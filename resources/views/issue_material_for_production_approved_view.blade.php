
@extends('layouts.app')
@section('content')
<div class="col-md-12">
    @if ($message = Session::get('success'))
    <div class="alert alert-info alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
    @endif
</div>
<!-- Main Container -->
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row page-heading">
                <div class="col-12 col-xl-8 mb-xl-0 align-self-center align-items-center">
                    <h4 class="font-weight-bold d-flex"><i class="menu-icon" data-feather="hard-drive"></i>Issued by Stores for Production (Annexure - III)</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="card main-card">
        <div class="card-body">
            <form id="packing_material_requisition_slip" method="post" action="{{ route('packing_material_requisition_slip_approved',["id"=>$issue_material->id]) }}">
            @csrf
            <div class="form-row">
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="from" class="active">From</label>
                            <input type="text" name="from" id="from" class="form-control" value="{{ $issue_material->from }}" readonly>


                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="to" class="active">To</label>
                            <input type="text" name="to" id="to" class="form-control" value="{{ $issue_material->to }}" readonly>

                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="batchNo">Batch No.</label>
                            <input type="text" class="form-control" name="batchNo" id="batchNo" placeholder="Batch No." value="{{ isset($issue_material->batch_no)?$issue_material->batch_no:old("batchNo") }}" readonly>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="Date" class="active">Date</label>
                            <input type="date" class="form-control calendar" name="Date" id="Date" value={{ $issue_material->issed_date }} readonly>
                        </div>
                    </div>

                    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="form-group input_fields_wrap_6"  id="MaterialReceived">
                            <label class="control-label d-flex">Material Detail <br /><br />
<div class="input-group-btn">&nbsp;</div>
                            </label>
                            @if(isset($material_details) && $material_details)
                            @php $i=1;
                            $material_type = ($issue_material->type=='R')? 'Raw Material':(($issue_material->type=='P')? 'Packing Material' :'') ; 
                             @endphp
                            @if($issue_material->type =='P')

                                    @foreach ($material_details as $mat)
                                    @php
                                        $batch  = "";
                                        $batch =  $batch = App\Models\Stock::select(DB::raw("concat(DATE_FORMAT(goods_receipt_note_items.created_at,\"%d-%m-%Y\"),'-',(goods_receipt_note_items.total_qty)) as Qty"),"stock.id")->join("goods_receipt_note_items","goods_receipt_note_items.id","stock.batch_no")->where("stock.matarial_id",$mat->PackingMaterialName)->pluck("Qty","id");

                                    @endphp
                                    <div class="row add-more-wrap after-add-more m-0 mb-4">
                                        <span class="add-count">{{ $i }}</span>
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="PackingMaterialName" class="active">{{$material_type}} Name</label>
                                                <input type="text" class="form-control" name="material_name{{ $mat->details_id }}" id="material_name{{ $i }}" value="{{ $mat->material_name }}" readonly>

                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="Quantity" class="active">Requestion Quantity (Kg.)</label>
                                                <input type="text" class="form-control" name="Quantity{{ $mat->details_id }}" id="Quantity{{ $i }}" placeholder="" value="{{$mat->requesist_qty}}" readonly>
                                            </div>
                                        </div>

                                        @if($issue_material->type !='P')
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="Quantity" class="active">A.R.N. Number</label>
                                                <input type="text" class="form-control" name="arno{{ $mat->details_id }}" id="arno{{ $i }}" placeholder="A.R.N. Number" value="{{ $mat->ar_no_date }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="Quantity" class="active">A.R.N. Date</label>
                                                <input type="text" class="form-control" name="arno_date{{ $mat->details_id }}" id="arno{{ $i }}" placeholder="A.R.N. Number" value="{{ $mat->ar_no_date_date }}" readonly>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="Quantity" class="active">Issued Quantity (Kg.)</label>
                                                <input type="text" class="form-control" name="Quantity_app{{ $mat->details_id }}" id="Quantity_app{{ $i }}" placeholder="Enter Approved Qty" value="{{ $mat->approved_qty }}" readonly>

                                            </div>
                                        </div>
                                    </div>

                                    @php $i++; @endphp
                                    @endforeach
                            @else
                                    @foreach ($material_details as $mat)
                                    @php
                                        $batch  = "";

                                        $batch = App\Models\Rawmaterialitems::select("inward_raw_materials_items.batch_no")->join("stock","stock.batch_no","inward_raw_materials_items.id")->where("stock.id",$mat->batch_id)->first();

                                    @endphp
                                    <div class="row add-more-wrap after-add-more m-0 mb-4">
                                        <span class="add-count">{{ $i }}</span>
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="PackingMaterialName" class="active">Raw Material Name</label>
                                                <input type="text" class="form-control" name="material_name{{ $mat->details_id }}" id="material_name{{ $i }}" value="{{ $mat->material_name }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="Quantity" class="active">Requestion Quantity (Kg.)</label>
                                                <input type="text" class="form-control" name="Quantity{{ $mat->details_id }}" id="Quantity{{ $i }}" placeholder="" value="{{number_format($mat->requesist_qty,3,".","")}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="Quantity" class="active">Raw Material Batch</label>
                                                <input type="text" class="form-control" name="batch{{ $mat->details_id }}" id="batch{{ $i }}" placeholder="" value="{{isset($batch->batch_no)?$batch->batch_no:$mat->batch_id}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="Quantity" class="active">A.R.N. Number</label>
                                                <input type="text" class="form-control" name="arno_date{{ $mat->details_id }}" id="arno{{ $i }}" placeholder="A.R.N. Number" value="{{ isset($batch->ar_no_date)?$batch->ar_no_date:$mat->ar_no_date}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="Quantity" class="active">A.R.N. Date</label>
                                                <input type="text" class="form-control" name="arno{{ $mat->details_id }}" id="arno{{ $i }}" placeholder="A.R.N. Number" value="{{ isset($batch->ar_no_date_date)?date("d/m/Y",strtotime($batch->ar_no_date_date)):($mat->ar_no_date_date?date("d/m/Y",strtotime($mat->ar_no_date_date)):"")}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="Quantity" class="active">Approved Quantity (Kg.)</label>
                                                <input type="text" class="form-control" name="Quantity_app{{ $mat->details_id }}" id="Quantity_app{{ $i }}" placeholder="Enter Approved Qty" value="{{ number_format($mat->approved_qty,3,".","") }}" readonly>

                                            </div>
                                        </div>
                                    </div>
                                    @php $i++; @endphp
                                    @endforeach
                                @endif
                            @endif
                        </div>
                    </div>


                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="ApprovedBy">Approved By</label>
                            <input type="text" class="form-control select" name="ApprovedBy" id="ApprovedBy" value="{{ $issue_material->name }}" readonly>
                                <!-- <option>Select</option>
                                <option>Manager Store</option>
                            </select> -->
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="Remark" class="active">Note / Remark</label>
                            <textarea class="form-control" name="Remark" id="Remark" placeholder="Note / Remark">{{ $issue_material->remark }}</textarea>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection

