<?php
// echo $pagetitle .'  '.$tanggal;
?>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .table-container {
    max-height: 500px; /* Sesuaikan tinggi maksimum dengan kebutuhan */
    overflow-y: auto;
}

th {
    position: sticky;
    top: 0;
    /* background-color: black; Atur warna latar belakang yang sesuai */
}
    </style>

<div class="tab-content table-container" >
<table>
        <thead>
        <tr> 
            <th colspan=6>JUMLAH MENIT DALAM PENARGETAN </th>
        </tr>
            <tr>

                <th>Jam NORMAL</th>
                <th>Jam OT 1</th>
                <th>Jam OT 2</th>
                <th>Jam OT 3</th>
                <th>Jam OT 4</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($LeanMenitPenargetan)>0)
            {
          echo '
                <tr>
                
                <td><input type="number" name="menit_jam_normal" id="menit_jam_normal"  value ="'. $LeanMenitPenargetan[0]['menit_jam_normal'].'"></td>
                <td><input type="number" name="menit_jam_ot1" id="menit_jam_ot1" value ="'. $LeanMenitPenargetan[0]['menit_jam_ot1'].'" ></td>
                <td><input type="number" name="menit_jam_ot2" id="menit_jam_ot2" value ="'. $LeanMenitPenargetan[0]['menit_jam_ot2'].'" ></td>
                <td><input type="number" name="menit_jam_ot3" id="menit_jam_ot3" value ="'. $LeanMenitPenargetan[0]['menit_jam_ot3'].'" ></td>
                <td><input type="number" name="menit_jam_ot4" id="menit_jam_ot4" value ="'. $LeanMenitPenargetan[0]['menit_jam_ot4'].'" ></td>
                <td><input type="button" class="btn btn-xs btn-success"   value="simpanMenit"  onclick="simpanMenit()"></td>
            </tr>
                
                ';
            }else{
                echo '
                <tr>
            
                <td><input type="number" name="menit_jam_normal" id="menit_jam_normal"  value ="0"></td>
                <td><input type="number" name="menit_jam_ot1" id="menit_jam_ot1" value ="0" ></td>
                <td><input type="number" name="menit_jam_ot2" id="menit_jam_ot2" value ="0" ></td>
                <td><input type=number" name=menit_jam_ot3" id=menit_jam_ot3" value ="0" ></td>
                <td><input type="number" name="menit_jam_ot4" id="menit_jam_ot4" value ="0" ></td>
                <td><input type="button" class="btn btn-xs btn-success"   value="SIMPAN MENIT"  onclick="simpanMenit()"></td>
            </tr>
                
                ';
            }
            ?>
           
        </tbody>
    </table>
</div>
<br>

<div class="tab-content table-container">
    <table>
        <thead>
        <tr> 
            <th colspan=7>JUMLAH KARYAWAN SETIAP LINE </th>
        </tr>
            <tr>
                <th>Line</th>
                <th>Jam NORMAL</th>
                <th>Jam OT 1</th>
                <th>Jam OT 2</th>
                <th>Jam OT 3</th>
                <th>Jam OT 4</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            // pre($JumlahKaryawan);
            for ($i=1; $i < 100; $i++) { 
                # code...
                $filteredData = array();
                $defaultData = array(
                    'id' => 0,
                    'tanggal' => date("Y-m-d"),
                    'line' => $i,
                    'jam_normal' => 0,
                    'jam_ot1' => 0,
                    'jam_ot2' => 0,
                    'jam_ot3' => 0,
                    'jam_ot4' => 0
                );
                $filteredData[] = $defaultData;
                if (count($JumlahKaryawan)>0)
                {
                    foreach ($JumlahKaryawan as $data) {
                        // Jika line sesuai dengan yang diinginkan, simpan datanya
                        if ($data['line'] == $i) {
                            $filteredData[] = $data; 
                        }
                        if (empty($filteredData)) {
                            $filteredData[] = $defaultData;
                        }
                    }
                }
                

                echo '
                <tr>
                <td>'.$i.'</td>
                <td><input type="number" name="jam_normal_'.$i.'" id="jam_normal_'.$i.'"  value ="'. $filteredData[0]['jam_normal'].'"></td>
                <td><input type="number" name="jam_ot1_'.$i.'" id="jam_ot1_'.$i.'" value ="'. $filteredData[0]['jam_ot1'].'" ></td>
                <td><input type="number" name="jam_ot2_'.$i.'" id="jam_ot2_'.$i.'" value ="'. $filteredData[0]['jam_ot2'].'" ></td>
                <td><input type="number" name="jam_ot3_'.$i.'" id="jam_ot3_'.$i.'" value ="'. $filteredData[0]['jam_ot3'].'" ></td>
                <td><input type="number" name="jam_ot4_'.$i.'" id="jam_ot4_'.$i.'" value ="'. $filteredData[0]['jam_ot4'].'" ></td>
                <td><input type="button" class="btn btn-xs btn-success"   value="simpan('.$i.')"  onclick="simpan('.$i.')"></td>
            </tr>
                
                ';
            }
           ?>
        </tbody>
    </table>


