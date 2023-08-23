@extends("layouts.app")
@section('content')

    @php 
	$todate = isset($_GET['todate'])?$_GET['todate']:'';
	$datefrom = !empty($_GET['datefrom'])?$_GET['datefrom']:'';
	@endphp 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row page-heading">
                <div class="col-12 col-xl-8 mb-xl-0 align-self-center align-items-center">
                    <h4 class="font-weight-bold d-flex"><i class="menu-icon" data-feather="shopping-cart"></i>Finished Goods Inward (Annexure - I)</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="card main-card">
        <div class="card-body">
        <div class="filter">
            <h3>Filter By Date of Receipt</h3>
            <form id="inward_packing_material" name="inward_packing_material" method="get" action="">
                <div class="form-row">

                        <!-- Date Picker -->
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="form-group">
                            <div class="datepicker date input-group">
                                <input type="text" name="datefrom" id="fromDate" placeholder="Date From" class="form-control"  value="{{old('datefrom', $datefrom)}}" >
                                <div class="input-group-append">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                         </div>
                        </div>
                    <div class="col-12 col-md-6 col-lg-3">    
                        <div class="form-group">
                            <div class="datepicker date input-group">
                                <input type="text" name="todate" id="toDate" placeholder="Date To" class="form-control"  value="{{old('todate', $todate)}}" >
                                <div class="input-group-append">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="col-12 col-md-6 col-lg-3">
                        <div class="form-group">
                        <input type="date" class="form-control calendar" value="{{old('todate', $todate)}}"  name="todate" id="toDate" placeholder="Date To"> 
                        </div>
                    </div> -->
                    <div class="col-12 col-md-6 col-lg-3">
                        <button type="submit" class="btn btn-primary">Search</button>
                        <button type="submit" value="reset" id="btnClear"class="btn btn-primary">
                        <a style="color: white;" href="{{ route('annexure_i') }}">clear</a>
                        </button>
                    </div>

                </div>
            </form>
        </div>

            <div class="tbl-sticky">
                <table class="table table-hover table-bordered datatable" id="example">
                    <thead>
                        <tr>
                            <th rowspan="2">Inward No</th>
                            <th rowspan="2">Date of Receipt</th>
                            <th rowspan="2">Opening Balance</th>
                            <th rowspan="2">Name of Manufacturer</th>
                            <th rowspan="2">Name of Supplier</th>
                            <th rowspan="2">Raw Material Name</th>
                            <th rowspan="2">Invoice Number</th>
                            <th rowspan="2">GRN</th>
                            <th rowspan="2">Viscosity</th>

                            <th rowspan="2">Total Quantity (Kg.)</th>
                            <th rowspan="2">Pack Size</th>
                            <th rowspan="2">Batch No.</th>
                            <th colspan="2">Manufacturer’s</th>
                            <th rowspan="2">RioCars’s Expiry / Retest Date</th>
                        </tr>
                        <tr>
                            <th>Mfg. Date</th>
                            <th>Expiry / Retest Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($inward_material))
                        @php $i=1; @endphp
                        @foreach($inward_material as $temp)
                        <tr>

                            <td>{{$temp->inward_no}}</td>
                            <td>{{isset($temp->date_of_receipt)?date("d/m/Y",$temp->date_of_receipt):""}}</td>
                            <td>{{$temp->opening_stock}}</td>
                            <td>{{$temp->man_name}}</td>
                            <td>{{$temp->name}}</td>
                            <td>{{$temp->material_name}}</td>
                            <td>{{$temp->invoice_no}}</td>
                            <td>{{$temp->goods_receipt_no}}</td>
                            <td>{{$temp->viscosity}}</td>
                            <td>{{number_format($temp->qty_received_kg,3,".","") }}</td>
                            <td>{{$temp->mesurment}}</td>
                            <td>{{$temp->batch_no}}</td>
                            <td>{{$temp->mfg_date!=""?date("d/m/Y",($temp->mfg_date)):""}}</td>
                            <td>{{$temp->mfg_expiry_date!=""?date("d/m/Y",($temp->mfg_expiry_date)):""}}</td>
                            <td>{{$temp->rio_care_expiry_date!=""?date("d/m/Y",($temp->rio_care_expiry_date)):""}}</td>
                        </tr>
                        @php $i++; @endphp
                        @endforeach
                        @endif

                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

@endsection
@push("scripts")

<link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="//cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css" />
<script src="//code.jquery.com/jquery-3.5.1.js"></script>


<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script src="{{ asset('assets/mdbootstrap4/mdb.min.js')  }}"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- endinject -->
<!-- Custom js for this page-->
<script src="{{ asset('assets/js/custom.js')  }}"></script>
<!-- End custom js for this page-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
    $(document).ready(function() {

        $('.datepicker').datepicker({
            language: "es",
            autoclose: true,
            format: "dd-mm-yyyy"
        });

        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        });
    });
</script>
@endpush
