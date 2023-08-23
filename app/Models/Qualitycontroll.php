<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class Qualitycontroll extends Model
{
    use HasFactory;
    protected $table = 'quality_controll_check';
    protected $fillable = [
        'id',
        'quantity_approved',
        'inward_material_id',
        'inward_material_item_id',
        'raw_material_id',
        'total_qty',
        'ar_no',
        "ar_no_date_date",
        'quantity_rejected',
        'quantity_status',
        'date_of_approval',
        'remark',
        'created_at',
        'updated_at',
        'checked_by',
        'material_type'
    ];
    protected static function boot()
    {

        parent::boot();

        static::creating(function ($user) {

        activity('Quality Control')
            ->performedOn($user)
            ->causedBy(auth()->user())
            /*->event('created')*/
            ->withProperties([
                    'user_id'    =>auth()->user()->id,
                    'first_name' => auth()->user()->name,
                    'ip'=>\Request::ip(),
                    "event"=> "Created"
                ])
            ->log('Quality Control Created');
        });

        static::updating(function ($user) {

            activity('Quality Control')
                ->performedOn($user)
                ->causedBy(auth()->user())
                /*->event('updated')*/
                ->withProperties([
                        'user_id'    =>auth()->user()->id,
                        'first_name' => auth()->user()->name,
                        'ip'=>\Request::ip(),
                        "event"=> "updated"
                    ])
                ->log('Quality Control Updated');
            });
        static::deleting(function ($user) {
        activity('Quality Control')
            ->performedOn($user)
            /*->event('deleted')*/
            ->causedBy(auth()->user())
            ->withProperties([
                'user_id'    =>auth()->user()->id,
                'first_name' => auth()->user()->name,
                'ip'=>Request::ip(),
                "event"=> "deleted"
                ])
            ->log('Quality Control Deleted');
        });


    }
}
