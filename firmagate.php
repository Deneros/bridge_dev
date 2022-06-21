<?php

function getEmail($document)
{
	$request_url = 'http://18.207.243.253/getEmail.php?doc='.$document;
	$curl = curl_init($request_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
	$JSON_R = curl_exec($curl);
    $Resultado = json_decode($JSON_R,true);
	curl_close($curl);

	$email = $Resultado['email'];
	return $email;
}