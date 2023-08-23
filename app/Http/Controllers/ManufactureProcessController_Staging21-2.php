<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BatchManufacture;
use App\Models\BillOfRwaMaterial;
use App\Models\BillOfRawMaterialsDetails;
use App\Models\BatchManufacturingPacking;
use App\Models\BatchManufacturingEquipment;
use App\Models\ListOfEquipmentManufacturing;
use App\Models\LineClearance;
use App\Models\Rawmeterial;
use Illuminate\Support\Facades\Auth;
use App\Models\BatchManufacturingRecordsLine;
use App\Models\PackingMaterialSlip;
use App\Models\MaterialDetails;
use App\Models\DetailsRequisition;
use App\Models\Grade;
use App\Models\RequisitionSlip;
use App\Models\AddLotsl;
use App\Models\Processlots;
use App\Models\AddLotslRawMaterialDetails;
use App\Models\HomogenizingList;
use App\Models\Homogenizing;
use App\Models\Requisitionissuedmaterial;
use App\Models\Requisitionissuedmaterialdetails;
use session;
use App\Models\Department;
use Symfony\Component\VarDumper\VarDumper;
use App\Models\Stock;
use App\Models\GanerateLable;
use App\Models\User;
use App\Models\ReactorsSatus;
use DB;
use PDF;
use Carbon\Carbon;

