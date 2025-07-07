<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'billing_period',
        'price',
        'invoice_limit_per_month',
        'features',
        'is_active',
    ];

}
