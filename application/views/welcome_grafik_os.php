<style>
.highcharts2-figure,
.highcharts2-data-table table {
     min-width: 100%;
    max-width: 100%;
    margin: 1em auto;
}

#container2 {
    height: 400px;
	
}
.highcharts2-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts2-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts2-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts2-data-table td,
.highcharts2-data-table th,
.highcharts2-data-table caption {
    padding: 0.5em;
}

.highcharts2-data-table thead tr,
.highcharts2-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts2-data-table tr:hover {
    background: #f1f7ff;
}

</style>
<figure class="highcharts2-figure">
    <div id="container2"></div>
</figure>

<!-- <script>
Highcharts.chart('container2', {
    chart: {
        
		plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
       
		type: 'pie',
		style: {
      		fontSize: '14px' 
   		}
    },
	credits: {
        enabled: false
    },
    title: {
        text: 'TOP 5 BUYER TAHUN <?php echo $info_tahun; ?>',
        align: 'left',
		style: {
      		fontSize: '14px' 
   		}
   
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
                format: '<span style="font-size: 1.2em"><b>{point.name}</b></span><br>' +
                    '<span style="opacity: 0.9">{point.percentage:.1f} %</span>',
                connectorColor: 'rgba(128,128,128,0.5)'
            }
        }
    },
    series: [{
        name: 'Share',
        data: [
            <?php foreach ($data as $row): ?>
			{ name: '<a href="#" target="_default"><?php if($row['buyer'] == "VERA BRADLEY") { echo "VB"; } else { echo $row['buyer']; };  ?> <br/> <?php echo number_format_($row['total']); ?></a>', y: <?php echo $row['total']; ?> },
            <?php endforeach; ?>
        ]
    }]
});

</script> -->
<script>
Highcharts.chart('container2', {
    chart: {
        
		plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
       
		type: 'pie',
		style: {
      		fontSize: '14px' 
   		}
    },
	credits: {
        enabled: false
    },
    title: {
        text: 'MONTHLY ORDER STATUS',
        align: 'left',
		style: {
      		fontSize: '14px' 
   		}
   
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
                format: '<span style="font-size: 1.2em"><b>{point.name}</b></span><br>' +
                    '<span style="opacity: 0.9">{point.percentage:.1f} %</span>',
                connectorColor: 'rgba(128,128,128,0.5)'
            }
        }
    },
    series: [{
        name: 'Share',
        data: [
            <?php foreach ($data as $row): ?>
			{ name: '<a href="#" target="_default"><?php if($row['buyer'] == "VERA BRADLEY") { echo "VB"; } else { echo $row['buyer']; };  ?> <br/> <?php echo number_format_($row['total']); ?></a>', y: <?php echo $row['total']; ?> },
            <?php endforeach; ?>
        ]
    }]
});

</script>