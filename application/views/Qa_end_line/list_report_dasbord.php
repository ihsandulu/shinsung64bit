

<?php
  $buttonCount = 100; // Jumlah button yang ingin ditampilkan

    // pre($persen_defect);



    // print_r($filteredArray);

?>

<!-- <i class="fa fa-google-plus"></i> -->
<div class="row">
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
	
	 $hidden = 'hidden';
      if (count($filteredArray)>0 )
            {
                $key = array_shift($filteredArray);


               if ($key['persen_defect'] >= 50 )
               {
                 $warna = 'red';
				 $hidden = '';
               }elseif ($key['persen_defect'] >= 31 )
               {
                   $warna = '#FC0';
				   $hidden = 'hidden';
               }elseif (($key['persen_defect'] = 0  )) {
                  $warna = 'black';  
				  $hidden = 'hidden';
               }else
               {
                   $warna = 'green';
				   $hidden = 'hidden';
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
 
  <div class="col-md-4 col-sm-6 col-xs-12" style="border:0px solid #000; text-align:center;" <?php echo $hidden; ?>>
     <div style="border:2px solid <?php echo $warna_bg; ?>; background-color:<?php echo $warna?>; color:<?php echo $warna_tulisan; ?>; font-size:30px; padding:5px;">
     <span>  <?php echo $i; ?></span>
      </div>
  </div>
  <?php }; ?>
  </div>
</div>



