<div class="container-scroller">

    <div class="container-fluid p-3">
      <!-- Main Container -->
    <div style="display:block;padding:20px;border:2px solid #000;height:15.2in;position: relative">
		<table width="100%" cellpadding="10" cellspacing="0" border="0">
			<tr>
				<td width="80"><img src="{{asset('pdf/assets/img/print_logo.png')}}" style="width:80px;height:auto;"></td>
				<td style="text-align:center;"><h2 style="font-family: serif;font-size: 2rem;">RioCare India Private Limited</h2><p style="font-family:serif;font-size:1rem;font-weight:bold;">Plot R-940,TTC Industrial Area,MIDC Rabale,Navi Mumbai-400701,District Thane,Maharashtra ,INDIA.</p></td>
				<td width="80">&nbsp;</td>
			</tr>
		</table>
		<div style="padding:2rem 0;text-align:center;text-decoration:underline;font-size:1.4rem;font-weight:bold;color:#000;">Batch Manufacturing Record</div>
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
						<table width="auto" cellpadding="5" cellspacing="0" border="0" style="font-size:1.1rem;font-weight:bold;font-family: serif;margin:0 1.2rem 1.5rem;line-height:1.5;">
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
			<div style="padding:2rem 0;text-align:center;text-decoration:underline;font-size:1.4rem;font-weight:bold;color:#000;margin-bottom:2rem">General Instruction for Manufacturing.</div>
			<div style="padding:2rem 0 0;text-align:left;text-decoration:underline;font-size:1.1rem;font-weight:bold;color:#000;margin-bottom:15px">Precaution for Safety:</div>
			<div style="padding:0rem 0 0 1rem;text-align:left;font-size:1rem;font-weight:400;color:#000;margin-bottom:10px;">1) Use Hand gloves, Nose mask and safety goggles while handling raw materials.</div>
			<div style="padding:0rem 0 0 1rem;text-align:left;font-size:1rem;font-weight:400;color:#000;margin-bottom:10px;">2) Use Hand gloves, Nose mask while handling finished product.</div>
			<div style="padding:0rem 0 0 1rem;text-align:left;font-size:1rem;font-weight:400;color:#000;margin-bottom:10px;">3) Follow personal hygiene requirements.</div>

			<div style="padding:2rem 0 0;text-align:left;text-decoration:underline;font-size:1.1rem;font-weight:bold;color:#000;margin-bottom:15px">Precaution for Safety:</div>
			<div style="padding:0rem 0 0 1rem;text-align:left;font-size:1rem;font-weight:400;color:#000;margin-bottom:10px;">a) Manufacturing has to be carried as per requirements of current GMP.</div>
			<div style="padding:0rem 0 0 1rem;text-align:left;font-size:1rem;font-weight:400;color:#000;margin-bottom:10px;">b) Use clean and dry S.S equipments at all stages of manufacturing.</div>
			<div style="padding:0rem 0 0 1rem;text-align:left;font-size:1rem;font-weight:400;color:#000;margin-bottom:10px;">c) Before weighing operation check cleanliness of balance.</div>
			<div style="padding:0rem 0 0 1rem;text-align:left;font-size:1rem;font-weight:400;color:#000;margin-bottom:10px;">d) All ingredients must have been approved by QC and Within expiry/retest date.</div>
			<div style="padding:0rem 0 0 1rem;text-align:left;font-size:1rem;font-weight:400;color:#000;margin-bottom:10px;">e) Batch size may vary, depending upon requirement. Prior permission should be obtained from QA.</div>
		@endif
		<!-- <span class="page-number" >Page No: 2 </span> -->
		</div>
		
	</div>
</div>
