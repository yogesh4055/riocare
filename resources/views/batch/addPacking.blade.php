<div id="Packing" class="tab-pane fade">
    <form id="add_manufacturing_packing" method="post"
        action="{{ route('add_manufacturing_packing_insert') }}">
        @csrf
        <input type="hidden" name="proName" value="{{ isset($batchproduct->id)?$batchproduct->id:0 }}" />
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
        <div class="form-row">


            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="ManufacturerDate" class="active">Date</label>
                    <input type="date" class="form-control calendar" name="ManufacturerDate"
                        id="ManufacturerDate" value="{{ date('Y-m-d') }}">
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                <div class="form-group input_fields_wrap" id="MaterialReceived">
                    <label class="control-label d-flex">Packing
                        <!-- <div class="input-group-btn">  -->
                        <!-- <button class="btn btn-dark add-more add_field_button waves-effect waves-light" type="button">Add More +</button> -->
                        <!-- </div> -->
                    </label>
                    <div class="row add-more-wrap after-add-more m-0 mb-4">
                        <!-- <span class="add-count">1</span> -->
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="startTime" class="active">Observation Time
                                    (Hrs.)</label>
                                <input type="text" class="form-control timepicker" name="startTime"
                                    id="startTime" placeholder="" data-mask="00:00"
                                    data-mask="00:00">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="Observation" class="active">Area cleanliness
                                    checked by Production Observation</label>
                                <input type="text" class="form-control" name="Observation"
                                    id="Observation" placeholder="Observation">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="Temperature" class="active">Temperature (
                                    <sup>o</sup>C) of Filling area</label>
                                <input type="text" class="form-control" name="Temperature"
                                    id="Temperature" placeholder="Observation">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="Humidity" class="active">Humidity (%RH) of
                                    Filling area</label>
                                <input type="text" class="form-control" name="Humidity"
                                    id="Humidity" placeholder="Observation">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="TemperatureP" class="active">Temperature (
                                    <sup>o</sup>C) of Product</label>
                                <input type="text" class="form-control" name="TemperatureP"
                                    id="TemperatureP" placeholder="Observation">
                            </div>
                        </div>
                        <div class="col-12"></div>
                        {{--  <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="200kgDrums" class="active">5 Kg No of Drums
                                    filled</label>
                                <input type="Number" class="form-control" name="5kgDrums"
                                    id="5kgDrums" placeholder="No of Drums">
                            </div>
                        </div>
                        --}}
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="200kgDrums" class="active">30 Kg No of Drums
                                    filled</label>
                                <input type="Number" class="form-control" name="30kgDrums"
                                    id="30kgDrums" placeholder="No of Drums">
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="50kgDrums" class="active">50 Kg No of Drums
                                    filled</label>
                                <input type="Number" class="form-control" name="50kgDrums"
                                    id="50kgDrums" placeholder="No of Drums">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="200kgDrums" class="active">200 Kg No of Drums
                                    filled</label>
                                <input type="Number" class="form-control" name="20kgDrums"
                                    id="20kgDrums" placeholder="No of Drums">
                            </div>
                        </div>


                      {{--   <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="EndstartTime" class="active">End Time
                                    (Hrs.)</label>
                                <input type="time" class="form-control time" name="EndstartTime"
                                    id="EndstartTime" placeholder="" data-mask="00:00">
                            </div>
                        </div> --}}
                        <div class="col-12"></div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="areaCleanliness">Done By</label>
                                <input type="text" class="form-control" name="areaCleanliness"
                                    id="areaCleanliness" value="{{ \Auth::user()->name }}"
                                    readonly>

                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="CareaCleanliness">Checked By</label>
                                {{ Form::select('CareaCleanliness',$usersworker,old("CareaCleanliness")?old("CareaCleanliness"):\Auth::user()->id,array('class'=>'form-control select',"placeholder"=>"Created by")) }}


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                <div class="form-group input_fields_wrap"
                    value="{{ isset($packingmateria->MaterialReceived) ? $packingmateria->MaterialReceived : '' }}"
                    id="MaterialReceived">
                    <label class="control-label d-flex">QC Sampling
                        <!-- <div class="input-group-btn">  -->
                        <!-- <button class="btn btn-dark add-more add_field_button waves-effect waves-light" type="button">Add More +</button> -->
                        <!-- </div> -->
                    </label>
                    <div class="row add-more-wrap after-add-more m-0 mb-4">
                        <!-- <span class="add-count">1</span> -->

                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="qcsampling" class="active">Regular QC Sampling
                                    (Kg.)</label>
                                <input type="text" class="form-control" name="qcsampling"
                                    value=""
                                    id="qcsampling" placeholder="" onchange="calculatesample()">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="StabilitySample" class="active">Stability Sample
                                    (Kg.)</label>
                                <input type="Number" class="form-control" name="StabilitySample"
                                    value=""
                                    id="StabilitySample" placeholder="" onchange="calculatesample()">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="WorkingSlandered" class="active">Working
                                    Slandered</label>
                                <input type="text" class="form-control" name="WorkingSlandered"
                                    value=""
                                    id="WorkingSlandered" placeholder="" onchange="calculatesample()">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="ValidationSample" class="active">Validation
                                    Sample</label>
                                <input type="text" class="form-control" name="ValidationSample"
                                    value=""
                                    id="ValidationSample" placeholder="" onchange="calculatesample()">
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                <div class="form-group input_fields_wrap" id="MaterialReceived">
                    <label class="control-label d-flex">Yield
                        <!-- <div class="input-group-btn">  -->
                        <!-- <button class="btn btn-dark add-more add_field_button waves-effect waves-light" type="button">Add More +</button> -->
                        <!-- </div> -->
                    </label>
                    <div class="row add-more-wrap after-add-more m-0 mb-4">
                        <!-- <span class="add-count">1</span> -->
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="rmInput" class="active">RM Input (Kg.)</label>
                                <input type="text" class="form-control" name="rmInput"
                                    id="rmInput" placeholder="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="fgOutput" class="active">FG Output</label>
                                <input type="text" class="form-control" name="fgOutput"
                                    id="fgOutput" placeholder="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="filledDrums" class="active">Filled in Drums
                                    (Kg)</label>
                                <input type="text" class="form-control" name="filledDrums"
                                    id="filledDrums" placeholder="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="excessFilledDrums" class="active">Excess filled
                                    in drums</label>
                                <input type="text" class="form-control" name="excessFilledDrums"
                                    id="excessFilledDrums" placeholder="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="qcsampling" class="active">QC Sampling
                                    (Kg.)</label>
                                <input type="text" class="form-control" name="totalsampling"
                                    id="totalsampling" placeholder="">
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="CustomerSample" class="active">Filled in Jerry
                                    can / Drum (Kg.) (Customer Sample)</label>
                                <input type="text" class="form-control" name="CustomerSample"
                                    id="CustomerSample" placeholder="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="ActualYield" class="active">Actual Yield
                                    [(Output/Input)*100]</label>
                                <input type="text" class="form-control" name="ActualYield"
                                    id="ActualYield" placeholder="98.00 / 102.00%">
                            </div>
                        </div>
                        {{-- <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="checkedBy">Checked By</label>
                                {{ Form::select('checkedBy',$usersworker,old("checkedBy")?old("checkedBy"):\Auth::user()->id,array('class'=>'form-control select',"placeholder"=>"Created by")) }}


                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="ApprovedBy">Approved By</label>
                                <input type="text" class="form-control" name="ApprovedBy"
                                    id="ApprovedBy" value="{{ \Auth::user()->name }}">
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="Remark" class="active">Note / Remark</label>
                    <textarea class="form-control" name="Remark" id="Remark"
                        placeholder="Note / Remark"></textarea>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <input type="hidden" name="batch_id" id="batch_id"
                        value="{{ isset($batchdetails->id) ? $batchdetails->id : old('batch_id') }}" />
                        <button type="submit"
                        class="btn btn-primary btn-md ml-0 form-btn waves-effect waves-light" name="submit" value="submit">Submit
                        & Next</button><button type="clear"
                        class="btn btn-light btn-md form-btn waves-effect waves-light" name="save_q" value="save_q">Save &
                        Quit</button>
                </div>
            </div>
        </div>
    </form>
</div>
@push("scripts")
<script>
    const calculatesample = () => {
        let  qcsampling = parseInt($("#qcsampling").val())  ? $("#qcsampling").val() : 0 ;
        let  StabilitySample = parseInt($("#StabilitySample").val())? $("#StabilitySample").val() : 0;
        let  WorkingSlandered =parseInt( $("#WorkingSlandered").val())  ? $("#WorkingSlandered").val() : 0;
        let  ValidationSample = parseInt($("#ValidationSample").val())  ? $("#ValidationSample").val() : 0;

        let total = 0;
        total = parseFloat(ValidationSample)+parseFloat(qcsampling)+parseFloat(StabilitySample)+parseFloat(WorkingSlandered);

        $("#totalsampling").val(total);
    }
</script>
@endpush
