<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow navbar-static-top navbar-light navbar-brand-center">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item">
                    <a class="navbar-brand" href="/dashboard">
                        <img class="brand-logo" alt="Mandali Indonesia" src="{{asset('app-assets/images/logo.png')}}" width="20px" height="50px">
                    </a>
                </li>
                <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a></li>
            </ul>
        </div>
        <div class="navbar-container container center-layout">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle" href="#"><i class="ft-menu"></i></a></li>
                    
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
                                </a><a href="javascript:void(0)">
                                    <div class="media">
                                        <div class="media-left align-self-center"><i class="material-icons icon-bg-circle bg-red bg-darken-1">cloud_download</i></div>
                                        <div class="media-body">
                                            <h6 class="media-heading red darken-1 mr-0">99% Server load</h6>
                                            <p class="notification-text font-small-3 text-muted">Aliquam tincidunt mauris eu risus.</p><small>
                                                <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Five hour ago</time></small>
                                        </div>
                                    </div>
                                </a><a href="javascript:void(0)">
                                    <div class="media">
                                        <div class="media-left align-self-center"><i class="material-icons icon-bg-circle bg-yellow bg-darken-3 mr-0">warning</i></div>
                                        <div class="media-body">
                                            <h6 class="media-heading yellow darken-3">Warning notifixation</h6>
                                            <p class="notification-text font-small-3 text-muted">Vestibulum auctor dapibus neque.</p><small>
                                                <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Today</time></small>
                                        </div>
                                    </div>
                                </a><a href="javascript:void(0)">
                                    <div class="media">
                                        <div class="media-left align-self-center"><i class="material-icons icon-bg-circle bg-cyan mr-0">check_circle</i></div>
                                        <div class="media-body">
                                            <h6 class="media-heading">Complete the task</h6><small>
                                                <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Last week</time></small>
                                        </div>
                                    </div>
                                </a><a href="javascript:void(0)">
                                    <div class="media">
                                        <div class="media-left align-self-center"><i class="material-icons icon-bg-circle bg-teal mr-0">insert_drive_file</i></div>
                                        <div class="media-body">
                                            <h6 class="media-heading">Generate monthly report</h6><small>
                                                <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Last month</time></small>
                                        </div>
                                    </div>
                                </a></li>
                            <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center" href="javascript:void(0)">Read all notifications</a></li>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <span class="mr-1 user-name text-bold-700">{{Str::upper(Auth::guard('web')->user()->nama_lengkap)}}</span><span class="avatar avatar-online"><img src="../../../app-assets/images/portrait/small/avatar-s-19.png" alt="avatar"><i></i></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="/profile/{{Auth::guard('web')->user()->user_id}}"><i class="material-icons">person_outline</i> Edit Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/logout">
                                <i class="material-icons">power_settings_new</i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>