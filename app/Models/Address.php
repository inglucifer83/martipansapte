<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * @property int $id
 * @property int $user_id
 * @property string $label
 * @property string $full_name
 * @property string $company
 * @property string $street
 * @property string $city
 * @property string $region
 * @property string $postal_code
 * @property string $country
 * @property string $phone
 * @property int $is_default_shipping
 * @property int $is_default_billing
 * @property Carbon|string $created_at
 * @property Carbon|string $updated_at
 * @property Carbon|string $deleted_at
 * @property User[] $user
 */
class Address extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'addresses';
    protected $fillable = ['user_id', 'label', 'full_name', 'company', 'street', 'city', 'region', 'postal_code', 'country', 'phone', 'is_default_shipping', 'is_default_billing'];
    protected $casts = ['is_default_billing' => 'boolean'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}