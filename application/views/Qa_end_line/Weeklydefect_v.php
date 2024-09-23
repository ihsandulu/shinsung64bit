<style>
    .ml-2 {
        margin-left: 5px;
    }

    th,
    td {
        text-align: center !important;
        vertical-align: middle !important;
    }
</style>
<?php
if (isset($_GET["from"])) {
    $from = $this->input->get("from");
} else {
    $from = date("Y-m-d");
}

if (isset($_GET["to"])) {
    $to = $this->input->get("to");
} else {
    $to = date("Y-m-d");
}
?>

<?php
?>

<div id="area_print">
    <div style="overflow-x:auto;">
        <div id="save_excel">
            <div align="center"><strong><?php echo $pagetitle; ?></strong></div>
            <br />
            <form class="form-inline" action="" align="center">
                <div class="form-group ml-2">
                    <label for="from">From:</label>
                    <input type="date" class="form-control" id="from" name="from" value="<?= $from; ?>">
                </div>
                <div class="form-group ml-2">
                    <label for="to">To:</label>
                    <input type="date" class="form-control" id="to" name="to" value="<?= $to; ?>">
                </div>
                <button type="submit" class="btn btn-default">Search</button>
            </form>
            <hr />
            <h4><b>Sewing Qty Date : <?= date("d M Y", strtotime($from)); ?> - <?= date("d M Y", strtotime($to)); ?></b></h4>
            <?php
            //SQL SEBELUMNYA
            /* $sql1 = $this->db->from("inspect_v2 AS i")
            ->select("i.line, i.kanaan_po, i.style, i.kode_defect, MAX(d.keterangan)AS keterangan, MAX(i.id_schedule)AS id_schedule, COUNT(i.id)AS jml")
            ->join("daftar_defect AS d", "d.kode=i.kode_defect", "left")
            ->where("convert(date, i.from)>='" . $from . "'")
            ->where("convert(date, i.from)<='" . $to . "'")
            ->group_by("i.line, i.kanaan_po, i.style, i.kode_defect")
            ->order_by("CAST(MAX(i.line) AS INT) ASC")
            ->get();
        $output1 = $sql1->result_array();
        $defarray = array();
        $defarrayket = array();
        $no = 0;
        $ur1=array();
        foreach ($output1 as $row1) {
            $ur1[$row1['id_schedule']][$row1['kode_defect']] = isset($row1["jml"]) ? $row1["jml"] : 0;
        } */

            //SQL SEKARANG
            $sql = $this->db->from("inspect_v2 AS i")
                ->select("i.line, i.kanaan_po, i.style, i.kode_defect, MAX(d.keterangan)AS keterangan, MAX(i.id_schedule)AS id_schedule, COUNT(i.id)AS jml")
                ->join("daftar_defect AS d", "d.kode=i.kode_defect", "left")
                ->where("convert(date, i.tanggal)>='" . $from . "'")
                ->where("convert(date, i.tanggal)<='" . $to . "'")
                ->group_by("i.line, i.kanaan_po, i.style, i.kode_defect")
                ->order_by("CAST(MAX(i.line) AS INT) ASC")
                ->get();
            $output = $sql->result_array();
            // echo $this->db->last_query(); die();

            // pre($output); 
            $defarray = array();
            $defarrayket = array();
            $no = 0;
            $ur = array();
            foreach ($output as $row) {
                $ur[$row['line']][$row['kanaan_po']][$row['style']][$row['kode_defect']] = isset($row["jml"]) ? $row["jml"] : 0;
                if (!in_array($row['kode_defect'], $defarray)) {
                    if ($row['kode_defect'] == "OK") {
                        // $defarrayket[$no] = "TOTAL QTY INSPECT";
                    } else {
                        $defarray[$no] = $row['kode_defect'];
                        $defarrayket[$no] = $row['kode_defect'] . " - " . $row['keterangan'];
                        $no++;
                    }
                }
            }
            // pre($ur);

            ?>
            <table class="table table-striped table-bordered" id="tabelsewing">
                <thead>
                    <tr>
                        <th>LINE</th>
                        <th>FILE NO</th>
                        <th>STYLE</th>
                        <?php
                        for ($x = 0; $x < $no; $x++) { ?>
                            <th><?= $defarrayket[$x]; ?></th>
                        <?php } ?>
                        <th>TOTAL DEFECT</th>
                        <th>TOTAL QTY INSPECT</th>
                        <!-- <th>% LAST</th> -->
                        <th>LINE PERFORMANCE</th>
                        <th>GOALS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = $this->db->from("inspect_v2 AS i")
                        ->select("i.line, i.kanaan_po, i.style, MAX(id_schedule)AS id_schedule")
                        ->where("convert(date, i.tanggal)>='" . $from . "'")
                        ->where("convert(date, i.tanggal)<='" . $to . "'")
                        ->group_by("i.line, i.kanaan_po, i.style")
                        ->order_by("CAST(MAX(i.line) AS INT) ASC")
                        ->get();
                    foreach ($sql->result() as $value) {
                        $t = 0;
                        if (isset($ur[$value->line][$value->kanaan_po][$value->style]["OK"])) {
                            $tok = $ur[$value->line][$value->kanaan_po][$value->style]["OK"];
                        } else {
                            $tok = 0;
                        }

                        if ($value->kanaan_po != "") {
                    ?>
                            <tr>
                                <td style='text-align: center;'> <?= $value->line; ?></td>
                                <td style='text-align: center;'> <?= $value->kanaan_po; ?> </td>
                                <td style='text-align: center;'> <?= $value->style; ?> </td>
                                <?php
                                for ($x = 0; $x < $no; $x++) {
                                    $kd = $defarray[$x];
                                ?>
                                    <td>
                                        <?php
                                        if (isset($ur[$value->line][$value->kanaan_po][$value->style][$kd])) {
                                            $tn = $ur[$value->line][$value->kanaan_po][$value->style][$kd];
                                            $t += $tn;
                                        } else {
                                            $tn = 0;
                                        };
                                        echo $tn;
                                        ?></td>
                                <?php } ?>
                                <td style='text-align: center;'> <?= $t; ?> </td>
                                <td style='text-align: center;'> <?= $tok; ?> </td>
                                <!-- <td style='text-align: center;'>  </td> -->
                                <td style='text-align: center;'>
                                    <?php
                                    if ($tok > 0) {
                                        $pperformance = $t / ($tok+$t) * 100;
                                    } else {
                                        $pperformance = 0;
                                    }
                                    echo number_format($pperformance, 1, ".", ",") . " %" ?>
                                </td>
                                <td style='text-align: center;'> </td>
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
        $('#tabelsewing').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excelHtml5',
                    text: 'Export to Excel',
                    title: 'WEEKLY DEFECT ANALYSIS ENDLINE QC SEWING <?= date("d M Y", strtotime($from)); ?> to <?= date("d M Y", strtotime($to)); ?>'
                },
                {
                    extend: 'print',
                    text: 'Print',
                    title: 'WEEKLY DEFECT ANALYSIS ENDLINE QC SEWING <?= date("d M Y", strtotime($from)); ?> to <?= date("d M Y", strtotime($to)); ?>'
                }
            ]
        });
    });
</script>

<!-- <script>
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
                $("#from").val("<?= date("Y-m-d"); ?>");
                $("#to").val("<?= date("Y-m-d"); ?>");
                break;
            case "weekly":
                $("#monthdiv").hide();
                $("#from").val("<?= $startOfWeek; ?>");
                $("#to").val("<?= $endOfWeek; ?>");
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

        $("#from").val(startOfMonth);
        $("#to").val(endOfMonth);
    }
</script> -->