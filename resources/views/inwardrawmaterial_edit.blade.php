@extends('layouts.app')
@section("title","Inward Raw Material")
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="row page-heading">
        <div class="col-12 col-xl-8 mb-xl-0 align-self-center align-items-center">
          <h4 class="font-weight-bold d-flex"><i class="menu-icon" data-feather="layers"></i>Goods Receipt Note (Annexure - IV)
          </h4>
          <p>This form is Submitted to Quality Control for testing Sample of Products received.</p>
        </div>
      </div>
    </div>
  </div>
  <div class="card main-card">
   <div class="card-body">
    @if (Session::has('error'))
    <div id="" class="alert alert-danger col-md-12">{!! Session::get('error') !!}
    </div>
    @endif
    @if (Session::has('message'))
    <div id="" class="alert alert-success col-md-12">{!! Session::get('message') !!}
    </div>
    @endif
    <form class="login100-form validate-form" action="{{ route('inwardrawmaterial-update') }}" method="POST" id="inwardrawmaterialForm">
      @csrf
      <div class="form-row">
       <div class="col-12 col-md-6 col-lg-6 col-xl-6">
        <div class="form-group">
          <label for="rno">No.</label>
          <input type="text" class="form-control" name="rno" id="rno" value="{{ $inwardmaterial->id }}" readonly>
          @if ($errors->has('rno'))
          <span class="text-danger">{{ $errors->first('rno') }}</span>
          @endif
        </div>
      </div>
    </div>
    <div class="form-row">
     <div class="col-12 col-md-6 col-lg-6 col-xl-6">
      <div class="form-group">
        <label for="from">From</label>
        {{ Form::select("from",$department,old("from")?old("from"):$inwardmaterial->received_from,array("class"=>"form-control select","id"=>"from","placeholder"=>"From")) }}
        @if ($errors->has('from'))
        <span class="text-danger">{{ $errors->first('from') }}</span>
        @endif
      </div>
    </div>
    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
      <div class="form-group">
        <label for="to">TO</label>
        {{ Form::select("to",$department,old("to")?old("to"):$inwardmaterial->received_to,array("class"=>"form-control select","id"=>"to","placeholder"=>"To Department")) }}

        @if ($errors->has('to'))
        <span class="text-danger">{{ $errors->first('to') }}</span>
        @endif
      </div>
    </div>
    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
      <div class="form-group">
        <label for="receiptDate">Date of Receipt</label>
        <input type="date" class="form-control calendar" name="receiptDate" value="{{ date('Y-m-d', $inwardmaterial->date_of_receipt)   }}" id="receiptDate" placeholder="DD-MM-YYYY">
        @if ($errors->has('receiptDate'))
        <span class="text-danger">{{ $errors->first('receiptDate') }}</span>
        @endif
      </div>
    </div>
    <!--<div class="col-12 col-md-6 col-lg-6 col-xl-6">-->
    <!--	<div class="form-group">-->
    <!--	  <label for="materialName">Name of Material</label>-->
    <!--                     {{ Form::select("materialname",$rawmaterial,old("materialname"),array("class"=>"form-control select","id"=>"materialname","placeholder"=>"Choose Material")) }}-->
    <!--                     @if ($errors->has('materialname'))-->
    <!--                     <span class="text-danger">{{ $errors->first('materialname') }}</span>-->
    <!--                   @endif-->
    <!--	</div>-->
    <!--</div>-->
    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
      <div class="form-group">
        <label for="manufacturername">Name of Manufacturer</label>
        {{ Form::select("manufacturername",$manufacturer,old("manufacturername")?old("manufacturername"):$inwardmaterial->manufacturer,array("class"=>"form-control select","id"=>"manufacturername","placeholder"=>"Choose Manufacturer")) }}

      </div>
    </div>
    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
      <div class="form-group">
        <label for="suppliername">Name of Supplier</label>
        {{ Form::select("suppliername",$supplier,old("suppliername")?old("suppliername"):$inwardmaterial->supplier,array("class"=>"form-control select","id"=>"suppliername","placeholder"=>"Choose Supplier")) }}
        @if ($errors->has('suppliername'))
        <span class="text-danger">{{ $errors->first('suppliername') }}</span>
        @endif
      </div>
    </div>
					<!-- <div class="col-12 col-md-6 col-lg-6 col-xl-6">
						<div class="form-group">
						  <label for="supplierAddress">Address of Supplier</label>
						  <input type="text" class="form-control" id="supplierAddress" name="supplierAddress" placeholder="Address of Supplier">
                          @if ($errors->has('supplierAddress'))
                          <span class="text-danger">{{ $errors->first('supplierAddress') }}</span>
                        @endif
						</div>
					</div> -->
					<!-- <div class="col-12 col-md-6 col-lg-6 col-xl-6">
						<div class="form-group">
						  <label for="supplierGST">Supplier GST Number</label>
						  <input type="text" class="form-control" id="supplierGST" name="supplierGST" placeholder="Supplier GST">
                          @if ($errors->has('supplierGST'))
                          <span class="text-danger">{{ $errors->first('supplierGST') }}</span>
                        @endif
						</div>
					</div> -->
          <!--<div class="col-12 col-md-6 col-lg-6 col-xl-6">-->
          <!--    <div class="form-group">-->
          <!--        <label for="Viscosity">Viscosity <span class="text-danger">(Only for certain Products)</span></label>-->
          <!--        <input type="text" class="form-control"  pattern="\d*" maxlength="50" name="viscosity" id="viscosity" placeholder="Viscosity"   value="{{ old("viscosity") }}">-->
          <!--    </div>-->
          <!--</div>-->

          <div class="col-12 col-md-6 col-lg-6 col-xl-6">
            <div class="form-group">
              <label for="invoiceNo">Invoice No.</label>
              <input type="text" class="form-control" id="invoiceNo" name="invoiceNo" value="{{$inwardmaterial->invoice_no}}"  pattern="^[a-zA-Z0-9]" / maxlength="120" placeholder="Invoice No" >
              @if ($errors->has('invoiceNo'))
              <span class="text-danger">{{ $errors->first('invoiceNo') }}</span>
              @endif
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-6 col-xl-6">
            <div class="form-group">
              <label for="receiptNo">Goods Receipt No.</label>
              <input type="text" class="form-control" id="receiptNo" pattern="\d*" maxlength="30" value="{{$inwardmaterial->goods_receipt_no}}"  name="receiptNo" placeholder="GRM/RM/Receipt No." >
              @if ($errors->has('receiptNo'))
              <span class="text-danger">{{ $errors->first('receiptNo') }}</span>
              @endif
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-6 col-xl-6">
            <div class="form-check" style="margin-top:30px;">
              <input type="checkbox" class="form-check-input" id="openingstockcheck" name="openingstock" id="openingstock" {{ $inwardmaterial->is_opening==1? 'checked':'' }}>
              <label class="form-check-label" for="openingstockcheck">Is Opening Stock?</label>
            </div>
          </div>
          <div class="col-12 col-md-12 col-lg-12 col-xl-12">
            <div class="form-group input_fields_wrap" id="MaterialReceived">

             <div class="row add-more-wrap after-add-more m-0 mb-4">
              <div class="col-12 col-md-6">
               <div class="form-group">
                 <label for="rawMaterialName">Raw Material Name</label>
                 {{ Form::select("materialnames",$rawmaterial,old("materialnames")?old("materialnames"):$inwardmaterial->material,array("class"=>"form-control select","id"=>"materialname1","placeholder"=>"Choose Material")) }}
               </div>
             </div>
             <div class="col-12 col-md-6">
               <div class="form-group">
                 <label for="batch">Batch No.</label>
                 <input type="text" class="form-control" name="batch" id="batch" placeholder="Batch" value="{{$inwardmaterial->batch_no}}" pattern="\d*" maxlength="150">
               </div>
             </div>
             <div class="col-12 col-md-6">
               <div class="form-group">
                 <label for="Containers">Total no of Containers / Bags</label>
                 <input type="text" class="form-control" id="Containers" name="Containers" value="{{$inwardmaterial->total_no_of_containers_or_bags}}" placeholder="No of Containers / Bags" pattern="\d*" maxlength="12" onkeypress="return /[0-9]/i.test(event.key)"
                 >
               </div>
             </div>
             <div class="col-12 col-md-6">
               <div class="form-group">
                 <label for="Quantity">Quantity Received (Kg)</label>
                 <input type="number" class="form-control" id="Quantity" name="Quantity" value="{{$inwardmaterial->qty_received_kg}}" placeholder="Quantity" maxlength="12">
               </div>
             </div>
             <div class="col-12 col-md-6">
               <div class="form-group">
                 <label for="mfgDate">Manufacturer’s Mfg. Date</label>
                 <input type="date" class="form-control calendar" id="mfgDate" value="{{ date('Y-m-d', $inwardmaterial->mfg_date)   }}" name="mfgDate" placeholder="Mfg. Date">
               </div>
             </div>
             <div class="col-12 col-md-6">
               <div class="form-group">
                 <label for="ExpiryDate">Manufacturer’s Expiry Date</label>
                 <input type="date" class="form-control calendar" id="ExpiryDate" name="ExpiryDate" value="{{ date('Y-m-d', $inwardmaterial->mfg_expiry_date)}}" placeholder="Expiry Date">
               </div>
             </div>
             <div class="col-12 col-md-6">
               <div class="form-group">
                 <label for="RIOExpiryDate">RIO Care Expiry Date</label>
                 <input type="date" class="form-control calendar" id="RIOExpiryDate" name="RIOExpiryDate" value="{{ date('Y-m-d', $inwardmaterial->rio_care_expiry_date)}}" placeholder="Expiry Date">
               </div>
             </div>
             <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="Viscosity">Viscosity <span class="text-danger">(Only for certain Products)</span></label>
                <input type="text" class="form-control"  pattern="\d*" maxlength="50" name="viscosity" value="{{$inwardmaterial->viscosity}}" id="viscosity" placeholder="Viscosity">
              </div>
            </div>
            <!--<div class="col-12 col-md-6">&nbsp;</div>-->
            <div class="col-12 col-md-6">
             <div class="form-group">
               <label for="ARNo">AR No.</label>
               <input type="text" class="form-control" id="ARNo" placeholder="AR No. / Date" value="{{$inwardmaterial->ar_no_date}}" name="ARNo"  maxlength="120">
             </div>
           </div>
           <div class="col-12 col-md-6">
             <div class="form-group">
               <label for="ARNo">AR Date</label>
               <input type="date" class="form-control" id="ARdate" placeholder="AR Date" value="{{ date('Y-m-d', strtotime($inwardmaterial->ar_no_date_date))}}" name="ARNodate">
             </div>
           </div>
         </div>
       </div>
     </div>
     <div class="col-12 col-md-6 col-lg-6 col-xl-6">
      <div class="form-group">
        <label for="createdby">Created By</label>
        {{ Form::select('createdby',$users,old("createdby")?old("createdby"):$inwardmaterial->created_by,array('class'=>'form-control select',"placeholder"=>"Created by")) }}

        @if ($errors->has('createdby'))
        <span class="text-danger">{{ $errors->first('createdby') }}</span>
        @endif
      </div>
    </div>
    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
      <div class="form-group">
        <label for="dateTime">Date and Time</label>
        <div class="form-row">
         <div class="col-6"><input type="date" name="cdate" class="form-control calendar" id="date" placeholder="Date" value={{ date("Y-m-d") }}></div>
         <div class="col-6"><input type="time"  name="ctime" class="form-control calendar" id="Time" placeholder="Time" value="{{ date("H:i") }}"></div>
         @if ($errors->has('cdate'))
         <span class="text-danger">{{ $errors->first('cdate') }}</span>
         @endif
       </div>
     </div>
   </div>
   <div class="col-12">
    <div class="form-group">
      <label for="Remark">Note / Remark</label>
      <textarea class="form-control" id="Remark" name="remark" placeholder="Note / Remark">{{$inwardmaterial->remark}}</textarea>
    </div>
  </div>
  <div class="col-12">
    <div class="form-group">
      <button type="submit" class="btn btn-primary btn-md ml-0 form-btn">Submit</button><button type="clear" class="btn btn-light btn-md form-btn">Clear</button>
    </div>
  </div>
