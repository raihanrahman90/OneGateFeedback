<?php 
	session_start();
    require_once("./new-header.php"); 
?>
<div class="w-100 h-100 d-flex align-items-center">
    <div class="register-container">
        <h3 class="text-left">Silahkan Buat Akun</h3>
        <div class="row mb-3 w-100 justify-content-center">
            <button class="register-button-timeline active">
                <span>1</span> Informasi Perusahaan
            </button>
            <button class="register-button-timeline">
                <span>2</span> Informasi personal
            </button>
        </div>
        <form class="register-card-container" id="form" onsubmit="return validasiUsername();"  method="post" action="../action/register.php" enctype="multipart/form-data">

        <?php
            if(isset($_SESSION['status'])){
                if($_SESSION['status']=='Email telah digunakan'){
                    echo '<div class="alert alert-warning alert-dismissible ">
                        Email telah digunakan
                    </div>';
                    $_SESSION['status']='';
                } else if($_SESSION['status']=='daftar'){
                    echo '<div class="alert alert-success alert-dismissible ">
                            Kami akan konfirmasi data diri anda, silahkan tunggu e-mail konfirmasi
                        </div>';
                    $_SESSION['status']='';
                } else if($_SESSION['status']=='Salah ekstensi'){
                    echo '<div class="alert alert-warning alert-dismissible ">
                        Mohon hanya mengupload gambar dengan ekstensi jpg, jpeg, atau png
                    </div>';
                    $_SESSION['status']='';
                }
            }
        ?>
            <div class="row register-card register-card-company visible">
                <div class="col-md-12 col-12">
                    <div class="form-group">
                        <label>Nama Perusahaan <span>*</span></label>
                        <input type="text" name="nama_perusahaan" placeholder="Masukkan nama perusahaan Anda" class="form-control" id="nama_perusahaan" required/>
                    </div>
                    <div class="form-group">
                        <label>Gerai <span>*</span></label>
                        <input type="text" name="gerai" placeholder="Masukkan gerai perusahaan" class="form-control" id = "gerai" required/>
                    </div>
                    <div class="form-group">
                        <label>Masa Berlaku Pass Bandara<span>*</span></label>
                        <input type="date" name="masa_berlaku" class="form-control" id="masa_berlaku" required>
                    </div>
                    <div class="form-group">
                        <label>Masa Berlaku Kontrak Kerja Perusahaan Dengan PT AP 1</label>
                        <input type="date" name="kontrak" class="form-control" id="kontrak">
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="file" id="pass_bandara" accept="image/png, image/jpg, image/jpeg" name='pass_bandara' required/>
                        </div>
                        <div class="col-sm-6">
                            <input type="number" id="id_pass_bandara" name="id_pass_bandara" class="form-control" placeholder="Masukkan Id sisi darat" max="2050-12-30" required/>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-end mt-2">
                    <button class="btn btn-new-primary" id="nextButton" type="button">Selanjutnya</button>
                </div>
            </div>
            <div class="row register-card register-card-personal w-100 justify-content-between">
                <div class="col-12 col-md-3 mr-1 d-flex justify-content-center">
                    <div class="picture-container col-6 col-md-12 overflow-x-hidden">
                        <div class="picture w-100">
                            <img src="../assets/img/default-avatar.jpg" class="picture-src w-100" id="image-preview" title="" />
                        </div>
                        <label for="file-upload" class="custom-upload-button">Upload Foto Anda</label>
                        <input type="file" id="file-upload" name='foto' accept="image/png, image/jpg, image/jpeg" required hidden/>
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" placeholder="Nama Lengkap" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="Email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>No Telpon</label>
                        <input type="text" name="no_telp" placeholder="No Telpon" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" id="password1" required>
                    </div>
                </div>
                <div class="d-flex justify-content-between col-12 mt-3 w-100">
                    <button id="backButton" class="btn btn-secondary" type="button">Kembali</button>
                    <button type="submit" class="btn btn-new-primary">Kirim</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    var currentForm = 'company';
    $(function() {
        $('#nextButton').on('click', function(event){
            if(!$('#nama_perusahaan')[0].checkValidity()){
                $('#nama_perusahaan')[0].reportValidity();
                return;
            }
            if(!$('#gerai')[0].checkValidity()){
                $('#gerai')[0].reportValidity();
                return;
            }
            if(!$('#masa_berlaku')[0].checkValidity()){
                $('#masa_berlaku')[0].reportValidity();
                return;
            }
            
            if(!$('#pass_bandara')[0].checkValidity() && !$('#id_pass_bandara')[0].checkValidity()){
                $('#pass_bandara')[0].reportValidity();
                return;
            }else{
                $('#pass_bandara').removeAttr("required");
                $('#id_pass_bandara').removeAttr("required");
            }
            $('.register-card-company').addClass('hide');
            $('.register-card-personal').addClass('visible');
        });
        $('#backButton').on('click', function(event){
            $('.register-card-company').removeClass('hide');
            $('.register-card-personal').removeClass('visible');
        })

        $("#file-upload").on('change', function(event) {    
        const file = event.target.files[0];
            if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $("#image-preview").attr('src', e.target.result).show();
            };

            reader.readAsDataURL(file);
            }
        });

        function validasiUsername(){
            alert("validate");
            var pass1 = document.getElementById("password1");
            var pass2 = document.getElementById("password2");
            if(pass1.value!=pass2.value){
                alert("Password tidak sama");
                pass1.focus();
                return false;
            }
            return true;
        }
    });
</script>
<?php require_once("./footer.php"); ?>