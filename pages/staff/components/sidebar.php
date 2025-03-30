<?php
$base_path =  '/web-project-the-a-team/pages/staff';

?>

<!-- sidebar navigation section -->

<base href=<?= $base_path ?>>
<nav class="navbar">

    <div class="navbar-content">
        <div class="navbar-top-section">
            <div class="sidebar-header">
                Student Course Hub
            </div>
            <div class="sidebar-menu">
                <a class="sidebar-link" href="<?= $base_path ?>">
                    <div class="menu-item" id="dashboard-menu-item">Dashboard</div>
                </a>
                <a class="sidebar-link" href="<?= $base_path ?>/programmes">
                    <div class="menu-item" id="modules-menu-item">Programmes</div>
                </a>
                <a class="sidebar-link" href="<?= $base_path ?>/modules">
                    <div class="menu-item" id="modules-menu-item">Modules</div>
                </a>

            </div>

        </div>

        <div class="logout-btn">Logout</div>
    </div>

</nav>