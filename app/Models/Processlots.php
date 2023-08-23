<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Processlots extends Model
{
    use HasFactory;
    protected $table = 'process_lots';
    protected $fillable = [
        "id",
        "qty",
        "temp",
        "stratTime",
        "endTime",
        "doneby",
        "checkedby",
        "lot_id",
        "process_id",
        "created_at",
        "updated_at",
    ];
}
