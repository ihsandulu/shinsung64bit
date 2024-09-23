
<div class="row">
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