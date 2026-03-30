<?php

namespace App\Models;

use App\Helpers\Locale;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class LocalizedModel extends Model
{
    public function __get($key)
    {
        if (in_array($key, $this->fillable)) {
            return parent::__get($key);
        }
        $localizedKeyParts = explode('_', $key);
        $keyLocaleParts = array_slice($localizedKeyParts, -2);
        $keyLocale = implode('_', $keyLocaleParts);
        $singularKey = Str::singular($key);
        $singularField = "{$singularKey}_key_id";
        $tranlsatableField = "{$key}_key_id";
        $localizedField = str_replace('_' . $keyLocale, '_key_id', $key);
        if (in_array($tranlsatableField, $this->fillable)) {
            return Locale::get($this->{$tranlsatableField});
        } else if (in_array($singularField, $this->fillable)) {
            return Locale::all($this->{$singularField});
        } else if (in_array($localizedField, $this->fillable) && count($localizedKeyParts) > 2) {
            return Locale::get($this->{$localizedField}, $keyLocale);
        }
        return parent::__get($key);
    }
    private static function addKey($name, $values = [], $model)
    {
        $keyTopic = strtoupper($model->getTable()) . '_' . strtoupper($name);
        $keyPrefix = $model->getTable() . '_' . $name;
        $keyIndex = Locale::nextIndex($keyPrefix);
        $keyName = "{$keyPrefix}_{$keyIndex}";
        return Locale::add($keyName . '', $keyTopic, $values);
    }
    public static function __callStatic($name, $arguments)
    {
        if ($name == 'updateOrCreate' && count($arguments) > 1) {
            $fields = $arguments[1];
            $emptyModel = new static();
            if (isset($fields['id'])) {
                $model = DB::table($emptyModel->getTable())->where('id', $fields['id'])->first();
                foreach ($fields as $fieldName => $value) {
                    $localizedName = $fieldName . '_key_id';
                    if (is_array($value) && in_array($localizedName, $emptyModel->fillable)) {
                        if ($model->{$localizedName}) {
                            Locale::set($model->{$localizedName}, $value);
                        } else {
                            $fields[$localizedName] = self::addKey($localizedName, $value, $emptyModel);
                        }
                        unset($fields[$fieldName]);
                    }
                }
            } else {
                foreach ($fields as $fieldName => $value) {
                    $localizedName = $fieldName . '_key_id';
                    if (is_array($value) && in_array($localizedName, $emptyModel->fillable)) {
                        $fields[$localizedName] = self::addKey($localizedName, $value, $emptyModel);
                    }
                    unset($fields[$fieldName]);
                }
            }
            $arguments[1] = $fields;
        }
        parent::$name(...$arguments);
    }
}