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
<div align="right" style="padding-top:-100px;" hidden><button type="button" class="btn btn-secondary"
        data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom"> <i class="fa fa-info-circle"></i>
    </button></div>
<div class="row">
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

    <!-- <div class="col-md-12 col-sm-12 col-xs-12 my-div" data-toggle="modal" onclick="openModal(<?php echo $i; ?>)"
        data-target="#myModal"> -->
    <div class="col-md-12 col-sm-12 col-xs-12 my-div">
        <div class="" style="overflow-y: scroll">
            <br>
            <span class="info-box-icon"
                style="border:2px solid <?php echo $warna_bg; ?>; background-color:<?php echo $warna; ?>; color:<?php echo $warna_tulisan; ?>; height:80px;">
                <span <?php echo $blink; ?>>
                    <div style="margin-top:-7px;"><?php echo $i; ?></div>
                </span>
            </span>
            <div class="info-box-content">


                <div
                    style="width:30px; height:7px; background-color:<?php echo $warna3; ?>; float:left; margin-left:-100px; margin-top:80px; border:1px solid #000; border-radius: 0px; ">
                </div>
                <div
                    style="width:30px; height:7px; background-color:<?php echo $warna2; ?>; float:left; margin-left:-70px; margin-top:80px; border:1px solid #000; border-radius: 0px; ">
                </div>
                <div
                    style="width:30px; height:7px; background-color:<?php echo $warna1; ?>; float:left; margin-left:-40px; margin-top:80px; border:1px solid #000; border-radius: 0px; ">
                </div>


                <div style="width:9%; float:left; margin-left:-100px; margin-top:100px; background-color:<?php //echo $warna3; ?>; ">
                    <span class="info-box-text"> <!--CHECK / % DEFECT --> </span>

                    <span class="info-box-numberx">
                        <?php   
            $filteredArray = array_filter($persen_defect, function($item)  use ($i)  {
                return $item['line'] == $i;
             });
            if (count($filteredArray)>0 )
                {
                    $key = array_shift($filteredArray);
                // pre($key);
                echo '<div align="left" style="margin-left:10px;">CHECK : <br/><b>'.$key['qty_checking'].'-'.$key['qty_hasil'].' </b><br/>DEFECT <br/> <b>'.$key['persen_defect'].' % </b></div>' ;
                    if($key['gabungan_nama'])
                {
            echo '<br/><div style="float:left;"> ';
            $arrayOfNames = explode(', ', $key['gabungan_nama']);
                foreach ($arrayOfNames as $name) {
                    $parts = explode('|', $name);                  
                    $position = $parts[0];
                    $filename = $parts[1];
                }
            echo ' </div>';
            }
                
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
                    </span>
                </div>
                <div style="width:90%; float:left; margin-left:0px; margin-top:-5px; " id="renderTable<?php echo $i; ?>">

                    <?php echo $i; ?>

                </div>


            </div>
        </div>
    </div>
    <?php }; ?>
</div>


<small> namafile : list_report_detail_qcov2 </small>

<script>
function filterByLine(data, line) {
    const lineString = line.toString();
    return data.filter(item => item.line === lineString);
}
$(document).ready(function() {
    // Loop untuk melakukan AJAX call dan membuat tabel untuk setiap line (dari 1 sampai 81)

    const apiUrl = baseUrl +
        'Qa_end_line/hasil_defect_harian_qco'; // Ganti baseUrl sesuai dengan URL API yang sesuai
    $.ajax({
        url: apiUrl,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            console.log(data);

            for (let i = 1; i <= 81; i++) {
                const filteredDataByLine = filterByLine(data, i);
                const elementId = 'renderTable' + i;
                if (filteredDataByLine && filteredDataByLine.length > 0) {
                    createTable(filteredDataByLine, elementId);
                } else {
                    console.log(`Data for line ${i} is empty or not found.`);
                }
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching data:', error);
        }
    });


    // Fungsi untuk membuat tabel berdasarkan data yang diterima
    function createTable(data, elementId) {
        const table = $('<table>').addClass('table table-bordered table-striped');
        const thead = $('<thead>').addClass('thead-dark');
        const tbody = $('<tbody>');

        // Membuat header tabel
        const headers = Object.keys(data[0]);
        const headerRow = $('<tr>');
        headers.forEach(headerText => {
            headerRow.append($('<th>').text(headerText.replace("_", " ").toUpperCase()));
        });
        thead.append(headerRow);

        // Mengisi data ke dalam tabel
        data.forEach(item => {
            const row = $('<tr>');
            headers.forEach(header => {
                row.append($('<td>').text(item[header]));
            });
            tbody.append(row);
        });

        // Menghapus konten sebelumnya dari elemen target
        const targetElement = $('#' + elementId);
        targetElement.empty();
        // Menambahkan tabel ke dalam elemen target
        table.append(thead, tbody);
        targetElement.append(table);
    }
});
</script>