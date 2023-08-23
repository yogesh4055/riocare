<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maincontroller;
class MaincontrollerController extends Controller
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
        //LISTING THE controllers
        $controllers = Maincontroller::get();

        return view("master.controller.index")->with(["controllers"=>$controllers]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Maincontroller::where("is_menu",1)->pluck("menu_name","id");
        return view("master.controller.create")->with(["menus"=>$menus]);
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
        $arrRules = ["controller"=>"required|unique:controllers,controller",
                     "publish"=>"required"];


        $arrMessages = [
        "controller"=>"This :attribute field is required.",
        "publish"=>"This :attribute field is required.",
        ];

        $attributes = array();
        foreach ($request->input() as $key => $val)
            $attributes[$key] = ucwords(str_replace("_", " ", $key));

        $validateData = $request->validate($arrRules, $arrMessages,$attributes);


        $data = array();
        $data["controller"] = $request->controller;
        $data["is_menu"] = $request->ismenu;
        $data["menu_name"] = $request->menuname;
        $data["parent"] = $request->parent?$request->parent:0;
        $data["order"] = $request->menuorder?$request->menuorder:0;
        $data["publish"] = $request->publish;

        $result = Maincontroller::create($data);

        if($result->id)
        {
            return redirect("controller")->with('message', "Controller created successfully");
        }
        else
            return redirect("controller")->with('error', "Something went wrong");

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
            $menus = Maincontroller::where("is_menu",1)->where("id","<>",$id)->pluck("menu_name","id");
            $controller = Maincontroller::where("id",$id)->first();
            return view("master.controller.edit")->with(["controller"=>$controller,"menus"=>$menus]);
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
    public function editsave(Request $request, $id)
    {
        //
        $arrRules = ["controller"=>"required|unique:controllers,controller,".$id,
                     "publish"=>"required"];


        $arrMessages = [
        "controller"=>"This :attribute field is required.",
        "publish"=>"This :attribute field is required.",
        ];

        $attributes = array();
        foreach ($request->input() as $key => $val)
            $attributes[$key] = ucwords(str_replace("_", " ", $key));

        $validateData = $request->validate($arrRules, $arrMessages,$attributes);


        $data = array();
        $data["controller"] = $request->controller;
        $data["is_menu"] = $request->ismenu;
        $data["menu_name"] = $request->menuname;
        $data["parent"] = $request->parent?$request->parent:0;
        $data["order"] = $request->menuorder?$request->menuorder:0;
        $data["publish"] = $request->publish;

        $controller = Maincontroller::find($id);
        $result = $controller->update($data);

        if($result)
        {
            return redirect("controller")->with('message', "Controller updated successfully");
        }
        else
            return redirect("controller")->with('error', "Something went wrong");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function remove($id)
    {
        //
        $controller = Maincontroller::findOrFail($id);
        if($controller)
        {
            $result = $controller->delete();
            if($result)
            {
                return redirect("controller")->with('message', "Controller deleted successfully");
            }
            else
                return redirect("controller")->with('error', "Something went wrong");
            }
    }
}
