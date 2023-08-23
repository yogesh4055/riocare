<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class RequisitionSlip extends Model
{
    use HasFactory;
    protected $table = 'packing_material_requisition_slip';
    protected $fillable = [
        "id",
        "order_id",
        "from",
        "to",
        "batchNo",
        "batch_id",
        "Date",
        "checkedBy",
        "ApprovedBy",
        "Remark",
        "created_at",
        "updated_at",
        "type",

        "status"
    ];

    public function DetailsRequisitions()
    {
        return $this->hasMany(DetailsRequisition::class,"requisition_id");
    }
    protected static function boot()
    {
      
        parent::boot();

        static::creating(function ($user) {
           
        activity('Packing Material Requisition Slip')
            ->performedOn($user)
            ->causedBy(auth()->user())
            /*->event('created')*/
            ->withProperties([
                    'user_id'    =>auth()->user()->id,
                    'first_name' => auth()->user()->name,
                    'ip'=>\Request::ip(),
                    "event"=> "Created"         
                ])
            ->log('Packing Material Requisition Slip Created');
        });

        static::updating(function ($user) {
           
            activity('Packing Material Requisition Slip')
                ->performedOn($user)
                ->causedBy(auth()->user())
                /*->event('updated')*/
                ->withProperties([
                        'user_id'    =>auth()->user()->id,
                        'first_name' => auth()->user()->name,
                        'ip'=>\Request::ip(),   
                        "event"=> "updated" 
                    ])
                ->log('Packing Material Requisition Slip Updated');
            });
        static::deleting(function ($user) {
        activity('Packing Material Requisition Slip')
            ->performedOn($user)
            /*->event('deleted')*/
            ->causedBy(auth()->user())
            ->withProperties([
                'user_id'    =>auth()->user()->id,
                'first_name' => auth()->user()->name,
                'ip'=>Request::ip(),
                "event"=> "deleted" 
                ])
            ->log('Packing Material Requisition Slip Deleted');
        });


    }
}
