<?php
  session_start(); // memulai sesi

  // Cek apakah file konfigurasi dan fungsi cek sudah di-include dengan benar
  if (!file_exists('../assets/conn/config.php') || !file_exists('../assets/conn/cek.php')) {
    die('File konfigurasi atau cek tidak ditemukan.');
  }

  // menyertakan file connection
  include '../assets/conn/config.php';
  include '../assets/conn/cek.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Laporan</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
      integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../assets/css/laporan.css">
  </head>

  <body>
    <div class="container-xl">
      <!-- Judul -->
      <div class="row mt-5">
        <div style="width: 10%; margin-left: 20px">
          <img src="gambar/logo.png" alt="" style="width: 100px" />
        </div>
        <div style="width: 85%">
          <h4 class="text-center">Pemerintah Kabupaten Solok Selatan</h4>
          <h2 class="text-center">
            Dinas Komunikasi dan Informatika Kabupaten Solok Selatan
          </h2>
          <p class="text-center">
            <b
              >Jl. Raya Lubuk Gadang, Padang Alai, Sangir, Solok Selatan,
              Sumatera Barat</b
            >
          </p>
        </div>
      </div>
      <hr />

      <h5 class="text-center my-4">
        LAPORAN HASIL EVALUASI KINERJA PROGRAM DIGITALISASI MENGGUNAKAN METODE
        TOPSIS
      </h5>

      <!-- isi -->
      <div class="panel panelcontainer">
        <!-- tabel -->
        <div class="bootstrap-table">
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

      <div class="card mb-5">
        <div class="card-body">
          <p class="card-text">
            Kesimpulan yang didapat berdasarkan hasil evaluasi kinerja program
            digitalisasi menggunakan metode Topsis, bahwa program digitalisasi
            terbaik pada Dinas Kominfo Solok Selatan adalah 
            <?php 
              $query = mysqli_query($conn, "SELECT * FROM program WHERE rank = 1");
              if ($result = mysqli_fetch_array($query)) {
                echo $result['nama_program'];
              }
            ?>.
          </p>
        </div>
      </div>

      <div id="footer">
        <p class="left">Solok Selatan, 
          <?php
            function tgl_indo($tanggal){ 
              $bulan = array (1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
              $pecahkan = explode('-', $tanggal);
              return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
            }
            echo tgl_indo(date('Y-m-d'));
          ?>
        </p>
        <p class="mb-1">Kepala Dinas Komunikasi dan Informatika</p>
        <p class="right">Kabupaten Solok Selatan</p>
        <p id="sign" class="left">
          (___________________________)
        </p>
      </div>
    </div>

  <script>
		window.print();
	</script>
  </body>
</html>
