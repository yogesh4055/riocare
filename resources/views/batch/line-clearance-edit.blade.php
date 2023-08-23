@php $i=1; @endphp
<div id="Line-Clearance" class="tab-pane {{ in_array($sequenceId,array(7)) ? 'in active show' : '' }} fade">
    <form id="add_manufacturing_line" method="post" action="{{ route('line_clearance_update') }}">
        <input type="hidden" value="6" name="sequenceId">
        <input type="hidden"
            value="{{ isset($edit_batchmanufacturing->id) ? $edit_batchmanufacturing->id : '' }}"
            name="id">

        <input type="hidden" class="form-control" name="batchNo" id="batchNo"
            placeholder="Batch No."
            value="{{ isset($edit_batchmanufacturing->id) ? $edit_batchmanufacturing->id : old('batchNo') }}"
            readonly>

        <input type="hidden" class="form-control" name="clearance_id" id="clearance_id"
            placeholder="Batch No."
            value="{{ isset($lineclearace->id) ? $lineclearace->id : old('clearance_id') }}"
            readonly>

        <input type="hidden" class="form-control" name="proName" id="proName"
            placeholder="proName"
            value="{{ isset($edit_batchmanufacturing->batchNo) ? $edit_batchmanufacturing->batchNo : old('batchNo') }}"
            readonly>
        @csrf
        <div class="form-row">

            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="Date">Date </label>
                    <input type="date" class="form-control" name="Date"  id="Date" placeholder="" value="{{ isset($lineclearace->Date)?$lineclearace->Date:date('Y-m-d') }}">
                </div>
            </div>

            <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                <div class="form-group input_fields_wrap-line" id="MaterialReceived">
                    <label class="control-label d-flex">Line Clearance Record
                        <div class="input-group-btn">
                            <button class="btn btn-dark add-more add_field_button_line waves-effect waves-light" id="add_field_button_line" type="button">Add More +</button>
                        </div>
                    </label>


                    @if(isset($lineclearace_details) && $lineclearace_details)

                        @foreach($lineclearace_details as $val)

                        <div class="row add-more-wrap after-add-more m-0 mb-4" id="add-more-wrap-line">
                            <span class="add-count">{{ $i }}</span>
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label for="EquipmentName" class="active">Particulars</label>
                                    <select class="form-control select" name="EquipmentName[]" id="EquipmentName">
                                        <option value="Area Cleanliness Checked" @if($val->EquipmentName == "Area Cleanliness Checked") selected="selected" @endif>Area Cleanliness Checked</option>
                                        <option value="Temperature(oC)" @if($val->EquipmentName == "Temperature(oC)") selected="selected" @endif>Temperature( &#x2070 C)</option>
                                        <option value="Humidity (%RH)" @if($val->EquipmentName == "Humidity (%RH)") selected="selected" @endif>Humidity (%RH)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label for="Observation" class="active">Observation</label>
                                    <input type="text" class="form-control" name="Observation[]" id="Observation" placeholder="" value="{{ $val->Observation }}">
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label for="time" class="active">Time (24 Hrs)</label>
                                    <input type="text" class="form-control timepicker"  name="time[]" id="time" placeholder="" value="{{ $val->time }}">
                                </div>
                            </div>
                        </div>
                        @php $i++; @endphp
                        @endforeach
                   @else
                    <div class="row add-more-wrap after-add-more m-0 mb-4" id="add-more-wrap-line">
                        <span class="add-count">1</span>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label for="EquipmentName" class="active">Particulars</label>
                                <select class="form-control select" name="EquipmentName[]" id="EquipmentName">
                                    <option>Area Cleanliness Checked</option>
                                    <option>Temperature( &#x2070 C)</option>
                                    <option>Humidity (%RH)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label for="Observation" class="active">Observation</label>
                                <input type="text" class="form-control" value="" name="Observation[]" id="Observation" placeholder="" value="">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label for="time" class="active">Time ( 24 Hrs)</label>
                                <input type="text" class="form-control timepicker" value="" name="time[]" id="time" placeholder="" value="">
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            @if(isset($reactorgroup) && count($reactorgroup) >0)
            <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                <div class="form-group input_fields_wrap-react" id="MaterialReceivedreact">
                    
                @if($batchproduct->reactorstatusgroup == 3)
                    <label class="control-label d-flex"> Equipment Status
                        <div class="input-group-btn">
                            <button class="btn btn-dark add-more add_field_button_react" waves-effect waves-light" id="add_field_button_react" type="button">Add More +</button>
                        </div>
                    </label>
                    @else
                    <label class="control-label d-flex"> Equipment Status
                        <div class="input-group-btn">
                            <button class="btn btn-dark add-more add_field_button_react" waves-effect waves-light" id="add_field_button_react" type="button">Add More +</button>
                        </div>
                    </label>
                    @endif


                    @if(isset($reactor_details) && count($reactor_details) >0)
                    @php $j=1; @endphp

                        @foreach($reactor_details as $val)

                      
                        <div class="row add-more-wrap after-add-more m-0 mb-4" id="add-more-wrap-line">
                            <span class="add-count">{{ $j }}</span>

                            <div class="input-group-btn">
                                <button class="btn btn-danger remove_field" type="button" onclick="deleteequpmentstatus({{$val->id}})">
                                <i class="icon-remove" data-feather="x"></i>
                            </button>
                        </div>


                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label for="EquipmentName" class="active">Particulars</label>
                                    <select class="form-control select" name="reactrosstatus[]" id="reactrosstatus">
                                    @if($batchproduct->reactorstatusgroup == 3)
                                        <option value=""> ----- Equipment Status -----</option>
                                    @else
                                        <option value=""> ----- Equipment Status -----</option>
                                    @endif

                                       @foreach($reactorgroup as $val1)
                                            <option value="{{ $val1->id }}" @if($val1->id == $val->status_id) selected="selected" @endif >{{ $val1->rector_status }}</option>
                                       @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label for="Observation" class="active"><br></label>
                                    <input type="text" class="form-control"  name="rBatch[]" id="rrBatch" placeholder="" value="{{ $val->batch_name }}">
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label for="time" class="active">Date</label>
                                    <input type="date" class="form-control"  name="rdate[]" id="rdate" placeholder="" value="{{ $val->date?date('Y-m-d',strtotime($val->date)):"" }}">
                                </div>
                            </div>


                            </div>
                        @php $j++; @endphp
                        @endforeach
                   @else
                    <div class="row add-more-wrap after-add-more m-0 mb-4" id="add-more-wrap-line">
                        <span class="add-count">1</span>
                        <div class="col-12 col-md-4">
                            <div class="form-group">

                                <label for="reactrosstatus" class="active">Particulars</label>
                                <select class="form-control select" name="reactrosstatus[]" id="reactrosstatus">
                                @if($batchproduct->reactorstatusgroup == 3)
                                        <option value=""> ----- Equipment Status -----</option>
                                    @else
                                        <option value=""> ----- Equipment Status -----</option>
                                    @endif
                                   @foreach($reactorgroup as $val)
                                        <option value="{{ $val->id }}">{{ $val->rector_status }}</option>
                                   @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label for="Observation" class="active"></label>
                                <input type="text" class="form-control" value="" name="rBatch[]" id="rrBatch" placeholder="" value="">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label for="time" class="active">Date</label>
                                <input type="date" class="form-control" value="" name="rdate[]" id="rdate" placeholder="" value="">
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif
            <div class="col-12 col-md-12">
                    <div class="form-group">
                      <label for="Remark" class="active">Note / Remark</label>
                      <textarea class="form-control" name="Remark"  id="Remark" placeholder="Note / Remark">{{ isset($lineclearace->Remark)?$lineclearace->Remark:"" }}</textarea>
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
                    @endif --}}
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="viewDetail" tabindex="-1" aria-labelledby="checkQuntityLabel" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkQuntityLabel">View Line Clearance Record</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body data_push">

           </div>
        </div>
    </div>
