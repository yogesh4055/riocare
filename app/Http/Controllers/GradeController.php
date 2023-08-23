<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
class GradeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:grade-list|grade-add|grade-edit|grade-delete', ['only' => ['index','store']]);
        $this->middleware('permission:grade-add', ['only' => ['create','store']]);
        $this->middleware('permission:grade-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:grade-delete', ['only' => ['destroy']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //LISTING THE Departments
        $grades = Grade::get();

        return view("master.grade.index")->with(["grades"=>$grades]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("master.grade.create");
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
        $arrRules = ["grade"=>"required|unique:grades,grade",
                     "publish"=>"required"];


        $arrMessages = [
        "grade"=>"This :attribute field is required.",
        "publish"=>"This :attribute field is required.",
        ];

        $attributes = array();
        foreach ($request->input() as $key => $val)
            $attributes[$key] = ucwords(str_replace("_", " ", $key));

        $validateData = $request->validate($arrRules, $arrMessages,$attributes);


        $data = array();
        $data["grade"] = $request->grade;
        $data["publish"] = $request->publish;

        $result = Grade::create($data);

        if($result->id)
        {
            return redirect("grade")->with('message', "Grade created successfully");
        }
        else
            return redirect("grade")->with('error', "Something went wrong");

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
            $grade = Grade::where("id",$id)->first();
            return view("master.grade.edit")->with(["grade"=>$grade]);
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
        $arrRules = ["grade"=>"required|unique:grades,grade,".$id,
                     "publish"=>"required"];


        $arrMessages = [
        "grade"=>"This :attribute field is required.",
        "publish"=>"This :attribute field is required.",
        ];

        $attributes = array();
        foreach ($request->input() as $key => $val)
            $attributes[$key] = ucwords(str_replace("_", " ", $key));

        $validateData = $request->validate($arrRules, $arrMessages,$attributes);


        $data = array();
        $data["grade"] = $request->grade;
        $data["publish"] = $request->publish;
        $grade = Grade::find($id);
        $result = $grade->update($data);

        if($result)
        {
            return redirect("grade")->with('message', "Grade updated successfully");
        }
        else
            return redirect("grade")->with('error', "Something went wrong");
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
        $grade = Grade::findOrFail($id);
        if($grade)
        {
            $result = $grade->delete();
            if($result)
            {
                return redirect("grade")->with('message', "Grade deleted successfully");
            }
            else
                return redirect("grade")->with('error', "Something went wrong");
            }
    }
}
