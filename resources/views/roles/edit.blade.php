

@extends("layouts.app")
@section('title', 'Create Department')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row page-heading">
                <div class="col-12 col-xl-8 mb-xl-0 align-self-center align-items-center">
                    <h4 class="font-weight-bold d-flex"><i class="menu-icon" data-feather="layers"></i>Edit Role</h4>

                </div>
            </div>
        </div>
    </div>

    <div class="card main-card">
        <div class="card-body">
                {!! Form::model($role, ['route' => ['roles.update', $role->id],'method' => 'POST']) !!}
                <div class="form-row">
                  <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                      <div class="form-group">
                          <label for="rno">Role</label>
                          {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                         
                          @if ($errors->has('role'))
                                  <span class="text-danger">{{ $errors->first('role') }}</span>
                          @endif

                      </div>
                  </div>
              </div>
              <div class="form-row">
                <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                      <div class="form-group">
                        <label for="rno">Permission:</label> <br>
                          @foreach($permission as $value)
                          <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                            <fieldset class="border p-2 mb-2">
                              <legend class="w-auto" style="font-size: 14px;">{{$value->module_name}}</legend>
                                @php
                                    $permissions = \Spatie\Permission\Models\Permission::where("module_name",$value->module_name)->get();
                                @endphp
                                @foreach($permissions as $v)
                                  <div class="custom-control custom-switch custom-control-inline mb-2 col-md-2">
                                    
                                      {{ Form::checkbox('permission[]', $v->id, in_array($v->id, $rolePermissions), array('class' => 'custom-control-input',"id"=>"per".$v->id)) }}
                                      <label class="custom-control-label" for="per{{$v->id}}">{{ $v->name }}</label>
                                  </div>
                                @endforeach
                            </fieldset>
                          </div>
                              
                        
                          @endforeach
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
      role : {
        required: true,
        minlength: 3
      },
      
    },
    messages : {
    role: {
        required: "Field Role is required.",
        minlength: "Role should be at least 3 characters"
      },
      publish: {
        required: "Please select publish option",

      }
    }
  });
});

    </script>

@endpush
