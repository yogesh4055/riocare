<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class Issuematerialproduction extends Model
{
    use HasFactory;
    protected $table = 'issue_material_production';
    protected $fillable = [
        'id',
        'requisition_no',
        'batch_quantity',
        'material',
        'opening_bal',
        'batch_no',
        'viscosity',
        'issual_date',
        'issued_quantity',
        'finished_batch_no',
        'excess',
        'wastage',
        'returned_from_day_store',
        'closing_balance_qty',
        'dispensed_by',
        'remark',
        'created_at',
        'updated_at',
    ];
    protected static function boot()
    {
      
        parent::boot();

        static::creating(function ($user) {
           
        activity('Issue Material For Production')
            ->performedOn($user)
            ->causedBy(auth()->user())
            /*->event('created')*/
            ->withProperties([
                    'user_id'    =>auth()->user()->id,
                    'first_name' => auth()->user()->name,
                    'ip'=>\Request::ip(),
                    "event"=> "Created"         
                ])
            ->log('Issue Material For Production Created');
        });

        static::updating(function ($user) {
           
            activity('Issue Material For Production')
                ->performedOn($user)
                ->causedBy(auth()->user())
                /*->event('updated')*/
                ->withProperties([
                        'user_id'    =>auth()->user()->id,
                        'first_name' => auth()->user()->name,
                        'ip'=>\Request::ip(),   
                        "event"=> "updated" 
                    ])
                ->log('Issue Material For Production Updated');
            });
        static::deleting(function ($user) {
        activity('Issue Material For Production')
            ->performedOn($user)
            /*->event('deleted')*/
            ->causedBy(auth()->user())
            ->withProperties([
                'user_id'    =>auth()->user()->id,
                'first_name' => auth()->user()->name,
                'ip'=>Request::ip(),
                "event"=> "deleted" 
                ])
            ->log('Issue Material For Production Deleted');
        });


    }
}
