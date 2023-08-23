@extends("layouts.app")
@section('title',"Edit Inward Packing Material")
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row page-heading">
                <div class="col-12 col-xl-8 mb-xl-0 align-self-center align-items-center">
                    <h4 class="font-weight-bold d-flex"><i class="menu-icon" data-feather="package"></i>Edit Goods Receipt Note (Annexure - IV)
                        (Packing Material)</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="card main-card">
        <div class="card-body">
            <form id="inward_packing_material" name="inward_packing_material" method="post" action="{{ route('inwardpackingrawmaterial-update') }}">
                @csrf
                <input type="hidden" name="id" value="{{$packingrawmaterial->id}}">
                <div class="form-row">
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="from">From</label>
                            {{ Form::select("received_from",$department,old("received_from")?old("received_from"):$packingrawmaterial->goods_going_from,array("class"=>"form-control select","id"=>"received_from","placeholder"=>"From")) }}

                            @if ($errors->has('dispath_no'))
                            <span class="text-danger">{{ $errors->first('received_from') }}</span>
                          @endif
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="to">TO</label>
                            {{ Form::select("received_to",$department,old("received_to")?old("received_to"):$packingrawmaterial->goods_going_to,array("class"=>"form-control select","id"=>"received_to","placeholder"=>"To")) }}

                            @if ($errors->has('received_to'))
                            <span class="text-danger">{{ $errors->first('received_to') }}</span>
                          @endif
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="receiptDate">Date of Receipt</label>
                            <input type="date" class="form-control calendar" name="date_of_receipt" id="date_of_receipt"  placeholder="DD-MM-YYYY" value="{{ $packingrawmaterial->date_of_receipt?date("Y-m-d",$packingrawmaterial->date_of_receipt):'' }}">
                            @if ($errors->has('date_of_receipt'))
                            <span class="text-danger">{{ $errors->first('date_of_receipt') }}</span>
                          @endif
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="ManufacturerName">Name of Manufacturer</label>
                            {{ Form::select("manufacturer",$manufacturer,old("manufacturer")?old("manufacturer"):$packingrawmaterial->manufacurer,array("class"=>"form-control select","id"=>"manufacturer","placeholder"=>"Name of Manufacturer")) }}
                            @if ($errors->has('manufacturer'))
                          <span class="text-danger">{{ $errors->first('manufacturer') }}</span>
                          @endif

                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="SupplierName">Name of Supplier</label>
                            {{ Form::select("supplier",$supplier,old("supplier")?old("supplier"):$packingrawmaterial->supplier,array("class"=>"form-control select","id"=>"manufacturer","placeholder"=>"Name of Supplier")) }}
                            @if ($errors->has('supplier'))
                          <span class="text-danger">{{ $errors->first('supplier') }}</span>
                          @endif
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="invoiceNo">Invoice No.</label>
                            <input type="text" class="form-control" name="invoice_no" id="invoice_no" placeholder="Invoice No" value="{{ $packingrawmaterial->invoice_no }}">
                            @if ($errors->has('invoice_no'))
                          <span class="text-danger">{{ $errors->first('invoice_no') }}</span>
                          @endif
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="receiptNo">Goods Receipt No.</label>
                            <input type="text" class="form-control" name="goods_receipt_no" id="goods_receipt_no" value="{{ $packingrawmaterial->goods_receipt_no }}" placeholder="GRM/RM/Receipt No.">
                            @if ($errors->has('goods_receipt_no'))
                          <span class="text-danger">{{ $errors->first('goods_receipt_no') }}</span>
                          @endif
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
						<div class="form-check">
                            <input type="checkbox" class="form-check-input" id="openingstockcheck" name="openingstock" id="openingstock" value="1" @if($packingrawmaterial->is_opening_stock ==1) checked='checked' @endif>
                            <label class="form-check-label" for="openingstockcheck">Is Opening Stock?</label>
						</div>
					</div>
                    @if(isset($packingrawmaterial->items))
                    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="form-group input_fields_wrap" id="MaterialReceived">
                            <label class="control-label d-flex">Details of Material Received 
                                <div class="input-group-btn"><br>
                                    <!--<button class="btn btn-dark add-more add_field_button" type="button">Add More +</button>-->
                                </div>
                            </label> <br>
                            @if(count($packingrawmaterial->items) >0)
                                @php $i=1; @endphp
                                @foreach ($packingrawmaterial->items as $val)
                                <input type="hidden" name="inward_pitem_id[]" value="{{$val->id}}">
                                <div class="row add-more-wrap after-add-more m-0 mb-4">
                                    <span class="add-count">{{ $i }}</span>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="packingMaterialName">Packing Material Name</label>
                                            {{ Form::select("material[]",$rawmaterial,isset(old("material")[0])?old("material")[0]:$val->material,array("class"=>"form-control select","id"=>"material","placeholder"=>"Name of Material")) }}
                                            @if ($errors->has('material'))
                                            <span class="text-danger">{{ $errors->first('material') }}</span>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="Quantity">Total Quantity Received (Nos.)</label>
                                            <input type="text" class="form-control" name="total_qty[]" id="total_qty" placeholder="Quantity" value="{{ isset(old("total_qty")[0])?old("total_qty")[0]:$val->total_qty }}">
                                            @if ($errors->has('total_qty'))
                                            <span class="text-danger">{{ $errors->first('total_qty') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <!--<div class="col-12 col-md-6">-->
                                    <!--    <div class="form-group">-->
                                    <!--        <label for="ARNo">AR No. / Date</label>-->
                                    <!--        <input type="text" class="form-control" name="ar_no_date[]" id="ar_no_date" placeholder="AR No. / Date" value="{{ isset(old("ar_no_date")[0])?old("ar_no_date")[0]:$val->ar_no_date }}">-->
                                    <!--        @if ($errors->has('ar_no_date'))-->
                                    <!--        <span class="text-danger">{{ $errors->first('ar_no_date') }}</span>-->
                                    <!--        @endif-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <!--<div class="col-12 col-md-6">-->
                                    <!--    <div class="form-group">-->
                                    <!--        <label for="ARNo">AR  Date</label>-->
                                    <!--        <input type="date" class="form-control" name="ar_no_datedate[]" id="ar_no_datedate" placeholder="AR Date" value=""{{ isset(old("ar_no_datedate")[0])?old("ar_no_datedate")[0]:$val->ar_no_datedate }}">-->
                                    <!--        @if ($errors->has('ar_no_datedate'))-->
                                    <!--        <span class="text-danger">{{ $errors->first('ar_no_datedate') }}</span>-->
                                    <!--        @endif-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    @php $i++; @endphp
                                    </div>
                                    @endforeach
                                  @else
                                  <div class="row add-more-wrap after-add-more m-0 mb-4">
                                    <span class="add-count">1</span>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="packingMaterialName">Packing Material Name</label>
                                            {{ Form::select("material[]",$rawmaterial,isset(old("material")[0])?old("material")[0]:"",array("class"=>"form-control select","id"=>"material","placeholder"=>"Name of Material")) }}
                                            @if ($errors->has('material'))
                                            <span class="text-danger">{{ $errors->first('material') }}</span>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="Quantity">Total Quantity Received (Nos.)</label>
                                            <input type="text" class="form-control" name="total_qty[]" id="total_qty" placeholder="Quantity" value="{{ isset(old("total_qty")[0])?old("total_qty")[0]:'' }}">
                                            @if ($errors->has('total_qty'))
                                            <span class="text-danger">{{ $errors->first('total_qty') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <!--<div class="col-12 col-md-6">-->
                                    <!--    <div class="form-group">-->
                                    <!--        <label for="ARNo">AR No. </label>-->
                                    <!--        <input type="text" class="form-control" name="ar_no_date[]" id="ar_no_date" placeholder="AR No." value=""{{ isset(old("ar_no_date")[0])?old("ar_no_date")[0]:'' }}">-->
                                    <!--        @if ($errors->has('ar_no_date'))-->
                                    <!--        <span class="text-danger">{{ $errors->first('ar_no_date') }}</span>-->
                                    <!--        @endif-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <!--<div class="col-12 col-md-6">-->
                                    <!--    <div class="form-group">-->
                                    <!--        <label for="ARNo">AR  Date</label>-->
                                    <!--        <input type="date" class="form-control" name="ar_no_datedate[]" id="ar_no_datedate" placeholder="AR Date" value=""{{ isset(old("ar_no_datedate")[0])?old("ar_no_datedate")[0]:'' }}">-->
                                    <!--        @if ($errors->has('ar_no_datedate'))-->
                                    <!--        <span class="text-danger">{{ $errors->first('ar_no_datedate') }}</span>-->
                                    <!--        @endif-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    </div>
                                  @endif
                        </div>
                    @endif
                    <div class="col-12">
                        <div class="form-group">
                            <label for="Remark">Note / Remark</label>
                            <textarea class="form-control" name="remark" id="remark" placeholder="Note / Remark">{{ $packingrawmaterial->remark }}</textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-md ml-0 form-btn">Submit</button>
                            <button type="reset" class="btn btn-light btn-md form-btn">Clear</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection
@push("scripts")
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
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
                $(wrapper).append('<div class="row add-more-wrap add-more-new m-0 mb-4"><span class="add-count">' + x + '</span><div class="input-group-btn"><button class="btn btn-danger remove_field" type="button"><i class="icon-remove" data-feather="x"></i></button></div><div class="col-12 col-md-6"><div class="form-group"><label for="MaterialName[' + x + ']">Packing Material Name</label>{{ Form::select("material[]",$rawmaterial,old("material"),array("class"=>"form-control select","id"=>"material'+x+'","placeholder"=>"Name of Material")) }}</div></div><div class="col-12 col-md-6"><div class="form-group"><label for="Quantity[' + x + ']">Quantity Received (Kg)</label><input type="text" class="form-control" name="total_qty[]" id="total_qty[' + x + ']" placeholder="Quantity"></div></div></div>'); //add input box
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
<script>
    $(document).ready(function() {
        $("#inward_packing_material").validate({
            rules: {
                received_from: "required",
                received_to: "required",
                date_of_receipt: "required",
                material: "required",
                manufacturer: "required",
                supplier: "required",

                invoice_no: "required",
                goods_receipt_no: "required",

                "total_qty[]": "required",
                /*"ar_no_date[]": "required",*/
                "material[]": "required",
                remark: "required",

            },
            messages: {
                inward_no: "Please  Enter The Inward No",
                received_from: "Please  Enter The Received from",
                received_to: "Please  Enter The Received To",
                date_of_receipt: "Please  Enter The Date Of Receipt",
                manufacturer: "Please  Enter The Manufacturer",
                supplier: "Please  Enter The Supplier",
                invoice_no: "Please  Enter The Invoice no",
                goods_receipt_no: "Please  Enter The Goods Receipt No",
                "total_qty[]": "Please  Enter The total qty",
                "material[]": "Please  select The Material",
                "ar_no_date": "Please  Enter The Ar No Date",
                remark:"Please enter remark"

            },
        });

    });
</script>

@endpush
