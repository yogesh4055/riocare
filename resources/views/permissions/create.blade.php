
@extends("layouts.app")
@section('title', 'Create permission')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row page-heading">
                <div class="col-12 col-xl-8 mb-xl-0 align-self-center align-items-center">
                    <h4 class="font-weight-bold d-flex"><i class="menu-icon" data-feather="layers"></i>Create permission</h4>

                </div>
            </div>
        </div>
    </div>
    <div class="card main-card">
        <div class="card-body">


          @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Opps!</strong> Something went wrong, please check below errors.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

                {!! Form::open(array('route' => 'permissions.store','method'=>'POST',"id"=>"departmentForm")) !!}
                <div class="form-row">
                  <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                      <div class="form-group">
                        <label for="from">Name:</label>
                          {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                      </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                {!! Form::close() !!}
               
              </div>
            </div>
        
        
@endsection
@push("scripts")
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {
  $("#departmentForm").validate({
    rules: {
      name : {
        required: true,
       
      }
    },
    messages : {
      name: {
        required: "Field Permission name is required.",
        
      }
    }
  });
});

    </script>

@endpush




