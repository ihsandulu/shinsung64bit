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
      <div class="info-box-content"> <span class="info-box-text"> CHECK / % DEFECT </span> 
        <span class="info-box-number" >
          <?php   
            $filteredArray = array_filter($persen_defect, function($item)  use ($i)  {
                return $item['line'] == $i;
             });
            if (count($filteredArray)>0 )
            {
                $key = array_shift($filteredArray);
               // pre($key);
               echo '('.$key['qty_checking'].'-'.$key['qty_hasil'].') / '.$key['persen_defect'].' % ' ;
            }else
            {
              echo '-  /  '.' % ' ;
            }

              if (count($filteredchief)>0 )
              {
                  $ch = array_shift($filteredchief);
                  echo '<br>'.$ch['nama_supervisor'] ;
              }
              else
            {
               echo '<br> ' ;
            }



          ?>
      </span> </div>
    </div>
  </div>
  <?php }; ?>
</div>


