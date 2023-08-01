<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseholdChecklist extends Model
{
    use HasFactory;
    protected $fillable = ['event_ID','value','person_responsible'];
}
