<style>
    .ml-2 {
        margin-left: 5px;
    }

    #pemisah {
        border-top: gray double 3px;
        margin-top: 20px;
        padding: 20px;
    }

    .dataTables_wrapper .dt-buttons {
        float: left;
        margin-bottom: 20px;
    }

    .dataTables_wrapper .dataTables_filter {
        float: right;
        margin-bottom: 20px;
    }

    th {
        text-align: center;
    }
</style>

<?php
$startDate = strtotime($sdate);
$endDate = strtotime($edate);
?>

<div id="area_print">
    <div style="overflow-x:auto;">
        <div id="save_excel" class="row">
            <div class="col-md-4" align="left">
                <div style="font-weight:bold; font-size:20px;">
                    PRODUCTION RESULTS REPORT
                </div>
                <div style="font-size:20px;">
                    <span style="font-weight:bold;">PERIOD : </span><span style="color:blue; font-size:18px;"><?= date("d M Y", strtotime($sdate)) . ' ~ ' . date("d M Y", strtotime($edate)); ?></span>
                </div>
            </div>
            <form class="form-inline col-md-8" action="" align="right">
                <div class="form-group ml-2">
                    <label for="tanggal">Date:</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $tanggal; ?>">
                </div>
                <button type="submit" class="btn btn-default">Search</button>
            </form>
        </div>
        <div id="pemisah">
            <?php
            $jam = $this->db->from("jam_narget_detail")
                ->select("hari, jam_ke, jam_start, jam_end")
                ->join("jam_narget_header", "jam_narget_header.id=jam_narget_detail.id_header", "left")
                ->where("jam_narget_header.is_active", "y")
                ->order_by("jam_start")
                ->get();
            $hari = array();
            $jamd = array();
            foreach ($jam->result() as $row) {
                $hari[] = $row->hari;
                $jamd[$row->hari]['ke'][] = $row->jam_ke;
                $jamd[$row->hari]['awal'][] = $row->jam_start;
                $jamd[$row->hari]['akhir'][] = $row->jam_end;
            }

            // Declare variables for day and day description
            $hari = date('N', strtotime($tanggal));
            $hari_ket = 'senin - kamis';
            if ($hari == 5) {
                $hari_ket = 'jumat';
            }

            $maxValue = max($jamd[$hari_ket]['ke']);
            $jmlValue = count($jamd[$hari_ket]['ke']);

            $select_output = "
SELECT 
s.line, 
s.KANAAN_PO,
s.STYLE_NO,
ISNULL(SUM(CASE WHEN j.jam_ke = 1 THEN s.QTY ELSE 0 END), 0) AS JAM_1,
ISNULL(SUM(CASE WHEN j.jam_ke = 2 THEN s.QTY ELSE 0 END), 0) AS JAM_2,
ISNULL(SUM(CASE WHEN j.jam_ke = 3 THEN s.QTY ELSE 0 END), 0) AS JAM_3,
ISNULL(SUM(CASE WHEN j.jam_ke = 4 THEN s.QTY ELSE 0 END), 0) AS JAM_4,
ISNULL(SUM(CASE WHEN j.jam_ke = 5 THEN s.QTY ELSE 0 END), 0) AS JAM_5,
ISNULL(SUM(CASE WHEN j.jam_ke = 6 THEN s.QTY ELSE 0 END), 0) AS JAM_6,
ISNULL(SUM(CASE WHEN j.jam_ke = 7 THEN s.QTY ELSE 0 END), 0) AS JAM_7,
ISNULL(SUM(CASE WHEN j.jam_ke = 8 THEN s.QTY ELSE 0 END), 0) AS JAM_8,
ISNULL(SUM(CASE WHEN j.jam_ke = 9 THEN s.QTY ELSE 0 END), 0) AS JAM_9,
ISNULL(SUM(CASE WHEN j.jam_ke = 10 THEN s.QTY ELSE 0 END), 0) AS JAM_10,
ISNULL(SUM(CASE WHEN j.jam_ke = 11 THEN s.QTY ELSE 0 END), 0) AS JAM_11,
ISNULL(SUM(CASE WHEN j.jam_ke = 12 THEN s.QTY ELSE 0 END), 0) AS JAM_12,
ISNULL(SUM(CASE WHEN j.jam_ke = 13 THEN s.QTY ELSE 0 END), 0) AS JAM_13,
ISNULL(SUM(CASE WHEN j.jam_ke = 14 THEN s.QTY ELSE 0 END), 0) AS JAM_14,
ISNULL(SUM(CASE WHEN j.jam_ke = 15 THEN s.QTY ELSE 0 END), 0) AS JAM_15,
ISNULL(SUM(CASE WHEN j.jam_ke = 16 THEN s.QTY ELSE 0 END), 0) AS JAM_16,
ISNULL(SUM(CASE WHEN j.jam_ke = 17 THEN s.QTY ELSE 0 END), 0) AS JAM_17,
ISNULL(SUM(CASE WHEN j.jam_ke = 18 THEN s.QTY ELSE 0 END), 0) AS JAM_18,
ISNULL(SUM(CASE WHEN j.jam_ke = 19 THEN s.QTY ELSE 0 END), 0) AS JAM_19,
ISNULL(SUM(CASE WHEN j.jam_ke = 20 THEN s.QTY ELSE 0 END), 0) AS JAM_20,
ISNULL(SUM(CASE WHEN j.jam_ke = 21 THEN s.QTY ELSE 0 END), 0) AS JAM_21,
ISNULL(SUM(CASE WHEN j.jam_ke = 22 THEN s.QTY ELSE 0 END), 0) AS JAM_22,
ISNULL(SUM(CASE WHEN j.jam_ke = 23 THEN s.QTY ELSE 0 END), 0) AS JAM_23,
ISNULL(SUM(CASE WHEN j.jam_ke = 24 THEN s.QTY ELSE 0 END), 0) AS JAM_24,
ISNULL(SUM(CASE WHEN j.jam_ke = 25 THEN s.QTY ELSE 0 END), 0) AS JAM_25,
ISNULL(SUM(s.QTY), 0) AS TOTAL_AKHIR
FROM 
    jam_narget_detail AS j
