<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>

                <li>
                    <a href="{{route('user.index')}}" class="waves-effect">
                        <i class="dripicons-device-desktop"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('user.setting')}}" class="waves-effect">
                        <i class="fa fa-user"></i>
                        <span>My Account</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('user.plans')}}" class="waves-effect">
                        <i class="fa fa-user-cog"></i>
                        <span>Plans</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('user.deposit')}}" class="waves-effect">
                        <i class="fa fa-user-cog"></i>
                        <span>Deposit</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('user.withdraw')}}" class="waves-effect">
                        <i class="fa fa-money-bill"></i>
                        <span>Withdrawal</span>
                    </a>
                </li>
                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="dripicons-mail"></i>
                        <span> Withdrawal </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('user.withdraw')}}">Withdraw Money</a></li>
                        <li><a href="{{route('user.withdraw.history')}}">Withdrawal History</a></li>
                    </ul>
                </li> --}}
                {{-- <li>
                    <a href="{{route('user.myteam')}}" class="waves-effect">
                        <i class="fa fa-user-cog"></i>
                        <span>My Team</span>
                    </a>
                </li> --}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="dripicons-mail"></i>
                        <span> Transactions </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('user.deposit.history')}}">Deposit History</a></li>
                        <li><a href="{{route('user.mdeposit')}}">Manual Deposit</a></li>
                        <li><a href="email-read.html">Investments</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{route('logout')}}" class=" waves-effect">
                        <i class="fa fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </li>

                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="dripicons-card"></i>
                        <span> Contact</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="contacts-grid.html">Contact Grid</a></li>
                        <li><a href="contacts-list.html">Contact List</a></li>
                        <li><a href="contacts-profile.html">Profile</a></li>
                    </ul>
                </li> --}}
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
