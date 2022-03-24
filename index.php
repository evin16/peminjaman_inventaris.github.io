<?php

require 'function.php';

if ($_SESSION['status'] != "login") {
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">Sebelas Maret</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Halaman</div>

                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link" href="peminjaman.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-th-list"></i></div>
                            Peminjaman
                        </a>
                        <a class="nav-link" href="inventaris.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-warehouse"></i></div>
                            Inventaris
                        </a>
                        <a class="nav-link" href="ajuan.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-paperclip"></i></div>
                            Ajuan Pinjaman
                        </a>
                        <a class="nav-link" href="kelola_admin.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-eye"></i></div>
                            Kelola Admin
                        </a>
                        <a class="nav-link" href="logout.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                            Logout
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-header text-secondary">
                                    Inventaris
                                    <a href="inventaris.php" style="float: right;">
                                        <i class="fas fa-arrow-circle-right text-primary"></i>
                                    </a>
                                </div>
                                <div class="card-body bg-primary text-white">
                                    <?php
                                    $query = mysqli_query($conn, "select * from barang");
                                    $result = mysqli_num_rows($query);
                                    ?>
                                    <h3 style="text-align:right">
                                        <?= $result; ?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-header text-secondary">
                                    Ajuan Pinjaman
                                    <a href="ajuan.php" style="float: right;">
                                        <i class="fas fa-arrow-circle-right text-warning"></i>
                                    </a>
                                </div>
                                <div class="card-body bg-warning text-white">
                                    <?php
                                    $query = mysqli_query($conn, "select * from ajuan_pinjaman");
                                    $result = mysqli_num_rows($query);
                                    ?>
                                    <h3 style="text-align:right">
                                        <?= $result; ?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-header text-secondary">
                                    Peminjaman
                                    <a href="peminjaman.php" style="float: right;">
                                        <i class="fas fa-arrow-circle-right text-success"></i>
                                    </a>
                                </div>
                                <div class="card-body bg-success text-white">
                                    <?php
                                    $query = mysqli_query($conn, "select * from peminjaman");
                                    $result = mysqli_num_rows($query);
                                    ?>
                                    <h3 style="text-align:right">
                                        <?= $result; ?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-header text-secondary">
                                    User
                                    <a href="kelola_admin.php" style="float: right;">
                                        <i class="fas fa-arrow-circle-right text-danger"></i>
                                    </a>
                                </div>
                                <div class="card-body bg-danger text-white">
                                    <?php 
                                    $query = mysqli_query($conn, "select * from users");
                                    $result = mysqli_num_rows($query);
                                    ?>
                                    <h3 style="text-align:right">
                                        <?= $result; ?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3>Tabel Peminjaman</h3>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama Barang</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Jumlah</th>
                                        <th>Nama Peminjam</th>
                                        <th>No Telp</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    $datainventaris = mysqli_query($conn, "select * from barang b, peminjaman p
                                        where b.nama_barang = p.nama_barang");
                                    while ($data = mysqli_fetch_array($datainventaris)) {
                                        $i++;
                                        $nama_barang = $data['nama_barang'];
                                        $tanggal_pinjam = $data['tanggal_pinjam'];
                                        $tanggal_kembali = $data['tanggal_kembali'];
                                        $total = $data['jumlah'];
                                        $peminjam = $data['peminjam'];
                                        $status = $data['status'];
                                        $no_telp = $data['telp'];
                                        $idp = $data['id_pinjam'];
                                    ?>

                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $nama_barang; ?></td>
                                            <td><?= $tanggal_pinjam; ?></td>
                                            <td><?= $tanggal_kembali; ?></td>
                                            <td><?= $total; ?></td>
                                            <td><?= $peminjam; ?></td>
                                            <td><?= $no_telp; ?></td>
                                            <td><?= $status; ?></td>
                                        </tr>
                                    <?php
                                    };
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Universitas Sebelas Maret 2022</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>