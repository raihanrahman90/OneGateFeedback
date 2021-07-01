<?php 
    
    $halaman = 'Aduan';
    include 'hak_akses.php';
    include 'header.php';
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Tindakan</h1>
          <!-- DataTales Example -->
          <?php 
                      if(isset($_SESSION['status_jalan'])){
                        if($_SESSION['status_jalan'] == "Gambar is missing"){
                        echo '<div class="alert alert-warning alert-dismissible fade show">
                              Tindakan dengan status Complete harus menyertakan bukti gambar
                          </div>';
                          unset($_SESSION['status_jalan']);
                        }
                      }
                    ?>
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
              <form action="../action/tindakan.php" method="post" enctype="multipart/form-data" id="form">
                <table class="table" id="" width="100%" cellspacing="0">
                
                  <tbody>
                    <tr>
                      <td><label>Status</label></td>
                      <td><label>:</label></td>
                      <td>
                        <div class="form-group-checked row">
                          <div class="col-sm-6 mb-3-checked mb-sm-0">
                            <input class="form-control-checked"type="radio" value="Progress" text="Progress" name="status" checked id="tindakan-progres">
                            <label class="form-check-label form-control-checked">Progress</label>
                          </div>
                          <div class="col-sm-6 mb-3-checked mb-sm-0">
                            <input type="radio" class="form-control-checked" value="Complete"  text="Complete" name="status" id="tindakan-complete">
                            <label class="form-check-label form-control-checked">Selesai</label>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td><label>Tindakan</label></td>
                      <td><label>:</label></td>
                      <td><input type="text" class ="form-control" name="tindakan" required>
                      </td>
                    </tr>
                    <tr>
                      <td><label>Bukti Gambar (PNG/JPG)</label></td>
                      <td><label>:</label></td>
                      <td><input type="file" name="Bukti" id="bukti" accept='image/*'></td>
                    </tr>
                    <tr>
                      <td><label>Laporan</label></td>
                      <td><label>:</label></td>
                      <td><input type="file" name="laporan" id="laporan" accept='application/pdf,application/vnd.ms-excel'><br>
                          <span class="text-danger">Masukkan laporan pdf jika perlu</span></td>
                    </tr>
                    <tr>
                      <td colspan="3">
                        <button type="submit" class="btn btn-info btn-icon-split float-right" data-toggle='modal' data-target='#kembaliModal'>
                          <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                          </span>
                          <span class="text">
                                Kirim
                          </span>
                         </button>
                      </td>
                    </tr>
                  </tbody>
                </table>  
                <?php
                  echo "<input type='hidden' name='id_aduan' value='".$_GET['id']."'>";
                ?>
              </form>
            </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
<?php include 'footer.php';
?>