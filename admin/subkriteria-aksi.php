<?php include 'header.php';
  if(isset($_GET['aksi'])) {
    if($_GET['aksi']=='tambah'){ ?>
      <div class="container-xl">
        <div class="bg-dark text-white py-2 mb-3">
          <h4 class="text-center">TAMBAH DATA SUBKRITERIA</h4>
        </div>

        <div class="panel panelcontainer">
          <div class="bootstrap-table">
            <form
              action="subkriteria-proses.php?proses=simpan"
              method="post"
              enctype="multipart/form-data"
            >
              <input type="hidden" name="id_kriteria" value="<?php echo $_GET['id_kriteria'] ?>">
              <div class="form-group">
                <label>Nama Subkriteria</label>
                <input
                  type="text"
                  name="nama_subkriteria"
                  class="form-control"
                  placeholder="Nama Subkriteria"
                />
              </div>

              <div class="form-group">
                <label>Nilai Subkriteria</label>
                <input
                  type="text"
                  name="nilai_subkriteria"
                  class="form-control"
                  placeholder="Nilai Subkriteria"
                />
              </div>

              <div class="form-group">
                <a href="subkriteria.php?id_kriteria=<?php echo $_GET['id_kriteria'] ?>" class="btn btn-danger">BATAL</a>
                <input type="submit" class="btn btn-success" value="SIMPAN" />
              </div>
            </form>
          </div>
        </div>
      </div>

    <?php } else if($_GET['aksi']=='ubah') { ?>
      <div class="container-xl">
        <div class="bg-dark text-white py-2 mb-3">
          <h4 class="text-center">UBAH DATA SUBKRITERIA</h4>
        </div>

        <div class="panel panelcontainer">
          <div class="bootstrap-table">
            <?php 
              $id_subkriteria = $_GET['id_subkriteria'];
              $data = mysqli_query($conn, "SELECT * FROM subkriteria WHERE id_subkriteria='$id_subkriteria'");
              while ($a=mysqli_fetch_array($data)) { ?>

            <form
              action="subkriteria-proses.php?proses=ubah"
              method="post"
              enctype="multipart/form-data"
            >
              <input type="hidden" name="id_kriteria" value="<?php echo $_GET['id_kriteria'] ?>">
              <input type="hidden" name="id_subkriteria" value="<?php echo $a['id_subkriteria']; ?>">
              <div class="form-group">
                <label>Nama Subkriteria</label>
                <input
                  type="text"
                  name="nama_subkriteria"
                  class="form-control"
                  placeholder="Nama Subkriteria"
                  value="<?php echo $a['nama_subkriteria']; ?>"
                />
              </div>

              <div class="form-group">
                <label>Nilai Subkriteria</label>
                <input
                  type="text"
                  name="nilai_subkriteria"
                  class="form-control"
                  placeholder="Nilai Subkriteria"
                  value="<?php echo $a['nilai_subkriteria']; ?>"
                />
              </div>

              <div class="form-group">
                <a href="subkriteria.php?id_kriteria=<?php echo $_GET['id_kriteria'] ?>" class="btn btn-danger">BATAL</a>
                <input type="submit" class="btn btn-success" value="UBAH" />
              </div>
            </form>
              <?php } ?>

          </div>
        </div>
      </div>
    <?php }} ?>