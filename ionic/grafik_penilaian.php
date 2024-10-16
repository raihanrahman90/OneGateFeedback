<?php
	include "../koneksi.php";
    if($_GET['status_akun']=='Unit'){
        $id_unit = $_GET['id_unit'];
        $id_departemen = $_GET['id_departemen'];
        $nama_unit = mysqli_query($koneksi, "SELECT nama_unit from tb_unit where id_unit=$id_unit") or die(mysqli_error($koneksi));
        $nama_unit = mysqli_fetch_array($nama_unit);
        $nama_unit = $nama_unit['nama_unit'];
        $nama_departemen = mysqli_query($koneksi, "SELECT Departemen from tb_departemen where id_departemen=$id_departemen") or die(mysqli_error($koneksi));
        $nama_departemen = mysqli_fetch_array($nama_departemen);
        $nama_departemen = $nama_departemen['Departemen'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <script type="text/javascript" src="../assets/js/Chart.js"></script>
	<script src="../assets/js/jquery.js"></script> 
	<script src="../assets/js/zoom.js"></script> 
  <title>One Gate Feedback</title>

  <!-- Custom fonts for this template -->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="../assets/css/custom.css" rel="stylesheet" type="text/css">

  <link rel="icon" href="../assets/logo.png">
  <!-- Custom styles for this page -->
  <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <script src="../vendor/jquery/jquery.min.js"></script>
  <link rel="stylesheet" href="../assets/jquery-ui/jquery-ui.min.css">
  <script src="../assets/jquery-ui/external/jquery/jquery.js"></script>
  <script src="../assets/jquery-ui/jquery-ui.min.js"></script>
</head>
<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">
        <noscript>
            <style type="text/css">
              .container-fluid{
                display:none;
              }
              .container{
                display:none;
              }
            </style>
            <div  class="alert alert-danger alert-dismissible">
              Halaman web ini membutuhkan javascript untuk bekerja dengan baik, mohon aktifkan javacript pada peramban Anda. 
            </div>
        </noscript>
    <div class='container-fluid'>
    	<h1 class="h3 mb-2 text-gray-800">Laporan Customer Service</h1>
        
        	<form id="myform" method="post">
            	<div class="card shadow mb-4 ">
        	    	<div class="card-header py-3">
                        <button class="btn btn-primary px-5" id="btn-grafik" type="button">Grafik</button>
                        <button class="btn btn-outline-primary px-5" id="btn-table" type="button">Table</button>
                        <noscript class="alert alert-danger alert-dismissible">
                            Halaman web ini membutuhkan javascript untuk bekerja dengan baik, mohon aktifkan javacript pada peramban Anda. 
                        </noscript>
                    </div>
                    <div class="card-body">
                        <div id="form-grafik">
                        
                            <div class="row">
                                <label class="col-12 col-md-2">Nilai Y</label>
                                <select id="kelompok" name='kelompok' class="col-12 col-md-1 form-control">    
                                    <option value='rata-rata' selected="true">Rata-rata</option>
                                    <option value='Nilai'>Nilai</option>
                                </select>
                                <label class="col-12 col-md-2">Periode</label>
                                <select id="rentang" name='rentang' class="col-12 col-md-1 form-control">    
                                    <option value='Tahun' selected="true">Tahun</option>
                                    <option value='Bulan'>Bulan</option>
                                    <option value='Hari'>Hari</option>
                                </select>
                                <select id="jenis" name='jenis' class="col-12 col-md-1 form-control">    
                                    <option value='line' selected="true">Line</option>
                                    <option value='bar'>Bar</option>
                                </select>
                            </div>
                        <div id="form_departemen" class="row">
                        <label class="col-12 col-md-2">Kelompokkan berdasarkan</label>
                	    	<select id="departemen" name='departemen' class="col-12 col-md-1 form-control ">
                                <?php   
                                    echo 
                                    "<option value='all' selected='true'>All</option>  
                                    <option value='departemen'>Berdasarkan departemen</option>";
                                    $query = mysqli_query($koneksi, "SELECT * FROM tb_departemen");
                                    foreach($query as $departemen){
                                        echo"<option value='".$departemen['id_departemen']."'>".$departemen['Departemen']."</option>";
                                    }
                                ?>
                    		</select>
            	    	    <label class="col-12 col-md-2">Unit</label>
                	    	<select id="unit" name='unit' class="col-12 col-md-2 form-control">
                                <option value='all'>All</option>
                    		</select>
                        </div>
                            <div id='input_date' class="row">
                                <label class="col-12 col-md-1">From :</label>
                                <input type="text" name='from' id='dari' class="col-12 col-md-2 form-control">
                                <label class="col-12 col-md-2">To :</label>
                                <input type="text" name="to" id='sampai' class="col-12 col-md-2 form-control">
                            </div>
                            <div style="width: 80%;height: 1000px;">
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                        <div id="form-table" class="d-none">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Id Aduan</th>
                                            <th>Open</th>
                                            <th>Penilaian</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Id Aduan</th>
                                            <th>Open</th> 
                                            <th>Penilaian</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                            $mahasiswa = mysqli_query($koneksi, "SELECT tb_penilaian.* from tb_penilaian
                                            inner join tb_aduan on tb_aduan.id_aduan=tb_penilaian.id_aduan  
                                            ORDER BY open") or die(mysqli_error($koneksi));
                                        $no=1;
                                        foreach ( $mahasiswa as $row){
                                            echo "
                                                <tr>
                                                    <td>$no</td>
                                                    <td>".$row['id_aduan']."</td>
                                                    <td>".($row['open']==0?'<span class="badge badge-pill badge-success">Belum Dibuka</span>':'Telah dibuka')."</td>
                                                    <td>";
                                                    for($x = 0; $x < $row['penilaian']; $x++){
                                                        echo"<span class='penilaian penilaian-checked fa fa-star'></span>";
                                                    }
                                                    for($x = 0; $x < 5-$row['penilaian']; $x++){
                                                        echo"<span class='penilaian fa fa-star'></span>";
                                                    }
                                                echo"
                                                    </td>
                                                    
                                                </tr>";
                                            $no++;
                                        }

                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            	</div>
        	</form>
    	</div>
    </div>
	<script>
	let dari = document.getElementById('dari');
    let sampai = document.getElementById('sampai');
    let data= {};
    var label = [];
    let warna = ['rgb(255, 99, 132)','rgb(255, 159, 64)','rgb(255, 205, 86)','rgb(75, 192, 192)','rgb(54, 162, 235)','rgb(153, 102, 255)','rgb(201, 203, 207)'];
    var ctx = document.getElementById("myChart").getContext('2d');
    var config = {
      type: "bar",
      data: {
        labels: [
        ],
        datasets: [{
          label: 'Processing . . .',
          data: [
          ],
          borderWidth: 1
        }]
      },
          options: {
            responsive: true,
            title: {
              display: true,
              text: "Kepuasan Pelanggan"
            },
            legend: {
              display: true
            },
            scales: {
                yAxes:[{
                    ticks:{
                        suggestedMin:0,
                        suggestedMax:5.1
                    }
                }]
            }
          }
      };
      var myChart = new Chart(ctx, config);
      /**Fungsi merubah konfigurasi */
    function gantiRange(format){
        $.ajax({
            data: $("#myform").serialize(),
              type: 'POST',
              url: "../action/datasets_penilaian.php",
              dataType: 'JSON',
              success: function(response) {
                try{
                    data=response;
                    config.data.labels=[];
                    for(label in data["label"]){
                        config.data.labels.push(data["label"][label]);
                    }
                    config.data.datasets =[];
                    var a =0;
                    for(garis in data["data"]){
                        var datamasuk=[];
                        for(label in data["label"]){
                            if(typeof data["data"][garis][data["label"][label]] == "undefined"){
                                ///kondisi data tidak ditemukan
                                datamasuk.push('"null"');
                            } else {
                                ///menambahkan data baru kedatamasuk
                                datamasuk.push(data["data"][garis][data["label"][label]]);
                            }
                        }
                         var tambah = '{"label":"'+garis+'", "fill":false, "borderWidth":1, "borderColor":"'+warna[a]+'", "connectNullData":true, "showLine":true,"backgroundColor":"'+warna[a]+'", "data":['+datamasuk+']}';
                      a=a+1;
                        var obj = JSON.parse(tambah);
                      config.data.datasets.push(obj);
                    }
                    if(myChart){
                        myChart.destroy();
                    }
                    var temp = jQuery.extend(true, {}, config);
                    myChart = new Chart(ctx, temp);
              ``}catch(err){
                  alert(err);
                }
                    
                },
              error:function(jqXHR, textStatus, errorThrown){
                alert("Error "+ jqXHR.status);
            }
        });
    }
      /**Fungsi merubah konfigurasi */
    $(document).ready(function() {
        /**Mensetting Tanggal */
        /** Tanggal 1 Tahun lalu */
        $( "#dari" ).datepicker();
        $( "#sampai" ).datepicker();
        $( "#dari" ).datepicker("option", "dateFormat", "dd/mm/yy");
        $( "#sampai" ).datepicker("option", "dateFormat", "dd/mm/yy");
        var today = new Date();
        var lastmonth = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();
        var ddl = lastmonth.getDate();
        var mml = lastmonth.getMonth();
        var yyyyl = lastmonth.getFullYear();
        if(dd<10){dd='0'+dd}
        if(mm<10){mm='0'+mm}
        if(mml == 0){
            mml=12;
            yyyyl=yyyyl-1;
        }
        if(ddl<10){ddl='0'+ddl}
        if(mml<10){mml='0'+mml}
        today = dd+'/'+mm+'/'+yyyy; 
        lastmonth = '01/01/'+yyyyl;
        /**Mensetting Tanggal */
        try{
            document.getElementById('dari').value = lastmonth;
            document.getElementById('sampai').value = today;
            document.getElementById('rentang').value = "Bulan";
            document.getElementById('jenis').value = "Status";
        } catch(e){
            alert(e);
        }
        $.ajax({
            data: $("#myform").serialize(),
              type: 'POST',
              url: "../action/datasets_penilaian.php",
              dataType: 'JSON',
              success: function(response) {
                try{
                    data=response;
                    gantiRange(document.getElementById('rentang').value);
                    $("#jenis").val("line");
                    config.type=$("#jenis").val();
                    if(myChart){
                        myChart.destroy();
                    }
                    var temp = jQuery.extend(true, {}, config);
                    myChart = new Chart(ctx, temp);
                }catch(err){
                  alert(err);
                }
                    
                },
              error:function(jqXHR, textStatus, errorThrown){
                alert("Error1 "+ jqXHR.status);
            }
        }); 
        
        /**Listen Tanggal Awal */
        $("#dari").change(function () {
            gantiRange(document.getElementById('rentang').value);
        });
        /**Listen Tanggal Awal */
        $('#unit').change(function(){
            gantiRange(document.getElementById('rentang').value);
        })
        /** Filter unit sesuai departemen */
        $("#departemen" ) .change(function () {    
            let departemen = $(this).val();
            let kelompok = $('#kelompok').val();
            var data = $('#myform').serialize();
            if(departemen=='all' || departemen=='departemen'){
                $('#unit').html('<option value="all" selected="true">All</option>')
            }else{
                $.ajax({
                    type: 'POST',
                    url: "../action/options_unit_grafik.php",
                    data: data,
                    success: function(response) {
                        let isi;
                        if(kelompok=='rata-rata'){
                            isi = "<option value='all' selected='true'>All</option><option value='unit'>Berdasarkan unit</option>"+response
                        }else{
                            isi = "<option value='all' selected='true'>All</option>"+response
                        }
                        $("#unit").html(isi);
                    },
                    error: function(err){
                    }
                }); 
            }
            gantiRange(document.getElementById('rentang').value);
            
        });
        /** Filter unit berdasarkan departemen */

        /**Listen Tanggal Akhir */
        $("#sampai").change(function () {
            gantiRange(document.getElementById('rentang').value);
        });
        /**Listen Tanggal Akhir */
        /**Listen Pengelompokkan */
        $("#kelompok").change(function () {
            let kelompok = $(this).val()
            var data = $('#myform').serialize();
            $.ajax({
            type: 'POST',
            url: "../action/options_departemen.php",
            data: data,
            success: function(response) {
                    let isi;
                    if(kelompok=='rata-rata'){
                        isi = "<option value='all' selected='true'>All</option><option value='departemen'>Berdasarkan departemen</option>"+response
                    }else{
                        isi = "<option value='all' selected='true'>All</option>"+response
                    }
                    $("#unit").html("<option value='all'>All</option>")
                    $("#departemen").html(isi);
                gantiRange(document.getElementById('rentang').value);
            }
            }); 
        });
        /**Listen Pengelompokkan */
        /**Listen Rentang */
        $("#rentang").change(function () {
            gantiRange(document.getElementById('rentang').value);
        });
        /**Listen Rentang */
        /**Listen Jenis Grafik */
        $("#jenis").change(function () {
            config.type=$(this).val();
            if(myChart){
                        myChart.destroy();
                    }
                    var temp = jQuery.extend(true, {}, config);
                    myChart = new Chart(ctx, temp);
        });
        /**Listen Jenis Grafik */
        /**ganti ke grafik */
        $("#btn-grafik").click(function(){
            $("#btn-grafik").removeClass('btn-outline-primary');
            $("#btn-grafik").addClass('btn-primary');
            $("#btn-table").addClass('btn-outline-primary');
            $("#btn-table").removeClass('btn-primary');
            $("#form-table").addClass('d-none');
            $("#form-grafik").removeClass('d-none');
        })
        $("#btn-table").click(function(){
            $("#btn-table").removeClass('btn-outline-primary');
            $("#btn-table").addClass('btn-primary');
            $("#btn-grafik").addClass('btn-outline-primary');
            $("#btn-grafik").removeClass('btn-primary');
            $("#form-table").removeClass('d-none');
            $("#form-grafik").addClass('d-none');
        })
    });
  </script>