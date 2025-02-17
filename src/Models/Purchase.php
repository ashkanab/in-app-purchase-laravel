<?php

namespace AppStore\InAppPurchase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'is_consumable',
        'org_transaction_id',
        'quantity',
        'status'
    ];
}
