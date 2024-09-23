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
  <div class="col-md-4 col-sm-6 col-xs-12"  class="my-div" data-toggle="modal" 
  onclick="openModal(<?php echo $i; ?>)"  data-target="#myModal" >
    <div class="info-box" style="background-color:#ccc;"> <span class="info-box-icon" style="background-color:<?php echo $warna?>; color:white">  <?php echo $i; ?></span>
      <div class="info-box-content"> <span class="info-box-text"> CHECK / % DEFECT </span> 
        <span class="info-box-number">
          <?php   
            $filteredArray = array_filter($persen_defect, function($item)  use ($i)  {
                return $item['line'] == $i;
             });
            if (count($filteredArray)>0 )
            {
                $key = array_shift($filteredArray);
               // pre($key);
               echo $key['qty_checking'].' / '.$key['persen_defect'].' % ' ;
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


<!-- Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="judul_modal">DAFTAR DEFECT </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          
          <table class="table table-striped table-bordered" id="tabel_summary_defect_list" style="width:100%;">
        </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<div onclick="redirectToPage()">Click me to redirect</div>


<div id="page_open"></div>
<script language="javascript">
$('#page_open').load('<?php echo base_url().'Qa_end_line_dashboard/test'?>');
</script>
<script>

  function redirectToPage(line) {
    // Redirect to the desired page
    //window.location.href = baseUrl + "Qa_end_line_dashboard/detail_defect_per_line/"+ line ;
  }


</script>

<script>
   function openModal(lines) {
  var modal = document.getElementById("myModal");
  modal.style.display = "block";
  document.getElementById("judul_modal").innerHTML = "DAFTAR DEFECT LINE : " + lines;


     $.ajax({
      type: 'POST',
      url: "<?php echo base_url().'Qa_end_line_dashboard/sp_dashboard_Qa_end_line_all_line_detail_defect_per_line/'?>" + lines  ,
      dataType: "JSON",
      data: {
      
      },
      success: function(response) {
   
       renderTable_summary(response , "tabel_summary_defect_list" );

      }
    });



}


function closeModal() {
  var modal = document.getElementById("myModal");
  modal.style.display = "none";
}


function renderTable_summary(data , nama_tabel) {
  var tableBody = document.getElementById(nama_tabel);
  //var rows = "<thead style='position: sticky; top: 0; background-color: #fff; z-index: 1; '> <tr> <th>KODE DEFECT</th> <th>KETERANGAN</th> <th>JUMLAH DEFECT</th> <th> PERSENTASE </th> </tr></thead>";
   var rows = '<tbody><tr><td width="7%" style="text-align:center;"><strong>KODE</strong></td><td width="54%"><strong>KETERANGAN</strong></td><td width="22%"><strong>JUMLAH</strong></td><td width="17%"><strong>PRESENTASE</strong></td></tr></tbody>';
   
   
  // Looping untuk setiap baris data
  for (var i = 0; i < data.length; i++) {
    rows += "<tr>";
    rows += "<td>" + data[i].kode_defect + "</td>";
    rows += "<td>" + data[i].keterangan + "</td>";
    rows += "<td>" + data[i].jumlah_defect + "</td>";
    rows += "<td>" + data[i].persen_defect + " %</td>";
    rows += "</tr>";
  }

  // Menambahkan baris data ke dalam tabel
  tableBody.innerHTML = rows;
}

  </script>