<?php 
include 'header.php';
$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT id_departemen, tb_aduan.id_unit, pelapor, perihal, ket,foto, status FROM tb_aduan inner join tb_unit on tb_unit.id_unit = tb_aduan.id_unit WHERE id_aduan ='".$id."'") or die(mysqli_error($koneksi));
$data = mysqli_fetch_array($data, MYSQLI_NUM);
$id_departemen = $data[0];
$id_unit = $data[1];  
$pelapor = $data[2];
$perihal = $data[3];
$keterangan= $data[4];
$foto= $data[5];
$status = $data[6];
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Edit Aduan</h1>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
            	<form action="../action/edit_aduan.php" id="my_form" method="post" enctype="multipart/form-data">
            		<table class="table" id="dataTable" width="100%" cellspacing="0">
                  <tbody>
            				<tr>
            					<td><label>Departemen</label></td>
            					<td><label>:</label></td>
            					<td>
                        <select name="Departemen" class="form-control departemen" id="departemen" required>
                          <?php
                            $departemen = mysqli_query($koneksi, "Select * from tb_departemen");
                            foreach($departemen as $row){
                              if($row['id_departemen']==$id_departemen){
                                echo "<option value='".$row['id_departemen']."' selected>".$row['Departemen']."</option>";
                              } else{
                                echo "<option value='".$row['id_departemen']."'>".$row['Departemen']."</option>";
                              }
                            }
                          ?>
                        </select>
                      </td>
            				</tr>
                    <tr>
                      
                    </tr>
                    <tr>
                      <div class="row">
                      <div class="col-lg-3">
                      <td><label>Unit</label></td>
                      </div>
                      <div class="col-lg-3">
                      <td><label>:</label></td></div>
                      <div class="col-lg-6">
                      <td>
                        <select name="unit" class="form-control unit" id="unit" required>
                       "departemen">
                          <?php
                            $departemen = mysqli_query($koneksi, "SELECT * FROM tb_unit where id_departemen='$id_departemen'");
                            foreach($departemen as $row){
                              if($row['id_unit']==$id_unit){
                                echo "<option value='".$row['unit']."' selected>".$row['nama_unit']."</option>";
                              } else{
                                echo "<option value='".$row['id_unit']."'>".$row['nama_unit']."</option>";
                              }
                            }
                          ?>
                        </select>
                      </td>
                    </div>
                    </tr>
            				<tr>
                      <div class="row">
                      <div class="col-lg-3">
                      <td><label>Pelapor</label></td>
                      </div>
                      <div class="col-lg-3">
                      <td><label>:</label></td></div>
                      <div class="col-lg-6">
                      <td><input type="text" class="form-control unit" name="pelapor" required value=<?php echo "'".$pelapor."'";?>></td></div>
                    </tr>
                    <tr>
                      <div class="row">
                      <div class="col-lg-3">
                      <td><label>Perihal</label></td>
                      </div>
                      <div class="col-lg-3">
                      <td><label>:</label></td></div>
                      <div class="col-lg-6">
                      <td><input type="text" class="form-control unit" name="perihal" required value=<?php echo "'".$perihal."'";?>></td></div>
                    </tr>
                    <tr>
                      <div class="row">
                      <div class="col-lg-3">
                      <td><label>Keterangan</label></td>
                      </div>
                      <div class="col-lg-3">
                      <td><label>:</label></td></div>
                      <div class="col-lg-6">
                      <td><input type="text" class="form-control unit" name="Keterangan" required value=<?php echo "'".$keterangan."'";?>></td></div>
                    </tr>
                    
                    <tr>
                      <div class="row">
                      <div class="col-lg-3">
                      <td><label>Foto</label></td>
                      </div>
                      <div class="col-lg-3">
                      <td><label>:</label></td></div>
                      <div class="col-lg-6">
                      <td><input type="file" name="Bukti" id="foto" style='vertical-align: top;'><img id='gambar' src=<?php echo "'../gambar/aduan/".$foto."'"; ?> height=250px ></td>
                      </div>
                      </div>
                    </tr><tr>
                      <td colspan="3">
                        <button type="submit" class="btn btn-primary float-right">Simpan</button>
                      </td>
                    </tr>
                    <input type="hidden" name ="id" value=<?php echo '"'.$id.'"';?>>
                    <input type="hidden" name="status" value=<?php echo '"'.$status.'"';?>>
            			</tbody>
            		</table>
            	</form>
            </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <script type="text/javascript">
    function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#gambar').attr('src', e.target.result).fadeIn('slow');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    $(document).ready(function() {
      $('#foto').change(function(){
        readURL(this);
      });
      $("#departemen" ) .change(function () {    
      var data = $('#my_form').serialize();
      $.ajax({
        type: 'POST',
        url: "../action/unit.php",
        data: data,
        success: function(response) {
          $("#unit").html(response) ;
        }
      }); 
      });  
    });
      </script>
      <!-- End of Main Content -->
<?php include 'footer.php';
?>