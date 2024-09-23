<?php
  $buttonCount = 20; // Jumlah button yang ingin ditampilkan

  // pre($buttonCount);
?>
 
    <div class="row">
      <div class="col-md-12">

      
        
        <?php
          // Loop untuk membuat button
          for ($i = 1; $i <= $buttonCount; $i++) {
            // Mengatur ukuran kolom pada layar sesuai jumlah button
            $colWidth = 12 / ceil(sqrt($buttonCount));
            // Membuat button background-color: 
            echo '<div class="col-lg-1 col-md-2 col-sm-2 col-xs-3" ><a class="btn btn-custom"  style ="background-color:#000;"' ;
            //echo sprintf("#%06x",rand(0,16777215)).'"';  
            echo ' href = "'. base_url().'Qa_end_line/daftar_schedule/' . $i . '">' . $i . '</a></div>';
          }
        ?>

      </div>
    </div>
    

<style>
  
    /* Gaya untuk button */
      .btn-custom {
        margin: 5px;
		padding-top:10px;
        width: 70px;
        height: 70px;
        font-size: 30px;
        font-weight: bold;
        border-radius: 20%;
        text-align: center;
        line-height: 1.5;
        /* Mengatur warna background secara acak */
       /* background-color: <?php echo sprintf("#%06x",rand(0,16777215)); ?>; */
        color: white;
      }
    </style>

