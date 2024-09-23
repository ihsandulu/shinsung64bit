<style>
th {
	background-color: white;
	border-right: 1px solid black;
	border-left: 1px solid black;
	border-top: 1px solid black;
	border-bottom: 1px solid black;
	color: black;
	text-align: center; /* Teks di tengah kolom header */
	padding: 5px;
	white-space: nowrap; /* Prevent line breaks in table headers */
	overflow: hidden; /* Hide overflowing content *//*text-overflow: ellipsis;  Display ellipsis (...) for long content */
}
 @media print {
body {
	visibility: hidden;
	font-size:10px;
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
   // echo '$report_array =';  pre($report_array);
   // echo '$report_defect =';
    // pre($report_defect);
    // pre($report_array);
    //   pre($report);
   // pre($report_defect[0]);
    // loop berdasarkan jumlah array kj report_array
   // pre( $kanaan_po);
    $loop = 0 ; 
    // foreach ($report_array as $key => $report) 
    // {
    //     // code...
    //   //  pre ( $report);
    //     $columns = array_keys($report[0]);

    //     $qty_checking = $qtychecking_array[$loop]['qtychecking'];
        
    //     // echo $qty_checking  ;
    //     $kolom_ke = 3 ; 

// Array
// (
//     [line] => 60
//     [tanggal] => 2023-07-25
//     [kanaan_po] => KJ23NI045
//     [style] => FJ4810(HO23)
//     [color] => 410 MIDNIGHT NAVY/MIDNIGHT NAVY/(BLACK)
//     [qty_order] => 608
//     [qty_check] => 7
// )

?>

<div id="area_print"> <?php echo header_print(); ?>
  <div style="overflow-x:auto;">
    <div id="save_excel">
      <div align="center"><strong><?php echo $pagetitle; ?></strong></div>
      <br/>
      <table border="1" width="100%">
        <thead>
          <tr>
            <th>LINE</th>
            <th>TANGGAL</th>
            <th>FILE NO</th>
            <th>STYLE</th>
            <th>COLOR</th>
            <th>DES</th>
            <th>SIZE</th>
            <th>QTY ORDER</th>
            <th>QTY CHECK</th>
            <?php
                        foreach ($daftar_defect as $key => $defect_list) {
                            // code...
                            echo "<th>". $defect_list['kode']  ."</th>" ; 

                        }
                     ?>
            <th>TOTAL <BR>
              DEFECT</th>
            <th>% DR</th>
          </tr>
        </thead>
        <tbody>
          <?php  
                    $kanan = "style=' white-space: nowrap; text-align:right' ";
                    $g_qty_order = 0; 
                    $g_qty_cek = 0 ; 
                        foreach ($report_array as $key => $report) 
                       {
                        // pre($report);
                        echo "<tr>" ;
                        echo  "<td>". $report['line']  ."</td>";
                        echo  "<td style=' white-space: nowrap;'>". $report['tanggal'] ."</td>";
                        echo  "<td>". $report['kanaan_po'] ."</td>";
                        echo  "<td>". $report['style'] ."</td>";
                        echo  "<td style=' white-space: nowrap;'>". $report['color'] ."</td>";
                        echo  "<td style=' white-space: nowrap;'>". $report['des'] ."</td>";
                        echo  "<td style=' white-space: nowrap;'>". $report['size'] ."</td>";
                        echo  "<td $kanan>". $report['qty_order'] ."</td>";
                        $g_qty_order += $report['qty_order']  ; 
                        echo  "<td $kanan>". $report['qty_check'] ."</td>";
                        $qtycheck = $report['qty_check'] ; 
                        $g_qty_cek  +=  $report['qty_check'] ;
                        unset($report['qty_check'])    ;
                       // pre($report);
                       // $data= filter_array_data($report_defect , $report );
                        // $data = (displayDefectReport($report_array, $report_defect));
                       // pre($data); exit();
                        $sumdefect = 0 ; 
                        foreach ($daftar_defect as $key => $defect_list) {
                            // code.. echo "<th>". $defect_list['kode']   ."</th>" ;
                            // echo pre($defect_list['kode']);
                               $data= filter_array_data_plus_defect_code($report_defect , $report , str_replace('0','x', $defect_list['kode'])  ); 
                               if ($data)
                                {
                                     $sumdefect += $data[0]['qty_defect'] ; 
                                    echo "<td $kanan>" . $data[0]['qty_defect']   ."</td>";
                                }else
                                {
                                    $sumdefect += 0 ; 
                                    echo "<td>  -  </td>";
                                }
                        }
                         echo  "<td $kanan>". $sumdefect ."</td>";
                         echo  "<td $kanan>". round(($sumdefect / $qtycheck),4) * 100   ."</td>";
                       echo "</tr>" ;
                        }
                    ?>
        </tbody>
        <tfoot>
          <tr style="background-color : lightgray;" >
            <td colspan="7"> TOTAL </td>
            <td colspan="" style=' white-space: nowrap; text-align:right' ><?php echo $g_qty_order ?></td>
            <td colspan="" style=' white-space: nowrap; text-align:right'><?php echo $g_qty_cek ?></td>
            <?php
                    $total_defect = 0 ; 
                      foreach ($daftar_defect as $key => $defect_list) {
                        $data = filterArray_basedonline_kodedefect( $sum_defect,$defect_list['kode']  ) ; 
                            if ($data)
                                {
                                     $total_defect += $data[0]['qty_defect'] ; 
                                    echo "<td $kanan>" . $data[0]['qty_defect']   ."</td>";
                                }else
                                {
                                     $total_defect += 0; 
                                    echo "<td>  0  </td>";
                                }
                      }
                    ?>
            <td colspan="" style=' white-space: nowrap; text-align:right' ><?php echo $total_defect ?></td>
            <td colspan="" style=' white-space: nowrap; text-align:right' ><?php echo round(($total_defect / $g_qty_cek),4) * 100   ?></td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>
<div class="row"> <br>
</div>
<?php
$loop++ ; 
    // } //end loop berdasarkan jumlah array kj report_array


?>
<?php 
function filterArray_basedonline_kodedefect($array,   $filterKodeDefect) {
    $filteredArray = array_filter($array, function($item) use (  $filterKodeDefect) {
        return ( $item['kode_defect'] == $filterKodeDefect);
    });
    return array_values($filteredArray);
}

function filter_array_data_plus_defect_code($datanya , $filternya , $kodedefect)
{   
     $filteredArray = array_filter($datanya, function($item) use ($filternya , $kodedefect) {
        return (
            $item['line'] ==  $filternya['line'] && 
            $item['tanggal'] ==  $filternya['tanggal']  &&
            $item['kanaan_po'] ==  $filternya['kanaan_po']   &&  
            $item['style'] ==  $filternya['style']   && 
            $item['color'] ==  $filternya['color']   && 
            $item['qty_order'] ==  $filternya['qty_order']   && 
            $item['des'] ==  $filternya['des']   && 
            $item['size'] ==  $filternya['size']   && 
            $item['kode_defect10'] == $kodedefect
            // strval( $item['kode_defect']) == strval($kodedefect) &&  
            // count( $item['kode_defect']) == count($kodedefect)
        );
        pre( $filteredArray );
    });
    return array_values($filteredArray);
}


    


function displayDefectReport($report_array, $report_defect) {
    $result = array();
    foreach ($report_array as $item) {
        $defect_details = array();
        $defect_entries = array_filter($report_defect, function ($defect) use ($item) {
            return (
                $defect['line'] === $item['line'] &&
                $defect['tanggal'] === $item['tanggal'] &&
                $defect['kanaan_po'] === $item['kanaan_po'] &&
                $defect['style'] === $item['style'] &&
                $defect['color'] === $item['color'] &&
                $defect['qty_order'] === $item['qty_order']
            );
        });

        // foreach ($defect_entries as $defect) {
        //     $defect_details[] = array(
        //         'qty_defect' => $defect['qty_defect'],
        //         'kode_defect' => $defect['kode_defect'],
        //     );
        // }

        $result[] = array(
            'line' => $item['line'],
            'tanggal' => $item['tanggal'],
            'kanaan_po' => $item['kanaan_po'],
            'style' => $item['style'],
            'color' => $item['color'],
            'qty_order' => $item['qty_order'],
            // 'defect_details' => $defect_details,
        );
    }

    return $result;
}


function convertToDynamicTable($report) {
    // Mengambil semua kolom dari array pertama sebagai header tabel
    $columns = array_keys($report[0]);

    // Membangun tabel HTML
    $html = '<table>';
    
    // Membuat baris header
    $html .= '<tr>';
    foreach ($columns as $column) {
        $html .= '<th>' . $column . '</th>';
    }
    $html .= '</tr>';

    // Membuat baris data
    foreach ($report as $row) {
        $html .= '<tr>';
        foreach ($row as $value) {
            $html .= '<td>' . $value . '</td>';
        }
        $html .= '</tr>';
    }
    
    // Menutup tabel HTML
    $html .= '</table>';

    return $html;
}


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

	
function filterArray_basedonline($array, $filterLine ) {
    $filteredArray = array_filter($array, function($item) use ($filterLine ) {
        return ($item['line'] == $filterLine  );
    });
    return array_values($filteredArray);
}


 
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
        a.download = 'DAILY_DEFECT_RATE_<?php echo date('Y-m-d'); ?>.xls';
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