<?php
defined('BASEPATH') OR exit('No direct script access allowed');


function removeEmptyArrayKeys_per_arrya($array) {
    foreach ($array as $key => &$value) {
        if (is_array($value)) {
            $value = removeEmptyArrayKeys($value);
            if (empty($value)) {
                unset($array[$key]);
            }
        } else {
            if (empty($value)) {
                unset($array[$key]);
            }
        }
    }
    return $array;
}


function removeEmptyArrayKey(&$array) {
  // ini bisa membuang array berikutnya seperti array pertama
  
  $emptyKeys = array_keys($array[1], '');
  foreach($emptyKeys as $key) {
    unset($array[1][$key]);
    foreach($array as &$subArray) {
      unset($subArray[$key]);
    }
  }
  $numKeys = count($array[1]);
  foreach($array as &$subArray) {
    while(count($subArray) < $numKeys) {
      $subArray[] = '';
    }
  }
}


function format_tanggal($originalDate)
{
  return date("Y-m-d H:i:s", strtotime($originalDate));
}

function format_tanggal_notime($originalDate)
{
  return date("Y-m-d", strtotime($originalDate));
}

function format_tanggal_indonesia($originalDate)
{
  setlocale(LC_TIME, 'id_ID.utf8');

  return date('d F Y', strtotime($originalDate)) ; //date("Y-m-d H:i", strtotime($originalDate));
}

function hitung_selisih_hari( $sdate , $edate)
{
  $timestamp_sdate = strtotime($sdate);
  $timestamp_edate = strtotime($edate);
  
  $selisih_hari = ($timestamp_edate - $timestamp_sdate) / (60 * 60 * 24);
  $selisih_hari = ($selisih_hari>1) ? $selisih_hari + 1  : $selisih_hari ;
  return $selisih_hari;
}

function parse_entitas($str)
{
  $json = "{\"";
  $replace = str_replace('-', '" : "', $str);
  $replace = str_replace(',', '","', $replace);
  $replace = str_replace('.', '', $replace);
  $json .= $replace;
  $json .= "\"}";

  
  return json_decode($json, TRUE);
}
  
function a_to_zz()
{
  $letters = array();
  $letter = 'A';
  while ($letter !== 'AAA') {
      $letters[] = $letter++;
  }
  $letter = array_slice($letters,0);
  return $letter;
}
function pre($data)
{
  echo "<pre>";
  print_r ($data);
  echo "</pre>";
  // exit;
}
function pre_exit($data)
{
  echo "<pre>";
  print_r ($data);
   exit;
}

function pred($data)
{
	echo "<pre>";
	print_r ($data);
	exit;
}

function format_dollar($raw_price)
{
  return number_format( $raw_price, 2, ".", "");
}

function parse_float($d)
{
	return number_format(floatval($d), 2);
}

function modal_start($id, $title, $isModalFullScreen = TRUE)
{

  $fullScreenClass = "";
  if ($isModalFullScreen) {
    $fullScreenClass = "modal-fullscreen";
  }
	return '
		<div class="modal '.$fullScreenClass.'" id="'.$id.'" tabindex="-1" role="dialog">
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title">'.$title.'</h4>
		      </div>
		      <div class="modal-body">
	';
}

function modal_end()
{
	return '

	</div><!-- /.modal-content -->

   <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
    
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	';
}

function parseShippingMark($shippingMark)
{
  $explode = explode('</p>', $shippingMark);
  $replace = str_replace('<p>', '', $explode);

  $mark = array_filter($replace, function($a) {
    return trim($a) !== "";
  });
   
  return $mark;
}

function number_format_word($number)
{
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'localhost:3005/api/number_to_words',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => 'number='.$number,
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/x-www-form-urlencoded'
    ),
  ));

  $response = curl_exec($curl);

  curl_close($curl);

  $word = json_decode($response, TRUE);
  if ($word['status'] == 200) {
    return 'US DOLLARS '. str_replace('DOLLARS', '', strtoupper($word['words']));
  } else {
    return 0;
  }
}


function number_format_decimal($number)
{
  return number_format($number, 2, ',', '.' );
}


function number_format_($number)
{
  return number_format($number, 0, ',', '.' );
}

function descColor($str)
{
  if ($str == "OK") {
    return "bg-green";
  } elseif ($str == "BELUM INPUT DI KIS") {
    return "bg-yellow";
  } elseif ($str == "LEBIH INPUT DI KIS") {
    return "bg-red";
  }
}
 
 

function angkaKeBulan($angka) {
    $bulan = [
        1 => "Januari",
        2 => "Februari",
        3 => "Maret",
        4 => "April",
        5 => "Mei",
        6 => "Juni",
        7 => "Juli",
        8 => "Agustus",
        9 => "September",
        10 => "Oktober",
        11 => "November",
        12 => "Desember"
    ];

    if (isset($bulan[$angka])) {
        return $bulan[$angka];
    } else {
        return "";
    }
}

