<?php include 'header.php';
  if(isset($_GET['aksi'])) {
    if($_GET['aksi']=='tambah'){ ?>
      <div class="container-xl">
        <div class="bg-dark text-white py-2 mb-3">
          <h4 class="text-center">TAMBAH DATA KRITERIA</h4>
        </div>

        <div class="panel panelcontainer">
          <div class="bootstrap-table">
            <form
              action="kriteria-proses.php?proses=simpan"
              method="post"
              enctype="multipart/form-data"
            >
              <div class="form-group">
                <label>Nama Kriteria</label>
                <input
                  type="text"
                  name="nama_kriteria"
                  class="form-control"
                  placeholder="Nama Kriteria"
                />
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Bobot Kriteria</label>
                  <input
                  type="text"
                  name="bobot_kriteria"
                  class="form-control"
                  placeholder="Bobot Kriteria"
                  />
                </div>
                <div class="form-group col-md-6">
                  <label>Jenis Kriteria</label>
                  <select class="form-control" name="jenis_kriteria">
                    <option selected disabled>--Pilih Jenis Kriteria--</option>
                    <option value="Benefit">Benefit</option>
                    <option value="Cost">Cost</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <a href="kriteria.php" class="btn btn-danger">BATAL</a>
                <input type="submit" class="btn btn-success" value="SIMPAN" />
              </div>
            </form>
          </div>
        </div>
      </div>

    <?php } else if($_GET['aksi']=='ubah') { ?>
      <div class="container-xl">
        <div class="bg-dark text-white py-2 mb-3">
          <h4 class="text-center">UBAH DATA KRITERIA</h4>
        </div>

        <div class="panel panelcontainer">
          <div class="bootstrap-table">
            <?php 
              $id_kriteria = $_GET['id_kriteria'];
              $data = mysqli_query($conn, "SELECT * FROM kriteria WHERE id_kriteria='$id_kriteria'");
              while ($a=mysqli_fetch_array($data)) { ?>

            <form
              action="kriteria-proses.php?proses=ubah"
              method="post"
              enctype="multipart/form-data"
            >
              <input type="hidden" name="id_kriteria" value="<?php echo $a['id_kriteria']; ?>">
              <div class="form-group">
                <label>Nama Kriteria</label>
                <input
                  type="text"
                  name="nama_kriteria"
                  class="form-control"
                  placeholder="Nama Kriteria"
                  value="<?php echo $a['nama_kriteria']; ?>"
                />
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Bobot Kriteria</label>
                  <input
                  type="text"
                  name="bobot_kriteria"
                  class="form-control"
                  placeholder="Bobot Kriteria"
                  value="<?php echo $a['bobot_kriteria']; ?>"
                  />
                </div>
                <div class="form-group col-md-6">
                  <label>Jenis Kriteria</label>
                  <select class="form-control" name="jenis_kriteria">
                    <option value="Benefit" <?php echo ($a['jenis_kriteria'] == 'Benefit') ? 'selected' : ''; ?>>Benefit</option>
                    <option value="Cost" <?php echo ($a['jenis_kriteria'] == 'Cost') ? 'selected' : ''; ?>>Cost</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <a href="kriteria.php" class="btn btn-danger">BATAL</a>
                <input type="submit" class="btn btn-success" value="UBAH" />
              </div>
            </form>
              <?php } ?>

          </div>
        </div>
      </div>
    <?php }} ?>