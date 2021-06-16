<?php
    $halaman='Laporan';
    include 'hak_akses.php';
	include "header.php";
    
    if($_SESSION['status_akun']=='Unit' || $_SESSION['status_akun']=='Manager'){
        $id_unit = $_SESSION['id_unit'];
        $id_departemen = $_SESSION['id_departemen'];
        $nama_unit = $_SESSION['nama_unit'];
        $nama_departemen = $_SESSION['departemen'];
    }else if($_SESSION['status_akun']=='Senior Manager'){
        $id_departemen = $_SESSION['id_departemen'];
        $nama_departemen = $_SESSION['departemen'];
    }
?>
    <div class='container-fluid'>
    	<h1 class="h3 mb-2 text-gray-800">Laporan Customer Service</h1>
        	<form id="myform" method="post">
            	<div class="card shadow mb-4 ">
        	    	<div class="card-header py-3">
                        <div class="row">
                            <noscript class="alert alert-danger alert-dismissible">
                                Halaman web ini membutuhkan javascript untuk bekerja dengan baik, mohon aktifkan javacript pada peramban Anda. 
                            </noscript>
                        </div>
        	    	    <div class="row mb-2">
                    		<label class="col-12 col-md-1">Periode</label>
                    		<select id="rentang" name='rentang' class="col-12 col-md-1 form-control">    
                				<option value='Tahun' selected="true">Tahun</option>
                				<option value='Bulan'>Bulan</option>
                    			<option value='Hari'>Hari</option>
                    		</select>
                    		<select id="jenis" name='jenis' class="col-12 col-md-1 form-control">    
                				<option value='line' selected="true">Line</option>
                				<option value='bar'>Bar</option>
                    		</select>
            	    	    <label class="col-12 col-md-2">Kelompok Berdasarkan</label>
                	    	<select id="kelompok" name='kelompok' class="col-12 col-md-1 form-control">    
                				<option value='status' selected="true">Status</option>
                				<option value='jenis'>Jenis</option>
                    		</select>
            	    	    
                    	</div>
                        <div id="form_departemen" class="row mb-2">
                        <label class="col-12 col-md-2">Departemen</label>
                	    	<select id="departemen" name='departemen' class="col-12 col-md-1 form-control ">   
                                <?php
                                    if(($_SESSION['status_akun']=='Unit' || $_SESSION['status_akun']=='Manager' || $_SESSION['status_akun']=='Senior Manager') && $_SESSION['hak_akses']=='Unit'){
                                        echo "
                                        <option value='$id_departemen'>$nama_departemen</option>
                                        ";
                                    }else{                				
                                        echo"<option value='all' selected='true'>All</option>";
                                        $query = mysqli_query($koneksi, "SELECT * FROM tb_departemen");
                                        foreach($query as $departemen){
                                            echo"<option value='".$departemen['id_departemen']."'>".$departemen['Departemen']."</option>";
                                        }

                                    }
                                ?>
                    		</select>
            	    	    <label class="col-12 col-md-2">Unit</label>
                	    	<select id="unit" name='unit' class="col-12 col-md-2 form-control">    
                                <?php
                                    if(($_SESSION['status_akun']=='Unit' || $_SESSION['status_akun']=='Manager') && $_SESSION['hak_akses']=='Unit'){
                                        echo "<option value='$id_unit'>$nama_unit</option>";
                                    }else if($_SESSION['status_akun']=='Senior Manger'){
                                        echo"<option value='all' selected='true'>All</option>";
                                    }else{
                                        echo"<option value='all' selected='true'>All</option>";
                                    }
                                ?>
                    		</select>
                        </div>
                		<div id='input_date' class="row">
                		    <label class="col-12 col-md-1">From :</label>
            			    <input type="text" name='from' id='dari' class="col-12 col-md-2 form-control">
            			    <label class="col-12 col-md-2">To :</label>
                		    <input type="text" name="to" id='sampai' class="col-12 col-md-2 form-control">
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="width: 80%;height: 1000px;">
                    		<canvas id="myChart"></canvas>
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
    let warna = ['rgb(255, 99, 132)','rgb(255, 159, 64)','rgb(87, 101, 116)','rgb(75, 192, 192)','rgb(54, 162, 235)','rgb(153, 102, 255)','rgb(201, 203, 207)'];
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
            }
          }
      };
      var myChart = new Chart(ctx, config);
    function gantiRange(format){
        $.ajax({
            data: $("#myform").serialize(),
              type: 'POST',
              url: "../action/datasets.php",
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
                                ///menambahkan data baru ke datamasuk
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
                alert("Error "+ errorThrow);
            }
        });
    }
    $(document).ready(function() {
        /** Setting Tanggal Default */
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
        /** Setting Tanggal Default */
        try{
            document.getElementById('dari').value = lastmonth;
            document.getElementById('sampai').value = today;
            document.getElementById('rentang').value = "Bulan";
            document.getElementById('jenis').value = "Status";
        } catch(e){
            alert(e);
        }
        var data = $('#myform').serialize();
        //Merefresh unit jika status adalah senior manager
        <?php
            if($_SESSION['status_akun']=='Senior Manager'){
        ?>
        $.ajax({
            type: 'POST',
            url: "../action/options_unit_grafik.php",
            data: data,
            success: function(response) {
                let isi = "<option value='all' selected='true'>All</option>"+response
                $("#unit").html(isi);
                gantiRange(document.getElementById('rentang').value);
            }
        }); 
        <?php
            }
        ?>
        //Akhir merefresh unit jika status adalah senior manager
        $.ajax({
            data: $("#myform").serialize(),
              type: 'POST',
              url: "../action/datasets.php",
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
        /** Filter unit sesuai departemen */
        $("#departemen" ) .change(function () {    
            var data = $('#myform').serialize();
            $.ajax({
                type: 'POST',
                url: "../action/options_unit_grafik.php",
                data: data,
                success: function(response) {
                    let isi = "<option value='all' selected='true'>All</option>"+response
                    $("#unit").html(isi);
                    gantiRange(document.getElementById('rentang').value);
                }
            }); 
        });
        /** Filter unit berdasarkan departemen */
        /**Listen Tanggal Awal */
        $("#unit").change(function () {
            gantiRange(document.getElementById('rentang').value);
        });
        /**Listen Tanggal Awal */
        /**Listen Tanggal Awal */
        $("#dari").change(function () {
            gantiRange(document.getElementById('rentang').value);
        });
        /**Listen Tanggal Awal */
        /**Listen Tanggal Akhir */
        $("#sampai").change(function () {
            gantiRange(document.getElementById('rentang').value);
        });
        /**Listen Tanggal Akhir */
        /**Listen Pengelompokkan */
        $("#kelompok").change(function () {
            gantiRange(document.getElementById('rentang').value);
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
    });
  </script>
  <?php
    include 'footer.php';
  ?>