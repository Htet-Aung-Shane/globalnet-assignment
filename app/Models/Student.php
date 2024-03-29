<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'father_name',
        'phone',
        'address',
        'roll_no',
        'class',
        'dob',
        'nrc',
    ];

}
