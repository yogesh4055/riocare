@extends("layouts.app")
@section("title","Add Manufacturing Record")
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row page-heading">
                <div class="col-12 col-lg-8 mb-xl-0 align-self-center align-items-center">
                    <h4 class="font-weight-bold d-flex"><i class="menu-icon" data-feather="package"></i>Batch Manufacturing Records - Packing</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="card main-card">
        <div class="card-body">
            <form id="add_manufacturing" method="post" action="{{ route('add_manufacturing_insert') }}">
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
                            <label for="batchNo">Batch No.</label>
                            <input type="text" class="form-control" name="batchNo" id="batchNo" placeholder="Batch No." value="RFLX 20/668">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="refMfrNo">Ref. MFR No.</label>
                            <input type="text" class="form-control" name="refMfrNo" id="refMfrNo" placeholder="Ref. MFR No." value="RCIPL/MFR/01/01">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="ManufacturerDate" class="active">Date</label>
                            <input type="date" class="form-control calendar" name="ManufacturerDate" id="ManufacturerDate" placeholder="DD/MM/YYYY">
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="form-group input_fields_wrap" id="MaterialReceived">
                            <label class="control-label d-flex">Packing
                                <!-- <div class="input-group-btn">  -->
                                <!-- <button class="btn btn-dark add-more add_field_button waves-effect waves-light" type="button">Add More +</button> -->
                                <!-- </div> -->
                            </label>
                            <div class="row add-more-wrap after-add-more m-0 mb-4">
                                <!-- <span class="add-count">1</span> -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="Observation" class="active">Area cleanliness checked by Production Observation</label>
                                        <input type="text" class="form-control" name="Observation" id="Observation" placeholder="Observation">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="Temperature" class="active">Temperature ( <sup>o</sup>C) of Filling area</label>
                                        <input type="text" class="form-control" name="Temperature" id="Temperature" placeholder="Observation">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="Humidity" class="active">Humidity (%RH) of Filling area</label>
                                        <input type="text" class="form-control" name="Humidity" id="Humidity" placeholder="Observation">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="TemperatureP" class="active">Temperature ( <sup>o</sup>C) of Product</label>
                                        <input type="text" class="form-control" name="TemperatureP" id="TemperatureP" placeholder="Observation">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="50kgDrums" class="active">50 Kg No of Drums filled</label>
                                        <input type="Number" class="form-control" name="50kgDrums" id="50kgDrums" placeholder="No of Drums">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="200kgDrums" class="active">200 Kg No of Drums filled</label>
                                        <input type="Number" class="form-control" name="20kgDrums" id="20kgDrums" placeholder="No of Drums">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="startTime" class="active">Start Time (Hrs.)</label>
                                        <input type="number" class="form-control time" name="startTime" id="startTime" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="EndstartTime" class="active">End Time (Hrs.)</label>
                                        <input type="number" class="form-control time" name="EndstartTime" id="EndstartTime" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="areaCleanliness">Done By</label>
                                        <select class="form-control select" name="areaCleanliness" id="areaCleanliness">
                                            <option>Select</option>
                                            <option>Employee Name</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="CareaCleanliness">Checked By</label>
                                        <select class="form-control select" name="CareaCleanliness" id="CareaCleanliness">
                                            <option>Select</option>
                                            <option>Employee Name</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="form-group input_fields_wrap" id="MaterialReceived">
                            <label class="control-label d-flex">Yield
                                <!-- <div class="input-group-btn">  -->
                                <!-- <button class="btn btn-dark add-more add_field_button waves-effect waves-light" type="button">Add More +</button> -->
                                <!-- </div> -->
                            </label>
                            <div class="row add-more-wrap after-add-more m-0 mb-4">
                                <!-- <span class="add-count">1</span> -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="rmInput" class="active">RM Input (Kg.)</label>
                                        <input type="text" class="form-control" name="rmInput" id="rmInput" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="fgOutput" class="active">FG Output</label>
                                        <input type="text" class="form-control" name="fgOutput" id="fgOutput" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="filledDrums" class="active">Filled in Drums (Kg)</label>
                                        <input type="text" class="form-control" name="filledDrums" id="filledDrums" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="excessFilledDrums" class="active">Excess filled in drums</label>
                                        <input type="text" class="form-control" name="excessFilledDrums" id="excessFilledDrums" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="qcsampling" class="active">QC Sampling (Kg.)</label>
                                        <input type="text" class="form-control" name="qcsampling" id="qcsampling" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="StabilitySample" class="active">Stability Sample (Kg.)</label>
                                        <input type="Number" class="form-control" name="StabilitySample" id="StabilitySample" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="WorkingSlandered" class="active">Working Slandered</label>
                                        <input type="text" class="form-control" name="WorkingSlandered" id="WorkingSlandered" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="ValidationSample" class="active">Validation Sample</label>
                                        <input type="text" class="form-control" name="ValidationSample" id="ValidationSample" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="CustomerRequirement" class="active">Customer's Trial Requirement</label>
                                        <input type="text" class="form-control" name="CustomerRequirement" id="CustomerRequirement" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="CustomerSample" class="active">Filled in Jerry can / Drum (Kg.) (Customer Sample)</label>
                                        <input type="text" class="form-control" name="CustomerSample" id="CustomerSample" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="ActualYield" class="active">Actual Yield [(Output/Input)*100]</label>
                                        <input type="text" class="form-control" name="ActualYield" id="ActualYield" placeholder="98.00 / 102.00%">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="checkedBy">Checked By</label>
                                        <select class="form-control select" name="checkedBy" id="checkedBy">
                                            <option>Select</option>
                                            <option>Manager Production</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="ApprovedBy">Approved By</label>
                                        <select class="form-control select" name="ApprovedBy" id="ApprovedBy">
                                            <option>Select</option>
                                            <option>Sr. Officer - QC</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="Remark" class="active">Note / Remark</label>
                            <textarea class="form-control" name="Remark" id="Remark" placeholder="Note / Remark"></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-md ml-0 form-btn waves-effect waves-light">Submit</button><button type="clear" class="btn btn-light btn-md form-btn waves-effect waves-light">Clear</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

