<?php
        session_start();
        include '../koneksi.php';
        $jumlah_complete = '';
        $jumlah_open = '';
        $status_akun = $_SESSION['status_akun'];
        if($_SESSION['hak_akses']=='Super Admin' || $_SESSION['hak_akses']=='Admin2' || $_SESSION['hak_akses']=='Pengawas Internal' || $_SESSION['hak_akses']=='Admin1'){
            $jumlah_complete = mysqli_query($koneksi, "SELECT id_aduan from tb_aduan where status='Complete'") or die(mysqli_error($koneksi));
            $jumlah_complete = mysqli_num_rows($jumlah_complete);
            if($jumlah_complete>0){
                $jumlah_complete = '<span class="badge badge-primary">'.$jumlah_complete.'</span>';
            }else{
                $jumlah_complete = '';
            } 
            $jumlah_open_kuning = mysqli_query($koneksi, "SELECT tb_aduan.id_aduan from tb_aduan 
                                                            left join (SELECT id_aduan, waktu FROM tb_progress where tindakan like 'Dikembalikan ke unit teknis%') as progress
                                                            on progress.id_aduan = tb_aduan.id_aduan and progress.waktu >= tb_aduan.waktu
                                                            where status='Open' and progress.waktu is null group by tb_aduan.id_aduan") or die(mysqli_error($koneksi));
            $jumlah_open_kuning = mysqli_num_rows($jumlah_open_kuning);
            if($jumlah_open_kuning>0){
                $jumlah_open_kuning = '<span class="badge badge-warning">'.$jumlah_open_kuning.'</span>';
            }else{
                $jumlah_open_kuning = '';
            }
                $jumlah_open_merah = mysqli_query($koneksi, "SELECT tb_aduan.id_aduan from tb_aduan left join 
                                                            (SELECT id_aduan, waktu FROM tb_progress where tindakan like 'Dikembalikan ke unit teknis%') as progress
                                                            on progress.id_aduan = tb_aduan.id_aduan and progress.waktu >= tb_aduan.waktu
                                                            where status ='Open' and progress.waktu is not null group by tb_aduan.id_aduan");
            $jumlah_open_merah = mysqli_num_rows($jumlah_open_merah);
            if($jumlah_open_merah>0){
                $jumlah_open_merah = '<span class="badge badge-danger">'.$jumlah_open_merah.'</span>';
            }else{
                $jumlah_open_merah = '';
            }
        }else if($_SESSION['status_akun']=='Unit' || $_SESSION['status_akun']=='Manager'){
            $id_unit = $_SESSION['id_unit'];
            $jumlah_open_kuning = mysqli_query($koneksi, "SELECT tb_aduan.id_aduan from tb_aduan
                                                            left join (SELECT id_aduan, waktu FROM tb_progress where tindakan like 'Dikembalikan ke unit teknis%') as progress
                                                            on progress.id_aduan = tb_aduan.id_aduan and progress.waktu >= tb_aduan.waktu
                                                            where status='Open' and id_unit='$id_unit' and progress.waktu is null") or die(mysqli_error($koneksi));
            $jumlah_open_kuning = mysqli_num_rows($jumlah_open_kuning);
            if($jumlah_open_kuning>0){
                $jumlah_open_kuning = '<span class="badge badge-warning">'.$jumlah_open_kuning.'</span>';
            }else{
                $jumlah_open_kuning = '';
            }
            $jumlah_open_merah = mysqli_query($koneksi, "SELECT tb_aduan.id_aduan from tb_aduan
                                                            left join (SELECT id_aduan, waktu FROM tb_progress where tindakan like 'Dikembalikan ke unit teknis%') as progress
                                                            on progress.id_aduan = tb_aduan.id_aduan and progress.waktu >= tb_aduan.waktu
                                                            where status='Open' and id_unit='$id_unit' and progress.waktu is not null") or die(mysqli_error($koneksi));
            $jumlah_open_merah = mysqli_num_rows($jumlah_open_merah);
            if($jumlah_open_merah>0){
                $jumlah_open_merah = '<span class="badge badge-danger">'.$jumlah_open_merah.'</span>';
            }else{
                $jumlah_open_merah = '';
            }
        }else if($_SESSION['status_akun']=='Senior Manager'){
            $id_departemen = $_SESSION['id_departemen'];
            $sintax="SELECT tb_aduan.id_aduan FROM tb_aduan 
                    inner join tb_unit on tb_aduan.id_unit = tb_unit.id_unit 
                    inner join tb_departemen on tb_departemen.id_departemen =tb_unit.id_departemen 
                    left join (SELECT id_aduan, waktu FROM tb_progress where tindakan like 'Dikembalikan ke unit teknis%') as progress
                                                            on progress.id_aduan = tb_aduan.id_aduan and progress.waktu >= tb_aduan.waktu
                    where tb_departemen.id_departemen = '".$id_departemen."' and level>=2 and status='Open' and progress.waktu is null";
            $jumlah_open_kuning = mysqli_query($koneksi, $sintax) or die(mysqli_error($koneksi));
            $jumlah_open_kuning = mysqli_num_rows($jumlah_open_kuning);
            if($jumlah_open_kuning>0){
                $jumlah_open_kuning = '<span class="badge badge-warning">'.$jumlah_open_kuning.'</span>';
            }else{
                $jumlah_open_kuning = '';
            }
            $sintax="SELECT tb_aduan.id_aduan FROM tb_aduan 
                    inner join tb_unit on tb_aduan.id_unit = tb_unit.id_unit 
                    inner join tb_departemen on tb_departemen.id_departemen =tb_unit.id_departemen 
                    left join (SELECT id_aduan, waktu FROM tb_progress where tindakan like 'Dikembalikan ke unit teknis%') as progress
                                                            on progress.id_aduan = tb_aduan.id_aduan and progress.waktu >= tb_aduan.waktu
                    where tb_departemen.id_departemen = '".$id_departemen."' and level>=2 and status='Open' and progress.waktu is not null";
            $jumlah_open_merah = mysqli_query($koneksi, $sintax) or die(mysqli_error($koneksi));
            $jumlah_open_merah = mysqli_num_rows($jumlah_open_merah);
            if($jumlah_open_merah>0){
                $jumlah_open_merah = '<span class="badge badge-danger">'.$jumlah_open_merah.'</span>';
            }else{
                $jumlah_open_merah = '';
            }
        }else if($_SESSION['status_akun']=='AOC Head'){
            $jumlah_open_kuning = mysqli_query($koneksi, "SELECT tb_aduan.id_aduan from tb_aduan 
                                                                left join (SELECT id_aduan, waktu FROM tb_progress where tindakan like 'Dikembalikan ke unit teknis%') as progress
                                                                                                        on progress.id_aduan = tb_aduan.id_aduan and progress.waktu >= tb_aduan.waktu
                                                                    where status='Open' and level>=3 and progress.waktu is null") or die(mysqli_error($koneksi));
            $jumlah_open_kuning = mysqli_num_rows($jumlah_open_kuning);
            if($jumlah_open_kuning>0){
                $jumlah_open_kuning = '<span class="badge badge-warning">'.$jumlah_open_kuning.'</span>';
            }else{
                $jumlah_open_kuning = '';
            }
            $jumlah_open_merah = mysqli_query($koneksi, "SELECT tb_aduan.id_aduan from tb_aduan 
                                                        left join (SELECT id_aduan, waktu FROM tb_progress where tindakan like 'Dikembalikan ke unit teknis%') as progress
                                                                                                on progress.id_aduan = tb_aduan.id_aduan and progress.waktu >= tb_aduan.waktu
                                                        where status='Open' and level>=3 and progress.waktu is not null") or die(mysqli_error($koneksi));
            $jumlah_open_merah = mysqli_num_rows($jumlah_open_merah);
            if($jumlah_open_merah>0){
                $jumlah_open_merah = '<span class="badge badge-danger">'.$jumlah_open_merah.'</span>';
            }else{
                $jumlah_open_merah = '';
            }
        }else if($_SESSION['status_akun']=='General Manager'){
            $jumlah_open_kuning = mysqli_query($koneksi, "SELECT tb_aduan.id_aduan from tb_aduan 
                                                                left join (SELECT id_aduan, waktu FROM tb_progress where tindakan like 'Dikembalikan ke unit teknis%') as progress
                                                                                                        on progress.id_aduan = tb_aduan.id_aduan and progress.waktu >= tb_aduan.waktu
                                                                    where status='Open' and level>=4 and progress.waktu is null") or die(mysqli_error($koneksi));
            $jumlah_open_kuning = mysqli_num_rows($jumlah_open_kuning);
            if($jumlah_open_kuning>0){
                $jumlah_open_kuning = '<span class="badge badge-warning">'.$jumlah_open_kuning.'</span>';
            }else{
                $jumlah_open_kuning = '';
            }
            $jumlah_open_merah = mysqli_query($koneksi, "SELECT tb_aduan.id_aduan from tb_aduan 
                                                        left join (SELECT id_aduan, waktu FROM tb_progress where tindakan like 'Dikembalikan ke unit teknis%') as progress
                                                                                                on progress.id_aduan = tb_aduan.id_aduan and progress.waktu >= tb_aduan.waktu
                                                        where status='Open' and level>=4 and progress.waktu is not null") or die(mysqli_error($koneksi));
            $jumlah_open_merah = mysqli_num_rows($jumlah_open_merah);
            if($jumlah_open_merah>0){
                $jumlah_open_merah = '<span class="badge badge-danger">'.$jumlah_open_merah.'</span>';
            }else{
                $jumlah_open_merah = '';
            }
        }

      
            echo '
                    Feedback
                    '.$jumlah_complete.'
                    '.$jumlah_open_kuning.'
                    '.$jumlah_open_merah;
?>