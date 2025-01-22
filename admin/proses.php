<div class="container-xl">
  <!-- Judul -->
  <hr>
  <div class="bg-dark text-white py-2">
    <h4 class="text-center">PROSES PERHITUNGAN DENGAN METODE TOPSIS</h4>
  </div>

  <!-- isi -->
  <div class="panel panelcontainer">
    <!-- tabel -->
    <div class="bootstrap-table">
      <hr />

    <!-- Tabel konversi nilai keputusan -->
      <h4 class="pb-3">Konversi Nilai Keputusan</h4>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center">No</th>
              <th class="text-center">Nama Program Digitalisasi</th>
              <?php
                $data = mysqli_query($conn, "SELECT * FROM kriteria ORDER BY id_kriteria");
                while ($a = mysqli_fetch_array($data)) { ?>
              <th class="text-center"> <?php echo $a['nama_kriteria'] ?> </th>
              <?php } ?>
            </tr>
          </thead>

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
              while ($a = mysqli_fetch_array($data)) { 
                $id_program = $a['id_program'];
            ?>
            <tr>
              <td class="text-center"><?php echo $no++ ?></td>
              <td class="text-center"><?php echo $a['nama_program'] ?></td>

              <?php
              $query = mysqli_query($conn, "
                SELECT a.nilai_subkriteria as nilai_sub 
                FROM subkriteria a
                JOIN nilai b ON a.id_subkriteria = b.id_subkriteria 
                WHERE b.id_program = $id_program
                ORDER BY b.id_kriteria
              ");

              while ($result = mysqli_fetch_array($query)) { ?>
                <td class="text-center"><?php echo $result['nilai_sub'] ?></td>
                <?php 
              } ?>
            </tr>
            <?php } ?>
          </tbody>

          <tr>
            <td class="text-center" colspan=2>Hasil Pangkat</td>
              <?php
              $data = mysqli_query($conn, "SELECT * FROM kriteria ORDER BY id_kriteria");

              while ($a = mysqli_fetch_array($data)) {
                $sum_pangkat = 0;
                $id_kriteria = $a['id_kriteria'];

                $query = mysqli_query($conn, "SELECT s.nilai_subkriteria as nilai_sub FROM subkriteria s, nilai kp, kriteria k WHERE kp.id_kriteria='".$id_kriteria."' AND s.id_subkriteria=kp.id_subkriteria AND k.id_kriteria=kp.id_kriteria ORDER BY kp.id_kriteria");
                while($result=mysqli_fetch_array($query)) {
                  // pangkatkan setiap nilai kriteria, lalu jumlahkan
                  $pangkat = pow($result['nilai_sub'], 2);
                  $sum_pangkat += $pangkat;
                }

                echo "<td class='text-center'><b>$sum_pangkat</b></td>";
              } ?>
          </tr>
          <tr>
            <td class="text-center" colspan=2>Hasil Akar</td>
            <?php
              $data = mysqli_query($conn, "SELECT * FROM kriteria ORDER BY id_kriteria");

              while ($a = mysqli_fetch_array($data)) {
                $sum_pangkat = 0;
                $id_kriteria = $a['id_kriteria'];

                $query = mysqli_query($conn, "SELECT s.nilai_subkriteria as nilai_sub FROM subkriteria s, nilai kp, kriteria k WHERE kp.id_kriteria='".$id_kriteria."' AND s.id_subkriteria=kp.id_subkriteria AND k.id_kriteria=kp.id_kriteria ORDER BY kp.id_kriteria");
                while($result=mysqli_fetch_array($query)) {
                  // pangkatkan setiap nilai kriteria, lalu jumlahkan
                  $pangkat = pow($result['nilai_sub'], 2);
                  $sum_pangkat += $pangkat;

                  // akarkan setiap jumlah pangkat
                  $akar = sqrt($sum_pangkat);
                  $angka_koma = number_format($akar, 4);

                  // akar simpan kedalam db
                  mysqli_query($conn, "UPDATE kriteria set akar_kriteria='".$akar."' WHERE id_kriteria='".$id_kriteria."'");
                }
                echo "<td class='text-center'><b>$angka_koma</b></td>";
              } ?>
          </tr>
        </table>
      </div>

      <!-- Tabel nilai keputusan Ternormalisasi-->
      <h4 class="mt-5 pb-3">Nilai Keputusan Ternormalisasi</h4>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center">No</th>
              <th class="text-center">Nama Program Digitalisasi</th>
              <?php
                $data = mysqli_query($conn, "SELECT * FROM kriteria ORDER BY id_kriteria");
                while ($a = mysqli_fetch_array($data)) { ?>
              <th class="text-center"> <?php echo $a['nama_kriteria'] ?> </th>
              <?php } ?>
            </tr>
          </thead>

          <!-- output dari tambah data -->
          <tbody>
            <?php
              $data = mysqli_query($conn, "SELECT p.id_program, p.nama_program
                FROM program p
                JOIN nilai n ON p.id_program = n.id_program
                GROUP BY p.id_program
                ORDER BY p.id_program");
              
              $no = 1;
              while ($a = mysqli_fetch_array($data)) { 
              $id_program = $a['id_program'];
            ?>
            <tr>
              <td class="text-center"><?php echo $no++ ?></td>
              <td class="text-center"><?php echo $a['nama_program'] ?></td>

              <?php
              $query = mysqli_query($conn, "SELECT a.nilai_subkriteria as nilai_sub, b.id_kriteria as id_kriteria FROM subkriteria a, nilai b, kriteria c WHERE b.id_program='".$id_program."' AND b.id_kriteria=c.id_kriteria AND a.id_subkriteria=b.id_subkriteria ORDER BY b.id_kriteria");

              while ($result = mysqli_fetch_array($query)) { 
                // panggil nilai akarnya
                $query1 = mysqli_query($conn, "SELECT akar_kriteria as akar FROM kriteria WHERE id_kriteria='".$result['id_kriteria']."'");
                $result1 = mysqli_fetch_array($query1);

                // pembagian di matriks ternormalisasi
                $bagi = $result['nilai_sub']/$result1['akar'];
                $akar_koma = number_format($bagi, 4);
                echo "<td class='text-center'>$akar_koma</td>";
              } ?>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>

      <!-- Tabel Normalisasi Terbobot-->
      <h4 class="mt-5 pb-3">Normalisasi Terbobot</h4>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center">No</th>
              <th class="text-center">Nama Program Digitalisasi</th>
              <?php
                $data = mysqli_query($conn, "SELECT * FROM kriteria ORDER BY id_kriteria");
                while ($a = mysqli_fetch_array($data)) { ?>
              <th class="text-center"> <?php echo $a['nama_kriteria'] ?> </th>
              <?php } ?>
            </tr>
          </thead>

          <tbody>
            <?php
              $data = mysqli_query($conn, "SELECT p.id_program, p.nama_program
                FROM program p
                JOIN nilai n ON p.id_program = n.id_program
                GROUP BY p.id_program
                ORDER BY p.id_program");
              $no = 1;
              while ($a = mysqli_fetch_array($data)) { 
              $id_program = $a['id_program'];
            ?>
            <tr>
              <td class="text-center"><?php echo $no++ ?></td>
              <td class="text-center"><?php echo $a['nama_program'] ?></td>

              <?php
              $query = mysqli_query($conn, "SELECT a.nilai_subkriteria as nilai_sub, b.id_kriteria as id_kriteria FROM subkriteria a, nilai b, kriteria c WHERE b.id_program='".$id_program."' AND b.id_kriteria=c.id_kriteria AND a.id_subkriteria=b.id_subkriteria ORDER BY b.id_kriteria");

              while ($result = mysqli_fetch_array($query)) { 
                // panggil nilai akarnya
                $query1 = mysqli_query($conn, "SELECT akar_kriteria as akar, bobot_kriteria FROM kriteria WHERE id_kriteria='".$result['id_kriteria']."'");
                $result1 = mysqli_fetch_array($query1);
                $bobot = $result1['bobot_kriteria'];

                // pembagian di matriks ternormalisasi
                $bagi = $result['nilai_sub']/$result1['akar'];

                $kali = $bagi * $bobot;
                $akar_koma = number_format($kali, 4);

                echo "<td class='text-center'>$akar_koma</td>";

                // normalisasi terbobot simpan kedalam db
                mysqli_query($conn, "UPDATE nilai set nm_bobot='".$kali."' WHERE id_kriteria='".$result['id_kriteria']."' AND id_program='".$a['id_program']."'");
              } ?>
            </tr>
            <?php } ?>
          </tbody>

          <tr>
            <td class="text-center" colspan=2>Solusi Ideal Positif ( A+ )</td>
            <?php
              $data = mysqli_query($conn, "SELECT * FROM kriteria ORDER BY id_kriteria");
              while($a=mysqli_fetch_array($data)){
                $id_kriteria = $a['id_kriteria'];
                $jenis_kriteria = $a['jenis_kriteria'];

                // tentukan nilai A+
                if ($jenis_kriteria === 'Benefit'){
                  $query = mysqli_query($conn, "SELECT max(nm_bobot) as positif FROM nilai WHERE id_kriteria='".$id_kriteria."' ORDER BY id_kriteria");
                  $result = mysqli_fetch_array($query);
                  $positif = $result['positif'];
                  $akar_positif = number_format($positif, 4);
                } else if ($jenis_kriteria === "Cost"){
                  $query = mysqli_query($conn, "SELECT min(nm_bobot) as positif FROM nilai WHERE id_kriteria='".$id_kriteria."' ORDER BY id_kriteria");
                  $result = mysqli_fetch_array($query);
                  $positif = $result['positif'];
                  $akar_positif = number_format($positif, 4);
                }
                echo "<td class='text-center'>$akar_positif</td>";
              
                // A+ simpan kedalam db
                mysqli_query($conn, "UPDATE kriteria set solusi_ideal_positif='".$positif."' WHERE id_kriteria='".$id_kriteria."'");
              }
            ?>
          </tr>

          <tr>
            <td class="text-center" colspan=2>Solusi Ideal Negatif ( A- )</td>
            <?php
              $data = mysqli_query($conn, "SELECT * FROM kriteria ORDER BY id_kriteria");
              while($a=mysqli_fetch_array($data)){
                $id_kriteria = $a['id_kriteria'];
                $jenis_kriteria = $a['jenis_kriteria'];

                // tentukan nilai A-
                if ($jenis_kriteria === 'Benefit'){
                  $query = mysqli_query($conn, "SELECT min(nm_bobot) as negatif FROM nilai WHERE id_kriteria='".$id_kriteria."' ORDER BY id_kriteria");
                  $result = mysqli_fetch_array($query);
                  $negatif = $result['negatif'];
                  $akar_negatif = number_format($negatif, 4);
                } else if ($jenis_kriteria === "Cost"){
                  $query = mysqli_query($conn, "SELECT max(nm_bobot) as negatif FROM nilai WHERE id_kriteria='".$id_kriteria."' ORDER BY id_kriteria");
                  $result = mysqli_fetch_array($query);
                  $negatif = $result['negatif'];
                  $akar_negatif = number_format($negatif, 4);
                }
                echo "<td class='text-center'>$akar_negatif</td>";
              
                // A+ simpan kedalam db
                mysqli_query($conn, "UPDATE kriteria set solusi_ideal_negatif='".$negatif."' WHERE id_kriteria='".$id_kriteria."'");
              }
            ?>
          </tr>
        </table>
      </div>

      <!-- Tabel D+ dan D- -->
      <h4 class="mt-5 pb-3">Jarak Normalisasi Terbobot dengan Solusi Ideal</h4>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center">No</th>
              <th class="text-center">Nama Program Digitalisasi</th>
              <th class="text-center">D+</th>
              <th class="text-center">D-</th>
            </tr>
          </thead>

          <tbody>
            <?php
              $data = mysqli_query($conn, "SELECT p.id_program, p.nama_program
                FROM program p
                JOIN nilai n ON p.id_program = n.id_program
                GROUP BY p.id_program
                ORDER BY p.id_program");
              $no = 1;
              while ($a = mysqli_fetch_array($data)) { 
              $nilai_d_max = 0;
              $nilai_d_min = 0;
              $id_program = $a['id_program'];
            ?>
            <tr>
              <td class="text-center"><?php echo $no++ ?></td>
              <td class="text-center"><?php echo $a['nama_program'] ?></td>

              <?php
              $query = mysqli_query($conn, "SELECT b.nm_bobot, b.id_kriteria as id_kriteria FROM subkriteria a, nilai b, kriteria c WHERE b.id_program='".$id_program."' AND b.id_kriteria=c.id_kriteria AND a.id_subkriteria=b.id_subkriteria ORDER BY b.id_kriteria");

              while ($result = mysqli_fetch_array($query)) { 
                // panggil nilai solusi ideal
                $query1 = mysqli_query($conn, "SELECT solusi_ideal_positif as positif, solusi_ideal_negatif as negatif FROM kriteria WHERE id_kriteria='".$result['id_kriteria']."'");
                $result1 = mysqli_fetch_array($query1);
                $positif = $result1['positif'];
                $negatif = $result1['negatif'];

                // solusi ideal positif - normalisasi terbobot
                $solusi1 = $result1['positif'] - $result['nm_bobot'];
                // normalisasi terbobot - solusi ideal negatif
                $solusi2 = $result['nm_bobot'] - $result1['negatif'];
                
                // lalu dipangkatkan
                $pangkat1 = pow($solusi1, 2);
                $pangkat2 = pow($solusi2, 2);

                // lalu di jumlahkan semuanya sesuai alternatif
                // positif
                $nilai_d_max += $pangkat1;
                $akar_d_max = sqrt($nilai_d_max);
                $round_d_max = number_format($akar_d_max, 4);

                // negatif
                $nilai_d_min += $pangkat2;
                $akar_d_min = sqrt($nilai_d_min);
                $round_d_min = number_format($akar_d_min, 4);
              } 
              echo "
                <td class='text-center'>$round_d_max</td>
                <td class='text-center'>$round_d_min</td>";

                // d_max dan d_min simpan kedalam db
                mysqli_query($conn, "UPDATE program set d_max='".$akar_d_max."', d_min='".$akar_d_min."' WHERE id_program='".$id_program."'");
                ?>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>

      <!-- proses nilai preferensi -->
      <?php
        $data = mysqli_query($conn, "SELECT p.id_program, p.nama_program, d_min, d_max
              FROM program p
              JOIN nilai n ON p.id_program = n.id_program
              GROUP BY p.id_program
              ORDER BY p.id_program");
        while ($a = mysqli_fetch_array($data)) { 
          $d_max = $a['d_max'];
          $d_min = $a['d_min'];
          if (($d_min + $d_max) == 0) {
            $nilai_v = 0; // Atau nilai default lainnya
          } else {
            $nilai_v = $d_min / ($d_min + $d_max);
          }

          // d_max dan d_min simpan ke dalam db
          mysqli_query($conn, "UPDATE program SET nilai_v='" . $nilai_v . "' WHERE id_program='" . $a['id_program'] . "'");
        }

        // Reset semua rank menjadi 0 terlebih dahulu
        mysqli_query($conn, "UPDATE program SET rank=0");

        // Proses ranking hanya untuk program yang ada di tabel nilai
        $data1 = mysqli_query($conn, "SELECT DISTINCT p.nama_program, MIN(p.id_program) AS id_program, MAX(p.nilai_v) AS nilai_v 
                  FROM program p
                  JOIN nilai n ON p.id_program = n.id_program
                  WHERE n.id_program IS NOT NULL
                  GROUP BY p.nama_program
                  ORDER BY nilai_v DESC");
        $rank = 1;
        while ($a1 = mysqli_fetch_array($data1)) { 
          // Update rank hanya untuk program yang ada di tabel nilai
          mysqli_query($conn, "UPDATE program SET rank='" . $rank. "' WHERE id_program='" . $a1['id_program'] . "'");
          $rank++ ;
        }
      ?>

      <!-- Print nilai V dan ranking -->
      <h4 class="mt-5 pb-3">Perangkingan</h4>
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

          <!-- Output dari data -->
          <tbody>
            <?php
            $data = mysqli_query($conn, "SELECT id_program, nama_program, nilai_v, rank FROM program ORDER BY id_program ASC");
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
</div>