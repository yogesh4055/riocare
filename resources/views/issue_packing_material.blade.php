@extends("layouts.app")
@section('content')
<div class="content-wrapper">
    <div class="col-md-12 grid-margin">
        <div class="row page-heading">
            <div class="col-12 col-lg-8 mb-xl-0 align-self-center align-items-center">
                <h4 class="font-weight-bold d-flex"><i class="menu-icon" data-feather="package"></i>Issed by Stores for Production (Annexure - III) </h4>
            </div>
            <div class="col-12 col-lg-2 ml-auto align-self-center align-items-end text-right">
                <a href="{{ route('issue_packing_material_add') }}" class="btn btn-md btn-primary">Add New +</a>
            </div>
        </div>
    </div>
    <div class="card main-card">
        <div class="card-body">
            <div class="tbl-sticky">
            @if ($message = Session::get('message'))
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
                <table class="table table-hover table-bordered datatable_p">
                    <thead>
                        <tr>
                            <th>Requisition No</th>
                            <th>Batch No</th>
                            <!-- <th>Viscosity</th> -->
                            <th>Issual Date</th>
                            <th>Dispensed By</th>
                            <th>Remark</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @if(count($issue_packing_material))
                        @foreach($issue_packing_material as $temp)
                        <tr>
                            <td> {{$temp->id}}</td>
                            <td> {{$temp->batchNo}}</td>
                            <td> {{$temp->created_at?date("d/m/Y",strtotime($temp->created_at)):""}}</td>
                            <td> {{$temp->name}}</td>
                            <td> {{$temp->remark}}</td>

                            <td> {!!  $temp->status == 1 ? '<span class="badge badge-success p-2">Approved</span>':'<span class="badge badge-warning p-2">Pending</span>' !!}</td>
                            <td>
                           <!-- <a href="{{ route('view_issue_material',['id'=>$temp->id]) }}" class="btn action-btn" data-toggle="tooltip" data-placement="top" title="View"><i data-feather="eye"></i></a>-->
                           @if($temp->status == 1)
                            <a href="{{ route('issue_material_view',['id'=>$temp->id]) }}" class="btn action-btn" title="Approved Qty"><i data-feather="eye"></i></a>
                           @else
                           <a href="{{ route('issue_packing_material',['id'=>$temp->id]) }}" class="btn action-btn" onclick="viewsupp({{$temp->id}})" title="Approved Qty"><i data-feather="eye"></i></a>
                           @endif

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
<div class="modal fade show" id="viewsupplier" tabindex="-1" aria-labelledby="checkQuntityLabel" aria-modal="true">
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="checkQuntityLabel">Supplier Details</h5>
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
      feather.replace()
    $(document).ready(function() {
        $('.datatable_p').DataTable({
        "order": [[ 0, "desc" ]]
    } );
    });

    function viewsupp(id)
    {
       $.ajax({
         url:'{{route("view_issue_material")}}',
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
