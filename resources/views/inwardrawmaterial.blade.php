@extends("layouts.app")
@section("title","Goods Receipt Note")
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row page-heading">
                <div class="col-12 col-lg-8 mb-xl-0 align-self-center align-items-center">
                    <h4 class="font-weight-bold d-flex"><i class="menu-icon" data-feather="package"></i>Goods Receipt Note (Annexure - IV)
                    </h4>
                </div>
                <div class="col-12 col-lg-2 ml-auto align-self-center align-items-end text-right">
                    <a href="{{ route('inward-rawmaterials_add') }}" class="btn btn-md btn-primary">Add New +</a>
                </div>
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
                @if ($message = Session::get('error'))
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
                            <th rowspan="2">Sr.No</th>
                            <th rowspan="2">Date of Receipt</th>

                            <th rowspan="2">Name of Manufacturer</th>
                            <th rowspan="2">Name of Supplier</th>
                            <th rowspan="2">Raw Material Name</th>
                            <th rowspan="2">Invoice Number</th>
                            <th rowspan="2">GRN</th>
                            <th rowspan="2">Viscosity</th>
                           <th rowspan="2">Ar No./Date</th>
                            <th rowspan="2">Total Quantity (Kg.)</th>
                            <th rowspan="2">Pack Size</th>
                            <th rowspan="2">Batch No.</th>
                            <th colspan="2">Manufacturer’s</th>
                            <th rowspan="2">RioCars’s Expiry / Retest Date</th>
                            <th rowspan="2">Action</th>
                        </tr>
                        <tr>
                            <th>Mfg. Date</th>
                            <th>Expiry / Retest Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($inward_material))
                        @php $i=1; @endphp
                        @foreach($inward_material as $temp)
                        <tr>

                        <td>{{$i}}</td>
                        <td>{{$temp->date_of_receipt != "0000-00-00 00:00:00"?date("d/m/Y",$temp->date_of_receipt):""}}</td>

                        <td>{{$temp->man_name}}</td>
                        <td>{{$temp->name}}</td>
                        <td>{{$temp->material_name}}</td>
                        <td>{{$temp->invoice_no}}</td>
                        <td>{{$temp->goods_receipt_no}}</td>
                        <td>{{$temp->viscosity}}</td>
                        <td>{{$temp->ar_no_date}}/{{$temp->ar_no_date_date != "0000-00-00 00:00:00"?date("d/m/Y",strtotime($temp->ar_no_date_date)):""}}</td>
                        <td>{{$temp->qty_received_kg}}</td>
                        <td>{{$temp->mesurment}}</td>
                        <td>{{$temp->batch_no}}</td>
                        <td>{{$temp->mfg_date!=""?date("d/m/Y",($temp->mfg_date)):""}}</td>
                        <td>{{$temp->mfg_expiry_date!=""?date("d/m/Y",($temp->mfg_expiry_date)):""}}</td>
                        <td>{{$temp->rio_care_expiry_date!=""?date("d/m/Y",($temp->rio_care_expiry_date)):""}}</td>
                        <td class="actions"><a href="#" class="btn action-btn" data-toggle="modal" data-target="#viewsupplier" title="View" onclick="viewsupp({{$temp->itemid}})"><i data-feather="eye"></i></a>
                            <a href="{{url('inward-rawmaterials_edit/'.$temp->itemid)}}" class="btn action-btn"  title="Edit"><i data-feather="edit-3"></i></a></td>

                            
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
@push("models")
  <div class="modal fade show" id="viewsupplier" tabindex="-1" aria-labelledby="checkQuntityLabel" aria-modal="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="checkQuntityLabel">Inward Material Details</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">x</button>
      </div>
      <div class="modal-body">

      </div>
    </div>
  </div>
</div>
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
        $('.datatable').DataTable();
    });
    function viewsupp(id)
    {
       $.ajax({
         url:'{{route("show-material")}}',
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

