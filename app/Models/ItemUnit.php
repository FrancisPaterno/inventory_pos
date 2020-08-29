<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemUnit extends Model
{
    //
    use SoftDeletes;
    //protected $dated = ['deleted_at'];
    protected $fillable = ['name', 'description'];
}
