<div class="modal-header">
    <h5 class="modal-title" id="checkQuntityLabel">{{$qty_control_view->material_name}} - {{$qty_control_view->batch_no}}.</h5>
    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">x</button>
</div>
<div class="modal-body">
  <form method="post" id="checkQuantity" action="{{ route('quality_control_insert') }}" name="checkQuantity">
      {{csrf_field()}}
      <div class="form-row">
          <!-- <div class="col-12 col-md-12 col-lg-12 col-xl-12">
            <div class="form-group">
              <label for="dateTime">Date and Time</label>
              <div class="form-row">
                <div class="col-6"><input type="date" name="cdate" class="form-control calendar" id="date" placeholder="Date" value={{ date("Y-m-d") }}></div>
                <div class="col-6"><input type="time"  name="ctime" class="form-control calendar" id="Time" placeholder="Time" value="{{ date("H:i") }}"></div>
                @if ($errors->has('cdate'))
                <span class="text-danger">{{ $errors->first('cdate') }}</span>
              @endif
              </div>
            </div>
        </div> -->
          
          <div class="col-12 col-md-6 col-lg-6 col-xl-6">
            <div class="form-group">
                <label for="ar_date">AR. Date</label>
                <input type="date" class="form-control" name="ar_date" id="ar_date" placeholder="AR Date"  value="{{ isset($qty_control_view->ar_no_date_date) ? date('Y-m-d', strtotime($qty_control_view->ar_no_date_date)) : date('d-m-Y') }}" required>

                <!-- value="{{ isset($qty_control_view->ar_no_date_date) ? date('Y-m-d', strtotime($qty_control_view->ar_no_date_date)) : date('Y-m-d', strtotime($qty_control_view->inward_ar_date)) }}" -->

            </div>
        </div>
          <div class="col-12 col-md-6 col-lg-6 col-xl-6">
            <div class="form-group">
                <label for="QuantityRejected">AR. Number</label>
                <input type="text" class="form-control" name="ar_number" id="ar_number" placeholder="AR No."  maxlength="120" onkeypress="" value="{{$qty_control_view->ar_no_date}}" required>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
              <div class="form-group">
                  <label for="ApprovalDate">Date of Approval/Rejection</label>
                  <input type="date" class="form-control calendar" name="date_of_approval" id="date_of_approval" placeholder="DD-MM-YYYY" value="@if($qty_control_view->date_of_approval){{$qty_control_view->date_of_approval}}@else{{ date('Y-m-d') }}@endif">
              </div>
          </div>

        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
            <div class="form-group">
                <label for="QuantityRejected">Attachment</label>
                <input type="file" class="form-control" name="files" id="files" placeholder="Attachment">
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
              <div class="form-group">
                  <label for="QuantityApproved">Quantity</label>
                  <input type="number" class="form-control" name="quantity_approved" disabled id="quantity_approved" placeholder="Quantity Approved" value="{{ $qty_control_view->qty_received_kg }}">
              </div>
          </div>
          {{-- <div class="col-12 col-md-6 col-lg-6 col-xl-6">
              <div class="form-group">
                  <label for="QuantityRejected">Quantity Rejected</label>
                  <input type="number" class="form-control" name="quantity_rejected" id="quantity_rejected" placeholder="Quantity Rejected">
              </div>
          </div> --}}
          <div class="col-12 col-md-6 col-lg-6 col-xl-6">
              <div class="form-group">
                  <label for="Status">Status</label> <br>
                  <div class="form-check-inline">
                    <input type="radio" class="form-check-input" name="quantity_status" id="materialChecked2" checked value="Approved">
                    <label class="form-check-label" for="materialChecked2">Approved</label>
                  </div>
                  <div class="form-check-inline">
                    <input type="radio" class="form-check-input" name="quantity_status" id="materialChecked3" value="Rejected">
                    <label class="form-check-label" for="materialChecked3">Rejected</label>
                  </div>

              </div>
          </div>
        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
            <div class="form-group">
                <label for="QuantityRejected">QC Manager</label>
                {{ Form::select('checkby',$users,old("checkby")?old("checkby"):$qty_control_view->checked_by,array('class'=>'form-control select',"placeholder"=>"Select Option","id"=>"checkby")) }}

            </div>
        </div>
        
          <div class="col-12">
              <div class="form-group">
                  <label for="Remark">Remark</label>
                  <textarea class="form-control" id="remark" name="remark" placeholder="remark">{{$qty_control_view->remark}}</textarea>
              </div>
          </div>
          <div class="col-12">
              <div class="form-group">
                  <input type="hidden" name="inward_id" value="{{ $qty_control_view->inward_id }}" />
                  <input type="hidden" name="inward_item_id" value="{{ $qty_control_view->itemid }}" />
                  <input type="hidden" name="batch_no" value="{{ $qty_control_view->batch_no }}" />

                  <input type="hidden" name="rawmaterial_id" value="{{ $qty_control_view->r_m_id }}" />
                  <input type="hidden" name="total_qty" value="{{ $qty_control_view->qty_received_kg }}" />
                  <input type="hidden" name="mat_type" value="{{ $mat_type }}" />
                  <input type="hidden" name="flag" value="{{ $flag }}" />
                  <input type="hidden" name="quality_id" value="{{ $qty_control_view->quality_id }}" />
                  <button type="submit" class="btn btn-primary btn-md m-0 submit_data">Submit</button>
              </div>
          </div>
      </div>
  </form>
</div>
<script>

    $(document).ready(function() {

        $("#checkQuantity").validate({
            rules: {
                quantity_approved: "required",
                quantity_status: "required",
                date_of_approval: "required",
                ar_number:"required",
                //remark:"required",
                checkby:"required",
                /*"quantity_rejected": {
                    required: function(element) {
                        return ($('input[name="quantity_status"]:checked').val() === "Rejected");
                    }
                }*/
            },
            messages: {
                quantity_approved: "Please  Enter quantity approved",
                quantity_status: "Please select check status",
                date_of_approval: "Please  Enter date of approval",
                ar_number:"Please Enter ar number/date",
                //remark:"Please enter remark",
                checkby:"Please select QA manager"

            },
        });
        $(function() {
        $('input:text').keydown(function(e) {
        if(e.keyCode==1)
            return false;

        });
        });
    });
</script>


