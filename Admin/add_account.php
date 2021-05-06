<?php
$halaman = 'Akun';
include 'hak_akses.php';
include 'super_admin.php';
include 'header.php';
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Tambah Akun</h1>
          <!-- DataTales Example -->
          <?php 
                      if(isset($_SESSION['status_jalan'])){
                        if($_SESSION['status_jalan'] == "Email telah digunakan"){
                        echo '<div class="alert alert-warning alert-dismissible fade show">
                              Email telah digunakan
                          </div>';
                          $_SESSION['status_jalan'] = "";
                        }
                      }
                    ?>
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
              <form action="../action/add_account.php" id="my_form" method="post" onsubmit="return validasi();">
                <table class="table" id="" width="100%" cellspacing="0">
                  <tbody>
                    <tr>
                      <td><label>Hak Akses</label></td>
                      <td><label>:</label></td>
                      <td>
                        <select name="hak_akses" class="form-control" id="hak_akses" required>
                          <option value='Super Admin'>Super Admin</option>
                          <option value='Admin1'>Admin 1</option>
                          <option value='Admin2'>Admin 2</option>
                          <option value='Pengawas Internal'>Pengawas Internal</option>
                          <option value='Unit' selected>Unit</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td><label>Status</label></td>
                      <td><label>:</label></td>
                      <td>
                        <select name="status" class="form-control" id="status" required>
                          <option value='Unit' selected>Unit</option>
                          <option value='Manager'>Manager</option>
                          <option value='Senior Manager'>Senior Manager</option>
                          <option value='AOC Head'>AOC Head</option>
                          <option value='General Manager'>General Manager</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                    <td><label>Departemen</label></td>
                    <td><label>:</label></td>
                    <td>
                        <select name="departemen" class="form-control departemen" id="departemen" required>
                          <?php
                            $departemen = mysqli_query($koneksi, "Select * from tb_departemen");
                            foreach($departemen as $row){
                              echo "<option value='".$row['id_departemen']."'>".$row['Departemen']."</option>";
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
                        <select name="unit" class="form-control unit" id="unit" required>
                       "departemen">
                          <?php
                            $departemen = mysqli_query($koneksi, "Select * from tb_unit where id_departemen=(select id_departemen from tb_departemen LIMIT 1)");
                            foreach($departemen as $row){
                              echo "<option value='".$row['id_unit']."'>".$row['nama_unit']."</option>";
                            }
                          ?>
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
                      <td><input type="text" class="form-control" name="Nama" required></td></div>
                    </tr>
                    
                    <tr>
                      <div class="row">
                      <div class="col-lg-3">
                      <td><label>E-mail</label></td>
                      </div>
                      <div class="col-lg-3">
                      <td><label>:</label></td></div>
                      <div class="col-lg-6">
                      <td><input type="email" class="form-control" name="E-mail" id="Email"required></td></div>
                    </tr>
                    <tr>
                      <div class="row">
                      <div class="col-lg-3">
                      <td><label>No Telp</label></td>
                      </div>
                      <div class="col-lg-3">
                      <td><label>:</label></td></div>
                      <div class="col-lg-6">
                      <td><input type="text" class="form-control" name="Telp" id="Telp"required></td></div>
                    </tr>
                    
                    <tr>
                      <div class="row">
                      <div class="col-lg-3">
                      <td><label>Password Default</label></td>
                      </div>
                      <div class="col-lg-3">
                      <td><label>:</label></td></div>
                      <div class="col-lg-6">
                      <td><input type="checkbox" class="form-control-user" id="default" checked><label class="form-control-user">Password = E-mail</label></td></div>
                    </tr>
                    
                    <tr>
                      <div class="row">
                      <div class="col-lg-3">
                      <td><label>Password</label></td>
                      </div>
                      <div class="col-lg-3">
                      <td><label>:</label></td></div>
                      <div class="col-lg-6">
                      <td><input type="Password" class="form-control Password" id="Password1" name="password" required readonly></td></div>
                    </tr>
                    
                    <tr>
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
                        <button type="submit" class="btn btn-info float-right">Tambah</button>        
                      </td>
                    </tr>
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

    $(document).ready(function() {
      $("#status" ) .change(function () {
      var data = $('#my_form').serialize();
      $.ajax({
        type: 'POST',
        url: "../action/options_hak_akses.php",
        data: data,
        success: function(response) {
          $("#departemen").html(response);
          if($("#departemen").val()=='0'){
            $("#unit").html(response);
          } else {
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
      });
      $("#departemen" ) .change(function () {    
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
      $("#default" ).change(function () {
        if(this.checked){
          $(".Password").prop("readonly", true);
          $(".Password").val($("#Email").val());
        } else {
          $(".Password").prop("readonly", false);
        }
      });
      $("#Email" ).change(function () {
        if($("#default").val()=='on'){
          $(".Password").val($("#Email" ).val());
        }
      });  
    });
      </script>
      <!-- End of Main Content -->
<?php include 'footer.php';
?>