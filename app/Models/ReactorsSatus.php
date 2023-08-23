<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetailsRequisition;
use Request;

class ReactorsSatus extends Model
{
    use HasFactory;
    protected $table = 'batch_manufacturing_reactor_status';
    protected $fillable = [
        "id", "status_id", "batch_name", "date", "created_by", "batch_id", "created_at", "updated_at","clearance_id"

    ];
    protected static function boot()
    {

        parent::boot();

        static::creating(function ($user) {

        activity('Batch Reactors Status')
            ->performedOn($user)
            ->causedBy(auth()->user())
            /*->event('created')*/
            ->withProperties([
                    'user_id'    =>auth()->user()->id,
                    'first_name' => auth()->user()->name,
                    'ip'=>\Request::ip(),
                    "event"=> "Created"
                ])
            ->log('Batch Reactors Status Created');
        });

        static::updating(function ($user) {

            activity('Batch Reactors Status')
                ->performedOn($user)
                ->causedBy(auth()->user())
                /*->event('updated')*/
                ->withProperties([
                        'user_id'    =>auth()->user()->id,
                        'first_name' => auth()->user()->name,
                        'ip'=>\Request::ip(),
                        "event"=> "updated"
                    ])
                ->log('Batch Reactors Status Updated');
            });
        static::deleting(function ($user) {
        activity('Batch Reactors Status')
            ->performedOn($user)
            /*->event('deleted')*/
            ->causedBy(auth()->user())
            ->withProperties([
                'user_id'    =>auth()->user()->id,
                'first_name' => auth()->user()->name,
                'ip'=>Request::ip(),
                "event"=> "deleted"
                ])
            ->log('Batch Reactors Status Deleted');
        });


    }
}
