<?php

    session_start();
    include('../koneksi.php');
    $link = $koneksi -> real_escape_string($_POST['link']);
    if(file_exists($link)){
        unlink($link);
    }
    $tmp_foto = $_FILES['file']['tmp_name'];
    move_uploaded_file($tmp_foto, $link);
?>