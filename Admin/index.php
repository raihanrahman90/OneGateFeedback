<?php 
$halaman ='Aduan';
include 'hak_akses.php';
include 'header.php';
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Table Feedback</h1>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered display" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th>No Aduan</th>
                        <th>Jenis</th>
                        <th>Departemen</th>
                        <th>Unit</th>
                        <th>Perihal</th>
                          <th class='sorting_desc' aria-sort="descending">Status</th>
                          <th>Level</th>
                      <th>Lakukan</th>  
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>No Aduan</th>
                      <th>Jenis</th>
                      <th>Departemen</th>
                      <th>Unit</th>
                      <th>Perihal</th>
                      <th>Status</th>
                      <th>Level</th>
                      <th>Lakukan</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                    ###login sebagai unit
                    if($_SESSION['hak_akses']!='Unit'){
                      $mahasiswa = mysqli_query($koneksi, "SELECT * from tb_aduan 
                          left join tb_unit ON tb_aduan.id_unit=tb_unit.id_unit 
                          left join tb_departemen on tb_unit.id_departemen = tb_departemen.id_departemen 
                          WHERE status <> 'Request' and status <> 'Returned' 
                          ORDER BY field(status,'Progress' ,'Open', 'Closed'), waktu DESC") or die(mysqli_error($koneksi));
                      $edit =false;
                      foreach ( $mahasiswa as $row){
                          echo "<tr>
                              <td>".$row['id_aduan']."</td>
                              <td>".$row['jenis']."</td>
                              <td>".$row['Departemen']."</td>
                              <td>".$row['nama_unit']."</td>";
                              ###mewarnai aduan yang berstatus urgen    
                              if($row['urgensi']==1){
                                echo"<td><span class='badge badge-pill badge-danger' style='auto;'>".$row['perihal']."</span></td>";
                              }else{
                                echo
                                "<td>".$row['perihal']."</td>";
                              }
                              
                              ####status
                              if($row['status']=='Closed'){  
                                  echo"<td> 
                                          <span class='badge badge-pill badge-success' style='width:100px;'>".$row['status']."</span>
                                    </td>";
                              } else if($row['status']=="Progress"){
                                  #kondisi progres sudah lebih dari 1 bulan
                                  $d1 = new DateTime($row['waktu']);
                                  $d2 = new DateTime();
                                  $interval = $d2->diff($d1);
                                  $interval = $interval->m;
                                  if($interval>1){
                                    echo"<td><span class='badge badge-pill badge-danger' style='width:100px;'>".$row['status']."</span></td>";
                                  } else {
                                    echo"<td><span class='badge badge-pill badge-warning' style='width:100px;'>".$row['status']."</span></td>";
                                  }
                              }else if($row['status']=="Returned"){
                                echo"<td><span class='badge badge-pill badge-danger' style='width:100px;'>".$row['status']."</span></td>";
                              }else if($row['status']=='Open'){
                                 echo"<td><span class='badge badge-pill badge-warning' style='width:100px;'>".$row['status']."</span></td>";
                              }else{
                                echo"<td><span class='badge badge-pill badge-info' style='width:100px;'>".$row['status']."</span></td>";
                              }
                              ###status
                              
                              
                              ####level
                              if($row['level']=='0'){  
                                  echo"<td><span class='badge badge-pill badge-secondary'  >".$row['level']."</span></td>";
                              } else if($row['level']=="1"){
                                echo"<td><span class='badge badge-pill badge-success'  >".$row['level']."</span></td>";
                              }else if($row['level']=="2"){
                                echo"<td><span class='badge badge-pill badge-info'  >".$row['level']."</span></td>";
                              }else if($row['level']=="3"){
                                    echo"<td><span class='badge badge-pill badge-warning'>".$row['level']."</span></td>";
                              }else{
                                  echo "<td><span class='badge badge-pill badge-danger'>".$row['level']."</span></td>";
                              }
                              ###level
                              
                                echo "
                                <td>
                                  <a href='detail_aduan.php?id=".$row['id_aduan']."' class='btn btn-info btn-circle btn-sm'>
                                    <i class='fas fa-info-circle'></i>
                                  </a>
                              </td>
                            </tr>";                      
                          }
                    } 
                    ###login sebagai unit
                    
                    
                    ###login selain unit
                    else {
                      if($_SESSION['status_akun']=='Manager'||$_SESSION['status_akun']=='Unit'){
                        $sintax="SELECT * FROM tb_aduan inner join tb_unit on tb_aduan.id_unit = tb_unit.id_unit inner join tb_departemen on tb_departemen.id_departemen =tb_unit.id_departemen where tb_unit.id_unit = '".$_SESSION['id_unit']."'";
                      }else if($_SESSION['status_akun']=='Senior Manager'){
                        $sintax="SELECT * FROM tb_aduan inner join tb_unit on tb_aduan.id_unit = tb_unit.id_unit inner join tb_departemen on tb_departemen.id_departemen =tb_unit.id_departemen where tb_departemen.id_departemen = '".$_SESSION['id_departemen']."' and level>=2";
                      } else if($_SESSION['status_akun']=='AOC Head'){
                        $sintax="SELECT * FROM tb_aduan inner join tb_unit on tb_aduan.id_unit = tb_unit.id_unit inner join tb_departemen on tb_departemen.id_departemen =tb_unit.id_departemen where level>=3";
                      } else {
                        $sintax="SELECT * FROM tb_aduan inner join tb_unit on tb_aduan.id_unit = tb_unit.id_unit inner join tb_departemen on tb_departemen.id_departemen =tb_unit.id_departemen where level=4";
                      }
                        $data = mysqli_query($koneksi, $sintax) or die(mysqli_error($koneksi));
                        $edit = true;
                        #perulangan untuk setiap row
                        foreach ( $data as $row){
                            echo "<tr>
                              <td>".$row['id_aduan']."</td>
                              <td>".$row['jenis']."</td>
                              <td>".$row['Departemen']."</td>
                              <td>".$row['nama_unit']."</td>";
                              ###mewarnai aduan yang berstatus urgen    
                              if($row['urgensi']==1){
                                echo"<td><span class='badge badge-pill badge-danger' style='width:100px;'>".$row['perihal']."</span></td>";
                              }else{
                                echo
                                "<td>".$row['perihal']."</td>";
                              }
                              
                                ###status
                                if($row['status']=='Closed'){  
                                    echo"<td><span class='badge badge-pill badge-success' style='width:100px;'>".$row['status']."</span></td>";
                                } else if($row['status']=="Progress"){
                                  #kondisi progres sudah lebih dari 1 bulan
                                  $d1 = new DateTime($row['waktu']);
                                  $d2 = new DateTime();
                                  $interval = $d2->diff($d1);
                                  $interval = $interval->m;
                                  if($interval>1){
                                  echo"<td><span class='badge badge-pill badge-danger' style='width:100px;'>".$row['status']."</span></td>";
                                  } else {
                                    echo"<td><span class='badge badge-pill badge-warning' style='width:100px;'>".$row['status']."</span></td>";
                                  }
                                }else if($row['status']=="Returned"){
                                  echo"<td><span class='badge badge-pill badge-danger' style='width:100px;'>".$row['status']."</span></td>";
                                }else if($row['status']=='Open'){
                                    echo"<td><span class='badge badge-pill badge-warning' style='width:100px;'>".$row['status']."</span></td>";
                                }else{
                                    echo"<td><span class='badge badge-pill badge-info' style='width:100px;'>".$row['status']."</span></td>";
                                }
                                ###tutup status
                                
                                ####level
                              if($row['level']=='0'){  
                                echo"<td><span class='badge badge-pill badge-secondary'  >".$row['level']."</span></td>";
                              } else if($row['level']=="1"){
                                echo"<td><span class='badge badge-pill badge-success'  >".$row['level']."</span></td>";
                              }else if($row['level']=="2"){
                                echo"<td><span class='badge badge-pill badge-info'  >".$row['level']."</span></td>";
                              }else if($row['level']=="3"){
                                echo"<td><span class='badge badge-pill badge-warning'  >".$row['level']."</span></td>";
                              }else{
                                echo "<td><span class='badge badge-pill badge-danger' >".$row['level']."</span></td>";
                              }
                              ###tutup level
                              
                              
                                echo"
                                <td>
                                    <a href='detail_aduan.php?id=".$row['id_aduan']."' class='btn btn-info btn-circle btn-sm'>
                                      <i class='fas fa-info-circle'></i>
                                    </a>
                                </td>
                              </tr>";
                        }
                        ###tutup perulangan
                    }
                     ###tutup else selain unit

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