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
        <form id="add_batch_manufacturing" method="post" action="{{ route('add_batch_manufacturing_recorde_insert') }}">
                @csrf

            <div class="form-row">
                <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="proName" class="active">Product Name</label>
                        <input type="text" class="form-control" name="proName" id="proName" placeholder="Product Name" value="Simethicone (Filix-110)">
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="bmrNo" class="active">BMR No.</label>
                        <input type="text" class="form-control" name="bmrNo" id="bmrNo" placeholder="BMR No." value="RCIPL/BMR/Flx-2300/09">
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="batchNoI">Batch No.</label>
                        <input type="text" class="form-control" name="batchNoI" id="batchNoI" placeholder="Batch No." value="RFLX 20/668">
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="refMfrNo">Ref. MFR No.</label>
                        <input type="text" class="form-control" name="refMfrNo" id="refMfrNo" placeholder="Ref. MFR No." value="RCIPL/MFR/01/01">
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group input_fields_wrap" id="MaterialReceived">
                        <label class="control-label d-flex">Bill of Raw Material Details and Weighing Record
                            <div class="input-group-btn">
                                <button class="btn btn-dark add-more add_field_button waves-effect waves-light" type="button">Add More +</button>
                            </div>
                        </label>
                        <div class="row add-more-wrap after-add-more m-0 mb-4">
                            <!-- <span class="add-count">1</span> -->
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="rawMaterialName" class="active">Raw Material</label>
                                    <select class="form-control select" name="rawMaterialName[]" id="rawMaterialName">
                                        <option>Select</option>
                                        <option>Material Name</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="batchNo" class="active">Batch No.</label>
                                    <select class="form-control select" name="batchNo[]" id="batchNo">
                                        <option>Select</option>
                                        <option>RFLX</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="Quantity" class="active">Quantity (Kg.)</label>
                                    <input type="text" class="form-control" name="Quantity[]" id="Quantity" placeholder="">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="arNo" class="active">AR No.</label>
                                    <input type="text" class="form-control" name="arNo[]" id="arNo" placeholder="">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="date" class="active">Date</label>
                                    <input type="date" class="form-control calendar" name="date[]" id="date" value={{ date("Y-m-d") }}>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="doneBy">Weighed by</label>
                        <select class="form-control select" name="doneBy" id="doneBy">
                            <option>Select</option>
                            <option>Employee Name</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="checkedBy">Checked by</label>
                        <!-- <select class="form-control select" name="checkedBy" id="checkedBy">
                            <option>Select</option>
                            <option>Employee Name</option>
                        </select> -->
                        <input type="text" class="form-control select" name="checkedBy" id="checkedBy" value="{{ \Auth::user()->name }}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-6">
						<div class="form-group">
						  <label for="Remark" class="active">Note / Remark</label>
						  <textarea class="form-control" name="Remark" id="Remark" placeholder="Note / Remark"></textarea>
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

<!-- <div class="modal fade show" id="checkQuntity" tabindex="-1" aria-labelledby="checkQuntityLabel" aria-modal="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkQuntityLabel">Material Name - Batch no.</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                <form action="#" method="_post" id="checkQuantity">
                    <div class="form-row">
                        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label for="QuantityApproved">Quantity Approved</label>
                                <input type="text" class="form-control" id="QuantityApproved" placeholder="Quantity Approved">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label for="QuantityRejected">Quantity Rejected</label>
                                <input type="text" class="form-control" id="QuantityRejected" placeholder="Quantity Rejected">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label for="Status">Status</label>
                                <select class="form-control select" id="Status">
                                    <option>Select</option>
                                    <option>Approved</option>
                                    <option>Rejected</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label for="ApprovalDate">Date of Approval</label>
                                <input type="date" class="form-control calendar" id="ApprovalDate" placeholder="DD-MM-YYYY">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="Remark">Remark</label>
                                <textarea class="form-control" id="Remark" placeholder="Remark"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-md m-0">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> -->

@endsection
@push("scripts")

<script>
    feather.replace()
    $(document).ready(function() {
        var max_fields = 15; //maximum input boxes allowed
        var wrapper = $(".input_fields_wrap"); //Fields wrapper
        var add_button = $(".add_field_button"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function(e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div class="row add-more-wrap add-more-new m-0 mb-4"><span class="add-count">' + x + '</span><div class="input-group-btn"><button class="btn btn-danger remove_field" type="button"><i class="icon-remove" data-feather="x"></i></button></div><div class="col-12 col-md-6 col-lg-4"><div class="form-group"><label for="rawMaterialName[' + x + ']" class="active">Raw Material</label><select class="form-control select" name="rawMaterialName[]" id="rawMaterialName[' + x + ']"><option>Select</option><option>Material Name</option></select></div></div><div class="col-12 col-md-6 col-lg-4"><div class="form-group"><label for="batchNo[' + x + ']" class="active">Batch No.</label><select class="form-control select" name="batchNo[]" id="batchNo[' + x + ']"><option>Select</option><option>RFLX</option></select></div></div><div class="col-12 col-md-6 col-lg-4"><div class="form-group"><label for="Quantity[' + x + ']" class="active">Quantity (Kg.)</label><input type="text" class="form-control" name="Quantity[]" id="Quantity[' + x + ']" placeholder=""></div></div><div class="col-12 col-md-6 col-lg-4"><div class="form-group"><label for="arNo[' + x + ']" class="active">AR No.</label><input type="text" class="form-control" name="arNo[]" id="arNo[' + x + ']" placeholder=""></div></div><div class="col-12 col-md-6 col-lg-4"><div class="form-group"><label for="date[' + x + ']" class="active">Date</label><input type="date" class="form-control calendar" name="date[]" id="date[' + x + ']" value={{ date("Y-m-d") }}></div></div>'); //add input box
            }
            feather.replace()
        });

        $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
            e.preventDefault();
            $(this).parents('div.row').remove();
            x--;
        })
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
