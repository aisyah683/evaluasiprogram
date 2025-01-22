<?php include 'header.php'; ?>

<div class="container-xl">
  <!-- Judul -->
  <div class="bg-dark text-white py-2 mb-3">
    <h4 class="text-center">PROGRAM DIGITALISASI</h4>
  </div>

  <!-- isi -->
  <div class="panel panelcontainer">
    <!-- tabel -->
    <div class="bootstrap-table">
      <!-- tambah data program -->
      <a href="program-aksi.php?aksi=tambah" class="btn btn-primary"
        >TAMBAH DATA</a
      >
      <hr />

      <!-- tabel isi program -->
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center">No</th>
              <th class="text-center">Nama Program Digitalisasi</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>

          <!-- output dari tambah data -->
          <tbody>
            <?php
              $data = mysqli_query($conn, "SELECT * FROM program ORDER BY id_program");
              $no = 1;
              while ($a = mysqli_fetch_array($data)) { ?>
            <tr>
              <td class="text-center"> <?php echo $no++ ?> </td>
              <td class="text-center"> <?php echo $a['nama_program'] ?> </td>
            
              <td class="text-center">
                <a href="program-aksi.php?id_program=<?php echo $a['id_program'] ?>&aksi=ubah" class="btn btn-success">UBAH</a>
                <a href="program-proses.php?id_program=<?php echo $a['id_program'] ?>&proses=hapus" class="btn btn-danger">HAPUS</a>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>