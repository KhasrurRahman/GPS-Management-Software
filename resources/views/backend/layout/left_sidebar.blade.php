  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: #f4f6f9 !important;">
    <!-- Brand Logo -->
    <a href="{{route('admin.adminDashboard')}}" class="brand-link text-center" style="border-bottom: none">
{{--      <img src="{{asset("public/assets/backend/img/35.png")}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"--}}
{{--           style="opacity: .8">--}}
      <img src="{{asset("public/assets/backend/img/gps-tracker.png")}}"  alt="User Image" style="height: 40px !important;">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="border-bottom: 3px solid #4f5962">
        <div class="image">
          <img src="{{asset("public/assets/backend/img/unnamed.png")}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block text-bold text-black-50">{{\Illuminate\Support\Facades\Auth::user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{route('admin.adminDashboard')}}" class="nav-link">
              <i class="nav-icon fas fa-th" style="color: #CF401C"></i>
              <p>
                Dashboard
                <span class="right badge badge-danger">Home</span>
              </p>
            </a>
          </li>

             <li class="nav-item has-treeview {{Request::is('admin/all_user*')?'menu-open': ''}}">
            <a href="#" class="nav-link {{Request::is('admin/all_user*')?'active': ''}}">
              <i class="nav-icon fas fa-users" style="color: #3FA9F5"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.all_user.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.all_user.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add User</p>
                </a>
              </li>

                <li class="nav-item">
                <a href="{{route('admin.export')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Export All User Data</p>
                </a>
              </li>

            </ul>
          </li>


        <li class="nav-item has-treeview {{Request::is('admin/corporate_user*')?'menu-open': ''}}{{Request::is('admin/individual_user*')?'menu-open': ''}}{{Request::is('admin/expire_user*')?'menu-open': ''}}{{Request::is('admin/paid_user*')?'menu-open': ''}}{{Request::is('admin/due_user*')?'menu-open': ''}}">
            <a href="#" class="nav-link {{Request::is('admin/corporate_user*')?'menu-open': ''}}{{Request::is('admin/individual_user*')?'menu-open': ''}}{{Request::is('admin/expire_user*')?'menu-open': ''}}{{Request::is('admin/paid_user*')?'menu-open': ''}}{{Request::is('admin/due_user*')?'menu-open': ''}}">
              <i class="nav-icon fas fa-filter" style="color: green"></i>
              <p>
                User Filter
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.corporate_user')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Corporate User</p>
                </a>
              </li>
                <li class="nav-item">
                <a href="{{route('admin.individual_user')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Individual User</p>
                </a>
              </li>
                <li class="nav-item">
                <a href="{{route('admin.expire_user')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Expire User</p>
                </a>
              </li>
                <li class="nav-item">
                <a href="{{route('admin.paid_user')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Paid User</p>
                </a>
              </li>
                <li class="nav-item">
                <a href="{{route('admin.due_user')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Due User</p>
                </a>
              </li>

            </ul>
          </li>



            <li class="nav-item has-treeview {{Request::is('admin/bill_schedule*')?'menu-open': ''}}">
            <a href="#" class="nav-link {{Request::is('admin/bill_schedule*')?'active': ''}}">
              <i class="nav-icon fas fa-calendar-check" style="color: #F0A732"></i>
              <p>
                Bill Schedule
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.calendar')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Filter Schedule</p>
                </a>
              </li>

                <li class="nav-item">
                <a href="{{route('admin.all_bill_schedule')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Schedule</p>
                </a>
              </li>

            </ul>
          </li>


            <li class="nav-item has-treeview {{Request::is('admin/order*')?'menu-open': ''}}{{Request::is('admin/assigned_order*')?'menu-open': ''}}">
            <a href="#" class="nav-link {{Request::is('admin/order*')?'active': ''}}{{Request::is('admin/assigned_order*')?'active': ''}}">
              <i class="nav-icon fas fa-sort-amount-up-alt " style="color: #17a2b8"></i>
              <p>
                Orders
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

                <li class="nav-item">
                <a href="{{route('admin.order.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Order</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('admin.order.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Order</p>
                </a>
              </li>

                <li class="nav-item">
                <a href="{{route('admin.assigned_order')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Assigned Order</p>
                </a>
              </li>

            </ul>
          </li>

             <li class="nav-item has-treeview {{Request::is('admin/technician*')?'menu-open': ''}}">
            <a href="#" class="nav-link {{Request::is('admin/technician*')?'active': ''}}">
              <i class="nav-icon fas fa-users-cog" style="color: deeppink"></i>
              <p>
                Technician
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.technician.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Technician</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.technician.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Technician</p>
                </a>
              </li>

            </ul>
          </li>


           <li class="nav-item {{Request::is('admin/all_complain*')?'menu-open': ''}}">
            <a href="{{route('admin.all_complain')}}" class="nav-link {{Request::is('admin/all_complain*')?'active': ''}}">
              <i class="nav-icon fas fa-comment" style="color: #4FC3F7"></i>
              <p>
                Complain
              </p>
            </a>
          </li>




            <li class="nav-item has-treeview {{Request::is('admin/device*')?'menu-open': ''}}">
            <a href="#" class="nav-link {{Request::is('admin/device*')?'active': ''}}">
             <i class="nav-icon fas fa-tablet"></i>
              <p>
                Device Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
     
              <li class="nav-item">
                <a href="{{route('admin.device.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stock Device</p>
                </a>
              </li>

              @if(\Illuminate\Support\Facades\Auth::user()->type == 'admin')
              <li class="nav-item">
                <a href="{{route('admin.device.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Device</p>
                </a>
              </li>
              @endif

                <li class="nav-item">
                <a href="{{route('admin.device_transaction_history')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Device Transaction</p>
                </a>
              </li>

            </ul>
          </li>




       <li class="nav-item has-treeview {{Request::is('admin/history*')?'menu-open': ''}}">
            <a href="#" class="nav-link {{Request::is('admin/history*')?'active': ''}}">
              <i class="nav-icon fas fa-file-medical-alt" style="color: #7E3896"></i>
              <p>
                Transaction History
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.device_sell_history')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Device Sell History</p>
                </a>
              </li>

                <li class="nav-item">
                <a href="{{route('admin.billing_history')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Billing History</p>
                </a>
              </li>

            </ul>
          </li>


@if(\Illuminate\Support\Facades\Auth::user()->type == 'admin')
            <li class="nav-item">
            <a href="{{route('admin.sub_admins')}}" class="nav-link">
              <i class="nav-icon fas fa-user-shield" style="color: #FFC107"></i>
              <p>
                Subadmin Request
              </p>
            </a>
          </li>
@endif



@if(\Illuminate\Support\Facades\Auth::user()->type == 'admin')
            <li class="nav-header">Website Information</li>


          <li class="nav-item has-treeview {{Request::is('admin/home_page_banner')?'menu-open': ''}}{{Request::is('admin/happy_client')?'menu-open': ''}}{{Request::is('admin/add_services')?'menu-open': ''}}{{Request::is('admin/add_demo')?'menu-open': ''}}">
            <a href="#" class="nav-link {{Request::is('admin/home_page_banner')?'active': ''}}{{Request::is('admin/happy_client')?'active': ''}}{{Request::is('admin/add_services')?'active': ''}}{{Request::is('admin/add_demo')?'active': ''}}">
              <i class="nav-icon fas fa-info-circle" style="color: green"></i>
              <p>
                Website Information
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.home_page_banner')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Home Page Banner</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.happy_client')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Happy Client</p>
                </a>
              </li>
                <li class="nav-item">
                <a href="{{route('admin.add_services')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Services</p>
                </a>
              </li>
                <li class="nav-item">
                <a href="{{route('admin.add_demo')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Demos</p>
                </a>
              </li>

            </ul>
          </li>


            <li class="nav-item has-treeview {{Request::is('admin/price_list*')?'menu-open': ''}}">
            <a href="#" class="nav-link {{Request::is('admin/price_list*')?'active': ''}}">
              <i class="nav-icon fas fa-wallet"></i>
              <p>
                Price List
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.price_list.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Price Main Category</p>
                </a>
              </li>

            </ul>
          </li>



            <li class="nav-item has-treeview {{Request::is('admin/feature*')?'menu-open': ''}}">
            <a href="#" class="nav-link {{Request::is('admin/feature*')?'active': ''}}">
              <i class="nav-icon fas fa-feather-alt"></i>
              <p>
                Features
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.add_feature')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add_feature</p>
                </a>
              </li>

            </ul>
          </li>


            <li class="nav-item has-treeview {{Request::is('admin/tracking_device*')?'menu-open': ''}}">
            <a href="#" class="nav-link {{Request::is('admin/tracking_device*')?'active': ''}}">
              <i class="nav-icon fas fa-map-marked"></i>
              <p>
                Tracking device
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.tracking_device')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Tracking device</p>
                </a>
              </li>

            </ul>
          </li>






          <li class="nav-item"><a href="{{route('admin.team')}}" class="nav-link {{Request::is('admin/team')?'active': ''}}"><i class="nav-icon fas fa-tags"></i>Team member</a></li>
          <li class="nav-item"><a href="{{route('admin.contact')}}" class="nav-link {{Request::is('admin/contact')?'active': ''}}"><i class="nav-icon fas fa-map"></i>Contact Information</a></li>
{{--          <li class="nav-item"><a href="{{route('blank')}}" class="nav-link"><i class="nav-icon fas fa-th"></i>Blank</a></li>--}}


@endif



            <li class="nav-item bg-red mb-3">
            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
              <i class="nav-icon fas fa-lock"></i>
              <p>
                Log Out
              </p>
            </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                </form>
          </li>




        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