function getNamaHari($tanggal) {
  // Mendapatkan indeks hari (0 untuk Minggu, 1 untuk Senin, dst.)
  $indeks_hari = date('w', strtotime($tanggal));

  // Daftar nama-nama hari dalam bahasa Indonesia
  $nama_hari = array(
      'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'
  );

  // Mengambil nama hari sesuai dengan indeks
  return $nama_hari[$indeks_hari];
}



/*	
  <div id="area_header" style="display:none; margin-top:-50px;">
			<table width="100%" style="border: 1px solid #000;">
		  <tr>
			<td width="9%" rowspan="5" class="header" style="border-right:1px solid #000;" align="center"><img src="'.base_url().'assets/img/qc.png" height="60" /></td>
			<td width="10%" rowspan="5" class="header" style="border-right:1px solid #000;" align="center"><img src="'. base_url().'assets/img/logo.png" height="60" /></td>
			<td width="54%" rowspan="5" class="header" style="font-size:14px; text-align:center; border-right:1px solid #000;"><strong>PT. KANINDO MAKMUR JAYA <br/> ENDLINE INSPECTION REPORT </strong></td>
			<td width="10%" class="header" style="padding-left:5px;">No. Dokumen</td>
			<td width="17%" class="header">KMJ1QC/F-0010/IV/2015</td>
		  </tr>
		  <tr>
			<td class="header" style="padding-left:5px;">Tgl Terbit</td>
			<td class="header">01 April 2015</td>
		  </tr>
		  <tr>
			<td class="header" style="padding-left:5px;">Revisi</td>
			<td class="header">01</td>
		  </tr>
		  <tr>
			<td class="header" style="padding-left:5px;">Tgl. Efektif</td>
			<td class="header">11 Mei 2020</td>
		  </tr>
		  <tr>
			<td class="header" style="padding-left:5px;">Departemen</td>
			<td class="header">QC</td>
		  </tr>
		</table>
	<br/>
	
	</div>
	
	*/
  
function header_print()
{
	return '
	

	<div id="print" align="right"><button id="ExportToExcel" class="btn btn-info"> <i class="fa fa-file-excel-o"> </i> Export  to Excel</button> <button type="button" class="btn btn-success" onclick="window.print()"><i class="fa fa-print"> </i> Print </button></div><br/>

	';
	
	//<div id="judul" style="text-align:center; padding-bottom:0px; font-size:14px;"><b>'.$pagetitle.'</b></div>
}


function tgl ($tgl) {
	$tanggal = explode("-",$tgl);
	$tahun = $tanggal[0];
	$bulan = $tanggal[1];
	$ar_hari = explode(' ',$tanggal[2]);
	$hari = $ar_hari[0];
	if (empty($ar_hari[1])) {$jam = '';} else { $jam = $ar_hari[1];};
	$tanggal = $hari.'-'.$bulan.'-'.$tahun.' '.$jam;
	$tanggal = trim($tanggal);
	return $tanggal;
}


function error ($text) {
$pesanMessage = '<div class="box-body">
				  <div id="message" class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Error! </h4>
					'.$text.'
					</div>
				</div>';
return $pesanMessage;
};

function success ($text) {
$pesanMessage = '<div class="box-body">
				  <div id="message" class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Success! </h4>
					'.$text.'
					</div>
				</div>';
return $pesanMessage;
};

function notice ($text) {
$pesanMessage = '<div class="box-body">
				  <div id="message" class="alert alert-info alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Info! </h4>
					'.$text.'
					</div>
				</div>';
return $pesanMessage;
};


function indotgl($tgl) {
	$tanggal = explode("-",$tgl);
	$hari = $tanggal[2];
	$hari = explode(' ',$hari);
	if (empty($hari[1])) {$jam = '';} else { $jam = $hari[1];};
	$ar_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus','September','Oktober', 'November','Desember');
	
	if (empty($hari[0])) {$hari = '';} else { $hari = $hari[0];};
	if (empty($ar_bulan[abs($tanggal[1])])) {$bulan = '';} else { $bulan = $ar_bulan[abs($tanggal[1])];};
	if (empty($tanggal[0])) {$tahun = '';} else { $tahun = $tanggal[0];};

	$tanggal = $hari.' '.$bulan.' '.$tahun.' '.$jam;
	if($tahun == '0000') {
		return '-';
	} else {
		return $tanggal;
	}
}


function right($string, $n)
{
      $balik = strrev($string);
      $hasil = strrev(substr($balik, 0, $n));
      return $hasil;
}

/* End of file ry_helper.php */
/* Location: ./application/helpers/ry_helper.php */
