<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property int $variant_id
 * @property string $name_snapshot
 * @property string $sku_snapshot
 * @property double $unit_price
 * @property int $quantity
 * @property double $total_price
 * @property double $tax_amount
 * @property Carbon|string $created_at
 * @property Carbon|string $updated_at
 * @property Order[] $order
 */
class OrderItem extends Model
{
    use HasFactory;
    protected $table = 'order_items';
    protected $fillable = ['order_id', 'product_id', 'variant_id', 'name_snapshot', 'sku_snapshot', 'unit_price', 'quantity', 'total_price', 'tax_amount'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }
}