<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="index.php?ahref=home" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <?php
        if ($_SESSION['user']) {
        ?>
            <!-- Navbar Search -->
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block">
                    <form class="form-inline">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                    <i class="fas fa-solid fa-gear"></i>
                </a>
            </li>
        <?php
        } else {
        ?>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="index.php?ahref=login" class="nav-link">Login</a>
            </li>

        <?php
        }
        ?>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php?ahref=home-view" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Berita Acara</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <?php
        if ($_SESSION['user']) {
        ?>
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="dist/img/user1-128x128.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block"><?= $_SESSION['web_user_full_name'] ?></a>
                </div>
            </div>
            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>
        <?php
        } else {
        ?>
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">

                <div class="info">
                    <a href="index.php?ahref=login" class="d-block">You need to login first</a>
                </div>
            </div>
        <?php
        } ?>



        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <?php if ($_SESSION['user'] && ($_SESSION['user_role_id'] == 3 || $_SESSION['user_role_id'] == 1)) { ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-solid fa-user"></i>
                            <p>
                                Dosen
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="index.php?ahref=dosen" class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?ahref=dosen-berita-acara" class="nav-link">
                                    <i class="nav-icon fas fa-solid fa-file-circle-plus"></i>
                                    <p>Berita Acara</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                <?php }
                if ($_SESSION['user'] && ($_SESSION['user_role_id'] == 2 || $_SESSION['user_role_id'] == 1)) { ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-solid fa-user-tie"></i>
                            <p>
                                Staff
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="index.php?ahref=staff-berita-acara" class="nav-link">
                                    <i class="nav-icon fas fa-solid fa-list"></i>
                                    <p>Berita Acara</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?ahref=staff-jadwal" class="nav-link">
                                    <i class="nav-icon fas fa-solid fa-calendar-days"></i>
                                    <p>Jadwal</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?ahref=staff-mata-kuliah" class="nav-link">
                                    <i class="nav-icon fas fa-solid fa-book"></i>
                                    <p>Mata Kuliah</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?ahref=staff-ruangan" class="nav-link">
                                    <i class="nav-icon fas fa-solid fa-house"></i>
                                    <p>Ruangan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?ahref=staff-semester" class="nav-link">
                                    <i class="nav-icon fas fa-solid fa-graduation-cap"></i>
                                    <p>Semester</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?ahref=staff-dosen" class="nav-link">
                                    <i class="nav-icon fas fa-solid fa-chalkboard-user"></i>
                                    <p>Dosen</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?ahref=staff-asisten" class="nav-link">
                                    <i class="nav-icon fas fa-solid fa-user-group"></i>
                                    <p>Asisten</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                <?php  }
                if ($_SESSION['user']) { ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-toggle="modal" data-target="#modal-default">

                            <script>
                                function signOut() {
                                    window.location = "index.php?ahref=logout";
                                }
                            </script>
                            <i class="nav-icon fas fa-solid fa-right-from-bracket"></i>
                            <p>
                                Sign Out

                            </p>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

</aside>
<!-- ./wrapper -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirmation</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure want to sign out?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="signOut()">Sign Out</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->