	<div class="form-row" >
				<div class="col-12">
					<h3>Supplier Details</h3>
				</div>
				<div class="col-12 table-responsive">
                     <table class="table table-hover table-bordered">
                         <tr>
                             <th>Supplier Name</th>
                             <td>{{ $supllier->name }}</td>
                         </tr>
                         <tr>
                            <th>City</th>
                            <td>{{ $supllier->city }}</td>
                        </tr>
                        <tr>
                            <th>State</th>
                            <td>{{ $supllier->state_name }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $supllier->address }}</td>
                        </tr>
                        <tr>
                            <th>Company Name</th>
                            <td>{{ $supllier->company_name }}</td>
                        </tr>
                        <tr>
                            <th>Contact Person Name</th>
                            <td>{{ $supllier->contact_per_name }}</td>
                        </tr>

                        <tr>
                            <th>Mobile Number</th>
                            <td>{{ $supllier->contact_no }}</td>
                        </tr>
                        <tr>
                            <th>Phone Number</th>
                            <td>{{ $supllier->phone_number }}</td>
                        </tr>
                        <tr>
                            <th>GST Number</th>
                            <td>{{ $supllier->gst_no }}</td>
                        </tr>
                        <tr>
                            <th>Pan Number</th>
                            <td>{{ $supllier->pan_no }}</td>
                        </tr>
                     </table>
				</div>
			</div>