</div>
</div>
</div>

</div>

@endsection
@push("scripts")
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

<script>
feather.replace()
$(document).ready(function() {
		var max_fields      = 15; //maximum input boxes allowed
		var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
		var add_button      = $(".add_field_button"); //Add button ID

	});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

<script>
$(document).ready(function() {
            //$("#Quantity").mask("999999");
           /* $("#suppliername").change(function(){
                $.ajax({
                    url:'{{ route("inwardrawmaterial-supplier") }}',
                    data:{
                        "id":$(this).val(),
                        "_token":'{{ csrf_token() }}'
                    },
                    method:"post",
                    datatype:"json"
                }).success(function(data){
                    $("#supplierAddress").val(data.address);
                    $("#supplierGST").val(data.gst);
                })
})*/
$("#inwardrawmaterialForm").validate({
  rules: {
    rno : {
      required: true,
    },
    from:{
      required:true
    },
    to:{
      required:true
    },
    receiptDate:
    {
      required:true
    },
        //   materialname:{
        //     required:true
        //   },
        manufacturername:{
          required:true
        },
        suppliername:{
          required:true
        },
        supplierAddress:{
          required:true
        },
        supplierGST:{
          required:true
        },
        invoiceNo:{
          required:true
        },
        receiptNo:{
          required:true
        },
        "materialnames":{
          required:true
        },
        "batch":{
          required:true
        },
        "Containers":{
          required:true
        },
        "Quantity":{
          required:true
        },
        "mfgDate":{
          required:true
        },
        // "ExpiryDate":{
        //   required:true
        // },
        // "ExpiryDate":{
        //   required:true
        // },
          /*"RIOExpiryDate[]":{
              required:true
          },
          "ARNo[]":{
              required:true
            },*/
            createdby:{
              required:true
            },
            cdate:{
              required:true
            },
            ctime:{
              required:true
            },

            publish: {
              required: true,

            }
          },
          messages : {
            supplier: {
              required: "Field Manufacturer is required.",
              minlength: "Manufacturer should be at least 3 characters"
            },
            city: {
              required: "City field is required.",

            },
            state: {
              required: "State field is required.",

            },
            address: {
              required: "Address field is required.",

            },
            company_name: {
              required: "Company Name field is required.",

            },
            contact_per_name: {
              required: "Contact person name field is required.",

            },
            contact_number: {
              required: "Contact number field is required.",

            },
            publish: {
              required: "Please select publish option",

            }
          }
        });


});
    // function AvoidSpace(event) {
    // var k = event ? event.which : window.event.keyCode;
    // if (k == 32) return false;
//}

</script>

@endpush
