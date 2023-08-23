@extends("layouts.app")
@section('title', 'Create Product')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row page-heading">
                <div class="col-12 col-xl-8 mb-xl-0 align-self-center align-items-center">
                    <h4 class="font-weight-bold d-flex"><i class="menu-icon" data-feather="layers"></i>Product</h4>

                </div>
            </div>
        </div>
    </div>
    <div class="card main-card">
        <div class="card-body">
            <form class="login100-form validate-form" action="{{ route('product_update',['id'=>$edit_product->id]) }}" method="POST" id="ar_no_vali">
            @csrf
                <div class="form-row">
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="rno">product</label>


                            <input type="text" class="form-control" name="name" id="name"  value="{{$edit_product->name}}" >
                            @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif

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
  $("#ar_no_vali").validate({
    rules: {
        name :'required',

    },
    messages : {
        name: "Please Enter The AR NO",

    }
  });
});

    </script>

@endpush
