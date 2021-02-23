<?php
require('./laporan/fpdf.php');
require('../koneksi.php');
class PDF extends FPDF
{
protected $col = 0; // Current column
protected $y0;
protected $y;
public $lastY;      // Ordinate of column start
function WriteHTML($html)
{
    // HTML parser
    $html = str_replace("\n",' ',$html);
    $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
    foreach($a as $i=>$e)
    {
        if($i%2==0)
        {
            // Text
            if($this->HREF)
                $this->PutLink($this->HREF,$e);
            else
                $this->Write(5,$e);
        }
        else
        {
            // Tag
            if($e[0]=='/')
                $this->CloseTag(strtoupper(substr($e,1)));
            else
            {
                // Extract attributes
                $a2 = explode(' ',$e);
                $tag = strtoupper(array_shift($a2));
                $attr = array();
                foreach($a2 as $v)
                {
                    if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                        $attr[strtoupper($a3[1])] = $a3[2];
                }
                $this->OpenTag($tag,$attr);
            }
        }
    }
}

function Header()
{
    // Page header
    global $title;

    $this->SetFont('Arial','B',12);
    $w = $this->GetStringWidth($title)+6;
    $this->SetX((210-$w)/2);
    $this->SetDrawColor(255,255,255);
    $this->SetFillColor(255,255,255);
    $this->SetTextColor(0,0,0);
    $this->SetLineWidth(1);
    $this->Cell($w,9,$title,1,1,'C',true);
    $this->Ln(10);
    // Save ordinate
    $this->y0 = $this->GetY();
}

function Footer()
{
    // Page footer
    $this->SetY(-15);
    $this->SetFont('Arial','I',8);
    $this->SetTextColor(128);
    $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
}

function SetCol($col)
{
    // Set position at a given column
    $this->col = $col;
    $x = 20+$col*30;
    if($col>1){
        $x=$x+20;
    }
    $this->SetLeftMargin($x);
    $this->SetX($x);
}

function ChapterTitle($label)
{
    // Title
    $this->SetLeftMargin(20);
    $this->SetY($this->lastY+10);
    $this->SetFillColor(255,255,255);
    $this->Cell(0,6,$label,0,1,'L',true);
    $this->Ln(4);
    // Save ordinate
    $this->lastY = $this->GetY();
}

function ChapterBody($text, $col)
{
    // Font
    $this->SetFont('Times','',12);
    // Output text in a 6 cm width column
    $this->y=$this->GetY();
    if($col%2==1){
        $this->MultiCell(50,5,$text);
    }else{
        $this->MultiCell(27, 5, $text);
    }
    // Go back to first column
}

function PrintChapter($text, $col)
{
    // Add chapter
    if($col%2==1){
        $this->SetTextColor(0,0,0);
    }else{
        $this->SetTextColor(99, 110, 114);
    }
    $this->SetLeftMargin(10);
    $this->SetCol($col);
    if($col==0){
        $y = $this->lastY+5;
        $this->SetY($this->lastY+8);
        $this->lastY=$this->GetY();
    }else{
        $this->SetY($this->lastY);
    }
    $this->ChapterBody($text, $col);
}

}

$pdf = new PDF();
$id = $_GET['id'];
$title = 'ID Aduan : '.$_GET['id'];
$pdf->SetFont('Times','',12);
$pdf->SetTitle($title);
$pdf->SetAuthor('Jules Verne');
$pdf->AddPage();
$pdf->SetLeftMargin(40);
$pdf->Line(10, $pdf->lastY+10, 200, $pdf->lastY+10);
$pdf->lastY=20;
$pdf->PrintChapter('Case Number', 0);
$pdf->PrintChapter($_GET['id'], 1);
$pdf->PrintChapter('Airport',2);
$pdf->PrintChapter('BPN - Bandara Udara Sultan Aji Muhammad Sulaiman Sepinggan',3);
$query = mysqli_query($koneksi, "SELECT *, tb_aduan.status as status FROM tb_aduan 
                                left join tb_customer on tb_aduan.id_customer = tb_customer.id_customer
                                left join (select id_aduan, waktu as waktu_closed from tb_progress where tindakan='Closed') as closed_table on closed_table.id_aduan=tb_aduan.id_aduan
                                where tb_aduan.id_aduan='$id'") or die(mysqli_error($koneksi));
if($data = mysqli_fetch_array($query)){
    $pdf->PrintChapter('Airport ID', 0);
    $pdf->PrintChapter('Segment', 0);
    $pdf->PrintChapter('Angkasa Pura 1', 1);
    $pdf->PrintChapter('Contact Name', 2);
    $pdf->PrintChapter(substr($data['nama'],0, 25), 3);
    $pdf->PrintChapter('Lokasi',0);
    $pdf->PrintChapter($data['nama_lokasi'], 1);
    $pdf->PrintChapter('Case Owner',2);
    $pdf->PrintChapter('bpn cs',3);
    $pdf->PrintChapter('Detail Lokasi',0);
    $pdf->PrintChapter($data['nama_detail_lokasi'], 1);
    $pdf->PrintChapter('Customer Type', 2);
    $pdf->PrintChapter($data['pelapor'], 3);
    $pdf->PrintChapter('Kategori',0);
    $pdf->PrintChapter($data['jenis'], 1);
    $pdf->PrintChapter('Departemen',0);
    $pdf->PrintChapter($data['nama_departemen'], 1);
    $pdf->PrintChapter('Unit',0);
    $pdf->PrintChapter($data['nama_unit'], 1);
    $pdf->PrintChapter('Status',0);
    $pdf->PrintChapter($data['status'], 1);
    $pdf->Line(10, $pdf->lastY+10, 200, $pdf->lastY+10);
    $pdf->lastY=$pdf->lastY+10;
    $pdf->ChapterTitle('Description Information');
    $pdf->PrintChapter('Perihal', 0);
    $pdf->PrintChapter($data['perihal'], 1);
    $pdf->PrintChapter('Date Opened', 2);
    $pdf->PrintChapter($data['waktu_kirim'], 3);
    $pdf->PrintChapter('Keterangan', 0);
    $pdf->PrintChapter($data['ket'], 1);
    $pdf->PrintChapter('Date Closed', 2);
    $pdf->PrintChapter($data['waktu_closed'], 3);
    if($data['status']=='Closed'){
        $gambar= mysqli_query($koneksi, "SELECT * FROM tb_progress 
            where id_aduan='$id' and 
            tindakan<>'Diteruskan ke unit' and
            tindakan<>'Dikembalikan ke cs dengan keterangan Kurang Data' and
            tindakan<>'Closed'
            order by id_progress desc") or die(mysqli_error($koneksi));
        if($gambar = mysqli_fetch_array($gambar)){
            if(!is_null($gambar['bukti'])){
                $pdf->PrintChapter('Tindakan', 0);
                $pdf->PrintChapter($gambar['tindakan'], 1);
                $pdf->Image('../gambar/bukti/'.$gambar['bukti'], 20, $pdf->lastY+20,80);
            }
        }
    }
}
$pdf->Output();
?>