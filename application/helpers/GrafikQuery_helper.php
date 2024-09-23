<?php
defined('BASEPATH') or exit('No direct script access allowed');


function Defect_rate($buyer, $tanggal_awal, $tanggal_akhir, $line)
{

	// pre($data);
	$d1 =   get_daftar_kj_from_buyer($buyer, $tanggal_awal, $tanggal_akhir, $line);
	// pre($d1);
	$line_number = "";
	//  $result[] = array();
	$qty_check = 0;
	$qty_defect = 0;
	if (count($d1) > 0) {
		$daftar_line =  get_daftar_line_from_list_kj($d1, $tanggal_awal, $tanggal_akhir, $line);
		//   echo '		$daftar_line = '; pre($daftar_line);
		$array_qty_cek =  get_qty_chek_from_list_kj($d1, $tanggal_awal, $tanggal_akhir, $line);
		//  echo '		$array_qty_cek = ';  pre($array_qty_cek);
		$array_qty_defect =  get_qty_defect_from_list_kj($d1, $tanggal_awal, $tanggal_akhir, $line);
		//   echo '		$array_qty_defect = '; pre($array_qty_defect);


		// join ke tabel daftarline , qty cek ,  defect 



		foreach ($daftar_line as $line_item) {
			$line_number = $line_item['line'];


			// cari qty_check in $array_qty_cek
			foreach ($array_qty_cek as $cek_item) {
				if ($cek_item['LINE'] == $line_number) {
					$qty_check = $cek_item['qty_check'];
					break;
				}
			}
			// cari qty_defect in $array_qty_defect
			foreach ($array_qty_defect as $defect_item) {
				if ($defect_item['LINE'] == $line_number) {
					$qty_defect = $defect_item['qty_defect'];
					break;
				}
			}
			// Calculate defect_percentage
			$deftotal = $qty_defect + $qty_check;
			$defect_percentage = ($qty_check > 0) ? round(($qty_defect / $deftotal) * 100, 0) : 0;
			$result[] = [
				'line' => $line_number,
				'qty_check' => $qty_check,
				'qty_defect' => $qty_defect,
				'defect_percentage' => $defect_percentage,
			];
		}
		// echo '		$result = '; pre($result);
		$avgLine = [
			'line' => 'AVG',
			'qty_check' => 0,
			'qty_defect' => 0,
			'defect_percentage' => 0,
		];

		// Loop through the result array to calculate the sums
		foreach ($result as $line_item) {
			// echo '		$line_item = '; pre($line_item);
			$avgLine['qty_check'] += $line_item['qty_check'];
			$avgLine['qty_defect'] += $line_item['qty_defect'];
			$avgLine['defect_percentage'] += $line_item['defect_percentage'];
		}

		// Calculate the average defect_percentage
		// if (count($result) > 0) {
		// 	$avgLine['defect_percentage'] /= count($result);
		// }
		if (count($result) > 0) {
			$avgLine['defect_percentage'] /= count($result);
			$avgLine['defect_percentage'] = round($avgLine['defect_percentage']);
		}

		array_push($result, $avgLine);
	}
	if (count(@$result) == 0) {
		echo " <div align='center' > No DATA </div> ";
	} else {
		return ($result);
	}
}

function Defect_ratew($buyer, $tanggal_awal, $tanggal_akhir, $line)
{

	// pre($data);
	$d1 =   get_daftar_kj_from_buyer($buyer, $tanggal_awal, $tanggal_akhir, $line);
	// pre($d1);
	$line_number = "";
	//  $result[] = array();
	$qty_check = 0;
	$qty_defect = 0;
	if (count($d1) > 0) {
		$daftar_line =  get_daftar_line_from_list_kj($d1, $tanggal_awal, $tanggal_akhir, $line);
		//   echo '		$daftar_line = '; pre($daftar_line);
		$array_qty_cek =  get_qty_chek_from_list_kj($d1, $tanggal_awal, $tanggal_akhir, $line);
		//  echo '		$array_qty_cek = ';  pre($array_qty_cek);
		$array_qty_defect =  get_qty_defect_from_list_kj($d1, $tanggal_awal, $tanggal_akhir, $line);
		//   echo '		$array_qty_defect = '; pre($array_qty_defect);


		// join ke tabel daftarline , qty cek ,  defect 



		foreach ($daftar_line as $line_item) {
			$line_number = $line_item['line'];


			// cari qty_check in $array_qty_cek
			foreach ($array_qty_cek as $cek_item) {
				if ($cek_item['LINE'] == $line_number) {
					$qty_check = $cek_item['qty_check'];
					break;
				}
			}
			// cari qty_defect in $array_qty_defect
			foreach ($array_qty_defect as $defect_item) {
				if ($defect_item['LINE'] == $line_number) {
					$qty_defect = $defect_item['qty_defect'];
					break;
				}
			}
			// Calculate defect_percentage
			$deftotal = $qty_defect + $qty_check;
			$defect_percentage = ($qty_check > 0) ? round(($qty_defect / $deftotal) * 100, 0) : 0;
			$result[] = [
				'line' => $line_number,
				'qty_check' => $qty_check,
				'qty_defect' => $qty_defect,
				'defect_percentage' => $defect_percentage,
			];
		}
		// echo '		$result = '; pre($result);
		$avgLine = [
			'line' => 'AVG',
			'qty_check' => 0,
			'qty_defect' => 0,
			'defect_percentage' => 0,
		];

		// Loop through the result array to calculate the sums
		foreach ($result as $line_item) {
			// echo '		$line_item = '; pre($line_item);
			$avgLine['qty_check'] += $line_item['qty_check'];
			$avgLine['qty_defect'] += $line_item['qty_defect'];
			$avgLine['defect_percentage'] += $line_item['defect_percentage'];
		}

		// Calculate the average defect_percentage
		// if (count($result) > 0) {
		// 	$avgLine['defect_percentage'] /= count($result);
		// }
		if (count($result) > 0) {
			$avgLine['defect_percentage'] /= count($result);
			$avgLine['defect_percentage'] = round($avgLine['defect_percentage']);
		}

		array_push($result, $avgLine);
	}
	if (count(@$result) == 0) {
		echo " <div align='center' > No DATA </div> ";
	} else {
		return ($result);
	}
}

