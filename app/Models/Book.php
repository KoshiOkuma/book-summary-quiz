<?php

namespace App\Models;

use App\Models\User;
use App\Models\Summary;
use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory, SoftDeletes ;

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

    public function question()
    {
        return $this->hasMany(Question::class);
    }
}
