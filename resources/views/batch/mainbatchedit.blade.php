<div id="batch" class="tab-pane fade {{ $sequenceId == '1' ? 'in active show' : '' }}">
    <form id="add_manufacturing" method="post" action="{{ route('add_manufacturing_update') }}">
        <input type="hidden" value="1" name="sequenceId">
        <input type="hidden" value="{{ $edit_batchmanufacturing->id }}" name="id">
        @csrf

        <div class="form-row">
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="proName" class="active">Product Name</label>
                    {{ Form::select('proName', $product, old('proName') ? old('proName') : $edit_batchmanufacturing->proName, ['class' => 'form-control select', 'id' => 'material_name']) }}
                    @if ($errors->has('proName'))
                        <span class="text-danger">{{ $errors->first('proName') }}</span>
                    @endif
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="bmrNo" class="active">BMR No.</label>

                        <input type="text" class="form-control" name="bmrNo"
                        value="{{ $edit_batchmanufacturing->bmrNo?$edit_batchmanufacturing->bmrNo:"RCIPL/BMR/" }}" id="bmrNo" pattern="\d*"
                        maxlength="120" onkeypress="">

                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">

                <div class="form-group">
                    <label for="batchNo">Batch No.</label>

                        <input type="text" class="form-control" name="batchNo"
                        value="{{ $edit_batchmanufacturing->batchNo }}" id="batchNo" pattern="\d*"
                        maxlength="120" onkeypress="">



                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="refMfrNo">Ref. MFR No.</label>

                    <input type="text" class="form-control" name="refMfrNo"
                        value="{{ $edit_batchmanufacturing->refMfrNo?$edit_batchmanufacturing->refMfrNo:"RCIPL/MFR/" }}" id="refMfrNo"
                        pattern="\d*" maxlength="120"
                        onkeypress="">


                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="grade" class="active">Grade</label>
                    <select class="form-control" name="grade" id="grade">
                        <option value="">Select Grade</option>
                        @if(count($grades) > 0)
                            @foreach($grades as $grade)
                            <option value="{{$grade->grade}}" <?php if($edit_batchmanufacturing->grade == $grade->grade) echo "selected";?>>{{$grade->grade}}</option>
                            @endforeach
                        @endif
                    </select>

                    <!-- <input type="text" class="form-control" name="grade"
                        value="{{ $edit_batchmanufacturing->grade }}" id="grade" placeholder=""
                        pattern="\d*" maxlength="120"
                        onkeypress=""> -->
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="BatchSize" class="active">Batch Size (kg)</label>
                    <!-- <select class="form-control" name="BatchSize" id="BatchSize">
                        <option value="">Select Batch Size</option>
                        <option value="1000 Kg" <?php if($edit_batchmanufacturing->BatchSize=='1000') echo"selected";?>>1000 Kg</option>
                        <option value="500 Kg" <?php if($edit_batchmanufacturing->BatchSize=='500') echo"selected";?>>500 Kg</option>
                        <option value="200 Kg" <?php if($edit_batchmanufacturing->BatchSize=='200') echo"selected";?>>200 Kg</option>
                        <option value="100 Kg" <?php if($edit_batchmanufacturing->BatchSize=='100') echo"selected";?>>100 Kg</option>
                        <option value="50 Kg" <?php if($edit_batchmanufacturing->BatchSize=='50') echo"selected";?>>50 Kg</option>
                    </select> -->
                    <input type="text" class="form-control" name="BatchSize"
                        value="{{ number_format($edit_batchmanufacturing->BatchSize,3,".","") }}" id="BatchSize"
                        placeholder="" pattern="\d*" maxlength="120"
                        onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="Viscosity" class="active">Viscosity</label>
                    <select class="form-control" name="Viscosity" id="Viscosity">
                        <option value="">Select Viscosity</option>
                        <option value="2000-2500 cSt" <?php if($edit_batchmanufacturing->Viscosity=='2000-2500 cSt') echo"selected";?>>2000-2500 cSt</option>
                        <option value="1000-1300 cSt" <?php if($edit_batchmanufacturing->Viscosity=='1000-1300 cSt') echo"selected";?>>1000-1300 cSt</option>
                        <option value="950-1050 cSt" <?php if($edit_batchmanufacturing->Viscosity=='950-1050 cSt') echo"selected";?>>950-1050 cSt</option>
                        <option value="500-700 cSt" <?php if($edit_batchmanufacturing->Viscosity=='500-700 cSt') echo"selected";?>>500-700 cSt</option>
                        <option value="475-525 cSt" <?php if($edit_batchmanufacturing->Viscosity=='475-525 cSt') echo"selected";?>>475-525 cSt</option>
                        <option value="332.5-367.5 cSt" <?php if($edit_batchmanufacturing->Viscosity=='332.5-367.5 cSt') echo"selected";?>>332.5-367.5 cSt</option>
                        <option value="190-220 cSt" <?php if($edit_batchmanufacturing->Viscosity=='190-220 cSt') echo"selected";?>>190-220 cSt</option>
                        <option value="95-105 cSt" <?php if($edit_batchmanufacturing->Viscosity=='95-105 cSt') echo"selected";?>>95-105 cSt</option>
                        <option value="47.5-52.5 cSt" <?php if($edit_batchmanufacturing->Viscosity=='47.5-52.5 cSt') echo"selected";?>>47.5-52.5 cSt</option>
                        <option value="18-22 cSt" <?php if($edit_batchmanufacturing->Viscosity=='18-22 cSt') echo"selected";?>>18-22 cSt</option>
                        <option value="-" <?php if($edit_batchmanufacturing->Viscosity=='-') echo"selected";?>>-</option>
                    </select>
                    <!-- <input type="text" class="form-control" name="Viscosity"
                        value="{{ $edit_batchmanufacturing->Viscosity }}" id="Viscosity"
                        placeholder="" value="2000-2500 cSt" pattern="\d*" maxlength="120"
                        onkeypress=""> -->
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="ProductionCommencedon" class="active">Production
                            Commenced on</label>
                        <input type="date" class="form-control" name="ProductionCommencedon"
                            value="{{ $edit_batchmanufacturing->ProductionCommencedon }}"
                            id="ProductionCommencedon" placeholder="">
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="ProductionCompletedon" class="active">Production
                            Completed on</label>
                        <input type="date" class="form-control" name="ProductionCompletedon"
                            value="{{ $edit_batchmanufacturing->ProductionCompletedon }}"
                            id="ProductionCompletedon" placeholder="" value="">
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="ManufacturingDate" class="active">Manufacturing
                            Date</label>
                        <input type="date" class="form-control" name="ManufacturingDate"
                            value="{{ $edit_batchmanufacturing->ManufacturingDate }}"
                            id="ManufacturingDate" placeholder="">
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="RetestDate" class="active">Retest Date</label>
                        <input type="date" class="form-control" name="RetestDate"
                            value="{{ $edit_batchmanufacturing->RetestDate }}" id="RetestDate"
                            placeholder="" value="">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="doneBy">Prepared by</label>
                        {{ Form::select('doneBy',$usersofficerpod,old("doneBy")?old("doneBy"):$edit_batchmanufacturing->doneBy,array('class'=>'form-control select',"placeholder"=>"Prepared by","id"=>"doneBy")) }}

                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="checkedBy">Checked by</label>

                        {{ Form::select('checkedBy',$usersofficerpodman,old("checkedBy")?old("checkedBy"):$edit_batchmanufacturing->checkedBy,array('class'=>'form-control select',"placeholder"=>"Checked by","id"=>"checkedBy")) }}


                    </div>
                </div>


                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="checkedByI">Reviewed and Approved by</label> 
                        {{ Form::select('checkedByI',$usersofficerqc,old("checkedByI")?old("checkedByI"):$edit_batchmanufacturing->checkedByI,array('class'=>'form-control select',"placeholder"=>"Reviewed and Approved by","id"=>"checkedByI")) }}


                    </div>
                </div>


                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="Remark" class="active">Note / Remark</label>
                        <textarea class="form-control" name="Remark" id="Remark"
                            value="{{ $edit_batchmanufacturing->Remark }}"
                            placeholder="Note / Remark">{{ $edit_batchmanufacturing->Remark }}</textarea>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 col-xl-6" style="margin-top: -53px;">
                    <div class="form-group">
                        <label for="approval" class="active">Deviation sheet attached</label>
                        <select class="form-control select" name="approval" id="approval">
                            <option value="1" @if ($edit_batchmanufacturing->approval == 1) selected='selected' @endif>Yes</option>
                            <option value="0" @if ($edit_batchmanufacturing->approval != 1) selected='selected' @endif>No</option>
                        </select>
                    </div>
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
                        @else--}}
                        @if(!$edit_batchmanufacturing->is_aproved)
                            <button type="submit"
                        class="btn btn-light btn-md form-btn waves-effect waves-light save_app" name="save_app" value="save_app">Approved & Submit</button>
                        @endif
                </div>
            </div>
        </div>
    </form>
</div>
@push('scripts')
<script>
$(".save_app").click(function(event) {
    if(!confirm("Do you really want to approve this batch? After approval can't edit")) {
        return false;
    }
   else
   {


        return true;
   }
})
</script>
@endpush
