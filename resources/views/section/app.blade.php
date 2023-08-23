<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>RIOCare India PVT LTD :: Inventory and Stock Management</title>

  <link rel="stylesheet" href="{{asset('assets/mdbootstrap4/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/mdbootstrap4/mdb.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/mdbootstrap4/mdb-plugins-gathered.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset('assets/img/favicon.png')}}" />
</head>
<style type="text/css">
    .error {
        color: red;
        font-size: 13px;
    }

</style>
<body>
  <div class="container-scroller">
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-brand-wrapper d-flex align-items-center">
        <a class="navbar-brand brand-logo" href="index.html"><img src="assets/img/rio_care_logo.png" class="mr-2" alt="logo"/><span class="sys-logo align-self-center">Inventory and Stock Management</span></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/img/rio_care_small_logo.png" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center d-md-none d-lg-block" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
		<ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
              <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                <span class="input-group-text" id="search">
                  <button type="search"><i class="icon-search" data-feather="search"></i></button>
                </span>
              </div>
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown notification mr-0 pr-0">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i data-feather="bell"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="text-white" data-feather="alert-triangle"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">100 Pending Product</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Just now
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="text-white" data-feather="settings"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Settings</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Password Change (2 days ago)
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="text-white" data-feather="user"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">50 New Product Received</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    2 Hrs ago
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item dropdown message mx-0 px-0"><a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown"><i data-feather="message-square"></i><span class="count"></span></a><div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="text-white" data-feather="alert-triangle"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">10 Product Out of Stock</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Just now
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="text-white" data-feather="settings"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Check Received Products</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    2 days ago
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="text-white" data-feather="plus"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">2 New Product Added</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    2 Hrs ago
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="assets/img/user_img.png" alt="profile"/>
			  <span class="username">
				<h6>RIO Care</h6>
			  </span>
              <i class="align-self-center ml-1" data-feather="chevron-down"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="text-danger mr-2" data-feather="settings"></i>
                Settings
              </a>
              <a class="dropdown-item">
                <i class="text-danger mr-2" data-feather="power"></i>
                Logout
              </a>
            </div>
          </li>
          <!-- <li class="nav-item nav-settings d-none d-lg-flex"> -->
            <!-- <a class="nav-link" href="#"> -->
              <!-- <i class="icon-ellipsis"></i> -->
            <!-- </a> -->
          <!-- </li> -->
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="sidebar">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <div class="container-fluid page-body-wrapper">

      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item active">
            <a class="nav-link" href="home">
              <i class="menu-icon" data-feather="home"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="inward_raw_material">
              <i class="menu-icon" data-feather="layers"></i>
              <span class="menu-title">Inward Raw Material</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="inward_packing_material">
              <i class="menu-icon" data-feather="package"></i>
              <span class="menu-title">Inward Packing Material</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="issue_material_for_production">
              <i class="menu-icon" data-feather="hard-drive"></i>
              <span class="menu-title">Issue Material For Production</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="new_stock">
              <i class="menu-icon" data-feather="shopping-cart"></i>
              <span class="menu-title">Inward Finished Goods -<br />New Stock</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="dispatch-finished-goods.html">
              <i class="menu-icon" data-feather="truck"></i>
              <span class="menu-title">Dispatch Finished Goods</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="quality-control.html">
              <i class="menu-icon" data-feather="check-square"></i>
              <span class="menu-title">Quality Control</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon" data-feather="pie-chart"></i>
              <span class="menu-title">Reports</span>
			  <i class="icon-layout menu-arrow" data-feather="chevron-down"></i>
            </a>
			<div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="annexure-i.html">Finished Goods Inward (Annexure - I)</a></li>
                <li class="nav-item"><a class="nav-link" href="annexure-ii.html">Issual by stores for production for captive consumption-simethicone (Annexure - II)</a></li>
                <li class="nav-item"><a class="nav-link" href="annexure-iii.html">Issed by Stores for Production (Annexure - III)</a></li>
                <li class="nav-item"><a class="nav-link" href="annexure-iv.html">Goods Receipt Note (Annexure - IV)</a></li>
                <li class="nav-item"><a class="nav-link" href="packing-annexure.html">Packing Material Inward (Annexure - IV)</a></li>
                <li class="nav-item"><a class="nav-link" href="annexure-VI.html">Quality Control Approval/Rejection (Annexure -VI)</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="product-masters.html">
              <i class="menu-icon" data-feather="shopping-bag"></i>
              <span class="menu-title">Product Masters</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="user-masters.html">
              <i class="menu-icon" data-feather="users"></i>
              <span class="menu-title">User Masters</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="setting.html">
              <i class="menu-icon" data-feather="settings"></i>
              <span class="menu-title">Setting</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.html">
              <i class="menu-icon" data-feather="power"></i>
              <span class="menu-title">Logout</span>
            </a>
          </li>
        </ul>
      </nav>
          <!-- Main Container -->
    <div class="main-panel">
    @yield('content')

    <div class="copyright">
			Copyright 2021. all rights are reserved.<b>Version 1.0</b>
	</div>

    </div>

 </div>
