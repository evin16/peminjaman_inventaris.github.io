<?php

// require 'check.php';

$conn = mysqli_connect('localhost', 'root', '', 'peminjaman_barang');

// Cek Sambungan Login
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = filter_input(INPUT_POST, 'password');
    // $role = $_POST['role'];

    //menyambungkan dengan tabel
    $login = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' and password = '$password' ");
    $cek = mysqli_num_rows($login);

    if ($cek > 0) {
        session_start();
        $_SESSION['status'] = "login";
        header('location:index.php');
    } else {
        header('location:login.php');
    }
}

if (isset($_POST['guest'])) {
    header('location: home.php');
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
    <title>Login</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-light">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="email" type="email" />
                                            <label for="email">Email</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="password" type="password" />
                                            <label for="password">Password</label>
                                        </div>
                                        <!-- <div class="form-floating mb-3">
                                            <select name="role" name="role" id="role" class="form-control">
                                                <option value=" "> </option>
                                                <option value="Administrator">Administrator</option>
                                                <option value="User">User</option>
                                            </select>
                                            <label for="inputRole">Role</label>
                                        </div> -->
                                        <div class="d-grid gap-3">
                                            <button class="btn btn-primary" name="login">Login</button>
                                        </div>
                                        <div class="d-grid gap-3">
                                            <hr>
                                        </div>
                                        <div class="d-grid gap-3">
                                            <button class="btn btn-danger" name="guest">Login sebagai Guest</button>
                                        </div>
                                </div>

                                </form>
                                <footer class="py-4 bg-light mt-auto">
                                    <div class="container-fluid px-4">
                                        <div class="d-flex align-items-right justify-content-between small">
                                            <div class="text-muted" >
                                                Copyright &copy; Universitas Sebelas Maret 2022
                                            </div>
                                        </div>
                                    </div>
                                </footer>
                            </div>
                        </div>
                    </div>

                </div>
        </div>
        </main>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>



</html>