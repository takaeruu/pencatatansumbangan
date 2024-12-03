<?php $currentUri = uri_string(); ?>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <img src="<?= base_url('images/' . $yogi->logo_website) ?>" alt="logo" style="max-width: 150%; height: auto; max-height: 100px;"/>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>

                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <!-- Dashboard -->
                        <li class="sidebar-item <?= ($currentUri == 'home/dashboard') ? 'active' : '' ?>">
                            <a href="<?= base_url('home/dashboard') ?>" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <?php
      if (session()->get('level') == 'admin' || session()->get('level') == 'osis'){
        ?>
                        <!-- Menu -->
                        <li class="sidebar-item <?= ($currentUri == 'home/program') ? 'active' : '' ?>">
                            <a href="<?= base_url('home/program') ?>" class='sidebar-link'>
                            <i class="fa fa-hand-holding-heart"></i>
                                <span>Program</span>
                            </a>
                        </li>

                        <?php 
      } else {

      }
?>

                        <li class="sidebar-item <?= ($currentUri == 'home/donasi') ? 'active' : '' ?>">
                            <a href="<?= base_url('home/donasi') ?>" class='sidebar-link'>
                                <i class="fa fa-donate"></i>
                                <span>Donasi</span>
                            </a>
                        </li>

                        <?php
      if (session()->get('level') == 'admin'){
        ?>
                        <li class="sidebar-item <?= ($currentUri == 'home/user') ? 'active' : '' ?>">
                            <a href="<?= base_url('home/user') ?>" class='sidebar-link'>
                                <i class="fa fa-user"></i>
                                <span>User</span>
                            </a>
                        </li>

                        <!-- Pemesanan -->

                        <!-- Modal - Submenu with multiple items -->

                        <!-- Settings -->
                        <li class="sidebar-item has-sub <?= ($currentUri == 'home/setting' || $currentUri == 'home/soft_delete' || $currentUri == 'home/restore_edit_program') ? 'active' : '' ?>">
    <a href="#" class="sidebar-link">
        <i class="bi bi-gear-fill"></i>
        <span>Setting</span>
    </a>
    <ul class="submenu">
        <!-- Setting -->
        <li class="submenu-item <?= ($currentUri == 'home/setting') ? 'active' : '' ?>">
            <a href="<?= base_url('home/setting') ?>">
                <i class="bi bi-file-earmark-medical-fill"></i>
                <span>Settings</span>
            </a>
        </li>

        <!-- Soft Delete -->
        <li class="submenu-item <?= ($currentUri == 'home/soft_delete') ? 'active' : '' ?>">
            <a href="<?= base_url('home/soft_delete') ?>">
                <i class="bi bi-file-earmark-medical-fill"></i>
                <span>Soft Delete</span>
            </a>
        </li>

        <!-- Restore Edit -->
        <li class="submenu-item <?= ($currentUri == 'home/restore_edit_program') ? 'active' : '' ?>">
            <a href="<?= base_url('home/restore_edit_program') ?>">
                <i class="bi bi-file-earmark-medical-fill"></i>
                <span>Restore Edit</span>
            </a>
        </li>
    </ul>
</li>


                        <!-- Log Activity -->
                        <li class="sidebar-item <?= ($currentUri == 'home/log_activity') ? 'active' : '' ?>">
    <a href="<?= base_url('home/log_activity') ?>" class='sidebar-link'>
        <i class="bi bi-clipboard-data"></i>
        <span>Log Activity</span>
    </a>
</li>

<?php 
      } else {

      }
?>



                        <li class="sidebar-item">
    <a href="<?= base_url('home/logout') ?>" class="sidebar-link">
        <i class="fa fa-sign-out-alt"></i>
        <span>Logout</span>
    </a>
</li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="main">
            <header class="mb-3"></header>
