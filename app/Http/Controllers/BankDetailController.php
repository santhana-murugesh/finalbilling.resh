<?php

namespace App\Http\Controllers;

use App\Models\BankDetail;
use Illuminate\Http\Request;

class BankDetailController extends Controller
{
    public function index()
    {
        $bankDetails = BankDetail::all();
        return view('bank-details.index', compact('bankDetails'));
    }

    public function create()
    {
        return view('bank-details.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:50',
            'ifsc_code' => 'required|string|max:20',
            'branch' => 'nullable|string|max:255',
            'is_default' => 'boolean',
        ]);

        // If this is set as default, unset other defaults
        if ($request->boolean('is_default')) {
            BankDetail::where('is_default', true)->update(['is_default' => false]);
        }

        BankDetail::create($request->all());

        return redirect()->route('bank-details.index')->with('success', 'Bank details added successfully!');
    }

    public function show(BankDetail $bankDetail)
    {
        return view('bank-details.show', compact('bankDetail'));
    }

    public function edit(BankDetail $bankDetail)
    {
        return view('bank-details.edit', compact('bankDetail'));
    }

    public function update(Request $request, BankDetail $bankDetail)
    {
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:50',
            'ifsc_code' => 'required|string|max:20',
            'branch' => 'nullable|string|max:255',
            'is_default' => 'boolean',
        ]);

        // If this is set as default, unset other defaults
        if ($request->boolean('is_default')) {
            BankDetail::where('is_default', true)->where('id', '!=', $bankDetail->id)->update(['is_default' => false]);
        }

        $bankDetail->update($request->all());

        return redirect()->route('bank-details.index')->with('success', 'Bank details updated successfully!');
    }

    public function destroy(BankDetail $bankDetail)
    {
        $bankDetail->delete();

        return redirect()->route('bank-details.index')->with('success', 'Bank details deleted successfully!');
    }

    public function getAllBankDetails()
    {
        $bankDetails = BankDetail::all();
        return response()->json(['success' => true, 'bankDetails' => $bankDetails]);
    }

    public function getDefaultBankDetails()
    {
        $bankDetail = BankDetail::where('is_default', true)->first();
        return response()->json(['success' => true, 'bankDetail' => $bankDetail]);
    }
}
