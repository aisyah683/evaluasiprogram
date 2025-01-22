<?php
session_start(); // Memulai sesi PHP

// Mengecek username sudah ada ketika login
if (isset($_SESSION['username'])) {
    // Jika sudah login, arahkan ke dashboard
    header("location:admin/index.php");
    exit();
}

// cek apakah ada "aksi" di url dan bernilai login
if (isset($_GET['aksi']) && $_GET['aksi'] == 'login') {
    // Menyertakan koneksi ke database
    include 'assets/conn/config.php';

    // Mengambil input username dan password dari form
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Melakukan query untuk mencari akun
    $query = mysqli_query($conn, "SELECT * FROM akun WHERE username='$username' AND password='$password'");
    $cek = mysqli_num_rows($query);

    // Jika ditemukan hasil yang cocok
    if ($cek > 0) {
        $data = mysqli_fetch_assoc($query); // Mengambil data pengguna
        if ($data['username'] == 'admin') {
            $_SESSION['username'] = $username; // Menyimpan username dalam sesi
            header("location:admin/index.php"); // pergi ke hal ini
            exit();
        }
    } else {
        // jika login gagal, kembali ke hal ini dan kasih pesan
        header("location:index.php?pesan=gagal");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Evaluasi Kinerja Program Digitalisasi Dinas Kominfo Solok Selatan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
      #container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 20px 25px;
        width: 300px;
      }

      #btn {
        width: 100%;
      }
    </style>
  </head>
  <body>
      <?php
        // Menampilkan pesan error jika login gagal
        if (isset($_GET['pesan']) && $_GET['pesan'] == 'gagal') {
            echo "<div class='alert alert-danger'>Login gagal! Username atau password salah.</div>";
        }
      ?>
    <div class="bg-white" id="container">
      <h1 class="text-center mb-5">LOGIN</h1>
      <form
        action="index.php?aksi=login"
        method="post"
        enctype="multipart/form-data"
      >
        <div class="form-group">
          <label>Username</label>
          <input
            type="text"
            class="form-control"
            placeholder="Username"
            name="username"
          />
        </div>
        <div class="form-group">
          <label>Password</label>
          <input
            type="password"
            class="form-control"
            placeholder="********"
            name="password"
          />
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="LOGIN" id="btn" />
        </div>
      </form>
    </div>
  </body>
</html>