
<div class="row">
  <div id="detail_grafik_defect">
    <div class="col-md-12 col-xs-12">
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


  <div id="detail_pegawai_aktif">
    <div class="col-md-12 col-xs-12">
      <div id="page_detail_pegawai"></div>
      <script language="javascript">
        $('#page_detail_pegawai').load('<?php echo base_url().'Home/detail_pegawai'?>');
        </script> 
    </div>
  </div>

  
  <div id="detail_grafik_open">
  <div class="col-md-4 col-xs-12" style="border-right:1px solid #999; border-bottom:1px solid #999;">
    <div id="open_grafik_ppm"></div>
  </div>
  <div class="col-md-4 col-xs-12" style="border-right:1px solid #999; border-bottom:1px solid #999;">
    <div id="open_grafik_ppm2"></div>
  </div>
  <div class="col-md-4 col-xs-12" style="border-right:0px solid #999; border-bottom:1px solid #999;">
    <div id="open_grafik_avg"></div>
  </div>
  <script language="javascript">
		$('#open_grafik_ppm').load('<?php echo base_url().'Home/jumlah_order_perbuyer_tahun'?>/<?php echo date('Y-m-d'); ?>/Y');
		$('#open_grafik_ppm2').load('<?php echo base_url().'Home/jumlah_order_perbuyer_bulan'?>/<?php echo date('Y-m-d'); ?>/Y');
		$('#open_grafik_avg').load('<?php echo base_url().'Home/avg_defect'?>');
    </script>
    
  <div class="col-md-12 col-xs-12"></div>
  <div class="col-md-4 col-xs-12" style="border-right:1px solid #999;">
    <div id="open_grafik_status_mesin"></div>
  </div>
  <div class="col-md-4 col-xs-12" style="border-right:1px solid #999;">
    <div id="open_jumlah_pegawai"></div>
  </div>
  
  
  <div class="col-md-4 col-xs-12" style="border-right:0px solid #999;">
    <div id="open_top_5"></div>
  </div>
  <script language="javascript">
        $('#open_top_5').load('<?php echo base_url().'Welcome/list_report_dasbord_top5'?>');
        </script> 
      <script language="javascript">
        $(document).ready(function(){
              setInterval(function(){
                $('#open_top_5').load('<?php  echo base_url().'Welcome/list_report_dasbord_top5'?>');
              },30000); });
        </script> 
  
  <!--
  <div class="col-md-4 col-xs-12" style="border-right:0px solid #999; border-bottom:0px solid #999;">
    <div id="open_grafik_ppm_new"></div>
  </div>
  <script language="javascript">
		$('#open_grafik_ppm_new').load('<?php echo base_url().'Home/jumlah_order_perbuyer_tahun_new'?>/<?php echo date('Y-m-d'); ?>/Y');
  </script>
 -->
 
<div class="col-md-12 col-xs-12" style="border-right:0px solid #999; border-bottom:0px solid #999;">
    <div id="open_grafik_detail_pegawai"></div>
</div>

<script language="javascript">
$("#detail_grafik_defect").hide();
$("#detail_pegawai_aktif").hide();

function detail_grafik_defect_rate() {
	$("#detail_grafik_defect").show()
	$("#detail_grafik_open").hide();
	$("#detail_pegawai_aktif").hide();
}




function kembali() {
	$("#detail_grafik_defect").hide()
	$("#detail_grafik_open").show();
	$("#detail_pegawai_aktif").hide();
}


function detail_pegawai_aktif() {
	$("#detail_grafik_defect").hide()
	$("#detail_grafik_open").hide();
	$("#detail_pegawai_aktif").show();
}

function kembali2() {
	$("#detail_grafik_defect").hide()
	$("#detail_grafik_open").show();
	$("#detail_pegawai_aktif").hide();
}



$('#open_jumlah_pegawai').load('<?php echo base_url().'Home/jml_pegawai'?>');
//$('#open_grafik_detail_pegawai').load('<?php echo base_url().'Home/grafik_detail_pegawai'?>');
$('#open_grafik_status_mesin').load('<?php echo base_url().'Home/status_mesin'?>');

</script> 

</div>
