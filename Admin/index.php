<?php 
$halaman ='Aduan';
include 'hak_akses.php';
include 'header.php';
if(!isset($_GET['sortBy'])){
  $sortBy = 'tb_aduan.id_aduan';
}
if(!isset($_GET['direction'])){
  $direction = 'desc';
}
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Table Feedback</h1>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="">
                <table class="table table-bordered display" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th>No Aduan</th>
                        <th>Jenis</th>
                        <th>Departemen</th>
                        <th>Unit</th>
                        <th>Perusahaan</th>
                        <th>Perihal</th>
                        <th>Tanggal Kirim</th>
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
                      <th>Perusahaan</th>
                      <th>Perihal</th>
                      <th>Tanggal Kirim</th>
                      <th>Status</th>
                      <th>Level</th>
                      <th>Lakukan</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                    ###login sebagai unit
                    if(($_SESSION['hak_akses']=='Super Admin' || $_SESSION['hak_akses'] == 'Admin2' || $_SESSION['hak_akses']=='Pengawas Internal' || $_SESSION['hak_akses']=='Admin1') || ($_SESSION['status_akun']=='AOC Head' || $_SESSION['status_akun']=='General Manager')){
                      $sintax = "SELECT tb_aduan.id_aduan, jenis, Departemen, tb_aduan.nama_unit, urgensi, perihal, tb_aduan.status, level, progress.id_aduan as merah, tb_aduan.waktu, nama_perusahaan, waktu_kirim from tb_aduan 
                          left join tb_unit ON tb_aduan.id_unit=tb_unit.id_unit 
                          left join tb_departemen on tb_unit.id_departemen = tb_departemen.id_departemen 
                          left join (select id_aduan, waktu from tb_progress where tindakan like 'Dikembalikan ke unit teknis%') as progress
                                on tb_aduan.id_aduan = progress.id_aduan and progress.waktu >= tb_aduan.waktu
                          left join tb_customer on tb_customer.id_customer = tb_aduan.id_customer
                          WHERE tb_aduan.status <> 'Request' and tb_aduan.status <> 'Returned' 
                          GROUP BY tb_aduan.id_aduan
                          ORDER BY $sortBy $direction";
                    }else if($_SESSION['status_akun']=='Manager'||$_SESSION['status_akun']=='Unit'){
                      /** Hanya menampilkan aduan terhadap unit */
                      $id_unit = $_SESSION['id_unit'];
                      $sintax="SELECT  tb_aduan.id_aduan, jenis, Departemen, tb_aduan.nama_unit, urgensi, perihal, tb_aduan.status, level, progress.id_aduan as merah, tb_aduan.waktu, waktu_kirim, nama_perusahaan from tb_aduan 
                                inner join tb_unit on tb_aduan.id_unit = tb_unit.id_unit inner join tb_departemen on tb_departemen.id_departemen =tb_unit.id_departemen 
                                left join (select id_aduan, waktu from tb_progress where tindakan like 'Dikembalikan ke unit teknis%') as progress
                                        on tb_aduan.id_aduan = progress.id_aduan and progress.waktu >= tb_aduan.waktu
                                left join tb_customer on tb_customer.id_customer = tb_aduan.id_customer
                                where tb_unit.id_unit = '$id_unit'
                                ORDER BY $sortBy $direction";
                      /** Hanya menampilkan aduan terhadap unit */

                    }else if($_SESSION['status_akun']=='Senior Manager'){
                      $id_departemen = $_SESSION['id_departemen'];
                      /** Hanya menampilkan aduan terhadap departemen dari senior manager */
                      $sintax="SELECT  tb_aduan.id_aduan, jenis, Departemen, tb_aduan.nama_unit, urgensi, perihal, tb_aduan.status, level, progress.id_aduan as merah, tb_aduan.waktu, waktu_kirim, nama_perusahaan from tb_aduan 
                              inner join tb_unit on tb_aduan.id_unit = tb_unit.id_unit inner join tb_departemen on tb_departemen.id_departemen =tb_unit.id_departemen 
                              left join (select id_aduan, waktu from tb_progress where tindakan like 'Dikembalikan ke unit teknis%') as progress
                                    on tb_aduan.id_aduan = progress.id_aduan and progress.waktu >= tb_aduan.waktu 
                              left join tb_customer on tb_customer.id_customer = tb_aduan.id_customer
                              where tb_departemen.id_departemen = '$id_departemen'
                              ORDER BY $sortBy $direction";
                      /** Hanya menampilkan aduan terhadap departemen dari senior manager */
                    }
                      $query = mysqli_query($koneksi, $sintax) or die(mysqli_error($koneksi));
                      $edit =false;
                      foreach ( $query as $row){
                          echo "<tr>
                              <td>".$row['id_aduan']."</td>
                              <td>".$row['jenis']."</td>
                              <td>".$row['Departemen']."</td>
                              <td>".$row['nama_unit']."</td>
                              <td>".$row['nama_perusahaan']."</td>";
                              /**mewarnai aduan yang berstatus urgen**/    
                              if($row['urgensi']==1){
                                echo"<td><span class='badge badge-pill badge-danger' style='auto;'>".$row['perihal']."</span></td>";
                              }else{
                                echo
                                "<td>".$row['perihal']."</td>";
                              }
                              /**mewarnai aduan yang berstatus urgen**/
                              ####status
                              echo "<td>".$row['waktu_kirim']."</td>";
                              if($row['status']=='Closed'){  
                                  echo"<td> 
                                          <span class='badge badge-pill badge-success' style='width:100px;'>".$row['status']."</span>
                                    </td>";
                              } else if($row['status']=="Progress"){
                                  #kondisi progres sudah lebih dari 1 bulan akan berwarna merah
                                  $d1 = new DateTime($row['waktu']);
                                  $d2 = new DateTime();
                                  $interval = $d2->diff($d1);
                                  $interval = $interval->m;
                                  if($interval>1){
                                    echo"<td><span class='badge badge-pill badge-danger' style='width:100px;'>".$row['status']."</span></td>";
                                  } else {
                                    echo"<td><span class='badge badge-pill badge-secondary' style='width:100px;'>".$row['status']."</span></td>";
                                  }
                                  #kondisi progres sudah lebih dari 1 bulan akan berwarna merah
                              }else if($row['status']=="Returned"){
                                echo"<td><span class='badge badge-pill badge-danger' style='width:100px;'>".$row['status']."</span></td>";
                              }else if($row['status']=='Open'){
                                if(is_null($row['merah'])){
                                  echo"<td><span class='badge badge-pill badge-warning' style='width:100px;'>".$row['status']."</span></td>";
                                }else{
                                  echo"<td><span class='badge badge-pill badge-danger' style='width:100px;'>".$row['status']."</span></td>";
                                }
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
                    ###login sebagai unit
                    
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