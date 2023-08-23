<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
class ActivitylogController extends Controller
{
    //
    function __construct()
    {
         $this->middleware('permission:activitylog-list', ['only' => ['index']]);
        
    }

    public function index()
    {
        $activity = Activity::all();
        return view("activitylog.index",compact("activity"));
    }


}