class ManufactureProcessController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:batch-manufacture-list|batch-manufacturing-add|batch-manufacturing-edit', ['only' => ['add_batch_manufacture','add_batch_manufacturing_recorde_insert']]);
         $this->middleware('permission:batch-manufacturing-add', ['only' => ['add_batch_manufacturing_record','add_batch_manufacturing_recorde_insert']]);
         $this->middleware('permission:batch-manufacturing-edit', ['only' => ['add_manufacturing_edit','add_manufacturing_update']]);
     }
    public function add_batch_manufacture(Request $request)
    {

        $data['manufacture'] = BatchManufacture::select('add_batch_manufacture.*', 'raw_materials.material_name')
            ->leftJoin('raw_materials', 'raw_materials.id', '=', 'add_batch_manufacture.proName')
            ->orderBy('id','desc')
            ->get();
        $data["product"] = Rawmeterial::where("material_type", "F")->pluck("material_name", "id");
        $request->session()->put('batch', "");
        return view('add_batch_manufacture', $data);
    }
    public function add_batch_manufactureAjax(Request $request)
    {
        $listquery = "";

        $listquery =  BatchManufacture::select('add_batch_manufacture.*', 'raw_materials.material_name')
                      ->leftJoin('raw_materials', 'raw_materials.id', '=', 'add_batch_manufacture.proName');

        $totalData = $listquery->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = isset($columns[$request->input('order.0.column')])?$columns[$request->input('order.0.column')]:"add_batch_manufacture.id";
        $dir = $request->input('order.0.dir');

        if($order == "id")
        {
            $dir = "desc";
        }

        ## Custom Field value
        $rcdate =  $request->input('rcdate');
        $batch_no = $request->input('batch_no');
        $product = $request->input('product');




        if ($rcdate) {
            $listquery->where(DB::raw('DATE_FORMAT(add_batch_manufacture.created_at,"%Y-%m-%d")'), '=', ($rcdate));
        }
        if ($batch_no) {

                $listquery->where('add_batch_manufacture.batchNo', '=', "{$batch_no}");
        }
        if ($product) {
            $listquery->where("add_batch_manufacture.proName", '=', "{$product}");
        }


        if(!empty($request->input('search.value')))
        {
                $search = $request->input('search.value');
                $listquery->orWhere('raw_materials.material_name', 'like', "%{$search}%")
                ->orWhere('add_batch_manufacture.batchNo', 'like', "%{$search}%")
                ->orWhere('add_batch_manufacture.ManufacturingDate', '=', "{strtotime($search)}")
                ->orWhere('add_batch_manufacture.refMfrNo', 'like', "%{$search}%")
                ->orWhere('add_batch_manufacture.BatchSize', 'like', "%{$search}%")
                ->orWhere('add_batch_manufacture.bmrNo', 'like', "%{$search}%");




        }

        $totalFiltered = $listquery->count();
        $listquery->offset($start)
                ->limit($limit)
                ->orderBy("add_batch_manufacture.created_at", "desc");

        $data = $listquery->get();



        $datas = array();
        if (!empty($data)) {
            $i=$request->input('start')+1;
            $type = "";

            foreach ($data as $post) {


                $print =  route('pdfview', ["id"=>$post->id]);
                $edit =  route('add_manufacturing_edit', ["id"=>$post->id]);


                $nestedData['id'] = $i;
                $nestedData["date"] = $post->created_at?date("d/m/Y",strtotime($post->created_at)):"";
                $nestedData["material_name"] = $post->material_name;
                $nestedData['batchno'] = $post->batchNo;
                $nestedData['bmrno'] = $post->bmrNo;
                $nestedData['refmfrno'] = $post->refMfrNo;
                $nestedData['grade'] = $post->grade;
                $nestedData['batchsize'] = number_format($post->BatchSize,3,".","");
                $nestedData['viscosity'] = $post->Viscosity;
                $nestedData['product_commence'] = $post->ProductionCommencedon;
                $nestedData["product_completion"] = $post->ProductionCompletedon;
                $nestedData["manfuactring_date"] = $post->ManufacturingDate;
                $nestedData["retest_date"] = $post->RetestDate;
                $nestedData["status"] = ($post->is_aproved?'<span class="badge badge-success p-2">Approved</span>':'<span class="badge badge-warning p-2">Not Approved</span>');
                if($post->is_aproved)
                {
                    $nestedData['action'] = '<div class="actions"> <!--<a href="#" class="btn action-btn view" id="myModal" data-tooltip="tooltip" title="View" onclick="view('.$post->id.')"><i data-feather="eye"></i></a> -->


                    <a href="'.$print.'" class="btn action-btn" data-tooltip="tooltip" title="Print" target="_blank"><i data-feather="printer"></i></a></div>';
                }
                elseif($post->approval!=1)
                {
                    $nestedData['action'] = '<div class="actions"> <!--<a href="#" class="btn action-btn view" id="myModal" data-tooltip="tooltip" title="View" onclick="view('.$post->id.')"><i data-feather="eye"></i></a> -->
                    <a href="'.$edit.'" class="btn action-btn" data-tooltip="tooltip" title="Edit"><i data-feather="edit-3"></i></a>

                    <a href="'.$print.'" class="btn action-btn" data-tooltip="tooltip" title="Print" target="_blank"><i data-feather="printer"></i></a></div>';
                }
                else
                {
                    $nestedData['action'] = '<div class="actions"> <!--<a href="#" class="btn action-btn view" id="myModal" data-tooltip="tooltip" title="View" onclick="view('.$post->id.')"><i data-feather="eye"></i></a> -->


                    <a href="'.$print.'" class="btn action-btn" data-tooltip="tooltip" title="Print" target="_blank"><i data-feather="printer"></i></a></div>';
                }
                $datas[] = $nestedData;

                $i++;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $datas
        );

        echo json_encode($json_data);
    }
    public function add_batch_manufacturing_record(Request $request)
    {
        $data["product"] = Rawmeterial::where("material_type", "F")->pluck("material_name", "id");
        $data["lotno"] =1;
        $data["selected_crop"] = array();
        $data["selected_crop_tank"] = array();
        $data["reactorgroup"] =array();
        $data["processgroup"] = array();

        $batch = "";
        if ($request->session()->has('batch')) {
            $batch = $request->session()->get('batch');
        }
        $data['batchproduct']  = array();
        $data["batch"] = $batch;

        if (isset($batch) && $batch) {

            $batchdetails =  BatchManufacture::select('add_batch_manufacture.*')->where("batchNo", $batch)->first();
            if (isset($batchdetails) && $batchdetails)
                $data["batchdetails"] = $batchdetails;

                $data['batchproduct'] = Rawmeterial::where("material_type", "F")->where("id",$data['batchdetails']->proName)->first();

            if(isset($data['batchproduct']) && $data['batchproduct'])
            {
                $data["processgroup"] = DB::table("processes")->where("group_id",$data["batchproduct"]->processgroupid)->get();
                $data["reactorgroup"] = DB::table("reactor_status")->where("group_id",$data["batchproduct"]->reactorstatusgroup)->get();

            }

            $lotsdetails = AddLotsl::select('add_lotsl.*','raw_materials.*',"add_lotsl.id as lotid")->where("batchNo",$batch)->leftJoin('raw_materials', 'raw_materials.id','=','add_lotsl.proName')->get();
            if (isset($lotsdetails) && $lotsdetails) {
                $data["lotsdetails"] = $lotsdetails;
                $lot_id = AddLotsl::select('id')->where("batchNo",$batch)->first();
                $processlots = AddLotslRawMaterialDetails::select('add_lots_raw_material_detail.*','add_lotsl.*')->where("batchNo",$batch)
                ->leftJoin('add_lotsl','add_lotsl.id','=','add_lots_raw_material_detail.add_lots_id')
                ->get();

                if (isset($processlots) && $processlots)
                    $data["processlots"] = $processlots;
            }

            $data["requestion"] = RequisitionSlip::where("batch_id", $batchdetails->id)->where("type","R")->orderBy('id', 'desc')->get();


            $Requisitionissuedmaterial = Requisitionissuedmaterial::where("batch_id", $batchdetails->id)->where("type","R")->orderBy('id', 'desc')->get();

             if(isset($Requisitionissuedmaterial) && $Requisitionissuedmaterial)
             {



                        foreach($Requisitionissuedmaterial as $mat)
                        {
                            $data['raw_material_bills'][] =  Requisitionissuedmaterialdetails::select("issue_material_production_requestion_details.*","raw_materials.material_name","inward_raw_materials_items.id")
                            ->where("issue_material_production_requestion_details.issual_material_id", $mat->id)
                            ->join("raw_materials", "raw_materials.id", "issue_material_production_requestion_details.material_id")
                            ->join("stock", "stock.id", "issue_material_production_requestion_details.batch_id")
                            ->join("inward_raw_materials_items", "inward_raw_materials_items.id", "stock.batch_no")
                            ->get();
                        }




            }

            $data["requestion_packing"] = RequisitionSlip::where("batch_id", $batchdetails->id)->where("type","P")->orderBy('id', 'desc')->get();
            $reqPackingCount = RequisitionSlip::where("batch_id", $batchdetails->id)->where("type","P")->orderBy('id', 'desc')->count();

            /*if (isset($data["requestion_packing"]) && $reqPackingCount > 0){
                $data["requestion_packing_details"] = DetailsRequisition::select("detail_packing_material_requisition.*", "raw_materials.material_name")->where("requisition_id", $data["requestion_packing"]->id)->join("raw_materials", "raw_materials.id", "detail_packing_material_requisition.PackingMaterialName")->orderBy('id', 'desc')->get();

                $data['packing_material_bills'] =  Requisitionissuedmaterialdetails::select("issue_material_production_requestion_details.*","raw_materials.material_name")
                    ->where("issue_material_production_requestion_details.main_details_id", $data["requestion_packing"]->id)
                    ->join("raw_materials", "raw_materials.id", "issue_material_production_requestion_details.material_id")
                    ->get();
            }*/

            $data["selected_crop"] =  ListOfEquipmentManufacturing::select("equipment_code.code","list_of_equipment_in_manufacturin_process.id")->join("batch_manufacturing_records_list_of_equipment","batch_manufacturing_records_list_of_equipment.id","list_of_equipment_in_manufacturin_process.batch_manufacturing_id")->join("equipment_code","equipment_code.id","list_of_equipment_in_manufacturin_process.EquipmentCode")->where('batch_manufacturing_records_list_of_equipment.batch_id', '=', $batchdetails->id)->where("equipment_code.equipment_id","<>",2)->pluck("code","id");

            $data["selected_crop_tank"] =  ListOfEquipmentManufacturing::select("equipment_code.code","list_of_equipment_in_manufacturin_process.id")->join("batch_manufacturing_records_list_of_equipment","batch_manufacturing_records_list_of_equipment.id","list_of_equipment_in_manufacturin_process.batch_manufacturing_id")->join("equipment_code","equipment_code.id","list_of_equipment_in_manufacturin_process.EquipmentCode")->where('batch_manufacturing_records_list_of_equipment.batch_id', '=', $batchdetails->id)->where("equipment_code.equipment_id","=",2)->pluck("code","id");

            $batchid  = $batchdetails->id;
            $data["stock"] = Stock::select("raw_materials.material_name","raw_materials.id")->where("department",3)->where(DB::raw("qty-used_qty"),">",0)->join("raw_materials","raw_materials.id","stock.matarial_id")->where("stock.material_type",'R')->groupBy("raw_materials.id")->pluck("material_name","id");

            $lotsnum = AddLotsl::select(DB::raw("max(lotNo) as lotno"))->where('batch_id', $batchdetails->id)->first();
            if(isset($lotsnum) && $lotsnum){
                $data["lotno"]  = $lotsnum->lotno+1;
            }
            else
                $data["lotno"]  = 1;

            $data['res_data_1'] = BatchManufacturingEquipment::where('batch_id', '=', $batchdetails->id)
                ->first();
            if(isset($data['res_data_1']) && $data['res_data_1'])
                 $data['res_1'] = ListOfEquipmentManufacturing::where('batch_manufacturing_id', '=', $data['res_data_1']->id)
                ->get();

            $data['Homogenizing'] = Homogenizing::select("homogenizing.*","raw_materials.material_name")->leftJoin('raw_materials', 'raw_materials.id','=','homogenizing.proName')->where('batch_id', '=', $batchdetails->id)
                ->get();


            $data['HomogenizingList'] = array();

        }
            $data["department"] = Department::where("department_type","W")->get();
            $data["rawmaterials"] = Rawmeterial::select("raw_materials.id","raw_materials.material_name",DB::raw("(sum(stock.qty)-sum(stock.used_qty)) as tot_stock"))->join("stock","stock.matarial_id","raw_materials.id")->where("raw_materials.material_type", "R")->groupBy("raw_materials.id")->having("tot_stock",">","0")->pluck("material_name", "id");;
        $data["packingmaterials"] = Rawmeterial::select("raw_materials.id","raw_materials.material_name",DB::raw("(sum(stock.qty)-sum(stock.used_qty)) as tot_stock"))->join("stock","stock.matarial_id","raw_materials.id")->where("raw_materials.material_type", "P")->groupBy("raw_materials.id")->having("tot_stock",">","0")->pluck("material_name", "id");
            $data["packingmaterialsarr"] = Rawmeterial::where("material_type", "P")->select("material_name", "id")->get();
            $data["batchName"] = array();

            $data["eqipment_name"] = DB::table("equipment_name")->pluck("equipment", "id");
            $data["eqipment_code"] = DB::table("equipment_code")->pluck("code", "id");

            $data["users"] = USER::pluck("name","id");
            $data["usersworker"] = USER::where("role_id",6)->pluck("name","id");
            $data["usersofficerqc"] = USER::where("role_id",5)->pluck("name","id");

            // office production
            $data["usersofficerpod"] = USER::where("role_id",7)->pluck("name","id");

            // production Manager
            $data["usersofficerpodman"] = USER::where("role_id",8)->pluck("name","id");
            $data["grades"] = Grade::get();




        return view('add_batch_manufacturing_record', $data);
    }


    public function add_btch_manufacture_view(Request $request)
    {
        if ($request->ajax()) {

            $res = BatchManufacture::select('add_batch_manufacture.*', 'raw_materials.material_name')
                ->join('raw_materials', 'raw_materials.id', '=', 'add_batch_manufacture.proName')
                ->where('add_batch_manufacture.id', $request->id)
                ->first();
        }
        return (['status' => true, 'res' => $res]);
    }

    public function add_manufacturing_insert(Request $request)
    {

       $alreadyBatchYN = BatchManufacture::get()->where("batchNo", $request['batchNo'])->count();
       if(0 < $alreadyBatchYN)
            return redirect("add-batch-manufacturing-record")->with('error', "Batch No. already Used");
        // dd($request->all());
        // $arrRules = [
        //     "proName" => "required",
        //     "bmrNo" => "required",
        //     "batchNo" => "required|unique:add_batch_manufacture",
        //     "refMfrNo" => "required",
        //     "grade" => "required",
        //     "BatchSize" => "required",
        //     "Viscosity" => "required",
        //     "ProductionCommencedon" => "required",
        //     "ProductionCompletedon" => "required",
        //     "ManufacturingDate" => "required",
        //     "RetestDate" => "required",
        //     "doneBy" => "required",
        //     "checkedBy" => "required",
        //     "inlineRadioOptions" => "required",
        //     "approval" => "required",
        //     "approvalDate" => "required",
        //     "checkedByI" => "required",
        // ];
        // $arrMessages = [
        //     "proName" => "This :attribute field is required.",
        //     "bmrNo" => "This :attribute field is required.",
        //     "batchNo" => "This :attribute field is required.",
        //     "refMfrNo" => "This :attribute field is required.",
        //     "grade" => "This :attribute field is required.",
        //     "BatchSize" => "This :attribute field is required.",
        //     "Viscosity" => "This :attribute field is required.",
        //     "ProductionCommencedon" => "This :attribute field is required.",
        //     "ProductionCompletedon" => "This :attribute field is required.",
        //     "ManufacturingDate" => "This :attribute field is required.",
        //     "RetestDate" => "This :attribute field is required.",
        //     "doneBy" => "This :attribute field is required.",
        //     "checkedBy" => "This :attribute field is required.",
        //     "inlineRadioOptions" => "This :attribute field is required.",
        //     "inlineRadioOptions" => "This :attribute field is required.",
        //     "approval" => "This :attribute field is required.",
        //     "approvalDate" => "This :attribute field is required.",
        //     "checkedBy" => "This :attribute field is required.",
        // ];
        // $validated = $request->validate($arrRules,$arrMessages);
        $bmrNo = $request['bmrNo'].''.$request['bmrNoo'];
        $data = [
            "proName" =>  $request['proName'],
            "bmrNo" =>  $bmrNo,
            "batchNo" =>  $request['batchNo'],
            "refMfrNo" =>  $request['refMfrNo'],
            "grade" =>  $request['grade'],
            "BatchSize" =>  $request['BatchSize'],
            "Viscosity" =>  $request['Viscosity'],
            "ProductionCommencedon" =>  $request['ProductionCommencedon'],
            "ProductionCompletedon" =>  $request['ProductionCompletedon'],
            "ManufacturingDate" =>  $request['ManufacturingDate'],
            "RetestDate" =>  $request['RetestDate'],
            "doneBy" =>  $request['doneBy'],
            "checkedBy" =>$request['checkedBy'],
            "inlineRadioOptions" =>  $request['inlineRadioOptions'],
            "approval" =>  $request['grade'],
            "approvalDate" =>  $request['approvalDate'],
            "checkedByI" => $request['checkedByI'],
            "Remark" =>  $request['Remark'],
            "is_active" => 1,
            "is_delete" => 1,
            "stage_1" => 1
        ];

        $result = BatchManufacture::create($data);

        if ($result) {
            // Session::put('batch',$request['batchNo']);
            $request->session()->put('batch', $request['batchNo']);
            if(isset($request->save_q))
            {
                return redirect("add-batch-manufacture")->with('success', "Batch created successfully");
            }
            else
                return redirect("add-batch-manufacturing-record#requisition")->with('success', "Batch created successfully");
        }
    }

    public function add_manufacturing_edit(Request $request, $id, $formSeqId = '')
    {
       // dd($request);
        $data['edit_batchmanufacturing'] = BatchManufacture::select('add_batch_manufacture.*')
            ->where('add_batch_manufacture.id', '=', $id)->first();
        //session
            $data['edit_ganerat_lable'] = GanerateLable::where('generate_label.batch_id', '=', $id)->first();


        $data['product'] = Rawmeterial::where("material_type", "F")->pluck("material_name", "id");

        $data['batchproduct'] = Rawmeterial::where("material_type", "F")->where("id",$data['edit_batchmanufacturing']->proName)->first();

        if(isset($data['batchproduct']) && $data['batchproduct'])
        {
           // dd($data["batchproduct"]->reactorstatusgroup);
            $data["processgroup"] = DB::table("processes")->where("group_id",$data["batchproduct"]->processgroupid)->get();
            $data["reactorgroup"] = DB::table("reactor_status")->where("group_id",$data["batchproduct"]->reactorstatusgroup)
            ->get();

        }

        $data["requestion"] = RequisitionSlip::where("batch_id", $id)->where("type","R")->orderBy('id', 'desc')->get();
        if (isset($data["requestion"]))


             $Requisitionissuedmaterial = Requisitionissuedmaterial::where("batch_id", $id)->where("type","R")->orderBy('id', 'desc')->get();

             if(isset($Requisitionissuedmaterial) && $Requisitionissuedmaterial)
             {



                        foreach($Requisitionissuedmaterial as $mat)
                        {
                            $data['raw_material_bills'][] =  Requisitionissuedmaterialdetails::select("issue_material_production_requestion_details.*","raw_materials.material_name","inward_raw_materials_items.id",
                                "issue_material_production_requestion_details.id as prod_d_id")
                            ->where("issue_material_production_requestion_details.issual_material_id", $mat->id)
                            ->join("raw_materials", "raw_materials.id", "issue_material_production_requestion_details.material_id")
                            ->join("stock", "stock.id", "issue_material_production_requestion_details.batch_id")
                            ->join("inward_raw_materials_items", "inward_raw_materials_items.id", "stock.batch_no")
                            ->get();
                        }



            }
            if(isset($data['edit_batchmanufacturing']))
            {
                $lotsdetails = AddLotsl::select('add_lotsl.*','raw_materials.*',"add_lotsl.id as lotid")->where("batchNo",$data['edit_batchmanufacturing']->batchNo)->leftJoin('raw_materials', 'raw_materials.id','=','add_lotsl.proName')->get();



                if (isset($lotsdetails) && $lotsdetails) {
                    $data["lotsdetails"] = $lotsdetails;
                    $lot_id = AddLotsl::select('id')->where("batch_id",$id)->first();
                    if(isset($lot_id) && $lot_id){
                        $processlots = Processlots::select("qty","temp","stratTime","endTime","users.name as doneby","process_id","pr.process_name")
                                                ->leftJoin("users","users.id","process_lots.doneby")
                                                ->leftJoin('processes as pr', 'pr.id', '=', 'process_lots.process_id')
                                                ->where("process_lots.lot_id",$lot_id->id)
                                                ->get();
                    }

                    /*$processlots = AddLotslRawMaterialDetails::select('add_lots_raw_material_detail.*','add_lotsl.*')->where("batch_id",$id)
                    ->leftJoin('add_lotsl','add_lotsl.id','=','add_lots_raw_material_detail.add_lots_id')

                    ->get();*/



                    if (isset($processlots) && $processlots)
                        $data["processlots"] = $processlots;
                }
            }

            $batchid  = $request->id;
            $data["stock"] = Stock::select("raw_materials.material_name","raw_materials.id")->where("department",3)->where(DB::raw("qty-used_qty"),">",0)->join("raw_materials","raw_materials.id","stock.matarial_id")->where("stock.material_type",'R')->groupBy("raw_materials.id")->pluck("material_name","id");

            $data["lotno"] =1;
            $lotsnum = AddLotsl::select(DB::raw("max(lotNo) as lotno"))->where('batch_id', $request->id)->first();
            if(isset($lotsnum) && $lotsnum){
                $data["lotno"]  = $lotsnum->lotno+1;
            }
            else
                $data["lotno"]  = 1;




        $batch = $id;

        $data["batch"] = $batch;
        if (isset($batch) && $batch) {
            $batchdetails =  BatchManufacture::select('add_batch_manufacture.*')->where("id", $batch)->first();
            if (isset($batchdetails) && $batchdetails) {
                $data["batchdetails"] = $batchdetails;
            }

            if(isset($data['edit_batchmanufacturing']))
            {
                $lotsdetails = AddLotsl::select('add_lotsl.*','raw_materials.*',"add_lotsl.id as lotid")->where("batchNo",$data['edit_batchmanufacturing']->batchNo)->leftJoin('raw_materials', 'raw_materials.id','=','add_lotsl.proName')->latest("add_lotsl.created_at")->get();

                if (isset($lotsdetails) && $lotsdetails) {
                    $data["lotsdetails"] = $lotsdetails;
                }
            }

            if(isset($batchdetails->id))
                $data["requestion_packing"] = RequisitionSlip::where("batch_id", $batchdetails->id)->where("type","P")->get();


          }

        $data['department'] = Department::where("department_type","W")->pluck("department", "id");

        $data['res_data'] = BillOfRwaMaterial::where('batch_id', '=', $id)->first();


        $data['res'] = BillOfRawMaterialsDetails::where('bill_of_raw_material_id', '=', $id)->get();
        $data['res_3'] = MaterialDetails::where('packingmaterial_id', '=', $id)
            ->get();
        $data['res_data_3'] = PackingMaterialSlip::where('batchNo', '=', $id)
            ->first();
        $data['res_data_1'] = BatchManufacturingEquipment::where('batch_id', '=', $id)
            ->first();
        if(isset($data['res_data_1']) && $data['res_data_1'])
             $data['res_1'] = ListOfEquipmentManufacturing::where('batch_manufacturing_id', '=', $data['res_data_1']->id)
            ->get();

        $data['packingmateria'] = BatchManufacturingPacking::where('batch_id', '=', $batchdetails->id)
            ->first();
        $data["rawmaterials"] = Rawmeterial::select("raw_materials.id","raw_materials.material_name",DB::raw("(sum(stock.qty)-sum(stock.used_qty)) as tot_stock"))->join("stock","stock.matarial_id","raw_materials.id")->where("raw_materials.material_type", "R")->groupBy("raw_materials.id")->having("tot_stock",">","0")->pluck("material_name", "id");;
        $data["packingmaterials"] = Rawmeterial::select("raw_materials.id","raw_materials.material_name",DB::raw("(sum(stock.qty)-sum(stock.used_qty)) as tot_stock"))->join("stock","stock.matarial_id","raw_materials.id")->where("raw_materials.material_type", "P")->groupBy("raw_materials.id")->having("tot_stock",">","0")->pluck("material_name", "id");
        $data['AddLotslRawMaterialDetails'] = AddLotslRawMaterialDetails::where('add_lots_id', '=', $id)
            ->get();

        $data['addlots'] = AddLotsl::where('batch_id', '=', $batchdetails->id)
            ->first();
       /* $data['lotsdetails'] = AddLotsl::select("add_lotsl.*","raw_materials.material_name")->where('add_lotsl.batch_id', '=', $id)->join("raw_materials","raw_materials.id","add_lotsl.proName")
            ->get();*/

        // line clearing
        //master record
        $data["lineclearace"] = BatchManufacturingRecordsLine::where("batchNo",$batchdetails->id)->first();



        // Line clearance details
        if(isset($data["lineclearace"]) && $data["lineclearace"]->id)
        {
            $data["lineclearace_details"] = LineClearance::where("line_clearance_id",$data["lineclearace"]->id)->get();
            $data["reactor_details"] = ReactorsSatus::where("clearance_id",$data["lineclearace"]->id)->get();


        }


        $data['Homogenizing'] = Homogenizing::select("homogenizing.*","raw_materials.material_name")->leftJoin('raw_materials', 'raw_materials.id','=','homogenizing.proName')->where('batch_id', '=', $id)
            ->get();


        $data['HomogenizingList'] = array();
        /*if(isset($data['Homogenizing']) && $data['Homogenizing'])
        {
            $data['HomogenizingList'] = HomogenizingList::where('homogenizing_id', '=', $data['Homogenizing'][0]->id)
            ->get();
        }*/


        $data['sequenceId'] = ($formSeqId) ? ($formSeqId) : 1;


        $data["eqipment_name"] = DB::table("equipment_name")->pluck("equipment", "id");
        //dd($data);
        $data["eqipment_code"] = DB::table("equipment_code")->pluck("code", "id");
        $data["selected_crop"] =  ListOfEquipmentManufacturing::select("equipment_code.code","list_of_equipment_in_manufacturin_process.id")->join("batch_manufacturing_records_list_of_equipment","batch_manufacturing_records_list_of_equipment.id","list_of_equipment_in_manufacturin_process.batch_manufacturing_id")->join("equipment_code","equipment_code.id","list_of_equipment_in_manufacturin_process.EquipmentCode")->where('batch_manufacturing_records_list_of_equipment.batch_id', '=', $id)->where("equipment_code.equipment_id","<>",2)->pluck("code","id");

        $data["selected_crop_tank"] =  ListOfEquipmentManufacturing::select("equipment_code.code","list_of_equipment_in_manufacturin_process.id")->join("batch_manufacturing_records_list_of_equipment","batch_manufacturing_records_list_of_equipment.id","list_of_equipment_in_manufacturin_process.batch_manufacturing_id")->join("equipment_code","equipment_code.id","list_of_equipment_in_manufacturin_process.EquipmentCode")->where('batch_manufacturing_records_list_of_equipment.batch_id', '=', $id)->where("equipment_code.equipment_id","=",2)->pluck("code","id");

        $data["users"] = USER::pluck("name","id");
        $data["usersworker"] = USER::where("role_id",6)->pluck("name","id");
        $data["usersofficerqc"] = USER::where("role_id",5)->pluck("name","id");

        // office production
        $data["usersofficerpod"] = USER::where("role_id",7)->pluck("name","id");

         // production Manager
         $data["usersofficerpodman"] = USER::where("role_id",8)->pluck("name","id");

       $data["grades"] = Grade::get();
        //$data['sequenceId'] = '#requisition';
        return view('add_manufacturing_edit', $data);
    }

    public function add_manufacturing_update(Request $request)
    {

        $data = [
            "proName" =>  $request->proName,
            "bmrNo" =>  $request->bmrNo,
            "batchNo" =>  $request->batchNo,
            "refMfrNo" =>  $request->refMfrNo,
            "grade" =>  $request->grade,
            "BatchSize" =>  $request->BatchSize,
            "Viscosity" =>  $request->Viscosity,
            "ProductionCommencedon" =>  $request->ProductionCommencedon,
            "ProductionCompletedon" =>  $request->ProductionCompletedon,
            "ManufacturingDate" =>  $request->ManufacturingDate,
            "RetestDate" =>  $request->RetestDate,
            "doneBy" =>   $request->doneBy,
            "checkedBy" =>  $request->checkedBy,
            "inlineRadioOptions" =>  $request->inlineRadioOptions,
            "approval" =>  $request->approval,
            "approvalDate" =>  $request->approvalDate,
            "checkedByI" => $request->checkedByI,
            "Remark" =>  $request->Remark,
            "is_active" => 1,
            "is_delete" => 1,
            "stage_1" => 1

        ];
        $result = BatchManufacture::where('id', $request->id)->update($data);
        $sequenceId = 1;
        if (isset($request->sequenceId)) {
            $sequenceId = (int)$request->sequenceId + 1;
        }
        if ($result) {
            $request->session()->put('batch', $request['batchNo']);
            if(isset($request->save_r))
            {
                $updreview = BatchManufacture::where('id', $request->id)->update(["is_review"=>Auth::user()->id,"reveivew_time"=>Carbon::now()]);
            }
            if(isset($request->save_app))
            {
                $updapproved = BatchManufacture::where('id', $request->id)->update(["is_aproved"=>Auth::user()->id,"aprroved_time"=>Carbon::now()]);
                return redirect("add-batch-manufacture")->with(['success' => " Batch  Data Update successfully", 'nextdivsequence' => 90]);
            }
            if(isset($request->save_q))
            {
                return redirect("add-batch-manufacture")->with('success', "Batch  Data Update successfully");
            }
            else
                return redirect("add_manufacturing_edit/" . $request->id . "/" . $sequenceId)->with(['success' => " Batch  Data Update successfully", 'nextdivsequence' => 90]);
        }
    }
    public function checkbatchnoexits(Request $request)
    {
        if($request->id)
        {
            $result = BatchManufacture::where('batchNo', $request->batch)->where('id',"<>", $request->id)->first();

            if(isset($result) && $result->id)
            {
                return response()->json(array("status"=>0));
            }
            else
                return response()->json(array("status"=>1));
        }
        elseif($request->batch)
        {
            $result = BatchManufacture::where('batchNo', $request->batch)->first();

            if(isset($result) && $result->id)
            {
                return response()->json(array("status"=>0));
            }
            else
                return response()->json(array("status"=>1));
        }
    }
    public function add_btch_manufacture_delete($id)
    {
        $result = BatchManufacture::where('id', $id)->delete();
        if ($result) {
            return redirect("add-batch-manufacture")->with('danger', "Data deleted successfully");
        }
    }
    public function bill_of_raw_material()
    {
        $data['bill_material'] = BillOfRwaMaterial::select('bill_of_raw_material.*', 'raw_materials.material_name')
            ->join('raw_materials', 'raw_materials.id', '=', 'bill_of_raw_material.id')
            ->where('bill_of_raw_material.is_delete', 1)
            ->get();
        return view('bill_of_raw_material', $data);
    }
    public function add_batch_manufacturing_record_bill()
    {
        return view('add_batch_manufacturing_record_bill');
    }


    public function add_batch_manufacturing_recorde_insert_packing(Request $request)
    {
       $request->batchNo = isset($request->batchNo)?$request->batchNo:[0 =>$request->batchNoI];

        $arrRules = [
            "proName" => "required",
            "bmrNo" => "required",
            "batchNoI" => "required",
            "refMfrNo" => "required",
            "rawMaterialName" => "required",
            "batchNo" => "required",
            "Quantity" => "required",
            "arNo" => "required",
            "date" => "required",
            "doneBy" => "required",
            "checkedBy" => "required",
        ];
        $arrMessages = [
            "proName" => "This :attribute field is required.",
            "bmrNo" => "This :attribute field is required.",
            "batchNoI" => "This :attribute field is required.",
            "refMfrNo" => "This :attribute field is required.",
            "rawMaterialName" => "This :attribute field is required.",
            "batchNo" => "This :attribute field is required.",
            "Quantity" => "This :attribute field is required.",
            "arNo" => "This :attribute field is required.",
            "date" => "This :attribute field is required.",
            "doneBy" => "This :attribute field is required.",
            "checkedBy" => "This :attribute field is required.",

        ];

        //$validateData = $request->validate($arrRules, $arrMessages);

        $arr['proName'] = $request->proName;
        $arr['bmrNo'] = $request->bmrNo;
        $arr['batchNoI'] = $request->batchNoI;
        $arr['refMfrNo'] = $request->refMfrNo;
        $order_number = date('dyHs');
        $arr['order_id'] = $order_number;
        $arr['doneBy'] = $request->doneBy;
        $arr['checkedBy'] = $request->checkedBy;
        $arr['Remark'] = $request->Remark;
        $arr['is_active'] = 1;
        $arr['is_delete'] = 1;
        $arr['batch_id'] = $request->batch_id;
        $BillOfRwaMaterial_id = BillOfRwaMaterial::Create($arr);

        if ($BillOfRwaMaterial_id->id) {
            foreach ($request->PackingMaterialName as $key => $value) {
                $arr_data['PackingMaterialName'] = $value;
                $arr_data['batchNo'] = $request->batchNo[$key];
                $arr_data['Quantity'] = $request->Quantity[$key];
                $arr_data['arNo'] = $request->arNo[$key];
                $arr_data['date'] = $request->date[$key];
                $arr_data['bill_of_raw_material_id'] = $BillOfRwaMaterial_id->id;
                BillOfRawMaterialsDetails::Create($arr_data);
            }
            $batch = BatchManufacture::find($request->batch_id);
            $batch->stage_3=1;
            $batch->save();
            if(isset($request->save_q))
            {

                return redirect("add-batch-manufacture")->with('success', "Data Bill Of Raw Materrila successfully");
            }
            else
                return redirect('add-batch-manufacturing-record#listOfEquipment')->with('success', "Data Bill Of Raw Materrila successfully");
        } else {
            return redirect('add-batch-manufacturing-record#requisition')->with('error', "Something went wrong");
        }
    }

    public function add_batch_manufacturing_recorde_insert(Request $request)
    {
        $arrRules = [
            "proName" => "required",
            "bmrNo" => "required",
            "batchNoI" => "required",
            "refMfrNo" => "required",
            "rawMaterialName" => "required",
            "batchNo" => "required",
            "Quantity" => "required",
            "arNo" => "required",
            "date" => "required",
            "doneBy" => "required",
            "checkedBy" => "required",
        ];
        $arrMessages = [
            "proName" => "This :attribute field is required.",
            "bmrNo" => "This :attribute field is required.",
            "batchNoI" => "This :attribute field is required.",
            "refMfrNo" => "This :attribute field is required.",
            "rawMaterialName" => "This :attribute field is required.",
            "batchNo" => "This :attribute field is required.",
            "Quantity" => "This :attribute field is required.",
            "arNo" => "This :attribute field is required.",
            "date" => "This :attribute field is required.",
            "doneBy" => "This :attribute field is required.",
            "checkedBy" => "This :attribute field is required.",

        ];

        //$validateData = $request->validate($arrRules, $arrMessages);

        $arr['proName'] = $request->proName;
        $arr['bmrNo'] = $request->bmrNo;
        $arr['batchNoI'] = $request->batchNoI;
        $arr['refMfrNo'] = $request->refMfrNo;
        $order_number = date('dyHs');
        $arr['order_id'] = $order_number;
        $arr['doneBy'] = $request->doneBy;
        $arr['checkedBy'] = $request->checkedBy;
        $arr['Remark'] = $request->Remark;
        $arr['is_active'] = 1;
        $arr['is_delete'] = 1;
        $arr["batch_id"] = $request->batch_id;
        $BillOfRwaMaterial_id = BillOfRwaMaterial::Create($arr);

        if ($BillOfRwaMaterial_id->id) {
            foreach ($request->rawMaterialName as $key => $value) {
                $arr_data['rawMaterialName'] = $value;
                $arr_data['batchNo'] = $request->batchNoI;
                $arr_data['Quantity'] = $request->Quantity[$key];
                $arr_data['arNo'] = $request->arNo[$key];
                $arr_data['date'] = $request->date[$key];
                $arr_data['bill_of_raw_material_id'] = $BillOfRwaMaterial_id->id;
                BillOfRawMaterialsDetails::Create($arr_data);
            }
            if(isset($request->save_q))
            {
                return redirect("add-batch-manufacture")->with('success', "Data Bill Of Raw Materrila successfully");
            }
            else
                return redirect('add-batch-manufacturing-record'.$request->nextForm)->with('success', "Data Bill Of Raw Materrila successfully");
        } else {
            return redirect('add-batch-manufacturing-record'.$request->currentForm)->with('error', "Something went wrong");
        }
    }
    public function bill_of_raw_material_edit($id)
    {

        $res_data = BillOfRwaMaterial::where('id', '=', $id)->first();
        $res = BillOfRawMaterialsDetails::where('bill_of_raw_material_id', '=', $id)->get();
        return view('bill_of_raw_material_edit', compact('res_data', $res_data, 'res', $res));
    }
    public function bill_of_raw_material_update(Request $request)
    {
        $arr['proName'] = $request->proName;
        $arr['bmrNo'] = $request->bmrNo;
        $arr['batchNoI'] = $request->batchNoI;
        $arr['refMfrNo'] = $request->refMfrNo;
        $order_number = date('dyHs');
        $arr['order_id'] = $order_number;
        $arr['doneBy'] = $request->doneBy;
        $arr['checkedBy'] = $request->checkedBy;
        $arr['Remark'] = $request->Remark;
        $arr['is_active'] = 1;
        $arr['is_delete'] = 1;

        $BillOfRwaMaterial_id = BillOfRwaMaterial::where('id', $request->id)->update($arr);

        if ((isset($request->id)) && ($request->id > 0)) {

            if (count($request->rawMaterialName)) {
                BillOfRawMaterialsDetails::where('bill_of_raw_material_id', $request->id)->delete();
                foreach ($request->rawMaterialName as $key => $value) {
                    $arr_data['rawMaterialName'] = $value;
                    $arr_data['Quantity'] = $request->Quantity[$key];
                    $arr_data['arNo'] = $request->arNo[$key];
                    $arr_data['date'] = $request->date[$key];
                    $arr_data['bill_of_raw_material_id'] = $request->id;
                    $result = BillOfRawMaterialsDetails::Create($arr_data);
                }

                $sequenceId = 1;
                if (isset($request->sequenceId)) {
                    $sequenceId = (int)$request->sequenceId + 2;
                }

                if ($result) {
                    if(isset($request->save_q))
                    {
                        return redirect("add-batch-manufacture")->with('success', " Batch  Data Update successfully");
                    }
                    else
                        return redirect("add_manufacturing_edit/" . $request->id . "/" . $sequenceId)->with(['success' => " Batch  Data Update successfully", 'nextdivsequence' => 90]);
                }
            }
            return redirect('bill-of-raw-material')->with('error', "Invalid Data");
        } else {
            return redirect('bill-of-raw-material')->with('error', "Something went wrong");
        }
    }
    public function bill_of_raw_m_view(Request $request)
    {
        if ($request->ajax()) {

            $res_data = BillOfRwaMaterial::select(
                'bill_of_raw_material.*',
            )
                ->where('bill_of_raw_material.id', $request->id)
                ->first();
            $res = BillOfRwaMaterial::select(
                'bill_of_raw_material.*',
                'bill_of_raw_material_details.*'
            )
                ->join('bill_of_raw_material_details', 'bill_of_raw_material_details.bill_of_raw_material_id', '=', 'bill_of_raw_material.id')
                ->where('bill_of_raw_material_details.bill_of_raw_material_id', $request->id)
                ->get();
        }

        return (['status' => true, 'res' => $res, 'res_data' => $res_data]);
    }
    public function bill_of_raw_material_delete($id)
    {
        $data = BillOfRwaMaterial::where('id', $id)->delete();
        if ($data) {
            return redirect('bill-of-raw-material')->with('danger', "Data Deleted successfully");
        }
    }

    public function packing_detail()
    {
        $data['packing_detail'] = BatchManufacturingPacking::select('batch_manufacturing_records_packing.*', 'raw_materials.material_name')
            ->join('raw_materials', 'raw_materials.id', '=', 'batch_manufacturing_records_packing.id')
            ->get();
        return view('packing_detail', $data);
    }
    public function add_manufacturing_record_Packing()
    {
        return view('add_manufacturing_record_Packing');
    }
    public function add_manufacturing_packing_insert(Request $request)
    {
        $arrRules = [
            "proName" => "required.",
            "bmrNo" => "required.",
            "batchNo" => "required",
            "refMfrNo" => "required",
            "ManufacturerDate" => "required",
            "Observation" => "required",
            "Temperature" => "required",
            "Humidity" => "required",
            "TemperatureP" => "required",
            "50kgDrums" => "required",
            "20kgDrums" => "required",

            "startTime" => "required",
           /* "EndstartTime" => "required",*/
            "areaCleanliness" => "required",
            "CareaCleanliness" => "required",
            "rmInput" => "required",
            "fgOutput" => "required",
            "filledDrums" => "required",
            "excessFilledDrums" => "required",
            "qcsampling" => "required",
            "StabilitySample" => "required",
            "WorkingSlandered" => "required",
            "ValidationSample" => "required",
            "CustomerSample" => "required",
            "ActualYield" => "required",
            "checkedBy" => "required",
            "ApprovedBy" => "required",
            "Remark" => "required",

        ];
        $arrMessages = [
            "proName" => "This :attribute field is required.",
            "bmrNo" => "This :attribute field is required.",
            "batchNo" => "This :attribute field is required.",
            "refMfrNo" => "This :attribute field is required.",
            "ManufacturerDate" => "This :attribute field is required.",
            "Observation" => "This :attribute field is required.",
            "Temperature" => "This :attribute field is required.",
            "Humidity" => "This :attribute field is required.",
            "TemperatureP" => "This :attribute field is required.",
            "50kgDrums" => "This :attribute field is required.",
            "20kgDrums" => "This :attribute field is required.",
            "startTime" => "This :attribute field is required.",
            "EndstartTime" => "This :attribute field is required.",
            "areaCleanliness" => "This :attribute field is required.",
            "CareaCleanliness" => "This :attribute field is required.",
            "rmInput" => "This :attribute field is required.",
            "fgOutput" => "This :attribute field is required.",
            "filledDrums" => "This :attribute field is required.",
            "excessFilledDrums" => "This :attribute field is required.",
            "qcsampling" => "This :attribute field is required.",
            "StabilitySample" => "This :attribute field is required.",
            "WorkingSlandered" => "This :attribute field is required.",
            "ValidationSample" => "This :attribute field is required.",
            "CustomerSample" => "This :attribute field is required.",
            "ActualYield" => "This :attribute field is required.",
            "checkedBy" => "This :attribute field is required.",
            "ApprovedBy" => "This :attribute field is required.",
            "Remark" => "This :attribute field is required.",
        ];
        // $validated = $request->validate($arrRules, $arrMessages);
        $data = [
            "proName" => $request['proName'],
            "bmrNo" => $request['bmrNo'],
            "batchNo" => $request['batchNo'],
            "refMfrNo" => $request['refMfrNo'],
            "ManufacturerDate" => $request['ManufacturerDate'],
            "Observation" => $request['Observation'],
            "Temperature" => $request['Temperature'],
            "Humidity" => $request['Humidity'],
            "TemperatureP" => $request['TemperatureP'],
            "50kgDrums" => $request['50kgDrums'],
            "20kgDrums" => $request['20kgDrums'],
            "30kgDrums" => $request['30kgDrums'],
            "5kgDrums" => $request['5kgDrums'],
            "NoOfBags5kg" => $request['NoOfBags5kg'],
            "NoOfBags25kg" => $request['NoOfBags25kg'],
            "NoOfBags50kg" => $request['NoOfBags'],
            "startTime" => $request['startTime'],
           /* "EndstartTime" => $request['EndstartTime'],*/
            "areaCleanliness" => Auth::user()->id,
            "CareaCleanliness" => Auth::user()->id,
            "rmInput" => $request['rmInput'],
            "fgOutput" => $request['fgOutput'],
            "filledDrums" => $request['filledDrums'],
            "excessFilledDrums" => $request['excessFilledDrums'],
            "qcsampling" => $request['qcsampling'],
            "StabilitySample" => $request['StabilitySample'],
            "WorkingSlandered" => $request['WorkingSlandered'],
            "ValidationSample" => $request['ValidationSample'],
            "CustomerSample" => $request['CustomerSample'],
            "ActualYield" => $request['ActualYield'],
            "checkedBy" => $request['checkedBy'],
            "ApprovedBy" => Auth::user()->id,
            "Remark" => $request['Remark'],
            "batch_id"=>$request["batch_id"],
            "total_sampling"=>$request['totalsampling']

        ];
        $result = BatchManufacturingPacking::create($data);

        if ($result) {
            $batch = BatchManufacture::find($request->batch_id);
            $batch->stage_7=1;
            $batch->save();
            if(isset($request->save_q))
            {

                return redirect("add-batch-manufacture")->with('success', " Data Batch Manufacturing Packing created successfully");
            }
            else
                return redirect("add-batch-manufacturing-record#generate_label")->with('success', "Data Batch Manufacturing Packing created successfully");
        }
    }

    public function list_of_equipment()
    {
        $data['list_equipment'] = BatchManufacturingEquipment::select('batch_manufacturing_records_list_of_equipment.*', 'raw_materials.material_name')
            ->join('raw_materials', 'raw_materials.id', '=', 'batch_manufacturing_records_list_of_equipment.id')
            ->get();
        return view('list_of_equipment', $data);
    }
    public function add_batch_list_of_equipment()
    {
        return view('add_batch_list_of_equipment');
    }
    public function add_batch_equipment_insert(Request $request)
    {
        $arrRules = [
            "proName" => "required.",
            "bmrNo" => "required.",
            "batchNo" => "required",
            "refMfrNo" => "required",
            "EquipmentName" => "required",
            "EquipmentCode" => "required",
        ];
        $arrMessages = [
            "proName" => "This :attribute field is required.",
            "bmrNo" => "This :attribute field is required.",
            "batchNo" => "This :attribute field is required.",
            "refMfrNo" => "This :attribute field is required.",
            "EquipmentName" => "This :attribute field is required.",
            "EquipmentCode" => "This :attribute field is required.",
        ];
        // $validated = $request->validate($arrRules, $arrMessages);
        $arr['proName'] = $request->proName;
        $order_number = date('dyHs');
        $arr['order_id'] = $order_number;
        $arr['bmrNo'] = $request->bmrNo;
        $arr['batchNo'] = $request->batchNo;
        $arr['refMfrNo'] = $request->refMfrNo;
        $arr['Remark'] = $request->Remark;
        $arr['batch_id'] = $request->batch_id;
        $BatchManufacturing_id = BatchManufacturingEquipment::Create($arr);
        if ($BatchManufacturing_id->id) {
            foreach ($request->EquipmentName as $key => $value) {
                $a_data['EquipmentName'] = $value;
                $a_data['EquipmentCode'] = $request->EquipmentCode[$key];
                $a_data['batch_manufacturing_id'] = $BatchManufacturing_id->id;
                ListOfEquipmentManufacturing::Create($a_data);
            }

            $batch = BatchManufacture::find($request->batch_id);
            $batch->stage_4=1;
            $batch->save();
            if(isset($request->save_q))
            {

                return redirect("add-batch-manufacture")->with('success', " Data List Of Equipment created Successfully");
            }
            else
                return redirect("add-batch-manufacturing-record#addLots_listing")->with('success', "Data List Of Equipment created Successfully");
        } else {
            return redirect("add-batch-manufacturing-record#listOfEquipment")->with('error', " Something went wrong");
        }
    }

    public function list_of_equipment_edit($id)
    {
        $res = ListOfEquipmentManufacturing::where('batch_manufacturing_id', '=', $id)
            ->get();
        $res_data = BatchManufacturingEquipment::where('id', '=', $id)
            ->first();

        return view('list_of_equipment_edit', compact('res', $res, 'res_data', $res_data));
    }
    public function list_of_equipment_delete($id)
    {
        $data = BatchManufacturingEquipment::where('id', $id)->delete();
        if ($data) {
            return redirect('list-of-equipment')->with('danger', "Data Deleted successfully");
        }
    }

    public function list_of_equipment_update(Request $request)
    {
        $arr['proName'] = $request->proName;
        $order_number = date('dyHs');
        $arr['order_id'] = $order_number;
        $arr['bmrNo'] = $request->bmrNo;
        $arr['batchNo'] = $request->batchNo;
        $arr['refMfrNo'] = $request->refMfrNo;
        $arr['batch_id'] = $request->mainid;
        $arr['Remark'] = $request->Remark;
        $batchmanid = 0;
       if($request->id){
            $BatchManufacturing_id = BatchManufacturingEquipment::where('id', $request->id)->update($arr);
            $batchmanid =  $request->id;
        }
        else{

            $BatchManufacturing_id = BatchManufacturingEquipment::create($arr);
            $batchmanid =  $BatchManufacturing_id->id;
        }

        if ((isset($batchmanid)) && ($batchmanid > 0)) {

            if (count($request->EquipmentName)) {
                ListOfEquipmentManufacturing::where('batch_manufacturing_id', $batchmanid)->delete();
                foreach ($request->EquipmentName as $key => $value) {
                    $arr_data['EquipmentName'] = $value;
                    $arr_data['EquipmentCode'] = $request->EquipmentCode[$key];
                    $arr_data['batch_manufacturing_id'] = $batchmanid;
                    $result = ListOfEquipmentManufacturing::Create($arr_data);
                }
                $sequenceId = 1;
                if (isset($request->sequenceId)) {
                    $sequenceId = (int)$request->sequenceId + 2;
                }
                if ($result) {
                    $batch = BatchManufacture::find($request->mainid);
                    $batch->stage_4=1;
                    $batch->save();

                    if(isset($request->save_r))
                    {
                        $updreview = BatchManufacture::where('id', $request->mainid)->update(["is_review"=>Auth::user()->id,"reveivew_time"=>Carbon::now()]);
                    }
                    if(isset($request->save_app))
                    {
                        $updapproved = BatchManufacture::where('id', $request->mainid)->update(["is_aproved"=>Auth::user()->id,"aprroved_time"=>Carbon::now()]);
                    }
                    if(isset($request->save_q))
                    {
                        return redirect("add-batch-manufacture")->with('success', "  Batch  Data Update successfully");
                    }
                    else
                     return redirect("add_manufacturing_edit/" .$request->mainid. "/" . $sequenceId)->with(['success' => " Batch  Data Update successfully", 'nextdivsequence' => 90]);
                }
            }
        }
    }


    public function list_of_equipment_view(Request $request)
    {
        if ($request->ajax()) {

            $res = ListOfEquipmentManufacturing::select(
                'list_of_equipment_in_manufacturin_process.*'
            )
                ->where('list_of_equipment_in_manufacturin_process.batch_manufacturing_id', $request->id)
                ->get();
            $res_data = BatchManufacturingEquipment::select(
                'batch_manufacturing_records_list_of_equipment.*',
            )
                ->where('batch_manufacturing_records_list_of_equipment.id', $request->id)
                ->first();
        }

        return (['status' => true, 'res' => $res, 'res_data' => $res_data]);
    }
    public function line_clearance()
    {
        $data['BatchManufacturing'] = BatchManufacturingRecordsLine::select('batch_manufacturing_records_line_clearance_record.*', 'raw_materials.material_name')
            ->join('raw_materials', 'raw_materials.id', '=', 'batch_manufacturing_records_line_clearance_record.id')
            ->get();
        return view('line_clearance', $data);
    }
    public function add_line_clearance_record()
    {
        return view('add_line_clearance_record');
    }

    public function add_line_clearance_insert(Request $request)
    {

        $arrRules = [
            "proName" => "required",
            "batchNo" => "required",

            "Date" => "required",
            "EquipmentName.*" => "required",
            "Observation.*" => "required",
            "time.*" => "required",
        ];
        $arrMessages = [
            "proName" => "This :attribute field is required.",
            "bmrNo" => "This :attribute field is required.",
            "batchNo" => "This :attribute field is required.",
            "refMfrNo" => "This :attribute field is required.",
            "Date" => "This :attribute field is required.",
            "EquipmentName" => "This :attribute field is required.",
            "Observation" => "This :attribute field is required.",
            "time" => "This :attribute field is required.",
        ];

        $validated = $request->validate($arrRules, $arrMessages);
        $arr = array();
        $arr['proName'] = $request->proName;

        $order_number = date('dyHs');
        $arr['order_id'] = $order_number;
        $arr['batchNo'] = $request->batchNo;
        $arr['Date'] = $request->Date;
        $arr['Remark'] = $request->Remark;

        $BatchManufacturing_id = BatchManufacturingRecordsLine::Create($arr);
        if ($BatchManufacturing_id->id) {
            foreach ($request->EquipmentName as $key => $value) {
                $arr_data['EquipmentName'] = $value;
                $arr_data['Observation'] = $request->Observation[$key];
                $arr_data['time'] = $request->time[$key];
                $arr_data['line_clearance_id'] = $BatchManufacturing_id->id;
                LineClearance::Create($arr_data);
            }
            if (count($request->reactrosstatus)) {

                foreach ($request->reactrosstatus as $key => $value) {
                    $arr_data = array();
                    $arr_data['status_id'] = $value;
                    $arr_data['batch_name'] = $request->rBatch[$key];
                    $arr_data['date'] = $request->rdate[$key];
                    $arr_data['clearance_id'] = $BatchManufacturing_id->id;
                    $arr_data['created_by'] = Auth::user()->id;
                    $arr_data['batch_id'] = $request->batchNo;

                    ReactorsSatus::Create($arr_data);
                }

            }

            if(isset($request->save_q))
            {
                return redirect("add-batch-manufacture#listOfEquipment")->with('success', "  Data Line Clearance created successfully");
            }
            else
                return redirect('add-batch-manufacturing-record#listOfEquipment')->with('success', "Data Line Clearance created successfully");
        } else {
            return redirect('add-batch-manufacturing-record')->with('error', " Something went wrong");
        }
    }
    public function line_clearance_edit($id)
    {

        $res = LineClearance::where('line_clearance_id', '=', $id)
            ->get();
        $res_data = BatchManufacturingRecordsLine::where('id', '=', $id)
            ->first();

        return view('line_clearance_edit', compact('res', $res, 'res_data', $res_data));
    }
    public function line_clearance_update(Request $request)
    {

        $arr['proName'] = $request->proName;
        $arr['bmrNo'] = $request->bmrNo;
        $order_number = date('dyHs');
        $arr['order_id'] = $order_number;
        $arr['batchNo'] = $request->batchNo;

        $arr['Date'] = $request->Date;
        $arr['Remark'] = $request->Remark;
        $clearance_id = 0;
        DB::beginTransaction();
    try {
            if((isset($request->clearance_id)) && ($request->clearance_id > 0))
            {
                $BatchManufacturing_id = BatchManufacturingRecordsLine::where('id', $request->clearance_id)->update($arr);
                $clearance_id  = $request->clearance_id;
            }
            else
            {
                $BatchManufacturing_id = BatchManufacturingRecordsLine::create($arr);
                $clearance_id  = $BatchManufacturing_id->id;
            }


            $sequenceId = 1;
            if (isset($request->sequenceId)) {
                $sequenceId = (int)$request->sequenceId + 2;
            }

            if ((isset($clearance_id)) && ($clearance_id > 0)) {

                if (count($request->EquipmentName)) {
                    LineClearance::where('line_clearance_id', $clearance_id)->delete();
                    foreach ($request->EquipmentName as $key => $value) {
                        $arr_data['EquipmentName'] = $value;
                        $arr_data['Observation'] = $request->Observation[$key];
                        $arr_data['time'] = $request->time[$key];
                        $arr_data['line_clearance_id'] = $clearance_id;

                        LineClearance::Create($arr_data);
                    }

                }

                if (count($request->reactrosstatus)) {
                    ReactorsSatus::where('clearance_id', $clearance_id)->delete();
                    foreach ($request->reactrosstatus as $key => $value) {
                        $arr_data = array();
                        $arr_data['status_id'] = $value;
                        $arr_data['batch_name'] = $request->rBatch[$key];
                        $arr_data['date'] = $request->rdate[$key];
                        $arr_data['clearance_id'] = $clearance_id;
                        $arr_data['created_by'] = Auth::user()->id;
                        $arr_data['batch_id'] = $request->batchNo;

                        ReactorsSatus::Create($arr_data);
                    }

                }
                 DB::commit();
                if(isset($clearancid))
                {
                    return redirect("add_manufacturing_edit/".$request->batchNo."/".$sequenceId)->with('success', " Data update successfully");
                }
                else
                    return redirect('add_manufacturing_edit/'.$request->batchNo."/".$sequenceId)->with('message', "Data update successfully");
                /*if(isset($request->save_r))
                {
                    $updreview = BatchManufacture::where('id', $request->batchNo."/".$sequenceId)->update(["is_review"=>Auth::user()->id,"reveivew_time"=>Carbon::now()]);
                }
                if(isset($request->save_app))
                {
                    $updapproved = BatchManufacture::where('id', $request->batchNo."/".$sequenceId)->update(["is_aproved"=>Auth::user()->id,"aprroved_time"=>Carbon::now()]);
                }
                return redirect('add_manufacturing_edit/'.$request->batchNo."/".$sequenceId)->with('error', "Invalid Data");*/
            } else {
                DB::rollback();
                return redirect('add_manufacturing_edit/'.$request->batchNo."/".$sequenceId)->with('error', "Something went wrong");
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('add_manufacturing_edit/'.$request->batchNo."/".$sequenceId)->with('error', "Something went wrong");
        }
    }

    public function line_clearance_view(Request $request)
    {
        if ($request->ajax()) {

            $res = BatchManufacturingRecordsLine::select(
                'batch_manufacturing_records_line_clearance_record.*',
                'line_clearance_record.*'
            )
                ->join('line_clearance_record', 'line_clearance_record.line_clearance_id', '=', 'batch_manufacturing_records_line_clearance_record.id')
                ->where('line_clearance_record.line_clearance_id', $request->id)
                ->get();
            $res_data = BatchManufacturingRecordsLine::select(
                'batch_manufacturing_records_line_clearance_record.*',
                'line_clearance_record.*'
            )
                ->join('line_clearance_record', 'line_clearance_record.line_clearance_id', '=', 'batch_manufacturing_records_line_clearance_record.id')
                ->where('line_clearance_record.line_clearance_id', $request->id)
                ->first();
        }

        return (['status' => true, 'res' => $res, 'res_data' => $res_data]);
    }


    public function packing_material_issuel_insert(Request $request)
    {
        if (isset($request->from)) {
            $request->session()->put('from', $request->from);
            $request->session()->put('to', $request->to);
        }
        $arrRules = [
            "from" => "required",
            "to" => "required",
            "batchNo" => "required",
            "Date" => "required",
            "PackingMaterialName" => "required",
            "Capacity" => "required",
            "Quantity" => "required",
            "arNo" => "required",
            "ARDate" => "required",
            "doneBy" => "required",
            "checkedBy" => "required",
        ];
        $arrMessages = [
            "from" => "This :attribute field is required.",
            "to" => "This :attribute field is required.",
            "batchNo" => "This :attribute field is required.",
            "Date" => "This :attribute field is required.",
            "PackingMaterialName" => "This :attribute field is required.",
            "Capacity" => "This :attribute field is required.",
            "Quantity" => "This :attribute field is required.",
            "arNo" => "This :attribute field is required.",
            "ARDate" => "This :attribute field is required.",
            "doneBy" => "This :attribute field is required.",
            "checkedBy" => "This :attribute field is required.",
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
                $a_data['ARDate'] = $request->ARDate[$key];
                $a_data['packingmaterial_id'] = $packingmaterial_id->id;
                MaterialDetails::Create($a_data);
            }
            if(isset($request->save_q))
            {
                return redirect("add-batch-manufacture")->with('success', "Packing Material created Successfully");
            }
            else
                return redirect("add-batch-manufacturing-record#billOfRawMaterialpacking")->with('success', "Packing Material created Successfully");
        } else {
            return redirect("add-batch-manufacturing-record#issualofrequisitionpacking")->with('error', " Something went wrong");
        }
    }
    public function packing_material_requisition_slip_insert_packing(Request $request)
    {
        if (isset($request->from)) {
            $request->session()->put('from', $request->from);
            $request->session()->put('to', $request->to);
        }

        $arrRules = [
            "from" => "required",
            "to" => "required",
            "batchNo" => "required",
            "Date" => "required",
            "checkedBy" => "required",
            "ApprovedBy" => "required",
            "Remark" => "required",
            "rawMaterialName.*" => "required|array",
            "Quantity.*" => "required|array",
            "batch_id" => "required",
        ];
        $arrMessages = [

            "from" => "This :attribute field is required.",
            "to" => "This :attribute field is required.",
            "batchNo" => "This :attribute field is required.",
            "Date" => "This :attribute field is required.",
            "checkedBy" => "This :attribute field is required.",
            "ApprovedBy" => "This :attribute field is required.",
            "Remark" => "This :attribute field is required.",
            "rawMaterialName.required" => "This :attribute field is required.",

            "Quantity.required" => "This :attribute field is required.",
            "batch_id" => "This :attribute field is required.",
        ];
        //$validateData = $request->validate($arrRules, $arrMessages);
        $nextForm = '';
        $nextForm = $request->nextForm;
        $request->nextForm = '';
        $arr['from'] = $request->from;
        $arr['to'] = $request->to;
        $arr['batchNo'] = $request->batchNo;
        $arr['Date'] = $request->Date;
        $order_number = date('dyHs');
        $arr['order_id'] = $order_number;
        $arr['checkedBy'] =  $request->checkedBy;
        $arr['ApprovedBy'] =  0;
        $arr['Remark'] = $request->Remark;
        $arr['batch_id'] = $request->batch_id;
        $arr['type'] = "P";
        $RequisitionSlip_id = RequisitionSlip::Create($arr);

        if ($RequisitionSlip_id->id) {
            foreach ($request->PackingMaterialName as $key => $value) {
                $arr_data['PackingMaterialName'] = $value;
                if (isset($request->Capacity))
                    $arr_data['Capacity'] = $request->Capacity[$key];
                $arr_data['Quantity'] = $request->Quantity[$key];
                $arr_data['requisition_id'] = $RequisitionSlip_id->id;
                $arr_data['type'] = "P";
                DetailsRequisition::Create($arr_data);
            }
            $batch = BatchManufacture::find($request->batch_id);
                $batch->stage_3=1;
                $batch->save();
            if(isset($request->save_q))
            {

                return redirect("add-batch-manufacture")->with('success', "Raw Matrial Of Requisition done successfully");
            }
            else
                return redirect('add-batch-manufacturing-record#issualofrequisitionpacking')->with('success', "Raw Matrial Of Requisition done successfully");
        } else {
            return redirect('add-batch-manufacturing-record#requisitionpacking')->with('error', "Something went wrong");
        }
    }
    public function packing_material_requisition_slip_insert(Request $request)
    {
        if (isset($request->from)) {
            $request->session()->put('from', $request->from);
            $request->session()->put('to', $request->to);
        }

        $arrRules = [
            "from" => "required",
            "from" => "required",
            "to" => "required",
            "batchNo" => "required",
            "Date" => "required",
            "checkedBy" => "required",
            "ApprovedBy" => "required",
            "Remark" => "required",
            "rawMaterialName.*" => "required|array",
            "Quantity.*" => "required|array",
            "batch_id" => "required",
        ];
        $arrMessages = [

            "from" => "This :attribute field is required.",
            "to" => "This :attribute field is required.",
            "batchNo" => "This :attribute field is required.",
            "Date" => "This :attribute field is required.",
            "checkedBy" => "This :attribute field is required.",
            "ApprovedBy" => "This :attribute field is required.",
            "Remark" => "This :attribute field is required.",
            "rawMaterialName.required" => "This :attribute field is required.",

            "Quantity.required" => "This :attribute field is required.",
            "batch_id" => "This :attribute field is required.",
        ];
        //$validateData = $request->validate($arrRules, $arrMessages);
        $arr['from'] = $request->from;
        $arr['to'] = $request->to;
        $arr['batchNo'] = $request->batchNo;
        $arr['Date'] = $request->Date;
        $order_number = date('dyHs');
        $arr['order_id'] = $order_number;
        $arr['checkedBy'] =  $request->checkedBy;
        $arr['ApprovedBy'] = 0;
        $arr['Remark'] = $request->Remark;
        $arr['batch_id'] = $request->batch_id;
        $arr['type'] = "R";
        $RequisitionSlip_id = RequisitionSlip::Create($arr);

        if ($RequisitionSlip_id->id) {
            foreach ($request->rawMaterialName as $key => $value) {
                $arr_data['PackingMaterialName'] = $value;
                if (isset($request->Capacity))
                    $arr_data['Capacity'] = $request->Capacity[$key];
                $arr_data['Quantity'] = $request->Quantity[$key];
                $arr_data['requisition_id'] = $RequisitionSlip_id->id;
                $arr_data['type'] = "R";
                DetailsRequisition::Create($arr_data);
            }
            $batch = BatchManufacture::find($request->batch_id);
                $batch->stage_2=1;
                $batch->save();
            if(isset($request->save_q))
            {

                return redirect("add-batch-manufacture")->with('success', "Raw Matrial Of Requisition done successfully");
            }
            else
                return redirect('add-batch-manufacturing-record#issualofrequisition')->with('success', "Raw Material Of Requisition done successfully");
        } else {
            return redirect('add-batch-manufacturing-record#requisition')->with('error', "Something went wrong");
        }
    }
    public function packing_material_requisition_slip_update(Request $request)
    {

        //$request->PackingMaterialName = (int)$request->PackingMaterialName;
        $arr['from'] = $request->from;
        $arr['to'] = $request->to;
        $arr['batchNo'] = $request->batchNo;
        $arr['Date'] = $request->Date;
        $order_number = date('dyHs');
        $arr['order_id'] = $order_number;
        $arr['checkedBy'] =  $request->checkedBy;
        $arr['ApprovedBy'] =  $request->ApprovedBy;
        $arr['Remark'] = $request->Remark;
        $arr['batch_id'] = $request->mainid;
        $arr['type'] = "R";
        $reqid = 0;
        if(isset($request->id) && $request->id)
        {
            $RequisitionSlip_id = RequisitionSlip::where('id', $request->id)->update($arr);
            $reqid = $request->id;
        }
        else
        {
            $RequisitionSlip_id = RequisitionSlip::create($arr);
            $reqid = $RequisitionSlip_id->id;
        }
        if ((isset($reqid)) && ($reqid > 0)) {
            if (count($request->PackingMaterialName)) {
                DetailsRequisition::where('requisition_id', $reqid)->delete();
                foreach ($request->PackingMaterialName as $key => $value) {
                    $arr_data['PackingMaterialName'] = $value;
                    $arr_data['Quantity'] = $request->Quantity[$key];
                    $arr_data['requisition_id'] = $reqid;
                    $arr_data['type'] = "R";
                    $result = DetailsRequisition::Create($arr_data);
                }

                $sequenceId = 1;
                if (isset($request->sequenceId)) {
                    $sequenceId = (int)$request->sequenceId + 1;
                }
                if ($result) {
                    $batch = BatchManufacture::find($request->mainid);
                    $batch->stage_2=1;
                    $batch->save();

                    if(isset($request->save_r))
                    {
                        $updreview = BatchManufacture::where('id', $request->mainid)->update(["is_review"=>Auth::user()->id,"reveivew_time"=>Carbon::now()]);
                    }
                    if(isset($request->save_app))
                    {
                        $updapproved = BatchManufacture::where('id', $request->mainid)->update(["is_aproved"=>Auth::user()->id,"aprroved_time"=>Carbon::now()]);
                    }

                    if(isset($request->save_q))
                    {

                        return redirect("add-batch-manufacture")->with('success', "Batch  Data Update successfully");
                    }
                    else
                        return redirect("add_manufacturing_edit/" . $request->mainid . "/6")->with(['success' => " Batch  Data Update successfully", 'nextdivsequence' => 90]);
                }
            }
            return redirect('add_manufacturing_edit#issualofrequisition')->with('error', "Invalid Data");
        } else {
            return redirect('add_manufacturing_edit#issualofrequisition')->with('error', "Something went wrong");
        }
    }
    public function bill_of_raw_material_packing_update(Request $request)
    {
        $arr['proName'] = $request->proName;
        $arr['bmrNo'] = $request->bmrNo;
        $arr['batchNoI'] = $request->batchNoI;
        $arr['refMfrNo'] = $request->refMfrNo;
        $order_number = date('dyHs');
        $arr['order_id'] = $order_number;
        $arr['doneBy'] = $request->doneBy;
        $arr['checkedBy'] = $request->checkedBy;
        $arr['Remark'] = $request->Remark;
        $arr['is_active'] = 1;
        $arr['is_delete'] = 1;

        $BillOfRwaMaterial_id = BillOfRwaMaterial::where('id', $request->id)->update($arr);

        if ((isset($request->id)) && ($request->id > 0)) {

            if (count($request->rawMaterialName)) {
                BillOfRawMaterialsDetails::where('bill_of_raw_material_id', $request->id)->delete();
                foreach ($request->rawMaterialName as $key => $value) {
                    $arr_data['rawMaterialName'] = $value;
                    $arr_data['batchNo'] = $request->batchNo[$key];
                    $arr_data['Quantity'] = $request->Quantity[$key];
                    $arr_data['arNo'] = $request->arNo[$key];
                    $arr_data['date'] = $request->date[$key];
                    $arr_data['bill_of_raw_material_id'] = $request->id;
                    $result = BillOfRawMaterialsDetails::Create($arr_data);
                }

                $sequenceId = 1;
                if (isset($request->sequenceId)) {
                    $sequenceId = (int)$request->sequenceId + 2;
                }
                if ($result) {
                    if(isset($request->save_q))
                    {
                        return redirect("add-batch-manufacture")->with('success', "Batch  Data Update successfully");
                    }
                    else
                        return redirect("add_manufacturing_edit/" . $request->id . "/" . $sequenceId)->with(['success' => " Batch  Data Update successfully", 'nextdivsequence' => 90]);
                }
            }
        }
    }
    public function packing_material_requisition_slip_update_1(Request $request)
    {

        $arr['from'] = $request->from;
        $arr['to'] = $request->to;
        $arr['batchNo'] = $request->batchNo;
        $arr['Date'] = $request->Date;
        $order_number = date('dyHs');
        $arr['order_id'] = $order_number;
        $arr['checkedBy'] =  $request->checkedBy;
        $arr['ApprovedBy'] =  $request->ApprovedBy;
        $arr['Remark'] = $request->Remark;
        $arr['batch_id'] = $request->id;
        $arr['type'] = "P";

        $requstion_id = 0;

        if($request->packingid > 0){
            $RequisitionSlip_id = RequisitionSlip::where('id', $request->packingid)->update($arr);
            $requstion_id = $request->packingid;
        }
        else{
            $RequisitionSlip_id = RequisitionSlip::create($arr);
            $requstion_id = $RequisitionSlip_id->id;
        }


        if ((isset($request->id)) && ($request->id > 0)) {
            if (count($request->PackingMaterialName)) {
                DetailsRequisition::where('requisition_id', $request->id)->delete();
                foreach ($request->PackingMaterialName as $key => $value) {
                    $arr_data['PackingMaterialName'] = $value;
                    $arr_data['Capacity'] = $request->Capacity[$key];
                    $arr_data['Quantity'] = $request->Quantity[$key];
                    $arr_data['requisition_id'] = $requstion_id;
                    $arr_data['type'] = "P";

                    $result = DetailsRequisition::Create($arr_data);
                }
                $sequenceId = 1;
                if (isset($request->sequenceId)) {
                    $sequenceId = (int)$request->sequenceId + 2;
                }

                if ($result) {
                    $batch = BatchManufacture::find($request->id);
                    $batch->stage_3=1;
                    $batch->save();
                    if(isset($request->save_r))
                    {
                        $updreview = BatchManufacture::where('id', $request->id)->update(["is_review"=>Auth::user()->id,"reveivew_time"=>Carbon::now()]);
                    }
                    if(isset($request->save_app))
                    {
                        $updapproved = BatchManufacture::where('id', $request->id)->update(["is_aproved"=>Auth::user()->id,"aprroved_time"=>Carbon::now()]);
                    }
                    if(isset($request->save_q))
                    {

                        return redirect("add-batch-manufacture")->with('success', "Batch  Data Update successfully");
                    }
                    else
                        return redirect("add_manufacturing_edit/" . $request->id . "/6")->with(['success' => " Batch  Data Update successfully", 'nextdivsequence' => 90]);
                }
            }
        }
    }
    public function packing_material_issuel_insert_update(Request $request)
    {

        $arr['from'] = $request->from;
        $order_number = date('dyHs');
        $arr['order_id'] = $order_number;
        $arr['to'] = $request->to;
        $arr['batchNo'] = $request->batchNo;
        $arr['Date'] = $request->Date;
        $arr['doneBy'] = $request->doneBy;
        $arr['checkedBy'] = $request->checkedBy;
        $PackingMaterialSlip = PackingMaterialSlip::where('id', $request->id)->update($arr);


        if ((isset($request->id)) && ($request->id > 0)) {
            if (count($request->PackingMaterialName)) {
                MaterialDetails::where('packingmaterial_id', $request->id)->delete();
                foreach ($request->PackingMaterialName as $key => $value) {
                    $arr_data['PackingMaterialName'] = $value;
                    $arr_data['Capacity'] = $request->Capacity[$key];
                    $arr_data['Quantity'] = $request->Quantity[$key];
                    $arr_data['arNo'] = $request->arNo[$key];
                    $arr_data['ARDate'] = $request->ARDate[$key];
                    $arr_data['packingmaterial_id'] = $request->id;
                    $arr_data['type'] = "R";
                    $result = MaterialDetails::Create($arr_data);
                }


                $sequenceId = 1;

                if (isset($request->sequenceId)) {
                    $sequenceId = (int)$request->sequenceId + 2;
                }
                if ($result) {
                    if(isset($request->save_q))
                    {
                        return redirect("add-batch-manufacture")->with('success', "Batch  Data Update successfully");
                    }
                    else
                        return redirect("add_manufacturing_edit/" . $request->id . "/" . $sequenceId)->with(['success' => " Batch  Data Update successfully", 'nextdivsequence' => 90]);
                }
            }
        }
    }
    public function add_manufacturing_packing_update(Request $request)
    {

        $data = [
            "proName" => $request['proName'],
            "bmrNo" => $request['bmrNo'],
            "batchNo" => $request['batchNo'],
            "refMfrNo" => $request['refMfrNo'],
            "ManufacturerDate" => $request['ManufacturerDate'],
            "Observation" => $request['Observation'],
            "Temperature" => $request['Temperature'],
            "Humidity" => $request['Humidity'],
            "TemperatureP" => $request['TemperatureP'],
            "50kgDrums" => $request['50kgDrums'],
            "20kgDrums" => $request['20kgDrums'],
            "30kgDrums" => $request['30kgDrums'],
            "5kgDrums"=> $request['5kgDrums'],
            "NoOfBags"=> $request['NoOfBags'],
            "startTime" => $request['startTime'],
            "EndstartTime" => $request['EndstartTime'],
            "areaCleanliness" => $request['areaCleanliness'],
            "CareaCleanliness" => $request['CareaCleanliness'],
            "rmInput" => $request['rmInput'],
            "fgOutput" => $request['fgOutput'],
            "filledDrums" => $request['filledDrums'],
            "excessFilledDrums" => $request['excessFilledDrums'],
            "qcsampling" => $request['qcsampling'],
            "StabilitySample" => $request['StabilitySample'],
            "WorkingSlandered" => $request['WorkingSlandered'],
            "ValidationSample" => $request['ValidationSample'],
            "CustomerSample" => $request['CustomerSample'],
            "ActualYield" => $request['ActualYield'],
            "checkedBy" =>  $request['CareaCleanliness'], //$request['checkedBy'],
            "ApprovedBy" => Auth::user()->id,
            "Remark" => $request['Remark'],
            "batch_id"=>$request['mainid'],
            "total_sampling"=>$request['totalsampling']

        ];
       // dd($data);
        if(isset($request->id) && $request->id)
        {
            $result = BatchManufacturingPacking::where('id', $request->id)->update($data);
        }
        else
        {
            $result = BatchManufacturingPacking::create($data);
        }


        $sequenceId = 1;
        if (isset($request->sequenceId)) {
            $sequenceId = (int)$request->sequenceId + 1;
        }
        if ($result) {
            $batch = BatchManufacture::find($request->mainid);
            $batch->stage_7=1;
            $batch->save();
            if(isset($request->save_r))
            {
                $updreview = BatchManufacture::where('id', $request->mainid)->update(["is_review"=>Auth::user()->id,"reveivew_time"=>Carbon::now()]);
            }
            if(isset($request->save_app))
            {
                $updapproved = BatchManufacture::where('id', $request->mainid)->update(["is_aproved"=>Auth::user()->id,"aprroved_time"=>Carbon::now()]);
            }
            if(isset($request->save_q))
            {
                return redirect("add-batch-manufacture")->with('success', "Batch  Data Update successfully");
            }
            else
                return redirect("add_manufacturing_edit/" . $request['mainid'] . "/" . $sequenceId)->with(['success' => " Batch  Data Update successfully", 'nextdivsequence' => 90]);
        }
    }
    public function add_manufacturing_packing_ganerate_update(Request $request)
    {

        $data = [
            "proName" => $request['proName'],
            "bmrNo" => $request['bmrNo'],
            "batchNo" => $request['batchNo'],
            "refMfrNo" => $request['refMfrNo'],
            "ManufacturerDate" => $request['ManufacturerDate'],
            "Observation" => $request['Observation'],
            "Temperature" => $request['Temperature'],
            "Humidity" => $request['Humidity'],
            "TemperatureP" => $request['TemperatureP'],
            "50kgDrums" => $request['50kgDrums'],
            "20kgDrums" => $request['20kgDrums'],
            "startTime" => $request['startTime'],
            "EndstartTime" => $request['EndstartTime'],
            "areaCleanliness" => Auth::user()->id,
            "CareaCleanliness" => Auth::user()->id,
            "rmInput" => $request['rmInput'],
            "fgOutput" => $request['fgOutput'],
            "filledDrums" => $request['filledDrums'],
            "excessFilledDrums" => $request['excessFilledDrums'],
            "qcsampling" => $request['qcsampling'],
            "StabilitySample" => $request['StabilitySample'],
            "WorkingSlandered" => $request['WorkingSlandered'],
            "ValidationSample" => $request['ValidationSample'],
            "CustomerSample" => $request['CustomerSample'],
            "ActualYield" => $request['ActualYield'],
            "checkedBy" =>$request['checkedBy'],
            "ApprovedBy" => $request['ApprovedBy'],
            "Remark" => $request['Remark'],
            "batch_id"=>$request['mainid']

        ];
        if(isset($request->id) && $request->id)
        {
            $result = BatchManufacturingPacking::where('id', $request->id)->update($data);
        }
        else
        {
            $result = BatchManufacturingPacking::create($data);
        }


        if ($result) {
            if(isset($request->save_q))
            {
                return redirect("add-batch-manufacture")->with('success', "Batch  Data Update successfully");
            }
            else
                return redirect("add-batch-manufacture")->with(['success' => " Batch  Data Update successfully", 'nextdivsequence' => 90]);
        }
    }

    public function add_batch_lots(Request $request)
    {

        $prvCount = AddLotsl::where('batchNo', $request->batchNo)->count('id');
        if ($prvCount > 10) {
            return ['message' => 'Already Have 10 lots Records'];       }



        $arr['proName'] = $request->proName;
        $arr['bmrNo'] = $request->bmrNo;
        $arr['batchNo'] = $request->batchNo;
        $arr['refMfrNo'] = $request->refMfrNo;
        $order_number = date('dyHs');
        $arr['order_id'] = $order_number;
        $arr['Date'] = $request->Date;
        $arr['lotNo'] = $request->lotNo;
        $arr['ReactorNo'] = $request->ReactorNo;
        $arr['batch_id'] = $request->batch_id;
        $arr['Process_date'] = $request->Process_date;
        $AddLotsl = AddLotsl::Create($arr);
        $batch = BatchManufacture::find($request->batch_id);

        $batch->stage_5=1;
        $batch->save();
        if ((isset($AddLotsl->id)) && ($AddLotsl->id > 0)) {
            $prvCount = ($prvCount == 0) ? 1 : $prvCount;
            (int)$prvCount++;
            if(empty($request->MaterialName))
            {
                return redirect("add-batch-manufacture")->with('error', "Something went wrong. Please check.");
            }
            if (count($request->MaterialName)) {
                foreach ($request->MaterialName as $key => $value) {
                    $arr_data['MaterialName'] = $value;
                    $arr_data['rmbatchno'] = $request->rmbatchno[$key];
                    $arr_data['Quantity'] = $request->Quantity[$key];
                    $arr_data['add_lots_id'] = $AddLotsl->id;
                    AddLotslRawMaterialDetails::Create($arr_data);
                }
                if ((isset($AddLotsl->id)) && ($AddLotsl->id > 0)) {
                    foreach ($request->qty as $key => $value) {

                        if (count($request->qty)) {

                            foreach ($request->qty as $key => $value) {
                                $arr_data['qty'] = $value;
                                $arr_data['temp'] = $request->temp[$key];
                                $arr_data['stratTime'] = $request->stratTime[$key];
                                $arr_data['endTime'] = $request->endTime[$key];
                                $arr_data['doneby'] = $request->doneby[$key];
                                $arr_data['lot_id'] = $AddLotsl->id;
                                $arr_data['process_id'] = $key+1;
                                $result = Processlots::Create($arr_data);
                            }if ($result) {
                                if ($prvCount == 10) {
                                    if(isset($request->save_q))
                                    {
                                        return redirect("add-batch-manufacture")->with('success', "Batch  Data Update successfully");
                                    }
                                    else
                                        return redirect('add-batch-manufacturing-record#addLots_listing')->with(['success' => "Lots added successfully", "prvCount" => $prvCount]);
                                } else {
                                    if(isset($request->save_q))
                                    {
                                        return redirect("add-batch-manufacture")->with('success', "Batch  Data Update successfully");
                                    }
                                    else
                                        return redirect('add-batch-manufacturing-record#addLots_listing')->with(['success' => "Lots added successfully", "prvCount" => $prvCount]);
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    public function add_lots_update(Request $request)
    {
        //validate approved_qty is less 
       
            if (count($request->prod_d_id)) { 
                foreach ($request->prod_d_id as $key => $value) {
                    $app_qty = Requisitionissuedmaterialdetails::select('approved_qty')->where('id', $value)->first();                    
                    if($app_qty->approved_qty < $request->Quantity[$key]){
                        return redirect("add_manufacturing_edit/" . $request->mainid)->with('error', "Quantity must less than or equal to Approved Quantity.");
                    }
                }
            }
       

        $arr['proName'] = $request->proName;
        $arr['bmrNo'] = $request->bmrNo;
        $arr['batchNo'] = $request->batchNo;
        $arr['refMfrNo'] = $request->refMfrNo;
        $order_number = date('dyHs');
        $arr['order_id'] = $order_number;
        $arr['Date'] = $request->Date;
      // dd("exit");
        if($request->lotNo)
            $arr['lotNo'] = $request->lotNo;
        else
        {
           
            $lotno = AddLotsl::select(DB::raw("max(lotNo) as lotno"))->where('id', $request->id)->first();
            if(isset($lotno) && $lotno)
            {
                $arr['lotNo'] = $lotno->lotno+1;
            }
            else
            {
                $arr['lotNo'] = 1;
            }
        }
        $arr['ReactorNo'] = $request->ReactorNo;
        $arr['Process_date'] = $request->Process_date;
        $arr['batch_id'] = $request->mainid;
        $lotsid = 0;
      
        /*if(isset($request->id) && $request->id){
            $AddLotsl = AddLotsl::where('id', $request->id)->update($arr);
            $lotsid = $request->id;
        }
        else{*/
            $AddLotsl = AddLotsl::create($arr);
            $lotsid = $AddLotsl->id;
           // dd($request->all());
        /*}*/
        if(empty($request->MaterialName))
        {
            return redirect("add-batch-manufacture")->with('error', "Something went wrong. Please check.");
        }

        if ((isset($lotsid)) && $lotsid) {
            if (count($request->MaterialName)) {
                AddLotslRawMaterialDetails::where('add_lots_id', $lotsid)->delete();
                foreach ($request->MaterialName as $key => $value) {
                    $arr_data['MaterialName'] = $value;
                    $arr_data['rmbatchno'] = $request->rmbatchno[$key];
                    $arr_data['Quantity'] = $request->Quantity[$key];
                    $arr_data['add_lots_id'] = $lotsid; 
                    $req = Requisitionissuedmaterialdetails::find($request->prod_d_id[$key]);
                    $arr_data['req_detail_id'] = $request->prod_d_id[$key];
                    Requisitionissuedmaterialdetails::where('id', $request->prod_d_id[$key])->update(["used_qty"=> $req->used_qty + $arr_data['Quantity']]);
                    AddLotslRawMaterialDetails::Create($arr_data);
                    $stockless = array();
                    $stock = Stock::where("matarial_id",$value)->where("batch_no",$request->rmbatchno[$key])->first();
                    if(isset($stock) && $stock)
                    {
                        $st = Stock::find($stock->id);
                        $stockless["used_qty"] = $st->used_qty + $request->Quantity[$key];
                        $st->update($stockless);  
                    }


                }

                if ((isset($lotsid)) && ($lotsid > 0)) {
                    foreach ($request->qty as $key => $value) {
                        Processlots::where('lot_id', $lotsid)->delete();

                        if (count($request->qty)) {
                            foreach ($request->qty as $key => $value) {
                                $arr_data['qty'] = $value;
                                $arr_data['temp'] = $request->temp[$key];
                                $arr_data['stratTime'] = $request->stratTime[$key];
                                $arr_data['endTime'] = $request->endTime[$key];
                                $arr_data['doneby'] = $request->doneby[$key];
                                $arr_data['lot_id'] = $lotsid;
                                $arr_data['process_id'] = $request->processName[$key];
                                $result = Processlots::Create($arr_data);
                            }

                            $sequenceId = 1;
                            if (isset($request->sequenceId)) {
                                $sequenceId = (int)$request->sequenceId + 1;
                            }
                            if ($result) {
                                $batch = BatchManufacture::find($request->mainid);

                                $batch->stage_5=1;
                                $batch->save();
                                if(isset($request->save_r))
                                {
                                        $updreview = BatchManufacture::where('id', $request->mainid)->update(["is_review"=>Auth::user()->id,"reveivew_time"=>Carbon::now()]);
                                }
                                if(isset($request->save_app))
                                {
                                    $updapproved = BatchManufacture::where('id', $request->mainid)->update(["is_aproved"=>Auth::user()->id,"aprroved_time"=>Carbon::now()]);
                                }
                                if(isset($request->save_q))
                                {
                                    return redirect("add-batch-manufacture")->with('success', "Batch  Data Update successfully");
                                }
                                else
                                    return redirect("add_manufacturing_edit/" . $request->mainid . "/" . $sequenceId)->with(['success' => " Batch  Data Update successfully", 'nextdivsequence' => 90]);
                            }
                        }
                    }
                }
            }
        }
    }
    public function homogenizing_insert(Request $request)
    {
        $arrRules = [
            "proName" => "required",
            "bmrNo" => "required",
            "batchNo" => "required",
            "refMfrNo" => "required",
            "Observedvalue" => "required",
            "homoTank" => "required",
            "dateProcess" => "required",
            "qty" => "required",
            "endTime" => "required",
            "stratTime" => "required",
        ];
        $arrMessages = [

            "proName" => "This :attribute field is required.",
            "bmrNo" => "This :attribute field is required.",
            "batchNo" => "This :attribute field is required.",
            "refMfrNo" => "This :attribute field is required.",
            "Observedvalue" => "This :attribute field is required.",
            "homoTank" => "This :attribute field is required.",
            "dateProcess" => "This :attribute field is required.",
            "qty" => "This :attribute field is required.",
            "endTime" => "This :attribute field is required.",
            "stratTime" => "This :attribute field is required.",
        ];
        //$validateData = $request->validate($arrRules, $arrMessages);

        $arr['proName'] = $request->proName;
        $arr['bmrNo'] = $request->bmrNo;
        $arr['batchNo'] = $request->batchNo;
        $arr['refMfrNo'] = $request->refMfrNo;
        $order_number = date('dyHs');
        $arr['order_id'] = $order_number;
        $arr['homoTank'] = $request->homoTank;
        $arr['Observedvalue'] = $request->Observedvalue;
        $arr['homoTank'] = $request->homoTank;
        $arr['batch_id'] = $request->batch_id;
        $Homogenizing_id = Homogenizing::Create($arr);

        if ($Homogenizing_id->id) {
            foreach ($request->dateProcess as $key => $value) {
                $arr_data['dateProcess'] = $value;
                $arr_data['qty'] = $request->qty[$key];
                $arr_data['stratTime'] = $request->stratTime[$key];
                $arr_data['lots_name'] = $request->lot[$key];
                $arr_data['endTime'] = $request->endTime[$key];
                $arr_data['doneby'] =  \Auth::user()->id;
                $arr_data['homogenizing_id'] = $Homogenizing_id->id;
                HomogenizingList::Create($arr_data);
            }
            $batch = BatchManufacture::find($request->batch_id);
            $batch->stage_6=1;
            $batch->save();
            if(isset($request->save_q))
            {

                return redirect("add-batch-manufacture")->with('success', "Batch  Data Update successfully");
            }
            else
                return redirect('add-batch-manufacturing-record#Packing')->with('success', "Raw Materrila Of Requisition done successfully");
        } else {
            return redirect('add-batch-manufacturing-record')->with('error', "Something went wrong");
        }
    }
    public function homogenizing_update(Request $request)
    {


        $arr['proName'] = $request->proName;
        $arr['bmrNo'] = $request->bmrNo;
        $arr['batchNo'] = $request->batchNo;
        $arr['refMfrNo'] = $request->refMfrNo;
        $order_number = date('dyHs');
        $arr['order_id'] = $order_number;
        $arr['homoTank'] = $request->homoTank;
        $arr['Observedvalue'] = $request->Observedvalue;
        $arr['homoTank'] = $request->homoTank;
        $arr['batch_id'] = $request->mainid;
        $arr['proecess_check'] = $request->proecess_check;
        $homeid = 0;
        /*if(isset($request->id))
        {
            $Homogenizing_id = Homogenizing::where('id', $request->id)->update($arr);
            $homeid = $request->id;
        }
        else
        {*/
            $Homogenizing_id = Homogenizing::create($arr);
            $homeid = $Homogenizing_id->id;
       /* }*/


        if ((isset($homeid)) && ($homeid > 0)) {
            if (count($request->dateProcess)) {
                HomogenizingList::where('homogenizing_id', $homeid)->delete();
              foreach ($request->dateProcess as $key => $value) {
                    $arr_data['dateProcess'] = $value;
                    $arr_data['qty'] = $request->qty[$key];
                    $arr_data['stratTime'] = $request->stratTime[$key];
                    $arr_data['endTime'] = $request->endTime[$key];
                    $arr_data['lots_name'] = $request->lot[$key];
                    $arr_data['homogenizing_id'] = $homeid;
                    $arr_data['doneby'] = Auth::user()->id;
                    $result=HomogenizingList::Create($arr_data);

                    $lotsarray = array();
                    $lotsarray["homogenize_done"]=1;
                    $lotsarray["homogenize_date"]=\Carbon\Carbon::now();;
                    if(isset($request->lotsid[$key]) && $request->lotsid[$key] >0)
                        $lots = AddLotsl::where("id",$request->lotsid[$key])->update($lotsarray);

                }

                 $sequenceId = 1;
                if (isset($request->sequenceId)) {
                    $sequenceId = (int)$request->sequenceId + 1;
                }

                if ($result) {
                    $batch = BatchManufacture::find($request->mainid);
                    $batch->stage_6=1;
                    $batch->save();

                    if(isset($request->save_r))
                    {
                        $updreview = BatchManufacture::where('id', $request->mainid)->update(["is_review"=>Auth::user()->id,"reveivew_time"=>Carbon::now()]);
                    }
                    if(isset($request->save_app))
                    {
                        $updapproved = BatchManufacture::where('id', $request->mainid)->update(["is_aproved"=>Auth::user()->id,"aprroved_time"=>Carbon::now()]);
                    }
                    if(isset($request->save_q))
                    {
                        $batch = BatchManufacture::find($request->mainid);
                        $batch->stage_6=1;
                        $batch->save();
                        return redirect("add-batch-manufacture")->with('success', "Batch  Data Update successfully");
                    }
                    else
                        return redirect("add_manufacturing_edit/" . $request->mainid . "/" . $sequenceId)->with(['success' => " Batch  Data Update successfully", 'nextdivsequence' => 90]);
                }
            }
        }
    }
    public function getequipmentcode(Request $request)
    {
        if($request->id)
        {
            $code = DB::table("equipment_code")->where("equipment_id",$request->id)->pluck("code","id");
            $data["code"] = $code;
            return response()->json($data);
        }
    }
    public function getbatchofmaterial(Request $request)
    {
        if($request->id)
        {
            $batchstock = Stock::select("inward_raw_materials_items.batch_no","stock.id")->where("department",3)->where(DB::raw("qty-stock.used_qty"),">",0)->join("raw_materials","raw_materials.id","stock.matarial_id")->join("inward_raw_materials_items","inward_raw_materials_items.id","stock.batch_no")->where("stock.material_type",'R')->where("stock.matarial_id",$request->id)->groupBy("stock.matarial_id")->pluck("batch_no","id");

            $data["batch"] = $batchstock;

            return response()->json($data);
        }
    }

    public function add_manufacturing_generate_label_insert( Request $request)
    {
        $arrRules = [
            "simethicone"=> "required",
            "batch_no_I"=> "required",
            "mfg_date"=> "required",
            "retest_date"=> "required",
            "net_wt"=> "required",
            "tare_wt"=> "required",
            "Remark"=> "required",

        ];
        $arrMessages = [

            "simethicone"=> "This :attribute field is required.",
            "batch_no_I"=> "This :attribute field is required.",
            "mfg_date"=> "This :attribute field is required.",
            "retest_date"=> "This :attribute field is required.",
            "net_wt"=> "This :attribute field is required.",
            "tare_wt"=> "This :attribute field is required.",
            "Remark"=> "This :attribute field is required.",
        ];
        // $validated = $request->validate($arrRules, $arrMessages);
        $data = [
            "simethicone"=> $request['simethicone'],
            "batch_no_I"=> $request['batch_no_I'],
            "mfg_date"=> $request['mfg_date'],
            "retest_date"=> $request['retest_date'],
            "net_wt_50"=> $request['net_wt'],
            "tare_wt_50"=> $request['tare_wt'],
            "net_wt_200"=> $request['net_wt_200'],
            "tare_wt_200"=> $request['tare_wt_200'],
            "net_wt_30"=> $request['net_wt_30'],
            "tare_wt_30"=> $request['tare_wt_30'],
            "net_wt_5"=> $request['net_wt_5'],
            "tare_wt_5"=> $request['tare_wt_5'],
            "Remark"=> $request['Remark'],
            "batch_id"=> $request['batch_id'],
        ];
        $result = GanerateLable::create($data);

        if ($result) {

            $batch = BatchManufacture::find($request->batch_id);
            $rawmeterial = Rawmeterial::find($batch->proName);

            if(isset($rawmeterial) && !$rawmeterial->qc_applicable) {


                $stock = Stock::where("matarial_id",$batch->proName)->where("material_type","F")->where("batch_no",$batch->batchNo)->first();

                $datastock = array();
                $datastock["matarial_id"] = $batch->proName;
                $datastock["material_type"] = "F";
                $datastock["department"] = 2;
                $datastock["qty"] = $batch->BatchSize;
                $datastock["batch_no"] = $batch->batchNo;
                $datastock["process_batch_id"] = $batch->batchNo;
                $datastock["type"] = "F";
                $materialdata = array();


                if(isset($stock) && $stock->id)
                {
                    Stock::where("id",$stock->id)->update($datastock);
                    $material  = Rawmeterial::where("id",$batch->proName)->first();
                    $materialdata["material_stock"]  =  ($material->material_stock+$batch->BatchSize);
                    $upd = Rawmeterial::where("id",$batch->proName)->update($materialdata);
                }
                else
                {

                    Stock::create($datastock);
                    $material  = Rawmeterial::where("id",$batch->proName)->first();
                    $materialdata["material_stock"]  =  ($material->material_stock+$batch->BatchSize);
                    $upd = Rawmeterial::where("id",$batch->proName)->update($materialdata);
                }
            }
            $batch = BatchManufacture::find($request->batch_id);
            $batch->stage_8=1;
            $batch->save();
             if(isset($request->save_q))
            {

                return redirect("add-batch-manufacture")->with('success', "Batch  Data Update successfully");
            }
            else
                return redirect("add-batch-manufacture")->with('success', "Data Batch Manufacturing  Generate Lable  successfully");
        }

    }
    public function add_manufacturing_generate_update(Request $request)
    {


        $arrRules = [
            "simethicone"=> "required",
            "batch_no_I"=> "required",
            "mfg_date"=> "required",
            "retest_date"=> "required",
            "net_wt"=> "required",
            "tare_wt"=> "required",
            "Remark"=> "required",

        ];
        $arrMessages = [

            "simethicone"=> "This :attribute field is required.",
            "batch_no_I"=> "This :attribute field is required.",
            "mfg_date"=> "This :attribute field is required.",
            "retest_date"=> "This :attribute field is required.",
            "net_wt"=> "This :attribute field is required.",
            "tare_wt"=> "This :attribute field is required.",
            "Remark"=> "This :attribute field is required.",
        ];
        // $validated = $request->validate($arrRules, $arrMessages);
        $data = [
            "simethicone"=> $request['simethicone'],
            "simethicone"=> $request['simethicone'],
            "batch_no_I"=> $request['batch_no_I'],
            "mfg_date"=> $request['mfg_date'],
            "retest_date"=> $request['retest_date'],
            "net_wt_50"=> $request['net_wt'],
            "tare_wt_50"=> $request['tare_wt'],
            "net_wt_200"=> $request['net_wt_200'],
            "tare_wt_200"=> $request['tare_wt_200'],
            "net_wt_30"=> $request['net_wt_30'],
            "tare_wt_30"=> $request['tare_wt_30'],
            "net_wt_5"=> $request['net_wt_5'],
            "tare_wt_5"=> $request['tare_wt_5'],
            "Remark"=> $request['Remark'],
            "batch_id"=> $request['batch_id'],
        ];

        if(isset($request->id) && $request->id)
        {
            $result = GanerateLable::where('id', $request->id)->update($data);

             $batch = BatchManufacture::find($request->batch_id);

             $rawmeterial = Rawmeterial::find($batch->proName);

             if(isset($rawmeterial) && !$rawmeterial->qc_applicable) {

                $stock = Stock::where("matarial_id",$batch->proName)->where("material_type","F")->where("batch_no",$batch->batchNo)->first();

                $datastock = array();
                $datastock["matarial_id"] = $batch->proName;
                $datastock["material_type"] = "F";
                $datastock["department"] = 2;
                $datastock["qty"] = $batch->BatchSize;
                $datastock["batch_no"] = $batch->batchNo;
                $datastock["process_batch_id"] = $batch->batchNo;
                $datastock["type"] = "F";

                if(isset($stock) && $stock->id)
                {
                    $material  = Rawmeterial::where("id",$batch->proName)->first();
                    $materialdata["material_stock"]  =  (($material->material_stock-$stock->qty)+$batch->BatchSize);
                    $upd = Rawmeterial::where("id",$batch->proName)->update($materialdata);
                    Stock::where("id",$stock->id)->update($datastock);
                }
                else
                {
                    $material  = Rawmeterial::where("id",$batch->proName)->first();
                    $materialdata["material_stock"]  =  ($material->material_stock+$batch->BatchSize);
                    $upd = Rawmeterial::where("id",$batch->proName)->update($materialdata);
                    Stock::create($datastock);
                }

                if(isset($request->save_r))
                {
                    $updreview = BatchManufacture::where('id', $request->batch_id)->update(["is_review"=>Auth::user()->id,"reveivew_time"=>Carbon::now()]);
                }
                if(isset($request->save_app))
                {
                    $updapproved = BatchManufacture::where('id', $request->batch_id)->update(["is_aproved"=>Auth::user()->id,"aprroved_time"=>Carbon::now()]);
                }
             }
        }
        else
        {
            $result = GanerateLable::create($data);

            $batch = BatchManufacture::find($request->batch_id);

            $rawmeterial = Rawmeterial::find($batch->proName);

            if(isset($rawmeterial) && !$rawmeterial->qc_applicable) {

                $stock = Stock::where("matarial_id",$batch->proName)->where("material_type","F")->where("batch_no",$batch->batchNo)->first();

                $datastock = array();
                $datastock["matarial_id"] = $batch->proName;
                $datastock["material_type"] = "F";
                $datastock["department"] = 2;
                $datastock["qty"] = $batch->BatchSize;
                $datastock["batch_no"] = $batch->batchNo;
                $datastock["process_batch_id"] = $batch->batchNo;
                $datastock["type"] = "F";

                if(isset($stock) && $stock->id)
                {
                    $material  = Rawmeterial::where("id",$batch->proName)->first();
                    $materialdata["material_stock"]  =  (($material->material_stock-$stock->qty)+$batch->BatchSize);
                    $upd = Rawmeterial::where("id",$batch->proName)->update($materialdata);
                    Stock::where("id",$stock->id)->update($datastock);
                }
                else
                {
                    $material  = Rawmeterial::where("id",$batch->proName)->first();
                    $materialdata["material_stock"]  =  ($material->material_stock+$batch->BatchSize);
                    $upd = Rawmeterial::where("id",$batch->proName)->update($materialdata);
                    Stock::create($datastock);
                }
            }
        }




        if ($result) {
            $batch = BatchManufacture::find($request->batch_id);
            $batch->stage_8=1;
            $batch->save();
            if(isset($request->save_q))
            {
                return redirect("add-batch-manufacture")->with('success', "Batch  Data Update successfully");
            }
            else
                return redirect("add-batch-manufacture")->with(['success' => " Batch  Data Update successfully"]);
        }

    }
    public function material_name_get(Request $request)
    {

                if($request->id){

                    $data=Rawmeterial::select('raw_materials.*')->where('raw_materials.id',$request->id)->first();

                if($data){
                        return ['status' =>'success','capacity'=>$data->capacity];
                    }


            }
                return ['status'=>'error','message'=>'Invalid Order ID'];



    }

    public function pdfview(Request $request,$id)
    {

        $data['manufacture'] = BatchManufacture::select('add_batch_manufacture.*', 'raw_materials.material_name',"userdone.name as doneby","usercheck.name as usercheck","qccheck.name as qcname")
            ->leftJoin("quality_controll_check",function($join){
                $join->on("quality_controll_check.inward_material_id","add_batch_manufacture.id");
                $join->where("quality_controll_check.material_type","B");
            })
            ->leftJoin('raw_materials', 'raw_materials.id', '=', 'add_batch_manufacture.proName')
            ->leftJoin('users as userdone', 'userdone.id', '=', 'add_batch_manufacture.doneBy')
            ->leftJoin('users as usercheck', 'usercheck.id', '=', 'add_batch_manufacture.checkedBy')
            ->leftJoin('users as qccheck', 'qccheck.id', '=', 'add_batch_manufacture.checkedByI')
            ->where("add_batch_manufacture.id",$id)
            ->orderBy('add_batch_manufacture.id','desc')
            ->first();

        $data['lastmanufacture'] = BatchManufacture::select('add_batch_manufacture.*', 'raw_materials.material_name',"userdone.name as doneby","usercheck.name as usercheck","qccheck.name as qcname")
            ->leftJoin("quality_controll_check",function($join){
                $join->on("quality_controll_check.inward_material_id","add_batch_manufacture.id");
                $join->where("quality_controll_check.material_type","B");
            })
            ->leftJoin('raw_materials', 'raw_materials.id', '=', 'add_batch_manufacture.proName')
            ->leftJoin('users as userdone', 'userdone.id', '=', 'add_batch_manufacture.doneBy')
            ->leftJoin('users as usercheck', 'usercheck.id', '=', 'add_batch_manufacture.checkedBy')
            ->leftJoin('users as qccheck', 'qccheck.id', '=', 'quality_controll_check.checked_by')
            ->where("add_batch_manufacture.id","<",$id)
            ->orderBy('add_batch_manufacture.id', 'desc')->take(1)->first();


        if($data["manufacture"])
        {
            $batchid = $data["manufacture"]->id;
            /*$data["requestion"] = RequisitionSlip::select("packing_material_requisition_slip.id","users.name")->where("batch_id", $batchid)->join("users","users.id","packing_material_requisition_slip.ApprovedBy")->where("type","R")->orderBy('id', 'desc')->get();*/
            
          // Bill of material issual
            $data["Requisitionissuedmaterial"] = Requisitionissuedmaterial::select("issue_material_production_requestion.id","app.name as approvedby","checked.name as checkby")->where("batch_id", $batchid)->where("type","R")->join("users as app","app.id","issue_material_production_requestion.ApprovedBy")->join("users as checked","checked.id","issue_material_production_requestion.checkedBy")->orderBy('id', 'desc')->get();
             if(isset($data["Requisitionissuedmaterial"]) && $data["Requisitionissuedmaterial"])
             {
                        foreach($data["Requisitionissuedmaterial"] as $mat)
                        {
                            $data['raw_material_bills'][] =  Requisitionissuedmaterialdetails::select("issue_material_production_requestion_details.*","raw_materials.material_name","inward_raw_materials_items.batch_no")
                            ->where("issue_material_production_requestion_details.issual_material_id", $mat->id)
                            ->join("raw_materials", "raw_materials.id", "issue_material_production_requestion_details.material_id")
                            ->join("inward_raw_materials_items", "inward_raw_materials_items.id", "issue_material_production_requestion_details.batch_id")
                            ->get();
                        }
            }

            // Bill of raw_materials requestion
            $data["Requisitmaterial"] = RequisitionSlip::select("packing_material_requisition_slip.*","checked.name as checkby")->where("batch_id", $batchid)->where("type","R")->join("users as checked","checked.id","packing_material_requisition_slip.checkedBy")->orderBy('id', 'desc')->get();

            if(isset($data["Requisitmaterial"]) && $data["Requisitmaterial"])
            {
                       foreach($data["Requisitmaterial"] as $mat)
                       {
                           $data['raw_material_Requisit'][] =  DetailsRequisition::select("detail_packing_material_requisition.*","raw_materials.material_name")
                           ->where("detail_packing_material_requisition.requisition_id", $mat->id)
                           ->join("raw_materials", "raw_materials.id", "detail_packing_material_requisition.PackingMaterialName")

                           ->get();
                       }
           }

            // packing material requestion  issual

            $data["Requisitionissuedmaterialpacking"] = Requisitionissuedmaterial::select("issue_material_production_requestion.id","app.name as approvedby","checked.name as checkby")->where("batch_id", $batchid)->where("type","P")->join("users as app","app.id","issue_material_production_requestion.ApprovedBy")->join("users as checked","checked.id","issue_material_production_requestion.checkedBy")->orderBy('id', 'desc')->get();
             if(isset($data["Requisitionissuedmaterialpacking"]) && $data["Requisitionissuedmaterialpacking"])
             {
                        foreach($data["Requisitionissuedmaterialpacking"] as $mat)
                        {
                            $data['raw_material_bills_packing'][] =  Requisitionissuedmaterialdetails::select("issue_material_production_requestion_details.*","raw_materials.material_name",DB::raw("''as batch_no"))
                            ->where("issue_material_production_requestion_details.issual_material_id", $mat->id)
                            ->join("raw_materials", "raw_materials.id", "issue_material_production_requestion_details.material_id")

                            ->get();
                        }
            }


            // packing material requestion

                $data["Requisitmaterialpacking"] = RequisitionSlip::select("packing_material_requisition_slip.*","checked.name as checkby")->where("batch_id", $batchid)->where("type","P")->join("users as checked","checked.id","packing_material_requisition_slip.checkedBy")->orderBy('id', 'desc')->get();

                if(isset($data["Requisitmaterialpacking"]) && $data["Requisitmaterialpacking"])
                {
                        foreach($data["Requisitmaterialpacking"] as $mat)
                        {
                            $data['raw_material_Requisitpacking'][] =  DetailsRequisition::select("detail_packing_material_requisition.*","raw_materials.material_name")
                            ->where("detail_packing_material_requisition.requisition_id", $mat->id)
                            ->join("raw_materials", "raw_materials.id", "detail_packing_material_requisition.PackingMaterialName")

                            ->get();
                        }
            }
            
            // list of list_of_equipment batch_manufacturing_records_line_clearance_record
            $data["selected_equipment"] =  ListOfEquipmentManufacturing::select("equipment_code.code","list_of_equipment_in_manufacturin_process.id","equipment_name.equipment")
                                            ->join("batch_manufacturing_records_list_of_equipment","batch_manufacturing_records_list_of_equipment.id","list_of_equipment_in_manufacturin_process.batch_manufacturing_id")
                                            ->join("equipment_code","equipment_code.id","list_of_equipment_in_manufacturin_process.EquipmentCode")
                                            ->join("equipment_name","equipment_name.id","equipment_code.equipment_id")
                                            ->where('batch_manufacturing_records_list_of_equipment.batch_id', '=',  $batchid)->get();

            //dd($batchid,$data["selected_equipment"]);
            // get lots
            $lotsdetails = AddLotsl::select('add_lotsl.*',"equipment_code.code")
                                    ->leftJoin("list_of_equipment_in_manufacturin_process","list_of_equipment_in_manufacturin_process.id","add_lotsl.ReactorNo")
                                    ->leftJoin("equipment_code","equipment_code.id","list_of_equipment_in_manufacturin_process.EquipmentCode")->where("batch_id",$batchid)->groupBy("add_lotsl.id")->get();

            if (isset($lotsdetails) && $lotsdetails) {
                $data["lotsdetails"] = $lotsdetails;
                foreach($lotsdetails as $lot)
                {
                    $lotsrawmaterials = AddLotslRawMaterialDetails::select('add_lots_raw_material_detail.*',"raw_materials.material_name","inward_raw_materials_items.batch_no")
                                        ->join("raw_materials","raw_materials.id","add_lots_raw_material_detail.MaterialName")
                                        ->join("inward_raw_materials_items","inward_raw_materials_items.id","add_lots_raw_material_detail.rmbatchno")
                                        ->where("add_lots_id",$lot->id)->get();
                        if (isset($lotsrawmaterials) && $lotsrawmaterials)
                        $lots[] = $lotsrawmaterials;
                    //dd($lotsrawmaterials);
                    $process[]  = Processlots::select("qty","temp","stratTime","endTime","users.name as doneby","process_id","pr.process_name")
                                            ->join("users","users.id","process_lots.doneby")
                                            ->leftJoin('processes as pr', 'pr.id', '=', 'process_lots.process_id')
                                            ->where("process_lots.lot_id",$lot->id)
                                            ->get();
                }

                if(isset($process) && $process)
                    $data["process"] = $process;
                if(isset($lots) && $lots)
                    $data["lotsrawmaterials"] = $lots;

                $data["processmaster"] = array("Charges Polydimethyl siloxane in reactor.","Starts heating the reactor and start stirring","Once the temperature is between 100 - 120oC starts the Inline mixer and charges ColloidalSilicon Dioxide (Fumed Silica) in reactor simultaneously and increase stirring speed.","When of temperature reaches 180 - 190 oC stops heating the reactor.","Stops stirrer and transfers the reaction mass to homogenizing tank No.- PR/BT/Come Tank number.");

            }
           //dd($data);
            // Homogenizing Process

            $data['Homogenizing'] = Homogenizing::select("homogenizing.*","raw_materials.material_name","equipment_code.code")->join('raw_materials', 'raw_materials.id','=','homogenizing.proName')
                ->join('list_of_equipment_in_manufacturin_process', 'list_of_equipment_in_manufacturin_process.id','=','homogenizing.homoTank')
                ->join('equipment_code', 'equipment_code.id','=','list_of_equipment_in_manufacturin_process.EquipmentCode')->where('batch_id', '=', $batchid)
                ->get();

           $homolist = array();
           if(isset($data['Homogenizing']) && $data['Homogenizing'])
           {
               foreach($data['Homogenizing'] as $key=>$val)
               {
                    $list = HomogenizingList::select("homogenizing_list.*","users.name as doneby")->where("homogenizing_id",$val->id)->join("users","users.id","homogenizing_list.doneby")->get();

                    $homolist[$val->id] = $list;
               }


           }
           if(isset($homolist) && $homolist)
                $data["homoList"] = $homolist;

           // packing process

           $data['packingmateria'] = BatchManufacturingPacking::select("batch_manufacturing_records_packing.*","donebyuser.name as doneby","checkbyuser.name as checkby")
                                    ->leftJoin("users as donebyuser","donebyuser.id","batch_manufacturing_records_packing.areaCleanliness")
                                    ->join("users as checkbyuser","checkbyuser.id","batch_manufacturing_records_packing.ApprovedBy")
                                    ->where('batch_manufacturing_records_packing.batch_id', '=', $batchid)
                                    ->first();

           //dd($data['packingmateria'],$batchid);
           // get Lable

           $data["lables"] = GanerateLable::select("generate_label.*")->where('batch_id', $batchid)->first();

           //equipment detailsid

           //$data["equipment"] =  ListOfEquipmentManufacturing::join("equipment_code","equipment_code.id","list_of_equipment_in_manufacturin_process.EquipmentCode")->where("batch_manufacturing_id",$batchid)->get();


            //Line Clearance
            //$data['batchproduct'] = Rawmeterial::where("material_type", "F")->where("id",$data['batchdetails']->proName)->first();

            $data["lineclearance"] =  BatchManufacturingRecordsLine::join("line_clearance_record","line_clearance_record.line_clearance_id","batch_manufacturing_records_line_clearance_record.id")->where("batch_manufacturing_records_line_clearance_record.batchNo",$batchid)->get();
            $data["reactor_details"] = ReactorsSatus::
                join("reactor_status","reactor_status.id","batch_manufacturing_reactor_status.status_id")
                ->where("batch_manufacturing_reactor_status.batch_id",$batchid)
                ->get();
          
            

        }


        $data["authData"] = Auth::user();

       // print_r($data["raw_material_bills"]);
        if($request->has('download')){
            $pdf = PDF::loadView('pdfview');

            return $pdf->download('pdfview.pdf');
        }



        return view('pdfview',$data,);
    }
    function viewLots(Request $request)
    {
        if($request->id)
        {
            $lotsdetails = AddLotsl::select('add_lotsl.*',"equipment_code.code")
            ->leftJoin("list_of_equipment_in_manufacturin_process","list_of_equipment_in_manufacturin_process.id","add_lotsl.ReactorNo")
            ->leftJoin("equipment_code","equipment_code.id","list_of_equipment_in_manufacturin_process.EquipmentCode")->where("add_lotsl.id",$request->id)->first();
            $data = array();


            if (isset($lotsdetails) && $lotsdetails) { 
                $data["lotsdetails"] = $lotsdetails;

                $data["batchdetails"] = BatchManufacture::select("add_batch_manufacture.*","raw_materials.material_name as productname")->where("add_batch_manufacture.id",$lotsdetails->batch_id)->join("raw_materials","raw_materials.id","add_batch_manufacture.proName")->first();

                    $data["lotsrawmaterials"] = AddLotslRawMaterialDetails::select('add_lots_raw_material_detail.*',"raw_materials.material_name","inward_raw_materials_items.batch_no")->join("raw_materials","raw_materials.id","add_lots_raw_material_detail.MaterialName")->join("inward_raw_materials_items","inward_raw_materials_items.id","add_lots_raw_material_detail.rmbatchno")->where("add_lots_id",$lotsdetails->id)->get();



                    $process  = Processlots::select("qty","temp","stratTime","endTime","users.name as doneby","process_id")->join("users","users.id","process_lots.doneby")->where("process_lots.lot_id",$lotsdetails->id)->get();

                if(isset($process) && $process)
                    $data["process"] = $process;



            }

            $view = view('batch.view_lot_details', $data)->render();
            return response()->json(['html'=>$view]);
        }
    }
    public function editLots(Request $request)
    {
        if($request->id)
        {
            $lotsdetails = AddLotsl::select('add_lotsl.*',"equipment_code.code")
            ->leftJoin("list_of_equipment_in_manufacturin_process","list_of_equipment_in_manufacturin_process.id","add_lotsl.ReactorNo")
            ->leftJoin("equipment_code","equipment_code.id","list_of_equipment_in_manufacturin_process.EquipmentCode")->where("add_lotsl.id",$request->id)->first();
            $data = array();


            if (isset($lotsdetails) && $lotsdetails) {
                $data["lotsdetails"] = $lotsdetails;

                $data["batchdetails"] = BatchManufacture::select("add_batch_manufacture.*","raw_materials.material_name as productname","raw_materials.processgroupid")->where("add_batch_manufacture.id",$lotsdetails->batch_id)->join("raw_materials","raw_materials.id","add_batch_manufacture.proName")->first();

                $data["selected_crop"] =  ListOfEquipmentManufacturing::select("equipment_code.code","list_of_equipment_in_manufacturin_process.id")->join("batch_manufacturing_records_list_of_equipment","batch_manufacturing_records_list_of_equipment.id","list_of_equipment_in_manufacturin_process.batch_manufacturing_id")->join("equipment_code","equipment_code.id","list_of_equipment_in_manufacturin_process.EquipmentCode")->where('batch_manufacturing_records_list_of_equipment.batch_id', '=', $lotsdetails->batch_id)->where("equipment_code.equipment_id","<>",2)->pluck("code","id");


                    $data["lotsrawmaterials"] = AddLotslRawMaterialDetails::select('add_lots_raw_material_detail.*',"raw_materials.material_name","inward_raw_materials_items.batch_no")->join("raw_materials","raw_materials.id","add_lots_raw_material_detail.MaterialName")->join("inward_raw_materials_items","inward_raw_materials_items.id","add_lots_raw_material_detail.rmbatchno")->where("add_lots_id",$lotsdetails->id)->get();



                    $process  = Processlots::select("qty","temp","stratTime","endTime","users.name as doneby","process_id","processes.process_name")
                    ->join("processes","processes.id","process_lots.process_id")
                    ->join("users","users.id","process_lots.doneby")->where("process_lots.lot_id",$lotsdetails->id)->get();

                if(isset($process) && $process)
                    $data["process"] = $process;


                    $Requisitionissuedmaterial = Requisitionissuedmaterial::where("batch_id", $lotsdetails->batch_id)->where("type","R")->orderBy('id', 'desc')->get();

                    if(isset($Requisitionissuedmaterial) && $Requisitionissuedmaterial)
                    {



                               foreach($Requisitionissuedmaterial as $mat)
                               {
                                   $data['raw_material_bills_req'][] =  Requisitionissuedmaterialdetails::select("issue_material_production_requestion_details.*","raw_materials.material_name","inward_raw_materials_items.id","issue_material_production_requestion_details.id as detail_id")
                                   ->where("issue_material_production_requestion_details.issual_material_id", $mat->id)
                                   ->join("raw_materials", "raw_materials.id", "issue_material_production_requestion_details.material_id")
                                   ->join("stock", "stock.id", "issue_material_production_requestion_details.batch_id")
                                   ->join("inward_raw_materials_items", "inward_raw_materials_items.id", "stock.batch_no")
                                   ->get();
                               }




                   }
                    
                  $data["raw_material_bills"] = AddLotslRawMaterialDetails::select('add_lots_raw_material_detail.*',"raw_materials.material_name","inward_raw_materials_items.batch_no")->join("raw_materials","raw_materials.id","add_lots_raw_material_detail.MaterialName")->join("inward_raw_materials_items","inward_raw_materials_items.id","add_lots_raw_material_detail.rmbatchno")->where("add_lots_id",$lotsdetails->id)->get();

                



                   /*$data["stock"] = Stock::select("raw_materials.material_name","raw_materials.id")->where("department",3)->where(DB::raw("qty-used_qty"),">",0)->join("raw_materials","raw_materials.id","stock.matarial_id")->where("stock.material_type",'R')->groupBy("raw_materials.id")->pluck("material_name","id");*/

                   $batchid  = $lotsdetails->batch_id;
                   $data["stock"] = Stock::select("raw_materials.material_name","raw_materials.id")->where("department",3)->where(DB::raw("qty-used_qty"),">",0)->join("raw_materials","raw_materials.id","stock.matarial_id")->where("stock.material_type",'R')->groupBy("raw_materials.id")->pluck("material_name","id");

                   if($data["batchdetails"])
                   {

                        $data["processgroup"] = DB::table("processes")->where("group_id",$data["batchdetails"]->processgroupid)->get();
                   }


                    $data["users"] = USER::where("role_id",6)->pluck("name","id");;

                    $view = view('batch.lot_edit', $data)->render();
            }
            return response()->json(['html'=>$view]);
        }
        else
        {
            return response()->json(['status'=>0]);
        }
    }

    public function lotseditupdate (Request $request)
    {
        //dd($request);
        if($request->id)
        {
            $lots = AddLotsl::find($request->id); //add_lotsl
            
            if(isset($lots))
            {
                $lots->proName = $request->proName;
                $lots->bmrNo = $request->bmrNo;
                $lots->batchNo = $request->batchNo;
                $lots->refMfrNo = $request->refMfrNo;
                $order_number = date('dyHs');
                $lots->order_id = $order_number;
                $lots->Date = $request->Date;
                if($request->lotNo)
                    $lots->lotNo = $request->lotNo;
                else
                {
                    $lotno = AddLotsl::select(DB::raw("max(lotNo) as lotno"))->where('id', $request->id)->first();
                    if(isset($lotno) && $lotno)
                    {
                        $lots->lotNo = $lotno->lotno+1;
                    }
                    else
                    {
                        $lots->lotNo = 1;
                    }
                }
                $lots->ReactorNo = $request->ReactorNo;
                $lots->Process_date = $request->Process_date;
                $lots->batch_id = $request->mainid;
             
                $lots->save();
                $lotsid = 0;
               
                $lotsid = $request->id;
                if(empty($request->MaterialName))
                {
                    return redirect("add-batch-manufacture")
                    ->with('error', "Something went wrong. Please check.");
                }
              
               
               $lotsid = $request->id;
                if ((isset($lotsid)) && ($lotsid > 0)) {
                    if (count($request->MaterialName)) {
                        $lotdetails = AddLotslRawMaterialDetails::where('add_lots_id', $lotsid)->get(); //add_lots_raw_material_detail

                        if(isset($lotdetails))
                        {
                            foreach ($lotdetails as $val)
                            {
                                $stockless = array();
                                $stock = Stock::where("matarial_id",$val->MaterialName)->where("batch_no",$val->rmbatchno)->first();
                                if(isset($stock) && $stock)
                                {
                                    $st = Stock::find($stock->id);
                                    $stockless["used_qty"] = ($st->used_qty - $val->Quantity);
                                    
                                    $st->update($stockless);
                                }
                                $usedQty = array();
                                $req_detail = Requisitionissuedmaterialdetails::where("id",$val->req_detail_id)->first();
                                if(isset($req_detail) && $req_detail)
                                {
                                    $rqd = Requisitionissuedmaterialdetails::find($req_detail->id);
                                    $usedQty["used_qty"] = ($rqd->used_qty - $val->Quantity);
                                    $rqd->update($usedQty);
                                }
                                
                                AddLotslRawMaterialDetails::where('id', $val->id)->delete(); //add_lots_raw_material_detail
                            }


                        }

                        foreach ($request->MaterialName as $key => $value) {
                            $arr_data['MaterialName'] = $value;
                            $arr_data['rmbatchno'] = $request->rmbatchno[$key];
                            $arr_data['Quantity'] = $request->Quantity[$key];
                            $arr_data['add_lots_id'] = $lotsid;
                            $arr_data['req_detail_id'] = $request->detail_id[$key];
                            AddLotslRawMaterialDetails::Create($arr_data); //add_lots_raw_material_detail

                            $stockless = array();
                            $stock = Stock::where("matarial_id",$value)->where("batch_no",$request->rmbatchno[$key])->first();
                            if(isset($stock) && $stock)
                            {
                                $st = Stock::find($stock->id);
                                $stockless["used_qty"] = $request->Quantity[$key];
                                $st->update($stockless);
                            }
                            $usedQty = array();
                            $req_detail = Requisitionissuedmaterialdetails::where("id",$request->detail_id[$key])->first();
                            if(isset($req_detail) && $req_detail)
                            {
                                $rqd = Requisitionissuedmaterialdetails::find($req_detail->id);
                                $usedQty["used_qty"] = ($rqd->used_qty + $request->Quantity[$key]);
                                $rqd->update($usedQty);
                            }
                            
                        }

                        if ((isset($lotsid)) && ($lotsid > 0) && isset($request->qty)) {
                            foreach ($request->qty as $key => $value) {
                                Processlots::where('lot_id', $lotsid)->delete();

                                if (count($request->qty)) {
                                    foreach ($request->qty as $key => $value) {
                                        $arr_data['qty'] = $value;
                                        $arr_data['temp'] = $request->temp[$key];
                                        $arr_data['stratTime'] = $request->stratTime[$key];
                                        $arr_data['endTime'] = $request->endTime[$key];
                                        $arr_data['doneby'] = $request->doneby[$key];
                                        $arr_data['lot_id'] = $lotsid;
                                        $arr_data['process_id'] = $request->processName[$key];
                                        $result = Processlots::Create($arr_data);
                                    }

                                    $sequenceId = 10;

                                    if ($result) {
                                        $batch = BatchManufacture::find($request->mainid);

                                        $batch->stage_5=1;
                                        $batch->save();
                                        if(isset($request->save_q))
                                        {
                                            return redirect("add-batch-manufacture")->with('success', "Batch  Data Update successfully");
                                        }
                                        else
                                            return redirect("add_manufacturing_edit/" . $request->mainid . "/" . $sequenceId)->with(['success' => " Batch  Data Update successfully", 'nextdivsequence' => 90]);
                                    }
                                }
                            }
                        }else{
                            return redirect("add_manufacturing_edit/" . $request->mainid)->with(['success' => " Batch  Data Update successfully..! But Process Batch Not updated", 'nextdivsequence' => 90]);
                        }
                    }
                }
            }
        }
    }
    public function homogenizingView(Request $request)
    {
        if($request->id)
        {
            $data['Homogenizing'] = Homogenizing::select("homogenizing.*","raw_materials.material_name","equipment_code.code")->join('raw_materials', 'raw_materials.id','=','homogenizing.proName')->join('list_of_equipment_in_manufacturin_process', 'list_of_equipment_in_manufacturin_process.id','=','homogenizing.homoTank')->join('equipment_code', 'equipment_code.id','=','list_of_equipment_in_manufacturin_process.EquipmentCode')->where('homogenizing.id', '=', $request->id)
                ->first();


           $homolist = array();
           if(isset($data['Homogenizing']) && $data['Homogenizing'])
           {

            $data["batchdetails"] = BatchManufacture::select("add_batch_manufacture.*","raw_materials.material_name as productname")->where("add_batch_manufacture.id",$data['Homogenizing'] ->batch_id)->join("raw_materials","raw_materials.id","add_batch_manufacture.proName")->first();



                    $list = HomogenizingList::select("homogenizing_list.*","users.name as doneby")->where("homogenizing_id",$data['Homogenizing']->id)->join("users","users.id","homogenizing_list.doneby")->get();

                    $homolist = $list;



           }
           if(isset($homolist) && $homolist)
                $data["homoList"] = $homolist;

            $view = view('batch.viewhomozine', $data)->render();
            return response()->json(['html'=>$view]);
        }
    }
    public function homogenizingEdit(Request $request)
    {
        if($request->id)
        {
            $data['Homogenizing'] = Homogenizing::select("homogenizing.*","raw_materials.material_name","equipment_code.code")->join('raw_materials', 'raw_materials.id','=','homogenizing.proName')->join('list_of_equipment_in_manufacturin_process', 'list_of_equipment_in_manufacturin_process.id','=','homogenizing.homoTank')->join('equipment_code', 'equipment_code.id','=','list_of_equipment_in_manufacturin_process.EquipmentCode')->where('homogenizing.id', '=', $request->id)
                ->first();


            $homolist = array();


            if(isset($data['Homogenizing']) && $data['Homogenizing'])
            {

                $data["batchdetails"] = BatchManufacture::select("add_batch_manufacture.*","raw_materials.material_name as productname")->where("add_batch_manufacture.id",$data['Homogenizing'] ->batch_id)->join("raw_materials","raw_materials.id","add_batch_manufacture.proName")->first();


                $data["selected_crop_tank"] =  ListOfEquipmentManufacturing::select("equipment_code.code","list_of_equipment_in_manufacturin_process.id")->join("batch_manufacturing_records_list_of_equipment","batch_manufacturing_records_list_of_equipment.id","list_of_equipment_in_manufacturin_process.batch_manufacturing_id")->join("equipment_code","equipment_code.id","list_of_equipment_in_manufacturin_process.EquipmentCode")->where('batch_manufacturing_records_list_of_equipment.batch_id', '=', $data['Homogenizing']->batch_id)->where("equipment_code.equipment_id","=",2)->pluck("code","id");


                        $list = HomogenizingList::select("homogenizing_list.*","users.name as doneby")->where("homogenizing_id",$data['Homogenizing']->id)->join("users","users.id","homogenizing_list.doneby")->get();

                        $homolist = $list;



            }
            if(isset($homolist) && $homolist)
                    $data["homoList"] = $homolist;

            $data["users"] = User::pluck("name","id");

                $view = view('batch.Edithomozine', $data)->render();
                return response()->json(['html'=>$view]);
        }
    }
    public function homogenizingEditstore(Request $request)
    {

        $arr['proName'] = $request->proName;
        $arr['bmrNo'] = $request->bmrNo;
        $arr['batchNo'] = $request->batchNo;
        $arr['refMfrNo'] = $request->refMfrNo;
        $order_number = date('dyHs');
        $arr['order_id'] = $order_number;
        $arr['homoTank'] = $request->homoTank;
        $arr['Observedvalue'] = $request->Observedvalue;
        $arr['homoTank'] = $request->homoTank;
        $arr['batch_id'] = $request->mainid;
        $arr['proecess_check'] = $request->proecess_check;
        $homeid = 0;
        if(isset($request->id))
        {
            $Homogenizing_id = Homogenizing::where('id', $request->id)->update($arr);
            $homeid = $request->id;
        }


        if ((isset($homeid)) && ($homeid > 0)) {
            if (count($request->dateProcess)) {
                HomogenizingList::where('homogenizing_id', $homeid)->delete();
              foreach ($request->dateProcess as $key => $value) {
                    $arr_data['dateProcess'] = $value;
                    $arr_data['qty'] = $request->qty[$key];
                    $arr_data['stratTime'] = $request->stratTime[$key];
                    $arr_data['endTime'] = $request->endTime[$key];
                    $arr_data['lots_name'] = $request->lot[$key];
                    $arr_data['homogenizing_id'] = $homeid;
                    $arr_data['doneby'] = $request->doneby[$key];
                    $result=HomogenizingList::Create($arr_data);

                    $lotsarray = array();
                    $lotsarray["homogenize_done"]=1;
                    $lotsarray["homogenize_date"]=\Carbon\Carbon::now();;
                    if(isset($request->lotsid[$key]) && $request->lotsid[$key] >0)
                        $lots = AddLotsl::where("id",$request->lotsid[$key])->update($lotsarray);

                }

                 $sequenceId = 1;
                if (isset($request->sequenceId)) {
                    $sequenceId = (int)$request->sequenceId + 1;
                }

                if ($result) {
                    $batch = BatchManufacture::find($request->mainid);
                    $batch->stage_6=1;
                    $batch->save();


                        return redirect("add_manufacturing_edit/" . $request->mainid . "/11")->with(['success' => " Batch  Data Update successfully", 'nextdivsequence' => 12]);
                }
            }
        }
    }
    public function lotsDelete(Request $request)
    {
        if($request->id)
        {
            $lots = AddLotsl::find($request->id);
            if(isset($lots))
            {
                $lotsid = 0;

                $lotsid = $request->id;


                if ((isset($lotsid)) && ($lotsid > 0)) {

                        $lotdetails = AddLotslRawMaterialDetails::where('add_lots_id', $lotsid)->get();

                        if(isset($lotdetails))
                        {
                            foreach ($lotdetails as $val)
                            {
                                $stockless = array();
                                $stock = Stock::where("matarial_id",$val->MaterialName)->where("batch_no",$val->rmbatchno)->first();
                                if(isset($stock) && $stock)
                                {
                                    $st = Stock::find($stock->id);
                                    $stockless["used_qty"] = ($st->used_qty - $val->Quantity);
                                    $st->update($stockless);
                                }
                                $usedQty = array();
                                $req_detail = Requisitionissuedmaterialdetails::where("id",$val->req_detail_id)->first();
                                if(isset($req_detail) && $req_detail)
                                {
                                    $rqd = Requisitionissuedmaterialdetails::find($req_detail->id);
                                    $usedQty["used_qty"] = ($rqd->used_qty - $val->Quantity);
                                    $rqd->update($usedQty);
                                }
                                
                                AddLotslRawMaterialDetails::where('id', $val->id)->delete();
                            }


                        }




                    $lots->delete();

                    return response()->json(['status'=>1]);
                }
            }
            else
                return response()->json(['status'=>0]);
        }
    }
    public function homogenizingdelete(Request $request)
    {
        if($request->id)
        {
           $hom =  Homogenizing::find($request->id);

           if($hom)
           {
                $processlist = HomogenizingList::where("homogenizing_id",$hom->id)->get();
                if(isset($processlist))
                {
                    foreach($processlist as $v)
                    {
                        $list =  HomogenizingList::where("id",$v->id)->delete();
                    }
                }

                $hom->delete();

                return response()->json(['status'=>1]);
           }
           else
            return response()->json(['status'=>0]);
        }
        else
            return response()->json(['status'=>0]);
    }

    public function equpmentstatusDelete(Request $request)
    {   
        if($request->id)
        {
            ReactorsSatus::where('id', $request->id)->delete();
        return response()->json(['status'=>1]);
        }else{
            return response()->json(['status'=>0]);
        }
    }

}