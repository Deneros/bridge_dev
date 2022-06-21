<?php
require_once __DIR__.'/../config.php';

if (!empty($phpErrorReporting)){          //if (!$phpErrorReporting){
    error_reporting(E_ERROR | E_PARSE);
}


require_once __DIR__.'/../server_oidc.php';

$nonUpdated = $storage_1->getRecord(0);

$fields = array("CreationDate",
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
                "Response_ANI");


$url = 'https://adocolumbia.ado-tech.com/Suntic/api/Suntic/Validation';
//$url = 'https://adocolombia-qa.ado-tech.com/SunticQA/api/SunticQA/Validation';

foreach($nonUpdated as $row){
    $nuTransaction_id = $row["TransactionId"];
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

    $storage_1->updateRecord($Resultado, $fields);
    echo '<h3>Transacci&oacute;n '.$nuTransaction_id.' actualizada</h3><br>';
}