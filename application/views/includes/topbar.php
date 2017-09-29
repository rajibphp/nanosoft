<!-- Top Bar Start -->
<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <a href="<?php echo site_url('dashboard'); ?>" class="logo">
            <span>Nanosoft</span>
        </a>
    </div>

    <nav class="navbar navbar-custom">
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <button class="button-menu-mobile open-left waves-light waves-effect">
                    <i class="zmdi zmdi-menu"></i>
                </button>
            </li>
            
        </ul>

        <ul class="nav navbar-nav pull-right">
<!--            <li class="nav-item hidden-mobile">
                <form role="search" class="app-search">
                    <input type="text" placeholder="Search..." class="form-control">
                    <a href=""><i class="fa fa-search"></i></a>
                </form>
            </li>-->
            
            <li class="nav-item dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light nav-user"
                   data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    Logout
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-arrow profile-dropdown "
                     aria-labelledby="Preview">
                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        <h5 class="text-overflow">
                            <small>
                                <?php 
                                    echo $this->session->userdata('login_username');
                                ?>
                                <p><?php echo date("j F, Y"); ?></p>
                            </small> 
                        </h5>
                    </div>

                    <!-- item-->
                    <span>
                        <a href="<?php echo site_url('login/userLogout'); ?>" class="btn btn-default btn-flat">
                           <i class="zmdi zmdi-power"></i> Logout
                        </a>
                    </span>
                </div>
            </li>

        </ul>

    </nav>

</div>
<!-- Top Bar End -->