<?php
  session_start(); // memulai sesi

  // Cek apakah file konfigurasi dan fungsi cek sudah di-include dengan benar
  if (!file_exists('../assets/conn/config.php') || !file_exists('../assets/conn/cek.php')) {
    die('File konfigurasi atau cek tidak ditemukan.');
  }

  // menyertakan file connection
  include '../assets/conn/config.php';
  include '../assets/conn/cek.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Evaluasi Kinerja Program Digitalisasi Dinas Kominfo Solok Selatan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  </head>
  <body>
    <!-- navbar -->
    <nav id="navbar" class="navbar navbar-expand-sm navbar-dark bg-primary">
      <a class="navbar-brand ml-5" href="#">
        <img src="gambar/logo.png" width="50" height="50" alt="" loading="lazy">
      </a>  
      <div class="container-xl">
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
              <li class="nav-item"><a class="nav-link" href="index.php">HOME <span class="sr-only">(current)</span></a></li>
              <li class="nav-item"><a class="nav-link" href="kriteria.php">KRITERIA </a></li>
              <li class="nav-item"><a class="nav-link" href="program.php">PROGRAM DIGITALISASI </a></li>
              <li class="nav-item"><a class="nav-link" href="nilai.php">PENILAIAN </a></li>
              <li class="nav-item"><a class="nav-link" href="hasil.php">LAPORAN </a></li>
          </ul>
        </div>
      </div>
      <ul class="navbar-nav">
        <li class="nav-item mr-5"><a class="nav-link" href="logout.php">LOGOUT </a></li>
      </ul>
    </nav>
  </body>
</html>