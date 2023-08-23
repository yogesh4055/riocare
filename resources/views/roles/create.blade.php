@extends("layouts.app")
@section('title', 'Create Department')
@section('content')



<div class="row">
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
        <h2>Roles Add </h2>
        <span class="float-right">
          <a class="btn btn-primary" href="{{ route('roles.index') }}">Roles</a>
        </span>

        <div class="clearfix"></div>
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
      </div>
      <div class="card main-card">
        <div class="card-body">
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box ">
                  {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
                  <div class="form-group">
                    <strong>Name:</strong>
                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                  </div>
                  <div class="form-group">
                    <strong>Permission:</strong>
                    <br />
                    @foreach($permission as $value)
                          <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                            <fieldset class="border p-2 mb-2">
                              <legend class="w-auto" style="font-size: 14px;">{{$value->module_name}}</legend>
                                @php
                                    $permissions = \Spatie\Permission\Models\Permission::where("module_name",$value->module_name)->get();
                                @endphp
                                @foreach($permissions as $v)
                                  <div class="custom-control custom-switch custom-control-inline mb-2 col-md-2">
                                    
                                    {{ Form::checkbox('permission[]', $v->id, false, array('class' => 'custom-control-input',"id"=>"per".$v->id)) }}
                                      <label class="custom-control-label" for="per{{$v->id}}">{{ $v->name }}</label>
                                  </div>
                                @endforeach
                            </fieldset>
                          </div>
                              
                        
                          @endforeach
                   
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                  {!! Form::close() !!}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection