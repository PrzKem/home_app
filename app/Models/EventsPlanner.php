<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventsPlanner extends Model
{
    use HasFactory;
    protected $fillable = ['event_ID','title','date_time','cost_per_person','location','extra_marks'];
}
