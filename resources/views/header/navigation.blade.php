<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item active">
      <a class="nav-link" href="{{ route('home') }}">
        <i class="menu-icon" data-feather="home"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    @canany('inward-rawmaterials-list','inward-packing-raw-material-list','issue-material-for-production-list','quality-control-list','issual-by-stores-for-production-list')
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#ui-warehouse" aria-expanded="false" aria-controls="ui-manufacture"><i class="menu-icon" data-feather="tool"></i>
        <span class="menu-title">Warehouse</span><i class="icon-layout menu-arrow" data-feather="chevron-down"></i></a>
      <div class="collapse" id="ui-warehouse">
        <ul class="nav flex-column sub-menu">

          @can('inward-rawmaterials-list')
          <li class="nav-item">
            <a class="nav-link" href="{{ route('inward-rawmaterials') }}">

              Inward Raw Material
            </a>
          </li>
          @endcan
          @can('inward-packing-raw-material-list')
          <li class="nav-item">

            <a class="nav-link" href="{{ route('inwardpackingrawmaterial-list') }}">


              Inward Packing Material
            </a>
          </li>
          @endcan
          @can('issue-material-for-production-list')
          <li class="nav-item">
            <a class="nav-link" href="{{ route('issue_material_for_production') }}">

              Issue Material For Production
            </a>
          </li>
          @endcan
          

          @can('issual-by-stores-for-production-list')
          <li class="nav-item">
            <a class="nav-link" href="{{ route('issual_by_stores_for_production') }}">

              Issual By Stores For Production
            </a>
          </li>
          @endcan
        </ul>
      </div>
    </li>
    @endcanany
    @canany('inward-finished-goods-new-stock-list','dispatch-finished-goods-list')
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#ui-finished-goods" aria-expanded="false" aria-controls="ui-manufacture"><i class="menu-icon" data-feather="tool"></i>
        <span class="menu-title">Finished Goods Store</span><i class="icon-layout menu-arrow" data-feather="chevron-down"></i></a>
      <div class="collapse" id="ui-finished-goods">
        <ul class="nav flex-column sub-menu">

          @can('inward-finished-goods-new-stock-list')
          <li class="nav-item">
            <a class="nav-link" href="{{ route('new_stock') }}">

              Inward Finished Goods -<br />New Stock
            </a>
          </li>
          @endcan
          @can('dispatch-finished-goods-list')

          <li class="nav-item">
            <a class="nav-link" href="{{ route('dispatch_finished_goods') }}">

              Dispatch Finished Goods
            </a>
          </li>
          @endcan
        </ul>
      </div>
    </li>
    @endcanany
    @canany(["quality_control","quality_control_packing","quality_control_finishgood","quality_control_batch","quality-control-list"])
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#ui-qc" aria-expanded="false" aria-controls="ui-qc"><i class="menu-icon" data-feather="tool"></i>
        <span class="menu-title">Quality Control</span><i class="icon-layout menu-arrow" data-feather="chevron-down"></i></a>
      <div class="collapse" id="ui-qc">
        <ul class="nav flex-column sub-menu">
          @can('quality_control')

          <li class="nav-item">
            <a class="nav-link" href="{{ route('quality_control') }}">
                Quality Control Raw Material

            </a>
          </li>
          @endcan
          @can('quality_control_packing')

          <!-- <li class="nav-item">
            <a class="nav-link" href="{{ route('quality_control_packing') }}">
                Quality Control Packing Material

            </a>
          </li> -->
          @endcan
          @can('quality_control_finishgood')

         <!--  <li class="nav-item">
            <a class="nav-link" href="{{ route('quality_control_finishgood') }}">
                Quality Control Finished Good

            </a>
          </li> -->
          @endcan
          @can('quality_control_batch')

          <li class="nav-item">
            <a class="nav-link" href="{{ route('quality_control_batch') }}">
                Quality Control Batch Process

            </a>
          </li>
          @endcan

  </ul>
  </div>
  </li>
  @endcanany

    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('issue_packing_material') }}">
    <i class="menu-icon" data-feather="hard-drive"></i>
    <span class="menu-title">Issue Packing Material </span>
    </a>
    </li> --}}
    @canany(["batch-manufacture-list"])
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#ui-manufacture" aria-expanded="false" aria-controls="ui-manufacture"><i class="menu-icon" data-feather="tool"></i>
        <span class="menu-title">Manufacture Process</span><i class="icon-layout menu-arrow" data-feather="chevron-down"></i></a>
      <div class="collapse" id="ui-manufacture">
        <ul class="nav flex-column sub-menu">
          @can('batch-manufacture-list')

          <li class="nav-item">
            <a class="nav-link" href="{{ route('add-batch-manufacture') }}">Batch</a>
          </li>
          @endcan
          {{-- <li class="nav-item"><a class="nav-link" href="{{ route('bill-of-raw-material')}}">Bill of Raw Material detail and Weighing Record</a>
    </li>
    <li class="nav-item"><a class="nav-link" href="{{route('list-of-equipment')}}">List of Equipment</a></li>
    <li class="nav-item"><a class="nav-link" href="{{route('line-clearance')}}">Line Clearance Record</a></li>
    <li class="nav-item"><a class="nav-link" href="{{route('add-lots')}}">Add Lots</a></li>
    <li class="nav-item"><a class="nav-link" href="{{route('packing-detail')}}">Packing</a></li>
    <li class="nav-item"><a class="nav-link" href="{{route('generate-label')}}">Generate Label</a></li> --}}
  </ul>
  </div>
  </li>
  @endcanany

  @canany(['annexure-i-list','annexure-ii-list','annexure-iii-list','annexure-iv-list','packing-annexure-list','annexure-iv-list','packing-annexure-list','annexure-vi-list','annexure-vii-list'])
  <li class="nav-item">
    <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
      <i class="menu-icon" data-feather="pie-chart"></i>
      <span class="menu-title">Reports</span>
      <i class="icon-layout menu-arrow" data-feather="chevron-down"></i>
    </a>
    <div class="collapse" id="ui-basic">
      <ul class="nav flex-column sub-menu">

          @can('annexure-i-list')
          <li class="nav-item"><a class="nav-link" href="{{ route('annexure_i') }}">Finished Goods Inward (Annexure - I)</a></li>
          @endcan
          @can('annexure-ii-list')
          <li class="nav-item"><a class="nav-link" href="{{ route('annexure_ii') }}">Issual by stores for production for captive consumption-simethicone (Annexure - II)</a></li>
          @endcan
          @can('annexure-iii-list')

          <li class="nav-item"><a class="nav-link" href="{{ route('annexure_iii') }}">Issed by Stores for Production (Annexure - III)</a></li>
          @endcan
          @can('annexure-iv-list')

          <li class="nav-item"><a class="nav-link" href="{{ route('annexure_iv') }}">Finished Goods Inward (Annexure - I) - New Stock</a></li>
          @endcan

          @can('packing-annexure-list')

        <li class="nav-item"><a class="nav-link" href="{{ route('annexure_vii') }}">Finished Goods Dispatch (Annexure -VII)</a></li>
        @endcan
        @can('material_report-list')

        <li class="nav-item"><a class="nav-link" href="{{ route('material_report') }}"> Raw Material Report</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('daystore_report') }}"> Daystore Report</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('warehouse_returend') }}"> Ware House Return Log</a></li>
        @endcan

      </ul>
    </div>
  </li>
  @endcanany
  <!-- <li class="nav-item">
        <a class="nav-link" href="{{ route('comingsoon') }}">
          <i class="menu-icon" data-feather="shopping-bag"></i>
          <span class="menu-title">Product Masters</span>
        </a>
      </li> -->


