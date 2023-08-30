<div id="addLots_listing" class="tab-pane fade {{ in_array($sequenceId,array(9,10)) ? 'in active show' : '' }}">
    @php $doneBy = [\Auth::user()->id => \Auth::user()->name];
    @endphp
    <div class="form-group">
        <input type="hidden" value="9" name="sequenceId">

        <a role="tab" data-toggle="tab" class="btn btn-primary btn-md ml-0 form-btn waves-effect waves-light "
            href="#addLots" onclick="">Add
            Lot</a>
    </div>


    <table class="table table-hover table-bordered datatable" id="examplereq_lots">
        <thead>
            <tr>
                <th>Sr.No</th>
                <th>Product Name</th>
                <th>Bmr.No</th>
                <th>lot.No</th>
                <th>Main Batch.No</th>
                <th>RefMfr.No</th>
                <th>Date</th>
                <th>Action</th>


            </tr>
        </thead>
        <tbody>

            @if ($lotsdetails)
                @foreach ($lotsdetails as $lots)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $lots->material_name }}</td>
                        <td>{{ $lots->bmrNo }}</td>
                        <td>{{ $lots->lotNo }}</td>
                        <td>{{ $lots->batchNo }}</td>
                        <td>{{ $lots->refMfrNo }}</td>
                        <td>{{ $lots->Date ? date('d/m/Y', strtotime($lots->created_at)) : '' }}</td>
                        <td><a href="#" class="btn action-btn" data-toggle="modal" data-target="#viewlots" title="View" onclick="viewlots({{$lots->lotid}})"><i data-feather="eye"></i></a> 
                         <a href="#" class="btn action-btn" data-toggle="modal" data-target="#editslots" title="Edit" onclick="editslots({{$lots->lotid}})"><i data-feather="edit"></i></a>
                          <a href="#" class="btn action-btn"  onclick="deletelots({{$lots->lotid}})"><i data-feather="trash"></i></a>
                        </td>

                    </tr>
                @endforeach
            @endif

        </tbody>
    </table>


</div>

