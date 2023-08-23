@extends("layouts.app")
@section("title","Packing Details")
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row page-heading">
                <div class="col-12 col-lg-8 mb-xl-0 align-self-center align-items-center">
                    <h4 class="font-weight-bold d-flex"><i class="menu-icon" data-feather="tool"></i>Batch Manufacturing Records - Packing</h4>
                </div>
                <div class="col-12 col-lg-2 ml-auto align-self-center align-items-end text-right">
                    <a href="{{route('add-manufacturing-record-Packing')}}" class="btn btn-md btn-primary">Add New +</a>
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
                            <input type="date" class="form-control" id="ReceiptDate" placeholder="Date of Receipt">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="form-group">
                            <input type="text" class="form-control" id="ReceiptNo" placeholder="Batch No.">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="form-group">
                            <input type="text" class="form-control" id="MaterialName" placeholder="Product Name">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <button type="search" class="btn btn-primary">Search</button>
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

                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Sr.No.</th>
                            <th>Product Name</th>
                            <th>Batch No.</th>
                            <th>BMR No.</th>
                            <th>Ref MFR No.</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($packing_detail))
                        @foreach($packing_detail as $temp)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$temp->material_name}}</td>
                            <td>{{$temp->bmrNo}}</td>
                            <td>{{$temp->batchNo}}</td>
                            <td>{{$temp->refMfrNo}}</td>
                            <td>{{$temp->ManufacturerDate}}</td>
                            <td class="actions"><a href="#" class="btn action-btn" data-tooltip="tooltip" title="View" data-toggle="modal" data-target="#viewDetail"><i data-feather="eye"></i></a><a href="#" class="btn action-btn" data-tooltip="tooltip" title="Edit"><i data-feather="edit-3"></i></a></td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="row mt-3">
                <div class="col-sm-12 col-md-5">
                    <div class="dataTables_length" id="example_length"><label>Show <select name="example_length" aria-controls="example" class="custom-select custom-select-sm form-control form-control-sm">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select> entries</label></div>
                </div>
                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers" id="example_paginate">
                        <ul class="pagination">
                            <li class="paginate_button page-item previous disabled" id="example_previous"><a href="#" aria-controls="example" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
                            <li class="paginate_button page-item active"><a href="#" aria-controls="example" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                            <li class="paginate_button page-item "><a href="#" aria-controls="example" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                            <li class="paginate_button page-item next" id="example_next"><a href="#" aria-controls="example" data-dt-idx="3" tabindex="0" class="page-link">Next</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="viewDetail" tabindex="-1" aria-labelledby="checkQuntityLabel" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkQuntityLabel">View Line Clearance Record</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                <div class="form-row form-detail">
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label>PRODUCT NAME</label>
                            <h4>Simethicone (Filix-110)</h4>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label>BMR NO.</label>
                            <h4>RCIPL/BMR/Flx-2300/09</h4>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label>BATCH NO.</label>
                            <h4>RFLX 20/668</h4>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label>REF MFR NO.</label>
                            <h4>RCIPL/MFR/01/017</h4>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label>DATE</label>
                            <h4>16/05/2021</h4>
                        </div>
                    </div>

                </div>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Process</th>
                            <th>Observation</th>
                            <th>Start Time (Hrs)</th>
                            <th>End Time (Hrs)</th>
                            <th>Done by</th>
                            <th>Checked by</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Area cleanliness checked by Production</td>
                            <td>Clean</td>
                            <td>15:10</td>
                            <td>15:10</td>
                            <td>Employee Name</td>
                            <td>Employee Name</td>
                        </tr>
                        <tr>
                            <td>Temperature ( <sup>o</sup>C) of Filling area</td>
                            <td>25.5</td>
                            <td>15:10</td>
                            <td>15:10</td>
                            <td>Employee Name</td>
                            <td>Employee Name</td>
                        </tr>
                        <tr>
                            <td>Humidity (%RH) of Filling area</td>
                            <td>53.2</td>
                            <td>15:10</td>
                            <td>15:10</td>
                            <td>Employee Name</td>
                            <td>Employee Name</td>
                        </tr>
                        <tr>
                            <td>Temperature ( <sup>o</sup>C) of Product</td>
                            <td>51</td>
                            <td>15:10</td>
                            <td>15:10</td>
                            <td>Employee Name</td>
                            <td>Employee Name</td>
                        </tr>
                        <tr>
                            <td rowspan="2">No. of Drums filled</td>
                            <td>Humidity (%RH)</td>
                            <td>50Kg - 40</td>
                            <td>200Kg - NA</td>
                            <td>Employee Name</td>
                            <td>Employee Name</td>
                        </tr>
                        <tr>
                            <td>Humidity (%RH)</td>
                            <td>15:10</td>
                            <td>15:10</td>
                            <td>Employee Name</td>
                            <td>Employee Name</td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-row form-detail">
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label>RM Input (Kg.)</label>
                            <h4>2003</h4>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label>FG Output</label>
                            <h4>2002</h4>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label>Filled in Drums (Kg)</label>
                            <h4>2000</h4>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label>Excess filled in drums</label>
                            <h4>1.900</h4>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label>QC Sampling (Kg.)</label>
                            <h4>0.200</h4>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label>Stability Sample (Kg.)</label>
                            <h4>-</h4>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label>Working Slandered</label>
                            <h4>-</h4>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label>Validation Sample</label>
                            <h4>-</h4>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label>Filled in Jerry can / Drum (Kg.) (Customer Sample)</label>
                            <h4>-</h4>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label>Actual Yield [(Output/Input)*100]</label>
                            <h4>99.94%</h4>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label>Checked By</label>
                            <h4>Employee Name</h4>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label>Approved By</label>
                            <h4>Employee Name</h4>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Note / Remark</label>
                            <p>Lorem Impsum</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push("scripts")
<script>
    feather.replace()
    /*$(document).ready(function() {
    var c = 1;
    $(".add-more").click(function(){
    var html = $(".copy").html();
    $(".after-add-more").after(html);
    });
    $("body").on("click",".remove",function(){
    $(this).parents(".add-more-new").remove();
    });
    });*/
    $(document).ready(function() {
        var max_fields = 15; //maximum input boxes allowed
        var wrapper = $(".input_fields_wrap"); //Fields wrapper
        var add_button = $(".add_field_button"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function(e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div class="row add-more-wrap add-more-new m-0 mb-4"><span class="add-count">' + x + '</span><div class="input-group-btn"><button class="btn btn-danger remove_field" type="button"><i class="icon-remove" data-feather="x"></i></button></div><div class="col-12 col-md-6"><div class="form-group"><label for="packingMaterialName[' + x + ']">Packing Material Name</label><select class="form-control select" id="packingMaterialName[' + x + ']"><option>Select Material Name</option></select></div></div><div class="col-12 col-md-6"><div class="form-group"><label for="Quantity[' + x + ']">Total Quantity Received (Nos.)</label><input type="text" class="form-control" id="Quantity[' + x + ']" placeholder="Quantity"></div></div><div class="col-12 col-md-6"><div class="form-group"><label for="ARNo[' + x + ']">AR No. / Date</label><input type="text" class="form-control" id="ARNo[' + x + ']" placeholder="AR No. / Date"></div></div></div>'); //add input box
            }
            feather.replace()
        });

        $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
            e.preventDefault();
            $(this).parents('div.row').remove();
            x--;
        })
    });
</script>
@endpush
