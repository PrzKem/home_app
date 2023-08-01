<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventsAcceptance extends Model
{
    use HasFactory;
    protected $fillable = ['proposal_ID','person','accepted','is_participant'];
}
