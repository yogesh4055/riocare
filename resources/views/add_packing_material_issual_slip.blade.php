@extends("layouts.app")
@section("title","Packing Material Issual Slip")
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row page-heading">
                <div class="col-12 col-lg-8 mb-xl-0 align-self-center align-items-center">
                    <h4 class="font-weight-bold d-flex"><i class="menu-icon" data-feather="package"></i>Packing Material Issual Slip</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="card main-card">
        <div class="card-body">
        <form id="packing_material_issuel_vali" method="post" action="{{ route('packing_material_issuel_insert') }}">
                @csrf
                <div class="form-row">
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="from" class="active">From</label>
                            <input type="text" class="form-control" name="from" id="from" placeholder="From">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="to" class="active">To</label>
                            <input type="text" class="form-control" name="to" id="to" placeholder="To">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="batchNo">Batch No.</label>
                            <input type="text" class="form-control" name="batchNo" id="batchNo" placeholder="Batch No.">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="Date" class="active">Date</label>
                            <input type="date" class="form-control calendar" name="Date" id="Date" value={{ date("Y-m-d") }}>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="form-group input_fields_wrap" id="MaterialReceived">
                            <label class="control-label d-flex">Material Details
                                <div class="input-group-btn">
                                    <button class="btn btn-dark add-more add_field_button waves-effect waves-light" type="button">Add More +</button>
                                </div>
                            </label>
                            <div class="row add-more-wrap after-add-more m-0 mb-4">
                                <span class="add-count">1</span>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="PackingMaterialName" class="active">Packing Material Name</label>
                                        <input type="text" class="form-control" name="PackingMaterialName" id="PackingMaterialName" placeholder="" value="">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="Capacity" class="active">Capacity (Kg.)</label>
                                        <input type="text" class="form-control" name="Capacity" id="Capacity" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="Quantity" class="active">Quantity (No)</label>
                                        <input type="text" class="form-control" name="Quantity" id="Quantity" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="arNo" class="active">AR No.</label>
                                        <input type="text" class="form-control" name="arNo" id="arNo" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="ARDate" class="active">Date</label>
                                        <input type="date" class="form-control" name="ARDate" id="ARDate" value={{ date("Y-m-d") }}>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="doneBy">Manager - Store</label>
                            <select class="form-control select" name="doneBy" id="doneBy">
                                <option>Select</option>
                                <option>Employee Name</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="checkedBy">Officer - Production</label>
                            <select class="form-control select" name="checkedBy" id="checkedBy">
                                <option>Select</option>
                                <option>Employee Name</option>
                            </select>
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
					  <input type="date" class="form-control calendar" id="ApprovalDate" value={{ date("Y-m-d") }}>
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
                $(wrapper).append('<div class="row add-more-wrap add-more-new m-0 mb-4"><span class="add-count">' + x + '</span><div class="input-group-btn"><button class="btn btn-danger remove_field" type="button"><i class="icon-remove" data-feather="x"></i></button></div><div class="col-12 col-md-6 col-lg-4"><div class="form-group"><label for="PackingMaterialName[' + x + ']" class="active">Raw Material Name</label><input type="text" class="form-control" id="PackingMaterialName[' + x + ']" placeholder="" value=""></div></div><div class="col-12 col-md-6 col-lg-4"><div class="form-group"><label for="Capacity[' + x + ']" class="active">Batch No.</label><input type="text" class="form-control" id="Capacity[' + x + ']" placeholder=""></div></div><div class="col-12 col-md-6 col-lg-4"><div class="form-group"><label for="Quantity[' + x + ']" class="active">Quantity (No)</label><input type="text" class="form-control" id="Quantity[' + x + ']" placeholder=""></div></div><div class="col-12 col-md-6 col-lg-4"><div class="form-group"><label for="arNo[' + x + ']" class="active">AR No.</label><input type="text" class="form-control" id="arNo[' + x + ']" placeholder=""></div></div><div class="col-12 col-md-6 col-lg-4"><div class="form-group"><label for="ARDate[' + x + ']" class="active">Date</label><input type="date" class="form-control" id="ARDate[' + x + ']" value={{ date("Y-m-d") }}></div></div></div>'); //add input box
            }
            feather.replace()
        });

        $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
            e.preventDefault();
            $(this).parents('div.row').remove();
            x--;
        })

    });
    $("#packing_material_issuel_vali").validate({
        rules: {

            from: "required",
            to: "required",
            batchNo: "required",
            Date: "required",
            PackingMaterialName: "required",
            Capacity: "required",
            Quantity: "required",
            arNo: "required",
            ARDate: "required",
            doneBy: "required",
            checkedBy: "required",


        },
        messages: {
            from: "Please  Enter The from Name",
            to: "Please  Enter The  To Name",
            batchNo: "Please  Enter The  batch No",
            Date: "Please  Enter The  Date",
            PackingMaterialName: "Please  Enter The  PackingMaterial Name",
            Capacity: "Please  Enter The  Capacity",
            Quantity: "Please  Enter The  Quantity",
            arNo: "Please  Enter The  ar No",
            ARDate: "Please  Enter The  ARDate",
            doneBy: "Please  Enter The  doneBy",
            checkedBy: "Please  Enter The  checkedBy",

        },
    });
</script>

@endpush
