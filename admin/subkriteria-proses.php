<?php include '../assets/conn/config.php';
  if(isset($_GET['proses'])) {
    if($_GET['proses']=='simpan'){
      $id_kriteria = $_POST['id_kriteria'];
      $nama_subkriteria = $_POST['nama_subkriteria'];
      $nilai_subkriteria = $_POST['nilai_subkriteria'];
      mysqli_query($conn, "INSERT into subkriteria(id_kriteria, nama_subkriteria, nilai_subkriteria) VALUES('$id_kriteria', '$nama_subkriteria', '$nilai_subkriteria')");
      header("location:subkriteria.php?id_kriteria=$_POST[id_kriteria]");

    } else if($_GET['proses']=='ubah'){
      $id_subkriteria = $_POST['id_subkriteria'];
      $id_kriteria = $_POST['id_kriteria'];
      $nama_subkriteria = $_POST['nama_subkriteria'];
      $nilai_subkriteria = $_POST['nilai_subkriteria'];
      mysqli_query($conn, "UPDATE subkriteria set id_kriteria='$id_kriteria', nama_subkriteria='$nama_subkriteria', nilai_subkriteria='$nilai_subkriteria' WHERE id_subkriteria='$id_subkriteria'");
      header("location:subkriteria.php?id_kriteria=$_POST[id_kriteria]");

    } else if($_GET['proses']=='hapus'){
      $id_kriteria = $_GET['id_kriteria'];
      $id_subkriteria = $_GET['id_subkriteria'];
      mysqli_query($conn, "DELETE FROM subkriteria WHERE id_subkriteria='$id_subkriteria'");
      header("location:subkriteria.php?id_kriteria=$_GET[id_kriteria]");
    }
  }
?>