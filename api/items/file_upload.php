<?php
header('Access-Control-Allow-Origin: *');

 $file = (isset($_POST['file']) ? $_POST['file'] : '');
 // echo $filePath;
 // echo (isset($_POST['filePath']));
 
 if(isset($_POST['file'])){
    $name       = $_FILES['file']['name'];  
    $temp_name  = $_FILES['file']['tmp_name'];  
    if(isset($name)){
        if(!empty($name)){      
            $location = '/uploads/';      
            if(move_uploaded_file($temp_name, $location.$name)){
                echo 'File uploaded successfully';
            }
            else {
            	echo 'invalid folder'.$location;
            }
        }       
    }  else {
        echo 'You should select a file to upload !! #'.$_FILES["file"]["error"];
    }
}else {
    echo 'No file#'.$file ;
}
?>