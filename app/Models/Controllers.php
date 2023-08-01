<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Controllers extends Model
{
    use HasFactory;
    protected $primaryKey = 'id'; 
    protected $fillable = ['name','location','actual_work_mode'];
}