</div>

@push("scripts")
<script>
$(document).ready(function() {

        var max_fields = 15; //maximum input boxes allowed
        var wrapper = $(".input_fields_wrap-line"); //Fields wrapper
        var add_button = $("#add_field_button_line"); //Add button ID
        var x =1
        @if(isset($i) && $i) x= {{ $i-1 }} @else  x = 2; @endif //initlal text box count
        $(add_button).click(function(e) { //on add input button click
            e.preventDefault();
            if(x<1) x =1;
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div class="row add-more-wrap add-more-new m-0 mb-4"><span class="add-count">' + x + '</span><div class="input-group-btn"><button class="btn btn-danger remove_field" type="button"><i class="icon-remove" data-feather="x"></i></button></div><div class="col-12 col-md-4"><div class="form-group"><label for="EquipmentName[' + x + ']" class="active">Particulars</label><select class="form-control select" name="EquipmentName[]" id="EquipmentName[' + x + ']"><option>Select</option><option>Area Cleanliness Checked</option><option>Temperature( &#x2070 C)</option><option>Humidity (%RH)</option></select></div></div><div class="col-12 col-md-4"><div class="form-group"><label for="Observation[' + x + ']" class="active">Observation</label><input type="text" class="form-control" name="Observation[]" id="Observation[' + x + ']" placeholder="" value=""></div></div><div class="col-12 col-md-4"><div class="form-group"><label for="time[' + x + ']" class="active">Time (Hrs)</label><input type="text" class="form-control timepicker" name="time[]" id="time[' + x + ']" placeholder="" value=""></div></div></div>'); //add input box
            }
            feather.replace()
        
        });

        $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
            e.preventDefault();
            $(this).parents('div.row').remove();
            x--;
        })

        var max_fields = 15; //maximum input boxes allowed
        var wrapper1 = $(".input_fields_wrap-react"); //Fields wrapper
        var add_button1 = $("#add_field_button_react"); //Add button ID

        @if(isset($j) && $j) var y= {{ $j-1 }} @else var y = 1; @endif //initlal text box count
        $(add_button1).click(function(e) { //on add input button click
            e.preventDefault();
            if (y < max_fields) { //max input box allowed
                y++; //text box increment
                $(wrapper1).append('<div class="row add-more-wrap add-more-new m-0 mb-4"><span class="add-count">' + y + '</span><div class="input-group-btn"><button class="btn btn-danger remove_field" type="button"><i class="icon-remove" data-feather="x"></i></button></div><div class="col-12 col-md-4"><div class="form-group"><label for="reactrosstatus[' + y + ']" class="active">Particulars</label><select class="form-control select" name="reactrosstatus[]" id="reactrosstatus[' + y + ']"> <option value=""> ----- Select Status -----</option>@foreach($reactorgroup as $val)<option value="{{ $val->id }}">{{ $val->rector_status }}</option>@endforeach</select></div></div><div class="col-12 col-md-4"><div class="form-group"><label for="rBatch[' + y + ']" class="active"></label><input type="text" class="form-control" name="rBatch[]" id="rBatch[' + y + ']" placeholder="" value=""></div></div><div class="col-12 col-md-4"><div class="form-group"><label for="rdate[' + y + ']" class="active">Date</label><input type="date" class="form-control " name="rdate[]" id="rdate[' + y + ']" placeholder="" value=""></div></div></div>'); //add input box
            }
            feather.replace()
        });

        $(wrapper1).on("click", ".remove_field", function(e) { //user click on remove text
            e.preventDefault();
            $(this).parents('div.row').remove();
            y--;
        })

});

function deleteequpmentstatus(id)
        {
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: "POST",
                    url: '{{ route("delete-equpmentstatus") }}',

                    data: {
                        _token: CSRF_TOKEN,
                        id: id
                    },
                    success: function(data) {
                        if(data.status)
                        {
                            Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                            ).then(function(){
                                location.reload();
                                }
                            );

                        }


                    }
                })

            }
            })
        }
        
</script>

@endpush
