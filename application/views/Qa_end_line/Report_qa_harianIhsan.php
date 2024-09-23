<style>
  @media print {
    body {
      visibility: hidden;
      font-size: 10px;
    }

    #area_print {
      visibility: visible;
      left: 0;
      top: 0;
    }

    #judul {
      display: inherit !important;
    }

    #area_header {
      display: inherit !important;
    }

    #print {
      display: none !important;
    }
  }

  table {
    width: inherit;
    /* border-collapse: collapse; */
    padding: 3px;
  }

  th {
    background-color: white;
    border-right: 1px solid black;
    border-left: 1px solid black;
    border-top: 1px solid black;
    border-bottom: 1px solid black;
    color: black;
    text-align: center;
    /* Teks di tengah kolom header */
    padding: 5px;
  }

  td {
    border: 1px solid black;
    padding: 3px;
  }

  .header {
    border: 0px solid #000;
    padding: 0px;
    margin: 0px;
    font-size: 11px;
  }

  .table thead th {
    border-bottom: 1px solid #ddd !important;
    border-top: 0;
    font-weight: 700;
  }

  .rotated_cell {
    text-align: left !important;
    vertical-align: bottom !important;
    padding: 1px !important;
    width: 15px;
  }

  .rotate_text {
    writing-mode: vertical-lr !important;
    -webkit-writing-mode: vertical-lr !important;
    -ms-writing-mode: vertical-lr !important;
    -webkit-transform: rotate(-180deg) !important;
    -moz-transform: rotate(-180deg) !important;
    -o-transform: rotate(-180deg) !important;
    transform: rotate(-180deg) !important;
    color: red;
  }

  .rotate_text_green {
    writing-mode: vertical-lr !important;
    -webkit-writing-mode: vertical-lr !important;
    -ms-writing-mode: vertical-lr !important;
    -webkit-transform: rotate(-180deg) !important;
    -moz-transform: rotate(-180deg) !important;
    -o-transform: rotate(-180deg) !important;
    transform: rotate(-180deg) !important;
    color: green;
  }

  .norotate {
    width: 100px;
  }

  .start {
    color: green;
  }

  .end {
    color: orangered;
  }

  .green {
    color: green;
  }

  .red {
    color: red;
  }
  .tfoot1{background-color: aquamarine;}
  .tfoot2{background-color:aqua;}
</style>

