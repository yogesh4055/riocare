@extends("layouts.app")
@section("title","Log Management")
@section("content")
<div class="row">
    <div class="col-md-12 grid-margin">
      <div class="row page-heading">
        <div class="col-12 col-lg-8 mb-xl-0 align-self-center align-items-center">
          <h4 class="font-weight-bold d-flex"><i class="menu-icon" data-feather="package"></i>Log Management</h4>
        </div>
       
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
                        <th>Log Name</th>
                        <th>Description</th>
                        <th>Subject Type</th>
                        <th>Event</th>
                        <th>Propertis</th>
                        <th>Created On</th>
                        
                    </tr>
                </thead>
                <tbody>
                  @if(isset($activity))
                  @php $i=1; @endphp
                  @foreach ($activity as $key => $act)
                  
                  <tr>
                    <td>{{ $i }} </td>
                    <td>{{ $act->log_name  }}</td>
                    <td>{{ $act->description  }}</td>
                    <td>{{ $act->subject_type   }}</td>
                    <td>{{ $act->event   }}</td>
                    <td>@php $data = json_decode($act->properties, true);  ; if(isset($data)) echo (isset($data["first_name"])?"Name:".$data["first_name"]:""); echo (isset($data["ip"])?"<br> IP:".$data["ip"]:"");
                    echo (isset($data["event"])?"<br> Event:".$data["event"]:""); @endphp</td>
                    <td>
                      {{ $act->created_at?date("d/m/Y H:i:s",strtotime($act->created_at)):""   }}
                    </td>
                  </tr>
                    @php $i++;@endphp
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
    
  </script>
  @endpush




