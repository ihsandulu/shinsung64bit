<!DOCTYPE html>
<html>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>UPLOAD STYLE IMAGE</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<body>
<!--
<img id="scream1" src="http://localhost:8000/templete_/assets/img/tas.jpg"  height="200" onClick="uploadImage1()">
<img id="scream2" src="http://localhost:8000/templete_/assets/img/logo.png"  height="200" onClick="uploadImage2()">
-->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>

<form id="save-ttd-digital">
    <div id="test" style="float:left;">
      <canvas
        id="canvas"
        width="600"
        height="400"
        style="border: 1px solid black;"
      ></canvas>
    </div>
    
    
    <div style="width:210px; float:left; border: 1px solid #000; margin-left:20px; padding:5px;">
    <div>
      <span>Size: </span>
      <input
        type="range"
        min="1"
        max="50"
        value="15"
        class="size"
        id="sizeRange"
      />
    </div>
    <div>
      <span>Color: </span>
      <input type="radio" name="colorRadio" value="black" />
      <label for="black">Black</label>
      <input type="radio" name="colorRadio" value="red" checked />
      <label for="black">Red</label>
    </div>
    <div style="margin-top: 5px;">
      
    </div>
    <br />
    <input id="upload" type="file" accept="image/*" />
    <br/><br/>
  <input name="simpan" type="button" id="simpan" value="Simpan" class="button"  onClick="signatureSave()">
  <button id="clear" class="button" style="background-color: #E74757;"  onClick="btn_clear()" >Clear  Canvas</button>
  <input name="kembali" type="button" id="simpan" value="Kembali ke Style" style="background-color: #09F;" class="button" onClick="btn_style()">
</div>

  </form>
  
</body>
</html>


<script>
function signatureSave() {
	//alert('');
	var canvas = document.getElementById("canvas");
	// save canvas image as data url (png format by default)
	var dataURL = canvas.toDataURL("image/png");
	//document.getElementById("saveSignature").src = dataURL;
	//document.getElementById("saveSignatures").value = dataURL;
	
	$.ajax({
      url: '<?php echo base_url().'Qa_end_line/AJAX_insert_data_img' ?>',
      type: 'POST',
      data: {         
        id_scedule : "<?php echo $this->uri->segment(4); ?>",
        img_style : dataURL
      },
    })
    .done(function(data) {
      alert('Data berhasil di simpan');
    });
	
};



function btn_style() {
	location.href = "<?php echo base_url(); ?>Qa_end_line/daftar_schedule/<?php echo $this->uri->segment(3); ?>";
}

function btn_clear() {
	context.clearRect(0, 0, canvasElement.width, canvasElement.height);
}





const fileInput = document.querySelector("#upload");

// enabling drawing on the blank canvas
drawOnImage();

fileInput.addEventListener("change", async (e) => {
  const [file] = fileInput.files;

  // displaying the uploaded image
  const image = document.createElement("img");
  image.src = await fileToDataUri(file);

  // enbaling the brush after after the image
  // has been uploaded
  image.addEventListener("load", () => {
    drawOnImage(image);
  });

  return false;
});

function fileToDataUri(field) {
  return new Promise((resolve) => {
    const reader = new FileReader();

    reader.addEventListener("load", () => {
      resolve(reader.result);
    });

    reader.readAsDataURL(field);
  });
}

const sizeElement = document.querySelector("#sizeRange");
let size = sizeElement.value;
sizeElement.oninput = (e) => {
  size = e.target.value;
};

const colorElement = document.getElementsByName("colorRadio");
let color;
colorElement.forEach((c) => {
  if (c.checked) color = c.value;
});

colorElement.forEach((c) => {
  c.onclick = () => {
    color = c.value;
  };
});

function drawOnImage(image = null) {
  
  const canvasElement = document.getElementById("canvas");
  const context = canvasElement.getContext("2d");

  // if an image is present,
  // the image passed as a parameter is drawn in the canvas
  if (image) {
    //const imageWidth = image.width;
    //const imageHeight = image.height;

    // rescaling the canvas element
    //canvasElement.width = imageWidth;
    //canvasElement.height = imageHeight;
	
	
	var scale = Math.max(canvas.width / image.width, canvas.height / image.height);
    // get the top left position of the image
    var x = (canvas.width / 2) - (image.width / 2) * scale;
    var y = (canvas.height / 2) - (image.height / 2) * scale;
    context.drawImage(image, x, y, image.width * scale, image.height * scale);
	
	
    //context.drawImage(image, 0, 0, imageWidth, imageHeight);
  }

  const clearElement = document.getElementById("clear");
  clearElement.onclick = () => {
    context.clearRect(0, 0, canvasElement.width, canvasElement.height);
  };

  let isDrawing;

  canvasElement.onmousedown = (e) => {
    isDrawing = true;
    context.beginPath();
    context.lineWidth = size;
    context.strokeStyle = color;
    context.lineJoin = "round";
    context.lineCap = "round";
    context.moveTo(e.clientX, e.clientY);
  };

  canvasElement.onmousemove = (e) => {
    if (isDrawing) {
      context.lineTo(e.clientX, e.clientY);
      context.stroke();
    }
  };

  canvasElement.onmouseup = function () {
    isDrawing = false;
    context.closePath();
  };
}
// JavaScript Document


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
    </style>

