<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;
class BatchManufacturingRecordsLine extends Model
{
    use HasFactory;
    protected $table = 'batch_manufacturing_records_line_clearance_record';
    protected $fillable = [
        "id",
        "order_id",
        "proName",
        "batchNo",
        "Date",
        "Remark",
        "created_at ",
        "updated_at",
    ];
    protected static function boot()
    {

        parent::boot();

        static::creating(function ($user) {

        activity('Batch Manufacturing Records Line Clearance Record')
            ->performedOn($user)
            ->causedBy(auth()->user())
            /*->event('created')*/
            ->withProperties([
                    'user_id'    =>auth()->user()->id,
                    'first_name' => auth()->user()->name,
                    'ip'=>\Request::ip(),
                    "event"=> "Created"
                ])
            ->log('Batch Manufacturing Records Line Clearance Record Created');
        });

        static::updating(function ($user) {

            activity('Batch Manufacturing Records Line Clearance Record')
                ->performedOn($user)
                ->causedBy(auth()->user())
                /*->event('updated')*/
                ->withProperties([
                        'user_id'    =>auth()->user()->id,
                        'first_name' => auth()->user()->name,
                        'ip'=>\Request::ip(),
                        "event"=> "updated"
                    ])
                ->log('Batch Manufacturing Records Line Clearance Record Updated');
            });
        static::deleting(function ($user) {
        activity('Batch Manufacturing Records Line Clearance Record')
            ->performedOn($user)
            /*->event('deleted')*/
            ->causedBy(auth()->user())
            ->withProperties([
                'user_id'    =>auth()->user()->id,
                'first_name' => auth()->user()->name,
                'ip'=>Request::ip(),
                "event"=> "deleted"
                ])
            ->log('Batch Manufacturing Records Line Clearance Record Deleted');
        });


    }
}
