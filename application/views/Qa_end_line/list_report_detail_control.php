<?php
  $buttonCount = 81; // Jumlah button yang ingin ditampilkan

    // pre($persen_defect);



    // print_r($filteredArray);

?>

<!-- <i class="fa fa-google-plus"></i> -->

  <?php for ($i = 1; $i <= $buttonCount; $i++) { 

     $filteredArray = array_filter($persen_defect, function($item)  use ($i)  {
                return $item['line'] == $i;
     });
     $filteredchief = array_filter($chief, function($item)  use ($i)  {
                return $item['line'] == $i;
     });

     $warna = 'black';
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
            }
    ?>
    
    <!--
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div style="background-color:#ccc; padding:2px; float:left; width:50px;" data-toggle="modal" onclick="openModal(<?php echo $i; ?>)"  data-target="#myModal"> <span style="background-color:<?php echo $warna?>; color:white ">  <?php echo $i; ?></span>
   </div>
    -->
<div style="width:47px; float:left; padding:3px;" data-toggle="modal" onclick="openModal(<?php echo $i; ?>)"  data-target="#myModal"><button type="button" class="btn btn-block" style="background-color:<?php echo $warna?>; color:white;"><?php echo $i; ?></button></div>
  
  </div>
  <?php }; ?>



