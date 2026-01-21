<?php

namespace App\Models;

use App\Models\LoanStatus;
use App\Models\Book;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
        'student_id',
        'book_id',
        'start_date',
        'end_date',
        'created_by',
    ];

    public $timestamps = false; // Karena hanya ada created_at

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'created_at' => 'datetime',
    ];

    // Relationships
    public function student()
{
    return $this->belongsTo(Student::class, 'student_id');
}

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function statuses()
    {
        return $this->hasMany(LoanStatus::class, 'loan_id');
    }

    public function latestStatus()
    {
        return $this->hasOne(LoanStatus::class, 'loan_id')->latestOfMany();
    }
    
}