</div>


<script> 

function simpan(rowNumber) {
     // mendapatkan nomor baris dari tombol yang diklik
    var jam_normal = $("#jam_normal_" + rowNumber).val();
    var jam_ot1 = $("#jam_ot1_" + rowNumber).val();
    var jam_ot2 = $("#jam_ot2_" + rowNumber).val();
    var jam_ot3 = $("#jam_ot3_" + rowNumber).val();
    var jam_ot4 = $("#jam_ot4_" + rowNumber).val();
console.log(jam_normal);
    $.ajax({
            url: baseUrl + 'AndonLean/JumlahKaryawanAction',
            type: 'POST',
            data: {
                line : rowNumber,
                jam_normal: jam_normal,
                jam_ot1: jam_ot1,
                jam_ot2: jam_ot2,
                jam_ot3: jam_ot3,
                jam_ot4: jam_ot4
            },
            success: function(response){
                // Tindakan setelah permintaan berhasil dikirim
                console.log(response); // Anda bisa melakukan sesuatu dengan respons dari server di sini
                $('<div class="alert alert-success alert-dismissible fade show" role="alert">Permintaan berhasil dikirim!</div>').appendTo('.container'); // Ganti '.container' dengan selector yang sesuai
  
            },
            error: function(xhr, status, error){
                // Tindakan jika permintaan gagal
                console.error(xhr.responseText);
            }
        });
}
function simpanMenit() {
     // mendapatkan nomor baris dari tombol yang diklik
    var menit_jam_normal = $("#menit_jam_normal").val();
    var menit_jam_ot1 = $("#menit_jam_ot1").val();
    var menit_jam_ot2 = $("#menit_jam_ot2").val();
    var menit_jam_ot3 = $("#menit_jam_ot3").val();
    var menit_jam_ot4 = $("#menit_jam_ot4").val();
console.log(menit_jam_normal);
    $.ajax({
            url: baseUrl + 'AndonLean/LeanMenitPenargetanAction',
            type: 'POST',
            data: {
            
                menit_jam_normal: menit_jam_normal,
                menit_jam_ot1: menit_jam_ot1,
                menit_jam_ot2: menit_jam_ot2,
                menit_jam_ot3: menit_jam_ot3,
                menit_jam_ot4: menit_jam_ot4
            },
            success: function(response){
                // Tindakan setelah permintaan berhasil dikirim
                console.log(response); // Anda bisa melakukan sesuatu dengan respons dari server di sini
                $('<div class="alert alert-success alert-dismissible fade show" role="alert">Permintaan berhasil dikirim!</div>').appendTo('.container'); // Ganti '.container' dengan selector yang sesuai
  
            },
            error: function(xhr, status, error){
                // Tindakan jika permintaan gagal
                console.error(xhr.responseText);
            }
        });
}



</script>