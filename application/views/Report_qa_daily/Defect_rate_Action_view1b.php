<style>
</style>
<div id="area_print">
    <div style="overflow-x:auto;">
        <div id="save_excel">
            <div align="center"><strong><?php echo $pagetitle; ?></strong></div>
            <br />

            <table border="1" width="100%" id="tabel" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>LINE</th>
                        <th>DATE</th>
                        <th>FILE NO</th>
                        <th>STYLE</th>
                        <th>COLOR</th>
                        <th>DES</th>
                        <th>SIZE</th>
                        <th>QTY ORDER</th>
                        <th>QTY CHECK</th>
                        <?php

                        $defec = array();
                        foreach ($daftar_defect as $key => $defect_list) {
                            // code...
                            echo "<th>" . $defect_list['kode']  . "</th>";
                            $defec[$defect_list['kode']] = 0;
                        }
                        ?>
                        <th>TOTAL <BR>
                            DEFECT</th>
                        <th>TOTAL GARMENT<BR>
                            DEFECT</th>
                        <th>% DR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $kanan = "style=' white-space: nowrap; text-align:right' ";
                    $g_qty_order = 0;
                    $g_qty_cek = 0;

                    $rm = array();
                    foreach ($report_mdefect as $k => $r) {
                        $rm[$r['kanaan_po']][$r['style']][$r['size']][$r['color']] = $r['qty_unitname'];
                    }
                    // pre($rm);
                    $tmdefect = 0;
                    foreach ($report_array as $key => $report) {
                        // pre($report);
                        if(isset($rm[$report['kanaan_po']][$report['style']][$report['size']][$report['color']])){
                        $mdefect = $rm[$report['kanaan_po']][$report['style']][$report['size']][$report['color']];
                        }else{
                            $mdefect =0;
                        }
                        $tmdefect += $mdefect;
                    ?>
                        <tr>
                            <td><?= $report['line']; ?></td>
                            <td style="white-space: nowrap;"><?= $report['tanggal']; ?></td>
                            <td><?= $report['kanaan_po']; ?></td>
                            <td><?= $report['style']; ?></td>
                            <td style="white-space: nowrap;"><?= $report['color']; ?></td>
                            <td style="white-space: nowrap;"><?= $report['des']; ?></td>
                            <td style="white-space: nowrap;"><?= $report['size']; ?></td>
                            <td <?= $kanan; ?>><?= number_format($report['qty_order'], 0, ".", ","); ?></td>
                            <?php $g_qty_order += $report['qty_order']; ?>
                            <td <?= $kanan; ?>><?= number_format($report['qty_check'], 0, ".", ","); ?></td>

                            <?php
                            $qtycheck = $report['qty_check'];
                            $g_qty_cek  +=  $report['qty_check'];
                            unset($report['qty_check']);
                            $sumdefect = 0;
                            foreach ($daftar_defect as $key => $defect_list) {
                                $data = filter_array_data_plus_defect_code($report_defect, $report, str_replace('0', 'x', $defect_list['kode']));
                                if ($data) {
                                    $sumdefect += $data[0]['qty_defect'];
                                    $defec[$defect_list['kode']] += $data[0]['qty_defect'];
                            ?>
                                    <td <?= $kanan; ?>><?= number_format($data[0]['qty_defect'], 0, ".", ","); ?></td>
                                <?php } else {
                                    $sumdefect += 0; ?>
                                    <td> - </td>
                            <?php }
                            } ?>

                            <td <?= $kanan; ?>><?= number_format($sumdefect, 0, ".", ","); ?></td>
                            <td <?= $kanan; ?>><?= number_format($mdefect, 0, ".", ","); ?></td>
                            <td <?= $kanan; ?>>
                                <?php if ($qtycheck > 0) {
                                    $pdr = $mdefect / ($qtycheck) * 100;
                                } else {
                                    $pdr = 0;
                                } ?>
                                <?= number_format($pdr, 1, ".", ","); ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr style="background-color : lightgray;">
                        <td colspan="7"> TOTAL </td>
                        <td colspan="" style="white-space: nowrap; text-align:right"><?= number_format($g_qty_order, 0, ".", ",") ?></td>
                        <td colspan="" style="white-space: nowrap; text-align:right"><?= number_format($g_qty_cek, 0, ".", ",") ?></td>
                        <?php
                        $total_defect = 0;
                        foreach ($daftar_defect as $key => $defect_list) {
                            $total_defect +=$defec[$defect_list['kode']];
                            ?>
                             <td <?= $kanan; ?>><?= $defec[$defect_list['kode']]; ?></td>
                            <?php /* $data = filterArray_basedonline_kodedefect($sum_defect, str_replace('0', 'x', $defect_list['kode']));
                            if ($data) {
                                $total_defect += $data[0]['qty_defect']; ?>
                                <td <?= $kanan; ?>><?= $data[0]['qty_defect']; ?></td>
                            <?php } else {
                                $total_defect += 0; ?>
                                <td> 0 </td>
                        <?php } */
                        }
                        ?>
                        <td colspan="" style="white-space: nowrap; text-align:right"><?= number_format($total_defect, 0, ".", ","); ?></td>
                        <td <?= $kanan; ?>><?= number_format($tmdefect, 0, ".", ","); ?></td>
                        <td colspan="" style="white-space: nowrap; text-align:right">
                            <?php
                            if ($g_qty_cek > 0) {
                                $tpdr = $tmdefect / ($g_qty_cek) * 100;
                            } else {
                                $tpdr = 0;
                            }
                            echo number_format($tpdr, 1, ".", ","); ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<div class="row"> <br>
</div>
<?php
function filterArray_basedonline_kodedefect($array,   $filterKodeDefect)
{
    $filteredArray = array_filter($array, function ($item) use ($filterKodeDefect) {
        return ($item['kode_defect10'] == $filterKodeDefect);
    });
    return array_values($filteredArray);
}

function filter_array_data_plus_defect_code($datanya, $filternya, $kodedefect)
{
    $filteredArray = array_filter($datanya, function ($item) use ($filternya, $kodedefect) {
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
        );
        pre($filteredArray);
    });
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

<script>
    $('#tabel').DataTable({
        dom: 'Bfrtip',
        buttons: [{
                extend: 'excelHtml5',
                text: 'Export to Excel',
                title: 'Daily Defect Rate % Report'
            },
            {
                extend: 'print',
                text: 'Print',
                title: 'Daily Defect Rate % Report'
            }
        ]
    });
</script>