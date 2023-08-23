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
                    <h4 class="font-weight-bold d-flex"><i class="menu-icon" data-feather="hard-drive"></i>Issual by stores for production for captive consumption-simethicone (Annexure - II)</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="card main-card">
        <div class="card-body">
            <form id="vali_issue_material" method="post" action="{{url('issue_by_stores_insert')}}">
                {{csrf_field()}}
                <div class="form-row">
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="Requisition">Requisition No.</label>
                            <input type="text" class="form-control" name="requisition_no" id="requisition_no" placeholder="Requisition" maxlength="50">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="RawBatchNo">Product Name</label>
                            {{ Form::select("product_name",$rawmaterial,old("product_name"),array("class"=>"form-control select","id"=>"product_name","placeholder"=>"Choose Material")) }}
                          @if ($errors->has('materialname'))
                          <span class="text-danger">{{ $errors->first('materialname') }}</span>
                        @endif

                           </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="Viscosity">Batch No <span class="text-danger"></span></label>

                            {{ Form::select("batch_no",array(),old("batch_no"),array("class"=>"form-control select","id"=>"batch_no","placeholder"=>"Choose Batch No")) }}
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
                            <label for="MaterialName">Opening Balance</label>
                            <input type="text" class="form-control" name="opening_balance" id="opening_balance" placeholder="Opening Balance" >
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="IssuedQuantity"> Quantity</label>
                            <input type="number" class="form-control calculate"  name="quantity" id="quantity" placeholder="Quantity">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="IssuedQuantity">For Fg Batch No</label>


                            <input type="number" class="form-control calculate" value="0" onkeyup="" name="for_fg_batch_no" id="for_fg_batch_no" placeholder="for fg batch no">
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="finishedBatchNo">Returned From Day Store</label>
                            <input type="text" class="form-control" name="returned_from_day_store" id="returned_from_day_store" placeholder="Finished Product Batch No.">
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="SupplierName">Dispensed by</label>
                            {{ Form::select('dispensed_by',$users,old("dispensed_by")?old("dispensed_by"):\Auth::user()->id,array('class'=>'form-control select',"placeholder"=>"Dispensed by","id"=>"dispensed_by")) }}


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
        $("#product_name").change(function(){
         $.ajax({
             url:'{{ route('getmatarialqtyandbatch') }}',
             method:'POST',
             data:{
                 "id":$(this).val(),
                 "_token":'{{ csrf_token() }}'
             }
         }).success(function(data){

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
                 "rawmaterial":$("#product_name").val(),
                 "_token":'{{ csrf_token() }}'
             }
         }).success(function(data){
            $("#opening_balance").val(data.qty);
            $("#quantity").val(data.qty);



         })
     })
        $("#vali_issue_material").validate({
            rules: {
                requisition_no:{ required:true,maxlength:50 },
                opening_balance: "required",
                issual_date: "required",
                product_name: "required",
                batch_no: "required",
                quantity: "required",
                for_fg_batch_no: "required",
                returned_from_day_store: "required",
                dispensed_by: "required",
                /*remark: "required",*/
            },
            messages: {
                requisition_no: "Please  Enter The Requisition No",
                opening_balance: "Please  Enter The Opening Balance",
                batch_no: "Please  Enter The Batch No ",
                issual_date: "Please  Enter The Issual Date ",
                product_name: "Please  Enter The Product Name",
                quantity: "Please  Enter The Quantity",
                for_fg_batch_no: "Please  Enter The for Fg Batch No",
                returned_from_day_store: "Please  Enter The Returned From Day Store",
                dispensed_by: "Please  Enter The Dispensed By Name",
                remark: "Please  Enter The Remark",
            },
        });

    });
</script>
@endpush
