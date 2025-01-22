<?php
if (!isset($_SESSION['username'])) {
  // jika tidak login, dikembalikan ke halaman login
  header("location:../index.php");
}
?>