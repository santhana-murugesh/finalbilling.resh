<?php

namespace App\Http\Controllers;

use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = GeneralSetting::first();
        return view('settings', compact('settings'));
    }

    public function updateGeneralSettings(Request $request)
    {
        \Log::info('Settings update request received', [
            'data' => $request->all(),
            'files' => $request->hasFile('logo') ? 'Logo file present' : 'No logo file'
        ]);

        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string|max:255',
            'company_address' => 'required|string|max:500',
            'company_phone' => 'required|string|max:20',
            'company_email' => 'nullable|email|max:255',
            'company_website' => 'nullable|url|max:255',
            'gst_number' => 'nullable|string|max:50',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tax_rate' => 'nullable|numeric|min:0|max:100',
            'currency_symbol' => 'nullable|string|max:10',
            'invoice_prefix' => 'nullable|string|max:10',
        ]);

        if ($validator->fails()) {
            \Log::error('Settings validation failed', [
                'errors' => $validator->errors()->toArray()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $settings = GeneralSetting::first();
            if (!$settings) {
                $settings = new GeneralSetting();
            }

            // Handle logo upload
            if ($request->hasFile('logo')) {
                // Delete old logo if exists
                if ($settings->logo && Storage::disk('public')->exists($settings->logo)) {
                    Storage::disk('public')->delete($settings->logo);
                }

                $logoPath = $request->file('logo')->store('logos', 'public');
                $settings->logo = $logoPath;
            }

            // Update other settings
            $settings->company_name = $request->company_name;
            $settings->company_address = $request->company_address;
            $settings->company_phone = $request->company_phone;
            $settings->company_email = $request->company_email;
            $settings->company_website = $request->company_website;
            $settings->gst_number = $request->gst_number;
            $settings->tax_rate = $request->tax_rate ?? 18;
            $settings->currency_symbol = $request->currency_symbol ?? '₹';
            $settings->invoice_prefix = $request->invoice_prefix ?? 'ORD';

            $settings->save();

            \Log::info('Settings updated successfully', ['settings_id' => $settings->id]);

            return response()->json([
                'success' => true,
                'message' => 'Settings updated successfully!',
                'settings' => $settings
            ]);

        } catch (\Exception $e) {
            \Log::error('Error updating settings', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Error updating settings: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getSettings()
    {
        $settings = GeneralSetting::first();
        return response()->json([
            'success' => true,
            'settings' => $settings
        ]);
    }

    public function deleteLogo()
    {
        try {
            $settings = GeneralSetting::first();
            if ($settings && $settings->logo) {
                if (Storage::disk('public')->exists($settings->logo)) {
                    Storage::disk('public')->delete($settings->logo);
                }
                $settings->logo = null;
                $settings->save();
            }

            return response()->json([
                'success' => true,
                'message' => 'Logo deleted successfully!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting logo: ' . $e->getMessage()
            ], 500);
        }
    }
}
