<?php

class grid_oauth_users_rtf
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
                   nm_limpa_str_grid_oauth_users($cadapar[1]);
                   nm_protect_num_grid_oauth_users($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['grid_oauth_users']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $this->Arquivo    = "sc_rtf";
      $this->Arquivo   .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arquivo   .= "_grid_oauth_users";
      $this->Arquivo   .= ".rtf";
      $this->Tit_doc    = "grid_oauth_users.rtf";
   }

   //----- 
   function gera_texto_tag()
   {
     global $nm_lang;
      global $nm_nada, $nm_lang;

      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->sc_proc_grid = false; 
      $nm_raiz_img  = ""; 
      $this->New_label['username'] = "" . $this->Ini->Nm_lang['lang_oauth_users_fld_username'] . "";
      $this->New_label['name'] = "" . $this->Ini->Nm_lang['lang_oauth_users_fld_name'] . "";
      $this->New_label['given_name'] = "" . $this->Ini->Nm_lang['lang_oauth_users_fld_given_name'] . "";
      $this->New_label['family_name'] = "" . $this->Ini->Nm_lang['lang_oauth_users_fld_family_name'] . "";
      $this->New_label['uid'] = "" . $this->Ini->Nm_lang['lang_oauth_users_fld_Uid'] . "";
      $this->New_label['transactionid'] = "" . $this->Ini->Nm_lang['lang_oauth_users_fld_TransactionId'] . "";
      $this->New_label['picture'] = "" . $this->Ini->Nm_lang['lang_oauth_users_fld_picture'] . "";
      $this->New_label['password'] = "" . $this->Ini->Nm_lang['lang_oauth_users_fld_password'] . "";
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_oauth_users']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_oauth_users']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_oauth_users']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_oauth_users']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_oauth_users']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_oauth_users']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_oauth_users']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_oauth_users']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_oauth_users']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_oauth_users']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_oauth_users']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_oauth_users']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_oauth_users']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_oauth_users']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_oauth_users']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->username = $Busca_temp['username']; 
          $tmp_pos = strpos($this->username, "##@@");
          if ($tmp_pos !== false && !is_array($this->username))
          {
              $this->username = substr($this->username, 0, $tmp_pos);
          }
          $this->password = $Busca_temp['password']; 
          $tmp_pos = strpos($this->password, "##@@");
          if ($tmp_pos !== false && !is_array($this->password))
          {
              $this->password = substr($this->password, 0, $tmp_pos);
          }
          $this->name = $Busca_temp['name']; 
          $tmp_pos = strpos($this->name, "##@@");
          if ($tmp_pos !== false && !is_array($this->name))
          {
              $this->name = substr($this->name, 0, $tmp_pos);
          }
          $this->given_name = $Busca_temp['given_name']; 
          $tmp_pos = strpos($this->given_name, "##@@");
          if ($tmp_pos !== false && !is_array($this->given_name))
          {
              $this->given_name = substr($this->given_name, 0, $tmp_pos);
          }
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_oauth_users']['rtf_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_oauth_users']['rtf_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_oauth_users']['rtf_name'] .= ".rtf";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_oauth_users']['rtf_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_oauth_users']['rtf_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_oauth_users']['rtf_name']);
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      $this->Texto_tag .= "<table>\r\n";
      $this->Texto_tag .= "<tr>\r\n";
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_oauth_users']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['username'])) ? $this->New_label['username'] : ""; 
          if ($Cada_col == "username" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['name'])) ? $this->New_label['name'] : ""; 
          if ($Cada_col == "name" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['given_name'])) ? $this->New_label['given_name'] : ""; 
          if ($Cada_col == "given_name" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['family_name'])) ? $this->New_label['family_name'] : ""; 
          if ($Cada_col == "family_name" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['transactionid'])) ? $this->New_label['transactionid'] : ""; 
          if ($Cada_col == "transactionid" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['picture'])) ? $this->New_label['picture'] : ""; 
          if ($Cada_col == "picture" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $nmgp_select = "SELECT username, name, given_name, family_name, Uid, TransactionId, picture from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT username, name, given_name, family_name, Uid, TransactionId, picture from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT username, name, given_name, family_name, Uid, TransactionId, picture from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT username, name, given_name, family_name, Uid, TransactionId, picture from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT username, name, given_name, family_name, Uid, TransactionId, picture from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT username, name, given_name, family_name, Uid, TransactionId, picture from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_oauth_users']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_oauth_users']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_oauth_users']['order_grid'];
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
         $this->username = $rs->fields[0] ;  
         $this->name = $rs->fields[1] ;  
         $this->given_name = $rs->fields[2] ;  
         $this->family_name = $rs->fields[3] ;  
         $this->uid = $rs->fields[4] ;  
         $this->transactionid = $rs->fields[5] ;  
         $this->transactionid = (string)$this->transactionid;
         $this->picture = $rs->fields[6] ;  
         $this->sc_proc_grid = true; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_oauth_users']['field_order'] as $Cada_col)
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
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_oauth_users']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_oauth_users']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_oauth_users']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_oauth_users']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_oauth_users']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_oauth_users']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_oauth_users']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_oauth_users']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- username
   function NM_export_username()
   {
         $this->username = html_entity_decode($this->username, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->username = strip_tags($this->username);
         $this->username = NM_charset_to_utf8($this->username);
         $this->username = str_replace('<', '&lt;', $this->username);
         $this->username = str_replace('>', '&gt;', $this->username);
         $this->Texto_tag .= "<td>" . $this->username . "</td>\r\n";
   }
   //----- name
   function NM_export_name()
   {
         $this->name = html_entity_decode($this->name, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->name = strip_tags($this->name);
         $this->name = NM_charset_to_utf8($this->name);
         $this->name = str_replace('<', '&lt;', $this->name);
         $this->name = str_replace('>', '&gt;', $this->name);
         $this->Texto_tag .= "<td>" . $this->name . "</td>\r\n";
   }
   //----- given_name
   function NM_export_given_name()
   {
         $this->given_name = html_entity_decode($this->given_name, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->given_name = strip_tags($this->given_name);
         $this->given_name = NM_charset_to_utf8($this->given_name);
         $this->given_name = str_replace('<', '&lt;', $this->given_name);
         $this->given_name = str_replace('>', '&gt;', $this->given_name);
         $this->Texto_tag .= "<td>" . $this->given_name . "</td>\r\n";
   }
   //----- family_name
   function NM_export_family_name()
   {
         $this->family_name = html_entity_decode($this->family_name, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->family_name = strip_tags($this->family_name);
         $this->family_name = NM_charset_to_utf8($this->family_name);
         $this->family_name = str_replace('<', '&lt;', $this->family_name);
         $this->family_name = str_replace('>', '&gt;', $this->family_name);
         $this->Texto_tag .= "<td>" . $this->family_name . "</td>\r\n";
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
   //----- transactionid
   function NM_export_transactionid()
   {
             nmgp_Form_Num_Val($this->transactionid, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->transactionid = NM_charset_to_utf8($this->transactionid);
         $this->transactionid = str_replace('<', '&lt;', $this->transactionid);
         $this->transactionid = str_replace('>', '&gt;', $this->transactionid);
         $this->Texto_tag .= "<td>" . $this->transactionid . "</td>\r\n";
   }
   //----- picture
   function NM_export_picture()
   {
         $this->picture = html_entity_decode($this->picture, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->picture = strip_tags($this->picture);
         $this->picture = NM_charset_to_utf8($this->picture);
         $this->picture = str_replace('<', '&lt;', $this->picture);
         $this->picture = str_replace('>', '&gt;', $this->picture);
         $this->Texto_tag .= "<td>" . $this->picture . "</td>\r\n";
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_oauth_users']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_oauth_users']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_oauth_users'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_oauth_users'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_grid_title'] ?> <?php echo $this->Ini->Nm_lang['lang_tbl_oauth_users'] ?> :: RTF</TITLE>
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
<form name="Fdown" method="get" action="grid_oauth_users_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_oauth_users"> 
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
