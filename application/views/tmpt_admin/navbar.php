<nav class="navbar navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-brand">
            <button type="button" class="btn-toggle-offcanvas"><i class="fa fa-bars"></i></button>
            <button type="button" class="btn-toggle-fullwidth"><i class="fa fa-bars"></i></button>
            <a href="index.html"> &ensp; Tiketting Event</a>
        </div>
        <div class="navbar-right">
            <div class="user-account m-0 p-0">
                <div class="dropdown">
                    <a href="javascript:void(0);" data-toggle="dropdown"
                        style="font-size:25px; margin-top: 1px; margin-bottom: 1px;"><i class="fa fa-power-off"></i></a>
                    <ul class="dropdown-menu dropdown-menu-right account">
                        <li><a href="<?= site_url('Profile'); ?>"><i class=" fa fa-user-md"></i>My Profile</a></li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?= base_url('Auth/logout'); ?>" class="icon-menu"><i
                                    class="fa fa-sign-out"></i>Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>