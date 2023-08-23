<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayStoreReport extends Model
{
    use HasFactory;
    protected $table = 'daystore_report';
    protected $fillable = [
        'id',
        'requesetion_detail_id',
        'issue_m_r_id',
        'add_lots_raw_id',
        "created_at",
        "updated_at",
    ];
}
