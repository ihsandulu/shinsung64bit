  <style>
  

    #server-donut svg text{
      font-size: 20px!important;
    }

    #server-donut tspan {
      font-size: 20px!important;
    }


.highcharts-figure,
.highcharts-data-table table {
    min-width: 100%;
    max-width: 100%;
    margin: 1em auto;
}

#container {
    height: 200px;
	
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
    font-size: 1.2em;
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

</style>




  <style>
.highcharts-figure2,
.highcharts-data-table2 table {
    min-width: 100%;
    max-width: 100%;
    margin: 1em auto;
}

#container2 {
    height: 200px;
	
}

.highcharts-data-table2 table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table2 caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table2 th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table2 td,
.highcharts-data-table2 th,
.highcharts-data-table2 caption {
    padding: 0.5em;
}

.highcharts-data-table2 thead tr,
.highcharts-data-table2 tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table2 tr:hover {
    background: #f1f7ff;
}

</style>



<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/morris.css') ?>">
<script type="text/javascript" src="<?php echo base_url('assets/js/raphael.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/morris.min.js') ?>"></script>

<div class="row">
  <div class="col-md-2">
    <div class="box box-danger">
      <div class="box-header with-border" style="text-align:center;">
        <h2 class="box-title"><strong>Q C</strong></h2><br/>Defect Rate (%)
      </div>
      
      <div class="box-body chart-responsive">
        <div class="chart" id="sales-chart" style="height: 200px; position: relative;"></div>
      </div>
    </div>
  </div>
  
  
  <div class="col-md-6">
    <div class="box box-success">
      <div class="box-header with-border" style="text-align:center;">
        <h2 class="box-title">MESIN </h2>
      </div>
      <div class="box-body chart-responsive">
        <figure class="highcharts-figure">
    	<div id="container" style="font-size:16px;"></div>
    </figure>
        
      </div>
    </div>
  </div>
  
  
  
  
  
  
  <div class="col-md-2">
    <div class="box box-primary">
      <div class="box-header with-border" style="text-align:center;">
        <h2 class="box-title">EXPORT </h2>
      </div>
      <div class="box-body chart-responsive">
        <div class="chart" id="sales-chart-mesin" style="height: 200px; position: relative;"></div>
      </div>
    </div>
  </div>
  
 <div class="col-md-2">
    <div class="box box-info">
      <div class="box-header with-border" style="text-align:center;">
        <h2 class="box-title">PPIC </h2>
      </div>
      <div class="box-body chart-responsive">
        <div class="chart" id="sales-chart-ppic" style="height: 200px; position: relative;"></div>
      </div>
    </div>
  </div> 
</div>






    
  <script language="javascript">
// Data retrieved from https://gs.statcounter.com/browser-market-share#monthly-202201-202201-bar

// Create the chart
Highcharts.setOptions({
    plotOptions: {
        series: {
            animation: false
        }
    }
});


Highcharts.chart('container', {
    chart: {
        type: 'column',
		style: {
        	fontSize: '16px'
        }
    },
    title: {
        align: 'center',
        text: 'DATA MESIN',
		style: {
        	fontSize: '14px'
        }
    },
    subtitle: {
        align: 'left',
        text: '<br/>'
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'	
    },
    yAxis: {
        title: {
            text: 'Total Mesin'
        }
    },
    credits: {
		enabled: false
	},
	legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.0f}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:16px;">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color};">{point.name}</span>: <b>{point.y:.0f}</b><br/>'
    },

    series: [
        {
            name: 'Data Mesin',
            colorByPoint: true,
            data: [
                
				{
                    name: 'Total Mesin',
                    y: 8000
                },
				
				{
                    name: 'Mesin Terpakai',
                    y: 7200
                },
				
				{
                    name: 'Mesin Ready',
                    y: 720
                },
				{
                    name: 'Mesin Dipinjamkan',
                    y: 1000
                },
				{
                    name: 'Mesin Pinjaman',
                    y: 4500
                },
				{
                    name: 'Mesin Reparasi',
                    y: 90
                },
				{
                    name: 'Mesin Rusak',
                    y: 6000
                },
				
                
            ]
        }
    ]
    
});

</script>




<script>

  $(function () {
    "use strict";

    
    //DONUT CHART
    var donut = new Morris.Donut({
      element: 'sales-chart',
      resize: true,
      colors: ["#f56954"],
      data: [
       
        {label: "", value: 60}
      ],
      hideHover: 'auto'
    });
	
	
	 //DONUT CHART MESIN
    var donut2 = new Morris.Donut({
      element: 'sales-chart-mesin',
      resize: true,
      colors: ["#0CF"],
      data: [
       
        {label: "Jumlah Export ", value: 25}
      ],
      hideHover: 'auto'
    });
	
	 //DONUT CHART MESIN
    var donut3 = new Morris.Donut({
      element: 'sales-chart-ppic',
      resize: true,
      colors: ["#000", "#C69"],
      data: [
       
        {label: "Jumlah  (%)", value: 91},
        {label: "", value: 9}
      ],
      hideHover: 'auto'
    });
    
  });
   
  
  

  
</script> 
