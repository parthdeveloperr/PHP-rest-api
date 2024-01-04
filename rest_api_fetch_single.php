<?php
header('content-type:application/json');
header('access-control-allow-origin:*');

$data = json_decode(file_get_contents("php://input"),true);

$student_id = $data['sid'];

include('config.php');

$sql = "SELECT * FROM users WHERE id = {$student_id}";

$result = mysqli_query($con,$sql);

if(mysqli_num_rows($result)>0){

    $output = mysqli_fetch_all($result , MYSQLI_ASSOC);
    
    echo  json_encode($output) ;
   
}else{
    
    echo  json_encode(array('message'=> 'Record Not Found' , 'status'=>false)) ;
    
}

?>