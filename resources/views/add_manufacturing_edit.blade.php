@extends("layouts.app")
@section('title', 'Add batch Manufacture')
@section('content')


    
<!-- datepicker styles -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css">


<style>
    .swal2-icon.swal2-warning {
    font-size: 20px;
}

    </style>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row page-heading">
                    <div class="col-12 col-lg-8 mb-xl-0 align-self-center align-items-center">
                        <h4 class="font-weight-bold d-flex"><i class="menu-icon" data-feather="package"></i>Batch
                            Manufacturing Records</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="card main-card">
            <div class="card-body">
                <div class="row add-more-wrap">

                            <div class="col-md-3">
                               <b> Product Name :  </b> {{ $batchproduct->material_name }}
                            </div>
                            <div class="col-md-3">
                                <b> BMR No. :</b>   {{  $batchdetails->bmrNo }}
                            </div>
                            <div class="col-md-3">
                                <b> Batch No. : </b>  {{ $batchdetails->batchNo }}
                            </div>
                            <div class="col-md-3">
                                <b> Ref. MFR No. :</b>  {{ $batchdetails->refMfrNo }}
                            </div>

                </div>
                <br>
                <ul class="nav nav-tabs tablist" role="tablist">
                    <li><a role="tab" class="{{ $sequenceId == '1' ? 'active' : '' }}"
                            area-selected="{{ $sequenceId == '1' ? 'true' : 'false' }}" data-toggle="tab"
                            href="#batch">Batch</a></li>
                    <li class="dropdown"><a role="tab" class="dropdown-toggle {{ in_array($sequenceId,array(2,3)) ? 'active' : '' }}" data-toggle="dropdown" href="#">Raw
                            Material<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a role="tab" class="{{ $sequenceId == '2' ? 'active' : '' }}"
                                    area-selected="{{ $sequenceId == '2' ? 'true' : 'false' }}" data-toggle="tab"
                                    href="#requisition">Requisition</a></li>
                            <li><a role="tab" class="{{ $sequenceId == '3' ? 'active' : '' }}"
                                    area-selected="{{ $sequenceId == '3' ? 'true' : 'false' }}" data-toggle="tab"
                                    href="#issualofrequisition">Issual of requisition</a></li>
                            <!--<li><a role="tab" class="{{ $sequenceId == '4' ? 'active' : '' }}" area-selected="{{ $sequenceId == '4' ? 'true' : 'false' }}" data-toggle="tab" href="#billOfRawMaterial">Bill of Raw Material</a></li>-->

                        </ul>
                    </li>
                    <li class="dropdown"><a role="tab" class="dropdown-toggle {{ in_array($sequenceId,array(5,6)) ? 'active' : '' }}" data-toggle="dropdown" href="#">Packing Material<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a role="tab" class="{{ $sequenceId == '5' ? 'active' : '' }}"
                                    area-selected="{{ $sequenceId == '5' ? 'true' : 'false' }}" data-toggle="tab"
                                    href="#requisitionpacking">Requisition</a></li>
                            <li><a role="tab" class="{{ $sequenceId == '6' ? 'active' : '' }}"
                                    area-selected="{{ $sequenceId == '6' ? 'true' : 'false' }}" data-toggle="tab"
                                    href="#issualofrequisitionpacking">Issual of requisition</a></li>
                            <!--<li><a role="tab" class="{{ $sequenceId == '7' ? 'active' : '' }}" area-selected="{{ $sequenceId == '7' ? 'true' : 'false' }}" data-toggle="tab" href="#billOfRawMaterialpacking">Bill of Packing Raw Material</a></li> -->

                        </ul>
                    </li>
                    <li class="dropdown"><a role="tab" class="dropdown-toggle {{ in_array($sequenceId,array(7)) ? 'active' : '' }}" data-toggle="dropdown" href="#">Finished Goods<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a role="tab" class="{{ $sequenceId == '7' ? 'active' : '' }}"
                                    area-selected="{{ $sequenceId == '7' ? 'true' : 'false' }}" data-toggle="tab"
                                    href="#requisitionFinishGood">Requisition</a></li>
                            <li><a role="tab" class=""area-selected="" data-toggle="tab" href="#issualFinishGood">Issual of requisition</a>
                            </li>
                        </ul>
                    </li>
                    <li><a role="tab" class="{{ $sequenceId == '8' ? 'active' : '' }}"
                            area-selected="{{ $sequenceId == '8' ? 'true' : 'false' }}" data-toggle="tab"
                            href="#listOfEquipment">List of Equipment</a></li>
                    <li><a role="tab" class="{{ $sequenceId == '6' ? 'active' : '' }}"
                        area-selected="{{ $sequenceId == '6' ? 'true' : 'false' }}" data-toggle="tab"
                        href="#Line-Clearance">Line Clearance Record</a></li>
                        
                     <li><a role="tab" class="{{ in_array($sequenceId,array(9,10)) ? 'active' : '' }} lots"
                            area-selected="{{ in_array($sequenceId,array(9,10)) ? 'true' : 'false' }}" data-toggle="tab"
                            href="#addLots_listing">Process</a></li>

                    <li><a role="tab" class="{{ in_array($sequenceId,array(9,10)) ? 'active' : '' }}"
                            area-selected="{{ in_array($sequenceId,array(9,10)) ? 'true' : 'false' }}" data-toggle="tab" href="#addLots"
                            hidden="hidden">Lots</a></li>

                   

                    <?php if($batchproduct->material_name !='Simethicone 50 % Powder (Simflo)' && $batchproduct->material_name !='Silicone Emulsion (Remsil-35)') {?>

                    <li><a role="tab" class="{{ $sequenceId == '11' ? 'active' : '' }}"
                            area-selected="{{ $sequenceId == '11' ? 'true' : 'false' }}" data-toggle="tab"
                            href="#mixing">Mixing</a></li>
                    <?php } ?>

                    <!-- <li><a role="tab" class="{{ in_array($sequenceId,array(9,10)) ? 'active' : '' }}"
                            area-selected="{{ in_array($sequenceId,array(9,10)) ? 'true' : 'false' }}" data-toggle="tab" href="#addLots"
                            hidden="hidden">Lots</a></li> -->


                    <li><a role="tab" class="{{ $sequenceId == '12' ? 'active' : '' }}"
                            area-selected="{{ $sequenceId == '12' ? 'true' : 'false' }}" data-toggle="tab"
                            href="#homogenizing">Homogenizing</a></li>

                    <li><a data-toggle="tab" class="{{ $sequenceId == '13' ? 'active' : '' }}"
                            area-selected="{{ $sequenceId == '13' ? 'true' : 'false' }}" href="#Packing">Packing</a></li>
                    <li><a data-toggle="tab" class="{{ $sequenceId == '14' ? 'active' : '' }}"
                            area-selected="{{ $sequenceId == '14' ? 'true' : 'false' }}" href="#generate_label">Generate
                            Label</a></li>
                </ul>
                @if ($message = Session::get('danger'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                @if ($message = Session::get('success'))
                    <div class="alert alert-info alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                @php $lc=0; @endphp
                <div class="tab-content">

                    @if (isset($edit_batchmanufacturing))
                        @include("batch.mainbatchedit")


                        @include("batch.requisition")

                        @include("batch.issualofrequisition")

                        {{-- @include("batch.billOfRawMaterial") --}}

                        @include("batch.requisitionpacking")

                        @include("batch.issualofrequisitionpacking")

                        @include("batch.requisitionFinishGood")
                        @include("batch.issualFinishGood")

                        @include("batch.line-clearance-edit")

                        @include("batch.listOfEquipment")


                        @include("batch.addLots_listing")

                        @include("batch.mixing")


                        @include("batch.homogenizing")




                        @include("batch.Packing")


                        @include("batch.generate_label")
                    @endif




                </div>
            </div>
        </div>
    </div>


@endsection
@push('scripts')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>


    <script>
        function validateNumber(event) {
            var key = window.event ? event.keyCode : event.which;
            if (event.keyCode === 8 || event.keyCode === 46) {
                return true;
            } else if ( key < 48 || key > 57 ) {
                return false;
            } else {
                return true;
            }
        };
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
                    $(wrapper).append(
                        '<div class="row add-more-wrap add-more-new m-0 mb-4"><span class="add-count">' +
                        x +
                        '</span><div class="input-group-btn"><button class="btn btn-danger remove_field" type="button"><i class="icon-remove" data-feather="x"></i></button></div><div class="col-12 col-md-6 col-lg-4"><div class="form-group"><label for="rawMaterialName[' +
                        x +
                        ']" class="active">Raw Material</label><select class="form-control select" name="rawMaterialName[]" id="rawMaterialName[' +
                        x +
                        ']"><option>Select</option><option value="">Material Name</option></select></div></div><div class="col-12 col-md-6 col-lg-4"><div class="form-group"><label for="Quantity[' +
                        x +
                        ']" class="active">Quantity (Kg.)</label><input type="text" class="form-control" name="Quantity[]" id="Quantity[' +
                        x +
                        ']" placeholder="" onkeypress="return validateNumber(event);"></div></div><div class="col-12 col-md-6 col-lg-4"><div class="form-group"><label for="arNo[' +
                        x +
                        ']" class="active">AR No.</label><input type="text" class="form-control" name="arNo[]" id="arNo[' +
                        x +
                        ']" placeholder=""></div></div><div class="col-12 col-md-6 col-lg-4"><div class="form-group"><label for="date[' +
                        x +
                        ']" class="active">Date</label><input type="date" class="form-control calendar" name="date[]" id="date[' +
                        x + ']" value={{ date('Y-m-d') }}></div></div>'); //add input box
                }
                feather.replace()
            });

            $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
                e.preventDefault();
                $(this).parents('div.row').remove();
                x--;
            })

        });

        feather.replace()
        $(document).ready(function() {
            var max_fields = 15; //maximum input boxes allowed
            var wrapper = $(".input_fields_wrap_1"); //Fields wrapper
            var add_button_eq = $(".add_field_button_1"); //Add button ID

            var x = @if (isset($res_1) && count($res_1) > 0) {{ count($res_1) }} @else 1 @endif//initlal text box count

            $(add_button_eq).click(function(e) { //on add input button click

                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++; //text box increment
                    $(wrapper).append(
                        '<div class="row add-more-wrap add-more-new m-0 mb-4"><span class="add-count">' +
                        x +
                        '</span><div class="input-group-btn"><button class="btn btn-danger remove_field" type="button"><i class="icon-remove" data-feather="x"></i></button></div><div class="col-12 col-md-6"><div class="form-group"><label for="EquipmentName[' +
                        x +
                        ']" class="active">Equipment Name</label><select class="form-control select" name=EquipmentName[] id="eqipment_name' +
                        x + '" onchange="getcodes($(this).val(),' + x +
                        ')"><option>Select</option>@foreach ($eqipment_name as $key => $eq) <option value="{{ $key }}">{{ $eq }}</option>@endforeach<select></div></div><div class="col-12 col-md-6"><div class="form-group"><label for="EquipmentCode[' + x + ']" class="active">Equipment Code</label><select class="form-control select" name="EquipmentCode[]" id="eqipment_code' + x + '"><option>Select</option>@foreach ($eqipment_code as $eq) <option value="{{ $eq->id }}">{{ $eq->code }}</option>@endforeach</select></div></div></div>'
                        ); //add input box
                }
                feather.replace()
            });

            $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
                e.preventDefault();
                $(this).parents('div.row').remove();
                x--;
            })


        });
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
            var wrapper = $(".input_fields_wrap_3"); //Fields wrapper
            var add_button = $(".add_field_button_3"); //Add button ID

            var x = 1; //initlal text box count
            $(add_button).click(function(e) { //on add input button click
                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++; //text box increment
                    $(wrapper).append(
                        '<div class="row add-more-wrap add-more-new m-0 mb-4"><span class="add-count">' +
                        x +
                        '</span><div class="input-group-btn"><button class="btn btn-danger remove_field" type="button"><i class="icon-remove" data-feather="x"></i></button></div><div class="col-12 col-md-4"><div class="form-group"><label for="EquipmentName[' +
                        x +
                        ']" class="active">Particulars</label><select class="form-control select" name="EquipmentName[]" id="EquipmentName[' +
                        x +
                        ']"><option>Select</option><option>Area Cleanliness Checked</option><option>Temperature( &#x2070 C)</option><option>Humidity (%RH)</option></select></div></div><div class="col-12 col-md-4"><div class="form-group"><label for="Observation[' +
                        x +
                        ']" class="active">Observation</label><input type="text" class="form-control" name="Observation[]" id="Observation[' +
                        x +
                        ']" placeholder="" value=""></div></div><div class="col-12 col-md-4"><div class="form-group"><label for="time[' +
                        x +
                        ']" class="active">Time (Hrs)</label><input type="text" class="form-control" name="time[]" id="time[' +
                        x + ']" placeholder="" value=""></div></div></div>'); //add input box
                }
                feather.replace()
            });

            $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
                e.preventDefault();
                $(this).parents('div.row').remove();
                x--;
            })

        });
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
            var wrapper = $(".input_fields_wrap_4"); //Fields wrapper
            var add_button = $(".add_field_button_4"); //Add button ID
            @php $lm =0; @endphp
            @if (isset($raw_material_bills))


                        @foreach ($raw_material_bills as $index => $rd)
                            @foreach ($rd as $in => $mat)
                                    @php $lm++; @endphp
                            @endforeach
                        @endforeach
            @endif

            var x =@if ($lm > 0) {{ $lm }} @else 1 @endif //initlal text box count
            $(add_button).click(function(e) { //on add input button click
                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++; //text box increment
                    $(wrapper).append(
                        '<div class="row add-more-wrap add-more-new m-0 mb-4"><span class="add-count">' +
                        x +
                        '</span><div class="input-group-btn"><button class="btn btn-danger remove_field" type="button"><i class="icon-remove" data-feather="x"></i></button></div><div class="col-12 col-md-4"><div class="form-group"><label for="MaterialName' +
                        x +
                        '" class="active">Raw Material</label><select class="form-control select" name="MaterialName[]" id="MaterialName' +
                        x + '" onchange="getbatchlot($(this).val(),' + x +
                        ')"><option>Select Raw Material</option>@if (isset($stock)) @foreach ($stock as $key => $value) <option value="{{ $key }}">{{ $value }}</option> @endforeach @endif</select></div></div><div class="col-12 col-md-4"><div class="form-group"><label for="rmbatchno' +
                        x +
                        '" class="active">Batch No.</label><select name="rmbatchno[]" class="form-control" id="rmbatchno' +
                        x +
                        '" placeholder="Choose Batch"><option>Choose Batch No</option></select></div></div><div class="col-12 col-md-4"><div class="form-group"><label for="Quantity' +
                        x +
                        '" class="active">Quantity (Kg.)</label><input type="text" class="form-control" id="Quantity' +
                        x + '" placeholder="" value="" name="Quantity[]" onkeypress="return validateNumber(event);"></div></div></div>'
                        ); //add input box
                }
                feather.replace()
            });

            $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
                e.preventDefault();
                $(this).parents('div.row').remove();
                x--;
            })
        });
        $(document).ready(function() {
            var max_fields = 15; //maximum input boxes allowed
            var wrapper = $(".input_fields_wrap_5"); //Fields wrapper
            var add_button = $(".add_field_button_5"); //Add button ID

            var x = 1; //initlal text box count
            $(add_button).click(function(e) { //on add input button click
                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++; //text box increment
                    $(wrapper).append(
                        '<div class="row add-more-wrap add-more-new m-0 mb-4"><span class="add-count">' +
                        x +
                        '</span><div class="input-group-btn"><button class="btn btn-danger remove_field" type="button"><i class="icon-remove" data-feather="x"></i></button></div><div class="col-12 col-md-6 col-lg-4"><div class="form-group"><label for="PackingMaterialName[' +
                        x +
                        ']" class="active">Packing Material Name</label><input type="text" class="form-control" name="PackingMaterialName[]" id="PackingMaterialName[' +
                        x +
                        ']" placeholder="" value=""></div></div><div class="col-12 col-md-6 col-lg-4"><div class="form-group"><label for="Capacity[' +
                        x +
                        ']" class="active">Capacity(Kg.)</label><input type="text" class="form-control" name="Capacity[]" id="Capacity[' +
                        x +
                        ']" placeholder=""></div></div><div class="col-12 col-md-6 col-lg-4"><div class="form-group"><label for="Quantity[' +
                        x +
                        ']" class="active">Quantity (No)</label><input type="text" class="form-control" name="Quantity[]" id="Quantity[' +
                        x +
                        ']" placeholder="" onkeypress="return validateNumber(event);"></div></div><div class="col-12 col-md-6 col-lg-4"><div class="form-group"><label for="arNo[' +
                        x +
                        ']" class="active">AR No.</label><input type="text" class="form-control" name="arNo[]"id="arNo[' +
                        x +
                        ']" placeholder=""></div></div><div class="col-12 col-md-6 col-lg-4"><div class="form-group"><label for="ARDate[' +
                        x +
                        ']" class="active">Date</label><input type="date" class="form-control" name="ARDate[]" id="ARDate[' +
                        x + ']" value={{ date('Y-m-d') }}></div></div></div>'); //add input box
                }
                feather.replace()
            });

            $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
                e.preventDefault();
                $(this).parents('div.row').remove();
                x--;
            })

        });
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
            var wrapper = $(".input_fields_wrap_6"); //Fields wrapper
            var add_button = $(".add_field_button_6"); //Add button ID

            var x =
                '{{ isset($requestion_details_packing) && count($requestion_details_packing) > 0 ? count($requestion_details_packing) : 1 }}'; //initlal text box count
            $(add_button).click(function(e) { //on add input button click
                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++; //text box increment
                    $(wrapper).append(
                        '<div class="row add-more-wrap add-more-new m-0 mb-4"><span class="add-count">' +
                        x +
                        '</span><div class="input-group-btn"><button class="btn btn-danger remove_field" type="button"><i class="icon-remove" data-feather="x"></i></button></div><div class="col-12 col-md-6 col-lg-4"><div class="form-group"><label for="PackingMaterialName' +
                        x +
                        '" class="active">Packing Material Name</label><select class="form-control select" name="PackingMaterialName[]" id="PackingMaterialName' +
                        x + '" onchange="getcapacity($(this).val(),' + x +
                        ')"><option>Select Packing Raw Material</option>@if (isset($packingmaterials)) @foreach ($packingmaterials as $key => $value) <option value="{{ $key }}">{{ $value }}</option> @endforeach @endif</select></div></div><div class="col-12 col-md-6 col-lg-4"><div class="form-group"><label for="Capacity" class="active">Capacity (Kg.)</label><input type="text" class="form-control" name="Capacity[]" id="Capacity' +
                        x +
                        '" placeholder=""></div></div><div class="col-12 col-md-6 col-lg-4"><div class="form-group"><label for="Quantity" class="active">Quantity (Kg.)</label><input type="text" class="form-control" name="Quantity[]" id="Quantity" placeholder="" onkeypress="return validateNumber(event);"></div></div></div></div>'
                        ); //add input box
                }
                feather.replace()
            });

            $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
                e.preventDefault();
                $(this).parents('div.row').remove();
                x--;
            })
        });
        $(document).ready(function() {
            var max_fields = 15; //maximum input boxes allowed
            var wrapper = $(".input_fields_wrap_7"); //Fields wrapper
            var add_button = $(".add_field_button_7"); //Add button ID

            var x =
                '{{ isset($requestion_details_packing) && count($requestion_details_packing) > 0 ? count($requestion_details_packing) : 1 }}'; //initlal text box count
            $(add_button).click(function(e) { //on add input button click
                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++; //text box increment
                    $(wrapper).append(
                        '<div class="row add-more-wrap add-more-new m-0 mb-4"><span class="add-count">' +
                        x +
                        '</span><div class="input-group-btn"><button class="btn btn-danger remove_field" type="button"><i class="icon-remove" data-feather="x"></i></button></div><div class="col-12 col-md-6 col-lg-4"><div class="form-group"><label for="FinishGoodMaterialName' +
                        x +
                        '" class="active">Finished Goods Material Name</label><select class="form-control select" name="FinishGoodMaterialName[]" id="FinishGoodMaterialName' +
                        x + '" onchange="getcapacity($(this).val(),' + x +
                        ')"><option>Choose Material Name</option>@if (isset($finishgoodmaterials)) @foreach ($finishgoodmaterials as $key => $value) <option value="{{ $key }}">{{ $value }}</option> @endforeach @endif</select></div></div><div class="col-12 col-md-6 col-lg-4"><div class="form-group"><label for="Quantity" class="active">Quantity (Kg.)</label><input type="text" class="form-control" name="Quantity[]" id="Quantity" placeholder="" onkeypress="return validateNumber(event);"></div></div></div></div>'
                        ); //add input box
                }
                feather.replace()
            });

            $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
                e.preventDefault();
                $(this).parents('div.row').remove();
                x--;
            })
        });
        $(document).ready(function() {
            var max_fields = 15; //maximum input boxes allowed
            var wrapper = $(".input_fields_wrap_9"); //Fields wrapper
            var add_button = $(".add_field_button_9"); //Add button ID

            var x =
                '{{ isset($requestion_details) && count($requestion_details) > 0 ? count($requestion_details) : 1 }}'; //initlal text box count
            $(add_button).click(function(e) { //on add input button click
                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++; //text box increment
                    $(wrapper).append(
                        '<div class="row add-more-wrap add-more-new m-0 mb-4"><span class="add-count">' +
                        x +
                        '</span><div class="input-group-btn"><button class="btn btn-danger remove_field" type="button"><i class="icon-remove" data-feather="x"></i></button></div><div class="col-12 col-md-6 col-lg-4"><div class="form-group"><label for="PackingMaterialName" class="active">Raw Material Name</label>        {{ Form::select('PackingMaterialName[]', $rawmaterials, old(), ['class' => 'form-control select', 'id' => 'material_name','placeholder'=>'Raw Material']) }} </div></div><div class="col-12 col-md-6 col-lg-4"><div class="form-group"><label for="Quantity" class="active">Quantity (Kg.)</label><input type="text" class="form-control" name="Quantity[]" id="Quantity" placeholder="" onkeypress="return validateNumber(event);"></div></div></div></div>'
                        ); //add input box
                }
                feather.replace()
            });

            $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
                e.preventDefault();
                $(this).parents('div.row').remove();
                x--;
            })
        });

        $(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function(e) {
            $('a[data-toggle="tab"]').removeClass('active');
            $(this).addClass('active');
            //alert("hi")
        })
        $(document).ready(function() {

            $("#add_manufacturing").validate({
                rules: {
                    proName: "required",
                    bmrNo: "required",
                    batchNo: "required",
                    refMfrNo: "required",
                    grade: "required",
                    BatchSize: "required",
                    //Viscosity: "required",
                    ProductionCommencedon: "required",
                    ProductionCompletedon: "required",
                    ManufacturingDate: "required",
                    RetestDate: "required",
                    /*doneBy: "required",
                    checkedBy: "required",
                    inlineRadioOptions: "required",
                    approval: "required",
                    approvalDate: "required",
                    checkedByI: "required",*/
                    remark: "required",

                },
                messages: {
                    proName: "Please  Enter The Name proName",
                    bmrNo: "Please  Enter The Name bmrNo",
                    batchNo: "Please  Enter The Name batchNo",
                    refMfrNo: "Please  Enter The Name refMfrNo",
                    grade: "Please  Enter The Name grade",
                    BatchSize: "Please  Enter The Name BatchSize",
                    Viscosity: "Please  Enter The Name Viscosity",
                    ProductionCommencedon: "Please  Enter The Name ProductionCommencedon",
                    ProductionCompletedon: "Please  Enter The Name ProductionCompletedon",
                    ManufacturingDate: "Please  Enter The Name ManufacturingDate",
                    RetestDate: "Please  Enter The Name RetestDate",
                    doneBy: "Please  Enter The Name doneBy",
                    checkedBy: "Please  Enter The Name checkedBy",
                    inlineRadioOptions: "Please  Enter The Name inlineRadioOptions",
                    approval: "Please  Enter The Name approval",
                    approvalDate: "Please  Enter The Name approvalDate",
                    checkedByI: "Please  Enter The Name checkedBy",
                },
            });
            $("#add_batch_manufacturing_bill").validate({
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
            $("#add_manufacturing_line").validate({
                rules: {
                    proName: "required",
                    bmrNo: "required",
                    batchNo: "required",
                    refMfrNo: "required",
                    Date: "required",
                    EquipmentName: "required",
                    Observation: "required",
                    time: "required",
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
            $("#add_homogninge").validate({
                rules: {
                    proName: "required",
                    bmrNo: "required",
                    batchNo: "required",
                    refMfrNo: "required",
                    homoTank: "required",
                    "dateProcess[]": "required",
                    "lot[]": "required",
                    "qty[]": "required",
                    "stratTime[]": "required",
                    "endTime[]": "required",
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
            })
            $("#add_manufacturing_packing").validate({
                rules: {
                    proName: "required",
                    bmrNo: "required",
                    batchNo: "required",
                    refMfrNo: "required",
                    ManufacturerDate: "required",
                    /*Observation: "required",
                    Temperature: "required",
                    Humidity: "required",
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
                    ActualYield: "required",*/
                    checkedBy: "required",
                    ApprovedBy: "required",

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
                },
            });
            $("#add_batch_equipment_vali").validate({
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
            $("#material_requisition_slip").validate({
                rules: {
                    from: "required",
                    to: "required",
                    batchNo: "required",
                    Date: "required",
                    "PackingMaterialName[]": "required",
                    "Quantity[]": "required",
                    checkedBy: "required",
                    ApprovedBy: "required",
                    //Remark: "required",
                },
                messages: {
                    from: "Please  Enter The from Name",
                    to: "Please  Enter The to Name",
                    batchNo: "Please  Enter The batchNo Name",
                    Date: "Please  Enter The Date Name",
                    PackingMaterialName: "Please  Enter The PackingMaterialName Name",
                    Capacity: "Please  Enter The Capacity Name",
                    Quantity: "Please  Enter The Quantity Name",
                    checkedBy: "Please  Enter The checkedBy Name",
                    ApprovedBy: "Please  Enter The ApprovedBy Name",

                },
            });

            $("#packing_material_requisition_slip").validate({
                rules: {
                    from: "required",
                    to: "required",
                    batchNo: "required",
                    Date: "required",
                    "PackingMaterialName[]": "required",
                    "Capacity[]": "required",
                    "Quantity[]": "required",
                    checkedBy: "required",
                    ApprovedBy: "required",
                },
                messages: {
                    from: "Please  Enter The from Name",
                    to: "Please  Enter The to Name",
                    batchNo: "Please  Enter The batchNo Name",
                    Date: "Please  Enter The Date Name",
                    PackingMaterialName: "Please  Enter The PackingMaterialName Name",
                    Capacity: "Please  Enter The Capacity Name",
                    Quantity: "Please  Enter The Quantity Name",
                    checkedBy: "Please  Enter The checkedBy Name",
                    ApprovedBy: "Please  Enter The ApprovedBy Name",

                },
            });
            $("#add_lots_process").validate({
                rules: {
                    proName: "required",
                    batchNo: "required",
                    Date: "required",
                    lotNo: "required",
                    ReactorNo: "required",
                    Process_date: "required",
                    "MaterialName[]": "required",
                    "rmbatchno[]": "required",
                    "Quantity[]": "required",
                   /* "qty[]": "required",
                    "temp[]": "required",
                    "stratTime[]": "required",
                    "endTime[]": "required",
                    "doneby[]": "required",*/
                    ApprovedBy: "required",
                },
                messages: {
                    from: "Please  Enter The from Name",
                    to: "Please  Enter The to Name",
                    batchNo: "Please  Enter The batchNo Name",
                    Date: "Please  Enter The Date Name",
                    PackingMaterialName: "Please  Enter The PackingMaterialName Name",
                    Capacity: "Please  Enter The Capacity Name",
                    Quantity: "Please  Enter The Quantity Name",
                    checkedBy: "Please  Enter The checkedBy Name",
                    ApprovedBy: "Please  Enter The ApprovedBy Name",

                },
            });

        });
    </script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" />
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#examplereq').DataTable();
            $('#examplereq_packing').DataTable();
            $('#examplereq_lots').DataTable();
            $("#examplereq_homogenizing").DataTable();
        });

        function getcodes(val, pos) {
            $.ajax({
                url: '{{ route('getequipmentcode') }}',
                method: 'POST',
                data: {
                    "id": val,
                    "_token": '{{ csrf_token() }}'
                }
            }).success(function(data) {
                $("#eqipment_code" + pos).empty();
                var option = "<option value=''>Choose Equipment Code</option>";
                $("#eqipment_code" + pos).append(option);
                $.each(data.code, function(key, val) {
                    var option = "<option value='" + key + "'>" + val + "</option>";
                    $("#eqipment_code" + pos).append(option);
                });
            });
        }
        $("#batchNo").change(function(){


            $.ajax({
                url: '{{ route('checkbatchnoexits') }}',
                method: 'POST',
                data: {
                    "id": '{{ $edit_batchmanufacturing->id }}',
                    "batch":$(this).val(),
                    "_token": '{{ csrf_token() }}'
                }
            }).success(function(data) {
                if(data.status == 0)
                {
                    $("#batchNo").val("");
                    $("#batchNo").focus();
                    swal("Exits !","This batch number already exists. Please check","warning");

                }
            });
        });


        function getbatchlot(val, pos) {
            $.ajax({
                url: '{{ route('getbatchofmaterial') }}',
                method: 'POST',
                data: {
                    "id": val,
                    "_token": '{{ csrf_token() }}'
                }
            }).success(function(data) {
                $("#rmbatchno" + pos).empty();
                var option = "<option value=''>Choose Batch No.</option>";
                $("#rmbatchno" + pos).append(option);

                $.each(data.batch, function(key, val) {

                    var option = "<option value='" + key + "'>" + val + "</option>";
                    $("#rmbatchno" + pos).append(option);
                });
            });
        }
        $(document).ready(function() {
            var max_fields_20 = 15; //maximum input boxes allowed
            var wrapper_20 = $(".input_fields_wrap_20"); //Fields wrapper
            var add_button_20 = $(".add_field_button_20"); //Add button ID
            var x = 0; //initlal text box count
            $(add_button_20).click(function(e) { //on add input button click
                e.preventDefault();
                if (x < max_fields_20) { //max input box allowed
                    x++; //text box increment
                    $(wrapper_20).append(
                        '<tr><td><input type="date" name="dateProcess[]" id="dateProcess[' + x +
                        ']" class="form-control" value="{{ date('Y-m-d') }}"></td>' +
                        '<td><input type="text" name="lot[]" id="lot' + x +
                        '" class="form-control" value=""></td>' +
                        '<td><input type="text" name="qty[]" id="qty[' + x +
                        ']" class="form-control" placeholder=""></td>' +
                        '<td><input type="text" name="stratTime[]" id="stratTime[' + x +
                        ']" class="form-control timepicker" placeholder="" data-mask="00:00"></td>' +
                        '<td><input type="text" name="endTime[]" id="endTime[' + x +
                        ']" class="form-control timepicker" placeholder="" data-mask="00:00"></td>' +
                        '<div class="input-group-btn"><button class="btn btn-danger remove_field_20" type="button"><i class="icon-remove" data-feather="x"></i></button></div>' +
                        '</tr>'); //add input box
                }
                feather.replace()
            });
            $(wrapper_20).on("click", ".remove_field_20", function(e) { //user click on remove text
                e.preventDefault();
                $(this).parents('div.row').remove();
                x--;
            });
            //    setTimeout(function () {
            //     $('.alert').alert('close');
            // }, 5000);


            $("#rmInput").keyup(function() {
                var input = $(this).val();
                var output = $("#fgOutput").val();
                if (!isNaN(input) && !isNaN(output)) {

                    $("#ActualYield").val(((output / input) * 100).toFixed(2));
                }
            })
            $("#fgOutput").keyup(function() {
                var input = $("#rmInput").val();
                var output = $("#fgOutput").val();
                if (!isNaN(input) && !isNaN(output)) {
                    $("#ActualYield").val(((output / input) * 100).toFixed(2));
                }
            })
        });

        /*$(".capacity_stock").change(function()
        {
            var id = $('.capacity_stock').val();

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: "POST",
                url:'{{ route('material_name_get') }}',

                data:  { _token: CSRF_TOKEN,id:id},
                success: function (data) {
                console.log(data.status);
                $('#Capacity').val(data.capacity)


            }

      });

    }); */
        function getcapacity(value, pos) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: "POST",
                url: '{{ route('material_name_get') }}',

                data: {
                    _token: CSRF_TOKEN,
                    id: value
                },
                success: function(data) {
                    console.log(data.status);
                    $('#Capacity' + pos).val(data.capacity)


                }
            })
        }
    </script>
    <script src="{{ asset('assets/js/jquery.mask.js?v=2.1.1') }}"></script>
    <script>
        $(document).ready(function() {
            $(".timepicker").mask('00:00');




            $(function() {
                $('input:text').keydown(function(e) {
                    if (e.keyCode == 1)
                        return false;

                });
            });


        });

        function viewlots(id)
        {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: "POST",
                url: '{{ route('lots-view') }}',

                data: {
                    _token: CSRF_TOKEN,
                    id: id
                },
                success: function(data) {
                    console.log(data.status);
                    $('.viewlotsdet').html(data.html)


                }
            })
        }
        function editslots(id)
        {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: "POST",
                url: '{{ route('lots-edit') }}',

                data: {
                    _token: CSRF_TOKEN,
                    id: id
                },
                success: function(data) {
                    console.log(data.status);
                    $('.editlotsdet').html(data.html)


                }
            })
        }
        function getbatchlotedit(val, pos) {

        $.ajax({
            url: '{{ route('getbatchofmaterial') }}',
            method: 'POST',
            data: {
                "id": val,
                "_token": '{{ csrf_token() }}'
            }
        }).success(function(data) {

            $("#rmbatchnoedit" + pos).empty();
            var option = "<option value=''>Choose Batch No.</option>";
            $("#rmbatchnoedit" + pos).append(option);

            $.each(data.batch, function(key, val) {

                var option = "<option value='" + key + "'>" + val + "</option>";
                $("#rmbatchnoedit" + pos).append(option);
            });
        });
}
function viewhomozine(id)
        {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: "POST",
                url: '{{ route('homozine-view') }}',

                data: {
                    _token: CSRF_TOKEN,
                    id: id
                },
                success: function(data) {
                    console.log(data.status);
                    $('.viewhomozinedet').html(data.html)


                }
            })
        }
        function edithomozine(id)
        {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: "POST",
                url: '{{ route('homozine-edit') }}',

                data: {
                    _token: CSRF_TOKEN,
                    id: id
                },
                success: function(data) {
                    console.log(data.status);
                    $('.edithomozinedet').html(data.html)


                }
            })
        }
        function deletelots(id)
        {
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: "POST",
                    url: '{{ route("delete-lots") }}',

                    data: {
                        _token: CSRF_TOKEN,
                        id: id
                    },
                    success: function(data) {
                        if(data.status)
                        {
                            Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                            ).then(function(){
                                location.reload();
                                }
                            );

                        }


                    }
                })

            }
            })
        }
        function deletehomozine(id)
        {
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: "POST",
                    url: '{{ route("delete-homogine") }}',

                    data: {
                        _token: CSRF_TOKEN,
                        id: id
                    },
                    success: function(data) {
                        if(data.status)
                        {
                            Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                            ).then(function(){
                                location.reload();
                                }
                            );

                        }


                    }
                })

            }
            })
        }
        // $('.timepicker').timepicker({
        //     timeFormat: 'H:mm',
        //     interval: 1,
        //     maxTime: '7:00pm',
        //     startTime: '8:00am',
        //     dynamic: true,
        //     dropdown: true,
        //     scrollbar: true
        // });



    </script>

    <script type="text/javascript">
        $(function () {
          $('.datepicker').datepicker({
            language: "es",
            autoclose: true,
            format: "dd-mm-yyyy"
          });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

@endpush
