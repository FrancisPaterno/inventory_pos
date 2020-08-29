<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleItem extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['sale_id', 'stock_item_id', 'description', 'quantity', 'sale_price', 'total'];
}
