<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\ErrorHandler\Debug;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:department-list|department-add|department-edit|department-delete', ['only' => ['index','store']]);
        $this->middleware('permission:department-add', ['only' => ['create','store']]);
        $this->middleware('permission:department-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:department-delete', ['only' => ['destroy']]);


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //LISTING THE Departments
        $departments = Department::get();

        return view("master.department.index")->with(["departments"=>$departments]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("master.department.create");
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
        $arrRules = ["department"=>"required|unique:department,department",
                    "dep_type"=>"required",
                     "publish"=>"required"];


        $arrMessages = [
        "department"=>"This :attribute field is required.",
        "dep_type"=>"This :attribute field is required.",
        "publish"=>"This :attribute field is required.",
        ];

        $attributes = array();
        foreach ($request->input() as $key => $val)
            $attributes[$key] = ucwords(str_replace("_", " ", $key));

        $validateData = $request->validate($arrRules, $arrMessages,$attributes);


        $data = array();
        $data["department"] = $request->department;
        $data["publish"] = $request->publish;
        $data["department_type"] = $request->dep_type;

        $result = Department::create($data);

        if($result->id)
        {
            return redirect("department")->with('message', "Department created successfully");
        }
        else
            return redirect("department")->with('error', "Something went wrong");

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
            $department = Department::where("id",$id)->first();
            return view("master.department.edit")->with(["department"=>$department]);
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
        $arrRules = ["department"=>"required|unique:department,department,".$id,
                    "dep_type"=>"required",
                    "publish"=>"required"];


            $arrMessages = [
            "department"=>"This :attribute field is required.",
            "dep_type"=>"This :attribute field is required.",
            "publish"=>"This :attribute field is required.",
            ];

            $attributes = array();
            foreach ($request->input() as $key => $val)
            $attributes[$key] = ucwords(str_replace("_", " ", $key));

            $validateData = $request->validate($arrRules, $arrMessages,$attributes);


            $data = array();
            $data["department"] = $request->department;
            $data["publish"] = $request->publish;
            $data["department_type"] = $request->dep_type;

        $department = Department::find($id);
        $result = $department->update($data);

        if($result)
        {
            return redirect("department")->with('message', "Department updated successfully");
        }
        else
            return redirect("department")->with('error', "Something went wrong");
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
        $department = Department::findOrFail($id);
        if($department)
        {
            $result = $department->delete();
            if($result)
            {
                return redirect("department")->with('message', "Department deleted successfully");
            }
            else
                return redirect("department")->with('error', "Something went wrong");
            }
    }

}
