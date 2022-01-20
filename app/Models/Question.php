<?php

namespace App\Models;

use App\Models\Book;
use App\Models\Choice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'content',
        'description',
    ];

    public function choice()
    {
        return $this->hasMany(Choice::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
