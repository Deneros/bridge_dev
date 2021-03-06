<?php
require_once __DIR__.'/../config.php';

if (!$phpErrorReporting){
    error_reporting(E_ERROR | E_PARSE);
}

require_once __DIR__.'/../server_oidc.php';

if ($production){
    $request_url = 'https://adocolumbia.ado-tech.com/Suntic/api/Suntic/Validation/'.$_GET['TID'].'?returnImages=true';
}
else {
    $request_url = 'https://adocolombia-qa.ado-tech.com/SunticQA/api/SunticQA/Validation/'.$_GET['TID'].'?returnImages=true';  
}
	
$curl = curl_init($request_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, [
 'apiKey: db92efc69991',
 'returnVideoLiveness: true',
 'returnDocuments:true'
]);

$Resultado = json_decode(curl_exec($curl),true);
$storage_1->updateRecord($Resultado, array("CreationDate",
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
                                            "Response_ANI"));  
curl_close($curl);

?>

<!DOCTYPE html>
<!-- saved from url=(0037)https://mg-local.login.portal-id.com/ -->
<html class=" grunticon"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>OneGate</title>

    <!--link href="theme_OG.css" rel="stylesheet" type="text/css"-->
    
    <link href="../mg-local/assets/css/open-sans.css" rel="stylesheet" type="text/css">
    <link href="../mg-local/assets/css/mobilityguard.css" rel="stylesheet" type="text/css">
    <link href="../mg-local/assets/css/theme.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="../mg-local/assets/svg-icons/grunticon/icons.data.svg.css" media="all"><script>
      /*! grunt-grunticon Stylesheet Loader - v2.1.6 | https://github.com/filamentgroup/grunticon | (c) 2015 Scott Jehl, Filament Group, Inc. | MIT license. */
      !function(){function e(e,n,t,o){"use strict";var r=window.document.createElement("link"),a=n||window.document.getElementsByTagName("script")[0],i=window.document.styleSheets;return r.rel="stylesheet",r.href=e,r.media="only x",o&&(r.onload=o),a.parentNode.insertBefore(r,a),r.onloadcssdefined=function(n){for(var t,o=0;o<i.length;o++)i[o].href&&i[o].href.indexOf(e)>-1&&(t=!0);t?n():setTimeout(function(){r.onloadcssdefined(n)})},r.onloadcssdefined(function(){r.media=t||"all"}),r}function n(e,n){e.onload=function(){e.onload=null,n&&n.call(e)},"isApplicationInstalled"in navigator&&"onloadcssdefined"in e&&e.onloadcssdefined(n)}!function(t){var o=function(r,a){"use strict";if(r&&3===r.length){var i=t.navigator,c=t.document,d=t.Image,s=!(!c.createElementNS||!c.createElementNS("http://www.w3.org/2000/svg","svg").createSVGRect||!c.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#Image","1.1")||t.opera&&-1===i.userAgent.indexOf("Chrome")||-1!==i.userAgent.indexOf("Series40")),l=new d;l.onerror=function(){o.method="png",o.href=r[2],e(r[2])},l.onload=function(){var t=1===l.width&&1===l.height,i=r[t&&s?0:t?1:2];t&&s?o.method="svg":t?o.method="datapng":o.method="png",o.href=i,n(e(i),a)},l.src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==",c.documentElement.className+=" grunticon"}};o.loadCSS=e,o.onloadCSS=n,t.grunticon=o}(this),function(e,n){"use strict";var t=n.document,o="grunticon:",r=function(e){if(t.attachEvent?"complete"===t.readyState:"loading"!==t.readyState)e();else{var n=!1;t.addEventListener("readystatechange",function(){n||(n=!0,e())},!1)}},a=function(e){return n.document.querySelector('link[href$="'+e+'"]')},i=function(e){var n,t,r,a,i,c,d={};if(n=e.sheet,!n)return d;t=n.cssRules?n.cssRules:n.rules;for(var s=0;s<t.length;s++)r=t[s].cssText,a=o+t[s].selectorText,i=r.split(");")[0].match(/US\-ASCII\,([^"']+)/),i&&i[1]&&(c=decodeURIComponent(i[1]),d[a]=c);return d},c=function(e){var n,r,a,i;a="data-grunticon-embed";for(var c in e){i=c.slice(o.length);try{n=t.querySelectorAll(i)}catch(d){continue}r=[];for(var s=0;s<n.length;s++)null!==n[s].getAttribute(a)&&r.push(n[s]);if(r.length)for(s=0;s<r.length;s++)r[s].innerHTML=e[c],r[s].style.backgroundImage="none",r[s].removeAttribute(a)}return r},d=function(n){"svg"===e.method&&r(function(){c(i(a(e.href))),"function"==typeof n&&n()})};e.embedIcons=c,e.getCSS=a,e.getIcons=i,e.ready=r,e.svgLoadedCallback=d,e.embedSVG=d}(grunticon,this)}();
      grunticon(["../mg-local/assets/svg-icons/grunticon/icons.data.svg.css", "../mg-local/assets/svg-icons/grunticon/icons.data.png.css", "../mg-local/assets/svg-icons/grunticon/icons.fallback.css"], grunticon.svgLoadedCallback);
    </script>
    <script language="JavaScript" type="text/javascript">
        function logoutMain(e) {
            try {
                e = e || window.event; // IE7
                if (window.opener && window.opener.tryLogout) {
                    e.preventDefault ? e.preventDefault() : (e.returnValue = false); // IE7
                    window.opener.tryLogout();
                } else if (window.opener && window.opener.parent && window.opener.parent.tryLogout) {
                    e.preventDefault ? e.preventDefault() : (e.returnValue = false); // IE7
                    window.opener.parent.tryLogout();
                } else if (window.parent && window.parent.tryLogout) {
                    e.preventDefault ? e.preventDefault() : (e.returnValue = false); // IE7
                    window.parent.tryLogout();
                } else {
                    if ("true" == "true" && !confirm("Usted esta por cerrar sesi??n desde OneGate...")) {
                        e.preventDefault ? e.preventDefault() : (e.returnValue = false); // IE7
                        return false;
                    } else {
                        return true;
                    }
                }

                return false;
            } catch(err) { }
            return true;
        }
        function setLang(lang) {
            document.location="mg-local/setlanguage?lang=" + lang;
        }
    </script>
    <noscript><link href="../mg-local/assets/svg-icons/grunticon/icons.fallback.css" rel="stylesheet"></noscript>
</head>

<body class="not-logged-in">

    <!-- Sticky footer -->
    <div class="page-wrap">

       <!-- Top -->
        <div class="top">

            <a class="logo" href="https://mg-local.login.portal-id.com/"><img src="../mg-local/assets/images/logo.svg" alt="OneGate"></a>

            <div class="language-selector">
                <label for="language">Seleccionar el idioma:</label>
                <select name="language" id="language" onchange="setLang(this.value);">
                    <option value="en">English</option><option value="sv">Svenska</option><option value="es" selected="">Espa??ol</option><option value="de">Deutsch</option><option value="fr">Fran??ais</option><option value="it">Italiano</option><option value="ru">??????????????</option>
                </select>
            </div>

        </div>


        <!-- Status bar -->
        <div class="status" style="display:none;;">

            <ul class="status-info">
                <li><a class="status-user" href="https://mg-local.login.portal-id.com/mg-local/userinfo"><div class="icon icon-home-1"></div> PARM{givenname} PARM{surname}</a></li>
                <li><a class="status-method" href="https://mg-local.login.portal-id.com/mg-local/userinfo"><div class="icon icon-lock-1"></div> unknown</a></li>
            </ul>

            <a class="status-logout" href="https://mg-local.login.portal-id.com/mg-local/logout" onclick="return logoutMain(event);"><div class="icon icon-logout-1"></div> Cerrar sesi??n</a>

        </div>
        <!-- Status bar End -->

        <!-- Content -->
        <div class="content">

            <!-- Status message -->
            <div class="box box--system-message" style="display:none;;">
                <p></p>
            </div>
            <!-- Status message End -->



        <!-- Box -->
        <div class="box box--login-options">
            <center>
                <?php
                if ($Resultado['Extras']['IdState'] == '2'){
                    echo "<h1 class=\"heading\">Su proceso de registro a finalizado con &eacute;xito</h1><br>";
                }
                else{
                    echo "<h1 class=\"heading\">Su proceso de registro no fue exitoso</h1><br>";
                }
                
                echo "<form action=\"http://18.207.243.253/bridge_destinatario/authorize.php?response_type=".$_SESSION['response_type']."&redirect_uri=".urlencode($_SESSION['redirect_uri'])."&client_id=".$_SESSION['client_id']."&nonce=".$_SESSION['nonce']."&state=".$_SESSION['state']."&scope=".$_SESSION['scope']."\" method=\"post\">";
                foreach($Resultado as $sbCampo=>$sbValor){
                    if($sbCampo=="Extras"){
                        foreach($sbValor as $sbCampo1=>$sbValor1 ){
                          echo "<input type=\"hidden\" name=\"person[Extras][".$sbCampo1."]\" value=\"".$sbValor1."\" />";
                        }
                    }
                    else{
                        echo "<input type=\"hidden\" name=\"person[".$sbCampo."]\" value=\"".$sbValor."\" />";
                    }
                }   
               
                //echo "<input id=\"endButton\" class=\"botons\" type=\"submit\" value=\"Finalizar\"/>";
                echo "</form>";
                
                echo '<button class="botons" onclick="close_tab()">Finalizar</button>'; 
                ?>
            </center>
            <div class="form-helper-text" style="display:none;">Olvid?? su contrase??a? <a href="https://mg-local.login.portal-id.com/mg-local/resetpassword-step1">Restablecer contrase??a </a>...</div>
        </div>
        <!-- Box End -->


        </div>
        <!-- Content End -->

    </div>
    <!-- Sticky footer End -->

    <!-- Footer -->
    <div class="footer">
      <p>
        <span class="footer--copyright">?? Copyright 2020 MobilityGuard </span>
      </p>
    </div>
    <!-- Footer End -->
    <script>
    function close_tab() {
    	if (confirm("Se le redireccionara para que haga la verificacion")) {
    		window.location.replace('https://destinatarioverify.login.portal-id.com');
            // window.close();
  		}
	}
	</script>
</body></html>