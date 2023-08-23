<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use DB;
class SupplierController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permission:suppliers-list|suppliers-add|suppliers-edit|suppliers-delete', ['only' => ['index','store']]);
        $this->middleware('permission:suppliers-add', ['only' => ['create','store']]);
        $this->middleware('permission:suppliers-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:suppliers-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //LISTING THE Departments
        $suppliers = Supplier::get();
        
        return view("master.supplier.index")->with(["suppliers"=>$suppliers]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = DB::table("state")->orderBy("state","asc")->pluck("state","id");
        return view("master.supplier.create")->with(["state"=>$states]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $arrRules = ["supplier"=>"required|unique:suppliers,name",
                    "city"=>"required",
                    "state"=>"required",
                    "address"=>"required",
                    "company_name"=>"required",
                    "contact_per_name"=>"required",
                    "contact_number"=>"required",
                     "publish"=>"required"];


        $arrMessages = [
        "supplier"=>"This :attribute field is required.",
        "supplier.unique"=>"This :attribute already in use.",
        "city"=>"This :attribute field is required.",
        "state"=>"This :attribute field is required.",
        "address"=>"This :attribute field is required.",
        "company_name"=>"This :attribute field is required.",
        "contact_per_name"=>"This :attribute field is required.",
        "contact_number"=>"This :attribute field is required.",
        "publish"=>"This :attribute field is required.",
        ];

        $attributes = array();
        foreach ($request->input() as $key => $val)
            $attributes[$key] = ucwords(str_replace("_", " ", $key));

        $validateData = $request->validate($arrRules, $arrMessages,$attributes);


        $data = array();
        $data["name"] = $request->supplier;
        $data["city"] = $request->city;
        $data["state"] = $request->state;
        $data["address"] = $request->address;
        $data["contact_no"] = $request->contact_number;
        $data["gst_no"] = $request->gst;
        $data["pan_no"] = $request->gst;
        $data["contact_per_name"] = $request->contact_per_name;
        $data["company_name"] = $request->company_name;
        $data["phone_number"] = $request->phone_number;
        $data["publish"] = $request->publish;


        $result = Supplier::create($data);

        if($result->id)
        {
            return redirect("supplier")->with('message', "Supplier created successfully");
        }
        else
            return redirect("supplier")->with('error', "Something went wrong");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        if($request->id)
        {
            $supplier = Supplier::select("suppliers.*","state.state as state_name")->where("suppliers.id",$request->id)->leftJoin("state","state.id","suppliers.state")->first();
             $view = view('master.supplier.view', ['supllier'=> $supplier])->render();
             return response()->json(['html'=>$view]);

        }
        else
        {
            redirect(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if($id)
        {
            $supplier = Supplier::where("id",$id)->first();
            $states = DB::table("state")->orderBy("state","asc")->pluck("state","id");
            return view("master.supplier.edit")->with(["supplier"=>$supplier,"state"=>$states]);
        }
        else
            redirect(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $arrRules = ["supplier"=>"required|unique:suppliers,name,".$id,
                    "city"=>"required",
                    "state"=>"required",
                    "address"=>"required",
                    "company_name"=>"required",
                    "contact_per_name"=>"required",
                    "contact_number"=>"required",
                     "publish"=>"required"];


        $arrMessages = [
        "supplier"=>"This :attribute field is required.",
        "supplier.unique"=>"This :attribute already in use.",
        "city"=>"This :attribute field is required.",
        "state"=>"This :attribute field is required.",
        "address"=>"This :attribute field is required.",
        "company_name"=>"This :attribute field is required.",
        "contact_per_name"=>"This :attribute field is required.",
        "contact_number"=>"This :attribute field is required.",
        "publish"=>"This :attribute field is required.",
        ];

        $attributes = array();
        foreach ($request->input() as $key => $val)
            $attributes[$key] = ucwords(str_replace("_", " ", $key));

        $validateData = $request->validate($arrRules, $arrMessages,$attributes);


        $data = array();
        $data["name"] = $request->supplier;
        $data["city"] = $request->city;
        $data["state"] = $request->state;
        $data["address"] = $request->address;
        $data["contact_no"] = $request->contact_number;
        $data["gst_no"] = $request->gst;
        $data["pan_no"] = $request->gst;
        $data["contact_per_name"] = $request->contact_per_name;
        $data["company_name"] = $request->company_name;
        $data["phone_number"] = $request->phone_number;
        $data["publish"] = $request->publish;
        $supplier = Supplier::find($id);
        $result = $supplier->update($data);

        if($result)
        {
            return redirect("supplier")->with('message', "Supplier updated successfully");
        }
        else
            return redirect("supplier")->with('error', "Something went wrong");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $supplier = Supplier::findOrFail($id);
        if($supplier)
        {
            $result = $supplier->delete();
            if($result)
            {
                return redirect("supplier")->with('message', "Supplier deleted successfully");
            }
            else
                return redirect("supplier")->with('error', "Something went wrong");
            }
    }
}
