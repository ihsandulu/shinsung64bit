<!--
<style>
      @keyframes blinking {
        0% {
          background-color: #fff;
		  /*  background-color: #06c3d1; */
          /* border: 3px solid #666; */
        }
        100% {
          /* background-color: #fff; */
          /* border: 3px solid #666; */
        }
      }
      #blink {
        
        animation: blinking 1s infinite;
      }
    </style>
-->
<style>
      .blink {
        animation: blink-animation 1s steps(5, start) infinite;
        -webkit-animation: blink-animation 1s steps(5, start) infinite;
      }
      @keyframes blink-animation {
        to {
          visibility: hidden;
        }
      }
      @-webkit-keyframes blink-animation {
        to {
          visibility: hidden;
        }
      }
    </style>


<?php
  $buttonCount = 20;


?>

<!-- <i class="fa fa-google-plus"></i> -->
<div align="right" style="padding-top:-100px;" hidden><button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom"> <i class="fa fa-info-circle"></i> </button></div>
<div class="row"  >
  <?php for ($i = 1; $i <= $buttonCount; $i++) { 

     $filteredArray = array_filter($persen_defect, function($item)  use ($i)  {
                return $item['line'] == $i;
     });
	 
	 $filteredHasil = array_filter($data_hasil, function($item)  use ($i)  {
                return $item['line_sewing'] == $i;
     });
	 
     $warna = 'black';
	 $warna_tulisan = 'white';
	 $warna_bg = 'black';
	  $blink = '';
	  
	  $hidden = 'hidden';
	  
	  
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
				   $blink = '';
               }
			   
			   
			   
			   $hasil = $key['qty_hasil'] * 2;
			   if ($key['qty_checking'] < $hasil )
               {
                 $warna_tulisan = '000000';
				 $warna_bg = '#000';
				 $blink = 'class="blink"';
		
               
               }else
               {
                   $warna_tulisan = 'white';
				   $warna_bg = $warna;
				   $blink = '';
				
               }
			   
			   
            }
    ?>
  <div class="col-md-12 col-sm-12 col-xs-12 my-div" data-toggle="modal" onclick="openModal(<?php echo $i; ?>)"  data-target="#myModal" >
    <div class="info-box" style="background-color:#fff;"> <span class="info-box-icon" style="border:2px solid <?php echo $warna_bg; ?>; background-color:<?php echo $warna; ?>; color:<?php echo $warna_tulisan; ?>"><span <?php echo $blink; ?>><?php echo $i; ?></span></span>
      <div class="info-box-content"> 
       
          <?php   
            $filteredArray = array_filter($persen_defect, function($item)  use ($i)  {
                return $item['line'] == $i;
             });
            if (count($filteredArray)>0 )
            {
                $key = array_shift($filteredArray); 
			   echo '
					<div style="font-size:12px; font:Tahoma, Geneva, sans-serif; overflow-y: scroll; overflow-x: scroll; max-height: 200px;">
					<table width="100%" class="table table-condensed">
					  <tbody>
						<tr>
						  <th>#</th>
							<th>QTY PLAN</th>
							<th>OUTPUT </th>
							<th>BALANCE</th>
							<th>FILE NO</th>
							<th>STYLE NO</th>
							<th>ITEM</th>
							<th>COLOR</th>
							<th>DES</th>
							<th>GAC</th>
							<th>QTY ORDER<BR>
							<th>QTY DEFECT</th>
              <th>QTY QC</th>
							<th>QTY IRONING</th>
              <th>QTY PACKING</th>
						</tr>';
				$nomor = '0';
				foreach($filteredHasil as $row) {
				$nomor++;
			
				echo '
				<tr>
				  <td>'.$nomor.'.</td>
				  <td align="left"><div style="margin-right:20px;">'. $row['QTY_PLAN'] .'</div></td>
			
				  <td align="left"><div style="margin-right:20px;">'. $row['ALLOUT'] .'</div></td>
				  <td align="left"><div style="margin-right:20px;">'. $row['BALANCE'] .'</div></td>
				  <td>'. $row['KANAAN_PO'] .'</td>
				  <td>'. $row['STYLE_NO'] .'</td>
				  <td>'. $row['ITEM'] .'</td>
				  <td>'. $row['COLOR'] .'</td>
				  <td>'. $row['DES'] .'</td>
          <td>'. $row['GAC'] .'</td>
          <td>'. $row['QTY_ORDER'] .'</td>
          <td align="left"><div style="margin-right:20px;">'. $row['jml_defect'] .'</div></td>
          <td align="left"><div style="margin-right:20px;">'. $row['ALLOUT'] .'</div></td>
          
		      <!-- <td align="left"><div style="margin-right:20px;">'. $row['qty'] .'</div></td> -->
          <td align="left"><div style="margin-right:20px;">'. $row['ALLOUTIRONING'] .'</div></td>
          <td align="left"><div style="margin-right:20px;">'. $row['ALLOUTPACKING'] .'</div></td>
				</tr>';
				}
	echo '
    </tbody>
</table>
</div>

			   ';
            }else
            {
			  echo '-';
            }

          ?>
      </span></div>
    </div>
  </div>
  <?php }; ?>



