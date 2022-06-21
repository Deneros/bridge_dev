<?php

include('json.php');
require_once __DIR__.'/../../config.php';

use \Simple\json;
   
// $url_base = "https://verify.portal-id.com/bridge";
$url_base = "http://18.207.243.253/bridge_destinatario";

$json = new json();

$json->issuer = $url_base;

if ($EnADO_Verify){
    $json->authorization_endpoint = $url_base."/verificar";
}
else{
    $json->authorization_endpoint = $url_base."/authorize.php"; 
}

$json->token_endpoint = $url_base."/token.php";
$json->userinfo_endpoint = $url_base."/user_info.php";
$json->jwks_uri = $url_base."/.well-known/jwks.json";
$json->response_types_supported = array("code",
                                        "id_token",
                                        "token id_token",
                                        "code token",
                                        "code id_token",
                                        "token id_token",
                                        "code token id_token",
                                        "none");
$json->subject_types_supported = array("public");
$json->id_token_signing_alg_values_supported = array("RS384");
$json->scopes_supported = array("openid",
                                "profile");
$json->token_endpoint_auth_methods_supported = array("client_secret_post","client_secret_basic");
$json->claims_supported = array("name",
                                "given_name",
                                "family_name",
                                "picture",
                                "locale",
                                "Uid");
$json->code_challenge_methods_supported = array("plain","S384");
$json->grant_types_supported = array("authorization_code","refresh_token");

$json->send();
?>