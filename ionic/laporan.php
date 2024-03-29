<?php
// (c) Xavier Nicolay
// Exemple de g�n�ration de devis/facture PDF
$id_aduan = $_GET['id'];
require('../Admin/laporan/invoice.php');
require('../koneksi.php');

$pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
$pdf->AddPage();
$pdf->addSociete( "Id Aduan\t".$id_aduan,
                  "BPN - Bandara Udara SAMS Sepinggan\n" .
                  "Angkasa Pura 1\n");
$cols=array( "1"    => 40,
             "2"    => 60,
             "3"    => 40,
             "4"    => 60);
$pdf->addCols( $cols, 30);
$cols=array( "1"    =>  "L",
                "2"    =>  "L",
                "3"    =>  "L",
                "4"    =>  "L");
$pdf->addLineFormat($cols);
$query = mysqli_query($koneksi, "SELECT *, tb_aduan.foto as gambar_aduan, tb_aduan.status as status_aduan FROM tb_aduan 
                                    left join tb_customer on tb_customer.id_customer = tb_aduan.id_customer
                                    where id_aduan='$id_aduan'") or die(mysqli_error($koneksi));
$data = mysqli_fetch_array($query);
$y    = 40;
if(!is_null($data['nama'])){
    $line = array(  "1" => "Kategori",
                    "2" => $data['jenis'],
                    "3" => "Nama Kontak",
                    "4" => $data['nama']);
}else{
    $line = array(  "1" => "Kategori",
                    "2" => $data['jenis'],
                    "3" => "Nama Kontak",
                    "4" => "Tidak Diketahui");
}
$size = $pdf->addLine( $y, $line );
$y   += $size + 2;


    if(is_null($data['nama_perusahaan'])){
        $line = array(  "1" => "Lokasi",
        "2" => $data['nama_lokasi'],
        "3" => "Nama Perusahaan",
        "4" =>  "Tidak Diketahui");
    }else{
        $line = array(  "1" => "Lokasi",
        "2" => $data['nama_lokasi'],
        "3" => "Nama Perusahaan",
        "4" => $data['nama_perusahaan']);
    }
    $size = $pdf->addLine( $y, $line );
    $y   += $size + 2;

    if(is_null($data['nama_perusahaan'])){
        $line = array(  "1" => "Detail Lokasi",
        "2" => $data['nama_detail_lokasi'],
        "3" => "Gerai",
        "4" =>  "Tidak Diketahui");
    }else{
        $line = array(  "1" => "Detail Lokasi",
        "2" => $data['nama_detail_lokasi'],
        "3" => "Gerai",
        "4" => $data['gerai']);
    }
    $size = $pdf->addLine( $y, $line );
    $y   += $size + 2;


    $line = array(  "1" => "Departemen",
    "2" => $data['nama_departemen'],
    "3" =>" ","4"=>" ");
    $size = $pdf->addLine( $y, $line );
    $y   += $size + 2;

    $line = array(  "1" => "Unit",
                    "2" => $data['nama_unit'],
                    "3" =>" ","4"=>" ");
    $size = $pdf->addLine( $y, $line );
    $y   += $size + 2;

    $line = array(  "1" => "Perihal",
                    "2" => $data['perihal'],
                    "3" =>" ","4"=>" ");
    $size = $pdf->addLine($y, $line );
    $y   += $size + 2;
    
    $line = array(  "1" => "Keterangan",
    "2" => $data['ket'],
    "3" =>" ","4"=>" ");
    $size = $pdf->addLine($y, $line );
    $y   += $size + 2;


    $line = array(  "1" => "Status",
                    "2" => $data['status_aduan'],
                    "3" =>" ","4"=>" ");
    $size = $pdf->addLine( $y, $line );
    $y   += $size + 2;


    $line = array(  "1" => "Tanggal Kejadian",
    "2" => $data['waktu_kejadian'],
    "3" =>" ","4"=>" ");
    $size = $pdf->addLine( $y, $line );
    $y   += $size + 2;

    if(!is_null($data['keterangan_kejadian'])){
        $line = array(  "1" => "Keterangan Kejadian",
        "2" => $data['keterangan_kejadian'],
        "3" =>" ","4"=>" ");
        $size = $pdf->addLine( $y, $line );
        $y   += $size + 2;
    }


    $y = $y+10;
    /**Menampilkan gambar aduan */
    if(!is_null($data['gambar_aduan']) && file_exists('../gambar/aduan/'.$data['gambar_aduan'])){
        $line = array(  "1" => "Gambar",
                        "2" => " ",
                        "3" =>" ","4"=>" ");
        $size = $pdf->addLine( $y, $line );
        $y   += $size + 2;
        $pdf->Image('../gambar/aduan/'.$data['gambar_aduan'], 10, $y,80, 80);
        $y += $size + 80;
    }
    /**Menampilkan gambar aduan */
    $cols=array( "1"    => 40,
                "2"    => 150);
    $pdf->addCols( $cols, $y);
    $cols=array( "1"    =>  "L",
                "2"    =>  "L");
                $pdf->addLineFormat($cols);
    //Informasi Tambahan

    $tindakan = mysqli_query($koneksi, "SELECT * FROM tb_keterangan_tambahan where id_aduan='$id_aduan'") or die(mysqli_error($koneksi));
    /**Menampilkan title Informasi Tambahan */    
    if(mysqli_num_rows($tindakan) > 0){

        $line = array(  "1" => "Informasi Tambahan",
                "2" => " ");
        $size = $pdf->addLine( $y, $line );
        $y   += $size + 2;
    }
    /**Menampilkan title Informasi Tambahan */    
    /**Menampilkan Informasi Tambahan */    
    foreach($tindakan as $row){
        $line = array(  "1" => $size,
                        "2" => $row['pertanyaan']);
        $size = $pdf->addLine( $y, $line );
        $y   += $size + 2;
        if(is_null($row['jawaban'])){
            $line = array(  "1" => "Answer",
            "2" => "Not Answered");
        }else{
            $line = array(  "1" => "Answer",
            "2" => $row['jawaban']);
        }
        $size = $pdf->addLine( $y, $line );
        $y   += $size + 2;
        /**Menampilkan gambar keterangan tambahan */
        if(!is_null($row['bukti'])&& file_exists('../gambar/keterangan_tambahan/'.$row['bukti'])){
            if($y+40 > 270){
                $y=270;
            }
            $pdf->Image('../gambar/keterangan_tambahan/'.$row['bukti'], 50, $y,40, 40);
            $y += 40;
        }
        /**Menampilkan gambar keterangan tambahan */
    }
    /**Menampilkan Informasi Tambahan */    

    $y += 20;
    //Informasi Tambahan
    /**Tindakan */
    $line = array(  "1" => "Tindakan",
                    "2" => " ");
    $size = $pdf->addLine( $y, $line );
    $y   += $size + 2;

    $tindakan = mysqli_query($koneksi, "SELECT * FROM tb_progress
                                         left join tb_akun on tb_akun.id_akun = tb_progress.id_akun
                                         where id_aduan='$id_aduan'") or die(mysqli_error($koneksi));
    /**Kondisi tidak ditemukan tindakan */
    if(mysqli_num_rows($tindakan)==0){
        $line = array(  "1"=>   'Belum dilakukan tindakan',
                        "2"=>   ' ');
        $size = $pdf->addLine($y, $line);
        $y += $size+2;
    }
    /**Akhir Kondisi tidak ditemukan tindakan */
    foreach($tindakan as $row){
        $line = array(  "1" => $row['waktu'],
                        "2" => $row['Nama']);
        $size = $pdf->addLine( $y, $line );
        $y   += $size + 2;
        $line = array(  "1" => "",
                        "2" => $row['tindakan']);
        $size = $pdf->addLine( $y, $line );
        /** Menampilkan gambar tindakan */
        
        if(file_exists('../gambar/bukti/'.$row['id_progress'].'.pdf')){
            $y   += $size + 2;
            $line = array(  "1" => " ",
                    "2" => 'Link pdf : http://ogfs-bpn.sepinggan-airport.com/Bandara/gambar/bukti/'.$row['id_progress'].'.pdf');
            $size = $pdf->addLine( $y, $line );
        }
        if(!is_null($row['bukti'])&& file_exists('../gambar/bukti/'.$row['bukti'])){
            
            try{
                $y   += $size + 10;
                if($y+40 > 270){
                    $pdf->addPage();
                    $y = 10;
                }
                $pdf->Image('../gambar/bukti/'.$row['bukti'], 50, $y,40, 40);   
                $y += 60;
            } catch(Exception $e){
                $line = array(  "1" => " ",
                        "2" => 'Gambar Tidak dapat ditampilkan : http://ogfs-bpn.sepinggan-airport.com/Bandara/gambar/bukti/'.$row['bukti']);
                $size = $pdf->addLine( $y-8, $line );            
                $y   +=  $size + 10;
            }
        }else{
            $y   += $size + 10;
        }
        /** Menampilkan gambar tindakan */
    }
    /**Akhir Tindakan */
    
// $line = array( "REFERENCE"    => "REF2",
//                "DESIGNATION"  => "C�ble RS232",
//                "QUANTITE"     => "1",
//                "P.U. HT"      => "10.00",
//                "MONTANT H.T." => "60.00",
//                "TVA"          => "1" );
// $size = $pdf->addLine( $y, $line );
// $y   += $size + 2;

        
// invoice = array( "px_unit" => value,
//                  "qte"     => qte,
//                  "tva"     => code_tva );
// tab_tva = array( "1"       => 19.6,
//                  "2"       => 5.5, ... );
// params  = array( "RemiseGlobale" => [0|1],
//                      "remise_tva"     => [1|2...],  // {la remise s'applique sur ce code TVA}
//                      "remise"         => value,     // {montant de la remise}
//                      "remise_percent" => percent,   // {pourcentage de remise sur ce montant de TVA}
//                  "FraisPort"     => [0|1],
//                      "portTTC"        => value,     // montant des frais de ports TTC
//                                                     // par defaut la TVA = 19.6 %
//                      "portHT"         => value,     // montant des frais de ports HT
//                      "portTVA"        => tva_value, // valeur de la TVA a appliquer sur le montant HT
//                  "AccompteExige" => [0|1],
//                      "accompte"         => value    // montant de l'acompte (TTC)
//                      "accompte_percent" => percent  // pourcentage d'acompte (TTC)
//                  "Remarque" => "texte"              // texte
$pdf->Output();
?>
