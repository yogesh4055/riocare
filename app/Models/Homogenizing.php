<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Request;

class Homogenizing extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'homogenizing';
    protected $fillable = [
        'id',
        'order_id',
        'proName',
        'batch_id',
        'bmrNo',
        'batchNo',
        'refMfrNo',
        'homoTank',
        'Observedvalue',
        'created_at',
        'updated_at',
        "proecess_check"
    ];
    protected static function boot()
    {

        parent::boot();

        static::creating(function ($user) {

        activity('Homo Genizing')
            ->performedOn($user)
            ->causedBy(auth()->user())
            /*->event('created')*/
            ->withProperties([
                    'user_id'    =>auth()->user()->id,
                    'first_name' => auth()->user()->name,
                    'ip'=>\Request::ip(),
                    "event"=> "Created"
                ])
            ->log('Homo Genizing Created');
        });

        static::updating(function ($user) {

            activity('Homo Genizing')
                ->performedOn($user)
                ->causedBy(auth()->user())
                /*->event('updated')*/
                ->withProperties([
                        'user_id'    =>auth()->user()->id,
                        'first_name' => auth()->user()->name,
                        'ip'=>\Request::ip(),
                        "event"=> "updated"
                    ])
                ->log('Homo Genizing Updated');
            });
        static::deleting(function ($user) {
        activity('Homo Genizing')
            ->performedOn($user)
            /*->event('deleted')*/
            ->causedBy(auth()->user())
            ->withProperties([
                'user_id'    =>auth()->user()->id,
                'first_name' => auth()->user()->name,
                'ip'=>Request::ip(),
                "event"=> "deleted"
                ])
            ->log('Homo Genizing Deleted');
        });


    }
}
