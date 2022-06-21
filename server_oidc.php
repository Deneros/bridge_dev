<?php
// error reporting 
//ini_set('display_errors',1);error_reporting(E_ALL);

// Autoloading (composer is preferred, but for this example let's just do this)
require_once('OAuth2/Autoloader.php');
OAuth2\Autoloader::register();

// create storage object
$dsn      = 'mysql:dbname=bridge_destinatario;host=localhost';
$username = 'root';
$password = '*Suntic2021';
$storage_1 = new OAuth2\Storage\Pdo(array('dsn' => $dsn, 'username' => $username, 'password' => $password));

//$dsn_f = 'mysql:dbname=firmagate;host=18.207.243.253';
//$username_f = 'ldap_firmadoc';
//$password_f = '*SunticLDAP2021';
//$storage_1B = new OAuth2\Storage\Pdo(array('dsn' => $dsn_f, 'username' => $username_f, 'password' => $password_f));

// configure the server for OpenID Connect
$config['use_openid_connect'] = true;
$config['issuer'] = 'http://18.207.243.253/bridge_destinatario';

// create the server
$server = new OAuth2\Server($storage_1, $config);

//set supported scopes
$defaultScope = 'basic';
$supportedScopes = array('openid','profile');
$storage_2 = new OAuth2\Storage\Memory(array(
    'default_scope' => $defaultScope,
    'supported_scopes' => $supportedScopes
));
$scopeUtil = new OAuth2\Scope($storage_2);
$server->setScopeUtil($scopeUtil);

$publicKey  = file_get_contents('keys_oidc/public.pem');
$privateKey = file_get_contents('keys_oidc/private.pem');

// create storage
$storage_3 = new OAuth2\Storage\Memory(array('keys' => array(
    'public_key'  => $publicKey,
    'private_key' => $privateKey,
    'encryption_algorithm'  => 'RS384',
)));

$server->addStorage($storage_3, 'public_key');

?>