<div id="addLots" class="tab-pane fade">

    <form method="post" action="{{ route('add_lots_update') }}" id="add_lots_process" name="add_lots_process" onsubmit="return confirm('Do you really want to submit the form?');">
        <div class="form-row">
            <input type="hidden" value="9" name="sequenceId">
            <input type="hidden" value="{{ isset($addlots->id) ? $addlots->id : '' }}" name="id">
            <input type="hidden"
                value="{{ isset($edit_batchmanufacturing->id) ? $edit_batchmanufacturing->id : '' }}" name="mainid">
            <input type="hidden" class="form-control" name="bmrNo" id="bmrNo"
                value="{{ $edit_batchmanufacturing->bmrNo }}" pattern="\d*" maxlength="120"
                onkeypress="" readonly>
            <input type="hidden" name="proName" value="{{ $batchproduct->id }}" />
            <input type="hidden" class="form-control" name="batchNo" id="batchNo"
            value="{{ $edit_batchmanufacturing->batchNo }}" pattern="\d*" maxlength="120"
            onkeypress="" readonly>
            <input type="hidden" class="form-control" name="refMfrNo" id="refMfrNo"
                        value="{{ $edit_batchmanufacturing->refMfrNo }}" pattern="\d*" maxlength="120"
                        onkeypress="" readonly>
            @csrf



            <div class="col-12 col-md-6 col-lg-6 col-xl-6" style="display:none">
                <div class="form-group">
                    <label for="Date">Date</label>
                    <input type="hidden" class="form-control" name="Date" id="Date"
                        value="{{ date('Y-m-d') }}">
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
                        value="{{ $lotno }}">
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <label for="ReactorNo">Reactor No.</label>
                    {{ Form::select('ReactorNo', $selected_crop, old('ReactorNo') ? old('ReactorNo') : '', ['class' => 'form-control select', 'id' => 'ReactorNo', 'placeholder' => 'Reactor No.']) }}

                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <label for="Date">Date</label>
                    <div class="datepicker date input-group">
                        <input type="text" placeholder="Choose Date" class="form-control" id="Process_date" name="Process_date" value="{{ date('d-m-Y') }}">
                        <div class="input-group-append">
                          <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                      </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <label for="rno">Purified water</label> <br>
                    <div class="form-check ">
                        <input class="form-check-input" type="radio" name="is_water" id="w_yes" value="1">
                        <label class="form-check-label" for="w_yes">Yes </label>
                        <input class="form-check-input" type="radio" name="is_water" id="w_no" value="2">
                        <label class="form-check-label" for="w_no">No </label>
                    </div>
                </div>
            </div>
            <div class="row m-0 mb-4" id="w_div" style="display: none;">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="waterQty" class="active">Quantity(Kg)</label>
                        <input type="text" class="form-control" name="waterQty" placeholder="" value="">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="waterARN" class="active">AR No.</label>
                        <input type="text" class="form-control" name="waterARN" placeholder="" value="">
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                <div class="form-group input_fields_wrap_4" id="MaterialReceived">

                    <label class="control-label d-flex">Raw Material Detail
                        <div class="input-group-btn">
                            <button class="btn btn-dark add-more add_field_button_4 waves-effect waves-light" type="button">Add More +</button>
                        </div>
                    </label><br>

                    @if (isset($raw_material_bills))
                        @php $lm =1; @endphp

                        @foreach ($raw_material_bills as $index => $rd)

                            @foreach ($rd as $in => $mat)
                            
                                
                                @if ($mat->material_type == "R")
                                @php
                                    $batchstock = App\Models\Stock::select('inward_raw_materials_items.batch_no', 'inward_raw_materials_items.id')
                                        ->where('department', 3)
                                        ->where(DB::raw('qty-stock.used_qty'), '>', 0)
                                        ->join('raw_materials', 'raw_materials.id', 'stock.matarial_id')
                                        ->join('inward_raw_materials_items', 'inward_raw_materials_items.id', 'stock.batch_no')
                                        ->whereIn('stock.material_type', array('R'))
                                        ->where('stock.matarial_id', $mat->material_id)
                                        ->pluck('batch_no', 'id');
                                @endphp
                                @else ($mat->material_type == "F")
                                @php
                                    $batchstock = App\Models\Stock::select("inward_finished_goods.batch_no",'inward_finished_goods.id')
                                        ->join("inward_finished_goods","inward_finished_goods.id","stock.batch_no")
                                        ->where("stock.matarial_id",$mat->material_id)
                                        ->where(DB::raw("(stock.qty-stock.used_qty)"),">",0)
                                        ->pluck('batch_no', 'id');
                                @endphp
                                @endif

                                
                                
                                <div class="row add-more-wrap5 after-add-more m-0 mb-4">
                                    <span class="add-count">{{ $lm }}</span>
                                    <input type="hidden" name="prod_d_id[]" value="{{$mat->prod_d_id}}">
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">

                                            <label for="MaterialName" class="active">Raw
                                                Material</label>
                                            {{ Form::select('MaterialName[]', $stock, old('MaterialName[]') ? old('MaterialName[]') : $mat->material_id, ['id' => 'MaterialName[]', 'class' => 'form-control select', 'selected' => 'selected', 'onchange' => "getbatchlot($(this).val()," . $lm . ')']) }}
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="rmbatchno" class="active">Batch
                                                No.</label>
                                            {{ Form::select('rmbatchno[]', $batchstock, old('rmbatchno[]') ? old('rmbatchno[]') : $mat->id, ['id' => 'rmbatchno' . $lm, 'class' => 'form-control select', 'selected' => 'selected', 'placeholder' => 'Batch No.']) }}

                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="Quantity" class="active">Quantity</label>
                                            <input type="text" class="form-control" name="Quantity[]"
                                                id="Quantity{{ $lm }}" placeholder=""
                                                value="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required>
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
                            <th>Start Time (24 Hrs)</th>
                            <th>End Time (24 Hrs)</th>
                            <th>Done by</th>
                            <th>Checked By</th>
                        </tr>
                    </thead>
                    <tbody>

                    @if(isset($processgroup) && $processgroup) 
                        @if (isset($Processlots) && count($Processlots) > 0)
                            @foreach ($Processlots as $key => $v)
            
                                <tr>
                                   <td> {{-- {{ $key == 0 ? 'Charge Polydimethylsiloxane in reactor.' : ($key == 1 ? 'Starts heating the reactor and start stirring' : ($key == 2 ? 'Once the temperature is between 100 - 120oC starts the Inline mixer and Charges ColloidalSilicon Dioxide (Fumed Silica) in reactor simultaneously and increase stirring speed.' : ($key == 3 ? 'When temperature reaches 180 - 190 oC stop heating the reactor.' : 'Stop stirrer and transfer the reaction mass to homogenizing tank No.- PR/BT/Come Tank number'))) }} --}}
                                    {{ $v->process_name }}<input type="hidden" name="processName[]" value="{{ $v->id }}">
                                    </td>
                                    <td><input type="text" value="{{ $v->qty }}" name="qty[]" id="qty"
                                            class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="7"></td>
                                    <td><input type="text" value="{{ $v->temp }}" name="temp[]" id="temp"
                                            class="form-control" maxlength="4"></td>
                                    <td><input type="text" value="{{ $v->stratTime }}" name="stratTime[]"
                                            id="stratTime[1]" class="form-control timepicker" data-mask="00:00"></td>
                                    <td><input type="text" value="{{ $v->endTime }}" name="endTime[]" id="endTime[1]"
                                            class="form-control timepicker" data-mask="00:00"></td>
                                    <td>{{ Form::select('doneby[]', $usersworker, old('doneby')?old('doneby'):(isset($v->doneby)?$v->doneby:Auth::user()->id), ['id' => 'doneby[5]', 'class' => 'form-control select', "placeholder"=>"Select Option"]) }}</td>
                                    <td>{{ Form::select('checkedby[]', $checkedBy, old('checkedby')?old('checkedby'):(isset($v->checkedby)?$v->checkedby:Auth::user()->id), ['id' => 'checkedby[5]', 'class' => 'form-control select', "placeholder"=>"Select Option"]) }}</td>
                                </tr>
                            @endforeach
                        @else
                        

                        @foreach($processgroup as $p)
                            @php $i=1; @endphp
                            <tr>
                                <td>{{ $p->process_name }} @if($p->group_id == 5 && $p->id == 35 && isset($equipment_status) && $equipment_status->EquipmentName == 2) {{$equipment_status->code}} @endif<input type="hidden" name="processName[]" value="{{ $p->id }}"></td>                                
                                <td><input type="text" name="qty[]" id="qty[{{ $i }}]" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="7"></td>
                                <td><input type="text" name="temp[]" id="temp[{{ $i }}]" class="form-control" maxlength="4"></td>
                                <td><input type="text" name="stratTime[]" id="stratTime[{{ $i }}]" class="form-control timepicker"
                                        data-mask="00:00"></td>
                                <td><input type="text" name="endTime[]" id="endTime[{{ $i }}]" class="form-control timepicker"
                                        data-mask="00:00"></td>
                                <td>{{ Form::select('doneby[]', $usersworker, old('doneby')?old('doneby'):Auth::user()->id, ['id' => 'doneby['.$i.']', 'class' => 'form-control select', "placeholder"=>"Select Option"]) }} </td>
                                <td>{{ Form::select('checkedby[]', $checkedBy, old('checkedby')?old('checkedby'):Auth::user()->id, ['id' => 'checkedby['.$i.']', 'class' => 'form-control select', "placeholder"=>"Select Option"]) }} </td>
                            </tr>
                            @php $i++ ; @endphp
                        @endforeach
                            {{-- <tr>
                                <td>Starts heating the reactor and start stirring</td>
                                
                                <td><input type="text" name="qty[]" id="qty[2]" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="7"></td>
                                <td><input type="text" name="temp[]" id="temp[2]" class="form-control" maxlength="4"></td>
                                <td><input type="text" name="stratTime[]" id="stratTime[2]" class="form-control timepicker"
                                        data-mask="00:00"></td>
                                <td><input type="text" name="endTime[]" id="endTime[2]" class="form-control timepicker"
                                        data-mask="00:00"></td>
                                <td>{{ Form::select('doneby[]', $usersworker, old('doneby')?old('doneby'):Auth::user()->id, ['id' => 'doneby[5]', 'class' => 'form-control select']) }}
                                </td>
                            </tr>
                            <tr>
                                <td>Once the temperature is between 100 - 120<sup>o</sup>C start the
                                    Inline mixer and charge ColloidalSilicon Dioxide (Fumed Silica) in
                                    reactor simultaneously and increase stirring speed.</td>
                                
                                <td><input type="text" name="qty[]" id="qty[3]" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="7"></td>
                                <td><input type="text" name="temp[]" id="temp[3]" class="form-control" maxlength="4"></td>
                                <td><input type="text" name="stratTime[]" id="stratTime[3]" class="form-control timepicker"
                                        data-mask="00:00"></td>
                                <td><input type="text" name="endTime[]" id="endTime[3]" class="form-control timepicker"
                                        data-mask="00:00"></td>
                                <td>{{ Form::select('doneby[]', $usersworker, old('doneby')?old('doneby'):Auth::user()->id, ['id' => 'doneby[5]', 'class' => 'form-control select']) }}
                                </td>
                            </tr>
                            <tr>
                                <td>When temperature reaches 180 - 190 <sup>o</sup>C stop heating the
                                    reactor.</td>
                                
                                <td><input type="text" name="qty[]" id="qty[4]" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="7"></td>
                                <td><input type="text" name="temp[]" id="temp[4]" class="form-control" maxlength="4"></td>
                                <td><input type="text" name="stratTime[]" id="stratTime4" class="form-control timepicker"
                                        data-mask="00:00"></td>
                                <td><input type="text" name="endTime[]" id="endTime4" class="form-control timepicker"
                                        data-mask="00:00"></td>
                                <td>{{ Form::select('doneby[]', $usersworker, old('doneby')?old('doneby'):Auth::user()->id, ['id' => 'doneby[5]', 'class' => 'form-control select']) }}
                                </td>
                            </tr>
                            <tr>
                                <td>Stop stirrer and transfer the reaction mass to homogenizing tank
                                    No.- PR/BT/Come Tank number</td>
                                
                                <td><input type="text" name="qty[]" id="qty[5]" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="7"></td>
                                <td><input type="text" name="temp[]" id="temp[5]" class="form-control" maxlength="4"></td>
                                <td><input type="text" name="stratTime[]" id="stratTime5" class="form-control timepicker"
                                        data-mask="00:00"></td>
                                <td><input type="text" name="endTime[]" id="endTime5" class="form-control timepicker"
                                        data-mask="00:00"></td>
                                <td>{{ Form::select('doneby[]', $usersworker, old('doneby')?old('doneby'):Auth::user()->id, ['id' => 'doneby[5]', 'class' => 'form-control select']) }}
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
                        name="submit" value="submit">Submit
                        & Next</button><button type="submit"
                        class="btn btn-light btn-md form-btn waves-effect waves-light" name="save_q" value="save_q">Save
                        &
                        Quit</button>
                        {{-- @if(!$edit_batchmanufacturing->is_review && !$edit_batchmanufacturing->is_aproved)
                        <button type="clear"
                        class="btn btn-light btn-md form-btn waves-effect waves-light" name="save_r" value="save_r">Review & Submit</button>
                    @elseif($edit_batchmanufacturing->is_review && !$edit_batchmanufacturing->is_aproved)
                        <button type="clear"
                    class="btn btn-light btn-md form-btn waves-effect waves-light" name="save_app" value="save_app">Approved & Submit</button>
                    @endif --}}
                </div>

            </div>
        </div>
    </form>
</div>
@push("models")
<div class="modal fade show" id="viewlots" tabindex="-1" aria-labelledby="checkllotsLabel" aria-modal="true">
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="checkQuntityLabel">Lots Details</h5>
      <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">x</button>
    </div>
    <div class="modal-body viewlotsdet">

    </div>
  </div>
</div>
</div>
<div class="modal fade show" id="editslots" tabindex="-1" aria-labelledby="checkQuntityLabel" aria-modal="true">
    <div class="modal-dialog modal-lg" style="max-width:1000px;">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="checkQuntityLabel">Lot Edit</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">x</button>
          </div>
          <div class="modal-body editlotsdet">

          </div>
      </div>
    </div>
    </div>
@endpush
@push("scripts")
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
  <script src="{{ asset('assets/mdbootstrap4/mdb.min.js')  }}"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{ asset('assets/js/custom.js')  }}"></script>
  <!-- End custom js for this page-->
  <script>
    $(document).ready(function() {
        $("#w_yes").click(function() {
            $("#w_div").show();
        });
        $("#w_no").click(function() {
            $("#w_div").hide();
        });
    } );
    
  </script>
  @endpush

