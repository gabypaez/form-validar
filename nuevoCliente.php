
<?php
require("config.php");
require_once __DIR__ . '/mpdf/vendor/autoload.php';
require_once(dirname(__FILE__).'/phpqrcode/qrlib.php');



$nombre        = ucwords($_REQUEST['nombre']); //ucwords para convertir la 1 letra mayuscula
$dni        = $_REQUEST['dni'];
$correo        = $_REQUEST['correo']; 
$celular       = $_REQUEST['celular'];


if(buscaRepetido($dni,$nombre,$con)==1){
  echo 2;
}else{
  $InsertCliente = "INSERT INTO invitados(
    nombre,
    dni,
    correo,
    celular
    )
  VALUES (
    '" .$nombre. "',
    '". $dni."',
    '" .$correo. "',
    '" .$celular. "'
)";
$resultadoCliente = mysqli_query($con, $InsertCliente);
}


function buscaRepetido($d,$nom,$conexion){
  $sql="SELECT * from invitados 
    where dni='$d' and nombre='$nom'";
  $result=mysqli_query($conexion,$sql);

  if(mysqli_num_rows($result) > 0){
    return 1;
  }else{
    return 0;
  }
}






          
          
          
          use PHPMailer\PHPMailer\PHPMailer;
          use PHPMailer\PHPMailer\Exception;
          
          require 'phpmailer/Exception.php';
          require 'phpmailer/PHPMailer.php';
          require 'phpmailer/SMTP.php';
     
          //Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'mincienciaeinovacion@gmail.com';                     //SMTP username
    $mail->Password   = 'yumi.loc';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('from@example.com', 'Mailer');
    $mail->addAddress('gaabii.alee.paez@gmail.com', 'Joe User');     //Add a recipient
    $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');

    //Attachments
    $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Prueba';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
    




?>