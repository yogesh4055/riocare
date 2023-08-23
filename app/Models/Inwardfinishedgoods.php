<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
USE Request;

class Inwardfinishedgoods extends Model
{
    use HasFactory;
    protected $table = 'inward_finished_goods';
    protected $fillable = [
        "id",
        "inward_no" ,
        "inward_date" ,
        "product_name" ,
        "batch_no" ,
        "grade" ,
        "viscosity" ,
        "mfg_date" ,
        "expiry_ratest_date" ,
        "total_no_of_200kg_drums" ,
        "total_no_of_50kg_drums" ,
        "total_no_of_30kg_drums" ,
        "total_no_of_5kg_drums" ,
        "total_no_of_fiber_board_drums" ,
        "total_quantity" ,
        "ar_no" ,
        "ar_no_date",
        "approval_data" ,
        "received_by" ,
        "remark" ,
        "created_at",
        "updated_at",
        'total_no_of_200kg_drums_bal',
        'total_no_of_50kg_drums_bal',
        'total_no_of_30kg_drums_bal',
        'total_no_of_5kg_drums_bal',
        'total_no_of_fiber_board_drums_bal',
        'total_quantity_bal',
        'is_opening_stock'
    ];
    protected static function boot()
    {

        parent::boot();

        static::creating(function ($user) {

        activity('Inward Finished Goods - New Stock')
            ->performedOn($user)
            ->causedBy(auth()->user())
            /*->event('created')*/
            ->withProperties([
                    'user_id'    =>auth()->user()->id,
                    'first_name' => auth()->user()->name,
                    'ip'=>\Request::ip(),
                    "event"=> "Created"
                ])
            ->log('Inward Finished Goods - New Stock Created');
        });

        static::updating(function ($user) {

            activity('Inward Finished Goods - New Stock')
                ->performedOn($user)
                ->causedBy(auth()->user())
                /*->event('updated')*/
                ->withProperties([
                        'user_id'    =>auth()->user()->id,
                        'first_name' => auth()->user()->name,
                        'ip'=>\Request::ip(),
                        "event"=> "updated"
                    ])
                ->log('Inward Finished Goods - New Stock Updated');
            });
        static::deleting(function ($user) {
        activity('Inward Finished Goods - New Stock')
            ->performedOn($user)
            /*->event('deleted')*/
            ->causedBy(auth()->user())
            ->withProperties([
                'user_id'    =>auth()->user()->id,
                'first_name' => auth()->user()->name,
                'ip'=>Request::ip(),
                "event"=> "deleted"
                ])
            ->log('Inward Finished Goods - New Stock Deleted');
        });


    }
}
