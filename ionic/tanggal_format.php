<?php
    function jquerytophp($tanggal) {
        $dd = substr($tanggal,0,2);
        $mm = substr($tanggal,3,5);
        $yy = substr($tanggal,6, 10);
        $tanggalHasil = $mm."/".$dd."-".$yy;
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