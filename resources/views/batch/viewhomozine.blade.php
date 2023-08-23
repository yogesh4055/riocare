<div class="form-row">
    <div class="col-12">
        <h3>Homogenizing details of {{ $batchdetails->productname }} Batch No. {{ $batchdetails->batchNo }}</h3>
    </div>
    <div class="col-12 table-responsive">
        <table class="table table-hover table-bordered">
            <tr>
                <th>Product Name</th>
                <td>{{ $batchdetails->productname }}</td>
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
                <th>Homogenizing tank No.</th>
                <td>{{ $Homogenizing->code }}</td>
            </tr>

            <tr>
                <th colspan="2">Homogenizing Details</th>

            </tr>
            <tr>
                <th colspan="2">Process</th>

            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%" height="100%" border="0" cellspacing="0">
                        <tr>
                            <th>Date</th>
                            <th>Process</th>

                            <th>Qty (Kg.)</th>
                            <th>Start Time (Hrs)</th>
                            <th>End Time (Hrs)</th>
                            <th>Done By</th>
                        </tr>
                        @if(isset($homoList) && $homoList)
                            @php $i =1; @endphp
                            @foreach ($homoList as $v)
                                <tr>
                                    <td>
                                       {{ $v->dateProcess }}
                                       </td>
                                    <td>{{ $v->lots_name }}</td>
                                    <td>{{ number_format($v->qty,3,".","") }}</td>
                                    <td>{{ $v->stratTime }}</td>
                                    <td>{{ $v->endTime }}</td>
                                    <td>{{ $v->doneby }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </td>
            </tr>



            <tr>
                <th>In Process Check (After 4 Lot)</th>
                <td>{{ $Homogenizing->proecess_check }}</td>
            </tr>
            <tr>
                <th>Observed value (cst/cp)</th>
                <td>{{ $Homogenizing->Observedvalue }}</td>
            </tr>

        </table>
    </div>
</div>
