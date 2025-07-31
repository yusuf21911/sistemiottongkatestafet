<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "estafet_iot";

$conn = mysqli_connect($servername, $username, $password, $database);

//periksa koneksi
if(!$conn){
    die("koneksi gagal: " . mysqli_connect_error());

}

// echo "koneksi berhasil";
?>