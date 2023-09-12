
<div class="container-scroller">

    <div class="container-fluid p-3">
      <!-- Main Container -->
    <div style="display:block;padding:20px;border:2px solid #000;height:15.4in; position: relative">
		<table width="100%" cellpadding="10" cellspacing="0" border="0">
			<tr>
				<td width="80"><img src="{{asset('pdf/assets/img/print_logo.png')}}" style="width:80px;height:auto;"></td>
				<td style="text-align:center;"><h2 style="font-family: serif;font-size: 2rem;">RioCare India Private Limited</h2><p style="font-family:serif;font-size:1rem;font-weight:bold;">Plot R-940,TTC Industrial Area, MIDC Rabale, Navi Mumbai-400701, District Thane,Maharashtra, INDIA.</p></td>
				<td width="80">&nbsp;</td>
			</tr>
		</table>
		<div style="padding:2rem 0;text-align:center;text-decoration:underline;font-size:1.4rem;font-weight:bold;color:#313131;">Batch Manufacturing Record</div>
		@if(isset($manufacture) && $manufacture)
			<table width="100%" cellpadding="10" cellspacing="0" border="0" class="heading-tbl">
				<tr>
					<td>
						<table width="auto" cellpadding="5" cellspacing="0" border="0" style="font-size:1.1rem;font-weight:bold;font-family:serif;margin:0 1.2rem 1.5rem;line-height:1.5;">
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
						<table width="auto" cellpadding="5" cellspacing="0" border="0" style="font-size:1.1rem;font-weight:bold;font-family:serif;margin:0 1.2rem 1.5rem;line-height:1.5;">
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
			<table class="table table-bordered">
				<thead>
					<tr>
						<th colspan="2">Product Name: Simethicone (Filix-110)</th>
					</tr>
					<tr>
						<th>Batch No.: {{$manufacture->batchNo}}</th>
						<th>Grade: {{$manufacture->grade}}</th>
					</tr>
					<tr>
						<th>Batch Size:  {{$manufacture->BatchSize}} Kg</th>
						<th>Viscosity: {{$manufacture->Viscosity}}</th>
					</tr>
					<tr>
						<th>Production Commenced on: {{date("d-m-Y", strtotime($manufacture->ProductionCommencedon))}}</th>
						<th>Production Completed on: {{date("d-m-Y", strtotime($manufacture->ProductionCompletedon))}}</th>
					</tr>
					<tr>
						<th>Manufacturing Date: {{ date("d-m-Y", strtotime($manufacture->ManufacturingDate))}}</th>
						<th>Retest Date: {{ date("d-m-Y", strtotime($manufacture->RetestDate))}}</th>
					</tr>
				</thead>
			</table>
			
			<div style="margin:1rem 0 3rem;font-weight:400;"> This batch has been produced according to instruction given MFR no. {{$manufacture->refMfrNo}} as mentioned above.</div>
			<table width="50%" cellpadding="5" cellspacing="0" border="0" style="">
				<tr>
					<td>Deviation sheet attached: @if ($manufacture->approval == 1) {{'Yes'}} @else {{'No'}} @endif <br><br></td>
				</tr>
				<tr>
					<td>Prepared by: <span style="display:inline-block;margin-left:2rem;min-width:50%;vertical-align:top;text-align:center;"><span style="display:block;border-bottom:2px solid #000;min-width:100%;margin-bottom:5px;">{{$manufacture->doneby}}</span>(Officer-Production)</span><br><br></td>
				</tr>
				<tr> <br><br>	
					<td>Checked by: <span style="display:inline-block;margin-left:2rem;min-width:50%;vertical-align:top;text-align:center;"><span style="display:block;border-bottom:2px solid #000;min-width:100%;margin-bottom:5px;">{{$manufacture->usercheck}}</span>(Production Manager)</span><br><br></td>
				</tr>
			</table>
			<!-- <table width="100%" cellpadding="0" cellspacing="0" border="0" style="font-size:1rem;font-weight:bold;font-family:serif;margin:0 1.2rem 1.5rem;line-height:1.5;">
				<thead>
					<tr>
						<th width="40%">Batch No.<br /><br /><br /><br /></th>
						<th valign="top" width="10">:</th>
						<th valign="top">{{$manufacture->batchNo?"Yes":"No"}}</th>
					</tr>
					<tr>
						<th width="40%">The batch is approved / not approved on<br /><br /><br /><br /></th>
						<th valign="top" width="10">:</th>
						<th valign="top">{{$manufacture->approval?"Yes":"No"}}</th>
					</tr>
					<tr>
						<th width="40%">Reviewed and Approved by<br /><br /><br /><br /></th>
						<th valign="top" width="10">:</th>
						<th valign="top"><span style="display:inline-block;margin-left:2rem;min-width:100px;vertical-align:top;text-align:center;"><span style="display:block;border-bottom:2px solid #000;min-width:100%;margin-bottom:5px;">{{ $manufacture->qcname }}</span>(Manager QA)</span></th>
					</tr>
				</thead>
			</table> -->
			
		@endif
		<!-- <span class="page-number" >Page No: 1 </span> -->
		</div>
			
	</div>
	
</div>
<style>
	
</style>