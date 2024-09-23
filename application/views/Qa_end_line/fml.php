<style>
  #customers {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }

  #customers td,
  #customers th {
    border: 1px solid #ddd;
    padding: 8px;
  }

  #customers tr:nth-child(even) {
    background-color: #f2f2f2;
  }
  }
</style>
<style>
  /* SIMPLE DEMO STYLES */


  .container img {
    width: 100%;
  }

  .pull-left {
    height: 100px;
    width: auto;
    position: relative;
    left:50%;
    top:50%;
    transform: translate(-50%,0);
  }
  .fmlr{margin-top:20px;}
</style>

<hr />
<div class="row">
  <div class="col-md-12">
    <div style="width:100%;" align="center"><strong>
        <?php if ($info_line == "") {
          echo '';
        } else {
          echo 'LINE : ' . $info_line;
        } ?>
        <?php if ($info_tanggal == "") {
          echo '';
        } else {
          echo 'DATE : ' . tgl($info_tanggal);
        } ?>
      </strong>
    </div>
    <div class="col-md-6 fmlr">
      <table id="customers">
        <tr>
          <td>
            <div align="center"><strong>LINE</strong></div>
          </td>
          <td>
            <div align="center"><strong>DATE</strong></div>
          </td>
          <td>
            <div align="center"><strong>MORNING</strong></div>
          </td>
          <!-- <td><div align="center"><strong>M</strong></div></td> -->
          <td>
            <p align="center"><strong>AFTERNOON</strong></p>
          </td>
        </tr>
        <?php foreach ($first_table as $row): ?>
          <tr>
            <td align="center"><?php echo $row['line']; ?></td>
            <td align="center"><b><?php echo $row['tanggal_upload']; ?></b></td>
            <td align="center"><?php if ($row['f'] != "") {  ?>
                <img src="<?php echo base_url() ?>uploads/style/<?php echo $row['f']; ?>" height="70" data-action="zoom" class="pull-left" />
              <?php } else {
                  echo 'Image not uploaded yet!';
                }; ?>
            </td>
            <!-- <td><?php if ($row['m'] != "") {  ?>
          <img src="<?php echo base_url() ?>uploads/style/<?php echo $row['m']; ?>"  height="70" data-action="zoom" class="pull-left"  />
          <?php } else {
                        echo 'Image not uploaded yet!';
                      }; ?></td> -->
            <td align="center"><?php if ($row['l'] != "") {  ?>
                <img src="<?php echo base_url() ?>uploads/style/<?php echo $row['l']; ?>" height="70" data-action="zoom" class="pull-left" />
              <?php } else {
                  echo 'Image not uploaded yet!';
                }; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
    <div class="col-md-6 fmlr">
      <table id="customers">
        <tr>
          <td>
            <div align="center"><strong>LINE</strong></div>
          </td>
          <td>
            <div align="center"><strong>DATE</strong></div>
          </td>
          <td>
            <div align="center"><strong>MORNING</strong></div>
          </td>
          <!-- <td><div align="center"><strong>M</strong></div></td> -->
          <td>
            <p align="center"><strong>AFTERNOON</strong></p>
          </td>
        </tr>
        <?php foreach ($second_table as $row): ?>
          <tr>
            <td align="center"><?php echo $row['line']; ?></td>
            <td align="center"><b><?php echo $row['tanggal_upload']; ?></b></td>
            <td align="center"><?php if ($row['f'] != "") {  ?>
                <img src="<?php echo base_url() ?>uploads/style/<?php echo $row['f']; ?>" height="70" data-action="zoom" class="pull-left" />
              <?php } else {
                  echo 'Image not uploaded yet!';
                }; ?>
            </td>
            <!-- <td><?php if ($row['m'] != "") {  ?>
          <img src="<?php echo base_url() ?>uploads/style/<?php echo $row['m']; ?>"  height="70" data-action="zoom" class="pull-left"  />
          <?php } else {
                        echo 'Image not uploaded yet!';
                      }; ?></td> -->
            <td align="center"><?php if ($row['l'] != "") {  ?>
                <img src="<?php echo base_url() ?>uploads/style/<?php echo $row['l']; ?>" height="70" data-action="zoom" class="pull-left" />
              <?php } else {
                  echo 'Image not uploaded yet!';
                }; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>
</div>
<div class="col-md-4"></div>