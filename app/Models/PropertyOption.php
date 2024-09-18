<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Property;

class PropertyOption extends Model
{
    use HasFactory;

    protected $table = "rs_properties_options";

    protected $fillable = [
        'title',
        'value'
    ];

    public $timestamps = false;

    public function property(){
        return $this->belongsTo(Property::class);
    }
}
