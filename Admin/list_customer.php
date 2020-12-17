<?php 
    include 'hak_akses.php';
    include  'super_admin.php';
    include 'header.php';
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Table Customer</h1>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>ID</th>
                      <th>Nama</th>
                      <th>Nama Perusahaan</th>
                      <th>Masa Berlaku</th>
                      <th>Status</th>
                      <th>Lakukan</th>  
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>ID</th>
                      <th>Nama</th>
                      <th>Nama Perusahaan</th>
                      <th>Masa Berlaku</th>
                      <th>Status</th>
                      <th>Lakukan</th>  
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                      $mahasiswa = mysqli_query($koneksi, "SELECT * from tb_customer ORDER BY status ASC");
                      $edit =false;$no=1;
                      foreach ( $mahasiswa as $row){
                          echo "<tr>
                              <td>$no</td>
                              <td>".$row['id_customer']."</td>
                              <td>".$row['nama']."</td>
                              <td>".$row['nama_perusahaan']."</td>
                              <td>".$row['masa_berlaku']."</td>
                              <td>
                              ";
                              if($row['status']=='0'){  
                                  echo"<span class='badge badge-pill badge-warning' style='width:100px;'>Tidak Aktif</span></td>
                              ";
                              } else if($row['status']=='2'){
                                echo"<span class='badge badge-pill badge-info' style='width:100px;'>Dinonaktifkan</span></td>
                              ";
                              }else{
                                echo"<span class='badge badge-pill badge-success' style='width:100px;'>Aktif</span></td>
                              ";
                              }
                              echo"
                              <td>
                              <a href='detail_customer.php?id=".$row['id_customer']."' class='btn btn-info btn-circle btn-sm'>
                                <i class='fas fa-info-circle'></i>
                              </a> ";
                                echo "<a href='../action/delete_customer.php?id=".$row['id_customer']."' class='btn btn-danger btn-circle btn-sm' name='hapus' onclick='return";
                                echo ' confirm("Apakah ingin menghapus akun pada dengan id '.$row['id_customer'].'?")';
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
      <script type="text/javascript">
        $(document).ready(function() {
   // some code here
        var aElems = document.getElementsByName('hapus');
        for (var i = 0, len = aElems.length; i < len; i++) {
            aElems[i].onclick = function() {
                var check = confirm("Ingin menghapus data?");
                if (check == true) {
                    return true;
                }
                else {
                    return false;
                }
            };
        }​
        });
 
      </script>
      <!-- End of Main Content -->
<?php include 'footer.php';
?>