function get_daftar_kj_from_buyer($buyer, $start_date, $end_date, $line)
{
	$tabel = "[dbo].[inspect_v2]";
	if ($start_date == $end_date) {
		if ($start_date == date("Y-m-d")) {
			$tabel = "[dbo].[inspect_v2_hari_ini]";
		}
	}

	$sql = " SELECT  distinct 
				ins.kanaan_po    
				from $tabel ins 
				where ins.kanaan_po is not null 
				 and
				 CONVERT(VARCHAR(10), ins.tanggal, 120) 
				 between
				 '$start_date' and '$end_date'
				 and buyer like '%$buyer%'
				AND ( '$line' IN (SELECT Value FROM [dbo].[SplitString]('$line', ','))); 
				   ";
	//   echo $sql;

	return execute_query_resultarray_and_log($sql);
}
function get_daftar_line_from_list_kj($daftar_kj, $start_date, $end_date, $line)
{
	$tabel = "[dbo].[inspect_v2]";
	if ($start_date == $end_date) {
		if ($start_date == date("Y-m-d")) {
			$tabel = "[dbo].[inspect_v2_hari_ini]";
		}
	}

	$tempTable = [];
	foreach ($daftar_kj as $item) {
		$tempTable[] = "'" . $item['kanaan_po'] . "'";
	}
	$kanaanPoValues = implode(',', $tempTable);
	// pre(strlen($kanaanPoValues));
	$where = " and kanaan_po in ($kanaanPoValues) ";
	if (strlen($kanaanPoValues) == 0) {
		$kanaanPoValues = '';
		$where = " ";
	}
	$sql = " 
			SELECT DISTINCT  convert( int , ins.line) line 
			FROM $tabel  ins
			 WHERE CONVERT(VARCHAR(10), ins.tanggal, 120) between
			   '$start_date' and '$end_date' 
			   $where
			   AND ('$line' = '' OR line IN (SELECT Value FROM [dbo].[SplitString]('$line', ',')))
			ORDER BY  convert( int , ins.line)  
				 ;   ";
	// echo $sql;
	return execute_query_resultarray_and_log($sql);
}

function get_qty_chek_from_list_kj($daftar_kj, $start_date, $end_date, $line)
{
	$tabel = "[dbo].[inspect_v2]";
	if ($start_date == $end_date) {
		if ($start_date == date("Y-m-d")) {
			$tabel = "[dbo].[inspect_v2_hari_ini]";
		}
	}

	$tempTable = [];
	foreach ($daftar_kj as $item) {
		$tempTable[] = "'" . $item['kanaan_po'] . "'";
	}
	$kanaanPoValues = implode(',', $tempTable);

	$where = " and kanaan_po in ($kanaanPoValues) ";
	if (strlen($kanaanPoValues) == 0) {
		$kanaanPoValues = '';
		$where = " ";
	}



	$sql = " 
				SELECT sum(QTY) qty_check,
			 
				       LINE   
				FROM
				sewing_hasil_produksi 
				  
				   WHERE CONVERT(VARCHAR(10),TANGGAL_HASIL, 120) between
				   '$start_date' and '$end_date' 
				   $where
				   AND ('$line' = '' OR line IN (SELECT Value FROM [dbo].[SplitString]('$line', ',')))
					 
				GROUP BY  
				         LINE  ";
	// echo $sql;
	return execute_query_resultarray_and_log($sql);
}

function get_qty_defect_from_list_kj($daftar_kj, $start_date, $end_date, $line)
{
	$tabel = "[dbo].[inspect_v2]";
	if ($start_date == $end_date) {
		if ($start_date == date("Y-m-d")) {
			$tabel = "[dbo].[inspect_v2_hari_ini]";
		}
	}

	$tempTable = [];
	foreach ($daftar_kj as $item) {
		$tempTable[] = "'" . $item['kanaan_po'] . "'";
	}
	$kanaanPoValues = implode(',', $tempTable);


	$where = " and kanaan_po in ($kanaanPoValues) ";
	if (strlen($kanaanPoValues) == 0) {
		$kanaanPoValues = '';
		$where = " ";
	}
	$sql = " 
				SELECT count(*) qty_defect,
    
				       LINE 
					   
				FROM
				  (SELECT CONVERT(VARCHAR(10), ins.tanggal, 120) tanggal,
				          LINE
				   FROM $tabel ins
				    WHERE CONVERT(VARCHAR(10), ins.tanggal, 120) between
					'$start_date' and '$end_date'
					$where
				     AND kode_defect <> 'ok' 
					 AND ('$line' = '' OR line IN (SELECT Value FROM [dbo].[SplitString]('$line', ',')))
					 ) AS DATA
				GROUP BY 
				         LINE
				ORDER BY LINE ;	  ";
	// echo $sql;
	return execute_query_resultarray_and_log($sql);
}
