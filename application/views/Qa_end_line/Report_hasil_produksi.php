<!-- <?php pre($list_defect); ?>  -->

<div class="col-md-6">
  <form action="<?php echo base_url() ?>Report_end_line/Report_hasil_produksi_action" method="post">
    <div class="form-group">
      <div class="form-group hide">
        <label for="weekly">Tipe Laporan:</label>
        <select class="form-control" name="weekly" id="weekly" onclick="pilihtype()">
          <option value="">PILIH </option>
          <option value="hasil_produksi">HASIL PRODUKSI</option>


        </select>
      </div>
      <div id="pilih_periode" name="pilih_periode">
        <div class="form-group">
          <label for="tanggal">TANGGAL START :</label>
          <input type="DATE" class="form-control" name="tanggal_start" id="tanggal_start" value="<?php echo date("Y-m-d") ?>">
        </div>
        <div class="form-group">
          <label for="tanggal">TANGGAL END :</label>
          <input type="DATE" class="form-control" name="tanggal_end" id="tanggal_end" value="<?php echo date("Y-m-d") ?>">
        </div>
      </div>
      <div class="form-group" id=pilih_line name=pilih_line>
        <label for="line_sewing">LINE SEWING:</label>
        <input type="number" class="form-control" name="line_sewing" id="line_sewing" value="1">
      </div>
      <div class="form-group" id="pilih_line_multiple" name="pilih_line_multiple">
        <label for="line_sewing_multiple">LINE SEWING (Multiple Select):</label>
        <select class="form-control" name="line_sewing_multiple[]" id="line_sewing_multiple" multiple="multiple" style="width:100%;">
          <?php for ($i = 1; $i <= 100; $i++) : ?>
            <option value="<?php echo $i; ?>"> <?php echo $i; ?></option>
          <?php endfor; ?>
          <option value="all">All Lines</option>
        </select>
      </div>
      <script>
        $(document).ready(function() {
          $('#line_sewing_multiple').select2({
            placeholder: "Select lines",
            allowClear: true
          });
        });
      </script>
      <div class="form-group" id=pilih_tanggal name=pilih_tanggal>
        <label for="tanggal">TANGGAL :</label>
        <input type="DATE" class="form-control" name="tanggal" id="tanggal" value="<?php echo date("Y-m-d") ?>">
      </div>
      <div id="combo_week" name="combo_week">
        <div class="form-group">
          <label for="bulan">Bulan:</label>
          <select class="form-control" name="bulan" id="bulan">
            <?php for ($i = 1; $i <= 12; $i++) {
              // code...
              $sele = ($i == date('m')) ? 'selected' : '';
              echo "<option value=$i  $sele  >" . angkaKeBulan($i) . "</option>";
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="tahun">Tahun:</label>
          <input type="number" class="form-control" name="tahun" id="tahun" value="<?php echo date("Y") ?>">
        </div>
        <div class="form-group">
          <label for="week">Minggu Ke:</label>
          <select class="form-control" name="week" id="week">
            <?php for ($i = 1; $i <= 5; $i++) {
              // code...
              echo "<option value=$i > ke " . $i . "</option>";
            }
            ?>
          </select>
        </div>
      </div>
      <div class="form-group" id="combo_manager" name="combo_manager">
        <label for="manager">Manager:</label>
        <select class="form-control" name="manager" id="manager">
          <option value="AFI">AFI</option>
          <option value="LASTRI">LASTRI</option>
        </select>
      </div>

      <div class="form-group" id="combo_defect" name="combo_defect">
        <label for="manager">OPTION:</label>
        <select class="form-control" name="option_defect" id="option_defect">
          <option value="603">DEFECT HANYA 603 </option>
          <option value="KECUALI 603">DEFECT SELAIN 603</option>
          <?php foreach ($list_defect as $key => $value) {
            echo "<option value='$value[kode]'> $value[keterangan] </option>";
          }
          ?>
          <option value="all">All Defect</option>
        </select>
      </div>
      <div id="checkbox_kj" name="checkbox_kj">
        <div class="form-group">
          <input type="button" class="form-control btn-success" onclick="panggil_kanaanpo()" name="btn_call_kj" id="btn_call_kj" value="TAMPILKAN KANAAN PO:">
        </div>
        <div class="form-group">
          <div class="col-md-12">
            <div id="result"> </div>
          </div>
        </div>

        <!-- <select class="form-control" name="manager" id="manager">
      <option value="AFI">AFI</option>
      <option value="LASTRI">LASTRI</option>
    </select> -->
      </div>
      <br>
      <div class="form-group">
        <br>
        <button type="submit" class="btn btn-primary">PREVIEW</button>
      </div>
  </form>
</div>
<div class="col-md-6"> </div>
<script type="text/javascript">
  function panggil_kanaanpo() {
    var weeklyValue = document.getElementById("weekly").value;
    if (weeklyValue === 'dailyperkj') {
      url_ = '<?php echo base_url() ?>Report_end_line/get_kanaan_po_pertanggal';
    } else {
      url_ = '<?php echo base_url() ?>Report_end_line/get_kanaan_po_style_pertanggal';
    }
    var tanggal = $('#tanggal').val();
    var line_sewing = $('#line_sewing').val();
    $.ajax({
      type: 'POST',
      url: url_,
      data: {
        tanggal: tanggal,
        line_sewing: line_sewing
      },
      dataType: 'json',
      success: function(response) {
        if (response.length === 0) {
          // No data was returned by the server
          $('#result').html(' tidak ada kj yang dikerjakan pada tanggal itu');
        } else {
          var checkboxes = '<div class="row"> <input type="checkbox" id="select-all"> Select All<br> </div> <div class="row"> ';
          response.forEach(function(item) {
            checkboxes += '<div class="col md-2" style="float:left"> <div class="form-check">' +
              ' <input class="form-check-input" type="checkbox" name="datakj[]" value="' + item.kanaan_po + '" id="' + item.kanaan_po + '"> &nbsp;' +
              '<label class="form-check-label" for="' + item.kanaan_po + '">' + item.kanaan_po + '      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>' +
              '</div> </div>';
          });
          checkboxes += '</div>';
          console.log(checkboxes);
          $('#result').html(checkboxes);
        }
        $('#select-all').click(function() {
          $('input[name="datakj[]"]').prop('checked', this.checked);
        });
      },
      error: function() {
        alert('Terjadi kesalahan dalam permintaan Ajax.');
      }
    });
  }
  //var comboWeekElement = document.getElementById("combo_week");
  //var pilih_lineElement = document.getElementById("pilih_line");
  //var pilih_tanggalElement = document.getElementById("pilih_tanggal");
  //var pilih_managerElement = document.getElementById("combo_manager");
  //var checkbox_kjElement = document.getElementById("checkbox_kj");
  //var pilih_periodeElement = document.getElementById("pilih_periode");
  $("#combo_week").hide();
  $("#pilih_line").hide();
  $("#pilih_line_multiple").hide();
  $("#pilih_tanggal").hide();
  $("#combo_manager").hide();
  $("#checkbox_kj").hide();
  $("#pilih_periode").hide();
  $("#combo_defect").hide();
  //comboWeekElement.style.display = 'none';
  //pilih_lineElement.style.display = 'none';
  //pilih_tanggalElement.style.display = 'none';
  //pilih_managerElement.style.display = 'none';
  //checkbox_kjElement.style.display = 'none';
  //pilih_periodeElement.style.display = 'none';

  function tampiltanggal() {
    // $("#combo_week").hide();
    $("#pilih_line").hide();
    $("#pilih_line_multiple").show();
    $("#pilih_tanggal").hide();
    $("#combo_manager").hide();
    $("#checkbox_kj").hide();
    $("#pilih_periode").show();
    $("#combo_defect").hide();
  }

  function pilihtype() {
    var weeklyValue = document.getElementById("weekly").value;
    // var comboWeekElement = document.getElementById("combo_week");
    console.log(weeklyValue);
    //  debugger;
    if (weeklyValue === 'hasil_produksi') {
      tampiltanggal();
    } else if (weeklyValue === 'reward') {

      // $("#combo_week").hide();
      $("#pilih_line").hide();
      $("#pilih_line_multiple").show();
      $("#pilih_tanggal").hide();
      $("#combo_manager").hide();
      $("#checkbox_kj").hide();
      $("#pilih_periode").show();
      $("#combo_defect").show();
    } else {
      $("#combo_week").hide();
      $("#pilih_line").hide();
      $("#pilih_line_multiple").hide();
      $("#pilih_tanggal").hide();
      $("#combo_manager").hide();
      $("#checkbox_kj").hide();
      $("#pilih_periode").hide();
      $("#combo_defect").hide();
    }
    // <option value="weekly">Weekly Summary Defect per manager</option>
    //      <option value="weekly_top_5_per_line">Weekly TOP 5 per line</option>
    //      <option value="daily">Daily</option>
    //      <option value="dailyperkj">Daily PER KJ </option>
    //      <option value="dailyperkjstyle">Daily PER KJ & STYLE </option>
  }
  $(document).ready(function() {
    setTimeout(function(){
      $("#weekly").val("hasil_produksi");
      tampiltanggal();
    },1000);
  });
</script>