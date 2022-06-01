<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = "task_id";

    protected $fillable = [
        'task_recipient_id',
        'task_text',
        'task_status',
        'has_file',
    ];
}
