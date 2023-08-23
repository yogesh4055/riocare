<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InwardMaterial;
use App\Models\Supplier;
use App\Models\Manufacturer;
use App\Models\Rawmeterial;
use App\Models\Rawmaterialitems;
use App\Models\InwardPackingMaterialItems;
use App\Models\Department;
use App\Models\Issuematerialproduction;
use App\Models\IssualStoresForProduction;
use App\Models\Inwardfinishedgoods;
use App\Models\FinishedGoodsDispatch;
use App\Models\DetailsRequisition;
use App\Models\RequisitionSlip;
use App\Models\Requisitionissuedmaterialdetails;
use App\Models\Requisitionissuedmaterial;
use App\Models\Qualitycontroll;
use App\Models\Stock;
use App\Models\ReturnWarehouseLog;
use DB;
use Auth;


class ReportsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:annexure-i-list', ['only' => ['annexure_i']]);
        $this->middleware('permission:annexure-ii-list', ['only' => ['annexure_ii']]);
        $this->middleware('permission:annexure-iii-list', ['only' => ['annexure_iii']]);
        $this->middleware('permission:annexure-iv-list', ['only' => ['annexure_iv']]);
        $this->middleware('permission:packing-annexure-list', ['only' => ['packing_annexure']]);
        $this->middleware('permission:annexure-vi-list', ['only' => ['annexure_vi']]);
        $this->middleware('permission:annexure-vii-list', ['only' => ['annexure_vii']]);
    }
    public function annexure_i(Request $request)
    {

        $datefrom =  $request->input('datefrom');
        $todate =  $request->input('todate');
        $data['inward_material']=Rawmaterialitems::select(
            "inward_raw_materials.*"
            ,"inward_raw_materials_items.*",
            "suppliers.name",
            "manufacturers.manufacturer as man_name",
            "raw_materials.material_name",
            "raw_materials.material_stock",
            "mesurments.mesurment",
            "inward_raw_materials_items.mfg_date",
            "inward_raw_materials_items.id as itemid")
            ->join("inward_raw_materials","inward_raw_materials.id","inward_raw_materials_items.inward_raw_material_id")
            ->join("suppliers","suppliers.id","inward_raw_materials.supplier")
            ->join("manufacturers","manufacturers.id","inward_raw_materials.manufacturer")
            ->join("raw_materials","raw_materials.id","inward_raw_materials_items.material")
            ->join("mesurments","mesurments.id","raw_materials.material_mesurment");

            if(!empty($datefrom) && !empty($todate)) {
                 $data['inward_material'] = $data['inward_material']
                                            ->whereBetween('inward_raw_materials.date_of_receipt', [strtotime($datefrom), strtotime($todate)]);
                 }
            $data['inward_material'] = $data['inward_material']->get();
          return view('reports.annexure_i',$data);
    }
    public function annexure_ii(Request $request)
    {   
        $datefrom =  $request->input('datefrom');
        $todate =  $request->input('todate');

        $data['issue_stores']=IssualStoresForProduction::select('issual_by_stores_for_production.*','raw_materials.material_name')
        ->join('raw_materials','raw_materials.id','issual_by_stores_for_production.id');
        if(!empty($datefrom) && !empty($todate)) {
            $data['issue_stores'] = $data['issue_stores']->whereBetween('issual_by_stores_for_production.issual_date', [strtotime($datefrom), strtotime($todate)]);
            }
         $data['issue_stores'] = $data['issue_stores']->get();

        return view('reports.annexure_ii',$data);
    }
    public function annexure_iii(Request $request)
    {   
        $datefrom =  $request->input('datefrom');
        $todate =  $request->input('todate');

        $data['issue_material']=Issuematerialproduction::select('issue_material_production.*','raw_materials.material_name',"inward_raw_materials_items.batch_no as rbatch","users.name")
        ->join("raw_materials", "raw_materials.id", "=", "issue_material_production.material")
        ->join("inward_raw_materials_items", "inward_raw_materials_items.id", "=", "issue_material_production.batch_no")
        ->join("users", "users.id", "=", "issue_material_production.dispensed_by");
        if(!empty($datefrom) && !empty($todate)) {
            $data['issue_material'] = $data['issue_material']->whereBetween('issue_material_production.issual_date', [strtotime($datefrom), strtotime($todate)]);
            }  
            $data['issue_material'] = $data['issue_material']->get();

        return view('reports.annexure_iii',$data);

    }
    public function annexure_iv(Request $request)
    {
        $datefrom =  $request->input('datefrom');
        $todate =  $request->input('todate');
        $data['inward_goods']=Inwardfinishedgoods::select("inward_finished_goods.*","raw_materials.material_name","grades.grade","users.name")
        ->join("raw_materials","raw_materials.id","inward_finished_goods.product_name")
        ->join("grades","grades.id","inward_finished_goods.grade")
        ->join("users","users.id","inward_finished_goods.received_by");
        if(!empty($datefrom) && !empty($todate)) {
            $todate = date("Y-m-d", strtotime($todate));
            $datefrom = date("Y-m-d", strtotime($datefrom));

            $data['inward_goods'] = $data['inward_goods']->whereBetween('inward_finished_goods.inward_date', [$datefrom, $todate]);
            } 
            $data['inward_goods'] = $data['inward_goods']->get();

        return view('reports.annexure_iv',$data);
    }
    public function packing_annexure()
    {
        $listquery = InwardPackingMaterialItems::select("goods_receipt_notes.*"
        ,"goods_receipt_note_items.*",
        "suppliers.name",
        "manufacturers.manufacturer",
        "users.name as uname",
        "department.department as goods_going_from_name",
        "detpto.department as goods_going_to_name",
        "raw_materials.material_name",
        "goods_receipt_note_items.id as itemid",
        "goods_receipt_notes.id as id")
                    ->join("goods_receipt_notes","goods_receipt_notes.id","goods_receipt_note_items.good_receipt_id")
                     ->join("suppliers","suppliers.id","goods_receipt_notes.supplier")
                     ->join("manufacturers","manufacturers.id","goods_receipt_notes.manufacurer")
                     ->join("raw_materials","raw_materials.id","goods_receipt_note_items.material")
                     ->leftJoin("users","users.id","goods_receipt_notes.created_by")
                     ->join("department", "department.id", "=", "goods_receipt_notes.goods_going_from")
                     ->join("department as detpto", "detpto.id", "=", "goods_receipt_notes.goods_going_to")
                     ->get();

        return view('reports.packing_annexure')->with(["listquery"=>$listquery]);
    }
    public function annexure_vi(Request $request)
    {
        //$datefrom =  $request->input('datefrom');
       // $todate =  $request->input('todate');
        
        $data['quality_control']=Rawmaterialitems::select(
            'quality_controll_check.*','quality_controll_check.id as quality_id',
            'inward_raw_materials_items.material as raw_material_name',
            'inward_raw_materials_items.id as inward_r_m_id',
            'inward_raw_materials.manufacturer as name_manufacturer',
            'inward_raw_materials.supplier as name_supplier',
            'inward_raw_materials.material as name_material',
            'inward_raw_materials.id as inward_r_m_t_id',
            'inward_raw_materials_items.batch_no',
            'inward_raw_materials_items.qty_received_kg',
            'inward_raw_materials_items.ar_no_date',
            'inward_raw_materials.goods_receipt_no',
            'raw_materials.id as r_m_id',
            'raw_materials.material_name',
            "suppliers.name",
            "manufacturers.manufacturer",
            "inward_raw_materials_items.id as itemid"
            )

        ->join('inward_raw_materials','inward_raw_materials.id','=','inward_raw_materials_items.inward_raw_material_id' )
        ->join('raw_materials','raw_materials.id','=','inward_raw_materials_items.material')
        ->join("suppliers","suppliers.id","inward_raw_materials.supplier")
        ->join("manufacturers","manufacturers.id","inward_raw_materials.manufacturer")
        ->leftjoin('quality_controll_check','quality_controll_check.inward_material_item_id','=','inward_raw_materials_items.id' )
        ->orderBy('inward_raw_materials.created_at', 'desc');
        // if(!empty($datefrom) && !empty($todate)) {
        //     $todate = date("Y-m-d", strtotime($todate));
        //     $datefrom = date("Y-m-d", strtotime($datefrom));
        //     $data['quality_control'] = $data['quality_control']->whereBetween('inward_finished_goods.mfg_date', [$datefrom, $todate]);
        //     } 

            $data['quality_control'] = $data['quality_control']-->get();
        return view('reports.annexure_vi',$data);
    }
    public function annexure_vii(Request $request)
    {   
        $datefrom =  $request->input('datefrom');
        $todate =  $request->input('todate');

        $data['finished_good'] = FinishedGoodsDispatch::select(
            'finished_goods_dispatch.*',
            'grades.grade as grades_name',
            'mode_of_dispatch.mode as mode_name',
            "raw_materials.material_name",
            "party_master.company_name",
            "inward_finished_goods.batch_no",
            "users.name"
        )
            ->Join("party_master", "party_master.id", "=", "finished_goods_dispatch.party_name")
            ->Join("grades", "grades.id", "=", "finished_goods_dispatch.grade")
            ->Join("mode_of_dispatch", "mode_of_dispatch.id", "=", "finished_goods_dispatch.mode_of_dispatch")
            ->Join("raw_materials", "raw_materials.id", "=", "finished_goods_dispatch.product")
            ->Join("inward_finished_goods", "inward_finished_goods.id", "=", "finished_goods_dispatch.batch_no")
            ->Join("users","users.id", "=", "finished_goods_dispatch.dispatch_by");
             if(!empty($datefrom) && !empty($todate)) {
                $todate = date("Y-m-d", strtotime($todate));
                $datefrom = date("Y-m-d", strtotime($datefrom));
                $data['finished_good'] = $data['finished_good']->whereBetween('finished_goods_dispatch.created_at', [$datefrom, $todate]);
            } 
            $data['finished_good'] = $data['finished_good']->get();

        return view('reports.annexure_vii',$data);
    }

    public function material_report(Request $request)
    {
        $datefrom =  $request->input('datefrom');
        $todate =  $request->input('todate');
        $material_name =  $request->input('material_name');

        $data['inward_material']=Rawmaterialitems::select(
            "inward_raw_materials.*"
            ,"inward_raw_materials_items.*",
            "suppliers.name",
            "manufacturers.manufacturer as man_name",
            "raw_materials.material_name",
            "raw_materials.material_stock",
            "mesurments.mesurment",
            "inward_raw_materials_items.id as itemid")
            ->join("inward_raw_materials","inward_raw_materials.id","inward_raw_materials_items.inward_raw_material_id")
            ->join("suppliers","suppliers.id","inward_raw_materials.supplier")
            ->join("manufacturers","manufacturers.id","inward_raw_materials.manufacturer")
            ->join("raw_materials","raw_materials.id","inward_raw_materials_items.material")
            ->join("mesurments","mesurments.id","raw_materials.material_mesurment");
            if(!empty($datefrom) && !empty($todate)) {
               // $todate = date("Y-m-d", strtotime($todate));
               // $datefrom = date("Y-m-d", strtotime($datefrom));
                $data['inward_material'] = $data['inward_material']->whereBetween('inward_raw_materials.date_of_receipt', [strtotime($datefrom), strtotime($todate)]);
            } 
            if(!empty($material_name) && $material_name != 'all')
            {
                $data['inward_material'] = $data['inward_material']->where('raw_materials.id',$material_name);
            }
            $data['inward_material'] = $data['inward_material']->get();
            $data['search_list'] = Rawmeterial::where('material_type','R')->get();
        return view('reports.material_report',$data);
    }
    
    public function daystore_report(Request $request)
    { 
        $day_store = Requisitionissuedmaterialdetails::join('raw_materials','issue_material_production_requestion_details.material_id','=','raw_materials.id')
                ->join('stock','issue_material_production_requestion_details.batch_id','=','stock.id')
                ->join('inward_raw_materials_items','stock.process_batch_id','=','inward_raw_materials_items.id')
                ->select('issue_material_production_requestion_details.ar_no_date','issue_material_production_requestion_details.id','raw_materials.material_name','issue_material_production_requestion_details.approved_qty','issue_material_production_requestion_details.requesist_qty','issue_material_production_requestion_details.used_qty','inward_raw_materials_items.batch_no','issue_material_production_requestion_details.return_to_warehouse')
                ->whereColumn('issue_material_production_requestion_details.used_qty','!=','issue_material_production_requestion_details.approved_qty')                                
                // ->where('issue_material_production_requestion_details.return_to_warehouse','!=',1)                    
                ->whereNotNull('issue_material_production_requestion_details.used_qty')                    
                ->orderBy('issue_material_production_requestion_details.main_details_id','desc')
                ->get();

                $returned_log = ReturnWarehouseLog::join('issue_material_production_requestion_details','return_warehouse_log.prod_detail_id','=','issue_material_production_requestion_details.id')
                ->join('inward_raw_materials','return_warehouse_log.inword_m_id','=','inward_raw_materials.id')
                //->join('stock','issue_material_production_requestion_details.batch_id','=','stock.id')
                ->join('inward_raw_materials_items','inward_raw_materials.id','=','inward_raw_materials_items.inward_raw_material_id')
                ->join('raw_materials','inward_raw_materials_items.material','=','raw_materials.id')
                ->select('issue_material_production_requestion_details.ar_no_date','inward_raw_materials_items.batch_no','raw_materials.material_name','return_warehouse_log.total_qty');
                
            
        return view('reports.daystore_report',compact('day_store'));
    }
    public function return_warehouse(Request $request){
        
        try{
                $req_details = Requisitionissuedmaterialdetails::select('inward_raw_materials_items.*','inward_raw_materials.*','inward_raw_materials.id as r_no','issue_material_production_requestion_details.approved_qty','issue_material_production_requestion_details.used_qty as re_used_qty','issue_material_production_requestion_details.id as prod_detail_id')
                ->join('inward_raw_materials_items','issue_material_production_requestion_details.inword_item_id','=','inward_raw_materials_items.id')
                ->join('inward_raw_materials','inward_raw_materials_items.inward_raw_material_id','=','inward_raw_materials.id')
                ->where('issue_material_production_requestion_details.id',$request->id)
                ->first();
                
                $quality_old = Qualitycontroll::select('checked_by','material_type')->where('inward_material_id',$req_details->r_no)->first();
               
                if($quality_old->material_type == 'R'){
                    $maxid = InwardMaterial::select(DB::Raw("max(id) as nextid"))->first();
                    $data = array();
                    $data["inward_no"] = $maxid->nextid+1;
                    $data["received_from"] = $req_details->received_from;
                    $data["received_to"] = $req_details->received_to;
                    $data["date_of_receipt"] = time();
                    $data["material"] = $req_details->material;
                    $data["manufacturer"] = $req_details->manufacturer;
                    $data["supplier"] = $req_details->supplier;
                    $data["supplier_address"] = $req_details->supplier_address;
                    $data["supplier_gst"] = $req_details->supplier_gst;
                    $data["invoice_no"] = $req_details->invoice_no;
                    $data["goods_receipt_no"] = $req_details->goods_receipt_no;
                    $data["created_by"] = $req_details->created_by;
                    $data["remark"] = $req_details->remark;
                    $data["is_opening"] = $req_details->is_opening;
                    
                    $result = InwardMaterial::create($data);
                        if($result->id){
                            $stock = Rawmeterial::find($req_details->material);
                            $itemdata["inward_raw_material_id"] = $result->id;
                            $itemdata["material"] = $req_details->material;
                            $itemdata["batch_no"] = $req_details->batch_no;
                            $itemdata["total_no_of_containers_or_bags"] = $req_details->total_no_of_containers_or_bags;
                            $itemdata["qty_received_kg"] = $req_details->approved_qty - $req_details->re_used_qty;
                            $itemdata["mfg_date"] = $req_details->mfg_date;
                            $itemdata["mfg_expiry_date"] = $req_details->mfg_expiry_date;
                            $itemdata["rio_care_expiry_date"] = $req_details->rio_care_expiry_date;
                            $itemdata["ar_no_date"] = $req_details->ar_no_date;
                            $itemdata["ar_no_date_date"] = $req_details->ar_no_date_date;
                            $itemdata["is_opening_stock"] = $req_details->is_opening_stock;
                            $itemdata["viscosity"] = $req_details->viscosity;
                            $itemdata["opening_stock"] = $stock->material_stock;
                            $resultsItem = Rawmaterialitems::create($itemdata);
                        }
                    }else if($quality_old->material_type == 'P'){  
                        $data = array();
                        $data["goods_going_from"]=$req_details->received_from;
                        $data["goods_going_to"]=$req_details->received_to;
                        $data["date_of_receipt"]=$req_details->date_of_receipt;

                        $data["manufacurer"]=$req_details->manufacturer;
                        $data["supplier"]=$req_details->supplier;
                        $data["invoice_no"]=$req_details->invoice_no;
                        $data["goods_receipt_no"]=$req_details->goods_receipt_no;
                        $data["created_by"]= $req_details->created_by;
                        $data["remark"]= $req_details->remark;
                        $data['is_opening_stock'] = $req_details->is_opening_stock;

                        $result = InwardPackingMaterial::create($data);
                        if($result->id){
                            $datas = array();
                            $datas["good_receipt_id"] = $result->id;
                            $datas["material"] = $req_details->material;
                            $datas["total_qty"] = $req_details->approved_qty - $req_details->re_used_qty;
                            $datas["ar_no_date"] = $req_details->ar_no_date;
                            $datas['is_opening_stock'] = $req_details->is_opening_stock;
                            $datas["ar_no_datedate"] = $req_details->ar_no_date_date;
                            $resultsItem = InwardPackingMaterialItems::create($datas);
                        }
                        
                    }
                    
                    if($resultsItem){
                        $stockarr["matarial_id"] = $req_details->material;
                        $stockarr["material_type"] = $quality_old->material_type;
                        $stockarr["department"] = 3;
                        $stockarr["qty"] = $req_details->approved_qty - $req_details->re_used_qty;
                        $stockarr["batch_no"] = $req_details->batch_no;
                        $stockarr["process_batch_id"] = $resultsItem->id;
                        $stockarr["ar_no_date"] = $req_details->ar_no_date;
                        $stockarr["ar_no_date_date"] = $req_details->ar_no_date_date;
                        $stockarr["type"] = $quality_old->material_type;
                        $stid = Stock::create($stockarr);
                    }
                   
                    $data = [
                        'quantity_status' => 'Approved',
                        'date_of_approval' => date('Y-m-d'),
                        'inward_material_id' => $result->id,
                        'inward_material_item_id' => $resultsItem->id,
                        'total_qty' => $req_details->approved_qty - $req_details->re_used_qty,
                        'quantity_approved' => $req_details->approved_qty - $req_details->re_used_qty,
                        'raw_material_id' => $req_details->material,
                        'ar_no' => $req_details->ar_no_date,
                        'ar_no_date_date' => $req_details->ar_no_date_date,
                        'checked_by' => $quality_old->checkby,
                        'material_type' =>$quality_old->material_type
                    ];
                   Qualitycontroll::create($data);
                   Requisitionissuedmaterialdetails::where('id',$req_details->prod_detail_id)->update(['return_to_warehouse' => 1]); 
                   //Log for check returned material
                   $log_data = [
                        'prod_detail_id' => $req_details->prod_detail_id,
                        'inword_m_id' => $result->id,
                        'material_type' => $quality_old->material_type,
                        'total_qty' => $req_details->approved_qty - $req_details->re_used_qty
                    ];
                $result = ReturnWarehouseLog::create($log_data);
                DB::commit();
                return redirect("daystore_report")->with('success', "Return to warehouse successfully.");
        } catch (\Exception $e) { 
                DB::rollback();
            return redirect("daystore_report")->with('massage',$e->getMessage());
        }
    }
    public function warehouse_returend(Request $request)
    {  
        $datefrom =  $request->input('datefrom');
        $todate =  $request->input('todate');
        $returned_log = ReturnWarehouseLog::join('issue_material_production_requestion_details','return_warehouse_log.prod_detail_id','=','issue_material_production_requestion_details.id')
                ->join('inward_raw_materials','return_warehouse_log.inword_m_id','=','inward_raw_materials.id')
                //->join('stock','issue_material_production_requestion_details.batch_id','=','stock.id')
                ->join('inward_raw_materials_items','inward_raw_materials.id','=','inward_raw_materials_items.inward_raw_material_id')
                ->join('raw_materials','inward_raw_materials_items.material','=','raw_materials.id')
                ->select('issue_material_production_requestion_details.ar_no_date','inward_raw_materials_items.batch_no','raw_materials.material_name','return_warehouse_log.total_qty');
                if(!empty($datefrom) && !empty($todate)) {
                    $returned_log = $returned_log->whereBetween('inward_raw_materials.date_of_receipt', [strtotime($datefrom), strtotime($todate)]);
                }
        $returned_log = $returned_log->get();
        return view('reports.warehouse_returend_view',compact('returned_log'));
    }
}
