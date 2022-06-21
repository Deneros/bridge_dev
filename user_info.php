<?php
// include our OAuth2 Server object
require_once __DIR__.'/server_oidc.php';
$request = OAuth2\Request::createFromGlobals();
$response = $server->handleUserInfoRequest($request);
$response->send();

//$rc = $server->getUserInfoController();
//$token = $rc->getToken();

//echo json_encode(array('Acceso' => $token['access_token'], 'message' => 'You accessed my APIs!'));
?>
