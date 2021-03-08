<?php 
    $halaman = 'Lokasi';
    include 'hak_akses.php';
    include  'super_admin.php';
    include 'header.php';
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Tabel Lokasi</h1>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <a href="add_lokasi.php" class="btn btn-info btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Tambah</span>
                  </a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Lokasi</th>
                      <th>Lakukan</th>  
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Lokasi</th>
                      <th>Lakukan</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                      $mahasiswa = mysqli_query($koneksi, "SELECT tb_lokasi.* from tb_lokasi") or die(mysqli_error($koneksi));
                      $no=1;
                      foreach ( $mahasiswa as $row){
                          echo "<tr>
                              <td>$no</td>
                              <td>".$row['nama_lokasi']."</td>
                              <td><a href='../action/delete_lokasi.php?id=".$row['id_lokasi']."' class='btn btn-danger btn-circle btn-sm' name='hapus' onclick='return";
                                echo ' confirm("Apakah ingin menghapus lokasi '.$row['nama_lokasi'].'?")';
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
                                      <h5 class="modal-title" id="exampleModalLabel">Ganti Nama Lokasi '.$row['nama_lokasi'].'</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <form action="../action/edit_lokasi.php" method="post">
                                        <div class="modal-body">
                                          <input type="text" class="form-control" placeholder="Nama Lokasi" name="nama_lokasi">
                                          <input type="hidden" value="'.$row['id_lokasi'].'" name="id_lokasi">
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