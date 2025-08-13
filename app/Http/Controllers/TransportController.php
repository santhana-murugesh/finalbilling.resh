<?php

namespace App\Http\Controllers;

use App\Models\Transport;
use Illuminate\Http\Request;

class TransportController extends Controller
{
    public function index()
    {
        $transports = Transport::all();
        return view('transports.index', compact('transports'));
    }

    public function create()
    {
        return view('transports.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'vehicle_number' => 'nullable|string|max:50',
        ]);

        Transport::create($request->all());

        return redirect()->route('transports.index')->with('success', 'Transport added successfully!');
    }

    public function show(Transport $transport)
    {
        return view('transports.show', compact('transport'));
    }

    public function edit(Transport $transport)
    {
        return view('transports.edit', compact('transport'));
    }

    public function update(Request $request, Transport $transport)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'vehicle_number' => 'nullable|string|max:50',
        ]);

        $transport->update($request->all());

        return redirect()->route('transports.index')->with('success', 'Transport updated successfully!');
    }

    public function destroy(Transport $transport)
    {
        $transport->delete();

        return redirect()->route('transports.index')->with('success', 'Transport deleted successfully!');
    }

    public function getAllTransports()
    {
        $transports = Transport::all();
        return response()->json(['success' => true, 'transports' => $transports]);
    }
}
