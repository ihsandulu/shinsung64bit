<?php
// pre($report);
?>

<style>
@media print {
body {
	visibility: hidden;
	font-size:12px;
}
#area_print {
	visibility: visible;
	left: 0;
	top: 0;
}
#judul {
	display: inherit !important;
}
#area_header {
	display: inherit !important;
}
#print {
	display: none !important;
}
}
table {
	border-collapse: collapse;
	width: 100%; /* Menambahkan lebar tabel 100% agar selalu mengisi lebar container */
	padding: 3px;
}
th {
	background-color: white;
	border-right: 1px solid black;
	border-left: 1px solid black;
	border-top: 1px solid black;
	border-bottom: 1px solid black;
	color: black;
	text-align: center; /* Teks di tengah kolom header */
	padding: 5px;
}
td {
	border: 1px solid black;
	padding: 3px;
}
.header {
	border:0px solid #000;
	padding:0px;
	margin:0px;
	font-size:11px;
}
</style>
<?php
// pre($report);
$unique_defect = array_unique(array_column($report, 'keterangan'));
 // pre($unique_defect);

$unique_data = array_unique($report, SORT_REGULAR); 
//   pre($qtychecking_array);

 $startDate = strtotime($sdate);
 $endDate = strtotime($edate);
?>

<div id="area_print"> <?php echo header_print(); ?>
  <div style="overflow-x:auto;">
    <div id="save_excel">
      <div align="center"><strong><?php echo $pagetitle; ?></strong></div>
      <br/>
      <table width="100%" border="1">
        <thead>
         
          <tr>
            <!-- <?php //pre($report[0]);?> -->
            <th>LINE</th>
            <th>FILE NO</th>
            <th>STYLE_NO</th>
            <th>ITEM</th>
            <th>COLOR</th>
            <th>QTYGLOBAL</th>
            <th>DES</th>
            <th>GAC</th>
            <th>SIZE</th>
            <th>HASIL</th>
          </tr>
        </thead>
        <tbody>
                <?php
                 $totalAll = 0 ; 
                    foreach ($report as $key => $value) {
                        echo "<tr>";
                        unset($value['TANGGAL_PRODUKSI']);
                        $currentLine = $value['LINE'];
                        static $previousLine = null;
                        static $lineTotal = 0;
                        
                        if ($previousLine !== $currentLine && $previousLine !== null) {
                            echo "<tr style='background-color: lightgray; font-weight: bold;'><td colspan='9' style='text-align:center;'> Total per Line:</td><td  style='text-align: right;' >$lineTotal</td></tr>";
                            $lineTotal = 0; // Reset line total for the new line
                        }
                        
                        foreach ($value as $key => $dt) {
                            echo "<td style='text-align: left;'> $dt </td>";
                            if ($key == 'HASIL') {
                                $lineTotal += $dt;
                            }
                        }
                        echo "</tr>";
                        
                        $previousLine = $currentLine; // Update previous line to current line after processing
                        $totalAll  += $lineTotal ; 
                    }
                    echo "<tr style='background-color: lightgray; font-weight: bold;'><td colspan='9' style='text-align:center;'> Total per Line:</td><td  style='text-align: right;' >$lineTotal</td></tr>";
                    echo "<tr style='background-color: gray; font-weight: bold;'><td colspan='9' style='text-align:center;'> TOTAL $Periode Line $LineSewing  </td><td  style='text-align: right;' >$totalAll</td></tr>";
                ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php 
function filterByTanggal($total_produksi, $tanggal) {
    foreach ($total_produksi as $data) {
        if ($data['tanggal'] == $tanggal) {
            return $data['jumlah'];
        }
    }

    return 0;
}

function calculateTotalOverall($report) {
    $total = 0;

    foreach ($report as $data) {
        $total += $data['jumlah'];
    }

    return $total;
}


    function calculateTotalByDate( $report , $tanggal) {
    $total = 0;
    foreach ($report as $data) {
        if ($data['tanggal'] == $tanggal) {
            $total += $data['jumlah'];
        }
    }

    return $total;
    }

    function calculateTotalByKodeDefect($report, $kode_defect) {
    $total = 0;

    foreach ($report as $data) {
        if ($data['keterangan'] == $kode_defect) {
            $total += $data['jumlah'];
        }
    }

    return $total;
}


    function filterDataByTanggalKodeDefect($report, $tanggal, $keterangan) {
    $filtered_data = array();

    foreach ($report as $data) {
        $tanggal_data = $data['tanggal'];
        $kode_defect_data = $data['keterangan'];

        if ($tanggal_data == $tanggal && $kode_defect_data == $keterangan) {
            $filtered_data[] = $data;
        }
    }

    return $filtered_data;
}

	function filterArray_basedonline_kodedefect($array, $filterLine, $filterKodeDefect) {
    $filteredArray = array_filter($array, function($item) use ($filterLine, $filterKodeDefect) {
        return ($item['line'] == $filterLine && $item['kode_defect'] == $filterKodeDefect);
    });
    return array_values($filteredArray);
}
function filterArray_basedonline($array, $filterLine ) {
    $filteredArray = array_filter($array, function($item) use ($filterLine ) {
        return ($item['line'] == $filterLine  );
    });
    return array_values($filteredArray);
}
 
?>
<?php
$unique_lines = array_unique(array_column($report, 'line'));
//print_r($unique_lines);
//pre ($report);
?>
<script type="text/javascript">
    $("#ExportToExcel").click(function(e) {
        var a = document.createElement('a');
        //getting data from our div that contains the HTML table
        var data_type = 'data:application/vnd.ms-excel';
        var table_div = document.getElementById('save_excel');
        var table_html = table_div.outerHTML.replace(/ /g, '%20');
        a.href = data_type + ', ' + table_html;
        //setting the file name
        a.download = 'REPORT HASIL PRODUKSI <?php echo "$Periode Line $LineSewing " . date('Y-m-d'); ?>.xls';
        //triggering the function
        a.click();
        //just in case, prevent default behaviour
        e.preventDefault();
    });
</script> 

<!--
<style>
    @media print {
        table {
            border-collapse: collapse;
            padding: 3px;
        }

        th {
            background-color: white;
            border-right: 2px solid black;
            border-left: 2px solid black;
            border-top: 2px solid black;
            border-bottom: 2px solid black;
            color: black;
             padding: 3px;
        }

        td {
            border: 1px solid black;
             padding: 3px;
        }
    }

    table {
        border-collapse: collapse;
        width: 100%; /* Menambahkan lebar tabel 100% agar selalu mengisi lebar container */
        padding: 3px;
    }

    th {
        background-color: white;
        border-right: 2px solid black;
        border-left: 2px solid black;
        border-top: 2px solid black;
        border-bottom: 2px solid black;
        color: black;
        text-align: center; /* Teks di tengah kolom header */
         padding: 3px;
    }

    td {
        border: 1px solid black;
         padding: 3px;
    }
</style>

-->