
@extends('layouts.app')
@section('content')
<div class="col-md-12">
    @if ($message = Session::get('success'))
    <div class="alert alert-info alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
    @endif
</div>
<!-- Main Container -->
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row page-heading">
                <div class="col-12 col-xl-8 mb-xl-0 align-self-center align-items-center">
                    <h4 class="font-weight-bold d-flex"><i class="menu-icon" data-feather="hard-drive"></i>Issued by Stores for Production (Annexure - III)</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="card main-card">
        <div class="card-body">
            <form  id="vali_issue_material" method="post" action="{{url('issue_material_insert')}}">
            {{csrf_field()}}
                <div class="form-row">
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="Requisition">Requisition No.</label>
                            <input type="text" class="form-control" name="requisition_no" id="requisition_no" placeholder="Requisition">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="MaterialName">Raw Material Name</label>
                            {{ Form::select("material",$rawmaterial,old("material"),array("class"=>"form-control select","id"=>"materialname","placeholder"=>"Choose Material")) }}
                            @if ($errors->has('material'))
                            <span class="text-danger">{{ $errors->first('material') }}</span>
                          @endif

                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="OpeningBalance">Opening Balance</label>
                            <input type="text" class="form-control" name="opening_bal" id="opening_bal" onkeyup="sub()"  placeholder="Balance Stock" readonly>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="RawBatchNo">Raw Material Batch No.</label>
                            {{ Form::select("batch_no",array(),old("batch_no"),array("class"=>"form-control select","id"=>"batch_no","placeholder"=>"Choose Batch No")) }}

                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="Viscosity" >Viscosity <span class="text-danger">(Only for certain Products)</span></label>
                            <input type="text" class="form-control" name="viscosity" id="viscosity" placeholder="Viscosity" pattern="\d*" maxlength="12" onkeypress="return /[0-9a-zA-Z\s\\/-]/i.test(event.key)">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="IssualDate">Issual Date</label>
                            <input type="date" class="form-control calendar" name="issual_date" id="issual_date" placeholder="Viscosity" value="{{ date("Y-m-d") }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="IssuedQuantity">Issued Quantity</label>
                            <input type="number" class="form-control calculate" value="0" onkeyup="sub()" name="issued_quantity" id="issued_quantity" placeholder="Quantity">
                        </div>
                    </div>
                    {{-- <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="IssuedQuantity">Batch Quantity</label>
                            <input type="number" class="form-control calculate" value="0" onkeyup="" name="batch_quantity" id="batch_quantity" placeholder="Quantity">
                        </div>
                    </div> --}}

                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="finishedBatchNo">For finished Product Batch No.</label>
                            {{-- <input type="text" class="form-control" name="finished_batch_no" id="finished_batch_no" placeholder="Finished Product Batch No." value="{{ Session::get('batchNo') }}"> --}}
                            {{ Form::select("finished_batch_no",$finishedproducts,old("finished_batch_no"),array("class"=>"form-control select","id"=>"finished_batch_no","placeholder"=>"Choose Product")) }}
                        </div>
                    </div>




                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="SupplierName">Dispensed by</label>
                            <input readonly type="text" class="form-control" name="dispensed_by" id="dispensed_by" placeholder="Dispensed by" value="{{ \Auth::user()->name }}">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="Remark">Note / Remark</label>
                            <textarea class="form-control" name="remark" id="remark" placeholder="Note / Remark"></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-md ml-0 form-btn ">Submit</button>
                            <button type="button" class="btn btn-light btn-md form-btn data_clear">Clear</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('custom-scripts')
<script>
 $(document).ready(function() {
     $("#materialname").change(function(){
         $.ajax({
             url:'{{ route('getmatarialqtyandbatch') }}',
             method:'POST',
             data:{
                 "id":$(this).val(),
                 "_token":'{{ csrf_token() }}'
             }
         }).success(function(data){
            $("#opening_bal").val(data.material.material_stock);
            $("#closing_balance_qty").val(data.material.material_stock);
            $.each(data.batch, function (key, val) {
                var option ="<option value='"+key+"'>"+val+"</option>";

                $("#batch_no").append(option);
        });
         })
     })
     $("#batch_no").change(function(){
         $.ajax({
             url:'{{ route('getmatarialqtyofbatch') }}',
             method:'POST',
             data:{
                 "id":$(this).val(),
                 "rawmaterial":$("#materialname").val(),
                 "_token":'{{ csrf_token() }}'
             }
         }).success(function(data){
            $("#issued_quantity").val(data.qty);
            $("#batch_quantity").val(data.qty);
            var batch_quantity = $('#opening_bal').val();
            $("#closing_balance_qty").val(batch_quantity-data.qty);


         })
     })
        $("#vali_issue_material").validate({
            rules: {
                requisition_no:"required",
                material:"required",
                opening_bal:"required",
                batch_no:"required",
                viscosity:"required",
                /*batch_quantity:"required",*/
                issued_quantity:"required",
               /* excess: "required",
                finished_batch_no:"required",
                wastage: "required",
                returned_from_day_store:"required",*/
                closing_balance_qty:"required",
                dispensed_by:"required",
               /* remark:"required",*/
            },
            messages: {
                requisition_no: "Please  Enter The Requisition No",
                material: "Please  Enter The Material Name",
                opening_bal: "Please  Enter The Opening Balance",
                batch_no: "Please  Enter The Batch No ",
                viscosity: "Please  Enter The Viscosity Name",
                batch_quantity: "Please  Enter The Batch Qty",
                issual_date: "Please  Enter The Issual Date ",
                issued_quantity: "Please  Enter The Issued Quantity ",
                finished_batch_no: "Please  Enter The Finished Batch No ",
                excess: "Please  Enter The Excess",
                wastage: "Please  Enter The Wastage",
                returned_from_day_store: "Please  Enter The Returned From Day Store",
                closing_balance_qty: "Please  Enter The Closing Balance qty ",
                dispensed_by: "Please  Enter The Dispensed By Name",
                remark: "Please  Enter The Remark",
            },
        });
        $('.data_clear').click(function() {
            $('#requisition_no').val('');
            $('#material').val('');
            $('#opening_bal').val('');
            $('#batch_no').val('');
            $('#batch_quantity').val('');
            $('#viscosity').val('');
            $('#issual_date').val('');
            $('#issued_quantity').val('');
            $('#finished_batch_no').val('');
            $('#excess').val('');
            $('#wastage').val('');
            $('#returned_from_day_store').val('');
            $('#closing_balance_qty').val('');
            $('#dispensed_by').val('');
            $('#remark').val('');
        });
        
            $(function() {
            $('input:text').keydown(function(e) {
            if(e.keyCode==1)
                return false;

            });
            });


    });
    function sub() {
        var issued_quantity = $('#issued_quantity').val();
        var batch_quantity = $('#opening_bal').val();
        if(batch_quantity > 0){
            var result = parseInt(batch_quantity) - parseInt(issued_quantity);
            if (!isNaN(result)) {
                $('#closing_balance_qty').val(result);
            }
        }
    }
</script>
@endpush
