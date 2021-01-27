<?php
        session_start();
        include '../koneksi.php';
        $jumlah_belum_dibuka = mysqli_query($koneksi, "SELECT count(tb_aduan.id_aduan) as jumlah from tb_penilaian 
                                                    inner join tb_aduan on tb_aduan.id_aduan  = tb_penilaian.id_aduan
                                                    where tb_penilaian.open='0'") or die(mysqli_error($koneksi));
        $jumlah_belum_dibuka = mysqli_fetch_array($jumlah_belum_dibuka)['jumlah'];

        if($jumlah_belum_dibuka>0){
            $jumlah_belum_dibuka = '<span class="badge badge-primary">'.$jumlah_belum_dibuka.'</span>';
        }else{
            $jumlah_belum_dibuka = '';
        }
        echo '
                    Penilaian
                    '.$jumlah_belum_dibuka;
        /**ALTER TABLE `tb_penilaian`  ADD `open` TINYINT NOT NULL DEFAULT '0'  AFTER `ulasan`; */
?>