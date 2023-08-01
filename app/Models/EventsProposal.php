<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventsProposal extends Model
{
    use HasFactory;
    protected $fillable = ['title','accepted','time_start','time_start','estimated_cost_per_person','budget_source'];
}
