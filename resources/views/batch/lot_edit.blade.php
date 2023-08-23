<div class="form-row">
    <div class="col-12">
        <h3>Lot details of {{ $batchdetails->productname }} Batch No. {{ $batchdetails->batchNo }}</h3>
    </div>
    <div class="col-12 table-responsive">
        <form method="post" action="{{ route('add_lots_editupdate') }}" id="add_lots_process" name="add_lots_process" onsubmit="return confirm('Do you really want to submit the form?');">
            <div class="form-row">
                <input type="hidden" value="{{ isset($lotsdetails->id) ? $lotsdetails->id : '' }}" name="id">
                <input type="hidden"
                    value="{{ isset($batchdetails->id) ? $batchdetails->id : '' }}" name="mainid">
                @csrf

                <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="proName" class="active">Product Name</label>
                        <input type="text" readonly name="proNameName" id="proNameName" class="form-control" value="{{ $batchdetails->productname }}"/>

                        @if ($errors->has('proName'))
                            <span class="text-danger">{{ $errors->first('proName') }}</span>
                        @endif
                        <input type="hidden" name="proName" value="{{ $lotsdetails->proName }}" />
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="bmrNo" class="active">BMR No.</label>
                        <input type="text" class="form-control" name="bmrNo" id="bmrNo"
                            value="{{ $lotsdetails->bmrNo }}" pattern="\d*" maxlength="120"
                            onkeypress="" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="batchNo">Batch No.</label>
                        <input type="text" class="form-control" name="batchNo" id="batchNo"
                            value="{{ $lotsdetails->batchNo }}" pattern="\d*" maxlength="120"
                            onkeypress="" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="refMfrNo">Ref. MFR No.</label>
                        <input type="text" class="form-control" name="refMfrNo" id="refMfrNo"
                            value="{{ $lotsdetails->refMfrNo }}" pattern="\d*" maxlength="120"
                            onkeypress="" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label for="Date">Date</label>
                        <input type="date" class="form-control" name="Date" id="Date"
                            value="{{ isset($lotsdetails->Date) ? $lotsdetails->Date : date('Y-m-d') }}">
                    </div>
                </div>
                <!-- <label for="rno">Purified water</label> <br>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="is_water" id="inlineRadio1" value="1" />
                  <label class="form-check-label" for="inlineRadio1">Yes</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="is_water" id="inlineRadio2" value="2" />
                  <label class="form-check-label" for="inlineRadio2">No</label>
                </div> -->
                <div class="col-2">
                    <div class="form-group">
                        <label for="rno">Purified water</label> <br>
                        <div class="form-check ">
                            <input class="form-check-input" type="radio" name="is_water" id="w_yes1" value="1" @if($lotsdetails->is_water == 1){{"checked"}} @endif>
                            <label class="form-check-label" for="w_yes1">Yes </label>
                            <input class="form-check-input" type="radio" name="is_water" id="w_no1" value="2" @if($lotsdetails->is_water == 2){{"checked"}} @endif>
                            <label class="form-check-label" for="w_no1">No </label>
                        </div>
                    </div>
                </div>
                
                <div class="row m-0 col-md-6" id="w_div1">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="waterQty" class="active">Quantity(Kg).</label>
                            <input type="text" class="form-control" name="waterQty" placeholder="" value="{{$lotsdetails->waterQty}}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="waterARN" class="active">AR No.</label>
                            <input type="text" class="form-control" name="waterARN" placeholder="" value="{{$lotsdetails->waterARN}}">
                        </div>
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
                        <input type="text" class="form-control" name="lotNo" id="lotNo"
                            value="{{ isset($lotsdetails->lotNo) ? $lotsdetails->lotNo : 1 }}">
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="form-group">
                        <label for="ReactorNo">Reactor No.</label>
                        {{ Form::select('ReactorNo', $selected_crop, old('ReactorNo') ? old('ReactorNo') : (isset($lotsdetails->ReactorNo) ? $lotsdetails->ReactorNo : ''), ['class' => 'form-control select', 'id' => 'ReactorNo', 'placeholder' => 'Reactor No.']) }}

                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="form-group">
                        <label for="Date">Date</label>
                        <input type="date" class="form-control" name="Process_date" id="Process_date " placeholder=""
                            value="{{ isset($lotsdetails->Process_date) ? $lotsdetails->Process_date : date('Y-m-d') }}">
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group input_fields_wrap_4_update" id="MaterialReceived">

                        <label class="control-label d-flex">Raw Material Detail
                            <div class="input-group-btn">
                                <button class="btn btn-dark add-more add_field_button_4_update waves-effect waves-light"
                                    type="button">Add More +</button>
                            </div>
                        </label>
                        <br>
                        @if (isset($raw_material_bills) && $raw_material_bills->count() > 0)
                            @php $lm =1; @endphp

                            @foreach ($raw_material_bills as $index => $mat)

                                    @php
                                        $batchstock = App\Models\Stock::select('inward_raw_materials_items.batch_no', 'inward_raw_materials_items.id')
                                            /*->where('department', 3)
                                            ->where(DB::raw('qty-stock.used_qty'), '>', 0)*/
                                            ->join('raw_materials', 'raw_materials.id', 'stock.matarial_id')
                                            ->join('inward_raw_materials_items', 'inward_raw_materials_items.id', 'stock.batch_no')                                            
                                            ->whereIn('stock.material_type',array('R','F'))
                                            ->where('stock.matarial_id', $mat->MaterialName)
                                            ->pluck('batch_no', 'id');

                                    @endphp
                                    <input type="hidden" name="detail_id[]" value="{{$mat->req_detail_id}}">
                                    <div class="row add-more-wrap5 after-add-more m-0 mb-4">
                                        <span class="add-count">{{ $lm }}</span>
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">

                                                <label for="MaterialName[]" class="active">Raw
                                                    Material</label>
                                                {{ Form::select('MaterialName[]', $stock, old('MaterialName[]') ? old('MaterialName[]') : $mat->MaterialName, ['id' => 'MaterialName[]', 'class' => 'form-control select', 'selected' => 'selected', 'onchange' => "getbatchlotedit($(this).val()," . $lm . ')']) }}
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <label for="rmbatchno" class="active">Batch
                                                    No.</label>
                                                {{ Form::select('rmbatchno[]', $batchstock, old('rmbatchno[]') ? old('rmbatchno[]') : $mat->rmbatchno, ['id' => 'rmbatchnoedit' . $lm, 'class' => 'form-control select', 'selected' => 'selected', 'placeholder' => 'Batch No.']) }}

                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <label for="Quantity" class="active">Quantity</label>
                                                <input type="text" class="form-control" name="Quantity[]"
                                                    id="Quantity{{ $lm }}" placeholder=""
                                                    value="{{ isset($mat->Quantity) ? $mat->Quantity : old('Quantity[]') }}">
                                            </div>
                                        </div>                                        
                                    </div>
                                    @php $lm++; @endphp

                            @endforeach
                        @elseif(isset($raw_material_bills_req))
                            @php $lm =1; @endphp

                            @foreach ($raw_material_bills_req as $index => $rd)
                                @foreach ($rd as $in => $mat)
                                @php
                                    $batchstock = App\Models\Stock::select('inward_raw_materials_items.batch_no', 'inward_raw_materials_items.id')
                                        ->where('department', 3)
                                        ->where(DB::raw('qty-stock.used_qty'), '>', 0)
                                        ->join('raw_materials', 'raw_materials.id', 'stock.matarial_id')
                                        ->join('inward_raw_materials_items', 'inward_raw_materials_items.id', 'stock.batch_no')

                                        ->where('stock.material_type', 'R')
                                        ->where('stock.matarial_id', $mat->material_id)
                                        ->pluck('batch_no', 'id');


                                @endphp
                                <input type="hidden" name="detail_id[]" value="{{$mat->detail_id}}">
                                <div class="row add-more-wrap5 after-add-more m-0 mb-4">
                                    <span class="add-count">{{ $lm }}</span>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">

                                            <label for="MaterialName[]" class="active">Raw
                                                Material</label>
                                            {{ Form::select('MaterialName[]', $stock, old('MaterialName[]') ? old('MaterialName[]') : $mat->material_id, ['id' => 'MaterialName[]', 'class' => 'form-control select', 'selected' => 'selected', 'onchange' => "getbatchlotedit($(this).val()," . $lm . ')']) }}
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="rmbatchno" class="active">Batch
                                                No.</label>
                                            {{ Form::select('rmbatchno[]', $batchstock, old('rmbatchno[]') ? old('rmbatchno[]') : $mat->id, ['id' => 'rmbatchnoedit' . $lm, 'class' => 'form-control select', 'selected' => 'selected', 'placeholder' => 'Batch No.']) }}

                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="Quantity" class="active">Quantity</label>
                                            <input type="text" class="form-control" name="Quantity[]"
                                                id="Quantity{{ $lm }}" placeholder=""
                                                value="{{ isset($mat->used_qty) ? $mat->used_qty : old('Quantity[]') }}">
                                        </div>
                                    </div>
                                </div>
                                @php $lm++; @endphp
                            @endforeach
                        @endforeach
                        @endif

                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                    <table class="table table-bordered" cellpadding="0" cellspacing="0" border="0">
                        <thead>
                            <tr>
                                <th>Process</th>
                                <th>Qty. (Kg.)</th>
                                <th>Temp (<sup>o</sup>C)</th>
                                <th>Start Time <br> (Hrs)</th>
                                <th>End Time <br> (Hrs)</th>
                                <th>Done by</th>
                                <th>Checked by</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(isset($processgroup) && $processgroup)
                            @if (isset($process) && count($process) > 0)
                                @foreach ($process as $key => $v)

                                    <tr>
                                         <td>{{--{{ $key == 0 ? 'Charge Polydimethylsiloxane in reactor.' : ($key == 1 ? 'Starts heating the reactor and start stirring' : ($key == 2 ? 'Once the temperature is between 100 - 120oC start the Inline mixer and charges ColloidalSilicon Dioxide (Fumed Silica) in reactor simultaneously and increase stirring speed.' : ($key == 3 ? 'When of temperature reaches 180 - 190 oC stops heating the reactor.' : 'Stop stirrer and transfer the reaction mass to homogenizing tank No.- PR/BT/Come Tank number'))) }} --}}
                                            {{ $v->process_name }}@if($v->group_id == 5 && $v->process_id == 35 && isset($equipment_status) && $equipment_status->EquipmentName == 2) {{$equipment_status->code}} @endif<input type="hidden" name="processName[]" value="{{ $v->process_id }}">
                                        </td>
                                        <td><input type="text" value="{{ $v->qty }}" name="qty[]" id="qty"
                                                class="form-control" size="20" maxlength="120" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"></td>
                                        <td><input type="text" value="{{ $v->temp }}" name="temp[]" id="temp"
                                                class="form-control"  size="20" maxlength="120"></td>
                                        <td><input type="time" value="{{ $v->stratTime }}" name="stratTime[]"
                                                id="stratTime" class="form-control time" data-mask="00:00"></td>
                                        <td><input type="time" value="{{ $v->endTime }}" name="endTime[]" id="endTime[1]"
                                                class="form-control time" data-mask="00:00"></td>
                                        <td>{{ Form::select('doneby[]', $users, old('doneby')?old('doneby'):(isset($v->doneby)?$v->doneby:Auth::user()->id), ['id' => 'doneby[5]', 'class' => 'form-control select', "placeholder"=>"Select Option"]) }}

                                        </td>
                                        <td>{{ Form::select('checkedby[]', $checkedBy, old('checkedby')?old('checkedby'):(isset($v->checkedby)?$v->checkedby:Auth::user()->id), ['id' => 'checkedby[5]', 'class' => 'form-control select', "placeholder"=>"Select Option"]) }}</td>
                                    </tr>
                                @endforeach
                            @else

                            @foreach($processgroup as $p)
                            @php $i=1; @endphp
                            <tr>
                                <td>{{ $p->process_name }} @if($p->group_id == 5 && $p->process_id == 35 && isset($equipment_status) && $equipment_status->EquipmentName == 2) {{$equipment_status->code}} @endif<input type="hidden" name="processName[]" value="{{ $p->id }}"></td>
                                <td><input type="text" name="qty[]" id="qty[{{ $i }}]" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"></td>
                                <td><input type="text" name="temp[]" id="temp[{{ $i }}]" class="form-control"></td>
                                <td><input type="text" name="stratTime[]" id="stratTime[{{ $i }}]" class="form-control timepicker"
                                        data-mask="00:00"></td>
                                <td><input type="text" name="endTime[]" id="endTime[{{ $i }}]" class="form-control timepicker"
                                        data-mask="00:00"></td>
                                <td>{{ Form::select('doneby[]', $users, old('doneby')?old('doneby'):Auth::user()->id, ['id' => 'doneby['.$i.']', 'class' => 'form-control select', "placeholder"=>"Select Option"]) }}</td>
                                    <td>{{ Form::select('checkedby[]', $checkedBy, old('checkedby')?old('checkedby'):Auth::user()->id, ['id' => 'checkedby['.$i.']', 'class' => 'form-control select', "placeholder"=>"Select Option"]) }} </td>
                                
                            </tr>
                            @php $i++ ; @endphp
                        @endforeach

                                {{-- <tr>
                                    <td>Charge Polydimethylsiloxane in reactor.</td>
                                    <td><input type="text" name="qty[]" id="qty[1]" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"></td>
                                    <td><input type="text" name="temp[]" id="temp[1]" class="form-control"></td>
                                    <td><input type="time" name="stratTime[]" id="stratTime[1]" class="form-control time"
                                            data-mask="00:00"></td>
                                    <td><input type="time" name="endTime[]" id="endTime[1]" class="form-control time"
                                            data-mask="00:00"></td>
                                    <td>{{ Form::select('doneby[]', $users, old('doneby')?old('doneby'):Auth::user()->id, ['id' => 'doneby[5]', 'class' => 'form-control select']) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Starts heating the reactor and start stirring</td>
                                    <td><input type="number" name="qty[]" id="qty[2]" class="form-control"></td>
                                    <td><input type="text" name="temp[]" id="temp[2]" class="form-control"></td>
                                    <td><input type="time" name="stratTime[]" id="stratTime[2]" class="form-control time"
                                            data-mask="00:00"></td>
                                    <td><input type="time" name="endTime[]" id="endTime[2]" class="form-control time"
                                            data-mask="00:00"></td>
                                    <td>{{ Form::select('doneby[]', $users, old('doneby')?old('doneby'):Auth::user()->id, ['id' => 'doneby[5]', 'class' => 'form-control select']) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Once the temperature is between 100 - 120<sup>o</sup>C start the
                                        Inline mixer and charges ColloidalSilicon Dioxide (Fumed Silica) in
                                        reactor simultaneously and increase stirring speed.</td>
                                    <td><input type="number" name="qty[]" id="qty[3]" class="form-control"></td>
                                    <td><input type="text" name="temp[]" id="temp[3]" class="form-control"></td>
                                    <td><input type="time" name="stratTime[]" id="stratTime[3]" class="form-control time"
                                            data-mask="00:00"></td>
                                    <td><input type="time" name="endTime[]" id="endTime[3]" class="form-control time"
                                            data-mask="00:00"></td>
                                    <td>{{ Form::select('doneby[]', $users, old('doneby')?old('doneby'):Auth::user()->id, ['id' => 'doneby[5]', 'class' => 'form-control select']) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>When temperature reaches 180 - 190 <sup>o</sup>C stop heating the
                                        reactor.</td>
                                    <td><input type="number" name="qty[]" id="qty[4]" class="form-control"></td>
                                    <td><input type="text" name="temp[]" id="temp[4]" class="form-control"></td>
                                    <td><input type="time" name="stratTime[]" id="stratTime4" class="form-control time"
                                            data-mask="00:00"></td>
                                    <td><input type="time" name="endTime[]" id="endTime4" class="form-control time"
                                            data-mask="00:00"></td>
                                    <td>{{ Form::select('doneby[]', $users, old('doneby')?old('doneby'):Auth::user()->id, ['id' => 'doneby[5]', 'class' => 'form-control select']) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Stop stirrer and transfer the reaction mass to homogenizing tank
                                        No.- PR/BT/Come Tank number</td>
                                    <td><input type="number" name="qty[]" id="qty[5]" class="form-control"></td>
                                    <td><input type="text" name="temp[]" id="temp[5]" class="form-control"></td>
                                    <td><input type="time" name="stratTime[]" id="stratTime5" class="form-control time"
                                            data-mask="00:00"></td>
                                    <td><input type="time" name="endTime[]" id="endTime5" class="form-control time"
                                            data-mask="00:00"></td>
                                    <td>{{ Form::select('doneby[]', $users, old('doneby')?old('doneby'):Auth::user()->id, ['id' => 'doneby[5]', 'class' => 'form-control select']) }}
                                    </td>
                                </tr> --}}

                                @endif
                            @endif

                        </tbody>
                    </table>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-md ml-0 form-btn waves-effect waves-light"
                            name="submit" value="submit">Submit</button>
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

            var max_fields = 15; //maximum input boxes allowed
            var wrapper = $(".input_fields_wrap_4_update"); //Fields wrapper
            var add_button = $(".add_field_button_4_update"); //Add button ID
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
                        '" class="active">Raw Material</label><select class="form-control select" id="MaterialName' +
                        x + '" onchange="getbatchlotedit($(this).val(),' + x +
                        ')"  name="MaterialName[]"><option>Select Raw Material</option>@if (isset($stock)) @foreach ($stock as $key => $value) <option value="{{ $key }}">{{ $value }}</option> @endforeach @endif</select></div></div><div class="col-12 col-md-4"><div class="form-group"><label for="rmbatchno' +
                        x +
                        '" class="active">Batch No.</label><select name="rmbatchno[]" class="form-control" id="rmbatchnoedit' +
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
            var is_water = "{{$lotsdetails->is_water}}";
            if(is_water == 1) {
                $("#w_div1").addClass('show');
            } else {
                $("#w_div1").addClass('hide');
            }
            $("#w_yes1").click(function() {
                  $("#w_div1").addClass('show');
                  $("#w_div1").removeClass('hide');
              });
              $("#w_no1").click(function() {
                  $("#w_div1").removeClass('show');
                  $("#w_div1").addClass('hide');
              });
        });

    </script>
