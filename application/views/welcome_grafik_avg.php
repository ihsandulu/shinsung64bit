  <style>
.highcharts-avg-figure,
.highcharts-avg-data-table table {
    min-width: 100%;
    max-width: 100%;
    /*margin: 1em auto; */
}

#container-avg {
    height: 387px;
	
}

.highcharts-avg-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-avg-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-avg-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-avg-data-table td,
.highcharts-avg-data-table th,
.highcharts-avg-data-table caption {
    padding: 0.5em;
}

.highcharts-avg-data-table thead tr,
.highcharts-avg-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-avg-data-table tr:hover {
    background: #f1f7ff;
}
</style>



    <figure class="highcharts-avg-figure">
      <div id="container-avg" style="font-size:16px;"></div>
      <div align="center" style="padding-bottom:5px;"><button type="button" class="btn btn-info btn-flat" onclick="detail_grafik_defect_rate();">DETAIL GRAFIK DEFECT RATE</button></div>
    </figure>
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


Highcharts.chart('container-avg', {
    chart: {
        type: 'column',
		style: {
        	fontSize: '15px'
        }
    },
	
	credits: {
        enabled: false
    },
	
    title: {
        align: 'center',
        text: '<?php echo $lineaktif; ?> LINE AKTIF<br/> DEFECT RATE <?php echo tgl(date('Y-m-d')); ?>',
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
            text: 'Total percent defect'
        }
		

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.1f}%'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:16px;">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color};">{point.name}</span>: <b>{point.y:.1f}%</b> of total<br/>'
    },

    series: [
        {
            name: 'Defect Rate',
            colorByPoint: true,
            data: [
                
			
				{
                    name: 'Lowest',
                    y: <?php echo $data['minimal']; ?>
                },
				{
                    name: 'Highest',
                    y: <?php echo $data['maximal']; ?>
                },
				{
                    name: 'Average',
                    y: <?php echo $data['avg']; ?>
                },
                
            ]
        }
    ]
    
});

</script>
