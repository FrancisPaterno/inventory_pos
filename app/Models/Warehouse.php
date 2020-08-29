<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warehouse extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['name', 'address', 'contact'];

    public function stockHeaders(){
        return $this->hasMany(StockHeader::class);
    }
}
