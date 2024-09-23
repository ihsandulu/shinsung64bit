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
                    PRODUCTION RESULTS REPORT (HANGTAG)
                </div>
                <div style="font-size:20px;">
                    <span style="font-weight:bold;">PERIOD : </span><span style="color:blue; font-size:18px;"><?= date("d M Y", strtotime($tanggal_awal)) . ' ~ ' . date("d M Y", strtotime($tanggal_akhir)); ?></span>
                </div>
            </div>
            <form class="form-inline col-md-8" action="" align="right">
                <div class="form-group">
                    <label for="pilihan">Type:</label>
                    <select onchange="pilihtipe()" class="form-control" id="pilihan" name="pilihan">
                        <option value="daily" <?= ($this->input->get("pilihan") == "daily") ? "selected" : ""; ?>>Daily</option>
                        <option value="weekly" <?= ($this->input->get("pilihan") == "weekly") ? "selected" : ""; ?>>Weekly</option>
                        <option value="monthly" <?= ($this->input->get("pilihan") == "monthly") ? "selected" : ""; ?>>Monthly</option>
                    </select>
                </div>
                <div class="form-group ml-2" id="monthdiv">
                    <label for="month">Month:</label>
                    <select onchange="monthlydate()" class="form-control" id="month" name="month">
                        <?php
                        $bulan = [
                            'January',
                            'February',
                            'March',
                            'April',
                            'May',
                            'June',
                            'July',
                            'August',
                            'September',
                            'October',
                            'November',
                            'December'
                        ];

                        // Looping untuk menampilkan nama-nama bulan
                        foreach ($bulan as $index => $nama) {
                        ?>
                            <option value="<?= $index + 1; ?>" <?= ($this->input->get("month") == ($index + 1)) ? "selected" : ""; ?>><?= $nama; ?></option>
                        <?php
                        }
                        ?>

                    </select>
                </div>
                <div class="form-group ml-2">
                    <label for="tanggal_awal">From:</label>
                    <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal" value="<?= $tanggal_awal; ?>">
                </div>
                <div class="form-group ml-2">
                    <label for="tanggal_akhir">To:</label>
                    <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" value="<?= $tanggal_akhir; ?>">
                </div>
                <button type="submit" class="btn btn-default">Search</button>
            </form>
        </div>
        <div id="pemisah">
            <table width="100%" border="1" class="table table-striped table-bordered" id="tabeliron">
                <thead>
                    <tr>
                        <th>FILE NO</th>
                        <th>STYLE_NO</th>
                        <th>COLOR</th>
                        <th>SIZE</th>
                        <th>PO No.</th>
                        <th>DC Date</th>
                        <th>PO Qty</th>
                        <th>QTY ORDER</th>
                        <th>QTY CURRENT</th>
                        <th>QTY TOTAL</th>
                        <th>BALANCE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $subquery = "(SELECT KANAAN_PO, STYLE_NO, COLOR, SIZE, SUM(CAST(QTY AS INT)) AS TOTAL
                    FROM sewing_hasil_hangtag
                    GROUP BY KANAAN_PO, STYLE_NO, COLOR, SIZE) AS sub";

                    // Buat query utama dengan menggunakan JOIN
                    $sql = $this->db->select('MAX(po_number)AS po_number,MAX(po_date)AS po_date,MAX(po_qty)AS po_qty,sub.TOTAL, main.KANAAN_PO, main.STYLE_NO, main.COLOR, main.SIZE, 
                          MAX(CAST(main.QTYGLOBAL AS BIGINT)) AS qtyorder, 
                          SUM(CAST(main.QTY AS INT)) AS HASIL')
                        ->from('sewing_hasil_hangtag main')
                        ->join("po","po.KANAAN_PO = main.KANAAN_PO 
                                   AND po.STYLE_NO = main.STYLE_NO 
                                   AND po.COLOR = main.COLOR 
                                   AND po.SIZE = main.SIZE","left")
                        ->join($subquery, 'sub.KANAAN_PO = main.KANAAN_PO 
                                   AND sub.STYLE_NO = main.STYLE_NO 
                                   AND sub.COLOR = main.COLOR 
                                   AND sub.SIZE = main.SIZE', 'left')
                        ->where("CONVERT(date, main.TANGGAL_HASIL) BETWEEN '" . $tanggal_awal . "' AND '" . $tanggal_akhir . "'")
                        ->group_by('sub.TOTAL, main.KANAAN_PO, main.STYLE_NO, main.COLOR, main.SIZE') // Tambahkan sub.TOTAL ke GROUP BY
                        ->get();
                    // echo $this->db->last_query();
                    $totalAll = 0;
                    foreach ($sql->result() as $value) {
                        if ($value->KANAAN_PO != "") {
                    ?>
                            <tr>
                                <td style='text-align: center;'> <?= $value->KANAAN_PO; ?> </td>
                                <td style='text-align: center;'> <?= $value->STYLE_NO; ?> </td>
                                <td style='text-align: center;'> <?= $value->COLOR; ?> </td>
                                <td style='text-align: center;'> <?= $value->SIZE; ?> </td>
                                <td style='text-align: center;'> <?= $value->po_number; ?> </td>
                                <td style='text-align: center;'> <?= $value->po_date; ?> </td>
                                <td style='text-align: center;'> <?= $value->po_qty; ?> </td>
                                <td style='text-align: center;'> <?= number_format($value->qtyorder, 0, ".", ","); ?> </td>
                                <td style='text-align: center;'> <?= number_format($value->HASIL, 0, ".", ","); ?> </td>
                                <td style='text-align: center;'> <?= number_format($value->TOTAL, 0, ".", ","); ?> </td>
                                <td style='text-align: center;'> <?= number_format($value->TOTAL - $value->HASIL, 0, ".", ","); ?> </td>
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
                    title: 'Sewing Data Period <?= date("d M Y", strtotime($tanggal_awal)); ?> to <?= date("d M Y", strtotime($tanggal_akhir)); ?>'
                },
                {
                    extend: 'print',
                    text: 'Print',
                    title: 'Sewing Data Period <?= date("d M Y", strtotime($tanggal_awal)); ?> to <?= date("d M Y", strtotime($tanggal_akhir)); ?>'
                }
            ]
        });
        $('#tabeliron').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excelHtml5',
                    text: 'Export to Excel',
                    title: 'Iron Data Period <?= date("d M Y", strtotime($tanggal_awal)); ?> to <?= date("d M Y", strtotime($tanggal_akhir)); ?>'
                },
                {
                    extend: 'print',
                    text: 'Print',
                    title: 'Iron Data Period <?= date("d M Y", strtotime($tanggal_awal)); ?> to <?= date("d M Y", strtotime($tanggal_akhir)); ?>'
                }
            ]
        });
        $('#tabelpacking').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excelHtml5',
                    text: 'Export to Excel',
                    title: 'Packing Data Period <?= date("d M Y", strtotime($tanggal_awal)); ?> to <?= date("d M Y", strtotime($tanggal_akhir)); ?>'
                },
                {
                    extend: 'print',
                    text: 'Print',
                    title: 'Packing Data Period <?= date("d M Y", strtotime($tanggal_awal)); ?> to <?= date("d M Y", strtotime($tanggal_akhir)); ?>'
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
                $("#tanggal_awal").val("<?= date("Y-m-d"); ?>");
                $("#tanggal_akhir").val("<?= date("Y-m-d"); ?>");
                break;
            case "weekly":
                $("#monthdiv").hide();
                $("#tanggal_awal").val("<?= $startOfWeek; ?>");
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

        $("#tanggal_awal").val(startOfMonth);
        $("#tanggal_akhir").val(endOfMonth);
    }
</script>