<?php 

$halaman ='Departemen';
include 'hak_akses.php';
include 'super_admin.php';
include 'header.php';
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Tambah Unit</h1>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
            	<form action="../action/add_unit.php" id="my_form" method="post">
            		<table class="table" width="100%" cellspacing="0">
                        <thead>
                		    <tr>
                				<td><label>Unit</label></td>
                				<td><label>:</label></td>
                				<td colspan="3"><input type="text" name="unit" class="form-control form-control-user" required></td>
            		            <input type="hidden" name="id" value=<?php echo '"'.$_GET['id'].'"';?> >
            				</tr>
                        </thead>
                	
                        <tfoot>
                            <tr>
                              <td colspan="4">
                                <button type="submit" value="Tambah" class="btn btn-primary btn-icon-split float-right">
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
          "<tr id='input_text"+total_text+"_wrapper'><td><label>Nama unit</label></td><td><input name='unit[]' type='text' class='input_text form-control form-control-user' id='input_text"+total_text+"' placeholder='Enter Text'></td><td>:</td><td><input type='button' value='Remove' onclick=remove_field('input_text"+total_text+"');></td></tr>";
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