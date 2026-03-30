<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @property int $id
 * @property int $cart_id
 * @property int $product_id
 * @property int $variant_id
 * @property double $price_at_time
 * @property int $quantity
 * @property Array|string $metadata
 * @property int $saved_for_later
 * @property Carbon|string $created_at
 * @property Carbon|string $updated_at
 * @property Cart[] $cart
 */
class CartItem extends Model
{
    use HasFactory;
    protected $table = 'cart_items';
    protected $fillable = ['cart_id', 'product_id', 'variant_id', 'price_at_time', 'quantity', 'metadata', 'saved_for_later'];
    protected $casts = ['saved_for_later' => 'boolean'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cart()
    {
        return $this->belongsTo('App\Models\Cart', 'cart_id');
    }
}