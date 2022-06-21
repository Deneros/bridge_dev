<?php

if (!isset($this->NM_ajax_info['param']['buffer_output']) || !$this->NM_ajax_info['param']['buffer_output'])
{
    $sOBContents = ob_get_contents();
    ob_end_clean();
}

header("X-XSS-Protection: 1; mode=block");
header("X-Frame-Options: SAMEORIGIN");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">

<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmi_title'] . " " . $this->Ini->Nm_lang['lang_tbl_ado_records'] . ""); } else { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_title'] . " " . $this->Ini->Nm_lang['lang_tbl_ado_records'] . ""); } ?></TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT" />
 <META http-equiv="Last-Modified" content="<?php echo gmdate('D, d M Y H:i:s') ?> GMT" />
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate" />
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0" />
 <META http-equiv="Pragma" content="no-cache" />
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
<?php

if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
{
?>
 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
}

?>
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox.css" type="text/css" media="screen" />
 <SCRIPT type="text/javascript">
  var sc_pathToTB = '<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/';
  var sc_tbLangClose = "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_tb_close"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>";
  var sc_tbLangEsc = "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_tb_esc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>";
  var sc_userSweetAlertDisplayed = false;
 </SCRIPT>
 <SCRIPT type="text/javascript">
  var sc_blockCol = '<?php echo $this->Ini->Block_img_col; ?>';
  var sc_blockExp = '<?php echo $this->Ini->Block_img_exp; ?>';
  var sc_ajaxBg = '<?php echo $this->Ini->Color_bg_ajax; ?>';
  var sc_ajaxBordC = '<?php echo $this->Ini->Border_c_ajax; ?>';
  var sc_ajaxBordS = '<?php echo $this->Ini->Border_s_ajax; ?>';
  var sc_ajaxBordW = '<?php echo $this->Ini->Border_w_ajax; ?>';
  var sc_ajaxMsgTime = 2;
  var sc_img_status_ok = '<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Img_status_ok; ?>';
  var sc_img_status_err = '<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Img_status_err; ?>';
  var sc_css_status = '<?php echo $this->Ini->Css_status; ?>';
  var sc_css_status_pwd_box = '<?php echo $this->Ini->Css_status_pwd_box; ?>';
  var sc_css_status_pwd_text = '<?php echo $this->Ini->Css_status_pwd_text; ?>';
 </SCRIPT>
        <SCRIPT type="text/javascript" src="../_lib/lib/js/jquery-3.6.0.min.js"></SCRIPT>
<input type="hidden" id="sc-mobile-lock" value='true' />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery/js/jquery-ui.js"></SCRIPT>
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery/css/smoothness/jquery-ui.css" type="text/css" media="screen" />
 <script type="text/javascript" src="<?php echo $this->Ini->url_lib_js ?>frameControl.js"></script>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.iframe-transport.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.fileupload.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/malsup-blockui/jquery.blockUI.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/thickbox/thickbox-compressed.js"></SCRIPT>
<style type="text/css">
.sc-button-image.disabled {
	opacity: 0.25
}
.sc-button-image.disabled img {
	cursor: default !important
}
</style>
 <style type="text/css">
  .fileinput-button-padding {
   padding: 3px 10px !important;
  }
  .fileinput-button {
   position: relative;
   overflow: hidden;
   float: left;
   margin-right: 4px;
  }
  .fileinput-button input {
   position: absolute;
   top: 0;
   right: 0;
   margin: 0;
   border: solid transparent;
   border-width: 0 0 100px 200px;
   opacity: 0;
   filter: alpha(opacity=0);
   -moz-transform: translate(-300px, 0) scale(4);
   direction: ltr;
   cursor: pointer;
  }
 </style>
<?php
$miniCalendarFA = $this->jqueryFAFile('calendar');
if ('' != $miniCalendarFA) {
?>
<style type="text/css">
.css_read_off_startingdate button {
	background-color: transparent;
	border: 0;
	padding: 0
}
.css_read_off_creationdate button {
	background-color: transparent;
	border: 0;
	padding: 0
}
.css_read_off_birthdate button {
	background-color: transparent;
	border: 0;
	padding: 0
}
.css_read_off_dateofidentification button {
	background-color: transparent;
	border: 0;
	padding: 0
}
.css_read_off_dateofdeath button {
	background-color: transparent;
	border: 0;
	padding: 0
}
.css_read_off_marriagedate button {
	background-color: transparent;
	border: 0;
	padding: 0
}
.css_read_off_issuedate button {
	background-color: transparent;
	border: 0;
	padding: 0
}
</style>
<?php
}
?>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>scInput.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.scInput.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.scInput2.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.fieldSelection.js"></SCRIPT>
 <?php
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['embutida_pdf']))
 {
 ?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_form.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_form<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
  <?php 
  if(isset($this->Ini->str_google_fonts) && !empty($this->Ini->str_google_fonts)) 
  { 
  ?> 
  <link href="<?php echo $this->Ini->str_google_fonts ?>" rel="stylesheet" /> 
  <?php 
  } 
  ?> 
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_appdiv.css" /> 
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_appdiv<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_tab.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_tab<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/buttons/<?php echo $this->Ini->Str_btn_form . '/' . $this->Ini->Str_btn_form ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_calendar.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_calendar<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
<?php
   include_once("../_lib/css/" . $this->Ini->str_schema_all . "_tab.php");
 }
?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_ado_records_admon/form_ado_records_admon_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = false;
var scFocusFirstErrorName  = "<?php echo $this->scFormFocusErrorName; ?>";
</script>

<?php
include_once("form_ado_records_admon_sajax_js.php");
?>
<script type="text/javascript">
if (document.getElementById("id_error_display_fixed"))
{
 scCenterFixedElement("id_error_display_fixed");
}
var posDispLeft = 0;
var posDispTop = 0;
var Nm_Proc_Atualiz = false;
function findPos(obj)
{
 var posCurLeft = posCurTop = 0;
 if (obj.offsetParent)
 {
  posCurLeft = obj.offsetLeft
  posCurTop = obj.offsetTop
  while (obj = obj.offsetParent)
  {
   posCurLeft += obj.offsetLeft
   posCurTop += obj.offsetTop
  }
 }
 posDispLeft = posCurLeft - 10;
 posDispTop = posCurTop + 30;
}
var Nav_permite_ret = "<?php if ($this->Nav_permite_ret) { echo 'S'; } else { echo 'N'; } ?>";
var Nav_permite_ava = "<?php if ($this->Nav_permite_ava) { echo 'S'; } else { echo 'N'; } ?>";
var Nav_binicio     = "<?php echo $this->arr_buttons['binicio']['type']; ?>";
var Nav_bavanca     = "<?php echo $this->arr_buttons['bavanca']['type']; ?>";
var Nav_bretorna    = "<?php echo $this->arr_buttons['bretorna']['type']; ?>";
var Nav_bfinal      = "<?php echo $this->arr_buttons['bfinal']['type']; ?>";
var Nav_binicio_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_disabled']['first']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_disabled']['first'] : 'off'); ?>";
var Nav_bavanca_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_disabled']['forward']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_disabled']['forward'] : 'off'); ?>";
var Nav_bretorna_macro_disabled = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_disabled']['back']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_disabled']['back'] : 'off'); ?>";
var Nav_bfinal_macro_disabled   = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_disabled']['last']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_disabled']['last'] : 'off'); ?>";
function nav_atualiza(str_ret, str_ava, str_pos)
{
<?php
 if (isset($this->NM_btn_navega) && 'N' == $this->NM_btn_navega)
 {
     echo " return;";
 }
 else
 {
?>
 if ('S' == str_ret)
 {
<?php
    if ($this->nmgp_botoes['first'] == "on")
    {
?>
       if ("off" == Nav_binicio_macro_disabled) { $("#sc_b_ini_" + str_pos).prop("disabled", false).removeClass("disabled"); }
<?php
    }
    if ($this->nmgp_botoes['back'] == "on")
    {
?>
       if ("off" == Nav_bretorna_macro_disabled) { $("#sc_b_ret_" + str_pos).prop("disabled", false).removeClass("disabled"); }
<?php
    }
?>
 }
 else
 {
<?php
    if ($this->nmgp_botoes['first'] == "on")
    {
?>
       $("#sc_b_ini_" + str_pos).prop("disabled", true).addClass("disabled");
<?php
    }
    if ($this->nmgp_botoes['back'] == "on")
    {
?>
       $("#sc_b_ret_" + str_pos).prop("disabled", true).addClass("disabled");
<?php
    }
?>
 }
 if ('S' == str_ava)
 {
<?php
    if ($this->nmgp_botoes['last'] == "on")
    {
?>
       if ("off" == Nav_bfinal_macro_disabled) { $("#sc_b_fim_" + str_pos).prop("disabled", false).removeClass("disabled"); }
<?php
    }
    if ($this->nmgp_botoes['forward'] == "on")
    {
?>
       if ("off" == Nav_bavanca_macro_disabled) { $("#sc_b_avc_" + str_pos).prop("disabled", false).removeClass("disabled"); }
<?php
    }
?>
 }
 else
 {
<?php
    if ($this->nmgp_botoes['last'] == "on")
    {
?>
       $("#sc_b_fim_" + str_pos).prop("disabled", true).addClass("disabled");
<?php
    }
    if ($this->nmgp_botoes['forward'] == "on")
    {
?>
       $("#sc_b_avc_" + str_pos).prop("disabled", true).addClass("disabled");
<?php
    }
?>
 }
<?php
  }
?>
}
function nav_liga_img()
{
 sExt = sImg.substr(sImg.length - 4);
 sImg = sImg.substr(0, sImg.length - 4);
 if ('_off' == sImg.substr(sImg.length - 4))
 {
  sImg = sImg.substr(0, sImg.length - 4);
 }
 sImg += sExt;
}
function nav_desliga_img()
{
 sExt = sImg.substr(sImg.length - 4);
 sImg = sImg.substr(0, sImg.length - 4);
 if ('_off' != sImg.substr(sImg.length - 4))
 {
  sImg += '_off';
 }
 sImg += sExt;
}
function summary_atualiza(reg_ini, reg_qtd, reg_tot)
{
    nm_sumario = "[<?php echo substr($this->Ini->Nm_lang['lang_othr_smry_info'], strpos($this->Ini->Nm_lang['lang_othr_smry_info'], "?final?")) ?>]";
    nm_sumario = nm_sumario.replace("?final?", reg_qtd);
    nm_sumario = nm_sumario.replace("?total?", reg_tot);
    if (reg_qtd < 1) {
        nm_sumario = "";
    }
    if (document.getElementById("sc_b_summary_b")) document.getElementById("sc_b_summary_b").innerHTML = nm_sumario;
}
function navpage_atualiza(str_navpage)
{
    if (document.getElementById("sc_b_navpage_b")) document.getElementById("sc_b_navpage_b").innerHTML = str_navpage;
}
<?php

include_once('form_ado_records_admon_jquery.php');

?>
var applicationKeys = "";
applicationKeys += "ctrl+shift+right";
applicationKeys += ",";
applicationKeys += "ctrl+shift+left";
applicationKeys += ",";
applicationKeys += "ctrl+right";
applicationKeys += ",";
applicationKeys += "ctrl+left";
applicationKeys += ",";
applicationKeys += "alt+q";
applicationKeys += ",";
applicationKeys += "escape";
applicationKeys += ",";
applicationKeys += "ctrl+enter";
applicationKeys += ",";
applicationKeys += "ctrl+s";
applicationKeys += ",";
applicationKeys += "ctrl+delete";
applicationKeys += ",";
applicationKeys += "f1";
applicationKeys += ",";
applicationKeys += "ctrl+shift+c";

var hotkeyList = "";

