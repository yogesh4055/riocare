<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Action;
use App\Models\Maincontroller;
class ActionController extends Controller
{
    //
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
        $actions = Action::select("actions.*","controllers.controller as controller_name")->join("controllers","controllers.id","actions.controller_id")->get();

        return view("master.action.index")->with(["actions"=>$actions]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $controllers = Maincontroller::where("publish",1)->pluck("controller","id");
        return view("master.action.create")->with(["controllers"=>$controllers]);
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
        $arrRules = ["action"=>"required|composite_unique:actions,action,controller_id",
                     "controller_id"=>"required",
                     "publish"=>"required"];


        $arrMessages = [
        "action"=>"This :attribute field is required.",
        "action.composite_unique"=>"This :attribute already in use.",
        "controller_id"=>"This :attribute field is required.",
        "publish"=>"This :attribute field is required.",
        ];

        $attributes = array();
        foreach ($request->input() as $key => $val)
            $attributes[$key] = ucwords(str_replace("_", " ", $key));

        $validateData = $request->validate($arrRules, $arrMessages,$attributes);


        $data = array();
        $data["action"] = $request->action;
        $data["controller_id"] = $request->controller_id;
        $data["publish"] = $request->publish;

        $result = Action::create($data);

        if($result->id)
        {
            return redirect("action")->with('message', "Action created successfully");
        }
        else
            return redirect("action")->with('error', "Something went wrong");

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
            $action = Action::where("id",$id)->first();
            $controllers = Maincontroller::where("publish",1)->pluck("controller","id");
            return view("master.action.edit")->with(["action"=>$action,"controllers"=>$controllers]);
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
        $arrRules = ["action"=>"required|composite_unique:actions,action,controller_id,id=".$id,
        "controller_id"=>"required",
        "publish"=>"required"];

        $arrMessages = [
        "action"=>"This :attribute field is required.",
        "action.composite_unique"=>"This :attribute already in use.",
        "controller_id"=>"This :attribute field is required.",
        "publish"=>"This :attribute field is required.",
        ];

        $attributes = array();
        foreach ($request->input() as $key => $val)
        $attributes[$key] = ucwords(str_replace("_", " ", $key));

        $validateData = $request->validate($arrRules, $arrMessages,$attributes);


        $data = array();
        $data["action"] = $request->action;
        $data["controller_id"] = $request->controller_id;
        $data["publish"] = $request->publish;
        $action = Action::find($id);
        $result = $action->update($data);

        if($result)
        {
            return redirect("action")->with('message', "Action updated successfully");
        }
        else
            return redirect("action")->with('error', "Something went wrong");
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
        $action = Action::findOrFail($id);
        if($action)
        {
            $result = $action->delete();
            if($result)
            {
                return redirect("action")->with('message', "Action deleted successfully");
            }
            else
                return redirect("action")->with('error', "Something went wrong");
            }
    }
}
