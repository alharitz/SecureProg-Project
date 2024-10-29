<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'forum_id',
        'user_id',
        'parent_id',
        'content',
    ];

    // A comment can have a parent comment (if it's a reply)
    public function parent(){
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // A comment can have many replies (self-referential relationship)
    public function replies(){
        return $this->hasMany(Comment::class, 'parent_id');
    }

    // A comment belongs to a forum
    public function forum(){
        return $this->belongsTo(Forum::class);
    }

    // A comment belongs to a user
    public function user(){
        return $this->belongsTo(User::class);
    }

    protected $primaryKey = 'id'; // Ensures it references the UUID field
    public $incrementing = false; // Because UUIDs are not auto-incrementing
    protected $keyType = 'string'; // UUIDs are stored as strings
    protected static function boot()
    {
        parent::boot();

        // Automatically generate UUID for 'id' field on creating a new record
        static::creating(function ($comment) {
            if (empty($comment->id)) {
                $comment->id = (string) Str::uuid();
            }
        });
    }
}
