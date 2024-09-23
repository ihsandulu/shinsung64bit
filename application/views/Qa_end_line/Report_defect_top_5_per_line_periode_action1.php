<style>
    .bg1 {
        background-color: darkgrey;
    }

    .bg2 {
        background-color: grey;
    }

    .bg3 {
        background-color: navajowhite;
    }

    th,
    td {
        text-align: center !important;
        vertical-align: middle !important;
    }
</style>
<?php
// pre($report); DataSort
$unique_defect = array_unique(array_column($report, 'keterangan')); //array_unique(array_column($report, 'keterangan'));

// pre($unique_defect);pre($DataSort); 

$unique_data = array_unique($report, SORT_REGULAR);
//  pre($qtychecking_array);

$startDate = strtotime($sdate);
$endDate = strtotime($edate);
?>

<div id="area_print">
    <div style="overflow-x:auto;">
        <div id="save_excel">
            <div align="center"><strong><?php echo $pagetitle; ?></strong></div>
            <br />
            <table width="100%" border="1" id="tabel" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>SUMMARY TOP 5 DEFECT</th>
                        <?php
                        for ($currentDate = $startDate; $currentDate <= $endDate; $currentDate += 86400) {
                            $tanggal = date('Y-m-d', $currentDate); // Format tanggal YYYY-MM-DD
                        ?>
                            <th><?= strtoupper(date("D", strtotime($tanggal))); ?><br /><?= strtoupper(date("d", strtotime($tanggal))); ?></th>
                        <?php } ?>
                        <th>TOTAL</th>
                        <th>%</th>
                        <th>SHARE %</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cumulative = 0;
                    $baris = 0;
                    $total_defect_all = calculateTotalOverall($report);
                    // for ($i=0; $i <count($unique_defect) ; $i++) { 
                    // foreach ($unique_defect as $keterangan) {
                    foreach ($DataSort as $ds) {
                        // pre($ds);  // echo $ds['Keterangan'] ; 
                        $keterangan = $ds['Keterangan'];
                    ?>
                        <tr>
                            <?php
                            //  $kode_defect =  $unique_defect[$i]['kode_defect'] ;
                            $baris += 1;
                            echo "<td> $baris </td>";
                            echo "<td>" . $keterangan . "</td>";
                            // loop pertanggal 
                            $jml = 0;
                            for ($currentDate = $startDate; $currentDate <= $endDate; $currentDate += 86400) {
                                $tanggal_hari = date('Y-m-d', $currentDate); // Format tanggal YYYY-MM-DD
                                // code... looping line header

                                $filtered_data = filterDataByTanggalKodeDefect($report, $tanggal_hari, $keterangan);
                                if (empty($filtered_data)) {
                                    echo "<td>";
                                    echo "</td>";
                                } else {
                                    echo "<td>";
                                    echo number_format($filtered_data[0]['jumlah'],0,".",",");
                                    $jml += $filtered_data[0]['jumlah'];
                                    echo "</td>";
                                }
                            }
                            echo "<td>" . calculateTotalByKodeDefect($report, $keterangan) . "</td>";
                            $cumulative = $cumulative + calculateTotalByKodeDefect($report, $keterangan);
                            $totprodu = totalproduksi($total_produksi);
                            $totdefe = totdef($report);
                            // echo "<td>" .  round(($jml / $totalJumlah) * 100, 2)  . " %</td>";
                            // echo "<td>" .  round(($cumulative / $total_defect_all) * 100, 0)  . " %</td>";
                            if($totprodu>0){
                                $ttotprodu= $jml / ($totprodu+$jml) * 100;
                            }else{
                                $ttotprodu=0;
                            }
                            echo "<td>" .  number_format($ttotprodu,1,".",",")  . " %</td>";
                            if($totdefe>0){
                                $ttotdefe= $jml / ($totdefe+$jml) * 100;
                            }else{
                                $ttotdefe=0;
                            }
                            echo "<td>" .  number_format($ttotdefe,1,".",",")  . " %</td>";
                            ?>
                        </tr>
                    <?php
                    }
                    ?>
                    </tr>
                    <tr class="bg1">
                        <td> </td>
                        <td> TOTAL DEFECTS </td>
                        <?php
                        $sum_defect_all = 0;
                        for ($currentDate = $startDate; $currentDate <= $endDate; $currentDate += 86400) {
                            $tanggal_hari = date('Y-m-d', $currentDate); // Format tanggal YYYY-MM-DD

                            echo "<td>";
                            echo  calculateTotalByDate($report,  $tanggal_hari);
                            $sum_defect_all += calculateTotalByDate($report,  $tanggal_hari);
                            echo "</td>";
                        }
                        echo "<td> <b>" . $sum_defect_all . "</b></td>";
                        ?>
                        <td> </td>
                        <td> </td>
                    </tr>
                    <tr class="bg2">
                        <td> </td>
                        <td> PRODUCTION </td>
                        <?php
                        $sum_production = 0;
                        for ($currentDate = $startDate; $currentDate <= $endDate; $currentDate += 86400) {
                            $tanggal_hari = date('Y-m-d', $currentDate); // Format tanggal YYYY-MM-DD

                            echo "<td>";

                            echo filterByTanggal($total_produksi, $tanggal_hari);
                            $sum_production += filterByTanggal($total_produksi, $tanggal_hari);
                            echo "</td>";
                        }
                        echo "<td>" . $sum_production . "</td>";
                        ?>
                        <td> </td>
                        <td> </td>
                    </tr>
                    <tr class="bg3">
                        <td> </td>
                        <td> TOTAL % DEFECTIVE </td>
                        <?php
                        $sum_total_defect = 0;
                        $sum_qty_checking = 0;
                        for ($currentDate = $startDate; $currentDate <= $endDate; $currentDate += 86400) {
                            $tanggal_hari = date('Y-m-d', $currentDate); // Format tanggal YYYY-MM-DD


                            $total_presen_defect = 0;
                            if (filterByTanggal($total_produksi, $tanggal_hari) > 0) {
                                $total_presen_defect =  calculateTotalByDate($report,  $tanggal_hari)  / (filterByTanggal($qtychecking_array, $tanggal_hari)+calculateTotalByDate($report,  $tanggal_hari));
                                $sum_total_defect = calculateTotalByDate($report,  $tanggal_hari);
                                $sum_qty_checking = filterByTanggal($qtychecking_array, $tanggal_hari);
                            }

                            echo "<td>";

                            echo ($total_presen_defect > 0) ? number_format($total_presen_defect * 100, 1,".",",") . ' %' : "";
                            echo "</td>";
                        }

                        //  echo "<td>".     round( $sum_defect_all / $sum_production ,2)     ."%</td>";
                        echo "<td>";
                        if ($sum_total_defect != 0) {
                            // echo $sum_total_defect .'  '. $sum_qty_checking .'  ' ; 
                            echo number_format($sum_defect_all / ($sum_production+$sum_defect_all)* 100,1,",",".")   . "%";
                            //echo "0"; // Atau pesan kesalahan lainnya
                        } else {
                            echo "0"; // Atau pesan kesalahan lainnya
                        }
                        echo "</td>";

                        ?>
                        <td> </td>
                        <td> </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
