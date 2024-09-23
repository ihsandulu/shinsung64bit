<?php
$this->db->where('id', $this->session->userdata('user_id'));
$query = $this->db->get('users');
if ($query->num_rows() <= 0) {
    redirect('/auth/login', 'refresh');
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
        font-size: 18px;
        content: "QMS (Quality Management System)";
    }

    @media only screen and (max-width: 600px) {
        .ref::before {
            font-weight: bold;
            color: white;
            font-size: 18px;
            content: "SGI ";
        }
    }

    body {
        padding-right: 0 !important
    }

    .toast {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        min-width: 200px;
        max-width: 300px;
        background-color: bisque;
        color: black;
        padding: 15px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        display: none;
        z-index: 1050;
    }

    #loading {
        position: fixed;
        left: 50%;
        top: 50%;
        color: red;
        z-index: 1000;
        display: none;
    }
</style>

<body class="hold-transition skin-blue sidebar-collapse">
    <div id="test"></div>
    <div class="wrapper">
        <header class="main-header" style="background-color:purple;">
            <nav class="navbar navbar-static-top" role="navigation" style="background-color:purple;">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"> <span class="sr-only">Toggle navigation</span> </a>
                <div style="margin-top:-6px; margin-bottom:-100px;">
                    &nbsp; <div class="ref"></div>
                </div>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                IP : <?php echo $_SERVER['REMOTE_ADDR']; ?> &nbsp;&nbsp;&nbsp;&nbsp;
                                <i class="fa fa-bell-o"></i> <span class="label label-warning"></span> </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 10 notifications</li>
                                <li>
                                    <ul class="menu">
                                        <li>
                                            <a href="#"> <i class="fa fa-users text-aqua"></i> 5 new members joined today </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">View all</a></li>
                            </ul>
                        </li>
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span style="color: white;"><i class="fa fa-user"></i></span>&nbsp;
                                <span class="hidden-xs">
                                    <?php //echo $user->first_name;
                                    ?> <?php echo $user->last_name; ?>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header"> <span style="font-size: 60px;color: white;"><i class="fa fa-user-circle-o" aria-hidden="true"></i></span>
                                    <p>
                                        <?php //echo $user->first_name;
                                        ?> <?php echo $user->last_name; ?> <small><?php echo $user->company ?></small>
                                    </p>
                                </li>

                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left"> <a href="<?php echo base_url() . 'auth/edit_user/' . $this->session->userdata('user_id') ?>" class="btn btn-default btn-flat"><i class="fa fa-cogs" aria-hidden="true"></i> Settings</a> </div>
                                    <div class="pull-right"> <a href="<?php echo base_url('auth/logout') ?>" class="btn btn-default btn-flat"><i class="fa fa-sign-out" aria-hidden="true"></i> Sign out</a> </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="main-sidebar">
            <section class="sidebar">
                <?php
                $slugName = $this->uri->segment(1) . '/' . $this->uri->segment(2);
                ?>
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MAINMENU </li>
                    <li <?php echo ($this->uri->segment(1) == NULL) ? 'class="active"' : '' ?>><a href="<?php echo base_url() ?>"><i class="fa fa-list-alt"></i> <span>HOME</span></a></li>
                    <?php
                    $group = array('PPIC');
                    if ($this->ion_auth->in_group($group)) :
                    ?>
                        <li class="treeview"> <a href="#"><i class="fa fa-list-alt" aria-hidden="true"></i> <span> PRODUCTION </span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
                            <ul class="treeview-menu">
                                <li <?php echo ($slugName == 'Qa_end_line_dashboardb') ? 'class="active"' : '' ?>><a href="<?php echo base_url('Qa_end_line_dashboardb') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> LINE MONITORING</a></li>
                                <li class="treeview"> <a href="#"><i class="fa fa-list-alt" aria-hidden="true"></i> <span> PRODUCTION RESULT </span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
                                    <ul class="treeview-menu">
                                        <li class="treeview"> <a href="#"><i class="fa fa-list-alt" aria-hidden="true"></i> <span> SEWING </span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
                                            <ul class="treeview-menu">
                                                <li <?php echo ($slugName == 'Report_end_line/Production_result_sewingstyle') ? 'class="active"' : '' ?>><a href="<?php echo base_url('Report_end_line/Production_result_sewingstyle') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> BY STYLE</a></li>
                                                <li <?php echo ($slugName == 'Report_end_line/Production_result_sewingtime') ? 'class="active"' : '' ?>><a href="<?php echo base_url('Report_end_line/Production_result_sewingtime') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> BY TIME</a></li>
                                            </ul>
                                        </li>
                                        <li <?php echo ($slugName == 'Report_end_line/Production_result_iron') ? 'class="active"' : '' ?>><a href="<?php echo base_url('Report_end_line/Production_result_iron') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> IRON</a></li>
                                        <li <?php echo ($slugName == 'Report_end_line/Production_result_hangtag') ? 'class="active"' : '' ?>><a href="<?php echo base_url('Report_end_line/Production_result_hangtag') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> HANGTAG</a></li>
                                        <li <?php echo ($slugName == 'Report_end_line/Production_result_packing') ? 'class="active"' : '' ?>><a href="<?php echo base_url('Report_end_line/Production_result_packing') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> PACKING</a></li>
                                    </ul>
                                </li>
                                <li <?php echo ($slugName == 'Report_end_line/Report_summary_defect1b') ? 'class="active"' : '' ?>><a href="<?php echo base_url('Schedule_produksi/indexb') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> PRODUCTION SCHEDULE</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <?php
                    $group = array('QC');
                    if ($this->ion_auth->in_group($group)) :
                    ?>
                        <li class="treeview"> <a href="#"><i class="fa fa-list-alt" aria-hidden="true"></i> <span> QUALITY CONTROL </span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
                            <ul class="treeview-menu">
                                <li <?php echo ($slugName == 'Qa_end_lineb') ? 'class="active"' : '' ?>><a href="<?php echo base_url('Qa_end_lineb') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> INPUT DEFECT </a></li>
                                <li <?php echo ($slugName == 'Report_end_line/Report_summary_defectb') ? 'class="active"' : '' ?>><a href="<?php echo base_url('Report_end_line/Report_summary_defectb') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> MONTHLY QTY </a></li>
                                <li <?php echo ($slugName == 'Report_end_line/Report_fml') ? 'class="active"' : '' ?>><a href="<?php echo base_url('Report_end_line/Report_fml') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> DEFECT PICTURE REPORT </a></li>
                                <li <?php echo ($slugName == 'Report_end_line/Report_summary_defect1b') ? 'class="active"' : '' ?>><a href="<?php echo base_url('Report_end_line/Report_summary_defect1b') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> DEFECT MONITORING</a></li>
                                <li class="treeview"> <a href="#"><i class="fa fa-list-alt" aria-hidden="true"></i> <span>CHART</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
                                    <ul class="treeview-menu">
                                        <li <?php echo ($slugName == 'grafik/report_defectrateb') ? 'class="active"' : '' ?>><a href="<?php echo base_url('grafik/report_defectrateb') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> DEFECT RATE </a></li>
                                        <li <?php echo ($slugName == 'grafik/report_weekly_top_5_per_lineb') ? 'class="active"' : '' ?>><a href="<?php echo base_url('grafik/report_weekly_top_5_per_lineb') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> TOP 5 DEFECT </a></li>
                                    </ul>
                                </li>
                                <li <?php echo ($slugName == 'Qa_end_line/weeklydefectb') ? 'class="active"' : '' ?>><a href="<?php echo base_url('Qa_end_line/weeklydefectb') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> WEEKLY DEFECT </a></li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <?php if ($this->ion_auth->is_admin()) : ?>
                        <li class="treeview"> <a href="#"><i class="fa fa-list-alt" aria-hidden="true"></i> <span> REPORT ADMIN </span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
                            <ul class="treeview-menu">

                                <li <?php echo ($slugName == 'auth') ? 'class="active"' : '' ?>><a href="<?php echo base_url('auth') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> MANAGE USER </a></li>
                                <li <?php echo ($slugName == 'Daftar_defect') ? 'class="active"' : '' ?>><a href="<?php echo base_url('Daftar_defect') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> MASTER DATA </a></li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <?php
                    $group = array('DASHBOARD_ONLY');
                    if ($this->ion_auth->in_group($group)) :
                    ?>

                        <li class="treeview"> <a href="#"><i class="fa fa-list-alt" aria-hidden="true"></i> <span> REPORT ONLY </span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
                            <ul class="treeview-menu">
                                <li <?php echo ($slugName == 'Qa_end_line_dashboardb') ? 'class="active"' : '' ?>><a href="<?php echo base_url('Qa_end_line_dashboardb') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> DASHBOARD</a></li>

                                <li <?php echo ($slugName == 'Daftar_defect/list_defect') ? 'class="active"' : '' ?>><a href="<?php echo base_url('Daftar_defect/list_defect') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> DEFECT LIST </a></li>
                                <li <?php echo ($slugName == 'Qa_end_line_dashboard2') ? 'class="active"' : '' ?>><a href="<?php echo base_url('Qa_end_line_dashboard2') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> MONITORING DETAIL</a></li>
                                <li <?php echo ($slugName == 'Report_end_line/Report_summary_defect') ? 'class="active"' : '' ?>><a href="<?php echo base_url('Report_end_line/Report_summary_defect') ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> REPORT SUMMARY DEFECT</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </section>
        </aside>

        <div class="content-wrapper">
            <section class="content container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <?php if ($pagetitle != "") { ?>
                                <div class="box-header with-border">
                                    <h3 class="box-title"><strong><?php echo $pagetitle ?></strong></h3>
                                </div>
                            <?php } ?>
                            <div class="box-body">