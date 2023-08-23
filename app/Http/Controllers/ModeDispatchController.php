<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modedispatch;
class ModedispatchController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:modedispatch-list|modedispatch-add|modedispatch-edit|modedispatch-delete', ['only' => ['index','store']]);
        $this->middleware('permission:modedispatch-add', ['only' => ['create','store']]);
        $this->middleware('permission:modedispatch-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:modedispatch-delete', ['only' => ['destroy']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //LISTING THE Departments
        $modes = Modedispatch::get();

        return view("master.modedispatch.index")->with(["modes"=>$modes]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("master.modedispatch.create");
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
        $arrRules = ["mode"=>"required|unique:mode_of_dispatch,mode",
                     "publish"=>"required"];


        $arrMessages = [
        "mode"=>"This :attribute field is required.",
        "publish"=>"This :attribute field is required.",
        ];

        $attributes = array();
        foreach ($request->input() as $key => $val)
            $attributes[$key] = ucwords(str_replace("_", " ", $key));

        $validateData = $request->validate($arrRules, $arrMessages,$attributes);


        $data = array();
        $data["mode"] = $request->mode;
        $data["publish"] = $request->publish;

        $result = Modedispatch::create($data);

        if($result->id)
        {
            return redirect("modedispatch")->with('message', "Mode of dispatch created successfully");
        }
        else
            return redirect("modedispatch")->with('error', "Something went wrong");

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
            $mode = Modedispatch::where("id",$id)->first();
            return view("master.modedispatch.edit")->with(["mode"=>$mode]);
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
        $arrRules = ["mode"=>"required|unique:mode_of_dispatch,mode,".$id,
                     "publish"=>"required"];


        $arrMessages = [
        "mode"=>"This :attribute field is required.",
        "publish"=>"This :attribute field is required.",
        ];

        $attributes = array();
        foreach ($request->input() as $key => $val)
            $attributes[$key] = ucwords(str_replace("_", " ", $key));

        $validateData = $request->validate($arrRules, $arrMessages,$attributes);


        $data = array();
        $data["mode"] = $request->mode;
        $data["publish"] = $request->publish;
        $mode = Modedispatch::find($id);
        $result = $mode->update($data);

        if($result)
        {
            return redirect("modedispatch")->with('message', "Mode of dispatch updated successfully");
        }
        else
            return redirect("modedispatch")->with('error', "Something went wrong");
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
        $grade = Modedispatch::findOrFail($id);
        if($grade)
        {
            $result = $grade->delete();
            if($result)
            {
                return redirect("modedispatch")->with('message', "Mode of dispatch deleted successfully");
            }
            else
                return redirect("modedispatch")->with('error', "Something went wrong");
            }
    }
}
