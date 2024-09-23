<style>
    body {
        width: 100%;
    }

    .container {
        margin-top: 10px;
    }

    .colomn_satu {
        border-right: 1px solid #000;
        border-top: 0px solid #000;
        padding: 10px;
    }

    .colomn_dua {
        border-right: 0px solid #000;
        border-top: 0px solid #000;
        padding: 10px;
    }

    .colomn_tiga {
        /*border-right: 1px solid #000; */
        border-top: 0px solid #000;
        padding: 10px;
        padding-top: 0px;
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
        height: 80px;
        width: 90px;
        margin: 5px;
        font-size: 24px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .button2 {
        height: 80px;
        width: 90px;
        margin: 5px;
        font-size: 24px;
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

    .font-besar {
        font-size: 17px;
    }

    .text-15 {
        font-size: 30px;
        height: 50px;
    }

    .btninfo {
        height: 50px !important;
        font-size: 15px;
    }

    .f30 {
        font-size: 20px;
    }

    .kangka {
        border-bottom: #000 dashed 1px;
        background-color: #ccc;
        align-items: center;
        justify-content: center;
        border: 1px dashed #C1C1B9;
        padding: 5px;
        height: 70px;
    }

    .kangka2 {
        border-bottom: #000 dashed 1px;
        background-color: green;
        align-items: center;
        justify-content: center;
        border: 1px dashed #C1C1B9;
        padding: 5px;
        color: #FFF;
        height: 70px;
    }

    .kangka3 {
        border-bottom: #000 dashed 1px;
        background-color: #B22E2E;
        align-items: center;
        justify-content: center;
        border: 1px dashed #C1C1B9;
        padding: 5px;
        color: #FFF;
        height: 70px;
    }

    .kangka4 {
        border-bottom: #000 dashed 1px;
        background-color: #C73333;
        align-items: center;
        justify-content: center;
        border: 1px dashed #C1C1B9;
        padding: 5px;
        color: #FFF;
        height: 70px;
    }

    .bangka {
        background-color: #E4E4E4;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0px;
    }


    .angka {
        font-weight: bold;
        font-size: 30px;
        text-align: right;
        vertical-align: middle !important;
    }

    .tangka {
        font-weight: bold;
        font-size: 15px;
        text-align: left;
        display: inline-block !important;
        vertical-align: middle !important;
    }

    .m-2 {
        margin-bottom: 5px !important;
        padding: 5px;
    }

    .m-0 {
        margin: 0px !important;
    }

    .p-0 {
        padding: 0px !important;
    }

    .p-1 {
        padding: 10px !important;
    }


    #listdefect {
        margin: 0px !important;
        padding: 5px !important;

    }

    #hasilsementara {
        border-radius: 5px;
        width: 96%;
        height: 185px;
        background-color: #E4E4E4;
        overflow: auto;
        margin-top: 5px;
        padding: 10px;
    }

    #hasilsementara2 {
        border-radius: 5px;
        height: 200px;
        background-color: #E4E4E4;
        overflow: auto;
        margin: 0px !important;
        padding: 15px;
    }

    .border {
        border: #000 solid 1px;
        ;
    }

    #isihasilsementara {
        overflow: auto;
        /* border:#000 solid 1px; */
        margin: 0px;
        padding: 0px;
    }

    #buttonsementara1 {
        height: 175px;
        width: 100%;
        /* border:#000 solid 1px; */
    }

    #buttonsementara2 {
        position: absolute;
        top: 207px;
        right: 10px;
        height: 200px;
        width: 130px;
        /* border:#000 solid 1px; */
    }

    #outputqc {
        height: 100%;
    }

    #outputqc2 {
        height: 100%;
    }

    #outputqc3 {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .mb-3 {
        margin-bottom: 10px;
    }

    .text-wrap {
        display: inline-block;
        padding: 10px 20px;
        font-size: 12px;
        text-align: center;
        text-decoration: none;
        color: white;
        background-color: brown;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        word-wrap: break-word;
        /* Membungkus kata yang panjang */
        white-space: normal;
        /* Mengizinkan pembungkusan baris */
    }

    .p-2 {
        padding: 5px;
        font-size: 15px;
    }

    .pilihcs {
        padding: 0px;
        padding-left: 10px !important;
        padding-right: 10px !important;
        margin: 0px !important;
    }

    .text-15 {
        font-size: 30px;
        height: 50px;
    }

    .btn-defect {
        height: 100px;
        font-size: 20px;
    }

    .overflow {
        overflow-x: hidden;
        overflow-y: auto;
        height: 630px;
        margin: 0px;
    }

    .btninfo {
        height: 50px !important;
        font-size: 15px;
    }

    .f30 {
        font-size: 20px;
    }

    #jml_persen {
        /* font-size: 20px; */
    }

    .titled {
        text-align: center;
        font-weight: bold;
    }

    .titlede {
        background-color: #E4E4E4;
        text-align: center;
        height: 28px;
        font-size: 20px;
        font-weight: bold;
    }

    #kumpulanb {
        margin-top: 0px;
    }

    #colomn_dua2 {
        display: none;
    }

    .btn4 {
        padding: 1px;
        padding-top: 2px;
    }

    #btn_data_defect {
        position: relative;
        top: -5px !important;
    }
