<style>
  /* Gaya untuk button */
  .btn-custom {
    margin: 1px;
    width: 35px;
    height: 35px;
    font-size: 14px;
    font-weight: bold;
    border-radius: 12%;
    text-align: center;
    line-height: 1.5;
    /* Mengatur warna background secara acak */
    background-color: <?php echo sprintf("#%06x", rand(0, 16777215)); ?>;
    color: white;
  }

  /* Mengatur tampilan button pada layar kecil */
</style>

<div class="row">
  <div class="col-md-12">
    <div align="right" style="color:#FF0000; margin-top:-40px; margin-bottom:20px; font-size:16px;"> <B> <u>APABILA ADA JADWAL YANG BELUM ADA DI DAFTAR LIST HUBUNGI PPIC SCHEDULE </u></B></div>
    <?php
    $line = $this->uri->segment(3);
    $sql = $this->db->from("SGI_LEAN.dbo.v_schedule_produksi_2021_hari_ini")
      ->select("MIN(ID) AS ID, 
      KANAAN_PO, 
      STYLE_NO, 
      MAX(tampilkan_target) AS tampilkan_target, 
      MIN(ITEM) AS ITEM, 
      SUM(QTY_ORDER) AS QTY_ORDER, 
      MIN(FOB) AS FOB, 
      MIN(CONVERT(date, DELIVERY)) AS GAC, 
      SUM(QTY_PLAN) AS QTY_PLAN, 
      MIN(DES) AS DES")
      ->where("LINE_SEWING", $line)
      ->group_by("KANAAN_PO, STYLE_NO")
      ->order_by("tampilkan_target", "DESC")
      ->get();
    if ($sql->num_rows() > 0) {
    ?>
      <div style="overflow-x:auto;">
        <table class="table" width="100%;">
          <thead>
            <tr>
              <th width="70" align="center">CEK IN</th>
              <th width="70" align="center">CEK OUT</th>
              <!-- <th width="70" align="center">IRON</th>
              <th width="70" align="center">PACKING</th> -->
              <th width="70" align="center">F M L</th>
              <th>FILE NO</th>
              <th>STYLE NO</th>
              <!-- <th>TARGET </th> -->
              <th>ITEM</th>
              <!-- <th>QTY ORDER</th>
              <th>FOB</th>
              <th>GAC</th>
              <th>QTY PLAN</th>
              <th>DES</th> -->
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($sql->result() as $row) { ?>
              <td><a href="<?= base_url("Qa_end_line/hasil_inspect_bags_defect_list_version2/" . $line . "/" . $row->ID . "?KANAAN_PO=" . $row->KANAAN_PO . "&STYLE_NO=" . $row->STYLE_NO); ?>"><button type="button" class="btn btn-danger btn-md"> <i class="fa fa-sign-in"></i> </button></a></td>

              <td><a href="<?= base_url("Qa_end_line/hasil_inspect_bags_defect_list_version1/" . $line . "/" . $row->ID . "?KANAAN_PO=" . $row->KANAAN_PO . "&STYLE_NO=" . $row->STYLE_NO); ?>"><button type="button" class="btn btn-warning btn-md"> <i class="fa fa-sign-in"></i> </button></a></td>

              <!-- <td><a href="<?= base_url("Qa_end_line/hasil_inspect_bags_defect_list_version3/" . $line . "/" . $row->ID . "?KANAAN_PO=" . $row->KANAAN_PO . "&STYLE_NO=" . $row->STYLE_NO); ?>"><button type="button" class="btn btn-success btn-md"> <i class="fa fa-plug"></i> </button></a></td>

              <td><a href="<?= base_url("Qa_end_line/hasil_inspect_bags_defect_list_version4/" . $line . "/" . $row->ID . "?KANAAN_PO=" . $row->KANAAN_PO . "&STYLE_NO=" . $row->STYLE_NO); ?>"><button type="button" class="btn btn-primary btn-md"> <i class="fa fa-dropbox"></i> </button></a></td> -->

              <td><a href="<?= base_url("Qa_end_line/upload_style_img/" . $line . "/" . $row->ID . "?KANAAN_PO=" . $row->KANAAN_PO . "&STYLE_NO=" . $row->STYLE_NO); ?>"><button type="button" class="btn btn-info btn-md"> <i class="fa fa-file-image-o"> </i> </button></a></td>
              <td><?= $row->KANAAN_PO; ?></td>
              <td><?= $row->STYLE_NO; ?></td>
              <!-- <td><?= $row->tampilkan_target; ?></td> -->
              <td><?= $row->ITEM; ?></td>
              <!-- <td><?= $row->QTY_ORDER; ?></td>
              <td><?= $row->FOB; ?></td>
              <td><?= $row->GAC; ?></td>
              <td><?= $row->QTY_PLAN; ?></td>
              <td><?= $row->DES; ?></td> -->
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <div style="overflow-x:auto;"> <B> APABILA ADA JADWAL YANG BELUM ADA DI DAFTAR LIST HUBUNGI PPIC SCHEDULE </B></div>
    <?php
    } else {
      echo "<H1> SCHEDULE LINE KOSONG <BR> HUBUNGI PPIC SCHEDULE </H1>";
    }
    ?>
  </div>
</div>