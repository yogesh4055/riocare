@extends("layouts.app")
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row page-heading">
                <div class="col-12 col-xl-8 mb-xl-0 align-self-center align-items-center">
                    <h4 class="font-weight-bold d-flex"><i class="menu-icon" data-feather="hard-drive"></i>Issual by stores for production for captive consumption-simethicone (Annexure - II)</h4>
                </div>
                <div class="col-12 col-lg-2 ml-auto align-self-center align-items-end text-right">
                    <a href="{{ route('issual_by_stores_for_production_add') }}" class="btn btn-md btn-primary">Add New +</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card main-card">
        <div class="card-body">
            <div class="tbl-sticky">
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
                            <th>Requisition No.</th>
                            <th>Opening Balance</th>
                            <th>Issual Date</th>
                            <th>Product Name</th>
                            <th>Batch No.</th>
                            <th>Quantity</th>
                            <th>For FG- Batch No</th>
                            <th>Returned<br />from<br />Day<br />Store</th>
                            <th>Dispensed by</th>
                            <th>Created At</th>
                            <th>Remark</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @if(count($issue_stores))
                        @foreach($issue_stores as $temp)
                        <tr>
                            <td>{{$temp->requisition_no}}</td>
                            <td>{{$temp->opening_balance}}</td>
                            <td>{{$temp->issual_date}}</td>
                            <td>{{$temp->material_name}}</td>
                            <td>{{$temp->batch_no}}</td>
                            <td>{{number_format($temp->quantity,3,".","") }}</td>
                            <td>{{$temp->for_fg_batch_no}}</td>
                            <td>{{$temp->returned_from_day_store}}</td>
                            <td>{{$temp->name}}</td>
                            <td>{{date("d/m/Y",strtotime($temp->created_at))}}</td>
                            <td>{{$temp->remark}}</td>

                            <td>
                                <a href="#" class="btn action-btn" data-toggle="modal" data-target="#viewbystore" title="View" onclick="viewstore({{$temp->id}})"><i data-feather="eye"></i></a>

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
  <div class="modal fade show" id="viewbystore" tabindex="-1" aria-labelledby="checkQuntityLabel" aria-modal="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="checkQuntityLabel">Issual by stores for production Details</h5>
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
            $('.datatable').DataTable();


        });
  function viewstore(id)
    {
       $.ajax({
         url:'{{route("view_store")}}',
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