<script>
    $(document).ready(function() {
        $("#add_manufacturing").validate({
            rules: {
                proName:"required",
                bmrNo:"required",
                batchNo:"required",
                refMfrNo:"required",
                ManufacturerDate:"required",
                Observation:"required",
                Temperature:"required",
                Humidity:"required",
                TemperatureP: "required",
                // 50kgDrums: "required",
                // 20kgDrums : "required",
                startTime: "required",
                EndstartTime: "required",
                areaCleanliness: "required",
                CareaCleanliness: "required",
                rmInput: "required",
                fgOutput: "required",
                filledDrums: "required",
                excessFilledDrums: "required",
                qcsampling: "required",
                StabilitySample: "required",
                WorkingSlandered: "required",
                ValidationSample: "required",
                CustomerSample: "required",
                ActualYield: "required",
                checkedBy: "required",
                ApprovedBy: "required",
                Remark: "required",

            },
            messages: {
                proName: "Please  Enter The Name proName",
                bmrNo: "Please  Enter The Name bmrNo",
                batchNo: "Please  Enter The Name batchNo",
                refMfrNo: "Please  Enter The Name refMfrNo",
                ManufacturerDate: "Please  Enter The Name ManufacturerDate",
                Observation: "Please  Enter The Name Observation",
                Temperature: "Please  Enter The Name Temperature",
                Humidity: "Please  Enter The Name Humidity",
                TemperatureP: "Please  Enter The Name TemperatureP",
                // 50kgDrums: "Please  Enter The Name 50kgDrums",
                // 20kgDrums: "Please  Enter The Name 20kgDrums",
                startTime: "Please  Enter The Name startTime",
                EndstartTime: "Please  Enter The Name EndstartTime",
                areaCleanliness: "Please  Enter The Name areaCleanliness",
                CareaCleanliness: "Please  Enter The Name CareaCleanliness",
                rmInput: "Please  Enter The Name rmInput",
                fgOutput: "Please  Enter The Name fgOutput",
                filledDrums: "Please  Enter The Name filledDrums",
                excessFilledDrums: "Please  Enter The Name excessFilledDrums",
                qcsampling: "Please  Enter The Name qcsampling",
                StabilitySample: "Please  Enter The Name StabilitySample",
                WorkingSlandered: "Please  Enter The Name WorkingSlandered",
                ValidationSample: "Please  Enter The Name ValidationSample",
                CustomerSample: "Please  Enter The Name CustomerSample",
                ActualYield: "Please  Enter The Name ActualYield",
                checkedBy: "Please  Enter The Name checkedBy",
                ApprovedBy: "Please  Enter The Name ApprovedBy",
                Remark: "Please  Enter The Name Remark",
            },
        });
        // $('.clear_submit').click(function() {
        //     $('#dispath_no').val('');
        //     $('#dispatch_form').val('');
        //     $('#dispatch_to').val('');
        //     $('#good_dispatch_date').val('');
        //     $('#mode_of_dispatch').val('');
        //     $('#party_name').val('');
        //     $('#product').val('');
        //     $('#invoice_no').val('');
        //     $('#batch_no').val('');
        //     $('#grade').val('');
        //     $('#viscosity').val('');
        //     $('#mfg_date').val('');
        //     $('#expiry_ratest_date').val('');
        //     $('#total_no_of_50kg_drums').val('');
        //     $('#total_no_of_30kg_drums').val('');
        //     $('#total_no_of_5kg_drums').val('');
        //     $('#total_no_qty').val('');
        //     $('#seal_no').val('');
        //     $('#dispatch_date').val('');
        //     $('#dispatch_by').val('');
        //     $('#remark').val('');

        // });
    });
</script>
@endpush
