<?php

require 'function.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - Inventaris</title>
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

                        <a class="nav-link" href="home.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link" href="gpeminjaman.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-th-list"></i></div>
                            Peminjaman
                        </a>
                        <a class="nav-link" href="ginventaris.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-warehouse"></i></div>
                            Inventaris
                        </a>
                        <a class="nav-link" href="gajuan.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-paperclip"></i></div>
                            Ajuan Pinjaman
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
                    <h1 class="mt-4">Data Ajuan Pinjaman</h1>
                    <hr>
                    <div class="card mb-4">
                        <div class="card-header">
                            <a class="btn btn-danger" href="home.php" role="button" title="Dashboard">
                                <i class="fas fas fa-arrow-circle-left"></i>
                            </a>
                            <a class="btn btn-primary" href="form_gajuan.php" role="button">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>

                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Jumlah</th>
                                        <th>Peminjam</th>
                                        <th>No telp</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $datainventaris = mysqli_query($conn, "select * from barang b, ajuan_pinjaman a
                                        where b.nama_barang = a.nama_barang");
                                    while ($data = mysqli_fetch_array($datainventaris)) {
                                        $nama_barang = $data['nama_barang'];
                                        $tanggal_pinjam = $data['tgl_pinjam'];
                                        $tanggal_kembali = $data['tgl_kembali'];
                                        $total = $data['jumlah'];
                                        $peminjam = $data['peminjam'];
                                        $no_telp = $data['telp'];
                                        $status = $data['acc'];
                                        $ida = $data['id_ajuan'];
                                    ?>

                                        <tr>
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