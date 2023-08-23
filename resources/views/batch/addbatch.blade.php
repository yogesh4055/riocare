<div id="batch" class="tab-pane fade in active show">
    <form id="add_manufacturing" method="post" action="{{ route('add_manufacturing_insert') }}">
        @csrf
        <div class="form-row">
            <div class="col-12 col-md-4 col-lg-4 col-xl-4">
                <div class="form-group">
                    <label for="proName" class="active">Product Name</label>
                    <!-- <input type="text" class="form-control" name="proName" id="proName" placeholder="Product Name" value="Simethicone (Filix-110)"> -->
                    {{ Form::select('proName', $product, old('proName'), ['class' => 'form-control select', 'id' => 'proName', 'placeholder' => 'Choose Product Name']) }}

                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-8 col-xl-8">
                <div class="form-group">
                    <label for="bmrNo" class="active">BMR No.</label>
                    <div class="form-row">
                    <div class="col-12 col-md-5 col-lg-5 col-xl-5">
                        <input type="text" class="form-control" name="bmrNo" id="bmrNo"
                        placeholder="BMR No." pattern="\d*" maxlength="50" value="RCIPL/BMR/"
                        >    
                    </div>
                    <div class="col-12 col-md-5 col-lg-5 col-xl-5">
                        <select class="form-control" name="bmrNoo" id="bmrNoo">
                            <option value="2300">2300</option>
                            <option value="1100">1100</option>
                            <option value="1000">1000</option>
                            <option value="600">600</option>
                            <option value="500">500</option>
                            <option value="350">350</option>
                            <option value="200">200</option>
                            <option value="100">100</option>
                            <option value="50">50</option>
                            <option value="20">20</option>
                            <option value="-">-</option>
                        </select>    
                    </div>
                    <div class="col-12 col-md-2 col-lg-2 col-xl-2">
                        <input type="text" class="form-control" name="bmrVer" id="bmrVer" pattern="\d*" maxlength="50" value=""
                        >    
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="batchNo">Batch No.</label>
                    <input type="text" class="form-control" name="batchNo" id="batchNo"
                        placeholder="Batch No." pattern="\d*" maxlength="50"
                        >
                </div>
                @if ($errors->has('proName'))
                    <span class="text-danger">{{ $errors->first('proName') }}</span>
                @endif
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="refMfrNo">Ref. MFR No.</label>


                        <input type="text" class="form-control" name="refMfrNo" id="refMfrNo"
                            placeholder="Ref. MFR No." pattern="\d*" maxlength="50" value="RCIPL/MFR/">

                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="grade" class="active">Grade</label>
                    <select class="form-control" name="grade" id="grade">
                        <option value="">Select Grade</option>
                        @if(count($grades) > 0)
                            @foreach($grades as $grade)
                            <option value="{{$grade->grade}}">{{$grade->grade}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="BatchSize" class="active">Batch Size (Kg)</label>
                    <input type="text" class="form-control" name="BatchSize"
                        id="BatchSize" placeholder="Batch Size">
                    <!-- <select class="form-control" name="BatchSize" id="BatchSize">
                        <option value="">Select Batch Size</option>
                        <option value="1000 Kg">1000 Kg</option>
                        <option value="500 Kg">500 Kg</option>
                        <option value="200 Kg">200 Kg</option>
                        <option value="100 Kg">100 Kg</option>
                        <option value="50 Kg">50 Kg</option>
                    </select> -->
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="Viscosity" class="active">Viscosity</label>
                    <select class="form-control" name="Viscosity" id="Viscosity">
                        <option value="">Select Viscosity</option>
                        <option value="2000-2500 cSt">2000-2500 cSt</option>
                        <option value="1000-1300 cSt">1000-1300 cSt</option>
                        <option value="950-1050 cSt">950-1050 cSt</option>
                        <option value="500-700 cSt">500-700 cSt</option>
                        <option value="475-525 cSt">475-525 cSt</option>
                        <option value="332.5-367.5 cSt">332.5-367.5 cSt</option>
                        <option value="190-220 cSt">190-220 cSt</option>
                        <option value="95-105 cSt">95-105 cSt</option>
                        <option value="47.5-52.5 cSt">47.5-52.5 cSt</option>
                        <option value="18-22 cSt">18-22 cSt</option>
                        <option value="-">-</option>
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-6"> &nbsp; </div>

            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="ProductionCommencedon" class="active">Production Commenced
                        on</label>
                    <input type="date" class="form-control" name="ProductionCommencedon"
                        id="ProductionCommencedon" value="{{ date('Y-m-d') }}">
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="ProductionCompletedon" class="active">Production Completed
                        on</label>
                    <input type="date" class="form-control" name="ProductionCompletedon"
                        id="ProductionCompletedon" placeholder="" value="{{ date('Y-m-d') }}">
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="ManufacturingDate" class="active">Manufacturing Date</label>
                    <input type="date" class="form-control" name="ManufacturingDate"
                        id="ManufacturingDate" placeholder="" value="{{ date('Y-m-d') }}">
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="RetestDate" class="active">Retest Date</label>
                    <input type="date" class="form-control" name="RetestDate" id="RetestDate"
                        placeholder="" value="{{ date('Y-m-d') }}">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="doneBy">Prepared by</label>
                    {{ Form::select('doneBy',$usersofficerpod,old("doneBy")?old("doneBy"):\Auth::user()->id,array('class'=>'form-control select',"placeholder"=>"Prepared by","id"=>"doneBy")) }}


                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="checkedBy">Checked by</label>
                    {{ Form::select('checkedBy',$usersofficerpodman,old("checkedBy")?old("checkedBy"):\Auth::user()->id,array('class'=>'form-control select',"placeholder"=>"Created by")) }}



                </div>
            </div>


            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="checkedByI">Reviewed and Approved by</label>
                    {{ Form::select('checkedByI',$usersofficerqc,old("checkedByI")?old("checkedByI"):\Auth::user()->id,array('class'=>'form-control select',"placeholder"=>"Reviewed and Approved by","id"=>"checkedByI")) }}


                </div>
            </div>
           {{--  <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="approval" class="active">This Batch is approved/not
                        approved</label>
                    <select class="form-control select" name="approval" id="approval">
                        <option>-- Select Option --</option>
                        <option value="Approved">Approved</option>
                        <option value="Not Approved">Not Approved</option>
                    </select>
                </div>
            </div>--}}
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="Remark" class="active">Note / Remark</label>
                    <textarea class="form-control" name="Remark" id="Remark"
                        placeholder="Note / Remark"></textarea>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
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
