<div id="billOfRawMaterialpacking" class="tab-pane fade">
    <form id="add_batch_manufacturing_bill" method="post"
        action="{{ route('add_batch_manufacturing_recorde_insert_packing') }}">
        @csrf
        <div class="form-row">
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="proName" class="active">Product Name</label>
                    <select name="proName" id="proName" readonly class="form-control select">
                        <option value="{{ $proId }}" class="form-control"
                            selected="selected">{{ $proName }}</option>
                    </select>
                    @if ($errors->has('proName'))
                        <span class="text-danger">{{ $errors->first('proName') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="bmrNo" class="active">BMR No.</label>
                    <input type="text" class="form-control" name="bmrNo" id="bmrNo"
                        placeholder="BMR No." pattern="\d*" maxlength="12"
                        onkeypress=""
                        value="{{ isset($batchdetails->bmrNo) ? $batchdetails->bmrNo : old('bmrNo') }}"
                        readonly>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="batchNoI">Batch No.</label>
                    <input type="text" class="form-control" name="batchNoI" id="batchNoI"
                        placeholder="Batch No." pattern="\d*" maxlength="12"
                        onkeypress=""
                        value="{{ isset($batchdetails->batchNo) ? $batchdetails->batchNo : old('batchNoI') }}"
                        readonly>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="refMfrNo">Ref. MFR No.</label>
                    <input type="text" class="form-control" name="refMfrNo" id="refMfrNo"
                        placeholder="Ref. MFR No." pattern="\d*" maxlength="12"
                        onkeypress=""
                        value="{{ isset($batchdetails->refMfrNo) ? $batchdetails->refMfrNo : old('refMfrNo') }}"
                        readonly>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                <div class="form-group input_fields_wrap" id="MaterialReceived">
                    <label class="control-label d-flex">Bill of Raw Material Details and Weighing
                        Record
                    </label>
                    @if (isset($packing_material_bills))
                        @foreach ($packing_material_bills as $index => $rd)
                            <div class="row add-more-wrap after-add-more m-0 mb-4">
                                @php $pm = [$rd->material_id => $packingmaterials[$rd->material_id]];
                                @endphp
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="PackingMaterialName[]"
                                            class="active">Packing Material</label>
                                        {{ Form::select('PackingMaterialName[]', $pm, old(), ['class' => 'form-control select', 'id' => 'material_name[]']) }}
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="batchNo" class="active">Batch
                                            No.</label>
                                        <input type="text" class="form-control" name="batchNo[]"
                                            id="batchNo" placeholder="Batch No."
                                            value="{{ isset($rd->batch_id) ? $rd->batch_id : old('batchNo[]') }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="Quantity" class="active">Quantity
                                            (Kg.)</label>
                                        <input type="number" class="form-control"
                                            value="{{ isset($rd->requesist_qty) ? $rd->requesist_qty : old('Quantity[]') }}"
                                            readonly name="Quantity[]" id="Quantity" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="arNo" class="active">AR No.</label>
                                        <input type="text" class="form-control" name="arNo[]"
                                            id="arNo" placeholder=""
                                            value="{{ isset($rd->ar_no_date) ? $rd->ar_no_date : old('arNo[]') }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="date" class="active">Date</label>
                                        <input type="date" class="form-control calendar"
                                            name="date[]" id="date" value="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="doneBy">Weighed by</label>
                    <input type="text" class="form-control select" name="doneBy"
                        value="{{ \Auth::user()->name }}" id="doneBy" readonly>

                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="checkedBy">Checked by</label>
                    <input type="text" class="form-control select" name="checkedBy" id="checkedBy"
                        value="{{ \Auth::user()->name }}" readonly>
                </div>
            </div>
            <div class="col-12 col-md-6">
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
                    <input type="hidden" name="currentForm" value="#billOfRawMaterialpacking">
                    <input type="hidden" name="nextForm" value="#listOfEquipment">
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
