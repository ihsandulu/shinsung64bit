<?php 
$this->db->where('id', $this->session->userdata('user_id'));
$query = $this->db->get('users');
if ($query->num_rows() <= 0) {
  redirect('/auth/login','refresh');
}

$user = $query->row();
?>


<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url() ?>assets/img/logo_.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() ?>assets/img/logo_.png">
  <title><?php echo $pagetitle ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php $this->load->view('includes/assets'); ?>
  <script type="text/javascript">
    var baseUrl = '<?php echo base_url() ?>';
  </script>
  </head>
  <?php
/*
$m = $this->uri->segment(2);
if($m == "hasil_inspect_bags_defect_list_version1" or $m == "daftar_schedule") {
	$skin = 'sidebar-collapse';
} else {
	//$skin = 'sidebar-mini';
	$skin = 'sidebar-collapse';
}
*/
?>

<style>
.ref::before {
  font-weight: bold;
  color: white;
  font-size:18px;
  content: "SGI - SEWING QA END LINE ";
}
@media only screen and (max-width: 600px) {
	.ref::before {
	  font-weight: bold;
	  color: white;
	  font-size:18px;
	  content: "SGI ";
	}	
}

body { padding-right: 0 !important }

</style>
  <body class="hold-transition skin-blue sidebar-collapse">
<div class="wrapper">

