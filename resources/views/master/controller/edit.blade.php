@extends("layouts.app")
@section('title', 'Create Department')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row page-heading">
                <div class="col-12 col-xl-8 mb-xl-0 align-self-center align-items-center">
                    <h4 class="font-weight-bold d-flex"><i class="menu-icon" data-feather="layers"></i>Edit Controller</h4>

                </div>
            </div>
        </div>
    </div>
    <div class="card main-card">
        <div class="card-body">
            <form class="login100-form validate-form" action="{{ route('controller-update',["id"=>$controller->id]) }}" method="POST" id="departmentForm">
                @csrf
                <div class="form-row">
                    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="form-group">
                            <label for="rno">Controller Name</label>
                            <input type="text" class="form-control" name="controller" id="controller" placeholder="Controller Name" value="{{ old("controller")?old("controller"):$controller->controller }}">
                            @if ($errors->has('controller'))
                                    <span class="text-danger">{{ $errors->first('controller') }}</span>
                            @endif

                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="form-group">
                            <label for="from">Is Menu</label>
                            <div>
                                @php
                                $ismenuy = "";
                                $ismenun = "";
                                if(old('ismenu') ==1 || $controller->is_menu ==1)
                                    $ismenuy = "checked";
                                elseif(old('ismenu') == 0 || $controller->is_menu ==0)
                                {
                                    $ismenun = "checked";
                                }
                                else {
                                    $ismenuy = "checked";
                                }
                            @endphp
                                <div class="form-check form-check-inline">
                                    <input
                                      class="form-check-input"
                                      type="radio"
                                      name="ismenu"
                                      id="ismenu1"
                                      value="1"
                                      {{ $ismenuy }}
                                    />
                                    <label class="form-check-label" for="ismenu1"> Yes</label>
                                  </div>

                                  <div class="form-check form-check-inline">
                                    <input
                                      class="form-check-input"
                                      type="radio"
                                      name="ismenu"
                                      id="ismenu2"
                                      value="0"
                                        {{ $ismenun }}
                                    />
                                    <label class="form-check-label" for="ismenu2">No</label>
                                  </div>

                                  @if ($errors->has('ismenu'))
                                    <span class="text-danger">{{ $errors->first('ismenu') }}</span>
                                  @endif


                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="rno">Menu Name</label>
                            <input type="text" class="form-control" name="menuname" id="menuname" placeholder="Menu Name" value="{{ old("menuname")?old("menuname"):$controller->menu_name }}">
                            @if ($errors->has('menuname'))
                                    <span class="text-danger">{{ $errors->first('menuname') }}</span>
                            @endif

                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="rno">Parent Menu</label>
                            {{ Form::select("parent",$menus,(old("parent")?old("parent"):$controller->parent),array("id"=>"parent","class"=>"form-control","placeholder"=>"Parent Menu")) }}

                            @if ($errors->has('parent'))
                                    <span class="text-danger">{{ $errors->first('parent') }}</span>
                            @endif

                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="rno">Menu Order</label>
                            <input type="number" class="form-control" name="menuorder" id="menuorder" placeholder="Menu Order" value="{{ old("menuorder")?old("menuorder"):$controller->order }}">
                            @if ($errors->has('menuorder'))
                                    <span class="text-danger">{{ $errors->first('menuorder') }}</span>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                        <div class="form-group">
                            <label for="from">Publish</label>
                            <div>
                                @php
                                    $pulishy = "";
                                    $pulishn = "";
                                    if(old('publish') ==1 || $controller->publish ==1)
                                        $pulishy = "checked";
                                    elseif(old('publish') == 0 || $controller->publish ==0)
                                    {
                                        $pulishn = "checked";
                                    }
                                    else {
                                        $pulishy = "checked";
                                    }
                                @endphp
                                <div class="form-check form-check-inline">
                                    <input
                                      class="form-check-input"
                                      type="radio"
                                      name="publish"
                                      id="inlineRadio1"
                                      value="1"
                                      {{ $pulishy }}
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
                                      {{ $pulishn }}
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
      controller : {
        required: true,
        minlength: 3
      },
      ismenu:{
        required: true,
      },
      menuname: {
        required: {
            depends: function(element) {
            return $('input[name=ismenu]:checked').val() == '1';
            }
        }
      },
     /* parent: {
        required: {
            depends: function(element) {
            return $('input[name=ismenu]:checked').val() == '1';
            }
        }
      },*/
      menuorder: {
        required: {
            depends: function(element) {
            return $('input[name=ismenu]:checked').val() == '1';
            }
        }
      },
      publish: {
        required: true,

      }
    },
    messages : {
    controller: {
        required: "Field Controller is required.",
        minlength: "Controller should be at least 3 characters"
      },
      ismenu:{ required: "Field is menu is required."},
      menuname:{ required: "Field is menu name is required."},
      parent:{ required: "Field is menu parent is required."},
      menuorder:{ required: "Field is menu order is required."},
      publish: {
        required: "Please select publish option",

      }
    }
  });
});

    </script>

@endpush
