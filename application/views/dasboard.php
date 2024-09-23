  <style>
.highcharts-figure,
.highcharts-data-table table {
    min-width: 100%;
    max-width: 100%;
    margin: 1em auto;
}

#container {
    height: 400px;
	
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

</style>

<div class="row">
<div class="col-md-12 col-xs-12" align="center"><strong>DASBOARD QUALITY CONTROL </strong> <hr/></div>

  <div class="col-md-12 col-xs-12">
  <div id="page_open_line"></div>
  
  </div>
  <script language="javascript">
    $('#page_open_line').load('<?php echo base_url().'Qa_end_line_dashboard/list_report_dasbord_all'?>');
    </script>
    
    <script language="javascript">
    $(document).ready(function(){
          setInterval(function(){
            $('#page_open_line').load('<?php  echo base_url().'Qa_end_line_dashboard/list_report_dasbord_all'?>');
          },10000); });	  
    </script>
    
    
    

  <div class="col-md-8 col-xs-12">
  <div id="page_open_grafik"></div>
  
  </div>
  <script language="javascript">
    $('#page_open_grafik').load('<?php echo base_url().'Dasboard/list_report_dasbord'?>');
    </script>
    
    <script language="javascript">
    $(document).ready(function(){
          setInterval(function(){
            $('#page_open_grafik').load('<?php  echo base_url().'Dasboard/list_report_dasbord'?>');
          },10000); });	  
    </script>
    
    
  
  <div class="col-md-4 col-xs-12">
    <div style="border:0px solid #999; padding:10px;">
      <div align="center"><strong>DEFECT RATE LEBIH DARI 50%</strong></div>
      <hr/>
      <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12" id="page_open"></div>
      </div>
    </div>
  </div>
	<script language="javascript">
    $('#page_open').load('<?php echo base_url().'Qa_end_line_dashboard/list_report_dasbord'?>');
    </script>
    
    <script language="javascript">
    $(document).ready(function(){
          setInterval(function(){
            $('#page_open').load('<?php  echo base_url().'Qa_end_line_dashboard/list_report_dasbord'?>');
          },10000); });	  
    </script>



<div class="col-md-8 col-sm-12 col-xs-12">
<p>&nbsp;</p>

<div id="page_open_lost_time"></div>
</div>


<div class="col-md-4 col-sm-12 col-xs-12">
<p>&nbsp;</p>

<div align="center"><strong>F M L </strong> <hr/>
<div id="page_open_fml"></div>
</div>
</div>

<script language="javascript">
    $('#page_open_fml').load('<?php echo base_url().'Dasboard/fml'?>');
</script>
    
<script language="javascript">
	$(document).ready(function(){
         setInterval(function(){
           $('#page_open_fml').load('<?php  echo base_url().'Dasboard/fml'?>');
         },10000); });	  
</script>

<script language="javascript">
    $('#page_open_lost_time').load('<?php echo base_url().'Dasboard/lost_time'?>');
</script>
    
<script language="javascript">
	$(document).ready(function(){
         setInterval(function(){
           $('#page_open_lost_time').load('<?php  echo base_url().'Dasboard/lost_time'?>');
         },10000); });	  
</script>
    



