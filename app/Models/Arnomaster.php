<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arnomaster extends Model
{
    use HasFactory;
    protected $table = 'ar_no_master';
    protected $fillable = [
        'id',
        'name',
        'created_at',
        'updated_at',
    ];
}
