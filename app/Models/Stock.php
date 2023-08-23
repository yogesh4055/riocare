<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class Stock extends Model
{
    use HasFactory;
    protected $table = 'stock';
    protected $fillable = [
        "id", "matarial_id", "material_type", "department", "qty", "batch_no", "process_batch_id", "ar_no_date", "created_at", "updated_at", "type","used_qty","ar_no_date_date"
    ];
    protected static function boot()
    {

        parent::boot();

        static::creating(function ($user) {

        activity('Stock')
            ->performedOn($user)
            ->causedBy(auth()->user())
            /*->event('created')*/
            ->withProperties([
                    'user_id'    =>auth()->user()->id,
                    'first_name' => auth()->user()->name,
                    'ip'=>\Request::ip(),
                    "event"=> "Created"
                ])
            ->log('Stock Created');
        });

        static::updating(function ($user) {

            activity('Stock')
                ->performedOn($user)
                ->causedBy(auth()->user())
                /*->event('updated')*/
                ->withProperties([
                        'user_id'    =>auth()->user()->id,
                        'first_name' => auth()->user()->name,
                        'ip'=>\Request::ip(),
                        "event"=> "updated"
                    ])
                ->log('Stock Updated');
            });
        static::deleting(function ($user) {
        activity('Stock')
            ->performedOn($user)
            /*->event('deleted')*/
            ->causedBy(auth()->user())
            ->withProperties([
                'user_id'    =>auth()->user()->id,
                'first_name' => auth()->user()->name,
                'ip'=>Request::ip(),
                "event"=> "deleted"
                ])
            ->log('Stock Deleted');
        });


    }

}
