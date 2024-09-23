<style>
.highcharts7-figure,
.highcharts7-data-table table {
    min-width: 100%;
    max-width: 100%;
    /*margin: 1em auto; */
}

#container7 {
    height: 387px;
	
}

.highcharts7-figure,
.highcharts7-data-table table {
    min-width: 310px;
    max-width: 100%;
    margin: 1em auto;
}

.highcharts7-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
   
}

.highcharts7-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts7-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts7-data-table td,
.highcharts7-data-table th,
.highcharts7-data-table caption {
    padding: 0.5em;
}

.highcharts7-data-table thead tr,
.highcharts7-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts7-data-table tr:hover {
    background: #f1f7ff;
}

</style>

<figure class="highcharts7-figure">
    <div id="container7"></div>
</figure>
  <script language="javascript">
// Data retrieved from https://gs.statcounter.com/browser-market-share#monthly-202201-202201-bar

// Create the chart
// Data retrieved from:
// - https://en.as.com/soccer/which-teams-have-won-the-premier-league-the-most-times-n/
// - https://www.statista.com/statistics/383679/fa-cup-wins-by-team/
// - https://www.uefa.com/uefachampionsleague/history/winners/
Highcharts.chart('container7', {
    chart: {
        type: 'column',
		style: {
      		fontSize: '14px' 
   		}
    },
    title: {
        text: 'JUMLAH DETAIL PEGAWAI AKTIF',
        align: 'center',
		style: {
      		fontSize: '14px' 
   		}
    },
    xAxis: {
        categories: [
			<?php foreach ($data as $row): ?>
			'<?php echo $row['DEPT']; ?>',
			<?php endforeach; ?>
			]
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Jumlah Pegawai Aktif'
        },
        stackLabels: {
            enabled: true
        }
    },
    legend: {
        align: 'left',
        x: 70,
        verticalAlign: 'top',
        y: 70,
        floating: true,
        backgroundColor:
            Highcharts.defaultOptions.legend.backgroundColor || 'white',
        borderColor: '#CCC',
        borderWidth: 1,
        shadow: false
    },
    tooltip: {
        headerFormat: '<b>{point.x}</b><br/>',
        pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
    },
    plotOptions: {
        column: {
            stacking: 'normal',
            dataLabels: {
                enabled: true
            }
        }
    },
    series: [
	
	{
        name: 'LAKI-LAKI',
        data: [
		<?php foreach ($data as $row_lk): ?>
		<?php echo $row_lk['SEX1']; ?>,
		<?php endforeach; ?>
		]
    }, 
	{
        name: 'PEREMPUAN',
        data: [
		<?php foreach ($data as $row_pr): ?>
		<?php echo $row_pr['SEX2']; ?>,
		<?php endforeach; ?>
		]
    }, 
	
	
	]
});


</script>
