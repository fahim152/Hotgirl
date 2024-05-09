<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorData extends Model
{
    protected $table = 'history'; // Ensure this is the correct table name
    protected $fillable = ['timestamp', 'temperature', 'humidity']; // Add all relevant fields
}
