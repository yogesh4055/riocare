<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Request;

class AddLotsl extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'add_lotsl';
    protected $fillable = [
        'id',
        'order_id',
        'proName',
        'bmrNo',
        'batchNo',
        'refMfrNo',
        'Date',
        'lotNo',
        'ReactorNo',
        'batch_id',
        'Process_date',
        "homogenize_done",
        "homogenize_date",
        'created_at',
        'updated_at',
    ];
    protected static function boot()
    {
      
        parent::boot();

        static::creating(function ($user) {
           
        activity('Add Lotsl')
            ->performedOn($user)
            ->causedBy(auth()->user())
            /*->event('created')*/
            ->withProperties([
                    'user_id'    =>auth()->user()->id,
                    'first_name' => auth()->user()->name,
                    'ip'=>\Request::ip(),
                    "event"=> "Created"         
                ])
            ->log('Add Lotsl Created');
        });

        static::updating(function ($user) {
           
            activity('Add Lotsl')
                ->performedOn($user)
                ->causedBy(auth()->user())
                /*->event('updated')*/
                ->withProperties([
                        'user_id'    =>auth()->user()->id,
                        'first_name' => auth()->user()->name,
                        'ip'=>\Request::ip(),   
                        "event"=> "updated" 
                    ])
                ->log('Add Lotsl Updated');
            });
        static::deleting(function ($user) {
        activity('Add Lotsl')
            ->performedOn($user)
            /*->event('deleted')*/
            ->causedBy(auth()->user())
            ->withProperties([
                'user_id'    =>auth()->user()->id,
                'first_name' => auth()->user()->name,
                'ip'=>Request::ip(),
                "event"=> "deleted" 
                ])
            ->log('Add Lotsl Deleted');
        });


    }

}
