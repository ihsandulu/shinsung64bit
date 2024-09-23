<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1"></meta>

<meta http-equiv='cache-control' content='no-cache'>
<meta http-equiv='expires' content='0'>
<meta http-equiv='pragma' content='no-cache'>

<title>UPLOAD IMAGES</title>
</head>
<body>
<style>
#canvas_div {
  text-align: center;
  /* display: block; 
  margin-left: auto;
  margin-right: auto;*/
}
canvas {
  border: 1px solid #CCC;
}
</style>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>

<div style="float:left;">

    <canvas id="canvas" width="600" height="400"></canvas>

</div>
<div style="width:300px; margin-left:20px; padding:10px; float:left; border:1px solid #CCC; border-radius:5px;">
   <form action="" method="post" enctype="multipart/form-data">
        <input type="file" id="imageLoader" name="imageLoader" accept="image/*" />
        <input type="submit" name="upload" value="Upload">
    </form>
  
  <hr/>
  <div> <span>Size: </span>
    <input
        type="range"
        min="1"
        max="50"
        value="15"
        class="size"
        id="selWidth"
      />
  </div>
  <hr/>
  <div> <span> Type: </span>
    <input type="radio" name="colorRadio" value="red" />
    <label for="black"> F</label>
    &nbsp;&nbsp;&nbsp;
    <input type="radio" name="colorRadio" value="yellow" />
    <label for="black">M</label>
    &nbsp;&nbsp;&nbsp;
    <input type="radio" name="colorRadio" value="green" />
    <label for="black">L</label>
  </div>
  <hr/>
  <input type="hidden" name="saveSignatures" id="saveSignatures">
  <button onclick="javascript:clearArea();return false;">Clear Area</button>
  <hr/>
  <div id="uploaded_images_loading"></div>
  <input name="simpan" type="button" id="simpan" value="Simpan" class="button"  onClick="signatureSave()">
  <input name="kembali" type="button" id="simpan_" value="Kembali ke Style" style="background-color: #09F;" class="button" onClick="btn_style()">
  <hr/>
  
<!--
  <img id="scream1" src="<?php //echo base_url() ?>uploads/style/<?php //echo $data['img_style']; ?>"  height="95" onClick="uploadImage1()" />
-->
  <table width="100%" border="0">
    <tr>
      <td><div align="center">F</div></td>
      <td><div align="center">M</div></td>
      <td><div align="center">L</div></td>
      </tr>
  </table>
 <?php $no = 0; ?>
 <?php foreach($data as $u){  $no++ ?>

<img id="scream<?php echo $no; ?>" src="<?php echo base_url() ?>uploads/style/<?php echo $u['img_style']; ?>"  height="64" onClick="uploadImage<?php echo $no; ?>()" />
 <?php }; ?>
  <!--
  <input name="download" type="button" id="download" value="Download Gambar" class="button_"  onClick="download_image()">
  -->
</div>
</div>
</div>
</body>
</html>
<script language="javascript">
function btn_style() {
  location.href = "<?php echo base_url(); ?>Qa_end_line/daftar_schedule/<?php echo $this->uri->segment(3); ?>";
}

function btn_clear() {
  context.clearRect(0, 0, canvasElement.width, canvasElement.height);
}

function signatureSave() {
  const colorElement = document.getElementsByName("colorRadio");
  let  color;
  colorElement.forEach((c) => {
    if (c.checked) color = c.value;
  });
  
  colorElement.forEach((c) => {
    c.onclick = () => {
    color = c.value;
    };
  });
  var canvas1 = document.getElementById("canvas");        
    if (canvas1.getContext) {
     var ctx = canvas1.getContext("2d");                
     var myImage = canvas1.toDataURL("image/png");      
    }
  document.getElementById("saveSignatures").value = myImage;
  if(color === undefined) {
    alert('Gagal, Pilih F/M/L terlebih dahulu');
  } else {
    $.ajax({
      url: '<?php echo base_url().'Qa_end_line/AJAX_insert_data_img' ?>',
      type: 'POST',
      data: {         
      id_scedule : "<?php echo $this->uri->segment(4); ?>",
      img_style : myImage,
      style : "<?php echo $this->uri->segment(5); ?>",
      tanggal_upload : '<?php echo date('Y-m-d'); ?>',
      color : color
      },
      
      beforeSend: function(){
        $('#uploaded_images_loading').html('<div id="x" align="center"><img src="<?php echo base_url() ?>assets/img/ajax-loader.gif" width="100" /></div>');
      },
       complete: function(){
        $("#x").hide();
      },
    })
    .done(function(data) {
      alert('Data berhasil di simpan');
      //location.reload();
    });   
  }
  
};

