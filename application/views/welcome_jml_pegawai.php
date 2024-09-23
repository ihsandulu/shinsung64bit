  <style>
.highcharts5-figure,
.highcharts5-data-table table {
    min-width: 100%;
    max-width: 100%;
    /*margin: 1em auto; */
}

#container5 {
    height: 361px;
	
}

.highcharts5-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts5-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts5-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts5-data-table td,
.highcharts5-data-table th,
.highcharts5-data-table caption {
    padding: 0.5em;
}

.highcharts5-data-table thead tr,
.highcharts5-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts5-data-table tr:hover {
    background: #f1f7ff;
}
</style>



    <figure class="highcharts5-figure">
      <div id="container5" style="font-size:16px;"></div>
      <div align="center" style="padding-bottom:5px;"><button type="button" class="btn btn-info btn-flat" onclick="detail_pegawai_aktif();">DETAIL PEGAWAI </button></div>
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


Highcharts.chart('container5', {
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
        text: 'JUMLAH PEGAWAI AKTIF',
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
            text: 'Total Pegawai'
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
                format: '{point.y}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:16px;">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color};">{point.name}</span>: <b>{point.y}</b> <br/>'
    },

    series: [
        {
            name: 'Total Pegawai',
            colorByPoint: true,
            data: [
                
			
				{
                    name: 'Semua',
                    y: <?php echo $data['total']; ?>
                },
				{
                    name: 'Laki-Laki',
                    y: <?php echo $data['pria']; ?>
                },
				{
                    name: 'Perempuan',
                    y: <?php echo $data['wanita']; ?>
                },
                
            ]
        }
    ]
    
});

</script>
