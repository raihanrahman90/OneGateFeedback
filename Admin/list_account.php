<?php 
$halaman = 'Akun';
    include 'hak_akses.php';
    include 'super_admin.php';
    include 'header.php';
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Tabel Akun</h1>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <a href="add_account.php" class="btn btn-info btn-icon-split">
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
                      <th>Hak Akses</th>
                      <th>Status</th> 
                      <th>Departemen</th>
                      <th>Unit</th>
                      <th>Nama</th>
                      <th>Lakukan</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Hak Akses</th>
                      <th>Status</th> 
                      <th>Departemen</th>
                      <th>Unit</th>
                      <th>Nama</th>
                      <th>Lakukan</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                      $mahasiswa = mysqli_query($koneksi, "SELECT * from tb_akun left join tb_unit ON tb_akun.id_unit=tb_unit.id_unit left join tb_departemen ON tb_akun.id_departemen = tb_departemen.id_departemen ORDER BY tb_akun.id_unit") or die(mysqli_error($koneksi));
                      $no=1;
                      foreach ( $mahasiswa as $row){
                          echo "<tr>
                              <td>$no</td>
                              <td>".$row['hak_akses']."</td>
                              <td>".$row['status']."</td>
                              <td>".$row['Departemen']."</td>
                              <td>".$row['nama_unit']."</td>
                              <td>".$row['Nama']."</td>
                              <td><a href='detail_akun.php?id=".$row['Id_akun']."' class='btn btn-info btn-circle btn-sm'>
                                <i class='fas fa-info-circle'></i>
                              </a>";
                              if($row['status']!='0'){
                              echo"<a href='../action/delete_account.php?id=".$row['Id_akun']."' class='btn btn-danger btn-circle btn-sm' name='hapus' onclick='return";
                                echo ' confirm("Apakah ingin menghapus akun atas nama '.$row['Nama'].'?")';
                                echo"'>
                                <i class='fas fa-trash'></i>
                              </a>";
                              }
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