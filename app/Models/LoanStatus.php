<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class LoanStatus extends Model
{ protected $fillable = [
        'loan_id',
        'status',
    ];

    public $timestamps = false;

    protected $casts = [
        'created_at' => 'datetime',
    ];

    // Relationships
    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}