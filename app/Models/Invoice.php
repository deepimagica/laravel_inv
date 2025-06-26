<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'user_id',
        'invoice_no',
        'billed_name',
        'billed_address',
        'billed_phone',
        'shipped_name',
        'shipped_address',
        'shipped_phone',
        'subtotal',
        'tax',
        'total'
    ];

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
