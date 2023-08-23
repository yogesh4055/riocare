<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class ListOfEquipmentManufacturing extends Model
{
    use HasFactory;
    protected $table = 'list_of_equipment_in_manufacturin_process';
    protected $fillable = [
        'id',
        'batch_manufacturing_id',
        'EquipmentName',
        'EquipmentCode',
        'created_at',
        'updated_at',
    ];
    protected static function boot()
    {
      
        parent::boot();

        static::creating(function ($user) {
           
        activity('List Of Equipment In Manufacturin Process')
            ->performedOn($user)
            ->causedBy(auth()->user())
            /*->event('created')*/
            ->withProperties([
                    'user_id'    =>auth()->user()->id,
                    'first_name' => auth()->user()->name,
                    'ip'=>\Request::ip(),
                    "event"=> "Created"         
                ])
            ->log('List Of Equipment In Manufacturin Process Created');
        });

        static::updating(function ($user) {
           
            activity('List Of Equipment In Manufacturin Process')
                ->performedOn($user)
                ->causedBy(auth()->user())
                /*->event('updated')*/
                ->withProperties([
                        'user_id'    =>auth()->user()->id,
                        'first_name' => auth()->user()->name,
                        'ip'=>\Request::ip(),   
                        "event"=> "updated" 
                    ])
                ->log('List Of Equipment In Manufacturin Process Updated');
            });
        static::deleting(function ($user) {
        activity('List Of Equipment In Manufacturin Process')
            ->performedOn($user)
            /*->event('deleted')*/
            ->causedBy(auth()->user())
            ->withProperties([
                'user_id'    =>auth()->user()->id,
                'first_name' => auth()->user()->name,
                'ip'=>Request::ip(),
                "event"=> "deleted" 
                ])
            ->log('List Of Equipment In Manufacturin Process Deleted');
        });


    }
}
