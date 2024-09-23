  <style>
      .highcharts-avg-figure,
      .highcharts-avg-data-table table {
          min-width: 100%;
          max-width: 100%;
          /*margin: 1em auto; */
      }

      #container-avg {
          height: 387px;

      }

      .highcharts-avg-data-table table {
          font-family: Verdana, sans-serif;
          border-collapse: collapse;
          border: 1px solid #ebebeb;
          margin: 10px auto;
          text-align: center;
          width: 100%;
          max-width: 500px;
      }

      .highcharts-avg-data-table caption {
          padding: 1em 0;
          font-size: 1.2em;
          color: #555;
      }

      .highcharts-avg-data-table th {
          font-weight: 600;
          padding: 0.5em;
      }

      .highcharts-avg-data-table td,
      .highcharts-avg-data-table th,
      .highcharts-avg-data-table caption {
          padding: 0.5em;
      }

      .highcharts-avg-data-table thead tr,
      .highcharts-avg-data-table tr:nth-child(even) {
          background: #f8f8f8;
      }

      .highcharts-avg-data-table tr:hover {
          background: #f1f7ff;
      }
  </style>



  <figure class="highcharts-avg-figure">
      <div id="container-avg-weekly" style="font-size:16px;"></div>
      <!-- <div align="center" style="padding-bottom:5px;"><button type="button" class="btn btn-info btn-flat" onclick="detail_grafik_defect_rate();">DETAIL GRAFIK DEFECT RATE</button></div> -->
  </figure>

  <?php
    $start_of_week = date('Y-m-d', strtotime('last sunday', strtotime('tomorrow')));
    $end_of_week = date('Y-m-d', strtotime('next saturday', strtotime('today')));

    //hitung line
    $this->db->select('line, COUNT(*) as count');
    $this->db->from('inspect_v2');
    $this->db->where('time_stamp >=', $start_of_week);
    $this->db->where('time_stamp <=', $end_of_week);
    $this->db->group_by('line');
    $query = $this->db->get();
    $results = $query->result();
    if (!empty($results)) {$numline = count($results);}else{$numline =0;}


    // Query untuk menghitung jumlah kemunculan setiap kode_defect
    $this->db->select('kode_defect, COUNT(*) as count');
    $this->db->from('inspect_v2');
    $this->db->where('time_stamp >=', $start_of_week);
    $this->db->where('time_stamp <=', $end_of_week);
    $this->db->group_by('kode_defect');
    $query = $this->db->get();

    // Memproses hasil query
    $results = $query->result();

    if (!empty($results)) {
        $min_defect = $results[0];
        // pre($min_defect);
        $max_defect = $results[0];
        $total_inputan = 0;
        $total_defects = 0;
        $num_defects = 0;
        foreach ($results as $row) {
            if ($row->count < $min_defect->count && $row->kode_defect != "OK") {
                $min_defect = $row;
            }
            if ($row->count > $max_defect->count && $row->kode_defect != "OK") {
                $max_defect = $row;
            }
            $total_inputan += $row->count;
            if ($row->kode_defect != "OK") {
                $total_defects += $row->count;
                $num_defects ++;
            }
        }
        $pmin = $min_defect->count / $total_inputan * 100;
        $pmax = $max_defect->count / $total_inputan * 100;
        $average = $total_defects / $num_defects;
        $paverage = $average / $total_inputan * 100;

        // echo 'Kode Defect dengan Count Paling Sedikit: ' . $min_defect->kode_defect . ' - Jumlah: ' . $min_defect->count .' - Persen:'.number_format($pmin, 2). '%<br>';
        // echo 'Kode Defect dengan Count Paling Banyak: ' . $max_defect->kode_defect . ' - Jumlah: ' . $max_defect->count .' - Persen:'.number_format($pmax, 2). '%<br>';
        // echo 'Jumlah Kode Defect adalah: ' . $total_inputan . '<br>';
        // echo 'Rata-rata Kode Defect adalah: '.$average.' yaitu ' . $paverage . '%<br>';
    } else {
        // echo 'Tidak ada data defect untuk minggu ini.';
    }
    ?>

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


      Highcharts.chart('container-avg-weekly', {
          chart: {
              type: 'column',
              style: {
                  fontSize: '15px'
              }
          },

          credits: {
              enabled: false
          },

          title: {
              align: 'center',
              text: '<?=$numline;?> LINE AKTIF<br/> DEFECT RATE WEEKLY',
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

          series: [{
              name: 'Defect Rate',
              colorByPoint: true,
              data: [


                  {
                      name: 'Lowest',
                      y: <?=$pmin;?>
                  },
                  {
                      name: 'Highest',
                      y: <?=$pmax;?>
                  },
                  {
                      name: 'Average',
                      y: <?=$paverage;?>
                  },

              ]
          }]

      });
  </script>