<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-black sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('admin') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Logo</div>
    </a>


    <!-- Nav Item - Dashboard -->
    <li class="nav-item active" style="border-bottom: 1px solid rgba(255,255,255, 0.2); border-top: 1px solid rgba(255,255,255, 0.2);">
        <a class="nav-link" href="{{ url('admin') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->

    <li class="nav-item" style="border-bottom: 1px solid rgba(255,255,255, 0.2);">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-users fa-cog"></i>
            <span>User Management</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="text-white py-2 my-0 collapse-inner rounded">
                @if(Auth::guard('admin')->user()->can('admin.view'))
                <a class="collapse-item" href="{{ url('admin/admins') }}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> Admins </a>
                @endif
{{--                <a class="collapse-item" href="{{ url('admin/users') }}"><i class="fas fa-arrow-right"></i> Users</a>--}}
                    @if(Auth::guard('admin')->user()->can('role.view'))
                <a class="collapse-item" href="{{ url('admin/roles') }}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> Role</a>
                    @endif
            </div>
        </div>
    </li>
@if(Auth::guard('admin')->user()->can('category.create'))
    <!-- Category ITEM -->
    <li class="nav-item" style="border-bottom: 1px solid rgba(255,255,255, 0.2);">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#category"
           aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span> Category </span>
        </a>
        <div id="category" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="text-white py-2 my-0 collapse-inner rounded">
                @if(Auth::guard('admin')->user()->can('category.create'))
                <a class="collapse-item" href="{{ url("admin/categories/create") }}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> Add Category</a>
                @endif
                @if(Auth::guard('admin')->user()->can('category.view'))
                <a class="collapse-item" href="{{ url("admin/categories") }}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> Category List </a>
                @endif
            </div>
        </div>
    </li>
@endif
    <!-- Category ITEM -->

    <!-- Category ITEM -->
        <li class="nav-item" style="border-bottom: 1px solid rgba(255,255,255, 0.2);">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#items"
               aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span> Item Particular </span>
            </a>
            <div id="items" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="text-white py-2 my-0 collapse-inner rounded">
                    @if(Auth::guard('admin')->user()->can('item-particular.create'))
                        <a class="collapse-item" href="{{ url("admin/items/create") }}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> Item Particular </a>
                        @endif
                        @if(Auth::guard('admin')->user()->can('item-particular.view'))
                        <a class="collapse-item" href="{{ url("admin/items") }}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> Item Particular List </a>
                            @endif
                </div>
            </div>
        </li>
<!-- Itme ITEM -->
    <li class="nav-item" style="border-bottom: 1px solid rgba(255,255,255, 0.2);">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
           aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Project</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
             data-parent="#accordionSidebar">
            <div class="text-white py-2 my-0 collapse-inner rounded">
                @if(Auth::guard('admin')->user()->can('project.create'))
                <a class="collapse-item" href="{{ route('projects.create') }}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> Add Project </a>
                @endif
                    @if(Auth::guard('admin')->user()->can('project.view'))
                <a class="collapse-item" href="{{ route('projects.index') }}"> <i class="fa fa-long-arrow-right" aria-hidden="true"></i> List Project </a>
                        @endif
            </div>
        </div>
    </li>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item" style="border-bottom: 1px solid rgba(255,255,255, 0.2);">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
           aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Client</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="text-white py-2 my-0 collapse-inner rounded">
                @if(Auth::guard('admin')->user()->can('client.create'))
                <a class="collapse-item" href="{{ route('clients.create') }}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> Add Client</a>
                @endif
                @if(Auth::guard('admin')->user()->can('client.view'))
                <a class="collapse-item" href="{{ route('clients.index') }}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> List Client </a>
                @endif
            </div>
        </div>
    </li>
    <!-- Nav Item - Pages Collapse Menu -->
    @if(Auth::guard('admin')->user()->can('visitor.create'))
    <li class="nav-item" style="border-bottom: 1px solid rgba(255,255,255, 0.2);">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#client"
           aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span> Visitor Information </span>
        </a>
        <div id="client" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="text-white py-2 my-0 collapse-inner rounded">
                @if(Auth::guard('admin')->user()->can('visitor.create'))
                    <a class="collapse-item" href="{{ url('admin/visitors/create') }}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> Add Visitor</a>
                @endif
                @if(Auth::guard('admin')->user()->can('visitor.view'))
                    <a class="collapse-item" href="{{ url('admin/visitors') }}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> List Visitor </a>
                @endif
                @if(Auth::guard('admin')->user()->can('visitor.create'))
                <a class="collapse-item" href="{{ url('admin/professionals/create') }}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> Profesion Add </a>
                @endif
                    @if(Auth::guard('admin')->user()->can('visitor.view'))
                    <a class="collapse-item" href="{{ url('admin/professionals') }}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> Profesion List </a>
                        @endif
            </div>
        </div>
    </li>
    @endif
