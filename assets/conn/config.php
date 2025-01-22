<?php
$host = 'localhost'; // Host database
$user = 'root';      // Username default MySQL
$pass = '';          // Password MySQL (kosong untuk konfigurasi default XAMPP/LAMP)
$db = 'evaluasi';    // Nama database yang ingin digunakan
$conn = mysqli_connect ($host, $user, $pass, $db) or die ("Tidak terkoneksi");
?>