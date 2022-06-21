<?php
session_start();
$_SESSION['response_type'] = $_GET['response_type'];
$_SESSION['redirect_uri'] = $_GET['redirect_uri'];
$_SESSION['client_id'] = $_GET['client_id'];
$_SESSION['nonce'] = $_GET['nonce'];
$_SESSION['state'] = $_GET['state'];
$_SESSION['scope'] = $_GET['scope'];

if(!empty($_POST["apiKey"])){
    require __DIR__.'/../config.php';
    $ProjectName = $_POST["projectName"];
    $sbKey = $_POST["apiKey"];
    $sbcliente = $_POST["id_cliente"];
   
    if ($production){
        $url = 'https://adocolumbia.ado-tech.com/'.$ProjectName.'/api/'.$ProjectName.'/FindByNumberIdSuccess';
    }
    else {
        $url = 'https://adocolombia-qa.ado-tech.com/'.$ProjectName.'/api/'.$ProjectName.'/FindByNumberIdSuccess';
    }
                   
   $docType = '1';//$_POST["id_tran"];
   $request_url = $url . '?identification='.$sbcliente.'&docType='.$docType.'&returnImages=true&enrol=true';
   $curl = curl_init($request_url);
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($curl, CURLOPT_HTTPHEADER, [
     'apiKey: '.$sbKey.'',
     'returnImages:true'
   ]);

   $response = curl_exec($curl);
   curl_close($curl);
   
   //Decodifico el json que trae la informacion
   $Resultado = json_decode($response,true);

   /*Si pinta el resultado de la consulta
   $sbHtml = fncPintarResultado($Resultado);
   echo $sbHtml;
   */
   
   if ($Resultado["Extras"]["IdState"] == '2'){ 
       
        echo "<script type=\"text/javascript\">window.alert(\"Usuario registrado: se procederá a verificar su identidad mediante reconocimiento facial\");</script>";
        
        if ($production){
            echo "<form id=\"verifyForm\" action=\"https://adocolumbia.ado-tech.com/Suntic/verificar-persona\" method=\"post\">";
        }
        else {
            echo "<form id=\"verifyForm\" action=\"https://adocolombia-qa.ado-tech.com/SunticQA/verificar-persona\" method=\"post\">";
        }
        echo "<input type=\"hidden\" name=\"Callback\" value=\"http://18.207.243.253/bridge_destinatario/respuesta\"/>";
        echo "<input type=\"hidden\" name=\"Key\" value=\"".$sbKey."\"/>";
        echo "<input type=\"hidden\" name=\"projectName\" value=\"".$ProjectName."\"/>";
        echo "<input type=\"hidden\" name=\"documentType\" value=\"1\"/>";
        echo "<input type=\"hidden\" name=\"identificationNumber\" value=\"".$sbcliente."\" />";
        echo "</form>";
        
        echo "<script>document.getElementById(\"verifyForm\").submit();</script>";
   }
   else {
       echo "<script type=\"text/javascript\">window.alert(\"Usuario no registrado: por favor, realizar el proceso de enrolamiento\");</script>";
       
        if ($production){
            echo "<form id=\"validateForm\" action=\"https://adocolumbia.ado-tech.com/Suntic/validar-persona\" method=\"post\">";
        }
        else {
            echo "<form id=\"validateForm\" action=\"https://adocolombia-qa.ado-tech.com/SunticQA/validar-persona\" method=\"post\">";
        }
        echo "<input type=\"hidden\" name=\"Callback\" value=\"http://18.207.243.253/bridge_destinatario/respuesta\"/>";
        echo "<input type=\"hidden\" name=\"Key\" value=\"".$sbKey."\"/>";
        echo "<input type=\"hidden\" name=\"projectName\" value=\"".$ProjectName."\"/>";
        echo "<input type=\"hidden\" name=\"documentType\" value=\"1\"/>";
        echo "<input type=\"hidden\" name=\"identificationNumber\" value=\"".$sbcliente."\" />";
        echo "</form>";
        
        echo "<script>document.getElementById(\"validateForm\").submit();</script>";
   }
}
else {
    include_once("verify_form.php");
}

?>