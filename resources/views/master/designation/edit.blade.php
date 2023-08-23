@extends("layouts.app")
@section('title', 'Create Department')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row page-heading">
                <div class="col-12 col-xl-8 mb-xl-0 align-self-center align-items-center">
                    <h4 class="font-weight-bold d-flex"><i class="menu-icon" data-feather="layers"></i>Edit Designation</h4>

                </div>
            </div>
        </div>
    </div>
    <div class="card main-card">
        <div class="card-body">
            <form class="login100-form validate-form" action="{{ route('designation-update',["id"=>$designation->id]) }}" method="POST" id="departmentForm">
                @csrf
                <div class="form-row">
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="rno">Designation</label>
                            <input type="text" class="form-control" name="designation" id="designation" pattern="\d*" maxlength="150" onkeypress="return /[0-9a-zA-Z\s\\/-]/i.test(event.key)" placeholder="Designation" value="{{ old("designation")?old("designation"):$designation->designation }}">
                            @if ($errors->has('designation'))
                                    <span class="text-danger">{{ $errors->first('designation') }}</span>
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
                                    if(old('publish') ==1 || $designation->publish ==1)
                                        $pulishy = "checked";
                                    elseif(old('publish') == 0 || $designation->publish ==0)
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
        designation : {
        required: true,
        minlength: 3
      },
      publish: {
        required: true,

      }
    },
    messages : {
        designation: {
        required: "Field Designation is required.",
        minlength: "Designation should be at least 3 characters"
      },
      publish: {
        required: "Please select publish option",

      }
    }
  });
  $(function() {
$('input:text').keydown(function(e) {
if(e.keyCode==1)
    return false;

});
});
});

    </script>

@endpush
