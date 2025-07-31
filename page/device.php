<?php
$page = $_GET['page'];
$insert = false;

// Handle form submission for editing data
if (isset($_POST['edit_data'])) {
    $old_id = $_POST['edit_data'];

    $serial_number = $_POST['serial_number'];
    $controller_type = $_POST['controller'];
    $location = $_POST['location'];
    $active = $_POST['active'];

    $sql_edit = "UPDATE devices SET serial_number = '$serial_number', mcu_type = '$controller_type', location = '$location', active = '$active' WHERE serial_number = '$old_id'";
    mysqli_query($conn, $sql_edit);
} elseif (isset($_POST['serial_number'])) { // Handle form submission for adding new data
    $serial_number = $_POST['serial_number'];
    $controller_type = $_POST['controller'];
    $location = $_POST['location'];

    $sql_insert = "INSERT INTO devices (serial_number, mcu_type, location) VALUES ('$serial_number', '$controller_type', '$location')";
    mysqli_query($conn, $sql_insert);
    $insert = true;
}

// Fetch data for editing
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $sql_select_data = "SELECT * FROM devices WHERE serial_number = '$id' LIMIT 1";
    $result = mysqli_query($conn, $sql_select_data);
    $data = mysqli_fetch_assoc($result);
}

// Fetch all devices
$sql = "SELECT * FROM devices";
$result = mysqli_query($conn, $sql);
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Perangkat</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <?php if ($insert) { alertsSucces("Data Berhasil ditambahkan"); } ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Perangkat Yang Terdaftar</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Serial Number</th>
                                        <th>Jenis Kontroller</th>
                                        <th>Lokasi</th>
                                        <th>Waktu Didaftarkan</th>
                                        <th>Aktif</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                        <tr>
                                            <td><?php echo $row['serial_number']; ?></td>
                                            <td><?php echo $row['mcu_type']; ?></td>
                                            <td><?php echo $row['location']; ?></td>
                                            <td><?php echo $row['created_time']; ?></td>
                                            <td><?php echo $row['active']; ?></td>
                                            <td>
                                                <a href="?page=<?php echo $page; ?>&edit=<?php echo $row['serial_number']; ?>">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

                <?php if (!isset($_GET['edit'])) { ?>
                    <div class="col-lg-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Tambah Data</h3>
                            </div>
                            <!-- /.card-header -->
                            <form method="post" action="?page=<?php echo $page; ?>">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Serial Number</label>
                                        <input type="text" class="form-control" name="serial_number" placeholder="Serial Number Tidak boleh" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Kontroller</label>
                                        <input type="text" class="form-control" name="controller" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Lokasi</label>
                                        <input type="text" class="form-control" name="location" required>
                                    </div>
                                </div>
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
                            </div>
                            <!-- /.card-header -->
                            <form method="post" action="?page=<?php echo $page; ?>">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Serial Number</label>
                                        <input type="hidden" name="edit_data" value="<?php echo $data['serial_number']; ?>">
                                        <input type="text" class="form-control" name="serial_number" value="<?php echo $data['serial_number']; ?>" placeholder="Serial Number Tidak boleh" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Kontroller</label>
                                        <input type="text" class="form-control" name="controller" value="<?php echo $data['mcu_type']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Lokasi</label>
                                        <input type="text" class="form-control" name="location" value="<?php echo $data['location']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control" name="active">
                                            <option value="Yes" <?php echo ($data['active'] == "Yes") ? 'selected' : ''; ?>>Aktif</option>
                                            <option value="No" <?php echo ($data['active'] == "No") ? 'selected' : ''; ?>>Tidak Aktif</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-warning">Ubah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
