<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class InwardMaterial extends Model
{
    use HasFactory;
    protected $table = 'inward_raw_materials';
    protected $fillable = [
        "id",
        "inward_no",
        "received_from",
        "received_to",
        "date_of_receipt",
        "material",
        "manufacturer",
        "supplier",
        "supplier_address",
        "supplier_gst", "invoice_no",
        "goods_receipt_no",
        "created_by",
        "remark",
        "viscosity",
        "is_opening"
    ];

    protected static function boot()
    {
      
        parent::boot();

        static::creating(function ($user) {
           
        activity('Inward Raw Materials')
            ->performedOn($user)
            ->causedBy(auth()->user())
            /*->event('created')*/
            ->withProperties([
                    'user_id'    =>auth()->user()->id,
                    'first_name' => auth()->user()->name,
                    'ip'=>\Request::ip(),
                    "event"=> "Created"         
                ])
            ->log('Inward Raw Materials Created');
        });

        static::updating(function ($user) {
           
            activity('Inward Raw Materials')
                ->performedOn($user)
                ->causedBy(auth()->user())
                /*->event('updated')*/
                ->withProperties([
                        'user_id'    =>auth()->user()->id,
                        'first_name' => auth()->user()->name,
                        'ip'=>\Request::ip(),   
                        "event"=> "updated" 
                    ])
                ->log('Inward Raw Materials Updated');
            });
        static::deleting(function ($user) {
        activity('Inward Raw Materials')
            ->performedOn($user)
            /*->event('deleted')*/
            ->causedBy(auth()->user())
            ->withProperties([
                'user_id'    =>auth()->user()->id,
                'first_name' => auth()->user()->name,
                'ip'=>Request::ip(),
                "event"=> "deleted" 
                ])
            ->log('Inward Raw Materials Deleted');
        });


    }

}
