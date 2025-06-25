<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreInvoiceRequest;

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

    public function getItemRow(Request $request)
    {
        $index = $request->get('index', 0);
        return view('user.page.item_row', compact('index'));
    }

    // public function store(StoreInvoiceRequest $request)
    // {
    //     $request->validate([
    //         'billed_name' => 'required|string',
    //         'billed_address' => 'required|string',
    //         'billed_phone' => 'required|string',
    //         'shipped_name' => 'required|string',
    //         'shipped_address' => 'required|string',
    //         'shipped_phone' => 'required|string',
    //         'items' => 'required|array|min:1',
    //         // 'items.*.product' => 'required|string',
    //         // 'items.*.hsn' => 'required|string',
    //         // 'items.*.design' => 'required|string',
    //         // 'items.*.quantity' => 'required|integer|min:1',
    //         // 'items.*.rate' => 'required|numeric|min:1',
    //         // 'items.*.amount' => 'required|numeric|min:1',
    //         // 'tax' => 'required|numeric|min:1',

    //         'items.0.product'  => 'required|string',
    //         'items.0.hsn'      => 'required|string',
    //         'items.0.design'   => 'required|string',
    //         'items.0.quantity' => 'required|integer|min:1',
    //         'items.0.rate'     => 'required|numeric|min:1',
    //         'items.0.amount'   => 'required|numeric|min:1',
    //     ]);

    //     $invoice = Invoice::create([
    //         'user_id' => Auth::guard('user')->user()->id,
    //         'billed_name' => $request->billed_name,
    //         'billed_address' => $request->billed_address,
    //         'billed_phone' => $request->billed_phone,
    //         'shipped_name' => $request->shipped_name,
    //         'shipped_address' => $request->shipped_address,
    //         'shipped_phone' => $request->shipped_phone,
    //         'subtotal' => $request->subtotal,
    //         'tax' => $request->tax ?? 0,
    //         'total' => $request->total,
    //     ]);

    //     foreach ($request->items as $item) {
    //         if (collect($item)->filter()->isEmpty()) continue;
    //         $invoice->items()->create([
    //             'product'  => $item['product'],
    //             'hsn'      => $item['hsn'] ?? null,
    //             'design'   => $item['design'] ?? null,
    //             'quantity' => $item['quantity'],
    //             'rate'     => $item['rate'],
    //             'amount'   => $item['amount'],
    //         ]);
    //     }

    //     return response()->json(['success' => 'true', 'message' => 'Invoice created successfully!'], 200);
    // }

    public function store(StoreInvoiceRequest $request)
    {
        $invoice = Invoice::create([
            'user_id' => auth()->guard('user')->id(),
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
                'product'  => $item['product'],
                'hsn'      => $item['hsn'] ?? null,
                'design'   => $item['design'] ?? null,
                'quantity' => $item['quantity'],
                'rate'     => $item['rate'],
                'amount'   => $item['amount'],
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Invoice created successfully!',
        ]);
    }
}
