@extends("layouts.app")
@section("title","Add Lots")
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row page-heading">
                <div class="col-12 col-lg-8 mb-xl-0 align-self-center align-items-center">
                    <h4 class="font-weight-bold d-flex"><i class="menu-icon" data-feather="tool"></i>Batch Manufacturing Records - Line Clearance Record</h4>
                </div>
                <!-- <div class="col-12 col-lg-2 ml-auto align-self-center align-items-end text-right"> -->
                <!-- <a href="add-batch-manufacturing-line-clearance-record.html" class="btn btn-md btn-primary">Add New +</a> -->
                <!-- </div> -->
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
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Sr.No.</th>
                            <th>Product Name</th>
                            <th>Batch No.</th>
                            <th>BMR No.</th>
                            <th>Ref MFR No.</th>
                            <th>Lot 1</th>
                            <th>Lot 2</th>
                            <th>Lot 3</th>
                            <th>Lot 4</th>
                            <th>Lot 5</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Simethicone (Filix-110)</td>
                            <td>RFLX 20/668</td>
                            <td>RCIPL/BMR/Flx-2300/09</td>
                            <td>RCIPL/MFR/01/017</td>
                            <td><a href="{{url('add-batch-manufacturing-record-add-lot')}}" class="btn btn-sm btn-success">View</a></td>
                            <td><a href="{{url('add-batch-manufacturing-record-add-lot2')}}" class="btn btn-sm btn-success">View</a></td>
                            <td><a href="{{url('add-batch-manufacturing-record-add-lot3')}}" class="btn btn-sm btn-dark">Add</a></td>
                            <td><a href="{{url('add-batch-manufacturing-record-add-lot4')}}" class="btn btn-sm btn-dark">Add</a></td>
                            <td><a href="{{url('add-batch-manufacturing-record-add-lot5')}}" class="btn btn-sm btn-dark disabled">Add</a></td>
                            <td class="actions"><a href="#" class="btn action-btn" data-tooltip="tooltip" title="View"><i data-feather="eye"></i></a><a href="#" class="btn action-btn" data-tooltip="tooltip" title="Check Quantity"><i data-feather="check"></i></a></td>
                        </tr>
                        <!-- <tr>
                            <td>2</td>
                            <td>Simethicone (Filix-110)</td>
                            <td>RFLX 20/668</td>
                            <td>RCIPL/BMR/Flx-2300/09</td>
                            <td>RCIPL/MFR/01/017</td>
                            <td><a href="add-batch-manufacturing-record-add-lot.html" class="btn btn-sm btn-success">View</a></td>
                            <td><a href="add-batch-manufacturing-record-add-lot2.html" class="btn btn-sm btn-success">View</a></td>
                            <td><a href="add-batch-manufacturing-record-add-lot3.html" class="btn btn-sm btn-success">View</a></td>
                            <td><a href="add-batch-manufacturing-record-add-lot4.html" class="btn btn-sm btn-success">View</a></td>
                            <td><a href="add-batch-manufacturing-record-add-lot5.html" class="btn btn-sm btn-dark">Add</a></td>
                            <td class="actions"><a href="#" class="btn action-btn" data-tooltip="tooltip" title="View"><i data-feather="eye"></i></a><a href="#" class="btn action-btn" data-tooltip="tooltip" title="Check Quantity"><i data-feather="check"></i></a></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Simethicone (Filix-110)</td>
                            <td>RFLX 20/668</td>
                            <td>RCIPL/BMR/Flx-2300/09</td>
                            <td>RCIPL/MFR/01/017</td>
                            <td><a href="add-batch-manufacturing-record-add-lot.html" class="btn btn-sm btn-success">View</a></td>
                            <td><a href="add-batch-manufacturing-record-add-lot2.html" class="btn btn-sm btn-success">View</a></td>
                            <td><a href="add-batch-manufacturing-record-add-lot3.html" class="btn btn-sm btn-dark">Add</a></td>
                            <td><a href="add-batch-manufacturing-record-add-lot4.html" class="btn btn-sm btn-dark">Add</a></td>
                            <td><a href="add-batch-manufacturing-record-add-lot5.html" class="btn btn-sm btn-dark disabled">Add</a></td>
                            <td class="actions"><a href="#" class="btn action-btn" data-tooltip="tooltip" title="View"><i data-feather="eye"></i></a><a href="#" class="btn action-btn" data-tooltip="tooltip" title="Check Quantity"><i data-feather="check"></i></a></td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Simethicone (Filix-110)</td>
                            <td>RFLX 20/668</td>
                            <td>RCIPL/BMR/Flx-2300/09</td>
                            <td>RCIPL/MFR/01/017</td>
                            <td><a href="add-batch-manufacturing-record-add-lot.html" class="btn btn-sm btn-success">View</a></td>
                            <td><a href="add-batch-manufacturing-record-add-lot2.html" class="btn btn-sm btn-success">View</a></td>
                            <td><a href="add-batch-manufacturing-record-add-lot3.html" class="btn btn-sm btn-dark">Add</a></td>
                            <td><a href="add-batch-manufacturing-record-add-lot4.html" class="btn btn-sm btn-dark">Add</a></td>
                            <td><a href="add-batch-manufacturing-record-add-lot5.html" class="btn btn-sm btn-dark disabled">Add</a></td>
                            <td class="actions"><a href="#" class="btn action-btn" data-tooltip="tooltip" title="View"><i data-feather="eye"></i></a><a href="#" class="btn action-btn" data-tooltip="tooltip" title="Check Quantity"><i data-feather="check"></i></a></td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Simethicone (Filix-110)</td>
                            <td>RFLX 20/668</td>
                            <td>RCIPL/BMR/Flx-2300/09</td>
                            <td>RCIPL/MFR/01/017</td>
                            <td><a href="add-batch-manufacturing-record-add-lot.html" class="btn btn-sm btn-success">View</a></td>
                            <td><a href="add-batch-manufacturing-record-add-lot2.html" class="btn btn-sm btn-success">View</a></td>
                            <td><a href="add-batch-manufacturing-record-add-lot3.html" class="btn btn-sm btn-dark">Add</a></td>
                            <td><a href="add-batch-manufacturing-record-add-lot4.html" class="btn btn-sm btn-dark">Add</a></td>
                            <td><a href="add-batch-manufacturing-record-add-lot5.html" class="btn btn-sm btn-dark disabled">Add</a></td>
                            <td class="actions"><a href="#" class="btn action-btn" data-tooltip="tooltip" title="View"><i data-feather="eye"></i></a><a href="#" class="btn action-btn" data-tooltip="tooltip" title="Check Quantity"><i data-feather="check"></i></a></td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Simethicone (Filix-110)</td>
                            <td>RFLX 20/668</td>
                            <td>RCIPL/BMR/Flx-2300/09</td>
                            <td>RCIPL/MFR/01/017</td>
                            <td><a href="add-batch-manufacturing-record-add-lot.html" class="btn btn-sm btn-success">View</a></td>
                            <td><a href="add-batch-manufacturing-record-add-lot2.html" class="btn btn-sm btn-success">View</a></td>
                            <td><a href="add-batch-manufacturing-record-add-lot3.html" class="btn btn-sm btn-dark">Add</a></td>
                            <td><a href="add-batch-manufacturing-record-add-lot4.html" class="btn btn-sm btn-dark">Add</a></td>
                            <td><a href="add-batch-manufacturing-record-add-lot5.html" class="btn btn-sm btn-dark disabled">Add</a></td>
                            <td class="actions"><a href="#" class="btn action-btn" data-tooltip="tooltip" title="View"><i data-feather="eye"></i></a><a href="#" class="btn action-btn" data-tooltip="tooltip" title="Check Quantity"><i data-feather="check"></i></a></td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Simethicone (Filix-110)</td>
                            <td>RFLX 20/668</td>
                            <td>RCIPL/BMR/Flx-2300/09</td>
                            <td>RCIPL/MFR/01/017</td>
                            <td><a href="add-batch-manufacturing-record-add-lot.html" class="btn btn-sm btn-success">View</a></td>
                            <td><a href="add-batch-manufacturing-record-add-lot2.html" class="btn btn-sm btn-success">View</a></td>
                            <td><a href="add-batch-manufacturing-record-add-lot3.html" class="btn btn-sm btn-dark">Add</a></td>
                            <td><a href="add-batch-manufacturing-record-add-lot4.html" class="btn btn-sm btn-dark">Add</a></td>
                            <td><a href="add-batch-manufacturing-record-add-lot5.html" class="btn btn-sm btn-dark disabled">Add</a></td>
                            <td class="actions"><a href="#" class="btn action-btn" data-tooltip="tooltip" title="View"><i data-feather="eye"></i></a><a href="#" class="btn action-btn" data-tooltip="tooltip" title="Check Quantity"><i data-feather="check"></i></a></td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>Simethicone (Filix-110)</td>
                            <td>RFLX 20/668</td>
                            <td>RCIPL/BMR/Flx-2300/09</td>
                            <td>RCIPL/MFR/01/017</td>
                            <td><a href="add-batch-manufacturing-record-add-lot.html" class="btn btn-sm btn-success">View</a></td>
                            <td><a href="add-batch-manufacturing-record-add-lot2.html" class="btn btn-sm btn-success">View</a></td>
                            <td><a href="add-batch-manufacturing-record-add-lot3.html" class="btn btn-sm btn-dark">Add</a></td>
                            <td><a href="add-batch-manufacturing-record-add-lot4.html" class="btn btn-sm btn-dark">Add</a></td>
                            <td><a href="add-batch-manufacturing-record-add-lot5.html" class="btn btn-sm btn-dark disabled">Add</a></td>
                            <td class="actions"><a href="#" class="btn action-btn" data-tooltip="tooltip" title="View"><i data-feather="eye"></i></a><a href="#" class="btn action-btn" data-tooltip="tooltip" title="Check Quantity"><i data-feather="check"></i></a></td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>Simethicone (Filix-110)</td>
                            <td>RFLX 20/668</td>
                            <td>RCIPL/BMR/Flx-2300/09</td>
                            <td>RCIPL/MFR/01/017</td>
                            <td><a href="add-batch-manufacturing-record-add-lot.html" class="btn btn-sm btn-success">View</a></td>
                            <td><a href="add-batch-manufacturing-record-add-lot2.html" class="btn btn-sm btn-success">View</a></td>
                            <td><a href="add-batch-manufacturing-record-add-lot3.html" class="btn btn-sm btn-dark">Add</a></td>
                            <td><a href="add-batch-manufacturing-record-add-lot4.html" class="btn btn-sm btn-dark">Add</a></td>
                            <td><a href="add-batch-manufacturing-record-add-lot5.html" class="btn btn-sm btn-dark disabled">Add</a></td>
                            <td class="actions"><a href="#" class="btn action-btn" data-tooltip="tooltip" title="View"><i data-feather="eye"></i></a><a href="#" class="btn action-btn" data-tooltip="tooltip" title="Check Quantity"><i data-feather="check"></i></a></td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>Simethicone (Filix-110)</td>
                            <td>RFLX 20/668</td>
                            <td>RCIPL/BMR/Flx-2300/09</td>
                            <td>RCIPL/MFR/01/017</td>
                            <td><a href="add-batch-manufacturing-record-add-lot.html" class="btn btn-sm btn-success">View</a></td>
                            <td><a href="add-batch-manufacturing-record-add-lot2.html" class="btn btn-sm btn-success">View</a></td>
                            <td><a href="add-batch-manufacturing-record-add-lot3.html" class="btn btn-sm btn-dark">Add</a></td>
                            <td><a href="add-batch-manufacturing-record-add-lot4.html" class="btn btn-sm btn-dark">Add</a></td>
                            <td><a href="add-batch-manufacturing-record-add-lot5.html" class="btn btn-sm btn-dark disabled">Add</a></td>
                            <td class="actions"><a href="#" class="btn action-btn" data-tooltip="tooltip" title="View"><i data-feather="eye"></i></a><a href="#" class="btn action-btn" data-tooltip="tooltip" title="Check Quantity"><i data-feather="check"></i></a></td>
                        </tr> -->
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
                            <th>Sr.No.</th>
                            <th>Particulars</th>
                            <th>Observation</th>
                            <th>Time (Hrs)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Area Cleanliness Checked</td>
                            <td>Lorem ipsum</td>
                            <td>12:38</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Temperature(<sup>o</sup>C)</td>
                            <td>60</td>
                            <td>12:38</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Humidity (%RH)</td>
                            <td>90</td>
                            <td>12:38</td>
                        </tr>
                    </tbody>
                </table>
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
