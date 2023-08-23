<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisitionissuedmaterial extends Model
{
    use HasFactory;
    protected $table = 'issue_material_production_requestion';
    protected $fillable = [
        "id", "requestion_id", "from", "to", "issed_date", "batch_no", "checkedBy", "ApprovedBy", "batch_id", "created_at", "updated_at", "status", "type"
    ];

    public function DetailsRequisitions()
    {
        return $this->hasMany(DetailsRequisition::class,"requisition_id");
    }
}
