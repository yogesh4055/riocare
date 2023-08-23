<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class PackingMaterialSlip extends Model
{
    use HasFactory;
    protected $table = 'packingmaterial_issual_slip';
    protected $fillable = [
        'id',
        'from',
        'to',
        'batchNo',
        'Date',
        'doneBy',
        'checkedBy',
        'order_id',
        'created_at',
        'updated_at',
    ];
    protected static function boot()
    {
      
        parent::boot();

        static::creating(function ($user) {
           
        activity('Packing Material Issual Slip')
            ->performedOn($user)
            ->causedBy(auth()->user())
            /*->event('created')*/
            ->withProperties([
                    'user_id'    =>auth()->user()->id,
                    'first_name' => auth()->user()->name,
                    'ip'=>\Request::ip(),
                    "event"=> "Created"         
                ])
            ->log('Packing Material Issual Slip Created');
        });

        static::updating(function ($user) {
           
            activity('Packing Material Issual Slip')
                ->performedOn($user)
                ->causedBy(auth()->user())
                /*->event('updated')*/
                ->withProperties([
                        'user_id'    =>auth()->user()->id,
                        'first_name' => auth()->user()->name,
                        'ip'=>\Request::ip(),   
                        "event"=> "updated" 
                    ])
                ->log('Packing Material Issual Slip Updated');
            });
        static::deleting(function ($user) {
        activity('Packing Material Issual Slip')
            ->performedOn($user)
            /*->event('deleted')*/
            ->causedBy(auth()->user())
            ->withProperties([
                'user_id'    =>auth()->user()->id,
                'first_name' => auth()->user()->name,
                'ip'=>Request::ip(),
                "event"=> "deleted" 
                ])
            ->log('Packing Material Issual Slip Deleted');
        });


    }
}
