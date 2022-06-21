<?php
// include our OAuth2 Server object
require_once __DIR__.'/server_oidc.php';
require_once __DIR__.'/config.php';
require_once __DIR__.'/MediaTool.php';
require_once __DIR__.'/firmagate.php';

$request = OAuth2\Request::createFromGlobals();
$response = new OAuth2\Response();

session_start(); 
$_SESSION['scope'] = $_GET['scope'];

if (!$EnADO_Verify){
    include('form.html');
    if (empty($_POST)){
        exit;
    }
}

$user = $_POST['person'];
$user['email'] = getEmail($user['IdNumber']);
if ($user['email'] == null){
	$user['email'] = "";
}

if ($onlyADO){ 
    if (($_SESSION['IdState'] == '14') || ($_SESSION['IdState'] == '2')){
        if ($EnADO_Verify){
            $storage_1->setUserV3($user); 
        }
        $user_s = $storage_1->getUser($user['IdNumber']);
    }
    else{
        header("Location: https://firmadoc.login.portal-id.com/");
        die;
    }
}
else{
    if ($EnADO_Verify){
        $storage_1->setUserV3($user); 
    }
    $user_s = $storage_1->getUser($user['IdNumber']);
}

$storage_4 = new OAuth2\Storage\Memory(array('user_credentials' => array($user_s['username'] => array('password' => $user_s['password']))));
$server->addStorage($storage_4, 'user_credentials');
$server->handleAuthorizeRequest($request, $response, true, $user_s['user_id']);

$response->send();
?>