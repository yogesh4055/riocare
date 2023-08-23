<div class="form-row">
    <div class="col-12">
        <h3>Inward Finished Goods - New Stock</h3>
    </div>
    <div class="col-12 table-responsive">
        <table class="table table-hover table-bordered">
            <tr>
                <th>Date</th>
                <td>{{ date("d/m/Y ",strtotime($view_quality->created_at)) }}</td>
            </tr>
            <tr>
                <th>Quality<br />(Kg)</th>
                <td>{{$view_quality->qty_received_kg}}</td>
            </tr>
             <tr>
                <th>Name of <br />Manufacturer</th>
                <td>{{ $view_quality->manufacturer }}</td>
            </tr>
            <tr>
                <th>Name of Supplier</th>
                <td>{{ $view_quality->name }}</td>
            </tr>
            <tr>
                <th>Raw Material Name</th>
                <td>{{ $view_quality->material_name }}</td>
            </tr>
            <tr>
                <th>Batch No.</th>
                <td>{{ $view_quality->batch_no }}</td>
            </tr>
            <tr>
                <th>AR No./Date</th>
                <td>{{$view_quality->checkar}} / {{$view_quality->checkardate != "0000-00-00 00:00:00"?date("d/m/Y",strtotime($view_quality->checkardate)):""}}</td>
            </tr>
            <tr>
                <th>GRN</th>
                <td>{{ $view_quality->goods_receipt_no }}</td>
            </tr>
             <tr>
                <th>Quantity Approved</th>
                <td>{{number_format($view_quality->quantity_approved,3,".","") }}</td>
            </tr>
            <tr>
                <th>Quantity Rejected</th>
                <td>{{number_format($view_quality->quantity_rejected,3,".","") }}</td>
            </tr>
            <tr>
                <th>Date of Approval/Rejection</th>
                <td>{{$view_quality->date_of_approval}}</td>
            </tr>
            <tr>
                <th>Status</th>
                @if($view_quality->quantity_status=='Approved')
                <td><span class="badges text-success">Approved</span></td>
                @elseif($view_quality->quantity_status=='Rejected')
                <td><span class="badges text-danger">Rejected</span></td>
                @else
                <td>&nbsp;</td>
                @endif

            </tr>
            <tr>
                <th>Remark</th>
                <td>{{$view_quality->remark}}</td>
            </tr>
        </table>
    </div>
</div>
