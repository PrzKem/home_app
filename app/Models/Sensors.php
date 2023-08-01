<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensors extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['controller_id','measurement_unit'];
}
