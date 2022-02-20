<?php
    require('header.php');
    $hak_akses = $_POST['user_hak_akses'];
    $status_akun = $_POST['user_status_akun'];
    if(isset($_POST['id_unit'])){
        $id_unit = $_POST['id_unit'];
    }
    
    $id_akun = $_POST['id_akun'];
    $query_admin = mysqli_query($koneksi, "SELECT * FROM tb_akun where id_akun='$id_akun'") or die(mysqli_error($koneksi));
    if($data_admin = mysqli_fetch_array($query_admin)){
        $aktif_admin = true;
        $status_admin = $data_admin['status'];
        $hak_akses = $data_admin['hak_akses'];
    }else{
        $aktif_admin = false;
        $status_admin = null;
        $hak_akses = null;
    }
    $jumlah_customer = mysqli_query($koneksi, "SELECT * FROM tb_customer where status ='0'") or die(mysqli_error($koneksi));
    $jumlah_customer = mysqli_num_rows($jumlah_customer);
    $jumlah_complete = 0;
    $jumlah_open = 0;
    if($hak_akses=='Super Admin' || $hak_akses=='Admin2' || $hak_akses=='Pengawas Internal' || $hak_akses=='Admin1'){
        $jumlah_complete = mysqli_query($koneksi, "SELECT id_aduan from tb_aduan where status='Complete'") or die(mysqli_error($koneksi));
        $jumlah_complete = mysqli_num_rows($jumlah_complete);
        $jumlah_open_kuning = mysqli_query($koneksi, "SELECT tb_aduan.id_aduan from tb_aduan 
                                                        left join (SELECT id_aduan, waktu FROM tb_progress where tindakan like 'Dikembalikan ke unit teknis%') as progress
                                                        on progress.id_aduan = tb_aduan.id_aduan and progress.waktu >= tb_aduan.waktu
                                                        where status='Open' and progress.waktu is null group by tb_aduan.id_aduan") or die(mysqli_error($koneksi));
        $jumlah_open_kuning = mysqli_num_rows($jumlah_open_kuning);
        $jumlah_open_merah = mysqli_query($koneksi, "SELECT tb_aduan.id_aduan from tb_aduan left join 
                                                        (SELECT id_aduan, waktu FROM tb_progress where tindakan like 'Dikembalikan ke unit teknis%') as progress
                                                        on progress.id_aduan = tb_aduan.id_aduan and progress.waktu >= tb_aduan.waktu
                                                        where status ='Open' and progress.waktu is not null group by tb_aduan.id_aduan");
        $jumlah_open_merah = mysqli_num_rows($jumlah_open_merah);
    }else if($status_akun=='Unit' || $status_akun=='Manager'){
        $jumlah_open_kuning = mysqli_query($koneksi, "SELECT tb_aduan.id_aduan from tb_aduan
                                                        left join (SELECT id_aduan, waktu FROM tb_progress where tindakan like 'Dikembalikan ke unit teknis%') as progress
                                                        on progress.id_aduan = tb_aduan.id_aduan and progress.waktu >= tb_aduan.waktu
                                                        where status='Open' and id_unit='$id_unit' and progress.waktu is null") or die(mysqli_error($koneksi));
        $jumlah_open_kuning = mysqli_num_rows($jumlah_open_kuning);
        $jumlah_open_merah = mysqli_query($koneksi, "SELECT tb_aduan.id_aduan from tb_aduan
                                                        left join (SELECT id_aduan, waktu FROM tb_progress where tindakan like 'Dikembalikan ke unit teknis%') as progress
                                                        on progress.id_aduan = tb_aduan.id_aduan and progress.waktu >= tb_aduan.waktu
                                                        where status='Open' and id_unit='$id_unit' and progress.waktu is not null") or die(mysqli_error($koneksi));
        $jumlah_open_merah = mysqli_num_rows($jumlah_open_merah);
    }else if($status_akun=='Senior Manager'){
        $id_departemen = $_POST['id_departemen'];
        $sintax="SELECT tb_aduan.id_aduan FROM tb_aduan 
                inner join tb_unit on tb_aduan.id_unit = tb_unit.id_unit 
                inner join tb_departemen on tb_departemen.id_departemen =tb_unit.id_departemen 
                left join (SELECT id_aduan, waktu FROM tb_progress where tindakan like 'Dikembalikan ke unit teknis%') as progress
                                                        on progress.id_aduan = tb_aduan.id_aduan and progress.waktu >= tb_aduan.waktu
                where tb_departemen.id_departemen = '".$id_departemen."' and level>=2 and status='Open' and progress.waktu is null";
        $jumlah_open_kuning = mysqli_query($koneksi, $sintax) or die(mysqli_error($koneksi));
        $jumlah_open_kuning = mysqli_num_rows($jumlah_open_kuning);
        $sintax="SELECT tb_aduan.id_aduan FROM tb_aduan 
                inner join tb_unit on tb_aduan.id_unit = tb_unit.id_unit 
                inner join tb_departemen on tb_departemen.id_departemen =tb_unit.id_departemen 
                left join (SELECT id_aduan, waktu FROM tb_progress where tindakan like 'Dikembalikan ke unit teknis%') as progress
                                                        on progress.id_aduan = tb_aduan.id_aduan and progress.waktu >= tb_aduan.waktu
                where tb_departemen.id_departemen = '".$id_departemen."' and level>=2 and status='Open' and progress.waktu is not null";
        $jumlah_open_merah = mysqli_query($koneksi, $sintax) or die(mysqli_error($koneksi));
        $jumlah_open_merah = mysqli_num_rows($jumlah_open_merah);
    }else if($status_akun=='AOC Head'){
        $jumlah_open_kuning = mysqli_query($koneksi, "SELECT tb_aduan.id_aduan from tb_aduan 
                                                            left join (SELECT id_aduan, waktu FROM tb_progress where tindakan like 'Dikembalikan ke unit teknis%') as progress
                                                                                                    on progress.id_aduan = tb_aduan.id_aduan and progress.waktu >= tb_aduan.waktu
                                                                where status='Open' and level>=3 and progress.waktu is null") or die(mysqli_error($koneksi));
        $jumlah_open_kuning = mysqli_num_rows($jumlah_open_kuning);
        $jumlah_open_merah = mysqli_query($koneksi, "SELECT tb_aduan.id_aduan from tb_aduan 
                                                    left join (SELECT id_aduan, waktu FROM tb_progress where tindakan like 'Dikembalikan ke unit teknis%') as progress
                                                                                            on progress.id_aduan = tb_aduan.id_aduan and progress.waktu >= tb_aduan.waktu
                                                    where status='Open' and level>=3 and progress.waktu is not null") or die(mysqli_error($koneksi));
        $jumlah_open_merah = mysqli_num_rows($jumlah_open_merah);
    }else if($status_akun=='General Manager'){
        $jumlah_open_kuning = mysqli_query($koneksi, "SELECT tb_aduan.id_aduan from tb_aduan 
                                                            left join (SELECT id_aduan, waktu FROM tb_progress where tindakan like 'Dikembalikan ke unit teknis%') as progress
                                                                                                    on progress.id_aduan = tb_aduan.id_aduan and progress.waktu >= tb_aduan.waktu
                                                                where status='Open' and level>=4 and progress.waktu is null") or die(mysqli_error($koneksi));
        $jumlah_open_kuning = mysqli_num_rows($jumlah_open_kuning);
        $jumlah_open_merah = mysqli_query($koneksi, "SELECT tb_aduan.id_aduan from tb_aduan 
                                                    left join (SELECT id_aduan, waktu FROM tb_progress where tindakan like 'Dikembalikan ke unit teknis%') as progress
                                                                                            on progress.id_aduan = tb_aduan.id_aduan and progress.waktu >= tb_aduan.waktu
                                                    where status='Open' and level>=4 and progress.waktu is not null") or die(mysqli_error($koneksi));
        $jumlah_open_merah = mysqli_num_rows($jumlah_open_merah);
    }
    
    $jumlah_belum_dibuka = mysqli_query($koneksi, "SELECT tb_aduan.id_aduan as jumlah from tb_penilaian 
        inner join tb_aduan on tb_aduan.id_aduan  = tb_penilaian.id_aduan
        where tb_penilaian.open='0'") or die(mysqli_error($koneksi));
    $jumlah_penilaian = mysqli_num_rows($jumlah_belum_dibuka);

    $jumlah_request = mysqli_query($koneksi, "SELECT id_aduan from tb_aduan where status='Request' and level='0'") or die(mysqli_error($koneksi));
    $jumlah_request = mysqli_num_rows($jumlah_request);
    $jumlah_return = mysqli_query($koneksi, "SELECT id_aduan from tb_aduan where status='Returned'") or die(mysqli_error($koneksi));
    $jumlah_return = mysqli_num_rows($jumlah_return);

    echo json_encode(
            array(
                'request_kuning'=>$jumlah_request,
                'request_merah'=>$jumlah_return,
                'feedback_merah'=>$jumlah_open_merah,
                'feedback_kuning'=>$jumlah_open_kuning,
                'feedback_biru'=>$jumlah_complete,
                'customer_biru'=>$jumlah_customer,
                'penilaian_biru'=>$jumlah_penilaian,
                'aktif_admin'=>$aktif_admin,
                'status_admin'=>$status_admin,
                'hak_akses_admin'=>$hak_akses
                )
        )
?>