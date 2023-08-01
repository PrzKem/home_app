<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredients extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'quantity_in_package', 'measure_of_package', 'quantity_on_stock']; 
}
