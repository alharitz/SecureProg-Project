<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Forum extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'forum_images_path',
        'views',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function report()
    {
        return $this->hasOne(Report::class);
    }

    protected $primaryKey = 'id'; // Ensures it references the UUID field
    public $incrementing = false; // Because UUIDs are not auto-incrementing
    protected $keyType = 'string'; // UUIDs are stored as strings
    protected static function boot()
    {
        parent::boot();

        // Automatically generate UUID for 'id' field on creating a new record
        static::creating(function ($forum) {
            if (empty($forum->id)) {
                $forum->id = (string) Str::uuid();
            }
        });
    }
}
