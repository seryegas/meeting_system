<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'meeting';

    protected $fillable = [
        'meeting_name',
        'company_id',
        'description',
        'meeting_time'
    ];
}
