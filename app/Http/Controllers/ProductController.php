<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductMaster;

class ProductController extends Controller
{
    public function product()

    {
        $data['product_master']=ProductMaster::all();
        return view('master.product.product',$data);
    }
    public function new_product()

    {
      return view('master.product.new_product');
    }
    public function product_insert(Request $request)
    {

        $data = [
            'name' => $request['name'],

        ];

        $result = ProductMaster::create($data);

        if ($result) {
            return redirect("product")->with('success', "Data created successfully");
        }
    }

    public function edit_product($id)
    {
        $edit_product = ProductMaster::where("id", $id)->first();
        return view("master.product.edit_product")->with(["edit_product" => $edit_product]);
    }
    public function delete_product($id)
    {

        $product = ProductMaster::where("id", $id)->delete();
        if ($product) {

            return redirect("product")->with('danger', "Data deleted successfully");
        }
    }
    public function product_update(Request $request,$id)
    {

        $data = [
            'name' => $request['name'],

        ];
        $arno = ProductMaster::find($id);
        $result = $arno->update($data);


        if ($result) {
            return redirect("product")->with('update', "Data Update successfully");
        }
    }
}
