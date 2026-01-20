<?php

namespace App\Models;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'access_type',
        'name',
        'email',
        'password',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Relationships
    public function student()
    {
        return $this->hasOne(Student::class, 'user_id');
    }

    public function isAdmin()
    {
        return $this->access_type === 'Admin';
    }

    public function isStudent()
    {
        return $this->access_type === 'Student';
    }
}