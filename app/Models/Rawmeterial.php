<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetailsRequisition;
use Request;

class Rawmeterial extends Model
{
    use HasFactory;
    protected $table = 'raw_materials';
    protected $fillable = [
        "id",
        "material_name",
        "material_mesurment",
        "material_stock",
        "material_preorder_stock",
        "expiry_date",
        "rio_expiry_date",
        "man_date",
        "material_type",
        "capacity",
        "material_code",
        "is_opening",
        "grade",
        "qc_applicable",
        'is_lot',
        'is_homoginize',
        "processgroupid",
        'reactorstatusgroup',
        'equipmentstatusgroup'

    ];
    protected static function boot()
    {

        parent::boot();

        static::creating(function ($user) {

        activity('Inward Raw Materials')
            ->performedOn($user)
            ->causedBy(auth()->user())
            /*->event('created')*/
            ->withProperties([
                    'user_id'    =>auth()->user()->id,
                    'first_name' => auth()->user()->name,
                    'ip'=>\Request::ip(),
                    "event"=> "Created"
                ])
            ->log('Raw Material Created');
        });

        static::updating(function ($user) {

            activity('Raw Material')
                ->performedOn($user)
                ->causedBy(auth()->user())
                /*->event('updated')*/
                ->withProperties([
                        'user_id'    =>auth()->user()->id,
                        'first_name' => auth()->user()->name,
                        'ip'=>\Request::ip(),
                        "event"=> "updated"
                    ])
                ->log('Raw Material Updated');
            });
        static::deleting(function ($user) {
        activity('Raw Material')
            ->performedOn($user)
            /*->event('deleted')*/
            ->causedBy(auth()->user())
            ->withProperties([
                'user_id'    =>auth()->user()->id,
                'first_name' => auth()->user()->name,
                'ip'=>Request::ip(),
                "event"=> "deleted"
                ])
            ->log('Raw Material Deleted');
        });


    }
}
