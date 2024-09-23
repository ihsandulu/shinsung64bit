<style>
  #po {
    background-color: #E8E8E8 !important;
    padding: 20px;
    border-radius: 3px;
    box-shadow: #F7F7F7 0px 0px 5px 1px;
  }

  th,
  td {
    text-align: center;
  }
</style>
<div class="body-body">
  <form class="form-horizontal" role="form">
    <div class="form-group">
      <label class="col-sm-2 control-label">FILE NO
        <input type="hidden" name="f_id" id="f_id" value="<?php echo @$ID ?>"> </label>
      <div class="col-sm-10">
        <input onchange="cekpo()" type="text" name="f_kanaan_po" class="form-control input-sm" id="f_kanaan_po" value="<?php echo @$KANAAN_PO ?>">


        <input type="hidden" name="f_id_order" id="f_id_order" value="">

        <!-- <input onclick="load_osliststyle();" style="cursor: pointer;" type="text" name="f_kanaan_po" class="form-control input-sm" id="f_kanaan_po" value="" readonly> -->

        <!--  <div class="input-group">
                              <span class="input-group-btn" hidden>
                                <button onclick="load_osliststyle();" class="btn btn-default btn-sm" type="button">PILIH KANAAN PO</button>
                              </span>
                                 </div> --><!-- /input-group -->
        <!-- <span class="help-block">klik untuk pilih kanaan po</span> -->


        <!-- Modal -->
        <div id="myModal" class="modal" role="dialog" hidden>
          <div class="modal-dialog modal-xl">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">SELECT FILE NO</h4>
                <small>Search di Enter </small>
              </div>
              <div class="modal-body">
                <table style="font-size: 11px; width: 100%; display: none;" id="tb_osliststyle" class="display compact nowrap" cellspacing="0">
                  <thead bgcolor="#eeeeee" align="center">
                    <tr>
                      <th>ACTION</th>
                      <th>FILE NO </th>
                      <th>BUYER </th>
                      <th>STYLE NO </th>
                      <th>ITEM </th>
                      <th>COLOR </th>
                      <th>SIZE </th>
                      <th>QTY ORDER </th>
                      <th>PP QTY</th>
                      <th>DESTINATION</th>
                      <th>FOB </th>
                      <th>DELIVERY </th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">BUYER</label>
      <div class="col-sm-10">
        <input class="form-control input-sm" type="text" name="f_buyer" id="f_buyer" value="<?php echo @$BUYER ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">STYLE NO</label>
      <div class="col-sm-10">
        <input onchange="cekpo()" class="form-control input-sm" type="text" name="f_style_no" id="f_style_no" value="<?php echo @$STYLE_NO ?>">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">ITEM</label>
      <div class="col-sm-10">
        <input class="form-control input-sm" type="text" name="f_item" id="f_item" value="<?php echo @$ITEM ?>">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">COLOR</label>
      <div class="col-sm-10">
        <input onchange="cekpo()" class="form-control input-sm" type="text" name="f_color" id="f_color" value="<?php echo @$COLOR ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">SIZE</label>
      <div class="col-sm-10">
        <input onchange="cekpo()" class="form-control input-sm" type="text" name="f_SIZE" id="f_SIZE" value="<?php echo @$SIZE ?>">
      </div>
    </div>


    <div class="form-group">
      <label class="col-sm-2 control-label">FOB</label>
      <div class="col-sm-10">
        <input class="form-control input-sm" type="number" name="f_fob" id="f_fob" value="<?php echo @$FOB ?>">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">DELIVERY</label>
      <div class="col-sm-10">
        <input class="form-control input-sm" type="date" name="f_delivery" id="f_delivery" value="<?php echo @$DELIVERY ?>" />
        <small>DELIVERY DATE (EXPORT) </small>
      </div>
    </div>

    <!-- 
                     <div class="form-group">
                        <label class="col-sm-2 control-label">TANGGAL CUTTING</label>
                        <div class="col-sm-5">
                           <input type="text" name="f_tanggal_cutting_start" class="form-control input-sm" id="f_tanggal_cutting_start" value="<?php echo @$TANGGAL_CUTTING_START ?>" placeholder="START" >
                        </div>
                        <div class="col-sm-5">
                           <input type="text" name="f_tanggal_cutting_end" class="form-control input-sm" id="f_tanggal_cutting_end" value="<?php echo @$TANGGAL_CUTTING_END ?>" placeholder="END" >
                        </div>
                    </div> -->

    <div class="form-group">
      <label class="col-sm-2 control-label">SEWING DATE <br>

      </label>
      <div class="col-sm-5">
        <input onchange="cekpo()" type="date" name="f_tanggal_sewing_start" class="form-control input-sm" id="f_tanggal_sewing_start" value="<?php echo @$TANGGAL_SEWING_START ?>" placeholder="START">
        <small> SEWING PROCESS START DATE </small>
      </div>
      <div class="col-sm-5">
        <input type="date" name="f_tanggal_sewing_end" class="form-control input-sm" id="f_tanggal_sewing_end" value="<?php echo @$TANGGAL_SEWING_END ?>" placeholder="END">
        <small> SEWING PROCESS END DATE </small>
      </div>

    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">LINE SEWING</label>
      <div class="col-sm-10">
        <select onchange="cekpo()" class="form-control" name="f_line_sewing" id="f_line_sewing">


        </select>
      </div>
    </div>


    <div class="form-group">
      <label class="col-sm-2 control-label">PO</label>
      <div class="col-sm-10" id="po">
        <input type="hidden" id="po_temporary" />
        <script>
          function cekpo() {
            let kanaan = $("#f_kanaan_po").val();
            let style = $("#f_style_no").val();
            let color = $("#f_color").val();
            let size = $("#f_SIZE").val();
            let line = $("#f_line_sewing").val();
            let sewingstart = $("#f_tanggal_sewing_start").val();
            let pogabungan = kanaan + ',' + style + ',' + color + ',' + size + ',' + line + ',' + sewingstart;
            // alert(pogabungan);
            $("#po_temporary").val(pogabungan);
            tablepo();
          }
          $(document).ready(function() {
            cekpo();
          });
        </script>
        <div class="form-group">
          <label class="col-sm-2 control-label">PO NUMBER</label>
          <div class="col-sm-10">
            <input class="form-control input-sm" type="text" id="po_number" value="">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">DC DATE</label>
          <div class="col-sm-10">
            <input class="form-control input-sm" type="date" id="po_date" value="">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">PO QTY</label>
          <div class="col-sm-10">
            <input class="form-control input-sm" type="number" id="po_qty" value="">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">&nbsp;</label>
          <div class="col-sm-10">
            <button onclick="insertpo()" type="button" class="btn btn-success">SUBMIT PO</button>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Data PO</label>
          <div class="col-sm-10">
            <table class="table table-bordered table-striped">
              <thead>
                <th class="col-sm-1">Action</th>
                <th class="col-sm-4">Date</th>
                <th class="col-sm-4">PO</th>
                <th class="col-sm-3">Qty</th>
              </thead>
              <tbody id="tablepo">

              </tbody>
            </table>
            <script>
              function tablepo() {
                let po_temporary = $("#po_temporary").val();
                // alert("<?= base_url("api/tablepo"); ?>?po_temporary=" + po_temporary);
                $.get("<?= base_url("api/tablepo"); ?>", {
                    po_temporary: po_temporary
                  })
                  .done(function(data) {
                    $("#tablepo").html(data);
                  });
              }

              $(document).ready(function() {
                tablepo();
              });

              function insertpo() {
                let po_temporary = $("#po_temporary").val();
                let po_number = $("#po_number").val();
                let po_date = $("#po_date").val();
                let po_qty = $("#po_qty").val();
                let KANAAN_PO = $("#f_kanaan_po").val();
                let STYLE_NO = $("#f_style_no").val();
                let COLOR = $("#f_color").val();
                let SIZE = $("#f_SIZE").val();
                if (KANAAN_PO != "" && STYLE_NO != "" && COLOR != "" && SIZE != "") {

                  if (po_number != "" && po_date != "" && po_qty != "") {
                    // $("#test").html("<?= base_url("api/insertpo"); ?>?po_temporary=" + po_temporary + "&po_number=" + po_number + "&po_date=" + po_date + "&po_qty=" + po_qty + "&KANAAN_PO=" + KANAAN_PO + "&STYLE_NO=" + STYLE_NO + "&COLOR=" + COLOR + "&SIZE=" + SIZE);
                    $.get("<?= base_url("api/insertpo"); ?>", {
                        po_temporary: po_temporary,
                        po_number: po_number,
                        po_date: po_date,
                        po_qty: po_qty,
                        KANAAN_PO: KANAAN_PO,
                        STYLE_NO: STYLE_NO,
                        COLOR: COLOR,
                        SIZE: SIZE
                      })
                      .done(function(data) {
                        tablepo();
                        clearpo();
                      });
                  } else {
                    toast("Data Tidak Lengkap!");
                  }
                } else {
                  toast("File No, Style, Color dan Size wajib sudah terisi!");
                }
              }

              function clearpo() {
                let po_temporary = $("#po_temporary").val("");
                let po_number = $("#po_number").val("");
                let po_date = $("#po_date").val("");
                let po_qty = $("#po_qty").val("");
              }

              function deletepo(po_id) {
                $.get("<?= base_url("api/deletepo"); ?>", {
                    po_id: po_id
                  })
                  .done(function(data) {
                    // alert(data);
                    tablepo();
                  });
              }
            </script>
          </div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">QUANTITY ORDER</label>
      <div class="col-sm-10">
        <input class="form-control input-sm" type="number" name="f_qty" id="f_qty" value="<?php echo @$QTY_ORDER ?>">
        <small>TOTAL QTY ORDER </small>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">HOURLY TARGET</label>
      <div class="col-sm-10">
        <input class="form-control input-sm" type="number" name="f_target100persen" id="f_target100persen" value="<?php echo @$target100persen ?>">
        <small>Target Per Jam </small>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">DESTINATION</label>
      <div class="col-sm-10">
        <input class="form-control input-sm" type="text" name="f_destination" id="f_destination" value="<?php echo @$DES ?>">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">QUANTITY LINE</label>
      <div class="col-sm-10">
        <input type="number" name="f_qty_plan" class="form-control input-sm" id="f_qty_plan" value="<?php echo @$QTY_PLAN ?>" placeholder="">
        <small>QTY ORDERS TO BE EXECUTED ON LINE </small>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">DAILY QUANTITY</label>
      <div class="col-sm-10">
        <input type="number" name="f_qty_harian" class="form-control input-sm" id="f_qty_harian" value="<?php echo @$QTY_HARIAN ?>" placeholder="">
        <small>TARGET QTY DAILY OUTPUT </small>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">NOTES</label>
      <div class="col-sm-10">
        <textarea name="f_catatan" id="f_catatan" cols="30" rows="5" class="form-control"><?php echo @$catatan ?></textarea>
      </div>
    </div>
    <?php
    $ctampilkan_andon = '';
    if (strtolower(@$tampilkan_andon) == 'y') {
      $ctampilkan_andon = "checked";
    }

    $ctampilkan_target = '';
    if (strtolower(@$tampilkan_target) == 'y') {
      $ctampilkan_target = "checked";
    }
    ?>
    <div class="form-group">
      <label class="col-sm-2 control-label">SET AS WALKING TARGET <?php //echo $ctampilkan_target
                                                                  ?> </label>
      <div class="col-sm-10">
        <input class="custom-control-input" type="checkbox" id="checkboxTarget" <?php echo $ctampilkan_target ?>> <label> Check if that day is used as a schedule that must be run </label>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">SET AS ANDON TABLE <?php //echo $ctampilkan_andon
                                                                ?> </label>
      <div class="col-sm-10">
        <input class="custom-control-input" type="checkbox" id="checkboxAndon" <?php echo $ctampilkan_andon ?>> <label> Check if you want it to be displayed at the bottom of the andon grid table. </label>
      </div>
    </div>

    <div class="form-group" id="btnClose">
      <label class="col-sm-2 control-label"></label>
      <div class="col-sm-10" id="btnClose">
        <input onclick="btn_insert_schedule_produksi()" class="btn btn-sm btn-primary" type="button" value="SAVE">
        <a id="btnCancel" onclick="btn_clear_data();" class="btn btn-sm btn-danger">CLEAR</a>
        <a class="btn btn-success btn-sm" href="<?php echo base_url() . '/Schedule_produksi/indexb'; ?>"><i class="fa fa-list" aria-hidden="true"></i> LIST SCHEDULE </a>
      </div>
    </div>
  </form>
