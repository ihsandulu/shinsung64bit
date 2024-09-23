<style>
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
    // loop berdasarkan jumlah array kj report_array
 // pre( $kanaan_po);
    $loop = 0 ; 
    foreach ($report_array as $key => $report) 
    {
        // code...
      //  pre ( $report);
        $columns = array_keys($report[0]);

        $qty_checking = $qtychecking_array[$loop]['qtychecking'];
        
        // echo $qty_checking  ;
        $kolom_ke = 3 ; 
?>

<div id="area_print"> <?php echo header_print(); ?>
  <div style="overflow-x:auto;">
    <div id="save_excel">
      <div align="center"><strong><?php echo $pagetitle; ?></strong></div>
      <br/>
      <div class="col-md-12">
        <h4><b>
          <?php   
                    echo $kanaan_po[$loop];
                ?>
          </b></h4>
      </div>
      <table border="1" width="100%" >
        <thead>
          <tr>
            <?php
                    foreach ($columns as $column) {
                            $column = str_replace("jam", "jam ", $column);  
                        
                    echo '<th>' . strtoupper($column) . '</th>';
                    }
                    ?>
            <th>TOTAL QTY <br>
              CHECK</th>
            <th>TOTAL QTY <br>
              DEFECT</th>
            <th>DEFECT RATE <br>
              %</th>
          </tr>
        </thead>
        <tbody>
          <?php
                        $total_perdefect = 0 ; 
                       $previous_jenis = null;
                       $rowspan = 1;
                        $total_perjam = array_fill(0, count($columns), 0); // Inisialisasi 
                        foreach ($report as $index => $row) {
                        echo '<tr>';
                         $start_kolom = 0 ; 
                         
                        foreach ($row as $key => $value) {
                            $css = "";
                            if (strpos($key, 'jam') === 0) {
                                $column_index = array_search($key, $columns); // Ambil indeks kolom jam
                                $total_perjam[$column_index] += intval($value); // Tambahkan nilai ke total per jam
                                $css= 'class="text-right"';
                            }

                            $n = "";
                            if($value!="0") 
                             {
                                    if($start_kolom>=$kolom_ke )
                                     { 
                                       $total_perdefect += intval($value) ;  
                                       //$jumlah['jam'.start_kolom] = 
                                     }

                               $n=$value; 
                             }
                            echo '<td '. $css.'>' . 
                            $n
                            . '</td>';
                            $start_kolom ++ ; 
                        }
                         $css= 'class="text-right"';
                         echo '<td '. $css.'>' ;
                        echo ($total_perdefect > 0 ) ? $qty_checking : ''  ;
                        echo  '</td>';

                           echo '<td '. $css.'>' ;
                           echo ($total_perdefect > 0 ) ? $total_perdefect : ''  ; 
                           echo '</td>';

                             echo '<td '. $css.'>' ;
                           echo ($total_perdefect > 0 ) ? $total_perdefect : ''  ; 
                           echo '</td>';
                            $start_kolom = 0 ; $total_perdefect= 0;
                        echo '</tr>';
                    }
                        ?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="3"> TOTAL </td>
            <?php
                       // pre ($total_perjam) ;
                        for ($i=0; $i <  $kolom_ke; $i++) { 
                             unset($total_perjam[$i]);
                         } 
                        foreach ($total_perjam as $total) {
                            $total = ($total > 0 ) ? $total : '' ;
                               echo '<td '. $css.'>' . $total . '</td>'; // Tampilkan total per jam di footer
                        }
                        ?>
            <td colspan="3"></td>
          </tr>
        </tfoot>
      </table>
    </div>
    <div class="row"> <br>
    </div>
  </div>
</div>
<?php
$loop++ ; 
    } //end loop berdasarkan jumlah array kj report_array


?>
<?php 
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



<script type="text/javascript">
    $("#ExportToExcel").click(function(e) {
        var a = document.createElement('a');
        //getting data from our div that contains the HTML table
        var data_type = 'data:application/vnd.ms-excel';
        var table_div = document.getElementById('save_excel');
        var table_html = table_div.outerHTML.replace(/ /g, '%20');
        a.href = data_type + ', ' + table_html;
        //setting the file name
        a.download = 'REPORT_DAILY_PERKJ_<?php echo date('Y-m-d'); ?>.xls';
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