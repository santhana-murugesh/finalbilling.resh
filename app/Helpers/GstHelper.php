<?php

namespace App\Helpers;

class GstHelper
{
    // GST rates for different states
    private static $stateGstRates = [
        'Tamil Nadu' => [
            'cgst' => 9,
            'sgst' => 9,
            'igst' => 0
        ],
        'Karnataka' => [
            'cgst' => 9,
            'sgst' => 9,
            'igst' => 0
        ],
        'Maharashtra' => [
            'cgst' => 9,
            'sgst' => 9,
            'igst' => 0
        ],
        'Delhi' => [
            'cgst' => 9,
            'sgst' => 9,
            'igst' => 0
        ],
        'Uttar Pradesh' => [
            'cgst' => 9,
            'sgst' => 9,
            'igst' => 0
        ],
        'Gujarat' => [
            'cgst' => 9,
            'sgst' => 9,
            'igst' => 0
        ],
        'West Bengal' => [
            'cgst' => 9,
            'sgst' => 9,
            'igst' => 0
        ],
        'Telangana' => [
            'cgst' => 9,
            'sgst' => 9,
            'igst' => 0
        ],
        'Andhra Pradesh' => [
            'cgst' => 9,
            'sgst' => 9,
            'igst' => 0
        ],
        'Kerala' => [
            'cgst' => 9,
            'sgst' => 9,
            'igst' => 0
        ],
        'Punjab' => [
            'cgst' => 9,
            'sgst' => 9,
            'igst' => 0
        ],
        'Haryana' => [
            'cgst' => 9,
            'sgst' => 9,
            'igst' => 0
        ],
        'Rajasthan' => [
            'cgst' => 9,
            'sgst' => 9,
            'igst' => 0
        ],
        'Madhya Pradesh' => [
            'cgst' => 9,
            'sgst' => 9,
            'igst' => 0
        ],
        'Bihar' => [
            'cgst' => 9,
            'sgst' => 9,
            'igst' => 0
        ],
        'Odisha' => [
            'cgst' => 9,
            'sgst' => 9,
            'igst' => 0
        ],
        'Jharkhand' => [
            'cgst' => 9,
            'sgst' => 9,
            'igst' => 0
        ],
        'Chhattisgarh' => [
            'cgst' => 9,
            'sgst' => 9,
            'igst' => 0
        ],
        'Himachal Pradesh' => [
            'cgst' => 9,
            'sgst' => 9,
            'igst' => 0
        ],
        'Uttarakhand' => [
            'cgst' => 9,
            'sgst' => 9,
            'igst' => 0
        ],
        'Assam' => [
            'cgst' => 9,
            'sgst' => 9,
            'igst' => 0
        ],
        'Manipur' => [
            'cgst' => 9,
            'sgst' => 9,
            'igst' => 0
        ],
        'Meghalaya' => [
            'cgst' => 9,
            'sgst' => 9,
            'igst' => 0
        ],
        'Nagaland' => [
            'cgst' => 9,
            'sgst' => 9,
            'igst' => 0
        ],
        'Tripura' => [
            'cgst' => 9,
            'sgst' => 9,
            'igst' => 0
        ],
        'Mizoram' => [
            'cgst' => 9,
            'sgst' => 9,
            'igst' => 0
        ],
        'Arunachal Pradesh' => [
            'cgst' => 9,
            'sgst' => 9,
            'igst' => 0
        ],
        'Sikkim' => [
            'cgst' => 9,
            'sgst' => 9,
            'igst' => 0
        ],
        'Goa' => [
            'cgst' => 9,
            'sgst' => 9,
            'igst' => 0
        ],
        'Chandigarh' => [
            'cgst' => 9,
            'sgst' => 9,
            'igst' => 0
        ],
        'Dadra and Nagar Haveli' => [
            'cgst' => 9,
            'sgst' => 9,
            'igst' => 0
        ],
        'Daman and Diu' => [
            'cgst' => 9,
            'sgst' => 9,
            'igst' => 0
        ],
        'Lakshadweep' => [
            'cgst' => 9,
            'sgst' => 9,
            'igst' => 0
        ],
        'Andaman and Nicobar Islands' => [
            'cgst' => 9,
            'sgst' => 9,
            'igst' => 0
        ],
        'Jammu and Kashmir' => [
            'cgst' => 9,
            'sgst' => 9,
            'igst' => 0
        ],
        'Ladakh' => [
            'cgst' => 9,
            'sgst' => 9,
            'igst' => 0
        ],
        'Puducherry' => [
            'cgst' => 9,
            'sgst' => 9,
            'igst' => 0
        ]
    ];

    // Default GST rates (for inter-state transactions)
    private static $defaultRates = [
        'cgst' => 0,
        'sgst' => 0,
        'igst' => 18
    ];

    /**
     * Get GST rates based on customer state
     * If customer state is same as business state (Tamil Nadu), use CGST+SGST
     * If different state, use IGST
     */
    public static function getGstRates($customerState = null, $businessState = 'Tamil Nadu')
    {
        // If no customer state provided, return default rates
        if (!$customerState) {
            return self::$defaultRates;
        }

        // If customer is from same state as business, use CGST+SGST
        if (strtolower($customerState) === strtolower($businessState)) {
            return self::$stateGstRates[$customerState] ?? self::$defaultRates;
        }

        // If customer is from different state, use IGST
        return [
            'cgst' => 0,
            'sgst' => 0,
            'igst' => 18
        ];
    }

    /**
     * Calculate GST amounts based on taxable amount and customer state
     */
    public static function calculateGst($taxableAmount, $customerState = null, $businessState = 'Tamil Nadu')
    {
        $rates = self::getGstRates($customerState, $businessState);
        
        return [
            'cgst' => ($taxableAmount * $rates['cgst']) / 100,
            'sgst' => ($taxableAmount * $rates['sgst']) / 100,
            'igst' => ($taxableAmount * $rates['igst']) / 100,
            'total_gst' => ($taxableAmount * ($rates['cgst'] + $rates['sgst'] + $rates['igst'])) / 100
        ];
    }

    /**
     * Get all available states
     */
    public static function getStates()
    {
        return array_keys(self::$stateGstRates);
    }
}
