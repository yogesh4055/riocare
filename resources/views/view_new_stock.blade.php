<div class="form-row">
    <div class="col-12">
        <h3>Inward Finished Goods - New Stock</h3>
    </div>
    <div class="col-12 table-responsive">
        <table class="table table-hover table-bordered">
            <tr>
                <th >Date</th>
                <td>{{ date("d/m/Y ",strtotime($inward_goods->created_at)) }}</td>
            </tr>
            <tr>
                <th >Product Name</th>
                <td>{{$inward_goods->material_name}}</td>
            </tr>

            <tr>
                <th >Batch No.</th>
                <td>{{ $inward_goods->batch_no }}</td>
            </tr>
            <tr>
                <th >Grade</th>
                <td>{{ $inward_goods->grade }}</td>
            </tr>
            <tr>
                <th >Viscosity</th>
                <td>{{ $inward_goods->viscosity }}</td>
            </tr>
            <tr>
                <th >Mfg. Date</th>
                <td>{{ $inward_goods->mfg_date }}</td>
            </tr>
            <tr>
                <th >Expiry Retest Date</th>
                <td>{{ $inward_goods->expiry_ratest_date }}</td>
            </tr>
            <tr>
                <th >Total No. of Drumbs (Kg.)</th>
            </tr>

            <tr>
                <th>200Kg</th>
                <td>{{number_format($inward_goods->total_no_of_200kg_drums,3,".","") }}</td>
            </tr>
            <tr>
                <th>50Kg</th>
                <td>{{number_format($inward_goods->total_no_of_50kg_drums,3,".","") }}</td>
            </tr>
            <tr>
                <th>30Kg</th>
                <td>{{number_format($inward_goods->total_no_of_30kg_drums,3,".","") }}</td>
            </tr>
            <tr>
                <th>5Kg</th>
                <td>{{number_format($inward_goods->total_no_of_5kg_drums,3,".","") }}</td>
            </tr>
            <tr>
                <th>Fiber board</th>
                <td>{{number_format($inward_goods->total_no_of_fiber_board_drums,3,".","") }}</td>
            </tr>



            <tr>
                <th>AR No.</th>
                <td>{{$inward_goods->ar_no}} {{$inward_goods->ar_no_date?date("d/m/Y",strtotime($inward_goods->ar_no_date)):""}}</td>
            </tr>
            <tr>
                <th>Total Quantity (Kg.)</th>
                <td>{{number_format($inward_goods->total_quantity,3,".","") }}</td>
            </tr>
            <tr>
                <th>Approval Date</th>
                <td>{{$inward_goods->approval_data}}</td>

            </tr>
            <tr>
                <th>Received by</th>
                <td>{{$inward_goods->name}}</td>
            </tr>
            <tr>
                <th>Is Opening Stock</th>
                <td>{{$inward_goods->is_opening_stock?"Opening Stock":""}}</td>

            </tr>

        </table>
    </div>
</div>
