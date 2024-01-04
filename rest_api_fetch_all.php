<?php
header('Content-Type:Application/Json');
header('Access-Control-Allow-Origin:*');

include('config.php');

$sql = "SELECT * FROM users";

$result = mysqli_query($con,$sql);

if(mysqli_num_rows($result)>0){

    $output = mysqli_fetch_all($result , MYSQLI_ASSOC);
    
    echo  json_encode($output) ;
   
}else{
    
    echo  json_encode(array('message'=> 'Record Not Found' , 'status'=>false)) ;
    
}

?>