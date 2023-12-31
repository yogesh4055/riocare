<div class="container-scroller">

    <div class="container-fluid p-3">
      <!-- Main Container -->
    <div style="display:block;padding:20px;border:2px solid #000;height:15.2in; position: relative">
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
			<div style="padding:1rem 0;text-align:left;text-decoration:underline;font-size:1.2rem;font-weight:bold;color:#616161;">Bill of Packaging Material Details and Weighing Record:</div>
            <div style="padding:1rem 0;text-align:left;text-decoration:underline;font-size:0.8rem;font-weight:bold;color:#616161;">Requisition Bill of Packaging Material Details</div>
			@if(isset($raw_material_bills_packing) && count($raw_material_bills_packing) >0)
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>S. No.</th>
							<th>Material</th>
							<th>Requisition Quantity<br />(Kg.)</th>
							<!--<th>Checked<br />By</th> -->
						</tr>
					</thead>
					@php $i =1; @endphp
					@foreach($raw_material_Requisitpacking as $mat)
						@foreach($mat as $det)
						<tr>
							<td>{{$i}}</td>
							<td>{{$det->material_name}}</td>
							<td>{{$det->approved_qty}}</td>
							<!--<td>{{isset($Requisitmaterialpacking[0])?$Requisitmaterialpacking[0]->checkby:""}}</td> -->

						</tr>
						@php $i++; @endphp
						@endforeach
					@endforeach

				</table>
                <div style="padding:1rem 0;text-align:right;text-decoration:underline;font-size:0.8rem;font-weight:bold;color:#616161;">
				<span style="display:inline-block;margin-right:2rem;min-width:10%;vertical-align:top;text-align:center;">
				<span style="display:block;border-bottom:2px solid #000;min-width:100%;margin-bottom:5px;">{{$manufacture->doneby}}</span>(Production Officer)</span></div>
			@endif
            <div style="padding:1rem 0;text-align:left;text-decoration:underline;font-size:0.8rem;font-weight:bold;color:#616161;">Issual of Requisition Packaging Material Details</div>
            @if(isset($raw_material_bills_packing) && count($raw_material_bills_packing) >0)
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>S. No.</th>
							<th>Material</th>
							<th>Issual Quantity<br />(Kg.)</th>
							<th>Batch No.</th>
							<th width="20%">AR No. / Date</th>
							<th>Weighed<br />By</th>
							<!--<th>Checked<br />By</th> -->
						</tr>
					</thead>
					@php $i =1; @endphp
					@foreach($raw_material_bills_packing as $mat)
						@foreach($mat as $det)
						<tr>
							<td>{{$i}}</td>
							<td>{{$det->material_name}}</td>
							<td>{{$det->approved_qty}}</td>
							<td>{{$det->batch_no}}</td>
							<td>{{$det->ar_no_date}}</td>
							<td>{{isset($Requisitionissuedmaterial[0])?$Requisitionissuedmaterial[0]->checkby:""}}</td>
							<!--<td>{{isset($Requisitionissuedmaterial[0])?$Requisitionissuedmaterial[0]->approvedby:""}}</td> -->
						</tr>
						@php $i++; @endphp
						@endforeach
					@endforeach

				</table>
                <div style="padding:1rem 0;text-align:right;text-decoration:underline;font-size:0.8rem;font-weight:bold;color:#616161;">
					<span style="display:inline-block;margin-right:2rem;min-width:10%;vertical-align:top;text-align:center;">
					<span style="display:block;border-bottom:2px solid #000;min-width:100%;margin-bottom:5px;">{{$manufacture->doneby}}</span>(Manager-Store)</span>
				</div>
			@endif
			<!-- <span class="page-number" >Page No: 4 </span> -->
			</div>
		@endif

		</div>
	</div>
</div>
