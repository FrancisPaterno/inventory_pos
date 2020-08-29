<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockHeader extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['delivery_receipt_no', 'description', 'date', 'warehouse_id', 'supplier_id', 'total'];

    public function warehouse(){
        return $this->belongsTo(Warehouse::class);
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }

    public function stockItems(){
        return $this->hasMany(StockItem::class);
    }

    protected static function boot(){
        parent::boot();

        static::deleted(function($stockHeader){
            $stockHeader->stockItems()->delete();
        });
    }
}
