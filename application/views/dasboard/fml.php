<style>
#customers {
	font-family: Arial, Helvetica, sans-serif;
	border-collapse: collapse;
	width: 100%;
}
#customers td, #customers th {
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
.container .pull-left {
	width: 55%;
	float: left;
	margin: 20px 20px 20px -80px;
}
</style>
<div style="overflow-y:auto; height:300px;">
<table width="60%"  id="customers">
  <tr>
    <td width="9%"><div align="center"><strong>LINE</strong></div></td>
    <td width="25%"><div align="center"><strong>F</strong></div></td>
    <td width="25%"><div align="center"><strong>M</strong></div></td>
    <td width="24%"><p align="center"><strong>L</strong></p></td>
  </tr>
  <?php foreach ($data as $row): ?>
  <tr>
    <td><?php echo $row['line']; ?></td>
    <td><?php if($row['f'] !="") {  ?>
      <img src="<?php echo base_url() ?>uploads/style/<?php echo $row['f']; ?>"  height="60" data-action="zoom" class="pull-left" />
      <?php } else { echo '-'; }; ?></td>
    <td><?php if($row['m'] !="") {  ?>
      <img src="<?php echo base_url() ?>uploads/style/<?php echo $row['m']; ?>"  height="60" data-action="zoom" class="pull-left"  />
      <?php } else { echo '-'; }; ?></td>
    <td><?php if($row['l'] !="") {  ?>
      <img src="<?php echo base_url() ?>uploads/style/<?php echo $row['l']; ?>"  height="60" data-action="zoom" class="pull-left"  />
      <?php } else { echo '-'; }; ?></td>
  </tr>
  <?php endforeach; ?>
</table>
</div>