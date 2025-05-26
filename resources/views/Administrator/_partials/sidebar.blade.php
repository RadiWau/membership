<div class="main-menu material-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{route('dashboard.index')}}">
                    <i class="material-icons">settings_input_svideo</i>
                    <span class="menu-title" data-i18n="Dashboard">Dashboard</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('admin/member') ? 'active' : '' }}">
                <a href="{{route('member.index')}}">
                    <i class="material-icons">people_outline</i>
                    <span class="menu-title" data-i18n="Member">Member</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('admin/user') ? 'active' : '' }}">
                <a href="{{route('user.index')}}">
                    <i class="material-icons">person_outline</i>
                    <span class="menu-title" data-i18n="User">User</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('admin/role') ? 'active' : '' }}">
                <a href="{{route('role.index')}}">
                    <i class="material-icons">account_circle</i>
                    <span class="menu-title" data-i18n="Role">Role</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('admin/laporan') ? 'active' : '' }}">
                <a href="{{route('laporan.index')}}">
                    <i class="material-icons">dvr</i>
                    <span class="menu-title" data-i18n="Laporan">Laporan</span>
                </a>
            </li>
        </ul>
    </div>
</div>