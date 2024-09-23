<style>
    .highcharts-figure,
    .highcharts-data-table table {
        min-width: 100%;
        max-width: 100%;
        margin: 1em auto;

    }

    #container {
        height: 400px;

    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #ebebeb;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
    }

    .highcharts-data-table caption {
        padding: 1em 0;
        font-size: 1.2em;
        color: #555;
    }

    .highcharts-data-table th {
        font-weight: 600;
        padding: 0.5em;
    }

    .highcharts-data-table td,
    .highcharts-data-table th,
    .highcharts-data-table caption {
        padding: 0.5em;
    }

    .highcharts-data-table thead tr,
    .highcharts-data-table tr:nth-child(even) {
        background: #f8f8f8;
    }

    .highcharts-data-table tr:hover {
        background: #f1f7ff;
    }
</style>
<hr />
<figure class="highcharts-figure">
    <div id="container" style="font-size:16px;"></div>
</figure>
<?php
$lines = $this->input->get('line');
$linesArray = explode(',', $lines);

$buyer = $this->input->get('buyer');
//  echo "asdf".$_GET["line"];die;

/* $this->db->from("inspect_v2 AS i")
    ->select("i.line, i.kode_defect, i.buyer");

if (!empty($lines)) {
    $this->db->where_in('i.line', $linesArray);
}
if (!empty($buyer)) {
    $this->db->where('i.buyer', $buyer);
}

$this->db->where('CONVERT(VARCHAR(10), i.tanggal, 120) >=', $info_tanggal_awal)
    ->where('CONVERT(VARCHAR(10), i.tanggal, 120) <=', $info_tanggal_akhir)
    ->order_by("CAST(i.line AS INT)", "ASC");

$defect = $this->db->get();
echo $this->db->last_query();
$totdef = 0;
$totok = 0;
$def = array();
$okd = array();
$lined = array();
$buyerd = array();
$linen = "";
foreach ($defect->result() as $row) {
    if ($linen != $row->line) {
        if ($row->kode_defect == "OK") {
            $totok = 1;
            $okd[$row->line] = $totok;
        } else {
            $totdef = 1;
            $def[$row->line] = $totdef;
        }
        $linen = $row->line;
        $lined["line"][] = $row->line;
    } else {
        if ($row->kode_defect == "OK") {
            $totok = $totok + 1;
            $okd[$row->line] = $totok;
        } else {
            $totdef = $totdef + 1;
            $def[$row->line] = $totdef;
        }
    }
    $buyerd[$row->line] = $row->buyer;
}

pre($okd);
pre($def); */

$def = array();
$okd = array();
$lined = array();
$buyerd = array();

//cari OK
$this->db->from("inspect_v2 AS i")
    ->select("i.line, max(i.buyer)AS buyer, COUNT(i.kode_defect)AS jml");

if (!empty($lines)) {
    $this->db->where_in('i.line', $linesArray);
}
if (!empty($buyer)) {
    $this->db->where('i.buyer', $buyer);
}

$this->db->where('i.kode_defect', 'OK');
$this->db->where('CONVERT(VARCHAR(10), i.tanggal, 120) >=', $info_tanggal_awal)
    ->where('CONVERT(VARCHAR(10), i.tanggal, 120) <=', $info_tanggal_akhir)
    ->group_by("i.line")
    ->order_by("CAST(i.line AS INT)", "ASC");

$defect = $this->db->get();
// echo $this->db->last_query();
foreach ($defect->result() as $row) {
    $buyerd[$row->line] = $row->buyer;
    $okd[$row->line] = $row->jml;
    $lined["line"][] = $row->line;
}

//cari selain OK
$this->db->from("inspect_v2 AS i")
    ->select("i.line, max(i.buyer)AS buyer, COUNT(i.kode_defect)AS jml");

if (!empty($lines)) {
    $this->db->where_in('i.line', $linesArray);
}
if (!empty($buyer)) {
    $this->db->where('i.buyer', $buyer);
}

$this->db->where('i.kode_defect !=', 'OK');
$this->db->where('CONVERT(VARCHAR(10), i.tanggal, 120) >=', $info_tanggal_awal)
    ->where('CONVERT(VARCHAR(10), i.tanggal, 120) <=', $info_tanggal_akhir)
    ->group_by("i.line")
    ->order_by("CAST(i.line AS INT)", "ASC");

$defect = $this->db->get();
// echo $this->db->last_query();
foreach ($defect->result() as $row) {
    $buyerd[$row->line] = $row->buyer;
    $def[$row->line] = $row->jml;
    $lined["line"][] = $row->line;
}

// pre($okd);
// pre($def);

?>
<?php if ($info_buyer == "") {$infobuyer="";} else {$infobuyer="<br/> BUYER " . $info_buyer;} ?>
<?php if ($info_line == "") {$infoline="";} else {$infoline="<br/> LINE " . $info_line;}?>
<script language="javascript">
    // Data retrieved from https://gs.statcounter.com/browser-market-share#monthly-202201-202201-bar

    // Create the chart
    Highcharts.chart('container', {
        chart: {
            type: 'column',
            style: {
                fontSize: '16px'
            }
        },
        title: {
            align: 'center',
            text: 'DEFECT RATE PERLINE <?=$info_buyer;?><br/> <?=tgl($info_tanggal_awal); ?> s/d <?=tgl($info_tanggal_akhir); ?>  <?=$infoline;?>',
            style: {
                fontSize: '14px'
            }
        },
        subtitle: {
            align: 'left',
            text: '<br/>'
        },
        accessibility: {
            announceNewData: {
                enabled: true
            }
        },
        xAxis: {
            type: 'category'

        },
        yAxis: {
            title: {
                text: 'Total percent defect'
            }


        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.1f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:16px;">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color};">{point.name}</span>: <b>{point.y:.1f}%</b> of total<br/>'
        },

        series: [{
            name: 'Defect Rate',
            colorByPoint: true,
            data: [
                /* <?php foreach ($data as $row) : ?>
				{
                    name: 'Line <?php echo $row['line']; ?>',
                    y: <?php echo $row['defect_percentage']; ?>
                },
				<?php endforeach; ?> */
                <?php
                foreach ($lined["line"] as $line) {
                    if (!empty($def[$line])) {
                        $defl = $def[$line];
                    } else {
                        $defl = 0;
                    }
                    if (!empty($okd[$line])) {
                        $okdl = $okd[$line];
                    } else {
                        $okdl = 0;
                    }
                    $t = $defl + $okdl;
                    if ($t > 0) {
                        // $percent = $defl / $t * 100;
                        $percent = $defl / ($okdl+$defl) * 100;
                    } else {
                        $percent = 0;
                    }
                ?> {
                        name: '<span style="font-size:11px;">L:<?= $line; ?> (D:<?= $defl; ?> | OK:<?= $okdl; ?>)</span><br/><span style="font-size:9px;"><?= $buyerd[$line]; ?></span>',
                        y: <?= number_format($percent, 1, ".", ","); ?>
                    },
                <?php }; ?>

            ]
        }]

    });
</script>