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

    .textbox2 {
        font-size: 24px;
        width: 100%;
        text-align: right;
        /* padding-right: 5px; */
    }

    .button {
        height: 80px;
        width: 80px;
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
        background-color: #5AA225;
        align-items: center;
        justify-content: center;
        border: 1px dashed #C1C1B9;
        padding: 5px;
        color: #FFF;
        height: 70px;
    }

    .kangka4 {
        border-bottom: #000 dashed 1px;
        background-color: #B0A936;
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


    .angka1 {
        font-weight: bold;
        font-size: 30px;
        text-align: center;
        vertical-align: middle !important;
    }

    .tangka {
        font-weight: bold;
        font-size: 30px;
        text-align: left;
        display: inline-block !important;
        vertical-align: middle !important;
    }

    .tangka1 {
        font-weight: bold;
        font-size: 13px;
        text-align: center;
        display: inline-block !important;
        vertical-align: middle !important;
        margin: 0px;
        background-color: #E4E4E4;
        color: #000;
        padding: 0px 5px 0px 5px;
        border-radius: 2px;
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
        height: 150px;
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
        top: 200px;
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

    #textbox1 {}

    #tombold {
        vertical-align: top;
        margin-top: 10px !important;
    }

    #tombold2 {
        vertical-align: top;
        margin-top: 10px !important;
    }

    #pilihancolor {
        margin-top: 10px !important;
    }

    .btn4 {
        padding: 1px;
        padding-top: 2px;
    }

    #btn_data_defect {
        position: relative;
        top: -5px !important;
    }

    .ftb {
        padding: 0px 10px 0px 10px;
        margin-top: 10px !important;
    }
</style>

