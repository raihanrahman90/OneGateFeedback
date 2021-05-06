<?php 
    $halaman = 'Request';
    include 'hak_akses.php';
    include 'admin1.php';
    include 'header.php';
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Detail Request</h1>
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="" width="100%" cellspacing="0">
          <!-- DataTales Example -->
            				<?php
            				$id_aduan = $_GET['id'];
            				$data = mysqli_query($koneksi, "SELECT pelapor, Nama,no_telp, email,jenis, perihal, ket, tb_aduan.foto, tb_aduan.status, nama_lokasi, nama_detail_lokasi from tb_aduan 
            				    left join tb_customer ON tb_aduan.id_customer=tb_customer.id_customer
            					where tb_aduan.id_aduan ='$id_aduan' ") or die(mysqli_error($koneksi));
            				$cek = mysqli_num_rows($data);
							if($cek > 0){
								$row = mysqli_fetch_assoc($data);
				
				if($row['Nama']==NULL){
          /**Kodisi Nama Tidak ditemukan */
				    echo "
				    <div class='row mb-2'>
				      <div class='col-lg-4'>
				        <label>Pelapor<label>
                      </div>
                      <div class='col-lg-8'>
                        <input type='text' class='form-control' disabled value='".$row['pelapor']."'></input>
                      </div>
                    </div>
                      ";
                      
          /**Akhir Kodisi Nama Tidak ditemukan */
				}else{
          
          /**Kodisi Nama ditemukan */
				    echo "
				    <div class='row mb-2'>
				      <div class='col-lg-4'>
				        <label>Nama<label>
                      </div>
                      <div class='col-lg-8'>
                        <input type='text' class='form-control' disabled value='".$row['Nama']."'></input>
                      </div>
                    </div>
				    <div class='row mb-2'>
				      <div class='col-lg-4'>
				        <label>No Telp<label>
                      </div>
                      <div class='col-lg-8'>
                        <input type='text' class='form-control' disabled value='".$row['no_telp']."'></input>
                      </div>
                    </div>
				    <div class='row mb-2'>
				      <div class='col-lg-4'>
				        <label>Email<label>
                      </div>
                      <div class='col-lg-8'>
                        <input type='text' class='form-control' disabled value='".$row['email']."'></input>
                      </div>
                    </div>
                      ";
          /**Akhir Kodisi Nama ditemukan */
				}
                echo "

				    <div class='row mb-2'>
				      <div class='col-lg-4'>
				        <label>Jenis Feedback<label>
                      </div>
                      <div class='col-lg-8'>
                        <input type='text' class='form-control' disabled value='".$row['jenis']."'></input>
                      </div>
                    </div>
				    <div class='row mb-2'>
				      <div class='col-lg-4'>
				        <label>Perihal<label>
                      </div>
                      <div class='col-lg-8'>
                        <input type='text' class='form-control' disabled value='".$row['perihal']."'></input>
                      </div>
                    </div>
				    <div class='row mb-2'>
				      <div class='col-lg-4'>
				        <label>Lokasi<label>
                      </div>
                      <div class='col-lg-8'>
                        <input type='text' class='form-control' disabled value='";
                        
                          if(isset($row["nama_lokasi"])){
                              echo $row["nama_lokasi"];
                          }else{
                              echo "Lokasi sudah dihapus dari database";
                          }
                        echo "'></input>
                      </div>
                    </div> 
                    <div class='row mb-2'>
				      <div class='col-lg-4'>
				        <label>Detail Lokasi<label>
                      </div>
                      <div class='col-lg-8'>
                        <input type='text' class='form-control' disabled value='";
                        
                          if(isset($row["nama_detail_lokasi"])){
                              echo $row["nama_detail_lokasi"];
                          }else{
                              echo "Lokasi sudah dihapus dari database";
                          }
                        echo "'></input>
                      </div>
                    </div>                  
				    <div class='row mb-2'>
				      <div class='col-lg-4'>
				        <label>Keterangan<label>
                      </div>
                      <div class='col-lg-8'>
                        <textarea class='form-control' disabled rows=8>".$row['ket']."</textarea>
                      </div>
                    </div>";
                    /**Menampilkan keterangan returned jika status Returned */
                      if($row["status"]=="Returned"){
                          $keterangan_kembali = mysqli_query($koneksi, "SELECT * from tb_progress where id_aduan = '$id_aduan' Order by id_progress DESC");
                          if($keterangan_kembali_row = mysqli_fetch_array($keterangan_kembali)){
                              echo"                  
                                    <div class='row mb-2 2'>
                				      <div class='col-lg-4'>
                				        <label>Keterangan Return<label>
                                      </div>
                                      <div class='col-lg-8'>
                                        <input type='text' class='form-control' disabled value='".$keterangan_kembali_row['tindakan']."'></input>
                                      </div>
                                    </div>";
                          }
                      }
                      
                    /**Akhir Menampilkan keterangan returned jika status Returned */
                    
                    /**Menampilkan Foto jika tidak null */
                      if($row["foto"]!=NULL){
                        echo"
                        <div class='row mb-2'>
                          <div class='col-lg-8 offset-4'>
                            <!-- Default Card Example -->
                            <div class='card mb-4'>
                              <div class='card-header'>
                                Foto
                              </div>
                              <div class='card-body'>
                                  <a href='../gambar/aduan/"
                                      .$row["foto"]."
                                      '>
                                      <img src='../gambar/aduan/"
                                      .$row["foto"].
                                      "' height=200px width='auto'>
                                  </a>
                              </div>
                            </div>
                          </div>
                        </div>
                        ";
                      }
                    /**Akhir Menampilkan Foto jika tidak null */
                      echo "
                      <button type='button' data-toggle='modal' data-target='#lihatketeranganModal' style='margin-left:10px;' class='btn btn-primary btn-icon-split float-right' >
                        <span class='icon text-white-50'>
                          <i class='fas fa-eye'></i>
                        </span>
                        <span class='text'>Lihat Keterangan Tambahan</span>
                      </button>
                      <!-- Logout Modal-->
                      <div class='modal fade' id='lihatketeranganModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                        <div class='modal-dialog' role='document'>
                          <div class='modal-content'>
                            <div class='modal-header'>
                              <h5 class='modal-title' id='kembaliModalLabel'>Keterangan Tambahan</h5>
                              <button class='close' type='button' data-dismiss='modal' aria-label='Close'>
                                <span aria-hidden='true'>×</span>
                              </button>
                            </div>
                              <div class='modal-body'>";
                             $keterangan_tambahan = mysqli_query($koneksi, "SELECT * from tb_keterangan_tambahan
                                  inner join tb_aduan on tb_keterangan_tambahan.id_aduan = tb_aduan.id_aduan
                                  where tb_aduan.id_aduan = '$id_aduan'") or die(mysqli_error($koneksi));
                                    if(mysqli_num_rows($keterangan_tambahan)==0){
                                      /** Kondisi tidak ada keterangan tambahan */
                                      echo '<div class="alert alert-warning alert-dismissible fade show">
                                              Tidak ditemukan keterangan tambahan
                                          </div>';   
                                        /** Akhir kondisi tidak ada keterangan tambahan */
                                    }else{
                                        /**Kondisi ada keterangan tambahan */
                                        while($row1 = mysqli_fetch_array($keterangan_tambahan)){
                                          echo "
                                          <div class='row mb-2'>
                                            <div class='col-lg-12'>
                                                <!-- Default Card Example -->
                                                <div class='card mb-4'>
                                                  <div class='card-header'>
                                                    ".$row1["pertanyaan"]."
                                                  </div>
                                                  <div class='card-body'>
                                                  ";
                                                  
                                                    if($row1['bukti']) echo "<a href='../gambar/keterangan_tambahan/".$row1['bukti']."' class='pull-right'>Lihat gambar</a> <br>";
                                                  if($row1["jawaban"]){
                                                      echo $row1['jawaban'];
                                                  } else {
                                                      echo 'Belum menerima jawaban';
                                                  }
                                                  echo"
                                                  </div>
                                                </div>
                                              </div>
                                            </div>";
                                        }
                                        /**Akhir Kondisi ada keterangan tambahan */
                                    }
                             echo"</div>
                                    <div class='modal-footer'>
                                        <button class='btn btn-secondary' type='button' data-dismiss='modal'>Keluar</button>
                                    </div>
                                </div>
                            </div>
                        </div>";
                      if(($_SESSION['hak_akses']=='Super Admin'||$_SESSION['hak_akses']=='Admin1')&& ($row["status"] =='Request' || $row["status"]=="Returned")){
                      /**Menampilkan Minta keterangan Tambahan dan Terukan ke unit */
                  echo "
                  <a href='#' data-toggle='modal' data-target='#kembaliModal' class='btn btn-info btn-icon-split float-right' >
                    <span class='icon text-white-50'>
                      <i class='fas fa-reply'></i>
                    </span>
                    <span class='text'>Teruskan ke Unit</span>
                  </a>
                  <div class='modal fade' id='kembaliModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                      <div class='modal-content'>
                        <div class='modal-header'>
                          <h5 class='modal-title' id='kembaliModalLabel'>Teruskan ke Unit</h5>
                          <button class='close' type='button' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>×</span>
                          </button>
                        </div>
                        <form action='../action/teruskan.php' method='post' id='my_form'>
                          <div class='modal-body'>
                            <label>Pilih Departemen.</label>
                            <select name='Departemen' class='form-control departemen' id='departemen' required>";
                            $departemen = mysqli_query($koneksi, "Select * from tb_departemen");
                            foreach($departemen as $row){
                              echo "<option value='".$row['id_departemen']."'>".$row['Departemen']."</option>";
                            }
                        echo"</select>
                        <label>Pilih Unit.</label>
                            <select name='unit' class='form-control unit' id='unit' required>";
                            $departemen = mysqli_query($koneksi, "Select * from tb_unit where id_departemen=(select id_departemen from tb_departemen LIMIT 1)");
                            foreach($departemen as $row){
                              echo "<option value='".$row['id_unit']."'>".$row['nama_unit']."</option>";
                            }
                        echo"</select>
                          </div>
                          <div class='modal-footer'>
                            <button class='btn btn-secondary' type='button' data-dismiss='modal'>Batal</button>
                            <button class='btn btn-info' type='submit'>Kirim</a>
                          </div>
                          <input type='hidden' value='".$_GET['id']."' name='id'>
                        </form>
                      </div>
                    </div>
                  </div>
                  <a href='#' data-toggle='modal' data-target='#keteranganModal' style='margin-right:10px;' class='btn btn-primary btn-icon-split float-right' >
                    <span class='icon text-white-50'>
                      <i class='fas fa-plus'></i>
                    </span>
                    <span class='text'>Minta Keterangan Tambahan</span>
                  </a>
                  <div class='modal fade' id='keteranganModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                      <div class='modal-content'>
                        <div class='modal-header'>
                          <h5 class='modal-title' id='kembaliModalLabel'>Keterangan Tambahan</h5>
                          <button class='close' type='button' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>×</span>
                          </button>
                        </div>
                        <form action='../action/add_keterangan_tambahan.php' method='post' id='my_form'>
                          <div class='modal-body'>
                            <label>Masukkan Keterangan yang anda butuhkan</label>
                            <input type='text' name='pertanyaan' class='form-control'>
                          </div>
                          <div class='modal-footer'>
                            <button class='btn btn-secondary' type='button' data-dismiss='modal'>Batal</button>
                            <button class='btn btn-info' type='submit'>Kirim</a>
                          </div>
                          <input type='hidden' value='".$_GET['id']."' name='id'>
                        </form>
                      </div>
                    </div>
                  </div>";
                      /**Menampilkan Minta keterangan Tambahan dan Terukan ke unit */

                    }
              } else {
                /** Data tidak ditemukan */
                echo"<tr>
                  <td><label>Data tidak Ditemukan</label></td>
                </tr>";
                /** AKhir data tidak ditemukan */
              }
            				?>
                    <tbody>
                  </table>
            </div>
          </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <script type="text/javascript">
        $(document).ready(function() {
        $("#departemen" ) .change(function () {  
          /**Merefresh isi pilihan unit ketika departemen diganti */  
        var data = $('#my_form').serialize();
        $.ajax({
          type: 'POST',
          url: "../action/unit_keluhan.php",
          data: data,
          success: function(response) {
            $("#unit").html(response) ;
          }
        }); 
        });
        /**Akhir Merefresh isi pilihan unit ketika departemen diganti */
      });
      </script>
      <!-- End of Main Content -->
<?php include 'footer.php';
?>