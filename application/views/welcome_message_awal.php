
<div class="row">

  <div id="detail_grafik_defect">
      <div class="col-md-8 col-xs-12">
        <div id="page_open_grafik"></div>
        <script language="javascript">
        $('#page_open_grafik').load('<?php echo base_url().'Welcome/list_report_dasbord'?>');
        </script> 
        <script language="javascript">
        $(document).ready(function(){
              setInterval(function(){
                $('#page_open_grafik').load('<?php  echo base_url().'Welcome/list_report_dasbord'?>');
              },30000); });
        </script> 
      </div>
  </div>
  
  <div id="detail_grafik_muncul">
  <div class="col-md-4 col-sm-12 col-xs-12">
    <div style="border:0px solid #999;">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">ORDER BY YEAR</a></li>
          <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">ORDER BY MONTH</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="tab_1">
            <div id="open_grafik_ppm"></div>
          </div>
          <div class="tab-pane" id="tab_2">
            <div id="open_grafik_ppm2"></div>
          </div>
        </div>
      </div>
      <script>
		$('#open_grafik_ppm').load('<?php echo base_url().'Home/jumlah_order_perbuyer_tahun'?>/<?php echo date('Y-m-d'); ?>/Y');
		$('#open_grafik_ppm2').load('<?php echo base_url().'Home/jumlah_order_perbuyer_bulan'?>/<?php echo date('Y-m-d'); ?>/Y');
    </script> 
    </div>
  </div>
  

  
  
    <div class="col-md-12 col-xs-12"></div>
  <div class="col-md-4 col-xs-12">
    <div id="open_grafik_avg"></div>
  </div>
  
  <div class="col-md-4 col-xs-12">
    <div id="open_grafik_status_mesin"></div>
  </div>
  
  
  <div class="col-md-4 col-xs-12">
	<div id="open_jumlah_pegawai"></div>
  </div>
  
  
</div>


  <script language="javascript">

$('#open_grafik_avg').load('<?php echo base_url().'Home/avg_defect'?>');
$('#open_jumlah_pegawai').load('<?php echo base_url().'Home/jml_pegawai'?>');
$('#open_grafik_status_mesin').load('<?php echo base_url().'Home/status_mesin'?>');


    $('#page_open').load('<?php echo base_url().'Qa_end_line_dashboard/list_report_dasbord'?>');
    </script> 
  <script language="javascript">
    $(document).ready(function(){
          setInterval(function(){
            $('#page_open').load('<?php  echo base_url().'Qa_end_line_dashboard/list_report_dasbord'?>');
          },30000); });	  
    </script> 
</div>
<div class="col-md-8 col-sm-12 col-xs-12">
  <p>&nbsp;</p>
  <div id="page_open_lost_time"></div>
  <!--
<script language="javascript">
    $('#page_open_lost_time').load('<?php echo base_url().'Welcome/lost_time'?>');
    </script>
--> 
  <!--
	<script language="javascript">
    $(document).ready(function(){
          setInterval(function(){
            $('#page_open_lost_time').load('<?php  echo base_url().'Welcome/lost_time'?>');
          },10000); });	  
    </script>
    --> 
</div>
