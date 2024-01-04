<?php
header('Content-Type:Application/Json');
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Origin ,Access-Control-Allow-Methods ,Access-Control-Allow-Headers,Authorization,X-Requested-with');

$data = json_decode(file_get_contents("php://input"),true);



$user = $data['username'];
$password = $data['password'];
$setfrom = $data['setfrom'];
$fromname = $data['fromname'];
$addaddress = $data['addaddress'];
$addCC = $data['cc'];
$addBCC = $data['bcc'];
$sub = $data['subject'];
$img = $data['image'];
// $email = $data['email'];




include('phpmailer/PHPMailerAutoload.php');
$mail = new PHPMailer();
$mail->isSMTP();
$mail->Mailer = 'smtp';
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->Username = $user ;
$mail->Password = $password;
$mail->SetFrom($setfrom, $fromname);
$mail->FromName = $fromname;
$mail->addAddress($addaddress, $fromname);
$mail->AddCC($addCC, $fromname);
$mail->AddBCC($addBCC, $fromname);
$mail->WordWrap = 50;
$mail->isHTML(true);
$mail->CharSet = "UTF-8";

/* -------------------contact us form------------------------- */


$subject = $sub;
$mail->Subject = $subject;
$name = $data['user_name'];
$mobile = $data['phone'];
$email = $data['email'];
$message = $data['message'];
$msg = '';

if (!empty($name)) {
    $msg .= "<tr><td>Name</td><td>: </td><td>" . $name . "</td></tr>";
}

if (!empty($email)) {
    $msg .= "<tr><td>Email</td><td>: </td><td>" . $email . "</td></tr>";
}
if (!empty($mobile)) {
    $msg .= "<tr><td>Contact No</td><td>: </td><td>" . $mobile . "</td></tr>";
}

if (!empty($message)) {
    $msg .= "<tr><td>Your message</td><td>: </td><td>" . $message . "</td></tr>";
}

$body = '
	<body style="width:500px;margin:0 auto;font-family: sans-serif;">
		<div style="background: rgb(255, 255, 255);border-radius: 5px;float: left;width: 100%;border: 2px solid #34495e;">
			<center>
				<h1><strong style="font-family: sans-serif;color: #334f7d;">Form Details</strong></h1>
			</center>
			<div style="width: 100%;background: #34495e;height: 2px;"></div> 
			<center>
				<table style="padding:5px">
					<tbody>' . $msg . '</tbody>
				</table>
			</center>
			<div style="width: 100%;background: #34495e;height: 2px;"></div>
			<div style="float:left">
				<table>
					<tbody>
   
   
					</tbody>
				</table>
			</div> 
			<div style="text-align:center">
			 <img style="width: 50%;margin-top:10px;" height="200" src="'.$img.'"  width="100%" /> </div>
		</div>
	</body>';
try {
    $mail->MsgHTML($body);
    if ($mail->Send()) {
        echo 'true';
    } else {
        echo 'false';
    }
} catch (phpmailerException $e) {
    echo 'false';
    //echo $e;
} catch (Exception $e) {
    echo 'false';
    //echo $e;
}
