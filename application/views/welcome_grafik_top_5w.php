<?php
error_reporting(0);
?>

<style>
.highcharts-top5-figure,
.highcharts-top5-data-table table {
    min-width: 100%;
    max-width: 100%;
    /*margin: 1em auto; */
}

#container-top5 {
    height: 400px;
	
}

.highcharts-top5-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-top5-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-top5-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-top5-data-table td,
.highcharts-top5-data-table th,
.highcharts-top5-data-table caption {
    padding: 0.5em;
}

.highcharts-top5-data-table thead tr,
.highcharts-top5-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-top5-data-table tr:hover {
    background: #f1f7ff;
}
</style>



<?php $i = 0; ?>
<?php foreach ($data as $jumlah): ?>
<?php $i++; ?>
<?php endforeach; ?>

    <figure class="highcharts-top5-figure">
      <div id="container-top5w" style="font-size:16px;"></div>
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


Highcharts.chart('container-top5w', {
    chart: {
        type: 'column',
		style: {
        	fontSize: '16px'
        }
    },
	
	credits: {
        enabled: false
    },
	
    title: {
        align: 'center',
        // text: 'TOP 5 DEFECT RATE LINE<br/> <?php echo indotgl($info_tanggal_awal); ?> <br/> ',
        text: 'TOP 5 DEFECT RATE LINE<br/> ( WEEKLY ) <br/> ',
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
                
				<?php foreach ($data as $row): ?>
				{
                    name: 'Line <?php echo $row['line']; ?>',
                    y: <?php echo $row['defect_percentage']; ?>
                },
				
				<?php endforeach; ?>
                
            ]
        }
    ]
    
});

</script>


<?php
error_reporting(E_ALL);
?>