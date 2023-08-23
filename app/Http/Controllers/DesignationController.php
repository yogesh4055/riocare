<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Designation;
class DesignationController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //LISTING THE Departments
        $designations = Designation::get();

        return view("master.designation.index")->with(["designations"=>$designations]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("master.designation.create");
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
        $arrRules = ["designation"=>"required|unique:designations,designation",
                     "publish"=>"required"];


        $arrMessages = [
        "designation"=>"This :attribute field is required.",
        "publish"=>"This:attribute field is required.",
        ];

        $attributes = array();
        foreach ($request->input() as $key => $val)
            $attributes[$key] = ucwords(str_replace("_", " ", $key));

        $validateData = $request->validate($arrRules, $arrMessages,$attributes);


        $data = array();
        $data["designation"] = $request->designation;
        $data["publish"] = $request->publish;

        $result = Designation::create($data);

        if($result->id)
        {
            return redirect("designation")->with('message', "Designation created successfully");
        }
        else
            return redirect("designation")->with('error', "Something went wrong");

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
            $designation = Designation::where("id",$id)->first();
            return view("master.designation.edit")->with(["designation"=>$designation]);
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
        $arrRules = ["designation"=>"required|unique:designations,designation,".$id,
                     "publish"=>"required"];


        $arrMessages = [
        "designation"=>"This :attribute field is required.",
        "publish"=>"This :attribute field is required.",
        ];

        $attributes = array();
        foreach ($request->input() as $key => $val)
            $attributes[$key] = ucwords(str_replace("_", " ", $key));

        $validateData = $request->validate($arrRules, $arrMessages,$attributes);


        $data = array();
        $data["designation"] = $request->designation;
        $data["publish"] = $request->publish;
        $designation = Designation::find($id);
        $result = $designation->update($data);

        if($result)
        {
            return redirect("designation")->with('message', "Designation updated successfully");
        }
        else
            return redirect("designation")->with('error', "Something went wrong");
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
        $designation = Designation::findOrFail($id);
        if($designation)
        {
            $result = $designation->delete();
            if($result)
            {
                return redirect("designation")->with('message', "Designation deleted successfully");
            }
            else
                return redirect("designation")->with('error', "Something went wrong");
            }
    }
}
