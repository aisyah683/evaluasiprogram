<?php include 'header.php';
  if(isset($_GET['aksi'])) {
    if($_GET['aksi']=='tambah'){ ?>
      <div class="container-xl">
        <div class="bg-dark text-white py-2 mb-3">
          <h4 class="text-center">TAMBAH DATA PROGRAM DIGITALISASI</h4>
        </div>

        <div class="panel panelcontainer">
          <div class="bootstrap-table">
            <form
              action="program-proses.php?proses=simpan"
              method="post"
              enctype="multipart/form-data"
            >
              <div class="form-group">
                <label>Nama Program Digitalisasi</label>
                <input
                  type="text"
                  name="nama_program"
                  class="form-control"
                  placeholder="Nama Program Digitalisasi"
                />
              </div>

              <div class="form-group">
                <a href="program.php" class="btn btn-danger">BATAL</a>
                <input type="submit" class="btn btn-success" value="SIMPAN" />
              </div>
            </form>
          </div>
        </div>
      </div>

    <?php } else if($_GET['aksi']=='ubah') { ?>
      <div class="container-xl">
        <div class="bg-dark text-white py-2 mb-3">
          <h4 class="text-center">UBAH DATA PROGRAM DIGITALISASI</h4>
        </div>

        <div class="panel panelcontainer">
          <div class="bootstrap-table">
            <?php 
              $id_program = $_GET['id_program'];
              $data = mysqli_query($conn, "SELECT * FROM program WHERE id_program='$id_program'");
              while ($a=mysqli_fetch_array($data)) { ?>

            <form
              action="program-proses.php?proses=ubah"
              method="post"
              enctype="multipart/form-data"
            >
              <input type="hidden" name="id_program" value="<?php echo $a['id_program']; ?>">
              <div class="form-group">
                <label>Nama Program Digitalisasi</label>
                <input
                  type="text"
                  name="nama_program"
                  class="form-control"
                  placeholder="Nama Program Digitalisasi"
                  value="<?php echo $a['nama_program']; ?>"
                />
              </div>

              <div class="form-group">
                <a href="program.php" class="btn btn-danger">BATAL</a>
                <input type="submit" class="btn btn-success" value="UBAH" />
              </div>
            </form>
              <?php } ?>

          </div>
        </div>
      </div>
    <?php }} ?>