/*
function signatureSave() {
  //alert('');
  //var canvas = document.getElementById("canvas");
  // save canvas image as data url (png format by default)
  //var dataURL = canvas.toDataURL("image/png");
  //document.getElementById("saveSignature").src = dataURL;
  
  var canvas = document.getElementsByTagName('canvas')[0];  
  var pngBase64 = canvas.toDataURL();
  localStorage.setItem('myCanvasData', pngBase64);

  document.getElementById("saveSignatures").value = dataURL;
};

*/



const colorElement = document.getElementsByName("colorRadio");
let  color;
colorElement.forEach((c) => {
  if (c.checked) color = c.value;
});

colorElement.forEach((c) => {
  c.onclick = () => {
    color = c.value;
  };
});



var imageLoader = document.getElementById('imageLoader');
    imageLoader.addEventListener('change', handleImage, false);
var canvas_ = document.getElementById('canvas');
var ctx = canvas_.getContext('2d');


function handleImage(e){
    var reader = new FileReader();
    reader.onload = function(event){
        var img = new Image();
        img.onload = function(){
            //canvas.width = img.width;
           // canvas.height = img.height;
           // ctx.drawImage(img,0,0);
       
       var scale = Math.max( (canvas.width / img.width) * 0.8 , (canvas.height / img.height) *  0.8 ) ;
       // get the top left position of the image
      var x = (canvas.width / 2) - (img.width / 2) * scale;
      var y = (canvas.height / 2) - (img.height / 2) * scale;


     // context.drawImage(img, x, y, img.width * scale, img.height * scale);
     const compressionQuality = 0.6;
      compressImage(img, compressionQuality)
        .then((compressedDataURL) => {
          // Menampilkan gambar yang telah dikompresi di elemen <canvas>
          canvas.width = img.width * scale;
          canvas.height = img.height * scale;
          context.drawImage(img, x, y, img.width * scale, img.height * scale);
          context.drawImage(img, x, y, img.width * scale, img.height * scale);
          // Lakukan sesuatu dengan compressedDataURL jika perlu
        })
  
        }
        img.src = event.target.result;
    }
    reader.readAsDataURL(e.target.files[0]);     
}

function compressImage(image, compressionQuality) {
  return new Promise((resolve, reject) => {
    const canvas = document.createElement("canvas");
    const ctx = canvas.getContext("2d");

    canvas.width = image.width;
    canvas.height = image.height;
    ctx.drawImage(image, 0, 0, canvas.width, canvas.height);

    // Mengubah data URL kembali ke gambar dengan kompresi
    canvas.toBlob(
      (blob) => {
        const reader = new FileReader();
        reader.readAsDataURL(blob);
        reader.onloadend = () => {
          const compressedDataURL = reader.result;
          resolve(compressedDataURL);
        };
      },
      "image/jpeg",
      compressionQuality
    );
  });
}




function uploadImage1() {
var c = document.getElementById("canvas");
  var ctx = c.getContext("2d");
  var img = document.getElementById("scream1");
  
   var scale = Math.max(canvas.width / img.width, canvas.height / img.height);
    var x = (canvas.width / 2) - (img.width / 2) * scale;
    var y = (canvas.height / 2) - (img.height / 2) * scale;
    ctx.drawImage(img, x, y, img.width * scale, img.height * scale);
  
}


