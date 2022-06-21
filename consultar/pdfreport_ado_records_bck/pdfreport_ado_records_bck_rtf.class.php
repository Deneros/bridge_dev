<?php

class pdfreport_ado_records_bck_rtf
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $nm_data;
   var $Texto_tag;
   var $Arquivo;
   var $Tit_doc;
   var $sc_proc_grid; 
   var $NM_cmp_hidden = array();

   //---- 
   function __construct()
   {
      $this->nm_data   = new nm_data("es");
      $this->Texto_tag = "";
   }

   //---- 
   function monta_rtf()
   {
      $this->inicializa_vars();
      $this->gera_texto_tag();
      $this->grava_arquivo_rtf();
      if ($this->Ini->sc_export_ajax)
      {
          $this->Arr_result['file_export']  = NM_charset_to_utf8($this->Rtf_f);
          $this->Arr_result['title_export'] = NM_charset_to_utf8($this->Tit_doc);
          $Temp = ob_get_clean();
          if ($Temp !== false && trim($Temp) != "")
          {
              $this->Arr_result['htmOutput'] = NM_charset_to_utf8($Temp);
          }
          $oJson = new Services_JSON();
          echo $oJson->encode($this->Arr_result);
          exit;
      }
      else
      {
          $this->monta_html();
      }
   }

   //----- 
   function inicializa_vars()
   {
      global $nm_lang;
      if (isset($GLOBALS['nmgp_parms']) && !empty($GLOBALS['nmgp_parms'])) 
      { 
          $GLOBALS['nmgp_parms'] = str_replace("@aspass@", "'", $GLOBALS['nmgp_parms']);
          $todox = str_replace("?#?@?@?", "?#?@ ?@?", $GLOBALS["nmgp_parms"]);
          $todo  = explode("?@?", $todox);
          foreach ($todo as $param)
          {
               $cadapar = explode("?#?", $param);
               if (1 < sizeof($cadapar))
               {
                   if (substr($cadapar[0], 0, 11) == "SC_glo_par_")
                   {
                       $cadapar[0] = substr($cadapar[0], 11);
                       $cadapar[1] = $_SESSION[$cadapar[1]];
                   }
                   if (isset($GLOBALS['sc_conv_var'][$cadapar[0]]))
                   {
                       $cadapar[0] = $GLOBALS['sc_conv_var'][$cadapar[0]];
                   }
                   elseif (isset($GLOBALS['sc_conv_var'][strtolower($cadapar[0])]))
                   {
                       $cadapar[0] = $GLOBALS['sc_conv_var'][strtolower($cadapar[0])];
                   }
                   nm_limpa_str_pdfreport_ado_records_bck($cadapar[1]);
                   nm_protect_num_pdfreport_ado_records_bck($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['pdfreport_ado_records_bck']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      if (!isset($nuTransacion) && isset($nutransacion)) 
      {
         $nuTransacion = $nutransacion;
      }
      if (isset($nuTransacion)) 
      {
          $_SESSION['nuTransacion'] = $nuTransacion;
          nm_limpa_str_pdfreport_ado_records_bck($_SESSION["nuTransacion"]);
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $this->Arquivo    = "sc_rtf";
      $this->Arquivo   .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arquivo   .= "_pdfreport_ado_records_bck";
      $this->Arquivo   .= ".rtf";
      $this->Tit_doc    = "pdfreport_ado_records_bck.rtf";
   }

   //----- 
   function gera_texto_tag()
   {
     global $nm_lang;
      global $nm_nada, $nm_lang;

      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->sc_proc_grid = false; 
      $nm_raiz_img  = ""; 
      $this->New_label['record'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_Record'] . "";
      $this->New_label['uid'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_Uid'] . "";
      $this->New_label['startingdate'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_StartingDate'] . "";
      $this->New_label['creationdate'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_CreationDate'] . "";
      $this->New_label['creationip'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_CreationIP'] . "";
      $this->New_label['documenttype'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_DocumentType'] . "";
      $this->New_label['idnumber'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_IdNumber'] . "";
      $this->New_label['firstname'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_FirstName'] . "";
      $this->New_label['secondname'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_SecondName'] . "";
      $this->New_label['firstsurname'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_FirstSurname'] . "";
      $this->New_label['secondsurname'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_SecondSurname'] . "";
      $this->New_label['gender'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_Gender'] . "";
      $this->New_label['birthdate'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_BirthDate'] . "";
      $this->New_label['placebirth'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_PlaceBirth'] . "";
      $this->New_label['transactiontype'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_TransactionType'] . "";
      $this->New_label['transactiontypename'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_TransactionTypeName'] . "";
      $this->New_label['issuedate'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_IssueDate'] . "";
      $this->New_label['adoprojectid'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_AdoProjectId'] . "";
      $this->New_label['transactionid'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_TransactionId'] . "";
      $this->New_label['productid'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_ProductId'] . "";
      $this->New_label['resultcomparationfaces'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_ResultComparationFaces'] . "";
      $this->New_label['comparationfacesaproved'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_ComparationFacesAproved'] . "";
      $this->New_label['extras'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_Extras'] . "";
      $this->New_label['response_ani'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_Response_ANI'] . "";
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records_bck']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records_bck']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records_bck']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records_bck']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records_bck']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records_bck']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->response_ani = $Busca_temp['response_ani']; 
          $tmp_pos = strpos($this->response_ani, "##@@");
          if ($tmp_pos !== false && !is_array($this->response_ani))
          {
              $this->response_ani = substr($this->response_ani, 0, $tmp_pos);
          }
          $this->record = $Busca_temp['record']; 
          $tmp_pos = strpos($this->record, "##@@");
          if ($tmp_pos !== false && !is_array($this->record))
          {
              $this->record = substr($this->record, 0, $tmp_pos);
          }
          $this->uid = $Busca_temp['uid']; 
          $tmp_pos = strpos($this->uid, "##@@");
          if ($tmp_pos !== false && !is_array($this->uid))
          {
              $this->uid = substr($this->uid, 0, $tmp_pos);
          }
          $this->startingdate = $Busca_temp['startingdate']; 
          $tmp_pos = strpos($this->startingdate, "##@@");
          if ($tmp_pos !== false && !is_array($this->startingdate))
          {
              $this->startingdate = substr($this->startingdate, 0, $tmp_pos);
          }
          $this->startingdate_2 = $Busca_temp['startingdate_input_2']; 
          $this->creationdate = $Busca_temp['creationdate']; 
          $tmp_pos = strpos($this->creationdate, "##@@");
          if ($tmp_pos !== false && !is_array($this->creationdate))
          {
              $this->creationdate = substr($this->creationdate, 0, $tmp_pos);
          }
          $this->creationdate_2 = $Busca_temp['creationdate_input_2']; 
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records_bck']['rtf_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records_bck']['rtf_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records_bck']['rtf_name'] .= ".rtf";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records_bck']['rtf_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records_bck']['rtf_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records_bck']['rtf_name']);
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      $this->Texto_tag .= "<table>\r\n";
      $this->Texto_tag .= "<tr>\r\n";
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records_bck']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['record'])) ? $this->New_label['record'] : ""; 
          if ($Cada_col == "record" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['uid'])) ? $this->New_label['uid'] : ""; 
          if ($Cada_col == "uid" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['startingdate'])) ? $this->New_label['startingdate'] : ""; 
          if ($Cada_col == "startingdate" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['creationdate'])) ? $this->New_label['creationdate'] : ""; 
          if ($Cada_col == "creationdate" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['creationip'])) ? $this->New_label['creationip'] : ""; 
          if ($Cada_col == "creationip" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['documenttype'])) ? $this->New_label['documenttype'] : ""; 
          if ($Cada_col == "documenttype" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['idnumber'])) ? $this->New_label['idnumber'] : ""; 
          if ($Cada_col == "idnumber" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['firstname'])) ? $this->New_label['firstname'] : ""; 
          if ($Cada_col == "firstname" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['secondname'])) ? $this->New_label['secondname'] : ""; 
          if ($Cada_col == "secondname" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['firstsurname'])) ? $this->New_label['firstsurname'] : ""; 
          if ($Cada_col == "firstsurname" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['secondsurname'])) ? $this->New_label['secondsurname'] : ""; 
          if ($Cada_col == "secondsurname" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['gender'])) ? $this->New_label['gender'] : ""; 
          if ($Cada_col == "gender" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['birthdate'])) ? $this->New_label['birthdate'] : ""; 
          if ($Cada_col == "birthdate" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['placebirth'])) ? $this->New_label['placebirth'] : ""; 
          if ($Cada_col == "placebirth" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['transactiontype'])) ? $this->New_label['transactiontype'] : ""; 
          if ($Cada_col == "transactiontype" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['transactiontypename'])) ? $this->New_label['transactiontypename'] : ""; 
          if ($Cada_col == "transactiontypename" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['issuedate'])) ? $this->New_label['issuedate'] : ""; 
          if ($Cada_col == "issuedate" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['adoprojectid'])) ? $this->New_label['adoprojectid'] : ""; 
          if ($Cada_col == "adoprojectid" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['transactionid'])) ? $this->New_label['transactionid'] : ""; 
          if ($Cada_col == "transactionid" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['productid'])) ? $this->New_label['productid'] : ""; 
          if ($Cada_col == "productid" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['resultcomparationfaces'])) ? $this->New_label['resultcomparationfaces'] : ""; 
          if ($Cada_col == "resultcomparationfaces" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['comparationfacesaproved'])) ? $this->New_label['comparationfacesaproved'] : ""; 
          if ($Cada_col == "comparationfacesaproved" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['extras'])) ? $this->New_label['extras'] : ""; 
          if ($Cada_col == "extras" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['response_ani'])) ? $this->New_label['response_ani'] : ""; 
          if ($Cada_col == "response_ani" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['photo'])) ? $this->New_label['photo'] : "Photo"; 
          if ($Cada_col == "photo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
      } 
      $this->Texto_tag .= "</tr>\r\n";
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $nmgp_select_count = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela; 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nmgp_select = "SELECT Record, Uid, str_replace (convert(char(10),StartingDate,102), '.', '-') + ' ' + convert(char(8),StartingDate,20), str_replace (convert(char(10),CreationDate,102), '.', '-') + ' ' + convert(char(8),CreationDate,20), CreationIP, DocumentType, IdNumber, FirstName, SecondName, FirstSurname, SecondSurname, Gender, str_replace (convert(char(10),BirthDate,102), '.', '-') + ' ' + convert(char(8),BirthDate,20), PlaceBirth, TransactionType, TransactionTypeName, str_replace (convert(char(10),IssueDate,102), '.', '-') + ' ' + convert(char(8),IssueDate,20), AdoProjectId, TransactionId, ProductId, ResultComparationFaces, ComparationFacesAproved, Extras, Response_ANI from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT Record, Uid, StartingDate, CreationDate, CreationIP, DocumentType, IdNumber, FirstName, SecondName, FirstSurname, SecondSurname, Gender, BirthDate, PlaceBirth, TransactionType, TransactionTypeName, IssueDate, AdoProjectId, TransactionId, ProductId, ResultComparationFaces, ComparationFacesAproved, Extras, Response_ANI from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT Record, Uid, convert(char(23),StartingDate,121), convert(char(23),CreationDate,121), CreationIP, DocumentType, IdNumber, FirstName, SecondName, FirstSurname, SecondSurname, Gender, convert(char(23),BirthDate,121), PlaceBirth, TransactionType, TransactionTypeName, convert(char(23),IssueDate,121), AdoProjectId, TransactionId, ProductId, ResultComparationFaces, ComparationFacesAproved, Extras, Response_ANI from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT Record, Uid, StartingDate, CreationDate, CreationIP, DocumentType, IdNumber, FirstName, SecondName, FirstSurname, SecondSurname, Gender, BirthDate, PlaceBirth, TransactionType, TransactionTypeName, IssueDate, AdoProjectId, TransactionId, ProductId, ResultComparationFaces, ComparationFacesAproved, Extras, Response_ANI from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT Record, Uid, EXTEND(StartingDate, YEAR TO FRACTION), EXTEND(CreationDate, YEAR TO FRACTION), CreationIP, DocumentType, IdNumber, FirstName, SecondName, FirstSurname, SecondSurname, Gender, EXTEND(BirthDate, YEAR TO FRACTION), PlaceBirth, TransactionType, TransactionTypeName, EXTEND(IssueDate, YEAR TO FRACTION), AdoProjectId, TransactionId, ProductId, ResultComparationFaces, ComparationFacesAproved, Extras, Response_ANI from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT Record, Uid, StartingDate, CreationDate, CreationIP, DocumentType, IdNumber, FirstName, SecondName, FirstSurname, SecondSurname, Gender, BirthDate, PlaceBirth, TransactionType, TransactionTypeName, IssueDate, AdoProjectId, TransactionId, ProductId, ResultComparationFaces, ComparationFacesAproved, Extras, Response_ANI from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records_bck']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records_bck']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records_bck']['order_grid'];
      $nmgp_select .= $nmgp_order_by; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select_count;
      $rt = $this->Db->Execute($nmgp_select_count);
      if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1)
      {
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
         exit;
      }
      $this->count_ger = $rt->fields[0];
      $rt->Close();
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select;
      $rs = $this->Db->Execute($nmgp_select);
      if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1)
      {
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
         exit;
      }
      $this->SC_seq_register = 0;
      $PB_tot = (isset($this->count_ger) && $this->count_ger > 0) ? "/" . $this->count_ger : "";
      while (!$rs->EOF)
      {
         $this->SC_seq_register++;
         $this->Texto_tag .= "<tr>\r\n";
         $this->record = $rs->fields[0] ;  
         $this->record = (string)$this->record;
         $this->uid = $rs->fields[1] ;  
         $this->startingdate = $rs->fields[2] ;  
         $this->creationdate = $rs->fields[3] ;  
         $this->creationip = $rs->fields[4] ;  
         $this->documenttype = $rs->fields[5] ;  
         $this->idnumber = $rs->fields[6] ;  
         $this->firstname = $rs->fields[7] ;  
         $this->secondname = $rs->fields[8] ;  
         $this->firstsurname = $rs->fields[9] ;  
         $this->secondsurname = $rs->fields[10] ;  
         $this->gender = $rs->fields[11] ;  
         $this->birthdate = $rs->fields[12] ;  
         $this->placebirth = $rs->fields[13] ;  
         $this->transactiontype = $rs->fields[14] ;  
         $this->transactiontypename = $rs->fields[15] ;  
         $this->issuedate = $rs->fields[16] ;  
         $this->adoprojectid = $rs->fields[17] ;  
         $this->transactionid = $rs->fields[18] ;  
         $this->productid = $rs->fields[19] ;  
         $this->resultcomparationfaces = $rs->fields[20] ;  
         $this->comparationfacesaproved = $rs->fields[21] ;  
         $this->extras = $rs->fields[22] ;  
         $this->response_ani = $rs->fields[23] ;  
         //----- lookup - gender
         $this->look_gender = $this->gender; 
         $this->Lookup->lookup_gender($this->look_gender); 
         $this->look_gender = ($this->look_gender == "&nbsp;") ? "" : $this->look_gender; 
         $this->sc_proc_grid = true; 
         $_SESSION['scriptcase']['pdfreport_ado_records_bck']['contr_erro'] = 'on';
 settype($sbRuta,"string");

$sbRuta = "/var/www/html/bridge_og_ado/Records/".$this->idnumber ."/".$this->transactionid ."/clientFace.png"; 
$this->photo  = $sbRuta;

if(($this->comparationfacesaproved ==0) || ($this->comparationfacesaproved =="0")){
   $this->comparationfacesaproved  = "Falso";
}
elseif(($this->comparationfacesaproved ==1) || ($this->comparationfacesaproved =="1")){
   $this->comparationfacesaproved  = "Verdadero";
}
if(($this->resultcomparationfaces ==0) || ($this->resultcomparationfaces =="0")){
   $this->resultcomparationfaces  = "Falso";
}
elseif(($this->resultcomparationfaces ==1) || ($this->resultcomparationfaces =="1")){
   $this->resultcomparationfaces  = "Verdadero";
}

$rcExtras = explode(",",$this->extras );
$sbCodigo = str_replace("IdState:","",$rcExtras[0]);
$sbNombre = ltrim(str_replace("StateName:","",$rcExtras[1]));
$this->extras =$sbCodigo."-".$sbNombre;

$_SESSION['scriptcase']['pdfreport_ado_records_bck']['contr_erro'] = 'off'; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records_bck']['field_order'] as $Cada_col)
         { 
            if (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off")
            { 
                $NM_func_exp = "NM_export_" . $Cada_col;
                $this->$NM_func_exp();
            } 
         } 
         $this->Texto_tag .= "</tr>\r\n";
         $rs->MoveNext();
      }
      $this->Texto_tag .= "</table>\r\n";
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records_bck']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records_bck']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records_bck']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records_bck']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records_bck']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records_bck']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records_bck']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records_bck']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- record
   function NM_export_record()
   {
             nmgp_Form_Num_Val($this->record, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->record = NM_charset_to_utf8($this->record);
         $this->record = str_replace('<', '&lt;', $this->record);
         $this->record = str_replace('>', '&gt;', $this->record);
         $this->Texto_tag .= "<td>" . $this->record . "</td>\r\n";
   }
   //----- uid
   function NM_export_uid()
   {
         $this->uid = html_entity_decode($this->uid, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->uid = strip_tags($this->uid);
         $this->uid = NM_charset_to_utf8($this->uid);
         $this->uid = str_replace('<', '&lt;', $this->uid);
         $this->uid = str_replace('>', '&gt;', $this->uid);
         $this->Texto_tag .= "<td>" . $this->uid . "</td>\r\n";
   }
   //----- startingdate
   function NM_export_startingdate()
   {
             if (substr($this->startingdate, 10, 1) == "-") 
             { 
                 $this->startingdate = substr($this->startingdate, 0, 10) . " " . substr($this->startingdate, 11);
             } 
             if (substr($this->startingdate, 13, 1) == ".") 
             { 
                $this->startingdate = substr($this->startingdate, 0, 13) . ":" . substr($this->startingdate, 14, 2) . ":" . substr($this->startingdate, 17);
             } 
             $conteudo_x =  $this->startingdate;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD HH:II:SS");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->startingdate, "YYYY-MM-DD HH:II:SS  ");
                 $this->startingdate = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "ddmmaaaa;hhiiss"));
             } 
         $this->startingdate = NM_charset_to_utf8($this->startingdate);
         $this->startingdate = str_replace('<', '&lt;', $this->startingdate);
         $this->startingdate = str_replace('>', '&gt;', $this->startingdate);
         $this->Texto_tag .= "<td>" . $this->startingdate . "</td>\r\n";
   }
   //----- creationdate
   function NM_export_creationdate()
   {
             if (substr($this->creationdate, 10, 1) == "-") 
             { 
                 $this->creationdate = substr($this->creationdate, 0, 10) . " " . substr($this->creationdate, 11);
             } 
             if (substr($this->creationdate, 13, 1) == ".") 
             { 
                $this->creationdate = substr($this->creationdate, 0, 13) . ":" . substr($this->creationdate, 14, 2) . ":" . substr($this->creationdate, 17);
             } 
             $conteudo_x =  $this->creationdate;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD HH:II:SS");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->creationdate, "YYYY-MM-DD HH:II:SS  ");
                 $this->creationdate = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "ddmmaaaa;hhiiss"));
             } 
         $this->creationdate = NM_charset_to_utf8($this->creationdate);
         $this->creationdate = str_replace('<', '&lt;', $this->creationdate);
         $this->creationdate = str_replace('>', '&gt;', $this->creationdate);
         $this->Texto_tag .= "<td>" . $this->creationdate . "</td>\r\n";
   }
   //----- creationip
   function NM_export_creationip()
   {
         $this->creationip = html_entity_decode($this->creationip, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->creationip = strip_tags($this->creationip);
         $this->creationip = NM_charset_to_utf8($this->creationip);
         $this->creationip = str_replace('<', '&lt;', $this->creationip);
         $this->creationip = str_replace('>', '&gt;', $this->creationip);
         $this->Texto_tag .= "<td>" . $this->creationip . "</td>\r\n";
   }
   //----- documenttype
   function NM_export_documenttype()
   {
         $this->documenttype = html_entity_decode($this->documenttype, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->documenttype = strip_tags($this->documenttype);
         $this->documenttype = NM_charset_to_utf8($this->documenttype);
         $this->documenttype = str_replace('<', '&lt;', $this->documenttype);
         $this->documenttype = str_replace('>', '&gt;', $this->documenttype);
         $this->Texto_tag .= "<td>" . $this->documenttype . "</td>\r\n";
   }
   //----- idnumber
   function NM_export_idnumber()
   {
         $this->idnumber = html_entity_decode($this->idnumber, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->idnumber = strip_tags($this->idnumber);
         $this->idnumber = NM_charset_to_utf8($this->idnumber);
         $this->idnumber = str_replace('<', '&lt;', $this->idnumber);
         $this->idnumber = str_replace('>', '&gt;', $this->idnumber);
         $this->Texto_tag .= "<td>" . $this->idnumber . "</td>\r\n";
   }
   //----- firstname
   function NM_export_firstname()
   {
         $this->firstname = html_entity_decode($this->firstname, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->firstname = strip_tags($this->firstname);
         $this->firstname = NM_charset_to_utf8($this->firstname);
         $this->firstname = str_replace('<', '&lt;', $this->firstname);
         $this->firstname = str_replace('>', '&gt;', $this->firstname);
         $this->Texto_tag .= "<td>" . $this->firstname . "</td>\r\n";
   }
   //----- secondname
   function NM_export_secondname()
   {
         $this->secondname = html_entity_decode($this->secondname, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->secondname = strip_tags($this->secondname);
         $this->secondname = NM_charset_to_utf8($this->secondname);
         $this->secondname = str_replace('<', '&lt;', $this->secondname);
         $this->secondname = str_replace('>', '&gt;', $this->secondname);
         $this->Texto_tag .= "<td>" . $this->secondname . "</td>\r\n";
   }
   //----- firstsurname
   function NM_export_firstsurname()
   {
         $this->firstsurname = html_entity_decode($this->firstsurname, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->firstsurname = strip_tags($this->firstsurname);
         $this->firstsurname = NM_charset_to_utf8($this->firstsurname);
         $this->firstsurname = str_replace('<', '&lt;', $this->firstsurname);
         $this->firstsurname = str_replace('>', '&gt;', $this->firstsurname);
         $this->Texto_tag .= "<td>" . $this->firstsurname . "</td>\r\n";
   }
   //----- secondsurname
   function NM_export_secondsurname()
   {
         $this->secondsurname = html_entity_decode($this->secondsurname, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->secondsurname = strip_tags($this->secondsurname);
         $this->secondsurname = NM_charset_to_utf8($this->secondsurname);
         $this->secondsurname = str_replace('<', '&lt;', $this->secondsurname);
         $this->secondsurname = str_replace('>', '&gt;', $this->secondsurname);
         $this->Texto_tag .= "<td>" . $this->secondsurname . "</td>\r\n";
   }
   //----- gender
   function NM_export_gender()
   {
         $this->look_gender = html_entity_decode($this->look_gender, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->look_gender = NM_charset_to_utf8($this->look_gender);
         $this->look_gender = str_replace('<', '&lt;', $this->look_gender);
         $this->look_gender = str_replace('>', '&gt;', $this->look_gender);
         $this->Texto_tag .= "<td>" . $this->look_gender . "</td>\r\n";
   }
   //----- birthdate
   function NM_export_birthdate()
   {
             $conteudo_x =  $this->birthdate;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->birthdate, "YYYY-MM-DD  ");
                 $this->birthdate = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         $this->birthdate = NM_charset_to_utf8($this->birthdate);
         $this->birthdate = str_replace('<', '&lt;', $this->birthdate);
         $this->birthdate = str_replace('>', '&gt;', $this->birthdate);
         $this->Texto_tag .= "<td>" . $this->birthdate . "</td>\r\n";
   }
   //----- placebirth
   function NM_export_placebirth()
   {
         $this->placebirth = html_entity_decode($this->placebirth, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->placebirth = strip_tags($this->placebirth);
         $this->placebirth = NM_charset_to_utf8($this->placebirth);
         $this->placebirth = str_replace('<', '&lt;', $this->placebirth);
         $this->placebirth = str_replace('>', '&gt;', $this->placebirth);
         $this->Texto_tag .= "<td>" . $this->placebirth . "</td>\r\n";
   }
   //----- transactiontype
   function NM_export_transactiontype()
   {
         $this->transactiontype = html_entity_decode($this->transactiontype, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->transactiontype = strip_tags($this->transactiontype);
         $this->transactiontype = NM_charset_to_utf8($this->transactiontype);
         $this->transactiontype = str_replace('<', '&lt;', $this->transactiontype);
         $this->transactiontype = str_replace('>', '&gt;', $this->transactiontype);
         $this->Texto_tag .= "<td>" . $this->transactiontype . "</td>\r\n";
   }
   //----- transactiontypename
   function NM_export_transactiontypename()
   {
         $this->transactiontypename = html_entity_decode($this->transactiontypename, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->transactiontypename = strip_tags($this->transactiontypename);
         $this->transactiontypename = NM_charset_to_utf8($this->transactiontypename);
         $this->transactiontypename = str_replace('<', '&lt;', $this->transactiontypename);
         $this->transactiontypename = str_replace('>', '&gt;', $this->transactiontypename);
         $this->Texto_tag .= "<td>" . $this->transactiontypename . "</td>\r\n";
   }
   //----- issuedate
   function NM_export_issuedate()
   {
             $conteudo_x =  $this->issuedate;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->issuedate, "YYYY-MM-DD  ");
                 $this->issuedate = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         $this->issuedate = NM_charset_to_utf8($this->issuedate);
         $this->issuedate = str_replace('<', '&lt;', $this->issuedate);
         $this->issuedate = str_replace('>', '&gt;', $this->issuedate);
         $this->Texto_tag .= "<td>" . $this->issuedate . "</td>\r\n";
   }
   //----- adoprojectid
   function NM_export_adoprojectid()
   {
         $this->adoprojectid = html_entity_decode($this->adoprojectid, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->adoprojectid = strip_tags($this->adoprojectid);
         $this->adoprojectid = NM_charset_to_utf8($this->adoprojectid);
         $this->adoprojectid = str_replace('<', '&lt;', $this->adoprojectid);
         $this->adoprojectid = str_replace('>', '&gt;', $this->adoprojectid);
         $this->Texto_tag .= "<td>" . $this->adoprojectid . "</td>\r\n";
   }
   //----- transactionid
   function NM_export_transactionid()
   {
         $this->transactionid = html_entity_decode($this->transactionid, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->transactionid = strip_tags($this->transactionid);
         $this->transactionid = NM_charset_to_utf8($this->transactionid);
         $this->transactionid = str_replace('<', '&lt;', $this->transactionid);
         $this->transactionid = str_replace('>', '&gt;', $this->transactionid);
         $this->Texto_tag .= "<td>" . $this->transactionid . "</td>\r\n";
   }
   //----- productid
   function NM_export_productid()
   {
         $this->productid = html_entity_decode($this->productid, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->productid = strip_tags($this->productid);
         $this->productid = NM_charset_to_utf8($this->productid);
         $this->productid = str_replace('<', '&lt;', $this->productid);
         $this->productid = str_replace('>', '&gt;', $this->productid);
         $this->Texto_tag .= "<td>" . $this->productid . "</td>\r\n";
   }
   //----- resultcomparationfaces
   function NM_export_resultcomparationfaces()
   {
         $this->resultcomparationfaces = html_entity_decode($this->resultcomparationfaces, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->resultcomparationfaces = strip_tags($this->resultcomparationfaces);
         $this->resultcomparationfaces = NM_charset_to_utf8($this->resultcomparationfaces);
         $this->resultcomparationfaces = str_replace('<', '&lt;', $this->resultcomparationfaces);
         $this->resultcomparationfaces = str_replace('>', '&gt;', $this->resultcomparationfaces);
         $this->Texto_tag .= "<td>" . $this->resultcomparationfaces . "</td>\r\n";
   }
   //----- comparationfacesaproved
   function NM_export_comparationfacesaproved()
   {
         $this->comparationfacesaproved = html_entity_decode($this->comparationfacesaproved, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->comparationfacesaproved = strip_tags($this->comparationfacesaproved);
         $this->comparationfacesaproved = NM_charset_to_utf8($this->comparationfacesaproved);
         $this->comparationfacesaproved = str_replace('<', '&lt;', $this->comparationfacesaproved);
         $this->comparationfacesaproved = str_replace('>', '&gt;', $this->comparationfacesaproved);
         $this->Texto_tag .= "<td>" . $this->comparationfacesaproved . "</td>\r\n";
   }
   //----- extras
   function NM_export_extras()
   {
         $this->extras = html_entity_decode($this->extras, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->extras = strip_tags($this->extras);
         $this->extras = NM_charset_to_utf8($this->extras);
         $this->extras = str_replace('<', '&lt;', $this->extras);
         $this->extras = str_replace('>', '&gt;', $this->extras);
         $this->Texto_tag .= "<td>" . $this->extras . "</td>\r\n";
   }
   //----- response_ani
   function NM_export_response_ani()
   {
         $this->response_ani = html_entity_decode($this->response_ani, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->response_ani = strip_tags($this->response_ani);
         $this->response_ani = NM_charset_to_utf8($this->response_ani);
         $this->response_ani = str_replace('<', '&lt;', $this->response_ani);
         $this->response_ani = str_replace('>', '&gt;', $this->response_ani);
         $this->Texto_tag .= "<td>" . $this->response_ani . "</td>\r\n";
   }
   //----- photo
   function NM_export_photo()
   {
         $this->photo = NM_charset_to_utf8($this->photo);
         $this->photo = str_replace('<', '&lt;', $this->photo);
         $this->photo = str_replace('>', '&gt;', $this->photo);
         $this->Texto_tag .= "<td>" . $this->photo . "</td>\r\n";
   }

   //----- 
   function grava_arquivo_rtf()
   {
      global $nm_lang, $doc_wrap;
      $this->Rtf_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $rtf_f       = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo, "w");
      require_once($this->Ini->path_third      . "/rtf_new/document_generator/cl_xml2driver.php"); 
      $text_ok  =  "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\r\n"; 
      $text_ok .=  "<DOC config_file=\"" . $this->Ini->path_third . "/rtf_new/doc_config.inc\" >\r\n"; 
      $text_ok .=  $this->Texto_tag; 
      $text_ok .=  "</DOC>\r\n"; 
      $xml = new nDOCGEN($text_ok,"RTF"); 
      fwrite($rtf_f, $xml->get_result_file());
      fclose($rtf_f);
   }

   function nm_conv_data_db($dt_in, $form_in, $form_out)
   {
       $dt_out = $dt_in;
       if (strtoupper($form_in) == "DB_FORMAT") {
           if ($dt_out == "null" || $dt_out == "")
           {
               $dt_out = "";
               return $dt_out;
           }
           $form_in = "AAAA-MM-DD";
       }
       if (strtoupper($form_out) == "DB_FORMAT") {
           if (empty($dt_out))
           {
               $dt_out = "null";
               return $dt_out;
           }
           $form_out = "AAAA-MM-DD";
       }
       if (strtoupper($form_out) == "SC_FORMAT_REGION") {
           $this->nm_data->SetaData($dt_in, strtoupper($form_in));
           $prep_out  = (strpos(strtolower($form_in), "dd") !== false) ? "dd" : "";
           $prep_out .= (strpos(strtolower($form_in), "mm") !== false) ? "mm" : "";
           $prep_out .= (strpos(strtolower($form_in), "aa") !== false) ? "aaaa" : "";
           $prep_out .= (strpos(strtolower($form_in), "yy") !== false) ? "aaaa" : "";
           return $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", $prep_out));
       }
       else {
           nm_conv_form_data($dt_out, $form_in, $form_out);
           return $dt_out;
       }
   }
   //---- 
   function monta_html()
   {
      global $nm_url_saida, $nm_lang;
      include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records_bck']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records_bck']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records_bck'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records_bck'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_chart_title'] ?> <?php echo $this->Ini->Nm_lang['lang_tbl_ado_records'] ?> :: RTF</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php
if ($_SESSION['scriptcase']['proc_mobile'])
{
?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
}
?>
  <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
  <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
  <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
  <META http-equiv="Cache-Control" content="post-check=0, pre-check=0"/>
  <META http-equiv="Pragma" content="no-cache"/>
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export.css" /> 
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <?php
 if(isset($this->Ini->str_google_fonts) && !empty($this->Ini->str_google_fonts))
 {
 ?>
    <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->str_google_fonts ?>" />
 <?php
 }
 ?>
  <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $this->Ini->Str_btn_css ?>" /> 
</HEAD>
<BODY class="scExportPage">
<?php echo $this->Ini->Ajax_result_set ?>
<table style="border-collapse: collapse; border-width: 0; height: 100%; width: 100%"><tr><td style="padding: 0; text-align: center; vertical-align: middle">
 <table class="scExportTable" align="center">
  <tr>
   <td class="scExportTitle" style="height: 25px">RTF</td>
  </tr>
  <tr>
   <td class="scExportLine" style="width: 100%">
    <table style="border-collapse: collapse; border-width: 0; width: 100%"><tr><td class="scExportLineFont" style="padding: 3px 0 0 0" id="idMessage">
    <?php echo $this->Ini->Nm_lang['lang_othr_file_msge'] ?>
    </td><td class="scExportLineFont" style="text-align:right; padding: 3px 0 0 0">
     <?php echo nmButtonOutput($this->arr_buttons, "bexportview", "document.Fview.submit()", "document.Fview.submit()", "idBtnView", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
 ?>
     <?php echo nmButtonOutput($this->arr_buttons, "bdownload", "document.Fdown.submit()", "document.Fdown.submit()", "idBtnDown", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
 ?>
     <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F0.submit()", "document.F0.submit()", "idBtnBack", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
 ?>
    </td></tr></table>
   </td>
  </tr>
 </table>
</td></tr></table>
<form name="Fview" method="get" action="<?php echo $this->Ini->path_imag_temp . "/" . $this->Arquivo ?>" target="_blank" style="display: none"> 
</form>
<form name="Fdown" method="get" action="pdfreport_ado_records_bck_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="pdfreport_ado_records_bck"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="volta_grid"> 
</FORM> 
</BODY>
</HTML>
<?php
   }
   function nm_gera_mask(&$nm_campo, $nm_mask)
   { 
      $trab_campo = $nm_campo;
      $trab_mask  = $nm_mask;
      $tam_campo  = strlen($nm_campo);
      $trab_saida = "";
      $str_highlight_ini = "";
      $str_highlight_fim = "";
      if(substr($nm_campo, 0, 23) == '<div class="highlight">' && substr($nm_campo, -6) == '</div>')
      {
           $str_highlight_ini = substr($nm_campo, 0, 23);
           $str_highlight_fim = substr($nm_campo, -6);

           $trab_campo = substr($nm_campo, 23, -6);
           $tam_campo  = strlen($trab_campo);
      }      $mask_num = false;
      for ($x=0; $x < strlen($trab_mask); $x++)
      {
          if (substr($trab_mask, $x, 1) == "#")
          {
              $mask_num = true;
              break;
          }
      }
      if ($mask_num )
      {
          $ver_duas = explode(";", $trab_mask);
          if (isset($ver_duas[1]) && !empty($ver_duas[1]))
          {
              $cont1 = count(explode("#", $ver_duas[0])) - 1;
              $cont2 = count(explode("#", $ver_duas[1])) - 1;
              if ($cont2 >= $tam_campo)
              {
                  $trab_mask = $ver_duas[1];
              }
              else
              {
                  $trab_mask = $ver_duas[0];
              }
          }
          $tam_mask = strlen($trab_mask);
          $xdados = 0;
          for ($x=0; $x < $tam_mask; $x++)
          {
              if (substr($trab_mask, $x, 1) == "#" && $xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_campo, $xdados, 1);
                  $xdados++;
              }
              elseif ($xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_mask, $x, 1);
              }
          }
          if ($xdados < $tam_campo)
          {
              $trab_saida .= substr($trab_campo, $xdados);
          }
          $nm_campo = $str_highlight_ini . $trab_saida . $str_highlight_ini;
          return;
      }
      for ($ix = strlen($trab_mask); $ix > 0; $ix--)
      {
           $char_mask = substr($trab_mask, $ix - 1, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               $trab_saida = $char_mask . $trab_saida;
           }
           else
           {
               if ($tam_campo != 0)
               {
                   $trab_saida = substr($trab_campo, $tam_campo - 1, 1) . $trab_saida;
                   $tam_campo--;
               }
               else
               {
                   $trab_saida = "0" . $trab_saida;
               }
           }
      }
      if ($tam_campo != 0)
      {
          $trab_saida = substr($trab_campo, 0, $tam_campo) . $trab_saida;
          $trab_mask  = str_repeat("z", $tam_campo) . $trab_mask;
      }
   
      $iz = 0; 
      for ($ix = 0; $ix < strlen($trab_mask); $ix++)
      {
           $char_mask = substr($trab_mask, $ix, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               if ($char_mask == "." || $char_mask == ",")
               {
                   $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
               }
               else
               {
                   $iz++;
               }
           }
           elseif ($char_mask == "x" || substr($trab_saida, $iz, 1) != "0")
           {
               $ix = strlen($trab_mask) + 1;
           }
           else
           {
               $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
           }
      }
      $nm_campo = $str_highlight_ini . $trab_saida . $str_highlight_ini;
   } 
}

?>
