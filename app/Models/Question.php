<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    use HasFactory;

    protected $primaryKey = "question_id";

    public $timestamps = false;

    protected $table = 'questions';
    protected $fillable = [
        'meeting_id',
        'question_name',
        'speaker_id',
        'description'
    ];

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }

    public function users()
    {
        return $this->hasOne(User::class, 'id', 'speaker_id');
    }
}
