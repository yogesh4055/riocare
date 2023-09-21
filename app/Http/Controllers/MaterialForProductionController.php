<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Rawmeterial;
use App\Models\Rawmaterialitems;
use App\Models\RequisitionSlip;
use App\Models\DetailsRequisition;
use App\Models\Issuematerialproduction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Requisitionissuedmaterialdetails;
use App\Models\Requisitionissuedmaterial;
use App\Models\InwardPackingMaterialItems;
use App\Models\PackingMaterialSlip;
use App\Models\DayStoreReport;
use App\Models\Requisition;
use App\Models\Stock;
use App\Models\User;
use Session;
class MaterialForProductionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:issue-material-for-production-list|issue-material-for-production-add|issue-material-for-production-edit', ['only' => ['issue_material_for_production_new','issue_material_insert']]);
        $this->middleware('permission:issue-material-for-production-add', ['only' => ['issue_material_for_production_add','issue_material_insert']]);


    }
    public function issue_material_for_production()
    {

        $data['issue_material']=Issuematerialproduction::select('issue_material_production.*','raw_materials.material_name',"inward_raw_materials_items.batch_no as rbatch","users.name")
        ->join("raw_materials", "raw_materials.id", "=", "issue_material_production.material")
        ->join("inward_raw_materials_items", "inward_raw_materials_items.id", "=", "issue_material_production.batch_no")
        ->join("users", "users.id", "=", "issue_material_production.dispensed_by")

        ->get();

        return view('issue_material_for_production',$data);
    }
    public function issue_material_for_production_new()
    {

        $data['issue_material']=RequisitionSlip::select('packing_material_requisition_slip.*',"users.name","add_batch_manufacture.bmrNo","add_batch_manufacture.Viscosity","add_batch_manufacture.BatchSize")
        ->join("users", "users.id", "=", "packing_material_requisition_slip.checkedBy")
        ->join("add_batch_manufacture", "add_batch_manufacture.id", "=", "packing_material_requisition_slip.batch_id")
      ->get();



        return view('issue_material_for_production_new',$data);
    }
    public function issue_packing_material()
    {
        $data['issue_packing_material']=RequisitionSlip::select('packing_material_requisition_slip.*',"users.name","add_batch_manufacture.bmrNo","add_batch_manufacture.Viscosity","add_batch_manufacture.BatchSize")
        ->join("users", "users.id", "=", "packing_material_requisition_slip.checkedBy")
        ->join("add_batch_manufacture", "add_batch_manufacture.id", "=", "packing_material_requisition_slip.batch_id")
        ->where("packing_material_requisition_slip.type","P")
        ->orderBy('id','desc')
        ->get();

        return view('issue_packing_material',$data);
    }
    public function view_issue_material(Request $request)
    {
        if($request->id)
        {

        $issue_material=Issuematerialproduction::select('issue_material_production.*','raw_materials.material_name',"inward_raw_materials_items.batch_no as rbatch","users.name")
        ->join("raw_materials", "raw_materials.id", "=", "issue_material_production.material")
        ->join("inward_raw_materials_items", "inward_raw_materials_items.id", "=", "issue_material_production.batch_no")
        ->join("users", "users.id", "=", "issue_material_production.dispensed_by")
        ->where("issue_material_production.id", $request->id)->first();
        $view = view('view_issue_material', ['issue_material'=> $issue_material])->render();
        return response()->json(['html'=>$view]);



    }
    else
    {
        redirect(404);
    }
    }
    public function issue_material_for_production_add()
    {
        $data['supplier_master']=Supplier::all();
        $data["rawmaterial"] = Rawmeterial::where("material_type","R")->where("material_stock",">",0)->pluck("material_name","id");
        $data["finishedproducts"] = Rawmeterial::where("material_type","F")->where("material_stock",">",0)->pluck("material_name","id");
        return view('issue_material_for_production_add',$data);
    }
    public function issue_packing_material_add()
    {
        $data['supplier_master']=Supplier::all();
        $data["rawmaterial"] = Rawmeterial::where("material_type","P")->where("material_stock",">",0)->pluck("material_name","id");
        $data["finishedproducts"] = Rawmeterial::where("material_type","F")->where("material_stock",">",0)->pluck("material_name","id");
        return view('issue_packing_material_add',$data);
    }
    public function issue_material_insert(Request $request)
    {

        $arrRules = [
       "requisition_no"=>"required",
        "material"=>"required",
        "opening_bal"=>"required",
        "batch_no"=>"required",
        "viscosity"=>"required",
        // "batch_quantity"=>"required",
        "issual_date"=>"required",
        // "issued_quantity"=>"required",
        // "excess"=> "required",
        // "finished_batch_no"=>"required",
        // "wastage"=> "required",
        // "returned_from_day_store"=>"required",
        "closing_balance_qty"=>"required",
        "dispensed_by"=>"required",
        // "remark"=>"required",
         ];
   $arrMessages = [
            "requisition_no"=>"This :attribute field is required.",
            "material"=>"This :attribute field is required..",
            "opening_bal"=>"This :attribute field is required.",
            "batch_no"=>"This :attribute field is required..",
            "viscosity"=>"This :attribute field is required.",
            "batch_quantity"=>"This :attribute field is required.",
            "issual_date"=>"This :attribute field is required.",
            "issued_quantity"=>"This :attribute field is required.",
            "finished_batch_no"=>"This :attribute field is required.",
            "excess"=>"This :attribute field is required.",
            "wastage"=>"This :attribute field is required.",
            "returned_from_day_store"=>" This :attribute field is required.",
            "closing_balance_qty"=>"This :attribute field is required.",
            "dispensed_by"=>"This :attribute field is required.",
            "remark"=>"This :attribute field is required.",
     ];
      //$validateData = $request->validate($arrRules,$arrMessages);


        $data = [
        'requisition_no'=> $request['requisition_no'],
        'material'=> $request['material'],
         'opening_bal'=> $request['opening_bal'],
        'batch_no'=> $request['batch_no'],
        'viscosity'=> $request['viscosity'],
        'issual_date'=> $request['issual_date'],
        'issued_quantity'=> $request['issued_quantity'],
        'finished_batch_no'=> $request['finished_batch_no'],
        'batch_quantity'=> $request['batch_quantity'],
        'excess'=> $request['excess'],
        'wastage'=> $request['wastage'],
        'returned_from_day_store'=> $request['returned_from_day_store'],
        'closing_balance_qty'=> $request['opening_bal'] - $request['issued_quantity'],
        // 'closing_balance_qty'=> $request['closing_balance_qty'],
        'dispensed_by'=> Auth::user()->id,
        'remark'=> $request['remark'],
        ];
        DB::beginTransaction();



    // all good

    try {
            $result= Issuematerialproduction::create($data);
            if($result)
            {
                $rawmaterial = Rawmeterial::find($request["matetial"]);
                if(isset($rawmaterial))
                {
                    //update rawmaterial main stock
                    $rdata["material_stock"] = ($rawmaterial->material_stock-$request['issued_quantity']);
                    $rawmaterial->update($rdata["material_stock"]);

                    //update rawmaterial batch quantity
                    $batch = Rawmaterialitems::find($request["batch_no"]);
                    if(isset($batch)){
                        $bdata["used_qty"] = ($batch->used_qty-$request['issued_quantity']);

                        $batch->update($batch);
                    }
                }
                DB::commit();
                return redirect("issue_material_for_production")->with('message', "Data created successfully");
            }
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
        }
    }
    public function getmatarialqtyandbatch(Request $request){
        if($request->id)
        {
            $rawmaterial=Rawmeterial::where("id",$request->id)->first();
            $batch = Rawmaterialitems::where("material",$request->id)->where("qty_received_kg",">",0)->pluck("batch_no","id");

            $data["material"] = $rawmaterial;
            $data["batch"] = $batch;
            return response()->json($data);
        }
        else{
            redirect(404);
        }
    }
    public function getmatarialqtyofbatch(Request $request)
    {
        if($request->id && $request->rawmaterial)
        {

            $batch = Rawmaterialitems::where("material",$request->rawmaterial)->where("id",$request->id)->where(DB::raw("(qty_received_kg-used_qty)"),">",0)->first();
            if(isset($batch))
                $data["qty"] = ($batch->qty_received_kg-$batch->used_qty);
            else
            $data["qty"] = 0;

            return response()->json($data);
        }
        else{
            redirect(404);
        }
    }
    public function issue_material(Request $request)
    {

        if($request->id)
        {
            $data['issue_material']=RequisitionSlip::select('packing_material_requisition_slip.*',"users.name",
            "add_batch_manufacture.bmrNo","add_batch_manufacture.Viscosity","add_batch_manufacture.BatchSize",
            "fromdep.department as fromdepartmet","todep.department as todepartmet","packing_material_requisition_slip.type")
            ->join("users", "users.id", "=", "packing_material_requisition_slip.checkedBy")
            ->join("add_batch_manufacture", "add_batch_manufacture.id", "=", "packing_material_requisition_slip.batch_id")
            ->join("department as fromdep", "fromdep.id", "=", "packing_material_requisition_slip.from")
            ->join("department as todep", "todep.id", "=", "packing_material_requisition_slip.to")
            //
            ->where("packing_material_requisition_slip.id",$request->id)
            ->first();

            $data["material_details"] = DetailsRequisition::select("detail_packing_material_requisition.*",
            "raw_materials.material_name","detail_packing_material_requisition.id as details_id")
            ->where("requisition_id",$data["issue_material"]->id)
            ->join("raw_materials","raw_materials.id","detail_packing_material_requisition.PackingMaterialName")
            ->get();

            $data["users"] = User::pluck("name","id");

            return view('issue_material_for_production_approved',$data);
        }
        else
        {
            redirect(404);
        }
    }
    public function getmatarialqtyofbatchwitharno(Request $request)
    {
        if($request->id && $request->rawmaterial)
        {
            if($request->mat_type == 'P'){
                $items = Stock::where("matarial_id",$request->rawmaterial)->where("id",$request->id)->where(DB::raw("(qty-used_qty)"),">",0)->where("material_type","P")->first();
                if($items)
                {
                    $data["qty"] = ($items->qty-$items->used_qty);
                    $data["arno"] = ($items->ar_no_date);
                    $data["arno_date"] = ($items->ar_no_date_date);
                    return response()->json($data);

                }
                else
                    return response()->json(['qty'=>'Not Available','arno'=>'']);
                } else if($request->mat_type == 'F') {
                    $items = Stock::where("matarial_id",$request->rawmaterial)->where("id",$request->id)->where(DB::raw("(qty-used_qty)"),">",0)->where("material_type","F")->first();

                if($items)
                {
                    $data["qty"] = ($items->qty-$items->used_qty);
                    $data["arno"] = ($items->ar_no_date);
                    $data["arno_date"] = ($items->ar_no_date_date);
                    return response()->json($data);

                } else
                    return response()->json(['qty'=>'Not Available','arno'=>'']);
                } else {
                //$items = Stock::where("matarial_id",$request->rawmaterial)->where("id",$request->id)->where(DB::raw("(qty-used_qty)"),">",0)->where("material_type","R")->first();
                $items = Stock::select('stock.*','quality_controll_check.date_of_approval')
                ->join("inward_raw_materials_items","inward_raw_materials_items.id","stock.process_batch_id")
                ->join("quality_controll_check","quality_controll_check.inward_material_item_id","inward_raw_materials_items.id")
                ->where("stock.matarial_id",$request->rawmaterial)->where("stock.id",$request->id)->where(DB::raw("(stock.qty-stock.used_qty)"),">",0)->where("stock.material_type","R")->first();
                
                if($items)
                {
                    $data["qty"] = ($items->qty-$items->used_qty);
                    $data["arno"] = ($items->ar_no_date);
                    $data["arno_date"] = ($items->date_of_approval);
                    return response()->json($data);

                } else
                    return response()->json(['qty'=>'Not Available','arno'=>'']);
                }


        }
        else
        {
            redirect(404);
        }
    }
    public function packing_material_requisition_slip_approved(Request $request)
    {           


        if($request->id)
        {
            
            $material_details = DetailsRequisition::select("detail_packing_material_requisition.*","raw_materials.material_name","detail_packing_material_requisition.id as details_id")->where("requisition_id",$request->id)->join("raw_materials","raw_materials.id","detail_packing_material_requisition.PackingMaterialName")->get();
            //detail_packing_material_requisition
   
            $arrRules = [
                "from"=>"required",
                 "to"=>"required",
                 "batchNo"=>"required",
                 "Date"=>"required",
                 "checkedBy"=>"required",
                 //"ApprovedBy"=>"required",
                 "batch_id"=>"required"];

                 $arrMessages = [
                    "from"=>"This :attribute field is required.",
                    "to"=>"This :attribute field is required..",
                    "batchNo"=>"This :attribute field is required.",
                    "Date"=>"This :attribute field is required..",
                    "checkedBy"=>"This :attribute field is required.",
                    //"ApprovedBy"=>"This :attribute field is required.",
                    "batch_id"=>"This :attribute field is required.",

             ];
            if(isset($material_details) && $material_details)
            {
                foreach($material_details as $material){
                    $arrRules["material_name".$material->id] = "required";
                    $arrRules["Quantity".$material->id] = "required";
                    $arrRules["rBatch".$material->id] = "required";
                    if($request->type != "P"){
                        $arrRules["arno".$material->id] = "required";
                    }
                    $arrRules["Quantity_app".$material->id] = "required";
                    $arrRules["details_id".$material->id] = "required";

                    $arrMessages["material_name".$material->id] = "This :attribute field is required.";
                    $arrMessages["Quantity".$material->id] = "This :attribute field is required.";
                    $arrMessages["rBatch".$material->id] = "This :attribute field is required.";
                    if($request->type != "P"){
                        $arrMessages["arno".$material->id] = "This :attribute field is required.";
                    }
                    $arrMessages["Quantity_app".$material->id] = "This :attribute field is required.";
                    $arrMessages["details_id".$material->id] = "This :attribute field is required.";

                }
            }
               $validateData = $request->validate($arrRules,$arrMessages);

               $data["from"] = $request->from;
               $data["to"] = $request->to;
               $data["batch_no"] = $request->batchNo;
               $data["issed_date"] = $request->Date;
               $data["requestion_id"] = $request->id;
               $data["checkedBy"] = $request->checkedBy;
               $data["ApprovedBy"] = (isset($request->ApprovedBy)) ? $request->ApprovedBy : '';
               $data["batch_id"] = $request->batch_id;
               $data["type"] = $request->type;
               
               
               
               DB::beginTransaction();
               // all good

               try { 
                    $result = Requisitionissuedmaterial::create([
                                'from' => $request->from,
                                'to' => $request->to,
                                'batch_no' =>$request->batchNo,
                                'issed_date' => $request->Date,
                                'requestion_id' => $request->id,
                                'checkedBy' => $request->checkedBy,
                                'ApprovedBy' => (isset($request->ApprovedBy)) ? $request->ApprovedBy : '',
                                'batch_id' => $request->batch_id,
                                'type' => $request->type
                            ]); //issue_material_production_requestion
                    if($result)
                    {
                        $requesetion = RequisitionSlip::find($request->id); //packing_material_requisition_slip

                        if(isset($requesetion) && $requesetion)
                        {
                            $requesetion->update(array("status"=>1));
                        }
                        
                        foreach($material_details as $key => $material)
                        {
                            $batch = "rBatch".$material->id;
                            $req_rqty = "Quantity_app".$material->id;
                            $rqty = "Quantity".$material->id;
                            $batches = $request->$batch;
                            $qty = 0;
                            $request_batch = "rBatch".$material->id;
           
                            if($request->type == 'P'){
                                $items = Stock::where("id",$request->$request_batch)->where(DB::raw("(qty-used_qty)"),">",0)->where("material_type","P")->first();
                                if($items)
                                {
                                    $data["qty"] = ($items->qty-$items->used_qty);

                                }
                                else
                                    $data["qty"] = 0;
                            }else if($request->type == 'F') {
                                $items = Stock::where("id",$request->$request_batch)->where(DB::raw("(qty-used_qty)"),">",0)->where("material_type","F")->first();
                                if($items)
                                {
                                    $data["qty"] = ($items->qty-$items->used_qty);
                                }
                                else
                                    $data["qty"] = 0;
                                
                            }else{
                                $items = Stock::where("id",$request->$request_batch)->where(DB::raw("(qty-used_qty)"),">",0)->where("material_type","R")->first();
                                if($items)
                                {
                                    $data["qty"] = ($items->qty-$items->used_qty);
                                }
                                else
                                    $data["qty"] = 0;
                                
                            }
                    
                            if($data["qty"] < 1) { //$data["qty"] < array_sum($request->$req_rqty) && $data["qty"] != array_sum($request->$req_rqty))
                                DB::rollback();
                                dd($data["qty"],array_sum($request->$req_rqty));
                                return redirect()->back()->withError("Approved quantity is greater than Approved By Quantity");
                            }
                            if(count($batches) >0)
                            {
                                    foreach($batches as $k=>$v)
                                    {

                                        $stock =  Stock::where("id",$request->$batch[$k])->first(); //stock

                                        $detailsdata["issual_material_id"] = $result->id;
                                        $matrail_id = "material_name_id".$material->id;
                                        $detailsdata["material_id"] = $request->$matrail_id;
                                        $rqty = "Quantity".$material->id;
                                        $detailsdata["requesist_qty"] = $request->$rqty;

                                        $detailsdata["batch_id"] = $v;
                                        $inword_item_id = "inword_item_id".$material->id;
                                        $detailsdata["inword_item_id"] = $request->$inword_item_id[$k];
                                        $arno = "arno".$material->id;
                                        if($request->$arno && isset($request->$arno[$k])) {
                                            $detailsdata["ar_no_date"] = $request->$arno[$k];
                                        } else {
                                            $detailsdata["ar_no_date"] = NULL;
                                        }
                                        $arnodate = "arnodate".$material->id;
                                        if($request->$arnodate && isset($request->$arnodate[$k])) {
                                            $detailsdata["ar_no_date_date"] = $request->$arnodate[$k];
                                        } else {
                                            $detailsdata["ar_no_date_date"] = NULL;
                                        }
                                        $appqty = "Quantity_app".$material->id;
                                        $detailsdata["approved_qty"] = $request->$appqty[$k];                                        
                                        $detailsdata["main_details_id"] = $request->id;

                                        // if($stock->qty >= $request->$appqty[$k])
                                        // {
                                                $res = Requisitionissuedmaterialdetails::create($detailsdata); // issue_material_production_requestion_details
                                                $type = "type".$material->id;
                                                $type = $request->$type;
                                                if($stock->qty >= $request->$appqty[$k])
                                                if($type == 'P'){

                                                    $rawmeterial = InwardPackingMaterialItems::find($stock->batch_no); //goods_receipt_note_items
                                                    $rawmeterial->update(array("used_qty"=>($rawmeterial->used_qty+$request->$appqty[$k])));
                                                }else if($type == 'F'){

                                                    $rawmeterial = Inwardfinishedgoods::find($stock->batch_no); //finished goods_items
                                                    $rawmeterial->update(array("used_qty"=>($rawmeterial->used_qty+$request->$appqty[$k])));
                                                }
                                                else
                                                    {
                                                        $ar_date = (isset($request->$arnodate[$k]))?$request->$arnodate[$k]:date('Y-m-d');
                                                        $rawmeterial = Rawmaterialitems::find($stock->batch_no); //inward_raw_materials_items
                                                        if(is_null($rawmeterial->ar_no_date_date) || $rawmeterial->ar_no_date_date == "0000-00-00 00:00:00"){
                                                            $rawmeterial->update(array("used_qty"=>($rawmeterial->used_qty+$request->$appqty[$k]),"ar_no_date_date"=>$request->$arnodate[$k]));
                                                        }
                                                        else
                                                            $rawmeterial->update(array("used_qty"=>($rawmeterial->used_qty+$request->$appqty[$k])));

                                                    }



                                                $qty = $qty+$request->$appqty[$k];

                                                $stockupd = $stock->update(array("used_qty"=>($stock->used_qty+$request->$appqty[$k])));


                                        // }
                                        // else
                                        // {

                                        //     DB::rollback();
                                        //     return redirect("issue_material_for_production")->with('danger',"Data not created successfully or quantity is greater than avialable quantity");
                                        // }

                                    }//foreach
                                        $detailsid = "details_id".$material->id;
                                        $issualdata = array();
                                        $issualdata["approved_qty"] = $qty;
                                        $detailsred = DetailsRequisition::find($request->$detailsid); // detail_packing_material_requisition
                                        $detailsred->update($issualdata);
                                        $stocka = array();
                                        $materialreq =  RequisitionSlip::where("batch_id",$request->batch_id)->first();
                                        /*$stocka["matarial_id"] =  $request->$matrail_id;
                                        $stocka["material_type"] =  $type;
                                        $stocka["department"] =  $materialreq->to;
                                        $stocka["qty"] =  $qty;
                                        $stocka["batch_no"] =  $v;
                                        $stocka["process_batch_id"] =  $request->batch_id;
                                        $stocka["ar_no_date"] =  "";
                                        $stocka["type"] =  $type;

                                        $resstock = Stock::create($stocka);*/

                                        DB::commit();
                                }




                        }
                        return redirect("issue_material_for_production")->with('massage',"Data created successfully");
                    }



            } catch (\Exception $e) { 
                    DB::rollback(); 
                    dd($e);
                    // something went wrong
                    return redirect("issue_material_for_production")->with('massage',$e->getMessage());
                }


        }
        else
        {
            redirect(404);
        }
    }
    public function issue_material_view(Request $request)
    {
        if($request->id)
        {
            $data['issue_material']=Requisitionissuedmaterial::select('issue_material_production_requestion.*',"users.name","add_batch_manufacture.bmrNo","add_batch_manufacture.Viscosity","add_batch_manufacture.BatchSize","packing_material_requisition_slip.type")
            ->join("users", "users.id", "=", "issue_material_production_requestion.ApprovedBy")
            ->join("add_batch_manufacture", "add_batch_manufacture.id", "=", "issue_material_production_requestion.batch_id")
            ->join("packing_material_requisition_slip", "packing_material_requisition_slip.id", "=", "issue_material_production_requestion.requestion_id")
            ->where("issue_material_production_requestion.requestion_id",$request->id)
            ->first();

            $data["material_details"] = Requisitionissuedmaterialdetails::select("issue_material_production_requestion_details.*","raw_materials.material_name","issue_material_production_requestion_details.id as details_id")->where("issual_material_id",$data["issue_material"]->id)->join("raw_materials","raw_materials.id","issue_material_production_requestion_details.material_id")->get();
            return view('issue_material_for_production_approved_view',$data);
        }
        else
        {
            redirect(404);
        }
    }
    public function assingindex(Request $request)
    {
        if($request->id)
        {

            $batch  = "";
            $matrialnme = "";
            if ($request->mattype == 'P') {

                $batch = Stock::select("goods_receipt_notes.goods_receipt_no as batch_no","stock.id",'goods_receipt_note_items.id as inword_item_id')
                    ->join("goods_receipt_note_items","goods_receipt_note_items.id","stock.batch_no")
                    ->join("goods_receipt_notes","goods_receipt_notes.id","goods_receipt_note_items.good_receipt_id")
                    ->where("stock.matarial_id",$request->id)
                    ->where(DB::raw("(stock.qty-stock.used_qty)"),">",0)
                    ->get(); 

                $matrialnme = "Packing Material ";
            }
            else
            {
                $batch = Stock::select("inward_raw_materials_items.batch_no","stock.id",'inward_raw_materials_items.id as inword_item_id')
                    ->join("inward_raw_materials_items","inward_raw_materials_items.id","stock.batch_no")
                    ->where("stock.matarial_id",$request->id)
                    ->where(DB::raw("(stock.qty-stock.used_qty)"),">",0)
                    ->get();
                
                $matrialnme = "Raw Material ";

            }
            // if ($request->mattype == 'P') {

            //     $batch = Stock::select(DB::raw("concat(DATE_FORMAT(goods_receipt_note_items.created_at,\"%d-%m-%Y\"),'-',(goods_receipt_note_items.total_qty)) as Qty"),"stock.id")->join("goods_receipt_note_items","goods_receipt_note_items.id","stock.batch_no")->where("stock.matarial_id",$request->id)->where(DB::raw("(stock.qty-stock.used_qty)"),">",0)->pluck("Qty","id");

            //     $matrialnme = "Packing Material ";
            // }
            // else
            // {
            //     $batch = Stock::select("inward_raw_materials_items.batch_no","stock.id")->join("inward_raw_materials_items","inward_raw_materials_items.id","stock.batch_no")->where("stock.matarial_id",$request->id)->where(DB::raw("(stock.qty-stock.used_qty)"),">",0)->pluck("batch_no","id");
                
            //     $matrialnme = "Raw Material ";

            // }
            $index = $request->index;
            $detailid = $request->detailsid;
            $html = '<div class="row add-more-wrap add-more-new input_fields_wrap_4'.$index.' m-0 mb-4 extraDiv_'.$index.'"><div class="input-group-btn"><button class="btn btn-danger remove_field" onclick="removedIV('.$index.')" type="button"><i class="icon-remove" data-feather="x" data-id="input_fields_wrap_4'.$index.'"></i>X</button></div><div class="col-12 col-md-6 col-lg-4"><div class="form-group"><label for="Quantity'.$index.'" class="active">'.$matrialnme.' Batch</label><select name="rBatch'.$detailid.'[]" id="rBatch'.$index.'" class="form-control batch_name" data-id="'.$request->mattype.'" placeholder="Choose Batch number" onchange="getarnoandqty($(this).val(),'.$request->id.','.$index.')"><option>Choose Batch number</option>';

            if(isset($batch))
            {
               foreach($batch as $bat)
               {
                    $html .='<option value="'.$bat->id.'">'. $bat->batch_no .'</option>';
               }
            }
            if ($request->mattype == 'P') {
                $html .='</select></div></div><div class="col-12 col-md-6 col-lg-4"><div class="form-group"><label for="Quantity" class="active">Approved Quantity (Kg.)</label><input type="text" class="form-control qty_cal" name="Quantity_app'.$detailid.'[]" id="Quantity_app'.$index.'" placeholder="Enter Approved Qty" value=""><input type="hidden" name="details_id['.$detailid.']" value="'.$detailid.'"></div></div></div>';
            } else {
                $html .='</select></div></div><div class="col-12 col-md-6 col-lg-4"><div class="form-group"><label for="Quantity" class="active">A.R.N. Number</label><input type="text" class="form-control" name="arno'.$detailid.'[]" id="arno'.$index.'" placeholder="A.R.N. Number" value=""></div></div><div class="col-12 col-md-6 col-lg-4"><div class="form-group"><label for="Quantity" class="active">A.R.N. Date</label><input type="date" class="form-control" name="arnodate'.$detailid.'[]" id="arnodate'.$index.'" placeholder="A.R.N. Date" value=""></div></div><div class="col-12 col-md-6 col-lg-4"><div class="form-group"><label for="Quantity" class="active">Approved Quantity (Kg.)</label><input type="text" class="form-control qty_cal" name="Quantity_app'.$detailid.'[]" id="Quantity_app'.$index.'" placeholder="Enter Approved Qty" value=""><input type="hidden" name="details_id['.$detailid.']" value="'.$detailid.'"></div></div></div>';
            }

            return response()->json(['data'=>$html]);

        }

    }
}