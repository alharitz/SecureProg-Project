<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
