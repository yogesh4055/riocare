@extends("layouts.app")
@section("title","New Batch")
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row page-heading">
                <div class="col-12 col-lg-8 mb-xl-0 align-self-center align-items-center">
                    <h4 class="font-weight-bold d-flex"><i class="menu-icon" data-feather="tool"></i>Batch Manufacturing Records</h4>
                </div>
                <div class="col-12 col-lg-2 ml-auto align-self-center align-items-end text-right">
                    <a href="{{route('add-batch-manufacturing-record')}}" class="btn btn-md btn-primary">Add New +</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card main-card">
        <div class="card-body">
            <div class="filter">
                <h3>Filter</h3>
                <div class="form-row">
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="form-group">
                            <input type="date" class="form-control" id="ReceiptDate" name="ReceiptDate" placeholder="Date of Receipt">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="form-group">
                            <input type="text" class="form-control" id="batchno" pattern="\d*" maxlength="12" name="batchno" placeholder="Batch No." onkeypress="return /[0-9a-zA-Z\s\\/-]/i.test(event.key)">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="form-group">
                            {!! Form::select("product", $product, old("product"), ["class"=>"form-control","placeholder"=>"Choose Product","id"=>"product"]) !!}
                            
                        </div>
                    </div>
                    
                </div>
            </div>
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
                <table class="table table-hover table-bordered datatable" id="example">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Date</th>
                            <th>Product Name</th>
                            <th>Batch No.</th>
                            <th>BMR No.</th>
                            <th>Ref MFR No.</th>
                            <th>Grade</th>
                            <th>Batch Size</th>
                            <th>Viscosity</th>

                            <th>Production Commenced on</th>
                            <th>Production Completed on</th>
                            <th>Manufacturing Date</th>
                            <th>Retest Date</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        
                       

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="viewDetail" tabindex="-1" aria-labelledby="checkQuntityLabel" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkQuntityLabel">View Batch Manufacturing Records
</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body data_push">

           </div>
        </div>
    </div>
</div>
@endsection
@push("scripts")
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('assets/mdbootstrap4/mdb.min.js')  }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('assets/js/custom.js')  }}"></script>
    <!-- End custom js for this page-->
  <script>
$(document).ready(function() {



function deleteConfirmation(id){
    alert(id);

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

swal({
    title: "Are you sure!",
    type: "error",
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Yes!",
    showCancelButton: true,
},
function() {
        $.ajax({
            type: "POST",
            url: 'add_btch_manufacture_delete',
            data:  {'_method':'DELETE', _token: CSRF_TOKEN,id:id},
            success: function (data) {
                swal(data.status,data.message);
                location.reload();
            }
          });
   });
}
});


