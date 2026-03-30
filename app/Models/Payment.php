<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * @property int $id
 * @property int $order_id
 * @property double $amount
 * @property string $currency
 * @property string $method
 * @property string $status
 * @property string $transaction_id
 * @property Array|string $gateway_response
 * @property Carbon|string $captured_at
 * @property Carbon|string $refunded_at
 * @property Carbon|string $created_at
 * @property Carbon|string $updated_at
 * @property Carbon|string $deleted_at
 * @property Order[] $order
 */
class Payment extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'payments';
    protected $fillable = ['order_id', 'amount', 'currency', 'method', 'status', 'transaction_id', 'gateway_response', 'captured_at', 'refunded_at'];
    protected $casts = ['refunded_at' => 'date:d/m/Y'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }
}