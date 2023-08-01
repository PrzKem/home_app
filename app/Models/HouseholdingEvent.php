<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseholdingEvent extends Model
{
    use HasFactory;
    protected $fillable = ['title','day_of_generation','span_of_weeks','generation_date', 'extra_marks'];
}