function view(id){
   
   var id =id;
   var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  $.ajax({
 type: "post",
 url: 'add_btch_manufacture_view',
 data:  {'_method':'post', _token: CSRF_TOKEN,id:id},
 success: function (data) {
$('#viewDetail').modal('show');
  var str = '';
   str += '<div class="form-row form-detail">';
   str += '<div class="col-12 col-md-6 col-lg-6 col-xl-6">';
   str += '<div class="form-group">';
   str += '<label>Product Name</label>';
   str += '<h4>'+data.res.material_name+'</h4>';
   str += '</div></div>';
   str += '<div class="col-12 col-md-6 col-lg-6 col-xl-6">';
   str += '<div class="form-group">';
   str += '<label>BMR NO.</label>';
   str += ' <h4>'+data.res.bmrNo+'</h4>';
   str += '</div></div>';
   str += '<div class="col-12 col-md-6 col-lg-6 col-xl-6">';
   str += '<div class="form-group">';
   str += '<label>BATCH NO.</label>';
   str += '<h4>'+data.res.batchNo+'</h4>';
   str += '</div></div>';
   str += '<div class="col-12 col-md-6 col-lg-6 col-xl-6">';
   str += '<div class="form-group">';
   str += '<label>REF MFR NO.</label>';
   str += '<h4>'+data.res.refMfrNo+'</h4>';
   str += '</div></div>';
   str += '<div class="col-12 col-md-6 col-lg-6 col-xl-6">';
   str += '<div class="form-group">';
   str += '<label>Grade</label>';
   str += '<h4>'+data.res.grade+'</h4>';
   str += '</div></div>';
   str += '</div>';
   str += '<div class="form-row form-detail">';
   str += '<div class="col-12 col-md-6 col-lg-6 col-xl-6">';
   str += '<div class="form-group">';
   str += '<label>Batch Size</label>';
   str += '<h4>'+data.res.BatchSize+'</h4>';
   str += '</div></div>';
   str += '<div class="col-12 col-md-6 col-lg-6 col-xl-6">';
   str += '<div class="form-group">';
   str += '<label>Viscosity</label>';
   str += ' <h4>'+data.res.Viscosity+'</h4>';
   str += '</div></div>';
   str += '<div class="col-12 col-md-6 col-lg-6 col-xl-6">';
   str += '<div class="form-group">';
   str += '<label>Production Commenced on</label>';
   str += '<h4>'+data.res.ProductionCommencedon+'</h4>';
   str += '</div></div>';
   str += '<div class="col-12 col-md-6 col-lg-6 col-xl-6">';
   str += '<div class="form-group">';
   str += '<label>Production Completed on</label>';
   str += '<h4>'+data.res.ProductionCompletedon+'</h4>';
   str += '</div></div>';
   str += '<div class="col-12 col-md-6 col-lg-6 col-xl-6">';
   str += '<div class="form-group">';
   str += '<label>Manufacturing Date</label>';
   str += '<h4>'+data.res.ManufacturingDate+'</h4>';
   str += '</div></div>';
   str += '<div class="col-12 col-md-6 col-lg-6 col-xl-6">';
   str += '<div class="form-group">';
   str += '<label>Retest Date</label>';
   str += '<h4>'+data.res.RetestDate+'</h4>';
   str += '</div></div>';
   str += '<div class="col-12 col-md-6 col-lg-6 col-xl-6">';
   str += '<div class="form-group">';
   str += '<label>Prepared by</label>';
   str += '<h4>'+data.res.doneBy+'</h4>';
   str += '</div></div>';
   str += '<div class="col-12 col-md-6 col-lg-6 col-xl-6">';
   str += '<div class="form-group">';
   str += '<label>Checked By</label>';
   str += '<h4>'+data.res.checkedBy+'</h4>';
   str += '</div></div>';
   str += '<div class="col-12 col-md-6 col-lg-6 col-xl-6">';
   str += '<div class="form-group">';
   str += '<label>Reviewed and Approved by</label>';
   str += '<h4>'+data.res.checkedByI+'</h4>';
   str += '</div></div>';
   str += '<div class="col-12 col-md-6 col-lg-6 col-xl-6">';
   str += '<div class="form-group">';
   str += '<label>This Batch is approved/not approved</label>';
   str += '<h4>'+data.res.approval+'</h4>';
   str += '</div></div>';
   str += '</div>';
   str += '<div class="form-row form-detail">';
   str += '<div class="col-12 col-md-6 col-lg-6 col-xl-6">';
   str += '<div class="form-group">';
   str += '<label>Note / Remark</label>';
   str += '<h4>'+data.res.Remark+'</h4>';
   str += '</div></div>';
   str += '</div>';
   str+='</div>';
   $('.data_push').html(str);
 }
});
}

   </script>
   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" />
   <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
   <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

   <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

   <script>
    $(document).ready(function() {
            var table = $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                drawCallback: function(settings) {
                    feather.replace();
                },
                ajax: {
                    "url": "{{route('manufacturing-listAjax')}}",
                    "type": "POST",
                    "dataType": "json",
                    'data': function(data) {
                        // Read values
                        var rcdate = $('#ReceiptDate').val();
                        var batch_no = $('#batchno').val();
                        var product = $('#product').val();
                       


                        // Append to data
                        data.rcdate = rcdate;
                        data.batch_no = batch_no;
                        data.product = product;                        
                        data._token = '{{csrf_token()}}';

                        feather.replace()
                    }

                },

                columns: [{
                        "data": "id"
                    },

                    {
                        "data": "date",
                        "orderable": true
                    },
                    {
                        "data": "material_name",
                        "orderable": true
                    },
                    {
                        "data": "batchno",
                        "orderable": true
                    },
                    {
                        "data": "bmrno",
                        "orderable": true
                    },
                    {
                        "data": "refmfrno",
                        "orderable": true
                    },
                    {
                        "data": "grade",
                        "orderable": true
                    },
                    {
                        "data": "batchsize",
                        "orderable": true
                    },
                    {
                        "data": "viscosity",
                        "orderable": true
                    },

                    {
                        "data": "product_commence",
                        "orderable": true
                    },
                    {
                        "data": "product_completion",
                        "orderable": false
                    },
                    
                    {
                        "data": "manfuactring_date",
                        "orderable": false
                    },                                       
                    {
                        "data": "retest_date",
                        "orderable": false
                    },
                                        
                    {
                        "data": "status",
                        "orderable": false
                    },
                    {
                        "data": "action",
                        "orderable": false
                    }
                ]
            });
            $('#ReceiptDate').change(function() {
                table.draw();
            });

            $('#batchno').keyup(function() {
                table.draw();
            });

            $('#product').change(function() {
                table.draw();
            });
            $(function() {
$('input:text').keydown(function(e) {
if(e.keyCode==1)
    return false;

});
});
            
        });
</script>
@endpush
