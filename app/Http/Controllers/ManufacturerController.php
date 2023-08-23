<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manufacturer;
class ManufacturerController extends Controller
{
    //
    public function __construct()
    {
        {
            $this->middleware('auth');
            $this->middleware('permission:manufacturer-list|manufacturer-add|manufacturer-edit|manufacturer-delete', ['only' => ['index','store']]);
            $this->middleware('permission:manufacturer-add', ['only' => ['create','store']]);
            $this->middleware('permission:manufacturer-edit', ['only' => ['edit','update']]);
            $this->middleware('permission:manufacturer-delete', ['only' => ['destroy']]);
    
        }


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //LISTING THE Departments
        $manufacturers = Manufacturer::get();

        return view("master.manufacturer.index")->with(["manufacturers"=>$manufacturers]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("master.manufacturer.create");
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
        $arrRules = ["manufacturer"=>"required|unique:manufacturers",
                     "publish"=>"required"];


        $arrMessages = [
        "manufacturer"=>"This :attribute field is required.",
        "manufacturer.unique"=>"This :attribute already in use.",

        "publish"=>"This :attribute field is required.",
        ];

        $attributes = array();
        foreach ($request->input() as $key => $val)
            $attributes[$key] = ucwords(str_replace("_", " ", $key));

        $validateData = $request->validate($arrRules, $arrMessages,$attributes);


        $data = array();
        $data["manufacturer"] = $request->manufacturer;
        $data["publish"] = $request->publish;

        $result = Manufacturer::create($data);

        if($result->id)
        {
            return redirect("manufacturer")->with('message', "Manufacturer created successfully");
        }
        else
            return redirect("manufacturer")->with('error', "Something went wrong");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

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
            $manufacturer = Manufacturer::where("id",$id)->first();

            return view("master.manufacturer.edit")->with(["manufacturer"=>$manufacturer]);
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
        $arrRules = ["manufacturer"=>"required|unique:manufacturers,manufacturer,id=".$id,
               "publish"=>"required"];

        $arrMessages = [
        "manufacturer"=>"This :attribute field is required.",
        "manufacturer.unique"=>"This :attribute already in use.",
        "publish"=>"This :attribute field is required.",
        ];

        $attributes = array();
        foreach ($request->input() as $key => $val)
        $attributes[$key] = ucwords(str_replace("_", " ", $key));

        $validateData = $request->validate($arrRules, $arrMessages,$attributes);


        $data = array();
        $data["manufacturer"] = $request->manufacturer;
        $data["publish"] = $request->publish;
        $manufacturer = Manufacturer::find($id);
        $result = $manufacturer->update($data);

        if($result)
        {
            return redirect("manufacturer")->with('message', "Manufacturer updated successfully");
        }
        else
            return redirect("manufacturer")->with('error', "Something went wrong");
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
        $manufacturer = Manufacturer::findOrFail($id);
        if($manufacturer)
        {
            $result = $manufacturer->delete();
            if($result)
            {
                return redirect("manufacturer")->with('message', "Manufacturer deleted successfully");
            }
            else
                return redirect("manufacturer")->with('error', "Something went wrong");
            }
    }
}
