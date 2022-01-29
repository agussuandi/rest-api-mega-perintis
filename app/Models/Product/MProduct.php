<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class MProduct extends Model
{
    protected $table = 'm_product';
    protected $primaryKey = 'id';
    public $timestamps = false;
}