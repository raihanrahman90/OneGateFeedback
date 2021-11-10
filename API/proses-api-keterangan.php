<?php
    include"header.php";
    if($postjson==null){
        echo json_encode(array('success'=>false));
    }else if($postjson['aksi']=='get-keterangan-tambahan'){
        $hasil = array();
        $id_aduan = $postjson['id_aduan'];
        $query = mysqli_query($koneksi, "SELECT id_keterangan, jawaban, pertanyaan, tb_aduan.id_aduan as id_aduan, id_customer, bukti FROM tb_keterangan_tambahan 
        left join tb_aduan on tb_aduan.id_aduan = tb_keterangan_tambahan.id_aduan
        where tb_aduan.id_aduan='$id_aduan'");
        while($row=mysqli_fetch_array($query)){
            $hasil[]=array(
                'id_customer'=>$row['id_customer'],
                'id_keterangan'=>$row['id_keterangan'],
                'pertanyaan'=>$row['pertanyaan'],
                'jawaban'=>$row['jawaban'],
                'bukti'=>$row['bukti']
            );
        }
        if($query) $result = json_encode(array('success'=>true, 'result'=>$hasil));
        else $result = json_encode(array('success'=>false));
        echo $result;
    }else if($postjson['aksi']=='jawab-keterangan-tambahan'){
        $jawaban = $koneksi->real_escape_string($_POST['jawaban']);
        $id_keterangan = $koneksi -> real_escape_string($_POST['id_keterangan']);
        $query = mysqli_query($koneksi, "UPDATE tb_keterangan_tambahan set jawaban='$jawaban' where id_keterangan='$id_keterangan'");
        $data = mysqli_query($koneksi, "SELECT * FROM tb_keterangan_tambahan 
            INNER JOIN tb_akun on tb_akun.id_akun = tb_keterangan_tambahan.id_akun
            where id_keterangan= '$id_keterangan'");
        $data = mysqli_fetch_array($data);
        $email = $data['Email'];
        $nama = $data['Nama'];
        $id_aduan = $data['id_aduan'];
        if(is_uploaded_file($_FILES['bukti']['tmp_name'])){
            $nama_foto = $id_aduan.'.jpg';
            mysqli_query($koneksi, "UPDATE tb_keterangan_tambahan SET bukti='$nama_foto' WHERE link ='$link'") or die(mysqli_error($koneksi));
        	move_uploaded_file($_FILES['bukti']['tmp_name'], "../gambar/keterangan_tambahan/".$nama_foto);
        }
        $subject = 'Keterangan Tambahan';
        include "../pesan/add_jawaban.php";
        if($query) $result = json_encode(array('success'=>true));
        else $result = json_encode(array('success'=>false));
        echo $result;
    }else if($postjson['aksi']=='get-id-keterangan-tambahan'){
        $id_keterangan_tambahan = $koneksi -> real_escape_string($postjson['id_keterangan_tambahan']);
        $query = mysqli_query($koneksi, "SELECT pertanyaan from tb_keterangan_tambahan where id_keterangan='$id_keterangan_tambahan'") or die(mysqli_error($koneksi));
        if($row = mysqli_fetch_array($query)){
            $pertanyaan = $row['pertanyaan'];
        }
        if($query) $result = json_encode(array('success'=>true, 'pertanyaan'=>$pertanyaan));
        else $result = json_encode(array('success'=>false));
        echo $result;
    }
?>