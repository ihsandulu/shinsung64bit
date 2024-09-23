<style>
.highcharts4-figure,
.highcharts4-data-table table {
     min-width: 100%;
    max-width: 100%;
    margin: 1em auto;
}

#container4 {
    height: 400px;
	
}
.highcharts4-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts4-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts4-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts4-data-table td,
.highcharts4-data-table th,
.highcharts4-data-table caption {
    padding: 0.5em;
}

.highcharts4-data-table thead tr,
.highcharts4-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts4-data-table tr:hover {
    background: #f1f7ff;
}

</style>
<figure class="highcharts4-figure">
    <div id="container4"></div>
</figure>

<script>
// Data retrieved from https://www.ssb.no/en/transport-og-reiseliv/landtransport/statistikk/bilparken
// Radialize the colors
/*
Highcharts.setOptions({
    colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
        return {
            radialGradient: {
                cx: 0.5,
                cy: 0.3,
                r: 0.7
            },
            stops: [
                [0, color],
                [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
            ]
        };
    })
});

*/
// Build the chart
Highcharts.chart('container4', {
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
        // text: 'TOP 5 BUYER BULAN <?php echo $info_bulan; ?> TAHUN <?php echo $info_tahun; ?>',
        text: 'DEFECT RATE BY BUYER WEEKLY',
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
