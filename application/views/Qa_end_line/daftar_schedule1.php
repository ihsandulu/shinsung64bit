<style>
      /* Gaya untuk button */
       .btn-custom {
        margin: 1px;
        width: 35px;
        height: 35px;
        font-size: 14px;
        font-weight: bold;
        border-radius: 12%;
        text-align: center;
        line-height: 1.5;
        /* Mengatur warna background secara acak */
        background-color: <?php echo sprintf("#%06x",rand(0,16777215)); ?>;
        color: white;
      }
      /* Mengatur tampilan button pada layar kecil */
    </style>

<div class="row">
<div class="col-md-12">
<div align="right" style="color:#FF0000; margin-top:-40px; margin-bottom:20px; font-size:16px;"> <B> <u>IF THERE IS A SCHEDULE THAT IS NOT ON THE LIST, PLEASE CONTACT PPIC SCHEDULE </u></B></div>
  <?php
  if(count($schedule)>0)
  {

   $html = '<div style="overflow-x:auto;"><table class="table" width="100%;">';
  
  // Membuat header tabel dari kunci array pertama
  $arrblok=["QTY_ORDER","FOB","GAC","QTY_PLAN","DES","tampilkan_target"];
  $html .= '<thead><tr>';
  foreach (array_keys($schedule[0]) as $header) {
    if($header == "ID") {
        $html .= '<th width="70" align="center"> CEK IN </th>';
        $html .= '<th width="70" align="center"> CEK OUT </th>';
        /* $html .= '<th width="70" align="center"> IRON</th>';
        $html .= '<th width="70" align="center"> PACKING </th>'; */
        $html .= '<th width="70" align="center"> F M L  </th>';
    }/*  else if($header == "tampilkan_target") {
		    $html .= '<th> TARGET </th>';
      } */ else if($header == "KANAAN_PO") {
		    $html .= '<th> FILE NO </th>';
	  } else if(!in_array($header, $arrblok)) {
        $html .= '<th>' . $header . '</th>';  
    }
    
  }
  

  
  $html .= '</tr></thead>';
  
  // Membuat isi tabel dari data array
  $html .= '<tbody>';
  foreach ($schedule as $row) {
    $html .= '<tr>';
    $col = 0 ; 
    foreach ($row as $cc=>$cell) {
      // $html .= '<td>' . $cell . '</td>';
      
	   if($col == 0) {
       //$html .= '' . $cell . '</td>';  

	   $html .= '<td><a href="'. base_url().'Qa_end_line/hasil_inspect_bags_defect_list_version21/' . $line . '/' . $cell . '"><button type="button" class="btn btn-danger btn-md"> <i class="fa fa-sign-in"></i> </button></a></td>'; 
	   
	    $html .= '<td><a href="'. base_url().'Qa_end_line/hasil_inspect_bags_defect_list_version11/' . $line . '/' . $cell . '"><button type="button" class="btn btn-warning btn-md"> <i class="fa fa-sign-in"></i> </button></a></td>'; 
		
		/* $html .= '<td><a href="'. base_url().'Qa_end_line/hasil_inspect_bags_defect_list_version3/' . $line . '/' . $cell . '"><button type="button" class="btn btn-success btn-md"> <i class="fa fa-plug"></i> </button></a></td>'; 
	   
	   $html .= '<td><a href="'. base_url().'Qa_end_line/hasil_inspect_bags_defect_list_version4/' . $line . '/' . $cell . '"><button type="button" class="btn btn-primary btn-md"> <i class="fa fa-dropbox"></i> </button></a></td>';  */
	   
	  $html .= '<td><a href="'. base_url().'Qa_end_line/upload_style_img/' . $line . '/' . $cell . '"><button type="button" class="btn btn-info btn-md"> <i class="fa fa-file-image-o"> </i> </button></a></td>'; 
	   
		      
	  }/* elseif($col==1)
    {
        // $html .= '<td> <font size=8>' . strtoupper($cell) . '</font></td>';
       $html .= '<td style="font-size:25px">  ' . strtoupper($cell) . '</td>';
    } */else if(!in_array($cc, $arrblok)){
    $html .= '<td>' . strtoupper($cell) . '</td>';

    }
      $col++ ; 
	
	
    }
	 
    $html .= '</tr>';
  }
  $html .= '</tbody>';
  
  $html  .= '</table></div>  ';

  echo $html ;

  $html = '<div style="overflow-x:auto;"> <B> IF THERE IS A SCHEDULE THAT IS NOT ON THE LIST, PLEASE CONTACT PPIC SCHEDULE </B></div>';
   echo $html ;

}else{
  echo "<H1> SCHEDULE LINE KOSONG <BR>
  HUBUNGI PPIC SCHEDULE </H1>";
}
?>
</div>
</div>

