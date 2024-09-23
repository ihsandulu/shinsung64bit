
<style>
.highcharts-figure,
.highcharts-data-table table {
    min-width: 100%;
    max-width: 100%;
    margin: 1em auto;
	
}

#container {
    height: 400px;
	
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
<hr/>
<figure class="highcharts-figure">
    <div id="container" style="font-size:16px;"></div>
</figure>

<script language="javascript">
// Data retrieved from https://gs.statcounter.com/browser-market-share#monthly-202201-202201-bar

// Create the chart
Highcharts.chart('container', {
    chart: {
        type: 'column',
		style: {
        	fontSize: '16px'
        }
    },
    title: {
        align: 'center',
        text: 'TOP 5 DEFECT  <?php if($info_buyer == "") { echo ''; } else { echo '<br/> BUYER '.$info_buyer ; } ?><br/> <?php echo tgl($info_tanggal_awal); ?> s/d <?php echo tgl($info_tanggal_akhir); ?> <?php if($info_line == "") { echo ''; } else { echo '<br/> LINE '.$info_line ; } ?>',
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
                    name: '<?php echo $row['kode_defect']; ?> - <?php echo $row['keterangan']; ?>',
                    y: <?php echo $row['prosentase']; ?>
                },
				<?php endforeach; ?>
                
            ]
        }
    ]
    
});

</script>
