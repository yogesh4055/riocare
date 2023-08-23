@extends("layouts.app")
@section('title', 'Create Ar. No')
@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row page-heading">
            <div class="col-12 col-xl-8 mb-xl-0 align-self-center align-items-center">
                <h4 class="font-weight-bold d-flex"><i class="menu-icon" data-feather="layers"></i>AR.No</h4>

            </div>
        </div>
    </div>
</div>
<div class="card main-card">
    <div class="card-body">
        <form class="login100-form validate-form" action="{{ url('party_master_insert') }}" method="POST" id="ar_no_vali">
            @csrf
            <div class="form-row">
               <div class="col-md-4">
                    <label for="rno">Company Name</label>
                    <input type="text" class="form-control" name="company_name" id="company_name" placeholder="Company Name">
                    @if ($errors->has('company_name'))
                    <span class="text-danger">{{ $errors->first('company_name') }}</span>
                    @endif
                </div>
                <div class="col-md-4">
                    <label for="rno">Mobile No</label>
                    <input type="text" class="form-control" name="mobileno"   pattern="^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[789]\d{9}$"  maxlength="10"id="mobileno" placeholder="Mobile No">
                    @if ($errors->has('mobileno'))
                    <span class="text-danger">{{ $errors->first('mobileno') }}</span>
                    @endif
                </div>
                <div class="col-md-4">
                    <label for="rno">Address</label>
                    <input type="text" class="form-control" name="address" id="address" placeholder="Address">
                    @if ($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                    @endif
                </div>
                <div class="col-md-4">
                    <label for="rno">CP Name</label>
                    <input type="text" class="form-control" name="cp_name" id="cp_name" placeholder="CP Name">
                    @if ($errors->has('cp_name'))
                    <span class="text-danger">{{ $errors->first('cp_name') }}</span>
                    @endif
                </div>
                <div class="col-md-4">
                <br>
                    <button type="submit" class="btn btn-primary btn-md ml-0 form-btn">Submit</button><button type="reset" class="btn btn-light btn-md form-btn">Clear</button>

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
        $("#ar_no_vali").validate({
            rules: {
                name: 'required',
                mobileno: {
            required: true,
            digits: true,
            minlength: 10,
            maxlength: 10,
        },

            },
          
            messages: {
                name: "Please Enter The AR NO",
                mobileno: {
                required: "Please enter Mobile  Number",
                digits: "Please enter valid phone number",
                minlength: "Phone number field accept only 10 digits",
                maxlength: "Phone number field accept only 10 digits",
            },

            }
        });
    });
</script>

@endpush
