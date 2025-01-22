<?php include '../assets/conn/config.php';
  if(isset($_GET['proses'])) {
    if($_GET['proses']=='simpan'){
      $nama_program = $_POST['nama_program'];
      mysqli_query($conn, "INSERT into program(nama_program) VALUES('$nama_program')");
      header("location:program.php");
    } else if($_GET['proses']=='ubah'){
      $id_program = $_POST['id_program'];
      $nama_program = $_POST['nama_program'];
      mysqli_query($conn, "UPDATE program set nama_program='$nama_program' WHERE id_program='$id_program'");
      header("location:program.php");
    } else if($_GET['proses']=='hapus'){
      $id_program = $_GET['id_program'];
      mysqli_query($conn, "DELETE FROM program WHERE id_program='$id_program'");
      header("location:program.php");
    }
  }
?>