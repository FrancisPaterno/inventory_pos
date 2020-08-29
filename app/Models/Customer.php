<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['firstname', 'middlename', 'lastname', 'gender_id', 'address', 'email', 'contact'];

    public function gender(){
        return $this->belongsTo(Gender::class);
    }
}
