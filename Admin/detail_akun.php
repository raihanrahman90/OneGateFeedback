<?php 

$halaman = 'akun';
include 'hak_akses.php';
include 'header.php';
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Detail Akun</h1>
          <!-- DataTales Example -->
          <?php 
          $id_akun = $_GET['id'];
                $status = mysqli_query($koneksi, "SELECT status from tb_akun where Id_akun ='$id_akun'");
                $status = mysqli_fetch_array($status);
                $status = $status['status'];
                if($status == 'Manager' || $status =='Unit'){
                      $data = mysqli_query($koneksi, "SELECT Nama, tb_departemen.id_departemen, tb_unit.id_unit, status,hak_akses, Email, Id_akun, No_Telp, nama_unit, Departemen FROM tb_akun left join tb_unit on tb_unit.id_unit = tb_akun.id_unit left join tb_departemen on tb_departemen.id_departemen = tb_unit.id_departemen WHERE id_akun ='$id_akun'") or die(mysqli_error($koneksi));
                        $data =  mysqli_fetch_array($data);
                } else if($status=='Senior Manager'){
                    $data = mysqli_query($koneksi, "SELECT tb_akun.*, Departemen FROM tb_akun inner join tb_departemen on tb_departemen.id_departemen = tb_akun.id_departemen left join tb_unit on tb_unit.id_unit = tb_akun.id_unit WHERE id_akun ='$id_akun'") or die(mysqli_error($koneksi));
                      $data =  mysqli_fetch_array($data);
                } else {
                    $data = mysqli_query($koneksi, "SELECT * FROM tb_akun left join tb_departemen on tb_departemen.id_departemen = tb_akun.id_departemen left join tb_unit on tb_unit.id_unit = tb_akun.id_unit WHERE id_akun ='$id_akun'") or die(mysqli_error($koneksi));
                    $data =  mysqli_fetch_array($data);
                }
          ?>
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
              <form action="../action/edit_account.php" id="my_form" method="post" onsubmit="return validasi();">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                  <tbody>
                      <?php
                      if(isset($_SESSION['status_jalan'])){
                          if($_SESSION['status_jalan']=="Email telah digunakan"){
                              echo'
                              <tr>
                                  <td colspan="3">
                                    <div class="alert alert-info alert-dismissible">
                                        Maaf, Email yang anda masukkan telah digunakan oleh akun lain
                                    </div>
                                  </td>
                              </tr>
                              ';
                              $_SESSION['status_jalan']="";
                          }
                      }
                      ?>
                     <tr>
                        <td><label>Hak Akses</label></td>
                        <td><label>:</label></td>
                        <td>
                            <select name="hak_akses" class="form-control edit" id="hak_akses" required disabled>
                                <?php
                          $status = array('Super Admin','Admin1','Admin2','Unit');
                          foreach($status as $row){
                            if($row == $data['hak_akses']){
                              echo "<option value='".$row."' selected>".$row."</option>";
                            } else {
                              echo "<option value='".$row."'>".$row."</option>";
                            }
                          }?>
                            </select>
                        </td>
                     </tr>
                    <tr>
                      <td><label>Status</label></td>
                      <td><label>:</label></td>
                      <td>
                        <select name="status" class="form-control edit" id="status" required disabled>
                          <?php
                          $status = array('Unit','Manager','Senior Manager','AOC Head','General Manager');
                          foreach($status as $row){
                            if($row == $data['status']){
                              echo "<option value='".$row."' selected>".$row."</option>";
                            } else {
                              echo "<option value='".$row."'>".$row."</option>";
                            }
                          }
                          ?>
                        </select>
                      </td>
                    </tr>
                    <tr><td><label>Departemen</label></td>
                    <td><label>:</label></td>
                    <td>
                        <select name='departemen' class='form-control departemen  edit' id='departemen' required disabled>
                        <option value=''></option>
                        <?php
                         if($data['status']=='Unit' || $data['status']=='Manager'|| $data['status']=='Senior Manager'){
                            $departemen = mysqli_query($koneksi, "Select * from tb_departemen");
                            foreach($departemen as $row_departemen){
                              if($row_departemen['id_departemen']==$data['id_departemen']){
                                echo "<option value='".$row_departemen['id_departemen']."' selected>".$row_departemen['Departemen']."</option>";
                              } else {
                                echo "<option value='".$row_departemen['id_departemen']."'>".$row_departemen['Departemen']."</option>";

                              }
                            }
                         }else {
                                echo"<option value='0' selected>--</option>";
                            }
                        ?>
                        </select>
                      </td>
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
                        <select name="unit" class="form-control unit  edit" id="unit" required disabled>
                        <?php
                        if($data['status']=='Unit' || $data['status']=='Manager'){
                            if($data['id_departemen']!=null){
                                $departemen = mysqli_query($koneksi, "Select * from tb_unit where id_departemen='".$data['id_departemen']."'");
                                foreach($departemen as $row){
                                  if($row['id_unit']==$data['id_unit']){
                                    echo "<option value='".$row['id_unit']."' selected>".$row['nama_unit']."</option>";
                                  } else {
                                    echo "<option value='".$row['id_unit']."'>".$row['nama_unit']."</option>";
    
                                  } 
                                }
                            }
                        } else if($data['status']=='Senior Manager'){
                                echo"<option value='0'>".$data['Departemen']."</option>";
                            } else{
                                echo"<option value='0'>--</option>"  ;
                            }?>
                        </select>
                      </td>
                    </div>
                    </tr>
                    <tr>
                      <div class="row">
                      <div class="col-lg-3">
                      <td><label>Nama</label></td>
                      </div>
                      <div class="col-lg-3">
                      <td><label>:</label></td></div>
                      <div class="col-lg-6">
                      <td><input type="text" class="form-control  edit" name="Nama" value=<?php echo "'".$data['Nama']."'";?> required disabled></td></div>
                    </tr>
                    
                    <tr>
                      <div class="row">
                      <div class="col-lg-3">
                      <td><label>E-mail</label></td>
                      </div>
                      <div class="col-lg-3">
                      <td><label>:</label></td></div>
                      <div class="col-lg-6">
                      <td><input type="email" class="form-control edit" name="E-mail" id="Email"  value=<?php echo "'".$data['Email']."'";?> required disabled></td></div>
                    </tr>
                    <tr>
                      <div class="row">
                      <div class="col-lg-3">
                      <td><label>No Telp</label></td>
                      </div>
                      <div class="col-lg-3">
                      <td><label>:</label></td></div>
                      <div class="col-lg-6">
                      <td><input type="text" class="form-control edit" name="Telp" id="Telp"  value=<?php echo "'".$data['No_Telp']."'";?>required disabled></td></div>
                    </tr>
                    
                    <tr hidden class='row_default'>
                      <td><label>Ubah Password</label></td>
                      </div>
                      <div class="col-lg-3">
                      <td><label>:</label></td></div>
                      <div class="col-lg-6">
                      <td><input type="checkbox" class="form-control-user" id="default" name="default"><label class="form-control-user"></label>
                    </tr>
                    
                    <tr hidden class='row_default'>
                      <div class="row">
                      <div class="col-lg-3">
                      <td><label>Password</label></td>
                      </div>
                      <div class="col-lg-3">
                      <td><label>:</label></td></div>
                      <div class="col-lg-6">
                      <td><input type="Password" class="form-control Password" id="Password1" name="password" required readonly></td></div>
                    </tr>
                    
                    <tr hidden class='row_default'>
                      <div class="row">
                      <div class="col-lg-3">
                      <td><label>Ketik ulang Password</label></td>
                      </div>
                      <div class="col-lg-3">
                      <td><label>:</label></td></div>
                      <div class="col-lg-6">
                      <td><input type="Password" class="form-control Password" id="Password2" required readonly></td></div>
                    </tr>
                    <tr>
                      <td colspan="3">
                         <?php
                        if($_SESSION['hak_akses']=='Super Admin'){
                            echo '<button type="button" class="btn btn-info float-right detail btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-edit"></i>
                            </span>
                            <span class="text">
                                Edit
                            </span>
                            </button>';
                        }
                        ?>
                        <button type="submit" class="tombol-edit btn btn-info float-right btn-icon-split" hidden style='margin-left: 10px;'>
                            <span class="icon text-white-50">
                                <i class="fas fa-save"></i>
                            </span>
                            <span class="text">Simpan
                            </span>
                        </button>  
                        <button type="reset" id="batal"class="tombol-edit btn btn-warning btn-icon-split float-right" hidden>                            
                            <span class="icon text-white-50">
                                <i class="fas fa-times"></i>
                            </span>
                            <span class="text">
                                Batal
                            </span></button>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <input type="hidden" name="id_akun" value=<?php echo"'".$_GET['id']."'"; ?>>
              </form>
            </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <script type="text/javascript">
        function validasi(){
          var pass1 = document.getElementById("Password1");
          var pass2 = document.getElementById("Password2");
          if(pass1.value!=pass2.value){
            alert("Password tidak sama");
            pass1.focus();
            return false;
          } else{
            return true;
          }
        }
    function availableDepartemen(){
        ///mengambil data my_form
        var data = $('#my_form').serialize();
            ///mengirim post ke action/options_hak_akses.php untuk menentukan departemen dan unit yang tersedia
          $.ajax({
            type: 'POST',
            url: "../action/options_hak_akses.php",
            data: data,
            success: function(response) {
              $("#departemen").html(response);
              ///unit diisi dengan hak akses jika value dari departemen adalah 0
              ///value 0 terjadi jika hak akses adalah AOC Head, Senior Manager, dan manager
              if($("#departemen").val()=='0'){
                $("#unit").html(response);
              } else {
                 ///mengambil data unit berdasarkan departemen
                 $.ajax({
                  type: 'POST',
                  url: "../action/options_unit.php",
                  data: data,
                  success: function(response) {
                    $("#unit").html(response);
                  }
                }); 
              }
            }
          }); 
    }
    $(document).ready(function() {
        
        ///memanggil fungsi ketika html direload
          
      $("#status" ) .change(function () {
          ///memanggil fungsi ketika status diganti
        availableDepartemen();
      });
      
      $("#departemen" ) .change(function () {
          ///mencari unit yang tersedia pada departemen yang dipilih
      var data = $('#my_form').serialize();
      $.ajax({
        type: 'POST',
        url: "../action/options_unit.php",
        data: data,
        success: function(response) {
            $("#unit").html(response);
        }
      }); 
      });
      
      ///melakukan pergantian password atau tidak
      $("#default" ).change(function () {
        if(this.checked){
          $(".Password").prop("readonly", false);
        } else {
          $(".Password").prop("readonly", true);
        }
      });
      
      ///melakukan password=email jika element default dionkan
      $("#Email" ).change(function () {
        if($("#default").val()=='on'){
          $(".Password").val($("#Email" ).val());
        }
      });
      ///jika tombol detail diklik 
      $(".detail" ).click(function () {
        $(".edit").prop("disabled",false);
        $(".tombol-edit").prop("hidden",false);
        $(".detail").prop("hidden",true);
        $(".row_default").prop("hidden",false);
      });
      
      ///jika tombol batal diklik
      $("#batal" ).click(function () {
        $(".edit").prop("disabled",true);
        $(".tombol-edit").prop("hidden",true);
        $(".row_default").prop("hidden",true);
        $(".detail").prop("hidden",false);
      });    
    });
      </script>
      <!-- End of Main Content -->
<?php include 'footer.php';
?>