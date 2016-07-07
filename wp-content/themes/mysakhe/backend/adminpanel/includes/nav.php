 <!-- navbar side -->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <!-- sidebar-collapse -->
            <div class="sidebar-collapse">
                <!-- side-menu -->
                <ul class="nav" id="side-menu">
                    <li>
                        <!-- user image section-->
                        <div class="user-section">
                            <div class="user-section-inner">
                                <img src="<?php bloginfo('template_url'); ?>/backend/adminpanel/assets/img/user.jpg" alt="">
                            </div>
                            <div class="user-info">
                                <div>Administrator</div>
                                <div class="user-text-online">
                                    <span class="user-circle-online btn btn-success btn-circle "></span>&nbsp;Online
                                </div>
                            </div>
                        </div>
                        <!--end user image section-->
                    </li>
                    <li class="sidebar-search">
                        <!-- search section-->
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        <!--end search section-->
                    </li>
                    <li class="menu-orders">
                        <a href="?p=orders"><i class="fa fa-dashboard fa-fw"></i>Service Orders&nbsp;&nbsp;&nbsp;<span class="label label-warning pending_num"></span></a>
                    </li>
                    <li class="menu-services">
                        <a href="?p=services"><i class="fa fa-dashboard fa-fw"></i>Services</a>
                    </li>
                    <li class="menu-users">
                        <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Users<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse" style="">
                            <li class="menu-managers">
                                <a href="?p=managers">Managers</a>
                            </li>
                            <li class="menu-employees">
                                <a href="?p=employees">Employees</a>
                            </li>
                        </ul>
                        <!-- second-level-items -->
                    </li>
                </ul>
                <!-- end side-menu -->
            </div>
            <!-- end sidebar-collapse -->
        </nav>
        <!-- end navbar side -->