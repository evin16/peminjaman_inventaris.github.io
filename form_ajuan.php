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
        <title>Dashboard - Peminjaman</title>
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
                            <div class="sb-sidenav-menu-heading">Form Ajuan Peminjaman</div>
                            
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
                        <h1 class="mt-4">Form Peminjaman</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                                <!-- Tombol Kembali -->
                                <a class="btn btn-danger" href="ajuan.php" role="button">
                                    <i class="fas fa-angle-double-left"></i>
                                </a>
                            </div>
                            <div class="card-body">
                                <form method="post">
                                <div class="form-group row">
                                    <label for="namabarang" class="col-sm-2 col-form-label">Nama Barang</label>
                                    <div class="col-sm-10">
                                        <select name="barangnya" class="form-control">
                                            <option disabled selected> </option>
                                            <?php 
                                                $sql=mysqli_query($conn, "select * from barang");
                                                while ($data=mysqli_fetch_array($sql)) {
                                                    $namabarangnya = $data['nama_barang'];
                                            ?>
            
                                            <option value="<?=$namabarangnya?>"><?=$namabarangnya?></option> 
                                        
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="inputjenis" class="col-sm-2 col-form-label">Tanggal Peminjaman</label>
                                    <div class="col-sm-10">
                                    <input type="date" class="form-control" name="tglpinjam" required>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="inputjenis" class="col-sm-2 col-form-label">Tanggal Pengembalian</label>
                                    <div class="col-sm-10">
                                    <input type="date" class="form-control" name="tglkembali" required>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="inputjumlah" class="col-sm-2 col-form-label">Jumlah Barang</label>
                                    <div class="col-sm-10">
                                    <input type="number" class="form-control" name="jumlahbarang" placeholder="Jumlah Barang" required>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="inputjenis" class="col-sm-2 col-form-label">Nama Peminjam</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" name="namapeminjam" placeholder="Nama Peminjam" required>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="inputjumlah" class="col-sm-2 col-form-label">No Telepon</label>
                                    <div class="col-sm-10">
                                    <input type="number" class="form-control" name="notelp" placeholder="No Telepon" required>
                                    </div>
                                </div>
                                <br>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary" name="ajuan">Submit</button>
                                </div>
                                </form>
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