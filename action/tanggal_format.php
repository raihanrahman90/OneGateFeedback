<?php
    function htmltophp($tanggal) {
        $mm = substr($tanggal,0,2);
        $dd = substr($tanggal,3,5);
        $yy = substr($tanggal,6, 10);
        $tanggalHasil = $yy."-".$mm."-".$dd;
        echo $tanggal;
        return $tanggalHasil;
    }
    function phptohtml($tanggal){
        $yy = substr($tanggal, 0, 4);
        $mm = substr($tanggal, 5, 7);
        $dd = substr($tanggal, 8, 10);
        $tanggalHasil = $mm."-".$dd."-".$yy;
        return $tanggalHasil;
    }
?>