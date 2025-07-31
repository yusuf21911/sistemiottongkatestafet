<?php
$page = $_GET['page'];
$insert = false;

// Hanya Admin yang bisa mengakses halaman ini
if ($_SESSION['role'] != "Admin") {
    echo "<script> location.href='index.php' </script>";
}

// Proses untuk mengedit data pengguna
if (isset($_POST['edit_data'])) {
    $old_id = $_POST['edit_data'];
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $role = $_POST['role'];
    $active = $_POST['active'];

    // Jika password tidak diubah
    if ($_POST['password'] == "") {
        $sql_edit = "UPDATE user SET username = '$username', fullname = '$fullname', role = '$role', active = '$active' WHERE username = '$old_id'";
    } else {
        // Jika password diubah, hash password baru
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql_edit = "UPDATE user SET username = '$username', password = '$password', fullname = '$fullname', role = '$role', active = '$active' WHERE username = '$old_id'";
    }

    mysqli_query($conn, $sql_edit);

// Proses untuk menambah data pengguna baru
} else if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $fullname = $_POST['fullname'];
    $role = $_POST['role'];

    // Query untuk menambahkan data pengguna baru
    $sql_insert = "INSERT INTO user (username, password, fullname, role) VALUES ('$username', '$password', '$fullname', '$role')";
    mysqli_query($conn, $sql_insert);
    $insert = true;
}

// Proses untuk menampilkan data pengguna yang akan diedit
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $sql_select_data = "SELECT * FROM user WHERE username = '$id' LIMIT 1";
    $result = mysqli_query($conn, $sql_select_data);
    $data = mysqli_fetch_assoc($result);
}

// Menampilkan daftar pengguna
$sql = "SELECT * FROM user";
$result = mysqli_query($conn, $sql);
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pengguna</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <?php
            // Menampilkan pesan sukses setelah menambahkan data
            if ($insert == true) {
                alertsSucces("Data Berhasil ditambahkan");
            }
            ?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Pengguna Yang Terdaftar</h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Nama Lengkap</th>
                                        <th>Hak Akses</th>
                                        <th>Aktif</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Menampilkan data pengguna dari database -->
                                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                        <tr>
                                            <td><?php echo $row['username']; ?></td>
                                            <td><?php echo $row['fullname']; ?></td>
                                            <td><?php echo $row['role']; ?></td>
                                            <td><?php echo $row['active']; ?></td>
                                            <td><a href="?page=<?php echo $page ?>&edit=<?php echo $row['username']; ?>"><i class="fas fa-edit"></i></a></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div><!-- /.col -->
            </div><!-- /.row -->

            <?php if (!isset($_GET['edit'])) { ?>
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Data</h3>
                        </div><!-- /.card-header -->
                        <form method="post" action="?page=<?php echo $page; ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" name="username" placeholder="Username Tidak boleh kosong" required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" class="form-control" name="fullname" required>
                                </div>
                                <div class="form-group">
                                    <label>Hak Akses</label>
                                    <select class="form-control" name="role">
                                        <option value="Admin">Admin</option>
                                        <option value="User">Pengguna</option>  
                                    </select>
                                </div>
                            </div><!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php } else { ?>
                <div class="col-lg-12">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Ubah Data</h3>
                        </div><!-- /.card-header -->
                        <form method="post" action="?page=<?php echo $page; ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="hidden" name="edit_data" value="<?php echo $data['username']; ?>">
                                    <input type="text" class="form-control" name="username" value="<?php echo $data['username']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Kosongkan jika tidak mengubah password">
                                </div>
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" class="form-control" name="fullname" value="<?php echo $data['fullname']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Hak Akses</label>
                                    <select class="form-control" name="role">
                                        <?php if ($data['role'] == "Admin") { ?>
                                            <option value="Admin">Admin</option>
                                            <option value="User">Pengguna</option>  
                                        <?php } else { ?>
                                            <option value="User">Pengguna</option>
                                            <option value="Admin">Admin</option>  
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="active">
                                        <?php if ($data['active'] == "Yes") { ?>
                                            <option value="Yes">Aktif</option>
                                            <option value="No">Tidak Aktif</option>  
                                        <?php } else { ?>
                                            <option value="No">Tidak Aktif</option>
                                            <option value="Yes">Aktif</option>  
                                        <?php } ?>
                                    </select>
                                </div>
                            </div><!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning">Ubah</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div><!-- /.container-fluid -->
    </div><!-- /.content -->
</div><!-- /.content-wrapper -->