@canany(['department-list','role-list','designation-list','grade-list','suppliers-list','modedispatch-list','manufacturer-list','rawmaterial-list','party-master-list','permission-list','user-list','activitylog-list'])
  <li class="nav-item">
    <a class="nav-link" data-toggle="collapse" href="#ui-master" aria-expanded="false" aria-controls="ui-master">
      <i class="menu-icon" data-feather="pie-chart"></i>
      <span class="menu-title">Masters</span>
      <i class="icon-layout menu-arrow" data-feather="settings"></i>
    </a>
    <div class="collapse" id="ui-master">
      <ul class="nav flex-column sub-menu">
        @can('department-list')
        <li class="nav-item"><a class="nav-link" href="{{ route('department') }}">Department</a></li>
        @endcan
        @can("role-list")
        <li class="nav-item"><a class="nav-link" href="{{ route('roles.index') }}">Role</a></li>
        @endcan

        @can('designation-list')
        <li class="nav-item"><a class="nav-link" href="{{ route('designation') }}">Designation</a></li>
        @endcan
        @can('grade-list')
        <li class="nav-item"><a class="nav-link" href="{{ route('grade') }}">Grade</a></li>
        @endcan
        @can('suppliers-list')
        <li class="nav-item"><a class="nav-link" href="{{ route('supplier') }}">Supplier</a></li>
        @endcan
        @can('modedispatch-list')

        <li class="nav-item"><a class="nav-link" href="{{ route('modedispatch') }}">Mode of Dispatch</a></li>
        @endcan
        @can('manufacturer-list')

        <li class="nav-item"><a class="nav-link" href="{{ route('manufacturer') }}">Manufacturers</a></li>
        @endcan
        @can('rawmaterial-list')

        <li class="nav-item"><a class="nav-link" href="{{ route('rawmaterial') }}">Materials Master</a></li>
        @endcan
        @can('party-master-list')
        <li class="nav-item"><a class="nav-link" href="{{ route('party_master') }}">Party Master</a></li>
        @endcan
        @can("permission-list")
        <li class="nav-item"><a class="nav-link" href="{{url('permissions')}}">Permission</a></li>
        @endcan
        @can('user-list')
        <li class="nav-item">
          <a class="nav-link" href="{{ route('users.index') }}">
            User Masters
          </a>
        </li>
        @endcan

        @can("activitylog-list")
            <li class="nav-item"><a class="nav-link" href="{{url('activitylog')}}">Activity Log</a></li>
        @endcan
      </ul>
    </div>
  </li>
  @endcanany
  <li class="nav-item">
    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
      <i class="menu-icon" data-feather="power"></i>
      <span class="menu-title">Logout</span>
    </a>
  </li>
  </ul>
</nav>
