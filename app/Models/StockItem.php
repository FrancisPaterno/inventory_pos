<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockItem extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['stock_header_id', 'item_id', 'description', 'Qty', 'wholesale_price', 'retail_price'];

    public function stockheader(){
        return $this->belongsTo(StockHeader::class);
    }

    public function item(){
        return $this->belongsTo(Item::class);
    }
}
