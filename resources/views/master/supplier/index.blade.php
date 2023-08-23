@extends("layouts.app");
@section("title","Supplier")
@section("content")
<div class="row">
    <div class="col-md-12 grid-margin">
      <div class="row page-heading">
        <div class="col-12 col-lg-8 mb-xl-0 align-self-center align-items-center">
          <h4 class="font-weight-bold d-flex"><i class="menu-icon" data-feather="package"></i>Suppliers</h4>
        </div>
        <div class="col-12 col-lg-2 ml-auto align-self-center align-items-end text-right">
          <a href="{{ route("new-supplier") }}" class="btn btn-md btn-primary">Add New +</a>
        </div>
      </div>
    </div>
  </div>
  <div class="card main-card">
    <div class="card-body">
       <div class="tbl-sticky">
        @if (Session::has('error'))
        <div id="" class="alert alert-danger col-md-12">{!! Session::get('error') !!}
        </div>
        @endif
        @if (Session::has('message'))
            <div id="" class="alert alert-success col-md-12">{!! Session::get('message') !!}
            </div>
        @endif
            <table class="table table-hover table-bordered datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Supplier Name</th>
                        <th>Contact Per Name</th>
                         <th>Contact Number</th>
                         <th>Address</th>
                         <th>Company Name</th>
                        <th align="center">Publish</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($suppliers))
                        @php($i=1)
                        @foreach($suppliers as $val)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $val->name }}</td>
                        <td>{{ $val->contact_per_name }}</td>
                        <td>{{ $val->contact_no }}</td>
                        <td>{{ $val->address }} <br>
                           {{ $val->city?$val->city:""}}
                           {!! $val->state?"<br>".$val->state:"" !!}</td>
                          <td>{{ $val->company_name }}</td>
                        <td align="center"> @if($val->publish ==1) <i data-feather="eye" style="color: green"></i> @else <i data-feather="eye-off" style="color: red"></i> @endif</td>
                        <td>{{ date("d/m/Y H:i",strtotime($val->created_at)) }}</td>

                        <td>{{ date("d/m/Y H:i",strtotime($val->created_at)) }}</td>

                        <td class="actions"><a href="#" class="btn action-btn" data-toggle="modal" data-target="#viewsupplier" title="View" onclick="viewsupp({{$val->id}})"><i data-feather="eye"></i></a><a href="{{ route("edit-supplier",["id"=>$val->id]) }}" class="btn action-btn" data-toggle="tooltip" title="Edit"><i data-feather="edit-3"></i></a><a href="#" class="btn action-btn" data-toggle="tooltip" class="remove" data-href="" title="Delete" onclick="remove('{{ route("delete-supplier",["id"=>$val->id]) }}')"><i data-feather="trash"></i></a></td>
                    </tr>
                        @php($i++)
                        @endforeach
                    @endif


                </tbody>
            </table>
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
    $(document).ready(function() {
        $('.datatable').DataTable();
    });
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
    function viewsupp(id)
    {
       $.ajax({
         url:'{{route("show-supplier")}}',
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
