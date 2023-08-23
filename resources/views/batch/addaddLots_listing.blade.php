<div id="addLots_listing" class="tab-pane fade">

    <div class="form-group">
        <a role="tab" data-toggle="tab"
            class="btn btn-primary btn-md ml-0 form-btn waves-effect waves-light "
            href="#addLots">Add lots</a>
    </div>
    @if (isset($lotsdetails))
        <table class="table table-hover table-bordered datatable" id="examplereq_lots">
            <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>Product Name</th>
                    <th>Bmr.No</th>
                    <th>lot.No</th>
                    <th>batch.No</th>
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
                            <td>{{ $lots->Date ? date('d/m/Y', strtotime($lots->created_at)) : '' }}
                            </td>
                            <td><a href="#" class="btn action-btn" data-toggle="modal" data-target="#viewlots" title="View" onclick="viewlots({{$lots->lotid}})"><i data-feather="eye"></i></a>  <a href="#" class="btn action-btn" data-toggle="modal" data-target="#editslots" title="Edit" onclick="editslots({{$lots->lotid}})"><i data-feather="edit"></i></a><a href="#" class="btn action-btn"  onclick="deletelots({{$lots->lotid}})"><i data-feather="trash"></i></a>
                            </td>




                        </tr>
                    @endforeach
                @endif

            </tbody>
        </table>
    @endif
</div>

