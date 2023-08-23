<div id="requisition" class="tab-pane fade">
    <form id="material_requisition_slip" method="post"
        action="{{ route('packing_material_requisition_slip_insert') }}">
        @csrf
        <input type="hidden" value="issualofrequisition" name="nextForm">
        <input type="hidden" class="form-control" name="batchNo" id="batchNo"
                        placeholder="Batch No."
                        value="{{ isset($batchdetails->batchNo) ? $batchdetails->batchNo : old('batchNo') }}"
                        readonly>
        <div class="form-row">
         <div class="row add-more-wrap after-add-more m-0 mb-4 col-12">
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="from" class="active">From</label>
                    <select name="from" id="from" class="form-control select" readonly>
                        @if (count($department))
                            @foreach ($department as $temp)
                                @if ($temp->id == 2)
                                    <option value="{{ $temp->id }}">{{ $temp->department }}
                                    </option>
                                @endif
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="to" class="active">To</label>
                    <select name="to" id="to" class="form-control select" readonly>
                        @if (count($department))
                            @foreach ($department as $temp)
                                @if ($temp->id == 3)
                                    <option value="{{ $temp->id }}">{{ $temp->department }}
                                    </option>
                                @endif
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>


            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="Date" class="active">Date</label>
                    <input type="date" class="form-control calendar" name="Date" id="Date"
                        value="{{ date('Y-m-d') }}">
                </div>
            </div>
         </div>

            <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                <div class="form-group input_fields_wrap_6" id="MaterialReceived">
                    <label class="control-label d-flex">Material Detail
                        <div class="input-group-btn text-right">
                            <button
                                class="btn btn-dark add-more add_field_button_6 waves-effect waves-light"
                                type="button">Add More +</button>
                        </div>
                    </label>
                    <div class="row add-more-wrap after-add-more m-0 mb-4">
                        <span class="add-count">1</span>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="rawMaterialName" class="active">Raw Material
                                    Name</label>
                                {{ Form::select('rawMaterialName[]', $rawmaterials, old('rawMaterialName'), ['id' => 'rawMaterialName', 'class' => 'form-control', 'placeholder' => 'Raw Material Name']) }}

                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="Quantity" class="active">Quantity (Kg.)</label>
                                <input type="number" class="form-control" name="Quantity[]"
                                    id="Quantity1" placeholder="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="checkedBy">Created By</label>
                    {{ Form::select('checkedBy',$usersworker,old("checkedBy")?old("checkedBy"):\Auth::user()->id,array('class'=>'form-control select',"placeholder"=>"Created by","id"=>"checkedBy")) }}


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

<div id="issualofrequisition" class="tab-pane fade">
    @if (isset($requestion))
        <table class="table table-hover table-bordered datatable" id="examplereq">
            <thead>
                <tr>
                    <th>Requestion No</th>
                    <th>Batch No</th>
                    <th>Date</th>
                    <th>Requestion Raw Material Name</th>
                    <th>Requestion Raw Material Qty</th>
                    <th>Issued Raw Material Qty</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @if ($requestion)
                    @foreach ($requestion as $req)
                        @php $requestion_details = \App\Models\DetailsRequisition::select('detail_packing_material_requisition.*', 'raw_materials.material_name')
                                ->where('requisition_id', $req->id)
                                ->join('raw_materials', 'raw_materials.id', 'detail_packing_material_requisition.PackingMaterialName')
                                ->orderBy('id', 'desc')
                                ->get();
                        @endphp
                        @if (isset($requestion_details) && $requestion_details)
                            @foreach ($requestion_details as $temp)
                                <tr>
                                    <td>{{ $req->id }}</td>
                                    <td>{{ $req->batchNo }}</td>
                                    <td>{{ $req->created_at ? date('d/m/Y', strtotime($req->created_at)) : '' }}
                                    </td>
                                    <td>{{ $temp->material_name }}</td>
                                    <td>{{ $temp->Quantity }}</td>
                                    <td>{{ $temp->approved_qty }}</td>
                                    <td>{!! $temp->approved_qty >= $temp->Quantity ? '<span class="badge badge-success p-2">Approved</span>' : '<span class="badge badge-warning p-2">Pending</span>' !!}</td>
                                </tr>
                            @endforeach
                        @endif
                    @endforeach
                @endif
            </tbody>
        </table>
    @endif
</div>
