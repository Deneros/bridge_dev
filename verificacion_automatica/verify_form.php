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
                    if ("true" == "true" && !confirm("Usted esta por cerrar sesión desde OneGate...")) {
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
                    <option value="en">English</option><option value="sv">Svenska</option><option value="es" selected="">Español</option><option value="de">Deutsch</option><option value="fr">Français</option><option value="it">Italiano</option><option value="ru">Русский</option>
                </select>
            </div>

        </div>


        <!-- Status bar -->
        <div class="status" style="display:none;;">

            <ul class="status-info">
                <li><a class="status-user" href="https://mg-local.login.portal-id.com/mg-local/userinfo"><div class="icon icon-home-1"></div> PARM{givenname} PARM{surname}</a></li>
                <li><a class="status-method" href="https://mg-local.login.portal-id.com/mg-local/userinfo"><div class="icon icon-lock-1"></div> unknown</a></li>
            </ul>

            <a class="status-logout" href="https://mg-local.login.portal-id.com/mg-local/logout" onclick="return logoutMain(event);"><div class="icon icon-logout-1"></div> Cerrar sesión</a>

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
                <h1 class="heading">CONSULTA DE ESTADO DE CLIENTE</h1>
                <form name="formulario1" action="" method="post">
                <ul class="auth-methods">
                    <input type="hidden" name="apiKey" value="db92efc69991"/>
                    <?php require_once __DIR__.'/../config.php';
                    if ($production){ ?>
                        <input type="hidden" name="projectName" value="Suntic"/>
                    <?php }
                    else { ?>
                        <input type="hidden" name="projectName" value="SunticQA"/>
                    <?php } ?>
                    <label for="id_cliente">Digite su n&uacute;mero de identificaci&oacute;n:</label>
                    <input type="text" id="id_cliente" name="id_cliente" placeholder="Ejemplo: 1144xxxxxx" />
                    <li style=""><button type="submit" style="" value="submit">Aceptar</button></li>
                </ul>
                </form>
            </center><br>
            <p>Inicialmente, se debe confirmar si usted se encuentra enrolado. De ser así, usted será redirigido a la interfaz de verificación, 
            en donde realizará el proceso de autenticación. Si usted no se encuentra enrolado, se le solicitará realizar el proceso de enrolamiento.</p>
            
            <p>*Enrolar: Proceso en el cual la persona realiza el registro de su información (incluyendo anexos) para garantizar que es la persona 
            quien dice ser y su información quede disponible para que luego pueda hacer el proceso de verificación.</p>
            
            <p>*Verificar: Proceso en el cual la persona se autentica de manera rápida para certificar que es quien dice ser.</p>
            <div class="form-helper-text" style="display:none;">Olvidó su contraseña? <a href="https://mg-local.login.portal-id.com/mg-local/resetpassword-step1">Restablecer contraseña </a>...</div>
        </div>
        <!-- Box End -->


        </div>
        <!-- Content End -->

    </div>
    <!-- Sticky footer End -->

    <!-- Footer -->
    <div class="footer">
      <p>
        <span class="footer--copyright">© Copyright 2020 MobilityGuard </span>
      </p>
    </div>
    <!-- Footer End -->

</body></html>