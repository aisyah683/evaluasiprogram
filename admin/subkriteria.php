<?php include 'header.php'; ?>

<div class="container-xl">
  <!-- menjalankan url -->
  <?php $data = mysqli_query($conn, "SELECT * FROM kriteria WHERE id_kriteria='$_GET[id_kriteria]'");
  $a = mysqli_fetch_array($data); ?>  <!-- mengambil data berdasarkan id -->

  <!-- Judul -->
  <div class="bg-dark text-white py-2 mb-3">
    <h4 class="text-center">SUBKRITERIA / <a href="kriteria.php" class="text-white"> <?php echo $a['nama_kriteria']; ?></a></h4>
  </div>

  <!-- isi -->
  <div class="panel panelcontainer">
    <!-- tabel -->
    <div class="bootstrap-table">
      <!-- tambah data subkriteria -->
      <a href="subkriteria-aksi.php?id_kriteria=<?php echo $_GET['id_kriteria'] ?>&aksi=tambah" class="btn btn-primary"
        >TAMBAH DATA</a
      >
      <hr />

      <!-- tabel isi subkriteria -->
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center">No</th>
              <th class="text-center">Nama Subkriteria</th>
              <th class="text-center">Nilai</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>

          <!-- output dari tambah data -->
          <tbody>
            <?php
              $data = mysqli_query($conn, "SELECT * FROM subkriteria WHERE id_kriteria='$_GET[id_kriteria]' ORDER BY id_subkriteria");
              $no = 1;
              while ($a = mysqli_fetch_array($data)) { ?>
            <tr>
              <td class="text-center"> <?php echo $no++ ?> </td>
              <td class="text-center"> <?php echo $a['nama_subkriteria'] ?> </td>
              <td class="text-center"> <?php echo $a['nilai_subkriteria'] ?> </td>

              <td class="text-center">
                <a href="subkriteria-aksi.php?id_kriteria=<?php echo $a['id_kriteria'] ?>&id_subkriteria=<?php echo $a['id_subkriteria'] ?>&aksi=ubah" class="btn btn-success">UBAH</a>
                <a href="subkriteria-proses.php?id_kriteria=<?php echo $a['id_kriteria'] ?>&id_subkriteria=<?php echo $a['id_subkriteria'] ?>&proses=hapus" class="btn btn-danger">HAPUS</a>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>S
  </div>
</div>