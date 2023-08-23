@extends("layouts.app")
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row page-heading">
                <div class="col-12 col-xl-8 mb-xl-0 align-self-center align-items-center">
                    <h4 class="font-weight-bold d-flex"><i class="menu-icon" data-feather="check-square"></i>Quality Control Approval/Rejection (Annexure -VI)</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="card main-card">
        <div class="card-body">
            <div class="tbl-sticky">
                <table class="table table-hover table-bordered datatable" id="example">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Quality<br />(Kg)</th>
                            <th>Name of <br />Manufacturer</th>
                            <th>Name of Supplier</th>
                            <th>Raw Material Name</th>
                            <th>Batch No.</th>
                            <th>GRN</th>
                            <th>AR No.</th>
                            <th>Quantity Approved</th>
                            <th>Quantity Rejected</th>
                            <th>Date of Approval</th>
                            <th>Status</th>
                            <th>Remark</th>

                        </tr>
                    </thead>
                    <tbody>
                        @if(count($quality_control))
                        @foreach($quality_control as $temp)
                        <tr>
                            <td>{{ date('d / m /Y',strtotime($temp->created_at))}}</td>

                            <td>{{$temp->qty_received_kg}}</td>
                            <td>{{$temp->manufacturer}}</td>
                            <td>{{$temp->name}}</td>
                            <td>{{$temp->material_name}}</td>
                            <td>{{$temp->batch_no}}</td>
                            <td>{{$temp->goods_receipt_no}}</td>
                            <td>{{$temp->ar_no_date}}</td>
                            <td>{{$temp->quantity_approved}}</td>
                            <td>{{$temp->quantity_rejected}}</td>
                            <td>{{$temp->date_of_approval}}</td>
                            @if($temp->quantity_status=='Approved')
                            <td><span class="badges text-success">Approved</span></td>
                            @elseif($temp->quantity_status=='Rejected')
                            <td><span class="badges text-danger">Rejected</span></td>
                            @else
                            <td>&nbsp;</td>
                            @endif
                            <td><small>{{$temp->remark}}</small></td>
                        </tr>
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

<script>
    $(document).ready(function() {
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
