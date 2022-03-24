<?php

session_start();

//membuat koneksi ke database
$conn = mysqli_connect('localhost', 'root', '', 'peminjaman_barang');

//menambah jenis barang baru
if (isset($_POST['tambah_barang'])) {
    $namabarang = $_POST['namabarang'];
    $jenisbarang = $_POST['jenisbarang'];
    $totalbarang = $_POST['totalbarang'];
    $kondisibarang = $_POST['kondisibarang'];

    $addontable = mysqli_query($conn, "INSERT into barang (nama_barang, jenis_barang, jumlah, kondisi) 
    values ('$namabarang', '$jenisbarang', '$totalbarang', '$kondisibarang')");

    if ($addontable) {
        header('location: inventaris.php');
    } else {
        header('location: form_barang.php');
    }
}

//menambah pinjaman baru
if (isset($_POST['peminjaman'])) {
    $barangnya = $_POST['barangnya'];
    $tglpinjam = $_POST['tglpinjam'];
    $tglkembali = $_POST['tglkembali'];
    $jumlahbarang = $_POST['jumlahbarang'];
    $namapeminjam = $_POST['namapeminjam'];

    $cekstok = mysqli_query($conn, "SELECT * from barang where nama_barang='$barangnya' ");
    $ambildata = mysqli_fetch_array($cekstok);

    $stok_ada = $ambildata['jumlah'];
    $penguranganstok = $stok_ada - $jumlahbarang;

    $updatestok = mysqli_query($conn, "UPDATE barang set jumlah='$penguranganstok' where nama_barang= '$barangnya'");

    $pinjam = mysqli_query($conn, "insert into peminjaman (nama_barang, tanggal_pinjam, tanggal_kembali, jumlah, peminjam) 
    values ('$barangnya', '$tglpinjam', '$tglkembali', '$jumlahbarang', '$namapeminjam')");
    if ($pinjam && $updatestok) {
        header('location: peminjaman.php');
    } else {
        header('location: form_peminjaman.php');
    }
}

// Hapus data pinjaman
if (isset($_POST['hapuspinjam'])) {
    $idp = $_POST['idp'];

    $dihapus = mysqli_query($conn, "DELETE from peminjaman WHERE id_pinjam='$idp'");

    if ($dihapus) {
        header('location: peminjaman.php');
    } else {
        header('location: index.php');
    }
}

// Update Info Inventaris
if (isset($_POST['editbarang'])) {
    $idb = $_POST['idb'];
    $namabarang = $_POST['namabarang'];
    $jumlahbarang = $_POST['jumlah'];
    $kondisi = $_POST['keterangan'];

    $update = mysqli_query($conn, "UPDATE barang set nama_barang='$namabarang', jumlah='$jumlahbarang', kondisi='$kondisi' where id_barang='$idb'");
    if ($update) {
        header('location: inventaris.php');
    } else {
        header('location: inventaris.php');
    }
}

// Hapus Info Inventaris
if (isset($_POST['hapusbarang'])) {
    $idb = $_POST['idb'];

    $hapus = mysqli_query($conn, "DELETE from barang where id_barang='$idb'");
    if ($hapus) {
        header('location: inventaris.php');
    } else {
        header('location: inventaris.php');
    }
}

// Pengembalian Data Peminjaman
if (isset($_POST['kembalian'])) {
    $idp = $_POST['idp'];

    $kembali = mysqli_query($conn, "UPDATE peminjaman SET status='Dikembalikan' WHERE id_pinjam='$idp'");

    $data = $conn->query("SELECT * FROM peminjaman WHERE id_pinjam='$idp' ");
    while ($result = $data->fetch_assoc()) {
        $barang = $result['nama_barang'];
        $jmlh = $result['jumlah'];
    }

    $cekstok = mysqli_query($conn, "SELECT * from barang where nama_barang='$barang'");
    $ambildata = mysqli_fetch_array($cekstok);

    $stok_ada = $ambildata['jumlah'];
    $penguranganstok = $stok_ada + $jmlh;

    $updatestok = mysqli_query($conn, "update barang set jumlah='$penguranganstok' where nama_barang= '$barang'");

    if ($kembali && $updatestok) {
        header('location: peminjaman.php');
    } else {
        header('location: index.php');
    }
}

//menambah admin baru
if (isset($_POST['tambah_admin'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $addadmin = mysqli_query($conn, "insert into users (email, username, password, role) 
    values ('$email', '$username', '$password', '$role')");

    if ($addadmin) {
        header('location: index.php');
    } else {
        header('location: kelola_admin.php');
    }
}

//menambah ajuan pinjaman
if (isset($_POST['ajuan'])) {
    $barangnya = $_POST['barangnya'];
    $tglpinjam = $_POST['tglpinjam'];
    $tglkembali = $_POST['tglkembali'];
    $jumlahbarang = $_POST['jumlahbarang'];
    $namapeminjam = $_POST['namapeminjam'];

    $addontable = mysqli_query($conn, "INSERT INTO ajuan_pinjaman (nama_barang, tgl_pinjam, tgl_kembali, jumlah, peminjam, acc) 
    VALUES ('$barangnya', '$tglpinjam', '$tglkembali', '$jumlahbarang', '$namapeminjam', 'Dalam Ajuan')");

    if ($addontable) {
        header('location: ajuan.php');
    } else {
        header('location: form_ajuan.php');
    }
}

//Status ajuan diterima
if (isset($_POST['disetujui'])) {
    $ida = $_POST['ida'];
    $jmlh = $_POST['total'];

    $disetujui = mysqli_query($conn, "UPDATE ajuan_pinjaman SET acc='Ajuan disetujui' WHERE id_ajuan='$ida'");

    $data = $conn->query("SELECT * FROM ajuan_pinjaman WHERE id_ajuan='$ida' ");
    while ($result = $data->fetch_assoc()) {
        $barang = $result['nama_barang'];
        $tanggalpinjam = $result['tgl_pinjam'];
        $tanggalkembali = $result['tgl_kembali'];
        $jmlh = $result['jumlah'];
        $nama_peminjam = $result['peminjam'];
        $no_telp = $result['telp'];
        $proses = mysqli_query($conn, "INSERT INTO peminjaman (nama_barang, tanggal_pinjam, tanggal_kembali, jumlah, peminjam, telp)
         VALUES ('$barang', '$tanggalpinjam', '$tanggalkembali', '$jmlh', '$nama_peminjam', '$no_telp')");
    }

    $cekstok = mysqli_query($conn, "SELECT * from barang where nama_barang='$barang'");
    $ambildata = mysqli_fetch_array($cekstok);

    $stok_ada = $ambildata['jumlah'];
    $penguranganstok = $stok_ada - $jmlh;

    $updatestok = mysqli_query($conn, "update barang set jumlah='$penguranganstok' where nama_barang= '$barang'");

    if ($disetujui && $proses) {
        header('location: peminjaman.php');
    } else {
        header('location: ajuan.php');
    }
}

//Status ajuan ditolak
if (isset($_POST['ditolak'])) {
    $ida = $_POST['ida'];

    $ditolak = mysqli_query($conn, "UPDATE ajuan_pinjaman SET acc='Ajuan ditolak' WHERE id_ajuan='$ida'");

    if ($ditolak) {
        header('location: ajuan.php');
    } else {
        header('location: index.php');
    }
}

// hapus data ajuan 
if (isset($_POST['hapusajuan'])) {
    $ida = $_POST['ida'];

    $dihapus = mysqli_query($conn, "DELETE from ajuan_pinjaman WHERE id_ajuan='$ida'");

    if ($dihapus) {
        header('location: ajuan.php');
    } else {
        header('location: index.php');
    }
}

if (isset($_POST['gajuan'])) {
    $barangnya = $_POST['barangnya'];
    $tglpinjam = $_POST['tglpinjam'];
    $tglkembali = $_POST['tglkembali'];
    $jumlahbarang = $_POST['jumlahbarang'];
    $namapeminjam = $_POST['namapeminjam'];
    $no_telp = $_POST['notelp'];

    $addontable = mysqli_query($conn, "INSERT INTO ajuan_pinjaman (nama_barang, tgl_pinjam, tgl_kembali, jumlah, peminjam, telp, acc) 
    VALUES ('$barangnya', '$tglpinjam', '$tglkembali', '$jumlahbarang', '$namapeminjam', '$no_telp', 'Dalam Ajuan')");

    if ($addontable) {
        header('location: gajuan.php');
    } else {
        header('location: form_gajuan.php');
    }
}

if (isset($_POST['text'])) {
    $noWA = $_POST['NoWA'];
}
