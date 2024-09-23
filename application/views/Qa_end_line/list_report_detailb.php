<style>
    .blink {
        animation: blink-animation 1s steps(5, start) infinite;
        -webkit-animation: blink-animation 1s steps(5, start) infinite;
    }

    @keyframes blink-animation {
        to {
            visibility: hidden;
        }
    }

    @-webkit-keyframes blink-animation {
        to {
            visibility: hidden;
        }
    }
</style>


<?php
$buttonCount = 25;
?>
<?php
$tanggal = date("Y-m-d");
if (isset($_GET["date1"])) {
    $tanggal = $_GET["date1"];
}
?>

<div align="right" style="padding-top:-100px;" hidden><button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom"> <i class="fa fa-info-circle"></i> </button></div>
<div class="row">
    <?php


    // Mengambil data qty ironing
    /* $query_ironing = $this->db->select('SUM(QTY) as qtyironing, LINE')
    ->from('sewing_hasil_ironing')
    ->where('CONVERT(VARCHAR(10), JAMINPUT, 120) =', date('Y-m-d', strtotime($tanggal)))
    ->group_by('LINE')
    ->get();

$ironing = [];
foreach ($query_ironing->result_array() as $row) {
    $ironing[$row['LINE']] = $row['qtyironing'];
} */

    // Mengambil data sum defect
    $query_defect = $this->db->select('line, COUNT(DISTINCT unit_name) AS sum_defect')
        ->from('inspect_v2')
        ->where('CONVERT(VARCHAR(10), time_stamp, 120) =', date('Y-m-d', strtotime($tanggal)))
        ->where('kode_defect <>', 'OK')
        ->group_by('line')
        ->get();

    // echo $this->db->last_query();

    $defect = [];
    foreach ($query_defect->result_array() as $row) {
        $defect[$row['line']] = $row['sum_defect'];
    }


    // Mengambil data qty hasil produksi
    $query_qtyqc = $this->db->select('SUM(QTY) as qty_hasil, line')
        ->from('sewing_hasil_produksi')
        ->where('CONVERT(VARCHAR(10), JAMINPUT, 120) =', date('Y-m-d', strtotime($tanggal)))
        ->group_by('line')
        ->get();

    $qtyqc = [];
    foreach ($query_qtyqc->result_array() as $row) {
        $qtyqc[$row['line']] = $row['qty_hasil'];
    }

    // Mengambil data qty packing
    /* $query_packing = $this->db->select('SUM(QTY) as qty_packing, line')
    ->from('sewing_hasil_packing')
    ->where('CONVERT(VARCHAR(10), JAMINPUT, 120) =', date('Y-m-d', strtotime($tanggal)))
    ->group_by('line')
    ->get();

$qtypacking = [];
foreach ($query_packing->result_array() as $row) {
    $qtypacking[$row['line']] = $row['qty_packing'];
} */

    // Menggabungkan semua hasil menjadi satu output
    $persen_defect = [];
    foreach ($qtyqc as $line => $qty_hasil) {
        $persen_defect[] = [
            'tanggal' => $tanggal,
            'line' => $line,
            // 'qtyironing' => isset($ironing[$line]) ? $ironing[$line] : 0,
            'sum_defect' => isset($defect[$line]) ? $defect[$line] : 0,
            'persen_defect' => isset($defect[$line]) && $qty_hasil > 0 ? ($defect[$line] / $qty_hasil) * 100 : 0,
            'qty_hasil' => $qty_hasil,
            // 'qty_packing' => isset($qtypacking[$line]) ? $qtypacking[$line] : 0,
        ];
    }
    // pre($persen_defect);
    for ($i = 1; $i <= $buttonCount; $i++) {

        $filteredArray = array_filter($persen_defect, function ($item)  use ($i) {
            return $item['line'] == $i;
        });


        $warna = 'black';
        $warna1 = 'black';
        $warna2 = 'black';
        $warna3 = 'black';
        $warna_tulisan = 'white';
        $warna_bg = 'black';
        $blink = '';
        if (count($filteredArray) > 0) {
            $key = array_shift($filteredArray);


            if ($key['persen_defect'] >= 50) {
                $warna = 'red';
            } elseif ($key['persen_defect'] >= 31) {
                $warna = '#FC0';
            } elseif (($key['persen_defect'] = 0)) {
                $warna = 'black';
            } else {
                $warna = 'green';
                $blink = '';
            }
        }
    ?>

        <div class="col-md-3 col-sm-4 col-xs-6 my-div" data-toggle="modal" onclick="openModal(<?php echo $i; ?>)" data-target="#myModal">
            <div class="info-box" style="background-color:#ccc;">
                <span class="info-box-icon" style="border:2px solid <?php echo $warna_bg; ?>; background-color:<?php echo $warna; ?>; color:<?php echo $warna_tulisan; ?>; height:90px;">
                    <span <?php echo $blink; ?>>
                        <div style="margin-top:-7px;"><?php echo $i; ?></div>
                    </span>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text"> RESULT / % DEFECT </span>
                    <span class="info-box-number">
                        <?php
                        $filteredArray = array_filter($persen_defect, function ($item)  use ($i) {
                            return $item['line'] == $i;
                        });
                        if (count($filteredArray) > 0) {
                            $key = array_shift($filteredArray);
                            echo $key['qty_hasil'] . ' / ' . number_format($key['persen_defect'], 1, ".", ",") . ' % ';
                        }
                        ?>
                    </span>
                </div>
            </div>
        </div>
    <?php }; ?>
</div>