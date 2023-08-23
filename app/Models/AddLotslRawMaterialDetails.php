<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class AddLotslRawMaterialDetails extends Model
{
    use HasFactory;
    protected $table = 'add_lots_raw_material_detail';
    protected $fillable = [
        'id',
        'MaterialName',
        'rmbatchno',
        'Quantity',
        'add_lots_id',
        'req_detail_id',
        'created_at',
        'updated_at',
    ];
    protected static function boot()
    {
      
        parent::boot();

        static::creating(function ($user) {
           
        activity('Add Lots Raw Material Detail')
            ->performedOn($user)
            ->causedBy(auth()->user())
            /*->event('created')*/
            ->withProperties([
                    'user_id'    =>auth()->user()->id,
                    'first_name' => auth()->user()->name,
                    'ip'=>\Request::ip(),
                    "event"=> "Created"         
                ])
            ->log('Add Lots Raw Material Detail Created');
        });

        static::updating(function ($user) {
           
            activity('Add Lots Raw Material Detail')
                ->performedOn($user)
                ->causedBy(auth()->user())
                /*->event('updated')*/
                ->withProperties([
                        'user_id'    =>auth()->user()->id,
                        'first_name' => auth()->user()->name,
                        'ip'=>\Request::ip(),   
                        "event"=> "updated" 
                    ])
                ->log('Add Lots Raw Material Detail Updated');
            });
        static::deleting(function ($user) {
        activity('Add Lots Raw Material Detail')
            ->performedOn($user)
            /*->event('deleted')*/
            ->causedBy(auth()->user())
            ->withProperties([
                'user_id'    =>auth()->user()->id,
                'first_name' => auth()->user()->name,
                'ip'=>Request::ip(),
                "event"=> "deleted" 
                ])
            ->log('Add Lots Raw Material Detail Deleted');
        });


    }
}
