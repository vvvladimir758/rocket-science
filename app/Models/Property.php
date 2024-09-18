<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Property extends Model
{
    use HasFactory;

    protected $table = "rs_properties";

    protected $fillable = [
        'title',
        'value'
    ];

    public $timestamps = false;

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