function filterByTanggal($total_produksi, $tanggal)
{
    foreach ($total_produksi as $data) {
        if ($data['tanggal'] == $tanggal) {
            return $data['jumlah'];
        }
    }

    return 0;
}

function totalproduksi($total_produksi)
{
    $totprod = 0;
    foreach ($total_produksi as $data) {
        $totprod += $data['jumlah'];
    }

    return $totprod;
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

function totdef($report)
{
    $totd = 0;
    foreach ($report as $data) {
        $totd += $data['jumlah'];
    }

    return $totd;
}

function calculateTotalByKodeDefect($report, $kode_defect)
{
    $total = 0;

    foreach ($report as $data) {
        if ($data['keterangan'] == $kode_defect) {
            $total += $data['jumlah'];
        }
    }

    return number_format($total,0,".",",");
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

function filterArray_basedonline_kodedefect($array, $filterLine, $filterKodeDefect)
{
    $filteredArray = array_filter($array, function ($item) use ($filterLine, $filterKodeDefect) {
        return ($item['line'] == $filterLine && $item['kode_defect'] == $filterKodeDefect);
    });
    return array_values($filteredArray);
}
function filterArray_basedonline($array, $filterLine)
{
    $filteredArray = array_filter($array, function ($item) use ($filterLine) {
        return ($item['line'] == $filterLine);
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


    jQuery(document).ready(function() {
        jQuery('thead th').each(function(column) {
            jQuery(this).addClass('sortable').click(function() {
                var findSortKey = function($cell) {
                    return $cell.find('.sort-key').text().toUpperCase() + ' ' + $cell.text().toUpperCase();
                };

                var sortDirection = jQuery(this).is('.sorted-asc') ? -1 : 1;
                var $tbodies = jQuery(this).parent().parent().parent().find('tbody').get();

                jQuery.each($tbodies, function(index, tbody) {
                    var $rows = jQuery(tbody).find('.sortable-row').get();
                    jQuery.each($rows, function(index, row) {
                        row.sortKey = findSortKey(jQuery(row).children('td').eq(column));
                    });

                    $rows.sort(function(a, b) {
                        if (a.sortKey < b.sortKey) return -sortDirection;
                        if (a.sortKey > b.sortKey) return sortDirection;
                        return 0;
                    });

                    jQuery.each($rows, function(index, row) {
                        jQuery(tbody).append(row);
                        row.sortKey = null;
                    });
                });

                jQuery('th').removeClass('sorted-asc sorted-desc');
                var $sortHead = jQuery('th').filter(':nth-child(' + (column + 1) + ')');
                sortDirection == 1 ? $sortHead.addClass('sorted-asc') : $sortHead.addClass('sorted-desc');

                jQuery('td').removeClass('sorted').filter(':nth-child(' + (column + 1) + ')').addClass('sorted');
            });
        });
    });
</script>



<script>
    $('#tabel').DataTable({
        dom: 'Bfrtip',
        buttons: [{
                extend: 'excelHtml5',
                text: 'Export to Excel',
                title: 'REPORT TOP 5 DEFECT'
            },
            {
                extend: 'print',
                text: 'Print',
                title: 'REPORT TOP 5 DEFECT'
            }
        ],
        ordering: false
    });
</script>