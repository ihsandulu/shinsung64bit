<?php 
 pre($data);
?>
<div class="row"  >
	<div class="col-md-8">
        <div class="box">
          <div class="box-header">
            <div class="body-body">
              <div class="row">
<table class="table table-bordered">
      <thead>
        <tr>
          <th>Kode Defect</th>
          <th>Keterangan</th>
          <th>Jumlah Defect</th>
          <th>Persen Defect</th>
        </tr>
      </thead>
      <tbody>
      	<?php
         
        foreach ($data as $defect) {
          echo "<tr>";
          echo "<td>" . $defect['kode_defect'] . "</td>";
          echo "<td>" . $defect['keterangan'] . "</td>";
          echo "<td>" . $defect['jumlah_defect'] . "</td>";
          echo "<td>" . $defect['persen_defect'] . "%</td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
 </div>