<!DOCTYPE html>
<html lang="en" style="background: #ffffff;font-size:16px;">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>RIO Care India PVT LTD :: Inventory and Stock Management</title>
  <link rel="stylesheet" href="{{asset('pdf/assets/mdbootstrap4/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('pdf/assets/mdbootstrap4/mdb.min.css')}}">
  <link rel="stylesheet" href="{{asset('pdf/assets/mdbootstrap4/mdb-plugins-gathered.min.css')}}">


  <link rel="stylesheet" href="{{asset('pdf/assets/css/style.css')}}">
  <!-- end inject -->
  <style>
	table td,table th {
		font-size: 1rem;
		font-weight: 600;
	}
	.heading-tbl td {
		font-size: 1.1rem;
		font-weight: 800;
	}
    .table-bordered {
    border: 2px solid #000000;
    }
    .table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #000000;
    }
    .table-bordered td, .table-bordered th {
    border: 2px solid #000000
    }
	@media print {
    .pagebreak { page-break-before: always; } /* page-break-after works, as well */
    table td,table th {
		font-size: 1rem;
		font-weight: 600;
	}
	.heading-tbl td {
		font-size: 1.1rem;
		font-weight: 800;
	}
    .table-bordered {
    border: 2px solid #000000;
    }
    .table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #000000;
    }
    .table-bordered td, .table-bordered th {
    border: 2px solid #000000
    }
}
	.page-number{
		text-align: right;
		position: relative;
		
		right: 33px;
		display: block;
		bottom: 44px;
	}
  </style>
</head>
<body style="background: #ffffff;font-size:16px;font-weight:bold;">

	@include("batch-process1")
	<div class="pagebreak"> </div>
	<span class="page-number" >Page No 1 </span>
	@include("batch-process-instruction")
	<div class="pagebreak"> </div>
	<span class="page-number" >Page No 2 </span>
	@include("batch-process-rawmaterial")
	<div class="pagebreak"> </div>
	<span class="page-number" >Page No 3 </span>
	@include("batch-process-packingmaterial")
	<div class="pagebreak"> </div>
	<span class="page-number" >Page No 4 </span>
	@include("batch-process-listequipment")
	<div class="pagebreak"> </div>
	<span class="page-number" >Page No 5 </span>
	@include("batch-process-lineclearance")
	<div class="pagebreak"> </div>
	<span class="page-number" >Page No 6 </span>


	 <?php if($manufacture->material_name =="Simethicone Emulsion-30% (Simul-73)" || $manufacture->material_name =='Silicone Emulsion (Remsil-35)') {?>

	@include("batch-process-mixing")
	<div class="pagebreak"> </div>
	<span class="page-number" >Page No 7 </span>

<?php } ?>

<!-- 24.  In Simethicone BMR, after 4 lots there should be first Homogenizing and then 5th lot followed by final Homogenizing -->
	
	@php $count = 8 ;@endphp
	@if(isset($lotsdetails) && $lotsdetails)
	 @php $l =0; @endphp
	 @foreach($lotsdetails as $lot)
		@include("batch-process-lots",array("lot"=>$lot,"process"=>$process[$l],"rawmaterial"=>$lotsrawmaterials[$l]))
		<div class="pagebreak"> </div>
		<span class="page-number" >Page No {{$count}} </span> 
		@php $l++;
			$count = $count + 1;
		@endphp
	 @endforeach
	@endif
	
	

	@if(isset($Homogenizing) && $Homogenizing)
	 @php $l =0; $counts = $count ; @endphp
	<?php if($manufacture->material_name =="Simethicone (Filix-110)") {?>
	 @foreach($Homogenizing as $hom)
		@include("batch-process-homogenizing",array("homo"=>$hom,"homolist"=>$homoList[$hom->id]))
		<div class="pagebreak"></div>
		<span class="page-number" >Page No {{$counts}} </span>
		@php $l++;
			$counts = $counts + 1;
		 @endphp
	 @endforeach
	 <?php } ?>
	@endif



	@include("batch-process-packing")
	<div class="pagebreak"></div>
	<span class="page-number" >Page No {{$counts}} </span>

	@if(isset($lables) && $lables)
	@if($lables->net_wt_200 !='' || $lables->tare_wt_200 !='')
	@include("batch-process-label")
	<div class="pagebreak"></div>
	<span class="page-number" >Page No {{$counts + 1}} </span>
	@endif

	@if($lables->net_wt_50 !='' || $lables->tare_wt_50 !='')
	@include("batch-process-label-one")
	<div class="pagebreak"></div>
	<span class="page-number" >Page No {{$counts + 2}} </span>
	@endif

	@if($lables->net_wt_30 !='' || $lables->tare_wt_30 !='')
	@include("batch-process-label-two")
	<div class="pagebreak"></div>
	<span class="page-number" >Page No {{$counts + 3}} </span>
	@endif

	@if($lables->net_wt_5 !='' || $lables->tare_wt_5 !='')
	@include("batch-process-label-three")
	<span class="page-number" >Page No {{$counts + 4}} </span>
	@endif

	@if($lables->net_wtb_25 !='' || $lables->tare_wtb_25 !='')
	@include("batch-process-label-four")
	<span class="page-number" >Page No {{$counts + 5}} </span>
	@endif
	
	@if($lables->net_wtb_50 !='' || $lables->tare_wtb_50 !='')
	@include("batch-process-label-five")
	<span class="page-number" >Page No {{$counts + 6}} </span>
	@endif
	@endif
</body>
