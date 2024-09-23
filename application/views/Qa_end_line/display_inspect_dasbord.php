<?php
$tanggal = date('Y-m-d');
if (isset($_GET["date1"])) {
    $tanggal = $_GET["date1"];
}
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/css/font-awesome.min.css">
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/js/js/jquery-3.3.1.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/js/bootstrap.min.js"></script>


<script src="<?php echo base_url(); ?>assets/highcharts/highcharts.js"></script>
<script src="<?php echo base_url(); ?>assets/highcharts/exporting.js"></script>
<script src="<?php echo base_url(); ?>assets/highcharts/export-data.js"></script>
<script src="<?php echo base_url(); ?>assets/highcharts/accessibility.js"></script>
<!--
<script language="javascript">
window.setTimeout( function() {
   //window.location.href = "http://192.168.0.18/Kmjdisplay/andon/"+ <?php // echo $line  
                                                                        ?>;
   location.reload();
}, 30000);
</script>
-->
<style>
    body {
        width: 100%;
        /* background-color: #000;  */
    }

    .colomn_satu {
        border-right: 1px solid #000;
        padding: 10px;
    }

    .colomn_dua {
        border-right: 1px solid #000;
        padding: 10px;
    }

    .colomn_tiga {
        border-right: 1px solid #000;
        padding: 10px;
    }

    .colomn_header {
        border-bottom: 1px solid #000;
        padding: 10px;
    }

    .isi {
        border-bottom: 1px solid #DFDFDF;
        padding-bottom: 3px;
    }

    .footer {
        border-top: 1px solid #000;
        padding: 10px;
    }

    .row {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        flex-wrap: wrap;
    }

    .row>[class*='col-'] {
        display: flex;
        flex-direction: column;
    }
</style>
<style>
    .container_form {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        min-height: 300px;
        width: 100%;
        background-color: #f2f2f2;
        padding: 10px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    }

    .textbox {
        font-size: 24px;
        width: 100%;
        margin-bottom: 10px;
        text-align: right;
        padding-right: 5px;
    }

    .button {
        height: 60px;
        width: 60px;
        margin: 5px;
        font-size: 24px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .button:hover {
        background-color: #3e8e41;
    }

    /* styling untuk tab */
    .tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
    }

    /* styling untuk tombol tab */
    .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
    }

    /* styling untuk tombol tab ketika diaktifkan */
    .tab button.active {
        background-color: #ccc;
    }

    /* styling untuk konten tab */
    0 {
        display: none;
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-top: none;
    }
</style>



