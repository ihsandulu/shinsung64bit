<style>
@media print {
body {
	visibility: hidden;
	font-size:6px;
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
	font-size:12px;
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
$unique_lines = array_unique(array_column($report, 'line'));
$uniqueSupervisors = [];
foreach ($chief as $item) {
    $supervisor = $item['nama_supervisor'];
    if (!isset($uniqueSupervisors[$supervisor])) {
        $uniqueSupervisors[$supervisor] = 1;
    } else {
        $uniqueSupervisors[$supervisor]++;
    }
}
?>

<div id="area_print">
<?php echo header_print(); ?>
<div style="overflow-x:auto;">
  <div id="save_excel">
    <div align="center"><strong><?php echo $pagetitle; ?></strong></div>
    <br/>
    <table border="1"  width="100%">
      <thead>
        <tr>
          <th>NO</th>
          <th>DEFECT</th>
          <?php 
                foreach ($unique_lines  as $line1 ) {
                	// code... looping line header
                	echo "<th> Line $line1 </th>";
                }
             ?>
        </tr>
        <tr>
          <td colspan="2"></td>
          <?php 
                foreach ($uniqueSupervisors as $supervisor => $count) {
                    // echo "Nama Supervisor: $supervisor, Jumlah: $count<br>";
                    echo "<th colspan=$count > CHIEF $supervisor </th>";
                }
             ?>
        </tr>
      </thead>
      <tbody>
        <?php 
        $total_defect_per_line = array();
        foreach ($unique_lines  as $line1 ) {
             $total_defect_per_line[$line1] = 0;
        }
        $no=1;
        foreach ($daftar_defect as $defect): 
        $kode_defect =  $defect['kode']; 
        
        ?>
        <tr>
          <td><?php echo $no ?></td>
          <td><?php echo $defect['keterangan'];  ?> <?php echo $defect['kode'];  ?></td>
          <?php 
	                foreach ($unique_lines  as $line1 ) {
	                	 $filteredResult = filterArray_basedonline_kodedefect($report, $line1, 
	                	 	$kode_defect);
	                	if (empty($filteredResult))
	                	{
	                		echo "<td>   </td>";
                            $total_defect_per_line[$line1] = $total_defect_per_line[$line1] + 0;
	                	}else{
	                	   echo "<td>";  echo ($filteredResult[0]['jumlah']);    echo " </td>";
                           $total_defect_per_line[$line1] =$total_defect_per_line[$line1] +  $filteredResult[0]['jumlah'] ; 
	                	}
	                }
             	  ?>
        </tr>
        <?php $no++; 
         endforeach; 
         // pre($total_defect_per_line);
         //  exit();
          $persen_defect_per_line = array();
          ?>
        <tr>
          <td colspan="2"> TOTAL DEFECT PER LINE </td>
          <?php
                 foreach ($unique_lines  as $line1 ) {
                            echo "<td>" . $total_defect_per_line[$line1] ." </td>";
                }
            ?>
        </tr>
        <tr>
          <td colspan="2"> TOTAL PRODUKSI PER LINE </td>
          <?php
                        foreach ($unique_lines  as $line1 ) {
                             $filteredResult = filterArray_basedonline($total_produksi, $line1);
                             if (empty($filteredResult))
                                {
                                    echo "<td>   </td>";                           
                                }else{
                                   echo "<td>";  echo ($filteredResult[0]['jumlah']);    echo " </td>";
                                   //echo $total_defect_per_line[$line1] ; echo $filteredResult[0]['jumlah'] ;  
                                   if ($filteredResult[0]['jumlah'] >0)
                                    { 
                                        $persen_defect_per_line[$line1] = $total_defect_per_line[$line1]  / $filteredResult[0]['jumlah']  ;
                                    }
                                    else
                                    {
                                        $persen_defect_per_line[$line1] = 0;
                                    }
                                }
                        }
                    ?>
        </tr>
        <tr>
          <td colspan="2"> TOTAL % DEFECT PER LINE </td>
          <?php
             $total_presen_defect = array();
             $temp_chief = "";  
                foreach ($unique_lines  as $line1 ) {
                    $filteredResult = filterArray_basedonline($total_produksi, $line1);
                     if (empty($filteredResult))
                        {
                            echo "<td>   </td>";                           
                        }else{
                            if ( $filteredResult[0]['jumlah']  > 0 )
                              {
                               echo "<td style='word-wrap: no-word'>";  echo round($persen_defect_per_line[$line1] ,4 ) * 100 ;    
                               echo "  %</td>";                               
                              }else
                              {
                                    echo "<td>  </td>";
                              }
                        }

                }
             ?>
        </tr>
        <?php //kombinasikan persen defect dengan data chief 
foreach ($chief as $key => $value) {
    $line = $value['line'];
    if (isset($persen_defect_per_line[$line])) {
        $chief[$key]['persen_defect'] = round($persen_defect_per_line[$line],4) * 100;
    } else {
        $chief[$key]['persen_defect'] = 0;
    }
}
$combined_defect_percentage = [];
foreach ($chief as $item) {
    $nama_supervisor = $item['nama_supervisor'];
    $persen_defect = $item['persen_defect'];
    if (!isset($combined_defect_percentage[$nama_supervisor])) {
        $combined_defect_percentage[$nama_supervisor] = $persen_defect;
    } else {
        $combined_defect_percentage[$nama_supervisor] += $persen_defect;
    }
}
?>
        <tr>
          <td colspan="2"> TOTAL % DEFECT PER CHIEF </td>
          <?php 
                $no = 0 ; 
                $offset_array = array_values($combined_defect_percentage);
                foreach ($uniqueSupervisors as $supervisor => $count) {
                    $jumlah = $offset_array[$no];
                    echo "<td colspan=$count> $jumlah %</td>";
                    $no++;
                }  
                ?>
        </tr>
      </tbody>
    </table>
    <br/>
  </div>
</div>
<?php 
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
        a.download = 'SUMMARY_DEFECT_PERMANAGER_<?php echo date('Y-m-d'); ?>.xls';
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
         width: 100%;  Menambahkan lebar tabel 100% agar selalu mengisi lebar container 
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