@extends("layouts.app")
@section("title","Batch Manufacturing Records")
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row page-heading">
                <div class="col-12 col-lg-8 mb-xl-0 align-self-center align-items-center">
                    <h4 class="font-weight-bold d-flex"><i class="menu-icon" data-feather="package"></i>Batch Manufacturing Records</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="card main-card">
        <div class="card-body">
            <div class="form-row">
                <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="proName" class="active">Product Name</label>
                        <input type="text" class="form-control" id="proName" placeholder="Product Name" value="Simethicone (Filix-110)">
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="bmrNo" class="active">BMR No.</label>
                        <input type="text" class="form-control" id="bmrNo" placeholder="BMR No." value="RCIPL/BMR/Flx-2300/09">
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="batchNo">Batch No.</label>
                        <input type="text" class="form-control" id="batchNo" placeholder="Batch No." value="RFLX 20/668">
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="refMfrNo">Ref. MFR No.</label>
                        <input type="text" class="form-control" id="refMfrNo" placeholder="Ref. MFR No." value="RCIPL/MFR/01/01">
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="Date">Date</label>
                        <input type="date" class="form-control" id="Date" placeholder="" value="">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label class="control-label d-flex">Process Sheet</label>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="form-group">
                        <label for="lotNo" class="active">Lot No.</label>
                        <input type="text" class="form-control" id="lotNo" placeholder="Lot No." value="1">
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="form-group">
                        <label for="ReactorNo">Reactor No.</label>
                        <select class="form-control" id="ReactorNo">
                            <option>Select</option>
                            <option>PR/RC/001</option>
                            <option>PR/RC/002</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="form-group">
                        <label for="Date">Date</label>
                        <input type="date" class="form-control" id="Date" placeholder="" value="">
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group input_fields_wrap" id="MaterialReceived">
                        <label class="control-label d-flex">Raw Material Detail
                            <div class="input-group-btn">
                                <button class="btn btn-dark add-more add_field_button waves-effect waves-light" type="button">Add More +</button>
                            </div>
                        </label>
                        <div class="row add-more-wrap after-add-more m-0 mb-4">
                            <!-- <span class="add-count">1</span> -->
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label for="EquipmentName" class="active">Raw Material</label>
                                    <select class="form-control select" id="EquipmentName">
                                        <option>Select</option>
                                        <option>Raw Material Name</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label for="rmbatchno" class="active">Batch No.</label>
                                    <input type="text" class="form-control" id="rmbatchno" placeholder="" value="">
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label for="Quantity" class="active">Quantity (Kg.)</label>
                                    <input type="text" class="form-control" id="Quantity" placeholder="" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                    <table class="table table-bordered" cellpadding="0" cellspacing="0" border="0">
                        <thead>
                            <tr>
                                <th>Process</th>
                                <th>Qty. (Kg.)</th>
                                <th>Temp (<sup>o</sup>C)</th>
                                <th>Start Time (Hrs)</th>
                                <th>End Time (Hrs)</th>
                                <th>Done by</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Charge Polydimethylsiloxane in reactor.</td>
                                <td><input type="text" name="qty[1]" id="qty[1]" class="form-control"></td>
                                <td><input type="text" name="temp[1]" id="temp[1]" class="form-control"></td>
                                <td><input type="text" name="stratTime[1]" id="stratTime[1]" class="form-control"></td>
                                <td><input type="text" name="endTime[1]" id="endTime[1]" class="form-control"></td>
                                <td><select class="form-control select" id="doneby[1]">
                                        <option>Select</option>
                                        <option>Employee Name</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <td>Starts heating the reactor and start stirring</td>
                                <td><input type="text" name="qty[2]" id="qty[2]" class="form-control"></td>
                                <td><input type="text" name="temp[2]" id="temp[2]" class="form-control"></td>
                                <td><input type="text" name="stratTime[2]" id="stratTime[2]" class="form-control"></td>
                                <td><input type="text" name="endTime[2]" id="endTime[2]" class="form-control"></td>
                                <td><select class="form-control select" id="doneby[2]">
                                        <option>Select</option>
                                        <option>Employee Name</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <td>Once the temperature is between 100 - 120<sup>o</sup>C start the Inline mixer and charges ColloidalSilicon Dioxide (Fumed Silica) in reactor simultaneously and increase stirring speed.</td>
                                <td><input type="text" name="qty[3]" id="qty[3]" class="form-control"></td>
                                <td><input type="text" name="temp[3]" id="temp[3]" class="form-control"></td>
                                <td><input type="text" name="stratTime[3]" id="stratTime[3]" class="form-control"></td>
                                <td><input type="text" name="endTime[3]" id="endTime[3]" class="form-control"></td>
                                <td><select class="form-control select" id="doneby[3]">
                                        <option>Select</option>
                                        <option>Employee Name</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <td>When temperature reaches 180 - 190 <sup>o</sup>C stop heating the reactor.</td>
                                <td><input type="text" name="qty[4]" id="qty[4]" class="form-control"></td>
                                <td><input type="text" name="temp[4]" id="temp[4]" class="form-control"></td>
                                <td><input type="text" name="stratTime[4]" id="stratTime[4]" class="form-control"></td>
                                <td><input type="text" name="endTime[4]" id="endTime[4]" class="form-control"></td>
                                <td><select class="form-control select" id="doneby[4]">
                                        <option>Select</option>
                                        <option>Employee Name</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <td>Stop stirrer and transfer the reaction mass to homogenizing tank No.- PR/BT/Come Tank number</td>
                                <td><input type="text" name="qty[1]" id="qty[1]" class="form-control"></td>
                                <td><input type="text" name="temp[1]" id="temp[1]" class="form-control"></td>
                                <td><input type="text" name="stratTime[1]" id="stratTime[1]" class="form-control"></td>
                                <td><input type="text" name="endTime[1]" id="endTime[1]" class="form-control"></td>
                                <td><select class="form-control select" id="doneby[1]">
                                        <option>Select</option>
                                        <option>Employee Name</option>
                                    </select></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-md ml-0 form-btn waves-effect waves-light">Save &amp; Quite</button><a href="{{url('add-batch-manufacturing-record-add-lot2')}}" class="btn btn-dark btn-md form-btn waves-effect waves-light">Continue</a>
                    </div>
                </div>
            </div>
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
                $(wrapper).append('<div class="row add-more-wrap add-more-new m-0 mb-4"><span class="add-count">' + x + '</span><div class="input-group-btn"><button class="btn btn-danger remove_field" type="button"><i class="icon-remove" data-feather="x"></i></button></div><div class="col-12 col-md-4"><div class="form-group"><label for="EquipmentName[' + x + ']" class="active">Raw Material</label><select class="form-control select" id="EquipmentName[' + x + ']"><option>Select</option><option>Raw Material Name</option></select></div></div><div class="col-12 col-md-4"><div class="form-group"><label for="rmbatchno[' + x + ']" class="active">Batch No.</label><input type="text" class="form-control" id="rmbatchno[' + x + ']" placeholder="" value=""></div></div><div class="col-12 col-md-4"><div class="form-group"><label for="Quantity[' + x + ']" class="active">Quantity (Kg.)</label><input type="text" class="form-control" id="Quantity[' + x + ']" placeholder="" value=""></div></div></div>'); //add input box
            }
            feather.replace()
        });

        $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
            e.preventDefault();
            $(this).parents('div.row').remove();
            x--;
        })
    });
</script>
@endpush
