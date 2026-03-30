<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * @property int $id
 * @property string $url
 * @property string $alt_text
 * @property string $caption
 * @property int $position
 * @property int $is_primary
 * @property int $product_id
 * @property Carbon|string $created_at
 * @property Carbon|string $updated_at
 * @property Carbon|string $deleted_at
 * @property Product[] $product
 */
class Image extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'images';
    protected $fillable = ['url', 'alt_text', 'caption', 'position', 'is_primary', 'product_id'];
    protected $casts = ['is_primary' => 'boolean'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}