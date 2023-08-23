<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Arnomaster;

class ARnoController extends Controller
{
    public function ar_no()
    {
        $data['arno_master'] = Arnomaster::all();
        return view("master.Arno.ar_no", $data);
    }
    public function new_ar_no()
    {
        return view("master.Arno.new_ar_no");
    }
    public function ar_no_insert(Request $request)
    {

        $data = [
            'name' => $request['name'],

        ];

        $result = Arnomaster::create($data);

        if ($result) {
            return redirect("ar_no")->with('success', "Data created successfully");
        }
    }

    public function edit_arno($id)
    {
        $arno = Arnomaster::where("id", $id)->first();
        return view("master.Arno.edit_arno")->with(["arno" => $arno]);
    }
    public function delete_arno($id)
    {

        $arno = Arnomaster::where("id", $id)->delete();
        if ($arno) {

            return redirect("ar_no")->with('danger', "Data deleted successfully");
        }
    }
    public function ar_no_update(Request $request,$id)
    {

        $data = [
            'name' => $request['name'],

        ];
        $arno = Arnomaster::find($id);
        $result = $arno->update($data);


        if ($result) {
            return redirect("ar_no")->with('update', "Data Update successfully");
        }
    }
}
