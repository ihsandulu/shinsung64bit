 

<style type="text/css">
  table {
  border-collapse: collapse;
  width: 100%;
  max-width: 600px;
  margin: 20px auto;
}

td {
  padding: 8px;
  border: 3px solid black;
}

tr.odd {
  background-color: #e6ffff;
}

tr.even {
  background-color: #e6e6e6;
}
</style>

<style>
    .container {
      display: flex; 
      flex-wrap: wrap;
      justify-content: center;
      align-items: center;
      height: 300px;
      width: 300px;
      background-color: #f2f2f2;
      padding: 10px;
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    }

    .textbox {
      font-size: 24px;
      width: 100%;
      margin-bottom: 10px;
      text-align: right;
      padding-right: 5px;
    }

    .button {
      height: 30px;
      width: 30px;
      margin: 5px;
      font-size: 24px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .button:hover {
      background-color: #3e8e41;
    }



    /* styling untuk tab */
    .tab {
      overflow: hidden;
      border: 1px solid #ccc;
      background-color: #f1f1f1;
    }
    
    /* styling untuk tombol tab */
    .tab button {
      background-color: inherit;
      float: left;
      border: none;
      outline: none;
      cursor: pointer;
      padding: 14px 16px;
      transition: 0.3s;
    }
    
    /* styling untuk tombol tab ketika diaktifkan */
    .tab button.active {
      background-color: #ccc;
    }
    
    /* styling untuk konten tab */
    0 {
      display: none;
      padding: 6px 12px;
      border: 1px solid #ccc;
      border-top: none;
    }
 


  </style>

  
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            <div class="body-body">
              <div class="row">

                <div class="col-md-4">
                  <table class="table table-striped table-bordered">
                        <tbody>
                              <tr  class="odd" style=" background-color: #e6ffff;">
                              <td> KANAAN PO </td>
                              <td><?php  echo $schedule['KANAAN_PO'] ?></td>
                            </tr>
                            <tr>
                              <td> STYLE NO </td>
                              <td><?php  echo $schedule['STYLE_NO'] ?></td>
                            </tr>
                            <tr  style=" background-color: #e6ffff;">
                              <td> ITEM </td>
                              <td><?php  echo $schedule['ITEM'] ?></td>
                              </tr>
                            <tr>
                               <td> COLOR </td>
                              <td><?php  echo $schedule['COLOR'] ?></td>
                              </tr>
                            <tr  style=" background-color: #e6ffff;">
                               <td> DES </td>
                              <td ><?php  echo $schedule['DES'] ?></td>
                            </tr>
                          </tbody>
                  </table>
              </div>
              <div class="col-md-4">

                 <table class="table table-striped table-bordered" id="Table_summary" style="width:100%;" >
                        <tbody>
                              <tr  class="odd" style=" background-color: #e6ffff; " align="center" valign="center">
                              <td> QTY ORDER </td>
                              <td><?php  echo $schedule['QTY_ORDER'] ?></td>
                               <td> QTY CHECK </td>
                              <td><?php  echo $schedule['QTY_ORDER'] ?></td>
                               <td> SUM DEFECT </td>
                              <td><?php  echo $schedule['QTY_ORDER'] ?></td>
                               <td> % DEFECT </td>
                              <td style="white-space: nowrap;" ><?php  echo $schedule['QTY_ORDER'] ?></td>
                            </tr>
                        </tbody>
                    </table>

                     <div class="table-responsive" style="height:200px">
                      <table class="table table-striped table-bordered table-full-color" id="tabel_summary_defect_list">
                        
                     </table>
                   </div>

              </div>
               <div class="col-md-4" style="height:200px">
                <div class="row">
                   


                </div>
                 <div class="row">
                    <div style="overflow-y:auto;">
                    <div style="height:200px">
                      <table class="table table-striped table-bordered table-full-color" id="tabel_defect_list" style="width:95%;">
                        
                     </table>
                     </div>
                   </div>
                  </div>
                 

               </div>
            </div>
 
           
            <div class="row">
            <p>&nbsp;</p>
              <div class="col-md-6">

                <table>
                  <tr align="center" style="font-size:25px" >
                    <td><b>OK</b></td>
                    <td><b>DEFECT CODE</b></td>
                  </tr>
                  <tr valign="top">
                    <td>
                      <button class="button" style="background-color:darkgreen; width: 150px; height: 100px;;" onclick="oke_inspect()">INSPECT OK</button>
                    </td>
                    <td>
<div>
                      <button class="btn btn-default" id="btn_start"   onclick="start_check()">start check</button>
                      <button class="btn btn-success" id="btn_end"     onclick="end_check()">end check</button>
              </div>                      
                    <div class="container">
                    <input type="text" class="textbox"  id="textbox1" name="textbox1" readonly >
                    <button class="button" style="background-color:blue;" onclick="insert1('0')">0</button>
                    <button class="button" style="background-color:blue;" onclick="insert1('1')">1</button>
                    <button class="button" style="background-color:blue;" onclick="insert1('2')">2</button>
                    
                    <button class="button" style="background-color:blue;" onclick="insert1('3')">3</button>
                    <button class="button" style="background-color:blue;" onclick="insert1('4')">4</button>
                    <button class="button" style="background-color:blue;" onclick="insert1('5')">5</button>
                    
                    <button class="button" style="background-color:blue;" onclick="insert1('6')">6</button>
                    <button class="button" style="background-color:blue;" onclick="insert1('7')">7</button>
                    <button class="button" style="background-color:blue;" onclick="insert1('8')">8</button>
                    
                    <button class="button" style="background-color:blue;" onclick="insert1('9')">9</button>
                    <button class="button" style="background-color:darkgreen;" onclick="ok_defect()">OK</button>
                    <button class="button" style="background-color:red" onclick="kosongkan1()">DEL</button>
                    
                  </div>
                </td>
                  </tr>
                </table>
              </div>

              <div class="col-md-6" >

                <table>
                  <tr align="center" style="font-size:25px" >
                    
                    <td><b>FINAL RESULT</b></td>
                  </tr>
                  <tr valign="top">
                    
                    <td>
                       
                      <div class="container">
                        <input type="text" class="textbox" id="textbox2" name="textbox2" readonly>
                        <button class="button" style="background-color:blue;" onclick="insert2('0')">0</button>
                        <button class="button" style="background-color:blue;" onclick="insert2('1')">1</button>
                        <button class="button" style="background-color:blue;" onclick="insert2('2')">2</button>
                        
                        <button class="button" style="background-color:blue;" onclick="insert2('3')">3</button>
                        <button class="button" style="background-color:blue;" onclick="insert2('4')">4</button>
                        <button class="button" style="background-color:blue;" onclick="insert2('5')">5</button>
                        
                        <button class="button" style="background-color:blue;" onclick="insert2('6')">6</button>
                        <button class="button" style="background-color:blue;" onclick="insert2('7')">7</button>
                        <button class="button" style="background-color:blue;" onclick="insert2('8')">8</button>
                        
                        <button class="button" style="background-color:blue;" onclick="insert2('9')">9</button>
                        <button class="button" style="background-color:darkgreen;" onclick="ok_final()">OK</button>
                        <button class="button" style="background-color:red" onclick="kosongkan2()">DEL</button>
                        
                      </div>

                </td>
                  </tr>
                </table>
              </div>
              

              
 
 

<!-- JAVASCRIPT -->
<script>
 // $('#defect__item').on('click', function() {
 //      var inspectId = $(this).data('inspectid');
 //      var defectId = $(this).data('defectid');
 //      // Lakukan sesuatu ketika tombol di-klik
     

 //    });

window.onload = list_data_defect; 

document.addEventListener("DOMContentLoaded", list_data_defect);


$(document).on('click', '.defect__item', function() {
 
   $.ajax({
      url: baseURL + "Qa_end_line/hasil_inspect_bags_insert_defect_detail/"  + $(this).data('inspectid') + "/" +  $(this).data('defectid'),
        type: 'POST',
        dataType: 'JSON',
      })
      .done(function(response) {
        if (response.status == 1) {
          alert("Sukses");
          list_data_defect();
        }
      });
  
});
var cekid = "";

function getuuid()
{
   $.ajax({
      url: "<?php echo base_url()?>" + "Qa_end_line/get_uuid",
        type: 'POST',
        dataType: 'JSON',
      })
      .done(function(response) {
          // alert(response[0].uuid);
          // uuid = response[0].uuid ;
        console.log(response);
        cekid = response.cekid ;
        console.log(cekid);
      });
}
function start_check()
{
  document.getElementById("btn_end").style.display = "block";
  document.getElementById("btn_start").style.display = "none";
  getuuid();

}
 document.getElementById("btn_end").style.display = "none" ;
function end_check()
{
  document.getElementById("btn_end").style.display = "none" ;
  document.getElementById("btn_start").style.display = "block" ;
  var cekid = "";
}


function  list_data_defect()
{
   
       $.ajax({
      type: 'POST',
      url: "<?php echo base_url().'Qa_end_line/sp_grid_hasil_inspect_bags_defect_list_version1/' . $line .'/'.$id_schedule   ?>",
      dataType: "JSON",
      data: {
      
      },
      success: function(response) {
       //alert(response);
       renderTable(response , "tabel_defect_list" );
       call_sp_grid_summary_hasil_inspect_bags_defect_list_version1();

      }
    });
}
 

function  call_sp_grid_summary_hasil_inspect_bags_defect_list_version1()
{
  var table = document.getElementById("Table_summary"); 
       $.ajax({
      type: 'POST',
      url: "<?php echo base_url().'Qa_end_line/sp_grid_summary_hasil_inspect_bags_defect_list_version1/' . $line .'/'.$id_schedule   ?>",
      dataType: "JSON",
      data: {
      
      },
      success: function(response) {
 //var cell = table.rows[1].cells[1];
   table.rows[0].cells[3].innerHTML = response[0].qty_checking;
   table.rows[0].cells[5].innerHTML = response[0].qty_defect;
   table.rows[0].cells[7].innerHTML = response[0].persen_defect + ' % ';


       //alert(response);
     //  renderTable(response , "tabel_defect_list" );

      }
    });


         $.ajax({
      type: 'POST',
      url: "<?php echo base_url().'Qa_end_line/sp_grid_summary_perdefect_hasil_inspect_bags_defect_list_version1/' . $line .'/'.$id_schedule   ?>",
      dataType: "JSON",
      data: {
      
      },
      success: function(response) {
   
       renderTable_summary(response , "tabel_summary_defect_list" );

      }
    });


}


 

function renderTable(data , nama_tabel) {
  var tableBody = document.getElementById(nama_tabel);
  var rows = "<thead style='position: sticky; top: 0; background-color: #fff; z-index: 1; '> <tr> <th>Jenis</th> <th>Kode</th> <th>Keterangan</th> <th>Time Stamp</th></tr></thead>";
   
  // Looping untuk setiap baris data
  for (var i = 0; i < data.length; i++) {
    rows += "<tr>";
    rows += "<td>" + data[i].jenis + "</td>";
    rows += "<td>" + data[i].kode + "</td>";
    rows += "<td>" + data[i].keterangan + "</td>";
    rows += "<td>" + data[i].time_stamp + "</td>";
    rows += "</tr>";
  }

  // Menambahkan baris data ke dalam tabel
  tableBody.innerHTML = rows;
}


function renderTable_summary(data , nama_tabel) {
  var tableBody = document.getElementById(nama_tabel);
  var rows = "<thead style='position: sticky; top: 0; background-color: #fff; z-index: 1; '> <tr> <th>KODE DEFECT</th> <th>KETERANGAN</th> <th>JUMLAH DEFECT</th> <th> PERSENTASE </th> </tr></thead>";
   
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

  <script>
                    // let textbox = document.querySelector('.textbox');
                    var textbox1 = document.getElementById("textbox1");
                    function insert1(char) {
                      textbox1.value += char;
                    }

                    function calculate1() {
                      try {
                        textbox1.value = eval(textbox1.value);
                      } catch (err) {
                        textbox1.value = 'Error';
                      }
                    }
                    function kosongkan1() {
                      try {
                        textbox1.value = "";
                      } catch (err) {
                        textbox1.value = 'Error';
                      }
                    }


                     var textbox2 = document.getElementById("textbox2");
                    function insert2(char) {
                      textbox2.value += char;
                    }
                    function calculate2() {
                      try {
                        textbox2.value = eval(textbox2.value);
                      } catch (err) {
                        textbox2.value = 'Error';
                      }
                    }
                    function kosongkan2() {
                      try {
                        textbox2.value = "";
                      } catch (err) {
                        textbox2.value = 'Error';
                      }
                  }

                  function ok_final()
                  {
                    var qty = $("#textbox2").val(); 

                     $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url().'Qa_end_line/hasil_inspect_bags_defect_list_version1_final_result_action/' . $line .'/'.$id_schedule  ?>",
                        dataType: "JSON",
                        data: {
                          qty : qty,
                        },
                        success: function(response) {
                         //alert(response);
                         list_data_defect();
                         

                        }
                      });
                  }
                  function ok_defect(){
                    if (cekid != "")
                    {


                    var kodeDefect = $("#textbox1").val(); 

                     $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url().'Qa_end_line/hasil_inspect_bags_defect_list_version1_action/' . $line .'/'.$id_schedule  ?>",
                        dataType: "JSON",
                        data: {
                          kode_defect : kodeDefect,
                          uuid : cekid ,
                        },
                        success: function(response) {
                         //alert(response);
                         list_data_defect();
                         

                        }
                      });

                   }else
                   {
                    alert(' start chek dulu') ; 

                   }
                  }

                  
                  function oke_inspect(){
                   
                      getuuid();
                    var kodeDefect = $("#textbox1").val(); 
                     $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url().'Qa_end_line/hasil_inspect_bags_defect_list_version1_action/' . $line .'/'.$id_schedule  ?>",
                        dataType: "JSON",
                        data: {
                          kode_defect : "OK",
                          uuid : cekid ,
                        },
                        success: function(response) {
                         //alert(response);
                         list_data_defect();
                         

                        }
                      });
                      
                  }
  </script>
 
<script>
  // fungsi untuk membuka konten tab saat tombol tab diklik
  function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
  }
 
</script>