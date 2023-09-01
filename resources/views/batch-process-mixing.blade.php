<div class="container-scroller">

    <div class="container-fluid p-3">
      <!-- Main Container -->

	<div style="display:block;padding:20px;border:2px solid #000;min-height:15.2in;position: relative">
	 	<table width="100%" cellpadding="10" cellspacing="0" border="0">
			<tr>
				<td width="80"><img src="{{asset('pdf/assets/img/print_logo.png')}}" style="width:80px;height:auto;"></td>
				<td style="text-align:center;"><h2 style="font-family: serif;font-size: 2rem;">RioCare India Private Limited</h2><p style="font-family: serif;font-size:1rem;font-weight:bold;">Plot R-940,TTC Industrial Area,MIDC Rabale,Navi Mumbai-400701,District Thane,Maharashtra ,INDIA.</p></td>
				<td width="80">&nbsp;</td>
			</tr>
		</table>
		<div style="padding:1rem 0;text-align:center;text-decoration:underline;font-size:1.4rem;font-weight:bold;color:#313131;">Batch Manufacturing Record</div>
		@if(isset($manufacture) && $manufacture)
			<table width="100%" cellpadding="10" cellspacing="0" border="0" class="heading-tbl">
				<tr>
					<td>
						<table width="auto" cellpadding="5" cellspacing="0" border="0" style="font-size:1.1rem;font-weight:bold;font-family: serif;margin:0 1.2rem 0rem;line-height:1.2;">
							<tr>
								<td>Product name</td>
								<td>:</td>
								<td>{{$manufacture->material_name}}</td>
							</tr>
							<tr>
								<td>Batch No.</td>
								<td>:</td>
								<td>{{$manufacture->batchNo}}</td>
							</tr>
						</table>
					</td>
					<td>
						<table width="auto" cellpadding="5" cellspacing="0" border="0" style="font-size:1.1rem;font-weight:bold;font-family: serif;margin:0 1.2rem 0rem;line-height:1.2;">
							<tr>
								<td>BMR No.</td>
								<td>:</td>
								<td>{{$manufacture->bmrNo}}</td>
							</tr>
							<tr>
								<td>Ref. MFR No.</td>
								<td>:</td>
								<td>{{$manufacture->refMfrNo}}</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<div style="padding:1rem 0;text-align:left;text-decoration:underline;font-size:1.2rem;font-weight:bold;color:#616161;">
			Mixing:</div>
			<div align="right">Date: {{ isset($mixing->date) ? date('d-m-Y',strtotime($mixing->date)) : '' }}</div>
				<table class="table table-bordered" >
				<thead>
					<tr>
                        <th rowspan="2">Process</th>
                        <th rowspan="2">Qty. (Ltr.)</th>
                        <th colspan="2">Time (Hrs)<br>Start | End</th>
                        <th rowspan="2">Done by</th>
                        <th rowspan="2">Checked by</th>
                    </tr>
				</thead>
				<tbody>
					<tr>
                        <td> Adds Hydrogen Peroxide and stirs for 30 minutes </td>
                        <td>{{isset($mixing) ? $mixing->qty_kg : ''}}</td>
                        <td>{{isset($mixing) ? $mixing->start_time : ''}}</td>
                        <td>{{isset($mixing) ? $mixing->end_time : ''}}</td>
                        <td>{{isset($doneBy) ? $doneBy->name : ''}}</td>
                        <td>{{isset($checkedBy) ? $checkedBy->name : ''}}</td>
                    </tr>
                </tbody>		
			</table>
			<table class="table table-bordered" cellpadding="0" cellspacing="0" border="0">
                    <thead>
                        <tr>
                            <th>Process</th>
                            <th>Qty. (Ltr.)</th>
                            <th>Final pH</th>
                            <th>Done by</th>
                            <th>Checked by</th>
                        </tr>
                    </thead>
                    <tbody>           
                        <tr>
                            <td> For correcting pH (Quantity : {{isset($mixing) ? $mixing->process_qty : ''}} kg.) O-Phosporic acid is added to achieve the desired pH. </pre></td>
                            <td>{{isset($mixing) ? $mixing->qty_ltr : ''}}</td>
                            <td>{{isset($mixing) ? $mixing->final_pH : ''}}</td>
                            <td>{{isset($doneBy1) ? $doneBy1->name : ''}}</td>
                            <td>{{isset($checkedBy1) ? $checkedBy1->name : ''}}</td>
                        </tr>
                    </tbody>
                </table>
		@endif
	</div>
</div>
