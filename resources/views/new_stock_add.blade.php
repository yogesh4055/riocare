@extends("layouts.app")

@section('content')
<div class="col-md-12">
    @if ($message = Session::get('success'))
    <div class="alert alert-info alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
    @endif
</div>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row page-heading">
                <div class="col-12 col-xl-8 mb-xl-0 align-self-center align-items-center">
                    <h4 class="font-weight-bold d-flex"><i class="menu-icon" data-feather="shopping-cart"></i>Finished Goods Inward (Annexure - I) - New Stock</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="card main-card">
        <div class="card-body">
            <form id="inward_finished_vali" method="post" action="inward_finished_insert">
                {{csrf_field()}}
                <div class="form-row">

                        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                              <label for="rno">No.</label>
                              <input type="text" class="form-control" name="rno" id="rno" placeholder="{{ $nextid }}" value="{{ $nextid }}" readonly>
                              @if ($errors->has('rno'))
                                        <span class="text-danger">{{ $errors->first('rno') }}</span>
                                @endif
                            </div>
                        </div>

                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" name="inward_date" id="inward_date" placeholder="Date">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="productName">Product Name</label>

                            {{ Form::select("product_name",$product,old("product_name"),array("class"=>"form-control select","id"=>"product_name","placeholder"=>"Choose Product Name")) }}

                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="BatchNo">Batch No.</label>
                            <input type="text" class="form-control" name="batch_no" id="batch_no" placeholder="Batch">   <!-- maxlength="25"> -->
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="grade">Grade</label>
                            <input type="text" class="form-control" name="grade" id="grade" placeholder="Grade"  maxlength="120">
                           {{--  <select class="form-control select" name="grade" id="grade">
                                <option value=""> Select</option>
                                @if(count($grade_master))
                                @foreach($grade_master as $temp)
                                <option value="{{$temp->id}}">{{$temp->grade}}</option>
                                @endforeach
                                @endif

                            </select> --}}
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="Viscosity">Viscosity (Optional)</label>
                            <input type="text" class="form-control" name="viscosity" id="viscosity" placeholder="Viscosity" maxlength="120">
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="mfgDate">Mfg. Date</label>
                            <input type="date" class="form-control calendar" name="mfg_date" id="mfg_date" placeholder="Mfg. Date">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="expiryDate">Expiry / Retest Date</label>
                            <input type="date" class="form-control" name="expiry_ratest_date" id="expiry_ratest_date" placeholder="Expiry / Retest Date">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="200KgDrums">Total No. of 200Kg Drums</label>
                            <input type="number" class="form-control qty-group" name="total_no_of_200kg_drums" id="total_no_of_200kg_drums" placeholder="200Kg Drums">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="50KgDrums">Total No. of 50Kg Drums</label>
                            <input type="number" class="form-control qty-group" name="total_no_of_50kg_drums" id="total_no_of_50kg_drums" placeholder="50Kg Drums">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="30KgDrums">Total No. of 30Kg Drums</label>
                            <input type="number" class="form-control qty-group" name="total_no_of_30kg_drums" id="total_no_of_30kg_drums" placeholder="30Kg Drums">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="5KgDrums">Total No. of 5Kg Drums</label>
                            <input type="number" class="form-control qty-group" name="total_no_of_5kg_drums" id="total_no_of_5kg_drums" placeholder="5Kg Drums">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="FiberboardDrums">Total No. of Fiber board Drums</label>
                            <input type="number" class="form-control qty-group" name="total_no_of_fiber_board_drums" id="total_no_of_fiber_board_drums" placeholder="Fiber board Drums">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="Quantity">Total Quantity (Kg)</label>
                            <input type="number" class="form-control" name="total_quantity" id="total_quantity" placeholder="Quantity">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="grade">AR No</label>
                            <input type="text" class="form-control" name="ar_no" id="ar_no" placeholder="AR.No"  maxlength="50" />



                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="grade">AR Date</label>
                            <input type="date" class="form-control" name="ar_no_date" id="ar_no_date" placeholder="AR. Date"/>



                        </div>
                    </div>
                    <!-- <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="approvalDate">Approval Date</label>
                            <input type="date" class="form-control calendar" name="approval_data" id="approval_data" placeholder="Date">
                        </div>
                    </div> -->
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="SupplierName">Received by</label>

                            {{ Form::select('received_by',$users,old("received_by")?old("received_by"):\Auth::user()->id,array('class'=>'form-control select',"placeholder"=>"Received by")) }}

                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
						<div class="form-check" style="margin-top:30px;">
                            <input type="checkbox" class="form-check-input" id="openingstockcheck" name="openingstock" id="openingstock" value="1">
                            <label class="form-check-label" for="openingstockcheck">Is Opening Stock?</label>
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
                            <button type="submit" class="btn btn-primary btn-md ml-0 form-btn submit_data">Submit</button>
                            <button type="button" class="btn btn-light btn-md form-btn clear_submit">Clear</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
