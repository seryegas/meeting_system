<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'company';
    protected $fillable = [
        'company_name',
        'supervisor_id',
        'secretary_id',
        'industry_id'
    ];
}
