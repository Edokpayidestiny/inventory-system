<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="active">
                    @if (Auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}"><img src="{{ asset('assets/img/icons/dashboard.svg') }}"
                                alt="img"><span> Dashboard</span> </a>
                    @elseif (Auth()->user()->role === 'staff')
                        <a href="{{ route('staff.dashboard') }}"><img src="{{ asset('assets/img/icons/dashboard.svg') }}"
                                alt="img"><span> Dashboard</span> </a>
                    @endif

                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><img src="{{ asset('assets/img/icons/product.svg') }}"
                            alt="img"><span> Product</span> <span class="menu-arrow"></span></a>
                    <ul>

                        @if (Auth()->user()->role === 'admin')
                            <li><a href="{{ route('admin.products') }}">Product List</a></li>
                            <li><a href="{{ route('admin.products.create') }}">Add Product</a></li>
                            <li><a href="{{ route('admin.categories') }}">Category List</a></li>
                            <li><a href="{{ route('admin.categories.create') }}">Add Category</a></li>
                        @elseif (Auth()->user()->role === 'staff')
                            <li><a href="{{ route('staff.products') }}">Product List</a></li>
                        @endif

                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><img src="{{ asset('assets/img/icons/sales1.svg') }}"
                            alt="img"><span> Sales</span> <span class="menu-arrow"></span></a>
                    <ul>
                        @if (Auth()->user()->role === 'staff')
                            <li><a href="{{ route('staff.sales.index') }}">POS</a></li>
                            <li><a href="{{ route('staff.sales.index') }}">New Sales</a></li>
                        @elseif (Auth()->user()->role === 'admin')
                            <li><a href="{{ route('admin.sales.history') }}">Sales History</a></li>
                            <li><a href="{{ route('admin.sales.index') }}">POS</a></li>
                            <li><a href="{{ route('admin.sales.index') }}">New Sales</a></li>
                            <li><a href="{{ route('admin.sales.summary') }}">Sales Report</a></li>
                        @endif
                    </ul>
                </li>
                @if (Auth()->user()->role === 'admin')
                    <li class="submenu">
                        <a href="javascript:void(0);"><img src="{{ asset('assets/img/icons/purchase1.svg') }}"
                                alt="img"><span> Inventory</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('admin.inventory') }}">View Inventory</a></li>
                            <li><a href="{{ route('admin.inventory.history') }}">Adjustment History</a></li>
                        </ul>
                    </li>
                @endif
                @if (Auth()->user()->role === 'admin')
                    <li class="submenu">
                        <a href="javascript:void(0);"><img src="{{ asset('assets/img/icons/purchase1.svg') }}"
                                alt="img"><span>Purchase</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('admin.purchase.index') }}">Purchase List</a></li>
                            <li><a href="{{ route('admin.purchase.create') }}">Add Purchase</a></li>
                        </ul>
                    </li>
                @endif
                 @if (Auth()->user()->role === 'admin')
                    <li class="submenu">
                        <a href="javascript:void(0);"><img src="{{ asset('assets/img/icons/purchase1.svg') }}"
                                alt="img"><span>Pricing</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('admin.pricing.index') }}">Adjust Pricing</a></li>
                            <li><a href="{{ route('admin.pricing.history') }}">Pricing History</a></li>
                        </ul>
                    </li>
                @endif
                @if (Auth()->user()->role === 'admin')
                    <li class="submenu">

                        <a href="javascript:void(0);"><img src="{{ asset('assets/img/icons/users1.svg') }}"
                                alt="img"><span> User</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('admin.users.index') }}">User List</a></li>
                        </ul>
                    </li>
                @endif

                <li class="submenu">
                    <a href="javascript:void(0);"><img src="{{ asset('assets/img/icons/places.svg') }}"
                            alt="img"><span> Profile</span> <span class="menu-arrow"></span></a>
                    @if(Auth()->user()->role === 'admin')
                    <ul>
                        <li><a href="{{ route('admin.profile.index') }}">My Profile</a></li>
                    </ul>
                    @elseif(Auth()->user()->role === 'staff')
                    <ul>
                        <li><a href="{{ route('staff.profile') }}">My Profile</a></li>
                    </ul>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</div>
