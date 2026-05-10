<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class KasirCustomerController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'nullable',
            'email' => 'nullable|email',
            'address' => 'nullable',
        ]);

        $customer = Customer::create([
            'name' => $request->name,
            'phone' => $request->phone ?? '',
            'email' => $request->email,
            'address' => $request->address,
            'customer_type' => 'Member',
        ]);

        return response()->json(['success' => true, 'customer' => $customer]);
    }
}