<style>
    .highcharts-figure,
    .highcharts-data-table table {
        min-width: 100%;
        max-width: 100%;
        margin: 1em auto;

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

    input[type="number"] {
        min-width: 50px;
    }



    .hide-bullets {
        list-style: none;
        margin-left: -40px;
        margin-top: 20px;
    }
</style>




<body>
    <div class="container-fluid">
        <div class="row">
            <?php
            $tanggal_hari_ini = date('Y-m-d');
            $this->db->select("KANAAN_PO, STYLE_NO");
            $this->db->where("LINE", $line);
            $this->db->where("CONVERT(VARCHAR(10), TANGGAL_HASIL, 120) =", $tanggal_hari_ini);
            $this->db->group_by("KANAAN_PO, STYLE_NO");
            $q = $this->db->get("sewing_hasil_produksi");
            $jumlah_array = $q->num_rows();
            if ($jumlah_array > 0) {
                $no = 1;
                foreach ($q->result() as $row) {
            ?>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div align="center" style="font-size:25px"> <strong>F# : <?= $row->KANAAN_PO; ?> - S# : <?= $row->STYLE_NO; ?> </strong></div>
                        <br />
                        <table class="table table-striped table-bordered" id="Table_summary" style="width:100%;">
                            <tbody>
                                <tr>
                                    <td width="12%" style="text-align:center;"> LINE <font size="+1"><strong>
                                                <div><?php echo $line; ?></div>
                                            </strong></font>
                                    </td>
                                    <td width="22%" style="text-align:center;" hidden> QTY CHECK : <font size="+1"><strong>
                                                <div id="jml_ceck<?= $no; ?>"></div>
                                            </strong></font>
                                    </td>
                                    <td width="20%" style="text-align:center;"> SUM OUTPUT : <font size="+1"><strong>
                                                <div id="jml_qty<?= $no; ?>"></div>
                                            </strong></font>
                                    </td>
                                    <td width="23%" style="text-align:center;"> SUM DEFECT : <font size="+1"><strong>
                                                <div id="jml_defect<?= $no; ?>"></div>
                                            </strong></font>
                                    </td>
                                    <td width="23%" style="text-align:center; color:white;" id="button_status<?= $no; ?>"> % DEFECT :
                                        <font size="+1">
                                            <strong>
                                                <div id="jml_persen<?= $no; ?>"></div>
                                            </strong>
                                        </font>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <script language="javascript">
                            call_sp_grid_summary_hasil_inspect_bags_defect_list_version1();

                            function call_sp_grid_summary_hasil_inspect_bags_defect_list_version1() {
                                // alert("<?php echo base_url() . 'Qa_end_line/sp_grid_summary_hasil_inspect_bags_defect_list_version1__/' . $line . '?date1=' . $tanggal;   ?>");
                                var table = document.getElementById("Table_summary");
                                $.ajax({
                                    type: 'POST',
                                    url: "<?php echo base_url() . 'Qa_end_line/sp_grid_summary_hasil_inspect_bags_defect_list_version1__/' . $line . '?date1=' . $tanggal;   ?>",
                                    dataType: "JSON",
                                    data: {

                                    },
                                    success: function(response) {
                                        //var cell = table.rows[1].cells[1];
                                        //table.rows[0].cells[0].innerHTML = response[0].qty_checking;
                                        document.getElementById("jml_ceck<?= $no; ?>").innerHTML = response[0].qty_checking;
                                        document.getElementById("jml_defect<?= $no; ?>").innerHTML = response[0].sum_defect;
                                        document.getElementById("jml_persen<?= $no; ?>").innerHTML = response[0].persen_defect.toFixed(1) + ' % ';
                                        document.getElementById("jml_qty<?= $no; ?>").innerHTML = response[0].qty_hasil;
                                        let persendefect = response[0].persen_defect;
                                        if (persendefect >= 50) {
                                            document.getElementById("button_status<?= $no; ?>").style.backgroundColor = "red";
                                        } else if (persendefect >= 31) {
                                            document.getElementById("button_status<?= $no; ?>").style.backgroundColor = "#FC0";
                                        } else if (persendefect < 31) {
                                            document.getElementById("button_status<?= $no; ?>").style.backgroundColor = "green";
                                        } else {
                                            document.getElementById("button_status<?= $no; ?>").style.backgroundColor = "#CCC";
                                        }
                                        document.getElementById("jml_qty").innerHTML = response[0].qty_hasil;


                                    }
                                });
                            }
                        </script>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <figure class="highcharts-figure">
                            <div id="containers<?= $no; ?>" style="width:100%;"></div>
                        </figure>
                    </div>
                    <?php
                    $kanaan_po = $row->KANAAN_PO;
                    $style = $row->STYLE_NO;
                    $this->db->from("inspect_v2_hari_ini AS S");
                    $this->db->select("S.kanaan_po, S.style, S.kode_defect, COUNT(S.kode_defect) AS jumlah_defect, MAX(daftar_defect.keterangan)AS keterangan");
                    $this->db->join("daftar_defect", "daftar_defect.kode = S.kode_defect", "left");
                    $this->db->where("S.kode_defect !=", "OK");
                    $this->db->where("S.LINE", $line);
                    $this->db->where("S.kanaan_po", $kanaan_po);
                    $this->db->where("S.style", $style);
                    $this->db->group_by("S.kanaan_po, S.style, S.kode_defect");
                    $this->db->order_by("jumlah_defect", "DESC");
                    $this->db->limit(3);
                    $sql = $this->db->get();
                    // echo $this->db->last_query();
                    $cacats = array();
                    $jumlahdefect = 0;
                    foreach ($sql->result() as $defect) {
                        $jumlahdefect += $defect->jumlah_defect;
                        $cacats["kode_defect"][] = $defect->kode_defect;
                        $cacats['keterangan'][] = $defect->keterangan;
                        $cacats['jumlah_defect'][] = $defect->jumlah_defect;
                    }
                    // pre($cacats);
                    
                    ?>
                     <script>
                        Highcharts.setOptions({
                            plotOptions: {
                                series: {
                                    animation: false
                                }
                            }
                        });

                        Highcharts.chart('containers<?= $no; ?>', {
                            chart: {
                                plotBackgroundColor: null,
                                plotBorderWidth: null,
                                plotShadow: false,
                                type: 'pie'
                            },
                            title: {
                                text: ' GRAFIK TOP 3 DEFECT ',
                                align: 'center'
                            },
                            tooltip: {
                                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                            },
                            accessibility: {
                                point: {
                                    valueSuffix: '%'
                                }
                            },
                            plotOptions: {
                                pie: {
                                    allowPointSelect: true,
                                    cursor: 'pointer',
                                    dataLabels: {
                                        enabled: true,

                                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                        style: {
                                            fontSize: '12px'
                                        }
                                    }
                                }
                            },
                            series: [{
                                name: 'Brands',
                                colorByPoint: true,
                                data: [
                                    <?php
                                    for($x=0;$x<3;$x++) { 
                                        $persend= $cacats['jumlah_defect'][$x]/$jumlahdefect*100;
                                        ?> {
                                        name: '<?=$cacats["kode_defect"][$x]; ?> - <?=$cacats['keterangan'][$x]; ?> (Defect:<?=$cacats['jumlah_defect'][$x]; ?>)',
                                        y: <?=$persend; ?>,
                                        sliced: false,
                                        selected: true
                                        },
                                    <?php } ?>
                                ]
                            }]
                        });
                    </script>
                    <?php  ?>
                <?php $no++;
                }
            } else { ?>
                <script>
                    $("containers<?= $no; ?>").html("Tidak ada data!");
                </script>
            <?php } ?>
        </div>
        <!-- END TEST IMAGES -->

    </div>

    </div>
    </div>

    <script language="javascript">
        jQuery(document).ready(function($) {
            //set here the speed to change the slides in the carousel
            $('#myCarousel').carousel({
                interval: 4000
            });

            //Loads the html to each slider. Write in the "div id="slide-content-x" what you want to show in each slide
            //$('#carousel-text').html($('#slide-content-0').html());

            //Handles the carousel thumbnails
            $('[id^=carousel-selector-]').click(function() {
                var id = this.id.substr(this.id.lastIndexOf("-") + 1);
                var id = parseInt(id);
                $('#myCarousel').carousel(id);
            });


            // When the carousel slides, auto update the text
            $('#myCarousel').on('slid.bs.carousel', function(e) {
                var id = $('.item.active').data('slide-number');
                $('#carousel-text').html($('#slide-content-' + id).html());
            });
        });
    </script>






</body>