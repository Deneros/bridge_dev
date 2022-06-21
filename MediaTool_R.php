<?php
function saveRecord($idN, $tId, $relFolder = false){
    require __DIR__.'/server_oidc.php';
    // $request_url = 'https://adocolumbia.ado-tech.com/Suntic/api/Suntic/Validation/'.$tId.'?returnImages=true';
    $request_url = 'https://adocolombia-qa.ado-tech.com/SunticQA/api/SunticQA/Validation/'.$tId.'?returnImages=true';
    $curl = curl_init($request_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
     'apiKey: db92efc69991',
     'returnVideoLiveness: true',
     'returnDocuments:true'
    ]);
    
	$JSON_R = curl_exec($curl);
    $Resultado = json_decode($JSON_R,true);
	
	$file = fopen('../JSON_Response/'.$tId.'.json', "w"); 
    fwrite($file, $JSON_R);
    fclose($file);
    
	$storage_1->setRecord($Resultado);
    curl_close($curl);
    
    session_start(); 
    $_SESSION['IdState'] = $Resultado['Extras']['IdState'];
    
	if ($relFolder){
    	$base_path = "../Records/";
    }
	else {
		$base_path = "Records/";
    }

    if (!is_dir($base_path.$idN)){
        mkdir($base_path.$idN, 0755);
    }
    if (!is_dir($base_path.$idN."/".$tId)){
        mkdir($base_path.$idN."/".$tId, 0755);
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
                         
    $path_record = $base_path.$idN."/".$tId."/";
    
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