</style>

<body>
    <div class="container-fluid">

        <div id="getJam" style="font-size:12px; color:#000;  font-size:25px; margin-top:-46px;" align="right"></div>

        <script language="javascript">
            $('#getJam').load('<?php echo base_url() . 'Qa_end_line/getJam' ?>');
        </script>
        <script language="javascript">
            $(document).ready(function() {
                setInterval(function() {
                    $('#getJam').load('<?php echo base_url() . 'Qa_end_line/getJam' ?>');
                }, 10000);
                /* setInterval(function() {
                  refresh_qty_cek();
                  total_output_perline();
                }, 12000); */
            });
        </script>



        <div align="center">
            <div class="alert alert-success" id="success-alert-inspect-ok_">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong> </strong> INSPECT OK
            </div>
        </div>


        <div align="center">
            <div class="alert alert-info" id="success-alert-defect-ok">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong> </strong> DEFECT DITAMBAHKAN
            </div>
        </div>


        <div align="center">
            <div class="alert alert-warning" id="success-alert-final-ok">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong> </strong> OUTPUT DITAMBAHKAN
            </div>
        </div>

        <div align="center">
            <div class="alert alert-warning" id="success-alert-final-hd-ok">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong> </strong> OUTPUT HD DITAMBAHKAN
            </div>
        </div>


        <div class="row">
            <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 colomn_satu m-0 p-0">

                <div class="overflow">
                    <div id="detail_data">
                        <div align="left">
                            <strong>
                                <a id="href1" href="<?php echo base_url(); ?>Qa_end_line/display_inspect/<?php echo $line; ?>/<?php echo $id_schedule; ?>" target="_blank">
                                </a>
                            </strong>
                        </div>
                        <div id='test1'></div>
                        <div align="left" class="font-besar"><i>FILE # / Style # / Qty Order / Target 100% / Des</i></div>
                        <div align="left" class="isi font-besar">
                            <b>
                                #<?= $this->input->get('KANAAN_PO'); ?> /
                                <?= $this->input->get('STYLE_NO'); ?> /
                                <i id="qtyorder"></i> /
                                <i id="target100"></i> /
                                <i id="des"></i>
                            </b>
                        </div>
                    </div>

                    <br />
                    <input type="hidden" id="id_schedule" value="" />
                    <input type="hidden" id="target" value="0" />
                    <span style="clear:both!important;"></span>
                    <form class="form-horizontal m-0 p-0">
                        <div class="form-group col-md-6 pilihcs">
                            <select id="color" onchange="cekidn()" class="form-control text-15">
                                <option value="">Color</option>
                                <?php
                                $kanaan_po = $this->input->get('KANAAN_PO');
                                $style_no = $this->input->get('STYLE_NO');
                                $color_query = $this->db->from("v_schedule_produksi_2021_hari_ini")
                                    ->select("COLOR")
                                    ->where("KANAAN_PO", $kanaan_po)
                                    ->where("STYLE_NO", $style_no)
                                    ->group_by("COLOR")
                                    ->get();
                                foreach ($color_query->result() as $color_query) { ?>
                                    <option value="<?= $color_query->COLOR; ?>"><?= $color_query->COLOR; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6 pilihcs">
                            <select id="size" onchange="cekidn()" class="form-control text-15">
                                <option value="">Size</option>
                                <?php
                                $kanaan_po = $this->input->get('KANAAN_PO');
                                $style_no = $this->input->get('STYLE_NO');
                                $size_query = $this->db->from("v_schedule_produksi_2021_hari_ini")
                                    ->select("SIZE")
                                    ->where("KANAAN_PO", $kanaan_po)
                                    ->where("STYLE_NO", $style_no)
                                    ->group_by("SIZE")
                                    ->get();
                                foreach ($size_query->result() as $size_query) { ?>
                                    <option value="<?= $size_query->SIZE; ?>"><?= $size_query->SIZE; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </form>
                    <div class=" col-md-12 kumpulant m-0 p-0" id="kumpulanb">
                        <div class="col-md-4 m-0 p-0">
                            <button class="button btn btn-success" style=" width: 96%; height: 185px;" id="btn_ok" onClick="oke_inspect()">GOOD </button>
                        </div>
                        <div class="col-md-4 m-0 p-0">
                            <button id="buttonsementara3" onclick="listinputdefect()" class="button2 btn btn-warning btn-block" style="width: 96%; height: 185px;">SUBMIT<br />DEFECT</button>
                        </div>
                        <div class="col-md-4 m-0 p-0">
                            <div id="hasilsementara">
                                <div style="font-weight: bold; font-size:15px;">LIST DEFECT:</div>
                            </div>
                        </div>
                    </div>
                    <div class="container_form p-0" id="form_defect">
                        <div align="center" style="width:98%;">
                            <div class="alert alert-danger" id="danger-alert-inspect-no">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                <strong> </strong> KODE TIDAK TERDAFTAR
                            </div>
                        </div>
                        <button class="button btn-block" style="background-color:darkred; width: 98%; height: 50px;" id="btn_end" onClick="end_check()">END CHECK</button>
                        <input type="text" class="textbox" id="textbox1" name="textbox1" readonly>
                        <button class="button" style="background-color:blue;" onClick="insert1('0')">0</button>
                        <button class="button" style="background-color:blue;" onClick="insert1('1')">1</button>
                        <button class="button" style="background-color:blue;" onClick="insert1('2')">2</button>

                        <button class="button" style="background-color:blue;" onClick="insert1('3')">3</button>
                        <button class="button" style="background-color:blue;" onClick="insert1('4')">4</button>
                        <button class="button" style="background-color:blue;" onClick="insert1('5')">5</button>

                        <button class="button" style="background-color:blue;" onClick="insert1('6')">6</button>
                        <button class="button" style="background-color:blue;" onClick="insert1('7')">7</button>
                        <button class="button" style="background-color:blue;" onClick="insert1('8')">8</button>

                        <button class="button" style="background-color:blue;" onClick="insert1('9')">9</button>

                        <button class="button" style="background-color:darkgreen;" onClick="btndefect()">OK</button>
                        <button class="button" style="background-color:red" onClick="kosongkan1()">DEL</button>

                    </div>
                    <div class="col-md-12 kumpulant m-0 p-0">
                        <div class="col-md-12 mb-3"><span class="label label-danger p-2 col-md-12">Top 5 Defect This Week</span></div>
                        <div id="5defect" class="" style="width: 100%;">
                        </div>
                        <script>
                            function rubah5defect() {
                                $.get("<?= base_url("api/fivedefectweekb"); ?>")
                                    .done(function(data) {
                                        $("#5defect").html(data);
                                    });
                            }
                            rubah5defect();
                        </script>
                    </div>
                </div>
            </div>
            <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 colomn_dua m-0 p-0">
                <div class="row  m-0">
                    <div onClick="call_refresh_all();total_output_perline();" class="col-md-6">
                        <div class="row kangka" id="outputqc">
                            <div class="tangka col-md-6 col-sm-6 col-xs-6 btn btn-success" id="outputqc2">
                                <span id="outputqc3">GOOD QTY</span>
                            </div>
                            <div id="jml_ceck" class="angka col-md-6 col-sm-6 col-xs-6">0</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row kangka2" id="button_status" style="">
                            <div class="tangka col-md-5 col-sm-5 col-xs-5">DEFECT %</div>
                            <div id="jml_persen" class="angka col-md-7 col-sm-7 col-xs-7">0</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row kangka3" id="button_status" style="">
                            <div class="tangka col-md-5 col-sm-5 col-xs-5">DEFECT</div>
                            <div id="jml_defect" class="angka col-md-7 col-sm-7 col-xs-7">0</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row kangka4" id="button_status" style="">
                            <div class="tangka col-md-5 col-sm-5 col-xs-5">GARMENT</div>
                            <div id="dress_defect" class="angka col-md-7 col-sm-7 col-xs-7">0</div>
                        </div>
                    </div>
                </div>
                <div align="right">
                    <div class="col-sm-3 btn4">
                        <button class="btn btn-sm btn-danger btninfo btn-block" style="background-color:darkred;" id="r" onClick="btn_reload()">REFRESH</button>
                    </div>
                    <div class="col-sm-3 btn4">
                        <button class="btn btn-sm btn-danger btninfo btn-block" style="background-color:darkblue;" id="l" onClick="btn_style()">STYLE</button>
                    </div>
                    <div class="col-sm-3 btn4">
                        <button class="btn btn-sm btn-danger btninfo btn-block" style="background-color:darkgreen;" id="btn_data_hasil" onClick="start_btn_hasil()">OUTPUT</button>
                        <button class="btn btn-sm btn-danger btninfo btn-block" style="background-color:purple;" id="btn_data_defect" onClick="start_btn_defect()">DEFECT</button>
                    </div>
                    <div class="col-sm-3 btn4">
                        <a href="#info" data-toggle="modal" id="detail" data-id="<?php echo $line; ?>">
                            <button class="btn btn-sm btn-danger btninfo btn-block" style="background-color:black;" id="btn_history">HISTORY</button>
                    </div>
                    </a>
                </div>
                <div style="overflow-y:auto; height:250px;">
                    <div id="tabel_data_defect">
                        <table class="table table-striped table-bordered" id="tabel_summary_defect_list" style="width:100%;">
                        </table>
                    </div>
                    <div id="tabel_data_hasil">
                        <div class="p-1" id="colomn_dua2">
                            <div class="col-md-12" id="hasilsementara2">
                                <div style="font-weight: bold; font-size:15px;">LIST DEFECT:</div>
                            </div>
                            <button id="buttonsementara2" onclick="listinputdefect()" class="btn btn-success btn-block">SUBMIT</button>
                        </div>
                        <table class="table table-striped table-bordered" style="width:100%;" id="colomn_dua1">
                            <thead>
                                <tr>
                                    <th class='norotate' style="font-size:20px;">TARGET TIME</th>
                                    <th class='rotate_text_green' style="font-size:20px;">RESULT</th>
                                </tr>
                            </thead>
                            <tbody id="tabel_summary_hasil_qa_perjam">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="info" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-admin" role="document" style="width:98%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> HISTORY PEKERJAAN </h4>
                </div>
                <div class="modal-body">
                    <div class="fetched-data">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                </div>
            </div>
        </div>
    </div>
    <input id="unit_name" type="hidden" />
    <script>
        function listinputdefect() {
            /* $("#buttonsementara3").attr("disabled", "disabled");
            $("#buttonsementara2").attr("disabled", "disabled");
            setTimeout(function(){
                $("#buttonsementara3").removeAttr("disabled");
                $("#buttonsementara2").removeAttr("disabled");
            },2000); */
            var unit_name = $("#unit_name").val();
            let id_schedule = $("#id_schedule").val();
            let line = '<?= $line; ?>';
            if (unit_name != "") {
                $.get("<?= base_url("api/listinputdefect"); ?>", {
                        unit_name: unit_name,
                        id_schedule: id_schedule,
                        line: line
                    })
                    .done(function(data) {
                        end_check();
                        $("#colomn_dua1").show();
                        $("#colomn_dua2").hide();
                        $("#hasilsementara2").html('<div style="font-weight: bold; font-size:15px;">LIST DEFECT:</div>');
                        $("#hasilsementara").html('<div style="font-weight: bold; font-size:15px;">LIST DEFECT:</div>');
                        $("#unit_name").val("");
                        cekidn();
                    });
            }
        }

        function inputdatadefect(unit_name) {
            let id_schedule = $("#id_schedule").val();
            var kodeDefect = $("#textbox1").val();
            // alert(id_schedule + "..." + kodeDefect + "..." + unit_name);
            if (id_schedule != "" && kodeDefect != "" && unit_name != "") {
                // alert("<?= base_url("api/tampildefectsementara"); ?>?defect_code="+kodeDefect+"&unit_name="+unit_name+"&id_schedule="+id_schedule);
                $.get("<?= base_url("api/tampildefectsementara"); ?>", {
                        defect_code: kodeDefect,
                        unit_name: unit_name,
                        id_schedule: id_schedule,
                    })
                    .done(function(data) {
                        if (data == '1') {
                            toast('Defect code not found!');
                        } else {
                            $("#hasilsementara").html(data);
                            $("#hasilsementara2").html(data);
                        }
                    });
            } else {
                toast('Warning! Data is incomplete.');
            }
        }

        function btndefect() {
            var unit_name = $("#unit_name").val();
            if (unit_name == "") {
                // alert('<?= base_url("api/namaunit"); ?>?line=<?= $line; ?>');
                $.get("<?= base_url("api/namaunit"); ?>", {
                        line: '<?= $line; ?>'
                    })
                    .done(function(data) {
                        unit_name = data;
                        inputdatadefect(unit_name);
                        $("#unit_name").val(unit_name);
                    });
            } else {
                inputdatadefect(unit_name);
            }
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#info').on('show.bs.modal', function(e) {
                var rowid = $(e.relatedTarget).data('id');
                $.ajax({
                    type: 'post',
                    url: baseUrl + 'Qa_end_line/history',
                    data: {
                        rowid: rowid,
                        url: '<?php echo $this->uri->segment(2); ?>',
                    },
                    success: function(data) {
                        $('.fetched-data').html(data);
                    }
                });
            });
        });
    </script>
