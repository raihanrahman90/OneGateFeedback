<?php
    if(!($_SESSION['hak_akses']=='Super Admin' || $_SESSION['hak_akses']=='Admin1' || $_SESSION['status_akun']=='AOC Head' || $_SESSION['status_akun']=='General Manager')){
        echo $_SESSION['status_akun'];
    }
?>