<!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item" style="border-bottom: 1px solid rgba(255,255,255, 0.2);">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#bank"
           aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span> Bank Information </span>
        </a>
        <div id="bank" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="text-white py-2 my-0 collapse-inner rounded">
                @if(Auth::guard('admin')->user()->can('bank.view'))
                <a class="collapse-item" href="{{ url('admin/banks') }}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> Bank Amount Information</a>
                <a class="collapse-item" href="{{ url('admin/bankloans') }}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> Bank Loan </a>
                @endif
                    @if(Auth::guard('admin')->user()->can('cash.view'))
                <a class="collapse-item" href="{{ url('admin/cashes') }}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> Cash Information</a>
                <a class="collapse-item" href="{{ url('admin/investmoneys') }}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> Invest Money </a>
                <a class="collapse-item" href="{{ url('admin/othersloans') }}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> Loan </a>
                <a class="collapse-item" href="{{ url('admin/bank_transfers') }}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> Bank Transfer </a>
                <!--<a class="collapse-item" href="{{ url('admin/others_collection_index') }}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> Others Amount  </a>-->
                <!--<a class="collapse-item" href="{{ url('admin/otherof') }}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> Others Expenditure  </a>-->
                    @endif
            @if(Auth::guard('admin')->user()->can('withdraw.create'))
                <a class="collapse-item" href="{{ url('admin/widraws') }}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> Withdraw </a>
                @endif
                @if(Auth::guard('admin')->user()->can('deposit.create'))
                <a class="collapse-item" href="{{ url('admin/deposits') }}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> Deposit</a>
                    @endif
            </div>
        </div>
    </li>
    <!-- Nav Item - Charts -->
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item" style="border-bottom: 1px solid rgba(255,255,255, 0.2);">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#report"
           aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span> Report</span>
        </a>
        <div id="report" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="text-white py-2 my-0 collapse-inner rounded">
{{--                <a class="collapse-item" href="{{ url('admin/project-report') }}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> Project Report</a>--}}
                @if(Auth::guard('admin')->user()->can('project-wise-client-report.view'))
                <a class="collapse-item" href="{{ url('admin/client-report') }}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> Project Wise Client Report  </a>
                @endif
                <!--@if(Auth::guard('admin')->user()->can('visistor-report.view'))-->
                <!--<a class="collapse-item" href="{{ url('admin/visitor-report') }}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> Visistor Report </a>-->
                <!--@endif-->
                @if(Auth::guard('admin')->user()->can('monthly-collection-statement.view'))
                <a class="collapse-item" href="{{ url('admin/collection-statement-report') }}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> Monthly Collection Statement </a>
                @endif
                @if(Auth::guard('admin')->user()->can('project-balance-sheet.view'))
                <a class="collapse-item" href="{{ url('admin/project-balance-sheet') }}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> Project Balance Sheet </a>
                @endif
{{--             <a class="collapse-item" href="{{ url('admin/payment-report') }}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> Payment Report </a>--}}
                @if(Auth::guard('admin')->user()->can('expenditure-summery-sheet.view'))
                <a class="collapse-item" href="{{ url('admin/expenditure_summery') }}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> Expenditure Summery Sheet </a>
                @endif
                @if(Auth::guard('admin')->user()->can('cash-report.view'))
                <a class="collapse-item" href="{{ url('admin/collection-report-cash') }}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> Cash Report </a>
                @endif
                @if(Auth::guard('admin')->user()->can('final-balance-sheet.view'))
                <a class="collapse-item" href="{{ url('admin/final_blance_sheet') }}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> Final Blance Sheet </a>
                @endif
            </div>
        </div>
    </li>
    <!-- Nav Item - Charts -->
    @if(Auth::guard('admin')->user()->can('profit-loss-report.view'))
    <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/profit-loss') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Profit and Loss Report </span>
        </a>
    </li>
    @endif
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light text-white topbar mb-4 static-top shadow">
            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>
            <!-- Topbar Search -->
            <form
                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                           aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                         aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small"
                                       placeholder="Search for..." aria-label="Search"
                                       aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Nav Item - Alerts -->
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell fa-fw"></i>
                        <!-- Counter - Alerts -->
                        <span class="badge badge-danger badge-counter">3+</span>
                    </a>
                    <!-- Dropdown - Alerts -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                         aria-labelledby="alertsDropdown">
                        <h6 class="dropdown-header">
                            Alerts Center
                        </h6>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="mr-3">
                                <div class="icon-circle bg-primary">
                                    <i class="fas fa-file-alt text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">December 12, 2019</div>
                                <span class="font-weight-bold">A new monthly report is ready to download!</span>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="mr-3">
                                <div class="icon-circle bg-success">
                                    <i class="fas fa-donate text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">December 7, 2019</div>
                                $290.29 has been deposited into your account!
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="mr-3">
                                <div class="icon-circle bg-warning">
                                    <i class="fas fa-exclamation-triangle text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">December 2, 2019</div>
                                Spending Alert: We've noticed unusually high spending for your account.
                            </div>
                        </a>
                        <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                    </div>
                </li>

                <!-- Nav Item - Messages -->
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Report
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                         aria-labelledby="messagesDropdown">

                        <a class="dropdown-item  bg-info text-white" href="#">
                            Today
                        </a>
                        <a class="dropdown-item d-flex align-items-center bg-info text-white" href="#">
                           This Week
                        </a>
                        <a class="dropdown-item d-flex align-items-center bg-info text-white" href="#">
                            This Month

                        </a>
                        <a class="dropdown-item d-flex align-items-center bg-info text-white" href="#">
                            Last Month
                        </a>
                        <a class="dropdown-item d-flex align-items-center bg-info text-white" href="#">
                            This Year
                        </a>
                        <a class="dropdown-item d-flex align-items-center bg-info text-white" href="#">
                            Last Year
                        </a>
                        <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                    </div>
                </li>

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-white small">

                            {{ Auth::guard('admin')->user()->name }}</span>
                        <img class="img-profile rounded-circle" src="{{ asset('assets/img/undraw_profile.svg') }}">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                         aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Settings
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                            Activity Log
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('admin.logout.submit') }}"
                           onclick="event.preventDefault();
                            document.getElementById('logout-form-admin').submit();">

                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                        <form id="logout-form-admin" action="{{ route('admin.logout.submit') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->
