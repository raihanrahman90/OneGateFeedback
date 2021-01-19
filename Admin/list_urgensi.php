<?php 
$halaman = 'Urgensi';
include 'hak_akses.php';
include 'super_admin.php';
include 'header.php';
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
        
          <!-- Page Heading -->
           <h1 class="h3 mb-2 text-gray-800">List Urgensi</h1>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <a href="../Admin/add_urgensi.php" class="btn btn-info btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Tambah Urgensi</span>
                  </a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Perihal</th>
                      <th>Lakukan</th>  
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>No</th>                      
                      <th>Perihal</th>
                      <th>Lakukan</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                      $urgensi = mysqli_query($koneksi, "SELECT * from tb_urgensi") or die(mysqli_error($koneksi));
                      $no=1;
                      foreach ( $urgensi as $row){
                          echo "<tr>
                              <td>$no</td>
                              <td>".$row['perihal']."</td>
                              <td>
                              <a href='../action/delete_urgensi.php?id=".$row['id_urgensi']."' class='btn btn-danger btn-circle btn-sm' name='hapus' onclick='return";
                                echo ' confirm("Apakah ingin menghapus perihal '.$row['perihal'].' dari daftar urgensi?")';
                                echo"'>
                                <i class='fas fa-trash'></i>
                              </a>";
                                echo '<button type="button" class="btn btn-warning btn-circle btn-sm" data-toggle="modal" data-target="#exampleModal'.$no.'">
                                    <i class="fas fa-edit"></i>
                                </button>
                                
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal'.$no.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Ganti Perihal '.$row['perihal'].'</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <form action="../action/edit_urgensi.php" method="post">
                                          <div class="modal-body">
                                            <input type="text" class="form-control" placeholder="Perihal" name="perihal">
                                            <input type="hidden" value="'.$row['id_urgensi'].'" name="id_urgensi">
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Rename</button>
                                          </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>';
                              echo"</td>
                            </tr>";
                          $no++;
                      }

                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
<?php include 'footer.php';
?>