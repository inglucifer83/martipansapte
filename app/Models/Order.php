<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * @property int $id
 * @property int $user_id
 * @property string $order_number
 * @property string $status
 * @property double $subtotal
 * @property double $shipping_cost
 * @property double $tax_total
 * @property double $total
 * @property string $currency
 * @property int $billing_address_id
 * @property int $shipping_address_id
 * @property Carbon|string $placed_at
 * @property Carbon|string $fulfilled_at
 * @property string $tracking_number
 * @property Carbon|string $created_at
 * @property Carbon|string $updated_at
 * @property Carbon|string $deleted_at
 * @property OrderItem[] $order_items
 * @property Payment[] $payments
 * @property User[] $user
 */
class Order extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = ['user_id', 'order_number', 'status', 'subtotal', 'shipping_cost', 'tax_total', 'total', 'currency', 'billing_address_id', 'shipping_address_id', 'placed_at', 'fulfilled_at', 'tracking_number'];
    protected $casts = ['fulfilled_at' => 'date:d/m/Y'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function order_items()
    {
        return $this->hasMany('App\Models\OrderItem', 'order_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments()
    {
        return $this->hasMany('App\Models\Payment', 'order_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}