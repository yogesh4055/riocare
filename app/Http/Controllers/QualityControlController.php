<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Qualitycontroll;
use App\Models\Rawmeterial;
use App\Models\InwardMaterial;
use App\Models\Rawmaterialitems;
use App\Models\InwardPackingMaterial;
use App\Models\InwardPackingMaterialItems;
use App\Models\Inwardfinishedgoods;
use App\Models\BatchManufacture;
use App\Models\FinishedGoodsDispatch;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use DB;
class QualityControlController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:quality-control-list|quality-control-check|quality_control_packing|quality_control_finishgood|quality_control_batch|quality_control', ['only' => ['quality_control','quality_control_insert',"quality_control_packing","quality_control_finishgood","quality_control_batch"]]);
         $this->middleware('permission:quality-control-check', ['only' => ['qty_control','quality_control_insert']]);
     }
    public function quality_control()
    {
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
            "raw_materials.created_at",
            "inward_raw_materials_items.id as itemid",
            "quality_controll_check.ar_no_date_date as checkardate",
            "quality_controll_check.ar_no as checkar",
            "inward_raw_materials_items.created_at as materialdate"

            )

        ->join('inward_raw_materials','inward_raw_materials.id','=','inward_raw_materials_items.inward_raw_material_id' )
        ->join('raw_materials',function($join){
            $join->on('raw_materials.id','=','inward_raw_materials_items.material' )
                ->on("raw_materials.qc_applicable",DB::raw('1'));
        })
        ->join("suppliers","suppliers.id","inward_raw_materials.supplier")
        ->join("manufacturers","manufacturers.id","inward_raw_materials.manufacturer")
        ->leftjoin('quality_controll_check',function($join){
            $join->on('quality_controll_check.inward_material_item_id','=','inward_raw_materials_items.id' )
                ->on("quality_controll_check.material_type",DB::raw('"R"'));
        })

        ->groupBy("inward_raw_materials_items.id")
        ->orderBy('inward_raw_materials_items.id', 'DESC')
       ->get();

        return view('quality_control',$data);
    }

    public function quality_control_insert(Request $request)
    {
        $arrRules = [
            "quantity_approved"=>"required",
            //"quantity_rejected"=>"required",
            "quantity_status"=>"required",
            "date_of_approval"=>"required",
            "inward_material_id"=>"required",
            "inward_material_item_id"=>"required",
            "total_qty"=>"required",
            "raw_material_id"=>"required",
            "ar_number"=>"required",
            "checkby"=>"required",

           ];
           $arrMessages = [
            "dispath_noThis :attribute field is required.",
            "quantity_approved"=>"This :attribute field is required.",
            "quantity_rejected"=>"This :attribute field is required.",
            "quantity_status"=>"This :attribute field is required.",
            "date_of_approval"=>"This.This :attribute field is required.",
            "inward_material_id"=>"This :attribute field is required.",
            "inward_material_item_id"=>"This.This :attribute field is required.",
            "total_qty"=>"This :attribute field is required.",
            "raw_material_id"=>"This :attribute field is required.",
            "ar_number"=>"This :attribute field is required.",
            "checkby"=>"This :attribute field is required.",
            ];
          // $validateData = $request->validate($arrRules, $arrMessages);

        $data = [
            //'quantity_approved' => $request['quantity_approved'],
            //'quantity_rejected' => $request['quantity_rejected'],
            'quantity_status' => $request['quantity_status'],
            'date_of_approval' => $request['date_of_approval'],
            'inward_material_id' => $request['inward_id'],
            'inward_material_item_id' => $request['inward_item_id'],
            'total_qty' => $request['total_qty'],
            'raw_material_id' => $request['rawmaterial_id'],
            'ar_no' => $request['ar_number'],
            'ar_no_date_date' => $request['ar_date']?$request['ar_date']:"",
            'checked_by' => $request['checkby'],
            'material_type' =>$request['mat_type'],
            'remark' =>$request['remark']
        ];
        $appqty = 0;
        $rejqty = 0;
        if($request->quantity_status == "Approved")
        {
            $data["quantity_approved"] = $request['total_qty'];
            $data["quantity_rejected"] =0;
            $appqty =  $request['total_qty'];
        }
        elseif($request->quantity_status == "Rejected")
        {
            $data["quantity_rejected"] = $request['total_qty'];
            $data["quantity_approved"] =0;
            $rejqty =  $request['total_qty'];
        }
        if($request->flag == 'add'){
            $result = Qualitycontroll::create($data);
        } else {
            
            $id = Qualitycontroll::where('id', $request->quality_id)->update($data);
            $result = Qualitycontroll::find($request->quality_id);
        }
        
         if($result)
         {
             if($request->mat_type == "R")
             {
                $rowmeterial = Rawmaterialitems::find($request['inward_item_id']);
                if($rowmeterial)
                {
                    $datas = array();
                    $datas["ar_no_date"] = $request['ar_number'];
                    $datas["ar_no_date_date"] = $request['ar_date']?$request['ar_date']:"";
                    $rowmeterial->update($datas);

                    $stockarr = array();
                    if($request['quantity_status'] == 'Approved')
                    {
                        $stockarr["matarial_id"] = $result->raw_material_id;
                        $stockarr["material_type"] = $request['mat_type'];
                        $stockarr["department"] = 3;
                        $stockarr["qty"] = ($appqty-$rejqty);
                        $stockarr["batch_no"] = $request['inward_item_id'];
                        $stockarr["process_batch_id"] = $request['inward_item_id'];
                        $stockarr["ar_no_date"] = $request['ar_number'];
                        $stockarr["ar_no_date_date"] = $request['ar_date']?$request['ar_date']:"";
                        $stockarr["type"] = $request['mat_type'];

                        if($request->flag == 'add'){
                            $stid = Stock::create($stockarr);
                        } else {
                            $arr = array();
                            $arr["qty"] = ($appqty-$rejqty);
                            $stid = Stock::where('process_batch_id', $request['inward_item_id'])->where('material_type', "R")->update($arr);
                        }
                        
                    }


                }
                return redirect("quality_control")->with('success', "Item checked successfully.");
             }
             elseif($request->mat_type == "P")
             {
                $rowmeterial = InwardPackingMaterialItems::find($request['inward_item_id']);
                if($rowmeterial)
                {
                    $datas = array();
                    $datas["ar_no_date"] = $request['ar_number'];
                    $datas["ar_no_datedate"] = $request['ar_date']?$request['ar_date']:"";
                    $rowmeterial->update($datas);

                    $stockarr = array();
                    if($request['quantity_status'] == 'Approved')
                    {
                        $stockarr["matarial_id"] = $result->raw_material_id;
                        $stockarr["material_type"] = $request['mat_type'];
                        $stockarr["department"] = 3;
                        $stockarr["qty"] =  ($appqty-$rejqty);
                        $stockarr["batch_no"] = $request['inward_item_id'];
                        $stockarr["process_batch_id"] = $request['inward_item_id'];
                        $stockarr["ar_no_date"] = $request['ar_number'];
                        $stockarr["ar_no_date_date"] = $request['ar_date']?$request['ar_date']:"";
                        $stockarr["type"] = $request['mat_type'];


                        $stid = Stock::create($stockarr);
                    }


                }
                return redirect("quality_control_packing")->with('success', "Item checked successfully.");
             }
             elseif($request->mat_type == "F")
             {
                $rowmeterial = Inwardfinishedgoods::find($request['inward_item_id']);
                if($rowmeterial)
                {
                    $datas = array();
                    $datas["ar_no"] = $request['ar_number'];
                    $datas["ar_no_date"] = $request['ar_date']?$request['ar_date']:"";
                    $rowmeterial->update($datas);

                    $stockarr = array();
                    if($request['quantity_status'] == 'Approved')
                    {
                        $stockarr["matarial_id"] = $result->raw_material_id;
                        $stockarr["material_type"] = $request['mat_type'];
                        $stockarr["department"] = 3;
                        $stockarr["qty"] =  ($appqty-$rejqty);
                        $stockarr["batch_no"] = $request['inward_item_id'];
                        $stockarr["process_batch_id"] = $request['inward_item_id'];
                        $stockarr["ar_no_date"] = $request['ar_number'];
                        $stockarr["ar_no_date_date"] = $request['ar_date']?$request['ar_date']:"";
                        $stockarr["type"] = $request['mat_type'];


                        $stid = Stock::create($stockarr);

                    }


                }
                return redirect("quality_control_finishgood")->with('success', "Item checked successfully.");
             }
             elseif($request->mat_type == "B")
             {
                $rowmeterial = BatchManufacture::find($request['inward_item_id']);
                if($rowmeterial)
                {
                    $datas = array();
                    $datas["ar_no"] = $request['ar_number'];
                    $datas["ar_no_date"] = $request['ar_date']?$request['ar_date']:"";
                    $datas["is_checked"] =1;
                    $datas["rejected_qty"] =$request['quantity_rejected'];
                    $datas["approval"] =1;
                    $datas["approvalDate"] =Carbon::now();;
                    $rowmeterial->update($datas);

                    $stockarr = array();
                    if($request['quantity_status'] == 'Approved')
                    {
                        $stockarr["matarial_id"] = $result->raw_material_id;
                        $stockarr["material_type"] = $request['mat_type'];
                        $stockarr["department"] = 3;
                        $stockarr["qty"] =  ($appqty-$rejqty);
                        $stockarr["batch_no"] = $request['inward_item_id'];
                        $stockarr["process_batch_id"] = $request['inward_item_id'];
                        $stockarr["ar_no_date"] = $request['ar_number'];


                        $stockarr["ar_no_date_date"] = $request['ar_date']?$request['ar_date']:"";
                        $stockarr["type"] = $request['mat_type'];


                        $stid = Stock::create($stockarr);




                    }


                }
                return redirect("quality_control_batch")->with('success', "Item checked successfully.");
             }

         }
    }
    public function qty_control(Request $request)
    {
         $qty_control_view = Rawmaterialitems::select(
            'quality_controll_check.*','quality_controll_check.id as quality_id',
            'inward_raw_materials_items.material as raw_material_name',
            'inward_raw_materials.id as inward_id',
            'inward_raw_materials_items.batch_no',
            'inward_raw_materials_items.qty_received_kg',
            'inward_raw_materials_items.ar_no_date',
            'inward_raw_materials_items.ar_no_date_date as inward_ar_date',
            'inward_raw_materials.goods_receipt_no',
            'raw_materials.id as r_m_id',
            'raw_materials.material_name',
            "inward_raw_materials_items.id as itemid",
            "quality_controll_check.ar_no_date_date as checkardate",
            "quality_controll_check.ar_no as checkar"
            )

        ->join('inward_raw_materials','inward_raw_materials.id','=','inward_raw_materials_items.inward_raw_material_id' )
        ->join('raw_materials','raw_materials.id','=','inward_raw_materials_items.material')
        ->join("suppliers","suppliers.id","inward_raw_materials.supplier")
        ->join("manufacturers","manufacturers.id","inward_raw_materials.manufacturer")
        ->leftjoin('quality_controll_check',function($join){
            $join->on('quality_controll_check.inward_material_item_id','=','inward_raw_materials_items.id' )
                ->on("quality_controll_check.material_type",DB::raw('"R"'));
        })
        ->where("inward_raw_materials_items.id",$request->quality_id)->first();
        $users = User::where("role_id",5)->pluck("name","id");
    
         $view = view('qty_control_view',['qty_control_view'=> $qty_control_view,"mat_type"=>"R","users"=>$users,"flag"=>$request->flag])->render();
         $sms='User does not have the right permissions. Necessary permissions are quality-control-check';
         return response()->json(['html'=>$view ,'message'=>$sms]);

    }
    public function view_quality(Request $request)
    {

        if($request->quality_id)
        {

            if($request->mat_type == "R")
            {
                $view_quality =Rawmaterialitems::select(
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
                    "inward_raw_materials_items.id as itemid",
                    "quality_controll_check.ar_no_date_date as checkardate",
                    "quality_controll_check.ar_no as checkar"
                    )
                ->join('inward_raw_materials','inward_raw_materials.id','=','inward_raw_materials_items.inward_raw_material_id' )
                ->join('raw_materials','raw_materials.id','=','inward_raw_materials_items.material')
                ->join("suppliers","suppliers.id","inward_raw_materials.supplier")
                ->join("manufacturers","manufacturers.id","inward_raw_materials.manufacturer")
                ->leftjoin('quality_controll_check','quality_controll_check.inward_material_item_id','=','inward_raw_materials_items.id' )
                ->where("inward_raw_materials_items.id",$request->quality_id)->first();
                $view = view('view_quality_control', ['view_quality'=> $view_quality])->render();
                return response()->json(['html'=>$view]);
            }
            elseif($request->mat_type == 'P')
            {
                $view_quality =InwardPackingMaterialItems::select(
                    'quality_controll_check.*','quality_controll_check.id as quality_id',
                    'goods_receipt_note_items.material as raw_material_name',
                    'goods_receipt_note_items.id as inward_r_m_id',
                    'manufacturers.manufacturer as name_manufacturer',
                    'goods_receipt_notes.supplier as name_supplier',
                    'goods_receipt_notes.id as inward_r_m_t_id',
                    'goods_receipt_note_items.total_qty as qty_received_kg',
                    'goods_receipt_notes.goods_receipt_no',
                    'raw_materials.id as r_m_id',
                    'raw_materials.material_name',
                    "suppliers.name",
                    "manufacturers.manufacturer",
                    "raw_materials.created_at",
                    "goods_receipt_note_items.id as itemid",
                    "goods_receipt_note_items.ar_no_date",
                    "quality_controll_check.ar_no_date_date as checkardate",
                    "quality_controll_check.ar_no as checkar"
                    )

                ->join('goods_receipt_notes','goods_receipt_notes.id','=','goods_receipt_note_items.good_receipt_id' )
                ->join('raw_materials','raw_materials.id','=','goods_receipt_note_items.material')
                ->join("suppliers","suppliers.id","goods_receipt_notes.supplier")
                ->join("manufacturers","manufacturers.id","goods_receipt_notes.manufacurer")
                ->leftjoin('quality_controll_check',function($join){
                    $join->on('quality_controll_check.inward_material_item_id','=','goods_receipt_note_items.id' );
                    $join->on("quality_controll_check.material_type",DB::raw('"P"'));
                })
                ->where("goods_receipt_note_items.id",$request->quality_id)->first();
                $view = view('view_quality_control', ['view_quality'=> $view_quality])->render();
                return response()->json(['html'=>$view]);
            }
            elseif($request->mat_type == 'F')
            {
                $view_quality =Inwardfinishedgoods::select(
                    'inward_finished_goods.*','quality_controll_check.id as quality_id',
                    'quality_controll_check.*',
                    'raw_materials.material_name as material_name',
                    'inward_finished_goods.batch_no as batch_no',
                    "inward_finished_goods.created_at",
                    "inward_finished_goods.total_quantity_bal as qty_received_kg",
                    "inward_finished_goods.ar_no as ar_no_date",
                    "inward_finished_goods.ar_no_date as ar_no_date_date",
                    "inward_finished_goods.id as itemid",
                    "raw_materials.id as r_m_id",
                    "inward_finished_goods.created_at as batch_no",
                    "inward_finished_goods.id as inward_id",
                    "quality_controll_check.ar_no_date_date as checkardate",
                    "quality_controll_check.ar_no as checkar"
                    )


                ->join('raw_materials','raw_materials.id','=','inward_finished_goods.product_name')
                ->leftjoin('quality_controll_check',function($join){
                    $join->on('quality_controll_check.inward_material_item_id','=','inward_finished_goods.id' );
                    $join->on("quality_controll_check.material_type",DB::raw('"F"'));
                })
                ->where("inward_finished_goods.id",$request->quality_id)->first();
                $view = view('view_quality_control_finish', ['view_quality'=> $view_quality])->render();
                return response()->json(['html'=>$view]);
            }

            elseif($request->mat_type == 'B')
            {
                $view_quality =BatchManufacture::select(
                    'quality_controll_check.*','quality_controll_check.id as quality_id',
                    'add_batch_manufacture.*',
                    'raw_materials.material_name as material_name',
                    'add_batch_manufacture.batchNo as batch_no',
                    "add_batch_manufacture.created_at",
                    "add_batch_manufacture.BatchSize as qty_received_kg",
                    "add_batch_manufacture.ar_no",
                    "add_batch_manufacture.ar_no_date",
                    "add_batch_manufacture.id as itemid",
                    "raw_materials.id as r_m_id",
                    "add_batch_manufacture.created_at as batch_no",
                    "add_batch_manufacture.id as inward_id",
                    "quality_controll_check.ar_no_date_date as checkardate",
                    "quality_controll_check.ar_no as checkar"

                    )


                ->join('raw_materials','raw_materials.id','=','add_batch_manufacture.proName')
                ->leftjoin('quality_controll_check',function($join){
                    $join->on('quality_controll_check.inward_material_item_id','=','add_batch_manufacture.id' );
                    $join->on("quality_controll_check.material_type",DB::raw('"B"'));
                })
                ->where("add_batch_manufacture.id",$request->quality_id)->first();
                $view = view('view_quality_control_finish', ['view_quality'=> $view_quality])->render();
                return response()->json(['html'=>$view]);
            }


        }
        else
        {

        redirect(404);
        }
    }

    public function quality_control_packing(Request $request)
    {
        $data['quality_control']=InwardPackingMaterialItems::select(
            'quality_controll_check.*','quality_controll_check.id as quality_id',
            'goods_receipt_note_items.material as raw_material_name',
            'goods_receipt_note_items.id as inward_r_m_id',
            'manufacturers.manufacturer as name_manufacturer',
            'goods_receipt_notes.supplier as name_supplier',
            'goods_receipt_notes.id as inward_r_m_t_id',
            'goods_receipt_note_items.total_qty',
            'goods_receipt_notes.goods_receipt_no',
            'raw_materials.id as r_m_id',
            'raw_materials.material_name',
            "suppliers.name",
            "manufacturers.manufacturer",
            "goods_receipt_note_items.created_at",
            "goods_receipt_note_items.id as itemid",
            "goods_receipt_note_items.ar_no_date",
            "quality_controll_check.ar_no_date_date as checkardate",
            "quality_controll_check.ar_no as checkar",
            "goods_receipt_note_items.created_at as materialdate"
            )

        ->join('goods_receipt_notes','goods_receipt_notes.id','=','goods_receipt_note_items.good_receipt_id' )
        ->join('raw_materials',function($join){
            $join->on('raw_materials.id','=','goods_receipt_note_items.material' )
                ->on("raw_materials.qc_applicable",DB::raw('1'));
        })

        ->join("suppliers","suppliers.id","goods_receipt_notes.supplier")
        ->join("manufacturers","manufacturers.id","goods_receipt_notes.manufacurer")
        ->leftjoin('quality_controll_check',function($join){
            $join->on('quality_controll_check.inward_material_item_id','=','goods_receipt_note_items.id' );
            $join->on("quality_controll_check.material_type",DB::raw('"P"'));
        })
        ->groupBy("goods_receipt_note_items.id")
        ->orderBy('goods_receipt_note_items.created_at', 'desc')
       ->get();
        return view('quality_control_packing',$data);

    }
    public function qty_control_packing_approved(Request $request) {

        $qty_control_view = InwardPackingMaterialItems::select(
            'quality_controll_check.*','quality_controll_check.id as quality_id',
            'goods_receipt_note_items.material as raw_material_name',
            'goods_receipt_notes.id as inward_id',
            'goods_receipt_note_items.total_qty as qty_received_kg',
            'goods_receipt_note_items.ar_no_date',
            'goods_receipt_notes.goods_receipt_no',
            'raw_materials.id as r_m_id',
            'goods_receipt_notes.created_at as batch_no',
            'raw_materials.material_name',
            "goods_receipt_note_items.id as itemid"
            )

        ->join('goods_receipt_notes','goods_receipt_notes.id','=','goods_receipt_note_items.good_receipt_id' )
        ->join('raw_materials',function($join){
            $join->on('raw_materials.id','=','goods_receipt_note_items.material' )
                ->on("raw_materials.qc_applicable",DB::raw('1'));
        })

        ->join("suppliers","suppliers.id","goods_receipt_notes.supplier")
        ->join("manufacturers","manufacturers.id","goods_receipt_notes.manufacurer")
        ->leftjoin('quality_controll_check',function($join){
            $join->on('quality_controll_check.inward_material_item_id','=','goods_receipt_note_items.id' );
            $join->on("quality_controll_check.material_type",DB::raw('"P"'));
        })
        ->where("goods_receipt_note_items.id",$request->quality_id)->first();
        $users = User::where("role_id",5)->pluck("name","id");
         $view = view('qty_control_view',['qty_control_view'=> $qty_control_view,"mat_type"=>"P","users"=>$users,"flag"=>$request->flag])->render();
         $sms='User does not have the right permissions. Necessary permissions are quality-control-check';
         return response()->json(['html'=>$view ,'message'=>$sms]);
    }
    public function quality_control_finishgood(Request $request)
    {
        $data['quality_control']= Inwardfinishedgoods::select(
            'quality_controll_check.*','quality_controll_check.id as quality_id',
            'inward_finished_goods.*',
            'raw_materials.material_name as material_name',
            'inward_finished_goods.batch_no as batch_no',
            "inward_finished_goods.created_at",
            "inward_finished_goods.total_quantity_bal as total_quantity_bal",
            "inward_finished_goods.ar_no",
            "inward_finished_goods.ar_no_date",
            "inward_finished_goods.id as itemid",
            "quality_controll_check.ar_no_date_date as checkardate",
            "quality_controll_check.ar_no as checkar",
            "inward_finished_goods.created_at as materialdate"
            )



        ->join('raw_materials',function($join){
            $join->on('raw_materials.id','=','inward_finished_goods.product_name' )
                ->on("raw_materials.qc_applicable",DB::raw('1'));
        })
        ->leftjoin('quality_controll_check',function($join){
            $join->on('quality_controll_check.inward_material_item_id','=','inward_finished_goods.id' );
            $join->on("quality_controll_check.material_type",DB::raw('"F"'));
        })
        ->groupBy("inward_finished_goods.id")
        ->orderBy('inward_finished_goods.created_at', 'desc')
       ->get();



        return view('quality_control_finishgood',$data);
    }
    public function qty_control_finishgoods_approved(Request $request)
    {
        $qty_control_view = Inwardfinishedgoods::select(
            'inward_finished_goods.*','quality_controll_check.id as quality_id',
            'raw_materials.material_name as material_name',
            'inward_finished_goods.batch_no as batch_no',
            "inward_finished_goods.created_at",
            "inward_finished_goods.total_quantity_bal as qty_received_kg",
            "inward_finished_goods.ar_no as ar_no_date",
            "inward_finished_goods.ar_no_date as ar_no_date_date",
            "inward_finished_goods.id as itemid",
            "raw_materials.id as r_m_id",
            "inward_finished_goods.created_at as batch_no",
            "inward_finished_goods.id as inward_id"
            )


        ->join('raw_materials','raw_materials.id','=','inward_finished_goods.product_name')
        ->leftjoin('quality_controll_check',function($join){
            $join->on('quality_controll_check.inward_material_item_id','=','inward_finished_goods.id' );
            $join->on("quality_controll_check.material_type",DB::raw('"F"'));
        })
        ->where("inward_finished_goods.id",$request->quality_id)->first();
        $users = User::where("role_id",5)->pluck("name","id");
         //$view = view('qty_control_view',['qty_control_view'=> $qty_control_view,"mat_type"=>"F","users"=>$users])->render();
         $view = view('qty_control_view',['qty_control_view'=> $qty_control_view,"mat_type"=>"F","users"=>$users,"flag"=>$request->flag])->render();
         $sms='User does not have the right permissions. Necessary permissions are quality-control-check';
         return response()->json(['html'=>$view ,'message'=>$sms]);
    }

    public function quality_control_batch(Request $request)
    {
        $data['quality_control']= BatchManufacture::select(
            'quality_controll_check.*','quality_controll_check.id as quality_id',
            'add_batch_manufacture.*',
            'raw_materials.material_name as material_name',
            'add_batch_manufacture.batchNo as batch_no',
            "add_batch_manufacture.created_at",
            "add_batch_manufacture.BatchSize as total_quantity_bal",
            "add_batch_manufacture.ar_no",
            "add_batch_manufacture.ar_no_date",
            "add_batch_manufacture.id as itemid",
            "quality_controll_check.ar_no_date_date as checkardate",
            "quality_controll_check.ar_no as checkar",
            "add_batch_manufacture.created_at as materialdate"
            )



        ->join('raw_materials',function($join){
            $join->on('raw_materials.id','=','add_batch_manufacture.proName' )
                ->on("raw_materials.qc_applicable",DB::raw('1'));
        })
        ->leftjoin('quality_controll_check',function($join){
            $join->on('quality_controll_check.inward_material_item_id','=','add_batch_manufacture.id' );
            $join->on("quality_controll_check.material_type",DB::raw('"B"'));
        })
        ->where(["stage_1"=>1,"stage_2"=>1,"stage_3"=>1,"stage_4"=>1,"stage_5"=>1,"stage_6"=>1,"stage_7"=>1,"stage_8"=>1])
        ->groupBy("add_batch_manufacture.id")
        ->orderBy('add_batch_manufacture.created_at', 'desc')
       ->get();


        return view('quality_control_batchgood',$data);
    }
    public function qty_control_batch_approved(Request $request)
    {
        $qty_control_view= BatchManufacture::select(
            'quality_controll_check.*','quality_controll_check.id as quality_id',
            'add_batch_manufacture.*',
            'raw_materials.material_name as material_name',
            'add_batch_manufacture.batchNo as batch_no',
            "add_batch_manufacture.created_at",
            "add_batch_manufacture.BatchSize as qty_received_kg",
            "add_batch_manufacture.ar_no",
            "add_batch_manufacture.ar_no_date",
            "add_batch_manufacture.id as itemid",
            "raw_materials.id as r_m_id",
            "add_batch_manufacture.created_at as batch_no",
            "add_batch_manufacture.id as inward_id"
            )


        ->join('raw_materials','raw_materials.id','=','add_batch_manufacture.proName')
        ->leftjoin('quality_controll_check',function($join){
            $join->on('quality_controll_check.inward_material_item_id','=','add_batch_manufacture.id' );
            $join->on("quality_controll_check.material_type",DB::raw('"B"'));
        })
        ->where("add_batch_manufacture.id",$request->quality_id)->first();
        $users = User::where("role_id",5)->pluck("name","id");
         $view = view('qty_control_view',['qty_control_view'=> $qty_control_view,"mat_type"=>"B","users"=>$users,"flag"=>$request->flag])->render();
         $sms='User does not have the right permissions. Necessary permissions are quality-control-check';
         return response()->json(['html'=>$view ,'message'=>$sms]);
    }
}
