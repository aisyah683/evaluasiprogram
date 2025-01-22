<?php
session_start(); // memulai sesi
session_destroy(); // menghancurkan semua sesi yang aktif
header("Location: ../index.php"); // kembali ke hal login
exit();
?>