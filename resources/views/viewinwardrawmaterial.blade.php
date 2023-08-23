	<div class="form-row" >
				<div class="col-12">
					<h3>Inward Raw Material Items Details</h3>
				</div>
				<div class="col-12 table-responsive">

                     <table class="table table-hover table-bordered">
                         <tr>
                             <th width="30%">Inward Number</th>
                             <td>{{ $inward_material->inward_no }}</td>
                         </tr>
                         <tr>
                            <th>DATE OF RECEIPT	</th>
                            <td>{{isset($inward_material->date_of_receipt)?date("d/m/Y",$inward_material->date_of_receipt):""}}</td>
                        </tr>
                        <tr>
                            <th>OPENING BALANCE	</th>
                            <td>{{$inward_material->opening_stock}}</td>
                        </tr>
                        <tr>
                            <th>NAME OF MANUFACTURER	</th>
                            <td>{{$inward_material->man_name}}</td>
                        </tr>
                        <tr>
                            <th>NAME OF SUPPLIER</th>
                            <td>{{$inward_material->name}}</td>
                        </tr>
                        <tr>
                            <th>RAW MATERIAL NAME</th>
                            <td>{{$inward_material->material_name}}</td>
                        </tr>

                        <tr>
                            <th>INVOICE NUMBER</th>
                            <td>{{ $inward_material->invoice_no }}</td>
                        </tr>
                        <tr>
                            <th>GRN</th>
                            <td>{{ $inward_material->goods_receipt_no }}</td>
                        </tr>
                        <tr>
                            <th>Viscosity</th>
                            <td>{{ $inward_material->viscosity }}</td>
                        </tr>
                        <tr><th colspan="2"><b>Material Details</b></th></tr>
                        <tr>
                            <th>Ar No./Date</th>
                            <td>{{$inward_material->ar_no_date}}/{{$inward_material->ar_no_date_date}}</td>
                        </tr>

                        <tr>
                            <th>TOTAL QUANTITY (KG.)</th>
                            <td>{{ $inward_material->qty_received_kg }}</td>
                        </tr>
                        <tr>
                            <th>PACK SIZE</th>
                            <td>{{ $inward_material->mesurment }}</td>
                        </tr>
                        <tr>
                            <th>BATCH NO.</th>
                            <td>{{ $inward_material->batch_no }}</td>
                        </tr>
                        <tr>
                            <th>Is Opening Stock</th>
                            <td>{{ $inward_material->is_opening?"Yes":"No" }}</td>
                        </tr>
                        <tr>
                            <th>MFG. DATE</th>
                            <td>{{ $inward_material->mfg_date!=""?date("d/m/Y",($inward_material->mfg_date)):""}}</td>
                        </tr>
                        <tr>
                            <th>EXPIRY / RETEST DATE</th>
                            <td>{{ $inward_material->mfg_expiry_date!=""?date("d/m/Y",($inward_material->mfg_expiry_date)):""}}</td>
                        </tr>
                        <tr>
                            <th>RIOCARS’S EXPIRY / RETEST DATE
                            </th>
                            <td>{{ $inward_material->rio_care_expiry_date!=""?date("d/m/Y",($inward_material->rio_care_expiry_date)):"" }}</td>
                        </tr>

                        <tr><th colspan="2">Other Details</th></tr>
                        <tr>
                            <th>Created By
                            </th>
                            <td>{{ $inward_material->uname }}</td>
                        </tr>
                        <tr>
                            <th>Date and Time
                            </th>
                            <td>{{ $inward_material->created_at!=""?date("d/m/Y",strtotime($inward_material->created_at)):""}}</td>
                        </tr>
                        <tr>
                            <th>Note / Remark
                            </th>
                            <td>{{ $inward_material->remark }}</td>
                        </tr>
                     </table>
				</div>
			</div>
