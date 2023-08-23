<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Grade;
use App\Models\FinishedGoodsDispatch;
use App\Models\Modedispatch;
use App\Models\Rawmeterial;
use App\Models\Department;
use App\Models\PartyMaster;
use App\Models\User;
use App\Models\Inwardfinishedgoods;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class DispatchFinishedGoodsController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:dispatch-finished-goods-list|dispatch-finished-goods-add|dispatch-finished-goods-edit|dispatch_finished-goods-delete', ['only' => ['dispatch_finished_goods','dispatch_finished_good_insert']]);
         $this->middleware('permission:dispatch-finished-goods-add', ['only' => ['add_dispatch_finished_goods','dispatch_finished_good_insert']]);
         $this->middleware('permission:dispatch_finished-goods-edit', ['only' => ['edit_dispatch_finished','update_dispatch_finished']]);
         $this->middleware('permission:dispatch_finished-goods-delete', ['only' => ['delete_dispatch_finished']]);
         $this->middleware('permission:add-dispatch-finished-goods', ['only' => ['add_dispatch_finished_goods']]);
    }
    public function dispatch_finished_goods()
    {
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
            ->Join("users","users.id", "=", "finished_goods_dispatch.dispatch_by")
            ->get();

        return view('dispatch_finished_goods', $data);
    }

    public function add_dispatch_finished_goods()
    {
        $data['supplier_master'] = Supplier::all();
        $data['mode'] = Modedispatch::where("publish",1)->get();
        $data["product"] = Rawmeterial::where("material_type","F")->where("material_stock",">",0)->pluck("material_name","id");
        $data["department"] = Department::where("publish",1)->pluck("department","id");
        $data["partyname"] = PartyMaster::pluck("company_name","id");
        $data['grade'] = Grade::all();
        $data["users"] = User::pluck("name","id");
        $maxid = FinishedGoodsDispatch::select(DB::Raw("max(dispath_no) as nextid"))->first();

        $nextid =1;
        if($maxid->nextid)
            $nextid = $maxid->nextid+1;
        $data["nextid"] = $nextid;
        return view('add_dispatch_finished_goods', $data);
    }
    public function dispatch_finished_good_insert(Request $request)
    {
        // $arrRules = [
        //     "dispath_no"=>"required",
        //     "dispatch_form"=>"required",
        //     "dispatch_to"=>"required",
        //     "good_dispatch_date"=>"required",
        //     "mode_of_dispatch"=>"required",
        //     "party_name"=>"required",
        //     "product"=>"required",
        //     "invoice_no"=>"required",
        //     "batch_no"=>"required",
        //     "grade"=>"required",
        //     "viscosity"=>"required",
        //     "mfg_date"=>"required",
        //     "expiry_ratest_date"=>"required",
        //     "total_no_of_200kg_drums"=>"required",
        //     "total_no_of_50kg_drums"=>"required",
        //     "total_no_of_30kg_drums"=>"required",
        //     "total_no_of_5kg_drums"=>"required",
        //     "total_no_of_fiber_board_drums"=>"required",
        //     "total_no_qty"=>"required",
        //     "seal_no"=>"required",
        //     "dispatch_date"=>"required",
        //     "remark"=>"required",

        //    ];
        //    $arrMessages = [
        //     "dispath_no"=>"This :attribute field is required.",
        //     "dispatch_form"=>"This :attribute field is required.",
        //     "dispatch_to"=>"This :attribute field is required.",
        //     "good_dispatch_date"=>"This :attribute field is required.",
        //     "mode_of_dispatch"=>"This :attribute field is required.",
        //     "party_name"=>"This :attribute field is required.",
        //     "product"=>"This :attribute field is required.",
        //     "invoice_no"=>"This :attribute field is required.",
        //     "batch_no"=>"This :attribute field is required.",
        //     "grade"=>"This :attribute field is required.",
        //     "viscosity"=>"This :attribute field is required.",
        //     "mfg_date"=>"This :attribute field is required.",
        //     "expiry_ratest_date"=>"This :attribute field is required.",
        //     "total_no_of_50kg_drums"=>"This :attribute field is required.",
        //     "total_no_of_30kg_drums"=>"This :attribute field is required.",
        //     "total_no_of_5kg_drums"=>"This :attribute field is required.",
        //     "total_no_qty"=>"This :attribute field is required.",
        //     "seal_no"=>"This :attribute field is required.",
        //     "dispatch_date"=>"This :attribute field is required.",
        //     "dispatch_by"=>"This :attribute field is required.",
        //     "remark"=>"This :attribute field is required.",
        //     ];
        //    $validateData = $request->validate($arrRules, $arrMessages);


        $data = [
            'dispath_no' => $request['dispath_no'],
            'dispatch_form' => $request['dispatch_form'],
            'dispatch_to' => $request['dispatch_to'],
            'good_dispatch_date' => $request['good_dispatch_date'],
            'mode_of_dispatch' => $request['mode_of_dispatch'],
            'party_name' => $request['party_name'],
            'product' => $request['product'],
            'invoice_no' => $request['invoice_no'],
            'batch_no' => $request['batch_no'],
            'grade' => $request['grade'],
            'viscosity' => $request['viscosity'],
            'mfg_date' => $request['mfg_date'],
            'expiry_ratest_date' => $request['expiry_ratest_date'],
            'total_no_of_200kg_drums' => $request['total_no_of_200kg_drums'],
            'total_no_of_50kg_drums' => $request['total_no_of_50kg_drums'],
            'total_no_of_30kg_drums' => $request['total_no_of_30kg_drums'],
            'total_no_of_5kg_drums' => $request['total_no_of_5kg_drums'],
            'total_no_of_fiber_board_drums' => $request['total_no_of_fiber_board_drums'],
            'total_no_qty' => $request['total_no_qty'],
            'seal_no' => $request['seal_no'],
            'dispatch_date' => $request['dispatch_date'],
            'dispatch_by' => $request->dispatch_by,
            'remark' => $request['remark'],

        ];

        $result = FinishedGoodsDispatch::create($data);

        if ($result) {
            return redirect("dispatch_finished_goods")->with('success', "Data created successfully");
        }
    }

    public function view_dispatch_finished($id)
    {


        $data['finished_good'] = FinishedGoodsDispatch::select(
            'finished_goods_dispatch.*',
            'grades.grade as grades_name',
            'suppliers.name as suppliers_name',
            'mode_of_dispatch.mode as mode_name'
        )
            ->leftJoin("suppliers", "suppliers.id", "=", "finished_goods_dispatch.dispatch_by")
            ->leftJoin("grades", "grades.id", "=", "finished_goods_dispatch.grade")
            ->leftJoin("mode_of_dispatch", "mode_of_dispatch.id", "=", "finished_goods_dispatch.mode_of_dispatch")
            ->where("finished_goods_dispatch.id", $id)->get();
        return view('view_dispatch_finished', $data);
    }
    public function edit_dispatch_finished($id)
    {
        $supplier_master = Supplier::all();
        $mode = Modedispatch::where("publish",1)->get();
        $grade = Grade::all();
        $users = User::pluck("name","id");
        $finished = FinishedGoodsDispatch::where("id", $id)->first();
        return view("edit_dispatch_finished")->with(["finished" => $finished, "supplier_master" => $supplier_master, "mode" => $mode, "grade" => $grade,"users"=>$users]);
    }


    public function update_dispatch_finished(Request $request, $id)
    {

        $data = [
            'dispath_no' => $request['dispath_no'],
            'dispatch_form' => $request['dispatch_form'],
            'dispatch_to' => $request['dispatch_to'],
            'good_dispatch_date' => $request['good_dispatch_date'],
            'mode_of_dispatch' => $request['mode_of_dispatch'],
            'party_name' => $request['party_name'],
            'product' => $request['product'],
            'invoice_no' => $request['invoice_no'],
            'batch_no' => $request['batch_no'],
            'grade' => $request['grade'],
            'viscosity' => $request['viscosity'],
            'mfg_date' => $request['mfg_date'],
            'expiry_ratest_date' => $request['expiry_ratest_date'],
            'total_no_of_200kg_drums' => $request['total_no_of_200kg_drums'],
            'total_no_of_50kg_drums' => $request['total_no_of_50kg_drums'],
            'total_no_of_30kg_drums' => $request['total_no_of_30kg_drums'],
            'total_no_of_5kg_drums' => $request['total_no_of_5kg_drums'],
            'total_no_of_fiber_board_drums' => $request['total_no_of_fiber_board_drums'],
            'total_no_qty' => $request['total_no_qty'],
            'seal_no' => $request['seal_no'],
            'dispatch_date' => $request['dispatch_date'],
            'dispatch_by' => $request->dispatch_by,
            'remark' => $request['remark'],
        ];
        $finished = FinishedGoodsDispatch::find($id);

        $result = $finished->update($data);
        if ($result) {
            return redirect("dispatch_finished_goods")->with('update', "Data Update successfully");
        }
    }
    public function delete_dispatch_finished($id)
    {

        $finished = FinishedGoodsDispatch::where("id", $id)->delete();
        if ($finished) {

            return redirect("dispatch_finished_goods")->with('danger', "Data deleted successfully");
        }
    }
    public function dispacth_view(Request $request)
    {

        if($request->id)
        {
            $dispacth_view = FinishedGoodsDispatch::select(
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
                ->Join("users", "users.id", "=", "finished_goods_dispatch.dispatch_by")

            ->where("finished_goods_dispatch.id",$request->id)->first();
             $view = view('dispacth_view', ['dispacth_view'=> $dispacth_view])->render();
             return response()->json(['html'=>$view]);
            }
            else
            {
                redirect(404);
            }


    }
    public function getproductbatch(Request $request)
    {
        if($request->id)
        {

            $batch = Inwardfinishedgoods::where("product_name",$request->id)->where("total_quantity_bal",">",0)->pluck("batch_no","id");


            $data["batch"] = $batch;
            return response()->json($data);
        }
        else{
            redirect(404);
        }
    }
    public function getproductqtyofbatch(Request $request)
    {
        if($request->id && $request->rawmaterial)
        {

            $batch = Inwardfinishedgoods::where("product_name",$request->rawmaterial)->where("id",$request->id)->where(DB::raw("(total_quantity_bal)"),">",0)->first();
            if(isset($batch))
            {
                $data["total_no_of_200kg_drums"] = ($batch->total_no_of_200kg_drums_bal>0?$batch->total_no_of_200kg_drums_bal:0);
                $data["total_no_of_50kg_drums"] = ($batch->total_no_of_50kg_drums_bal>0?$batch->total_no_of_50kg_drums_bal:0);
                $data["total_no_of_30kg_drums"] = ($batch->total_no_of_30kg_drums_bal>0?$batch->total_no_of_30kg_drums_bal:0);
                $data["total_no_of_5kg_drums"] = ($batch->total_no_of_5kg_drums_bal>0?$batch->total_no_of_5kg_drums_bal:0);
                $data["total_no_of_fiber_board_drums"] = ($batch->total_no_of_fiber_board_drums_bal>0?$batch->total_no_of_fiber_board_drums_bal:0);
                $data["total_quantity"] = ($batch->total_quantity_bal>0?$batch->total_quantity_bal:0);
                $data["mfg_date"] = ($batch->mfg_date);
                $data["expiry_ratest_date"] = ($batch->expiry_ratest_date);
                $data["grade"] = ($batch->grade);
                $data["viscosity"] = ($batch->viscosity);
            }
            else
           {
               $data["total_no_of_200kg_drums"] = 0;
               $data["total_no_of_50kg_drums"] = 0;
               $data["total_no_of_30kg_drums"] = 0;
               $data["total_no_of_5kg_drums"] = 0;
               $data["total_no_of_fiber_board_drums"] =0;
               $data["total_quantity"] = 0;
               $data["mfg_date"] = "";
                $data["expiry_ratest_date"] = "";
                $data["grade"] = "";
                $data["viscosity"] ="";
            }

            return response()->json($data);
        }
        else{
            redirect(404);
        }
    }
}
