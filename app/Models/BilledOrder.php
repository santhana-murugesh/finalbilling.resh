<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Customer;

class BilledOrder extends Model
{
    protected $fillable = [
        'order_number',
        'cart',
        'subtotal',
        'discount',
        'tax',
        'total',
        'customer_id',
        'customer_info',
        'order_status',
        'payment_status',
        'notes',
    ];

    protected $casts = [
        'cart' => 'array',
        'customer_info' => 'array',
        'subtotal' => 'decimal:2',
        'discount' => 'decimal:2',
        'tax' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function getFormattedTotalAttribute()
    {
        return '₹' . number_format($this->total, 2);
    }

    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('d M Y, h:i A');
    }

    public function getStatusBadgeClassAttribute()
    {
        return match($this->order_status) {
            'pending' => 'bg-yellow-100 text-yellow-800',
            'processing' => 'bg-blue-100 text-blue-800',
            'completed' => 'bg-green-100 text-green-800',
            'cancelled' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getPaymentBadgeClassAttribute()
    {
        return match($this->payment_status) {
            'pending' => 'bg-yellow-100 text-yellow-800',
            'paid' => 'bg-green-100 text-green-800',
            'partial' => 'bg-orange-100 text-orange-800',
            'cancelled' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }
}
