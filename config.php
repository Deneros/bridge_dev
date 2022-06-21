<?php
$onlyADO = true;                   //Deny access to unregistered users in ADO (Must be enabled on production)
$EnADO_Verify = true;              //Enable facial verification with ADO (Disable to OP testing without ADO)
$SaveRec = $EnADO_Verify && true;  //Enable recording of transactions on table "ado_records" from db. 
$production = false;				   //
$phpErrorReporting = true;        //Show the PHP and DB errors on browser.
?>