</div>


<script>
  function btn_clear_data() {
    $('#f_nomor_penerimaan,#f_kanaan_po,#f_buyer,#f_style_no,#f_item,#f_color,#f_SIZE,#f_qty,#f_fob,#f_delivery,#f_tanggal_cutting_start,#f_tanggal_cutting_end,#f_tanggal_sewing_start,#f_tanggal_sewing_end,#f_qty_plan,#f_catatan,#f_line_sewing').val('');
  }

  function btn_insert_schedule_produksi() {
    let tablepo = $("#tablepo").html();
    // if (tablepo != "") {
      tampilkan_andon = 'n';
      if ($('#checkboxAndon').is(':checked')) {
        tampilkan_andon = 'Y';
      }

      tampilkan_target = 'n';
      if ($('#checkboxTarget').is(':checked')) {
        tampilkan_target = 'Y';
      }


      $.ajax({
          url: '<?php echo base_url() . 'Schedule_produksi/ajax_insert_schedule_produksi' ?>',
          type: 'POST',
          data: {
            // NOMOR_INPUT : $('#f_nomor_penerimaan').val(),
            // TANGGAL_INPUT : $('#f_tanggal_penerimaan').val(),
            ID: $('#f_id').val(),
            KANAAN_PO: $('#f_kanaan_po').val(),
            BUYER: $('#f_buyer').val(),
            STYLE_NO: $('#f_style_no').val(),
            ITEM: $('#f_item').val(),
            COLOR: $('#f_color').val(),
            SIZE: $('#f_SIZE').val(),
            LINE_SEWING: $('#f_line_sewing').val(),
            QTY_ORDER: $('#f_qty').val(),
            target100persen: $('#f_target100persen').val(),
            ID_ORDER: $('#f_id_order').val(),
            DES: $('#f_destination').val(),
            FOB: $('#f_fob').val(),
            DELIVERY: $('#f_delivery').val(),
            TANGGAL_CUTTING_START: $('#f_tanggal_cutting_start').val(),
            TANGGAL_CUTTING_END: $('#f_tanggal_cutting_end').val(),
            TANGGAL_SEWING_START: $('#f_tanggal_sewing_start').val(),
            TANGGAL_SEWING_END: $('#f_tanggal_sewing_end').val(),
            QTY_PLAN: $('#f_qty_plan').val(),
            QTY_HARIAN: $('#f_qty_harian').val(),
            catatan: $('#f_catatan').val(),
            tampilkan_andon: tampilkan_andon,
            tampilkan_target: tampilkan_target,
          },
        })
        .done(function() {
          edit_data = $('#f_id').val();
          if (edit_data == '') {
            alert('DATA BERHASIL DI SIMPAN');
          } else {
            alert('DATA BERHASIL DI PERBARUI');
          }
        })
        .fail(function() {
          alert('DATA TIDAK BERHASIL DI SIMPAN');
        });
    // }else{toast("PO belum diisi!");}
  }

  var isiline = 0;
  <?php if ($this->uri->segment(3)) : ?>
    $('#btnCancel').hide();
    $('#f_line_sewing').val('<?php echo $LINE_SEWING ?>')
    isiline = <?php echo $LINE_SEWING ?>;
  <?php endif ?>

  var min = 1,
    max = 25,
    select = document.getElementById('f_line_sewing');

  for (var i = min; i <= max; i++) {
    var opt = document.createElement('option');
    opt.value = i;
    opt.innerHTML = i;
    select.appendChild(opt);
  }

  function selectElement(id, valueToSelect) {
    let element = document.getElementById(id);
    element.value = valueToSelect;
  }
  selectElement('f_line_sewing', isiline);
</script>