LEFT JOIN 
    (SELECT TANGGAL_HASIL, line, QTY, KANAAN_PO, STYLE_NO  FROM sewing_hasil_produksi)AS s 
    ON s.TANGGAL_HASIL IS NOT NULL 
    AND CONVERT(TIME, s.TANGGAL_HASIL) BETWEEN j.jam_start 
    AND j.jam_end AND CONVERT(DATE, s.TANGGAL_HASIL)='" . $tanggal . "'
WHERE 
    j.id_header IN (
        SELECT id
        FROM jam_narget_header
        WHERE is_active = 'y'
    )
    AND j.hari = '" . $hari_ket . "' 
    AND s.line IS NOT NULL 

GROUP BY s.line, s.KANAAN_PO, s.STYLE_NO
";
            $output = $this->db->query($select_output)->result_array();
            // echo $this->db->last_query(); die();
            // $result = $output->result_array();

            // pre($output); 
            foreach ($output as $row) {
                for ($x = 1; $x <= 25; $x++) {
                    $jam_key = "JAM_" . $x;
                    $ur[$row['line']][$x][$row['KANAAN_PO']][$row['STYLE_NO']] = isset($row[$jam_key]) ? $row[$jam_key] : 0;
                    // echo $row['line']."-".$jam_key."-".$row['KANAAN_PO']."-".$row['STYLE_NO']."=".$row[$jam_key]."<br/>";
                }
            }
            // pre($ur);

            ?>
            <table width="100%" border="1" class="table table-striped table-bordered" id="tabelsewing">
                <thead>
                    <tr>
                        <th>LINE</th>
                        <th>FILE NO</th>
                        <th>STYLE_NO</th>
                        <th>QTY ORDER</th>
                        <th>BUYER</th>
                        <?php
                        for ($x = 1; $x <= $jmlValue; $x++) { ?>
                            <th><?= $x; ?></th>
                        <?php } ?>
                        <th>TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = $this->db->from("sewing_hasil_produksi AS s")
                        ->select("s.LINE, s.KANAAN_PO, s.STYLE_NO, MAX(CAST(s.QTYGLOBAL AS BIGINT)) AS qtyorder, SUM(CAST(s.QTY AS INT)) AS HASIL, MAX(p.BUYER) AS BUYER, MAX(id_schedule)AS id_schedule")
                        ->join("Schedule_produksi AS p", "p.ID=s.id_schedule", "left")
                        ->where("convert(date, s.TANGGAL_HASIL)='" . $tanggal . "'")
                        ->group_by("s.LINE, s.KANAAN_PO, s.STYLE_NO, s.ITEM")
                        ->order_by("CAST(MAX(s.LINE) AS INT) ASC")
                        ->get();
                        // echo $this->db->last_query();
                    $totalAll = 0;
                    foreach ($sql->result() as $value) {
                        if ($value->KANAAN_PO != "") {
                    ?>
                            <tr>
                                <td style='text-align: center;'> <?= $value->LINE; ?> </td>
                                <td style='text-align: center;'> <?= $value->KANAAN_PO; ?> </td>
                                <td style='text-align: center;'> <?= $value->STYLE_NO; ?> </td>
                                <td style='text-align: center;'> <?= number_format($value->qtyorder, 0, ".", ","); ?> </td>
                                <td style='text-align: center;'> <?= $value->BUYER; ?> </td>
                                <?php
                                $t = 0;
                                for ($x = 1; $x <= $jmlValue; $x++) { ?>
                                    <td>
                                        <?php
                                        // echo "ur[". $value->LINE ."][". $x ."][". $value->id_schedule ."]=";

                                        if (isset($ur[$value->LINE][$x][$value->KANAAN_PO][$value->STYLE_NO])) {
                                            $tn = $ur[$value->LINE][$x][$value->KANAAN_PO][$value->STYLE_NO];
                                            $t += $tn;
                                        } else {
                                            $tn = 0;
                                        };
                                        echo $tn;
                                        ?></td>
                                <?php } ?>
                                <td style='text-align: center;'> <?= $t; ?> </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
//pre ($report);
?>

<script>
    $(document).ready(function() {
        <?php if (isset($_GET["month"]) && isset($_GET["pilihan"]) && $_GET["pilihan"] == "monthly") { ?>
            $("#monthdiv").show();
        <?php } else { ?>
            $("#monthdiv").hide();
        <?php } ?>
        $('#tabelsewing').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excelHtml5',
                    text: 'Export to Excel',
                    title: 'Sewing Data Period <?= date("d M Y", strtotime($tanggal)); ?> to <?= date("d M Y", strtotime($tanggal_akhir)); ?>'
                },
                {
                    extend: 'print',
                    text: 'Print',
                    title: 'Sewing Data Period <?= date("d M Y", strtotime($tanggal)); ?> to <?= date("d M Y", strtotime($tanggal_akhir)); ?>'
                }
            ]
        });
        $('#tabeliron').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excelHtml5',
                    text: 'Export to Excel',
                    title: 'Iron Data Period <?= date("d M Y", strtotime($tanggal)); ?> to <?= date("d M Y", strtotime($tanggal_akhir)); ?>'
                },
                {
                    extend: 'print',
                    text: 'Print',
                    title: 'Iron Data Period <?= date("d M Y", strtotime($tanggal)); ?> to <?= date("d M Y", strtotime($tanggal_akhir)); ?>'
                }
            ]
        });
        $('#tabelpacking').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excelHtml5',
                    text: 'Export to Excel',
                    title: 'Packing Data Period <?= date("d M Y", strtotime($tanggal)); ?> to <?= date("d M Y", strtotime($tanggal_akhir)); ?>'
                },
                {
                    extend: 'print',
                    text: 'Print',
                    title: 'Packing Data Period <?= date("d M Y", strtotime($tanggal)); ?> to <?= date("d M Y", strtotime($tanggal_akhir)); ?>'
                }
            ]
        });
    });
