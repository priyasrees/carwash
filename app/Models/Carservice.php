<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carservice extends Model
{
    use HasFactory;
    protected $fillable = ['car_service_name','description'];
}
