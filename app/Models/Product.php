<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Property;
use App\Filters\ProductFilter;

class Product extends Model
{
    use HasFactory;

    protected $table = "rs_products";

    protected $fillable = [
        'title'
    ];

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function scopeFilter(Builder $builder, ProductFilter $filter)
    {
        $filter->apply($builder);
    }
}
