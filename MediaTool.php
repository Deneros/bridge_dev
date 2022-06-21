<?php
function saveRecord($Resultado, $relFolder = false){
    require __DIR__.'/server_oidc.php';
    
	$storage_1->setRecord($Resultado);
    
    session_start(); 
    $_SESSION['IdState'] = $Resultado['Extras']['IdState'];
    
	if ($relFolder){
    	$base_path = "../Records/";
    }
	else {
		$base_path = "Records/";
    }

    if (!is_dir($base_path.$Resultado['IdNumber'])){
        mkdir($base_path.$Resultado['IdNumber'], 0755);
    }
    if (!is_dir($base_path.$Resultado['IdNumber']."/".$Resultado['TransactionId'])){
        mkdir($base_path.$Resultado['IdNumber']."/".$Resultado['TransactionId'], 0755);
    }
    
    $nameMapping = array(1=>'frontDocument',
                         2=>'rearDocument',
                         3=>'clientFace',
                         4=>'fingerprint_1',
                         5=>'fingerprint_2',
                         6=>'signature',
                         7=>'otherDocuments_1',
                         8=>'otherDocuments_2',
                         9=>'otherDocuments_3',
                         10=>'otherDocuments_4',
                         11=>'externalServiceClient',
                         12=>'croppedFaceDocument',
                         13=>'croppedSignatureDocument',
                         14=>'ghostCroppedDocument',
                         15=>'fingerprintCroppedDocument',
                         16=>'barcodeCroppedDocument',
                         17=>'frontCroppedDocument',
                         18=>'rearCroppedDocument',
                         19=>'verifiedClient',
                         20=>'liveness');
                         
    $path_record = $base_path.$Resultado['IdNumber']."/".$Resultado['TransactionId']."/";
    
    foreach($Resultado['Images'] as $sbItem){
        $extType = '.png';
        if ($sbItem["ImageTypeId"] == 20){
            $extType = '.mp4';
        }
        $file = fopen($path_record.$nameMapping[$sbItem["ImageTypeId"]].$extType, "w"); 
        fwrite($file, base64_decode($sbItem['Image']));
        fclose($file);
    }

}
?>