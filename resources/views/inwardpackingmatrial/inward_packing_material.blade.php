@extends("layouts.app")
@section("title","Inword Packing Material")
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row page-heading">
                <div class="col-12 col-lg-8 mb-xl-0 align-self-center align-items-center">
                    <h4 class="font-weight-bold d-flex"><i class="menu-icon" data-feather="package"></i>Goods Receipt Note (Annexure - IV) (Packing Material)</h4>
                </div>
                <div class="col-12 col-lg-2 ml-auto align-self-center align-items-end text-right">
                    <a href="{{route('inwardpackingrawmaterial-new')}}" class="btn btn-md btn-primary">Add New +</a>
                </div>
            </div>
        </div>

        <div class="card main-card">
            <div class="card-body">

                <div class="filter">
                    <h3>Filter</h3>
                    <form id="inward_packing_material" name="inward_packing_material" method="get" action="">
                        <div class="form-row">
                            <div class="col-12 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <input type="date" class="form-control calendar" name="ReceiptDate" id="ReceiptDate" placeholder="Date of Receipt">

                                </div>
                            </div>
                            {{-- <div class="col-12 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="ReceiptNo" id="ReceiptNo" placeholder="Receipt No.">

                                </div>
                            </div> --}}

                            <div class="col-12 col-md-6 col-lg-3">
                                <div class="form-group">
                                    {{ Form::select("manufacturer",$manufacturer,old("manufacturer"),array("class"=>"form-control select","id"=>"manufacturer","placeholder"=>"Name of Manufacturer")) }}

                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3">
                                <div class="form-group">
                                    {{ Form::select("supplier",$supplier,old("supplier"),array("class"=>"form-control select","id"=>"supplier","placeholder"=>"Name of Supplier")) }}

                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="invoiceNo" id="invoiceNo" placeholder="invoice No.">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3">
                                <button type="submit" class="btn btn-primary">Search</button>
                                <button type="submit"  id="btnClear"class="btn btn-primary">clear</button>
                            </div>

                        </div>
                    </form>
                </div>
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
                                <th>Sr.No.</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Date of Receipt</th>
                               <!-- <th>Ar No./Date</th> -->
                                <th>Packing Material Name</th>
                                <th>Name of Manufacturer</th>
                                <th>Name of Supplier</th>
                                <th>Invoice No./ Challan</th>
                                <th>Quantity</th>
                                <th>GRN</th>
                                <th>Checked by</th>
                                <th>Action</th>
                            </tr>
                        </thead>

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
                    <h5 class="modal-title" id="checkQuntityLabel">Inward Packing Rawmeterial Details</h5>
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
            var table = $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                drawCallback: function(settings) {
                    feather.replace();
                },
                ajax: {
                    "url": "{{route('inwardpackingrawmaterial-listAjax')}}",
                    "type": "POST",
                    "dataType": "json",
                    'data': function(data) {
                        // Read values
                        var rcdate = $('#ReceiptDate').val();
                        var ReceiptNo = $('#ReceiptNo').val();
                        var manufacturer = $('#manufacturer').val();
                        var supplier = $('#supplier').val();
                        var invoiceNo = $('#invoiceNo').val();


                        // Append to data
                        data.rcdate = rcdate;
                        data.ReceiptNo = ReceiptNo;
                        data.manufacturer = manufacturer;
                        data.supplier = supplier;
                        data.invoiceNo = invoiceNo;
                        data._token = '{{csrf_token()}}';

                        feather.replace()
                    }

                },

                columns: [{
                        "data": "id"
                    },

                    {
                        "data": "from",
                        "orderable": true
                    },
                    {
                        "data": "to",
                        "orderable": true
                    },
                    {
                        "data": "date_of_receipt",
                        "orderable": true
                    }/*,
                    {
                        "data": "arno_date",
                        "orderable": false
                    }*/,
                    {
                        "data": "material_name",
                        "orderable": false
                    },
                    {
                        "data": "manufacturer",
                        "orderable": false
                    },
                    {
                        "data": "supplier",
                        "orderable": false
                    },
                    {
                        "data": "invoice_no",
                        "orderable": true
                    },
                    {
                        "data": "qty",
                        "orderable": true
                    },

                    {
                        "data": "goods_receipt_no",
                        "orderable": true
                    },
                    {
                        "data": "submited_by",
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

            $('#ReceiptNo').keyup(function() {
                table.draw();
            });

            $('#manufacturer').change(function() {
                table.draw();
            });
            $('#supplier').change(function() {
                table.draw();
            });
            $('#invoiceNo').keyup(function() {
                table.draw();
            });
            $('#btnClear').click(function(){
        $('#ReceiptNo').val();
        $('#manufacturer').val('');
        $('#supplier').val('');
        $('#invoiceNo').val('');

     })

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

        function viewrawmatrial(id) {
            $.ajax({
                url: '{{route("inwardpackingrawmaterial-view")}}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                datatype: 'json',
                method: "POST"
            }).done(function(html) {

                $(".modal-body").html(html.html);
            });
        }
    </script>
    @endpush
