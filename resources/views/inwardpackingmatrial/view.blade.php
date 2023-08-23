	<div class="form-row" >
				<div class="col-12">
					<h3>Inward Packing  Material Details</h3>
				</div>
				<div class="col-12 table-responsive">
                     <table class="table table-hover table-bordered">
                         <tr>
                             <th>Packing Material From</th>
                             <td>{{ $matarial->goods_going_from_name }}</td>
                         </tr>
                         <tr>
                            <th>Packing Material To</th>
                            <td>{{ $matarial->goods_going_to_name }}</td>
                        </tr>
                        <tr>
                            <th>Date of Receipt</th>
                            <td>{{ $matarial->date_of_receipt }}</td>
                        </tr>
                        <tr>
                            <th>Name of Material</th>
                            <td>{{ $matarial->material_name }}</td>
                        </tr>
                        <tr>
                            <th>Name of Manufacturer</th>
                            <td>{{ $matarial->manufacturer }}</td>
                        </tr>
                        <tr>
                            <th>Name of Supplier</th>
                            <td>{{ $matarial->name }}</td>
                        </tr>
                        <tr>
                            <th>Invoice No.</th>
                            <td>{{ $matarial->invoice_no }}</td>
                        </tr>

                        <tr>
                            <th>Goods Receipt No.</th>
                            <td>{{ $matarial->goods_receipt_no }}</td>
                        </tr>
                        <tr>
                        <th> Total Quantity Received (Nos.)</th>
                         <td>{{ number_format($matarial->total_qty,3,".","") }}</td>
                        </tr>
                        <tr>
                            <th colspan="2">
                                Material Details
                            </th>
                        </tr>
                        <tr>
                            <th colspan="2">
                                @if(isset($items))
                                <table class="table table-hover table-bordered">
                                    <tr>
                                        <th>Packing Material Name</th>
                                        <th>Total Quantity Received (Nos.)</th>
                                        <th>AR No. / Date</th>
                                    </tr>
                                    @foreach($items as $value)
                                        <tr>
                                            <td>{{ $value->material_name }}</td>
                                            <td>{{ number_format($value->total_qty,3,".","") }}</td>
                                            <td>{{ $value->ar_no_date }} {{ $value->ar_no_datedate !="0000-00-00 00:00:00" ?date("d/m/Y",strtotime($value->ar_no_datedate)):"-" }} </td>
                                        </tr>
                                    @endforeach
                                </table>
                                @endif
                            </th>
                        </tr>

                        <tr>
                            <th>Remark</th>
                            <td>{{ $matarial->remark }}</td>
                        </tr>
                        <tr>
                            <th>Submited By</th>
                            <td>{{ $matarial->uname }}</td>
                        </tr>
                        <tr>
                            <th>Submited Time</th>
                            <td>{{ $matarial->created_at }}</td>
                        </tr>
                     </table>
				</div>
			</div>
