<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = "solution_id";

    protected $fillable = [
        'question_id',
        'solution_desc'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
