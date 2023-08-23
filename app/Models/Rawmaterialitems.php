<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rawmaterialitems extends Model
{
    use HasFactory;
    protected $table = 'inward_raw_materials_items';
    protected $fillable = [
        "id",
        "inward_raw_material_id",
        "material",
        "batch_no",
        "total_no_of_containers_or_bags",
        "qty_received_kg",
        "mfg_date",
        "viscosity",
        "mfg_expiry_date",
        "rio_care_expiry_date",
        "ar_no_date",
        "opening_stock",
        "used_qty",
        "is_opening_stock",
        "ar_no_date_date"
    ];
}
