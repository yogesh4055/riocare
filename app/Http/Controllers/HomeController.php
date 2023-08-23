<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\InwardMaterial;
use App\Models\Supplier;
use App\Models\Manufacturer;
use App\Models\Rawmeterial;
use App\Models\Rawmaterialitems;
use App\Models\Inwardfinishedgoods;
use App\Models\Stock;
use DB;
use Carbon\Carbon;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $stock = Stock::select(DB::raw("(sum(qty)-sum(used_qty)) as qty_rem"),"raw_materials.material_name")->join("raw_materials","raw_materials.id","stock.matarial_id")->where("stock.material_type","R")->groupBy("raw_materials.id")->get();

        $stocktotalRaw = Stock::select(DB::raw("(sum(qty)-sum(used_qty)) as qty_rem"),"raw_materials.material_name")->join("raw_materials","raw_materials.id","stock.matarial_id")->where("stock.material_type","R")->first();

        $stocktoday = Stock::select(DB::raw("(sum(qty)-sum(used_qty)) as qty_rem"),"raw_materials.material_name")->join("raw_materials","raw_materials.id","stock.matarial_id")->where("stock.material_type","F")->whereDate('stock.created_at', Carbon::today())->first();

        $stockmonthaly = Stock::select(DB::raw("(sum(qty)-sum(used_qty)) as qty_rem"),"raw_materials.material_name",DB::raw('MONTHNAME(stock.created_at) as month'))->join("raw_materials","raw_materials.id","stock.matarial_id")->where("stock.material_type","F")->groupBy(DB::raw('month(stock.created_at)'))->get();

       

        $stocktall = Stock::select(DB::raw("(sum(qty)-sum(used_qty)) as qty_rem"),"raw_materials.material_name")->join("raw_materials","raw_materials.id","stock.matarial_id")->where("stock.material_type","F")->first();

        return view('home',compact('stock','stocktoday','stocktall','stocktotalRaw','stockmonthaly'));
    }
    public function comingsoon()
    {
        return view('comming-soon');
    }
}
