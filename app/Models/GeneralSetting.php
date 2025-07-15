<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    protected $fillable = [
        'company_name',
        'company_address',
        'company_phone',
        'company_email',
        'company_website',
        'gst_number',
        'logo',
        'tax_rate',
        'currency_symbol',
        'invoice_prefix',
    ];

    protected $casts = [
        'tax_rate' => 'decimal:2',
    ];

    public function getLogoUrlAttribute()
    {
        if ($this->logo) {
            return asset('storage/' . $this->logo);
        }
        return asset('images/default-logo.png');
    }

    public function getFormattedTaxRateAttribute()
    {
        return $this->tax_rate . '%';
    }
}
