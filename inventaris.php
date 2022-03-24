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
                    <h1 class="mt-4">Data Inventaris</h1>
                    <hr>
                    <div class="card mb-4">
                        <div class="card-header">
                            <a class="btn btn-danger" href="index.php" role="button">
                                <i class="fas fas fa-arrow-circle-left"></i>
                            </a>
                            <a class="btn btn-primary" href="form_barang.php" role="button">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>

                        <div class="card-body">

                            <?php
                            $stockhabis = mysqli_query($conn, "select * from barang where jumlah < 1");

                            while ($sampel = mysqli_fetch_array($stockhabis)) {
                                $barang = $sampel['nama_barang'];

                            ?>
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    <strong>Peringatan!</strong> Stock <?= $barang; ?> tidak ada!
                                </div>
                            <?php

                            }

                            ?>

                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama Barang</th>
                                        <th>Jenis Barang</th>
                                        <th>Jumlah</th>
                                        <th>Kondisi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    $datainventaris = mysqli_query($conn, "select * from barang ");
                                    while ($data = mysqli_fetch_array($datainventaris)) {
                                        $i++;
                                        $nama_barang = $data['nama_barang'];
                                        $jenis_barang = $data['jenis_barang'];
                                        $total = $data['jumlah'];
                                        $keterangan = $data['kondisi'];
                                        $idb = $data['id_barang'];
                                    ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $nama_barang; ?></td>
                                            <td><?= $jenis_barang; ?></td>
                                            <td><?= $total; ?></td>
                                            <td><?= $keterangan; ?></td>
                                            <td>
                                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#edit<?= $idb; ?>" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#delete<?= $idb; ?>" title="Hapus">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>

                                            <!-- The Modal -->
                                            <div class="modal fade" id="edit<?= $idb; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Form Edit Data</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                <div class="form-floating mb-3">
                                                                    <input type="text" name="namabarang" value="<?= $nama_barang; ?>" class="form-control" required>
                                                                    <label for="role">Nama Barang</label>
                                                                </div>
                                                                <div class="form-floating mb-3">
                                                                    <input type="number" name="jumlah" class="form-control" required>
                                                                    <label for="role">Jumlah Barang</label>
                                                                </div>
                                                                <div class="form-floating mb-3">
                                                                    <input type="text" name="keterangan" class="form-control" required>
                                                                    <label for="role">Kondisi Barang</label>
                                                                </div>
                                                                <input type="hidden" name="idb" value="<?= $idb; ?>">
                                                                <div class="form-group row">
                                                                    <button type="submit" class="btn btn-primary" name="editbarang">Submit</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal Hapus Data -->
                                            <div class="modal fade" id="delete<?= $idb; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Form Hapus Data</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                <div class="form-group row">
                                                                    <p>Apakah anda yakin menghapus <?= $nama_barang; ?> ?</p>
                                                                </div>
                                                                <input type="hidden" name="idb" value="<?= $idb; ?>">
                                                                <br>
                                                                <div class="d-grid">
                                                                    <button type="submit" class="btn btn-danger" name="hapusbarang">Hapus</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
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