<?php
    if($_SESSION['hak_akses']!='Super Admin' && $_SESSION['hak_akses']!='Admin1' && $_SESSION['hak_akses']!='Pengawas'){
        header("Location:../Admin");
    }
?>