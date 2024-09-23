<style>
    th {
        background-color: white;
        border-right: 1px solid black;
        border-left: 1px solid black;
        border-top: 1px solid black;
        border-bottom: 1px solid black;
        color: black;
        text-align: center;
        /* Teks di tengah kolom header */
        padding: 5px;
        white-space: nowrap;
        /* Prevent line breaks in table headers */
        overflow: hidden;
        /* Hide overflowing content */
        /*text-overflow: ellipsis;  Display ellipsis (...) for long content */
    }

    @media print {
        body {
            visibility: hidden;
            font-size: 10px;
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
        width: 100%;
        /* Menambahkan lebar tabel 100% agar selalu mengisi lebar container */
        padding: 3px;
    }

    th {
        background-color: white;
        border-right: 1px solid black;
        border-left: 1px solid black;
        border-top: 1px solid black;
        border-bottom: 1px solid black;
        color: black;
        text-align: center;
        /* Teks di tengah kolom header */
        padding: 5px;
    }

    td {
        border: 1px solid black;
        padding: 3px;
    }

    .header {
        border: 0px solid #000;
        padding: 0px;
        margin: 0px;
        font-size: 11px;
    }
</style>
<?php
//    qty_check_harian_line
// qty_defect_harian_line
// daftar_line
// pre($tanggal);
// pre($qty_check_harian_line[0]);
// pre($qty_defect_harian_line[0]);
function getDistinctDates($array)
{
    $distinct_dates = array();

    foreach ($array as $item) {
        $date = $item['tanggal'];
        if (!in_array($date, $distinct_dates)) {
            $distinct_dates[] = $date;
        }
    }

    return $distinct_dates;
}

$distinct_dates = getDistinctDates($qty_check_harian_line);
// print_r($distinct_dates);
?>

<div id="area_print"> <?php echo header_print(); ?>
    <div style="overflow-x:auto;">
        <div id="save_excel">
            <div align="center"><strong><?php echo $pagetitle; ?></strong></div>
            <br />
            <table border="1" width="100%">
                <thead>
                    <tr>
                        <th rowspan="2">TANGGAL</th>
                        <th colspan="<?php echo count($daftar_line) ?>">DR %</th>
                        <th rowspan="2">AVERAGE</th>
                    </tr>
                    <tr>
                        <?php
                        $arr_sum = array();
                        foreach ($daftar_line as $key => $value) {
                            echo "<th> LINE " . $value['line'] . "</th>";
                            $arr_sum[$value['line']] = 0;
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $kanan = "style=' white-space: nowrap; text-align:right' ";
                    $g_qty_order = 0;
                    $g_qty_cek = 0;
                    $g_avg = 0;
                    foreach ($distinct_dates as $key => $value) {
                        // code...
                        $tanggal = $value;
                        $avg = 0;
                        $avgcount = 0;
                        echo " <tr>";
                        echo " <td> " . $tanggal . "</td>";
                        // hitung defect rate 
                        foreach ($daftar_line as $key => $d_line) {
                            // code...
                            $line = $d_line['line'];

                            $dt_check = filterArray_based_on_line_tanggal($qty_check_harian_line, $line, $tanggal);
                            $dt_defect = filterArray_based_on_line_tanggal($qty_defect_harian_line, $line, $tanggal);
                            $q_check = 0;
                            $q_defect = 0;
                            $dr = 0;
                            if ($dt_check && $dt_defect) {
                                // code...
                                $q_check = $dt_check[0]['qty_check'];
                                $q_defect = $dt_defect[0]['qty_defect'];
                                $dr = round($q_defect / $q_check, 2) * 100;
                                $avgcount++;
                            } elseif ($dt_check) {
                                $q_check = $dt_check[0]['qty_check'];
                                $q_defect = 0;
                                $dr = round($q_defect / $q_check, 2) * 100;
                                $avgcount++;
                            } else {
                                $q_check = 0;
                                $q_defect = 0;
                                $dr = 0;
                            }
                            $avg += $dr;
                            $arr_sum[$line] += $dr;
                            echo " <td title=' defect : " . $q_defect . ' | Cek :' . $q_check  . "'> " . number_format($dr,2,",",".")   . " % 
                              
                                 </td>"; //  <br> defect : ".$q_defect .' | Cek :'. $q_check  ."                          
                        }
                        $temp_avg =  round($avg /  $avgcount, 2);
                        $g_avg += $temp_avg;
                        echo " <td> " . $temp_avg . "%</td>";
                        echo " </tr>";
                    }

                    ?>
                </tbody>
                <tfoot>
                    <tr style="background-color : lightgray;">
                        <td colspan=""> AVERAGE </td>
                        <?php
                        foreach ($daftar_line as $key => $d_line) {
                            $sum_avg = 0;
                            $line = $d_line['line'];
                            echo " <td> " . number_format($arr_sum[$line] / count($distinct_dates),2,",",".") . "%</td>";
                        }
                        echo " <td> " . $g_avg / count($distinct_dates) . "%</td>";
                        ?>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<div class="row"> <br>
</div>

<script type="text/javascript">
    $("#ExportToExcel").click(function(e) {
        var a = document.createElement('a');
        //getting data from our div that contains the HTML table
        var data_type = 'data:application/vnd.ms-excel';
        var table_div = document.getElementById('save_excel');
        var table_html = table_div.outerHTML.replace(/ /g, '%20');
        a.href = data_type + ', ' + table_html;
        //setting the file name
        a.download = 'SUMMARY DEFECT_<?php echo date('Y-m-d'); ?>.xls';
        //triggering the function
        a.click();
        //just in case, prevent default behaviour
        e.preventDefault();
    });
</script>

<?php
// } //end loop berdasarkan jumlah array kj report_array


?>
<?php
function filterArray_based_on_line_tanggal($array,   $filterline, $tanggal)
{
    $filteredArray = array_filter($array, function ($item) use ($filterline, $tanggal) {
        return ($item['line'] == $filterline && $item['tanggal'] == $tanggal);
    });
    return array_values($filteredArray);
}

function filter_array_data_plus_defect_code($datanya, $filternya, $kodedefect)
{
    // pre( count($datanya));
    $filteredArray = array_filter($datanya, function ($item) use ($filternya, $kodedefect) {
        return (
            $item['line'] ==  $filternya['line'] &&
            $item['tanggal'] ==  $filternya['tanggal']  &&
            $item['kanaan_po'] ==  $filternya['kanaan_po']   &&
            $item['style'] ==  $filternya['style']   &&
            $item['color'] ==  $filternya['color']   &&
            $item['qty_order'] ==  $filternya['qty_order']   &&
            $item['des'] ==  $filternya['des']   &&

            $item['kode_defect'] == $kodedefect
        );
    });
    // pre( count($filteredArray)); exit();
    return array_values($filteredArray);
}





function displayDefectReport($report_array, $report_defect)
{
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


function convertToDynamicTable($report)
{
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


function filterByTanggal($total_produksi, $tanggal)
{
    foreach ($total_produksi as $data) {
        if ($data['tanggal'] == $tanggal) {
            return $data['jumlah'];
        }
    }
    return 0;
}

function calculateTotalOverall($report)
{
    $total = 0;

    foreach ($report as $data) {
        $total += $data['jumlah'];
    }

    return $total;
}


function calculateTotalByDate($report, $tanggal)
{
    $total = 0;
    foreach ($report as $data) {
        if ($data['tanggal'] == $tanggal) {
            $total += $data['jumlah'];
        }
    }

    return $total;
}

function calculateTotalByKodeDefect($report, $kode_defect)
{
    $total = 0;

    foreach ($report as $data) {
        if ($data['keterangan'] == $kode_defect) {
            $total += $data['jumlah'];
        }
    }

    return $total;
}


function filterDataByTanggalKodeDefect($report, $tanggal, $keterangan)
{
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


function filterArray_basedonline($array, $filterLine)
{
    $filteredArray = array_filter($array, function ($item) use ($filterLine) {
        return ($item['line'] == $filterLine);
    });
    return array_values($filteredArray);
}



?>

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