function uploadImage2() {
var c = document.getElementById("canvas");
  var ctx = c.getContext("2d");
  var img = document.getElementById("scream2");
  
   var scale = Math.max(canvas.width / img.width, canvas.height / img.height);
    var x = (canvas.width / 2) - (img.width / 2) * scale;
    var y = (canvas.height / 2) - (img.height / 2) * scale;
    ctx.drawImage(img, x, y, img.width * scale, img.height * scale);
  
}

function uploadImage3() {
var c = document.getElementById("canvas");
  var ctx = c.getContext("2d");
  var img = document.getElementById("scream3");
  
   var scale = Math.max(canvas.width / img.width, canvas.height / img.height);
    var x = (canvas.width / 2) - (img.width / 2) * scale;
    var y = (canvas.height / 2) - (img.height / 2) * scale;
    ctx.drawImage(img, x, y, img.width * scale, img.height * scale);
  
}
</script>




<script>
const canvas = document.getElementById('canvas');
const context = canvas.getContext('2d');
const viewport = window.visualViewport;
var offsetX;
var offsetY;

function startup() {
  canvas.addEventListener('touchstart', handleStart);
  canvas.addEventListener('touchend', handleEnd);
  canvas.addEventListener('touchcancel', handleCancel);
  canvas.addEventListener('touchmove', handleMove);
}

document.addEventListener("DOMContentLoaded", startup);

const ongoingTouches = [];

function handleStart(evt) {
  evt.preventDefault();
  const touches = evt.changedTouches;
  offsetX = canvas.getBoundingClientRect().left;
  offsetY = canvas.getBoundingClientRect().top;
  console.log(offsetX, offsetY)
  for (let i = 0; i < touches.length; i++) {
    ongoingTouches.push(copyTouch(touches[i]));
  }
}

function handleMove(evt) {
  evt.preventDefault();
  const touches = evt.changedTouches;
  for (let i = 0; i < touches.length; i++) {
    //const color = document.getElementById('selColor').value;
    const idx = ongoingTouchIndexById(touches[i].identifier);
    if (idx >= 0) {
      context.beginPath();
      context.moveTo(ongoingTouches[idx].clientX - offsetX, ongoingTouches[idx].clientY - offsetY);
      context.lineTo(touches[i].clientX - offsetX, touches[i].clientY - offsetY);
      context.lineWidth = document.getElementById('selWidth').value;
      context.strokeStyle = color;
      context.lineJoin = "round";
      context.closePath();
      context.stroke();
      ongoingTouches.splice(idx, 1, copyTouch(touches[i]));  // swap in the new touch record
    }
  }
}

function handleEnd(evt) {
  evt.preventDefault();
  const touches = evt.changedTouches;
  for (let i = 0; i < touches.length; i++) {
   // const color = document.getElementById('selColor').value;
    let idx = ongoingTouchIndexById(touches[i].identifier);
    if (idx >= 0) {
      context.lineWidth = document.getElementById('selWidth').value;
      context.fillStyle = color;
      ongoingTouches.splice(idx, 1);  // remove it; we're done
    }
  }
}

function handleCancel(evt) {
  evt.preventDefault();
  const touches = evt.changedTouches;
  for (let i = 0; i < touches.length; i++) {
    let idx = ongoingTouchIndexById(touches[i].identifier);
    ongoingTouches.splice(idx, 1);  // remove it; we're done
  }
}

function copyTouch({ identifier, clientX, clientY }) {
  return { identifier, clientX, clientY };
}

function ongoingTouchIndexById(idToFind) {
  for (let i = 0; i < ongoingTouches.length; i++) {
    const id = ongoingTouches[i].identifier;
    if (id === idToFind) {
      return i;
    }
  }
  return -1;    // not found
}

function clearArea() {
    context.setTransform(1, 0, 0, 1, 0, 0);
    context.clearRect(0, 0, context.canvas.width, context.canvas.height);
}

</script>
<style>
.button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 12px;
}
.button_ {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 6px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 12px;
}
</style>


