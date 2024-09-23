<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url() ?>assets/img/logo_.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() ?>assets/img/logo_.png">
  <title><?php echo lang('login_heading');?></title>
  <?php $this->load->view('includes/assets'); ?>
</head>
<body class="hold-transition login-page">
  <div class="login-box">
     <div class="login-logo">
      <a href="#"><b>QMS</b></a><br/><DIV STYLE="font-size: 20px;">(QUALITY MANAGEMENT SYSTEM)</div>
    </div>

  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">LOGIN USING REGISTERED NIK / EMAIL</p>
    <div id="infoMessage"><?php echo $message;?></div>
    <?php echo form_open("auth/login");?>
      <div class="form-group has-feedback">
        <?php echo form_input($identity);?>
      </div>
      <div class="form-group has-feedback">
        <?php echo form_input($password);?>
      </div>
      <!-- <div class="form-group has-feedback">
        <input type="checkbox" name="baru" value="OK"/>
      </div> -->
      <input type="hidden" name="baru" value="OK"/>
      <div class="row">
      
        <!-- /.col -->
        <div class="col-xs-12">
          <?php echo form_submit('submit', lang('login_submit_btn'), 'class="btn btn-primary btn-block"');?>
        </div>
        <!-- /.col -->
      </div>
    <?php echo form_close();?>

   
    <br>
    <p><a href="forgot_password"><?php echo lang('login_forgot_password');?></a></p>
    <br>
    <div class="text-center text-muted">&copy; <?php echo date('Y') ?> - PT SGI IT Dept </div>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
  
 


</body>
</html>

