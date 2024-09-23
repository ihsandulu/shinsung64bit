<div class="row">
  <div class="col-md-4 col-xs-12">
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
  </div>
  
  <div class="col-md-4 col-xs-12">
    <div align="center"><strong>MATERIAL</strong></div>
    <hr/>
  </div>
  
  <div class="col-md-4 col-xs-12">
    <div align="center"><strong>PRODUKSI </strong></div>
    <hr/>
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
$('#open_grafik_ppm').load('<?php echo base_url().'Home/jumlah_order_perbuyer_tahun'?>/<?php echo date('Y-m-d'); ?>/Y');
$('#open_grafik_ppm2').load('<?php echo base_url().'Home/jumlah_order_perbuyer_bulan'?>/<?php echo date('Y-m-d'); ?>/Y');
$('#open_grafik_avg').load('<?php echo base_url().'Home/avg_defect'?>');
$('#open_jumlah_pegawai').load('<?php echo base_url().'Home/jml_pegawai'?>');
$('#open_grafik_status_mesin').load('<?php echo base_url().'Home/status_mesin'?>');
</script>