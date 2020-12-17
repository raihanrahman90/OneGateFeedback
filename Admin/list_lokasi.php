<?php 
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
                      <th>Jumlah Detail Lokasi</th>
                      <th>Lakukan</th>  
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Lokasi</th>
                      <th>Jumlah Detail Lokasi</th>
                      <th>Lakukan</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                      $mahasiswa = mysqli_query($koneksi, "SELECT tb_lokasi.*, count(id_detail_lokasi) from tb_lokasi LEFT JOIN tb_detail_lokasi ON tb_lokasi.id_lokasi = tb_detail_lokasi.id_lokasi GROUP BY tb_lokasi.id_lokasi");
                      $no=1;
                      foreach ( $mahasiswa as $row){
                          echo "<tr>
                              <td>$no</td>
                              <td>".$row['nama_lokasi']."</td>
                              <td>".$row['count(id_detail_lokasi)']."</td>
                              <td>
                              <a href='detail_lokasi.php?id=".$row['id_lokasi']."' class='btn btn-info btn-circle btn-sm'>
                                <i class='fas fa-info-circle'></i>
                              </a><a href='../action/delete_lokasi.php?id=".$row['id_lokasi']."' class='btn btn-danger btn-circle btn-sm' name='hapus' onclick='return";
                                echo ' confirm("Apakah ingin menghapus lokasi '.$row['nama_lokasi'].'?")';
                                echo"'>
                                <i class='fas fa-trash'></i>
                              </a>
                              </td>
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