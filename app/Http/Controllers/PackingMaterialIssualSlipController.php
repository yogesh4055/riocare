<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PackingMaterialSlip;
use App\Models\MaterialDetails;

class PackingMaterialIssualSlipController extends Controller
{
    public function add_packing_material_issual_slip()
    {
     return view ('add_packing_material_issual_slip');
    }
    public function packing_material_issuel_insert(Request $request)
    {
     $arrRules = [
        "from"=>"required",
        "to"=>"required",
        "batchNo"=>"required",
        "Date"=>"required",
        "PackingMaterialName"=>"required",
        "Capacity"=>"required",
        "Quantity"=>"required",
        "arNo"=>"required",
        "ARDate"=>"required",
        "doneBy"=>"required",
        "checkedBy"=>"required",
    ];
    $arrMessages = [

        "from"=>"This :attribute field is required.",
        "to"=>"This :attribute field is required.",
        "batchNo"=>"This :attribute field is required.",
        "Date"=>"This :attribute field is required.",
        "PackingMaterialName"=>"This :attribute field is required.",
        "Capacity"=>"This :attribute field is required.",
        "Quantity"=>"This :attribute field is required.",
        "arNo"=>"This :attribute field is required.",
        "ARDate"=>"This :attribute field is required.",
        "doneBy"=>"This :attribute field is required.",
        "checkedBy"=>"This :attribute field is required.",
    ];
    // $validated = $request->validate($arrRules, $arrMessages);
    $arr['from'] = $request->from;
    $order_number = date('dyHs');
    $arr['order_id'] = $order_number;
    $arr['to'] = $request->to;
    $arr['batchNo'] = $request->batchNo;
    $arr['Date'] = $request->Date;
    $arr['doneBy'] = $request->doneBy;
    $arr['checkedBy'] = $request->checkedBy;
    $packingmaterial_id = PackingMaterialSlip::Create($arr);
    if ($packingmaterial_id->id) {
        foreach ($request->PackingMaterialName as $key => $value) {
            $a_data['PackingMaterialName'] = $value;
            $a_data['Capacity'] = $request->Capacity[$key];
            $a_data['Quantity'] = $request->Quantity[$key];
            $a_data['arNo'] = $request->arNo[$key];
            $a_data['arNo'] = $request->arNo[$key];
            $a_data['ARDate'] = $request->ARDate[$key];
            $a_data['packingmaterial_id'] = $packingmaterial_id->id;
            MaterialDetails::Create($a_data);
        }


        return redirect("add-packing-material-issual-slip")->with('success', "Data List Of Equipment Successfully");
    } else {
        return redirect("add-packing-material-issual-slip")->with('error', " Something went wrong");
    }
}
}
