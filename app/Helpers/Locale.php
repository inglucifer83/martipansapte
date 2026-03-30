<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
class Locale
{
    public static function langs()
    {
        return Cache::rememberForever('langs', function () {
            return DB::table('langs')->get();
        });
    }
    public static function flush($langs = false)
    {
        Cache::forget('locales');
        if ($langs) {
            Cache::forget('langs');
        }
    }
    public static function refresh($langs = false)
    {
        self::flush($langs);
        self::locales();
        if ($langs) {
            self::langs();
        }
    }
    private static function locales()
    {
        return Cache::rememberForever('locales', function () {
            $result = DB::table('lang_values', 'v')->join('langs', 'langs.id', '=', 'v.lang_id')->selectRaw('v.lang_key_id, JSON_OBJECTAGG(langs.code, v.value) as translations')->groupByRaw('v.lang_key_id')->get()->map(function ($r) {
                $r->translations = json_decode($r->translations, true);
                return $r;
            });
            $locales = $result->pluck('translations', 'lang_key_id')->toArray();
            return $locales;
        });
    }
    public static function get($keyId, $locale = null)
    {
        $locales = self::locales();
        $lang = $locale ?? app()->getLocale();
        return isset($locales[$keyId]) && isset($locales[$keyId][$lang]) ? $locales[$keyId][$lang] : '';
    }
    public static function all($keyId)
    {
        $locales = self::locales();
        return isset($locales[$keyId]) ? $locales[$keyId] : [];
    }
    public static function add($name, $topic, $values = [])
    {
        $langs = self::langs();
        $keyId = DB::table('lang_keys')->insertGetId(['name' => $name, 'topic' => $topic]);
        $inserts = [];
        foreach ($values as $code => $value) {
            $lang = $langs->firstWhere('code', $code);
            $inserts[] = ['lang_id' => $lang->id, 'lang_key_id' => $keyId, 'value' => $value];
        }
        if (count($inserts) > 0) {
            DB::table('lang_values')->insert($inserts);
            self::refresh();
        }
        return $keyId;
    }
    public static function set($keyId, $values)
    {
        $langs = self::langs();
        $langValues = DB::table('lang_values')->where('lang_key_id', $keyId)->get();
        $upserts = [];
        foreach ($values as $code => $value) {
            $lang = $langs->firstWhere('code', $code);
            $langValue = $langValues->firstWhere('lang_id', $lang->id);
            $langValue->value = $value;
            $upserts[] = json_decode(json_encode($langValue), true);
        }
        if (count($upserts) > 0) {
            DB::table('lang_values')->upsert($upserts, ['id'], ['value']);
            self::refresh();
        }
    }
    public static function nextIndex($prefix)
    {
        return DB::table('lang_keys')->whereLike('name', "%{$prefix}")->count();
    }
}