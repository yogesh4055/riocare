<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class BatchManufacturingEquipment extends Model
{
    use HasFactory;
    protected $table = 'batch_manufacturing_records_list_of_equipment';
    protected $fillable = [
        'id',
        'order_id',
        'proName',
        'bmrNo',
        'batchNo',
        "batch_id",
        'refMfrNo',
        'Remark',
        'created_at',
        'updated_at',

    ];
    protected static function boot()
    {
      
        parent::boot();

        static::creating(function ($user) {
           
        activity('Batch Manufacturing Records List Of Equipment')
            ->performedOn($user)
            ->causedBy(auth()->user())
            /*->event('created')*/
            ->withProperties([
                    'user_id'    =>auth()->user()->id,
                    'first_name' => auth()->user()->name,
                    'ip'=>\Request::ip(),
                    "event"=> "Created"         
                ])
            ->log('Batch Manufacturing Records List Of Equipment Created');
        });

        static::updating(function ($user) {
           
            activity('Batch Manufacturing Records List Of Equipment')
                ->performedOn($user)
                ->causedBy(auth()->user())
                /*->event('updated')*/
                ->withProperties([
                        'user_id'    =>auth()->user()->id,
                        'first_name' => auth()->user()->name,
                        'ip'=>\Request::ip(),   
                        "event"=> "updated" 
                    ])
                ->log('Batch Manufacturing Records List Of Equipment Updated');
            });
        static::deleting(function ($user) {
        activity('Batch Manufacturing Records List Of Equipment')
            ->performedOn($user)
            /*->event('deleted')*/
            ->causedBy(auth()->user())
            ->withProperties([
                'user_id'    =>auth()->user()->id,
                'first_name' => auth()->user()->name,
                'ip'=>Request::ip(),
                "event"=> "deleted" 
                ])
            ->log('Batch Manufacturing Records List Of Equipment Deleted');
        });


    }
}