<div id="addLots" class="tab-pane fade">
    <form id="add_batch_equipment_vali" method="post" action="{{ route('add_batch_lots') }}" onsubmit="return confirm('Do you really want to submit the form?');">
        @csrf
        <input type="hidden" name="proName" value="{{ $proId }}" />
        <input type="hidden" class="form-control" name="bmrNo" id="bmrNo" pattern="\d*"
                            maxlength="120" onkeypress=""
                            value="{{ isset($batchdetails->bmrNo) ? $batchdetails->bmrNo : old('bmrNo') }}"
                            readonly>
        <input type="hidden" class="form-control" name="batchNo" id="batchNo"
                            pattern="\d*" maxlength="120"
                            onkeypress=""
                            value="{{ isset($batchdetails->batchNo) ? $batchdetails->batchNo : old('batchNo') }}"
                            readonly>
        <input type="hidden" class="form-control" name="refMfrNo" id="refMfrNo"
                            pattern="\d*" maxlength="120"
                            onkeypress=""
                            value="{{ isset($batchdetails->refMfrNo) ? $batchdetails->refMfrNo : old('refMfrNo') }}"
                            readonly>
        <input type="hidden" class="form-control" name="Date" id="Date" placeholder=""
                            value="{{ date('Y-m-d') }}">
        <div class="form-row">

            <div class="col-12">
                <div class="form-group">
                    <label class="control-label d-flex">Process Sheet</label>
                </div>
            </div>
            @php   $prvCount = Session::get('prvCount')!==null ? Session::get('prvCount'): Session::get('prvCount') ;    @endphp
            <div class="col-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <label for="lotNo" class="active">Lot No.</label>
                    <input type="text" class="form-control" name="lotNo" id="lotNo"
                        placeholder="Lot No." value="{{ isset($prvCount) ? $prvCount : $lotno }}">
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <label for="ReactorNo">Reactor No.</label>
                    {{ Form::select('ReactorNo', $selected_crop, old('ReactorNo') ? old('ReactorNo') : (isset($addlots->ReactorNo) ? $addlots->ReactorNo : ''), ['class' => 'form-control select', 'id' => 'ReactorNo', 'placeholder' => 'Reactor No.']) }}
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <label for="Date">Date</label>
                    <input type="date" class="form-control" name="Process_date"
                        id="Process_date " placeholder="" value="{{ date('Y-m-d') }}">
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                <div class="form-group input_fields_wrap_4" id="MaterialReceived">
                    <label class="control-label d-flex">Raw Material Detail
                        <div class="input-group-btn">
                            <button
                                class="btn btn-dark add-more add_field_button_4 waves-effect waves-light"
                                type="button">Add More +</button>
                        </div>
                    </label>
                    @if (isset($raw_material_bills))
                        @php $lm =1; @endphp
                        @foreach ($raw_material_bills as $mat)
                            @foreach ($mat as $index => $rd)
                                @php
                                    $batchstock = App\Models\Stock::select('inward_raw_materials_items.batch_no', 'inward_raw_materials_items.id')
                                        ->where('department', 3)
                                        ->where(DB::raw('qty-stock.used_qty'), '>', 0)
                                        ->join('raw_materials', 'raw_materials.id', 'stock.matarial_id')
                                        ->join('inward_raw_materials_items', 'inward_raw_materials_items.id', 'stock.batch_no')
                                        ->whereIn('stock.material_type', array('R','F'))
                                        ->where('stock.matarial_id', $rd->material_id)
                                        ->pluck('batch_no', 'id');
                                @endphp

                                
                                <div class="row add-more-wrap5 after-add-more m-0 mb-4">
                                    <span class="add-count">{{ $lm }}</span>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">

                                            <label for="MaterialName[]" class="active">Raw Material</label>
                                            
                                            {{ Form::select('MaterialName[]', $stock, old('MaterialName[]') ? old('MaterialName[]') : $rd->material_id, ['id' => 'MaterialName[]', 'class' => 'form-control select', 'selected' => 'selected', 'onchange' => "getbatchlot($(this).val()," . $lm . ')']) }}
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="rmbatchno" class="active">Batch No.</label>
                                            {{ Form::select('rmbatchno[]', $batchstock, old('rmbatchno[]') ? old('rmbatchno[]') : $rd->batch_id, ['id' => 'rmbatchno' . $lm, 'class' => 'form-control select', 'selected' => 'selected', 'placeholder' => 'Batch No.']) }}

                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="Quantity" class="active">Quantity (Kg.)</label>
                                            <input type="text" class="form-control"
                                                name="Quantity[]" id="Quantity{{ $lm }}"
                                                placeholder="{{ isset($rd->requesist_qty) ? $rd->requesist_qty : old('Quantity[]') }}"
                                                value="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                        </div>
                                    </div>
                                </div>
                                @php $lm++; @endphp
                            @endforeach
                        @endforeach
                    @endif
                </div>
            </div>
            @php $doneBy = [\Auth::user()->id => \Auth::user()->name];
            @endphp
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
                        @foreach($processgroup as $p)
                        @php $i=1; @endphp
                        <tr>
                            <td>{{ $p->process_name }} @if($p->group_id == 5 && isset($equipment_status) && $equipment_status->EquipmentName == 2) {{$equipment_status->code}} @endif<input type="hidden" name="processName[]" value="{{ $p->id }}"></td>
                            <td><input type="text" name="qty[]" id="qty[{{ $i }}]" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"></td>
                            <td><input type="text" name="temp[]" id="temp[{{ $i }}]" class="form-control"></td>
                            <td><input type="text" name="stratTime[]" id="stratTime[{{ $i }}]" class="form-control timepicker"
                                    data-mask="00:00"></td>
                            <td><input type="text" name="endTime[]" id="endTime[{{ $i }}]" class="form-control timepicker"
                                    data-mask="00:00"></td>
                            <td>{{ Form::select('doneby[]', $usersworker, old('doneby')?old('doneby'):Auth::user()->id, ['id' => 'doneby['.$i.']', 'class' => 'form-control select']) }}
                            </td>
                        </tr>
                        @php $i++ ; @endphp
                    @endforeach
                        {{-- <tr>
                            <td>Charge Polydimethylsiloxane in reactor.</td>
                            <td><input type="text" name="qty[]" id="qty[1]"
                                    class="form-control " oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"></td>
                            <td><input type="text" name="temp[]" id="temp[1]"
                                    class="form-control"></td>
                            <td><input type="text" name="stratTime[]" id="stratTime[1]"
                                    class="form-control timepicker" data-mask="00:00"></td>
                            <td><input type="text" name="endTime[]" id="endTime[1]"
                                    class="form-control timepicker" data-mask="00:00"></td>
                            <td>{{ Form::select('doneby[]', $usersworker, old('doneby')? old('doneby'):Auth::user()->id, ['id' => 'doneby[5]', 'class' => 'form-control select']) }}
                            </td>
                        </tr>
                        <tr>
                            <td>Starts heating the reactor and start stirring</td>
                            <td><input type="text" name="qty[]" id="qty[2]"
                                    class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"></td>
                            <td><input type="text" name="temp[]" id="temp[2]"
                                    class="form-control"></td>
                            <td><input type="text" name="stratTime[]" id="stratTime[2]"
                                    class="form-control timepicker" data-mask="00:00"></td>
                            <td><input type="text" name="endTime[]" id="endTime[2]"
                                    class="form-control timepicker" data-mask="00:00"></td>
                            <td>{{ Form::select('doneby[]', $usersworker, old('doneby')? old('doneby'):Auth::user()->id, ['id' => 'doneby[5]', 'class' => 'form-control select']) }}
                            </td>
                        </tr>
                        <tr>
                            <td>Once the temperature is between 100 - 120<sup>o</sup>C start the
                                Inline mixer and charges ColloidalSilicon Dioxide (Fumed Silica) in
                                reactor simultaneously and increase stirring speed.</td>
                            <td><input type="text" name="qty[]" id="qty[3]"
                                    class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"></td>
                            <td><input type="text" name="temp[]" id="temp[3]"
                                    class="form-control"></td>
                            <td><input type="text" name="stratTime[]" id="stratTime[3]"
                                    class="form-control timepicker" data-mask="00:00"></td>
                            <td><input type="text" name="endTime[]" id="endTime[3]"
                                    class="form-control timepicker" data-mask="00:00"></td>
                            <td>{{ Form::select('doneby[]', $usersworker, old('doneby')? old('doneby'):Auth::user()->id, ['id' => 'doneby[5]', 'class' => 'form-control select']) }}
                            </td>
                        </tr>
                        <tr>
                            <td>When temperature reaches 180 - 190 <sup>o</sup>C stop heating the
                                reactor.</td>
                            <td><input type="text" name="qty[]" id="qty[4]"
                                    class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"></td>
                            <td><input type="text" name="temp[]" id="temp[4]"
                                    class="form-control"></td>
                            <td><input type="text" name="stratTime[]" id="stratTime[4]"
                                    class="form-control timepicker" data-mask="00:00"></td>
                            <td><input type="text" name="endTime[]" id="endTime[4]"
                                    class="form-control timepicker" data-mask="00:00"></td>
                            <td>{{ Form::select('doneby[]', $usersworker, old('doneby')? old('doneby'):Auth::user()->id, ['id' => 'doneby[5]', 'class' => 'form-control select']) }}
                            </td>
                        </tr>
                        <tr>
                            <td>Stop stirrer and transfer the reaction mass to homogenizing tank
                                No.- PR/BT/Come Tank number</td>
                            <td><input type="text" name="qty[]" id="qty[5]"
                                    class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"></td>
                            <td><input type="text" name="temp[]" id="temp[5]"
                                    class="form-control"></td>
                            <td><input type="text" name="stratTime[]" id="stratTime[5]"
                                    class="form-control timepicker" data-mask="00:00"></td>
                            <td><input type="text" name="endTime[]" id="endTime[5]"
                                    class="form-control timepicker" data-mask="00:00"></td>
                            <td>{{ Form::select('doneby[]', $usersworker, old('doneby')? old('doneby'):Auth::user()->id, ['id' => 'doneby[5]', 'class' => 'form-control select']) }}
                            </td>
                        </tr> --}}
                    </tbody>
                </table>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <input type="hidden" name="batch_id" id="batch_id"
                        value="{{ isset($batchdetails->id) ? $batchdetails->id : old('batch_id') }}" />
                        <button type="submit"
                        class="btn btn-primary btn-md ml-0 form-btn waves-effect waves-light" name="submit" value="submit">Submit
                        & Next</button><button type="submit"
                        class="btn btn-light btn-md form-btn waves-effect waves-light" name="save_q" value="save_q">Save &
                        Quit</button>
            </div>
        </div>
    </form>
</div>
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

