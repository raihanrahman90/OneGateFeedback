<?php 

include 'hak_akses.php';
include 'super_admin.php';
include 'header.php';
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Tambah Lokasi</h1>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                	<form action="../action/add_lokasi.php" id="my_form" method="post">
                	    <table class="table" width="100%" cellspacing="0">
                            <thead>
                        		<tr>
                        			<td><label>Lokasi</label></td>
                        			<td><label>:</label></td>
                    				<td colspan="3"><input type="text" name="nama_lokasi" class="form-control form-control-user" required></td>
                        	    </tr>
                            </thead>
                            <tbody id="field_div">
                          		<tr>
                        			<td><label>Lokasi Detail</label></td>
                        			<td colspan="3"><input type="button" value="Tambah Detail" onclick="add_field();"></td>
                        		</tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                  <td colspan="4">
                                    <button type="submit" value="Tambah" class="btn btn-info btn-icon-split float-right">
                                      <span class="icon text-white-50">
                                        <i class="fas fa-plus"></i>
                                      </span>
                                      <span class="text">Tambah</span>
                                    </button>                   
                                  </td>
                                </tr>
                            </tfoot>
                		</table>
                	</form>
                </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <script>
        function add_field()
        {
          var total_text=document.getElementsByClassName("input_text");
          total_text=total_text.length+1;
          document.getElementById("field_div").innerHTML=document.getElementById("field_div").innerHTML+
          "<tr id='input_text"+total_text+"_wrapper'><td><label>Lokasi Detail</label></td><td><input name='detail[]' type='text' class='input_text form-control form-control-user' id='input_text"+total_text+"' placeholder='Enter Text'></td><td>:</td><td><input type='button' value='Remove' onclick=remove_field('input_text"+total_text+"');></td></tr>";
        }
        function remove_field(id)
        {
          var div = document.getElementById(id+"_wrapper");
          div.parentNode.removeChild(div);
        }
        </script>
      <!-- End of Main Content -->
<?php include 'footer.php';
?>