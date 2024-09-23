<?php
  $buttonCount = 100; // Jumlah button yang ingin ditampilkan

    // pre($persen_defect);



    // print_r($filteredArray);

?>

<!-- <i class="fa fa-google-plus"></i> -->
<div class="row"  >
  <?php for ($i = 1; $i <= $buttonCount; $i++) { 

     $filteredArray = array_filter($persen_defect, function($item)  use ($i)  {
                return $item['line'] == $i;
     });
     $filteredchief = array_filter($chief, function($item)  use ($i)  {
                return $item['line'] == $i;
     });

     $warna = 'black';
	 $warna_tulisan = 'white';
	 $warna_bg = '';
      if (count($filteredArray)>0 )
            {
                $key = array_shift($filteredArray);


               if ($key['persen_defect'] >= 50 )
               {
                 $warna = 'red';
               }elseif ($key['persen_defect'] >= 31 )
               {
                   $warna = '#FC0';
               }elseif (($key['persen_defect'] = 0  )) {
                  $warna = 'black';
               }else
               {
                   $warna = 'green';
               }
			   
			   
			   
			   $hasil = $key['qty_hasil'] * 2;
			   if ($key['qty_checking'] < $hasil )
               {
                 $warna_tulisan = '#000000';
				 $warna_bg = '#000';
               
               }else
               {
                   $warna_tulisan = 'white';
				   $warna_bg = $warna;
               }
			   
			   
            }
    ?>
  <div class="col-md-4 col-sm-6 col-xs-12 my-div" data-toggle="modal" onclick="openModal(<?php echo $i; ?>)"  data-target="#myModal" >
    <div class="info-box" style="background-color:#ccc;"> <span class="info-box-icon" style="border:2px solid <?php echo $warna_bg; ?>; background-color:<?php echo $warna?>; color:<?php echo $warna_tulisan; ?>">  <?php echo $i; ?></span>
      <div class="info-box-content"> <!-- <span class="info-box-text"> OUTPUT / DEFECT / OK / % DEFECT </span>  -->
        <span class="info-box-number" >
          <?php   
            $filteredArray = array_filter($persen_defect, function($item)  use ($i)  {
                return $item['line'] == $i;
             });
            
			 if (count($filteredchief)>0 )
              {
                  $ch = array_shift($filteredchief);
                  echo '<div style="font-size:14px;">'.$ch['nama_supervisor'].'</div>';
              }
              else
            {
               echo '<br> ' ;
            }
			if (count($filteredArray)>0 )
            {
                $key = array_shift($filteredArray);
               // pre($key);
			   //$persen = ($key['sum_defect'] / $key['qty_hasil']) *100;
               //echo ''.$key['qty_hasil'].' / '.$key['sum_defect'].' / '.number_format_decimal(0).' % ' ;
			   
			  //echo '
			   //<table width="100%" border="1" style="font-size:12px;">
				 // <tr>
					//<td width="25%" align="center">OUTPUT</td>
					//<td width="25%" align="center">DEFECT</td>
					//<td width="25%" align="center">OK</td>
					//<td width="25%" align="center">DR %</td>
				 // </tr>
				//  <tr>
					//<td align="center">'.$key['qty_hasil'].'</td>
					//<td align="center">'.$key['sum_defect'].'</td>
					//<td align="center">&nbsp;</td>
					//<td align="center">&nbsp;</td>
				  //</tr>
				//</table>
			   //';
            }else
            {
             // echo '
			   //<table width="100%" border="1" style="font-size:13px;">
				  //<tr>
					//<td width="25%" align="center">OUTPUT</td>
					//<td width="25%" align="center">DEFECT</td>
					//<td width="25%" align="center">OK</td>
					//<td width="25%" align="center">DR %</td>
				 // </tr>
				 // <tr>
					//<td align="center">-</td>
					//<td align="center">-</td>
					//<td align="center">-</td>
					//<td align="center">-</td>
				//  </tr>
				//</table>
			   //';
            }

             



          ?>
      </span> </div>
    </div>
  </div>
  <?php }; ?>
</div>


