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
                      if(isset($_SESSION['status'])){
                        if($_SESSION['status'] == "Email telah digunakan"){
                        echo '<div class="alert alert-warning alert-dismissible fade show">
                              Email telah digunakan
                          </div>';
                          $_SESSION['status'] = "";
                        }
                      }
                    ?>
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
              <form action="../action/tindakan.php" method="post" enctype="multipart/form-data">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                  <tbody>
                    <tr>
                      <td><label>Status</label></td>
                      <td><label>:</label></td>
                      <td><div class="form-group-checked row">
                  <div class="col-sm-6 mb-3-checked mb-sm-0">
                    <input class="form-control-checked"type="radio" value="Progress" text="Progress" name="status" checked>
                    <label class="form-check-label form-control-checked">Progress</label>
                  </div>
                  <div class="col-sm-6 mb-3-checked mb-sm-0">
                    <input type="radio" class="form-control-checked" value="Complete"  text="Complete" name="status">
                    <label class="form-check-label form-control-checked">Selesai</label>
                  </div>
                </div>
              </td>
                    </tr>
                    <tr>
                      <td><label>Tindakan</label></td>
                      <td><label>:</label></td>
                      <td><input type="text" class ="form-control" name="tindakan">
                      </td>
                    </tr>
                    <tr>
                      <td><label>Bukti</label></td>
                      <td><label>:</label></td>
                     <?php
                        if($_SESSION['status_akun']=='Senior Manager' || $_SESSION['status_akun']=='Duty Manager' ||  $_SESSION['status_akun']=='General Manager'){
                            echo '<td><input type="file" name="Bukti"></td>';
                        } else {
                            echo '<td><input type="file" name="Bukti" required></td>';
                        }
                    ?>
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