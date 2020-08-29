<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['name', 'sku', 'barcode', 'description', 'item_category_id', 'item_brand_id', 'item_unit_id', 'item_status_id'];

    public function itemCategory(){
        return $this->belongsTo(ItemCategory::class);
    }

    public function itemBrand(){
        return $this->belongsTo(ItemBrand::class);
    }

    public function itemUnit(){
        return $this->belongsTo(ItemUnit::class);
    }

    public function itemStatus(){
        return $this->belongsTo(ItemStatus::class);
    }
}
