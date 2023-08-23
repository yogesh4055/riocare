<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InwardPackingMaterial;
use App\Models\Modedispatch;
use App\Models\Department;
use App\Models\Grade;
use DB;
class DishpatchfinishgoodsController extends Controller
{
    //
    public function dispatch_finished_goods()
    {
        return view("dispatch_finished_goods");
    }
    public function add()
    {
        $modeofdispatch = Modedispatch::where("publish",1)->pluck("mode","id");
        $grade = Grade::where("publish",1)->pluck("grade","id");
        $department = Department::pluck("department","id");
        $inwordno = InwardPackingMaterial::select(DB::raw("max(id) as lastnumber"))->first();
        $nextnum = 0;
        if($inwordno->lastnumber >0)
        {
            $nextnum = $inwordno->lastnumber +1;
        }
        else
            $nextnum = 1;
        return view("add_dispatch_finished_goods")->with(["mode"=>$modeofdispatch,"grade"=>$grade,"nextnum"=>$nextnum,"department"=>$department]);
    }
    public function store(Request $request)
    {
        dd($request->input());
        $arrRules = ["dispath_no"=>"required",
                     "dispatch_form"=>"required",
                     "dispatch_to"=>"required",
                     "good_dispatch_date"=>"required",
                     "mode_of_dispatch"=>"required",
                     "party_name"=>"required",
                     "product"=>"required",
                     "invoice_no"=>"required",
                     "batch_no"=>"required",
                     "grade"=>"required",
                     "mfg_date"=>"required",
                     "total_no_qty"=>"required",
                     "seal_no"=>"required",
                     "dispatch_date"=>"required",
                     "dispatch_by"=>"required"
                    ];


        $arrMessages = [
            "dispath_no"=>"This :attribute field is required.",
            "dispatch_form"=>"This :attribute field is required.",
            "dispatch_to"=>"This :attribute field is required.",
            "good_dispatch_date"=>"This :attribute field is required.",
            "mode_of_dispatch"=>"This :attribute field is required.",
            "party_name"=>"This :attribute field is required.",
            "product"=>"This :attribute field is required.",
            "invoice_no"=>"This :attribute field is required.",
            "batch_no"=>"This :attribute field is required.",
            "grade"=>"This :attribute field is required.",
            "mfg_date"=>"This :attribute field is required.",
            "total_no_qty"=>"This :attribute field is required.",
            "seal_no"=>"This :attribute field is required.",
            "dispatch_date"=>"This :attribute field is required.",
            "dispatch_by"=>"This :attribute field is required."

        ];

        $attributes = array();
        foreach ($request->input() as $key => $val)
            $attributes[$key] = ucwords(str_replace("_", " ", $key));

        $validateData = $request->validate($arrRules, $arrMessages,$attributes);

        $data = array();
        $data["inward_no"]=$request->dispath_no;
        $data[""]=$request->dispatch_form;
        $data[""]=$request->dispatch_to;
        $data[""]=$request->good_dispatch_date;
        $data[""]=$request->mode_of_dispatch;
        $data[""]=$request->party_name;
        $data[""]=$request->product;
        $data[""]=$request->invoice_no;
        $data[""]=$request->batch_no;
        $data[""]=$request->grade;
        $data[""]=$request->mfg_date;
        $data[""]=$request->total_no_qty;
        $data[""]=$request->seal_no;
        $data[""]=$request->dispatch_date;
        $data[""]=$request->dispatch_by;
    }
}
