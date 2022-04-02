<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Industry extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'industry';
    protected $fillable = [
        'industry_name'
    ];
}
