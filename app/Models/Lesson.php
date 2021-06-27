<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{

    protected $fillable = [
        'user_id', 'title', 'body'
    ];


    public function user()
    {
        return $this->belongsTo(User::class); //select * from Users where lesson_id = user_id
    }

    use HasFactory;

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'lesson_tags');
    }
}
