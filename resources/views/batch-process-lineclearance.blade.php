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
			@if(!empty($reactor_details) && !empty($reactor_details[0]) && $reactor_details[0]->group_id == 3 )
			<div style="padding:1rem 0;text-align:left;text-decoration:underline;font-size:1.2rem;font-weight:bold;color:#616161;">
			Equipment Status:</div>
			@else
			<div style="padding:1rem 0;text-align:left;text-decoration:underline;font-size:1.2rem;font-weight:bold;color:#616161;">
			Reactor Status:</div>

			@endif

				<table class="table table-bordered" >
				<thead>
					<tr>
						<th rowspan="2">Sr. No.</th>
						<th rowspan="2">Particular</th>
						<th rowspan="2"></th>
						<th rowspan="2">Date</th>
						<th>Production</th>
						<th>Quality Assurance</th>
					</tr>
				</thead>

					<tr>
						<td>1</td>
						<td>Batch Number:Last batch produced</td>
						<td>{{ isset($lastmanufacture->batchNo)?$lastmanufacture->batchNo:""}}</td>
						<td>{{ isset($lastmanufacture->created_at)?date("d/m/Y",strtotime($lastmanufacture->created_at)):""}}</td>
						<td>{{ isset($lastmanufacture->doneby)?$lastmanufacture->doneby:""}}</td>
						<td>{{ isset($lastmanufacture->qcname)?$lastmanufacture->qcname:""}}</td>
					</tr>
					@php  $i=2;  @endphp
					@foreach($reactor_details as $val)
					<tr>
						<td>{{$i}}</td>
						<td>{{$val->rector_status}}</td>
						<td>{{$val->batch_name}}</td>
						<td>{{ isset($val->date)?date("d/m/Y",strtotime($val->date)):""}}</td>
						<td>{{ isset($lastmanufacture->doneby)?$lastmanufacture->doneby:""}}</td>
						<td>{{ isset($lastmanufacture->qcname)?$lastmanufacture->qcname:""}}</td>
					</tr>
					@php  $i++;  @endphp
					@endforeach
				
				<!-- @if(isset($selected_equipment) && $selected_equipment)
                     @php $reactors = array();
                          $homo = array();
                        foreach($selected_equipment as $val)
                        {
                            if(strpos($val->equipment,'Reactor') >0)
                                $reactors[] = $val;

                            if(strpos($val->equipment,'Homogenising') >0)
                                $homo[] = $val;
                        }

                     @endphp


                        <tr>
                            <td rowspan="{{ count($reactors)+1 }}">2</td>
                            <td colspan="5">Reactor cleaned on - <i>(Cleaning Frequency - Once in 3 months)</i></td>
                        </tr>

                        @foreach($reactors as $val)
                        <tr>
                            <td>{{ $val->code }}</td>
							<td></td>
                            <td>{{ isset($val->created_at)?date("d/m/Y",strtotime($val->created_at)):""}}</td>
                            <td>{{ isset($manufacture->doneby)?$manufacture->doneby:""}}</td>
                            <td>{{ isset($manufacture->qcname)?$manufacture->qcname:""}}</td>
                        </tr>

                        @endforeach
                    @endif

                    @if(isset($homo) && $homo)
                        <tr>
                            <td rowspan="{{ count($homo)+1 }}">3</td>
                            <td colspan="5">Homogenizing tank cleaned on - <i>(Cleaning Frequency - Once in 3 months)</i></td>
                        </tr>
                        @foreach($homo as $val)
                        <tr>
                            <td>{{ $val->code }}</td>
							<td></td>
                            <td>{{ isset($val->created_at)?date("d/m/Y",strtotime($val->created_at)):""}}</td>
                            <td>{{ isset($manufacture->doneby)?$manufacture->doneby:""}}</td>
                            <td>{{ isset($manufacture->qcname)?$manufacture->qcname:""}}</td>
                        </tr>
                        @endforeach
                    @endif

					 <tr>
						<td>4</td>
						<td>Sieve Mesh integrity cleaned checked</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>{{ isset($manufacture->doneby)?$manufacture->doneby:""}}</td>
                        <td>{{ isset($manufacture->qcname)?$manufacture->qcname:""}}</td>
						
					</tr> -->
			</table>
		@endif
		<!-- <span class="page-number" >Page No: 6 </span> -->
	</div>
</div>
