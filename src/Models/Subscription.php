<?php

namespace AppStore\InAppPurchase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'org_transaction_id',
        'group_id',
        'expire_at',
        'auto_renewable',
        'status'
    ];

    protected $casts = [
        'expire_at' => 'datetime',
    ];
}
