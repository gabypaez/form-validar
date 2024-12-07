
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





  


      QRcode::png("$dni","test.png");
          // Create an instance of the class:
          $mpdf = new \Mpdf\Mpdf();
          
          // Write some HTML code:
          $mpdf->WriteHTML('');
          
          $mpdf->Image('test.png', 10, 10, 20, 20, 'png', '', true, false);
          
          // Output a PDF file directly to the browser
          $mpdf->Output("entrada","I");

          //header('Location: index.php');


?>