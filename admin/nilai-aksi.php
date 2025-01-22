<?php include 'header.php';
  if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'tambah') {
      // Cek apakah semua program sudah memiliki nilai
      $queryCheck = mysqli_query($conn, "SELECT DISTINCT id_program FROM nilai");
      $programWithValues = mysqli_num_rows($queryCheck);

      $queryTotal = mysqli_query($conn, "SELECT COUNT(*) as total_program FROM program");
      $totalProgram = mysqli_fetch_assoc($queryTotal)['total_program'];
  ?>
    <div class="container-xl">
      <div class="bg-dark text-white py-2 mb-3">
        <h4 class="text-center">TAMBAH DATA PENILAIAN</h4>
      </div>

      <div class="panel panelcontainer">
        <div class="bootstrap-table">
          <!-- Cek apakah ada error dan tampilkan alert -->
          <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
              <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
          <?php endif; ?>

          <?php if (isset($_SESSION['errors'])): ?>
            <div class="alert alert-danger">
                <ul>
                  <?php foreach ($_SESSION['errors'] as $error): ?>
                    <li><?php echo $error; ?></li>
                  <?php endforeach; ?>
                </ul>
                <?php unset($_SESSION['errors']); ?>
            </div>
          <?php endif; ?>

          <form action="nilai-proses.php?proses=simpan" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label>Nama Program Digitalisasi</label>
              <select class="form-control" name="id_program" required>
                <option selected disabled>Pilih</option>
                <?php
                  // Tampilkan hanya program yang belum memiliki nilai
                  $query = mysqli_query($conn, "SELECT * FROM program WHERE id_program NOT IN (SELECT DISTINCT id_program FROM nilai) ORDER BY id_program");
                  while ($result = mysqli_fetch_array($query)) {
                    echo "<option value='{$result['id_program']}'>{$result['nama_program']}</option>";
                  }
                ?>
              </select>
            </div>

            <?php
              $query1 = mysqli_query($conn, "SELECT * FROM kriteria ORDER BY id_kriteria");
              while ($result1 = mysqli_fetch_array($query1)) { 
                $id_kriteria = $result1['id_kriteria'];
                $nama_kriteria = $result1['nama_kriteria'];

                echo "
                <div class='form-group'>
                  <label>".$nama_kriteria."</label>
                  <select name=".$id_kriteria." class='form-control'>
                    <option selected disabled>Pilih</option>";
                    $query2 = mysqli_query($conn, "SELECT * FROM subkriteria WHERE id_kriteria='$id_kriteria' ORDER BY nilai_subkriteria DESC");
                    while ($result2 = mysqli_fetch_array($query2)) {
                      echo "<option value=".$result2['id_subkriteria'].">".$result2['nama_subkriteria']."</option>";
                    }

                echo "</select></div>";
              }
            ?>

            <div class="form-group">
              <a href="nilai.php" class="btn btn-danger">BATAL</a>
              <input type="submit" class="btn btn-success" value="SIMPAN" />
            </div>
          </form>
        </div>
      </div>
    </div>

    <?php } else if($_GET['aksi']=='ubah') { ?>
      <div class="container-xl">
        <div class="bg-dark text-white py-2 mb-3">
          <h4 class="text-center">UBAH DATA PENILAIAN</h4>
        </div>

        <div class="panel panelcontainer">
          <div class="bootstrap-table">
            <form
              action="nilai-proses.php?proses=ubah"
              method="post"
              enctype="multipart/form-data"
            >
              <div class="form-group">
                <label>Nama Program Digitalisasi</label>
                <?php 
                  $id_program = $_GET['id_program'];
                  $query3 = mysqli_query($conn, "SELECT * FROM program WHERE id_program='".$id_program."'");
                  $result3 = mysqli_fetch_array($query3); ?>

                <select class="form-control" name="id_program">
                  <option selected value="<?php echo $result3['id_program']?>"><?php echo $result3['nama_program']?></option>
                </select>
              </div>

              <?php
                $query1 = mysqli_query($conn, "SELECT * FROM kriteria ORDER BY id_kriteria");
                while ($result1=mysqli_fetch_array($query1)){ 
                  $id_kriteria = $result1['id_kriteria'];
                  $nama_kriteria = $result1['nama_kriteria']; 
                  $id_program = $_GET['id_program'];

                  $query4 = mysqli_query($conn, "SELECT * FROM nilai WHERE id_kriteria='".$id_kriteria."' AND id_program='".$id_program."'");
                  $result4 = mysqli_fetch_array($query4);
                  $sub = $result4['id_subkriteria'];

                  echo "
                  <div class='form-group'>
                    <label>".$nama_kriteria."</label>
                    <select name=".$id_kriteria." class='form-control'>";
                      $query2 = mysqli_query($conn, "SELECT * FROM subkriteria WHERE id_kriteria='$id_kriteria' ORDER BY nilai_subkriteria DESC");
                      while ($result2=mysqli_fetch_array($query2)){

                        if($result2['id_subkriteria']==$sub){
                          echo "<option selected value=".$result2['id_subkriteria'].">".$result2['nama_subkriteria']."</option>";
                        } else {
                          echo "<option value=".$result2['id_subkriteria'].">".$result2['nama_subkriteria']."</option>";
                        }
                      }
                  echo "</select></div>";
                }?>

              <div class="form-group">
                <a href="nilai.php" class="btn btn-danger">BATAL</a>
                <input type="submit" class="btn btn-success" value="UBAH" />
              </div>
            </form>
          </div>
        </div>
      </div>
    <?php }} ?>