<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function getInvoice()
    {
        return view('user.page.invoice');
    }

    public function getCreateInvoiceForm()
    {
        return view('user.page.create-invoice');
    }
    public function store(Request $request)
    {
        $request->validate([
            'billed_name' => 'required|string',
            'billed_address' => 'required|string',
            'billed_phone' => 'required|string',
            'shipped_name' => 'required|string',
            'shipped_address' => 'required|string',
            'shipped_phone' => 'required|string',
            'items' => 'required|array|min:1',
            'items.*.product' => 'required|string',
            'items.*.hsn' => 'required|string',
            'items.*.design' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.rate' => 'required|numeric|min:1',
            'items.*.amount' => 'required|numeric|min:1',
            'tax' => 'required|numeric|min:1',
        ]);

        $invoice = Invoice::create([
            'user_id' => Auth::guard('user')->user()->id,
            'billed_name' => $request->billed_name,
            'billed_address' => $request->billed_address,
            'billed_phone' => $request->billed_phone,
            'shipped_name' => $request->shipped_name,
            'shipped_address' => $request->shipped_address,
            'shipped_phone' => $request->shipped_phone,
            'subtotal' => $request->subtotal,
            'tax' => $request->tax ?? 0,
            'total' => $request->total,
        ]);

        foreach ($request->items as $item) {
            $invoice->items()->create([
                'product' => $item['product'],
                'hsn' => $item['hsn'] ?? null,
                'design' => $item['design'] ?? null,
                'quantity' => $item['quantity'],
                'rate' => $item['rate'],
                'amount' => $item['amount'],
            ]);
        }

        return redirect()->route('user.invoice')->with('success', 'Invoice created successfully!');
    }
}
