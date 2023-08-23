@extends("layouts.app")
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row page-heading">
                <div class="col-12 col-xl-8 mb-xl-0 align-self-center align-items-center">
                    <h4 class="font-weight-bold d-flex"><i class="menu-icon" data-feather="layers"></i>Goods Receipt Note (Annexure - IV)</h4>
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
                        <th>#</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Date of Receipt</th>
                            <th>Packing Material Name</th>
                            <th>Name of Manufacturer</th>
                            <th>Name of Supplier</th>
                            <th>Invoice No./ Challan</th>

                            <th>Quantity</th>
                            <th>GRN</th>
                            <th>Checked by</th>
                        </tr>

                    </thead>
                    <tbody>
                        @if(isset($listquery))
                        @php $i=1; @endphp
                        @foreach($listquery as $temp)
                        <tr>

                            <td>{{$temp->id}}</td>
                            <td>{{$temp->goods_going_from_name}}</td>
                            <td>{{$temp->goods_going_to_name}}</td>
                            <td>{{$temp->date_of_receipt}}</td>
                            <td>{{$temp->material_name}}</td>
                            <td>{{$temp->manufacturer}}</td>
                            <td>{{$temp->name}}</td>
                            <td>{{$temp->invoice_no}}</td>
                            <td>{{$temp->total_qty}}</td>
                            <td>{{$temp->goods_receipt_no}}</td>
                            <td>{{$temp->uname}}</td>
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
