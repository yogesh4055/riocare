@if (isset($res_data))
<div id="billOfRawMaterial" class="tab-pane fade {{ $sequenceId == '4' ? 'in active show' : '' }}">

    <form id="add_batch_manufacturing_bill" method="post"
        action="{{ route('bill_of_raw_material_update') }}">
        <input type="hidden" value="4" name="sequenceId">

        <input type="hidden" value="{{ isset($res_data->id) ? $res_data->id : 0 }}" name="id">
        @csrf

        <div class="form-row">

            <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                <div class="form-group input_fields_wrap" id="MaterialReceived">
                    <label class="control-label d-flex">Bill of Raw Material Details and Weighing
                        Record
                        <div class="input-group-btn">
                            <button
                                class="btn btn-dark add-more add_field_button waves-effect waves-light"
                                type="button">Add More +</button>
                        </div>
                    </label>
                    @if (isset($res))
                        @foreach ($res as $temp)
                            <div class="row add-more-wrap after-add-more m-0 mb-4">
                                <!-- <span class="add-count">1</span> -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="rawMaterialName" class="active">Raw
                                            Material</label>
                                        <select class="form-control select"
                                            name="rawMaterialName[]" id="rawMaterialName">
                                            <option>Select</option>
                                            <option value="Material name" selected>Material Name
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="Quantity" class="active">Quantity
                                            (Kg.)</label>
                                        <input type="number" class="form-control"
                                            name="Quantity[]" id="Quantity"
                                            value="{{ $temp->Quantity }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="arNo" class="active">AR No.</label>
                                        <input type="text" class="form-control" name="arNo[]"
                                            id="arNo" value="{{ $temp->arNo }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="date" class="active">Date</label>
                                        <input type="date" class="form-control calendar"
                                            name="date[]" id="date" value="{{ $temp->date }}">
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
                        placeholder="Note / Remark">{{ $res_data->Remark }}</textarea>
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
@endif
