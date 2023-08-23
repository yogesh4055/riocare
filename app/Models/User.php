<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Request;
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   
    /*protected static $logAttributes = ['*'];
    protected static $logOnlyDirty=true;
    protected static $recordEvents = ["created","updated","deleted"];
    protected static $logName = 'User';

    
   public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->setDescriptionForEvent(fn(string $eventName) => "This User Model has been {$eventName}")
        ->useAttributeRawValues(fn(array $attributes)=>array(
            'user_id'    =>auth()->user()->id,
            'first_name' => auth()->user()->name,
            'ip'=>\Request::ip()           
        ));
        

        
    }
    public function useAttributeRawValues(array $attributes): LogOption
    {
        return [
            'user_id'    =>auth()->user()->id,
            'first_name' => auth()->user()->name,
            'ip'=>\Request::ip()           
        ];
    }*/
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'department_id',
        'designation_id',
        'role_id'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
      
        parent::boot();

        static::creating(function ($user) {
           
        activity('user')
            ->performedOn($user)
            ->causedBy(auth()->user())
            /*->event('created')*/
            ->withProperties([
                    'user_id'    =>auth()->user()->id,
                    'first_name' => auth()->user()->name,
                    'ip'=>\Request::ip(),
                    "event"=> "Created"         
                ])
            ->log('Account Created');
        });

        static::updating(function ($user) {
           
            activity('user')
                ->performedOn($user)
                ->causedBy(auth()->user())
                /*->event('updated')*/
                ->withProperties([
                        'user_id'    =>auth()->user()->id,
                        'first_name' => auth()->user()->name,
                        'ip'=>\Request::ip(),   
                        "event"=> "updated" 
                    ])
                ->log('Account Updated');
            });
        static::deleting(function ($user) {
        activity('user')
            ->performedOn($user)
            /*->event('deleted')*/
            ->causedBy(auth()->user())
            ->withProperties([
                'user_id'    =>auth()->user()->id,
                'first_name' => auth()->user()->name,
                'ip'=>Request::ip(),
                "event"=> "deleted" 
                ])
            ->log('Account Deleted');
        });


    }

    

}
