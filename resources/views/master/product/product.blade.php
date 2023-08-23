@extends("layouts.app");
@section("title","Ar No Master")
@section("content")
<div class="row">
    <div class="col-md-12 grid-margin">
      <div class="row page-heading">
        <div class="col-12 col-lg-8 mb-xl-0 align-self-center align-items-center">
          <h4 class="font-weight-bold d-flex"><i class="menu-icon" data-feather="package"></i>Product Master</h4>
        </div>
        <div class="col-12 col-lg-2 ml-auto align-self-center align-items-end text-right">
          <a href="{{ route('new_product') }}" class="btn btn-md btn-primary">Add New +</a>
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
                        <th>Id</th>
                        <th>Name</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($product_master))
                       @foreach($product_master as $temp)
                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{$temp->name }}</td>
                        <td>{{ date("d/m/Y H:i",strtotime($temp->created_at)) }}</td>

                        <td>{{ date("d/m/Y H:i",strtotime($temp->created_at)) }}</td>

                        <td class="actions">
                        <a href="{{ route('edit_product',['id'=>$temp->id]) }}" class="btn action-btn" data-toggle="tooltip" title="Edit"><i data-feather="edit-3"></i></a>
                        <a href="{{ route('delete_product',['id'=>$temp->id]) }}" class="btn action-btn" data-toggle="tooltip" class="remove" data-href=""><i data-feather="trash"></i></a></td>
                    </tr>
                         @endforeach
                    @endif


                </tbody>
            </table>
        </div>

    </div>
  </div>
@endsection
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
    } );
    function remove(url) {

        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
            swalWithBootstrapButtons.fire(
            'Deleted!',
            'Your record has been deleted.',
            'success'
            )
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
            'Cancelled',
            'Your imaginary file is safe :)',
            'error'
            )
        }
        })
    }
  </script>
  @endpush
