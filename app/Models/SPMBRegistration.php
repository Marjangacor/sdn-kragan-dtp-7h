<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SPMBRegistration extends Model
{
    protected $table = 'spmb_registrations';

    protected $fillable = [
        'student_name',
        'student_email',
        'student_birthdate',
        'student_address',
        'parent_name',
        'parent_phone',
        'parent_email',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'student_birthdate' => 'date',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
}
