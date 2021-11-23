<?php
    require('../koneksi.php');
    if(!isset($_POST['id_aduan'])){
        echo json_encode(array('success'=>false, 'msg'=>'Id Aduan tidak ditemukan'));
    }else if(!isset($_POST['user_id_kustomer'])){
        echo json_encode(array('success'=>false, 'msg'=>'Mohon login terlebih dahulu'));
    }else{
        $id_aduan = $_POST['id_aduan'];
        $id_customer = $_POST['user_id_kustomer'];
        $aduan = mysqli_query($koneksi, "SELECT * FROM tb_aduan 
                                            where id_aduan=$id_aduan");
        if($aduan = mysqli_fetch_array($aduan)){
            if($aduan['id_customer']==$id_customer && $aduan['level']==-1){
                $edit = true;
            }else{
                $edit = false;
            }
            if($aduan['level']==-1){
                $kirim = true;
            }else{
                $kirim = false;
            }
            //timeline
            if($aduan['status']=='Closed'){
                $timeline=7;
            }else if($aduan['status']=='Complete'){
                $timeline=6;
            }else if($aduan['status']=='Progress'){
                $timeline=5;
            }else if($aduan['status']=='Open' && ($aduan['level']=="4"||$aduan['level']=="3")){
                $timeline=4;
            }else if($aduan['status']=='Open'&& $aduan['level']==2){
                $timeline=3;
            }else if($aduan['status']=='Open'){
                $timeline=2;
            }else{
                $timeline=1;
            }
            if($timeline>=6){
                $datacomplete = mysqli_query($koneksi, "SELECT * FROM tb_progress 
                                                        where 
                                                        id_aduan=$id_aduan and 
                                                        tindakan like 'Feedback telah selesai%'
                                                        order by id_progress desc");
                if($datacomplete = mysqli_fetch_array($datacomplete)){
                    $fotocomplete = $datacomplete['bukti'];
                    $tindakancomplete = $datacomplete['tindakan'];
                }else{
                    $tindakancomplete = null;
                    $fotocomplete = null;
                }
            }else{
                $tindakancomplete = null;
                $fotocomplete = null;
            }
            if($timeline>=5){
                $dataprogress = mysqli_query($koneksi, "SELECT * FROM tb_progress 
                                                        where 
                                                        id_aduan=$id_aduan and 
                                                        tindakan like 'Feedback direspons oleh unit dengan keterangan%'
                                                        order by id_progress desc");
                if($dataprogress = mysqli_fetch_array($dataprogress)){
                    $fotoprogress = $dataprogress['bukti'];
                    $tindakanprogress = $dataprogress['tindakan'];
                }else{
                    
                $fotoprogress= null;
                $tindakanprogress = null;
                }
            }else{
                $fotoprogress= null;
                $tindakanprogress = null;
            }
            //timeline
            $data = array(
                'id_aduan'=>$id_aduan,
                'jenis'=>$aduan['jenis'],
                'perihal'=>$aduan['perihal'],
                'urgensi'=>$aduan['urgensi'],
                'keterangan'=>$aduan['ket'],
                'nama_lokasi'=>$aduan['nama_lokasi'],
                'nama_detail_lokasi'=>$aduan['nama_detail_lokasi'],
                'tanggal_kejadian'=>$aduan['waktu_kejadian'],
                'keterangan_kejadian'=>$aduan['keterangan_kejadian'],
                'foto'=>$aduan['foto'],
                'edit'=>$edit,
                'kirim'=>$kirim,
                'timeline'=>$timeline,
                'foto_complete'=>$fotocomplete,
                'tindakan_complete'=>$tindakancomplete
            );
            
            echo json_encode(array('success'=>true, 'data'=>$data));
        }else{
            echo json_encode(array('success'=>false, 'msg'=>'Id Aduan tidak ditemukan'));
        }
    }
    
?>