<style>
    .font-white {
        color: white !important;
        transition: 0.25s;
    }

    .font-white:hover {
        color: #cacaca !important;
        transition: 0.25s;
    }

    #guest-login {
        border-radius: 100%;
    }

    .navbar {
        box-shadow: 0px 4px 39px -10px black;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light mb-3 fixed-top" style="background-color:#004488">
    <div class="container">

        <!-- Judul di sebelah kiri -->
        <a href="#" class="navbar-brand">
            <span class="font-white">Sistem Informasi Perhotelan</span>
        </a>

        <!-- Button Toggle -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav1" aria-controls="navbarNav1" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Isi dari Navbar -->
        <div class="collapse navbar-collapse" id="navbarNav1">
            <ul class="navbar-nav mr-auto">

                <?php if ($_SESSION['user']['user_level'] == 'ADMIN') { ?>
                <li class="nav-item">
                    <a href="dashboard.php" class="nav-link font-white">Beranda</a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link font-white dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Input Data
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a href="dashboard.php?page=data_kamar" class="dropdown-item">Input Data Kamar</a>
                        <a href="dashboard.php?page=data_jasa" class="dropdown-item">Input Data Jasa</a>
                        <a href="dashboard.php?page=data_tamu" class="dropdown-item">Input Data Tamu</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link font-white dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Transaksi
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a href="dashboard.php?page=transaksi_jasa" class="dropdown-item">Transaksi Jasa</a>
                        <a href="dashboard.php?page=tagihan" class="dropdown-item">Tagihan Tamu</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="dashboard.php?page=income" class="nav-link font-white">Keuangan</a>
                </li>
                <?php } ?>

            </ul>

            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle font-white" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin:-10px 0px;">
                        Selamat datang, <?= $_SESSION['user']['username'] ?>.
                        &nbsp;<img id="guest-login" class="img-thumbnail" width="38" src="./assets/user-male-icon.png">
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a href="logout.php" class="dropdown-item">Keluar</a>
                    </div>
                </li>
            </ul>
        </div>

    </div>
</nav>
