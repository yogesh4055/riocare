@extends("layouts.app")
@section('title', 'User Master')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row page-heading">
                <div class="col-12 col-lg-8 mb-xl-0 align-self-center align-items-center">
                    <h4 class="font-weight-bold d-flex"><i class="menu-icon" data-feather="package"></i>Users</h4>
                </div>
                @can('user-create')
                    <div class="col-12 col-lg-2 ml-auto align-self-center align-items-end text-right">
                        <a href="{{ route('users.create') }}" class="btn btn-md btn-primary">Add User +</a>
                    </div>
                @endcan
            </div>
        </div>
    </div>
    <div class="card main-card">
        <div class="card-body">
            <div class="tbl-sticky">


                <div class="clearfix"></div>
                @if ($message = Session::get('danger'))
                    <div id="" class="alert alert-danger col-md-12">
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                @if ($message = Session::get('success'))
                    <div id="" class="alert alert-success col-md-12">
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                @if ($message = Session::get('info'))
                    <div id="" class="alert alert-info alert-block col-md-12">

                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                <table class="table table-hover table-bordered datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if (!empty($user->getRoleNames()))
                                        @foreach ($user->getRoleNames() as $val)
                                            <label class="badge badge-dark">{{ $val }}</label>
                                        @endforeach
                                    @endif
                                </td>
                                <td>

                                    @can('user-edit')
                                        <a class="btn btn-primary" data-toggle="tooltip" title="Edit" href="{{ route('users.edit', $user->id) }}"><i data-feather="edit-3"></i></a>
                                    @endcan
                                    @can('user-delete')
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style' => 'display:inline']) !!}
                                        <button type="submit" name="delete" class="btn btn-danger" data-toggle="tooltip" title="Delete"><i data-feather="trash"></i></button>

                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
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

  </script>
@endpush