<body>
    <div class="container-fluid">

        <div id="getJam" style="font-size:12px; color:#000;  font-size:25px; margin-top:-46px;" align="right"></div>

        <script>
            $(document).ready(function() {
                function updateClock() {
                    var now = new Date();
                    var hours = now.getHours().toString().padStart(2, '0');
                    var minutes = now.getMinutes().toString().padStart(2, '0');
                    $('#getJam').text(hours + ':' + minutes);
                }

                // Perbarui jam setiap detik
                setInterval(updateClock, 60000);

                // Inisialisasi jam saat halaman dimuat
                updateClock();
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

                <div id="detail_data">
                    <div align="left">
                        <strong>
                            <a id="href1" href="<?php echo base_url(); ?>Qa_end_line/display_inspect/<?php echo $line; ?>/<?php echo $id_schedule; ?>" target="_blank">
                            </a>
                        </strong>
                    </div>
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

                <div class="container_form1" id="form_defect">
                    <div align="center" style="width:98%;">
                        <div class="alert alert-danger" id="danger-alert-inspect-no">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            <strong> </strong> KODE TIDAK TERDAFTAR
                        </div>
                    </div>

                    <input type="hidden" id="id_schedule" value="" />
                    <input type="hidden" id="target" value="0" />
                    <span style="clear:both!important;"></span>
                    <form class="form-horizontal m-0 p-0" id="pilihancolor">
                        <div class="form-group col-md-4 pilihcs">
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
                        <div class="form-group col-md-4 pilihcs">
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
                        <div class="form-group col-md-4 pilihcs" id="">
                            <?php
                            $kanaan_po = $this->input->get('KANAAN_PO');
                            $style_no = $this->input->get('STYLE_NO');
                            $po = $this->db->from("po")
                                ->where("KANAAN_PO", $kanaan_po)
                                ->where("STYLE_NO", $style_no)
                                ->get();
                            // echo $this->db->last_query();
                            ?>
                            <select class="form-control  text-15" id="po">
                                <option value="">PO</option>
                                <?php
                                foreach ($po->result() as $po) { ?>
                                    <option value="<?= $po->po_id; ?>"><?= $po->po_number; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </form>
                    <div class=" col-md-12 m-0 ftb" id="">
                        <input type="text" class="textbox2" id="textbox1" name="textbox1" readonly>
                    </div>
                    <div class=" col-md-12 m-0 p-0 " id="tombold">
                        <button class="button" style="background-color:black;" onClick="insert1('0')">0</button>
                        <button class="button" style="background-color:black;" onClick="insert1('1')">1</button>
                        <button class="button" style="background-color:black;" onClick="insert1('2')">2</button>

                        <button class="button" style="background-color:black;" onClick="insert1('3')">3</button>
                        <button class="button" style="background-color:black;" onClick="insert1('4')">4</button>
                        <button class="button" style="background-color:black;" onClick="insert1('5')">5</button>

                        <button class="button" style="background-color:black;" onClick="insert1('6')">6</button>
                        <button class="button" style="background-color:black;" onClick="insert1('7')">7</button>
                        <button class="button" style="background-color:black;" onClick="insert1('8')">8</button>

                        <button class="button" style="background-color:black;" onClick="insert1('9')">9</button>
                        <!-- <button class="button" style="background-color:darkgreen;" onClick="ok_defect()">OK</button> -->
                        <button class="button" style="background-color:darkgreen" onClick="btnhangtag()">OK</button>
                        <button class="button" style="background-color:red" onClick="kosongkan1()">DEL</button>
                    </div>
                </div>
            </div>
            <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 colomn_dua m-0 p-0">
                <div class="row  m-0">
                    <div class="col-md-5">
                        <div class="row kangka2 btn btn-success" style="">
                            <div class="tangka1 col-md-12 col-sm-12 col-xs-12 text-center"> QTY / ACC</div>
                            <div id="jml_ceck" class="angka1 col-md-12 col-sm-12 col-xs-12 text-center">0 / 0</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row kangka4" style="">
                            <div class="tangka1 col-md-12 col-sm-12 col-xs-12 text-center"> IRONING</div>
                            <div id="tsewing" class="angka1 col-md-12 col-sm-12 col-xs-12 text-center">0</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row kangka3" id="button_status" style="">
                            <div class="tangka1 col-md-12 col-sm-12 col-xs-12 text-center"> ACHIEVEMENT %</div>
                            <div id="jml_persen" class="angka1 col-md-12 col-sm-12 col-xs-12 text-center">0</div>
                        </div>
                    </div>
                </div>


                <div align="right">
                    <font size="+1" hidden>OUTPUT QC : </font><b> <span id="jml_qty" style="text-align:left; font-weight: bold; margin-right:10px; font-size:18px;" hidden></span></b>
                    <div class="col-sm-6 btn4">
                        <button class="btn btn-sm btn-danger btninfo btn-block" style="background-color:darkred;" id="r" onClick="btn_reload()">REFRESH</button>
                    </div>
                    <div class="col-sm-6 btn4">
                        <button class="btn btn-sm btn-danger btninfo  btn-block" style="background-color:darkblue;" id="l" onClick="btn_style()">STYLE</button>
                    </div>
                </div>


                <div style="overflow-y:auto; height:250px;">



                    <div id="tabel_data_hasil">
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



    <input id="unit_name" type="hidden" />
    <script>
        function btnhangtag() {
            let id_schedule = $("#id_schedule").val();
            let LINE = '<?= $line; ?>';
            var QTY = $("#textbox1").val();
            let po_id = $("#po").val();
            // alert(id_schedule + "..." + QTY + "..." + LINE);
            if (id_schedule != "" && QTY != "" && LINE != "" && po_id != "") {
                // alert("<?= base_url("api/inserthangtag"); ?>?QTY="+QTY+"&LINE="+LINE+"&id_schedule="+id_schedule);
                $.get("<?= base_url("api/inserthangtag"); ?>", {
                        QTY: QTY,
                        LINE: LINE,
                        id_schedule: id_schedule,
                        po_id: po_id,
                    })
                    .done(function(data) {
                        cekidn();
                        kosongkan1();
                    });
            } else {
                toast('Warning! Data is incomplete.');
            }
        }
    </script>
    <div id="test"></div>

</body>

<script language="javascript">
    $("#form_defect").show();
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
</script>

<script>
    var cekid = "";
    var qty_checking = 0;
    var qty_tchecking = 0;
    var qty_sewing = 0;

    function refresh_qty_cek() {
        var id_schedule = $("#id_schedule").val();
        if (id_schedule != "") {
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url() . 'Qa_end_line/hangtagok/' . $line . '/'; ?>" + id_schedule + "/<?= date("Y-m-d"); ?>",
                dataType: "JSON",
                data: {},
                success: function(response) {
                    // $("#test").html(response.query);
                    qty_checking = response.jumlah_qty_cek;
                    qty_tchecking = response.jumlah_tqty_cek;
                    qty_sewing = response.target;
                    document.getElementById("jml_ceck").innerHTML = qty_checking + ' / ' + qty_tchecking;
                    $("#tsewing").html(qty_sewing);
                    $("#jml_persen").html('0 % ');
                    var persen_hangtag = 0;
                    if (qty_tchecking > 0) {
                        persen_hangtag = qty_tchecking / qty_sewing * 100;
                    }
                    if (persen_hangtag >= 100) {
                        document.getElementById("button_status").style.backgroundColor = "red";
                    } else {
                        document.getElementById("button_status").style.backgroundColor = "#5AA225";
                    }
                    document.getElementById("jml_persen").innerHTML = persen_hangtag.toFixed(1);
                }
            });
        } else {
            document.getElementById("jml_ceck").innerHTML = 0;
        }

    }



    function total_output_perline() {
        var id_schedule = $("#id_schedule").val();
        // alert("<?php echo base_url() . 'api/hasillinejamhangtag'; ?>?tanggal=<?= date("Y-m-d"); ?>&line_sewing=<?= $line; ?>&"+id_schedule);
        if (id_schedule != "") {
            $.get("<?php echo base_url() . 'api/hasillinejamhangtag'; ?>", {
                    tanggal: '<?= date("Y-m-d"); ?>',
                    line_sewing: '<?= $line; ?>',
                    id_schedule: id_schedule
                })
                .done(function(data) {
                    $("#tabel_summary_hasil_qa_perjam").html(data);
                });
        } else {
            $("#tabel_summary_hasil_qa_perjam").html('');
        }
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




    function cekcolorsize() {
        var color = $("#color").val();
        var size = $("#size").val();
        if (color == "") {
            alert("Silahkan isi color!");
        } else if (size == "") {
            alert("Silahkan isi size!");
        } else {
            cekidn();
        }
    }

    function cekidn() {
        var color = $("#color").val();
        var size = $("#size").val();
        if (color != "" && size != "") {
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
                    $("#des").html(response.des);
                    rubah_id_schedule(response.id_schedule);
                    total_output_perline();
                }
            });
        } else {
            $("#qtyorder").html('');
            $("#target100").html('');
            $("#des").html('');
            rubah_id_schedule('');
            total_output_perline();
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
        refresh_qty_cek();
    }
</script>