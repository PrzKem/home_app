<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IoTTags extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['alias','value'];
    protected $table="iottags";
}
