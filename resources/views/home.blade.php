@extends('layouts.app')
@section("title","Dashboard")
@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
      <div class="row page-heading">
        <div class="col-12 col-xl-8 mb-xl-0 align-self-center align-items-center d-flex">
          <h4 class="font-weight-bold"><i class="menu-icon" data-feather="home"></i>Dashboard</h4>
        </div>
      </div>
    </div>
  </div>
  <div class="row dashboard">
    <div class="col-12 col-lg-8">
        <div class="card main-blocks">
            <div class="card-body">
                <div class="row ml-0">
                    <div class="col-12 col-lg-4">
                        <i class="icon manufacture"></i>
                        <p>Today's Production</p>
                        <h2>{{$stocktoday->qty_rem >0?$stocktoday->qty_rem:0}} KG</h2>
                    </div>
                    <div class="col-12 col-lg-4">
                        <i class="icon supplier"></i>
                        <p>Total Production</p>
                        <h2>{{$stocktall->qty_rem >0?$stocktall->qty_rem:0}} KG</h2>
                    </div>
                    <div class="col-12 col-lg-4">
                        <i class="icon customers"></i>
                        <p>Average Yield/ (Production Loss)</p>
                        <h2>0</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row icon-blocks">
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="icon-wrap">
                            <i class="icon" data-feather="archive"></i>
                        </div>
                        <div class="con-wrap">
                            <p>Total Raw Material</p>
                            <h2>{{$stocktotalRaw->qty_rem >0?$stocktotalRaw->qty_rem:0}} KG</h2>
                            {{--<span class="situation"><i class="text-success" data-feather="trending-up"></i>15% more than the previous month</span>--}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="icon-wrap">
                            <i class="icon" data-feather="box"></i>
                        </div>
                        <div class="con-wrap">
                            <p>Total Quantity</p>
                            <h2>{{$stocktotalRaw->qty_rem>0?$stocktotalRaw->qty_rem:0}} KG</h2>
                            {{--<span class="situation"><i class="text-danger" data-feather="trending-down"></i>5% Less than the previous month</span> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--<div class="row orders">
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-body pr-0">
                        <div class="form-row">
                            <div class="col-8">
                                <p>Total Orders</p>
                                <h2>5000</h2>
                            </div>
                            <a href="orders.html" class="col-4">
                                <i class="icon" data-feather="shopping-cart"></i> View Orders
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-body pr-0">
                        <div class="form-row">
                            <div class="col-8">
                                <p>Todays Delivery Orders</p>
                                <h2>100</h2>
                            </div>
                            <a href="orders.html" class="col-4">
                                <i class="icon" data-feather="shopping-cart"></i> View Orders
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
    <div class="col-12 col-lg-4">
        <div class="card bg-primary text-white low-stock">
            <div class="card-heading">Inventory products</div>
            <div class="card-body">
                <table cellpadding="0" cellspacing="0" border="0" class="table">
                    <thead>
                        <tr>
                            <th>Name of Inventory</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    @if(isset($stock) && $stock)
                       
                    <tbody>
                        @foreach($stock as $st)
                        <tr>
                            <td>{{$st->material_name}}</td>
                            <td>{{$st->qty_rem>0?$st->qty_rem:0}}</td>
                        </tr>
                        @endforeach
                       
                    </tbody>
                    @endif
                </table>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                Final Production Monthaly Analysis
            </div>
            <div class="card-body">
                <canvas id="canvas" style="height:40vh; width:80vw"></canvas>
            </div>
        </div>
    </div>
  </div>
@push("scripts")
  <script src="{{ asset('assets/mdbootstrap4/mdb.min.js')  }}"></script>
  <script src="{{ asset('vendors/chart.js/Chart.min.js')  }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{ asset('assets/js/custom.js')  }}"></script>
  <!-- End custom js for this page-->
  <script src="{{ asset('assets/js/feather.min.js')  }}"></script>
  <script>
    var MONTHS = [];
    var data = new Array();
    @foreach ($stockmonthaly as $val)
            MONTHS.push('{{$val->month}}');
            data.push('{{$val->qty_rem}}');
    @endforeach
		var color = Chart.helpers.color;
		var barChartData = {
			labels: MONTHS,
			datasets: [{
				label: 'Final Production',
				backgroundColor: "#ec1616",
				borderColor: "#ff0000",
				borderWidth: 1,
				data: data
			}]

		};

		window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myBar = new Chart(ctx, {
				type: 'bar',
				data: barChartData,
				options: {
					responsive: true,
					legend: {
						display: false,
						position: 'top',
					},
					title: {
						display: false,
						text: 'Chart.js Bar Chart'
					}
				}
			});

		};
    feather.replace()
  </script>
  @endpush
@endsection
