<div id="homogenizing" class="tab-pane fade {{ $sequenceId == '12' ? 'in active show' : '' }}">
    <div class="form-group">
        <input type="hidden" value="11" name="sequenceId">

        <a role="tab" data-toggle="tab"
            class="btn btn-primary btn-md ml-0 form-btn waves-effect waves-light "
            href="#addhomogenizing">Add Homogenize</a>
    </div>


    <table class="table table-hover table-bordered datatable" id="examplereq_homogenizing">
        <thead>
            <tr>
                <th>Sr.No</th>
                <th>Product Name</th>
                <th>Bmr.No</th>
                <th>Main Batch.No</th>
                <th>RefMfr.No</th>
                <th>Date</th>
                <th>Homogenizing Tank No.</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>

            @if (isset($Homogenizing) && $Homogenizing)
                @foreach ($Homogenizing as $lots)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $lots->material_name }}</td>
                        <td>{{ $lots->bmrNo }}</td>
                        <td>{{ $lots->batchNo }}</td>
                        <td>{{ $lots->refMfrNo }}</td>
                        <td>{{ $lots->created_at ? date('d/m/Y', strtotime($lots->created_at)) : '' }}</td>
                        <td>{{ $lots->homoTank }}</td>
                        <td> <a href="#" class="btn action-btn" data-toggle="modal" data-target="#viewhomozine" title="View" onclick="viewhomozine({{$lots->id}})"><i data-feather="eye"></i></a>  <a href="#" class="btn action-btn" data-toggle="modal" data-target="#edithomozine" title="Edit" onclick="edithomozine({{$lots->id}})"><i data-feather="edit"></i></a><a href="#" class="btn action-btn"  onclick="deletehomozine({{$lots->id}})"><i data-feather="trash"></i></a></td>
                    </tr>
                @endforeach
            @endif

        </tbody>
    </table>

