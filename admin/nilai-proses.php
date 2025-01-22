<?php 
  include '../assets/conn/config.php';
  session_start();  // Mulai session untuk menyimpan pesan error

  if (isset($_GET['proses'])) {
    if ($_GET['proses'] == 'simpan') {
      // Cek apakah 'id_program' sudah dipilih
      if (empty($_POST['id_program'])) {
        $_SESSION['error'] = "Nama Program harus dipilih.";
        header("Location: " . $_SERVER['HTTP_REFERER']); // Redirect ke halaman sebelumnya
        exit();
      }

      // Validasi: Cek apakah setiap kriteria sudah dipilih subkriteria-nya
      $errors = [];
      $query = mysqli_query($conn, "SELECT * FROM kriteria ORDER BY id_kriteria");
      while ($result = mysqli_fetch_array($query)) {
        $idK = $result['id_kriteria'];
        if (empty($_POST[$idK])) {
          $errors[] = "Subkriteria untuk kriteria '{$result['nama_kriteria']}' harus dipilih.";
        }
      }

      // Jika ada error, simpan pesan error di session dan redirect kembali
      if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: " . $_SERVER['HTTP_REFERER']); // Redirect ke halaman sebelumnya
        exit();
      }

      // Jika tidak ada error, proses penyimpanan data
      $id_program = $_POST['id_program'];
      foreach ($_POST as $key => $value) {
        if ($key != 'id_program' && !empty($value)) {
          $query1 = "INSERT INTO nilai(id_program, id_kriteria, id_subkriteria) 
                      VALUES('".$id_program."', '".$key."', '".$value."')";
          mysqli_query($conn, $query1);
        }
      }

      // Redirect ke halaman 'nilai.php' setelah data berhasil disimpan
      header("Location: nilai.php");
      exit();

    } else if($_GET['proses']=='ubah'){
      $id_program = $_POST['id_program'];
      $query2 = "DELETE FROM nilai WHERE id_program='".$_POST['id_program']."'";
      $result2 = mysqli_query($conn, $query2);

      $query = mysqli_query($conn, "SELECT * FROM kriteria ORDER BY id_kriteria");
      while($result = mysqli_fetch_array($query)){
        $idK = $result['id_kriteria'];
        $idS = $_POST[$idK];
        $query1 = "INSERT INTO nilai(id_program, id_kriteria, id_subkriteria)VALUES('".$id_program."', '".$idK."', '".$idS."')";
        $result1 = mysqli_query($conn, $query1);
      }
      header("location:nilai.php");
    }else if($_GET['proses']=='hapus'){
      $id_program = $_GET['id_program'];
      $query2 = "DELETE FROM nilai WHERE id_program='".$id_program."'";
      $result2 = mysqli_query($conn, $query2);

      $query3 = "UPDATE `program` SET `d_max`='0',`d_min`='0',`nilai_v`='0' WHERE `id_program`='".$id_program."'";
      $result3 = mysqli_query($conn, $query3);
      header("location:nilai.php");
    }
  }
?>