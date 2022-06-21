<?php
require_once __DIR__.'/../config.php';

if (!$phpErrorReporting){
    error_reporting(E_ERROR | E_PARSE);
}

if (!empty($_GET["TID"])){
    require_once __DIR__.'/../server_oidc.php';
    $nuTransaction_id = $_GET["TID"];
    // $url = 'https://adocolumbia.ado-tech.com/Suntic/api/Suntic/Validation';
    $url = 'https://adocolombia-qa.ado-tech.com/SunticQA/api/SunticQA/Validation';
    $request_url = $url . '/' . $nuTransaction_id.'?returnImages=true';
    $curl = curl_init($request_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
    'apiKey: db92efc69991',
    'returnVideoLiveness: true',
    'returnDocuments:true'
    ]);

    $Resultado = json_decode(curl_exec($curl),true);
    curl_close($curl);

    $sbTransactionType= $Resultado["TransactionType"];
    if(!empty($sbTransactionType)){  //Enrolamiento & Verificación
        $storage_1->updateRecord($Resultado, array("CreationDate",
                                                    "AdoProjectId",
                                                    "ComparationFacesSuccesful",
                                                    "FaceFound",
                                                    "FaceDocumentFrontFound",
                                                    "BarcodeFound",
                                                    "Extras",
                                                    "NumberPhone",
                                                    "CodFingerprint",
                                                    "ResultQRCode",
                                                    "Images",
                                                    "Scores",
                                                    "Response_ANI"));  

    echo '<h3>Transacci&oacute;n '.$nuTransaction_id.' actualizada</h3><br>';
    }
}