<!-- Main Header -->
<!-- <header class="main-header"> --> 
<header class="main-header" style="background-color:purple;">  
<!--
<a href="<?php echo base_url() ?>" class="logo"> 
<span class="logo-mini"><b>SMART FACTORY</b></span> 
<span class="logo-lg"> <b>KISS</b> </span> </a> 
-->  
    <nav class="navbar navbar-static-top" role="navigation" style="background-color:purple;">
     
    
    <!-- Sidebar toggle button--> 
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"> <span class="sr-only">Toggle navigation</span> </a> 
    
    <div style="margin-top:-6px; margin-bottom:-100px;"> 
    &nbsp; <div class="ref"></div>
    
    </div>
    
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
        
        <!-- Notifications Menu -->
        <li class="dropdown notifications-menu"> 
            <!-- Menu toggle button --> 
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
            IP : <?php echo $_SERVER['REMOTE_ADDR']; ?> &nbsp;&nbsp;&nbsp;&nbsp;
            
            <i class="fa fa-bell-o"></i> <span class="label label-warning"></span> </a>
            <ul class="dropdown-menu">
            <li class="header">You have 10 notifications</li>
            <li> 
                <!-- Inner Menu: contains the notifications -->
                <ul class="menu">
                <li><!-- start notification --> 
                    <a href="#"> <i class="fa fa-users text-aqua"></i> 5 new members joined today </a> </li>
                <!-- end notification -->
              </ul>
              </li>
            <li class="footer"><a href="#">View all</a></li>
          </ul>
          </li>
        
        <!-- User Account Menu -->
        <li class="dropdown user user-menu"> 
            <!-- Menu Toggle Button --> 
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
          <!-- The user image in the navbar--> 
          <span style="color: white;"><i class="fa fa-user"></i></span>&nbsp; 
          <!-- <img src="<?php echo base_url('assets/img/user2-160x160.jpg') ?>" class="user-image" alt="User Image"> --> 
          <!-- hidden-xs hides the username on small devices so only the image appears. --> 
          <span class="hidden-xs"><?php //echo $user->first_name ?> <?php echo $user->last_name; ?> </span> </a>
            <ul class="dropdown-menu">
            <!-- The user image in the menu -->
            <li class="user-header"> <span style="font-size: 60px;color: white;"><i class="fa fa-user-circle-o" aria-hidden="true"></i></span>
                <p> <?php //echo $user->first_name ?> <?php echo $user->last_name; ?> <small><?php echo $user->company ?></small> </p>
              </li>

            <!-- Menu Footer-->
            <li class="user-footer">
                <div class="pull-left"> <a href="<?php echo base_url().'auth/edit_user/'. $this->session->userdata('user_id') ?>" class="btn btn-default btn-flat"><i class="fa fa-cogs" aria-hidden="true"></i> Settings</a> </div>
                <div class="pull-right"> <a href="<?php echo base_url('auth/logout') ?>" class="btn btn-default btn-flat"><i class="fa fa-sign-out" aria-hidden="true"></i> Sign out</a> </div>
              </li>
          </ul>
          </li>
      </ul>
      </div>
  </nav>
  </header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar"> 
    
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
    <?php 
        $slugName = $this->uri->segment(1) . '/' . $this->uri->segment(2);
      ?>
    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAINMENU </li>
        <!-- Optionally, you can add icons to the links -->
        <li <?php  echo ($this->uri->segment(1) == NULL) ? 'class="active"' : '' ?>><a href="<?php echo base_url() ?>"><i class="fa fa-list-alt"></i> <span>HOME</span></a></li>

        
        <?php if ($this->ion_auth->is_admin()) : ?>
        <li <?php  echo ($this->uri->segment(1) == 'auth') ? 'class="active"' : '' ?>><a href="<?php echo base_url('auth') ?>"><i class="fa fa-list-alt" aria-hidden="true"></i> <span>MANAGE USERS</span></a></li>
        <?php endif; ?>
        <?php  
          $group = array('PPIC');
          if ($this->ion_auth->in_group($group)) :
        ?>
        <li class="treeview"> <a href="#"><i class="fa fa-list-alt" aria-hidden="true"></i> <span> PPIC </span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
        <ul class="treeview-menu">
            <li <?php  echo ($slugName == 'Schedule_produksi') ? 'class="active"' : '' ?>><a href="<?php echo base_url('Schedule_produksi') ?>"><i class="fa fa-calendar" aria-hidden="true"></i> CREATE SCHEDULE </a></li>
            
            <li <?php  echo ($slugName == 'Qa_end_line_dashboard') ? 'class="active"' : '' ?>><a href="<?php echo base_url('Qa_end_line_dashboard') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> DASHBOARD</a></li>
            <li <?php  echo ($slugName == 'Qa_end_line_dashboard2') ? 'class="active"' : '' ?>><a href="<?php echo base_url('Qa_end_line_dashboard2') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> MONITORING DETAIL</a></li>
            <li <?php  echo ($slugName == 'Report_end_line/Report_summary_defect') ? 'class="active"' : '' ?>><a href="<?php echo base_url('Report_end_line/Report_summary_defect') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> REPORT SUMMARY DEFECT</a></li>
            
            
          </ul>
      </li>
        <?php endif; ?>
        <?php  
          $group = array('admin');
          if ($this->ion_auth->in_group($group)) :
        ?>
        <li class="treeview"> <a href="#"><i class="fa fa-list-alt" aria-hidden="true"></i> <span> MASTER DATA </span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
        <ul class="treeview-menu">
            <li <?php  echo ($slugName == 'Daftar_defect') ? 'class="active"' : '' ?>><a href="<?php echo base_url('Daftar_defect') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> DEFECT LIST</a></li>
            
            <!--     <li <?php  echo ($slugName == 'Daftar_images') ? 'class="active"' : '' ?>><a href="<?php echo base_url('Daftar_images/Index') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> DAFTAR IMAGES</a></li> -->
            
          </ul>
      </li>
        <?php endif; ?>        
         
         
         
          <?php  
          $group = array('QC');
          if ($this->ion_auth->in_group($group)) :
        ?>
        
        <li class="treeview"> <a href="#"><i class="fa fa-list-alt" aria-hidden="true"></i> <span> QC </span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
        <ul class="treeview-menu">
        <li <?php  echo ($slugName == 'Qa_end_line_dashboard') ? 'class="active"' : '' ?>><a href="<?php echo base_url('Qa_end_line_dashboard') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> DASHBOARD</a></li>
        
            <li <?php  echo ($slugName == 'Daftar_defect/list_defect') ? 'class="active"' : '' ?>><a href="<?php echo base_url('Daftar_defect/list_defect') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> DEFECT LIST </a></li>
            <li <?php  echo ($slugName == 'Qa_end_line') ? 'class="active"' : '' ?>><a href="<?php echo base_url('Qa_end_line') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> PRODUCTION INPUT </a></li>
            
            <li <?php  echo ($slugName == 'Hasil_inputan/EditOutputQC') ? 'class="active"' : '' ?>><a href="<?php echo base_url('Hasil_inputan/EditOutputQC') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> QC RESULTS </a></li>
            
            <li <?php  echo ($slugName == 'Hasil_inputan/EditOutputIroning') ? 'class="active"' : '' ?>><a href="<?php echo base_url('Hasil_inputan/EditOutputIroning') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> IRONING RESULTS </a></li>
            
            <li <?php  echo ($slugName == 'Hasil_inputan/EditOutputPacking') ? 'class="active"' : '' ?>><a href="<?php echo base_url('Hasil_inputan/EditOutputPacking') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> PACKING RESULTS </a></li>
            
            <li <?php  echo ($slugName == 'Qa_end_line_dashboard2') ? 'class="active"' : '' ?>><a href="<?php echo base_url('Qa_end_line_dashboard2') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> MONITORING DETAIL</a></li>
            <li <?php  echo ($slugName == 'Report_end_line/Report_summary_defect') ? 'class="active"' : '' ?>><a href="<?php echo base_url('Report_end_line/Report_summary_defect') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> DEFECT REPORT SUMMARY</a></li>
            
            <li <?php  echo ($slugName == 'Report_end_line/Report_hasil_produksi') ? 'class="active"' : '' ?>><a href="<?php echo base_url('Report_end_line/Report_hasil_produksi') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> PRODUCTION RESULTS REPORT</a></li> 

            <li <?php  echo ($slugName == 'Report_end_line/Report_fml') ? 'class="active"' : '' ?>><a href="<?php echo base_url('Report_end_line/Report_fml') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> FML REPORT</a></li>  
          </ul>
      </li>
         <?php endif; ?>


         
                  
        <?php  
          $group = array('QC');
          if ($this->ion_auth->in_group($group)) :
        ?>
      
        <li class="treeview"> <a href="#"><i class="fa fa-list-alt" aria-hidden="true"></i> <span>CHART</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
        <ul class="treeview-menu">
            <li <?php  echo ($slugName == 'grafik/report_defectrate') ? 'class="active"' : '' ?>><a href="<?php echo base_url('grafik/report_defectrate') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> DEFECT RATE </a></li>
            <li <?php  echo ($slugName == 'grafik/report_weekly_top_5_per_line') ? 'class="active"' : '' ?>><a href="<?php echo base_url('grafik/report_weekly_top_5_per_line') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> TOP 5 DEFECT </a></li>
            <!--
              <li <?php  echo ($slugName == 'grafik/report_weekly_top_5_per_line') ? 'class="active"' : '' ?>><a href="<?php echo base_url('grafik/report_weekly_top_5_per_line') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> TOP 5 WEEKLY </a></li>
              
              <li <?php  echo ($slugName == 'grafik/report_monthly_top_5_per_line') ? 'class="active"' : '' ?>><a href="<?php echo base_url('grafik/report_monthly_top_5_per_line') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> TOP 5 MONTHLY </a></li>
              
 -->
          </ul>
      </li>
        <?php endif; ?>
         






