<div id="mixing" class="tab-pane fade {{ $sequenceId == '11' ? 'in active show' : '' }}">
    @php $doneBy = [\Auth::user()->id => \Auth::user()->name];
    @endphp
    
    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
        <form method="post" action="{{ route('add_mixing_update') }}" id="add_mixing_process" name="add_mixing_process" onsubmit="return confirm('Do you really want to submit the form?');">
            <input type="hidden" value="{{ isset($edit_batchmanufacturing->id) ? $edit_batchmanufacturing->id : '' }}" name="mainid">
            @csrf
            <input type="hidden" value="10" name="sequenceId">
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="m_date" class="active">Date</label>
                    <div class="datepicker date input-group">
                        <input type="text" placeholder="Choose Date" class="form-control" id="m_date" name="m_date" value="{{ isset($mixing->date) ? date('d-m-Y', strtotime($mixing->date)): date('d-m-Y') }}">
                        <div class="input-group-append">
                          <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                      </div>
                </div>
            </div>
            <div class="form-row">
                <table class="table table-bordered" cellpadding="0" cellspacing="0" border="0">
                    <thead>
                        <tr>
                            <th rowspan="2">Process</th>
                            <th rowspan="2">Qty. (Ltr.)</th>
                            <th rowspan="2">Start Time (Hrs)</th>
                            <th rowspan="2">End Time (Hrs)</th>
                            <th rowspan="2">Done by</th>
                            <th rowspan="2">Cheked by</th>
                        </tr>
                       
                    </thead>
                    <tbody>           
                        <tr>
                            <td> Adds Hydrogen Peroxide and stirs for 30 minutes </td>
                            <td><input type="text" value="{{isset($mixing) ? $mixing->qty_kg : ''}}" name="qty_kg" id="qty_kg" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="7"></td>
                            <td><input type="text" value="{{isset($mixing) ? $mixing->start_time : ''}}" name="startTime" id="startTime"class="form-control timepicker" maxlength="4" data-mask="00:00"></td>
                            <td><input type="text" value="{{isset($mixing) ? $mixing->end_time : ''}}" name="endTime" id="endTime" class="form-control timepicker" maxlength="4" data-mask="00:00"></td>
                            
                            <td>{{ Form::select('doneBy', $usersworker, old('doneBy')?old('doneBy'):(isset($mixing->done_by)?$mixing->done_by:Auth::user()->id), ['id' => 'doneBy', 'class' => 'form-control select', "placeholder"=>"Select Option"]) }}</td>
                            <td>{{ Form::select('checkedBy', $checkedBy, old('checkedBy')?old('checkedBy'):(isset($mixing->checked_by)?$mixing->checked_by:Auth::user()->id), ['id' => 'checkedBy', 'class' => 'form-control select', "placeholder"=>"Select Option"]) }}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-bordered" cellpadding="0" cellspacing="0" border="0">
                    <thead>
                        <tr>
                            <th>Process</th>
                            <th>Qty. (Ltr.)</th>
                            <th>Final pH</th>
                            <th>Done by</th>
                            <th rowspan="2">Cheked by</th>
                        </tr>
                    </thead>
                    <tbody>           
                        <tr>
                            <td> For correcting pH (Quantity : <input type="text" value="{{isset($mixing) ? $mixing->process_qty : ''}}" name="process_qty" id="process_qty" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" <pre> kg.) O-Phosporic acid is added to achieve the desired pH. </pre></td>
                            <td><input type="text" value="{{isset($mixing) ? $mixing->qty_ltr : ''}}" name="qty_ltr" id="qty_ltr" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="7"></td>
                            <td><input type="text" value="{{isset($mixing) ? $mixing->final_pH : ''}}" name="finalpH" id="finalpH" class="form-control"></td>
                            <td>{{ Form::select('doneBy1', $usersworker, old('doneBy1')?old('doneBy1'):(isset($mixing->done_by_1)?$mixing->done_by_1:Auth::user()->id), ['id' => 'doneBy1', 'class' => 'form-control select', "placeholder"=>"Select Option"]) }}</td>
                            <td>{{ Form::select('checkedBy1', $checkedBy, old('checkedBy1')?old('checkedBy1'):(isset($mixing->checked_by_1)?$mixing->checked_by_1:Auth::user()->id), ['id' => 'checkedBy1', 'class' => 'form-control select', "placeholder"=>"Select Option"]) }}</td>
                        </tr>
                    </tbody>
                </table>

                <button type="submit" class="btn btn-primary btn-md ml-0 form-btn waves-effect waves-light" name="submit" value="submit">Submit </button>
            </div>
        </form>
    </div>

</div>

