<?php
function downBagCounter($bolsaid, $enroll_verify){
    require __DIR__.'/server_oidc.php';
    $bolsa = $storage_1->getBolsa($bolsaid); 
    
	if ($enroll_verify == '1'){
        $newValue = intval($bolsa['EnrollCount']) + 1;
        $newBalance = intval($bolsa['saldo']) - 1;
    }
    elseif ($enroll_verify == '2'){
        $newValue = intval($bolsa['VerifyCount']) + 1;
        $newBalance = intval($bolsa['saldo']);
    }
    
    $objDateTime = new DateTime('NOW');
    $dateTime = $objDateTime->format('Y-m-d H:i:s');
    $storage_1->setBolsa($bolsaid, $enroll_verify, $newBalance, $newValue, $dateTime); 
}
?>