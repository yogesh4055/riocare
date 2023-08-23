<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class BatchManufacture extends Model
{
    use HasFactory;
    protected $table = 'add_batch_manufacture';
    protected $fillable = [
        'id',
        'proName',
        'bmrNo',
        'batchNo',
        'refMfrNo',
        'grade',
        'BatchSize',
        'Viscosity',
        'ProductionCommencedon',
        'ProductionCompletedon',
        'ManufacturingDate',
        'RetestDate',
        'doneBy',
        'checkedBy',
        'inlineRadioOptions',
        'approval',
        'approvalDate',
        'checkedByI',
        'Remark',
        'is_active',
        'is_delete',
        'created_at',
        'updated_at',
        "ar_no",
        "ar_no_date",
        'stage_1',
        'stage_2',
        'stage_3',
        'stage_4',
        'stage_5',
        'stage_6',
        'stage_8',
        'checked_time',
        'is_checked',
        'rejected_qty'
    ];
    protected static function boot()
    {

        parent::boot();

        static::creating(function ($user) {

        activity('Manufacture Process')
            ->performedOn($user)
            ->causedBy(auth()->user())
            /*->event('created')*/
            ->withProperties([
                    'user_id'    =>auth()->user()->id,
                    'first_name' => auth()->user()->name,
                    'ip'=>\Request::ip(),
                    "event"=> "Created"
                ])
            ->log('Manufacture Process Created');
        });

        static::updating(function ($user) {

            activity('Manufacture Process')
                ->performedOn($user)
                ->causedBy(auth()->user())
                /*->event('updated')*/
                ->withProperties([
                        'user_id'    =>auth()->user()->id,
                        'first_name' => auth()->user()->name,
                        'ip'=>\Request::ip(),
                        "event"=> "updated"
                    ])
                ->log('Manufacture Process Updated');
            });
        static::deleting(function ($user) {
        activity('Manufacture Process')
            ->performedOn($user)
            /*->event('deleted')*/
            ->causedBy(auth()->user())
            ->withProperties([
                'user_id'    =>auth()->user()->id,
                'first_name' => auth()->user()->name,
                'ip'=>Request::ip(),
                "event"=> "deleted"
                ])
            ->log('Manufacture Process Deleted');
        });


    }
}
