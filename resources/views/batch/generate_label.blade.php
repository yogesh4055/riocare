
<div id="generate_label" class="tab-pane fade {{ $sequenceId == '13' ? 'in active show' : '' }}">
    <form id="add_manufacturing_generate_label" method="post"
        action="{{ route('add_manufacturing_generate_update') }}">
        <input type="hidden" value="13" name="sequenceId">
        <input type="hidden" value="{{ isset($edit_ganerat_lable->id) ? $edit_ganerat_lable->id : '' }}"
            name="id">
        <input type="hidden"
            value="{{ isset($edit_batchmanufacturing->id) ? $edit_batchmanufacturing->id : '' }}"
            name="batch_id">
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

            <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="form-group">
                        <label for="mfg_date" class="active">MFG Date</label>
                        <input type="date" class="form-control" name="mfg_date" id="mfg_date"
                            value="{{ isset($edit_ganerat_lable->mfg_date) ? $edit_ganerat_lable->mfg_date : $edit_batchmanufacturing->ManufacturingDate }}"
                            placeholder="">
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <div class="form-group">
                        <label for="retest_date" class="active">Retest Date</label>
                        <input type="date" class="form-control" name="retest_date"
                            id="retest_date"
                            value="{{ isset($edit_ganerat_lable->retest_date) ? $edit_ganerat_lable->retest_date : $edit_batchmanufacturing->RetestDate }}"
                            placeholder="">
                    </div>
                </div>
                </div>

                <div class="form-group input_fields_wrap" id="MaterialReceived">
                    <label class="control-label d-flex">Product Label 200 Kg Drums

                    </label>
                    <div class="row add-more-wrap after-add-more m-0 mb-4">
                        <!-- <span class="add-count">1</span> -->



                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="net_wt" class="active">Net Wt</label>
                                <input type="text" class="form-control" name="net_wt_200" id="net_wt_200"
                                    value="{{ (isset($edit_ganerat_lable->net_wt_200) && $edit_ganerat_lable->net_wt_200 >0) ? number_format($edit_ganerat_lable->net_wt_200,3,".","") : old("net_wt_200") }}"
                                    placeholder="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="tare_wt" class="active">Tare Wt</label>
                                <input type="text" class="form-control" name="tare_wt_200"
                                    value="{{ (isset($edit_ganerat_lable->tare_wt_200) && $edit_ganerat_lable->tare_wt_200 >0) ? number_format($edit_ganerat_lable->tare_wt_200,3,".","") : old("tare_wt_200") }}"
                                    id="tare_wt" placeholder="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group input_fields_wrap" id="MaterialReceived">
                    <label class="control-label d-flex">Product Label 50 Kg Drums

                    </label>
                    <div class="row add-more-wrap after-add-more m-0 mb-4">
                        <!-- <span class="add-count">1</span> -->



                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="net_wt" class="active">Net Wt</label>
                                <input type="text" class="form-control" name="net_wt" id="net_wt"
                                    value="{{ (isset($edit_ganerat_lable->net_wt_50) && $edit_ganerat_lable->net_wt_50 >0) ? number_format($edit_ganerat_lable->net_wt_50,3,".","") : old("net_wt") }}"
                                    placeholder="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="tare_wt" class="active">Tare Wt</label>
                                <input type="text" class="form-control" name="tare_wt"
                                    value="{{ (isset($edit_ganerat_lable->tare_wt_50) && $edit_ganerat_lable->tare_wt_50 >0) ? number_format($edit_ganerat_lable->tare_wt_50,3,".","") : old("tare_wt") }}"
                                    id="tare_wt" placeholder="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group input_fields_wrap" id="MaterialReceived">
                    <label class="control-label d-flex">Product Label 30 Kg Drums

                    </label>
                    <div class="row add-more-wrap after-add-more m-0 mb-4">
                        <!-- <span class="add-count">1</span> -->



                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="net_wt" class="active">Net Wt</label>
                                <input type="text" class="form-control" name="net_wt_30" id="net_wt_30"
                                    value="{{ (isset($edit_ganerat_lable->net_wt_30) && $edit_ganerat_lable->net_wt_30 >0) ? number_format($edit_ganerat_lable->net_wt_30,3,".","") : old("net_wt_30") }}"
                                    placeholder="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="tare_wt" class="active">Tare Wt</label>
                                <input type="text" class="form-control" name="tare_wt_30"
                                    value="{{ (isset($edit_ganerat_lable->tare_wt_30) && $edit_ganerat_lable->tare_wt_30 >0) ? number_format($edit_ganerat_lable->tare_wt_30,3,".","") : old("tare_wt_30") }}"
                                    id="tare_wt_30" placeholder="">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group input_fields_wrap" id="MaterialReceived">
                    <label class="control-label d-flex">Product Label 25 Kg Drums

                    </label>
                    <div class="row add-more-wrap after-add-more m-0 mb-4">
                        <!-- <span class="add-count">1</span> -->



                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="net_wt" class="active">Net Wt</label>
                                <input type="text" class="form-control" name="net_wt_5" id="net_wt_5"
                                    value="{{ isset($edit_ganerat_lable->net_wt_5) ? number_format($edit_ganerat_lable->net_wt_5,3,".","") : old("net_wt_5") }}"
                                    placeholder="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="tare_wt" class="active">Tare Wt</label>
                                <input type="text" class="form-control" name="tare_wt_5"
                                    value="{{ isset($edit_ganerat_lable->tare_wt_5) ? number_format($edit_ganerat_lable->tare_wt_5,3,".","") : old("tare_wt_5") }}"
                                    id="tare_wt_5" placeholder="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group input_fields_wrap" id="MaterialReceived">
                    <label class="control-label d-flex">Product Label 25 Kg Bags</label>
                    <div class="row add-more-wrap after-add-more m-0 mb-4">
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="net_wt" class="active">Net Wt</label>
                                <input type="text" class="form-control" name="net_wtb_25" id="net_wtb_25"
                                    value="{{ isset($edit_ganerat_lable->net_wtb_25) ? number_format($edit_ganerat_lable->net_wtb_25,3,".","") : old("net_wtb_25") }}"
                                    placeholder="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="tare_wt" class="active">Tare Wt</label>
                                <input type="text" class="form-control" name="tare_wtb_25"
                                    value="{{ isset($edit_ganerat_lable->tare_wtb_25) ? number_format($edit_ganerat_lable->tare_wtb_25,3,".","") : old("tare_wtb_25") }}"
                                    id="tare_wtb_25" placeholder="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group input_fields_wrap" id="MaterialReceived">
                    <label class="control-label d-flex">Product Label 50 Kg Bags</label>
                    <div class="row add-more-wrap after-add-more m-0 mb-4">
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="net_wt" class="active">Net Wt</label>
                                <input type="text" class="form-control" name="net_wtb_50" id="net_wtb_50"
                                    value="{{ isset($edit_ganerat_lable->net_wtb_50) ? number_format($edit_ganerat_lable->net_wtb_50,3,".","") : old("net_wtb_50") }}"
                                    placeholder="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="tare_wt" class="active">Tare Wt</label>
                                <input type="text" class="form-control" name="tare_wtb_50"
                                    value="{{ isset($edit_ganerat_lable->tare_wtb_50) ? number_format($edit_ganerat_lable->tare_wtb_50,3,".","") : old("tare_wtb_50") }}"
                                    id="tare_wtb_50" placeholder="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="form-group">
                    <label for="Remark" class="active">Note / Remark</label>
                    <textarea class="form-control" name="Remark" id="Remark"
                        placeholder="Note / Remark"> {{ isset($edit_ganerat_lable->Remark) ? $edit_ganerat_lable->Remark : '' }}</textarea>
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
</div>
