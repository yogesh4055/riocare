<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('optimize');
    // $exitCode = Artisan::call('config:cache');
    return '<h1>Cache cleared</h1>';
});
Auth::routes();


$router->group(['middleware' => ['auth']], function ($router) {

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Department managment
    Route::get("department", [App\Http\Controllers\DepartmentController::class, "index"])->name("department")->middleware("adminmaster");
    Route::get("new-department", [App\Http\Controllers\DepartmentController::class, "create"])->name("new-department")->middleware("adminmaster");;
    Route::post("department-store", [App\Http\Controllers\DepartmentController::class, "store"])->name("department-store")->middleware("adminmaster");;
    Route::get("/department/edit/{id}", [App\Http\Controllers\DepartmentController::class, "edit"])->name("edit-department")->middleware("adminmaster");;
    Route::post("department/update/{id}", [App\Http\Controllers\DepartmentController::class, "update"])->name("department-update")->middleware("adminmaster");;
    Route::get("/department/remove/{id}", [App\Http\Controllers\DepartmentController::class, "destroy"])->name("delete-department")->middleware("adminmaster");;


    // Role managment
    Route::get("role", [App\Http\Controllers\RoleController::class, "index"])->name("roles.index")->middleware("adminmaster");
    Route::get("roles/create", [App\Http\Controllers\RoleController::class, "create"])->name("new-role")->middleware("adminmaster");;
    Route::post("role-store", [App\Http\Controllers\RoleController::class, "store"])->name("roles.store")->middleware("adminmaster");;
    Route::get("/role/edit/{id}", [App\Http\Controllers\RoleController::class, "edit"])->name("roles.edit")->middleware("adminmaster");;
    Route::post("role/update/{id}", [App\Http\Controllers\RoleController::class, "update"])->name("roles.update")->middleware("adminmaster");;
    Route::get("/role/remove/{id}", [App\Http\Controllers\RoleController::class, "destroy"])->name("roles.destroy")->middleware("adminmaster");;


    // Designation managment
    Route::get("designation", [App\Http\Controllers\DesignationController::class, "index"])->name("designation")->middleware("adminmaster");
    Route::get("new-designation", [App\Http\Controllers\DesignationController::class, "create"])->name("new-designation")->middleware("adminmaster");;
    Route::post("designation-store", [App\Http\Controllers\DesignationController::class, "store"])->name("designation-store")->middleware("adminmaster");;
    Route::get("/designation/edit/{id}", [App\Http\Controllers\DesignationController::class, "edit"])->name("edit-designation")->middleware("adminmaster");;
    Route::post("designation/update/{id}", [App\Http\Controllers\DesignationController::class, "update"])->name("designation-update")->middleware("adminmaster");;
    Route::get("/designation/remove/{id}", [App\Http\Controllers\DesignationController::class, "destroy"])->name("delete-designation")->middleware("adminmaster");;


    // Grade managment
    Route::get("grade", [App\Http\Controllers\GradeController::class, "index"])->name("grade")->middleware("adminmaster");
    Route::get("new-grade", [App\Http\Controllers\GradeController::class, "create"])->name("new-grade")->middleware("adminmaster");;
    Route::post("grade-store", [App\Http\Controllers\GradeController::class, "store"])->name("grade-store")->middleware("adminmaster");;
    Route::get("/grade/edit/{id}", [App\Http\Controllers\GradeController::class, "edit"])->name("edit-grade")->middleware("adminmaster");;
    Route::post("grade/update/{id}", [App\Http\Controllers\GradeController::class, "update"])->name("grade-update")->middleware("adminmaster");;
    Route::get("/grade/remove/{id}", [App\Http\Controllers\GradeController::class, "destroy"])->name("delete-grade")->middleware("adminmaster");;


    // Mode of Dispatch managment
    Route::get("modedispatch", [App\Http\Controllers\ModedispatchController::class, "index"])->name("modedispatch")->middleware("adminmaster");
    Route::get("new-modedispatch", [App\Http\Controllers\ModedispatchController::class, "create"])->name("new-modedispatch")->middleware("adminmaster");;
    Route::post("modedispatch-store", [App\Http\Controllers\ModedispatchController::class, "store"])->name("modedispatch-store")->middleware("adminmaster");;
    Route::get("/modedispatch/edit/{id}", [App\Http\Controllers\ModedispatchController::class, "edit"])->name("edit-modedispatch")->middleware("adminmaster");;
    Route::post("modedispatch/update/{id}", [App\Http\Controllers\ModedispatchController::class, "update"])->name("modedispatch-update")->middleware("adminmaster");;
    Route::get("/modedispatch/remove/{id}", [App\Http\Controllers\ModedispatchController::class, "destroy"])->name("delete-modedispatch")->middleware("adminmaster");;



    // Action managment
    Route::get("action",[App\Http\Controllers\ActionController::class,"index"])->name("action")->middleware("adminmaster");
    Route::get("new-ar_no",[App\Http\Controllers\ActionController::class,"create"])->name("new-action")->middleware("adminmaster");;
    Route::post("action-store",[App\Http\Controllers\ActionController::class,"store"])->name("action-store")->middleware("adminmaster");;
    Route::get("/action/edit/{id}",[App\Http\Controllers\ActionController::class,"edit"])->name("edit-action")->middleware("adminmaster");;
    Route::post("action/update/{id}",[App\Http\Controllers\ActionController::class,"update"])->name("action-update")->middleware("adminmaster");;
    Route::get("/action/remove/{id}",[App\Http\Controllers\ActionController::class,"destroy"])->name("delete-action")->middleware("adminmaster");;
     // Ar no master
    Route::get("ar_no",[App\Http\Controllers\ARnoController::class,"ar_no"])->name("ar_no")->middleware("adminmaster");
    Route::get("new_ar_no",[App\Http\Controllers\ARnoController::class,"new_ar_no"])->name("new_ar_no")->middleware("adminmaster");
    Route::post("ar_no_insert",[App\Http\Controllers\ARnoController::class,"ar_no_insert"])->name("ar_no_insert")->middleware("adminmaster");
    Route::get("edit_arno/{id}",[App\Http\Controllers\ARnoController::class,"edit_arno"])->name("edit_arno")->middleware("adminmaster");
    Route::get("delete_arno/{id}",[App\Http\Controllers\ARnoController::class,"delete_arno"])->name("delete_arno")->middleware("adminmaster");
    Route::post("ar_no_update/{id}",[App\Http\Controllers\ARnoController::class,"ar_no_update"])->name("ar_no_update")->middleware("adminmaster");
    // Product Master
    Route::get("product",[App\Http\Controllers\ProductController::class,"product"])->name("product")->middleware("adminmaster");
    Route::get("new_product",[App\Http\Controllers\ProductController::class,"new_product"])->name("new_product")->middleware("adminmaster");
    Route::post("product_insert",[App\Http\Controllers\ProductController::class,"product_insert"])->name("product_insert")->middleware("adminmaster");
    Route::get("edit_product/{id}",[App\Http\Controllers\ProductController::class,"edit_product"])->name("edit_product")->middleware("adminmaster");
    Route::get("delete_product/{id}",[App\Http\Controllers\ProductController::class,"delete_product"])->name("delete_product")->middleware("adminmaster");
    Route::post("product_update/{id}",[App\Http\Controllers\ProductController::class,"product_update"])->name("product_update")->middleware("adminmaster");

    //party_master
    Route::get("party_master",[App\Http\Controllers\PartyController::class,"party_master"])->name("party_master")->middleware("adminmaster");
    Route::get("new_party_master",[App\Http\Controllers\PartyController::class,"new_party_master"])->name("new_party_master")->middleware("adminmaster");
    Route::post("party_master_insert",[App\Http\Controllers\PartyController::class,"party_master_insert"])->name("party_master_insert")->middleware("adminmaster");
    Route::get("edit_party_master/{id}",[App\Http\Controllers\PartyController::class,"edit_party_master"])->name("edit_party_master")->middleware("adminmaster");
    Route::post("update_party_master/{id}",[App\Http\Controllers\PartyController::class,"update_party_master"])->name("update_party_master")->middleware("adminmaster");
    Route::get("delete_party_master/{id}",[App\Http\Controllers\PartyController::class,"delete_party_master"])->name("delete_party_master")->middleware("adminmaster");

    // Controller managment
     Route::get("controller",[App\Http\Controllers\MaincontrollerController::class,"index"])->name("controller")->middleware("adminmaster");
     Route::get("new-controller",[App\Http\Controllers\MaincontrollerController::class,"create"])->name("new-controller")->middleware("adminmaster");;
     Route::post("controller-store",[App\Http\Controllers\MaincontrollerController::class,"store"])->name("controller-store")->middleware("adminmaster");;
     Route::get("/controller/edit/{id}",[App\Http\Controllers\MaincontrollerController::class,"edit"])->name("edit-controller")->middleware("adminmaster");;
     Route::post("controller/update/{id}",[App\Http\Controllers\MaincontrollerController::class,"editsave"])->name("controller-update")->middleware("adminmaster");;
     Route::get("/controller/remove/{id}",[App\Http\Controllers\MaincontrollerController::class,"remove"])->name("remove-controller")->middleware("adminmaster");;

      // Manufacturer managment
      Route::get("manufacturer",[App\Http\Controllers\ManufacturerController::class,"index"])->name("manufacturer")->middleware("adminmaster");
      Route::get("new-manufacturer",[App\Http\Controllers\ManufacturerController::class,"create"])->name("new-manufacturer")->middleware("adminmaster");;
      Route::post("manufacturer-store",[App\Http\Controllers\ManufacturerController::class,"store"])->name("manufacturer-store")->middleware("adminmaster");;
      Route::get("/manufacturer/edit/{id}",[App\Http\Controllers\ManufacturerController::class,"edit"])->name("edit-manufacturer")->middleware("adminmaster");;
      Route::post("manufacturer/update/{id}",[App\Http\Controllers\ManufacturerController::class,"update"])->name("manufacturer-update")->middleware("adminmaster");;
      Route::get("/manufacturer/remove/{id}",[App\Http\Controllers\ManufacturerController::class,"destroy"])->name("delete-manufacturer")->middleware("adminmaster");;

       // RawMaterial managment
       Route::get("rawmaterial",[App\Http\Controllers\RawmaterialController::class,"index"])->name("rawmaterial")->middleware("adminmaster");
       Route::get("new-rawmaterial",[App\Http\Controllers\RawmaterialController::class,"create"])->name("new-rawmaterial")->middleware("adminmaster");;
       Route::post("rawmaterial-store",[App\Http\Controllers\RawmaterialController::class,"store"])->name("rawmaterial-store")->middleware("adminmaster");;
       Route::get("/rawmaterial/edit/{id}",[App\Http\Controllers\RawmaterialController::class,"edit"])->name("edit-rawmaterial")->middleware("adminmaster");;
       Route::post("rawmaterial/update/{id}",[App\Http\Controllers\RawmaterialController::class,"update"])->name("rawmaterial-update")->middleware("adminmaster");;
       Route::get("/rawmaterial/remove/{id}",[App\Http\Controllers\RawmaterialController::class,"destroy"])->name("delete-rawmaterial")->middleware("adminmaster");;

        // Supplier managment
        Route::get("supplier",[App\Http\Controllers\SupplierController::class,"index"])->name("supplier")->middleware("adminmaster");
        Route::get("new-supplier",[App\Http\Controllers\SupplierController::class,"create"])->name("new-supplier")->middleware("adminmaster");;
        Route::post("supplier-store",[App\Http\Controllers\SupplierController::class,"store"])->name("supplier-store")->middleware("adminmaster");;
        Route::get("/supplier/edit/{id}",[App\Http\Controllers\SupplierController::class,"edit"])->name("edit-supplier")->middleware("adminmaster");;
        Route::post("supplier/update/{id}",[App\Http\Controllers\SupplierController::class,"update"])->name("supplier-update")->middleware("adminmaster");;
        Route::get("/supplier/remove/{id}",[App\Http\Controllers\SupplierController::class,"destroy"])->name("delete-supplier")->middleware("adminmaster");;
        Route::post("/supplier/view",[App\Http\Controllers\SupplierController::class,"show"])->name("show-supplier")->middleware("adminmaster");;


        // inward Raw Materials
        Route::get("inward-rawmaterials",[App\Http\Controllers\InwardMaterialController::class,"index"])->name("inward-rawmaterials");
        Route::get("inward-rawmaterials_add",[App\Http\Controllers\InwardMaterialController::class,"create"])->name("inward-rawmaterials_add");
        Route::post("inwardrawmaterial/save",[App\Http\Controllers\InwardMaterialController::class,"store"])->name("inwardrawmaterial-store");
        Route::get("inward-rawmaterials_edit/{id}",[App\Http\Controllers\InwardMaterialController::class,"edit"])->name("inward-rawmaterials_edit");
        Route::post("inwardrawmaterial/update",[App\Http\Controllers\InwardMaterialController::class,"update"])->name("inwardrawmaterial-update");
        Route::post("inwardrawmaterial/getsupllier",[App\Http\Controllers\InwardMaterialController::class,"getsupllier"])->name("inwardrawmaterial-supplier");
        Route::post("show-material",[App\Http\Controllers\InwardMaterialController::class,"showmaterail"])->name("show-material");

        Route::get("inwardpackingrawmaterial/list",[App\Http\Controllers\InwardPackingMaterialController::class,"index"])->name("inwardpackingrawmaterial-list");
        Route::post("inwardpackingrawmaterial/listAjax",[App\Http\Controllers\InwardPackingMaterialController::class,"listAjax"])->name("inwardpackingrawmaterial-listAjax");

        Route::get("inwardpackingrawmaterial/new",[App\Http\Controllers\InwardPackingMaterialController::class,"add"])->name("inwardpackingrawmaterial-new");
        Route::post("inwardpackingrawmaterial/save",[App\Http\Controllers\InwardPackingMaterialController::class,"store"])->name("inwardpackingrawmaterial-save");
        Route::post("inwardpackingrawmaterial/view",[App\Http\Controllers\InwardPackingMaterialController::class,"view"])->name("inwardpackingrawmaterial-view");
        Route::get("inwardpackingrawmaterial/edit/{id}",[App\Http\Controllers\InwardPackingMaterialController::class,"edit"])->name("inwardpackingrawmaterial-edit");
        Route::post("inwardpackingrawmaterial/update",[App\Http\Controllers\InwardPackingMaterialController::class,"update"])->name("inwardpackingrawmaterial-update");
        Route::get("inwardpackingrawmaterial/remove/{id}",[App\Http\Controllers\InwardPackingMaterialController::class,"remove"])->name("inwardpackingrawmaterial-remove");


        // dispatch finish Goods Receipt
        Route::get("dishpatchfinishgoods/new",[App\Http\Controllers\DishpatchfinishgoodsController::class,"add"])->name("dishpatchfinishgoods-new");
        Route::post("dishpatchfinishgoods/save",[App\Http\Controllers\DishpatchfinishgoodsController::class,"store"])->name("dishpatchfinishgoods-save");


        // Inward Finished Goods - New Stock

        Route::get('new_stock', [App\Http\Controllers\InwardFinishedController::class, 'new_stock'])->name("new_stock");
        Route::post('viewstock', [App\Http\Controllers\InwardFinishedController::class, 'viewstock'])->name("viewstock");
        Route::get('new_stock_add', [App\Http\Controllers\InwardFinishedController::class, 'new_stock_add'])->name("new_stock_add");
        Route::post('inward_finished_insert', [App\Http\Controllers\InwardFinishedController::class, 'inward_finished_insert']);

        // issue material for production
        // This is old one
        //Route::get('/issue_material_for_production', [App\Http\Controllers\MaterialForProductionController::class, 'issue_material_for_production'])->name("issue_material_for_production");

        //this is new one as per issual request
        Route::get('/issue_material_for_production', [App\Http\Controllers\MaterialForProductionController::class, 'issue_material_for_production_new'])->name("issue_material_for_production");
        Route::get("/issue_material/{id}",[App\Http\Controllers\MaterialForProductionController::class, 'issue_material'])->name("issue_material");
        Route::post("/assingindex",[App\Http\Controllers\MaterialForProductionController::class, 'assingindex'])->name("assingindex");
        Route::post("/packing_material_requisition_slip_approved/{id}",[App\Http\Controllers\MaterialForProductionController::class, 'packing_material_requisition_slip_approved'])->name("packing_material_requisition_slip_approved");
        Route::get("/issue_material_view/{id}",[App\Http\Controllers\MaterialForProductionController::class, 'issue_material_view'])->name("issue_material_view");
        Route::post("/getmatarialqtyofbatchwitharno",[App\Http\Controllers\MaterialForProductionController::class, 'getmatarialqtyofbatchwitharno'])->name("getmatarialqtyofbatchwitharno");

        Route::get('/issue_packing_material', [App\Http\Controllers\MaterialForProductionController::class, 'issue_packing_material'])->name("issue_packing_material");
        Route::get('/issue_packing_material_add', [App\Http\Controllers\MaterialForProductionController::class, 'issue_packing_material_add'])->name("issue_packing_material_add");

        Route::post('view_issue_material', [App\Http\Controllers\MaterialForProductionController::class, 'view_issue_material'])->name("view_issue_material");
        Route::get('/issue_material_for_production_add', [App\Http\Controllers\MaterialForProductionController::class, 'issue_material_for_production_add'])->name("issue_material_for_production_add");
        Route::post('issue_material_insert', [App\Http\Controllers\MaterialForProductionController::class, 'issue_material_insert'])->name("issue_material_insert");
        Route::post("getmatarialqtyandbatch",[App\Http\Controllers\MaterialForProductionController::class, 'getmatarialqtyandbatch'])->name("getmatarialqtyandbatch");
        Route::post("getmatarialqtyofbatch",[App\Http\Controllers\MaterialForProductionController::class, 'getmatarialqtyofbatch'])->name("getmatarialqtyofbatch");

         // quality control
         Route::get('/quality_control', [App\Http\Controllers\QualityControlController::class, 'quality_control'])->name("quality_control");

         Route::post('/quality_control_insert', [App\Http\Controllers\QualityControlController::class, 'quality_control_insert'])->name("quality_control_insert");
         Route::post('/qty_control', [App\Http\Controllers\QualityControlController::class, 'qty_control'])->name('qty_control');
         Route::post('/view_quality', [App\Http\Controllers\QualityControlController::class, 'view_quality'])->name('view_quality');
         Route::get("/quality_control_packing",[App\Http\Controllers\QualityControlController::class, 'quality_control_packing'])->name('quality_control_packing');
         Route::get("/quality_control_finishgood",[App\Http\Controllers\QualityControlController::class, 'quality_control_finishgood'])->name('quality_control_finishgood');
         Route::get("/quality_control_batch",[App\Http\Controllers\QualityControlController::class, 'quality_control_batch'])->name('quality_control_batch');

         Route::post("/qty_control_packing",[App\Http\Controllers\QualityControlController::class, 'qty_control_packing_approved'])->name("qty_control_packing");
         Route::post("/qty_control_finishgoods",[App\Http\Controllers\QualityControlController::class, 'qty_control_finishgoods_approved'])->name("qty_control_finishgoods");
         Route::post("/qty_control_batch_approved",[App\Http\Controllers\QualityControlController::class, 'qty_control_batch_approved'])->name("qty_control_batch_approved");




         //dispath finshed googds
        Route::get('/dispatch_finished_goods', [App\Http\Controllers\DispatchFinishedGoodsController::class, 'dispatch_finished_goods'])->name("dispatch_finished_goods");
        Route::get('/add_dispatch_finished_goods', [App\Http\Controllers\DispatchFinishedGoodsController::class, 'add_dispatch_finished_goods'])->name("add_dispatch_finished_goods");
        Route::post('/dispatch_finished_good_insert', [App\Http\Controllers\DispatchFinishedGoodsController::class, 'dispatch_finished_good_insert'])->name("dispatch_finished_good_insert");
        Route::get('/edit_dispatch_finished/{id}', [App\Http\Controllers\DispatchFinishedGoodsController::class, 'edit_dispatch_finished'])->name("edit_dispatch_finished");
        Route::get('/delete_dispatch_finished/{id}', [App\Http\Controllers\DispatchFinishedGoodsController::class, 'delete_dispatch_finished'])->name("delete_dispatch_finished");
        Route::get('/view_dispatch_finished/{id}', [App\Http\Controllers\DispatchFinishedGoodsController::class, 'view_dispatch_finished'])->name("view_dispatch_finished");
        Route::post('/update_dispatch_finished/{id}', [App\Http\Controllers\DispatchFinishedGoodsController::class, 'update_dispatch_finished'])->name("update_dispatch_finished");
        Route::post('/dispacth_view', [App\Http\Controllers\DispatchFinishedGoodsController::class, 'dispacth_view'])->name("dispacth_view");
        Route::post("getproductbatch", [App\Http\Controllers\DispatchFinishedGoodsController::class, 'getproductbatch'])->name("getproductbatch");
        Route::post("getproductqtyofbatch", [App\Http\Controllers\DispatchFinishedGoodsController::class, 'getproductqtyofbatch'])->name("getproductqtyofbatch");



        // Reports//
        Route::get('/annexure_i', [App\Http\Controllers\ReportsController::class, 'annexure_i'])->name("annexure_i");
        Route::get('/annexure_ii', [App\Http\Controllers\ReportsController::class, 'annexure_ii'])->name("annexure_ii");
        Route::get('/annexure_iii', [App\Http\Controllers\ReportsController::class, 'annexure_iii'])->name("annexure_iii");
        Route::get('/annexure_iv', [App\Http\Controllers\ReportsController::class, 'annexure_iv'])->name("annexure_iv");
        Route::get('/packing_annexure', [App\Http\Controllers\ReportsController::class, 'packing_annexure'])->name("packing_annexure");
        Route::get('/annexure_vi', [App\Http\Controllers\ReportsController::class, 'annexure_vi'])->name("annexure_vi");
        Route::get('/annexure_vii', [App\Http\Controllers\ReportsController::class, 'annexure_vii'])->name("annexure_vii");
        Route::get("/material_report",[App\Http\Controllers\ReportsController::class, 'material_report'])->name("material_report");
        Route::get("/daystore_report",[App\Http\Controllers\ReportsController::class, 'daystore_report'])->name("daystore_report");
        Route::post("/return_warehouse",[App\Http\Controllers\ReportsController::class, 'return_warehouse'])->name("return_warehouse");
        Route::get("/warehouse_returend",[App\Http\Controllers\ReportsController::class, 'warehouse_returend'])->name("warehouse_returend");
        //Manufacture Process
        Route::get('/add-batch-manufacture', [App\Http\Controllers\ManufactureProcessController::class,'add_batch_manufacture'])->name("add-batch-manufacture");
        Route::post("/manufacturing-listAjax",[App\Http\Controllers\ManufactureProcessController::class,'add_batch_manufactureAjax'])->name("manufacturing-listAjax");
      //Route::get('/add-manufacturing-record', [App\Http\Controllers\ManufactureProcessController::class,'add_manufacturing_record'])->name("add-manufacturing-record");
        Route::get('/add-batch-manufacturing-record', [App\Http\Controllers\ManufactureProcessController::class,'add_batch_manufacturing_record'])->name("add-batch-manufacturing-record");
        Route::post('/add_manufacturing_insert', [App\Http\Controllers\ManufactureProcessController::class,'add_manufacturing_insert'])->name("add_manufacturing_insert");
        Route::get('/add_manufacturing_edit/{id}/{any?}', [App\Http\Controllers\ManufactureProcessController::class,'add_manufacturing_edit'])->name("add_manufacturing_edit");
        Route::post('/add_btch_manufacture_view', [App\Http\Controllers\ManufactureProcessController::class,'add_btch_manufacture_view'])->name("add_btch_manufacture_view");
        Route::get('/add_btch_manufacture_delete/{id}', [App\Http\Controllers\ManufactureProcessController::class,'add_btch_manufacture_delete'])->name("add_btch_manufacture_delete");
        Route::post("checkbatchnoexits",[App\Http\Controllers\ManufactureProcessController::class,'checkbatchnoexits'])->name("checkbatchnoexits");
        //bill-of-raw-materia
        Route::get('/bill-of-raw-material', [App\Http\Controllers\ManufactureProcessController::class,'bill_of_raw_material'])->name("bill-of-raw-material");
        Route::get('/add-batch-manufacturing-record-bill-of-raw-material', [App\Http\Controllers\ManufactureProcessController::class,'add_batch_manufacturing_record_bill'])->name("add-batch-manufacturing-record-bill-of-raw-material");
        Route::post('/add_batch_manufacturing_recorde_insert', [App\Http\Controllers\ManufactureProcessController::class,'add_batch_manufacturing_recorde_insert'])->name("add_batch_manufacturing_recorde_insert");
        Route::post('/add_batch_manufacturing_recorde_insert_packing', [App\Http\Controllers\ManufactureProcessController::class,'add_batch_manufacturing_recorde_insert_packing'])->name("add_batch_manufacturing_recorde_insert_packing");
        Route::get('bill_of_raw_material_edit/{id}', [App\Http\Controllers\ManufactureProcessController::class,'bill_of_raw_material_edit'])->name("bill_of_raw_material_edit");
        Route::get('/bill_of_raw_material_delete/{id}', [App\Http\Controllers\ManufactureProcessController::class,'bill_of_raw_material_delete'])->name("bill_of_raw_material_delete");
        Route::post('/bill_of_raw_material_update', [App\Http\Controllers\ManufactureProcessController::class,'bill_of_raw_material_update'])->name("bill_of_raw_material_update");
        Route::post('/add_manufacturing_update', [App\Http\Controllers\ManufactureProcessController::class,'add_manufacturing_update'])->name("add_manufacturing_update");
        Route::post('/bill_of_raw_m_view', [App\Http\Controllers\ManufactureProcessController::class,'bill_of_raw_m_view'])->name("bill_of_raw_m_view");
        // packing-detail
        Route::get('/packing-detail', [App\Http\Controllers\ManufactureProcessController::class,'packing_detail'])->name("packing-detail");
        Route::get('/add-manufacturing-record-Packing', [App\Http\Controllers\ManufactureProcessController::class,'add_manufacturing_record_Packing'])->name("add-manufacturing-record-Packing");
        Route::post('/add_manufacturing_packing_insert', [App\Http\Controllers\ManufactureProcessController::class,'add_manufacturing_packing_insert'])->name("add_manufacturing_packing_insert");
        Route::post('/add_manufacturing_packing_update', [App\Http\Controllers\ManufactureProcessController::class,'add_manufacturing_packing_update'])->name("add_manufacturing_packing_update");
        Route::post('/add_manufacturing_packing_ganerate_update', [App\Http\Controllers\ManufactureProcessController::class,'add_manufacturing_packing_ganerate_update'])->name("add_manufacturing_packing_ganerate_update");
        // list-of-equipment
       Route::get('/list-of-equipment', [App\Http\Controllers\ManufactureProcessController::class,'list_of_equipment'])->name("list-of-equipment");
       Route::get('/add-batch-manufacturing-record-list-of-equipment', [App\Http\Controllers\ManufactureProcessController::class,'add_batch_list_of_equipment'])->name("add-batch-manufacturing-record-list-of-equipment");
       Route::post('/add_batch_equipment_insert', [App\Http\Controllers\ManufactureProcessController::class,'add_batch_equipment_insert'])->name("add_batch_equipment_insert");
       Route::post('/list_of_equipment_view', [App\Http\Controllers\ManufactureProcessController::class,'list_of_equipment_view'])->name("list_of_equipment_view");
       Route::get('/list_of_equipment_edit/{id}', [App\Http\Controllers\ManufactureProcessController::class,'list_of_equipment_edit'])->name("list_of_equipment_edit");
       Route::post('/list_of_equipment_update', [App\Http\Controllers\ManufactureProcessController::class,'list_of_equipment_update'])->name("list_of_equipment_update");
       Route::get('/list_of_equipment_delete/{id}', [App\Http\Controllers\ManufactureProcessController::class,'list_of_equipment_delete'])->name("list_of_equipment_delete");

       Route::post("/getequipmentcode",[App\Http\Controllers\ManufactureProcessController::class,'getequipmentcode'])->name("getequipmentcode");
       // line-clearance
       Route::get('/line-clearance', [App\Http\Controllers\ManufactureProcessController::class,'line_clearance'])->name("line-clearance");
       Route::get('/add-batch-manufacturing-line-clearance-record', [App\Http\Controllers\ManufactureProcessController::class,'add_line_clearance_record'])->name("add-batch-manufacturing-line-clearance-record");
       Route::post('/add_line_clearance_insert', [App\Http\Controllers\ManufactureProcessController::class,'add_line_clearance_insert'])->name("add_line_clearance_insert");
       Route::get('/line_clearance_edit/{id}', [App\Http\Controllers\ManufactureProcessController::class,'line_clearance_edit'])->name("line_clearance_eit");
       Route::post('/line_clearance_update', [App\Http\Controllers\ManufactureProcessController::class,'line_clearance_update'])->name("line_clearance_update");
       Route::post('/line_clearance_view', [App\Http\Controllers\ManufactureProcessController::class,'line_clearance_view'])->name("line_clearance_view");
      //generate-label
       Route::get('/generate-label', [App\Http\Controllers\ManufactureProcessController::class,'generate_label'])->name("generate-label");
       Route::get('/add-manufacturing-record-label', [App\Http\Controllers\ManufactureProcessController::class,'add_manufacturing_record_label'])->name("add-manufacturing-record-label");
       Route::post('/add_manufacturing_generate_label_insert', [App\Http\Controllers\ManufactureProcessController::class,'add_manufacturing_generate_label_insert'])->name("add_manufacturing_generate_label_insert");
       Route::post('/add_manufacturing_generate_update', [App\Http\Controllers\ManufactureProcessController::class,'add_manufacturing_generate_update'])->name("add_manufacturing_generate_update");
        //add-lots
        Route::get('/add-lots', [App\Http\Controllers\ManufactureProcessController::class,'add_lots'])->name("add-lots");
        Route::get('/add-batch-manufacturing-record-add-lot', [App\Http\Controllers\ManufactureProcessController::class,'add_batch_manufacturing_record_add_lot'])->name("add-batch-manufacturing-record-add-lot");
        Route::get('/add-batch-manufacturing-record-add-lot2', [App\Http\Controllers\ManufactureProcessController::class,'add_batch_manufacturing_record_add_lot2'])->name("add-batch-manufacturing-record-add-lot2");
        Route::get('/add-batch-manufacturing-record-add-lot3', [App\Http\Controllers\ManufactureProcessController::class,'add_batch_manufacturing_record_add_lot3'])->name("add-batch-manufacturing-record-add-lot3");
        Route::get('/add-batch-manufacturing-record-add-lot4', [App\Http\Controllers\ManufactureProcessController::class,'add_batch_manufacturing_record_add_lot4'])->name("add-batch-manufacturing-record-add-lot4");
        Route::get('/add-batch-manufacturing-record-add-lot5', [App\Http\Controllers\ManufactureProcessController::class,'add_batch_manufacturing_record_add_lot5'])->name("add-batch-manufacturing-record-add-lot5");
        Route::get('/add-batch-manufacturing-record-process-chec-5', [App\Http\Controllers\ManufactureProcessController::class,'add_batch_manufacturing_record_process_chec_5'])->name("add-batch-manufacturing-record-process-chec-5");

        Route::post("lots-view",[App\Http\Controllers\ManufactureProcessController::class,'viewLots'])->name("lots-view");
        Route::post("lots-edit",[App\Http\Controllers\ManufactureProcessController::class,'editLots'])->name("lots-edit");
        Route::post("add_lots_editupdate",[App\Http\Controllers\ManufactureProcessController::class,'lotseditupdate'])->name("add_lots_editupdate");
        Route::post("/delete-lots",[App\Http\Controllers\ManufactureProcessController::class,'lotsDelete'])->name("delete-lots");
       
        Route::post("/delete-equpmentstatus",[App\Http\Controllers\ManufactureProcessController::class,'equpmentstatusDelete'])->name("delete-equpmentstatus");
 
        

        // capacity stock
        Route::post('material_name_get', [App\Http\Controllers\ManufactureProcessController::class,'material_name_get'])->name("material_name_get");

     //comming Soon
        Route::get("comming-soon", [App\Http\Controllers\HomeController::class, 'comingsoon'])->name("comingsoon");
        //Issual By Stores For Production
        Route::get("issual_by_stores_for_production", [App\Http\Controllers\IssualByStoresForProductionController::class, 'issual_by_stores_for_production'])->name("issual_by_stores_for_production");
        Route::get("issual_by_stores_for_production_add", [App\Http\Controllers\IssualByStoresForProductionController::class, 'issual_by_stores_for_production_add'])->name("issual_by_stores_for_production_add");
        Route::post("issue_by_stores_insert", [App\Http\Controllers\IssualByStoresForProductionController::class, 'issue_by_stores_insert'])->name("issue_by_stores_insert");
        Route::post("view_store", [App\Http\Controllers\IssualByStoresForProductionController::class, 'view_store'])->name("view_store");
     // packing material issual slip
         Route::post('/packing_material_issuel_insert', [App\Http\Controllers\ManufactureProcessController::class,'packing_material_issuel_insert'])->name("packing_material_issuel_insert");
         Route::post('/packing_material_requisition_slip_insert', [App\Http\Controllers\ManufactureProcessController::class,'packing_material_requisition_slip_insert'])->name("packing_material_requisition_slip_insert");
         Route::post('/packing_material_requisition_slip_insert_packing', [App\Http\Controllers\ManufactureProcessController::class,'packing_material_requisition_slip_insert_packing'])->name("packing_material_requisition_slip_insert_packing");
         Route::post('/packing_material_requisition_slip_update', [App\Http\Controllers\ManufactureProcessController::class,'packing_material_requisition_slip_update'])->name("packing_material_requisition_slip_update");
         Route::post('/bill_of_raw_material_packing_update', [App\Http\Controllers\ManufactureProcessController::class,'bill_of_raw_material_packing_update'])->name("bill_of_raw_material_packing_update");
         Route::post('/packing_material_requisition_slip_update_1', [App\Http\Controllers\ManufactureProcessController::class,'packing_material_requisition_slip_update_1'])->name("packing_material_requisition_slip_update_1");
         Route::post('/packing_material_issuel_insert_update', [App\Http\Controllers\ManufactureProcessController::class,'packing_material_issuel_insert_update'])->name("packing_material_issuel_insert_update");

         Route::post('/finish_good_req_update', [App\Http\Controllers\ManufactureProcessController::class,'finish_good_req_update'])->name("finish_good_req_update");
         Route::post('/packing_material_issuel_insert_update', [App\Http\Controllers\ManufactureProcessController::class,'packing_material_issuel_insert_update'])->name("packing_material_issuel_insert_update");
         Route::post('/add_batch_equipment_update', [App\Http\Controllers\ManufactureProcessController::class,'packing_material_issuel_insert_update'])->name("add_batch_equipment_update");
         Route::post('/add_batch_lots', [App\Http\Controllers\ManufactureProcessController::class,'add_batch_lots'])->name("add_batch_lots");
         Route::post('/add_lots_update', [App\Http\Controllers\ManufactureProcessController::class,'add_lots_update'])->name("add_lots_update");
         Route::post('/add_mixing_update', [App\Http\Controllers\ManufactureProcessController::class,'add_mixing_update'])->name("add_mixing_update");


         Route::post('/homogenizing_insert', [App\Http\Controllers\ManufactureProcessController::class,'homogenizing_insert'])->name("homogenizing_insert");
         Route::post('/homogenizing_update', [App\Http\Controllers\ManufactureProcessController::class,'homogenizing_update'])->name("homogenizing_update");
         Route::post('/homozine-view', [App\Http\Controllers\ManufactureProcessController::class,'homogenizingView'])->name("homozine-view");
         Route::post('/homozine-edit', [App\Http\Controllers\ManufactureProcessController::class,'homogenizingEdit'])->name("homozine-edit");
         Route::post('/homogenizing_update_single', [App\Http\Controllers\ManufactureProcessController::class,'homogenizingEditstore'])->name("homogenizing_update_single");
         Route::post('/delete-homogine', [App\Http\Controllers\ManufactureProcessController::class,'homogenizingdelete'])->name("delete-homogine");



         //get ajax for batch in Add lot
         Route::post("/getbatchofmaterial", [App\Http\Controllers\ManufactureProcessController::class,'getbatchofmaterial'])->name("getbatchofmaterial");
         Route::get('/pdfview/{id}', [App\Http\Controllers\ManufactureProcessController::class,'pdfview'])->name("pdfview");
         //Route::get('pdfview',array('as'=>'pdfview','uses'=>'ItemController@pdfview'));


         //permission
          Route::resource('permissions', App\Http\Controllers\PermissionController::class);

         //user Controller
         Route::resource('users', App\Http\Controllers\UserController::class);
         Route::resource('activitylog', App\Http\Controllers\ActivitylogController::class);




});

