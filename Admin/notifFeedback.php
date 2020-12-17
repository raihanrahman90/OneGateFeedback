<?php
        session_start();
        include '../koneksi.php';
        $jumlah_complete = '';
        $jumlah_open = '';
        $status_akun = $_SESSION['status_akun'];
        if($_SESSION['hak_akses']=='Super Admin' || $_SESSION['hak_akses']=='Admin2'){
            $jumlah_complete = mysqli_query($koneksi, "SELECT id_aduan from tb_aduan where status='Complete'") or die(mysqli_error($koneksi));
            $jumlah_complete = mysqli_num_rows($jumlah_complete);
            if($jumlah_complete>0){
                $jumlah_complete = '<span class="badge badge-primary">'.$jumlah_complete.'</span>';
            }else{
                $jumlah_complete = '';
            } 
            $jumlah_open = mysqli_query($koneksi, "SELECT id_aduan from tb_aduan where status='Open'") or die(mysqli_error($koneksi));
            $jumlah_open = mysqli_num_rows($jumlah_open);
            if($jumlah_open>0){
                $jumlah_open = '<span class="badge badge-warning">'.$jumlah_open.'</span>';
            }else{
                $jumlah_open = '';
            }            
        }else if($_SESSION['status_akun']=='Unit' || $_SESSION['status_akun']=='Manager'){
            $id_unit = $_SESSION['id_unit'];
            $jumlah_open = mysqli_query($koneksi, "SELECT id_aduan from tb_aduan where status='Open' and id_unit='$id_unit'") or die(mysqli_error($koneksi));
            $jumlah_open = mysqli_num_rows($jumlah_open);
            if($jumlah_open>0){
                $jumlah_open = '<span class="badge badge-warning">'.$jumlah_open.'</span>';
            }else{
                $jumlah_open = '';
            }            
        }else if($_SESSION['status_akun']=='Senior Manager'){
            $id_departemen = $_SESSION['id_departemen'];
            $sintax="SELECT id_aduan FROM tb_aduan 
                    inner join tb_unit on tb_aduan.id_unit = tb_unit.id_unit 
                    inner join tb_departemen on tb_departemen.id_departemen =tb_unit.id_departemen 
                    where tb_departemen.id_departemen = '".$id_departemen."' and level>=2 and status='Open'";
            $jumlah_open = mysqli_query($koneksi, $sintax) or die(mysqli_error($koneksi));
            $jumlah_open = mysqli_num_rows($jumlah_open);
            if($jumlah_open>0){
                $jumlah_open = '<span class="badge badge-warning">'.$jumlah_open.'</span>';
            }else{
                $jumlah_open = '';
            }
        }else if($_SESSION['status_akun']=='AOC Head'){
            $jumlah_open = mysqli_query($koneksi, "SELECT id_aduan from tb_aduan where status='Open' and level>=3") or die(mysqli_error($koneksi));
            $jumlah_open = mysqli_num_rows($jumlah_open);
            if($jumlah_open>0){
                $jumlah_open = '<span class="badge badge-warning">'.$jumlah_open.'</span>';
            }else{
                $jumlah_open = '';
            }
        }else if($_SESSION['status_akun']=='General Manager'){
            $jumlah_open = mysqli_query($koneksi, "SELECT id_aduan from tb_aduan where status='Open' and level=4") or die(mysqli_error($koneksi));
            $jumlah_open = mysqli_num_rows($jumlah_open);
            if($jumlah_open>0){
                $jumlah_open = '<span class="badge badge-warning">'.$jumlah_open.'</span>';
            }else{
                $jumlah_open = '';
            }
        }

      
            echo '
                    Feedback
                    '.$jumlah_complete.'
                    '.$jumlah_open;
?>