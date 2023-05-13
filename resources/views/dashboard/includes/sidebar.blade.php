<!-- Sidebar -->
        <!--
            Sidebar Mini Mode - Display Helper classes

            Adding 'smini-hide' class to an element will make it invisible (opacity: 0) when the sidebar is in mini mode
            Adding 'smini-show' class to an element will make it visible (opacity: 1) when the sidebar is in mini mode
                If you would like to disable the transition animation, make sure to also add the 'no-transition' class to your element

            Adding 'smini-hidden' to an element will hide it when the sidebar is in mini mode
            Adding 'smini-visible' to an element will show it (display: inline-block) only when the sidebar is in mini mode
            Adding 'smini-visible-block' to an element will show it (display: block) only when the sidebar is in mini mode
        -->
        <nav id="sidebar" aria-label="Main Navigation">
            <!-- Side Header -->
            <div class="content-header bg-white-5">
                <!-- Logo -->
                <a class="font-w600 text-dual" href="{{route('main')}}">
                    <span class="smini-visible">
                        <i class="fa fa-circle-notch text-primary"></i>
                    </span>
                    <span class="smini-hide font-size-h5 tracking-wider">
                        Mr<span class="font-w400">Mathematica</span>
                    </span>
                </a>
                <!-- END Logo -->

                <!-- Extra -->
                <div>
                    <!-- Options -->
                    <div class="dropdown d-inline-block ml-2">
                        <a class="btn btn-sm btn-dual" id="sidebar-themes-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                            <i class="si si-drop"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right font-size-sm smini-hide border-0" aria-labelledby="sidebar-themes-dropdown">
                            <!-- Color Themes -->
                            <!-- Layout API, functionality initialized in Template._uiHandleTheme() -->
                            <a class="dropdown-item d-flex align-items-center justify-content-between font-w500" data-toggle="theme" data-theme="default" href="#">
                                <span>Default</span>
                                <i class="fa fa-circle text-default"></i>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between font-w500" data-toggle="theme" data-theme="{{ asset('dashboard/assets/css/themes/amethyst.min.css') }}" href="#">
                                <span>Amethyst</span>
                                <i class="fa fa-circle text-amethyst"></i>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between font-w500" data-toggle="theme" data-theme="{{ asset('dashboard/assets/css/themes/city.min.css') }}" href="#">
                                <span>City</span>
                                <i class="fa fa-circle text-city"></i>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between font-w500" data-toggle="theme" data-theme="{{ asset('dashboard/assets/css/themes/flat.min.css') }}" href="#">
                                <span>Flat</span>
                                <i class="fa fa-circle text-flat"></i>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between font-w500" data-toggle="theme" data-theme="{{ asset('dashboard/assets/css/themes/modern.min.css') }}" href="#">
                                <span>Modern</span>
                                <i class="fa fa-circle text-modern"></i>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between font-w500" data-toggle="theme" data-theme="{{ asset('dashboard/assets/css/themes/smooth.min.css') }}" href="#">
                                <span>Smooth</span>
                                <i class="fa fa-circle text-smooth"></i>
                            </a>
                            <!-- END Color Themes -->

                            <div class="dropdown-divider"></div>

                            <!-- Sidebar Styles -->
                            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                            <a class="dropdown-item font-w500" data-toggle="layout" data-action="sidebar_style_light" href="#">
                                <span>Sidebar Light</span>
                            </a>
                            <a class="dropdown-item font-w500" data-toggle="layout" data-action="sidebar_style_dark" href="#">
                                <span>Sidebar Dark</span>
                            </a>
                            <!-- Sidebar Styles -->

                            <div class="dropdown-divider"></div>

                            <!-- Header Styles -->
                            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                            <a class="dropdown-item font-w500" data-toggle="layout" data-action="header_style_light" href="#">
                                <span>Header Light</span>
                            </a>
                            <a class="dropdown-item font-w500" data-toggle="layout" data-action="header_style_dark" href="#">
                                <span>Header Dark</span>
                            </a>
                            <!-- Header Styles -->
                        </div>
                    </div>
                    <!-- END Options -->

                    <!-- Close Sidebar, Visible only on mobile screens -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <a class="d-lg-none btn btn-sm btn-dual ml-1" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
                        <i class="fa fa-fw fa-times"></i>
                    </a>
                    <!-- END Close Sidebar -->
                </div>
                <!-- END Extra -->
            </div>
            <!-- END Side Header -->

            <!-- Sidebar Scrolling -->
            <div class="js-sidebar-scroll">
                <!-- Side Navigation -->
                <div class="content-side">
                    <ul class="nav-main">
                        <li class="nav-main-item">
                            <a class="nav-main-link active" href="{{route('main')}}">
                                <i class="nav-main-link-icon si si-speedometer"></i>
                                <span class="nav-main-link-name">{{ trans('sidebar.dashboard') }}</span>
                            </a>
                        </li>
                        <li class="nav-main-heading">{{ trans('sidebar.school_info') }}</li>

                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{route('grades.index')}}">
                                <i class="nav-main-link-icon fa fa-school"></i>
                                <span class="nav-main-link-name">{{ trans('sidebar.grades') }}</span>
                            </a>
                        </li>

                        <li class="nav-main-heading">Others</li>

                        <li class="nav-main-item">
                            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                <i class="nav-main-link-icon si si-badge"></i>
                                <span class="nav-main-link-name">Services</span>
                            </a>
                            <ul class="nav-main-submenu">
                                <li class="nav-main-item">
                                    <a class="nav-main-link" href="be_ui_grid.html">
                                        <span class="nav-main-link-name">Grid</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link" href="be_ui_typography.html">
                                        <span class="nav-main-link-name">Typography</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                <i class="nav-main-link-icon si si-grid"></i>
                                <span class="nav-main-link-name">Projects</span>
                            </a>
                            <ul class="nav-main-submenu">
                                <li class="nav-main-item">
                                    <a class="nav-main-link" href="be_tables_styles.html">
                                        <span class="nav-main-link-name">Styles</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-main-item">
                            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                <i class="nav-main-link-icon si si-grid"></i>
                                <span class="nav-main-link-name">inbox</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- END Side Navigation -->
            </div>
            <!-- END Sidebar Scrolling -->
        </nav>
        <!-- END Sidebar -->
