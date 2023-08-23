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

		@if(isset($homo) && $homo)

		<table width="100%" cellpadding="0" cellspacing="0" border="0" class="heading-tbl">
			<tr>
				<td>
					<table width="100%	" cellpadding="5" cellspacing="0" border="0" style="font-size:1.1rem;font-weight:bold;font-family: serif;margin:0 0rem 1rem;line-height:1.2;">
						<tr>
							<td>Homogenizing tank No: <span style="font-weight:400;">{{$homo->code}}</span></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<table class="table table-bordered" style="border-top: 2px solid #000">
			<thead>
				<tr>
					<th rowspan="2">Date</th>
					<th rowspan="2">Process</th>
					<th rowspan="2">Qty. (Kg.)</th>
					<th colspan="2">Time (Hrs)</th>
					<th rowspan="2">Done By</th>
					<th rowspan="2">checked By</th>
				</tr>
				<tr>
					<th>Start</th>
					<th>End</th>
				</tr>
			</thead>
			@if(isset($homolist) && $homolist)
				@foreach($homolist as $hom)
				<tr>
					<td>{{$hom->dateProcess}}</td>
					<td>{{$hom->lots_name}}</td>
					<td>{{$hom->qty}}</td>
					<td>{{$hom->stratTime}}</td>
					<td>{{$hom->endTime}}</td>
					<td>{{$hom->doneby}}</td>
					<td>{{$hom->doneby}}</td>
				</tr>
				@endforeach
			@endif

			</table>
			<table width="100%" cellpadding="10" cellspacing="0" border="0" style="font-size:1rem;font-weight:400;font-family: serif;margin:1rem 0rem 0rem;line-height:1.2;">
				<tr>
					<th style="text-align:left;" width="15%">In Process Check<br />(After 4 Lot)<br /><br /><br /></th>
					<th valign="top" width="1%">:</th>
					<td valign="top">{!!$homo->proecess_check!!}</td>
				</tr>
				<tr>
					<th style="text-align:left;" width="15%">Observed value</th>
					<th width="1%">:</th>
					<td>{{$homo->Observedvalue}} cSt</td>
				</tr>
			</table>
			@endif
		@endif
		<!-- <span class="page-number" >Page No: 8 </span> -->
		</div>
	</div>
</div>
