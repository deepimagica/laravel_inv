<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function getInvoice()
    {
        return view('user.page.invoice');
    }

    public function getCreateInvoiceForm()
    {
        return view('user.page.invoice-create');
    }

    public function getItemRow(Request $request)
    {
        $index = $request->get('index', 0);
        return view('user.page.item_row', compact('index'));
    }

    public function store(StoreInvoiceRequest $request)
    {
        DB::beginTransaction();

        try {
            $invoice = Invoice::create([
                'user_id' => auth()->guard('user')->id(),
                'invoice_no' => 'INV-' . now()->format('Ymd') . '-' . mt_rand(1000, 9999),
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

            $items = collect($request->items)->map(function ($item) {
                return [
                    'product'  => $item['product'],
                    'hsn'      => $item['hsn'] ?? null,
                    'design'   => $item['design'] ?? null,
                    'quantity' => $item['quantity'],
                    'rate'     => $item['rate'],
                    'amount'   => $item['amount'],
                ];
            });

            $invoice->items()->createMany($items->toArray());

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Invoice created successfully!',
                'redirect_url' => route('user.invoice.list')
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to create invoice. Please try again.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $user = auth()->guard('user')->user();
            $invoices = $user->invoices()->with('user')->orderBy('created_at', 'desc');

            return DataTables::of($invoices)
                ->addColumn('action', function ($row) {
                    $id = Crypt::encrypt($row->id);
                    $downloadUrl = route('user.invoice.download', $id);
                    $editUrl = route('user.invoice.edit', $id);
                    return '
                    <a href="' . $downloadUrl . '" class="btn btn-sm btn-outline-primary" title="Download">
                        <i class="fa fa-download"></i>
                    </a>
                    <a href="' . $editUrl . '" class="btn btn-sm btn-outline-success" title="Edit">
                        <i class="fa fa-edit"></i>
                    </a>
                    <button class="btn btn-sm btn-outline-danger delete-invoice" data-id="' . $id . '" title="Delete">
                        <i class="fa fa-trash"></i>
                    </button>';
                })
                ->addColumn('user_name', function ($row) {
                    return $row->user->name ?? '-';
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('Y-m-d');
                })
                ->rawColumns(['action', 'user_name'])
                ->make(true);
        }

        return view('user.page.invoice_list');
    }

    public function downloadInvoice($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);
        $invoice = Invoice::with('items')->findOrFail($id);
        $user = auth()->guard('user')->user();

        if ($invoice->user_id !== $user->id) {
            abort(403);
        }

        $pdf = Pdf::loadView('user.page.invoice_pdf', compact('invoice', 'user'));
        return $pdf->download('invoice_' . $invoice->invoice_no . '.pdf');
    }

    public function edit($id)
    {
        $invoiceId = Crypt::decrypt($id);
        $invoice = Invoice::with('items')->findOrFail($invoiceId);
        return view('user.page.invoice_edit', compact('invoice'));
    }

    public function update(UpdateInvoiceRequest $request, $id)
    {
        $invoiceId = Crypt::decrypt($id);
        $invoice = Invoice::findOrFail($invoiceId);

        $invoice->update([
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

        DB::transaction(function () use ($invoice, $request) {
            $invoice->items()->delete();

            $itemsData = collect($request->items)->map(function ($item) {
                return [
                    'product'  => $item['product'],
                    'hsn'      => $item['hsn'] ?? null,
                    'design'   => $item['design'] ?? null,
                    'quantity' => $item['quantity'],
                    'rate'     => $item['rate'],
                    'amount'   => $item['amount'],
                ];
            });

            $invoice->items()->createMany($itemsData->toArray());
        });

        return response()->json([
            'success' => true,
            'message' => 'Invoice updated successfully!',
            'redirect_url' => route('user.invoice.list')
        ]);
    }

    public function destroy($id)
    {
        $invoiceId = Crypt::decrypt($id);
        $invoice = Invoice::findOrFail($invoiceId);
        $invoice->items()->delete();
        $invoice->delete();

        return response()->json(['success' => true, 'message' => 'Invoice deleted successfully']);
    }
}