</script>

<script>
    <?php
    $today = date('Y-m-d');
    $startOfWeek = date('Y-m-d', strtotime('monday this week', strtotime($today)));
    $endOfWeek = date('Y-m-d', strtotime('sunday this week', strtotime($today)));
    ?>

    function pilihtipe() {
        let pilihan = $("#pilihan").val();
        switch (pilihan) {
            case "daily":
                $("#monthdiv").hide();
                $("#tanggal").val("<?= date("Y-m-d"); ?>");
                $("#tanggal_akhir").val("<?= date("Y-m-d"); ?>");
                break;
            case "weekly":
                $("#monthdiv").hide();
                $("#tanggal").val("<?= $startOfWeek; ?>");
                $("#tanggal_akhir").val("<?= $endOfWeek; ?>");
                break;
            case "monthly":
                $("#monthdiv").show();
                $("#month").val('<?= date("n"); ?>');
                monthlydate();
                break;
            default:
                $("#monthdiv").hide();
                break;
        }
    }
</script>

<script>
    function monthlydate() {
        let month = $("#month").val();
        var year = 2024;
        var startDate = new Date(year, month - 1, 1);
        var endDate = new Date(year, month, 0);
        var startOfMonth = startDate.getFullYear() + '-' + ('0' + (startDate.getMonth() + 1)).slice(-2) + '-' + ('0' + startDate.getDate()).slice(-2);
        var endOfMonth = endDate.getFullYear() + '-' + ('0' + (endDate.getMonth() + 1)).slice(-2) + '-' + ('0' + endDate.getDate()).slice(-2);

        $("#tanggal").val(startOfMonth);
        $("#tanggal_akhir").val(endOfMonth);
    }
</script>