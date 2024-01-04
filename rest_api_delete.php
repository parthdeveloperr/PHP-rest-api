<?php
header('Content-Type:Application/Json');
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Origin ,Access-Control-Allow-Methods ,Access-Control-Allow-Headers,Authorization,X-Requested-with');

$data = json_decode(file_get_contents("php://input"),true);

$student_id = $data['sid'];

include('config.php');

$sql = "DELETE FROM users WHERE id = {$student_id}";



if( mysqli_query($con,$sql)){

    echo  json_encode(array('message'=> 'Record Deleted' , 'status'=>true)) ;

   
}else{
    
    echo  json_encode(array('message'=> 'Record Not Deleted' , 'status'=>false)) ;
    
}

?>