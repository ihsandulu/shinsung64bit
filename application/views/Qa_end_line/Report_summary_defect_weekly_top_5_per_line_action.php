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
 // pre($total_produksi);
?>

<div id="area_print"> <?php echo header_print(); ?>
  <div style="overflow-x:auto;">
    <div id="save_excel">
      <div align="center"><strong><?php echo $pagetitle; ?></strong></div>
      <br/>
      <table width="100%" border="1">
        <thead>
          <tr>
            <th rowspan="2">NO</th>
            <th>SUMMARY TOP 5 DEFECT</th>
            <th colspan="7">WEEK <?php echo $week ?> <br>
              <?php echo $start_week['startweek'].' - '. $start_week['akhirwek']   ?> </th>
            <!-- <th colspan="2"> <?php echo $start_week['startweek'].' - '. $start_week['akhirwek']  ?> </th> --> 
          </tr>
          <tr>
            <th>CATEGORY</th>
            <?php 
                foreach ($nama_hari  as $line1 ) {
                    // code... looping line header
                   echo "<th>";  echo $line1['hari'];
                   // pre($line1);
                   echo "</th>";
                }
             ?>
            <th >TOTAL</th>
            <th colspan="2">% CUMULATIVE</th>
          </tr>
        </thead>
        <tbody>
          <?php
         $cumulative = 0 ;
         $baris = 0;
         $total_defect_all = calculateTotalOverall($report) ;
            // for ($i=0; $i <count($unique_defect) ; $i++) { 
            foreach ($unique_defect as $keterangan) {
                // code...
           
        ?>
          <tr>
            <?php
           
          //  $kode_defect =  $unique_defect[$i]['kode_defect'] ;
            $baris += 1 ; 
            
                echo "<td> $baris </td>";
                echo "<td>". $keterangan ."</td>";
                // loop pertanggal 
                
                foreach ($nama_hari  as $hari ) {
                    // code... looping line header
                      $tanggal_hari = $hari['tanggal'];
                        $filtered_data = filterDataByTanggalKodeDefect($report, $tanggal_hari, $keterangan) ; 
                       if (empty($filtered_data))
                        {
                   echo "<td>";    
                   echo "</td>";
                        }else
                        {
                            echo "<td>";
                            echo $filtered_data[0] ['jumlah']; 
                            echo "</td>";
                        }

                }

                 echo "<td>". calculateTotalByKodeDefect($report  , $keterangan) ."</td>";
                    $cumulative = $cumulative + calculateTotalByKodeDefect($report  , $keterangan ) ; 
                 echo "<td>".  $cumulative ."</td>";
                 echo "<td>".  round(($cumulative / $total_defect_all) * 100,0)  ." %</td>";
            ?>
          </tr>
          <?php
            }
            ?>
            </tr>
          
          <tr>
            <td colspan="2"> TOTAL DEFECTS </td>
            <?php
              $sum_defect_all = 0 ; 
                 foreach ($nama_hari  as $hari ) {
                    // code... looping line header
                      $tanggal_hari = $hari['tanggal'];
                          echo "<td>";
                       echo  calculateTotalByDate($report ,  $tanggal_hari );
                       $sum_defect_all += calculateTotalByDate($report ,  $tanggal_hari ) ; 
                       echo "</td>";
                }
                 echo "<td>". $sum_defect_all ."</td>";
              ?>
            <td colspan="2"></td>
          </tr>
          <tr>
            <td colspan="2"> PRODUCTION </td>
            <?php
              $sum_production = 0 ; 
                 foreach ($nama_hari  as $hari ) {
                    // code... looping line header
                      $tanggal_hari = $hari['tanggal'];
                          echo "<td>";
                        
                        echo filterByTanggal($total_produksi, $tanggal_hari); 
                         $sum_production +=filterByTanggal($total_produksi, $tanggal_hari);
                       echo "</td>";
                }
                 echo "<td>". $sum_production ."</td>";
              ?>
            <td colspan="2"></td>
          </tr>
          <tr>
            <td colspan="2"> TOTAL % DEFECTIVE </td>
            <?php
              
                 foreach ($nama_hari  as $hari ) {
                    // code... looping line header
                      $tanggal_hari = $hari['tanggal'];

                      $total_presen_defect = 0; 
                         if (filterByTanggal($total_produksi, $tanggal_hari) > 0 )
                         {
                          $total_presen_defect =  calculateTotalByDate($report ,  $tanggal_hari )  / filterByTanggal($total_produksi, $tanggal_hari); 
                          }

                          echo "<td>";
                         echo (round($total_presen_defect,2) > 0 ) ? round($total_presen_defect,2). ' %' : "" ;
                       echo "</td>";
                }

                //  echo "<td>".     round( $sum_defect_all / $sum_production ,2)     ."%</td>";
                echo "<td>";
                    if ($sum_production != 0) {
                        echo round($sum_defect_all / $sum_production, 2) . "%";
                    } else {
                        echo "0"; // Atau pesan kesalahan lainnya
                    }
                    echo "</td>";

              ?>
            <td colspan="2"></td>
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
        a.download = 'REPORT_TOP_5_WEEKLY_LINE_<?php echo date('Y-m-d'); ?>.xls';
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