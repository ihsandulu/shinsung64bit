<div align="right" style="margin-top:0px; margin-bottom:0px; margin-right:20px;"><strong>
<a href="<?php echo base_url(); ?>Ordersheet/HdMdUpdate">ORDER SHEEET UPDATE</a>
</strong></div>

<div class="row">
    <div class="col-md-4">
        <label for="orderSheetSelcet">PILIH BUYER</label>
        <select id="buyer" class="form-control">
            <option value="">Pilih buyer</option>
        </select>
    </div>


    <div class="col-md-4">
        <label for="orderSheetSelcet">JUMLAH DATA PER PAGE</label>
        <select id="pageSize" class="form-control">
            <!-- Options will be dynamically populated here -->
            <?php 
        for ($i=100; $i < 10000000 ; $i) { 
            # code...
            echo "<option value=$i>$i</option>";
            $i = $i * 10 ;
        }
        echo "<option value=100000000>All</option>";
      ?>
        </select>
    </div>

</div>

<br>

<div class="row">
    <div class="col-md-12">
        <div id="renderdata">

        </div>
    </div>
</div>


<script>
document.getElementById('buyer').addEventListener('change', loadOrdersheets);
document.getElementById('pageSize').addEventListener('change', loadOrdersheets);

$(document).ready(function() {
    // Fetch data from API buyerLIST
    $.ajax({
        url: 'http://192.168.1.164:3001/api/ordersheetbuyerlist',
        // url: 'http://192.168.1.164:3001/api/ordersheetbuymmonthlist',
        type: 'GET',
        success: function(data) {
            // Populate dropdown options
            var select = $('#buyer');
            $.each(data, function(index, item) {
                select.append('<option value="' + item.replace("'", "''") + '">' + item + '</option>');
            });
            // Refresh Bootstrap Select picker after data population
            //   select.selectpicker('refresh');

        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert('Error fetching data from API');
        }
    });
});


function loadOrdersheets() {
    var buyerSelect = document.getElementById('buyer');
    var selectedBuyer = buyerSelect.value;
    var pageSizeSelect = document.getElementById('pageSize');
    var pageSize = pageSizeSelect.value;

    var apiUrl = 'http://192.168.1.164:3001/api/ordersheethdmdhistory?page=1&pageSize=' + pageSize + '&Buyer=' + selectedBuyer;
    // var apiUrl = 'http://192.168.1.164:3001/api/ordersheethdmdhistory?page=1&pageSize=' + pageSize + '&BuyMonth=' + selectedBuyer;

    // console.log(apiUrl);
    // Buat objek XMLHttpRequest
    var xhr = new XMLHttpRequest();
    // Atur callback ketika permintaan selesai
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Tangkap respons JSON
                var data = JSON.parse(xhr.responseText);
                // console.log(data);

                // Panggil fungsi untuk merender data ke dalam tabel
                renderDataOrdersheet(data);
            } else {
                console.error('Permintaan gagal: ' + xhr.status);
            }
        }
    };
    // console.log(apiUrl);
    // Buka permintaan dengan metode GET ke URL yang diberikan
    xhr.open('GET', apiUrl);
    // Kirim permintaan
    xhr.send();


}

