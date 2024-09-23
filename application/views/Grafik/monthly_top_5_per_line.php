<!--
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
-->


<script src="<?php echo base_url(); ?>assets/highcharts/x/highcharts.js"></script>
<script src="<?php echo base_url(); ?>assets/highcharts/x/data.js"></script>
<script src="<?php echo base_url(); ?>assets/highcharts/x/drilldown.js"></script>
<script src="<?php echo base_url(); ?>assets/highcharts/x/exporting.js"></script>
<script src="<?php echo base_url(); ?>assets/highcharts/x/export-data.js"></script>
<script src="<?php echo base_url(); ?>assets/highcharts/x/accessibility.js"></script>



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

<figure class="highcharts-figure">
    <div id="container" style="font-size:16px;"></div>
</figure>

<script language="javascript">
Highcharts.chart('container', {
    chart: {
        type: 'column',
		style: {
        	fontSize: '16px'
        }
    },
    title: {
        text: 'MONTHLY TOP 5 DEFECT PERLINE <BR> LINE <?php echo $infoline_sewing ?> BULAN : <?php echo strtoupper(angkaKeBulan($infobulan)).' '.$infotahun ?>  ' 
    },
    subtitle: {
        text: '<br/>'
    },
    xAxis: {
        categories: [
            
			<?php foreach ($kode_defect as $row): ?>
			'<?php echo $row['kode_defect']; ?> - <?php echo $row['keterangan']; ?>',
			<?php endforeach; ?>
			
            
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Rainfall (mm)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:14px"><u> {point.key}</u></span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name} :  </td>' +
            '<td style="padding:0"><b><div align="right">{point.y}</div></b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        },
		 series: {
            dataLabels: {
                enabled: true
            }
        }
    },
    series: [
	
	<?php foreach ($kode_defect as $rows): ?>
		{
			name: '<?php echo $rows['kode_defect']; ?> - <?php echo $rows['keterangan']; ?>',
			
			data: [
				<?php foreach ($report as $rows_): ?>
				<?php if($rows['keterangan'] == $rows_['keterangan']) { ?>
				<?php echo $rows_['jumlah']; ?>,
				<?php }; ?>
				<?php endforeach; ?>
			]
			
		},
	<?php endforeach; ?>
	]
});

</script>
