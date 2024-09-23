<div align="right" style="margin-top:0px; margin-bottom:0px; margin-right:20px;"><strong>
<a href="<?php echo base_url(); ?>Ordersheet/HdMdUpdateHistory">DATA HISTORI</a>
</strong></div>
<div class="row">
    <div class="col-md-4">
        <label for="orderSheetSelcet">PILIH BUYER</label>
        <select id="buyer" class="form-control">
            <option value="">Pilih Buyer</option>
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
    // Fetch data from API
    $.ajax({
        // url: 'http://192.168.1.164:3001/api/ordersheetbuyerlist',
        url: 'http://192.168.1.164:3001/api/ordersheetbuymmonthlist',
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

    // var apiUrl = 'http://192.168.1.164:3001/api/ordersheets?page=1&pageSize=' + pageSize + '&Buyer=' + selectedBuyer;
    var apiUrl = 'http://192.168.1.164:3001/api/ordersheets?page=1&pageSize=' + pageSize + '&BuyMonth=' + selectedBuyer;


    

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


function loadOrdersheetsHdMd() {
    return new Promise(function(resolve, reject) {
        var buyerSelect = document.getElementById('buyer');
        var selectedBuyer = buyerSelect.value;
        var pageSizeSelect = document.getElementById('pageSize');
        var pageSize = pageSizeSelect.value;

        var apiUrl = 'http://192.168.1.164:3001/api/ordersheethdmd?Buyer=' + selectedBuyer;

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var data = JSON.parse(xhr.responseText);
                    resolve(data); // Resolve dengan data yang diterima
                } else {
                    reject('Permintaan gagal: ' + xhr.status); // Reject dengan pesan error
                }
            }
        };
        xhr.open('GET', apiUrl);
        xhr.send();
    });
}

async function renderDataOrdersheet(data) {
    var dataHdMd;
    try {
        // Menunggu hasil dari loadOrdersheetsHdMd()
        dataHdMd = await loadOrdersheetsHdMd();
        console.log(dataHdMd); // Lakukan apapun yang diperlukan dengan data yang diterima
        // Panggil fungsi untuk merender data ke dalam tabel di sini
        // renderDataToTable(dataHdMd);
    } catch (error) {
        console.error(error); // Tangani kesalahan jika permintaan gagal
    }
    var tableHtml =
        ` 

 `;

    tableHtml += '<table id="summaryTable" class="table table-bordered table-hover">';
    tableHtml += '<thead class="bg-light" align="center">';
    tableHtml += '<tr>';
    tableHtml += '<th width="15%"><input type="text" id="filterSeasonInErp" class="filter-input form-control" placeholder="Season In ERP"> </th>';
    tableHtml += '<th width="15%"><input type="text" id="filterKj" class="filter-input form-control" placeholder="Filter KJ">  </th>';
    // tableHtml += '<th></th>';
    // tableHtml += '<th>Buy Month</th>';
    tableHtml += '<th width="15%"><input type="text" id="filterProductCode" class="filter-input form-control" placeholder="Filter Style / Product Code "></th>';
    tableHtml += '<th width="20%"><input type="text" id="filterProductName" class="filter-input form-control" placeholder="Filter Style Name / Product Name "></th>';
    tableHtml += '<th width="7%"><div align="center">HD</div></th>';
    tableHtml += '<th width="7%"><div align="center">MD</div></th>';
    tableHtml += '<th width="7%"><div align="center">ACTION</div></th>';
    tableHtml += '<th width="14%"><div align="center">BUYER</div></th>';
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
        tableHtml += '<td>' + item.ProductName + '</td>';

        var selectHd = `<select class="form form-control"> 
                      <option value=""></option>
                      <option value="HD">HD</option>
                      </select>`;
        var selectMd = `<select class="form form-control">
                      <option value=""></option>
                      <option value="MD" >MD</option>
                      </select>`;

        let hasilFilter = HdMdfilterby(dataHdMd, item.SeasoninERP, item.KJ, item.ProductCode);
        if (hasilFilter.length > 0) {
            var selectHd = `<select class="form form-control"> 
                      <option value=""></option>`;
            var dipilih = "";
            if(hasilFilter[0].HD==="HD")
            {
                dipilih = "selected";
            }
            selectHd +=`<option value="HD" ${dipilih} >HD</option>
                      </select>`;
            tableHtml += '<td>'+ selectHd +'</td>';


            var selectMd = `<select class="form form-control"> 
                      <option value=""></option>`;
            var dipilih = "";
            if(hasilFilter[0].MD==="MD")
            {
                dipilih = "selected";
            }
            selectMd +=`<option value="MD" ${dipilih} >MD</option>
                      </select>`;

            tableHtml += '<td>'+ selectMd +'</td>';
        } else {
            tableHtml += '<td>'+ selectHd +'</td>';
            tableHtml += '<td>'+ selectMd +'</td>';
        }
        tableHtml += `<td> <button onclick="simpan(${i})" class="btn btn-block btn-success btn-sm"> <i class="fa fa-check"> </i> SAVE </button></td>`;
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
    document.getElementById('filterProductName').addEventListener('keyup', filterTable);
    // calculateTotals();
}

