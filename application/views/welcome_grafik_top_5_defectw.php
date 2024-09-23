
<style>
.highcharts-top5-defect-figure,
.highcharts-top5-defect-data-table table {
    min-width: 100%;
    max-width: 100%;

	
}

#container-top5-defectw {
    height: 400px;
	
}

.highcharts-top5-defect-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-top5-defect-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-top5-defect-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-top5-defect-data-table td,
.highcharts-top5-defect-data-table th,
.highcharts-top5-defect-data-table caption {
    padding: 0.5em;
}

.highcharts-top5-defect-data-table thead tr,
.highcharts-top5-defect-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-top5-defect-data-table tr:hover {
    background: #f1f7ff;
}

</style>

<figure class="highcharts-top5-defect-figure">
    <div id="container-top5-defectw" style="font-size:16px;"></div>
</figure>

<script language="javascript">
// Data retrieved from https://gs.statcounter.com/browser-market-share#monthly-202201-202201-bar

// Create the chart
Highcharts.chart('container-top5-defectw', {
    chart: {
        type: 'column',
		style: {
        	fontSize: '16px'
        }
    },
    title: {
        align: 'center',
        text: 'TOP 5 DEFECT<br/>( WEEKLY )',
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
            text: 'Total percent top 5 defect'
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
            name: 'Top 5 Defect',
            colorByPoint: true,
            data: [
                <?php foreach ($data as $row): ?>
				{
                    name: '<?php
                $eng=explode("/",$row['keterangan']);
                
                echo $eng[0];?>',
                    y: <?php echo $row['prosentase']; ?>
                },
				<?php endforeach; ?>
                
            ]
        }
    ]
    
});

</script>
