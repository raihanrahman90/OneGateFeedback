
<?php 

$halaman = 'Kustomer';
include 'hak_akses.php';
include 'header.php';
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Detail Customer</h1>
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <form action='../action/aktifkan.php' method='post' id="my_form">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
          <!-- DataTales Example -->
            				<?php
                    if(isset($_SESSION['langgar'])){
                      if($_SESSION['langgar']=='nerobos'){
                      echo '<div class="alert alert-warning alert-dismissible fade show">
                              Anda tidak memiliki hak akses untuk mengubah data 
                          </div>';
                          $_SESSION['langgar']='';
                      }
                    }
            				$id = $_GET['id'];
            				$data = mysqli_query($koneksi, "SELECT nama_perusahaan,gerai, nama, email, no_telp, pass_bandara, foto, status, id_pass_bandara from tb_customer where tb_customer.id_customer ='$id'") or die(mysqli_error($koneksi));
            				$cek = mysqli_num_rows($data);
							if($cek > 0){
								$row = mysqli_fetch_assoc($data);
                echo "
                    <div class='row'>
                      <div class='col-lg-12'>
                        <div class='row mb-2'>
                          <!-- Default Card Example -->
                            <label class='col-lg-4'>
                              Nama Perusahaan
                            </label>
                            <div class='col-lg-8'>
                                <input type='text' class='form-control' disabled value='".$row['nama_perusahaan']."'>
                            </div>
                        </div>
                        <div class='row mb-2'>
                          <!-- Default Card Example -->
                            <label class='col-lg-4'>
                              Gerai
                            </label>
                            <div class='col-lg-8'>
                                <input type='text' class='form-control' disabled value='".$row['gerai']."'>
                            </div>
                        </div>
                        <div class='row mb-2'>
                          <!-- Default Card Example -->
                            <label class='col-lg-4'>
                              Nama
                            </label>
                            
                            <div class='col-lg-8'>
                                <input type='text' class='form-control' disabled value='".$row['nama']."'>
                            </div>
                        </div>
                        
                        <div class='row mb-2'>
                          <!-- Default Card Example -->
                            <label class='col-lg-4'>
                                Email
                            </label>
                            <div class='col-lg-8'>
                                <input type='text' class='form-control' disabled value='".$row['email']."'>
                            </div>
                        </div>
                        <div class='row mb-2'>
                          <!-- Default Card Example -->
                            <label class='col-lg-4'>
                              No Telpon
                            </label>
                            <div class='col-lg-8'>
                                <input type='text' class='form-control' disabled value='".$row['no_telp']."'>
                            </div>
                        </div>
                        <div class='row mb-2'>
                          <!-- Default Card Example -->
                            <label class='col-lg-4'>
                              Id Sisi Darat
                            </label>
                            <div class='col-lg-8'>
                                <input type='text' class='form-control' disabled value='".$row['id_pass_bandara']."'>
                            </div>
                        </div>
                    </div>
                    </div>
                        <div class='col-lg-12'>
                            <div class='row'>
                                <div class='col-lg-8 offset-4'>
                                  <!-- Default Card Example -->
                                  <div class='card mb-4'>
                                    <div class='card-header'>
                                      Foto
                                    </div>
                                    <div class='card-body'>
                                    <a href='../gambar/foto/"
                                    .$row['foto'].
                                    "' target='_blank'>
                                      <img src='../gambar/foto/"
                                      .$row['foto'].
                                      "' style='width:50%;height:auto;'>
                                    </a>
                                    </div>
                                  </div>
                                </div>
                            </div>";
                            if($row['pass_bandara']){
                                echo"
                            <div class='row'>
                                <div class='col-lg-8 offset-4'>
                                  <!-- Default Card Example -->
                                  <div class='card mb-4'>
                                    <div class='card-header'>
                                      Pass Bandara
                                    </div>
                                    <div class='card-body'>
                                    <a href='../gambar/bypass/"
                                    .$row['pass_bandara'].
                                    "' target='_blank'>
                                      <img src='../gambar/bypass/"
                                      .$row['pass_bandara'].
                                      "' style='width:50%;height:auto;'>
                                    </a>
                                    </div>
                                  </div>
                                </div>
                            </div>";
                            }
                            echo"
                        </div>
                      </div>";
/*                      <div class='col-lg-6'>
                        <ul class='list-group'>
                          <li class='list-group-item active' aria-disabled='true'>Data Kontrak PT</li>
                          <li class='list-group-item'>Dapibus ac facilisis in</li>
                          <li class='list-group-item'>Morbi leo risus</li>
                          <li class='list-group-item'>Porta ac consectetur ac</li>
                          <li class='list-group-item'>Vestibulum at eros</li>
                        </ul>
                      </div>    
                    </div>*/
            	} else {
            		echo"<tr>
            			<td><label>Data tidak Ditemukan</label></td>
            		</tr>";
            	}
            	?>
                  </table>
                  <?php 
                    echo "<input type='hidden' value = '$id' name='id'>";
                  
                      if($_SESSION['hak_akses']=='Super Admin'&& $row['status'] =='0'){
            echo "<a href='javascript:{}' onclick='lakukan()'.submit();' type='submit' value='Tambah' class='btn btn-info btn-icon-split float-right'>
                    <span class='icon text-white-50'>
                      <i class='fas fa-check'></i>
                    </span>
                    <span class='text'>Aktifkan</span>
                  </a>
                  ";
                    }
                  ?>
              </form>
            </div>
          </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <script type="text/javascript">
        function lakukan(){
          //fungsi submit pada tag a
          document.getElementById('my_form').submit();
        }
      </script>
      <!-- End of Main Content -->
<?php include 'footer.php';
?>