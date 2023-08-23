<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class BillOfRawMaterialsDetails extends Model
{
    use HasFactory;
    protected $table = 'bill_of_raw_material_details';
    protected $fillable = [
        'id',
        'rawMaterialName',
        'batchNo',
        'Quantity',
        'arNo',
        'date',
        'bill_of_raw_material_id',
        'created_at',
        'updated_at',
    ];
    protected static function boot()
    {
      
        parent::boot();

        static::creating(function ($user) {
           
        activity('Bill Of Raw Material Details')
            ->performedOn($user)
            ->causedBy(auth()->user())
            /*->event('created')*/
            ->withProperties([
                    'user_id'    =>auth()->user()->id,
                    'first_name' => auth()->user()->name,
                    'ip'=>\Request::ip(),
                    "event"=> "Created"         
                ])
            ->log('Bill Of Raw Material Details Created');
        });

        static::updating(function ($user) {
           
            activity('Bill Of Raw Material Details')
                ->performedOn($user)
                ->causedBy(auth()->user())
                /*->event('updated')*/
                ->withProperties([
                        'user_id'    =>auth()->user()->id,
                        'first_name' => auth()->user()->name,
                        'ip'=>\Request::ip(),   
                        "event"=> "updated" 
                    ])
                ->log('Bill Of Raw Material Details Updated');
            });
        static::deleting(function ($user) {
        activity('Bill Of Raw Material Details')
            ->performedOn($user)
            /*->event('deleted')*/
            ->causedBy(auth()->user())
            ->withProperties([
                'user_id'    =>auth()->user()->id,
                'first_name' => auth()->user()->name,
                'ip'=>Request::ip(),
                "event"=> "deleted" 
                ])
            ->log('Bill Of Raw Material Details Deleted');
        });


    }
}