</div>
<div id="addhomogenizing" class="tab-pane fade">
    <form id="add_homogninge" method="post" action="{{ route('homogenizing_update') }}" onsubmit="return confirm('Do you really want to submit the form?');">
        <input type="hidden" value="12" name="sequenceId">
        <input type="hidden" value="{{ isset($Homogenizing->id) ? $Homogenizing->id : '' }}" name="id">
        <input type="hidden"
            value="{{ isset($edit_batchmanufacturing->id) ? $edit_batchmanufacturing->id : '' }}"
            name="mainid">
            <input type="hidden" name="proName" value="{{ $batchproduct->id }}" />
            <input type="hidden" class="form-control" name="bmrNo" id="bmrNo"
                        value="{{ $edit_batchmanufacturing->bmrNo }}" pattern="\d*" maxlength="120"
                        onkeypress="" readonly>
            <input type="hidden" class="form-control" name="batchNo" id="batchNo"
                        value="{{ $edit_batchmanufacturing->batchNo }}" pattern="\d*" maxlength="120"
                        onkeypress="" readonly>
            <input type="hidden" class="form-control" name="refMfrNo" id="refMfrNo"
                        value="{{ $edit_batchmanufacturing->refMfrNo }}" pattern="\d*" maxlength="120"
                        onkeypress="" readonly>
        @csrf

        <div class="form-row">


            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="homoTank">Homogenizing tank No.</label>
                    {{ Form::select('homoTank', $selected_crop_tank, old('homoTank') ? old('homoTank') : (isset($Homogenizing->homoTank) ? $Homogenizing->homoTank : ''), ['id' => 'homoTank', 'class' => 'form-control', 'placeholder' => 'Choose Homogenizing tank']) }}
                    <!--<input type="text" class="form-control" name="homoTank" id="homoTank" value="{{ isset($Homogenizing->homoTank) ? $Homogenizing->homoTank : '' }}"> -->
                </div>
            </div>

            <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                <button type="button" class="btn-primary add_field_button_20 mb-4 float-right">Add More
                    Lots +</button>
                <table class="table table-bordered" cellpadding="0" cellspacing="0" border="0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Process</th>
                            <th>Qty (Kg.)</th>
                            <th>Start Time (24 Hrs)</th>
                            <th>End Time (24 Hrs)</th>

                        </tr>
                    </thead>
                    <tbody class="input_fields_wrap_20">

                        @if (isset($HomogenizingList) && count($HomogenizingList) > 0)
                            @foreach ($HomogenizingList as $key => $temp)
                                <tr>
                                    <td>
                                        <div class="datepicker date input-group">
                                            <input type="text" placeholder="Choose Date" class="form-control" id="dateProcess[1]" name="dateProcess[]" value="{{ isset($temp->dateProcess) ? date('d-m-Y', strtotime($temp->dateProcess)): date('d-m-Y') }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                        
                                    <td><input type="text" name="lot[]" id="lot" class="form-control"
                                            value=""></td>
                                    <td><input type="text" name="qty[]" id="qty"
                                            value="{{ $temp->qty }}" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"></td>
                                    <td><input type="text" name="stratTime[]" id="stratTime"
                                            value="{{ $temp->stratTime }}" class="form-control timepicker"
                                            data-mask="00:00"></td>
                                    <td><input type="text" name="endTime[]" id="endTime"
                                            value="{{ $temp->endTime }}" class="form-control timepicker"
                                            data-mask="00:00"></td>

                                </tr>

                            @endforeach
                        @else

                            <tr>
                                <td>
                                    <div class="datepicker date input-group">
                                            <input type="text" placeholder="Choose Date" class="form-control" id="dateProcess[1]" name="dateProcess[]" value="{{ date('d-m-Y') }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                <td><input type="text" name="lot[]" id="lot" class="form-control"
                                        value=""><input type="hidden" name="lotsid[]" value=""></td>
                                <td><input type="text" name="qty[]" id="qty[1]"
                                        class="form-control" value="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"></td>
                                <td><input type="text" name="stratTime[]" id="stratTime[1]"
                                        class="form-control timepicker" value="" data-mask="00:00"></td>
                                <td><input type="texg" name="endTime[]" id="endTime[1]"
                                        class="form-control timepicker" value="" data-mask="00:00"></td>
                            </tr>

                        @endif

                    </tbody>

                </table>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label class="d-block">In Process Check (After 4 Lot)</label>
                    <input type="text" class="form-control" id="proecess_check" name="proecess_check" value="Remove sample (approx. 100gm) and check for viscosity at 25 C. 30 RPM with LV3 spindle using Brookfield Viscometer (ID No.: PR/VM/002)." />
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="Observedvalue">Observed value(cSt)</label>
                    <input type="text" class="form-control" name="Observedvalue" id="Observedvalue"
                        value="{{ isset($Homogenizing->Observedvalue) ? $Homogenizing->Observedvalue : '' }}"
                        placeholder="" value="">
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <button type="submit"
                    class="btn btn-primary btn-md ml-0 form-btn waves-effect waves-light" name="submit" value="submit">Submit
                    & Next</button><button type="clear"
                    class="btn btn-light btn-md form-btn waves-effect waves-light" name="save_q" value="save_q">Save &
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
<div class="modal fade show" id="viewhomozine" tabindex="-1" aria-labelledby="checkllotsLabel" aria-modal="true">
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="checkQuntityLabel">Homogenizing Details</h5>
      <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">x</button>
    </div>
    <div class="modal-body viewhomozinedet">

    </div>
  </div>
</div>
</div>
<div class="modal fade show" id="edithomozine" tabindex="-1" aria-labelledby="checkQuntityLabel" aria-modal="true">
    <div class="modal-dialog modal-lg" style="max-width:1000px;">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="checkQuntityLabel">Homogenizing Edit</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">x</button>
          </div>
          <div class="modal-body edithomozinedet">

          </div>
      </div>
    </div>
    </div>
@endpush

