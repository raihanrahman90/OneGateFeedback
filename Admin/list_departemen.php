<?php 
    $halaman = 'Departemen';
    include 'hak_akses.php';
    include  'super_admin.php';
    include 'header.php';
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Tabel Departemen</h1>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <a href="add_departemen.php" class="btn btn-info btn-icon-split">
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
                      <th>Departemen</th>
                      <th>Jumlah Unit</th>
                      <th>Lakukan</th>  
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Departemen</th>
                      <th>Jumlah Unit</th>
                      <th>Lakukan</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                      $mahasiswa = mysqli_query($koneksi, "SELECT tb_departemen.id_departemen,Departemen, count(id_unit) from tb_departemen LEFT JOIN tb_unit ON tb_departemen.id_departemen = tb_unit.id_departemen GROUP BY tb_departemen.id_departemen");
                      $no=1;
                      foreach ( $mahasiswa as $row){
                          echo "<tr>
                              <td>$no</td>
                              <td>".$row['Departemen']."</td>
                              <td>".$row['count(id_unit)']."</td>
                              <td>
                              <a href='detail_departemen.php?id=".$row['id_departemen']."' class='btn btn-info btn-circle btn-sm'>
                                <i class='fas fa-info-circle'></i>
                              </a><a href='../action/delete_departemen.php?id=".$row['id_departemen']."' class='btn btn-danger btn-circle btn-sm' name='hapus' onclick='return";
                                echo ' confirm("Apakah ingin menghapus departemen atas nama '.$row['Departemen'].'?")';
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