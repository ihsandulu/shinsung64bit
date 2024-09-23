 <style type="text/css">
     .bg-info {
        background-color: #d9edf7 !important;
     }
 </style>
<div class="row">
    <form id="formReport">
    <div class="col-md-12"> 
         <div class="col-md-2">
        <div class="form-group">
          <label for="tanggal_awal">Tanggal Awal</label>
          <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal" autocomplete="off" value="<?php echo date('Y-m-01') ?>" >
        </div>
      </div>


      <div class="col-md-2">
        <div class="form-group">
          <label for="tanggal_akhir">Tanggal Akhir</label>
          <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" autocomplete="off" value="<?php echo date('Y-m-t') ?>" >
        </div>
      </div>
        <div class="col-md-2" style="margin-top:25px;">
           <button type="submit" class="btn btn-primary">PROSES</button>
      </div>
       </form>

        <div class="col-md-12">
    <div class="responseResult"></div>
        </div>
</div>


<div class="row">
 
</div>



<div class="row">
    <div class="col-md-12"> 
       
    </div>
</div>

<div class="row" hidden>
    <div class="col-md-12"> 
       Select * from  [dbo].[OS_list_style] 
where delivery between 
'2023-10-01' and '2023-10-31'
order by style_no ;


Select style_no , sum(qty) qty , sum(isnull(pp_qty,0)) pp_qty  from  [dbo].[OS_list_style] 
where delivery between 
'2023-10-01' and '2023-10-31'
group by style_no 
order by style_no ;

    </div>
</div>




<div id="popup">
    <div hidden>
    <p>Column 2: <span id="popup-column-2"></span></p>
    <p>Column 3: <span id="popup-column-3"></span></p>
    <p>Column 4: <span id="popup-column-4"></span></p>
    <p>Column 5: <span id="popup-column-5"></span></p>

    </div>
    <p> HISTORY LINE  YANG MENEGRJAKAN STYLE : <span id="popup-column-4"></span> <p>
    <button onclick="closePopup()">Close</button>
</div>



<script>
let a = 3.14159265359;
let b = a.toFixed(2);
console.log(b);


  $(function() {

    $('#formReport').on('submit', function(e) {
      e.preventDefault();

      Swal.fire({
          title: 'Please Wait...',
          allowOutsideClick: false,
          showConfirmButton:false,
          onBeforeOpen: () => {
              Swal.showLoading()
          },
      });

      $.ajax({
        url: baseUrl + 'PpicSchedule/TampilkanStyleDariGac',
        type: 'POST',
        dataType: 'HTML',
        data: $(this).serializeArray(),
      })
      .done(function(response) {
        swal.close();
        var groupColumn = 3;
        $('.responseResult').html(response);
        // $('#reportTable').dataTable();
         $('#reportTable').DataTable({
            "ordering": false,
            "stateSave": true,
           "iDisplayLength": 10000,
           "aLengthMenu": [10, 50, 100, 1000, 10000, 100000],
           drawCallback: function (settings) {
                var api = this.api();
                var rows = api.rows({ page: 'current' }).nodes();
                var aData = new Array();
                api.column(3, { page: 'current' }).data().each(function (group, i) {
                var vals = api.row(api.row($(rows).eq(i)).index()).data();
                var qty = vals[6] ? parseFloat(vals[6]) : 0;
                var ppQty = vals[7] ? parseFloat(vals[7]) : 0;
                var fob = vals[8] ? parseFloat(vals[8]) : 0;
                var amount = vals[9] ? parseFloat(vals[9]) : 0;

                if (typeof aData[group] == 'undefined') {
                    aData[group] = new Array();
                    aData[group].rows = [];
                    aData[group].qty = [];
                    aData[group].ppQty = [];
                    aData[group].fob = [];
                    aData[group].amount = [];
                }

                aData[group].rows.push(i);
                aData[group].qty.push(qty);
                aData[group].ppQty.push(ppQty);
                aData[group].fob.push(fob);
                aData[group].amount.push(amount);
            });

            var idx = 0;
            for (var styleNo in aData) {
                idx = Math.max.apply(Math, aData[styleNo].rows);
                
                var sumQty = 0;
                $.each(aData[styleNo].qty, function (k, v) {
                    sumQty = sumQty + v;
                });

                let sumFob = 0;
                a = 0 ; 
                $.each(aData[styleNo].fob, function (k, v) {
                    a = a + v ;
                    sumFob = a.toFixed(2);
                });

                let sumAmount = 0;
                a = 0 ; 
                $.each(aData[styleNo].amount, function (k, v) {
                    a = a + v;
                    sumAmount =  a.toFixed(2) ;
                });

                $(rows).eq(idx).after(
                    `<tr class="bg-info" style=" font-size:bold">
                        <td colspan="6"> <b> Total :  ${styleNo} 
                        </b> </td>
                        <td colspan="2"><b> ${sumQty} </b></td>
                        <td ><b> ${sumFob} </b></td>
                        <td colspan="6"> <b> ${sumAmount} <b> </td>
                    </tr>`
                );
            };
 

                   
            },


            "dom": "<'row'<'col-sm-2'l><'col-sm-6'B><'col-sm-4 pull-right'f>>" +
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "language": {
              "sLengthMenu": "_MENU_",
              "searchPlaceholder": "Cari..."
            },
            buttons: [{
              extend: 'excel',
              className: 'btn btn-default btn-sm',
              text: 'Export to Excel',
              // title: "FG PENERIMAAN DETAIL",
              // messageTop: 'Tanggal ' + $('#f_tanggal_mulai').val() + ' s/d ' + $('#f_tanggal_selesai').val() 
            }]
          });
      });
    });

    $('.select2').select2({
      theme: "bootstrap"
    })
  });
</script>

<!-- echo "<tr>";
                     //             echo '<td colspan=3>  <h5> <b> TOTAL  STYLE </b>  </h5>  </td>';
                     //             echo '<td colspan=3> <h5> <b>  '. $style_no .'  </b>  </h5> </td>';
                                    // echo '<td colspan=1> '. $sum .'</td>';
                                    // echo '<td colspan=6></td>';
                     //         echo "</tr>"; -->
 

 <style>
        /* Style for the popup */
        #popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
    </style>

     <script>
        // Function to show the popup and populate it with data
        function showPopup(button) {
            const popup = document.getElementById('popup');
            const column2 = button.parentNode.parentNode.querySelector('.column-2').textContent;
        const column3 = button.parentNode.parentNode.querySelector('.column-3').textContent;
        const column4 = button.parentNode.parentNode.querySelector('.column-4').textContent;
        const column5 = button.parentNode.parentNode.querySelector('.column-5').textContent;

        document.getElementById('popup-column-2').textContent = column2;
        document.getElementById('popup-column-3').textContent = column3;
        document.getElementById('popup-column-4').textContent = column4;
        document.getElementById('popup-column-5').textContent = column5;


            popup.style.display = 'block';
        }

        // Function to close the popup
        function closePopup() {
            const popup = document.getElementById('popup');
            popup.style.display = 'none';
        }
    </script>