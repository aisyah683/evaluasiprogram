<?php include 'header.php'; ?>
<style>
   /* Tambahkan CSS untuk tampilan cetak */
   @media print {
      .no-print {
        display: none; /* Elemen dengan kelas no-print tidak akan ditampilkan saat mencetak */
      }
    }
</style>
<div class="container-xl">
  <!-- Judul -->
  <h2 class="text-center my-4">LAPORAN HASIL EVALUASI KINERJA PROGRAM DIGITALISASI</h2>

  <!-- isi -->
  <div class="panel panelcontainer">
    <!-- tabel -->
    <div class="bootstrap-table">
      <hr />

      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center">No</th>
              <th class="text-center">Nama Program Digitalisasi</th>
              <th class="text-center">Nilai V</th>
              <th class="text-center">Rangking</th>
            </tr>
          </thead>

          <!-- output dari tambah data -->
          <tbody>
            <?php
            $data = mysqli_query($conn, "SELECT id_program, nama_program, nilai_v, rank FROM program ORDER BY rank ASC");
            $no = 1;
            while ($a = mysqli_fetch_array($data)) {
              $rankzero = ($a['rank'] == 0);
              if(!$rankzero) {?>
                <tr>
                  <td class="text-center"> <?php echo $no++ ?> </td>
                  <td class="text-center"> <?php echo $a['nama_program'] ?> </td>
                  <td class="text-center"> <?php echo number_format($a['nilai_v'], 4) ?> </td>
                  <td class="text-center"> <?php echo $a['rank'] ?> </td>
                </tr>
            <?php }} ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <a href="cetak.php" class="btn btn-primary" target="_BLANK">CETAK LAPORAN</a>
</div>