</body>

<script language="javascript">
    $("#form_defect").hide();
    $("#form_output").hide();
    $("#form_output_hd").hide();

    $("#tabel_data_hasil").show();
    $("#tabel_data_defect").hide();

    $("#btn_data_defect").show();
    $("#btn_data_hasil").hide();

    $("#success-alert-defect-ok").hide();
    $("#success-alert-final-ok").hide();
    $("#success-alert-final-hd-ok").hide();
    $("#danger-alert-inspect-no").hide();
    $("#success-alert-inspect-ok_").hide();

    function btn_reload() {
        location.reload();
    }

    function btn_style() {
        location.href = "<?php echo base_url(); ?>Qa_end_line/daftar_scheduleb/<?php echo $line; ?>";
    }

    function start_btn_hasil() {
        $("#btn_data_hasil").hide();
        $("#btn_data_defect").show();
        $("#tabel_data_defect").hide();
        $("#tabel_data_hasil").show();
        $("#r").show();
        $("#l").show();
    }

    function start_btn_defect() {
        refresh_defect_table();
        $("#btn_data_hasil").show();
        $("#btn_data_defect").hide();
        $("#tabel_data_defect").show();
        $("#tabel_data_hasil").hide();
        $("#r").show();
        $("#l").show();
    }
</script>
<script>
    var cekid = "";
    getuuid();

    function getuuid() {
        $.ajax({
                url: "<?php echo base_url() ?>" + "Qa_end_line/get_uuid",
                type: 'POST',
                dataType: 'JSON',
            })
            .done(function(response) {
                cekid = response.cekid;
            });
    }

    function end_check() {
        call_refresh_all();
        $("#colomn_dua1").show();
        $("#colomn_dua2").hide();
        $(".kumpulant").show();
        $("#btn_start").show();
        $("#btn_ok").show();
        $("#btn_output").show();
        $("#btn_output_hd").show();
        $("#form_defect").hide();
        $("#form_output").hide();
        $("#form_output_hd").hide();
        $("#detail_data").show();
        cekid = "";
        getuuid();
    }
    var qty_checking = 0;
    var qty_defect = 0;

    function refresh_qty_cek() {
        var id_schedule = $("#id_schedule").val();
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url() . 'Qa_end_line/json_jumlah_qty_cek/' . $line . '/'; ?>" + id_schedule + "/<?= date("Y-m-d"); ?>",
            dataType: "JSON",
            data: {},
            success: function(response) {
                qty_checking = response.jumlah_qty_cek;
                document.getElementById("jml_ceck").innerHTML = qty_checking;
                hitung_persen_defect();
            }
        });
    }

    function refresh_sum_defect() {
        var id_schedule = $("#id_schedule").val();
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url() . 'Qa_end_line/json_jumlah_qty_defect1/' . $line . '/'; ?>" + id_schedule,
            dataType: "JSON",
            data: {},
            success: function(response) {
                //alert(response);
                $("#jml_defect").text(response.jumlahdefect);
                $("#dress_defect").text(response.jumlahdress);
                qty_defect = response.jumlahdress;
                hitung_persen_defect();
            }
        });
    }

    async function call_refresh_all() {
        await refresh_qty_cek();
        await refresh_sum_defect();
    }

    function hitung_persen_defect() {
        var persen_defect = 0;
        if (qty_checking > 0) {
            persen_defect = qty_defect / qty_checking * 100;
        }
        document.getElementById("jml_persen").innerHTML = persen_defect.toFixed(1);
        if (persen_defect >= 50) {
            document.getElementById("button_status").style.backgroundColor = "red";
        } else if (persen_defect >= 31) {
            document.getElementById("button_status").style.backgroundColor = "#FC0";
        } else if (persen_defect < 31) {
            document.getElementById("button_status").style.backgroundColor = "green";
        } else {
            document.getElementById("button_status").style.backgroundColor = "#CCC";
        }
    }

    function refresh_defect_table() {
        var id_schedule = $("#id_schedule").val();
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url() . 'Qa_end_line/sp_grid_summary_perdefect_hasil_inspect_bags_defect_list_version1/' . $line . '/'; ?>" + id_schedule,
            dataType: "JSON",
            data: {

            },
            success: function(response) {
                renderTable_summary(response, "tabel_summary_defect_list");
            }
        });
    }

    function renderTable_summary(data, nama_tabel) {
        // alert();
        var tableBody = document.getElementById(nama_tabel);
        //var rows = "<thead style='position: sticky; top: 0; background-color: #fff; z-index: 1; '> <tr> <th>KODE DEFECT</th> <th>KETERANGAN</th> <th>JUMLAH DEFECT</th> <th> PERSENTASE </th> </tr></thead>";
        var rows = '<tbody><tr><td width="7%" style="text-align:center;"><strong>KODE</strong></td><td width="54%"><strong>KETERANGAN</strong></td><td width="22%"><strong>JUMLAH</strong></td><td width="17%"><strong>PRESENTASE</strong></td></tr></tbody>';

        // Looping untuk setiap baris data
        for (var i = 0; i < data.length; i++) {
            rows += "<tr>";
            rows += "<td>" + data[i].kode_defect + "</td>";
            rows += "<td>" + data[i].keterangan + "</td>";
            rows += "<td>" + data[i].jumlah_defect + "</td>";
            rows += "<td>" + data[i].persen_defect + " %</td>";
            rows += "</tr>";
        }
        // Menambahkan baris data ke dalam tabel
        tableBody.innerHTML = rows;
    }

    function total_output_perline() {
        /* $.ajax({
          type: 'POST',
          url: "<?php echo base_url() . 'Qa_end_line/hasil_qa_perjam/' . $line  ?>",
          dataType: "JSON",
          data: {

          },
          success: function(response) {
            renderTable_total_output_perline(response, "tabel_summary_hasil_qa_perjam");
          }
        }); */
        // alert("<?php echo base_url() . 'api/hasillinejam'; ?>?tanggal=<?= date("Y-m-d"); ?>&line_sewing=<?= $line; ?>&id_schedule=<?= $id_schedule; ?>");
        var id_schedule = $("#id_schedule").val();
        $.get("<?php echo base_url() . 'api/hasillinejam'; ?>", {
                tanggal: '<?= date("Y-m-d"); ?>',
                line_sewing: '<?= $line; ?>',
                id_schedule: id_schedule
            })
            .done(function(data) {
                $("#tabel_summary_hasil_qa_perjam").html(data);
            });
    }

    function generateRandomNumber(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }
