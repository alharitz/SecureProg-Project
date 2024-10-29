<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
      'forum_id',
      'report_count',
    ];

    public function forum(){
        return $this->belongsTo(Forum::class);
    }

    protected $primaryKey = 'id'; // Ensures it references the UUID field
    public $incrementing = false; // Because UUIDs are not auto-incrementing
    protected $keyType = 'string'; // UUIDs are stored as strings
    protected static function boot()
    {
        parent::boot();

        // Automatically generate UUID for 'id' field on creating a new record
        static::creating(function ($report) {
            if (empty($report->id)) {
                $report->id = (string) Str::uuid();
            }
        });
    }
}
