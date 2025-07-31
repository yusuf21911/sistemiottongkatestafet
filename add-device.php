<?php
include "../config/database.php";

$sql = "INSERT INTO devices (serial_number, mcu_type, location) VALUES ('123455', 'Test', 'lokasi')";

if(mysqli_query($connn,$sql)){
    echo "Data berhasil ditambahkan";
}else{
    echo "Data gagal ditambahkan";
}
?>