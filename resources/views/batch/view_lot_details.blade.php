<div class="form-row">
    <div class="col-12">
        <h3>Lot details of {{ $batchdetails->productname }} Batch No. {{ $batchdetails->batchNo }}</h3>
    </div>
    <div class="col-12 table-responsive">
        <table class="table table-hover table-bordered">
            <tr>
                <th>Date</th>
                <td>{{ date("d/m/Y ",strtotime($lotsdetails->Date)) }}</td>
            </tr>
            <tr>
                <th>BMR NO</th>
                <td>{{$batchdetails->bmrNo}}</td>
            </tr>
             <tr>
                <th>Ref. MFR No.</th>
                <td>{{ $batchdetails->refMfrNo }}</td>
            </tr>
            <tr>
                <th>Purified water</th>
                <td>@if($lotsdetails->is_water == 1) Quantity(Kg).: {{  $lotsdetails->waterQty   }}  <br><br>  AR No.:  {{  $lotsdetails->waterARN }}@endif</td>
            </tr>
            <tr>
                <th colspan="2">Process Sheet</th>

            </tr>
            <tr>
                <th>Lot No.</th>
                <td>{{ $lotsdetails->lotNo }}</td>
            </tr>
            <tr>
                <th>Reactor No.</th>
                <td>{{ $lotsdetails->code }}</td>
            </tr>
            <tr>
                <th>Date</th>
                <td>{{ $lotsdetails->Process_date }}</td>
            </tr>
            <tr>
                <th colspan="2">Material Details</th>

            </tr>
            @if(isset($lotsrawmaterials) && $lotsrawmaterials)
                @php $i=1; @endphp
                @foreach ($lotsrawmaterials as $val)


                <tr>
                    <th colspan="2">{{ $i }}</th>

                </tr>
                <tr>
                    <th>Raw Material</th>
                    <td>{{$val->material_name}}</td>
                </tr>
                <tr>
                    <th>Batch No.</th>
                    <td>{{$val->batch_no}}</td>
                </tr>
                <tr>
                    <th>Quantity (Kg.)</th>
                    <td>{{number_format($val->Quantity,3,".","") }}</td>
                </tr>
                @php $i++; @endphp
            @endforeach
            @endif


            <tr>
                <th colspan="2">Process</th>

            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%" height="100%" border="0" cellspacing="0">
                        <tr>
                            <th>Process</th>
                            <th>Qty. (Kg.)</th>

                            <th>Temp (<sup>o</sup>C)</th>
                            <th>Start Time (Hrs)</th>
                            <th>End Time (Hrs)</th>
                            <th>Done By</th>
                        </tr>
                        @if(isset($process) && $process)
                        
                            @php $i =1; @endphp
                            @foreach ($process as $v)
                                <tr>
                                    <td>{{ $v->process_name }} @if($v->group_id == 5 && $v->process_id == 35 && isset($equipment_status) && $equipment_status->EquipmentName == 2) {{$equipment_status->code}} @endif</td>
                                    <td>{{ number_format($v->qty,3,".","") }}</td>
                                    <td>{{ $v->temp }}</td>
                                    <td>{{ $v->stratTime }}</td>
                                    <td>{{ $v->endTime }}</td>
                                    <td>{{ $v->doneby }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </td>
            </tr>
        </table>
    </div>
</div>
