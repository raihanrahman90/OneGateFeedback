
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="../action/logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <div id="loader"></div>
  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../assets/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script>
        var spinner = $('#loader');
        

        $('form').submit(function(e) {
          $('button[type="submit"]').attr('disabled',true)
          $('button[type="submit"]').html("Mohon Tunggu")
        });
      $(document).ready(function(){
        
        if($('#dataTable').length){
          $('#dataTable thead tr').clone(true).appendTo( '#dataTable thead' );
          var column_count = $("table > tbody > tr:first > td").length
          $('#dataTable thead tr:eq(1) th').each( function (i) {
              if(i<column_count-1){
                var title = $(this).text();
                $(this).html( '<input type="text" placeholder="Search '+title+'" style="width:100%;" />' );
        
                $( 'input', this ).on( 'keyup change', function () {
                    if ( table.column(i).search() !== this.value ) {
                        table
                            .column(i)
                            .search( this.value )
                            .draw();
                    }
                } );
              }else{
                $(this).html( '' );
              }
          } );
          var table = $('#dataTable').DataTable( {
            orderCellsTop: true,
            fixedHeader: true
            <?php 
              if($halaman=='aduan'){
                echo ",'order':[[5]]";
              }
            ?>
        } );
        }
          /**Mengecek jumlah data yang akan ditampilkan di sidebar */
          $('#notifCustomer').load("notifCustomer.php");
          $('#notifRequest').load("notifRequest.php");
          $('#notifFeedback').load("notifFeedback.php");
          /**menghilangkan required pada tindakan jika status adalah progres */
          $('#tindakan-progres').change(
            ()=>{
              if($(this).val()=='Yes'){
                $('#bukti').prop('required', true)
              }else{
                $('#bukti').prop('required', false)
              }
            }
          )
          $('#tindakan-complete').change(
            ()=>{
              if($(this).val()=='Yes'){
                $('#bukti').prop('required', false)
              }else{
                $('#bukti').prop('required', true)
              }
            }
          )
          <?php
            if($_SESSION['hak_akses']!='Unit'){
              echo "
                $('#notifPenilaian').load('notifPenilaian.php');
                setInterval(function(){
                  $('#notifPenilaian').load('notifPenilaian.php');
                },30000);
              ";
            }
          ?>
          /**Mengecek jumlah data yang akan ditampilkan di sidebar */
          /**Mengecek Ulang data setiap 30 detik*/
          setInterval(function(){
              $('#notifCustomer').load("notifCustomer.php");
          }, 15000);          
          setInterval(function(){
              $('#notifRequest').load("notifRequest.php");
          }, 15000);    
          setInterval(function(){
              $('#notifFeedback').load("notifFeedback.php");
          }, 15000);
          /**Mengecek Ulang data setiap 30 detik*/

      })
  </script>

</body>

</html>