</div>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{asset('assets/mdbootstrap4/jquery.min.js')}}"></script>
  <script src="{{asset('assets/mdbootstrap4/popper.min.js')}}"></script>
  <script src="{{asset('assets/mdbootstrap4/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/mdbootstrap4/mdb.min.js')}}"></script>
<script src="{{asset('vendors/chart.js/Chart.min.js')}}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{asset('assets/js/custom.js')}}"></script>
  <!-- End custom js for this page-->
  <script src="{{asset('assets/js/feather.min.js')}}"></script>
  <script>
    feather.replace()
	/*$(document).ready(function() {
		var c = 1;
      $(".add-more").click(function(){
          var html = $(".copy").html();
          $(".after-add-more").after(html);
      });
      $("body").on("click",".remove",function(){
          $(this).parents(".add-more-new").remove();
      });
    });*/
	$(document).ready(function() {
		var max_fields      = 15; //maximum input boxes allowed
		var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
		var add_button      = $(".add_field_button"); //Add button ID

		var x = 1; //initlal text box count
		$(add_button).click(function(e){ //on add input button click
			e.preventDefault();
			if(x < max_fields){ //max input box allowed
				x++; //text box increment
				$(wrapper).append('<div class="row add-more-wrap add-more-new m-0 mb-4"><span class="add-count">'+x+'</span><div class="input-group-btn"><button class="btn btn-danger remove_field" type="button"><i class="icon-remove" data-feather="x"></i></button></div><div class="col-12 col-md-6"><div class="form-group"><label for="rawMaterialName['+x+']">Raw Material Name</label><input type="text" class="form-control" id="rawMaterialName['+x+']" placeholder="Material Name"></div></div><div class="col-12 col-md-6"><div class="form-group"><label for="batch['+x+']">Batch No.</label><input type="text" class="form-control" id="batch['+x+']" placeholder="Batch"></div></div><div class="col-12 col-md-6"><div class="form-group"><label for="Containers['+x+']">Total no of Containers / Bags</label><input type="text" class="form-control" id="Containers[]" placeholder="No of Containers / Bags"></div></div><div class="col-12 col-md-6"><div class="form-group"><label for="Quantity['+x+']">Quantity Received (Kg)</label><input type="text" class="form-control" id="Quantity['+x+']" placeholder="Quantity"></div></div><div class="col-12 col-md-6"><div class="form-group"><label for="mfgDate['+x+']">Manufacturer’s Mfg. Date</label><input type="date" class="form-control calendar" id="mfgDate['+x+']" placeholder="Mfg. Date"></div></div><div class="col-12 col-md-6"><div class="form-group"><label for="ExpiryDate['+x+']">Manufacturer’s Expiry Date</label><input type="date" class="form-control calendar" id="ExpiryDate['+x+']" placeholder="Expiry Date"></div></div><div class="col-12 col-md-6"><div class="form-group">'+x+'<label for="RIOExpiryDate['+x+']">RIO Care Expiry Date</label><input type="date" class="form-control calendar" id="RIOExpiryDate['+x+']" placeholder="Expiry Date"></div></div><div class="col-12 col-md-6"><div class="form-group"><label for="ARNo['+x+']">AR No. / Date</label><input type="text" class="form-control" id="ARNo['+x+']" placeholder="AR No. / Date"></div></div></div>'); //add input box
			}
			feather.replace()
		});

		$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
			e.preventDefault(); $(this).parents('div.row').remove(); x--;
		})
	});
  </script>
     <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

  @stack('custom-scripts')
</body>
</html>