function execHotKey(e, h) {
    var hotkey_fired = false;
  switch (true) {
    case (["ctrl+shift+right"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_fim");
      break;
    case (["ctrl+shift+left"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_ini");
      break;
    case (["ctrl+right"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_ava");
      break;
    case (["ctrl+left"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_ret");
      break;
    case (["alt+q"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_sai");
      break;
    case (["escape"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_cnl");
      break;
    case (["ctrl+enter"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_inc");
      break;
    case (["ctrl+s"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_alt");
      break;
    case (["ctrl+delete"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_exc");
      break;
    case (["f1"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_webh");
      break;
    case (["ctrl+shift+c"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_copy");
      break;
    default:
      return true;
  }
  if (hotkey_fired) {
        e.preventDefault();
        return false;
    } else {
        return true;
    }
}
</script>

<script type="text/javascript" src="<?php echo $this->Ini->url_lib_js ?>hotkeys.inc.js"></script>
<script type="text/javascript" src="<?php echo $this->Ini->url_lib_js ?>hotkeys_setup.js"></script>
<script type="text/javascript" src="<?php echo $this->Ini->url_lib_js ?>frameControl.js"></script>
<script type="text/javascript">

function process_hotkeys(hotkey)
{
  if (hotkey == "sys_format_fim") {
    if (typeof scBtnFn_sys_format_fim !== "undefined" && typeof scBtnFn_sys_format_fim === "function") {
      scBtnFn_sys_format_fim();
        return true;
    }
  }
  if (hotkey == "sys_format_ini") {
    if (typeof scBtnFn_sys_format_ini !== "undefined" && typeof scBtnFn_sys_format_ini === "function") {
      scBtnFn_sys_format_ini();
        return true;
    }
  }
  if (hotkey == "sys_format_ava") {
    if (typeof scBtnFn_sys_format_ava !== "undefined" && typeof scBtnFn_sys_format_ava === "function") {
      scBtnFn_sys_format_ava();
        return true;
    }
  }
  if (hotkey == "sys_format_ret") {
    if (typeof scBtnFn_sys_format_ret !== "undefined" && typeof scBtnFn_sys_format_ret === "function") {
      scBtnFn_sys_format_ret();
        return true;
    }
  }
  if (hotkey == "sys_format_sai") {
    if (typeof scBtnFn_sys_format_sai !== "undefined" && typeof scBtnFn_sys_format_sai === "function") {
      scBtnFn_sys_format_sai();
        return true;
    }
  }
  if (hotkey == "sys_format_cnl") {
    if (typeof scBtnFn_sys_format_cnl !== "undefined" && typeof scBtnFn_sys_format_cnl === "function") {
      scBtnFn_sys_format_cnl();
        return true;
    }
  }
  if (hotkey == "sys_format_inc") {
    if (typeof scBtnFn_sys_format_inc !== "undefined" && typeof scBtnFn_sys_format_inc === "function") {
      scBtnFn_sys_format_inc();
        return true;
    }
  }
  if (hotkey == "sys_format_alt") {
    if (typeof scBtnFn_sys_format_alt !== "undefined" && typeof scBtnFn_sys_format_alt === "function") {
      scBtnFn_sys_format_alt();
        return true;
    }
  }
  if (hotkey == "sys_format_exc") {
    if (typeof scBtnFn_sys_format_exc !== "undefined" && typeof scBtnFn_sys_format_exc === "function") {
      scBtnFn_sys_format_exc();
        return true;
    }
  }
  if (hotkey == "sys_format_webh") {
    if (typeof scBtnFn_sys_format_webh !== "undefined" && typeof scBtnFn_sys_format_webh === "function") {
      scBtnFn_sys_format_webh();
        return true;
    }
  }
  if (hotkey == "sys_format_copy") {
    if (typeof scBtnFn_sys_format_copy !== "undefined" && typeof scBtnFn_sys_format_copy === "function") {
      scBtnFn_sys_format_copy();
        return true;
    }
  }
    return false;
}

 var Dyn_Ini  = true;
 $(function() {

  scJQElementsAdd('');

  scJQGeneralAdd();

  $('#SC_fast_search_t').keyup(function(e) {
   scQuickSearchKeyUp('t', e);
  });

  $(document).bind('drop dragover', function (e) {
      e.preventDefault();
  });

  var i, iTestWidth, iMaxLabelWidth = 0, $labelList = $(".scUiLabelWidthFix");
  for (i = 0; i < $labelList.length; i++) {
    iTestWidth = $($labelList[i]).width();
    sTestWidth = iTestWidth + "";
    if ("" == iTestWidth) {
      iTestWidth = 0;
    }
    else if ("px" == sTestWidth.substr(sTestWidth.length - 2)) {
      iTestWidth = parseInt(sTestWidth.substr(0, sTestWidth.length - 2));
    }
    iMaxLabelWidth = Math.max(iMaxLabelWidth, iTestWidth);
  }
  if (0 < iMaxLabelWidth) {
    $(".scUiLabelWidthFix").css("width", iMaxLabelWidth + "px");
  }
<?php
if (!$this->NM_ajax_flag && isset($this->NM_non_ajax_info['ajaxJavascript']) && !empty($this->NM_non_ajax_info['ajaxJavascript']))
{
    foreach ($this->NM_non_ajax_info['ajaxJavascript'] as $aFnData)
    {
?>
  <?php echo $aFnData[0]; ?>(<?php echo implode(', ', $aFnData[1]); ?>);

<?php
    }
}
?>
 });

   $(window).on('load', function() {
     if ($('#t').length>0) {
         scQuickSearchKeyUp('t', null);
     }
   });
   function scQuickSearchSubmit_t() {
     nm_move('fast_search', 't');
   }

   function scQuickSearchKeyUp(sPos, e) {
     if (null != e) {
       var keyPressed = e.charCode || e.keyCode || e.which;
       if (13 == keyPressed) {
         if ('t' == sPos) scQuickSearchSubmit_t();
       }
       else
       {
           $('#SC_fast_search_submit_'+sPos).show();
       }
     }
   }
   function nm_gp_submit_qsearch(pos)
   {
        nm_move('fast_search', pos);
   }
   function nm_gp_open_qsearch_div(pos)
   {
        if (typeof nm_gp_open_qsearch_div_mobile == 'function') {
            return nm_gp_open_qsearch_div_mobile(pos);
        }
        if($('#SC_fast_search_dropdown_' + pos).hasClass('fa-caret-down'))
        {
            if(($('#quicksearchph_' + pos).offset().top+$('#id_qs_div_' + pos).height()+10) >= $(document).height())
            {
                $('#id_qs_div_' + pos).offset({top:($('#quicksearchph_' + pos).offset().top-($('#quicksearchph_' + pos).height()/2)-$('#id_qs_div_' + pos).height()-4)});
            }

            nm_gp_open_qsearch_div_store_temp(pos);
            $('#SC_fast_search_dropdown_' + pos).removeClass('fa-caret-down').addClass('fa-caret-up');
        }
        else
        {
            $('#SC_fast_search_dropdown_' + pos).removeClass('fa-caret-up').addClass('fa-caret-down');
        }
        $('#id_qs_div_' + pos).toggle();
   }

   var tmp_qs_arr_fields = [], tmp_qs_arr_cond = "";
   function nm_gp_open_qsearch_div_store_temp(pos)
   {
        tmp_qs_arr_fields = [], tmp_qs_str_cond = "";

        if($('#fast_search_f0_' + pos).prop('type') == 'select-multiple')
        {
            tmp_qs_arr_fields = $('#fast_search_f0_' + pos).val();
        }
        else
        {
            tmp_qs_arr_fields.push($('#fast_search_f0_' + pos).val());
        }

        tmp_qs_str_cond = $('#cond_fast_search_f0_' + pos).val();
   }

   function nm_gp_cancel_qsearch_div_store_temp(pos)
   {
        $('#fast_search_f0_' + pos).val('');
        $("#fast_search_f0_" + pos + " option").prop('selected', false);
        for(it=0; it<tmp_qs_arr_fields.length; it++)
        {
            $("#fast_search_f0_" + pos + " option[value='"+ tmp_qs_arr_fields[it] +"']").prop('selected', true);
        }
        $("#fast_search_f0_" + pos).change();
        tmp_qs_arr_fields = [];

        $('#cond_fast_search_f0_' + pos).val(tmp_qs_str_cond);
        $('#cond_fast_search_f0_' + pos).change();
        tmp_qs_str_cond = "";

        nm_gp_open_qsearch_div(pos);
   } if($(".sc-ui-block-control").length) {
  preloadBlock = new Image();
  preloadBlock.src = "<?php echo $this->Ini->path_icones; ?>/" + sc_blockExp;
 }

 var show_block = {
  
 };

 function toggleBlock(e) {
  var block = e.data.block,
      block_id = $(block).attr("id");
      block_img = $("#" + block_id + " .sc-ui-block-control");

  if (1 >= block.rows.length) {
   return;
  }

  show_block[block_id] = !show_block[block_id];

  if (show_block[block_id]) {
    $(block).css("height", "100%");
    if (block_img.length) block_img.attr("src", changeImgName(block_img.attr("src"), sc_blockCol));
  }
  else {
    $(block).css("height", "");
    if (block_img.length) block_img.attr("src", changeImgName(block_img.attr("src"), sc_blockExp));
  }

  for (var i = 1; i < block.rows.length; i++) {
   if (show_block[block_id])
    $(block.rows[i]).show();
   else
    $(block.rows[i]).hide();
  }

  if (show_block[block_id]) {
  }
 }

 function changeImgName(imgOld, imgNew) {
   var aOld = imgOld.split("/");
   aOld.pop();
   aOld.push(imgNew);
   return aOld.join("/");
 }

</script>
</HEAD>
<?php
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['recarga'];
}
    $remove_margin = '';
    $remove_border = '';
    $vertical_center = '';
?>
<body class="scFormPage sc-app-form" style="<?php echo $remove_margin . $str_iframe_body . $vertical_center; ?>">
<?php

if (!isset($this->NM_ajax_info['param']['buffer_output']) || !$this->NM_ajax_info['param']['buffer_output'])
{
    echo $sOBContents;
}

?>
<div id="idJSSpecChar" style="display: none;"></div>
<script type="text/javascript">
function NM_tp_critica(TP)
{
    if (TP == 0 || TP == 1 || TP == 2)
    {
        nmdg_tipo_crit = TP;
    }
}
</script> 
<?php
 include_once("form_ado_records_admon_js0.php");
?>
<script type="text/javascript"> 
 function setLocale(oSel)
 {
  var sLocale = "";
  if (-1 < oSel.selectedIndex)
  {
   sLocale = oSel.options[oSel.selectedIndex].value;
  }
  document.F1.nmgp_idioma_novo.value = sLocale;
 }
 function setSchema(oSel)
 {
  var sLocale = "";
  if (-1 < oSel.selectedIndex)
  {
   sLocale = oSel.options[oSel.selectedIndex].value;
  }
  document.F1.nmgp_schema_f.value = sLocale;
 }
 </script>
<form  name="F1" method="post" 
               action="./" 
               target="_self">
<input type="hidden" name="nmgp_url_saida" value="">
<?php
if ('novo' == $this->nmgp_opcao || 'incluir' == $this->nmgp_opcao)
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['insert_validation'] = md5(time() . rand(1, 99999));
?>
<input type="hidden" name="nmgp_ins_valid" value="<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['insert_validation']; ?>">
<?php
}
?>
<input type="hidden" name="nm_form_submit" value="1">
<input type="hidden" name="nmgp_idioma_novo" value="">
<input type="hidden" name="nmgp_schema_f" value="">
<input type="hidden" name="nmgp_opcao" value="">
<input type="hidden" name="nmgp_ancora" value="">
<input type="hidden" name="nmgp_num_form" value="<?php  echo $this->form_encode_input($nmgp_num_form); ?>">
<input type="hidden" name="nmgp_parms" value="">
<input type="hidden" name="script_case_init" value="<?php  echo $this->form_encode_input($this->Ini->sc_page); ?>">
<input type="hidden" name="NM_cancel_return_new" value="<?php echo $this->NM_cancel_return_new ?>">
<input type="hidden" name="csrf_token" value="<?php echo $this->scCsrfGetToken() ?>" />
<input type="hidden" name="_sc_force_mobile" id="sc-id-mobile-control" value="" />
<?php
$_SESSION['scriptcase']['error_span_title']['form_ado_records_admon'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_ado_records_admon'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
?>
<div style="display: none; position: absolute; z-index: 1000" id="id_error_display_table_frame">
<table class="scFormErrorTable scFormToastTable">
<tr><?php if ($this->Ini->Error_icon_span && '' != $this->Ini->Err_ico_title) { ?><td style="padding: 0px" rowspan="2"><img src="<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Err_ico_title; ?>" style="border-width: 0px" align="top"></td><?php } ?><td class="scFormErrorTitle scFormToastTitle"><table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormErrorTitleFont" style="padding: 0px; vertical-align: top; width: 100%"><?php if (!$this->Ini->Error_icon_span && '' != $this->Ini->Err_ico_title) { ?><img src="<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Err_ico_title; ?>" style="border-width: 0px" align="top">&nbsp;<?php } ?><?php echo $this->Ini->Nm_lang['lang_errm_errt'] ?></td><td style="padding: 0px; vertical-align: top"><?php echo nmButtonOutput($this->arr_buttons, "berrm_clse", "scAjaxHideErrorDisplay('table')", "scAjaxHideErrorDisplay('table')", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
</td></tr></table></td></tr>
<tr><td class="scFormErrorMessage scFormToastMessage"><span id="id_error_display_table_text"></span></td></tr>
</table>
</div>
<div style="display: none; position: absolute; z-index: 1000" id="id_message_display_frame">
 <table class="scFormMessageTable" id="id_message_display_content" style="width: 100%">
  <tr id="id_message_display_title_line">
   <td class="scFormMessageTitle" style="height: 20px"><?php
if ('' != $this->Ini->Msg_ico_title) {
?>
<img src="<?php echo $this->Ini->path_icones . '/' . $this->Ini->Msg_ico_title; ?>" style="border-width: 0px; vertical-align: middle">&nbsp;<?php
}
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmessageclose", "_scAjaxMessageBtnClose()", "_scAjaxMessageBtnClose()", "id_message_display_close_icon", "", "", "float: right", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<span id="id_message_display_title" style="vertical-align: middle"></span></td>
  </tr>
  <tr>
   <td class="scFormMessageMessage"><?php
if ('' != $this->Ini->Msg_ico_body) {
?>
<img id="id_message_display_body_icon" src="<?php echo $this->Ini->path_icones . '/' . $this->Ini->Msg_ico_body; ?>" style="border-width: 0px; vertical-align: middle">&nbsp;<?php
}
?>
<span id="id_message_display_text"></span><div id="id_message_display_buttond" style="display: none; text-align: center"><br /><input id="id_message_display_buttone" type="button" class="scButton_default" value="Ok" onClick="_scAjaxMessageBtnClick()" ></div></td>
  </tr>
 </table>
</div>
<?php
$msgDefClose = isset($this->arr_buttons['bmessageclose']) ? $this->arr_buttons['bmessageclose']['value'] : 'Ok';
?>
<script type="text/javascript">
var scMsgDefTitle = "<?php if (isset($this->Ini->Nm_lang['lang_usr_lang_othr_msgs_titl'])) {echo $this->Ini->Nm_lang['lang_usr_lang_othr_msgs_titl'];} ?>";
var scMsgDefButton = "Ok";
var scMsgDefClose = "<?php echo $msgDefClose; ?>";
var scMsgDefClick = "close";
var scMsgDefScInit = "<?php echo $this->Ini->page; ?>";
</script>
<?php
if ($this->record_insert_ok)
{
?>
<script type="text/javascript">
if (typeof sc_userSweetAlertDisplayed === "undefined" || !sc_userSweetAlertDisplayed) {
    _scAjaxShowMessage({message: "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_othr_ajax_frmi']) ?>", title: "", isModal: false, timeout: sc_ajaxMsgTime, showButton: false, buttonLabel: "Ok", topPos: 0, leftPos: 0, width: 0, height: 0, redirUrl: "", redirTarget: "", redirParam: "", showClose: false, showBodyIcon: true, isToast: true, type: "success"});
}
sc_userSweetAlertDisplayed = false;
</script>
<?php
}
if ($this->record_delete_ok)
{
?>
<script type="text/javascript">
if (typeof sc_userSweetAlertDisplayed === "undefined" || !sc_userSweetAlertDisplayed) {
    _scAjaxShowMessage({message: "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_othr_ajax_frmd']) ?>", title: "", isModal: false, timeout: sc_ajaxMsgTime, showButton: false, buttonLabel: "Ok", topPos: 0, leftPos: 0, width: 0, height: 0, redirUrl: "", redirTarget: "", redirParam: "", showClose: false, showBodyIcon: true, isToast: true, type: "success"});
}
sc_userSweetAlertDisplayed = false;
</script>
<?php
}
?>
<table id="main_table_form"  align="center" cellpadding=0 cellspacing=0  width="60%">
 <tr>
  <td>
  <div class="scFormBorder" style="<?php echo (isset($remove_border) ? $remove_border : ''); ?>">
   <table width='100%' cellspacing=0 cellpadding=0>
<?php
  if (!$this->Embutida_call && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['mostra_cab']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['mostra_cab'] != "N") && (!$_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['dashboard_info']['under_dashboard'] || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['dashboard_info']['compact_mode'] || $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['dashboard_info']['maximized']))
  {
?>
<tr><td>
<style>
    .scMenuTHeaderFont img, .scGridHeaderFont img , .scFormHeaderFont img , .scTabHeaderFont img , .scContainerHeaderFont img , .scFilterHeaderFont img { height:23px;}
</style>
<div class="scFormHeader" style="height: 54px; padding: 17px 15px; box-sizing: border-box;margin: -1px 0px 0px 0px;width: 100%;">
    <div class="scFormHeaderFont" style="float: left; text-transform: uppercase;"><?php if ($this->nmgp_opcao == "novo") { echo "" . $this->Ini->Nm_lang['lang_othr_frmi_title'] . " " . $this->Ini->Nm_lang['lang_tbl_ado_records'] . ""; } else { echo "" . $this->Ini->Nm_lang['lang_othr_frmu_title'] . " " . $this->Ini->Nm_lang['lang_tbl_ado_records'] . ""; } ?></div>
    <div class="scFormHeaderFont" style="float: right;"><?php echo date($this->dateDefaultFormat()); ?></div>
</div></td></tr>
<?php
  }
?>
<tr><td>
<?php
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-top" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['run_iframe'] != "R")
{
    $NM_btn = false;
      if ($this->nmgp_botoes['qsearch'] == "on" && $opcao_botoes != "novo")
      {
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['fast_search'][2] : "";
          $stateSearchIconClose  = 'none';
          $stateSearchIconSearch = '';
          if(!empty($OPC_dat))
          {
              $stateSearchIconClose  = '';
              $stateSearchIconSearch = 'none';
          }
?> 
           <script type="text/javascript">var change_fast_t = "";</script>
          <input id='fast_search_f0_t' type="hidden" name="nmgp_fast_search_t" value="SC_all_Cmp">
          <select id='cond_fast_search_f0_t' class="scFormToolbarInput" style="vertical-align: middle;display:none;" name="nmgp_cond_fast_search_t" onChange="change_fast_t = 'CH';">
<?php 
          $OPC_sel = ("qp" == $OPC_arg) ? " selected" : "";
           echo "           <option value='qp'" . $OPC_sel . ">" . $this->Ini->Nm_lang['lang_srch_like'] . "</option>";
?> 
          </select>
          <span id="quicksearchph_t" class="scFormToolbarInput" style='display: inline-block; vertical-align: inherit'>
              <span>
                  <input type="text" id="SC_fast_search_t" class="scFormToolbarInputText" style="border-width: 0px;;" name="nmgp_arg_fast_search_t" value="<?php echo $this->form_encode_input($OPC_dat) ?>" size="10" onChange="change_fast_t = 'CH';" alt="{maxLength: 255}" placeholder="<?php echo $this->Ini->Nm_lang['lang_othr_qk_watermark'] ?>">&nbsp;
                  <img style="display: <?php echo $stateSearchIconSearch ?>; "  id="SC_fast_search_submit_t" class='css_toolbar_obj_qs_search_img' src="<?php echo $this->Ini->path_botoes ?>/<?php echo $this->Ini->Img_qs_search; ?>" onclick="scQuickSearchSubmit_t();">
                  <img style="display: <?php echo $stateSearchIconClose ?>; " id="SC_fast_search_close_t" class='css_toolbar_obj_qs_search_img' src="<?php echo $this->Ini->path_botoes ?>/<?php echo $this->Ini->Img_qs_clean; ?>" onclick="document.getElementById('SC_fast_search_t').value = '__Clear_Fast__'; nm_move('fast_search', 't');">
              </span>
          </span>  </div>
  <?php
      }
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['new'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-1';
        $buttonMacroLabel = "";
        
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_disabled']['new']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_disabled']['new']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['new']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['new']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['new'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bnovo", "scBtnFn_sys_format_inc()", "scBtnFn_sys_format_inc()", "sc_b_new_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!$this->Embutida_call || $this->sc_evento == "novo" || $this->sc_evento == "insert" || $this->sc_evento == "incluir")) {
        $sCondStyle = ($this->nmgp_botoes['insert'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-2';
        $buttonMacroLabel = "";
        
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_disabled']['insert']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_disabled']['insert']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['insert']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['insert']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['insert'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bincluir", "scBtnFn_sys_format_inc()", "scBtnFn_sys_format_inc()", "sc_b_ins_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!$this->Embutida_call || $this->sc_evento == "novo" || $this->sc_evento == "insert" || $this->sc_evento == "incluir")) {
        $sCondStyle = ($this->nmgp_botoes['insert'] == "on" && $this->nmgp_botoes['cancel'] == "on") && ($this->nm_flag_saida_novo != "S" || $this->nmgp_botoes['exit'] != "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-3';
        $buttonMacroLabel = "";
        
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_disabled']['bcancelar']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_disabled']['bcancelar']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['bcancelar']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['bcancelar']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['bcancelar'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bcancelar", "scBtnFn_sys_format_cnl()", "scBtnFn_sys_format_cnl()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['update'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-4';
        $buttonMacroLabel = "";
        
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_disabled']['update']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_disabled']['update']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['update']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['update']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['update'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "balterar", "scBtnFn_sys_format_alt()", "scBtnFn_sys_format_alt()", "sc_b_upd_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['delete'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-5';
        $buttonMacroLabel = "";
        
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_disabled']['delete']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_disabled']['delete']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['delete']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['delete']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['delete'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bexcluir", "scBtnFn_sys_format_exc()", "scBtnFn_sys_format_exc()", "sc_b_del_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
?> 
     </td> 
     <td nowrap align="right" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ('' != $this->url_webhelp) {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";
        
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_disabled']['help']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_disabled']['help']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['help']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['help']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['help'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bhelp", "scBtnFn_sys_format_hlp()", "scBtnFn_sys_format_hlp()", "sc_b_hlp_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && ($nm_apl_dependente != 1 || $this->nm_Start_new) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['run_iframe'] != "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = (($this->nm_flag_saida_novo == "S" || ($this->nm_Start_new && !$this->aba_iframe)) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-6';
        $buttonMacroLabel = "";
        
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['run_iframe'] == "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = ($this->nm_flag_saida_novo == "S" && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-7';
        $buttonMacroLabel = "";
        
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-8';
        $buttonMacroLabel = "";
        
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-9';
        $buttonMacroLabel = "";
        
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-10';
        $buttonMacroLabel = "";
        
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['run_iframe'] != "R")
{
?>
   </td></tr> 
   </table> 
   </td></tr></table> 
<?php
}
?>
<?php
if (!$NM_btn && isset($NM_ult_sep))
{
    echo "    <script language=\"javascript\">";
    echo "      document.getElementById('" .  $NM_ult_sep . "').style.display='none';";
    echo "    </script>";
}
unset($NM_ult_sep);
?>
<?php if ('novo' != $this->nmgp_opcao || $this->Embutida_form) { ?><script>nav_atualiza(Nav_permite_ret, Nav_permite_ava, 't');</script><?php } ?>
</td></tr> 
<tr><td>
<?php
       echo "<div id=\"sc-ui-empty-form\" class=\"scFormPageText\" style=\"padding: 10px; font-weight: bold" . ($this->nmgp_form_empty ? '' : '; display: none') . "\">";
       echo $this->Ini->Nm_lang['lang_errm_empt'];
       echo "</div>";
  if ($this->nmgp_form_empty)
  {
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['empty_filter'] = true;
       }
  }
?>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_0"><!-- bloco_c -->
<?php
?>
<TABLE align="center" id="hidden_bloco_0" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['record']))
           {
               $this->nmgp_cmp_readonly['record'] = 'on';
           }
?>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['record']))
    {
        $this->nm_new_label['record'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_Record'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $record = $this->record;
   $sStyleHidden_record = '';
   if (isset($this->nmgp_cmp_hidden['record']) && $this->nmgp_cmp_hidden['record'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['record']);
       $sStyleHidden_record = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_record = 'display: none;';
   $sStyleReadInp_record = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["record"]) &&  $this->nmgp_cmp_readonly["record"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['record']);
       $sStyleReadLab_record = '';
       $sStyleReadInp_record = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['record']) && $this->nmgp_cmp_hidden['record'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="record" value="<?php echo $this->form_encode_input($record) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php if ((isset($this->Embutida_form) && $this->Embutida_form) || ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir")) { ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_record_label" id="hidden_field_label_record" style="<?php echo $sStyleHidden_record; ?>"><span id="id_label_record"><?php echo $this->nm_new_label['record']; ?></span></TD>
    <TD class="scFormDataOdd css_record_line" id="hidden_field_data_record" style="<?php echo $sStyleHidden_record; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_record_line" style="vertical-align: top;padding: 0px"><span id="id_read_on_record" class="css_record_line" style="<?php echo $sStyleReadLab_record; ?>"><?php echo $this->form_format_readonly("record", $this->form_encode_input($this->record)); ?></span><span id="id_read_off_record" class="css_read_off_record" style="<?php echo $sStyleReadInp_record; ?>"><input type="hidden" name="record" value="<?php echo $this->form_encode_input($record) . "\">"?><span id="id_ajax_label_record"><?php echo nl2br($record); ?></span>
</span></span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_record_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_record_text"></span></td></tr></table></td></tr></table></TD>
   <?php }
      else
      {
         $sc_hidden_no--;
      }
?>
<?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['uid']))
    {
        $this->nm_new_label['uid'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_Uid'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $uid = $this->uid;
   $sStyleHidden_uid = '';
   if (isset($this->nmgp_cmp_hidden['uid']) && $this->nmgp_cmp_hidden['uid'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['uid']);
       $sStyleHidden_uid = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_uid = 'display: none;';
   $sStyleReadInp_uid = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['uid']) && $this->nmgp_cmp_readonly['uid'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['uid']);
       $sStyleReadLab_uid = '';
       $sStyleReadInp_uid = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['uid']) && $this->nmgp_cmp_hidden['uid'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="uid" value="<?php echo $this->form_encode_input($uid) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_uid_label" id="hidden_field_label_uid" style="<?php echo $sStyleHidden_uid; ?>"><span id="id_label_uid"><?php echo $this->nm_new_label['uid']; ?></span></TD>
    <TD class="scFormDataOdd css_uid_line" id="hidden_field_data_uid" style="<?php echo $sStyleHidden_uid; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_uid_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["uid"]) &&  $this->nmgp_cmp_readonly["uid"] == "on") { 

 ?>
<input type="hidden" name="uid" value="<?php echo $this->form_encode_input($uid) . "\">" . $uid . ""; ?>
<?php } else { ?>
<span id="id_read_on_uid" class="sc-ui-readonly-uid css_uid_line" style="<?php echo $sStyleReadLab_uid; ?>"><?php echo $this->form_format_readonly("uid", $this->form_encode_input($this->uid)); ?></span><span id="id_read_off_uid" class="css_read_off_uid<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_uid; ?>">
 <input class="sc-js-input scFormObjectOdd css_uid_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_uid" type=text name="uid" value="<?php echo $this->form_encode_input($uid) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_uid_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_uid_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['startingdate']))
    {
        $this->nm_new_label['startingdate'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_StartingDate'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $old_dt_startingdate = $this->startingdate;
   if (strlen($this->startingdate_hora) > 8 ) {$this->startingdate_hora = substr($this->startingdate_hora, 0, 8);}
   $this->startingdate .= ' ' . $this->startingdate_hora;
   $this->startingdate  = trim($this->startingdate);
   $startingdate = $this->startingdate;
   $sStyleHidden_startingdate = '';
   if (isset($this->nmgp_cmp_hidden['startingdate']) && $this->nmgp_cmp_hidden['startingdate'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['startingdate']);
       $sStyleHidden_startingdate = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_startingdate = 'display: none;';
   $sStyleReadInp_startingdate = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['startingdate']) && $this->nmgp_cmp_readonly['startingdate'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['startingdate']);
       $sStyleReadLab_startingdate = '';
       $sStyleReadInp_startingdate = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['startingdate']) && $this->nmgp_cmp_hidden['startingdate'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="startingdate" value="<?php echo $this->form_encode_input($startingdate) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_startingdate_label" id="hidden_field_label_startingdate" style="<?php echo $sStyleHidden_startingdate; ?>"><span id="id_label_startingdate"><?php echo $this->nm_new_label['startingdate']; ?></span></TD>
    <TD class="scFormDataOdd css_startingdate_line" id="hidden_field_data_startingdate" style="<?php echo $sStyleHidden_startingdate; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_startingdate_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["startingdate"]) &&  $this->nmgp_cmp_readonly["startingdate"] == "on") { 

 ?>
<input type="hidden" name="startingdate" value="<?php echo $this->form_encode_input($startingdate) . "\">" . $startingdate . ""; ?>
<?php } else { ?>
<span id="id_read_on_startingdate" class="sc-ui-readonly-startingdate css_startingdate_line" style="<?php echo $sStyleReadLab_startingdate; ?>"><?php echo $this->form_format_readonly("startingdate", $this->form_encode_input($startingdate)); ?></span><span id="id_read_off_startingdate" class="css_read_off_startingdate<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_startingdate; ?>"><?php
$tmp_form_data = $this->field_config['startingdate']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
<?php
$miniCalendarButton = $this->jqueryButtonText('calendar');
if ('scButton_' == substr($miniCalendarButton[1], 0, 9)) {
    $miniCalendarButton[1] = substr($miniCalendarButton[1], 9);
}
?>
<span class='trigger-picker-<?php echo $miniCalendarButton[1]; ?>' style='display: inherit; width: 100%'>

 <input class="sc-js-input scFormObjectOdd css_startingdate_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_startingdate" type=text name="startingdate" value="<?php echo $this->form_encode_input($startingdate) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=18"; } ?> alt="{datatype: 'datetime', dateSep: '<?php echo $this->field_config['startingdate']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['startingdate']['date_format']; ?>', timeSep: '<?php echo $this->field_config['startingdate']['time_sep']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_startingdate_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_startingdate_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>
<?php
   $this->startingdate = $old_dt_startingdate;
?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['creationdate']))
    {
        $this->nm_new_label['creationdate'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_CreationDate'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $old_dt_creationdate = $this->creationdate;
   if (strlen($this->creationdate_hora) > 8 ) {$this->creationdate_hora = substr($this->creationdate_hora, 0, 8);}
   $this->creationdate .= ' ' . $this->creationdate_hora;
   $this->creationdate  = trim($this->creationdate);
   $creationdate = $this->creationdate;
   $sStyleHidden_creationdate = '';
   if (isset($this->nmgp_cmp_hidden['creationdate']) && $this->nmgp_cmp_hidden['creationdate'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['creationdate']);
       $sStyleHidden_creationdate = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_creationdate = 'display: none;';
   $sStyleReadInp_creationdate = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['creationdate']) && $this->nmgp_cmp_readonly['creationdate'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['creationdate']);
       $sStyleReadLab_creationdate = '';
       $sStyleReadInp_creationdate = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['creationdate']) && $this->nmgp_cmp_hidden['creationdate'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="creationdate" value="<?php echo $this->form_encode_input($creationdate) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_creationdate_label" id="hidden_field_label_creationdate" style="<?php echo $sStyleHidden_creationdate; ?>"><span id="id_label_creationdate"><?php echo $this->nm_new_label['creationdate']; ?></span></TD>
    <TD class="scFormDataOdd css_creationdate_line" id="hidden_field_data_creationdate" style="<?php echo $sStyleHidden_creationdate; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_creationdate_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["creationdate"]) &&  $this->nmgp_cmp_readonly["creationdate"] == "on") { 

 ?>
<input type="hidden" name="creationdate" value="<?php echo $this->form_encode_input($creationdate) . "\">" . $creationdate . ""; ?>
<?php } else { ?>
<span id="id_read_on_creationdate" class="sc-ui-readonly-creationdate css_creationdate_line" style="<?php echo $sStyleReadLab_creationdate; ?>"><?php echo $this->form_format_readonly("creationdate", $this->form_encode_input($creationdate)); ?></span><span id="id_read_off_creationdate" class="css_read_off_creationdate<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_creationdate; ?>"><?php
$tmp_form_data = $this->field_config['creationdate']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
<?php
$miniCalendarButton = $this->jqueryButtonText('calendar');
if ('scButton_' == substr($miniCalendarButton[1], 0, 9)) {
    $miniCalendarButton[1] = substr($miniCalendarButton[1], 9);
}
?>
<span class='trigger-picker-<?php echo $miniCalendarButton[1]; ?>' style='display: inherit; width: 100%'>

 <input class="sc-js-input scFormObjectOdd css_creationdate_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_creationdate" type=text name="creationdate" value="<?php echo $this->form_encode_input($creationdate) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=18"; } ?> alt="{datatype: 'datetime', dateSep: '<?php echo $this->field_config['creationdate']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['creationdate']['date_format']; ?>', timeSep: '<?php echo $this->field_config['creationdate']['time_sep']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_creationdate_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_creationdate_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>
<?php
   $this->creationdate = $old_dt_creationdate;
?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['creationip']))
    {
        $this->nm_new_label['creationip'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_CreationIP'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $creationip = $this->creationip;
   $sStyleHidden_creationip = '';
   if (isset($this->nmgp_cmp_hidden['creationip']) && $this->nmgp_cmp_hidden['creationip'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['creationip']);
       $sStyleHidden_creationip = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_creationip = 'display: none;';
   $sStyleReadInp_creationip = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['creationip']) && $this->nmgp_cmp_readonly['creationip'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['creationip']);
       $sStyleReadLab_creationip = '';
       $sStyleReadInp_creationip = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['creationip']) && $this->nmgp_cmp_hidden['creationip'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="creationip" value="<?php echo $this->form_encode_input($creationip) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_creationip_label" id="hidden_field_label_creationip" style="<?php echo $sStyleHidden_creationip; ?>"><span id="id_label_creationip"><?php echo $this->nm_new_label['creationip']; ?></span></TD>
    <TD class="scFormDataOdd css_creationip_line" id="hidden_field_data_creationip" style="<?php echo $sStyleHidden_creationip; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_creationip_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["creationip"]) &&  $this->nmgp_cmp_readonly["creationip"] == "on") { 

 ?>
<input type="hidden" name="creationip" value="<?php echo $this->form_encode_input($creationip) . "\">" . $creationip . ""; ?>
<?php } else { ?>
<span id="id_read_on_creationip" class="sc-ui-readonly-creationip css_creationip_line" style="<?php echo $sStyleReadLab_creationip; ?>"><?php echo $this->form_format_readonly("creationip", $this->form_encode_input($this->creationip)); ?></span><span id="id_read_off_creationip" class="css_read_off_creationip<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_creationip; ?>">
 <input class="sc-js-input scFormObjectOdd css_creationip_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_creationip" type=text name="creationip" value="<?php echo $this->form_encode_input($creationip) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_creationip_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_creationip_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['documenttype']))
    {
        $this->nm_new_label['documenttype'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_DocumentType'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $documenttype = $this->documenttype;
   $sStyleHidden_documenttype = '';
   if (isset($this->nmgp_cmp_hidden['documenttype']) && $this->nmgp_cmp_hidden['documenttype'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['documenttype']);
       $sStyleHidden_documenttype = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_documenttype = 'display: none;';
   $sStyleReadInp_documenttype = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['documenttype']) && $this->nmgp_cmp_readonly['documenttype'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['documenttype']);
       $sStyleReadLab_documenttype = '';
       $sStyleReadInp_documenttype = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['documenttype']) && $this->nmgp_cmp_hidden['documenttype'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="documenttype" value="<?php echo $this->form_encode_input($documenttype) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_documenttype_label" id="hidden_field_label_documenttype" style="<?php echo $sStyleHidden_documenttype; ?>"><span id="id_label_documenttype"><?php echo $this->nm_new_label['documenttype']; ?></span></TD>
    <TD class="scFormDataOdd css_documenttype_line" id="hidden_field_data_documenttype" style="<?php echo $sStyleHidden_documenttype; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_documenttype_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["documenttype"]) &&  $this->nmgp_cmp_readonly["documenttype"] == "on") { 

 ?>
<input type="hidden" name="documenttype" value="<?php echo $this->form_encode_input($documenttype) . "\">" . $documenttype . ""; ?>
<?php } else { ?>
<span id="id_read_on_documenttype" class="sc-ui-readonly-documenttype css_documenttype_line" style="<?php echo $sStyleReadLab_documenttype; ?>"><?php echo $this->form_format_readonly("documenttype", $this->form_encode_input($this->documenttype)); ?></span><span id="id_read_off_documenttype" class="css_read_off_documenttype<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_documenttype; ?>">
 <input class="sc-js-input scFormObjectOdd css_documenttype_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_documenttype" type=text name="documenttype" value="<?php echo $this->form_encode_input($documenttype) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=2"; } ?> maxlength=2 alt="{datatype: 'text', maxLength: 2, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_documenttype_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_documenttype_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['idnumber']))
    {
        $this->nm_new_label['idnumber'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_IdNumber'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $idnumber = $this->idnumber;
   $sStyleHidden_idnumber = '';
   if (isset($this->nmgp_cmp_hidden['idnumber']) && $this->nmgp_cmp_hidden['idnumber'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['idnumber']);
       $sStyleHidden_idnumber = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_idnumber = 'display: none;';
   $sStyleReadInp_idnumber = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['idnumber']) && $this->nmgp_cmp_readonly['idnumber'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['idnumber']);
       $sStyleReadLab_idnumber = '';
       $sStyleReadInp_idnumber = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['idnumber']) && $this->nmgp_cmp_hidden['idnumber'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="idnumber" value="<?php echo $this->form_encode_input($idnumber) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_idnumber_label" id="hidden_field_label_idnumber" style="<?php echo $sStyleHidden_idnumber; ?>"><span id="id_label_idnumber"><?php echo $this->nm_new_label['idnumber']; ?></span></TD>
    <TD class="scFormDataOdd css_idnumber_line" id="hidden_field_data_idnumber" style="<?php echo $sStyleHidden_idnumber; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_idnumber_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["idnumber"]) &&  $this->nmgp_cmp_readonly["idnumber"] == "on") { 

 ?>
<input type="hidden" name="idnumber" value="<?php echo $this->form_encode_input($idnumber) . "\">" . $idnumber . ""; ?>
<?php } else { ?>
<span id="id_read_on_idnumber" class="sc-ui-readonly-idnumber css_idnumber_line" style="<?php echo $sStyleReadLab_idnumber; ?>"><?php echo $this->form_format_readonly("idnumber", $this->form_encode_input($this->idnumber)); ?></span><span id="id_read_off_idnumber" class="css_read_off_idnumber<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_idnumber; ?>">
 <input class="sc-js-input scFormObjectOdd css_idnumber_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_idnumber" type=text name="idnumber" value="<?php echo $this->form_encode_input($idnumber) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_idnumber_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_idnumber_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['firstname']))
    {
        $this->nm_new_label['firstname'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_FirstName'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $firstname = $this->firstname;
   $sStyleHidden_firstname = '';
   if (isset($this->nmgp_cmp_hidden['firstname']) && $this->nmgp_cmp_hidden['firstname'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['firstname']);
       $sStyleHidden_firstname = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_firstname = 'display: none;';
   $sStyleReadInp_firstname = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['firstname']) && $this->nmgp_cmp_readonly['firstname'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['firstname']);
       $sStyleReadLab_firstname = '';
       $sStyleReadInp_firstname = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['firstname']) && $this->nmgp_cmp_hidden['firstname'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="firstname" value="<?php echo $this->form_encode_input($firstname) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_firstname_label" id="hidden_field_label_firstname" style="<?php echo $sStyleHidden_firstname; ?>"><span id="id_label_firstname"><?php echo $this->nm_new_label['firstname']; ?></span></TD>
    <TD class="scFormDataOdd css_firstname_line" id="hidden_field_data_firstname" style="<?php echo $sStyleHidden_firstname; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_firstname_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["firstname"]) &&  $this->nmgp_cmp_readonly["firstname"] == "on") { 

 ?>
<input type="hidden" name="firstname" value="<?php echo $this->form_encode_input($firstname) . "\">" . $firstname . ""; ?>
<?php } else { ?>
<span id="id_read_on_firstname" class="sc-ui-readonly-firstname css_firstname_line" style="<?php echo $sStyleReadLab_firstname; ?>"><?php echo $this->form_format_readonly("firstname", $this->form_encode_input($this->firstname)); ?></span><span id="id_read_off_firstname" class="css_read_off_firstname<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_firstname; ?>">
 <input class="sc-js-input scFormObjectOdd css_firstname_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_firstname" type=text name="firstname" value="<?php echo $this->form_encode_input($firstname) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_firstname_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_firstname_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['secondname']))
    {
        $this->nm_new_label['secondname'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_SecondName'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $secondname = $this->secondname;
   $sStyleHidden_secondname = '';
   if (isset($this->nmgp_cmp_hidden['secondname']) && $this->nmgp_cmp_hidden['secondname'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['secondname']);
       $sStyleHidden_secondname = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_secondname = 'display: none;';
   $sStyleReadInp_secondname = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['secondname']) && $this->nmgp_cmp_readonly['secondname'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['secondname']);
       $sStyleReadLab_secondname = '';
       $sStyleReadInp_secondname = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['secondname']) && $this->nmgp_cmp_hidden['secondname'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="secondname" value="<?php echo $this->form_encode_input($secondname) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_secondname_label" id="hidden_field_label_secondname" style="<?php echo $sStyleHidden_secondname; ?>"><span id="id_label_secondname"><?php echo $this->nm_new_label['secondname']; ?></span></TD>
    <TD class="scFormDataOdd css_secondname_line" id="hidden_field_data_secondname" style="<?php echo $sStyleHidden_secondname; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_secondname_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["secondname"]) &&  $this->nmgp_cmp_readonly["secondname"] == "on") { 

 ?>
<input type="hidden" name="secondname" value="<?php echo $this->form_encode_input($secondname) . "\">" . $secondname . ""; ?>
<?php } else { ?>
<span id="id_read_on_secondname" class="sc-ui-readonly-secondname css_secondname_line" style="<?php echo $sStyleReadLab_secondname; ?>"><?php echo $this->form_format_readonly("secondname", $this->form_encode_input($this->secondname)); ?></span><span id="id_read_off_secondname" class="css_read_off_secondname<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_secondname; ?>">
 <input class="sc-js-input scFormObjectOdd css_secondname_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_secondname" type=text name="secondname" value="<?php echo $this->form_encode_input($secondname) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_secondname_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_secondname_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['firstsurname']))
    {
        $this->nm_new_label['firstsurname'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_FirstSurname'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $firstsurname = $this->firstsurname;
   $sStyleHidden_firstsurname = '';
   if (isset($this->nmgp_cmp_hidden['firstsurname']) && $this->nmgp_cmp_hidden['firstsurname'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['firstsurname']);
       $sStyleHidden_firstsurname = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_firstsurname = 'display: none;';
   $sStyleReadInp_firstsurname = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['firstsurname']) && $this->nmgp_cmp_readonly['firstsurname'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['firstsurname']);
       $sStyleReadLab_firstsurname = '';
       $sStyleReadInp_firstsurname = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['firstsurname']) && $this->nmgp_cmp_hidden['firstsurname'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="firstsurname" value="<?php echo $this->form_encode_input($firstsurname) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_firstsurname_label" id="hidden_field_label_firstsurname" style="<?php echo $sStyleHidden_firstsurname; ?>"><span id="id_label_firstsurname"><?php echo $this->nm_new_label['firstsurname']; ?></span></TD>
    <TD class="scFormDataOdd css_firstsurname_line" id="hidden_field_data_firstsurname" style="<?php echo $sStyleHidden_firstsurname; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_firstsurname_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["firstsurname"]) &&  $this->nmgp_cmp_readonly["firstsurname"] == "on") { 

 ?>
<input type="hidden" name="firstsurname" value="<?php echo $this->form_encode_input($firstsurname) . "\">" . $firstsurname . ""; ?>
<?php } else { ?>
<span id="id_read_on_firstsurname" class="sc-ui-readonly-firstsurname css_firstsurname_line" style="<?php echo $sStyleReadLab_firstsurname; ?>"><?php echo $this->form_format_readonly("firstsurname", $this->form_encode_input($this->firstsurname)); ?></span><span id="id_read_off_firstsurname" class="css_read_off_firstsurname<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_firstsurname; ?>">
 <input class="sc-js-input scFormObjectOdd css_firstsurname_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_firstsurname" type=text name="firstsurname" value="<?php echo $this->form_encode_input($firstsurname) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_firstsurname_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_firstsurname_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['secondsurname']))
    {
        $this->nm_new_label['secondsurname'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_SecondSurname'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $secondsurname = $this->secondsurname;
   $sStyleHidden_secondsurname = '';
   if (isset($this->nmgp_cmp_hidden['secondsurname']) && $this->nmgp_cmp_hidden['secondsurname'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['secondsurname']);
       $sStyleHidden_secondsurname = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_secondsurname = 'display: none;';
   $sStyleReadInp_secondsurname = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['secondsurname']) && $this->nmgp_cmp_readonly['secondsurname'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['secondsurname']);
       $sStyleReadLab_secondsurname = '';
       $sStyleReadInp_secondsurname = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['secondsurname']) && $this->nmgp_cmp_hidden['secondsurname'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="secondsurname" value="<?php echo $this->form_encode_input($secondsurname) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_secondsurname_label" id="hidden_field_label_secondsurname" style="<?php echo $sStyleHidden_secondsurname; ?>"><span id="id_label_secondsurname"><?php echo $this->nm_new_label['secondsurname']; ?></span></TD>
    <TD class="scFormDataOdd css_secondsurname_line" id="hidden_field_data_secondsurname" style="<?php echo $sStyleHidden_secondsurname; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_secondsurname_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["secondsurname"]) &&  $this->nmgp_cmp_readonly["secondsurname"] == "on") { 

 ?>
<input type="hidden" name="secondsurname" value="<?php echo $this->form_encode_input($secondsurname) . "\">" . $secondsurname . ""; ?>
<?php } else { ?>
<span id="id_read_on_secondsurname" class="sc-ui-readonly-secondsurname css_secondsurname_line" style="<?php echo $sStyleReadLab_secondsurname; ?>"><?php echo $this->form_format_readonly("secondsurname", $this->form_encode_input($this->secondsurname)); ?></span><span id="id_read_off_secondsurname" class="css_read_off_secondsurname<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_secondsurname; ?>">
 <input class="sc-js-input scFormObjectOdd css_secondsurname_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_secondsurname" type=text name="secondsurname" value="<?php echo $this->form_encode_input($secondsurname) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_secondsurname_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_secondsurname_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['gender']))
   {
       $this->nm_new_label['gender'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_Gender'] . "";
   }
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $gender = $this->gender;
   $sStyleHidden_gender = '';
   if (isset($this->nmgp_cmp_hidden['gender']) && $this->nmgp_cmp_hidden['gender'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['gender']);
       $sStyleHidden_gender = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_gender = 'display: none;';
   $sStyleReadInp_gender = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['gender']) && $this->nmgp_cmp_readonly['gender'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['gender']);
       $sStyleReadLab_gender = '';
       $sStyleReadInp_gender = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['gender']) && $this->nmgp_cmp_hidden['gender'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="gender" value="<?php echo $this->form_encode_input($this->gender) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_gender_label" id="hidden_field_label_gender" style="<?php echo $sStyleHidden_gender; ?>"><span id="id_label_gender"><?php echo $this->nm_new_label['gender']; ?></span></TD>
    <TD class="scFormDataOdd css_gender_line" id="hidden_field_data_gender" style="<?php echo $sStyleHidden_gender; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_gender_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["gender"]) &&  $this->nmgp_cmp_readonly["gender"] == "on") { 

$gender_look = "";
 if ($this->gender == "M") { $gender_look .= "" . $this->Ini->Nm_lang['lang_masculino'] . "" ;} 
 if ($this->gender == "F") { $gender_look .= "" . $this->Ini->Nm_lang['lang_femenino'] . "" ;} 
 if (empty($gender_look)) { $gender_look = $this->gender; }
?>
<input type="hidden" name="gender" value="<?php echo $this->form_encode_input($gender) . "\">" . $gender_look . ""; ?>
<?php } else { ?>
<?php

$gender_look = "";
 if ($this->gender == "M") { $gender_look .= "" . $this->Ini->Nm_lang['lang_masculino'] . "" ;} 
 if ($this->gender == "F") { $gender_look .= "" . $this->Ini->Nm_lang['lang_femenino'] . "" ;} 
 if (empty($gender_look)) { $gender_look = $this->gender; }
?>
<span id="id_read_on_gender" class="css_gender_line"  style="<?php echo $sStyleReadLab_gender; ?>"><?php echo $this->form_format_readonly("gender", $this->form_encode_input($gender_look)); ?></span><span id="id_read_off_gender" class="css_read_off_gender<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_gender; ?>">
 <span id="idAjaxSelect_gender" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_gender_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_gender" name="gender" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="M" <?php  if ($this->gender == "M") { echo " selected" ;} ?>><?php echo $this->Ini->Nm_lang['lang_masculino']; ?></option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['Lookup_gender'][] = 'M'; ?>
 <option  value="F" <?php  if ($this->gender == "F") { echo " selected" ;} ?>><?php echo $this->Ini->Nm_lang['lang_femenino']; ?></option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['Lookup_gender'][] = 'F'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_gender_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_gender_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['birthdate']))
    {
        $this->nm_new_label['birthdate'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_BirthDate'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $birthdate = $this->birthdate;
   $sStyleHidden_birthdate = '';
   if (isset($this->nmgp_cmp_hidden['birthdate']) && $this->nmgp_cmp_hidden['birthdate'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['birthdate']);
       $sStyleHidden_birthdate = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_birthdate = 'display: none;';
   $sStyleReadInp_birthdate = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['birthdate']) && $this->nmgp_cmp_readonly['birthdate'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['birthdate']);
       $sStyleReadLab_birthdate = '';
       $sStyleReadInp_birthdate = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['birthdate']) && $this->nmgp_cmp_hidden['birthdate'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="birthdate" value="<?php echo $this->form_encode_input($birthdate) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_birthdate_label" id="hidden_field_label_birthdate" style="<?php echo $sStyleHidden_birthdate; ?>"><span id="id_label_birthdate"><?php echo $this->nm_new_label['birthdate']; ?></span></TD>
    <TD class="scFormDataOdd css_birthdate_line" id="hidden_field_data_birthdate" style="<?php echo $sStyleHidden_birthdate; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_birthdate_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["birthdate"]) &&  $this->nmgp_cmp_readonly["birthdate"] == "on") { 

 ?>
<input type="hidden" name="birthdate" value="<?php echo $this->form_encode_input($birthdate) . "\">" . $birthdate . ""; ?>
<?php } else { ?>
<span id="id_read_on_birthdate" class="sc-ui-readonly-birthdate css_birthdate_line" style="<?php echo $sStyleReadLab_birthdate; ?>"><?php echo $this->form_format_readonly("birthdate", $this->form_encode_input($birthdate)); ?></span><span id="id_read_off_birthdate" class="css_read_off_birthdate<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_birthdate; ?>"><?php
$tmp_form_data = $this->field_config['birthdate']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
<?php
$miniCalendarButton = $this->jqueryButtonText('calendar');
if ('scButton_' == substr($miniCalendarButton[1], 0, 9)) {
    $miniCalendarButton[1] = substr($miniCalendarButton[1], 9);
}
?>
<span class='trigger-picker-<?php echo $miniCalendarButton[1]; ?>' style='display: inherit; width: 100%'>

 <input class="sc-js-input scFormObjectOdd css_birthdate_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_birthdate" type=text name="birthdate" value="<?php echo $this->form_encode_input($birthdate) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=18"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['birthdate']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['birthdate']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_birthdate_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_birthdate_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['street']))
    {
        $this->nm_new_label['street'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_Street'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $street = $this->street;
   $sStyleHidden_street = '';
   if (isset($this->nmgp_cmp_hidden['street']) && $this->nmgp_cmp_hidden['street'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['street']);
       $sStyleHidden_street = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_street = 'display: none;';
   $sStyleReadInp_street = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['street']) && $this->nmgp_cmp_readonly['street'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['street']);
       $sStyleReadLab_street = '';
       $sStyleReadInp_street = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['street']) && $this->nmgp_cmp_hidden['street'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="street" value="<?php echo $this->form_encode_input($street) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_street_label" id="hidden_field_label_street" style="<?php echo $sStyleHidden_street; ?>"><span id="id_label_street"><?php echo $this->nm_new_label['street']; ?></span></TD>
    <TD class="scFormDataOdd css_street_line" id="hidden_field_data_street" style="<?php echo $sStyleHidden_street; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_street_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["street"]) &&  $this->nmgp_cmp_readonly["street"] == "on") { 

 ?>
<input type="hidden" name="street" value="<?php echo $this->form_encode_input($street) . "\">" . $street . ""; ?>
<?php } else { ?>
<span id="id_read_on_street" class="sc-ui-readonly-street css_street_line" style="<?php echo $sStyleReadLab_street; ?>"><?php echo $this->form_format_readonly("street", $this->form_encode_input($this->street)); ?></span><span id="id_read_off_street" class="css_read_off_street<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_street; ?>">
 <input class="sc-js-input scFormObjectOdd css_street_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_street" type=text name="street" value="<?php echo $this->form_encode_input($street) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_street_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_street_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['cedulatecondition']))
    {
        $this->nm_new_label['cedulatecondition'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_CedulateCondition'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $cedulatecondition = $this->cedulatecondition;
   $sStyleHidden_cedulatecondition = '';
   if (isset($this->nmgp_cmp_hidden['cedulatecondition']) && $this->nmgp_cmp_hidden['cedulatecondition'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['cedulatecondition']);
       $sStyleHidden_cedulatecondition = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_cedulatecondition = 'display: none;';
   $sStyleReadInp_cedulatecondition = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['cedulatecondition']) && $this->nmgp_cmp_readonly['cedulatecondition'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['cedulatecondition']);
       $sStyleReadLab_cedulatecondition = '';
       $sStyleReadInp_cedulatecondition = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['cedulatecondition']) && $this->nmgp_cmp_hidden['cedulatecondition'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="cedulatecondition" value="<?php echo $this->form_encode_input($cedulatecondition) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_cedulatecondition_label" id="hidden_field_label_cedulatecondition" style="<?php echo $sStyleHidden_cedulatecondition; ?>"><span id="id_label_cedulatecondition"><?php echo $this->nm_new_label['cedulatecondition']; ?></span></TD>
    <TD class="scFormDataOdd css_cedulatecondition_line" id="hidden_field_data_cedulatecondition" style="<?php echo $sStyleHidden_cedulatecondition; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cedulatecondition_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["cedulatecondition"]) &&  $this->nmgp_cmp_readonly["cedulatecondition"] == "on") { 

 ?>
<input type="hidden" name="cedulatecondition" value="<?php echo $this->form_encode_input($cedulatecondition) . "\">" . $cedulatecondition . ""; ?>
<?php } else { ?>
<span id="id_read_on_cedulatecondition" class="sc-ui-readonly-cedulatecondition css_cedulatecondition_line" style="<?php echo $sStyleReadLab_cedulatecondition; ?>"><?php echo $this->form_format_readonly("cedulatecondition", $this->form_encode_input($this->cedulatecondition)); ?></span><span id="id_read_off_cedulatecondition" class="css_read_off_cedulatecondition<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_cedulatecondition; ?>">
 <input class="sc-js-input scFormObjectOdd css_cedulatecondition_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_cedulatecondition" type=text name="cedulatecondition" value="<?php echo $this->form_encode_input($cedulatecondition) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cedulatecondition_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cedulatecondition_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['spouse']))
    {
        $this->nm_new_label['spouse'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_Spouse'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $spouse = $this->spouse;
   $sStyleHidden_spouse = '';
   if (isset($this->nmgp_cmp_hidden['spouse']) && $this->nmgp_cmp_hidden['spouse'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['spouse']);
       $sStyleHidden_spouse = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_spouse = 'display: none;';
   $sStyleReadInp_spouse = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['spouse']) && $this->nmgp_cmp_readonly['spouse'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['spouse']);
       $sStyleReadLab_spouse = '';
       $sStyleReadInp_spouse = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['spouse']) && $this->nmgp_cmp_hidden['spouse'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="spouse" value="<?php echo $this->form_encode_input($spouse) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_spouse_label" id="hidden_field_label_spouse" style="<?php echo $sStyleHidden_spouse; ?>"><span id="id_label_spouse"><?php echo $this->nm_new_label['spouse']; ?></span></TD>
    <TD class="scFormDataOdd css_spouse_line" id="hidden_field_data_spouse" style="<?php echo $sStyleHidden_spouse; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_spouse_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["spouse"]) &&  $this->nmgp_cmp_readonly["spouse"] == "on") { 

 ?>
<input type="hidden" name="spouse" value="<?php echo $this->form_encode_input($spouse) . "\">" . $spouse . ""; ?>
<?php } else { ?>
<span id="id_read_on_spouse" class="sc-ui-readonly-spouse css_spouse_line" style="<?php echo $sStyleReadLab_spouse; ?>"><?php echo $this->form_format_readonly("spouse", $this->form_encode_input($this->spouse)); ?></span><span id="id_read_off_spouse" class="css_read_off_spouse<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_spouse; ?>">
 <input class="sc-js-input scFormObjectOdd css_spouse_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_spouse" type=text name="spouse" value="<?php echo $this->form_encode_input($spouse) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_spouse_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_spouse_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['home']))
    {
        $this->nm_new_label['home'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_Home'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $home = $this->home;
   $sStyleHidden_home = '';
   if (isset($this->nmgp_cmp_hidden['home']) && $this->nmgp_cmp_hidden['home'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['home']);
       $sStyleHidden_home = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_home = 'display: none;';
   $sStyleReadInp_home = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['home']) && $this->nmgp_cmp_readonly['home'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['home']);
       $sStyleReadLab_home = '';
       $sStyleReadInp_home = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['home']) && $this->nmgp_cmp_hidden['home'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="home" value="<?php echo $this->form_encode_input($home) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_home_label" id="hidden_field_label_home" style="<?php echo $sStyleHidden_home; ?>"><span id="id_label_home"><?php echo $this->nm_new_label['home']; ?></span></TD>
    <TD class="scFormDataOdd css_home_line" id="hidden_field_data_home" style="<?php echo $sStyleHidden_home; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_home_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["home"]) &&  $this->nmgp_cmp_readonly["home"] == "on") { 

 ?>
<input type="hidden" name="home" value="<?php echo $this->form_encode_input($home) . "\">" . $home . ""; ?>
<?php } else { ?>
<span id="id_read_on_home" class="sc-ui-readonly-home css_home_line" style="<?php echo $sStyleReadLab_home; ?>"><?php echo $this->form_format_readonly("home", $this->form_encode_input($this->home)); ?></span><span id="id_read_off_home" class="css_read_off_home<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_home; ?>">
 <input class="sc-js-input scFormObjectOdd css_home_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_home" type=text name="home" value="<?php echo $this->form_encode_input($home) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_home_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_home_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['maritalstatus']))
    {
        $this->nm_new_label['maritalstatus'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_MaritalStatus'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $maritalstatus = $this->maritalstatus;
   $sStyleHidden_maritalstatus = '';
   if (isset($this->nmgp_cmp_hidden['maritalstatus']) && $this->nmgp_cmp_hidden['maritalstatus'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['maritalstatus']);
       $sStyleHidden_maritalstatus = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_maritalstatus = 'display: none;';
   $sStyleReadInp_maritalstatus = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['maritalstatus']) && $this->nmgp_cmp_readonly['maritalstatus'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['maritalstatus']);
       $sStyleReadLab_maritalstatus = '';
       $sStyleReadInp_maritalstatus = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['maritalstatus']) && $this->nmgp_cmp_hidden['maritalstatus'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="maritalstatus" value="<?php echo $this->form_encode_input($maritalstatus) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_maritalstatus_label" id="hidden_field_label_maritalstatus" style="<?php echo $sStyleHidden_maritalstatus; ?>"><span id="id_label_maritalstatus"><?php echo $this->nm_new_label['maritalstatus']; ?></span></TD>
    <TD class="scFormDataOdd css_maritalstatus_line" id="hidden_field_data_maritalstatus" style="<?php echo $sStyleHidden_maritalstatus; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_maritalstatus_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["maritalstatus"]) &&  $this->nmgp_cmp_readonly["maritalstatus"] == "on") { 

 ?>
<input type="hidden" name="maritalstatus" value="<?php echo $this->form_encode_input($maritalstatus) . "\">" . $maritalstatus . ""; ?>
<?php } else { ?>
<span id="id_read_on_maritalstatus" class="sc-ui-readonly-maritalstatus css_maritalstatus_line" style="<?php echo $sStyleReadLab_maritalstatus; ?>"><?php echo $this->form_format_readonly("maritalstatus", $this->form_encode_input($this->maritalstatus)); ?></span><span id="id_read_off_maritalstatus" class="css_read_off_maritalstatus<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_maritalstatus; ?>">
 <input class="sc-js-input scFormObjectOdd css_maritalstatus_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_maritalstatus" type=text name="maritalstatus" value="<?php echo $this->form_encode_input($maritalstatus) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_maritalstatus_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_maritalstatus_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['dateofidentification']))
    {
        $this->nm_new_label['dateofidentification'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_DateOfIdentification'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $old_dt_dateofidentification = $this->dateofidentification;
   if (strlen($this->dateofidentification_hora) > 8 ) {$this->dateofidentification_hora = substr($this->dateofidentification_hora, 0, 8);}
   $this->dateofidentification .= ' ' . $this->dateofidentification_hora;
   $this->dateofidentification  = trim($this->dateofidentification);
   $dateofidentification = $this->dateofidentification;
   $sStyleHidden_dateofidentification = '';
   if (isset($this->nmgp_cmp_hidden['dateofidentification']) && $this->nmgp_cmp_hidden['dateofidentification'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['dateofidentification']);
       $sStyleHidden_dateofidentification = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_dateofidentification = 'display: none;';
   $sStyleReadInp_dateofidentification = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['dateofidentification']) && $this->nmgp_cmp_readonly['dateofidentification'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['dateofidentification']);
       $sStyleReadLab_dateofidentification = '';
       $sStyleReadInp_dateofidentification = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['dateofidentification']) && $this->nmgp_cmp_hidden['dateofidentification'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="dateofidentification" value="<?php echo $this->form_encode_input($dateofidentification) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_dateofidentification_label" id="hidden_field_label_dateofidentification" style="<?php echo $sStyleHidden_dateofidentification; ?>"><span id="id_label_dateofidentification"><?php echo $this->nm_new_label['dateofidentification']; ?></span></TD>
    <TD class="scFormDataOdd css_dateofidentification_line" id="hidden_field_data_dateofidentification" style="<?php echo $sStyleHidden_dateofidentification; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_dateofidentification_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["dateofidentification"]) &&  $this->nmgp_cmp_readonly["dateofidentification"] == "on") { 

 ?>
<input type="hidden" name="dateofidentification" value="<?php echo $this->form_encode_input($dateofidentification) . "\">" . $dateofidentification . ""; ?>
<?php } else { ?>
<span id="id_read_on_dateofidentification" class="sc-ui-readonly-dateofidentification css_dateofidentification_line" style="<?php echo $sStyleReadLab_dateofidentification; ?>"><?php echo $this->form_format_readonly("dateofidentification", $this->form_encode_input($dateofidentification)); ?></span><span id="id_read_off_dateofidentification" class="css_read_off_dateofidentification<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_dateofidentification; ?>"><?php
$tmp_form_data = $this->field_config['dateofidentification']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
<?php
$miniCalendarButton = $this->jqueryButtonText('calendar');
if ('scButton_' == substr($miniCalendarButton[1], 0, 9)) {
    $miniCalendarButton[1] = substr($miniCalendarButton[1], 9);
}
?>
<span class='trigger-picker-<?php echo $miniCalendarButton[1]; ?>' style='display: inherit; width: 100%'>

 <input class="sc-js-input scFormObjectOdd css_dateofidentification_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_dateofidentification" type=text name="dateofidentification" value="<?php echo $this->form_encode_input($dateofidentification) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=18"; } ?> alt="{datatype: 'datetime', dateSep: '<?php echo $this->field_config['dateofidentification']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['dateofidentification']['date_format']; ?>', timeSep: '<?php echo $this->field_config['dateofidentification']['time_sep']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_dateofidentification_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_dateofidentification_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>
<?php
   $this->dateofidentification = $old_dt_dateofidentification;
?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['dateofdeath']))
    {
        $this->nm_new_label['dateofdeath'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_DateOfDeath'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $old_dt_dateofdeath = $this->dateofdeath;
   if (strlen($this->dateofdeath_hora) > 8 ) {$this->dateofdeath_hora = substr($this->dateofdeath_hora, 0, 8);}
   $this->dateofdeath .= ' ' . $this->dateofdeath_hora;
   $this->dateofdeath  = trim($this->dateofdeath);
   $dateofdeath = $this->dateofdeath;
   $sStyleHidden_dateofdeath = '';
   if (isset($this->nmgp_cmp_hidden['dateofdeath']) && $this->nmgp_cmp_hidden['dateofdeath'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['dateofdeath']);
       $sStyleHidden_dateofdeath = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_dateofdeath = 'display: none;';
   $sStyleReadInp_dateofdeath = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['dateofdeath']) && $this->nmgp_cmp_readonly['dateofdeath'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['dateofdeath']);
       $sStyleReadLab_dateofdeath = '';
       $sStyleReadInp_dateofdeath = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['dateofdeath']) && $this->nmgp_cmp_hidden['dateofdeath'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="dateofdeath" value="<?php echo $this->form_encode_input($dateofdeath) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_dateofdeath_label" id="hidden_field_label_dateofdeath" style="<?php echo $sStyleHidden_dateofdeath; ?>"><span id="id_label_dateofdeath"><?php echo $this->nm_new_label['dateofdeath']; ?></span></TD>
    <TD class="scFormDataOdd css_dateofdeath_line" id="hidden_field_data_dateofdeath" style="<?php echo $sStyleHidden_dateofdeath; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_dateofdeath_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["dateofdeath"]) &&  $this->nmgp_cmp_readonly["dateofdeath"] == "on") { 

 ?>
<input type="hidden" name="dateofdeath" value="<?php echo $this->form_encode_input($dateofdeath) . "\">" . $dateofdeath . ""; ?>
<?php } else { ?>
<span id="id_read_on_dateofdeath" class="sc-ui-readonly-dateofdeath css_dateofdeath_line" style="<?php echo $sStyleReadLab_dateofdeath; ?>"><?php echo $this->form_format_readonly("dateofdeath", $this->form_encode_input($dateofdeath)); ?></span><span id="id_read_off_dateofdeath" class="css_read_off_dateofdeath<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_dateofdeath; ?>"><?php
$tmp_form_data = $this->field_config['dateofdeath']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
<?php
$miniCalendarButton = $this->jqueryButtonText('calendar');
if ('scButton_' == substr($miniCalendarButton[1], 0, 9)) {
    $miniCalendarButton[1] = substr($miniCalendarButton[1], 9);
}
?>
<span class='trigger-picker-<?php echo $miniCalendarButton[1]; ?>' style='display: inherit; width: 100%'>

 <input class="sc-js-input scFormObjectOdd css_dateofdeath_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_dateofdeath" type=text name="dateofdeath" value="<?php echo $this->form_encode_input($dateofdeath) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=18"; } ?> alt="{datatype: 'datetime', dateSep: '<?php echo $this->field_config['dateofdeath']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['dateofdeath']['date_format']; ?>', timeSep: '<?php echo $this->field_config['dateofdeath']['time_sep']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_dateofdeath_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_dateofdeath_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>
<?php
   $this->dateofdeath = $old_dt_dateofdeath;
?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['marriagedate']))
    {
        $this->nm_new_label['marriagedate'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_MarriageDate'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $old_dt_marriagedate = $this->marriagedate;
   if (strlen($this->marriagedate_hora) > 8 ) {$this->marriagedate_hora = substr($this->marriagedate_hora, 0, 8);}
   $this->marriagedate .= ' ' . $this->marriagedate_hora;
   $this->marriagedate  = trim($this->marriagedate);
   $marriagedate = $this->marriagedate;
   $sStyleHidden_marriagedate = '';
   if (isset($this->nmgp_cmp_hidden['marriagedate']) && $this->nmgp_cmp_hidden['marriagedate'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['marriagedate']);
       $sStyleHidden_marriagedate = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_marriagedate = 'display: none;';
   $sStyleReadInp_marriagedate = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['marriagedate']) && $this->nmgp_cmp_readonly['marriagedate'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['marriagedate']);
       $sStyleReadLab_marriagedate = '';
       $sStyleReadInp_marriagedate = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['marriagedate']) && $this->nmgp_cmp_hidden['marriagedate'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="marriagedate" value="<?php echo $this->form_encode_input($marriagedate) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_marriagedate_label" id="hidden_field_label_marriagedate" style="<?php echo $sStyleHidden_marriagedate; ?>"><span id="id_label_marriagedate"><?php echo $this->nm_new_label['marriagedate']; ?></span></TD>
    <TD class="scFormDataOdd css_marriagedate_line" id="hidden_field_data_marriagedate" style="<?php echo $sStyleHidden_marriagedate; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_marriagedate_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["marriagedate"]) &&  $this->nmgp_cmp_readonly["marriagedate"] == "on") { 

 ?>
<input type="hidden" name="marriagedate" value="<?php echo $this->form_encode_input($marriagedate) . "\">" . $marriagedate . ""; ?>
<?php } else { ?>
<span id="id_read_on_marriagedate" class="sc-ui-readonly-marriagedate css_marriagedate_line" style="<?php echo $sStyleReadLab_marriagedate; ?>"><?php echo $this->form_format_readonly("marriagedate", $this->form_encode_input($marriagedate)); ?></span><span id="id_read_off_marriagedate" class="css_read_off_marriagedate<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_marriagedate; ?>"><?php
$tmp_form_data = $this->field_config['marriagedate']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
<?php
$miniCalendarButton = $this->jqueryButtonText('calendar');
if ('scButton_' == substr($miniCalendarButton[1], 0, 9)) {
    $miniCalendarButton[1] = substr($miniCalendarButton[1], 9);
}
?>
<span class='trigger-picker-<?php echo $miniCalendarButton[1]; ?>' style='display: inherit; width: 100%'>

 <input class="sc-js-input scFormObjectOdd css_marriagedate_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_marriagedate" type=text name="marriagedate" value="<?php echo $this->form_encode_input($marriagedate) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=18"; } ?> alt="{datatype: 'datetime', dateSep: '<?php echo $this->field_config['marriagedate']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['marriagedate']['date_format']; ?>', timeSep: '<?php echo $this->field_config['marriagedate']['time_sep']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_marriagedate_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_marriagedate_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>
<?php
   $this->marriagedate = $old_dt_marriagedate;
?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['instruction']))
    {
        $this->nm_new_label['instruction'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_Instruction'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $instruction = $this->instruction;
   $sStyleHidden_instruction = '';
   if (isset($this->nmgp_cmp_hidden['instruction']) && $this->nmgp_cmp_hidden['instruction'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['instruction']);
       $sStyleHidden_instruction = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_instruction = 'display: none;';
   $sStyleReadInp_instruction = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['instruction']) && $this->nmgp_cmp_readonly['instruction'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['instruction']);
       $sStyleReadLab_instruction = '';
       $sStyleReadInp_instruction = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['instruction']) && $this->nmgp_cmp_hidden['instruction'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="instruction" value="<?php echo $this->form_encode_input($instruction) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_instruction_label" id="hidden_field_label_instruction" style="<?php echo $sStyleHidden_instruction; ?>"><span id="id_label_instruction"><?php echo $this->nm_new_label['instruction']; ?></span></TD>
    <TD class="scFormDataOdd css_instruction_line" id="hidden_field_data_instruction" style="<?php echo $sStyleHidden_instruction; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_instruction_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["instruction"]) &&  $this->nmgp_cmp_readonly["instruction"] == "on") { 

 ?>
<input type="hidden" name="instruction" value="<?php echo $this->form_encode_input($instruction) . "\">" . $instruction . ""; ?>
<?php } else { ?>
<span id="id_read_on_instruction" class="sc-ui-readonly-instruction css_instruction_line" style="<?php echo $sStyleReadLab_instruction; ?>"><?php echo $this->form_format_readonly("instruction", $this->form_encode_input($this->instruction)); ?></span><span id="id_read_off_instruction" class="css_read_off_instruction<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_instruction; ?>">
 <input class="sc-js-input scFormObjectOdd css_instruction_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_instruction" type=text name="instruction" value="<?php echo $this->form_encode_input($instruction) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_instruction_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_instruction_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['placebirth']))
    {
        $this->nm_new_label['placebirth'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_PlaceBirth'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $placebirth = $this->placebirth;
   $sStyleHidden_placebirth = '';
   if (isset($this->nmgp_cmp_hidden['placebirth']) && $this->nmgp_cmp_hidden['placebirth'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['placebirth']);
       $sStyleHidden_placebirth = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_placebirth = 'display: none;';
   $sStyleReadInp_placebirth = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['placebirth']) && $this->nmgp_cmp_readonly['placebirth'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['placebirth']);
       $sStyleReadLab_placebirth = '';
       $sStyleReadInp_placebirth = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['placebirth']) && $this->nmgp_cmp_hidden['placebirth'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="placebirth" value="<?php echo $this->form_encode_input($placebirth) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_placebirth_label" id="hidden_field_label_placebirth" style="<?php echo $sStyleHidden_placebirth; ?>"><span id="id_label_placebirth"><?php echo $this->nm_new_label['placebirth']; ?></span></TD>
    <TD class="scFormDataOdd css_placebirth_line" id="hidden_field_data_placebirth" style="<?php echo $sStyleHidden_placebirth; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_placebirth_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["placebirth"]) &&  $this->nmgp_cmp_readonly["placebirth"] == "on") { 

 ?>
<input type="hidden" name="placebirth" value="<?php echo $this->form_encode_input($placebirth) . "\">" . $placebirth . ""; ?>
<?php } else { ?>
<span id="id_read_on_placebirth" class="sc-ui-readonly-placebirth css_placebirth_line" style="<?php echo $sStyleReadLab_placebirth; ?>"><?php echo $this->form_format_readonly("placebirth", $this->form_encode_input($this->placebirth)); ?></span><span id="id_read_off_placebirth" class="css_read_off_placebirth<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_placebirth; ?>">
 <input class="sc-js-input scFormObjectOdd css_placebirth_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_placebirth" type=text name="placebirth" value="<?php echo $this->form_encode_input($placebirth) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_placebirth_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_placebirth_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['nationality']))
    {
        $this->nm_new_label['nationality'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_Nationality'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $nationality = $this->nationality;
   $sStyleHidden_nationality = '';
   if (isset($this->nmgp_cmp_hidden['nationality']) && $this->nmgp_cmp_hidden['nationality'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['nationality']);
       $sStyleHidden_nationality = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_nationality = 'display: none;';
   $sStyleReadInp_nationality = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['nationality']) && $this->nmgp_cmp_readonly['nationality'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['nationality']);
       $sStyleReadLab_nationality = '';
       $sStyleReadInp_nationality = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['nationality']) && $this->nmgp_cmp_hidden['nationality'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="nationality" value="<?php echo $this->form_encode_input($nationality) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_nationality_label" id="hidden_field_label_nationality" style="<?php echo $sStyleHidden_nationality; ?>"><span id="id_label_nationality"><?php echo $this->nm_new_label['nationality']; ?></span></TD>
    <TD class="scFormDataOdd css_nationality_line" id="hidden_field_data_nationality" style="<?php echo $sStyleHidden_nationality; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_nationality_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["nationality"]) &&  $this->nmgp_cmp_readonly["nationality"] == "on") { 

 ?>
<input type="hidden" name="nationality" value="<?php echo $this->form_encode_input($nationality) . "\">" . $nationality . ""; ?>
<?php } else { ?>
<span id="id_read_on_nationality" class="sc-ui-readonly-nationality css_nationality_line" style="<?php echo $sStyleReadLab_nationality; ?>"><?php echo $this->form_format_readonly("nationality", $this->form_encode_input($this->nationality)); ?></span><span id="id_read_off_nationality" class="css_read_off_nationality<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_nationality; ?>">
 <input class="sc-js-input scFormObjectOdd css_nationality_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_nationality" type=text name="nationality" value="<?php echo $this->form_encode_input($nationality) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_nationality_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_nationality_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['mothername']))
    {
        $this->nm_new_label['mothername'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_MotherName'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $mothername = $this->mothername;
   $sStyleHidden_mothername = '';
   if (isset($this->nmgp_cmp_hidden['mothername']) && $this->nmgp_cmp_hidden['mothername'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['mothername']);
       $sStyleHidden_mothername = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_mothername = 'display: none;';
   $sStyleReadInp_mothername = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['mothername']) && $this->nmgp_cmp_readonly['mothername'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['mothername']);
       $sStyleReadLab_mothername = '';
       $sStyleReadInp_mothername = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['mothername']) && $this->nmgp_cmp_hidden['mothername'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="mothername" value="<?php echo $this->form_encode_input($mothername) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_mothername_label" id="hidden_field_label_mothername" style="<?php echo $sStyleHidden_mothername; ?>"><span id="id_label_mothername"><?php echo $this->nm_new_label['mothername']; ?></span></TD>
    <TD class="scFormDataOdd css_mothername_line" id="hidden_field_data_mothername" style="<?php echo $sStyleHidden_mothername; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_mothername_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["mothername"]) &&  $this->nmgp_cmp_readonly["mothername"] == "on") { 

 ?>
<input type="hidden" name="mothername" value="<?php echo $this->form_encode_input($mothername) . "\">" . $mothername . ""; ?>
<?php } else { ?>
<span id="id_read_on_mothername" class="sc-ui-readonly-mothername css_mothername_line" style="<?php echo $sStyleReadLab_mothername; ?>"><?php echo $this->form_format_readonly("mothername", $this->form_encode_input($this->mothername)); ?></span><span id="id_read_off_mothername" class="css_read_off_mothername<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_mothername; ?>">
 <input class="sc-js-input scFormObjectOdd css_mothername_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_mothername" type=text name="mothername" value="<?php echo $this->form_encode_input($mothername) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_mothername_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_mothername_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['fathername']))
    {
        $this->nm_new_label['fathername'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_FatherName'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $fathername = $this->fathername;
   $sStyleHidden_fathername = '';
   if (isset($this->nmgp_cmp_hidden['fathername']) && $this->nmgp_cmp_hidden['fathername'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['fathername']);
       $sStyleHidden_fathername = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_fathername = 'display: none;';
   $sStyleReadInp_fathername = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['fathername']) && $this->nmgp_cmp_readonly['fathername'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['fathername']);
       $sStyleReadLab_fathername = '';
       $sStyleReadInp_fathername = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['fathername']) && $this->nmgp_cmp_hidden['fathername'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="fathername" value="<?php echo $this->form_encode_input($fathername) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_fathername_label" id="hidden_field_label_fathername" style="<?php echo $sStyleHidden_fathername; ?>"><span id="id_label_fathername"><?php echo $this->nm_new_label['fathername']; ?></span></TD>
    <TD class="scFormDataOdd css_fathername_line" id="hidden_field_data_fathername" style="<?php echo $sStyleHidden_fathername; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_fathername_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["fathername"]) &&  $this->nmgp_cmp_readonly["fathername"] == "on") { 

 ?>
<input type="hidden" name="fathername" value="<?php echo $this->form_encode_input($fathername) . "\">" . $fathername . ""; ?>
<?php } else { ?>
<span id="id_read_on_fathername" class="sc-ui-readonly-fathername css_fathername_line" style="<?php echo $sStyleReadLab_fathername; ?>"><?php echo $this->form_format_readonly("fathername", $this->form_encode_input($this->fathername)); ?></span><span id="id_read_off_fathername" class="css_read_off_fathername<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_fathername; ?>">
 <input class="sc-js-input scFormObjectOdd css_fathername_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_fathername" type=text name="fathername" value="<?php echo $this->form_encode_input($fathername) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_fathername_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_fathername_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['housenumber']))
    {
        $this->nm_new_label['housenumber'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_HouseNumber'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $housenumber = $this->housenumber;
   $sStyleHidden_housenumber = '';
   if (isset($this->nmgp_cmp_hidden['housenumber']) && $this->nmgp_cmp_hidden['housenumber'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['housenumber']);
       $sStyleHidden_housenumber = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_housenumber = 'display: none;';
   $sStyleReadInp_housenumber = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['housenumber']) && $this->nmgp_cmp_readonly['housenumber'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['housenumber']);
       $sStyleReadLab_housenumber = '';
       $sStyleReadInp_housenumber = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['housenumber']) && $this->nmgp_cmp_hidden['housenumber'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="housenumber" value="<?php echo $this->form_encode_input($housenumber) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_housenumber_label" id="hidden_field_label_housenumber" style="<?php echo $sStyleHidden_housenumber; ?>"><span id="id_label_housenumber"><?php echo $this->nm_new_label['housenumber']; ?></span></TD>
    <TD class="scFormDataOdd css_housenumber_line" id="hidden_field_data_housenumber" style="<?php echo $sStyleHidden_housenumber; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_housenumber_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["housenumber"]) &&  $this->nmgp_cmp_readonly["housenumber"] == "on") { 

 ?>
<input type="hidden" name="housenumber" value="<?php echo $this->form_encode_input($housenumber) . "\">" . $housenumber . ""; ?>
<?php } else { ?>
<span id="id_read_on_housenumber" class="sc-ui-readonly-housenumber css_housenumber_line" style="<?php echo $sStyleReadLab_housenumber; ?>"><?php echo $this->form_format_readonly("housenumber", $this->form_encode_input($this->housenumber)); ?></span><span id="id_read_off_housenumber" class="css_read_off_housenumber<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_housenumber; ?>">
 <input class="sc-js-input scFormObjectOdd css_housenumber_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_housenumber" type=text name="housenumber" value="<?php echo $this->form_encode_input($housenumber) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_housenumber_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_housenumber_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['profession']))
    {
        $this->nm_new_label['profession'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_Profession'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $profession = $this->profession;
   $sStyleHidden_profession = '';
   if (isset($this->nmgp_cmp_hidden['profession']) && $this->nmgp_cmp_hidden['profession'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['profession']);
       $sStyleHidden_profession = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_profession = 'display: none;';
   $sStyleReadInp_profession = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['profession']) && $this->nmgp_cmp_readonly['profession'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['profession']);
       $sStyleReadLab_profession = '';
       $sStyleReadInp_profession = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['profession']) && $this->nmgp_cmp_hidden['profession'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="profession" value="<?php echo $this->form_encode_input($profession) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_profession_label" id="hidden_field_label_profession" style="<?php echo $sStyleHidden_profession; ?>"><span id="id_label_profession"><?php echo $this->nm_new_label['profession']; ?></span></TD>
    <TD class="scFormDataOdd css_profession_line" id="hidden_field_data_profession" style="<?php echo $sStyleHidden_profession; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_profession_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["profession"]) &&  $this->nmgp_cmp_readonly["profession"] == "on") { 

 ?>
<input type="hidden" name="profession" value="<?php echo $this->form_encode_input($profession) . "\">" . $profession . ""; ?>
<?php } else { ?>
<span id="id_read_on_profession" class="sc-ui-readonly-profession css_profession_line" style="<?php echo $sStyleReadLab_profession; ?>"><?php echo $this->form_format_readonly("profession", $this->form_encode_input($this->profession)); ?></span><span id="id_read_off_profession" class="css_read_off_profession<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_profession; ?>">
 <input class="sc-js-input scFormObjectOdd css_profession_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_profession" type=text name="profession" value="<?php echo $this->form_encode_input($profession) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_profession_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_profession_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['expeditioncity']))
    {
        $this->nm_new_label['expeditioncity'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_ExpeditionCity'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $expeditioncity = $this->expeditioncity;
   $sStyleHidden_expeditioncity = '';
   if (isset($this->nmgp_cmp_hidden['expeditioncity']) && $this->nmgp_cmp_hidden['expeditioncity'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['expeditioncity']);
       $sStyleHidden_expeditioncity = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_expeditioncity = 'display: none;';
   $sStyleReadInp_expeditioncity = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['expeditioncity']) && $this->nmgp_cmp_readonly['expeditioncity'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['expeditioncity']);
       $sStyleReadLab_expeditioncity = '';
       $sStyleReadInp_expeditioncity = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['expeditioncity']) && $this->nmgp_cmp_hidden['expeditioncity'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="expeditioncity" value="<?php echo $this->form_encode_input($expeditioncity) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_expeditioncity_label" id="hidden_field_label_expeditioncity" style="<?php echo $sStyleHidden_expeditioncity; ?>"><span id="id_label_expeditioncity"><?php echo $this->nm_new_label['expeditioncity']; ?></span></TD>
    <TD class="scFormDataOdd css_expeditioncity_line" id="hidden_field_data_expeditioncity" style="<?php echo $sStyleHidden_expeditioncity; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_expeditioncity_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["expeditioncity"]) &&  $this->nmgp_cmp_readonly["expeditioncity"] == "on") { 

 ?>
<input type="hidden" name="expeditioncity" value="<?php echo $this->form_encode_input($expeditioncity) . "\">" . $expeditioncity . ""; ?>
<?php } else { ?>
<span id="id_read_on_expeditioncity" class="sc-ui-readonly-expeditioncity css_expeditioncity_line" style="<?php echo $sStyleReadLab_expeditioncity; ?>"><?php echo $this->form_format_readonly("expeditioncity", $this->form_encode_input($this->expeditioncity)); ?></span><span id="id_read_off_expeditioncity" class="css_read_off_expeditioncity<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_expeditioncity; ?>">
 <input class="sc-js-input scFormObjectOdd css_expeditioncity_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_expeditioncity" type=text name="expeditioncity" value="<?php echo $this->form_encode_input($expeditioncity) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_expeditioncity_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_expeditioncity_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['expeditiondepartment']))
    {
        $this->nm_new_label['expeditiondepartment'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_ExpeditionDepartment'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $expeditiondepartment = $this->expeditiondepartment;
   $sStyleHidden_expeditiondepartment = '';
   if (isset($this->nmgp_cmp_hidden['expeditiondepartment']) && $this->nmgp_cmp_hidden['expeditiondepartment'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['expeditiondepartment']);
       $sStyleHidden_expeditiondepartment = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_expeditiondepartment = 'display: none;';
   $sStyleReadInp_expeditiondepartment = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['expeditiondepartment']) && $this->nmgp_cmp_readonly['expeditiondepartment'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['expeditiondepartment']);
       $sStyleReadLab_expeditiondepartment = '';
       $sStyleReadInp_expeditiondepartment = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['expeditiondepartment']) && $this->nmgp_cmp_hidden['expeditiondepartment'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="expeditiondepartment" value="<?php echo $this->form_encode_input($expeditiondepartment) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_expeditiondepartment_label" id="hidden_field_label_expeditiondepartment" style="<?php echo $sStyleHidden_expeditiondepartment; ?>"><span id="id_label_expeditiondepartment"><?php echo $this->nm_new_label['expeditiondepartment']; ?></span></TD>
    <TD class="scFormDataOdd css_expeditiondepartment_line" id="hidden_field_data_expeditiondepartment" style="<?php echo $sStyleHidden_expeditiondepartment; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_expeditiondepartment_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["expeditiondepartment"]) &&  $this->nmgp_cmp_readonly["expeditiondepartment"] == "on") { 

 ?>
<input type="hidden" name="expeditiondepartment" value="<?php echo $this->form_encode_input($expeditiondepartment) . "\">" . $expeditiondepartment . ""; ?>
<?php } else { ?>
<span id="id_read_on_expeditiondepartment" class="sc-ui-readonly-expeditiondepartment css_expeditiondepartment_line" style="<?php echo $sStyleReadLab_expeditiondepartment; ?>"><?php echo $this->form_format_readonly("expeditiondepartment", $this->form_encode_input($this->expeditiondepartment)); ?></span><span id="id_read_off_expeditiondepartment" class="css_read_off_expeditiondepartment<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_expeditiondepartment; ?>">
 <input class="sc-js-input scFormObjectOdd css_expeditiondepartment_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_expeditiondepartment" type=text name="expeditiondepartment" value="<?php echo $this->form_encode_input($expeditiondepartment) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_expeditiondepartment_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_expeditiondepartment_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['birthcity']))
    {
        $this->nm_new_label['birthcity'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_BirthCity'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $birthcity = $this->birthcity;
   $sStyleHidden_birthcity = '';
   if (isset($this->nmgp_cmp_hidden['birthcity']) && $this->nmgp_cmp_hidden['birthcity'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['birthcity']);
       $sStyleHidden_birthcity = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_birthcity = 'display: none;';
   $sStyleReadInp_birthcity = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['birthcity']) && $this->nmgp_cmp_readonly['birthcity'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['birthcity']);
       $sStyleReadLab_birthcity = '';
       $sStyleReadInp_birthcity = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['birthcity']) && $this->nmgp_cmp_hidden['birthcity'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="birthcity" value="<?php echo $this->form_encode_input($birthcity) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_birthcity_label" id="hidden_field_label_birthcity" style="<?php echo $sStyleHidden_birthcity; ?>"><span id="id_label_birthcity"><?php echo $this->nm_new_label['birthcity']; ?></span></TD>
    <TD class="scFormDataOdd css_birthcity_line" id="hidden_field_data_birthcity" style="<?php echo $sStyleHidden_birthcity; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_birthcity_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["birthcity"]) &&  $this->nmgp_cmp_readonly["birthcity"] == "on") { 

 ?>
<input type="hidden" name="birthcity" value="<?php echo $this->form_encode_input($birthcity) . "\">" . $birthcity . ""; ?>
<?php } else { ?>
<span id="id_read_on_birthcity" class="sc-ui-readonly-birthcity css_birthcity_line" style="<?php echo $sStyleReadLab_birthcity; ?>"><?php echo $this->form_format_readonly("birthcity", $this->form_encode_input($this->birthcity)); ?></span><span id="id_read_off_birthcity" class="css_read_off_birthcity<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_birthcity; ?>">
 <input class="sc-js-input scFormObjectOdd css_birthcity_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_birthcity" type=text name="birthcity" value="<?php echo $this->form_encode_input($birthcity) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_birthcity_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_birthcity_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['birthdepartment']))
    {
        $this->nm_new_label['birthdepartment'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_BirthDepartment'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $birthdepartment = $this->birthdepartment;
   $sStyleHidden_birthdepartment = '';
   if (isset($this->nmgp_cmp_hidden['birthdepartment']) && $this->nmgp_cmp_hidden['birthdepartment'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['birthdepartment']);
       $sStyleHidden_birthdepartment = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_birthdepartment = 'display: none;';
   $sStyleReadInp_birthdepartment = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['birthdepartment']) && $this->nmgp_cmp_readonly['birthdepartment'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['birthdepartment']);
       $sStyleReadLab_birthdepartment = '';
       $sStyleReadInp_birthdepartment = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['birthdepartment']) && $this->nmgp_cmp_hidden['birthdepartment'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="birthdepartment" value="<?php echo $this->form_encode_input($birthdepartment) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_birthdepartment_label" id="hidden_field_label_birthdepartment" style="<?php echo $sStyleHidden_birthdepartment; ?>"><span id="id_label_birthdepartment"><?php echo $this->nm_new_label['birthdepartment']; ?></span></TD>
    <TD class="scFormDataOdd css_birthdepartment_line" id="hidden_field_data_birthdepartment" style="<?php echo $sStyleHidden_birthdepartment; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_birthdepartment_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["birthdepartment"]) &&  $this->nmgp_cmp_readonly["birthdepartment"] == "on") { 

 ?>
<input type="hidden" name="birthdepartment" value="<?php echo $this->form_encode_input($birthdepartment) . "\">" . $birthdepartment . ""; ?>
<?php } else { ?>
<span id="id_read_on_birthdepartment" class="sc-ui-readonly-birthdepartment css_birthdepartment_line" style="<?php echo $sStyleReadLab_birthdepartment; ?>"><?php echo $this->form_format_readonly("birthdepartment", $this->form_encode_input($this->birthdepartment)); ?></span><span id="id_read_off_birthdepartment" class="css_read_off_birthdepartment<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_birthdepartment; ?>">
 <input class="sc-js-input scFormObjectOdd css_birthdepartment_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_birthdepartment" type=text name="birthdepartment" value="<?php echo $this->form_encode_input($birthdepartment) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_birthdepartment_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_birthdepartment_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['transactiontype']))
    {
        $this->nm_new_label['transactiontype'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_TransactionType'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $transactiontype = $this->transactiontype;
   $sStyleHidden_transactiontype = '';
   if (isset($this->nmgp_cmp_hidden['transactiontype']) && $this->nmgp_cmp_hidden['transactiontype'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['transactiontype']);
       $sStyleHidden_transactiontype = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_transactiontype = 'display: none;';
   $sStyleReadInp_transactiontype = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['transactiontype']) && $this->nmgp_cmp_readonly['transactiontype'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['transactiontype']);
       $sStyleReadLab_transactiontype = '';
       $sStyleReadInp_transactiontype = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['transactiontype']) && $this->nmgp_cmp_hidden['transactiontype'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="transactiontype" value="<?php echo $this->form_encode_input($transactiontype) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_transactiontype_label" id="hidden_field_label_transactiontype" style="<?php echo $sStyleHidden_transactiontype; ?>"><span id="id_label_transactiontype"><?php echo $this->nm_new_label['transactiontype']; ?></span></TD>
    <TD class="scFormDataOdd css_transactiontype_line" id="hidden_field_data_transactiontype" style="<?php echo $sStyleHidden_transactiontype; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_transactiontype_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["transactiontype"]) &&  $this->nmgp_cmp_readonly["transactiontype"] == "on") { 

 ?>
<input type="hidden" name="transactiontype" value="<?php echo $this->form_encode_input($transactiontype) . "\">" . $transactiontype . ""; ?>
<?php } else { ?>
<span id="id_read_on_transactiontype" class="sc-ui-readonly-transactiontype css_transactiontype_line" style="<?php echo $sStyleReadLab_transactiontype; ?>"><?php echo $this->form_format_readonly("transactiontype", $this->form_encode_input($this->transactiontype)); ?></span><span id="id_read_off_transactiontype" class="css_read_off_transactiontype<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_transactiontype; ?>">
 <input class="sc-js-input scFormObjectOdd css_transactiontype_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_transactiontype" type=text name="transactiontype" value="<?php echo $this->form_encode_input($transactiontype) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_transactiontype_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_transactiontype_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['transactiontypename']))
    {
        $this->nm_new_label['transactiontypename'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_TransactionTypeName'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $transactiontypename = $this->transactiontypename;
   $sStyleHidden_transactiontypename = '';
   if (isset($this->nmgp_cmp_hidden['transactiontypename']) && $this->nmgp_cmp_hidden['transactiontypename'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['transactiontypename']);
       $sStyleHidden_transactiontypename = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_transactiontypename = 'display: none;';
   $sStyleReadInp_transactiontypename = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['transactiontypename']) && $this->nmgp_cmp_readonly['transactiontypename'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['transactiontypename']);
       $sStyleReadLab_transactiontypename = '';
       $sStyleReadInp_transactiontypename = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['transactiontypename']) && $this->nmgp_cmp_hidden['transactiontypename'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="transactiontypename" value="<?php echo $this->form_encode_input($transactiontypename) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_transactiontypename_label" id="hidden_field_label_transactiontypename" style="<?php echo $sStyleHidden_transactiontypename; ?>"><span id="id_label_transactiontypename"><?php echo $this->nm_new_label['transactiontypename']; ?></span></TD>
    <TD class="scFormDataOdd css_transactiontypename_line" id="hidden_field_data_transactiontypename" style="<?php echo $sStyleHidden_transactiontypename; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_transactiontypename_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["transactiontypename"]) &&  $this->nmgp_cmp_readonly["transactiontypename"] == "on") { 

 ?>
<input type="hidden" name="transactiontypename" value="<?php echo $this->form_encode_input($transactiontypename) . "\">" . $transactiontypename . ""; ?>
<?php } else { ?>
<span id="id_read_on_transactiontypename" class="sc-ui-readonly-transactiontypename css_transactiontypename_line" style="<?php echo $sStyleReadLab_transactiontypename; ?>"><?php echo $this->form_format_readonly("transactiontypename", $this->form_encode_input($this->transactiontypename)); ?></span><span id="id_read_off_transactiontypename" class="css_read_off_transactiontypename<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_transactiontypename; ?>">
 <input class="sc-js-input scFormObjectOdd css_transactiontypename_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_transactiontypename" type=text name="transactiontypename" value="<?php echo $this->form_encode_input($transactiontypename) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_transactiontypename_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_transactiontypename_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['issuedate']))
    {
        $this->nm_new_label['issuedate'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_IssueDate'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $old_dt_issuedate = $this->issuedate;
   if (strlen($this->issuedate_hora) > 8 ) {$this->issuedate_hora = substr($this->issuedate_hora, 0, 8);}
   $this->issuedate .= ' ' . $this->issuedate_hora;
   $this->issuedate  = trim($this->issuedate);
   $issuedate = $this->issuedate;
   $sStyleHidden_issuedate = '';
   if (isset($this->nmgp_cmp_hidden['issuedate']) && $this->nmgp_cmp_hidden['issuedate'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['issuedate']);
       $sStyleHidden_issuedate = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_issuedate = 'display: none;';
   $sStyleReadInp_issuedate = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['issuedate']) && $this->nmgp_cmp_readonly['issuedate'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['issuedate']);
       $sStyleReadLab_issuedate = '';
       $sStyleReadInp_issuedate = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['issuedate']) && $this->nmgp_cmp_hidden['issuedate'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="issuedate" value="<?php echo $this->form_encode_input($issuedate) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_issuedate_label" id="hidden_field_label_issuedate" style="<?php echo $sStyleHidden_issuedate; ?>"><span id="id_label_issuedate"><?php echo $this->nm_new_label['issuedate']; ?></span></TD>
    <TD class="scFormDataOdd css_issuedate_line" id="hidden_field_data_issuedate" style="<?php echo $sStyleHidden_issuedate; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_issuedate_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["issuedate"]) &&  $this->nmgp_cmp_readonly["issuedate"] == "on") { 

 ?>
<input type="hidden" name="issuedate" value="<?php echo $this->form_encode_input($issuedate) . "\">" . $issuedate . ""; ?>
<?php } else { ?>
<span id="id_read_on_issuedate" class="sc-ui-readonly-issuedate css_issuedate_line" style="<?php echo $sStyleReadLab_issuedate; ?>"><?php echo $this->form_format_readonly("issuedate", $this->form_encode_input($issuedate)); ?></span><span id="id_read_off_issuedate" class="css_read_off_issuedate<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_issuedate; ?>"><?php
$tmp_form_data = $this->field_config['issuedate']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
<?php
$miniCalendarButton = $this->jqueryButtonText('calendar');
if ('scButton_' == substr($miniCalendarButton[1], 0, 9)) {
    $miniCalendarButton[1] = substr($miniCalendarButton[1], 9);
}
?>
<span class='trigger-picker-<?php echo $miniCalendarButton[1]; ?>' style='display: inherit; width: 100%'>

 <input class="sc-js-input scFormObjectOdd css_issuedate_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_issuedate" type=text name="issuedate" value="<?php echo $this->form_encode_input($issuedate) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=18"; } ?> alt="{datatype: 'datetime', dateSep: '<?php echo $this->field_config['issuedate']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['issuedate']['date_format']; ?>', timeSep: '<?php echo $this->field_config['issuedate']['time_sep']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_issuedate_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_issuedate_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>
<?php
   $this->issuedate = $old_dt_issuedate;
?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['barcodetext']))
    {
        $this->nm_new_label['barcodetext'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_BarcodeText'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $barcodetext = $this->barcodetext;
   $sStyleHidden_barcodetext = '';
   if (isset($this->nmgp_cmp_hidden['barcodetext']) && $this->nmgp_cmp_hidden['barcodetext'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['barcodetext']);
       $sStyleHidden_barcodetext = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_barcodetext = 'display: none;';
   $sStyleReadInp_barcodetext = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['barcodetext']) && $this->nmgp_cmp_readonly['barcodetext'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['barcodetext']);
       $sStyleReadLab_barcodetext = '';
       $sStyleReadInp_barcodetext = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['barcodetext']) && $this->nmgp_cmp_hidden['barcodetext'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="barcodetext" value="<?php echo $this->form_encode_input($barcodetext) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_barcodetext_label" id="hidden_field_label_barcodetext" style="<?php echo $sStyleHidden_barcodetext; ?>"><span id="id_label_barcodetext"><?php echo $this->nm_new_label['barcodetext']; ?></span></TD>
    <TD class="scFormDataOdd css_barcodetext_line" id="hidden_field_data_barcodetext" style="<?php echo $sStyleHidden_barcodetext; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_barcodetext_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["barcodetext"]) &&  $this->nmgp_cmp_readonly["barcodetext"] == "on") { 

 ?>
<input type="hidden" name="barcodetext" value="<?php echo $this->form_encode_input($barcodetext) . "\">" . $barcodetext . ""; ?>
<?php } else { ?>
<span id="id_read_on_barcodetext" class="sc-ui-readonly-barcodetext css_barcodetext_line" style="<?php echo $sStyleReadLab_barcodetext; ?>"><?php echo $this->form_format_readonly("barcodetext", $this->form_encode_input($this->barcodetext)); ?></span><span id="id_read_off_barcodetext" class="css_read_off_barcodetext<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_barcodetext; ?>">
 <input class="sc-js-input scFormObjectOdd css_barcodetext_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_barcodetext" type=text name="barcodetext" value="<?php echo $this->form_encode_input($barcodetext) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_barcodetext_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_barcodetext_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['ocrtextsideone']))
    {
        $this->nm_new_label['ocrtextsideone'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_OcrTextSideOne'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $ocrtextsideone = $this->ocrtextsideone;
   $sStyleHidden_ocrtextsideone = '';
   if (isset($this->nmgp_cmp_hidden['ocrtextsideone']) && $this->nmgp_cmp_hidden['ocrtextsideone'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['ocrtextsideone']);
       $sStyleHidden_ocrtextsideone = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_ocrtextsideone = 'display: none;';
   $sStyleReadInp_ocrtextsideone = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['ocrtextsideone']) && $this->nmgp_cmp_readonly['ocrtextsideone'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['ocrtextsideone']);
       $sStyleReadLab_ocrtextsideone = '';
       $sStyleReadInp_ocrtextsideone = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['ocrtextsideone']) && $this->nmgp_cmp_hidden['ocrtextsideone'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="ocrtextsideone" value="<?php echo $this->form_encode_input($ocrtextsideone) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_ocrtextsideone_label" id="hidden_field_label_ocrtextsideone" style="<?php echo $sStyleHidden_ocrtextsideone; ?>"><span id="id_label_ocrtextsideone"><?php echo $this->nm_new_label['ocrtextsideone']; ?></span></TD>
    <TD class="scFormDataOdd css_ocrtextsideone_line" id="hidden_field_data_ocrtextsideone" style="<?php echo $sStyleHidden_ocrtextsideone; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_ocrtextsideone_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["ocrtextsideone"]) &&  $this->nmgp_cmp_readonly["ocrtextsideone"] == "on") { 

 ?>
<input type="hidden" name="ocrtextsideone" value="<?php echo $this->form_encode_input($ocrtextsideone) . "\">" . $ocrtextsideone . ""; ?>
<?php } else { ?>
<span id="id_read_on_ocrtextsideone" class="sc-ui-readonly-ocrtextsideone css_ocrtextsideone_line" style="<?php echo $sStyleReadLab_ocrtextsideone; ?>"><?php echo $this->form_format_readonly("ocrtextsideone", $this->form_encode_input($this->ocrtextsideone)); ?></span><span id="id_read_off_ocrtextsideone" class="css_read_off_ocrtextsideone<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_ocrtextsideone; ?>">
 <input class="sc-js-input scFormObjectOdd css_ocrtextsideone_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_ocrtextsideone" type=text name="ocrtextsideone" value="<?php echo $this->form_encode_input($ocrtextsideone) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_ocrtextsideone_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_ocrtextsideone_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['ocrtextsidetwo']))
    {
        $this->nm_new_label['ocrtextsidetwo'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_OcrTextSideTwo'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $ocrtextsidetwo = $this->ocrtextsidetwo;
   $sStyleHidden_ocrtextsidetwo = '';
   if (isset($this->nmgp_cmp_hidden['ocrtextsidetwo']) && $this->nmgp_cmp_hidden['ocrtextsidetwo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['ocrtextsidetwo']);
       $sStyleHidden_ocrtextsidetwo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_ocrtextsidetwo = 'display: none;';
   $sStyleReadInp_ocrtextsidetwo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['ocrtextsidetwo']) && $this->nmgp_cmp_readonly['ocrtextsidetwo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['ocrtextsidetwo']);
       $sStyleReadLab_ocrtextsidetwo = '';
       $sStyleReadInp_ocrtextsidetwo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['ocrtextsidetwo']) && $this->nmgp_cmp_hidden['ocrtextsidetwo'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="ocrtextsidetwo" value="<?php echo $this->form_encode_input($ocrtextsidetwo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_ocrtextsidetwo_label" id="hidden_field_label_ocrtextsidetwo" style="<?php echo $sStyleHidden_ocrtextsidetwo; ?>"><span id="id_label_ocrtextsidetwo"><?php echo $this->nm_new_label['ocrtextsidetwo']; ?></span></TD>
    <TD class="scFormDataOdd css_ocrtextsidetwo_line" id="hidden_field_data_ocrtextsidetwo" style="<?php echo $sStyleHidden_ocrtextsidetwo; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_ocrtextsidetwo_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["ocrtextsidetwo"]) &&  $this->nmgp_cmp_readonly["ocrtextsidetwo"] == "on") { 

 ?>
<input type="hidden" name="ocrtextsidetwo" value="<?php echo $this->form_encode_input($ocrtextsidetwo) . "\">" . $ocrtextsidetwo . ""; ?>
<?php } else { ?>
<span id="id_read_on_ocrtextsidetwo" class="sc-ui-readonly-ocrtextsidetwo css_ocrtextsidetwo_line" style="<?php echo $sStyleReadLab_ocrtextsidetwo; ?>"><?php echo $this->form_format_readonly("ocrtextsidetwo", $this->form_encode_input($this->ocrtextsidetwo)); ?></span><span id="id_read_off_ocrtextsidetwo" class="css_read_off_ocrtextsidetwo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_ocrtextsidetwo; ?>">
 <input class="sc-js-input scFormObjectOdd css_ocrtextsidetwo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_ocrtextsidetwo" type=text name="ocrtextsidetwo" value="<?php echo $this->form_encode_input($ocrtextsidetwo) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_ocrtextsidetwo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_ocrtextsidetwo_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['sideonewrongattempts']))
    {
        $this->nm_new_label['sideonewrongattempts'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_SideOneWrongAttempts'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $sideonewrongattempts = $this->sideonewrongattempts;
   $sStyleHidden_sideonewrongattempts = '';
   if (isset($this->nmgp_cmp_hidden['sideonewrongattempts']) && $this->nmgp_cmp_hidden['sideonewrongattempts'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['sideonewrongattempts']);
       $sStyleHidden_sideonewrongattempts = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_sideonewrongattempts = 'display: none;';
   $sStyleReadInp_sideonewrongattempts = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['sideonewrongattempts']) && $this->nmgp_cmp_readonly['sideonewrongattempts'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['sideonewrongattempts']);
       $sStyleReadLab_sideonewrongattempts = '';
       $sStyleReadInp_sideonewrongattempts = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['sideonewrongattempts']) && $this->nmgp_cmp_hidden['sideonewrongattempts'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="sideonewrongattempts" value="<?php echo $this->form_encode_input($sideonewrongattempts) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_sideonewrongattempts_label" id="hidden_field_label_sideonewrongattempts" style="<?php echo $sStyleHidden_sideonewrongattempts; ?>"><span id="id_label_sideonewrongattempts"><?php echo $this->nm_new_label['sideonewrongattempts']; ?></span></TD>
    <TD class="scFormDataOdd css_sideonewrongattempts_line" id="hidden_field_data_sideonewrongattempts" style="<?php echo $sStyleHidden_sideonewrongattempts; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_sideonewrongattempts_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["sideonewrongattempts"]) &&  $this->nmgp_cmp_readonly["sideonewrongattempts"] == "on") { 

 ?>
<input type="hidden" name="sideonewrongattempts" value="<?php echo $this->form_encode_input($sideonewrongattempts) . "\">" . $sideonewrongattempts . ""; ?>
<?php } else { ?>
<span id="id_read_on_sideonewrongattempts" class="sc-ui-readonly-sideonewrongattempts css_sideonewrongattempts_line" style="<?php echo $sStyleReadLab_sideonewrongattempts; ?>"><?php echo $this->form_format_readonly("sideonewrongattempts", $this->form_encode_input($this->sideonewrongattempts)); ?></span><span id="id_read_off_sideonewrongattempts" class="css_read_off_sideonewrongattempts<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_sideonewrongattempts; ?>">
 <input class="sc-js-input scFormObjectOdd css_sideonewrongattempts_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_sideonewrongattempts" type=text name="sideonewrongattempts" value="<?php echo $this->form_encode_input($sideonewrongattempts) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_sideonewrongattempts_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_sideonewrongattempts_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['sidetwowrongattempts']))
    {
        $this->nm_new_label['sidetwowrongattempts'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_SideTwoWrongAttempts'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $sidetwowrongattempts = $this->sidetwowrongattempts;
   $sStyleHidden_sidetwowrongattempts = '';
   if (isset($this->nmgp_cmp_hidden['sidetwowrongattempts']) && $this->nmgp_cmp_hidden['sidetwowrongattempts'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['sidetwowrongattempts']);
       $sStyleHidden_sidetwowrongattempts = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_sidetwowrongattempts = 'display: none;';
   $sStyleReadInp_sidetwowrongattempts = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['sidetwowrongattempts']) && $this->nmgp_cmp_readonly['sidetwowrongattempts'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['sidetwowrongattempts']);
       $sStyleReadLab_sidetwowrongattempts = '';
       $sStyleReadInp_sidetwowrongattempts = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['sidetwowrongattempts']) && $this->nmgp_cmp_hidden['sidetwowrongattempts'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="sidetwowrongattempts" value="<?php echo $this->form_encode_input($sidetwowrongattempts) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_sidetwowrongattempts_label" id="hidden_field_label_sidetwowrongattempts" style="<?php echo $sStyleHidden_sidetwowrongattempts; ?>"><span id="id_label_sidetwowrongattempts"><?php echo $this->nm_new_label['sidetwowrongattempts']; ?></span></TD>
    <TD class="scFormDataOdd css_sidetwowrongattempts_line" id="hidden_field_data_sidetwowrongattempts" style="<?php echo $sStyleHidden_sidetwowrongattempts; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_sidetwowrongattempts_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["sidetwowrongattempts"]) &&  $this->nmgp_cmp_readonly["sidetwowrongattempts"] == "on") { 

 ?>
<input type="hidden" name="sidetwowrongattempts" value="<?php echo $this->form_encode_input($sidetwowrongattempts) . "\">" . $sidetwowrongattempts . ""; ?>
<?php } else { ?>
<span id="id_read_on_sidetwowrongattempts" class="sc-ui-readonly-sidetwowrongattempts css_sidetwowrongattempts_line" style="<?php echo $sStyleReadLab_sidetwowrongattempts; ?>"><?php echo $this->form_format_readonly("sidetwowrongattempts", $this->form_encode_input($this->sidetwowrongattempts)); ?></span><span id="id_read_off_sidetwowrongattempts" class="css_read_off_sidetwowrongattempts<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_sidetwowrongattempts; ?>">
 <input class="sc-js-input scFormObjectOdd css_sidetwowrongattempts_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_sidetwowrongattempts" type=text name="sidetwowrongattempts" value="<?php echo $this->form_encode_input($sidetwowrongattempts) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_sidetwowrongattempts_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_sidetwowrongattempts_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['foundonadoalert']))
    {
        $this->nm_new_label['foundonadoalert'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_FoundOnAdoAlert'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $foundonadoalert = $this->foundonadoalert;
   $sStyleHidden_foundonadoalert = '';
   if (isset($this->nmgp_cmp_hidden['foundonadoalert']) && $this->nmgp_cmp_hidden['foundonadoalert'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['foundonadoalert']);
       $sStyleHidden_foundonadoalert = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_foundonadoalert = 'display: none;';
   $sStyleReadInp_foundonadoalert = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['foundonadoalert']) && $this->nmgp_cmp_readonly['foundonadoalert'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['foundonadoalert']);
       $sStyleReadLab_foundonadoalert = '';
       $sStyleReadInp_foundonadoalert = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['foundonadoalert']) && $this->nmgp_cmp_hidden['foundonadoalert'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="foundonadoalert" value="<?php echo $this->form_encode_input($foundonadoalert) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_foundonadoalert_label" id="hidden_field_label_foundonadoalert" style="<?php echo $sStyleHidden_foundonadoalert; ?>"><span id="id_label_foundonadoalert"><?php echo $this->nm_new_label['foundonadoalert']; ?></span></TD>
    <TD class="scFormDataOdd css_foundonadoalert_line" id="hidden_field_data_foundonadoalert" style="<?php echo $sStyleHidden_foundonadoalert; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_foundonadoalert_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["foundonadoalert"]) &&  $this->nmgp_cmp_readonly["foundonadoalert"] == "on") { 

 ?>
<input type="hidden" name="foundonadoalert" value="<?php echo $this->form_encode_input($foundonadoalert) . "\">" . $foundonadoalert . ""; ?>
<?php } else { ?>
<span id="id_read_on_foundonadoalert" class="sc-ui-readonly-foundonadoalert css_foundonadoalert_line" style="<?php echo $sStyleReadLab_foundonadoalert; ?>"><?php echo $this->form_format_readonly("foundonadoalert", $this->form_encode_input($this->foundonadoalert)); ?></span><span id="id_read_off_foundonadoalert" class="css_read_off_foundonadoalert<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_foundonadoalert; ?>">
 <input class="sc-js-input scFormObjectOdd css_foundonadoalert_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_foundonadoalert" type=text name="foundonadoalert" value="<?php echo $this->form_encode_input($foundonadoalert) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_foundonadoalert_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_foundonadoalert_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['adoprojectid']))
    {
        $this->nm_new_label['adoprojectid'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_AdoProjectId'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $adoprojectid = $this->adoprojectid;
   $sStyleHidden_adoprojectid = '';
   if (isset($this->nmgp_cmp_hidden['adoprojectid']) && $this->nmgp_cmp_hidden['adoprojectid'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['adoprojectid']);
       $sStyleHidden_adoprojectid = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_adoprojectid = 'display: none;';
   $sStyleReadInp_adoprojectid = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['adoprojectid']) && $this->nmgp_cmp_readonly['adoprojectid'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['adoprojectid']);
       $sStyleReadLab_adoprojectid = '';
       $sStyleReadInp_adoprojectid = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['adoprojectid']) && $this->nmgp_cmp_hidden['adoprojectid'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="adoprojectid" value="<?php echo $this->form_encode_input($adoprojectid) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_adoprojectid_label" id="hidden_field_label_adoprojectid" style="<?php echo $sStyleHidden_adoprojectid; ?>"><span id="id_label_adoprojectid"><?php echo $this->nm_new_label['adoprojectid']; ?></span></TD>
    <TD class="scFormDataOdd css_adoprojectid_line" id="hidden_field_data_adoprojectid" style="<?php echo $sStyleHidden_adoprojectid; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_adoprojectid_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["adoprojectid"]) &&  $this->nmgp_cmp_readonly["adoprojectid"] == "on") { 

 ?>
<input type="hidden" name="adoprojectid" value="<?php echo $this->form_encode_input($adoprojectid) . "\">" . $adoprojectid . ""; ?>
<?php } else { ?>
<span id="id_read_on_adoprojectid" class="sc-ui-readonly-adoprojectid css_adoprojectid_line" style="<?php echo $sStyleReadLab_adoprojectid; ?>"><?php echo $this->form_format_readonly("adoprojectid", $this->form_encode_input($this->adoprojectid)); ?></span><span id="id_read_off_adoprojectid" class="css_read_off_adoprojectid<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_adoprojectid; ?>">
 <input class="sc-js-input scFormObjectOdd css_adoprojectid_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_adoprojectid" type=text name="adoprojectid" value="<?php echo $this->form_encode_input($adoprojectid) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_adoprojectid_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_adoprojectid_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['transactionid']))
    {
        $this->nm_new_label['transactionid'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_TransactionId'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $transactionid = $this->transactionid;
   $sStyleHidden_transactionid = '';
   if (isset($this->nmgp_cmp_hidden['transactionid']) && $this->nmgp_cmp_hidden['transactionid'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['transactionid']);
       $sStyleHidden_transactionid = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_transactionid = 'display: none;';
   $sStyleReadInp_transactionid = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['transactionid']) && $this->nmgp_cmp_readonly['transactionid'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['transactionid']);
       $sStyleReadLab_transactionid = '';
       $sStyleReadInp_transactionid = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['transactionid']) && $this->nmgp_cmp_hidden['transactionid'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="transactionid" value="<?php echo $this->form_encode_input($transactionid) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_transactionid_label" id="hidden_field_label_transactionid" style="<?php echo $sStyleHidden_transactionid; ?>"><span id="id_label_transactionid"><?php echo $this->nm_new_label['transactionid']; ?></span></TD>
    <TD class="scFormDataOdd css_transactionid_line" id="hidden_field_data_transactionid" style="<?php echo $sStyleHidden_transactionid; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_transactionid_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["transactionid"]) &&  $this->nmgp_cmp_readonly["transactionid"] == "on") { 

 ?>
<input type="hidden" name="transactionid" value="<?php echo $this->form_encode_input($transactionid) . "\">" . $transactionid . ""; ?>
<?php } else { ?>
<span id="id_read_on_transactionid" class="sc-ui-readonly-transactionid css_transactionid_line" style="<?php echo $sStyleReadLab_transactionid; ?>"><?php echo $this->form_format_readonly("transactionid", $this->form_encode_input($this->transactionid)); ?></span><span id="id_read_off_transactionid" class="css_read_off_transactionid<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_transactionid; ?>">
 <input class="sc-js-input scFormObjectOdd css_transactionid_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_transactionid" type=text name="transactionid" value="<?php echo $this->form_encode_input($transactionid) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_transactionid_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_transactionid_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['productid']))
    {
        $this->nm_new_label['productid'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_ProductId'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $productid = $this->productid;
   $sStyleHidden_productid = '';
   if (isset($this->nmgp_cmp_hidden['productid']) && $this->nmgp_cmp_hidden['productid'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['productid']);
       $sStyleHidden_productid = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_productid = 'display: none;';
   $sStyleReadInp_productid = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['productid']) && $this->nmgp_cmp_readonly['productid'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['productid']);
       $sStyleReadLab_productid = '';
       $sStyleReadInp_productid = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['productid']) && $this->nmgp_cmp_hidden['productid'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="productid" value="<?php echo $this->form_encode_input($productid) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_productid_label" id="hidden_field_label_productid" style="<?php echo $sStyleHidden_productid; ?>"><span id="id_label_productid"><?php echo $this->nm_new_label['productid']; ?></span></TD>
    <TD class="scFormDataOdd css_productid_line" id="hidden_field_data_productid" style="<?php echo $sStyleHidden_productid; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_productid_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["productid"]) &&  $this->nmgp_cmp_readonly["productid"] == "on") { 

 ?>
<input type="hidden" name="productid" value="<?php echo $this->form_encode_input($productid) . "\">" . $productid . ""; ?>
<?php } else { ?>
<span id="id_read_on_productid" class="sc-ui-readonly-productid css_productid_line" style="<?php echo $sStyleReadLab_productid; ?>"><?php echo $this->form_format_readonly("productid", $this->form_encode_input($this->productid)); ?></span><span id="id_read_off_productid" class="css_read_off_productid<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_productid; ?>">
 <input class="sc-js-input scFormObjectOdd css_productid_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_productid" type=text name="productid" value="<?php echo $this->form_encode_input($productid) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_productid_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_productid_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['comparationfacessuccesful']))
    {
        $this->nm_new_label['comparationfacessuccesful'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_ComparationFacesSuccesful'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $comparationfacessuccesful = $this->comparationfacessuccesful;
   $sStyleHidden_comparationfacessuccesful = '';
   if (isset($this->nmgp_cmp_hidden['comparationfacessuccesful']) && $this->nmgp_cmp_hidden['comparationfacessuccesful'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['comparationfacessuccesful']);
       $sStyleHidden_comparationfacessuccesful = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_comparationfacessuccesful = 'display: none;';
   $sStyleReadInp_comparationfacessuccesful = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['comparationfacessuccesful']) && $this->nmgp_cmp_readonly['comparationfacessuccesful'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['comparationfacessuccesful']);
       $sStyleReadLab_comparationfacessuccesful = '';
       $sStyleReadInp_comparationfacessuccesful = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['comparationfacessuccesful']) && $this->nmgp_cmp_hidden['comparationfacessuccesful'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="comparationfacessuccesful" value="<?php echo $this->form_encode_input($comparationfacessuccesful) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_comparationfacessuccesful_label" id="hidden_field_label_comparationfacessuccesful" style="<?php echo $sStyleHidden_comparationfacessuccesful; ?>"><span id="id_label_comparationfacessuccesful"><?php echo $this->nm_new_label['comparationfacessuccesful']; ?></span></TD>
    <TD class="scFormDataOdd css_comparationfacessuccesful_line" id="hidden_field_data_comparationfacessuccesful" style="<?php echo $sStyleHidden_comparationfacessuccesful; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_comparationfacessuccesful_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["comparationfacessuccesful"]) &&  $this->nmgp_cmp_readonly["comparationfacessuccesful"] == "on") { 

 ?>
<input type="hidden" name="comparationfacessuccesful" value="<?php echo $this->form_encode_input($comparationfacessuccesful) . "\">" . $comparationfacessuccesful . ""; ?>
<?php } else { ?>
<span id="id_read_on_comparationfacessuccesful" class="sc-ui-readonly-comparationfacessuccesful css_comparationfacessuccesful_line" style="<?php echo $sStyleReadLab_comparationfacessuccesful; ?>"><?php echo $this->form_format_readonly("comparationfacessuccesful", $this->form_encode_input($this->comparationfacessuccesful)); ?></span><span id="id_read_off_comparationfacessuccesful" class="css_read_off_comparationfacessuccesful<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_comparationfacessuccesful; ?>">
 <input class="sc-js-input scFormObjectOdd css_comparationfacessuccesful_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_comparationfacessuccesful" type=text name="comparationfacessuccesful" value="<?php echo $this->form_encode_input($comparationfacessuccesful) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_comparationfacessuccesful_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_comparationfacessuccesful_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['facefound']))
    {
        $this->nm_new_label['facefound'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_FaceFound'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $facefound = $this->facefound;
   $sStyleHidden_facefound = '';
   if (isset($this->nmgp_cmp_hidden['facefound']) && $this->nmgp_cmp_hidden['facefound'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['facefound']);
       $sStyleHidden_facefound = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_facefound = 'display: none;';
   $sStyleReadInp_facefound = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['facefound']) && $this->nmgp_cmp_readonly['facefound'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['facefound']);
       $sStyleReadLab_facefound = '';
       $sStyleReadInp_facefound = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['facefound']) && $this->nmgp_cmp_hidden['facefound'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="facefound" value="<?php echo $this->form_encode_input($facefound) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_facefound_label" id="hidden_field_label_facefound" style="<?php echo $sStyleHidden_facefound; ?>"><span id="id_label_facefound"><?php echo $this->nm_new_label['facefound']; ?></span></TD>
    <TD class="scFormDataOdd css_facefound_line" id="hidden_field_data_facefound" style="<?php echo $sStyleHidden_facefound; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_facefound_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["facefound"]) &&  $this->nmgp_cmp_readonly["facefound"] == "on") { 

 ?>
<input type="hidden" name="facefound" value="<?php echo $this->form_encode_input($facefound) . "\">" . $facefound . ""; ?>
<?php } else { ?>
<span id="id_read_on_facefound" class="sc-ui-readonly-facefound css_facefound_line" style="<?php echo $sStyleReadLab_facefound; ?>"><?php echo $this->form_format_readonly("facefound", $this->form_encode_input($this->facefound)); ?></span><span id="id_read_off_facefound" class="css_read_off_facefound<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_facefound; ?>">
 <input class="sc-js-input scFormObjectOdd css_facefound_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_facefound" type=text name="facefound" value="<?php echo $this->form_encode_input($facefound) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_facefound_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_facefound_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['facedocumentfrontfound']))
    {
        $this->nm_new_label['facedocumentfrontfound'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_FaceDocumentFrontFound'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $facedocumentfrontfound = $this->facedocumentfrontfound;
   $sStyleHidden_facedocumentfrontfound = '';
   if (isset($this->nmgp_cmp_hidden['facedocumentfrontfound']) && $this->nmgp_cmp_hidden['facedocumentfrontfound'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['facedocumentfrontfound']);
       $sStyleHidden_facedocumentfrontfound = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_facedocumentfrontfound = 'display: none;';
   $sStyleReadInp_facedocumentfrontfound = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['facedocumentfrontfound']) && $this->nmgp_cmp_readonly['facedocumentfrontfound'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['facedocumentfrontfound']);
       $sStyleReadLab_facedocumentfrontfound = '';
       $sStyleReadInp_facedocumentfrontfound = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['facedocumentfrontfound']) && $this->nmgp_cmp_hidden['facedocumentfrontfound'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="facedocumentfrontfound" value="<?php echo $this->form_encode_input($facedocumentfrontfound) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_facedocumentfrontfound_label" id="hidden_field_label_facedocumentfrontfound" style="<?php echo $sStyleHidden_facedocumentfrontfound; ?>"><span id="id_label_facedocumentfrontfound"><?php echo $this->nm_new_label['facedocumentfrontfound']; ?></span></TD>
    <TD class="scFormDataOdd css_facedocumentfrontfound_line" id="hidden_field_data_facedocumentfrontfound" style="<?php echo $sStyleHidden_facedocumentfrontfound; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_facedocumentfrontfound_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["facedocumentfrontfound"]) &&  $this->nmgp_cmp_readonly["facedocumentfrontfound"] == "on") { 

 ?>
<input type="hidden" name="facedocumentfrontfound" value="<?php echo $this->form_encode_input($facedocumentfrontfound) . "\">" . $facedocumentfrontfound . ""; ?>
<?php } else { ?>
<span id="id_read_on_facedocumentfrontfound" class="sc-ui-readonly-facedocumentfrontfound css_facedocumentfrontfound_line" style="<?php echo $sStyleReadLab_facedocumentfrontfound; ?>"><?php echo $this->form_format_readonly("facedocumentfrontfound", $this->form_encode_input($this->facedocumentfrontfound)); ?></span><span id="id_read_off_facedocumentfrontfound" class="css_read_off_facedocumentfrontfound<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_facedocumentfrontfound; ?>">
 <input class="sc-js-input scFormObjectOdd css_facedocumentfrontfound_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_facedocumentfrontfound" type=text name="facedocumentfrontfound" value="<?php echo $this->form_encode_input($facedocumentfrontfound) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_facedocumentfrontfound_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_facedocumentfrontfound_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['barcodefound']))
    {
        $this->nm_new_label['barcodefound'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_BarcodeFound'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $barcodefound = $this->barcodefound;
   $sStyleHidden_barcodefound = '';
   if (isset($this->nmgp_cmp_hidden['barcodefound']) && $this->nmgp_cmp_hidden['barcodefound'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['barcodefound']);
       $sStyleHidden_barcodefound = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_barcodefound = 'display: none;';
   $sStyleReadInp_barcodefound = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['barcodefound']) && $this->nmgp_cmp_readonly['barcodefound'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['barcodefound']);
       $sStyleReadLab_barcodefound = '';
       $sStyleReadInp_barcodefound = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['barcodefound']) && $this->nmgp_cmp_hidden['barcodefound'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="barcodefound" value="<?php echo $this->form_encode_input($barcodefound) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_barcodefound_label" id="hidden_field_label_barcodefound" style="<?php echo $sStyleHidden_barcodefound; ?>"><span id="id_label_barcodefound"><?php echo $this->nm_new_label['barcodefound']; ?></span></TD>
    <TD class="scFormDataOdd css_barcodefound_line" id="hidden_field_data_barcodefound" style="<?php echo $sStyleHidden_barcodefound; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_barcodefound_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["barcodefound"]) &&  $this->nmgp_cmp_readonly["barcodefound"] == "on") { 

 ?>
<input type="hidden" name="barcodefound" value="<?php echo $this->form_encode_input($barcodefound) . "\">" . $barcodefound . ""; ?>
<?php } else { ?>
<span id="id_read_on_barcodefound" class="sc-ui-readonly-barcodefound css_barcodefound_line" style="<?php echo $sStyleReadLab_barcodefound; ?>"><?php echo $this->form_format_readonly("barcodefound", $this->form_encode_input($this->barcodefound)); ?></span><span id="id_read_off_barcodefound" class="css_read_off_barcodefound<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_barcodefound; ?>">
 <input class="sc-js-input scFormObjectOdd css_barcodefound_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_barcodefound" type=text name="barcodefound" value="<?php echo $this->form_encode_input($barcodefound) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_barcodefound_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_barcodefound_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['resultcomparationfaces']))
    {
        $this->nm_new_label['resultcomparationfaces'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_ResultComparationFaces'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $resultcomparationfaces = $this->resultcomparationfaces;
   $sStyleHidden_resultcomparationfaces = '';
   if (isset($this->nmgp_cmp_hidden['resultcomparationfaces']) && $this->nmgp_cmp_hidden['resultcomparationfaces'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['resultcomparationfaces']);
       $sStyleHidden_resultcomparationfaces = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_resultcomparationfaces = 'display: none;';
   $sStyleReadInp_resultcomparationfaces = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['resultcomparationfaces']) && $this->nmgp_cmp_readonly['resultcomparationfaces'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['resultcomparationfaces']);
       $sStyleReadLab_resultcomparationfaces = '';
       $sStyleReadInp_resultcomparationfaces = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['resultcomparationfaces']) && $this->nmgp_cmp_hidden['resultcomparationfaces'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="resultcomparationfaces" value="<?php echo $this->form_encode_input($resultcomparationfaces) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_resultcomparationfaces_label" id="hidden_field_label_resultcomparationfaces" style="<?php echo $sStyleHidden_resultcomparationfaces; ?>"><span id="id_label_resultcomparationfaces"><?php echo $this->nm_new_label['resultcomparationfaces']; ?></span></TD>
    <TD class="scFormDataOdd css_resultcomparationfaces_line" id="hidden_field_data_resultcomparationfaces" style="<?php echo $sStyleHidden_resultcomparationfaces; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_resultcomparationfaces_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["resultcomparationfaces"]) &&  $this->nmgp_cmp_readonly["resultcomparationfaces"] == "on") { 

 ?>
<input type="hidden" name="resultcomparationfaces" value="<?php echo $this->form_encode_input($resultcomparationfaces) . "\">" . $resultcomparationfaces . ""; ?>
<?php } else { ?>
<span id="id_read_on_resultcomparationfaces" class="sc-ui-readonly-resultcomparationfaces css_resultcomparationfaces_line" style="<?php echo $sStyleReadLab_resultcomparationfaces; ?>"><?php echo $this->form_format_readonly("resultcomparationfaces", $this->form_encode_input($this->resultcomparationfaces)); ?></span><span id="id_read_off_resultcomparationfaces" class="css_read_off_resultcomparationfaces<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_resultcomparationfaces; ?>">
 <input class="sc-js-input scFormObjectOdd css_resultcomparationfaces_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_resultcomparationfaces" type=text name="resultcomparationfaces" value="<?php echo $this->form_encode_input($resultcomparationfaces) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_resultcomparationfaces_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_resultcomparationfaces_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['comparationfacesaproved']))
    {
        $this->nm_new_label['comparationfacesaproved'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_ComparationFacesAproved'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $comparationfacesaproved = $this->comparationfacesaproved;
   $sStyleHidden_comparationfacesaproved = '';
   if (isset($this->nmgp_cmp_hidden['comparationfacesaproved']) && $this->nmgp_cmp_hidden['comparationfacesaproved'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['comparationfacesaproved']);
       $sStyleHidden_comparationfacesaproved = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_comparationfacesaproved = 'display: none;';
   $sStyleReadInp_comparationfacesaproved = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['comparationfacesaproved']) && $this->nmgp_cmp_readonly['comparationfacesaproved'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['comparationfacesaproved']);
       $sStyleReadLab_comparationfacesaproved = '';
       $sStyleReadInp_comparationfacesaproved = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['comparationfacesaproved']) && $this->nmgp_cmp_hidden['comparationfacesaproved'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="comparationfacesaproved" value="<?php echo $this->form_encode_input($comparationfacesaproved) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_comparationfacesaproved_label" id="hidden_field_label_comparationfacesaproved" style="<?php echo $sStyleHidden_comparationfacesaproved; ?>"><span id="id_label_comparationfacesaproved"><?php echo $this->nm_new_label['comparationfacesaproved']; ?></span></TD>
    <TD class="scFormDataOdd css_comparationfacesaproved_line" id="hidden_field_data_comparationfacesaproved" style="<?php echo $sStyleHidden_comparationfacesaproved; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_comparationfacesaproved_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["comparationfacesaproved"]) &&  $this->nmgp_cmp_readonly["comparationfacesaproved"] == "on") { 

 ?>
<input type="hidden" name="comparationfacesaproved" value="<?php echo $this->form_encode_input($comparationfacesaproved) . "\">" . $comparationfacesaproved . ""; ?>
<?php } else { ?>
<span id="id_read_on_comparationfacesaproved" class="sc-ui-readonly-comparationfacesaproved css_comparationfacesaproved_line" style="<?php echo $sStyleReadLab_comparationfacesaproved; ?>"><?php echo $this->form_format_readonly("comparationfacesaproved", $this->form_encode_input($this->comparationfacesaproved)); ?></span><span id="id_read_off_comparationfacesaproved" class="css_read_off_comparationfacesaproved<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_comparationfacesaproved; ?>">
 <input class="sc-js-input scFormObjectOdd css_comparationfacesaproved_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_comparationfacesaproved" type=text name="comparationfacesaproved" value="<?php echo $this->form_encode_input($comparationfacesaproved) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_comparationfacesaproved_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_comparationfacesaproved_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['extras']))
    {
        $this->nm_new_label['extras'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_Extras'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $extras = $this->extras;
   $sStyleHidden_extras = '';
   if (isset($this->nmgp_cmp_hidden['extras']) && $this->nmgp_cmp_hidden['extras'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['extras']);
       $sStyleHidden_extras = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_extras = 'display: none;';
   $sStyleReadInp_extras = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['extras']) && $this->nmgp_cmp_readonly['extras'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['extras']);
       $sStyleReadLab_extras = '';
       $sStyleReadInp_extras = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['extras']) && $this->nmgp_cmp_hidden['extras'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="extras" value="<?php echo $this->form_encode_input($extras) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_extras_label" id="hidden_field_label_extras" style="<?php echo $sStyleHidden_extras; ?>"><span id="id_label_extras"><?php echo $this->nm_new_label['extras']; ?></span></TD>
    <TD class="scFormDataOdd css_extras_line" id="hidden_field_data_extras" style="<?php echo $sStyleHidden_extras; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_extras_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["extras"]) &&  $this->nmgp_cmp_readonly["extras"] == "on") { 

 ?>
<input type="hidden" name="extras" value="<?php echo $this->form_encode_input($extras) . "\">" . $extras . ""; ?>
<?php } else { ?>
<span id="id_read_on_extras" class="sc-ui-readonly-extras css_extras_line" style="<?php echo $sStyleReadLab_extras; ?>"><?php echo $this->form_format_readonly("extras", $this->form_encode_input($this->extras)); ?></span><span id="id_read_off_extras" class="css_read_off_extras<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_extras; ?>">
 <input class="sc-js-input scFormObjectOdd css_extras_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_extras" type=text name="extras" value="<?php echo $this->form_encode_input($extras) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=1000 alt="{datatype: 'text', maxLength: 1000, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_extras_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_extras_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['numberphone']))
    {
        $this->nm_new_label['numberphone'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_NumberPhone'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $numberphone = $this->numberphone;
   $sStyleHidden_numberphone = '';
   if (isset($this->nmgp_cmp_hidden['numberphone']) && $this->nmgp_cmp_hidden['numberphone'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['numberphone']);
       $sStyleHidden_numberphone = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_numberphone = 'display: none;';
   $sStyleReadInp_numberphone = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['numberphone']) && $this->nmgp_cmp_readonly['numberphone'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['numberphone']);
       $sStyleReadLab_numberphone = '';
       $sStyleReadInp_numberphone = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['numberphone']) && $this->nmgp_cmp_hidden['numberphone'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="numberphone" value="<?php echo $this->form_encode_input($numberphone) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_numberphone_label" id="hidden_field_label_numberphone" style="<?php echo $sStyleHidden_numberphone; ?>"><span id="id_label_numberphone"><?php echo $this->nm_new_label['numberphone']; ?></span></TD>
    <TD class="scFormDataOdd css_numberphone_line" id="hidden_field_data_numberphone" style="<?php echo $sStyleHidden_numberphone; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_numberphone_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["numberphone"]) &&  $this->nmgp_cmp_readonly["numberphone"] == "on") { 

 ?>
<input type="hidden" name="numberphone" value="<?php echo $this->form_encode_input($numberphone) . "\">" . $numberphone . ""; ?>
<?php } else { ?>
<span id="id_read_on_numberphone" class="sc-ui-readonly-numberphone css_numberphone_line" style="<?php echo $sStyleReadLab_numberphone; ?>"><?php echo $this->form_format_readonly("numberphone", $this->form_encode_input($this->numberphone)); ?></span><span id="id_read_off_numberphone" class="css_read_off_numberphone<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_numberphone; ?>">
 <input class="sc-js-input scFormObjectOdd css_numberphone_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_numberphone" type=text name="numberphone" value="<?php echo $this->form_encode_input($numberphone) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_numberphone_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_numberphone_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['codfingerprint']))
    {
        $this->nm_new_label['codfingerprint'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_CodFingerprint'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $codfingerprint = $this->codfingerprint;
   $sStyleHidden_codfingerprint = '';
   if (isset($this->nmgp_cmp_hidden['codfingerprint']) && $this->nmgp_cmp_hidden['codfingerprint'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['codfingerprint']);
       $sStyleHidden_codfingerprint = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_codfingerprint = 'display: none;';
   $sStyleReadInp_codfingerprint = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['codfingerprint']) && $this->nmgp_cmp_readonly['codfingerprint'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['codfingerprint']);
       $sStyleReadLab_codfingerprint = '';
       $sStyleReadInp_codfingerprint = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['codfingerprint']) && $this->nmgp_cmp_hidden['codfingerprint'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="codfingerprint" value="<?php echo $this->form_encode_input($codfingerprint) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_codfingerprint_label" id="hidden_field_label_codfingerprint" style="<?php echo $sStyleHidden_codfingerprint; ?>"><span id="id_label_codfingerprint"><?php echo $this->nm_new_label['codfingerprint']; ?></span></TD>
    <TD class="scFormDataOdd css_codfingerprint_line" id="hidden_field_data_codfingerprint" style="<?php echo $sStyleHidden_codfingerprint; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_codfingerprint_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["codfingerprint"]) &&  $this->nmgp_cmp_readonly["codfingerprint"] == "on") { 

 ?>
<input type="hidden" name="codfingerprint" value="<?php echo $this->form_encode_input($codfingerprint) . "\">" . $codfingerprint . ""; ?>
<?php } else { ?>
<span id="id_read_on_codfingerprint" class="sc-ui-readonly-codfingerprint css_codfingerprint_line" style="<?php echo $sStyleReadLab_codfingerprint; ?>"><?php echo $this->form_format_readonly("codfingerprint", $this->form_encode_input($this->codfingerprint)); ?></span><span id="id_read_off_codfingerprint" class="css_read_off_codfingerprint<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_codfingerprint; ?>">
 <input class="sc-js-input scFormObjectOdd css_codfingerprint_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_codfingerprint" type=text name="codfingerprint" value="<?php echo $this->form_encode_input($codfingerprint) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_codfingerprint_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_codfingerprint_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['resultqrcode']))
    {
        $this->nm_new_label['resultqrcode'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_ResultQRCode'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $resultqrcode = $this->resultqrcode;
   $sStyleHidden_resultqrcode = '';
   if (isset($this->nmgp_cmp_hidden['resultqrcode']) && $this->nmgp_cmp_hidden['resultqrcode'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['resultqrcode']);
       $sStyleHidden_resultqrcode = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_resultqrcode = 'display: none;';
   $sStyleReadInp_resultqrcode = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['resultqrcode']) && $this->nmgp_cmp_readonly['resultqrcode'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['resultqrcode']);
       $sStyleReadLab_resultqrcode = '';
       $sStyleReadInp_resultqrcode = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['resultqrcode']) && $this->nmgp_cmp_hidden['resultqrcode'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="resultqrcode" value="<?php echo $this->form_encode_input($resultqrcode) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_resultqrcode_label" id="hidden_field_label_resultqrcode" style="<?php echo $sStyleHidden_resultqrcode; ?>"><span id="id_label_resultqrcode"><?php echo $this->nm_new_label['resultqrcode']; ?></span></TD>
    <TD class="scFormDataOdd css_resultqrcode_line" id="hidden_field_data_resultqrcode" style="<?php echo $sStyleHidden_resultqrcode; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_resultqrcode_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["resultqrcode"]) &&  $this->nmgp_cmp_readonly["resultqrcode"] == "on") { 

 ?>
<input type="hidden" name="resultqrcode" value="<?php echo $this->form_encode_input($resultqrcode) . "\">" . $resultqrcode . ""; ?>
<?php } else { ?>
<span id="id_read_on_resultqrcode" class="sc-ui-readonly-resultqrcode css_resultqrcode_line" style="<?php echo $sStyleReadLab_resultqrcode; ?>"><?php echo $this->form_format_readonly("resultqrcode", $this->form_encode_input($this->resultqrcode)); ?></span><span id="id_read_off_resultqrcode" class="css_read_off_resultqrcode<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_resultqrcode; ?>">
 <input class="sc-js-input scFormObjectOdd css_resultqrcode_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_resultqrcode" type=text name="resultqrcode" value="<?php echo $this->form_encode_input($resultqrcode) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_resultqrcode_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_resultqrcode_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['dactilarcode']))
    {
        $this->nm_new_label['dactilarcode'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_DactilarCode'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $dactilarcode = $this->dactilarcode;
   $sStyleHidden_dactilarcode = '';
   if (isset($this->nmgp_cmp_hidden['dactilarcode']) && $this->nmgp_cmp_hidden['dactilarcode'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['dactilarcode']);
       $sStyleHidden_dactilarcode = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_dactilarcode = 'display: none;';
   $sStyleReadInp_dactilarcode = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['dactilarcode']) && $this->nmgp_cmp_readonly['dactilarcode'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['dactilarcode']);
       $sStyleReadLab_dactilarcode = '';
       $sStyleReadInp_dactilarcode = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['dactilarcode']) && $this->nmgp_cmp_hidden['dactilarcode'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="dactilarcode" value="<?php echo $this->form_encode_input($dactilarcode) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_dactilarcode_label" id="hidden_field_label_dactilarcode" style="<?php echo $sStyleHidden_dactilarcode; ?>"><span id="id_label_dactilarcode"><?php echo $this->nm_new_label['dactilarcode']; ?></span></TD>
    <TD class="scFormDataOdd css_dactilarcode_line" id="hidden_field_data_dactilarcode" style="<?php echo $sStyleHidden_dactilarcode; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_dactilarcode_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["dactilarcode"]) &&  $this->nmgp_cmp_readonly["dactilarcode"] == "on") { 

 ?>
<input type="hidden" name="dactilarcode" value="<?php echo $this->form_encode_input($dactilarcode) . "\">" . $dactilarcode . ""; ?>
<?php } else { ?>
<span id="id_read_on_dactilarcode" class="sc-ui-readonly-dactilarcode css_dactilarcode_line" style="<?php echo $sStyleReadLab_dactilarcode; ?>"><?php echo $this->form_format_readonly("dactilarcode", $this->form_encode_input($this->dactilarcode)); ?></span><span id="id_read_off_dactilarcode" class="css_read_off_dactilarcode<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_dactilarcode; ?>">
 <input class="sc-js-input scFormObjectOdd css_dactilarcode_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_dactilarcode" type=text name="dactilarcode" value="<?php echo $this->form_encode_input($dactilarcode) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_dactilarcode_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_dactilarcode_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['reponsecontrollist']))
    {
        $this->nm_new_label['reponsecontrollist'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_ReponseControlList'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $reponsecontrollist = $this->reponsecontrollist;
   $sStyleHidden_reponsecontrollist = '';
   if (isset($this->nmgp_cmp_hidden['reponsecontrollist']) && $this->nmgp_cmp_hidden['reponsecontrollist'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['reponsecontrollist']);
       $sStyleHidden_reponsecontrollist = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_reponsecontrollist = 'display: none;';
   $sStyleReadInp_reponsecontrollist = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['reponsecontrollist']) && $this->nmgp_cmp_readonly['reponsecontrollist'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['reponsecontrollist']);
       $sStyleReadLab_reponsecontrollist = '';
       $sStyleReadInp_reponsecontrollist = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['reponsecontrollist']) && $this->nmgp_cmp_hidden['reponsecontrollist'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="reponsecontrollist" value="<?php echo $this->form_encode_input($reponsecontrollist) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_reponsecontrollist_label" id="hidden_field_label_reponsecontrollist" style="<?php echo $sStyleHidden_reponsecontrollist; ?>"><span id="id_label_reponsecontrollist"><?php echo $this->nm_new_label['reponsecontrollist']; ?></span></TD>
    <TD class="scFormDataOdd css_reponsecontrollist_line" id="hidden_field_data_reponsecontrollist" style="<?php echo $sStyleHidden_reponsecontrollist; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_reponsecontrollist_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["reponsecontrollist"]) &&  $this->nmgp_cmp_readonly["reponsecontrollist"] == "on") { 

 ?>
<input type="hidden" name="reponsecontrollist" value="<?php echo $this->form_encode_input($reponsecontrollist) . "\">" . $reponsecontrollist . ""; ?>
<?php } else { ?>
<span id="id_read_on_reponsecontrollist" class="sc-ui-readonly-reponsecontrollist css_reponsecontrollist_line" style="<?php echo $sStyleReadLab_reponsecontrollist; ?>"><?php echo $this->form_format_readonly("reponsecontrollist", $this->form_encode_input($this->reponsecontrollist)); ?></span><span id="id_read_off_reponsecontrollist" class="css_read_off_reponsecontrollist<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_reponsecontrollist; ?>">
 <input class="sc-js-input scFormObjectOdd css_reponsecontrollist_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_reponsecontrollist" type=text name="reponsecontrollist" value="<?php echo $this->form_encode_input($reponsecontrollist) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_reponsecontrollist_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_reponsecontrollist_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['images']))
    {
        $this->nm_new_label['images'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_Images'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $images = $this->images;
   $sStyleHidden_images = '';
   if (isset($this->nmgp_cmp_hidden['images']) && $this->nmgp_cmp_hidden['images'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['images']);
       $sStyleHidden_images = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_images = 'display: none;';
   $sStyleReadInp_images = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['images']) && $this->nmgp_cmp_readonly['images'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['images']);
       $sStyleReadLab_images = '';
       $sStyleReadInp_images = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['images']) && $this->nmgp_cmp_hidden['images'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="images" value="<?php echo $this->form_encode_input($images) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_images_label" id="hidden_field_label_images" style="<?php echo $sStyleHidden_images; ?>"><span id="id_label_images"><?php echo $this->nm_new_label['images']; ?></span></TD>
    <TD class="scFormDataOdd css_images_line" id="hidden_field_data_images" style="<?php echo $sStyleHidden_images; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_images_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["images"]) &&  $this->nmgp_cmp_readonly["images"] == "on") { 

 ?>
<input type="hidden" name="images" value="<?php echo $this->form_encode_input($images) . "\">" . $images . ""; ?>
<?php } else { ?>
<span id="id_read_on_images" class="sc-ui-readonly-images css_images_line" style="<?php echo $sStyleReadLab_images; ?>"><?php echo $this->form_format_readonly("images", $this->form_encode_input($this->images)); ?></span><span id="id_read_off_images" class="css_read_off_images<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_images; ?>">
 <input class="sc-js-input scFormObjectOdd css_images_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_images" type=text name="images" value="<?php echo $this->form_encode_input($images) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_images_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_images_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['signeddocuments']))
    {
        $this->nm_new_label['signeddocuments'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_SignedDocuments'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $signeddocuments = $this->signeddocuments;
   $sStyleHidden_signeddocuments = '';
   if (isset($this->nmgp_cmp_hidden['signeddocuments']) && $this->nmgp_cmp_hidden['signeddocuments'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['signeddocuments']);
       $sStyleHidden_signeddocuments = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_signeddocuments = 'display: none;';
   $sStyleReadInp_signeddocuments = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['signeddocuments']) && $this->nmgp_cmp_readonly['signeddocuments'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['signeddocuments']);
       $sStyleReadLab_signeddocuments = '';
       $sStyleReadInp_signeddocuments = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['signeddocuments']) && $this->nmgp_cmp_hidden['signeddocuments'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="signeddocuments" value="<?php echo $this->form_encode_input($signeddocuments) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_signeddocuments_label" id="hidden_field_label_signeddocuments" style="<?php echo $sStyleHidden_signeddocuments; ?>"><span id="id_label_signeddocuments"><?php echo $this->nm_new_label['signeddocuments']; ?></span></TD>
    <TD class="scFormDataOdd css_signeddocuments_line" id="hidden_field_data_signeddocuments" style="<?php echo $sStyleHidden_signeddocuments; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_signeddocuments_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["signeddocuments"]) &&  $this->nmgp_cmp_readonly["signeddocuments"] == "on") { 

 ?>
<input type="hidden" name="signeddocuments" value="<?php echo $this->form_encode_input($signeddocuments) . "\">" . $signeddocuments . ""; ?>
<?php } else { ?>
<span id="id_read_on_signeddocuments" class="sc-ui-readonly-signeddocuments css_signeddocuments_line" style="<?php echo $sStyleReadLab_signeddocuments; ?>"><?php echo $this->form_format_readonly("signeddocuments", $this->form_encode_input($this->signeddocuments)); ?></span><span id="id_read_off_signeddocuments" class="css_read_off_signeddocuments<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_signeddocuments; ?>">
 <input class="sc-js-input scFormObjectOdd css_signeddocuments_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_signeddocuments" type=text name="signeddocuments" value="<?php echo $this->form_encode_input($signeddocuments) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_signeddocuments_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_signeddocuments_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['scores']))
    {
        $this->nm_new_label['scores'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_Scores'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $scores = $this->scores;
   $sStyleHidden_scores = '';
   if (isset($this->nmgp_cmp_hidden['scores']) && $this->nmgp_cmp_hidden['scores'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['scores']);
       $sStyleHidden_scores = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_scores = 'display: none;';
   $sStyleReadInp_scores = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['scores']) && $this->nmgp_cmp_readonly['scores'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['scores']);
       $sStyleReadLab_scores = '';
       $sStyleReadInp_scores = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['scores']) && $this->nmgp_cmp_hidden['scores'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="scores" value="<?php echo $this->form_encode_input($scores) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_scores_label" id="hidden_field_label_scores" style="<?php echo $sStyleHidden_scores; ?>"><span id="id_label_scores"><?php echo $this->nm_new_label['scores']; ?></span></TD>
    <TD class="scFormDataOdd css_scores_line" id="hidden_field_data_scores" style="<?php echo $sStyleHidden_scores; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_scores_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["scores"]) &&  $this->nmgp_cmp_readonly["scores"] == "on") { 

 ?>
<input type="hidden" name="scores" value="<?php echo $this->form_encode_input($scores) . "\">" . $scores . ""; ?>
<?php } else { ?>
<span id="id_read_on_scores" class="sc-ui-readonly-scores css_scores_line" style="<?php echo $sStyleReadLab_scores; ?>"><?php echo $this->form_format_readonly("scores", $this->form_encode_input($this->scores)); ?></span><span id="id_read_off_scores" class="css_read_off_scores<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_scores; ?>">
 <input class="sc-js-input scFormObjectOdd css_scores_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_scores" type=text name="scores" value="<?php echo $this->form_encode_input($scores) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_scores_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_scores_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['response_ani']))
    {
        $this->nm_new_label['response_ani'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_Response_ANI'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $response_ani = $this->response_ani;
   $sStyleHidden_response_ani = '';
   if (isset($this->nmgp_cmp_hidden['response_ani']) && $this->nmgp_cmp_hidden['response_ani'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['response_ani']);
       $sStyleHidden_response_ani = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_response_ani = 'display: none;';
   $sStyleReadInp_response_ani = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['response_ani']) && $this->nmgp_cmp_readonly['response_ani'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['response_ani']);
       $sStyleReadLab_response_ani = '';
       $sStyleReadInp_response_ani = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['response_ani']) && $this->nmgp_cmp_hidden['response_ani'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="response_ani" value="<?php echo $this->form_encode_input($response_ani) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_response_ani_label" id="hidden_field_label_response_ani" style="<?php echo $sStyleHidden_response_ani; ?>"><span id="id_label_response_ani"><?php echo $this->nm_new_label['response_ani']; ?></span></TD>
    <TD class="scFormDataOdd css_response_ani_line" id="hidden_field_data_response_ani" style="<?php echo $sStyleHidden_response_ani; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_response_ani_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["response_ani"]) &&  $this->nmgp_cmp_readonly["response_ani"] == "on") { 

 ?>
<input type="hidden" name="response_ani" value="<?php echo $this->form_encode_input($response_ani) . "\">" . $response_ani . ""; ?>
<?php } else { ?>
<span id="id_read_on_response_ani" class="sc-ui-readonly-response_ani css_response_ani_line" style="<?php echo $sStyleReadLab_response_ani; ?>"><?php echo $this->form_format_readonly("response_ani", $this->form_encode_input($this->response_ani)); ?></span><span id="id_read_off_response_ani" class="css_read_off_response_ani<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_response_ani; ?>">
 <input class="sc-js-input scFormObjectOdd css_response_ani_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_response_ani" type=text name="response_ani" value="<?php echo $this->form_encode_input($response_ani) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=32767 alt="{datatype: 'text', maxLength: 32767, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_response_ani_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_response_ani_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['parameters']))
    {
        $this->nm_new_label['parameters'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_Parameters'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $parameters = $this->parameters;
   $sStyleHidden_parameters = '';
   if (isset($this->nmgp_cmp_hidden['parameters']) && $this->nmgp_cmp_hidden['parameters'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['parameters']);
       $sStyleHidden_parameters = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_parameters = 'display: none;';
   $sStyleReadInp_parameters = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['parameters']) && $this->nmgp_cmp_readonly['parameters'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['parameters']);
       $sStyleReadLab_parameters = '';
       $sStyleReadInp_parameters = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['parameters']) && $this->nmgp_cmp_hidden['parameters'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="parameters" value="<?php echo $this->form_encode_input($parameters) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_parameters_label" id="hidden_field_label_parameters" style="<?php echo $sStyleHidden_parameters; ?>"><span id="id_label_parameters"><?php echo $this->nm_new_label['parameters']; ?></span></TD>
    <TD class="scFormDataOdd css_parameters_line" id="hidden_field_data_parameters" style="<?php echo $sStyleHidden_parameters; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_parameters_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["parameters"]) &&  $this->nmgp_cmp_readonly["parameters"] == "on") { 

 ?>
<input type="hidden" name="parameters" value="<?php echo $this->form_encode_input($parameters) . "\">" . $parameters . ""; ?>
<?php } else { ?>
<span id="id_read_on_parameters" class="sc-ui-readonly-parameters css_parameters_line" style="<?php echo $sStyleReadLab_parameters; ?>"><?php echo $this->form_format_readonly("parameters", $this->form_encode_input($this->parameters)); ?></span><span id="id_read_off_parameters" class="css_read_off_parameters<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_parameters; ?>">
 <input class="sc-js-input scFormObjectOdd css_parameters_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_parameters" type=text name="parameters" value="<?php echo $this->form_encode_input($parameters) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_parameters_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_parameters_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['statesignaturedocument']))
    {
        $this->nm_new_label['statesignaturedocument'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_StateSignatureDocument'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $statesignaturedocument = $this->statesignaturedocument;
   $sStyleHidden_statesignaturedocument = '';
   if (isset($this->nmgp_cmp_hidden['statesignaturedocument']) && $this->nmgp_cmp_hidden['statesignaturedocument'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['statesignaturedocument']);
       $sStyleHidden_statesignaturedocument = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_statesignaturedocument = 'display: none;';
   $sStyleReadInp_statesignaturedocument = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['statesignaturedocument']) && $this->nmgp_cmp_readonly['statesignaturedocument'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['statesignaturedocument']);
       $sStyleReadLab_statesignaturedocument = '';
       $sStyleReadInp_statesignaturedocument = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['statesignaturedocument']) && $this->nmgp_cmp_hidden['statesignaturedocument'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="statesignaturedocument" value="<?php echo $this->form_encode_input($statesignaturedocument) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_statesignaturedocument_label" id="hidden_field_label_statesignaturedocument" style="<?php echo $sStyleHidden_statesignaturedocument; ?>"><span id="id_label_statesignaturedocument"><?php echo $this->nm_new_label['statesignaturedocument']; ?></span></TD>
    <TD class="scFormDataOdd css_statesignaturedocument_line" id="hidden_field_data_statesignaturedocument" style="<?php echo $sStyleHidden_statesignaturedocument; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_statesignaturedocument_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["statesignaturedocument"]) &&  $this->nmgp_cmp_readonly["statesignaturedocument"] == "on") { 

 ?>
<input type="hidden" name="statesignaturedocument" value="<?php echo $this->form_encode_input($statesignaturedocument) . "\">" . $statesignaturedocument . ""; ?>
<?php } else { ?>
<span id="id_read_on_statesignaturedocument" class="sc-ui-readonly-statesignaturedocument css_statesignaturedocument_line" style="<?php echo $sStyleReadLab_statesignaturedocument; ?>"><?php echo $this->form_format_readonly("statesignaturedocument", $this->form_encode_input($this->statesignaturedocument)); ?></span><span id="id_read_off_statesignaturedocument" class="css_read_off_statesignaturedocument<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_statesignaturedocument; ?>">
 <input class="sc-js-input scFormObjectOdd css_statesignaturedocument_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_statesignaturedocument" type=text name="statesignaturedocument" value="<?php echo $this->form_encode_input($statesignaturedocument) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_statesignaturedocument_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_statesignaturedocument_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['json_response']))
    {
        $this->nm_new_label['json_response'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_JSON_Response'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $json_response = $this->json_response;
   $sStyleHidden_json_response = '';
   if (isset($this->nmgp_cmp_hidden['json_response']) && $this->nmgp_cmp_hidden['json_response'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['json_response']);
       $sStyleHidden_json_response = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_json_response = 'display: none;';
   $sStyleReadInp_json_response = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['json_response']) && $this->nmgp_cmp_readonly['json_response'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['json_response']);
       $sStyleReadLab_json_response = '';
       $sStyleReadInp_json_response = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['json_response']) && $this->nmgp_cmp_hidden['json_response'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="json_response" value="<?php echo $this->form_encode_input($json_response) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_json_response_label" id="hidden_field_label_json_response" style="<?php echo $sStyleHidden_json_response; ?>"><span id="id_label_json_response"><?php echo $this->nm_new_label['json_response']; ?></span></TD>
    <TD class="scFormDataOdd css_json_response_line" id="hidden_field_data_json_response" style="<?php echo $sStyleHidden_json_response; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_json_response_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["json_response"]) &&  $this->nmgp_cmp_readonly["json_response"] == "on") { 

 ?>
<input type="hidden" name="json_response" value="<?php echo $this->form_encode_input($json_response) . "\">" . $json_response . ""; ?>
<?php } else { ?>
<span id="id_read_on_json_response" class="sc-ui-readonly-json_response css_json_response_line" style="<?php echo $sStyleReadLab_json_response; ?>"><?php echo $this->form_format_readonly("json_response", $this->form_encode_input($this->json_response)); ?></span><span id="id_read_off_json_response" class="css_read_off_json_response<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_json_response; ?>">
 <input class="sc-js-input scFormObjectOdd css_json_response_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_json_response" type=text name="json_response" value="<?php echo $this->form_encode_input($json_response) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=32767 alt="{datatype: 'text', maxLength: 32767, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_json_response_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_json_response_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['verifyupdate']))
    {
        $this->nm_new_label['verifyupdate'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_VerifyUpdate'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $verifyupdate = $this->verifyupdate;
   $sStyleHidden_verifyupdate = '';
   if (isset($this->nmgp_cmp_hidden['verifyupdate']) && $this->nmgp_cmp_hidden['verifyupdate'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['verifyupdate']);
       $sStyleHidden_verifyupdate = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_verifyupdate = 'display: none;';
   $sStyleReadInp_verifyupdate = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['verifyupdate']) && $this->nmgp_cmp_readonly['verifyupdate'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['verifyupdate']);
       $sStyleReadLab_verifyupdate = '';
       $sStyleReadInp_verifyupdate = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['verifyupdate']) && $this->nmgp_cmp_hidden['verifyupdate'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="verifyupdate" value="<?php echo $this->form_encode_input($verifyupdate) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_verifyupdate_label" id="hidden_field_label_verifyupdate" style="<?php echo $sStyleHidden_verifyupdate; ?>"><span id="id_label_verifyupdate"><?php echo $this->nm_new_label['verifyupdate']; ?></span></TD>
    <TD class="scFormDataOdd css_verifyupdate_line" id="hidden_field_data_verifyupdate" style="<?php echo $sStyleHidden_verifyupdate; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_verifyupdate_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["verifyupdate"]) &&  $this->nmgp_cmp_readonly["verifyupdate"] == "on") { 

 ?>
<input type="hidden" name="verifyupdate" value="<?php echo $this->form_encode_input($verifyupdate) . "\">" . $verifyupdate . ""; ?>
<?php } else { ?>
<span id="id_read_on_verifyupdate" class="sc-ui-readonly-verifyupdate css_verifyupdate_line" style="<?php echo $sStyleReadLab_verifyupdate; ?>"><?php echo $this->form_format_readonly("verifyupdate", $this->form_encode_input($this->verifyupdate)); ?></span><span id="id_read_off_verifyupdate" class="css_read_off_verifyupdate<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_verifyupdate; ?>">
 <input class="sc-js-input scFormObjectOdd css_verifyupdate_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_verifyupdate" type=text name="verifyupdate" value="<?php echo $this->form_encode_input($verifyupdate) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'integer', maxLength: 10, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['verifyupdate']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['verifyupdate']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['verifyupdate']['format_neg'] ? "'suffix'" : "'prefix'") ?>, enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_verifyupdate_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_verifyupdate_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['estadoreg']))
   {
       $this->nm_new_label['estadoreg'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_EstadoReg'] . "";
   }
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $estadoreg = $this->estadoreg;
   $sStyleHidden_estadoreg = '';
   if (isset($this->nmgp_cmp_hidden['estadoreg']) && $this->nmgp_cmp_hidden['estadoreg'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['estadoreg']);
       $sStyleHidden_estadoreg = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_estadoreg = 'display: none;';
   $sStyleReadInp_estadoreg = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['estadoreg']) && $this->nmgp_cmp_readonly['estadoreg'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['estadoreg']);
       $sStyleReadLab_estadoreg = '';
       $sStyleReadInp_estadoreg = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['estadoreg']) && $this->nmgp_cmp_hidden['estadoreg'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="estadoreg" value="<?php echo $this->form_encode_input($this->estadoreg) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_estadoreg_label" id="hidden_field_label_estadoreg" style="<?php echo $sStyleHidden_estadoreg; ?>"><span id="id_label_estadoreg"><?php echo $this->nm_new_label['estadoreg']; ?></span></TD>
    <TD class="scFormDataOdd css_estadoreg_line" id="hidden_field_data_estadoreg" style="<?php echo $sStyleHidden_estadoreg; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_estadoreg_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["estadoreg"]) &&  $this->nmgp_cmp_readonly["estadoreg"] == "on") { 

$estadoreg_look = "";
 if ($this->estadoreg == "A") { $estadoreg_look .= "" . $this->Ini->Nm_lang['lang_activo'] . "" ;} 
 if ($this->estadoreg == "I") { $estadoreg_look .= "" . $this->Ini->Nm_lang['lang_inactivo'] . "" ;} 
 if (empty($estadoreg_look)) { $estadoreg_look = $this->estadoreg; }
?>
<input type="hidden" name="estadoreg" value="<?php echo $this->form_encode_input($estadoreg) . "\">" . $estadoreg_look . ""; ?>
<?php } else { ?>
<?php

$estadoreg_look = "";
 if ($this->estadoreg == "A") { $estadoreg_look .= "" . $this->Ini->Nm_lang['lang_activo'] . "" ;} 
 if ($this->estadoreg == "I") { $estadoreg_look .= "" . $this->Ini->Nm_lang['lang_inactivo'] . "" ;} 
 if (empty($estadoreg_look)) { $estadoreg_look = $this->estadoreg; }
?>
<span id="id_read_on_estadoreg" class="css_estadoreg_line"  style="<?php echo $sStyleReadLab_estadoreg; ?>"><?php echo $this->form_format_readonly("estadoreg", $this->form_encode_input($estadoreg_look)); ?></span><span id="id_read_off_estadoreg" class="css_read_off_estadoreg<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_estadoreg; ?>">
 <span id="idAjaxSelect_estadoreg" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_estadoreg_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_estadoreg" name="estadoreg" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="A" <?php  if ($this->estadoreg == "A") { echo " selected" ;} ?><?php  if (empty($this->estadoreg)) { echo " selected" ;} ?>><?php echo $this->Ini->Nm_lang['lang_activo']; ?></option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['Lookup_estadoreg'][] = 'A'; ?>
 <option  value="I" <?php  if ($this->estadoreg == "I") { echo " selected" ;} ?>><?php echo $this->Ini->Nm_lang['lang_inactivo']; ?></option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['Lookup_estadoreg'][] = 'I'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_estadoreg_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_estadoreg_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } ?>
   </td></tr></table>
   </tr>
</TABLE></div><!-- bloco_f -->
</td></tr> 
<tr><td>
<?php
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-bottom" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['run_iframe'] != "R")
{
    $NM_btn = false;
      if ($opcao_botoes != "novo" && $this->nmgp_botoes['goto'] == "on")
      {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";
        
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_disabled']['birpara']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_disabled']['birpara']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['birpara']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['birpara']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['birpara'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "birpara", "scBtnFn_sys_GridPermiteSeq()", "scBtnFn_sys_GridPermiteSeq()", "brec_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
?> 
   <input type="text" class="scFormToolbarInput" name="nmgp_rec_b" value="" style="width:25px;vertical-align: middle;"/> 
<?php 
      }
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['first'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-11';
        $buttonMacroLabel = "";
        
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_disabled']['first']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_disabled']['first']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['first']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['first']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['first'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "binicio", "scBtnFn_sys_format_ini()", "scBtnFn_sys_format_ini()", "sc_b_ini_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['back'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-12';
        $buttonMacroLabel = "";
        
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_disabled']['back']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_disabled']['back']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['back']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['back']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['back'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bretorna", "scBtnFn_sys_format_ret()", "scBtnFn_sys_format_ret()", "sc_b_ret_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
if ($opcao_botoes != "novo" && $this->nmgp_botoes['navpage'] == "on")
{
?> 
     <span nowrap id="sc_b_navpage_b" class="scFormToolbarPadding"></span> 
<?php 
}
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['forward'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-13';
        $buttonMacroLabel = "";
        
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_disabled']['forward']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_disabled']['forward']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['forward']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['forward']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['forward'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bavanca", "scBtnFn_sys_format_ava()", "scBtnFn_sys_format_ava()", "sc_b_avc_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['last'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-14';
        $buttonMacroLabel = "";
        
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_disabled']['last']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_disabled']['last']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['last']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['last']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['btn_label']['last'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bfinal", "scBtnFn_sys_format_fim()", "scBtnFn_sys_format_fim()", "sc_b_fim_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
?> 
     </td> 
     <td nowrap align="right" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
if ($opcao_botoes != "novo" && $this->nmgp_botoes['summary'] == "on")
{
?> 
     <span nowrap id="sc_b_summary_b" class="scFormToolbarPadding"></span> 
<?php 
}
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['run_iframe'] != "R")
{
?>
   </td></tr> 
   </table> 
   </td></tr></table> 
<?php
}
?>
<?php
if (!$NM_btn && isset($NM_ult_sep))
{
    echo "    <script language=\"javascript\">";
    echo "      document.getElementById('" .  $NM_ult_sep . "').style.display='none';";
    echo "    </script>";
}
unset($NM_ult_sep);
?>
<?php if ('novo' != $this->nmgp_opcao || $this->Embutida_form) { ?><script>nav_atualiza(Nav_permite_ret, Nav_permite_ava, 'b');</script><?php } ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['run_iframe'] != "F") { if ('parcial' == $this->form_paginacao) {?><script>summary_atualiza(<?php echo ($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['reg_start'] + 1). ", " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['reg_qtd'] . ", " . ($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['total'] + 1)?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['run_iframe'] != "F") { if ('total' == $this->form_paginacao) {?><script>summary_atualiza(1, <?php echo $this->sc_max_reg . ", " . $this->sc_max_reg?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['run_iframe'] != "F") { ?><script>navpage_atualiza('<?php echo $this->SC_nav_page ?>');</script><?php } ?>
</td></tr> 
</table> 
</div> 
</td> 
</tr> 
</table> 

<div id="id_debug_window" style="display: none;" class='scDebugWindow'><table class="scFormMessageTable">
<tr><td class="scFormMessageTitle"><?php echo nmButtonOutput($this->arr_buttons, "berrm_clse", "scAjaxHideDebug()", "scAjaxHideDebug()", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
&nbsp;&nbsp;Output</td></tr>
<tr><td class="scFormMessageMessage" style="padding: 0px; vertical-align: top"><div style="padding: 2px; height: 200px; width: 350px; overflow: auto" id="id_debug_text"></div></td></tr>
</table></div>

</form> 
<script> 
<?php
  $nm_sc_blocos_da_pag = array(0);

  foreach ($this->Ini->nm_hidden_blocos as $bloco => $hidden)
  {
      if ($hidden == "off" && in_array($bloco, $nm_sc_blocos_da_pag))
      {
          echo "document.getElementById('hidden_bloco_" . $bloco . "').style.display = 'none';";
          if (isset($nm_sc_blocos_aba[$bloco]))
          {
               echo "document.getElementById('id_tabs_" . $nm_sc_blocos_aba[$bloco] . "_" . $bloco . "').style.display = 'none';";
          }
      }
  }
?>
</script> 
<script>
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['masterValue']);
?>
}
<?php
    }
}
?>
function updateHeaderFooter(sFldName, sFldValue)
{
  if (sFldValue[0] && sFldValue[0]["value"])
  {
    sFldValue = sFldValue[0]["value"];
  }
}
</script>
<?php
if (isset($_POST['master_nav']) && 'on' == $_POST['master_nav'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("form_ado_records_admon");
</script>
<?php
    }
    else {
        $sTamanhoIframe = isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_ado_records_admon");
 parent.scAjaxDetailHeight("form_ado_records_admon", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("form_ado_records_admon", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("form_ado_records_admon", <?php echo $sTamanhoIframe; ?>);
 }
</script>
<?php
    }
}
?>
<?php
if (isset($this->NM_ajax_info['displayMsg']) && $this->NM_ajax_info['displayMsg'])
{
    $isToast   = isset($this->NM_ajax_info['displayMsgToast']) && $this->NM_ajax_info['displayMsgToast'] ? 'true' : 'false';
    $toastType = $isToast && isset($this->NM_ajax_info['displayMsgToastType']) ? $this->NM_ajax_info['displayMsgToastType'] : '';
?>
<script type="text/javascript">
_scAjaxShowMessage({title: scMsgDefTitle, message: "<?php echo $this->NM_ajax_info['displayMsgTxt']; ?>", isModal: false, timeout: sc_ajaxMsgTime, showButton: false, buttonLabel: "Ok", topPos: 0, leftPos: 0, width: 0, height: 0, redirUrl: "", redirTarget: "", redirParam: "", showClose: false, showBodyIcon: true, isToast: <?php echo $isToast ?>, toastPos: "", type: "<?php echo $toastType ?>"});
</script>
<?php
}
?>
<?php
if ('' != $this->scFormFocusErrorName)
{
?>
<script>
scAjaxFocusError();
</script>
<?php
}
?>
<script type='text/javascript'>
bLigEditLookupCall = <?php if ($this->lig_edit_lookup_call) { ?>true<?php } else { ?>false<?php } ?>;
function scLigEditLookupCall()
{
<?php
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['sc_modal'])
{
?>
  parent.<?php echo $this->lig_edit_lookup_cb; ?>(<?php echo $this->lig_edit_lookup_row; ?>);
<?php
}
elseif ($this->lig_edit_lookup)
{
?>
  opener.<?php echo $this->lig_edit_lookup_cb; ?>(<?php echo $this->lig_edit_lookup_row; ?>);
<?php
}
?>
}
if (bLigEditLookupCall)
{
  scLigEditLookupCall();
}
<?php
if (isset($this->redir_modal) && !empty($this->redir_modal))
{
    echo $this->redir_modal;
}
?>
</script>
<?php
if ($this->nmgp_form_empty) {
?>
<script type="text/javascript">
scAjax_displayEmptyForm();
</script>
<?php
}
?>
<script type="text/javascript">
	function scBtnFn_sys_format_inc() {
		if ($("#sc_b_new_t.sc-unique-btn-1").length && $("#sc_b_new_t.sc-unique-btn-1").is(":visible")) {
		    if ($("#sc_b_new_t.sc-unique-btn-1").hasClass("disabled")) {
		        return;
		    }
			nm_move ('novo');
			 return;
		}
		if ($("#sc_b_ins_t.sc-unique-btn-2").length && $("#sc_b_ins_t.sc-unique-btn-2").is(":visible")) {
		    if ($("#sc_b_ins_t.sc-unique-btn-2").hasClass("disabled")) {
		        return;
		    }
			nm_atualiza ('incluir');
			 return;
		}
	}
	function scBtnFn_sys_format_cnl() {
		if ($("#sc_b_sai_t.sc-unique-btn-3").length && $("#sc_b_sai_t.sc-unique-btn-3").is(":visible")) {
		    if ($("#sc_b_sai_t.sc-unique-btn-3").hasClass("disabled")) {
		        return;
		    }
			<?php echo $this->NM_cancel_insert_new ?> document.F5.submit();
			 return;
		}
	}
	function scBtnFn_sys_format_alt() {
		if ($("#sc_b_upd_t.sc-unique-btn-4").length && $("#sc_b_upd_t.sc-unique-btn-4").is(":visible")) {
		    if ($("#sc_b_upd_t.sc-unique-btn-4").hasClass("disabled")) {
		        return;
		    }
			nm_atualiza ('alterar');
			 return;
		}
	}
	function scBtnFn_sys_format_exc() {
		if ($("#sc_b_del_t.sc-unique-btn-5").length && $("#sc_b_del_t.sc-unique-btn-5").is(":visible")) {
		    if ($("#sc_b_del_t.sc-unique-btn-5").hasClass("disabled")) {
		        return;
		    }
			nm_atualiza ('excluir');
			 return;
		}
	}
	function scBtnFn_sys_format_hlp() {
		if ($("#sc_b_hlp_t").length && $("#sc_b_hlp_t").is(":visible")) {
		    if ($("#sc_b_hlp_t").hasClass("disabled")) {
		        return;
		    }
			window.open('<?php echo $this->url_webhelp; ?>', '', 'resizable, scrollbars'); 
			 return;
		}
	}
	function scBtnFn_sys_format_sai() {
		if ($("#sc_b_sai_t.sc-unique-btn-6").length && $("#sc_b_sai_t.sc-unique-btn-6").is(":visible")) {
		    if ($("#sc_b_sai_t.sc-unique-btn-6").hasClass("disabled")) {
		        return;
		    }
			scFormClose_F5('<?php echo $nm_url_saida; ?>');
			 return;
		}
		if ($("#sc_b_sai_t.sc-unique-btn-7").length && $("#sc_b_sai_t.sc-unique-btn-7").is(":visible")) {
		    if ($("#sc_b_sai_t.sc-unique-btn-7").hasClass("disabled")) {
		        return;
		    }
			scFormClose_F5('<?php echo $nm_url_saida; ?>');
			 return;
		}
		if ($("#sc_b_sai_t.sc-unique-btn-8").length && $("#sc_b_sai_t.sc-unique-btn-8").is(":visible")) {
		    if ($("#sc_b_sai_t.sc-unique-btn-8").hasClass("disabled")) {
		        return;
		    }
			scFormClose_F6('<?php echo $nm_url_saida; ?>'); return false;
			 return;
		}
		if ($("#sc_b_sai_t.sc-unique-btn-9").length && $("#sc_b_sai_t.sc-unique-btn-9").is(":visible")) {
		    if ($("#sc_b_sai_t.sc-unique-btn-9").hasClass("disabled")) {
		        return;
		    }
			scFormClose_F6('<?php echo $nm_url_saida; ?>'); return false;
			 return;
		}
		if ($("#sc_b_sai_t.sc-unique-btn-10").length && $("#sc_b_sai_t.sc-unique-btn-10").is(":visible")) {
		    if ($("#sc_b_sai_t.sc-unique-btn-10").hasClass("disabled")) {
		        return;
		    }
			scFormClose_F6('<?php echo $nm_url_saida; ?>'); return false;
			 return;
		}
	}
	function scBtnFn_sys_GridPermiteSeq() {
		if ($("#brec_b").length && $("#brec_b").is(":visible")) {
		    if ($("#brec_b").hasClass("disabled")) {
		        return;
		    }
			nm_navpage(document.F1.nmgp_rec_b.value, 'P'); document.F1.nmgp_rec_b.value = '';
			 return;
		}
	}
	function scBtnFn_sys_format_ini() {
		if ($("#sc_b_ini_b.sc-unique-btn-11").length && $("#sc_b_ini_b.sc-unique-btn-11").is(":visible")) {
		    if ($("#sc_b_ini_b.sc-unique-btn-11").hasClass("disabled")) {
		        return;
		    }
			nm_move ('inicio');
			 return;
		}
	}
	function scBtnFn_sys_format_ret() {
		if ($("#sc_b_ret_b.sc-unique-btn-12").length && $("#sc_b_ret_b.sc-unique-btn-12").is(":visible")) {
		    if ($("#sc_b_ret_b.sc-unique-btn-12").hasClass("disabled")) {
		        return;
		    }
			nm_move ('retorna');
			 return;
		}
	}
	function scBtnFn_sys_format_ava() {
		if ($("#sc_b_avc_b.sc-unique-btn-13").length && $("#sc_b_avc_b.sc-unique-btn-13").is(":visible")) {
		    if ($("#sc_b_avc_b.sc-unique-btn-13").hasClass("disabled")) {
		        return;
		    }
			nm_move ('avanca');
			 return;
		}
	}
	function scBtnFn_sys_format_fim() {
		if ($("#sc_b_fim_b.sc-unique-btn-14").length && $("#sc_b_fim_b.sc-unique-btn-14").is(":visible")) {
		    if ($("#sc_b_fim_b.sc-unique-btn-14").hasClass("disabled")) {
		        return;
		    }
			nm_move ('final');
			 return;
		}
	}
</script>
<script type="text/javascript">
$(function() {
 $("#sc-id-mobile-in").mouseover(function() {
  $(this).css("cursor", "pointer");
 }).click(function() {
  scMobileDisplayControl("in");
 });
 $("#sc-id-mobile-out").mouseover(function() {
  $(this).css("cursor", "pointer");
 }).click(function() {
  scMobileDisplayControl("out");
 });
});
function scMobileDisplayControl(sOption) {
 $("#sc-id-mobile-control").val(sOption);
 nm_atualiza("recarga_mobile");
}
</script>
<?php
       if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'])
       {
?>
<span id="sc-id-mobile-in"><?php echo $this->Ini->Nm_lang['lang_version_mobile']; ?></span>
<?php
       }
?>
<?php
$_SESSION['sc_session'][$this->Ini->sc_page]['form_ado_records_admon']['buttonStatus'] = $this->nmgp_botoes;
?>
<script type="text/javascript">
   function sc_session_redir(url_redir)
   {
       if (window.parent && window.parent.document != window.document && typeof window.parent.sc_session_redir === 'function')
       {
           window.parent.sc_session_redir(url_redir);
       }
       else
       {
           if (window.opener && typeof window.opener.sc_session_redir === 'function')
           {
               window.close();
               window.opener.sc_session_redir(url_redir);
           }
           else
           {
               window.location = url_redir;
           }
       }
   }
</script>
</body> 
</html> 
