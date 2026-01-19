<?php

namespace App\Models;

use App\Http\Controllers\LoanstatusController;
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
        return $this->belongsTo(Student::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function statuses()
    {
        return $this->hasMany(LoanstatusController::class, 'loan_id');
    }

    public function latestStatus()
    {
        return $this->hasOne(LoanstatusController::class, 'loan_id')->latestOfMany();
    }
}