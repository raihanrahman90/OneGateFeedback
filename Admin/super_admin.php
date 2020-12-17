<?php
    if($_SESSION['hak_akses']!='Super Admin'){
        header('Location:../Admin');
    }
?>