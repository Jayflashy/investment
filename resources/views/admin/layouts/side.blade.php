<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>
                <li>
                    <a href="{{route('admin.index')}}" class="waves-effect">
                        <i class="dripicons-device-desktop"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.profile')}}" class="waves-effect">
                        <i class="fa fa-user"></i>
                        <span>My Account</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.members.index')}}" class="waves-effect">
                        <i class="fa fa-users"></i>
                        <span>Users</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.plans')}}" class="waves-effect">
                        <i class="fa fa-folder"></i>
                        <span>Plans</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.withdraw.requests')}}" class="waves-effect">
                        <i class="fa fa-user-cog"></i>
                        <span>Withdrawal Request</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa fa-money-bill"></i>
                        <span> Payments </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.deposit')}}">Deposit History</a></li>
                        <li><a href="{{route('admin.mpayment')}}">Manual Deposits</a></li>
                        <li><a href="{{route('admin.withdraw.paid')}}">Withdrawal History</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa fa-cog"></i>
                        <span> Settings</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.setting.index')}}">Site Settings</a></li>
                        <li><a href="{{route('admin.setting.payment')}}">Payment Setting</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('logout')}}" class=" waves-effect">
                        <i class="fa fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
