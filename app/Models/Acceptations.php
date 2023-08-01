<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acceptations extends Model
{
    use HasFactory;
    protected $fillable = ['eventID', 'userID', 'result'];
}