@push("scripts")
<script src="//cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script>

    $(document).ready(function() {

        $("#inward_finished_vali").validate({
            rules: {
                inward_date: "required",
                product_name: "required",
                batch_no: "required",
               /* grade: "required",
                grade: "required",
                viscosity: "required",*/
                mfg_date: "required",
                expiry_ratest_date: "required",
                total_no_of_200kg_drums: {
                require_from_group: [1, ".qty-group"]
                },
                total_no_of_50kg_drums: {
                require_from_group: [1, ".qty-group"]
                },
                total_no_of_30kg_drums: {
                require_from_group: [1, ".qty-group"]
                },
                total_no_of_5kg_drums: {
                require_from_group: [1, ".qty-group"]
                },
                total_no_of_fiber_board_drums: {
                require_from_group: [1, ".qty-group"]
                },
                total_quantity: "required",
               /* ar_no: "required",*/
                approval_data: "required",
                received_by: "required",
                /*remark: "required",*/
            },
            messages: {
                inward_date: "Please  Enter The date of Inward No",
                product_name: "Please  Enter The Product Name",
                batch_no: "Please  Enter The Name Batch No",
                grade: "Please  Enter The Name Ggrad",
                viscosity: "Please  Enter The Name Viscosit",
                mfg_date: "Please  Enter The Name Mfg Date",
                expiry_ratest_date: "Please  Enter The Name Expiry Ratest Date",
                total_no_of_200kg_drums: "Please  Enter The Name Total No Of 200kg Drum",
                total_no_of_50kg_drums: "Please  Enter The Name total_no_of_50kg Drum",
                total_no_of_30kg_drums: "Please  Enter The Name total_no_of_30kg Drum",
                total_no_of_5kg_drums: "Please  Enter The Name total_no_of_5kg Drum",
                total_no_of_fiber_board_drums: "Please  Enter The Name Total No Of Fiber Board Drum",
                total_quantity: "Please  Enter The Name Total Quantit",
                ar_no: "Please  Enter The Name Ar No",
                approval_data: "Please  Enter The Name Approval Date",
                received_by: "Please  Enter The Name Received By",
                remark: "Please  Enter The Name Remark",
            },
        });
        $('.clear_submit').click(function() {
            $('#inward_date').val('');
            $('#product_name').val('');
            $('#batch_no').val('');
            $('#grade').val('');
            $('#grade').val('');
            $('#viscosity').val('');
            $('#mfg_date').val('');
            $('#expiry_ratest_date ').val('');
            $('#total_no_of_200kg_drums').val('');
            $('#total_no_of_50kg_drums').val('');
            $('#total_no_of_30kg_drums').val('');
            $('#total_no_of_5kg_drums').val('');
            $('#total_no_of_fiber_board_drums').val('');
            $('#total_quantity').val('');
            $('#ar_no').val('');
            $('#approval_data').val('');
            $('#received_by').val('');
            $('#remark').val('');
        });

});
</script>
@endpush
