<?php
include('../controllers/infoSystem.php');

$objInfoSystem = new InfoSystem();
$result = $objInfoSystem->GetUser($_POST['strData']);
$result = base64_decode($result);
$result = json_decode($result);
if ($result->desc > 0){
    //echo('Este correo electronico ya existe, por favor ingrese otro')
    $arrJson = array("code"=>"200", "desc"=>"El correo electronico ya existe");
    $strEcho = json_encode($arrJson);
    $strEcho = base64_encode($strEcho);
    echo($strEcho);

} else{
    $objInfoSystem->NewUser($_POST['strData']);
    //$redirect = '../views/home.php';
    //header("Location: $redirect");
    $arrJson = array("code"=>"201", "desc"=>"../views/home.php");
    $strEcho = json_encode($arrJson);
    $strEcho = base64_encode($strEcho);
    echo($strEcho);
}

?>