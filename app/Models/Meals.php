<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meals extends Model
{
    use HasFactory;
    protected $fillable = ['final_number_of_portions','type_of_meal','name','source'];
}
