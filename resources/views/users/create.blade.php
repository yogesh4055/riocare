@extends("layouts.app")
@section('title', 'Create user')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row page-heading">
                <div class="col-12 col-xl-8 mb-xl-0 align-self-center align-items-center">
                    <h4 class="font-weight-bold d-flex"><i class="menu-icon" data-feather="layers"></i>Create user</h4>

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
        
                {!! Form::open(array('route' => 'users.store','method'=>'POST' ,"id"=>"userForm")) !!}
                <div class="form-row">
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="password">Password:</label>
                            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control',"id"=>"password")) !!}
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password:</label>
                            {!! Form::password('password_confirmation', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="roles">Role:</label>
                            {!! Form::select('roles', $roles,[], array('class' => 'form-control','multiple')) !!}
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="roles[]">Designation:</label>
                            {!! Form::select('designation_id', $designation,[], array('class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="roles[]">Department:</label>
                            {!! Form::select('department_id', $department,[], array('class' => 'form-control')) !!}
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
  $("#userForm").validate({
    rules: {
      name : {
        required: true,
        maxlength:150,

      },
      email:{required:true,email:true },
      password:true,
      password_confirmation:{ required:true,equalTo:"#password"},
      "roles[]":{required:true},
      designation:{required:true},
      department:{required:true},

    },
    messages : {
      name: {
        required: "Field Users name is required.",
        
      }
    }
  });
});

    </script>

@endpush