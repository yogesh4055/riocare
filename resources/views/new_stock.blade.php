@extends("layouts.app")
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row page-heading">
                <div class="col-12 col-lg-8 mb-xl-0 align-self-center align-items-center">
                    <h4 class="font-weight-bold d-flex"><i class="menu-icon" data-feather="package"></i>Finished Goods Inward (Annexure - I) - New Stock</h4>
                </div>
                <div class="col-12 col-lg-2 ml-auto align-self-center align-items-end text-right">
                    <a href="{{ route('new_stock_add') }}" class="btn btn-md btn-primary">Add New +</a>
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
                <div class="table-responsive">
                    <table class="table table-hover table-bordered datatable">
                        <thead>
                            <tr>
                                <th rowspan="2">Date</th>
                                <th rowspan="2">Product Name</th>
                                <th rowspan="2">Batch No</th>
                                <th rowspan="2">Grade</th>
                                <th rowspan="2">Viscosity</th>
                                <th rowspan="2">Mfg. Date</th>
                                <th rowspan="2">Expiry Retest Date</th>
                                <th colspan="5">Total No. of Drumbs</th>
                                <th rowspan="2">Total Quantity (Kg.)</th>
                                <th rowspan="2">AR No./Date</th>
                                <th rowspan="2">Approval Date</th>
                                <th rowspan="2">Received by</th>
                                <th rowspan="2">Action</th>
                            </tr>
                            <tr>
                                <th>200 Kg</th>
                                <th>50 Kg</th>
                                <th>30 Kg</th>
                                <th>5 Kg</th>
                                <th>Fiber board</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($inward_goods))
                            @foreach($inward_goods as $temp)
                            <tr>
                                <td>{{$temp->created_at?date("Y-m-d",strtotime($temp->created_at)):""}}</td>
                                <td>{{$temp->material_name}}</td>
                                <td>{{$temp->batch_no}}</td>
                                <td>{{$temp->grade}}</td>
                                <td>{{$temp->viscosity}}</td>

                                <td>{{$temp->mfg_date}}</td>
                                <td>{{$temp->expiry_ratest_date}}</td>
                                <td>{{number_format($temp->total_no_of_200kg_drums,3,".","")}}</td>
                                <td>{{number_format($temp->total_no_of_50kg_drums,3,".","")}}</td>
                                <td>{{number_format($temp->total_no_of_30kg_drums,3,".","")}}</td>
                                <td>{{number_format($temp->total_no_of_5kg_drums,3,".","")}}</td>
                                <td>{{number_format($temp->total_no_of_fiber_board_drums,3,".","")}}</td>
                                <td>{{number_format($temp->total_quantity,3,".","")}}</td>
                                <td>{{$temp->ar_no}}/{{$temp->ar_no_date!='0000-00-00 00:00:00'?date("d/m/Y",strtotime($temp->ar_no_date)):""}}</td>
                                <td>{{$temp->approval_data}}</td>
                                <td>{{$temp->name}}</td>
                                <td>
                                    <a class="actions"><a href="#" class="btn action-btn" data-toggle="modal" data-target="#viewnewstock" title="View" onclick="viewstock({{$temp->id}})"><i data-feather="eye"></i></a>

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
    <div class="modal fade show" id="viewnewstock" tabindex="-1" aria-labelledby="checkQuntityLabel" aria-modal="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="checkQuntityLabel">New Stock Details</h5>
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
        $('.datatable').DataTable({
        "order": [[ 0, "desc" ]]
    } );


        function viewstock(id) {
            $.ajax({
                url: '{{route("viewstock")}}',
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
