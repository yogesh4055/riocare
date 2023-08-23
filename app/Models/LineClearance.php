<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineClearance extends Model
{
    use HasFactory;
    protected $table = 'line_clearance_record';
    protected $fillable = [
        "id",
        "EquipmentName",
        "Observation",
        "time",
        "line_clearance_id",
        "created_at ",
        "updated_at",
    ];
}
