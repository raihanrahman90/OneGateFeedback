<?php 
    $halaman = 'Request';
    include 'hak_akses.php';
    include  'admin1.php';
    include 'header.php';
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Table Request</h1>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Jenis</th>
                      <th>Perihal</th>
                      <th>Status</th>
                      <th>Lakukan</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Jenis</th>
                      <th>Perihal</th>
                      <th>Status</th>
                      <th>Lakukan</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                    $pertanyaan = 'Ingin mengapus data?';
                    $id_akun = $_SESSION['id_akun'];
                   if($_SESSION['hak_akses']=='Super Admin' || $_SESSION['hak_akses']=='Admin1'){
                        $mahasiswa = mysqli_query($koneksi, "SELECT * from tb_aduan WHERE (status = 'Request' or status='Returned') and level > -1 ORDER BY waktu DESC") or die(mysqli_error($koneksi));
                    } else {
                        $mahasiswa = mysqli_query($koneksi, "SELECT * from tb_aduan where id_akun='$id_akun' ORDER BY waktu DESC");
                    }
                      $edit =false;$no=1;
                      foreach ( $mahasiswa as $row){
                          echo "<tr>
                              <td>".$row['id_aduan']."</td>
                              <td>".$row['jenis']."</td>";
                              if($row['urgensi']==1){
                                echo"<td><span class='badge badge-pill badge-danger' style='width:100px;'>".$row['perihal']."</span></td>";
                              }else{
                                echo
                                "<td>".$row['perihal']."</td>";
                              }
                              if($row['status']=='Returned'){
                                echo"<td><span class='badge badge-pill badge-danger' style='width:100px;'>".$row['status']."</span></td>";
                              } else {
                                    echo"<td> 
                                          <span class='badge badge-pill badge-success' style='width:100px;'>".$row['status']."</span>
                                    </td>";

                              }
                              echo"
                              <td>
                                  <a href='detail_request.php?id=".$row['id_aduan']."' class='btn btn-info btn-circle btn-sm'>
                                    <i class='fas fa-info-circle'></i>
                                  </a>
                              </td>
                            </tr>";
                            ///hapus request
                             /*if($row['status']=='Request'){
                             echo"<a href='../action/delete_aduan.php?id=".$row['id_aduan']."' class='btn btn-danger btn-circle btn-sm' name='hapus' onclick='return";
                                echo ' confirm("Apakah ingin menghapus request?")';
                                echo"'>
                                <i class='fas fa-trash'></i>
                              </a>";
                              }*/
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
        }
        });
 
      </script>
      <!-- End of Main Content -->
<?php include 'footer.php';
?>