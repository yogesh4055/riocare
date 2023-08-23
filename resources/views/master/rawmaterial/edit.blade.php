@extends('layouts.app')
@section('title', 'Edit Raw Material')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row page-heading">
                <div class="col-12 col-xl-8 mb-xl-0 align-self-center align-items-center">
                    <h4 class="font-weight-bold d-flex"><i class="menu-icon" data-feather="layers"></i>Edit Material</h4>

                </div>
            </div>
        </div>
    </div>
    <div class="card main-card">
        <div class="card-body">

            <form class="login100-form validate-form" action="{{ route('rawmaterial-update', ['id' => $rawmaterial->id]) }}"
                method="POST" id="departmentForm">
                @csrf
                <div class="form-row">
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="rno">Material Name</label>
                            <input type="text" class="form-control" name="rawmeterial" id="rawmeterial"
                                placeholder="Material Name"
                                value="{{ old('rawmeterial') ? old('rawmeterial') : $rawmaterial->material_name }}">
                            @if ($errors->has('rawmeterial'))
                                <span class="text-danger">{{ $errors->first('rawmeterial') }}</span>
                            @endif

                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="rno">Material Code</label>
                            <input type="text" class="form-control" name="rawmeterial_code" id="rawmeterial_code"
                                placeholder="Material Code"
                                value="{{ old('rawmeterial_code') ? old('rawmeterial_code') : $rawmaterial->material_code }}">
                            @if ($errors->has('rawmeterial_code'))
                                <span class="text-danger">{{ $errors->first('rawmeterial_code') }}</span>
                            @endif

                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="controller_id">Material Mesurment</label>
                            {{ Form::select('mesurment', $mesurments, old('mesurment') ? old('mesurment') : $rawmaterial->material_mesurment, ['id' => 'mesurment', 'class' => 'form-control', 'placeholder' => 'Material Mesurment']) }}
                            @if ($errors->has('mesurment'))
                                <span class="text-danger">{{ $errors->first('mesurment') }}</span>
                            @endif

                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="controller_id">Material Type</label>
                            {{ Form::select('type', $type, old('type') ? old('type') : $rawmaterial->material_type, ['id' => 'type', 'class' => 'form-control material_type', 'placeholder' => 'Material Type']) }}
                            @if ($errors->has('mesurment'))
                                <span class="text-danger">{{ $errors->first('mesurment') }}</span>
                            @endif

                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6 hidden material_type_div" style="display: none;">

                    </div>

                    {{-- <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="controller_id">Material Opening Stock</label>
                            <input type="number" class="form-control" name="stock" id="stock" placeholder="Material Opening Stock" value="{{ old("stock")?old("stock"):$rawmaterial->material_stock }}">

                            @if ($errors->has('stock'))
                                    <span class="text-danger">{{ $errors->first('stock') }}</span>
                            @endif

                        </div>
                    </div> --}}
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="controller_id">Material Preorder Stock</label>
                            <input type="number" class="form-control" name="prestock" id="prestock"
                                placeholder="Material Preorder Stock"
                                value="{{ old('prestock') ? old('prestock') : $rawmaterial->material_preorder_stock }}">

                            @if ($errors->has('prestock'))
                                <span class="text-danger">{{ $errors->first('prestock') }}</span>
                            @endif

                        </div>
                    </div>
                    {{-- <div class="col-12 col-md-6 col-lg-6 col-xl-6 ">
                        <div class="form-group ">
                            <label for="controller_id">Grade</label>
                            {{ Form::select("grade",$group,old("grade")?old("grade"):$rawmaterial->grade,array("id"=>"type","class"=>"form-control  grade","placeholder"=>"Grade")) }}
                            @if ($errors->has('grade'))
                                    <span class="text-danger">{{ $errors->first('grade') }}</span>
                            @endif

                        </div>
                    </div> --}}
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="Status">QC Status</label> <br>
                            <div class="form-check-inline">
                                <input type="checkbox" class="form-check-input" name="qc_status" id="qc_status"
                                    value="1" @if ($rawmaterial->qc_applicable) checked="checked" @endif>
                                <label class="form-check-label" for="qc_status">Yes</label>
                            </div>

                        </div>
                    </div>
                    {{-- <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="controller_id">Material Expiery Date</label>
                            <input type="date" class="form-control calendar"  name="expierydate" id="expierydate" placeholder="Material Expiery Date" value="{{ old("expierydate")?old("expierydate"):($rawmaterial->expiry_date?date("Y-m-d",$rawmaterial->expiry_date):'')}}">

                            @if ($errors->has('expierydate'))
                                    <span class="text-danger">{{ $errors->first('expierydate') }}</span>
                            @endif

                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="controller_id">Rio Expiery Date</label>
                            <input type="date" class="form-control calendar" name="rioexpierydate" id="rioexpierydate" placeholder="Rio Expiery Date" value="{{ old("rioexpierydate")?old("rioexpierydate"):($rawmaterial->rio_expiry_date?date("Y-m-d",$rawmaterial->rio_expiry_date):'') }}">

                            @if ($errors->has('rioexpierydate'))
                                    <span class="text-danger">{{ $errors->first('rioexpierydate') }}</span>
                            @endif

                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="controller_id">Manufacturing Date</label>
                            <input type="date" class="form-control calendar" name="manufacturingdate" id="manufacturingdate" placeholder="Manufacturing Date" value="{{ old("manufacturingdate")?old("manufacturingdate"):($rawmaterial->man_date?date("Y-m-d",$rawmaterial->man_date):'') }}">

                            @if ($errors->has('Manufacturing Date'))
                                    <span class="text-danger">{{ $errors->first('manufacturingdate') }}</span>
                            @endif

                        </div>
                    </div> --}}
                </div>
                {{-- <div class="form-row" id="finalprod" style="display:none">
                    <div class="col-6 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="Status">Lots Enable/Disable</label> <br>
                            <div class="form-check-inline">
                                <input type="checkbox" class="form-check-input" name="lot_status" id="lot_status"
                                    value="1" @if ($rawmaterial->is_lot) checked="checked" @endif>
                                <label class="form-check-label" for="lot_status">Yes</label>
                            </div>

                        </div>
                    </div>
                    <div class="col-6 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="Status">Homogenize Enable/Disable</label> <br>
                            <div class="form-check-inline">
                                <input type="checkbox" class="form-check-input" name="homog_status" id="homog_status"
                                    value="1" @if ($rawmaterial->is_homoginize) checked="checked" @endif>
                                <label class="form-check-label" for="homog_status">Yes</label>
                            </div>

                        </div>
                    </div>

                </div> --}}

                <div class="form-row" id="finalprod" style="display: none;">

                    @if(isset($procgroup) && isset($procgroup[1]))
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="rno">Process</label> <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="processgroupid" id="inlineRadio1" value="1" @if ($rawmaterial->processgroupid ==1) checked="checked" @endif>
                                <label class="form-check-label" for="inlineRadio1">Group 1 <br>

                                <ol style="font-size:10px;">
                                    @foreach($procgroup[1] as $group)
                                        <li>{{ $group->process_name }} </li>
                                    @endforeach
                                </ol>
                                </label>
                            </div>
                        </div>
                    </div>

                @endif


                    @if(isset($procgroup) && isset($procgroup[2]))
                            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="radio" name="processgroupid" id="inlineRadio2" value="2" @if ($rawmaterial->processgroupid ==2) checked="checked" @endif>
                                        <label class="form-check-label" for="inlineRadio2">Group 2 <br>

                                        <ol style="font-size:10px;">
                                            @foreach($procgroup[2] as $group)
                                                <li>{{ $group->process_name }} </li>
                                            @endforeach
                                        </ol>
                                        </label>
                                    </div>
                                </div>
                            </div>

                        @endif
                        @if(isset($procgroup) && isset($procgroup[3]))
                        <div class="col-12 col-md-6 col-lg-6 col-xl-6" style="margin-top:30px">
                            <div class="form-group">
                                <div class="form-check ">
                                    <input class="form-check-input" type="radio" name="processgroupid" id="inlineRadio3" value="3" @if ($rawmaterial->processgroupid ==3) checked="checked" @endif>
                                    <label class="form-check-label" for="inlineRadio3">Group 3 <br>

                                    <ol style="font-size:10px;">
                                        @foreach($procgroup[3] as $group)
                                            <li>{{ $group->process_name }} </li>
                                        @endforeach
                                    </ol>
                                    </label>
                                </div>
                            </div>
                        </div>

                    @endif
                    <!--@if(isset($procgroup) && isset($procgroup[4]))-->
                    <!--    <div class="col-12 col-md-6 col-lg-6 col-xl-6" style="margin-top:30px">-->
                    <!--        <div class="form-group">-->
                    <!--            <div class="form-check ">-->
                    <!--                <input class="form-check-input" type="radio" name="processgroupid" id="inlineRadio4" value="4" @if ($rawmaterial->processgroupid ==4) checked="checked" @endif>-->
                    <!--                <label class="form-check-label" for="inlineRadio4">Group 4 <br>-->

                    <!--                <ol style="font-size:10px;">-->
                    <!--                    @foreach($procgroup[4] as $group)-->
                    <!--                        <li>{{ $group->process_name }} </li>-->
                    <!--                    @endforeach-->
                    <!--                </ol>-->
                    <!--                </label>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->

                    <!--@endif-->
                    @if(isset($procgroup) && isset($procgroup[5]))
                        <div class="col-12 col-md-6 col-lg-6 col-xl-6" style="margin-top:10px">
                            <div class="form-group">
                                <div class="form-check ">
                                    <input class="form-check-input" type="radio" name="processgroupid" id="inlineRadio5" value="5" @if ($rawmaterial->processgroupid ==5) checked="checked" @endif>
                                    <label class="form-check-label" for="inlineRadio5">Group 4 <br>

                                    <ol style="font-size:10px;">
                                        @foreach($procgroup[5] as $group)
                                            <li>{{ $group->process_name }} </li>
                                        @endforeach
                                    </ol>
                                    </label>
                                </div>
                            </div>
                        </div>

                    @endif
                    @if(isset($procgroup) && isset($procgroup[6]))
                        <div class="col-12 col-md-12 col-lg-12 col-xl-12" style="margin-top:10px">
                            <div class="form-group">
                                <div class="form-check ">
                                    <input class="form-check-input" type="radio" name="processgroupid" id="inlineRadio6" value="6" @if ($rawmaterial->processgroupid ==6) checked="checked" @endif>
                                    <label class="form-check-label" for="inlineRadio6">Group 5 <br>

                                    <ol style="font-size:10px;">
                                        @foreach($procgroup[6] as $group)
                                            <li>{{ $group->process_name }} </li>
                                        @endforeach
                                    </ol>
                                    </label>
                                </div>
                            </div>
                        </div>

                    @endif

                    @if(isset($reactgroup) && isset($reactgroup[1]))
                        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label for="rno">Equipment Status</label> <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="reactorstatusgroup" id="reactorstatusgroup1" value="1" @if ($rawmaterial->reactorstatusgroup ==1) checked="checked" @endif>
                                    <label class="form-check-label" for="reactorstatusgroup1">Group 1 <br>

                                    <ol style="font-size:10px;">
                                        @foreach($reactgroup[1] as $group)
                                            <li>{{ $group->rector_status }} </li>
                                        @endforeach
                                    </ol>
                                    </label>
                                </div>
                            </div>
                        </div>

                    @endif

                    @if(isset($reactgroup) && isset($reactgroup[2]))
                            <div class="col-12 col-md-6 col-lg-6 col-xl-6" style="margin-top:30px">
                                <div class="form-group">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="radio" name="reactorstatusgroup" id="reactorstatusgroup2" value="2" @if ($rawmaterial->reactorstatusgroup ==2) checked="checked" @endif>
                                        <label class="form-check-label" for="reactorstatusgroup2">Group 2 <br>

                                        <ol style="font-size:10px;">
                                            @foreach($reactgroup[2] as $group)
                                                <li>{{ $group->rector_status }} </li>
                                            @endforeach
                                        </ol>
                                        </label>
                                    </div>
                                </div>
                            </div>

                        @endif


                        @if(isset($reactgroup) && isset($reactgroup[3]))
                            <div class="col-12 col-md-6 col-lg-6 col-xl-6" style="margin-top:30px">
                                <div class="form-group">
                                
                                    <div class="form-check ">
                                        <input class="form-check-input" type="radio" name="reactorstatusgroup" id="reactorstatusgroup3" value="3" @if ($rawmaterial->reactorstatusgroup ==3) checked="checked" @endif>
                                        <label class="form-check-label" for="reactorstatusgroup3">Group 3 <br>

                                        <ol style="font-size:10px;">
                                            @foreach($reactgroup[3] as $group)
                                                <li>{{ $group->rector_status }} </li>
                                            @endforeach
                                        </ol>
                                        </label>
                                    </div>
                                </div>
                            </div>

                        @endif
                        @if(isset($reactgroup) && isset($reactgroup[4]))
                            <div class="col-12 col-md-6 col-lg-6 col-xl-6" style="margin-top:30px">
                                <div class="form-group"><br>
                                    <div class="form-check ">
                                        <input class="form-check-input" type="radio" name="reactorstatusgroup" id="reactorstatusgroup4" value="4" @if ($rawmaterial->reactorstatusgroup ==4) checked="checked" @endif>
                                        <label class="form-check-label" for="reactorstatusgroup4">Group 4 <br>

                                        <ol style="font-size:10px;">
                                            @foreach($reactgroup[4] as $group)
                                                <li>{{ $group->rector_status }} </li>
                                            @endforeach
                                        </ol>
                                        </label>
                                    </div>
                                </div>
                            </div>

                        @endif
                        @if(isset($reactgroup) && isset($reactgroup[5]))
                            <div class="col-12 col-md-6 col-lg-6 col-xl-6" style="margin-top:30px">
                                <div class="form-group"><br>
                                    <div class="form-check ">
                                        <input class="form-check-input" type="radio" name="reactorstatusgroup" id="reactorstatusgroup5" value="5" @if ($rawmaterial->reactorstatusgroup ==5) checked="checked" @endif>
                                        <label class="form-check-label" for="reactorstatusgroup5">Group 5 <br>

                                        <ol style="font-size:10px;">
                                            @foreach($reactgroup[5] as $group)
                                                <li>{{ $group->rector_status }} </li>
                                            @endforeach
                                        </ol>
                                        </label>
                                    </div>
                                </div>
                            </div>

                        @endif


            </div>


                <div class="form-row">
                    <div class="col-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-md ml-0 form-btn">Submit</button><button
                                type="reset" class="btn btn-light btn-md form-btn">Clear</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>



