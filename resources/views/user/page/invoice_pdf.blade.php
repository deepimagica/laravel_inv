<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice - {{ $invoice->invoice_no }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #000;
        }

        .header,
        .footer {
            width: 100%;
            margin-bottom: 20px;
        }

        .header img {
            height: 60px;
        }

        .text-end {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 6px;
        }

        .no-border {
            border: none;
        }

        .bg-gray {
            background-color: #f2f2f2;
        }

        .mt-2 {
            margin-top: 8px;
        }

        .mt-4 {
            margin-top: 20px;
        }

        .mb-1 {
            margin-bottom: 4px;
        }

        .mb-2 {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <table>
            <tr>
                <td>
                    <img src="{{ public_path('assets/user/images/logo-sm.png') }}" alt="Logo">
                </td>
                <td class="text-end">
                    <strong>Invoice #:</strong> {{ $invoice->invoice_no }}<br>
                    <strong>Date:</strong> {{ $invoice->created_at->format('d/m/Y') }}
                </td>
            </tr>
        </table>
    </div>
    <table>
        <tr class="bg-gray">
            <th>Invoice To</th>
            <th>Billed To</th>
            <th>Shipped To</th>
        </tr>
        <tr>
            <td>
                <strong>{{ $invoice->billed_name }}</strong><br>
                GSTIN: {{ $invoice->billed_gst ?? 'N/A' }}
            </td>
            <td>
                {{ $invoice->billed_address }}<br>
                Phone: {{ $invoice->billed_phone }}
            </td>
            <td>
                {{ $invoice->shipped_address }}<br>
                Phone: {{ $invoice->shipped_phone }}
            </td>
        </tr>
    </table>

    <!-- Invoice Items -->
    <table>
        <thead class="bg-gray">
            <tr>
                <th>Product</th>
                <th>HSN</th>
                <th>Design</th>
                <th>Qty</th>
                <th>Rate (₹)</th>
                <th>Amount (₹)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoice->items as $item)
                <tr>
                    <td>{{ $item->product }}</td>
                    <td>{{ $item->hsn }}</td>
                    <td>{{ $item->design }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->rate, 2) }}</td>
                    <td>{{ number_format($item->quantity * $item->rate, 2) }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="5" class="text-end"><strong>Subtotal</strong></td>
                <td>{{ number_format($invoice->subtotal, 2) }}</td>
            </tr>
            <tr>
                <td colspan="5" class="text-end"><strong>GST ({{ $invoice->tax }}%)</strong></td>
                <td>{{ number_format(($invoice->subtotal * $invoice->tax) / 100, 2) }}</td>
            </tr>
            <tr>
                <td colspan="5" class="text-end"><strong>Total</strong></td>
                <td><strong>{{ number_format($invoice->total, 2) }}</strong></td>
            </tr>
        </tbody>
    </table>

    <!-- Terms & Signature -->
    <table class="mt-4">
        <tr>
            <td style="width: 60%;">
                <strong>Terms & Conditions</strong><br>
                <ul style="margin: 0; padding-left: 16px;">
                    <li>Payment to be made within 7 days.</li>
                    <li>Goods once sold will not be taken back.</li>
                    <li>Subject to Surat jurisdiction.</li>
                </ul>
            </td>
            <td class="text-end">
                <small>Authorized Signature</small><br>
                <img src="{{ public_path('assets/user/images/extra/signature.png') }}" height="30"><br>
                <div style="border-top: 1px solid #000; width: 80%; margin-left:auto;"></div>
            </td>
        </tr>
    </table>

    <!-- Footer -->
    <div class="text-center mt-4">
        <small>Thank you very much for doing business with us.</small>
    </div>

</body>

</html>
