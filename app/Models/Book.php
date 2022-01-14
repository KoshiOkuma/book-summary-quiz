<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'author',
        'image',
    ];

    public function summary()
    {
        return $this->hasOne(Summary::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
