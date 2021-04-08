<?php 
$halaman ='Lokasi';
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
      <!-- End of Main Content -->
<?php include 'footer.php';
?>