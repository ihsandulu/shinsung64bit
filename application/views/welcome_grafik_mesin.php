<style>
.highcharts6-figure,
.highcharts6-data-table table {
     min-width: 100%;
    max-width: 100%;
    margin: 1em auto;
}

#container6 {
    height: 400px;
	
}
.highcharts6-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts6-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts6-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts6-data-table td,
.highcharts6-data-table th,
.highcharts6-data-table caption {
    padding: 0.5em;
}

.highcharts6-data-table thead tr,
.highcharts6-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts6-data-table tr:hover {
    background: #f1f7ff;
}

</style>
<figure class="highcharts6-figure">
    <div id="container6"></div>
</figure>

<script>
Highcharts.chart('container6', {
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
        text: 'GRAFIK STATUS MESIN <br/> TOTAL : <?php echo $data['total']; ?>',
        align: 'center',
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
			{ name: '<a href="#" target="_default">Aktif <br/> <?php echo number_format_($data['Aktif']); ?></a>', y: <?php echo $data['Aktif']; ?> },
			{ name: '<a href="#" target="_default">Perbaikan <br/> <?php echo number_format_($data['Perbaikan']); ?></a>', y: <?php echo $data['Perbaikan']; ?> },
			{ name: '<a href="#" target="_default">Rusak <br/> <?php echo number_format_($data['Rusak']); ?></a>', y: <?php echo $data['Rusak']; ?> },
			{ name: '<a href="#" target="_default">Standby <br/> <?php echo number_format_($data['Standby']); ?></a>', y: <?php echo $data['Standby']; ?> },
			{ name: '<a href="#" target="_default">Non Aktif <br/> <?php echo number_format_($data['NonAktif']); ?></a>', y: <?php echo $data['NonAktif']; ?> },
           
        ]
    }]
});

</script>
