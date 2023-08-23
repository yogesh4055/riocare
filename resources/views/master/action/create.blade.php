@extends("layouts.app")
@section('title', 'Create Department')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row page-heading">
                <div class="col-12 col-xl-8 mb-xl-0 align-self-center align-items-center">
                    <h4 class="font-weight-bold d-flex"><i class="menu-icon" data-feather="layers"></i>New Action</h4>

                </div>
            </div>
        </div>
    </div>
    <div class="card main-card">
        <div class="card-body">

            <form class="login100-form validate-form" action="{{ route('action-store') }}" method="POST" id="departmentForm">
                @csrf
                <div class="form-row">
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="rno">Action Name</label>
                            <input type="text" class="form-control" name="action" id="action" placeholder="Action" value="{{ old("action") }}">
                            @if ($errors->has('action'))
                                    <span class="text-danger">{{ $errors->first('action') }}</span>
                            @endif

                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="controller_id">Controller Name</label>
                            {{ Form::select("controller_id",$controllers,old("controller_id"),array("id"=>"controller_id","class"=>"form-control","placeholder"=>"Controller Name")) }}
                            @if ($errors->has('controller_id'))
                                    <span class="text-danger">{{ $errors->first('controller_id') }}</span>
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
                                      @if(old('publish') == 1) checked @endif
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
                                      @if(old('publish') == 0) checked @endif
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
        action : {
        required: true,
        minlength: 3
      },
      controller_id : {
        required: true
      },
      publish: {
        required: true,

      }
    },
    messages : {
        action: {
        required: "Field Action is required.",
        minlength: "Action should be at least 3 characters"
      },
      controller_id: {
        required: "Please select Controller Name",

      },
      publish: {
        required: "Please select publish option",

      }
    }
  });
});

    </script>

@endpush
