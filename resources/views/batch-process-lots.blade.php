<div class="container-scroller">
    <div class="container-fluid p-3">
      <!-- Main Container -->
    	<div style="display:block;padding:20px;border:2px solid #000;height:15.2in;position: relative">
		<table width="100%" cellpadding="10" cellspacing="0" border="0">
			<tr>
				<td width="80"><img src="{{asset('pdf/assets/img/print_logo.png')}}" style="width:80px;height:auto;"></td>
				<td style="text-align:center;"><h2 style="font-family: serif;font-size: 2rem;">RioCare India Private Limited</h2><p style="font-family: serif;font-size:1rem;font-weight:bold;">Plot R-940,TTC Industrial Area,MIDC Rabale,Navi Mumbai-400701,District Thane,Maharashtra ,INDIA.</p></td>
				<td width="80">&nbsp;</td>
			</tr>
		</table>
		<!-- <span class="page-number" >Page No: 7 </span> -->
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
		<div style="padding:1rem 0;text-align:center;text-decoration:underline;font-size:1.2rem;font-weight:bold;color:#313131;">Process Sheet</div>
		@if(isset($lot) && $lot)
		<table width="100%" cellpadding="10" cellspacing="0" border="0" class="heading-tbl">
				<td>
					<table width="100%	" cellpadding="5" cellspacing="0" border="0" style="font-size:1.1rem;font-weight:bold;font-family: serif;margin:0 1.2rem 0rem;line-height:1.2;">
						@if($lot->is_water == 1)
						<tr>
							<td width="30%">Purified water:</td>
							<td>Quantity(Kg). : <span style="font-weight:400;">{{$lot->waterQty}}</span></td>
							<td>AR No. : <span style="font-weight:400;">{{$lot->waterARN}}</span></td>
						</tr>
						@endif
						<tr>
							<td width="30%">Lot No.: {{$lot->lotNo}}</td>
							<td>Reactor No.: <span style="font-weight:400;">{{$lot->code}}</span></td>
							<td width="30%">Date:{{$lot->Process_date}}</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<table class="table table-bordered" style="margin-bottom:2.5rem;border:2px solid #000;">
			<thead>
				<tr>
					<th width="50%">Raw Material</th>
					<th>Batch No.</th>
					<th>Qty (Kg.)</th>
				</tr>
			</thead>
			@if(isset($rawmaterial) && $rawmaterial)
				@foreach($rawmaterial  as $mat)
				<tr>
					<td>{{$mat->material_name}}</td>
					<td>{{$mat->batch_no}}</td>
					<td>{{$mat->Quantity}}</td>
				</tr>

				@endforeach
			@endif

		</table>
		<table class="table table-bordered" style="margin-bottom:2.5rem;border:2px solid #000;">
			<thead>
				<tr>
					<th rowspan="2" width="40%">Process</th>
					<th rowspan="2">Qty. (Kg.)</th>
					<th rowspan="2">Temp (<sup>o</sup>C)</th>
					<th colspan="2">Time (Hrs)</th>
					<th rowspan="2">Done By</th>
					<th rowspan="2">checked By</th>
				</tr>
				<tr>
					<th>Start</th>
					<th>End</th>
				</tr>
			</thead>
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
		@endif
		@endif
		<!-- <span class="page-number" >Page No: 7 </span> -->
	</div>
</div>
</div>
