<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


    function selisihTanggal($tanggalLahir){
        $hariIni = "'" . date("Y-m-d") . "'";
        $sql = "select datediff($hariIni,$tanggalLahir) as selisih";
        $hasil = mysql_query($sql);
        $data = mysql_fetch_array($hasil);
        $yStr = "";
        $hasil = $data[0] ;
        if($hasil < 32){
            $yStr = floor($hasil) . " Hari";
        } elseif($hasil < 366){
            $yStr = floor($hasil / 30) . " Bulan";
        }else{
            $yStr = floor($hasil / 365) . " tahun";
        }
        return $yStr;
    }

    function dmyToYmd($tanggal){
        $tgl = explode("-", $tanggal);
        return $tgl2 = $tgl[2]."/".$tgl[1]."/".$tgl[0];
    }

    function ymdToDmy($tanggal){
        $tgl = explode("-", $tanggal);
        return $tgl2 = $tgl[2]."/".$tgl[1]."/".$tgl[0];
    }

    function DateToIndo($date) { // fungsi atau method untuk mengubah tanggal ke format indonesia
       // variabel BulanIndo merupakan variabel array yang menyimpan nama-nama bulan
            $BulanIndo = array("Januari", "Februari", "Maret",
                               "April", "Mei", "Juni",
                               "Juli", "Agustus", "September",
                               "Oktober", "November", "Desember");
        
            $tahun = substr($date, 0, 4); // memisahkan format tahun menggunakan substring
            $bulan = substr($date, 5, 2); // memisahkan format bulan menggunakan substring
            $tgl   = substr($date, 8, 2); // memisahkan format tanggal menggunakan substring
            
            $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;
            return($result);
    }

    function angkakebulan($angka){
        if ($angka==1) {
            $bulan = "JAN";
        } else if ($angka==2) {
            $bulan = "FEB";
        } else if ($angka==3) {
            $bulan = "MAR";
        } else if ($angka==4) {
            $bulan = "APR";
        } else if ($angka==5) {
            $bulan = "MEI";
        } else if ($angka==6) {
            $bulan = "JUN";
        } else if ($angka==7) {
            $bulan = "JUL";
        } else if ($angka==8) {
            $bulan = "AGS";
        } else if ($angka==9) {
            $bulan = "SEP";
        } else if ($angka==10) {
            $bulan = "OKT";
        } else if ($angka==11) {
            $bulan = "NOV";
        } else if ($angka==12) {
            $bulan = "DES";
        }
        
        return $bulan;
    }
	
	function DateEng($date) { // fungsi atau method untuk mengubah tanggal ke format indonesia
       // variabel BulanIndo merupakan variabel array yang menyimpan nama-nama bulan
            $month = array("January", "February", "March",
                               "April", "May", "June",
                               "July", "August", "September",
                               "October", "November", "December");
        
            $tahun = substr($date, 0, 4); // memisahkan format tahun menggunakan substring
            $bulan = substr($date, 5, 2); // memisahkan format bulan menggunakan substring
            $tgl   = substr($date, 8, 2); // memisahkan format tanggal menggunakan substring
            
            $result = $month[(int)$bulan-1]." ".$tgl.", ".$tahun;
            return($result);
    }

    function DateEng2($date) { // fungsi atau method untuk mengubah tanggal ke format indonesia
       // variabel BulanIndo merupakan variabel array yang menyimpan nama-nama bulan
            $month = array("January", "February", "March",
                               "April", "May", "June",
                               "July", "August", "September",
                               "October", "November", "December");
        
            $tahun = substr($date, 0, 4); // memisahkan format tahun menggunakan substring
            $bulan = substr($date, 5, 2); // memisahkan format bulan menggunakan substring
            $tgl   = substr($date, 8, 2); // memisahkan format tanggal menggunakan substring
            
            $result = $tgl." ".$month[(int)$bulan-1].", ".$tahun;
            return($result);
    }
/* End of file download_helper.php */
/* Location: ./system/helpers/download_helper.php */