<div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-dark navbar-without-dd-arrow navbar-shadow" role="navigation" data-menu="menu-wrapper">
        <div class="navbar-container main-menu-content container center-layout" data-menu="menu-container">
            <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="dropdown nav-item {{ Request::is('dashboard') ? 'active' : '' }}" >
                    <a class="dropdown-toggle nav-link" href="/dashboard">
                        <i class="material-icons">settings_input_svideo</i><span>Beranda</span>
                    </a>
                </li>
                <li class="dropdown nav-item {{ Request::is('member') ? 'active' : '' }}">
                    <a class="dropdown-toggle nav-link" href="/member" >
                        <i class="material-icons">people_outline</i> <span data-i18n="Contacts">Member</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>