<div class="form-row">
    <div class="col-12">
        <h3>Homogenizing details of {{ $batchdetails->productname }} Batch No. {{ $batchdetails->batchNo }}</h3>
    </div>
    <div class="col-12 table-responsive">
        <form id="add_homogninge_single" method="post" action="{{ route('homogenizing_update_single') }}" onsubmit="return confirm('Do you really want to submit the form?');">
            <input type="hidden" value="11" name="sequenceId">
            <input type="hidden" value="{{ isset($Homogenizing->id) ? $Homogenizing->id : '' }}" name="id">
            <input type="hidden"
                value="{{ isset($batchdetails->id) ? $batchdetails->id : '' }}"
                name="mainid">
            @csrf

            <div class="form-row">
                <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="proName" class="active">Product Name</label>

                        <input type="text" readonly name="proNameName" id="proNameName" class="form-control" value="{{ $batchdetails->productname }}"/>

                        @if ($errors->has('proName'))
                            <span class="text-danger">{{ $errors->first('proName') }}</span>
                        @endif
                        <input type="hidden" name="proName" value="{{ $batchdetails->id }}" />

                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="bmrNo" class="active">BMR No.</label>
                        <input type="text" class="form-control" name="bmrNo" id="bmrNo"
                            value="{{ $batchdetails->bmrNo }}" pattern="\d*" maxlength="120"
                            onkeypress="" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="batchNo">Batch No.</label>
                        <input type="text" class="form-control" name="batchNo" id="batchNo"
                            value="{{ $batchdetails->batchNo }}" pattern="\d*" maxlength="120"
                            onkeypress="" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="refMfrNo">Ref. MFR No.</label>
                        <input type="text" class="form-control" name="refMfrNo" id="refMfrNo"
                            value="{{ $batchdetails->refMfrNo }}" pattern="\d*" maxlength="120"
                            onkeypress="" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="homoTank">Homogenizing tank No.</label>
                        {{ Form::select('homoTank', $selected_crop_tank, old('homoTank') ? old('homoTank') : (isset($Homogenizing->homoTank) ? $Homogenizing->homoTank : ''), ['id' => 'homoTank', 'class' => 'form-control', 'placeholder' => 'Choose Homogenizing tank']) }}
                        <!--<input type="text" class="form-control" name="homoTank" id="homoTank" value="{{ isset($Homogenizing->homoTank) ? $Homogenizing->homoTank : '' }}"> -->
                    </div>
                </div>

                <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                    <button type="button" class="btn-primary add_field_button_20_edit mb-4 float-right">Add More
                        Lots +</button>
                    <table class="table table-bordered" cellpadding="0" cellspacing="0" border="0">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Process</th>
                                <th>Qty (Kg.)</th>
                                <th>Start Time (Hrs)</th>
                                <th>End Time (Hrs)</th>
                                <th>Done By</th>
                            </tr>
                        </thead>
                        <tbody class="input_fields_wrap_20_edit">

                            @if (isset($homoList) && count($homoList) > 0)
                                @foreach ($homoList as $key => $temp)
                                    <tr>
                                        <td><input type="date" name="dateProcess[]"
                                                value="{{ $temp->dateProcess }}" id="dateProcess[1]"
                                                class="form-control"></td>
                                        <td><input type="text" name="lot[]" id="lot" class="form-control"
                                                value="{{ $temp->lots_name }}"></td>
                                        <td><input type="text" name="qty[]" id="qty"
                                                value="{{ number_format($temp->qty,3,".","") }}" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"></td>
                                        <td><input type="time" name="stratTime[]" id="stratTime"
                                                value="{{ $temp->stratTime }}" class="form-control time"
                                                data-mask="00:00"></td>
                                        <td><input type="time" name="endTime[]" id="endTime"
                                                value="{{ $temp->endTime }}" class="form-control time"
                                                data-mask="00:00"></td>

                                        <td>{{ Form::select('doneby[]', $users, old('doneby')?old('doneby'):(isset($temp->doneby)?$temp->doneby:Auth::user()->id), ['id' => 'doneby[5]', 'class' => 'form-control select']) }}</td>

                                    </tr>

                                @endforeach
                            @else

                                <tr>
                                    <td><input type="date" name="dateProcess[]" id="dateProcess[1]"
                                            class="form-control" value="{{ date('Y-m-d') }}"></td>
                                    <td><input type="text" name="lot[]" id="lot" class="form-control"
                                            value=""><input type="hidden" name="lotsid[]" value=""></td>
                                    <td><input type="text" name="qty[]" id="qty[1]"
                                            class="form-control" value="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"></td>
                                    <td><input type="time" name="stratTime[]" id="stratTime[1]"
                                            class="form-control time" value="" data-mask="00:00"></td>
                                    <td><input type="time" name="endTime[]" id="endTime[1]"
                                            class="form-control time" value="" data-mask="00:00"></td>
                                </tr>

                            @endif

                        </tbody>

                    </table>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label class="d-block">In Process Check (After 4 Lot)</label>
                        <input type="text" class="form-control" id="proecess_check" name="proecess_check" value="{!! isset($Homogenizing->proecess_check) ? $Homogenizing->proecess_check : 'Remove sample (approx. 100gm) and check for viscosity at 25 <sup>o</sup>C/ 30 RPM with LV3 spindle using Brookfield Viscometer (ID No.: PR/VM/002).'!!}" />
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="Observedvalue">Observed value</label>
                        <input type="text" class="form-control" name="Observedvalue" id="Observedvalue"
                            value="{!! isset($Homogenizing->Observedvalue) ? $Homogenizing->Observedvalue : '' !!}"
                            placeholder="" value="">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <button type="submit"
                        class="btn btn-primary btn-md ml-0 form-btn waves-effect waves-light" name="submit" value="submit">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
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

      $(document).ready(function() {

            var max_fields_20 = 15; //maximum input boxes allowed
            var wrapper_20 = $(".input_fields_wrap_20_edit"); //Fields wrapper
            var add_button_20 = $(".add_field_button_20_edit"); //Add button ID
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
                        ']" class="form-control" placeholder="" onkeypress="return validateNumber(event);"></td>' +
                        '<td><input type="time" name="stratTime[]" id="stratTime[' + x +
                        ']" class="form-control time" placeholder="" data-mask="00:00"></td>' +
                        '<td><input type="time" name="endTime[]" id="endTime[' + x +
                        ']" class="form-control itme" placeholder="" data-mask="00:00"></td>' +
                        '<td><select  name="doneby[]" id="doneby[' + x +
                        ']" class="form-control select" placeholder="Select User">@if(isset($users)) @foreach($users as $k=>$u) <option value="{{ $k }}">{{ $u }}</option>@endforeach @endif </select></td>' +
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
            $("#add_homogninge_single").validate({
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
                    "doneBy[]": "required"
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
        });


    </script>
