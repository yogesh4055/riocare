<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InwardPackingMaterial extends Model
{
    use HasFactory;
    protected $table = 'goods_receipt_notes';
    protected $fillable = [
        "id", "goods_going_from", "goods_going_to", "date_of_receipt",
        "manufacurer", "supplier", "invoice_no", "goods_receipt_no", "created_by", "updated_at", "remark","is_opening_stock"
    ];

    public function items()
    {
        return $this->hasMany(InwardPackingMaterialItems::class, 'good_receipt_id');
    }
}
