<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classroom extends Model // Singular, bukan Classrooms
{
    use SoftDeletes; // Untuk soft delete (deleted_at)

    protected $table = 'classrooms';

    protected $fillable = [
        'class_name',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    // Hapus created_at, updated_at dari fillable karena otomatis
    // Jangan set timestamps = false, biarkan true (default)

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    // Relationships
    public function students()
    {
        return $this->hasMany(Student::class, 'classroom_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}