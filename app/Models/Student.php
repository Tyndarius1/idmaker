<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Student extends Model
{
    use HasFactory;

    // Table name
    protected $table = 'students';

    // Primary key
    protected $primaryKey = 'id';

    // Fillable attributes for mass assignment
    protected $fillable = [
        'student_id',
        'first_name',
        'last_name',
        'address',
        'birth_date',
        'course',
        'profile_image',
    ];

    // Cast birth_date to a date format
    protected $casts = [
        'birth_date' => 'date',
    ];
}
