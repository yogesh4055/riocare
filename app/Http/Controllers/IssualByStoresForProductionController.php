<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rawmeterial;
use App\Models\User;
use App\Models\IssualStoresForProduction;
use Auth;
class IssualByStoresForProductionController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:issual-by-stores-for-production-list|issual-by-stores-for-production-add', ['only' => ['issual_by_stores_for_production','issue_by_stores_insert']]);
         $this->middleware('permission:issual-by-stores-for-production-list', ['only' => ['issual_by_stores_for_production_add','issue_by_stores_insert']]);
     }
    public function issual_by_stores_for_production()
    {

        $data['issue_stores']=IssualStoresForProduction::select('issual_by_stores_for_production.*',
        'raw_materials.material_name',"inward_raw_materials_items.batch_no","users.name")
        ->leftJoin('raw_materials','raw_materials.id','issual_by_stores_for_production.product_name')
        ->leftJoin('inward_raw_materials_items','inward_raw_materials_items.id','issual_by_stores_for_production.batch_no')
        ->leftJoin('users','users.id','issual_by_stores_for_production.dispensed_by')
        ->get();

        return view('issual_by_stores_for_production',$data);
    }
    public function issual_by_stores_for_production_add()
    {

        $rawmaterial =Rawmeterial::where('material_type','R')->where("material_stock",">",0)->pluck("material_name","id");
        $users = User::pluck("name","id");
        return view('issual_by_stores_for_production_add')->with(["rawmaterial"=>$rawmaterial,"users"=>$users]);
    }
    public function issue_by_stores_insert(Request $request)
    {
        $arrRules = [
               "requisition_no"=>"required",
                "opening_balance"=>"required",
                "issual_date"=>"required",
                "product_name"=>"required",
                "batch_no"=>"required",
                "quantity"=>"required",
                "for_fg_batch_no"=>"required",
                "returned_from_day_store"=>"required",
                "dispensed_by"=>"required",
                // "remark"=>"required",

           ];
           $arrMessages = [
            "requisition_no"=>"This :attribute field is required.",
            "opening_balance"=>"This :attribute field is required.",
            "batch_no"=>"This :attribute field is required.",
            "issual_date"=>"This :attribute field is required.",
            "product_name"=>"This :attribute field is required.",
            "quantity"=>"This :attribute field is required.",
            "for_fg_batch_no"=>"This.Please  This :attribute field is required.",
            "returned_from_day_store"=>"This.Please  This :attribute field is required.",
            "dispensed_by"=>"This.This :attribute field is required.",
            "remark"=>"This :attribute field is required.",
            ];
           $validateData = $request->validate($arrRules, $arrMessages);


         $data = [
            "requisition_no"=>$request['requisition_no'],
            "opening_balance"=>$request['opening_balance'],
            "issual_date"=>$request['issual_date'],
            "product_name"=>$request['product_name'],
            "batch_no"=>$request['batch_no'],
            "quantity"=>$request['quantity'],
            "for_fg_batch_no"=>$request['for_fg_batch_no'],
            "returned_from_day_store"=>$request['returned_from_day_store'],
            "dispensed_by"=> $request['dispensed_by'],
            "remark"=>$request['remark'],
         ];

        $result = IssualStoresForProduction::create($data);

        if ($result) {
            return redirect("issual_by_stores_for_production")->with('success', "Data created successfully");
        }
    }
    public function view_store(Request $request)
    {
        //
        if($request->id)
        {
            $IssualStores = IssualStoresForProduction::select('issual_by_stores_for_production.*','raw_materials.material_name')
            ->join('raw_materials','raw_materials.id','issual_by_stores_for_production.product_name')
            ->where("issual_by_stores_for_production.id",$request->id)->first();
             $view = view('view_issual_stores', ['IssualStores'=> $IssualStores])->render();
             return response()->json(['html'=>$view]);

        }
        else
        {
            redirect(404);
        }
    }


}
