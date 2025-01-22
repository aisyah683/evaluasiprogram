<?php include 'header.php'; ?>

<div class="container-xl">
  <!-- Judul -->
  <div class="bg-dark text-white py-2 mb-3">
    <h4 class="text-center">PENILAIAN</h4>
  </div>

  <!-- isi -->
  <div class="panel panelcontainer">
    <!-- tabel -->
    <div class="bootstrap-table">
      <?php
        // Hitung jumlah program yang sudah memiliki nilai
        $queryCheck = mysqli_query($conn, "SELECT DISTINCT id_program FROM nilai");
        $programWithValues = mysqli_num_rows($queryCheck);

        // Hitung total program
        $queryTotal = mysqli_query($conn, "SELECT COUNT(*) as total_program FROM program");
        $totalProgram = mysqli_fetch_assoc($queryTotal)['total_program']; ?>
        <a href="nilai-aksi.php?aksi=tambah" class="btn btn-primary">TAMBAH DATA</a>
      <hr />

      <!-- tabel isi nilai -->
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center">No</th>
              <th class="text-center">Nama Program Digitalisasi</th>
              <?php
                $data = mysqli_query($conn, "SELECT * FROM kriteria ORDER BY id_kriteria");
                $jumlah_kriteria = mysqli_num_rows($data); // Jumlah kolom kriteria
                while ($a = mysqli_fetch_array($data)) { ?>
              <th class="text-center"> <?php echo $a['nama_kriteria'] ?> </th>
              <?php } ?>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>

          <!-- output dari tambah data -->
          <tbody>
            <?php
              // Ambil data program yang ada di tabel nilai
              $data = mysqli_query($conn, "
                SELECT p.id_program, p.nama_program
                FROM program p
                JOIN nilai n ON p.id_program = n.id_program
                GROUP BY p.id_program
                ORDER BY p.id_program
              ");

              $no = 1;
              $dataExists = false; // Tambahkan variabel untuk pengecekan data

              while ($a = mysqli_fetch_array($data)) { 
                $dataExists = true; // Tandai bahwa ada data
                $id_program = $a['id_program'];
            ?>
            <tr>
              <td class="text-center"><?php echo $no++ ?></td>
              <td class="text-center"><?php echo $a['nama_program'] ?></td>

              <?php
              $query = mysqli_query($conn, "
                SELECT a.nama_subkriteria as nama_sub 
                FROM subkriteria a
                JOIN nilai b ON a.id_subkriteria = b.id_subkriteria 
                WHERE b.id_program = $id_program
                ORDER BY b.id_kriteria
              ");

              while ($result = mysqli_fetch_array($query)) { ?>
                <td class="text-center"><?php echo $result['nama_sub'] ?></td>
                <?php
              } ?>

              <td>
                <a href="nilai-aksi.php?id_program=<?php echo $a['id_program'] ?>&aksi=ubah" class="btn btn-success">UBAH</a>
                <a href="nilai-proses.php?id_program=<?php echo $a['id_program'] ?>&proses=hapus" class="btn btn-danger">HAPUS</a>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <?php 
        // Tampilkan include proses.php hanya jika data ada
        if ($dataExists) {
          include 'proses.php';
        }
      ?>
    </div>
  </div>
</div>