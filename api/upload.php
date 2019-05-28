<?php
header('Access-Control-Allow-Origin: *');
$target_path = "uploads/";
 
$filePath = (isset($_POST['filePath']) ? $_POST['filePath'] : '');
$target_path = $target_path . basename( $_FILES['filePath']['name']);
 
if (move_uploaded_file($_FILES['filePath']['tmp_name'], $target_path)) {
    echo "Upload and move success";
} else {
echo $target_path;
    echo "There was an error uploading the file, please try again!";
}
?>