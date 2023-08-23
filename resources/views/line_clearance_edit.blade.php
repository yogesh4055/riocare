@extends("layouts.app")
@section("title","life Of Equipment")
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row page-heading">
                <div class="col-12 col-lg-8 mb-xl-0 align-self-center align-items-center">
                    <h4 class="font-weight-bold d-flex"><i class="menu-icon" data-feather="package"></i>Batch Manufacturing Records - Line Clearance Record</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="card main-card">
        <div class="card-body">
        <form id="add_manufacturing" method="post" action="{{ route('line_clearance_update') }}">
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
                        <label for="batchNo">Batch No.</label>
                        <input type="text" class="form-control" name="batchNo" value="{{$res_data->batchNo}}" id="batchNo" placeholder="Batch No." >
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="refMfrNo">Ref. MFR No.</label>
                        <input type="text" class="form-control" name="refMfrNo" value="{{$res_data->refMfrNo}}" id="refMfrNo" placeholder="Ref. MFR No." >
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="Date">Date</label>
                        <input type="date" class="form-control" name="Date" value="{{$res_data->Date}}" id="Date" placeholder="" >
                    </div>
                </div>

                <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group input_fields_wrap" id="MaterialReceived">
                        <label class="control-label d-flex">Line Clearance Record
                            <div class="input-group-btn">
                                <button class="btn btn-dark add-more add_field_button waves-effect waves-light" type="button">Add More +</button>
                            </div>
                        </label>
                        @foreach ($res as $temp)
                        <div class="row add-more-wrap after-add-more m-0 mb-4">
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label for="EquipmentName" class="active">Particulars</label>
                                    <select class="form-control select" name="EquipmentName[]" id="EquipmentName">
                                        <option>{{$temp->EquipmentName}}</option>
                                        <option>Area Cleanliness Checked</option>
                                        <option>Temperature( &#x2070 C)</option>
                                        <option>Humidity (%RH)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label for="Observation" class="active">Observation</label>
                                    <input type="text" class="form-control" value="{{$temp->Observation}}" name="Observation[]" id="Observation" placeholder="" value="">
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label for="time" class="active">Time (Hrs)</label>
                                    <input type="text" class="form-control" value="{{$temp->time}}" name="time[]" id="time" placeholder="" value="">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-12 col-md-12">
						<div class="form-group">
						  <label for="Remark" class="active">Note / Remark</label>
						  <textarea class="form-control" name="Remark" value="{{$res_data->Remark}}" id="Remark" placeholder="Note / Remark">{{$res_data->Remark}} </textarea>
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

<div class="modal fade show" id="checkQuntity" tabindex="-1" aria-labelledby="checkQuntityLabel" aria-modal="true">
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
</div>
@endsection
@push("scripts")

<script>
    feather.replace()
    /*$(document).ready(function() {
		var c = 1;
      $(".add-more").click(function(){
          var html = $(".copy").html();
          $(".after-add-more").after(html);
      });
      $("body").on("click",".remove",function(){
          $(this).parents(".add-more-new").remove();
      });
    });*/
    $(document).ready(function() {
        var max_fields = 15; //maximum input boxes allowed
        var wrapper = $(".input_fields_wrap"); //Fields wrapper
        var add_button = $(".add_field_button"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function(e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div class="row add-more-wrap add-more-new m-0 mb-4"><span class="add-count">' + x + '</span><div class="input-group-btn"><button class="btn btn-danger remove_field" type="button"><i class="icon-remove" data-feather="x"></i></button></div><div class="col-12 col-md-4"><div class="form-group"><label for="EquipmentName[' + x + ']" class="active">Particulars</label><select class="form-control select" name="EquipmentName[]" id="EquipmentName[' + x + ']"><option>Select</option><option>Area Cleanliness Checked</option><option>Temperature( &#x2070 C)</option><option>Humidity (%RH)</option></select></div></div><div class="col-12 col-md-4"><div class="form-group"><label for="Observation[' + x + ']" class="active">Observation</label><input type="text" class="form-control" name="Observation[]" id="Observation[' + x + ']" placeholder="" value=""></div></div><div class="col-12 col-md-4"><div class="form-group"><label for="time[' + x + ']" class="active">Time (Hrs)</label><input type="text" class="form-control" name="time[]" id="time[' + x + ']" placeholder="" value=""></div></div></div>'); //add input box
            }
            feather.replace()
        });

        $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
            e.preventDefault();
            $(this).parents('div.row').remove();
            x--;
        })
        $("#add_manufacturing").validate({
            rules: {
                proName:"required",
                bmrNo:"required",
                batchNo:"required",
                refMfrNo:"required",
                Date:"required",
                EquipmentName:"required",
                Observation:"required",
                time:"required",
               },
            messages: {
                proName: "Please  Enter The Name proName",
                bmrNo: "Please  Enter The Name bmrNo",
                batchNo: "Please  Enter The Name batchNo",
                refMfrNo: "Please  Enter The Name refMfrNo",
                Date: "Please  Enter The  Date",
                EquipmentName: "Please  Enter The Name EquipmentName",
                Observation: "Please  Enter The Name Observation",
                time: "Please  Enter The Name time",
                },
        });
    });
</script>
@endpush
