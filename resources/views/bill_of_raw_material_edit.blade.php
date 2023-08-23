@extends("layouts.app")
@section("title","Add batch Manufacture")
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row page-heading">
                <div class="col-12 col-lg-8 mb-xl-0 align-self-center align-items-center">
                    <h4 class="font-weight-bold d-flex"><i class="menu-icon" data-feather="package"></i>Batch Manufacturing Records - Bill of Raw Material detail and Weighing Record</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="card main-card">
        <div class="card-body">
        <form id="add_batch_manufacturing" method="post" action="{{ route('bill_of_raw_material_update') }}">
        <input type="hidden" value="{{$res_data->id}}" name="id">

        @csrf

            <div class="form-row">
                <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="proName" class="active">Product Name</label>
                        <input type="text" class="form-control" name="proName" value="{{$res_data->proName}}" id="proName" placeholder="Product Name" >
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="bmrNo" class="active">BMR No.</label>
                        <input type="text" class="form-control" name="bmrNo" value="{{$res_data->bmrNo}}" id="bmrNo" placeholder="BMR No." >
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="batchNoI">Batch No.</label>
                        <input type="text" class="form-control" name="batchNoI" value="{{$res_data->batchNoI}}" id="batchNoI" placeholder="Batch No." >
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="refMfrNo">Ref. MFR No.</label>
                        <input type="text" class="form-control" name="refMfrNo" value="{{$res_data->refMfrNo}}" id="refMfrNo" placeholder="Ref. MFR No." >
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group input_fields_wrap" id="MaterialReceived">
                        <label class="control-label d-flex">Bill of Raw Material Details and Weighing Record
                           </label>
                        @foreach ($res as $temp)

                        <div class="row add-more-wrap after-add-more m-0 mb-4">
                            <!-- <span class="add-count">1</span> -->

                            <div class="col-12 col-md-6 col-lg-4">

                                <div class="form-group">
                                    <label for="rawMaterialName" class="active">Raw Material</label>
                                    <select class="form-control select" name="rawMaterialName[]" value="{{$temp->rawMaterialName}}" id="rawMaterialName">
                                        <option>{{$temp->rawMaterialName}}</option>
                                        <option>Material Name</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="batchNo" class="active">Batch No.</label>
                                    <select class="form-control select" name="batchNo[]" value="{{$temp->batchNo}}" id="batchNo">
                                        <option>{{$temp->batchNo}}</option>
                                        <option>RFLX</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="Quantity" class="active">Quantity (Kg.)</label>
                                    <input type="text" class="form-control" name="Quantity[]" value="{{$temp->Quantity}}" id="Quantity" placeholder="">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="arNo" class="active">AR No.</label>
                                    <input type="text" class="form-control" name="arNo[]" value="{{$temp->arNo}}" id="arNo" placeholder="">
                             </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="date" class="active">Date</label>
                                    <input type="date" class="form-control calendar" name="date[]" id="date" value="{{$temp->date}}" placeholder="">
                                </div>
                            </div>




                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="doneBy">Weighed by</label>
                        <select class="form-control select" name="doneBy" id="doneBy">
                            <option>{{$res_data->doneBy}}</option>
                            <option>Employee Name</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="checkedBy">Checked by</label>
                        <select class="form-control select" name="checkedBy" id="checkedBy">
                            <option>{{$res_data->checkedBy}}</option>
                            <option>Employee Name</option>
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-md ml-0 form-btn waves-effect waves-light">Submit</button>
                        <button type="clear" class="btn btn-light btn-md form-btn waves-effect waves-light">Clear</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>

</div>


@endsection
@push("scripts")

<script>
    $(document).ready(function() {

        $("#add_batch_manufacturing").validate({
            rules: {
                proName: "required",
                bmrNo: "required",
                batchNoI: "required",
                refMfrNo: "required",
                rawMaterialName: "required",
                batchNo: "required",
                Quantity: "required",
                arNo: "required",
                date: "required",
                doneBy: "required",
                checkedBy: "required",

            },
            messages: {
                proName: "Please  Enter The Name proName",
                bmrNo: "Please  Enter The Name bmrNo",
                batchNoI: "Please  Enter The Name batchNo",
                refMfrNo: "Please  Enter The Name refMfrNo",
                rawMaterialName: "Please  Enter The Name rawMaterialName",
                batchNo: "Please  Enter The Name batchNo",
                Quantity: "Please  Enter The Name Quantity",
                arNo: "Please  Enter The Name arNo",
                date: "Please  Enter The Name dateid",
                doneBy: "Please  Enter The Name doneBy",
                checkedBy: "Please  Enter The Name checkedBy",
            },
        });

    });
</script>
@endpush
