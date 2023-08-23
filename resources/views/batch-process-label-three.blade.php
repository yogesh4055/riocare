@if(isset($lables) && $lables)
@if($lables->net_wt_5 && $lables->tare_wt_5)
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
							@if(isset($lables) && $lables)
									<div style="padding:1rem 0;text-align:center;text-decoration:underline;font-size:1.4rem;font-weight:bold;color:#313131;">PRODUCT LABEL 25 kg Drums</div>
									<div style="padding:2rem;text-align:center;margin:1.5rem;border:2px solid #000;">
										<div style="padding:0rem 0 1rem;text-align:center;font-size:1.1rem;font-weight:bold;color:#313131;">{{strtoupper($manufacture->material_name)}}   -100%</div>
										<div style="padding:1rem 0;text-align:center;font-size:1.1rem;font-weight:bold;color:#313131;">FILIX -110</div>
										<table width="100%" cellpadding="10" cellspacing="0" border="0" class="heading-tbl">
											<tr>
												<td>
													<table width="auto" cellpadding="5" cellspacing="0" border="0" style="font-size:1.1rem;font-weight:bold;font-family: serif;margin:0 1.2rem 0rem;line-height:1.1;text-align:left !important;">
														<tr>
															<td>BATCH NO.</td>
															<td>:</td>
															<td>{{$manufacture->batchNo}}</td>
														</tr>
														<tr>
															<td>MFG DATE</td>
															<td>:</td>
															<td>{{ date("d-M-Y", strtotime($lables->mfg_date))}} </td>
														</tr>
														<tr>
															<td>RETEST DATE</td>
															<td>:</td>
															<td>{{ date("d-M-Y", strtotime($lables->mfg_date))}}</td>
														</tr>
													</table>
												</td>
												<td>
													<table width="auto" cellpadding="5" cellspacing="0" border="0" style="font-size:1.1rem;font-weight:bold;font-family: serif;margin:0 1.2rem 0rem;line-height:1.1;text-align:left !important;">
														<tr>
															<td>&nbsp;</td>
															<td>&nbsp;</td>
															<td>&nbsp;</td>
														</tr>
														<tr>
															<td>NET WT</td>
															<td>:</td>
															<td>{{$lables->net_wt_5}} KG</td>
														</tr>
														<tr>
															<td>TARE WT</td>
															<td>:</td>
															<td>{{$lables->tare_wt_5}} KG</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
										<div style="padding:1rem 0 2rem;text-align:center;font-size:1rem;font-weight:bold;color:#000;line-height:1.5;">Drug Mfg. Lic. No. &nbsp; &nbsp; &nbsp; MH/101560<br />Manufacture By:<br />RioCare India Private Limited<br />Plot R-940, TTC Indl. Area,<br />MIDC Rabale, Navi Mumbai – 400 701, District : Thane .<br />Maharashtra, INDIA.</div>


									</div>
							@endif
						@endif
				</div>
			</div>
		</div>

	@endif
    @endif