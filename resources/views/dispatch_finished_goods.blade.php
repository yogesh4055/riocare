@extends("layouts.app")
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row page-heading">
                <div class="col-12 col-lg-8 mb-xl-0 align-self-center align-items-center">
                    <h4 class="font-weight-bold d-flex"><i class="menu-icon" data-feather="truck"></i>Finished Goods Dispatch</h4>
                </div>
                <div class="col-12 col-lg-2 ml-auto align-self-center align-items-end text-right">
                    <a href="{{ route('add_dispatch_finished_goods') }}" class="btn btn-md btn-primary">Add New +</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card main-card">
        <div class="card-body">
            {{-- <div class="filter">
                <h3>Filter</h3>
                <div class="form-row">
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="form-group">
                          <input type="date" class="form-control" id="ReceiptDate" placeholder="Date">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="form-group">
                            <input type="text" class="form-control" id="ReceiptNo" placeholder="INVOICE NO.">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="form-group">
                            <input type="text" class="form-control" id="partyName" placeholder="Party Name">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <button type="search" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </div> --}}
            <div class="tbl-sticky">
            <div class="table-responsive">

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                @if ($message = Session::get('danger'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                @if ($message = Session::get('update'))
                <div class="alert alert-info alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <table class="table table-hover table-bordered datatable">
                    <thead>
                        <tr>
                            <th rowspan="2">Date</th>
                            <th rowspan="2">Party Name</th>
                            <th rowspan="2">Product Name</th>
                            <th rowspan="2">Invoice No.</th>
                            <th rowspan="2">Batch No.</th>
                            <th rowspan="2">Grade</th>
                            <th rowspan="2">Viscosity</th>
                            <th colspan="5">Total Drums</th>
                            <th rowspan="2">Total Quantity (Kg)</th>
                            <th rowspan="2">Seal No.</th>
                            <th rowspan="2">Remark</th>
                            <th rowspan="2">Dispatch By</th>
                            <th rowspan="2">Action</th>
                        </tr>
                        <tr>
                            <th>200Kg</th>
                            <th>50Kg</th>
                            <th>30Kg</th>
                            <th>5Kg</th>
                            <th>Fiber Board Drums</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($finished_good))
                        @foreach($finished_good as $temp)

                        <tr>
                            <td>{{ date("d/m/Y ",strtotime($temp->created_at)) }}</td>
                            <td>{{$temp->company_name}}</td>
                            <td>{{$temp->material_name}}</td>
                            <td>{{$temp->invoice_no}}</td>
                            <td>{{$temp->batch_no}}</td>
                            <td>{{$temp->grades_name}}</td>
                            <td>{{$temp->viscosity}}</td>
                            <td>{{number_format($temp->total_no_of_200kg_drums,3,".","") }}</td>
                            <td>{{number_format($temp->total_no_of_50kg_drums,3,".","") }}</td>
                            <td>{{number_format($temp->total_no_of_30kg_drums,3,".","") }}</td>
                            <td>{{number_format($temp->total_no_of_5kg_drums,3,".","") }}</td>
                            <td>{{number_format($temp->total_no_of_fiber_board_drums,3,".","") }}</td>
                            <td>{{number_format($temp->total_no_qty,3,".","") }}</td>
                            <td>{{$temp->seal_no}}</td>
                            <td>{{$temp->remark}}</td>
                            <td>{{$temp->name}}</td>
                            <td class="actions">
                            <a href="#" class="btn action-btn" data-toggle="modal" data-target="#viewsdispth" title="View" onclick="dispth_finishe_view({{$temp->id}})"><i data-feather="eye"></i></a> {{--
                                <a href="{{ route('edit_dispatch_finished',['id'=>$temp->id]) }}" class="btn action-btn" data-toggle="tooltip" data-placement="top" title="Edit"><i data-feather="edit-3"></i></a>
                                <a href="{{ route('delete_dispatch_finished',['id'=>$temp->id]) }}" class="btn action-btn" data-toggle="tooltip" data-placement="top" title="Delete"><i data-feather="trash"></i></a> --}}
                            </td>
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
    @push("models")
  <div class="modal fade show" id="viewsdispth" tabindex="-1" aria-labelledby="checkQuntityLabel" aria-modal="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="checkQuntityLabel">Finished Goods Dispatch</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">x</button>
      </div>
      <div class="modal-body">

      </div>
    </div>
  </div>
</div>
@endpush

    @push("scripts")
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
  <script src="{{ asset('assets/mdbootstrap4/mdb.min.js')  }}"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{ asset('assets/js/custom.js')  }}"></script>
  <!-- End custom js for this page-->

    <script>
        $(document).ready(function() {
            $('.datatable').DataTable({
     });


        });
        function dispth_finishe_view(id)
    {
       $.ajax({
         url:'{{route("dispacth_view")}}',
         data:{
        "_token": "{{ csrf_token() }}",
        "id": id
        },
        datatype:'json',
         method:"POST"
       }).done(function( html ) {

          $(".modal-body").html(html.html);
      });
    }
    </script>


@endpush
