<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Property;

class ProductProperty extends Model
{
    protected $table = "rs_products_properties";
    public $timestamps = false;
}
