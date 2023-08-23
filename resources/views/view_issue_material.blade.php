<div class="form-row">
    <div class="col-12">
        <h3>Issed by Stores for Production (Annexure - III)</h3>
    </div>
    <div class="col-12 table-responsive">
        <table class="table table-hover table-bordered">
            <tr>
                <th>Requisition No</th>
                <td>{{$issue_material->requisition_no}}</td>

            </tr>
            <tr>
                <th>Material</th>
                <td>{{$issue_material->material}}</td>
            </tr>
            <tr>
                <th>Opening Bal</th>
                <td>{{$issue_material->opening_bal}}</td>
            </tr>
            <tr>
                <th>Batch No</th>
                <td>{{$issue_material->batch_no}}</td>
            </tr>
            <tr>
                <th>Viscosity</th>
                <td>{{$issue_material->viscosity}}</td>
            </tr>
            <tr>
                <th>Issual Date</th>
                <td>{{$issue_material->issual_date}}</td>
            </tr>
            <tr>
                <th>Issued Quantity</th>
                <td>{{number_format($issue_material->issued_quantity,3,".","") }}</td>
            </tr>
            <tr>
                <th>Finished Batch No</th>
                <td>{{$issue_material->finished_batch_no}}</td>
            </tr>
            <tr>
                <th>Excess</th>
                <td>{{$issue_material->excess}}</td>
            </tr>
            <tr>
                <th>Wastage</th>
                <td>{{$issue_material->wastage}}</td>
            </tr>
            <tr>
                <th>Returned From Day Store</th>
                <td>{{$issue_material->returned_from_day_store}}</td>
            </tr>
            <tr>
                <th>Closing Bbalance Qty</th>
                <td>{{number_format($issue_material->closing_balance_qty,3,".","") }}</td>
            </tr>
            <tr>
                <th>Dispensed By</th>
                <td>{{$issue_material->name}}</td>
            </tr>
            <tr>
                <th>Remark</th>
                <td>{{$issue_material->remark}}</td>
            </tr>
         </table>
    </div>
</div>