@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#departmentForm").validate({
                rules: {
                    rawmeterial: {
                        required: true,
                        minlength: 3
                    },
                    mesurment: {
                        required: true
                    },
                    stock: {
                        required: true,
                        number: true
                    },
                    type: {
                        required: true
                    }

                },
                messages: {
                    rawmeterial: {
                        required: "Field Meterial is required.",
                        minlength: "Meterial should be at least 3 characters"
                    },
                    mesurment: {
                        required: "Please select stock mesurment",

                    },
                    stock: {
                        required: "Please enter opening stock",

                    },
                    type: {
                        required: "Please select material type"
                    }
                }
            });

        });

        $(".material_type").change(function() {

            var id = $('.material_type').val();

            if (id == 'P') {

                var capacity =
                    '<div class="form-group"> <label for="controller_id">Capacity</label><input type="number" class="form-control" name="capacity" id="capacity" placeholder="Capacity Opening Stock" value="{{ old('stock') ? old('stock') : $rawmaterial->capacity }}"></div>';
                $('.material_type_div').css('display', 'block');
                $('.material_type_div').html(capacity);
            } else if (id == 'F') {
                $('.material_type_div').css('display', 'none');
                $('#finalprod').css('display', 'flex');
            } else {
                $('.material_type_div').css('display', 'none');
                $('#finalprod').css('display', 'none');
            }



        });

        var id = '{{ $rawmaterial->material_type }}';
        if (id == 'P') {

            var capacity =
                '<div class="form-group"> <label for="controller_id">Capacity</label><input type="number" class="form-control" name="capacity" id="capacity" placeholder="Capacity Opening Stock" value="{{ old('stock') ? old('stock') : $rawmaterial->capacity }}"></div>';
            $('.material_type_div').css('display', 'block');
            $('.material_type_div').html(capacity);
        } else if (id == 'F') {
            $('.material_type_div').css('display', 'none');
            $('#finalprod').css('display', 'flex');
        } else {
            $('.material_type_div').css('display', 'none');
            $('#finalprod').css('display', 'none');
        }
    </script>
@endpush
