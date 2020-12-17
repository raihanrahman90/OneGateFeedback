<?php 

include 'hak_akses.php';
include 'super_admin.php';
include 'header.php';
?>
        <?php
        $id_departemen = $_GET['id'];
            $query = mysqli_query($koneksi, "SELECT * FROM tb_departemen where id_departemen='$id_departemen'") or die(mysqli_error($koneksi));
            $row = mysqli_fetch_array($query);
        ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
        
          <!-- Page Heading -->
          <?php
             echo '<h1 class="h3 mb-2 text-gray-800">Tabel Departemen '.$row['Departemen'].'</h1>' 
          ?>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <a href=<?php echo "'../Admin/add_unit.php?id=".$id_departemen."'"; ?> class="btn btn-info btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Tambah unit</span>
                  </a>
                  <button type="button" class="btn btn-warning btn-icon-split" data-toggle="modal" data-target="#exampleModal">
                      <span class="icon text-white-50">
                        <i class="fas fa-edit"></i>
                      </span>
                      <span class="text">
                          Rename
                      </span>
                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ganti Nama Departemen</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action='../action/edit_departemen.php' method='post'>
                              <div class="modal-body">
                                <input type='text' class='form-control' placeholder='Nama Departemen' name='nama_departemen'>
                                <?php
                                    echo '<input type="hidden" value="'.$id_departemen.'" name="id_departemen">';
                                ?>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Rename</button>
                              </div>
                          </form>
                        </div>
                      </div>
                    </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Unit</th>
                      <th>Lakukan</th>  
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Unit</th>
                      <th>Lakukan</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                    $id_departemen = $_GET['id'];
                      $mahasiswa = mysqli_query($koneksi, "SELECT * from tb_departemen inner join tb_unit on tb_departemen.id_departemen = tb_unit.id_departemen where tb_unit.id_departemen = '$id_departemen'") or die(mysqli_error($koneksi));
                      $no=1;
                      foreach ( $mahasiswa as $row){
                          echo "<tr>
                              <td>$no</td>
                              <td>".$row['nama_unit']."</td>
                              <td>
                              <a href='../action/delete_unit.php?id=".$row['id_unit']."' class='btn btn-danger btn-circle btn-sm' name='hapus' onclick='return";
                                echo ' confirm("Apakah ingin menghapus unit '.$row['nama_unit'].'?")';
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
                                        <h5 class="modal-title" id="exampleModalLabel">Ganti Nama Unit '.$row['nama_unit'].'</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <form action="../action/edit_unit.php" method="post">
                                          <div class="modal-body">
                                            <input type="text" class="form-control" placeholder="Nama Unit" name="nama_unit">
                                            <input type="hidden" value="'.$row['id_unit'].'" name="id_unit">
                                            <input type="hidden" value="'.$id_departemen.'" name="id_departemen">
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