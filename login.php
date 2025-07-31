<?php
session_start();
include "config/database.php";

// Pesan default saat login
$message = "Masukan Username dan Password";

// Proses login saat form disubmit
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk mengambil data user berdasarkan username
    $sql = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);

    // Cek jika username tidak ditemukan
    if (!mysqli_num_rows($result) > 0) {
        $message = "<b style='color:red;'> Username tidak terdaftar</b>";
    } else {
        // Cek password yang dimasukkan
        if (password_verify($password, $data['password'])) {
            // Set session data jika login berhasil
            $_SESSION['username'] = $username;
            $_SESSION['fullname'] = $data['fullname'];
            $_SESSION['role'] = $data['role'];
            // Redirect ke halaman index
            echo "<script> location.href='index.php' </script>";
        } else {
            $message = "<b style ='color:red' >Password Salah</b>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Estafet - Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <b>Estafet</b>IoT
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <!-- Menampilkan pesan login -->
                <p class="login-box-msg"><?php echo $message ?></p>

                <!-- Form login -->
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="username" placeholder="Username" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                    </div>
                </form>
            </div><!-- /.login-card-body -->
        </div><!-- /.card -->
    </div><!-- /.login-box -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
</body>
</html>
