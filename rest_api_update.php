<?php
header('Content-Type:Application/Json');
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Origin ,Access-Control-Allow-Methods ,Access-Control-Allow-Headers,Authorization,X-Requested-with');

 $data = json_decode(file_get_contents("php://input"),true);


$id = $data['sid'];
$fname = $data['fname'];
$lname = $data['lname'];

include('config.php');

$checksql = "SELECT * FROM users WHERE firstname LIKE '%{$fname}%' && lastname LIKE '%{$lname}%' && id NOT LIKE '%{$id}%' ";

$checkres = mysqli_query($con,$checksql);

if(mysqli_num_rows($checkres)>0){

    echo  json_encode(array('message'=> 'Record already exists' , 'status'=>false)) ;
}else{

$sql = "UPDATE users SET firstname = '{$fname}' ,lastname = '{$lname}' WHERE id = {$id}";


if(mysqli_query($con,$sql)){

    echo  json_encode(array('message'=> 'Student Record Updated' , 'status'=>true)) ;
   
}else{
    
    echo  json_encode(array('message'=> 'Student Record Not Updated' , 'status'=>false)) ;
    
}
}
?>