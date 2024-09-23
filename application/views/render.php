<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title ?></title>
  <link rel="stylesheet" href="">
  <style>
    body{
      text-align: center;
    }
  </style>
</head>
<body>
<div style="width:400px; border:1px solid #F00;">
<?php $no=1; foreach ($data as $row): ?>
<div align="left" style="width:180px; border:1px solid #F00;"><img src="<?php echo site_url('Render/Barcode/'.$row['barcode']); ?>"></div>
<?php endforeach ?>
</div>
</body>
</html>
    