function renderDataOrdersheet(data) {
     
    var tableHtml = ``;

    tableHtml += '<table id="summaryTable" class="table table-bordered table-hover">';
    tableHtml += '<thead class="bg-light" align="center">';
    tableHtml += '<tr>';
    tableHtml +='<th width="20%"><input type="text" id="filterSeasonInErp" class="filter-input form-control" placeholder="Season In ERP"> </th>';
    tableHtml += '<th width="20%"><input type="text" id="filterKj" class="filter-input form-control" placeholder="Filter KJ">  </th>';
    // tableHtml += '<th></th>';
    // tableHtml += '<th>Buy Month</th>';
    tableHtml +='<th width="20%"><input type="text" id="filterProductCode" class="filter-input form-control" placeholder="Filter Style / Product Code "></th>';
    // tableHtml +=
    //     '<th><input type="text" id="filterProductName" class="filter-input" placeholder="Filter Style Name / Product Name "></th>';
    tableHtml += '<th width="10%">HD</th>';
    tableHtml += '<th width="10%">MD</th>';
    // tableHtml += '<th>Action</th>';
    tableHtml += '<th width="20%">Buyer</th>';
    tableHtml += '</tr>';
    tableHtml += '</thead>';
    tableHtml += '<tbody>';
    var i = 1 ; 
    data.forEach(function(item) {
        tableHtml += '<tr>';
        tableHtml += '<td>' + item.SeasoninERP + '</td>';
        tableHtml += '<td>' + item.KJ + '</td>';
        // tableHtml += '<td>' + item.Buyer + '</td>';
        // tableHtml += '<td>' + item.BuyMonth + '</td>';
        tableHtml += '<td>' + item.ProductCode + '</td>';
        // tableHtml += '<td>' + item.ProductName + '</td>';
        tableHtml += '<td>' + item.HD + '</td>';
        tableHtml += '<td>' + item.MD + '</td>';
        
        tableHtml += '<td>' + item.Buyer + '</td>';
        tableHtml += '</tr>';
        i++;
    });

    tableHtml += '</tbody>';
    tableHtml += '<tfoot hidden>';
    tableHtml += '<tr>';
    tableHtml += '<td colspan="3">Total</td>';
    tableHtml += '<td id="totalQty"></td>';
    tableHtml += '<td id="totalAmount"></td>';
    tableHtml += '</tr>';
    tableHtml += '</tfoot>';
    tableHtml += '</table>';
    document.getElementById('renderdata').innerHTML = tableHtml;

    document.getElementById('filterKj').addEventListener('keyup', filterTable);
    document.getElementById('filterSeasonInErp').addEventListener('keyup', filterTable);
    document.getElementById('filterProductCode').addEventListener('keyup', filterTable);
    // document.getElementById('filterProductName').addEventListener('keyup', filterTable);
    // calculateTotals();
}


function filterTable() {
    var totalQty = 0;
    var totalAmount = 0;

    var filterKj = document.getElementById('filterKj').value.toUpperCase();
    var filterSeasonInErp = document.getElementById('filterSeasonInErp').value.toUpperCase();
    var filterProductCode = document.getElementById('filterProductCode').value.toUpperCase();
    // var filterProductName = document.getElementById('filterProductName').value.toUpperCase();
    var rows = document.getElementById("summaryTable").getElementsByTagName("tr");

    for (var i = 0; i < rows.length - 1; i++) {
        var cells = rows[i].getElementsByTagName("td");
        var display = false;

        if (cells.length > 0) { // Memeriksa apakah ada sel yang ada
            var kj = cells[1].textContent.toUpperCase();
            var seasoninerp = cells[0].textContent.toUpperCase();
            var ProductCode = cells[2].textContent.toUpperCase();
            // var ProductName = cells[3].textContent.toUpperCase();

            if (kj.indexOf(filterKj) > -1 && seasoninerp.indexOf(filterSeasonInErp) > -1 && ProductCode.indexOf(
                    filterProductCode) > -1  ) {
                display = true;

                if (cells[3]) {
                    // totalQty += parseInt(cells[3].textContent);
                }

                // Memastikan sel ke-4 ada sebelum mengakses textContent-nya
                if (cells[4]) {
                    // totalAmount += parseFloat(cells[4].textContent.replace(/,/g, ''));
                }
            }
        } else {
            display = true; // Menampilkan baris header
        }

        // rows[i].style.display = display ? "" : "none";
        if (display) {
            rows[i].style.display = "";
        } else {
            rows[i].style.display = "none";
        }
    }
    // document.getElementById('totalQty').textContent = totalQty;
    // document.getElementById('totalAmount').textContent = totalAmount.toFixed(2);
    // calculateTotals();
}

</script>