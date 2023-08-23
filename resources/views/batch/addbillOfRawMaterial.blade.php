<div id="billOfRawMaterial" class="tab-pane fade">
    <form id="add_batch_manufacturing_bill" method="post"
        action="{{ route('add_batch_manufacturing_recorde_insert') }}">
        @csrf
        <div class="form-row">
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="proName" class="active">Product Name</label>

                    <select name="proName" id="proName" readonly class="form-control select">
                        <option value="{{ $proId }}" class="form-control"
                            selected="selected">
                            {{ $proName }}
                        </option>
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
                        Record</label>
                    @if (isset($raw_material_bills))

                        @foreach ($raw_material_bills as $mat)

                            @foreach ($mat as $index => $rd)

                                <div class="row add-more-wrap after-add-more m-0 mb-4">
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            @php $rw = [$rd->material_id => $rawmaterials[$rd->material_id]];
                                            @endphp
                                            <label for="rawMaterialName" class="active">Raw
                                                Material</label>
                                            {{ Form::select('rawMaterialName[]', $rw, old(), ['class' => 'form-control', 'readonly']) }}
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="Quantity" class="active">Quantity
                                                (Kg.)</label>
                                            <input type="number" class="form-control"
                                                name="Quantity[]" id="Quantity" placeholder=""
                                                onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'') value="
                                                {{ isset($rd->requesist_qty) ? $rd->requesist_qty : 'Quantity[]' }}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="arNo" class="active">AR No.</label>
                                            <input type="text" class="form-control" name="arNo[]"
                                                id="arNo" placeholder=""
                                                value="{{ isset($rd->ar_no_date) ? $rd->ar_no_date : old('arNo[]') }}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="date" class="active">Date</label>
                                            <input type="date" class="form-control calendar"
                                                name="date[]" id="date"
                                                value="{{ date('Y-m-d') }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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
                    <input type="hidden" name="currentForm" value="#billOfRawMaterial">
                    <input type="hidden" name="nextForm" value="#requisitionpacking">
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
