<?php
session_start();

session_destroy();
echo"<script> location.href='login.php' </script>";
?>