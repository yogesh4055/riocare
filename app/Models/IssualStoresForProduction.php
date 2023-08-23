<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class IssualStoresForProduction extends Model
{
    use HasFactory;
    protected $table = 'issual_by_stores_for_production';
    protected $fillable = [
        "id",
        "requisition_no",
        "opening_balance",
        "issual_date",
        "product_name",
        "batch_no",
        "quantity",
        "for_fg_batch_no",
        "returned_from_day_store",
        "dispensed_by",
        "remark",
        "created_at ",
        "updated_at",
    ];
    protected static function boot()
    {
      
        parent::boot();

        static::creating(function ($user) {
           
        activity('Issual By Stores For Production')
            ->performedOn($user)
            ->causedBy(auth()->user())
            /*->event('created')*/
            ->withProperties([
                    'user_id'    =>auth()->user()->id,
                    'first_name' => auth()->user()->name,
                    'ip'=>\Request::ip(),
                    "event"=> "Created"         
                ])
            ->log('Issual By Stores For Production Created');
        });

        static::updating(function ($user) {
           
            activity('Issual By Stores For Production')
                ->performedOn($user)
                ->causedBy(auth()->user())
                /*->event('updated')*/
                ->withProperties([
                        'user_id'    =>auth()->user()->id,
                        'first_name' => auth()->user()->name,
                        'ip'=>\Request::ip(),   
                        "event"=> "updated" 
                    ])
                ->log('Issual By Stores For Production Updated');
            });
        static::deleting(function ($user) {
        activity('Issual By Stores For Production')
            ->performedOn($user)
            /*->event('deleted')*/
            ->causedBy(auth()->user())
            ->withProperties([
                'user_id'    =>auth()->user()->id,
                'first_name' => auth()->user()->name,
                'ip'=>Request::ip(),
                "event"=> "deleted" 
                ])
            ->log('Issual By Stores For Production Deleted');
        });


    }
}