function HdMdfilterby(dataHdMd, SeasoninERP, KJ, ProductCode) {
    // Lakukan filter data berdasarkan parameter yang diberikan
    console.log(dataHdMd);
    const filteredData = [];
    dataHdMd.forEach(item => {
        // Lakukan filter berdasarkan kondisi yang sesuai dengan kebutuhan Anda
        // Misalnya, filter berdasarkan SeasoninERP, KJ, dan ProductCode
        const matchSeasoninERP = SeasoninERP ? item.SeasoninERP.replace(/\s/g, '') === SeasoninERP.replace(
            /\s/g, '') : true;
        const matchKJ = KJ ? item.KJ.replace(/\s/g, '') === KJ.replace(/\s/g, '') : true;
        const matchProductCode = ProductCode ? item.ProductCode.replace(/\s/g, '') === ProductCode.replace(
            /\s/g, '') : true;


        // Jika semua kondisi terpenuhi, tambahkan item ke dalam filteredData
        if (matchSeasoninERP && matchKJ && matchProductCode) {
            filteredData.push(item);
        }
    });

    // Kembalikan data yang telah difilter
    return filteredData;

}

function filterTable() {
    var totalQty = 0;
    var totalAmount = 0;
// document.getElementById('filterKj').addEventListener('keyup', filterTable);
// document.getElementById('filterSeasonInErp').addEventListener('keyup', filterTable);
//     document.getElementById('filterProductCode').addEventListener('keyup', filterTable);
//     document.getElementById('filterProductName').addEventListener('keyup', filterTable);
    var filterKj = document.getElementById('filterKj').value.toUpperCase();
    var filterSeasonInErp = document.getElementById('filterSeasonInErp').value.toUpperCase();
    var filterProductCode = document.getElementById('filterProductCode').value.toUpperCase();
    var filterProductName = document.getElementById('filterProductName').value.toUpperCase();
    var rows = document.getElementById("summaryTable").getElementsByTagName("tr");

    for (var i = 0; i < rows.length - 1; i++) {
        var cells = rows[i].getElementsByTagName("td");
        var display = false;

        if (cells.length > 0) { // Memeriksa apakah ada sel yang ada
            var kj = cells[1].textContent.toUpperCase();
            var seasoninerp = cells[0].textContent.toUpperCase();
            var ProductCode = cells[2].textContent.toUpperCase();
            var ProductName = cells[3].textContent.toUpperCase();

            if (kj.indexOf(filterKj) > -1 && seasoninerp.indexOf(filterSeasonInErp) > -1 && ProductCode.indexOf(
                    filterProductCode) > -1 && ProductName.indexOf(
                    filterProductName) > -1 ) {
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


function simpan(baris){
    console.log(baris);
    var rows = document.getElementById("summaryTable").getElementsByTagName("tr");
    var cells = rows[baris].getElementsByTagName("td");
    console.log(cells);
    if (cells.length > 0) { // Memeriksa apakah ada sel yang ada
        var kj = cells[1].textContent.toUpperCase();
        var seasoninerp = cells[0].textContent.toUpperCase();
        var ProductCode = cells[2].textContent.toUpperCase();
        var ProductName = cells[3].textContent.toUpperCase();
        var HD = cells[4].querySelector('select').value.toUpperCase(); // Mengambil nilai terpilih dari combobox di dalam sel kelima
        var MD = cells[5].querySelector('select').value.toUpperCase(); 
        var Buyer = cells[7].textContent.toUpperCase();
       
		
        $.ajax({
            url: "<?php echo base_url().'Ordersheet/HdMdUpdateAction'?>",
            type: 'POST',
            data: {
                kj: kj,
                seasoninerp: seasoninerp,
                productCode: ProductCode,
                // productName: ProductName,
                HD: HD,
                MD: MD,
                Buyer: Buyer,
            },
            success: function(responseData) {
                console.log(responseData); // Lakukan sesuatu dengan data balasan jika perlu
				
				Swal.fire({
				  icon: "success",
				  text: "Data berhasil diupdate",
				  showConfirmButton: false,
				  timer: 1000
				});
            },
            error: function(xhr, status, error) {
                console.error('Error:', error); // Tangani error jika terjadi kesalahan dalam permintaan
            }
        });

    }
}
</script>