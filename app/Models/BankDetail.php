<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_name',
        'account_number',
        'ifsc_code',
        'branch',
        'is_default'
    ];

    protected $casts = [
        'is_default' => 'boolean'
    ];
}
