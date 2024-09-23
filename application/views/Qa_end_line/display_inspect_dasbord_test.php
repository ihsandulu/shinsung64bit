<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/css/font-awesome.min.css">
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/js/js/jquery-3.3.1.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/js/bootstrap.min.js"></script>


<script src="<?php echo base_url(); ?>assets/highcharts/highcharts.js"></script>
<script src="<?php echo base_url(); ?>assets/highcharts/exporting.js"></script>
<script src="<?php echo base_url(); ?>assets/highcharts/export-data.js"></script>
<script src="<?php echo base_url(); ?>assets/highcharts/accessibility.js"></script>
<!--
<script language="javascript">
window.setTimeout( function() {
   //window.location.href = "http://192.168.0.18/Kmjdisplay/andon/"+ <?php // echo $line  ?>;
   location.reload();
}, 30000);
</script>
-->
<style>
body {
 width:100%;
 /* background-color: #000;  */
}
.colomn_satu {
	border-right: 1px solid #000;
	padding: 10px;
}
.colomn_dua {
	border-right: 1px solid #000;
	padding: 10px;
}
.colomn_tiga {
	border-right: 1px solid #000;
	padding: 10px;
}
.colomn_header {
	border-bottom: 1px solid #000;
	padding: 10px;
}
.isi {
	border-bottom: 1px solid #DFDFDF;
	padding-bottom: 3px;
}
.footer {
	border-top: 1px solid #000;
	padding: 10px;
}
.row {
	display: -webkit-box;
	display: -webkit-flex;
	display: -ms-flexbox;
	display:         flex;
	flex-wrap: wrap;
}
.row > [class*='col-'] {
 display: flex;
 flex-direction: column;
}
</style>
<style>
.container_form {
	display: flex;
	flex-wrap: wrap;
	justify-content: center;
	align-items: center;
	min-height: 300px;
	width: 100%;
	background-color: #f2f2f2;
	padding: 10px;
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
}
.textbox {
	font-size: 24px;
	width: 100%;
	margin-bottom: 10px;
	text-align: right;
	padding-right: 5px;
}
.button {
	height: 60px;
	width: 60px;
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



<style>
.highcharts-figure,
.highcharts-data-table table {
    min-width: 100%;
    max-width: 100%;
    margin: 1em auto;
	
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

input[type="number"] {
    min-width: 50px;
}



.hide-bullets {
list-style:none;
margin-left: -40px;
margin-top:20px;
}


</style>




<body>
<div class="container-fluid">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
      
      <br/>
      <table class="table table-striped table-bordered" id="Table_summary" style="width:100%;">
        <tbody>
          <tr>
          	<td width="12%" style="text-align:center;"> LINE <font size="+4"><strong><div><?php echo $line; ?></div></strong></font></td>
            <td width="22%" style="text-align:center;"> QTY CHECK : <font size="+4"><strong><div id="jml_ceck"></div></strong></font></td>
            <td width="23%" style="text-align:center;"> SUM DEFECT : <font size="+4"><strong><div id="jml_defect"></div> </strong></font></td>
            <td width="23%" style="text-align:center;" id="button_status"> % DEFECT : <font size="+4"><strong><div id="jml_persen"></div> </strong></font></td>
            <td width="20%" style="text-align:center;"> OUTPUT : <font size="+4"><strong><div id="jml_qty"></div> </strong></font></td>
          </tr>
        </tbody>
      </table>
      <div align="center">  <strong>KJ : <?php echo $schedule['KANAAN_PO']; ?> - STYLE : <?php  echo $schedule['STYLE_NO']; ?> / <?php  echo $schedule['COLOR']; ?></strong></div>
      
    </div>

    
    <div class="col-xs-12 col-sm-12 col-md-6">
      <figure class="highcharts-figure">
    <div id="containers" style="width:100%;"></div>
   
</figure>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-6"> 
    <!-- TEST IMAGES -->
    <div id="main_area">
        <!-- Slider -->
        <div class="row">
          <div class="col-xs-12" id="slider">
            <!-- Top part of the slider -->
            <div class="row">
              <div class="col-sm-12" id="carousel-bounding-box">
                <div class="carousel slide" id="myCarousel">
                  <!-- Carousel items -->
                  <div class="carousel-inner">
                    
                    <?php $no = 0; ?>
					<?php foreach($data as $u){   ?>
                    <?php if($no =="0") { 
                        $q = "active";
                    } else {
                        $q = "";
                    }
                    ?>

                    <div class="<?php echo $q; ?> item" data-slide-number="<?php echo $no; ?>"><br/>
                    <img src="<?php echo base_url() ?>uploads/style/<?php echo $u['img_style']; ?>" width="100%">
                    </div>
					<?php $no++; ?>
					<?php }; ?>   
                    
                    
                  
                  </div>
                
                  <!-- Carousel nav -->
                  <!--
                  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                  </a>
                  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                  </a>
                  
                  -->
                </div>
              </div>
    
          
    
              
            </div>
          </div>
        </div>
        <!--/Slider-->
    
        <div class="row hidden-xs" id="slider-thumbs">
          <!-- Bottom switcher of slider -->
          <ul class="hide-bullets">
             <?php $no_ = 0; ?>
			 <?php foreach($data as $u_){   ?>
            <li class="col-sm-3">
              <a class="thumbnail" id="carousel-selector-<?php echo $no_; ?>"><img src="<?php echo base_url() ?>uploads/style/<?php echo $u_['img_style']; ?>" width="100%"></a>
            </li>
    		<?php $no_++; ?>
			<?php }; ?> 
            
    
         
          </ul>
        </div>
      </div>
	<!-- END TEST IMAGES -->


    </div>
    
  </div>
</div>

<script language="javascript">
  jQuery(document).ready(function($) {
 				//set here the speed to change the slides in the carousel
        $('#myCarousel').carousel({
                interval: 4000
        });
 				
//Loads the html to each slider. Write in the "div id="slide-content-x" what you want to show in each slide
       //$('#carousel-text').html($('#slide-content-0').html());
 
        //Handles the carousel thumbnails
       $('[id^=carousel-selector-]').click( function(){
            var id = this.id.substr(this.id.lastIndexOf("-") + 1);
            var id = parseInt(id);
            $('#myCarousel').carousel(id);
        });
 
 
        // When the carousel slides, auto update the text
        $('#myCarousel').on('slid.bs.carousel', function (e) {
                 var id = $('.item.active').data('slide-number');
                $('#carousel-text').html($('#slide-content-'+id).html());
        });
});
</script>

<script>
// Data retrieved from https://netmarketshare.com

Highcharts.setOptions({
    plotOptions: {
        series: {
            animation: false
        }
    }
});

Highcharts.chart('containers', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: ' GRAFIK TOP 3 DEFECT ',
        align: 'center'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
				
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
				style: {
                   fontSize: '12px'
                }
            }
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: [
		
		<?php foreach ($defects as $defect): ?>
		{
            name: '<?php echo $defect['kode_defect'] ?> - <?php echo $defect['keterangan'] ?>',
            y: <?php echo $defect['persen_defect'] ?>,
            sliced: false,
            selected: true
        }, 
		<?php endforeach; ?>
		
		
		]
    }]
});

</script>



<script language="javascript">
window.onload = list_data_defect; 
document.addEventListener("DOMContentLoaded", list_data_defect);
list_data_defect();
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
       //renderTable(response , "tabel_defect_list" );
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
   //table.rows[0].cells[0].innerHTML = response[0].qty_checking;
   document.getElementById("jml_ceck").innerHTML = response[0].qty_checking;
   document.getElementById("jml_defect").innerHTML = response[0].qty_defect;
   document.getElementById("jml_persen").innerHTML = response[0].persen_defect + ' % ';
   document.getElementById("jml_qty").innerHTML = response[0].total_qty;
	
	
	document.getElementById("jml_qty").innerHTML = response[0].total_qty;
   if(response[0].persen_defect >= 50) {
	   document.getElementById("button_status").style.backgroundColor = "red";
   } else if(response[0].persen_defect >= 31) {
	   document.getElementById("button_status").style.backgroundColor = "#FC0";
   } else if(response[0].persen_defect < 31) {
	   document.getElementById("button_status").style.backgroundColor = "green";
   } else {
	   document.getElementById("button_status").style.backgroundColor = "#CCC";
   }
   

      }
    });


}

</script>
</body>
