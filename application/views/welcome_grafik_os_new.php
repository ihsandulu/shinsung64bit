<style>
.highcharts-os-figure,
.highcharts-os-data-table table {
    min-width: 100%;
    max-width: 100%;
    margin: 1em auto;
}

#container-os {
    height: 400px;
	
}

.highcharts-os-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-os-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-os-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-os-data-table td,
.highcharts-os-data-table th,
.highcharts-os-data-table caption {
    padding: 0.5em;
}

.highcharts-os-data-table thead tr,
.highcharts-os-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-os-data-table tr:hover {
    background: #f1f7ff;
}

input[type="number"] {
    min-width: 50px;
}

</style>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<figure class="highcharts-os-figure">
    <div id="container-os"></div>
</figure>

<script>
Highcharts.chart('container-os', {
    chart: {
        type: 'pie',
		style: {
      		fontSize: '14px' 
		}
    },
    title: {
        text: 'Egg Yolk Composition',
		style: {
      		fontSize: '14px' 
   		}
    },
    tooltip: {
        valueSuffix: '%'
    },
    subtitle: {
        text:
        'Source:<a href="https://www.mdpi.com/2072-6643/11/3/684/htm" target="_default">MDPI</a>'
    },
    plotOptions: {
        series: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: [{
                enabled: true,
                distance: 20
            }, {
                enabled: true,
                distance: -80,
                format: '{point.percentage:.1f}%',
                style: {
                    fontSize: '1.2em',
                    textOutline: 'none',
                    opacity: 0.7
                },
                filter: {
                    operator: '>',
                    property: 'percentage',
                    value: 10
                }
            }]
        }
    },
    series: [
        {
            name: 'Percentage',
            colorByPoint: true,
            data: [
                {
                    name: 'Water',
                    y: 55.02
                },
                {
                    name: 'Fat',
                    sliced: true,
                    selected: true,
                    y: 26.71
                },
                {
                    name: 'Carbohydrates',
                    y: 1.09
                },
                {
                    name: 'Protein',
                    y: 15.5
                },
                {
                    name: 'Ash',
                    y: 1.68
                }
            ]
        }
    ]
});
</script>