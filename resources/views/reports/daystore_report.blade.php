@extends("layouts.app")
@section("title","Day Store Report")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row page-heading">
                <div class="col-12 col-lg-8 mb-xl-0 align-self-center align-items-center">
                    <h4 class="font-weight-bold d-flex"><i class="menu-icon" data-feather="package"></i>Day Store Report
                    </h4>
                </div>
            </div>
        </div>
    </div>
    <div class="card main-card">
        <div class="card-body">
            <div class="tbl-sticky">
                <div class="table-responsive">
                    <div class="col-md-12">
                        @if ($message = Session::get('success'))
                        <div class="alert alert-info alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                        @endif
                    </div>
                    <table class="table table-hover table-bordered datatable11">
                       <thead>
                        <tr>
                            <th>Sr.No.</th>
                            <th>Requisition Material Name</th>
                            <th>Batch No.</th>
                            <th>AR No.</th>
                            <th>Pre Req Quantity</th>
                            <th>Approved Quantity</th>
                            <th>Used Quantity</th>
                            <th>Remain Quantity</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if(isset($day_store))
                            @php $i=1; @endphp
                                @foreach($day_store as $key => $temp)
                                @if($temp->return_to_warehouse != 1)
                                <tr>
                                    <td>{{$i++}} </td>
                                    <td>{{$temp['material_name']}} </td>
                                    <td>{{$temp['batch_no']}}</td>
                                    <td>{{$temp['ar_no_date']}}</td>
                                    <td>{{$temp['requesist_qty']}}</td>
                                    <td>{{$temp['approved_qty']}}</td>
                                    <td>{{$temp['used_qty']}}</td>
                                    <td>{{$temp['approved_qty'] - $temp['used_qty'] }}</td>
                                    <td><a title="Return to WareHouse" class="return-to-warehouse" data-id="{{$temp['id']}}"><i class="fa fas fa-recycle" style="font-size:22px;"></i></td>
                                </tr>
                                @endif
                                @endforeach
                            
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push("models")
  <div class="modal fade show" id="viewsupplier" tabindex="-1" aria-labelledby="checkQuntityLabel" aria-modal="true">
  <div class="modal-dialog modal-sm">
    <form id="form-delete-tag" role="form" method="POST" action="{{ route("return_warehouse") }}" novalidate> 
      <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
        <div class="modal-content">
          <div class="modal-header text-center">
            <h5 class="modal-title" id="delete-tag-modal-label"></h5>
          </div>
          <div class="modal-body">
            <input type="hidden" id="id" name="id">
            <h5>Are you sure to Return to WareHouse ?</h5>
          </div>
          <div class="modal-footer text-center">
            <input type="submit" class="btn btn-primary br-25" value="Yes">
            <a href="/" class="btn btn-warning br-25" data-dismiss="modal">No</a> 
          </div>
        </div>
      </form>
  </div>
</div>
<!-- <div class="loader"></div> -->
<!-- <img src="{{asset('assets/img/loader.gif')}}" class="loader" id="img" style="display:none"/ > -->
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
      //feather.replace()
    $(document).ready(function() {
        $('.datatable11').DataTable();

    $(document).on('click', '.return-to-warehouse', function(ev) {
        //ev.preventDefault();    
        var type_id = $(this).data('id'); 
        $('#id').val(type_id);
        $('#viewsupplier').modal('show');
      })
    // $(document).on('click', '.sub-btn', function(ev) {
    //     ev.preventDefault();    
    //     $('#viewsupplier').modal('hide');
    //     // $('.loader').show(); 
    //   })

    });
    
</script>

@endpush

