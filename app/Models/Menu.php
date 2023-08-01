<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = ['meal_id', 'type_of_meal', 'time_of_occuring'];
    public $timestamps = false;
}
