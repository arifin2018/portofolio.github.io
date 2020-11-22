<?php
require_once 'cek_session.php';
$base_url = "http://arifinportofolio.rf.gd/"
?>
<nav class="navbar navbar-expand-sm bg-primary navbar-dark">
    <div class="container">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link <?= $active == 'dashboard' ? 'active' : '' ?>" href="<?= $base_url ?>admin">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $active == 'master' ? 'active' : '' ?> " href="<?= $base_url ?>admin/master/index.php">Data Contact</a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link <?= $active == 'bukutamu' ? 'active' : '' ?> " href="<?= $base_url ?>admin/bukutamu.php">Bukutamu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $active == 'tentang_website' ? 'active' : '' ?> " href="<?= $base_url ?>admin/tentang_website.php">Tentang Website</a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link" href="<?= $base_url ?>admin/logout.php" onclick="return confirm('apakah anda yakin?')">Logout</a>
            </li>
        </ul>
    </div>
</nav>