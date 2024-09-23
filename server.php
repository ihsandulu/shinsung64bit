<?php
// check if post data is available or not
if (isset($_POST['fileName']) && $_POST['fileData']){
    // save uploaded file
    $uploadDir = 'uploads/style/';
    file_put_contents(
        $uploadDir. $_POST['fileName'],
        base64_decode($_POST['fileData'])
    );
      // done
                 
         } else {
               echo "Error : File not uploaded to remote server.";
        } ?>