<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * @property int $id
 * @property int $product_id
 * @property string $sku
 * @property double $price
 * @property double $compare_at_price
 * @property int $inventory_quantity
 * @property Array|string $attributes
 * @property double $weight
 * @property int $image_id
 * @property Carbon|string $created_at
 * @property Carbon|string $updated_at
 * @property Carbon|string $deleted_at
 * @property Product[] $product
 */
class Variant extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'variants';
    protected $fillable = ['product_id', 'sku', 'price', 'compare_at_price', 'inventory_quantity', 'attributes', 'weight', 'image_id'];
    protected $casts = ['attributes' => 'array'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}