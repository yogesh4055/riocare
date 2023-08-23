<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomogenizingList extends Model
{
    use HasFactory;
    protected $table = 'homogenizing_list';
    protected $fillable = [
        'id',
        'dateProcess',
        'lots_name',
        'qty',
        'stratTime',
        'endTime',
        'doneby',
        'homogenizing_id',
        'created_at',
        'updated_at',
    ];
}
