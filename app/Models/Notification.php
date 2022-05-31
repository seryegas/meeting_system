<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = "note_id";

    protected $fillable = [
        'note_recipient_id',
        'note_text',
        'note_status',
        'note_type',
        'note_help_col',
    ];
}
