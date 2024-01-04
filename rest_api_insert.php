<?php
header('Content-Type:Application/Json');
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Origin ,Access-Control-Allow-Methods ,Access-Control-Allow-Headers,Authorization,X-Requested-with');

 $data = json_decode(file_get_contents("php://input"),true);

$fname = $data['fname'];
$lname = $data['lname'];



include('config.php');

$checksql = "SELECT * FROM users WHERE firstname LIKE '%{$fname}%' && lastname LIKE '%{$lname}%'";

$checkres = mysqli_query($con,$checksql);

if(mysqli_num_rows($checkres)>0){

    echo  json_encode(array('message'=> 'record already exists' , 'status'=>false)) ;
}else{
    $sql = "INSERT INTO users(firstname,lastname) VALUES ('{$fname}','{$lname}')";


if(mysqli_query($con,$sql)){

    echo  json_encode(array('message'=> 'Student Record Inserted' , 'status'=>true)) ;
   
}else{
    
    echo  json_encode(array('message'=> 'Student Record Not Inserted' , 'status'=>false)) ;
    
}
}



?>