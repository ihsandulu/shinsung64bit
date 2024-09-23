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
  $buttonCount = 81; // Jumlah button yang ingin ditampilkan

    // pre($persen_defect);



    // print_r($filteredArray);

?>



<!-- <i class="fa fa-google-plus"></i> -->
<div align="right" style="padding-top:-100px;" hidden><button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom"> <i class="fa fa-info-circle"></i> </button></div>
<div class="row"  >
  <?php for ($i = 1; $i <= $buttonCount; $i++) { 

     $filteredArray = array_filter($persen_defect, function($item)  use ($i)  {
                return $item['line'] == $i;
     });
     $filteredchief = array_filter($chief, function($item)  use ($i)  {
                return $item['line'] == $i;
     });

     $warna = 'black';
	 $warna1 = 'black';
	 $warna2 = 'black';
	 $warna3 = 'black';
	 $warna_tulisan = 'white';
	 $warna_bg = 'black';
	  $blink = '';
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
			   
			   
			  //KEMAEREN 1 
			   if ($key['kemarin1'] >= 50 )
               {
                 $warna1 = 'red';
				 
               }elseif ($key['kemarin1'] >= 31 )
               {
                   $warna1 = '#FC0';
				   
               }elseif (($key['kemarin1'] = 0  )) {
                  $warna1 = 'black';
				  
               }else
               {
                   $warna1 = 'green';
				   $blink = '';
               }
			   
			   
			   //KEMAEREN 2 
			   if ($key['kemarin2'] >= 50 )
               {
                 $warna2 = 'red';
				 
               }elseif ($key['kemarin2'] >= 31 )
               {
                   $warna2 = '#FC0';
				   
               }elseif (($key['kemarin2'] = 0  )) {
                  $warna2 = 'black';
				  
               }else
               {
                   $warna2 = 'green';
				   $blink = '';
               }

			   //KEMAEREN 3 
			   if ($key['kemarin3'] >= 50 )
               {
                 $warna3 = 'red';
				 
               }elseif ($key['kemarin3'] >= 31 )
               {
                   $warna3 = '#FC0';
				   
               }elseif (($key['kemarin3'] = 0  )) {
                  $warna3 = 'black';
				  
               }else
               {
                   $warna3 = 'green';
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
  
  <div class="col-md-4 col-sm-6 col-xs-12 my-div" data-toggle="modal" onclick="openModal(<?php echo $i; ?>)"  data-target="#myModal" >
    <div class="info-box" style="background-color:#ccc;"> <span class="info-box-icon" style="border:2px solid <?php echo $warna_bg; ?>; background-color:<?php echo $warna; ?>; color:<?php echo $warna_tulisan; ?>; height:80px;"><span <?php echo $blink; ?>><div style="margin-top:-7px;"><?php echo $i; ?></div></span></span>
      <div class="info-box-content"> 
      

      <div style="width:30px; height:7px; background-color:<?php echo $warna3; ?>; float:left; margin-left:-100px; margin-top:80px; border:1px solid #000; border-radius: 0px; ">  </div>
      <div style="width:30px; height:7px; background-color:<?php echo $warna2; ?>; float:left; margin-left:-70px; margin-top:80px; border:1px solid #000; border-radius: 0px; "></div>
      <div style="width:30px; height:7px; background-color:<?php echo $warna1; ?>; float:left; margin-left:-40px; margin-top:80px; border:1px solid #000; border-radius: 0px; "></div>

	  
      
      <span class="info-box-text"> CHECK / % DEFECT  </span> 
      
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
			  //echo ''. $key['nama_gambar'];


			  // if($i ==26) {
         // echo $key['gabungan_nama'];
        if($key['gabungan_nama'])
        {
           echo '<br/><div style="float:left;"> ';
        
          $arrayOfNames = explode(', ', $key['gabungan_nama']);
               foreach ($arrayOfNames as $name) {
                  // Pisahkan setiap bagian berdasarkan pemisah vertikal (|)
                  $parts = explode('|', $name);
                  // $parts[0] akan berisi posisi (MANAGER, SUPERVISOR), $parts[1] akan berisi nama file
                  $position = $parts[0];
                  $filename = $parts[1];
                  // echo "Position: $position, Filename: $filename\n";
                 // echo '<img src="'.base_url().'assets/img/panggil/'.$filename.'" height="25" title="'. $position .'">&nbsp;';
              }
          echo ' </div>';
        }
			  // echo '<br/><div style="float:left;">
			  // <img src="'.base_url().'assets/img/panggil/manager.png" height="30">
			  // <img src="'.base_url().'assets/img/panggil/assmanager.png" height="30">
			  // <img src="'.base_url().'assets/img/panggil/it.png" height="30">
			  // <img src="'.base_url().'assets/img/panggil/mekanik.png" height="30">
			  // </div>';
			  // } else {
				 //  }
			
			  
			  
			  
			  if($key['nama_gambar'] !="") {
			  	//echo '<div style="float:right; margin-top:-10px;"><img src="'.base_url().'assets/img/'.$key['nama_gambar'].'" height="40"></div>';
			  } 
            }else
            {
              echo '-  /  '.' % ' ;
            }

              if (count($filteredchief)>0 )
              {
                  $ch = array_shift($filteredchief);
                  
              }
              else
            {
               echo '<br> ' ;
			   
            }



          ?>
      </span></div>
    </div>
  </div>
  <?php }; ?>
</div>


