<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-lg-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item mr-auto">
                    <a class="navbar-brand" href="index.html">
                        <h3 class="brand-text">Mandali Indonesia</h3>
                    </a>
                </li>
                <li class="nav-item d-lg-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="material-icons mt-50">more_vert</i></a></li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li>
                </ul>
                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="material-icons">notifications_none</i><span class="badge badge-pill badge-danger badge-up badge-glow">5</span></a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                            <li class="dropdown-menu-header">
                                <h6 class="dropdown-header m-0"><span class="grey darken-2">Notifications</span></h6><span class="notification-tag badge badge-danger float-right m-0">5 New</span>
                            </li>
                            <li class="scrollable-container media-list w-100"><a href="javascript:void(0)">
                                    <div class="media">
                                        <div class="media-left align-self-center"><i class="material-icons icon-bg-circle bg-cyan mr-0">add_box</i></div>
                                        <div class="media-body">
                                            <h6 class="media-heading">You have new order!</h6>
                                            <p class="notification-text font-small-3 text-muted">Lorem ipsum dolor sit amet, consectetuer elit.</p><small>
                                                <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">30 minutes ago</time></small>
                                        </div>
                                    </div>
                                </a>
                                <a href="javascript:void(0)">
                                    <div class="media">
                                        <div class="media-left align-self-center"><i class="material-icons icon-bg-circle bg-teal mr-0">insert_drive_file</i></div>
                                        <div class="media-body">
                                            <h6 class="media-heading">Generate monthly report</h6><small>
                                                <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Last month</time></small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center" href="javascript:void(0)">Read all notifications</a></li>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown"><span class="mr-1 user-name text-bold-700">{{Auth::guard('admin')->user()->admin_name}}</span><span class="avatar avatar-online"><img src="../../../app-assets/images/portrait/small/avatar-s-19.png" alt="avatar"><i></i></span></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="/admin/profile"><i class="material-icons">person_outline</i> Edit Profile</a>
                            <div class="dropdown-divider"></div><a class="dropdown-item" href="/admin/logout"><i class="material-icons">power_settings_new</i> Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>