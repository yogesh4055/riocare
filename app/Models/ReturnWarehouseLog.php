<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnWarehouseLog extends Model
{
    use HasFactory;
    protected $table = 'return_warehouse_log';
    protected $fillable = [
        "id",
        "prod_detail_id",
        "inword_m_id",
        "material_type",
        "total_qty",
        "created_at",
        "updated_at"
    ];
}
