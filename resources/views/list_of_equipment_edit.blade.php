@extends("layouts.app")
@section("title"," Add list Of Equipment")
@section('content')
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row page-heading">
                <div class="col-12 col-lg-8 mb-xl-0 align-self-center align-items-center">
                  <h4 class="font-weight-bold d-flex"><i class="menu-icon" data-feather="package"></i>Batch Manufacturing Records - List of Equipment</h4>
                </div>
              </div>
            </div>
          </div>
		  <div class="card main-card">
			<div class="card-body">
            <form id="add_batch_equipment_insert" method="post" action="{{ route('list_of_equipment_update') }}">
            <input type="hidden" value="{{$res_data->id}}" name="id">

            @csrf

				<div class="form-row">
					<div class="col-12 col-md-6 col-lg-6 col-xl-6">
						<div class="form-group">
						  <label for="proName" class="active">Product Name</label>
						  <input type="text" class="form-control" name="proName"  value="{{$res_data->proName}}"  id="proName" placeholder="Product Name">
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
						  <input type="text" class="form-control"  name="batchNo" value="{{$res_data->batchNo}}" id="batchNo" placeholder="Batch No." >
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
							<label class="control-label d-flex">List of Equipment in Manufacturing Process
								<div class="input-group-btn">
									<button class="btn btn-dark add-more add_field_button waves-effect waves-light" type="button">Add More +</button>
								</div>
							</label>
                            @foreach ($res as $temp)
							<div class="row add-more-wrap after-add-more m-0 mb-4">
								<!-- <span class="add-count">1</span> -->
								<div class="col-12 col-md-6">
									<div class="form-group">
									  <label for="EquipmentName" class="active">Equipment Name</label>
									  <select class="form-control select" name="EquipmentName[]" value="{{$temp->EquipmentName}}" id="EquipmentName">
										<option>{{$temp->EquipmentName}}</option>
										<option>SS Reactor</option>
										<option>SS Homogenising Tank</option>
										<option>Filling Station</option>
									  </select>
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
									  <label for="EquipmentCode" class="active">Equipment Code</label>
									  <select class="form-control select" name="EquipmentCode[]" value="{{$temp->EquipmentCode}}" id="EquipmentCode">
										<option>{{$temp->EquipmentCode}}</option>
										<option>PR/RC/001</option>
										<option>PR/RC/002</option>
									  </select>
									</div>
								</div>
							</div>
                            @endforeach
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
		var max_fields      = 15; //maximum input boxes allowed
		var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
		var add_button      = $(".add_field_button"); //Add button ID

		var x = 1; //initlal text box count
		$(add_button).click(function(e){ //on add input button click
			e.preventDefault();
			if(x < max_fields){ //max input box allowed
				x++; //text box increment
				$(wrapper).append('<div class="row add-more-wrap add-more-new m-0 mb-4"><span class="add-count">'+x+'</span><div class="input-group-btn"><button class="btn btn-danger remove_field" type="button"><i class="icon-remove" data-feather="x"></i></button></div><div class="col-12 col-md-6"><div class="form-group"><label for="EquipmentName['+x+']" class="active">Equipment Name</label><select class="form-control select" name=EquipmentName[] id="EquipmentName['+x+']"><option>Select</option><option>SS Reactor</option><option>SS Homogenising Tank</option><option>Filling Station</option></select></div></div><div class="col-12 col-md-6"><div class="form-group"><label for="EquipmentCode['+x+']" class="active">Equipment Code</label><select class="form-control select" name="EquipmentCode[]" id="EquipmentCode['+x+']"><option>Select</option><option>PR/RC/001</option><option>PR/RC/002</option></select></div></div></div>'); //add input box
			}
			feather.replace()
		});

		$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
			e.preventDefault(); $(this).parents('div.row').remove(); x--;
		})
        $("#add_batch_manufacturing").validate({
            rules: {
                proName: "required",
                bmrNo: "required",
                batchNo: "required",
                refMfrNo: "required",
                EquipmentName: "required",
                EquipmentCode: "required",


            },
            messages: {
                proName: "Please  Enter The Name proName",
                bmrNo: "Please  Enter The Name bmrNo",
                batchNo: "Please  Enter The Name batchNo",
                refMfrNo: "Please  Enter The Name refMfrNo",
                EquipmentName: "Please  Enter The Name EquipmentName",
                EquipmentCode: "Please  Enter The Name EquipmentCode",

            },
        });

	});
  </script>


@endpush
