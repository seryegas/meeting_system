<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $primaryKey = "question_id";

    public $timestamps = false;

    protected $table = 'questions';
    protected $fillable = [
        'meeting_id',
        'question_name'
    ];
}
