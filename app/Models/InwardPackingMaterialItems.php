<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class InwardPackingMaterialItems extends Model
{
    use HasFactory;
    protected $table = 'goods_receipt_note_items';
    protected $fillable = ["id", "good_receipt_id", "material", "total_qty", "ar_no_date","used_qty","is_opening_stock","ar_no_datedate"];
    protected static function boot()
    {

        parent::boot();

        static::creating(function ($user) {

        activity('Inward Packing Material')
            ->performedOn($user)
            ->causedBy(auth()->user())
            /*->event('created')*/
            ->withProperties([
                    'user_id'    =>auth()->user()->id,
                    'first_name' => auth()->user()->name,
                    'ip'=>\Request::ip(),
                    "event"=> "Created"
                ])
            ->log('Inward Packing Material Created');
        });

        static::updating(function ($user) {

            activity('Inward Packing Material')
                ->performedOn($user)
                ->causedBy(auth()->user())
                /*->event('updated')*/
                ->withProperties([
                        'user_id'    =>auth()->user()->id,
                        'first_name' => auth()->user()->name,
                        'ip'=>\Request::ip(),
                        "event"=> "updated"
                    ])
                ->log('Inward Packing Material Updated');
            });
        static::deleting(function ($user) {
        activity('Inward Packing Material')
            ->performedOn($user)
            /*->event('deleted')*/
            ->causedBy(auth()->user())
            ->withProperties([
                'user_id'    =>auth()->user()->id,
                'first_name' => auth()->user()->name,
                'ip'=>Request::ip(),
                "event"=> "deleted"
                ])
            ->log('Inward Packing Material Deleted');
        });


    }

}

