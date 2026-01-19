<?php

namespace App\Models;

use App\Http\Controllers\LoansController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'author',
        'publisher',
        'publication_year',
        'isbn',
        'category',
        'stock',
        'cover',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'publication_year' => 'integer',
        'stock' => 'integer',
        'deleted_at' => 'datetime',
    ];

    // Relationships
    public function loans()
    {
        return $this->hasMany(Loan::class, 'book_id');
    }
}