<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;
class BatchManufacturingPacking extends Model
{
    use HasFactory;
    protected $table = 'batch_manufacturing_records_packing';
    protected $fillable = [
        'id',
        'proName',
        'bmrNo',
        'batchNo',
        'refMfrNo',
        'ManufacturerDate',
        'Observation',
        'Temperature',
        'Humidity',
        'TemperatureP',
        '50kgDrums',
        '20kgDrums',
        '30kgDrums',
        '5kgDrums',
        'NoOfBags5kg',
        'NoOfBags25kg',
        'NoOfBags50kg',
        'startTime',
        'EndstartTime',
        'areaCleanliness',
        'CareaCleanliness',
        'rmInput',
        'fgOutput',
        'filledDrums',
        'excessFilledDrums',
        'qcsampling',
        'StabilitySample',
        'WorkingSlandered',
        'ValidationSample',
        'CustomerRequirement',
        'CustomerSample',
        'ActualYield',
        'checkedBy',
        'ApprovedBy',
        'Remark',
        'batch_id',
        'created_at',
        'updated_at',
        'total_sampling'
    ];
    protected static function boot()
    {

        parent::boot();

        static::creating(function ($user) {

        activity('Batch Manufacturing Records Packing')
            ->performedOn($user)
            ->causedBy(auth()->user())
            /*->event('created')*/
            ->withProperties([
                    'user_id'    =>auth()->user()->id,
                    'first_name' => auth()->user()->name,
                    'ip'=>\Request::ip(),
                    "event"=> "Created"
                ])
            ->log('Batch Manufacturing Records Packing Created');
        });

        static::updating(function ($user) {

            activity('Batch Manufacturing Records Packing')
                ->performedOn($user)
                ->causedBy(auth()->user())
                /*->event('updated')*/
                ->withProperties([
                        'user_id'    =>auth()->user()->id,
                        'first_name' => auth()->user()->name,
                        'ip'=>\Request::ip(),
                        "event"=> "updated"
                    ])
                ->log('Batch Manufacturing Records Packing Updated');
            });
        static::deleting(function ($user) {
        activity('Batch Manufacturing Records Packing')
            ->performedOn($user)
            /*->event('deleted')*/
            ->causedBy(auth()->user())
            ->withProperties([
                'user_id'    =>auth()->user()->id,
                'first_name' => auth()->user()->name,
                'ip'=>Request::ip(),
                "event"=> "deleted"
                ])
            ->log('Batch Manufacturing Records Packing Deleted');
        });


    }
}
