<div id="listOfEquipment" class="tab-pane fade {{ $sequenceId == '8' ? 'in active show' : '' }}">
    <form id="add_batch_equipment_vali" method="post"
        action="{{ route('list_of_equipment_update') }}">
        <input type="hidden" value="8" name="sequenceId">
        <input type="hidden" value="{{ isset($res_data_1->id) ? $res_data_1->id : '' }}" name="id">
        <input type="hidden" value="{{ $edit_batchmanufacturing->id }}" name="mainid">
        <input type="hidden" value="{{ $edit_batchmanufacturing->proName }}" name="proName">
        <input type="hidden" class="form-control" name="bmrNo" id="bmrNo"
                        value="{{ isset($res_data_1->bmrNo) ? $res_data_1->bmrNo : $edit_batchmanufacturing->bmrNo }}"
                        pattern="\d*" maxlength="120"
                        onkeypress="">
        <input type="hidden" class="form-control" name="batchNo" id="batchNo"
                        value="{{ $edit_batchmanufacturing->batchNo }}" readonly pattern="\d*"
                        maxlength="120" onkeypress=""
                        readonly>
       <input type="hidden" class="form-control" name="refMfrNo" id="refMfrNo"
                        value="{{ $edit_batchmanufacturing->refMfrNo }}" pattern="\d*" maxlength="120"
                        onkeypress="" pattern="\d*"
                        maxlength="120" onkeypress=""
                        readonly>
        @csrf
        <div class="form-row">



            <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                <div class="form-group input_fields_wrap_1" id="MaterialReceived">
                    <label class="control-label d-flex">List of Equipment in Manufacturing Process
                        <div class="input-group-btn">
                            <button
                                class="btn btn-dark add-more add_field_button_1 waves-effect waves-light"
                                type="button">Add More +</button>
                        </div>
                    </label>
                    @php $lc =1; @endphp
                    @if (isset($res_1) && count($res_1) > 0)

                        @foreach ($res_1 as $temp)

                            <div class="row add-more-wrap after-add-more m-0 mb-4">
                                <span class="add-count">{{ $lc }}</span>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="EquipmentName" class="active">Equipment
                                            Name</label>
                                            <select class="form-control select" id="eqipment_name{{$lc}}" name="EquipmentName[]" onchange= "getcodes($(this).val(),{{ $lc }})">
                                               <option value="">Select option </option>
                                               @foreach($eqipment_name as $k=>$e)
                                               <option value="{{$k}}" @if($temp->EquipmentName == $k) selected @endif>{{ $e }} </option>
                                               @endforeach
                                            </select>
                                        <!-- {{ Form::select('EquipmentName[]', $eqipment_name, old('eqipment_name') ? old('eqipment_name') : $temp->EquipmentName, ['class' => 'form-control select', 'id' => 'eqipment_name' . $lc, 'Placeholder' => 'Equipment Name', 'onchange' => "getcodes($(this).val()," . $lc . ')']) }} -->

                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="EquipmentCode" class="active">Equipment
                                            Code</label>
                                            <select class="form-control select" id="eqipment_code{{$lc}}" name="EquipmentCode[]">
                                               <option value="">Select option </option>
                                               @foreach($eqipment_code as $k=>$e)
                                               @if($temp->EquipmentName == $e->equipment_id)
                                               <option value="{{$e->id}}" @if($temp->EquipmentCode == $e->id) selected @endif>{{ $e->code }} </option>
                                               @endif
                                               @endforeach
                                            </select>
                                        


                                    </div>
                                </div>
                            </div>
                            @php $lc++; @endphp
                        @endforeach
                    @else
                        <div class="row add-more-wrap after-add-more m-0 mb-4">
                            <span class="add-count">1</span>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="EquipmentName" class="active">Equipment
                                        Name</label>
                                        <select class="form-control select" id="eqipment_name1" name="EquipmentName[]" onchange= "getcodes($(this).val(),{{ $lc }})">
                                               <option value="">Select option </option>
                                               @foreach($eqipment_name as $k=>$e)
                                               <option value="{{$k}}">{{ $e }} </option>
                                               @endforeach
                                            </select>
                                    <!-- {{ Form::select('EquipmentName[]', $eqipment_name, old('eqipment_name'), ['class' => 'form-control select', 'id' => 'eqipment_name1', 'Placeholder' => 'Equipment Name', 'onchange' => "getcodes($(this).val()," . $lc . ')']) }} -->

                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="EquipmentCode" class="active">Equipment
                                        Code</label>
                                        <select class="form-control select" id="eqipment_code{{$lc}}" name="EquipmentCode[]" >
                                               <option value="">Choose Batch number </option>
                                               
                                            </select>
                                    

                                </div>
                            </div>
                        </div>
                    @endif


                </div>
            </div>
            <div class="col-12 col-md-12">
                <div class="form-group">
                    <label for="Remark" class="active">Note / Remark</label>
                    <textarea class="form-control" name="Remark" id="Remark"
                        placeholder="Note / Remark">{{ isset($res_data->Remark) ? $res_data->Remark : '' }}</textarea>
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
                        @endif--}}
                </div>
            </div>
        </div>
    </form>
</div>

