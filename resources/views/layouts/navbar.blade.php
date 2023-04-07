<!-- Navbar-->
<header class="main-header-top hidden-print">
    <a href="{{ route('home') }}" class="logo">
        <img class="img-fluid able-logo" src="{{ url('storage/app/public/sale_images') }}/{{ \App\Models\BusinessSetting::first()->business_logo }}" alt="Theme-logo"></a>
        {{--<img class="img-fluid able-logo" src="{{ URL::asset('public/assets/images//logo/logo.png') }}" alt="Theme-logo"></a>--}}
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="javascript:void(0)" data-toggle="offcanvas" class="sidebar-toggle"></a>
        @if(Request::segment(2)=='pos')
        <div class="navbar-custom-menu">
            <ul class="top-nav" style="float: left">
                <!--Notification Menu-->
                <li class="pc-rheader-submenu">
                    <a href="{{ url('home') }}">
                        <img src="{{ url('storage/app/public/sale_images') }}/{{ \App\Models\BusinessSetting::first()->business_logo }}" width="200" height="58">
                    </a>
                </li>
            </ul>
        </div>
        @endif
        <!-- Navbar Right Menu-->
        <div class="navbar-custom-menu f-right mt10" style="margin-right:10px;">
            <ul class="top-nav">
                <!--Notification Menu-->
                <li class="pc-rheader-submenu">
                    <a href="{{ url('sale/gen_invoice/') }}"  title="Print Last Receipt">
                        <i class="fa fa-print"></i>
                    </a>
                </li>
                <li class="pc-rheader-submenu">
                    <a href="#" onclick="cash_register()" data-toggle="tooltip" data-placement="bottom" title="Cash Register Details">
                        <i class="fa fa-briefcase"></i>
                    </a>
                </li>
                <li class="pc-rheader-submenu">
                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Today Sale">
                        <i class="fa fa-bar-chart"></i>
                    </a>
                </li>
                <li class="dropdown notification-menu">
                    <a href="#!" data-toggle="dropdown" aria-expanded="false" class="dropdown-toggle">
                        <i class="icon-bell"></i>
                        <span class="badge badge-primary header-badge">3</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="not-head">You have <b class="text-primary">3</b> new notifications.</li>
                        <li class="bell-notification">
                            <a href="notify_due_inv" class="media">
                                <span class="media-left media-icon">
                                    <i class="fa fa-bell"></i>
                                </span>
                                <div class="media-body"><span class="block">you have 0 invoices Due for payment</span><!--<span class="text-muted block-time">2min ago</span>--></div></a>
                            </li>
                            <li class="bell-notification">
                                <a href="notify?type=dep" class="media">
                                    <span class="media-left media-icon">
                                       <i class="fa fa-calendar"></i>
                                    </span>
                                    <div class="media-body"><span class="block">You Have 1 Departures</span><span class="text-muted block-time"></span></div></a>
                                </li>
                                <li class="bell-notification">
                                    <a href="notify?type=arrival" class="media"><span class="media-left media-icon">
                                        <span class="media-left media-icon">
                                       <i class="fa fa-calendar"></i>
                                    </span>
                                    </span>
                                    <div class="media-body"><span class="block">You Have 2 Arrivals</span></div></a>
                                </li>
								<li class="bell-notification">
                                    <a href="notify" class="media"><span class="media-left media-icon">
                                         <i class="fa fa-calendar"></i>
                                    </span>
                                    <div class="media-body"><span class="block">Visa Expired</span></div></a>
                                </li>
                                <!--<li class="not-footer">
                                    <a href="#!">See all notifications.</a>
                                </li>-->
                            </ul>
                        </li>
                        <!-- window screen -->
                        <li class="pc-rheader-submenu">
                            <a href="javascript:void(0)" class="drop icon-circle" onclick="javascript:toggleFullScreen()">
                                <i class="icon-size-fullscreen"></i>
                            </a>

                        </li>
                        <!-- User Menu-->
                        <li class="dropdown">
                            <a href="javascript:void(0)" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle drop icon-circle drop-image">
                                <span><img class="img-circle " src="{{ url('storage/app/public/users_images/'.Auth::user()->profile_photo_path) }}" style="width:40px;" alt="User Image"></span>
                                <span>{{ Auth::user()->name }} <i class=" icofont icofont-simple-down"></i></span>

                            </a>
                            <ul class="dropdown-menu settings-menu">
                                <li><a href="javascript:void(0)"><i class="icon-settings"></i> Settings</a></li>
                                <li><a href="profile.html"><i class="icon-user"></i> Profile</a></li>
                                <!--<li><a href="message.html"><i class="icon-envelope-open"></i> My Messages</a></li>
                                <li class="p-0">
                                    <div class="dropdown-divider m-0"></div>
                                </li>
                                <li><a href="lock-screen.html"><i class="icon-lock"></i> Lock Screen</a></li>-->
                                <li><a href="{{ url('logout') }}"><i class="icon-logout"></i> Logout</a></li>

                            </ul>
                        </li>
                    </ul>

                    <!-- search -->
                    <div id="morphsearch" class="morphsearch">
                        <form class="morphsearch-form">

                            <input class="morphsearch-input" type="search" placeholder="Search..."/>

                            <button class="morphsearch-submit" type="submit">Search</button>

                        </form>
                        <div class="morphsearch-content">
                            <div class="dummy-column">
                                <h2>People</h2>
                                <a class="dummy-media-object" href="#!">
                                    <img class="round" src="https://0.gravatar.com/avatar/81b58502541f9445253f30497e53c280?s=50&d=identicon&r=G" alt="Sara Soueidan"/>
                                    <h3>Sara Soueidan</h3>
                                </a>

                                <a class="dummy-media-object" href="#!">
                                    <img class="round" src="https://1.gravatar.com/avatar/9bc7250110c667cd35c0826059b81b75?s=50&d=identicon&r=G" alt="Shaun Dona"/>
                                    <h3>Shaun Dona</h3>
                                </a>
                            </div>
                            <div class="dummy-column">
                                <h2>Popular</h2>
                                <a class="dummy-media-object" href="#!">
                                    <img src="comp_logo/logo.png" alt="PagePreloadingEffect"/>
                                    <h3>Page Preloading Effect</h3>
                                </a>

                                <a class="dummy-media-object" href="#!">
                                    <img src="assets/images/avatar-1.png" alt="DraggableDualViewSlideshow"/>
                                    <h3>Draggable Dual-View Slideshow</h3>
                                </a>
                            </div>
                            <div class="dummy-column">
                                <h2>Recent</h2>
                                <a class="dummy-media-object" href="#!">
                                    <img src="assets/images/avatar-1.png" alt="TooltipStylesInspiration"/>
                                    <h3>Tooltip Styles Inspiration</h3>
                                </a>
                                <a class="dummy-media-object" href="#!">
                                    <img src="assets/images/avatar-1.png" alt="NotificationStyles"/>
                                    <h3>Notification Styles Inspiration</h3>
                                </a>
                            </div>
                        </div><!-- /morphsearch-content -->
                        <span class="morphsearch-close"><i class="icofont icofont-search-alt-1"></i></span>
                    </div>
                    <!-- search end -->
                </div>
            </nav>
			<span style="font-size:18px;cursor:pointer;position:absolute;right:15px;top:21px;" onclick="openNav()" id="openNav">&#9776;</span>
			<span style="font-size:22px;cursor:pointer;position:absolute;right:15px;top:17px;display:none;" onclick="closeNav()" id="closeNav">&times;</span>

        </header>
