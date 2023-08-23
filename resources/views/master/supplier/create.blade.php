@extends("layouts.app")
@section('title', 'Create Supplier')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row page-heading">
                <div class="col-12 col-xl-8 mb-xl-0 align-self-center align-items-center">
                    <h4 class="font-weight-bold d-flex"><i class="menu-icon" data-feather="layers"></i>New Supplier</h4>

                </div>
            </div>
        </div>
    </div>
    <div class="card main-card">
        <div class="card-body">
            <form class="login100-form validate-form" action="{{ route('supplier-store') }}" method="POST" id="departmentForm">
                @csrf

                <div class="form-row">
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="rno">Supplier Name</label>
                            <input type="text" class="form-control" name="supplier" id="supplier" placeholder="Supplier Name" value="{{ old("supplier") }}">
                            @if ($errors->has('supplier'))
                                    <span class="text-danger">{{ $errors->first('supplier') }}</span>
                            @endif

                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="rno">City</label>
                            <input type="text" class="form-control" name="city" id="city" placeholder="City" value="{{ old("city") }}">
                            @if ($errors->has('city'))
                                    <span class="text-danger">{{ $errors->first('city') }}</span>
                            @endif

                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="rno">State</label>
                            {{Form::select("state",$state,old("state"),array("class"=>"form-control","placeholder"=>"---Select State-----"))}}                            
                            @if ($errors->has('state'))
                                    <span class="text-danger">{{ $errors->first('state') }}</span>
                            @endif

                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="rno">Address</label>
                            <textarea class="form-control" row="2" cols="30" name="address" id="address" placeholder="Address">{{ old("address") }}</textarea>
                            @if ($errors->has('address'))
                                    <span class="text-danger">{{ $errors->first('address') }}</span>
                            @endif

                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="rno">Company Name</label>
                            <input type="text" class="form-control" name="company_name" id="state" placeholder="Company Name" value="{{ old("company_name") }}">
                            @if ($errors->has('company_name'))
                                    <span class="text-danger">{{ $errors->first('company_name') }}</span>
                            @endif

                        </div>
                    </div>
                     <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="rno">Contact Person Name</label>
                            <input type="text" class="form-control" name="contact_per_name" id="state" placeholder="Contact Person Name" value="{{ old("contact_per_name") }}">
                            @if ($errors->has('contact_per_name'))
                                    <span class="text-danger">{{ $errors->first('contact_per_name') }}</span>
                            @endif

                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="rno">Mobile Number</label>
                            <input type="text" class="form-control" name="contact_number" id="contact_number" placeholder="Mobile Number" value="{{ old("contact_number") }}">
                            @if ($errors->has('contact_number'))
                                    <span class="text-danger">{{ $errors->first('contact_number') }}</span>
                            @endif

                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                      <div class="form-group">
                          <label for="rno">Phone Number</label>
                          <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="Phone Number" value="{{ old("phone_number") }}">
                          @if ($errors->has('phone_number'))
                                  <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                          @endif

                      </div>
                  </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="rno">GST Number</label>
                            <input type="text" class="form-control" name="gst" id="gst" placeholder="GST Number" value="{{ old("gst") }}">
                            @if ($errors->has('gst'))
                                    <span class="text-danger">{{ $errors->first('gst') }}</span>
                            @endif

                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="rno">Pan Number</label>
                            <input type="text" class="form-control" name="pan" id="gst" placeholder="Pan Number" value="{{ old("pan") }}">
                            @if ($errors->has('pan'))
                                    <span class="text-danger">{{ $errors->first('pan') }}</span>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                        <div class="form-group">
                            <label for="from">Publish</label>
                            <div>

                                <div class="form-check form-check-inline">
                                    <input
                                      class="form-check-input"
                                      type="radio"
                                      name="publish"
                                      id="inlineRadio1"
                                      value="1"
                                     checked 
                                    />
                                    <label class="form-check-label" for="inlineRadio1"> Yes</label>
                                  </div>

                                  <div class="form-check form-check-inline">
                                    <input
                                      class="form-check-input"
                                      type="radio"
                                      name="publish"
                                      id="inlineRadio2"
                                      value="0"
                                     
                                    />
                                    <label class="form-check-label" for="inlineRadio2">No</label>
                                  </div>

                                  @if ($errors->has('publish'))
                                    <span class="text-danger">{{ $errors->first('publish') }}</span>
                                  @endif


                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-md ml-0 form-btn">Submit</button><button type="reset"
                                class="btn btn-light btn-md form-btn">Clear</button>
                        </div>
                    </div>
                </div>
                </form>
        </div>
    </div>



@endsection
@push("scripts")
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {
  $("#departmentForm").validate({
    rules: {
        supplier : {
        required: true,
        minlength: 3
      },
      city:{
        required:true
      },
      state:{
        required:true
      },
      address:
      {
        required:true
      },
      company_name:{
        required:true
      },
      contact_per_name:{
        required:true
      },
      contact_number:{
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

    </script>

@endpush
