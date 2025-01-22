<?php include 'header.php'; ?>

<div class="container-xl">
  <!-- Judul -->
  <div class="bg-dark text-white py-2 mb-3">
    <h4 class="text-center">KRITERIA</h4>
  </div>

  <!-- isi -->
  <div class="panel panelcontainer">
    <!-- tabel -->
    <div class="bootstrap-table">
      <!-- tambah data kriteria -->
      <a href="kriteria-aksi.php?aksi=tambah" class="btn btn-primary"
        >TAMBAH DATA</a
      >
      <hr />

      <!-- tabel isi kriteria -->
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center">No</th>
              <th class="text-center">Nama Kriteria</th>
              <th class="text-center">Bobot</th>
              <th class="text-center">Jenis</th>
              <th class="text-center">Subkriteria</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>

          <!-- output dari tambah data -->
          <tbody>
            <?php
              $data = mysqli_query($conn, "SELECT * FROM kriteria ORDER BY id_kriteria");
              $no = 1;
              while ($a = mysqli_fetch_array($data)) { ?>
            <tr>
              <td class="text-center"> <?php echo $no++ ?> </td>
              <td class="text-center"> <?php echo $a['nama_kriteria'] ?> </td>
              <td class="text-center"> <?php echo $a['bobot_kriteria'] ?> </td>
              <td class="text-center"> <?php echo $a['jenis_kriteria'] ?> </td>
            
              <td class="text-center">
                <a href="subkriteria.php?id_kriteria=<?php echo $a['id_kriteria'] ?>" class="btn btn-primary">SUBKRITERIA</a>
              </td>

              <td class="text-center">
                <a href="kriteria-aksi.php?id_kriteria=<?php echo $a['id_kriteria'] ?>&aksi=ubah" class="btn btn-success">UBAH</a>
                <a href="kriteria-proses.php?id_kriteria=<?php echo $a['id_kriteria'] ?>&proses=hapus" class="btn btn-danger">HAPUS</a>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>