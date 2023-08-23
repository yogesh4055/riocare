<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inwardfinishedgoods;
use App\Models\Grade;
use App\Models\Arnomaster;
use App\Models\Supplier;
use App\Models\Rawmeterial;
use App\Models\Stock;
use App\Models\User;
use App\Models\Qualitycontroll;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class InwardFinishedController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:inward-finished-goods-new-stock-list|inward-finished-goods-new-stock-add', ['only' => ['new_stock','inward_finished_insert']]);
         $this->middleware('permission:inward-finished-goods-new-stock-add', ['only' => ['new_stock_add','inward_finished_insert']]);
      }

    public function new_stock()
    {

        $data['inward_goods']=Inwardfinishedgoods::select("inward_finished_goods.*","raw_materials.material_name","users.name","inward_finished_goods.created_at as createdat")->join("raw_materials","raw_materials.id","inward_finished_goods.product_name")->join("users","users.id","inward_finished_goods.received_by")->orderby("inward_finished_goods.created_at",'desc')->get();

        return view('new_stock',$data);
    }
    public function viewstock(Request $request)
    {

        if($request->id)
        {
             $inward_goods = Inwardfinishedgoods::select("inward_finished_goods.*"
             ,"raw_materials.material_name","inward_finished_goods.grade",
             "users.name")->join("raw_materials","raw_materials.id",
             "inward_finished_goods.product_name")

             ->join("users","users.id","inward_finished_goods.received_by")
             ->where("inward_finished_goods.id",$request->id)->first();
             $view = view('view_new_stock', ['inward_goods'=> $inward_goods])->render();
             return response()->json(['html'=>$view]);

        }
        else
        {
            redirect(404);
        }

       }
    public function new_stock_add()
    {
        $data["product"] = Rawmeterial::where("material_type","F")->pluck("material_name","id");
        $data['grade_master']=Grade::all();
        $data['supplier_master']=Supplier::all();
        $data['arno_master']=Arnomaster::all();
        $maxid = Inwardfinishedgoods::select(DB::Raw("max(inward_no) as nextid"))->first();
        $data['users'] = User::pluck("name","id");
        $nextid =1;
        if($maxid->nextid)
            $nextid = $maxid->nextid+1;
        $data["nextid"] = $nextid;
        return view('new_stock_add',$data);
    }
    public function inward_finished_insert(Request $request)
    {

        // $arrRules = [
        //      "inward_no"=>"required",
        //      "inward_date" => "required",
        //      "product_name" => "required",
        //      "batch_no" => "required",
        //      "grade" => "required",
        //      "viscosity" => "required",
        //      "mfg_date" => "required",
        //      "expiry_ratest_date" => "required",
        //      "total_no_of_200kg_drums" => "required",
        //      "total_no_of_50kg_drums" => "required",
        //      "total_no_of_30kg_drums" => "required",
        //      "total_no_of_5kg_drums" => "required",
        //      "total_no_of_fiber_board_drums" => "required",
        //      "total_quantity" => "required",
        //      "total_no_of_200kg_drums_bal" => "required",
        //      "total_no_of_50kg_drums_bal" => "required",
        //      "total_no_of_30kg_drums_bal" => "required",
        //      "total_no_of_5kg_drums_bal" => "required",
        //      "total_no_of_fiber_board_drums_bal" => "required",
        //      "total_quantity_bal" => "required",
        //      "ar_no" => "required",
        //      "approval_data" => "required",
        //      "remark" => "required",
        //     ];
        //     $arrMessages = [
        //         "inward_date"=>"Please  This :attribute field is required.",
        //         "product_name"=>"This :attribute field is required.",
        //         "batch_no"=>"Please  This :attribute field is required.",
        //         "grade"=>"This :attribute field is required.",
        //         "viscosity"=>"This :attribute field is required.",
        //         "mfg_date"=>"Please  This :attribute field is required.",
        //         "expiry_ratest_date"=>"Please  Enter This :attribute field is required.",
        //         "total_no_of_200kg_drums"=>"Please  Enter The Name This :attribute field is required.",
        //         "total_no_of_50kg_drums"=>"Please  This :attribute field is required.",
        //         "total_no_of_30kg_drums"=>"Please  This :attribute field is required.",
        //         "total_no_of_5kg_drums"=>"Please  This :attribute field is required.",
        //         "total_no_of_fiber_board_drums"=>"Please  Enter The Name Total This :attribute field is required.",
        //         "total_quantity"=>"Please  This :attribute field is required.",
        //         "ar_no"=>"Please  This :attribute field is required.",
        //         "approval_data"=>"Please  This :attribute field is required.",
        //         "received_by"=>"Please  This :attribute field is required.",
        //         "remark"=>"This :attribute field is required.",
        //      ];
        //     $validateData = $request->validate($arrRules, $arrMessages);
         try {
            $data = [
            'inward_no'=>$request->rno,
            'inward_date' => $request['inward_date'],
            'product_name' => $request['product_name'],
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
            'total_quantity' => $request['total_quantity'],
            'total_no_of_200kg_drums_bal' => $request['total_no_of_200kg_drums'],
            'total_no_of_50kg_drums_bal' => $request['total_no_of_50kg_drums'],
            'total_no_of_30kg_drums_bal' => $request['total_no_of_30kg_drums'],
            'total_no_of_5kg_drums_bal' => $request['total_no_of_5kg_drums'],
            'total_no_of_fiber_board_drums_bal' => $request['total_no_of_fiber_board_drums'],
            'total_quantity_bal' => $request['total_quantity'],
            'ar_no' => $request['ar_no'],
            'ar_no_date' => $request['ar_no_date']?$request['ar_no_date']:"",
            'approval_data' => date('Y-m-d'),
            'received_by' => Auth::user()->id,
            'remark' => $request['remark'],
            'is_opening_stock'=> ($request['openingstock']?$request['openingstock']:0)

        ];

       $result= Inwardfinishedgoods::create($data);

        if($result)
        {
                $stock = Rawmeterial::where("id",$request['product_name'])->first();
                $datas["material_stock"] = ($stock->material_stock+$request['total_quantity']);
                $stock->update($datas);

                $stockarr = array();

                $stockarr["matarial_id"] = $request['product_name'];
                $stockarr["material_type"] = "F";
                $stockarr["department"] = 3;
                $stockarr["qty"] = $request['total_quantity'];
                $stockarr["batch_no"] = $result->id;
                $stockarr["process_batch_id"] = $result->id;
                $stockarr["ar_no_date"] = $request['ar_no'];
                $stockarr["type"] = "F";


                $stid = Stock::create($stockarr);

                $stock = Rawmeterial::find($request['product_name']);
                if($stock)
                {
                    $sdata["material_stock"] = $stock->material_stock+$request['total_quantity'];
                    $stock->update($sdata);
                }
                

            
            return redirect("new_stock")->with('success', "Data created successfully");
        } else {
            DB::rollback();
                 return redirect(route("new_stock"))->with('error', "Something went wrong");
            }
        } catch (\Exception $e) {
            DB::rollback();
            dd("Exception",$e);
            return redirect(route("new_stock"))->with('error', "Something went wrong");
        }
    }
}