<div id="area_print">
  <?php echo header_print(); ?>
  <div style="overflow-x:auto;">
    <div id="save_excel">
      <div align="center"><strong><?php echo $pagetitle; ?></strong></div>
      <br />
      <table border="1" width="100%">
        <thead>
          <?php
          $harike =  date('N', strtotime($_POST['tanggal']));
          if ($harike == 5) {
            $hari_ket = "jumat";
          } else if ($harike == 6) {
            $hari_ket = "sabtu";
          } else if ($harike == 7) {
            $hari_ket = "minggu";
          } else {
            $hari_ket = "senin - kamis";
          }
          $tanggal = $_POST["tanggal"];
          $jenis = $this->db
            ->select("daftar_defect.jenis, inspect_v2.kode_defect, daftar_defect.keterangan")
            ->join("daftar_defect", "daftar_defect.kode = inspect_v2.kode_defect", "left")
            ->where("line", $_POST['line_sewing'])
            ->where("kode_defect !=", "OK")
            ->where("CONVERT(VARCHAR, inspect_v2.time_stamp , 23) = ", $tanggal)
            ->group_by(array('daftar_defect.jenis', 'inspect_v2.kode_defect', 'daftar_defect.keterangan'))
            ->get("inspect_v2");
          // echo $this->db->last_query();
          ?>
          <tr>
            <th class='norotate'>Jam Ke</th>
            <!-- <th class='rotate_text_green'>OK</th> -->
            <?php

            $tarjenis = array();
            $tarjenis["OK"] = 0;

            $arjenis = array();
            $arjenis["OK"] = '';
            foreach ($jenis->result() as $row) {
              $arjenis[$row->kode_defect] = '';
              $tarjenis[$row->kode_defect] = 0;
            ?>
              <th class="rotated_cell">
                <div class='rotate_text'><?= $row->jenis; ?>-<?= $row->kode_defect; ?>-<?= $row->keterangan; ?></div>
              </th>
            <?php } ?>
            <!-- <th class='rotate_text_green'>Total Pieces</th> -->
            <!-- <th class='rotate_text_green'>Total OK</th> -->
            <th class='rotate_text_green'>Total Defect</th>
            <th class='rotate_text_green'>Defect Rate</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $tpieces = 0;
          $tarok = 0;
          $tardefect = 0;
          $jam = $this->db
            ->select("CAST(jam_ke AS INT) AS jam_ke_int, MIN(jam_start) AS jam_start, MIN(jam_end) AS jam_end")
            ->from("jam_narget_detail")
            ->join("jam_narget_header", "jam_narget_header.id = jam_narget_detail.id_header", "left")
            ->where("jam_narget_header.is_active", "y")
            ->where("jam_narget_detail.hari", $hari_ket)
            ->group_by("jam_ke")
            ->order_by("CONVERT(INT, jam_ke)")
            ->get();
          // echo $this->db->last_query();
          foreach ($jam->result() as $row) {
            $jam_start = $row->jam_start;
            $jam_end = $row->jam_end;
          ?>
            <tr>
              <td>Jam ke : <?= $row->jam_ke_int; ?><br />
                <b>S:</b><span class="start"><?= substr($row->jam_start, 0, 8); ?></span><br />
                <b>E:</b><span class="end"><?= substr($row->jam_end, 0, 8); ?></span>
              </td>
              <?php
              $mjenis = $this->db
                ->select("inspect_v2.kode_defect, COUNT(id)as jml")
                ->where("line", $_POST['line_sewing'])
                // ->where("kode_defect !=", "OK")
                ->where("CONVERT(VARCHAR, inspect_v2.time_stamp , 23) = ", $tanggal)
                ->where("CAST(time_stamp AS TIME) BETWEEN '" . $jam_start . "' AND '" . $jam_end . "'")
                ->group_by(array('inspect_v2.kode_defect'))
                ->get("inspect_v2");
              // echo $this->db->last_query();
              foreach ($mjenis->result() as $rowj) {
                $arjenis[$rowj->kode_defect] = $rowj->jml;
              }
              $total = 0;
              $tok = 0;
              $tdefect = 0;
              $pdefect = 0;
              foreach ($arjenis as $kode_defect => $value) {
                if (is_numeric($value)) {
                  $total += $value;
                  $tarjenis[$kode_defect] += $value;
                }

                if ($value > 0) {
                  if ($kode_defect == "OK") {
                    $color = "green";
                    $tok += $value;
                  } else {
                    $color = "red";
                    $tdefect += $value;?>
                    <td class="<?= $color; ?>">
                      <?= $value; ?>
                    </td>
                    <?php
                  }
                  
                  $arjenis[$kode_defect] = '';
                } else { ?>
                  <?php  if ($kode_defect != "OK") {?>
                    <td>
                      <?= $value; ?>
                    </td>
                  <?php }?>
                <?php } ?>
              <?php } ?>

              <!-- <td>
                <?= $total; ?>
                <?php $tpieces += $total; ?>
              </td> -->
              <!-- <td>
                <?= $tok; ?>
                <?php $tarok += $tok; ?>
              </td> -->
              <td>
                <?= $tdefect; ?>
                <?php $tardefect += $tdefect; ?>
              </td>
              <td>
                <?php if ($tdefect > 0) {
                  $pdefect = (($tdefect / $total) * 100);
                  echo round($pdefect, 2) . " %";
                } else {
                  echo "";
                } ?>
              </td>
            </tr>
          <?php
            $total = 0;
            $tok = 0;
            $tdefect = 0;
          } ?>
        <tfoot>
          <th class=''>Total</th>
          <?php
          foreach ($arjenis as $kode_defect => $value) { ?>
            <?php if($kode_defect!="OK"){?>
            <td class="tfoot1"><?= $tarjenis[$kode_defect]; ?></td>
            <?php }?>
          <?php } ?>
          <!-- <td class="tfoot2"><?= $tpieces; ?></td> -->
          <!-- <td class="tfoot2"><?= $tarok; ?></td> -->
          <td class="tfoot2"><?= $tardefect; ?></td>
          <td class="tfoot2">
            <?php if ($tardefect > 0) {
              $tpdefect = (($tardefect / $tpieces) * 100);
              echo round($tpdefect, 2) . " %";
            } else {
              echo "";
            } ?>
          </td>
        </tfoot>
        </tbody>
      </table>
      <script>
        $(document).ready(function() {
          $('.vertical-text').css('height', $('.vertical-text').width());
        });
      </script>
    </div>
  </div>

  <script type="text/javascript">
    $("#ExportToExcel").click(function(e) {
      var a = document.createElement('a');
      //getting data from our div that contains the HTML table
      var data_type = 'data:application/vnd.ms-excel';
      var table_div = document.getElementById('save_excel');
      var table_html = table_div.outerHTML.replace(/ /g, '%20');
      a.href = data_type + ', ' + table_html;
      //setting the file name
      a.download = 'REPORT_DAILY_LINE_<?php echo date('Y-m-d'); ?>.xls';
      //triggering the function
      a.click();
      //just in case, prevent default behaviour
      e.preventDefault();
    });
  </script>