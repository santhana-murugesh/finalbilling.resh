<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'gst_number',
        'aadhar_number',
        'state',
        'total_orders',
        'total_spent',
        'last_order_date',
    ];

    protected $casts = [
        'total_orders' => 'integer',
        'total_spent' => 'decimal:2',
        'last_order_date' => 'datetime',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(BilledOrder::class);
    }

    public function updateStats()
    {
        $this->total_orders = $this->orders()->count();
        $this->total_spent = $this->orders()->sum('total');
        $this->last_order_date = $this->orders()->latest()->first()?->created_at;
        $this->save();
    }
} 