<div class="col-md-12 col-xs-12" align="center"><strong> <hr/>DASBOARD MEKANIK <br/><br/></strong> </div>


  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box" style="background-color:#EFEDEE;"> <span class="info-box-icon bg-aqua"><i class="fa fa-database"></i></span>
      <div class="info-box-content"> <span class="info-box-text"><strong>QUANTITY MESIN REGISTER</strong></span> <span class="info-box-number">7.125</span> </div>
      <div align="right"  style="padding-right:20px;">VIEW DETAIL </div>
    </div>
  </div>
  
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box" style="background-color:#EFEDEE;"> <span class="info-box-icon bg-red"><i class="fa  fa-bar-chart"></i></span>
      <div class="info-box-content"> <span class="info-box-text"><strong>MESIN STOK OPNAME </strong></span> <span class="info-box-number">7.100</span> </div>
      <div align="right"  style="padding-right:20px;">VIEW DETAIL </div>
    </div>
  </div>
  
  
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box" style="background-color:#EFEDEE;"> <span class="info-box-icon bg-blue"><i class="fa fa-folder-open"></i></span>
      <div class="info-box-content"> <span class="info-box-text"><strong>MESIN TERPAKAI</strong></span> <span class="info-box-number">6.210</span> </div>
      <div align="right"  style="padding-right:20px;">VIEW DETAIL </div>
    </div>
  </div>
  
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box" style="background-color:#EFEDEE;"> <span class="info-box-icon bg-green"><i class="fa fa-folder-open-o"></i></span>
      <div class="info-box-content"> <span class="info-box-text"><strong>MESIN READY</strong></span> <span class="info-box-number">900</span> </div>
      <div align="right"  style="padding-right:20px;">VIEW DETAIL </div>
    </div>
  </div>
  
  
  
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box" style="background-color:#EFEDEE;"> <span class="info-box-icon bg-yellow"><i class="fa  fa-arrow-circle-o-up"></i></span>
      <div class="info-box-content"> <span class="info-box-text"><strong>MESIN DIPINJANKAN </strong></span> <span class="info-box-number">250</span> </div>
      <div align="right"  style="padding-right:20px;">VIEW DETAIL </div>
    </div>
  </div>
  
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box" style="background-color:#EFEDEE;"> <span class="info-box-icon bg-purple"><i class="fa fa-arrow-circle-o-down"></i></span>
      <div class="info-box-content"> <span class="info-box-text"><strong>MESIN PINJAMAN </strong></span> <span class="info-box-number">97</span> </div>
      <div align="right"  style="padding-right:20px;">VIEW DETAIL </div>
    </div>
  </div>
  
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box" style="background-color:#EFEDEE;"> <span class="info-box-icon bg-black"><i class="fa fa-gears"></i></span>
      <div class="info-box-content"> <span class="info-box-text"><strong>MESIN REPARASI </strong></span> <span class="info-box-number">97</span> </div>
      <div align="right"  style="padding-right:20px;">VIEW DETAIL </div>
    </div>
  </div>
  
  
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box" style="background-color:#EFEDEE;"> <span class="info-box-icon bg-black"><i class="fa fa-trash"></i></span>
      <div class="info-box-content"> <span class="info-box-text"><strong>MESIN RUSAK </strong></span> <span class="info-box-number">51</span> </div>
      <div align="right"  style="padding-right:20px;">VIEW DETAIL </div>
    </div>
  </div>
  
<div class="col-md-8 col-xs-12" align="center"><strong> <hr/> QCO PLAN </strong>
<div style="min-height:200px;"> </div>
</div>
<div class="col-md-4 col-xs-12" align="center"><strong> <hr/> MUTASI MESIN HARIAN</strong>
<div style="min-height:200px;"> </div>
</div>




<div class="col-md-12 col-xs-12" align="center"><strong> <hr/>DASBOARD PPIC <br/><br/></strong> </div>

<div class="col-md-12 col-xs-12" align="center"><strong> <hr/> SCHEDULE PRODUKSI </strong>
<div style="min-height:200px;"> </div>
</div>
<div class="col-md-12 col-xs-12" align="center"><strong> <hr/> HASIL PRODUKSI </strong>
<div style="min-height:200px;">


</div>
</div>




<div class="col-md-12 col-xs-12" align="center"><strong> <hr/>DASBOARD FINISH GOOD<br/></strong> </div>

<div class="col-md-6 col-xs-12" align="center"><strong> <hr/> SCHEDULE EXPORT </strong>
<div style="min-height:200px;"> </div>
</div>
<div class="col-md-6 col-xs-12" align="center"><strong> <hr/> UNCOMPLETE </strong>
<div style="min-height:200px;"> 
  <table class="table">
    <tr>
      <td width="12%"><div align="center"><strong>KJ</strong></div></td>
      <td width="11%"><div align="center"><strong>STYLE</strong></div></td>
      <td width="16%"><div align="center"><strong>COLOR</strong></div></td>
      <td width="26%"><div align="center"><strong>DES</strong></div></td>
      <td width="13%"><div align="center"><strong>QTY ORDER</strong></div></td>
      <td width="14%"><div align="center"><strong>QTY UNCOMPLETE</strong></div></td>
      <td width="8%"><div align="center"><strong>#</strong></div></td>
    </tr>
    <tr>
      <td>1</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>2</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>3</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    </table>
</div>
</div>


<!-- end -->
</div>