<?php  
          $group = array('DASHBOARD_ONLY');
          if ($this->ion_auth->in_group($group)) :
        ?>
      
        <li class="treeview"> <a href="#"><i class="fa fa-list-alt" aria-hidden="true"></i> <span> REPORT ONLY </span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
        <ul class="treeview-menu">
        <li <?php  echo ($slugName == 'Qa_end_line_dashboard') ? 'class="active"' : '' ?>><a href="<?php echo base_url('Qa_end_line_dashboard') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> DASHBOARD</a></li>
        
            <li <?php  echo ($slugName == 'Daftar_defect/list_defect') ? 'class="active"' : '' ?>><a href="<?php echo base_url('Daftar_defect/list_defect') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> DEFECT LIST </a></li>
            <li <?php  echo ($slugName == 'Qa_end_line_dashboard2') ? 'class="active"' : '' ?>><a href="<?php echo base_url('Qa_end_line_dashboard2') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> MONITORING DETAIL</a></li>
            <li <?php  echo ($slugName == 'Report_end_line/Report_summary_defect') ? 'class="active"' : '' ?>><a href="<?php echo base_url('Report_end_line/Report_summary_defect') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> REPORT SUMMARY DEFECT</a></li>
          </ul>
      </li>
        <?php endif; ?>
        
        
        
                
        <!-- <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Link in level 2</a></li>
            <li><a href="#">Link in level 2</a></li>
          </ul>
        </li> -->
      </ul>
    <!-- /.sidebar-menu --> 
  </section>
    <!-- /.sidebar --> 
  </aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Main content -->
<section class="content container-fluid">
<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header with-border">
    <h3 class="box-title"><strong><?php echo $pagetitle ?></strong></h3>
  </div>
<!-- /.box-header -->
<div class="box-body">
