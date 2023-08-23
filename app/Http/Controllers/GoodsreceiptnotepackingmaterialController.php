<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NameMaterialMaster;
use App\Models\NameSupplierMaster;
class GoodsreceiptnotepackingmaterialController extends Controller
{
   public function inward_packing_material()
   {

       return view('admin.pinward_packing_material');
   }

   public function add_inward_packing_material()
   {

    return view('admin.add_inward_packing_material');
   }
}