</script>

<script>
    // let textbox = document.querySelector('.textbox');
    var textbox1 = document.getElementById("textbox1");

    function insert1(char) {
        textbox1.value += char;
    }

    function calculate1() {
        try {
            textbox1.value = eval(textbox1.value);
        } catch (err) {
            textbox1.value = 'Error';
        }
    }

    function kosongkan1() {
        try {
            textbox1.value = "";
        } catch (err) {
            textbox1.value = 'Error';
        }
    }

    function top5defect(kodenya) {
        /* $(".btn-defect").attr("disabled", "disabled");
        setTimeout(function(){
            $(".btn-defect").removeAttr("disabled");
        },2000); */
        $("#textbox1").val(kodenya);
        btndefect()
        setTimeout(function() {
            $("#textbox1").val("");
        }, 2000);
    }

    function cekidn() {
        var color = $("#color").val();
        var size = $("#size").val();
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url() . 'Qa_end_line/cekidn/' . $line . '/'; ?>",
            dataType: "JSON",
            data: {
                color: color,
                size: size,
                KANAAN_PO: '<?= $_GET["KANAAN_PO"]; ?>',
                STYLE_NO: '<?= $_GET["STYLE_NO"]; ?>'
            },
            success: function(response) {
                $("#qtyorder").html(response.qtyorder);
                $("#target100").html(response.target100);
                $("#target").val(response.target100);
                $("#des").html(response.des);
                rubah_id_schedule(response.id_schedule);
                total_output_perline();
            }
        });
    }

    function start_check() {
        $("#colomn_dua1").hide();
        $("#colomn_dua2").show();
        $(".kumpulant").hide();
        $("#btn_start").hide();
        $("#btn_ok").hide();
        $("#form_defect").show();
        $("#form_defect_hd").hide();
        $("#detail_data").hide();
        $("#btn_output").hide();
        $("#btn_output_hd").hide();

        getuuid();

    }

    function oke_inspect() {
        /* $("#btn_ok").attr("disabled", "disabled");
        setTimeout(function(){
            $("#btn_ok").removeAttr("disabled");
        },2000); */

        getuuid();
        var kodeDefect = $("#textbox1").val();
        var color = $("#color").val();
        var size = $("#size").val();
        // alert('<?php echo base_url() . 'Qa_end_line/hasil_inspect_bags_defect_list_version1_action/' . $line; ?>');
        if (color == "") {
            alert("Color belum diisi!");
        } else if (size == "") {
            alert("Size belum diisi!");
        } else {
            // alert('<?php echo base_url() . 'Qa_end_line/hasil_inspect_bags_defect_list_version1_action/' . $line; ?>?kode_defect=OK&uuid='+cekid+'&qty=1&color='+color+'&size='+size+'&KANAAN_PO=<?= $_GET["KANAAN_PO"]; ?>&STYLE_NO=<?= $_GET["STYLE_NO"]; ?>');
            /* url: "<?php echo base_url() . 'Qa_end_line/hasil_inspect_bags_defect_list_version1_action/' . $line . '/' . $id_schedule  ?>", */
            $.ajax({
                type: 'POST',

                url: "<?php echo base_url() . 'Qa_end_line/hasil_inspect_bags_defect_list_version1_action/' . $line; ?>",
                dataType: "JSON",
                data: {
                    kode_defect: "OK",
                    uuid: cekid,
                    qty: 1,
                    color: color,
                    size: size,
                    KANAAN_PO: '<?= $_GET["KANAAN_PO"]; ?>',
                    STYLE_NO: '<?= $_GET["STYLE_NO"]; ?>'
                },
                success: function(response) {
                    // alert(response.id_schedule);
                    rubah_id_schedule(response.id_schedule);
                    total_output_perline();

                    if (response.status == "2") {
                        $("#success-alert-inspect-ok_").fadeTo(1000, 300).slideUp(300, function() {
                            $("#success-alert-inspect-ok_").slideUp(300);
                        });
                    } else if (response.status == "0") {
                        $("#danger-alert-inspect-no").fadeTo(1000, 300).slideUp(300, function() {
                            $("#danger-alert-inspect-no").slideUp(300);
                        });
                    } else if (response.status === "5") {
                        alert('Cek Kembali Schedule Produksi');
                    } else {
                        alert('Cek Kembali Schedule Produksi');
                    }
                }
            });
        }
    }
</script>
<script>
    // fungsi untuk membuka konten tab saat tombol tab diklik
    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
    }
</script>
<script>
    function rubah_id_schedule(id_schedule) {
        $("#id_schedule").val(id_schedule);
        $("#href1").attr("href", "<?php echo base_url(); ?>Qa_end_line/display_inspect/<?php echo $line; ?>/" + id_schedule);
        call_refresh_all();
    }
</script>