<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Rawmeterial;
use Request;
class DetailsRequisition extends Model
{
    use HasFactory;
    protected $table = 'detail_packing_material_requisition';
    protected $fillable = [
        "id",
        "PackingMaterialName",
        "Capacity",
        "Quantity",
        "requisition_id",
        "created_at",
        "updated_at",
        "type",
        "approved_qty"
    ];

    public function Requisition()
    {
        return $this->belongsTo(RequisitionSlip::class,"id");
    }
    protected static function boot()
    {
      
        parent::boot();

        static::creating(function ($user) {
           
        activity('Detail Packing Material Requisition')
            ->performedOn($user)
            ->causedBy(auth()->user())
            /*->event('created')*/
            ->withProperties([
                    'user_id'    =>auth()->user()->id,
                    'first_name' => auth()->user()->name,
                    'ip'=>\Request::ip(),
                    "event"=> "Created"         
                ])
            ->log('Detail Packing Material Requisition Created');
        });

        static::updating(function ($user) {
           
            activity('Detail Packing Material Requisition')
                ->performedOn($user)
                ->causedBy(auth()->user())
                /*->event('updated')*/
                ->withProperties([
                        'user_id'    =>auth()->user()->id,
                        'first_name' => auth()->user()->name,
                        'ip'=>\Request::ip(),   
                        "event"=> "updated" 
                    ])
                ->log('Detail Packing Material Requisition Updated');
            });
        static::deleting(function ($user) {
        activity('Detail Packing Material Requisition')
            ->performedOn($user)
            /*->event('deleted')*/
            ->causedBy(auth()->user())
            ->withProperties([
                'user_id'    =>auth()->user()->id,
                'first_name' => auth()->user()->name,
                'ip'=>Request::ip(),
                "event"=> "deleted" 
                ])
            ->log('Detail Packing Material Requisition Deleted');
        });


    }

}
