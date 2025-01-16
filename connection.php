<?php
$conn = mysqli_connect('localhost', 'bmi_data', '12345678', 'bmi');
if(!$conn){
echo"connection failed".mysqli_connect_error();
}

?>