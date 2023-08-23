<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class FinishedGoodsDispatch extends Model
{

    use HasFactory;
    protected $table = 'finished_goods_dispatch';
    protected $fillable = [
        'id',
        'dispath_no',
        'dispatch_form',
        'dispatch_to',
        'good_dispatch_date',
        'mode_of_dispatch',
        'party_name',
        'product',
        'invoice_no',
        'batch_no',
        'grade',
        'viscosity',
        'mfg_date',
        'expiry_ratest_date',
        'total_no_of_200kg_drums',
        'total_no_of_50kg_drums',
        'total_no_of_30kg_drums',
        'total_no_of_5kg_drums',
        'total_no_qty',
        'seal_no',
        'dispatch_date',
        'remark',
        'dispatch_by',
        'created_at',
        'updated_at',
        'total_no_of_fiber_board_drums'
    ];
    protected static function boot()
    {
      
        parent::boot();

        static::creating(function ($user) {
           
        activity('Dispatch Finished Goods')
            ->performedOn($user)
            ->causedBy(auth()->user())
            /*->event('created')*/
            ->withProperties([
                    'user_id'    =>auth()->user()->id,
                    'first_name' => auth()->user()->name,
                    'ip'=>\Request::ip(),
                    "event"=> "Created"         
                ])
            ->log('Dispatch Finished Goods Created');
        });

        static::updating(function ($user) {
           
            activity('Dispatch Finished Goods')
                ->performedOn($user)
                ->causedBy(auth()->user())
                /*->event('updated')*/
                ->withProperties([
                        'user_id'    =>auth()->user()->id,
                        'first_name' => auth()->user()->name,
                        'ip'=>\Request::ip(),   
                        "event"=> "updated" 
                    ])
                ->log('Dispatch Finished Goods Updated');
            });
        static::deleting(function ($user) {
        activity('Dispatch Finished Goods')
            ->performedOn($user)
            /*->event('deleted')*/
            ->causedBy(auth()->user())
            ->withProperties([
                'user_id'    =>auth()->user()->id,
                'first_name' => auth()->user()->name,
                'ip'=>Request::ip(),
                "event"=> "deleted" 
                ])
            ->log('Dispatch Finished Goods Deleted');
        });


    }
}
