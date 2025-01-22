<?php include '../assets/conn/config.php';
  if(isset($_GET['proses'])) {
    if($_GET['proses']=='simpan'){
      $nama_kriteria = $_POST['nama_kriteria'];
      $bobot_kriteria = $_POST['bobot_kriteria'];
      $jenis_kriteria = $_POST['jenis_kriteria'];
      mysqli_query($conn, "INSERT into kriteria(nama_kriteria, bobot_kriteria, jenis_kriteria) VALUES('$nama_kriteria', '$bobot_kriteria', '$jenis_kriteria')");
      header("location:kriteria.php");
    } else if($_GET['proses']=='ubah'){
      $id_kriteria = $_POST['id_kriteria'];
      $nama_kriteria = $_POST['nama_kriteria'];
      $bobot_kriteria = $_POST['bobot_kriteria'];
      $jenis_kriteria = $_POST['jenis_kriteria'];
      mysqli_query($conn, "UPDATE kriteria set nama_kriteria='$nama_kriteria', bobot_kriteria='$bobot_kriteria', jenis_kriteria='$jenis_kriteria' WHERE id_kriteria='$id_kriteria'");
      header("location:kriteria.php");
    } else if($_GET['proses']=='hapus'){
      $id_kriteria = $_GET['id_kriteria'];
      mysqli_query($conn, "DELETE FROM kriteria WHERE id_kriteria='$id_kriteria'");
      header("location:kriteria.php");
    }
  }
?>