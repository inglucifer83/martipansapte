<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @property int $id
 * @property int $user_id
 * @property string $token
 * @property string $currency
 * @property double $total_amount
 * @property Carbon|string $expires_at
 * @property int $is_active
 * @property Carbon|string $created_at
 * @property Carbon|string $updated_at
 * @property CartItem[] $cart_items
 * @property User[] $user
 */
class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable = ['user_id', 'token', 'currency', 'total_amount', 'expires_at', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cart_items()
    {
        return $this->hasMany('App\Models\CartItem', 'cart_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}