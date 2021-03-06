<?php

class grid_ado_records_admon_pesq
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $cmp_formatado;
   var $nm_data;
   var $Campos_Mens_erro;

   var $comando;
   var $comando_sum;
   var $comando_filtro;
   var $comando_ini;
   var $comando_fim;
   var $NM_operador;
   var $NM_data_qp;
   var $NM_path_filter;
   var $NM_curr_fil;
   var $nm_location;
   var $NM_ajax_opcao;
   var $nmgp_botoes = array();
   var $NM_fil_ant = array();

   /**
    * @access  public
    */
   function __construct()
   {
   }

   /**
    * @access  public
    * @global  string  $bprocessa  
    */
   function monta_busca()
   {
      global $bprocessa;
      include("../_lib/css/" . $this->Ini->str_schema_filter . "_filter.php");
      $this->Ini->Str_btn_filter = trim($str_button) . "/" . trim($str_button) . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".php";
      $this->Str_btn_filter_css  = trim($str_button) . "/" . trim($str_button) . ".css";
      $this->Ini->str_google_fonts = (isset($str_google_fonts) && !empty($str_google_fonts))?$str_google_fonts:'';
      include($this->Ini->path_btn . $this->Ini->Str_btn_filter);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['path_libs_php'] = $this->Ini->path_lib_php;
      $this->Img_sep_filter = "/" . trim($str_toolbar_separator);
      $this->Block_img_col  = trim($str_block_col);
      $this->Block_img_exp  = trim($str_block_exp);
      $this->Bubble_tail    = trim($str_bubble_tail);
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_gp_config_btn.php", "F", "nmButtonOutput"); 
      $this->NM_case_insensitive = false;
      $this->init();
      if ($this->NM_ajax_flag && $this->NM_ajax_opcao == "ajax_grid_search_change_fil")
      {
          $arr_new_fil = $this->recupera_filtro($this->NM_ajax_grid_fil);
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca'] = array(); 
          foreach ($arr_new_fil as $tp)
          {
              foreach ($tp as $ind => $cada_dado)
              {
                  $field = $cada_dado['field'];
                  if (substr($cada_dado['field'], 0, 3) == "SC_")
                  {
                      $field = substr($cada_dado['field'], 3);
                  }
                  if (substr($cada_dado['field'], 0, 6) == "id_ac_")
                  {
                      $field = substr($cada_dado['field'], 6);
                  }
                  if (is_array($cada_dado['value']))
                  {
                      $arr_tmp = array();
                      foreach($cada_dado['value'] as $ix => $dados)
                      {
                          if (isset($dados['opt']))
                          {
                              $arr_tmp[] = $dados['opt'];
                          }
                          else
                          {
                              $arr_tmp[] = $dados;
                          }
                      }
                      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca'][$field] = $arr_tmp; 
                  }
                  else
                  {
                      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca'][$field] = $cada_dado['value']; 
                  }
              }
          }
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca'] = NM_conv_charset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca'], $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->processa_busca();
          if (!empty($this->Campos_Mens_erro)) 
          {
              scriptcase_error_display($this->Campos_Mens_erro, ""); 
              return false;
          }
          return true;
      }
      if ($this->NM_ajax_flag && $this->NM_ajax_opcao == "ajax_grid_search")
      {
         $this->processa_busca();
         return;
      }
      if ($this->NM_ajax_flag)
      {
          ob_start();
          $this->Arr_result = array();
          $this->processa_ajax();
          $Temp = ob_get_clean();
          if ($Temp !== false && trim($Temp) != "")
          {
              $this->Arr_result['htmOutput'] = NM_charset_to_utf8($Temp);
          }
          $oJson = new Services_JSON();
          echo $oJson->encode($this->Arr_result);
          if ($this->Db)
          {
              $this->Db->Close(); 
          }
          exit;
      }
      if (isset($bprocessa) && "pesq" == $bprocessa)
      {
         $this->processa_busca();
      }
      else
      {
         $this->monta_formulario();
      }
   }

   /**
    * @access  public
    */
   function monta_formulario()
   {
      $this->monta_html_ini();
      $this->monta_cabecalho();
      $this->monta_form();
      $this->monta_html_fim();
   }

   /**
    * @access  public
    */
   function init()
   {
      global $bprocessa;
      $_SESSION['scriptcase']['sc_tab_meses']['int'] = array(
                                  $this->Ini->Nm_lang['lang_mnth_janu'],
                                  $this->Ini->Nm_lang['lang_mnth_febr'],
                                  $this->Ini->Nm_lang['lang_mnth_marc'],
                                  $this->Ini->Nm_lang['lang_mnth_apri'],
                                  $this->Ini->Nm_lang['lang_mnth_mayy'],
                                  $this->Ini->Nm_lang['lang_mnth_june'],
                                  $this->Ini->Nm_lang['lang_mnth_july'],
                                  $this->Ini->Nm_lang['lang_mnth_augu'],
                                  $this->Ini->Nm_lang['lang_mnth_sept'],
                                  $this->Ini->Nm_lang['lang_mnth_octo'],
                                  $this->Ini->Nm_lang['lang_mnth_nove'],
                                  $this->Ini->Nm_lang['lang_mnth_dece']);
      $_SESSION['scriptcase']['sc_tab_meses']['abr'] = array(
                                  $this->Ini->Nm_lang['lang_shrt_mnth_janu'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_febr'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_marc'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_apri'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_mayy'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_june'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_july'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_augu'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_sept'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_octo'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_nove'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_dece']);
      $_SESSION['scriptcase']['sc_tab_dias']['int'] = array(
                                  $this->Ini->Nm_lang['lang_days_sund'],
                                  $this->Ini->Nm_lang['lang_days_mond'],
                                  $this->Ini->Nm_lang['lang_days_tued'],
                                  $this->Ini->Nm_lang['lang_days_wend'],
                                  $this->Ini->Nm_lang['lang_days_thud'],
                                  $this->Ini->Nm_lang['lang_days_frid'],
                                  $this->Ini->Nm_lang['lang_days_satd']);
      $_SESSION['scriptcase']['sc_tab_dias']['abr'] = array(
                                  $this->Ini->Nm_lang['lang_shrt_days_sund'],
                                  $this->Ini->Nm_lang['lang_shrt_days_mond'],
                                  $this->Ini->Nm_lang['lang_shrt_days_tued'],
                                  $this->Ini->Nm_lang['lang_shrt_days_wend'],
                                  $this->Ini->Nm_lang['lang_shrt_days_thud'],
                                  $this->Ini->Nm_lang['lang_shrt_days_frid'],
                                  $this->Ini->Nm_lang['lang_shrt_days_satd']);
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_functions.php", "", "") ; 
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_api.php", "", "") ; 
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_data.class.php", "C", "nm_data") ; 
      $this->nm_data = new nm_data("es");
      $pos_path = strrpos($this->Ini->path_prod, "/");
      $this->NM_path_filter = $this->Ini->root . substr($this->Ini->path_prod, 0, $pos_path) . "/conf/filters/";
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['opcao'] = "igual";
   }

   function processa_ajax()
   {
      global $NM_filters, $NM_filters_del, $nmgp_save_name, $nmgp_save_option, $NM_fields_refresh, $NM_parms_refresh, $Campo_bi, $Opc_bi, $NM_operador, $nmgp_save_origem;
//-- ajax metodos ---
      if ($this->NM_ajax_opcao == "ajax_filter_save")
      {
          ob_end_clean();
          ob_end_clean();
          $this->salva_filtro($nmgp_save_origem);
          $this->NM_fil_ant = $this->gera_array_filtros();
          $Nome_filter = "";
          $Opt_filter  = "<option value=\"\"></option>\r\n";
          foreach ($this->NM_fil_ant as $Cada_filter => $Tipo_filter)
          {
              if ($_SESSION['scriptcase']['charset'] != "UTF-8")
              {
                  $Tipo_filter[1] = sc_convert_encoding($Tipo_filter[1], "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($Tipo_filter[1] != $Nome_filter)
              {
                  $Nome_filter = $Tipo_filter[1];
                  $Opt_filter .= "<option value=\"\">" . grid_ado_records_admon_pack_protect_string($Nome_filter) . "</option>\r\n";
              }
              $Opt_filter .= "<option value=\"" . grid_ado_records_admon_pack_protect_string($Tipo_filter[0]) . "\">.." . grid_ado_records_admon_pack_protect_string($Cada_filter) .  "</option>\r\n";
          }
          if (isset($nmgp_save_origem) && $nmgp_save_origem == "grid")
          {
              $Ajax_select  = "<SELECT id=\"id_sel_recup_filters\" class=\"scFilterToolbar_obj\" name=\"sel_recup_filters\" onChange=\"nm_change_grid_search(this)\" size=\"1\">\r\n";
              $Ajax_select .= $Opt_filter;
              $Ajax_select .= "</SELECT>\r\n";
              $this->Arr_result['setValue'][] = array('field' => "id_NM_filters_save", 'value' => $Ajax_select);
              $Ajax_select = "<SELECT id=\"sel_filters_del\" class=\"scFilterToolbar_obj\" name=\"NM_filters_del\" size=\"1\">\r\n";
              $Ajax_select .= $Opt_filter;
              $Ajax_select .= "</SELECT>\r\n";
              $this->Arr_result['setValue'][] = array('field' => "id_sel_filters_del", 'value' => $Ajax_select);
              return;
          }
          $Ajax_select  = "<SELECT id=\"sel_recup_filters_bot\" name=\"NM_filters_bot\" onChange=\"nm_submit_filter(this, 'bot');\" size=\"1\">\r\n";
          $Ajax_select .= $Opt_filter;
          $Ajax_select .= "</SELECT>\r\n";
          $this->Arr_result['setValue'][] = array('field' => "idAjaxSelect_NM_filters_bot", 'value' => $Ajax_select);
          $Ajax_select = "<SELECT id=\"sel_filters_del_bot\" class=\"scFilterToolbar_obj\" name=\"NM_filters_del_bot\" size=\"1\">\r\n";
          $Ajax_select .= $Opt_filter;
          $Ajax_select .= "</SELECT>\r\n";
          $this->Arr_result['setValue'][] = array('field' => "idAjaxSelect_NM_filters_del_bot", 'value' => $Ajax_select);
      }

      if ($this->NM_ajax_opcao == "ajax_filter_delete")
      {
          ob_end_clean();
          ob_end_clean();
          $this->apaga_filtro();
          $this->NM_fil_ant = $this->gera_array_filtros();
          $Nome_filter = "";
          $Opt_filter  = "<option value=\"\"></option>\r\n";
          foreach ($this->NM_fil_ant as $Cada_filter => $Tipo_filter)
          {
              if ($_SESSION['scriptcase']['charset'] != "UTF-8")
              {
                  $Tipo_filter[1] = sc_convert_encoding($Tipo_filter[1], "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($Tipo_filter[1] != $Nome_filter)
              {
                  $Nome_filter  = $Tipo_filter[1];
                  $Opt_filter .= "<option value=\"\">" .  grid_ado_records_admon_pack_protect_string($Nome_filter) . "</option>\r\n";
              }
              $Opt_filter .= "<option value=\"" . grid_ado_records_admon_pack_protect_string($Tipo_filter[0]) . "\">.." . grid_ado_records_admon_pack_protect_string($Cada_filter) .  "</option>\r\n";
          }
          if (isset($nmgp_save_origem) && $nmgp_save_origem == "grid")
          {
              $Ajax_select  = "<SELECT id=\"id_sel_recup_filters\" class=\"scFilterToolbar_obj\" name=\"sel_recup_filters\" onChange=\"nm_change_grid_search(this)\" size=\"1\">\r\n";
              $Ajax_select .= $Opt_filter;
              $Ajax_select .= "</SELECT>\r\n";
              $this->Arr_result['setValue'][] = array('field' => "id_NM_filters_save", 'value' => $Ajax_select);
              $Ajax_select = "<SELECT id=\"sel_filters_del\" class=\"scFilterToolbar_obj\" name=\"NM_filters_del\" size=\"1\">\r\n";
              $Ajax_select .= $Opt_filter;
              $Ajax_select .= "</SELECT>\r\n";
              $this->Arr_result['setValue'][] = array('field' => "id_sel_filters_del", 'value' => $Ajax_select);
              return;
          }
          $Ajax_select  = "<SELECT id=\"sel_recup_filters_bot\" class=\"scFilterToolbar_obj\" style=\"display:". (count($this->NM_fil_ant)>0?'':'none') .";\" name=\"NM_filters_bot\" onChange=\"nm_submit_filter(this, 'bot');\" size=\"1\">\r\n";
          $Ajax_select .= $Opt_filter;
          $Ajax_select .= "</SELECT>\r\n";
          $this->Arr_result['setValue'][] = array('field' => "idAjaxSelect_NM_filters_bot", 'value' => $Ajax_select);
          $Ajax_select = "<SELECT id=\"sel_filters_del_bot\" class=\"scFilterToolbar_obj\" name=\"NM_filters_del_bot\" size=\"1\">\r\n";
          $Ajax_select .= $Opt_filter;
          $Ajax_select .= "</SELECT>\r\n";
          $this->Arr_result['setValue'][] = array('field' => "idAjaxSelect_NM_filters_del_bot", 'value' => $Ajax_select);
      }
      if ($this->NM_ajax_opcao == "ajax_filter_select")
      {
          ob_end_clean();
          ob_end_clean();
          $this->Arr_result = $this->recupera_filtro($NM_filters);
      }

      if ($this->NM_ajax_opcao == 'autocomp_creationip')
      {
          $creationip = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_creationip($creationip);
          ob_end_clean();
          ob_end_clean();
          $count_aut_comp = 0;
          $resp_aut_comp  = array();
          foreach ($nmgp_def_dados as $Ind => $Lista)
          {
             if (is_array($Lista))
             {
                 foreach ($Lista as $Cod => $Valor)
                 {
                     if ($_GET['cod_desc'] == "S")
                     {
                         $Valor = $Cod . " - " . $Valor;
                     }
                     $resp_aut_comp[] = array('label' => $Valor , 'value' => $Cod);
                     $count_aut_comp++;
                 }
             }
             if ($count_aut_comp == $_GET['max_itens'])
             {
                 break;
             }
          }
          $oJson = new Services_JSON();
          echo $oJson->encode($resp_aut_comp);
          $this->Db->Close(); 
          exit;
      }
      if ($this->NM_ajax_opcao == 'autocomp_firstname')
      {
          $firstname = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_firstname($firstname);
          ob_end_clean();
          ob_end_clean();
          $count_aut_comp = 0;
          $resp_aut_comp  = array();
          foreach ($nmgp_def_dados as $Ind => $Lista)
          {
             if (is_array($Lista))
             {
                 foreach ($Lista as $Cod => $Valor)
                 {
                     if ($_GET['cod_desc'] == "S")
                     {
                         $Valor = $Cod . " - " . $Valor;
                     }
                     $resp_aut_comp[] = array('label' => $Valor , 'value' => $Cod);
                     $count_aut_comp++;
                 }
             }
             if ($count_aut_comp == $_GET['max_itens'])
             {
                 break;
             }
          }
          $oJson = new Services_JSON();
          echo $oJson->encode($resp_aut_comp);
          $this->Db->Close(); 
          exit;
      }
      if ($this->NM_ajax_opcao == 'autocomp_firstsurname')
      {
          $firstsurname = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_firstsurname($firstsurname);
          ob_end_clean();
          ob_end_clean();
          $count_aut_comp = 0;
          $resp_aut_comp  = array();
          foreach ($nmgp_def_dados as $Ind => $Lista)
          {
             if (is_array($Lista))
             {
                 foreach ($Lista as $Cod => $Valor)
                 {
                     if ($_GET['cod_desc'] == "S")
                     {
                         $Valor = $Cod . " - " . $Valor;
                     }
                     $resp_aut_comp[] = array('label' => $Valor , 'value' => $Cod);
                     $count_aut_comp++;
                 }
             }
             if ($count_aut_comp == $_GET['max_itens'])
             {
                 break;
             }
          }
          $oJson = new Services_JSON();
          echo $oJson->encode($resp_aut_comp);
          $this->Db->Close(); 
          exit;
      }
      if ($this->NM_ajax_opcao == 'autocomp_transactiontypename')
      {
          $transactiontypename = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_transactiontypename($transactiontypename);
          ob_end_clean();
          ob_end_clean();
          $count_aut_comp = 0;
          $resp_aut_comp  = array();
          foreach ($nmgp_def_dados as $Ind => $Lista)
          {
             if (is_array($Lista))
             {
                 foreach ($Lista as $Cod => $Valor)
                 {
                     if ($_GET['cod_desc'] == "S")
                     {
                         $Valor = $Cod . " - " . $Valor;
                     }
                     $resp_aut_comp[] = array('label' => $Valor , 'value' => $Cod);
                     $count_aut_comp++;
                 }
             }
             if ($count_aut_comp == $_GET['max_itens'])
             {
                 break;
             }
          }
          $oJson = new Services_JSON();
          echo $oJson->encode($resp_aut_comp);
          $this->Db->Close(); 
          exit;
      }
      if ($this->NM_ajax_opcao == 'autocomp_extras')
      {
          $extras = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_extras($extras);
          ob_end_clean();
          ob_end_clean();
          $count_aut_comp = 0;
          $resp_aut_comp  = array();
          foreach ($nmgp_def_dados as $Ind => $Lista)
          {
             if (is_array($Lista))
             {
                 foreach ($Lista as $Cod => $Valor)
                 {
                     if ($_GET['cod_desc'] == "S")
                     {
                         $Valor = $Cod . " - " . $Valor;
                     }
                     $resp_aut_comp[] = array('label' => $Valor , 'value' => $Cod);
                     $count_aut_comp++;
                 }
             }
             if ($count_aut_comp == $_GET['max_itens'])
             {
                 break;
             }
          }
          $oJson = new Services_JSON();
          echo $oJson->encode($resp_aut_comp);
          $this->Db->Close(); 
          exit;
      }
   }
   function lookup_ajax_creationip($creationip)
   {
      $creationip = substr($this->Db->qstr($creationip), 1, -1);
            $creationip_look = substr($this->Db->qstr($creationip), 1, -1); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct CreationIP from " . $this->Ini->nm_tabela . " where EstadoReg='A' and  CreationIP like '%" . $creationip . "%' order by CreationIP"; 
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

      return $nmgp_def_dados;
   }
   
   function lookup_ajax_firstname($firstname)
   {
      $firstname = substr($this->Db->qstr($firstname), 1, -1);
            $firstname_look = substr($this->Db->qstr($firstname), 1, -1); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct FirstName from " . $this->Ini->nm_tabela . " where EstadoReg='A' and  FirstName like '%" . $firstname . "%' order by FirstName"; 
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

      return $nmgp_def_dados;
   }
   
   function lookup_ajax_firstsurname($firstsurname)
   {
      $firstsurname = substr($this->Db->qstr($firstsurname), 1, -1);
            $firstsurname_look = substr($this->Db->qstr($firstsurname), 1, -1); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct FirstSurname from " . $this->Ini->nm_tabela . " where EstadoReg='A' and  FirstSurname like '%" . $firstsurname . "%' order by FirstSurname"; 
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

      return $nmgp_def_dados;
   }
   
   function lookup_ajax_transactiontypename($transactiontypename)
   {
      $transactiontypename = substr($this->Db->qstr($transactiontypename), 1, -1);
            $transactiontypename_look = substr($this->Db->qstr($transactiontypename), 1, -1); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct TransactionTypeName from " . $this->Ini->nm_tabela . " where EstadoReg='A' and  TransactionTypeName like '%" . $transactiontypename . "%' order by TransactionTypeName"; 
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

      return $nmgp_def_dados;
   }
   
   function lookup_ajax_extras($extras)
   {
      $extras = substr($this->Db->qstr($extras), 1, -1);
            $extras_look = substr($this->Db->qstr($extras), 1, -1); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct Extras from " . $this->Ini->nm_tabela . " where EstadoReg='A' and  Extras like '%" . $extras . "%' order by Extras"; 
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

      return $nmgp_def_dados;
   }
   

   /**
    * @access  public
    */
   function processa_busca()
   {
      $this->inicializa_vars();
      $this->trata_campos();
      if ($this->NM_ajax_flag && ($this->NM_ajax_opcao == "ajax_grid_search" || $this->NM_ajax_opcao == "ajax_grid_search_change_fil"))
      {
          $this->finaliza_resultado_ajax();
          return;
      }
      if (!empty($this->Campos_Mens_erro)) 
      {
          $this->monta_formulario();
      }
      else
      {
          $this->finaliza_resultado();
      }
   }

   /**
    * @access  public
    */
   function and_or()
   {
      $posWhere = strpos(strtolower($this->comando), "where");
      if (FALSE === $posWhere)
      {
         $this->comando     .= " where (";
         $this->comando_sum .= " and (";
         $this->comando_fim  = " ) ";
      }
      if ($this->comando_ini == "ini")
      {
          if (FALSE !== $posWhere)
          {
              $this->comando     .= " and ( ";
              $this->comando_sum .= " and ( ";
              $this->comando_fim  = " ) ";
          }
         $this->comando_ini  = "";
      }
      elseif ("or" == $this->NM_operador)
      {
         $this->comando        .= " or ";
         $this->comando_sum    .= " or ";
         $this->comando_filtro .= " or ";
      }
      else
      {
         $this->comando        .= " and ";
         $this->comando_sum    .= " and ";
         $this->comando_filtro .= " and ";
      }
   }

   /**
    * @access  public
    * @param  string  $nome  
    * @param  string  $condicao  
    * @param  mixed  $campo  
    * @param  mixed  $campo2  
    * @param  string  $nome_campo  
    * @param  string  $tp_campo  
    * @global  array  $nmgp_tab_label  
    */
   function monta_condicao($nome, $condicao, $campo, $campo2 = "", $nome_campo="", $tp_campo="")
   {
      global $nmgp_tab_label;
      $condicao   = strtoupper($condicao);
      $nm_aspas   = "'";
      $nm_aspas1  = "'";
      $Nm_numeric = array();
      $nm_esp_postgres = array();
      $nm_ini_lower = "";
      $nm_fim_lower = "";
      $Nm_datas[] = "StartingDate";$Nm_datas[] = "StartingDate";$Nm_datas[] = "CreationDate";$Nm_datas[] = "CreationDate";$Nm_datas[] = "BirthDate";$Nm_datas[] = "BirthDate";$Nm_datas[] = "DateOfIdentification";$Nm_datas[] = "DateOfIdentification";$Nm_datas[] = "DateOfDeath";$Nm_datas[] = "DateOfDeath";$Nm_datas[] = "MarriageDate";$Nm_datas[] = "MarriageDate";$Nm_datas[] = "IssueDate";$Nm_datas[] = "IssueDate";$Nm_numeric[] = "record";$Nm_numeric[] = "verifyupdate";
      $campo_join = strtolower(str_replace(".", "_", $nome));
      if (in_array($campo_join, $Nm_numeric))
      {
          if ($condicao == "EP" || $condicao == "NE")
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$campo_join]);
              return;
          }
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['decimal_db'] == ".")
         {
            $nm_aspas  = "";
            $nm_aspas1 = "";
         }
         if ($condicao != "IN")
         {
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['decimal_db'] == ".")
            {
               $campo  = str_replace(",", ".", $campo);
               $campo2 = str_replace(",", ".", $campo2);
            }
            if ($campo == "")
            {
               $campo = 0;
            }
            if ($campo2 == "")
            {
               $campo2 = 0;
            }
         }
      }
      $Nm_datas[] = "StartingDate";$Nm_datas[] = "StartingDate";$Nm_datas[] = "CreationDate";$Nm_datas[] = "CreationDate";$Nm_datas[] = "BirthDate";$Nm_datas[] = "BirthDate";$Nm_datas[] = "DateOfIdentification";$Nm_datas[] = "DateOfIdentification";$Nm_datas[] = "DateOfDeath";$Nm_datas[] = "DateOfDeath";$Nm_datas[] = "MarriageDate";$Nm_datas[] = "MarriageDate";$Nm_datas[] = "IssueDate";$Nm_datas[] = "IssueDate";
      if (in_array($campo_join, $Nm_datas))
      {
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
             $nm_aspas  = "#";
             $nm_aspas1 = "#";
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['SC_sep_date']))
          {
              $nm_aspas  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['SC_sep_date'];
              $nm_aspas1 = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['SC_sep_date1'];
          }
      }
      if ($campo == "" && $condicao != "NU" && $condicao != "NN" && $condicao != "EP" && $condicao != "NE")
      {
         return;
      }
      else
      {
         $tmp_pos = strpos($campo, "##@@");
         if ($tmp_pos === false)
         {
             $res_lookup = $campo;
         }
         else
         {
             $res_lookup = substr($campo, $tmp_pos + 4);
             $campo = substr($campo, 0, $tmp_pos);
             if ($campo == "" && $condicao != "NU" && $condicao != "NN" && $condicao != "EP" && $condicao != "NE")
             {
                 return;
             }
         }
         $tmp_pos = strpos($this->cmp_formatado[$nome_campo], "##@@");
         if ($tmp_pos !== false)
         {
             $this->cmp_formatado[$nome_campo] = substr($this->cmp_formatado[$nome_campo], $tmp_pos + 4);
         }
         $this->and_or();
         $campo  = substr($this->Db->qstr($campo), 1, -1);
         $campo2 = substr($this->Db->qstr($campo2), 1, -1);
         $nome_sum = "ado_records.$nome";
         if ($tp_campo == "TIMESTAMP")
         {
             $tp_campo = "DATETIME";
         }
         if (in_array($campo_join, $Nm_numeric) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && ($condicao == "II" || $condicao == "QP" || $condicao == "NP"))
         {
             $nome     = "CAST ($nome AS TEXT)";
             $nome_sum = "CAST ($nome_sum AS TEXT)";
         }
         if (in_array($campo_join, $nm_esp_postgres) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
         {
             $nome     = "CAST ($nome AS TEXT)";
             $nome_sum = "CAST ($nome_sum AS TEXT)";
         }
         if (substr($tp_campo, 0, 8) == "DATETIME" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && !$this->Date_part)
         {
             if (in_array($condicao, array('II','QP','NP','IN','EP','NE'))) {
                 $nome     = "to_char ($nome, 'YYYY-MM-DD hh24:mi:ss')";
                 $nome_sum = "to_char ($nome_sum, 'YYYY-MM-DD hh24:mi:ss')";
             }
         }
         elseif (substr($tp_campo, 0, 4) == "DATE" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && !$this->Date_part)
         {
             if (in_array($condicao, array('II','QP','NP','IN','EP','NE'))) {
                 $nome     = "to_char ($nome, 'YYYY-MM-DD')";
                 $nome_sum = "to_char ($nome_sum, 'YYYY-MM-DD')";
             }
         }
         elseif (substr($tp_campo, 0, 4) == "TIME" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && !$this->Date_part)
         {
             if (in_array($condicao, array('II','QP','NP','IN','EP','NE'))) {
                 $nome     = "to_char ($nome, 'hh24:mi:ss')";
                 $nome_sum = "to_char ($nome_sum, 'hh24:mi:ss')";
             }
         }
         if (in_array($campo_join, $Nm_numeric) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase) && ($condicao == "II" || $condicao == "QP" || $condicao == "NP"))
         {
             $nome     = "CAST ($nome AS VARCHAR)";
             $nome_sum = "CAST ($nome_sum AS VARCHAR)";
         }
         if ($tp_campo == "DATE" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql) && !$this->Date_part)
         {
             if (in_array($condicao, array('II','QP','NP','IN','EP','NE'))) {
                 $nome     = "convert(char(10),$nome,121)";
                 $nome_sum = "convert(char(10),$nome_sum,121)";
             }
         }
         if ($tp_campo == "DATETIME" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql) && !$this->Date_part)
         {
             if (in_array($condicao, array('II','QP','NP','IN','EP','NE'))) {
                 $nome     = "convert(char(19),$nome,121)";
                 $nome_sum = "convert(char(19),$nome_sum,121)";
             }
         }
         if (substr($tp_campo, 0, 8) == "DATETIME" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle) && !$this->Date_part)
         {
             $nome     = "TO_DATE(TO_CHAR($nome, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss')";
             $nome_sum = "TO_DATE(TO_CHAR($nome_sum, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss')";
             $tp_campo = "DATETIME";
         }
         if (substr($tp_campo, 0, 8) == "DATETIME" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix) && !$this->Date_part)
         {
             $nome     = "EXTEND($nome, YEAR TO FRACTION)";
             $nome_sum = "EXTEND($nome_sum, YEAR TO FRACTION)";
         }
         elseif (substr($tp_campo, 0, 4) == "DATE" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix) && !$this->Date_part)
         {
             $nome     = "EXTEND($nome, YEAR TO DAY)";
             $nome_sum = "EXTEND($nome_sum, YEAR TO DAY)";
         }
         if (in_array($campo_join, $Nm_numeric) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress) && ($condicao == "II" || $condicao == "QP" || $condicao == "NP"))
         {
             $nome     = "CAST ($nome AS VARCHAR(255))";
             $nome_sum = "CAST ($nome_sum AS VARCHAR(255))";
         }
         if (substr($tp_campo, 0, 8) == "DATETIME" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress) && !$this->Date_part)
         {
             if (in_array($condicao, array('II','QP','NP','IN','EP','NE'))) {
                 $nome     = "to_char ($nome, 'YYYY-MM-DD hh24:mi:ss')";
                 $nome_sum = "to_char ($nome_sum, 'YYYY-MM-DD hh24:mi:ss')";
             }
         }
         if (substr($tp_campo, 0, 4) == "DATE" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress) && !$this->Date_part)
         {
             if (in_array($condicao, array('II','QP','NP','IN','EP','NE'))) {
                 $nome     = "to_char ($nome, 'YYYY-MM-DD')";
                 $nome_sum = "to_char ($nome_sum, 'YYYY-MM-DD')";
             }
         }
         switch ($condicao)
         {
            case "EQ":     // 
               $this->comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " = " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
               $this->comando_sum    .= $nm_ini_lower . $nome_sum . $nm_fim_lower . " = " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
               $this->comando_filtro .= $nm_ini_lower . $nome . $nm_fim_lower. " = " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_equl'] . " " . $this->cmp_formatado[$nome_campo] . "##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_equl'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_equl'] . " " . $this->cmp_formatado[$nome_campo];
            break;
            case "II":     // 
               if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && $this->NM_case_insensitive)
               {
                   $op_all       = " ilike ";
                   $nm_ini_lower = "";
                   $nm_fim_lower = "";
               }
               else
               {
                   $op_all = " like ";
               }
               $this->comando        .= $nm_ini_lower . $nome . $nm_fim_lower . $op_all . $nm_ini_lower . "'" . $campo . "%'" . $nm_fim_lower;
               $this->comando_sum    .= $nm_ini_lower . $nome_sum . $nm_fim_lower . $op_all . $nm_ini_lower . "'" . $campo . "%'" . $nm_fim_lower;
               $this->comando_filtro .= $nm_ini_lower . $nome . $nm_fim_lower . $op_all . $nm_ini_lower . "'" . $campo . "%'" . $nm_fim_lower;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_strt'] . " " . $this->cmp_formatado[$nome_campo] . "##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_strt'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_strt'] . " " . $this->cmp_formatado[$nome_campo];
            break;
             case "QP";     // 
             case "NP";     // 
                $concat = " " . $this->NM_operador . " ";
                if ($condicao == "QP")
                {
                    $op_all    = " #sc_like_# ";
                    $lang_like = $this->Ini->Nm_lang['lang_srch_like'];
                }
                else
                {
                    $op_all    = " not #sc_like_# ";
                    $lang_like = $this->Ini->Nm_lang['lang_srch_not_like'];
                }
               $NM_cond    = "";
               $NM_cmd     = "";
               $NM_cmd_sum = "";
               if (substr($tp_campo, 0, 4) == "DATE" && $this->Date_part)
               {
                   if ($this->NM_data_qp['ano'] != "____")
                   {
                       $NM_cond    .= (empty($NM_cmd)) ? "" : " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " ";
                       $NM_cond    .= $this->Ini->Nm_lang['lang_srch_year'] . " " . $this->Lang_date_part . " " . $this->NM_data_qp['ano'];
                       $NM_cmd     .= (empty($NM_cmd)) ? "" : $concat;
                       $NM_cmd_sum .= (empty($NM_cmd_sum)) ? "" : $concat;
                       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
                       {
                           $NM_cmd     .= "strftime('%Y', " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                           $NM_cmd_sum .= "strftime('%Y', " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
                       {
                           $NM_cmd     .= "extract(year from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(year from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                       {
                           if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'YYYY') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'YYYY') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= $this->Ini_date_char . "extract('year' from " . $nome . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                               $NM_cmd_sum .= $this->Ini_date_char . "extract('year' from " . $nome_sum . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                           }
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
                       {
                           $NM_cmd     .= "extract(year from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(year from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                       {
                           $NM_cmd     .= "TO_CHAR(" . $nome . ", 'YYYY')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                           $NM_cmd_sum .= "TO_CHAR(" . $nome_sum . ", 'YYYY')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
                       {
                           $NM_cmd     .= "DATEPART(year, " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                           $NM_cmd_sum .= "DATEPART(year, " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress))
                       {
                           if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'YYYY') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'YYYY') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= "year (" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                               $NM_cmd_sum .= "year (" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                           }
                       }
                       else
                       {
                           $NM_cmd     .= "year(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                           $NM_cmd_sum .= "year(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                       }
                   }
                   if ($this->NM_data_qp['mes'] != "__")
                   {
                       $NM_cond    .= (empty($NM_cmd)) ? "" : " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " ";
                       $NM_cond    .= $this->Ini->Nm_lang['lang_srch_mnth'] . " " . $this->Lang_date_part . " " . $this->NM_data_qp['mes'];
                       $NM_cmd     .= (empty($NM_cmd)) ? "" : $concat;
                       $NM_cmd_sum .= (empty($NM_cmd_sum)) ? "" : $concat;
                       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
                       {
                           $NM_cmd     .= "strftime('%m', " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                           $NM_cmd_sum .= "strftime('%m', " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
                       {
                           $NM_cmd     .= "extract(month from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(month from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                       {
                           if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'MM') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'MM') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= $this->Ini_date_char . "extract('month' from " . $nome . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                               $NM_cmd_sum .= $this->Ini_date_char . "extract('month' from " . $nome_sum . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                           }
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
                       {
                           $NM_cmd     .= "extract(month from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(month from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                       {
                           $NM_cmd     .= "TO_CHAR(" . $nome . ", 'MM')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                           $NM_cmd_sum .= "TO_CHAR(" . $nome_sum . ", 'MM')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
                       {
                           $NM_cmd     .= "DATEPART(month, " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                           $NM_cmd_sum .= "DATEPART(month, " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress))
                       {
                           if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'MM') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'MM') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= "month (" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                               $NM_cmd_sum .= "month (" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                           }
                       }
                       else
                       {
                           $NM_cmd     .= "month(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                           $NM_cmd_sum .= "month(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                       }
                   }
                   if ($this->NM_data_qp['dia'] != "__")
                   {
                       $NM_cond    .= (empty($NM_cmd)) ? "" : " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " ";
                       $NM_cond    .= $this->Ini->Nm_lang['lang_srch_days'] . " " . $this->Lang_date_part . " " . $this->NM_data_qp['dia'];
                       $NM_cmd     .= (empty($NM_cmd)) ? "" : $concat;
                       $NM_cmd_sum .= (empty($NM_cmd_sum)) ? "" : $concat;
                       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
                       {
                           $NM_cmd     .= "strftime('%d', " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                           $NM_cmd_sum .= "strftime('%d', " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
                       {
                           $NM_cmd     .= "extract(day from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(day from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                       {
                           if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'DD') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'DD') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= $this->Ini_date_char . "extract('day' from " . $nome . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                               $NM_cmd_sum .= $this->Ini_date_char . "extract('day' from " . $nome_sum . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                           }
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
                       {
                           $NM_cmd     .= "extract(day from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(day from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                       {
                           $NM_cmd     .= "TO_CHAR(" . $nome . ", 'DD')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                           $NM_cmd_sum .= "TO_CHAR(" . $nome_sum . ", 'DD')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
                       {
                           $NM_cmd     .= "DATEPART(day, " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                           $NM_cmd_sum .= "DATEPART(day, " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress))
                       {
                           if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'DD') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'DD') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= "DAYOFMONTH(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                               $NM_cmd_sum .= "DAYOFMONTH(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                           }
                       }
                       else
                       {
                           $NM_cmd     .= "day(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                           $NM_cmd_sum .= "day(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                       }
                   }
               }
               if (strpos($tp_campo, "TIME") !== false && $this->Date_part)
               {
                   if ($this->NM_data_qp['hor'] != "__")
                   {
                       $NM_cond    .= (empty($NM_cmd)) ? "" : " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " ";
                       $NM_cond    .= $this->Ini->Nm_lang['lang_srch_time'] . " " . $this->Lang_date_part . " " . $this->NM_data_qp['hor'];
                       $NM_cmd     .= (empty($NM_cmd)) ? "" : $concat;
                       $NM_cmd_sum .= (empty($NM_cmd_sum)) ? "" : $concat;
                       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
                       {
                           $NM_cmd     .= "strftime('%H', " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                           $NM_cmd_sum .= "strftime('%H', " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
                       {
                           $NM_cmd     .= "extract(hour from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(hour from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                       {
                           if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'hh24') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'hh24') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= $this->Ini_date_char . "extract('hour' from " . $nome . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                               $NM_cmd_sum .= $this->Ini_date_char . "extract('hour' from " . $nome_sum . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                           }
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
                       {
                           $NM_cmd     .= "extract(hour from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(hour from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                       {
                           $NM_cmd     .= "TO_CHAR(" . $nome . ", 'HH24')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                           $NM_cmd_sum .= "TO_CHAR(" . $nome_sum . ", 'HH24')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
                       {
                           $NM_cmd     .= "DATEPART(hour, " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                           $NM_cmd_sum .= "DATEPART(hour, " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress))
                       {
                           if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'hh24') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'hh24') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= "hour(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                               $NM_cmd_sum .= "hour(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                           }
                       }
                       else
                       {
                           $NM_cmd     .= "hour(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                           $NM_cmd_sum .= "hour(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                       }
                   }
                   if ($this->NM_data_qp['min'] != "__")
                   {
                       $NM_cond    .= (empty($NM_cmd)) ? "" : " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " ";
                       $NM_cond    .= $this->Ini->Nm_lang['lang_srch_mint'] . " " . $this->Lang_date_part . " " . $this->NM_data_qp['min'];
                       $NM_cmd     .= (empty($NM_cmd)) ? "" : $concat;
                       $NM_cmd_sum .= (empty($NM_cmd_sum)) ? "" : $concat;
                       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
                       {
                           $NM_cmd     .= "strftime('%M', " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                           $NM_cmd_sum .= "strftime('%M', " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
                       {
                           $NM_cmd     .= "extract(minute from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(minute from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                       {
                           if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'mi') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'mi') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= $this->Ini_date_char . "extract('minute' from " . $nome . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                               $NM_cmd_sum .= $this->Ini_date_char . "extract('minute' from " . $nome_sum . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                           }
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
                       {
                           $NM_cmd     .= "extract(minute from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(minute from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                       {
                           $NM_cmd     .= "TO_CHAR(" . $nome . ", 'MI')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                           $NM_cmd_sum .= "TO_CHAR(" . $nome_sum . ", 'MI')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
                       {
                           $NM_cmd     .= "DATEPART(minute, " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                           $NM_cmd_sum .= "DATEPART(minute, " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress))
                       {
                           if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'mi') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'mi') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= "minute(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                               $NM_cmd_sum .= "minute(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                           }
                       }
                       else
                       {
                           $NM_cmd     .= "minute(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                           $NM_cmd_sum .= "minute(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                       }
                   }
                   if ($this->NM_data_qp['seg'] != "__")
                   {
                       $NM_cond    .= (empty($NM_cmd)) ? "" : " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " ";
                       $NM_cond    .= $this->Ini->Nm_lang['lang_srch_scnd'] . " " . $this->Lang_date_part . " " . $this->NM_data_qp['seg'];
                       $NM_cmd     .= (empty($NM_cmd)) ? "" : $concat;
                       $NM_cmd_sum .= (empty($NM_cmd_sum)) ? "" : $concat;
                       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
                       {
                           $NM_cmd     .= "strftime('%S', " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                           $NM_cmd_sum .= "strftime('%S', " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
                       {
                           $NM_cmd     .= "extract(second from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(second from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                       {
                           if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'ss') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'ss') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= $this->Ini_date_char . "extract('second' from " . $nome . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                               $NM_cmd_sum .= $this->Ini_date_char . "extract('second' from " . $nome_sum . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                           }
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
                       {
                           $NM_cmd     .= "extract(second from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(second from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                       {
                           $NM_cmd     .= "TO_CHAR(" . $nome . ", 'SS')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                           $NM_cmd_sum .= "TO_CHAR(" . $nome_sum . ", 'SS')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
                       {
                           $NM_cmd     .= "DATEPART(second, " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                           $NM_cmd_sum .= "DATEPART(second, " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress))
                       {
                           if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'ss') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'ss') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= "second(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                               $NM_cmd_sum .= "second(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                           }
                       }
                       else
                       {
                           $NM_cmd     .= "second(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                           $NM_cmd_sum .= "second(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                       }
                   }
               }
               if ($this->Date_part)
               {
                   if (!empty($NM_cmd))
                   {
                       $NM_cmd     = " (" . $NM_cmd . ")";
                       $NM_cmd_sum = " (" . $NM_cmd_sum . ")";
                       $this->comando        .= $NM_cmd;
                       $this->comando_sum    .= $NM_cmd_sum;
                       $this->comando_filtro .= $NM_cmd;
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . ": " . $NM_cond . "##*@@";
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $NM_cond;
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $NM_cond;
                   }
               }
               else
               {
                   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && $this->NM_case_insensitive)
                   {
                       $op_all       = str_replace("#sc_like_#", "ilike", $op_all);
                       $nm_ini_lower = "";
                       $nm_fim_lower = "";
                   }
                   else
                   {
                       $op_all = str_replace("#sc_like_#", "like", $op_all);
                   }
                   $this->comando        .= $nm_ini_lower . $nome . $nm_fim_lower . $op_all . $nm_ini_lower . "'%" . $campo . "%'" . $nm_fim_lower;
                   $this->comando_sum    .= $nm_ini_lower . $nome_sum . $nm_fim_lower . $op_all . $nm_ini_lower . "'%" . $campo . "%'" . $nm_fim_lower;
                   $this->comando_filtro .= $nm_ini_lower . $nome . $nm_fim_lower . $op_all . $nm_ini_lower . "'%" . $campo . "%'" . $nm_fim_lower;
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $lang_like . " " . $this->cmp_formatado[$nome_campo] . "##*@@";
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $lang_like . " " . $this->cmp_formatado[$nome_campo];
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $lang_like . " " . $this->cmp_formatado[$nome_campo];
               }
            break;
            case "DF":     // 
               $this->comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " <> " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
               $this->comando_sum    .= $nm_ini_lower . $nome_sum . $nm_fim_lower . " <> " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
               $this->comando_filtro .= $nm_ini_lower . $nome . $nm_fim_lower . " <> " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_diff'] . " " . $this->cmp_formatado[$nome_campo] . "##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_diff'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_diff'] . " " . $this->cmp_formatado[$nome_campo];
            break;
            case "GT":     // 
               $this->comando        .= " $nome > " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum > " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= " $nome > " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_grtr'] . " " . $this->cmp_formatado[$nome_campo] . "##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_grtr'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_grtr'] . " " . $this->cmp_formatado[$nome_campo];
            break;
            case "GE":     // 
               $this->comando        .= " $nome >= " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum >= " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= " $nome >= " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_grtr_equl'] . " " . $this->cmp_formatado[$nome_campo] . "##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_grtr_equl'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_grtr_equl'] . " " . $this->cmp_formatado[$nome_campo];
            break;
            case "LT":     // 
               $this->comando        .= " $nome < " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum < " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= " $nome < " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_less'] . " " . $this->cmp_formatado[$nome_campo] . "##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_less'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_less'] . " " . $this->cmp_formatado[$nome_campo];
            break;
            case "LE":     // 
               $this->comando        .= " $nome <= " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum <= " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= " $nome <= " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_less_equl'] . " " . $this->cmp_formatado[$nome_campo] . "##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_less_equl'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_less_equl'] . " " . $this->cmp_formatado[$nome_campo];
            break;
            case "BW":     // 
               $this->comando        .= " $nome between " . $nm_aspas . $campo . $nm_aspas1 . " and " . $nm_aspas . $campo2 . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum between " . $nm_aspas . $campo . $nm_aspas1 . " and " . $nm_aspas . $campo2 . $nm_aspas1;
               $this->comando_filtro .= " $nome between " . $nm_aspas . $campo . $nm_aspas1 . " and " . $nm_aspas . $campo2 . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_betw'] . " " . $this->cmp_formatado[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " " . $this->cmp_formatado[$nome_campo . "_input_2"] . "##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_betw'] . " " . $this->cmp_formatado[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " " . $this->cmp_formatado[$nome_campo . "_input_2"];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_betw'] . " " . $this->cmp_formatado[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " " . $this->cmp_formatado[$nome_campo . "_input_2"];
            break;
            case "IN":     // 
               $nm_sc_valores = explode(",", $campo);
               $cond_str  = "";
               $nm_cond   = "";
               $cond_descr  = "";
               $count_descr = 0;
               $end_descr   = false;
               $lim_descr   = 15;
               $lang_descr  = strlen($this->Ini->Nm_lang['lang_srch_orr_cond']);
               if (!empty($nm_sc_valores))
               {
                   foreach ($nm_sc_valores as $nm_sc_valor)
                   {
                      if (in_array($campo_join, $Nm_numeric) && substr_count($nm_sc_valor, ".") > 1)
                      {
                         $nm_sc_valor = str_replace(".", "", $nm_sc_valor);
                      }
                      if ("" != $cond_str)
                      {
                         $cond_str .= ",";
                         $nm_cond  .= " " . $this->Ini->Nm_lang['lang_srch_orr_cond'] . " ";
                      }
                      $cond_str .= $nm_ini_lower . $nm_aspas . $nm_sc_valor . $nm_aspas1 . $nm_fim_lower;
                      $nm_cond  .= $nm_aspas . $nm_sc_valor . $nm_aspas1;
                      if (((strlen($cond_descr) + strlen($nm_sc_valor) + $lang_descr) < $lim_descr) || empty($cond_descr))
                      {
                          $cond_descr .= (empty($cond_descr)) ? "" : " " . $this->Ini->Nm_lang['lang_srch_orr_cond'] . " ";
                          $cond_descr .= $nm_aspas . $nm_sc_valor . $nm_aspas1;
                          $count_descr++;
                      }
                      elseif (!$end_descr)
                      {
                          $cond_descr .= " +" . (count($nm_sc_valores) - $count_descr);
                          $end_descr = true;
                      };
                   }
               }
               $this->comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " in (" . $cond_str . ")";
               $this->comando_sum    .= $nm_ini_lower . $nome_sum . $nm_fim_lower . " in (" . $cond_str . ")";
               $this->comando_filtro .= $nm_ini_lower . $nome . $nm_fim_lower . " in (" . $cond_str . ")";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_like'] . " " . $nm_cond . "##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_like'] . " " . $cond_descr;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_like'] . " " . $nm_cond;
            break;
            case "NU":     // 
               $this->comando        .= " $nome IS NULL ";
               $this->comando_sum    .= " $nome_sum IS NULL ";
               $this->comando_filtro .= " $nome IS NULL ";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_null'] . "##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_null'];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_null'];
            break;
            case "NN":     // 
               $this->comando        .= " $nome IS NOT NULL ";
               $this->comando_sum    .= " $nome_sum IS NOT NULL ";
               $this->comando_filtro .= " $nome IS NOT NULL ";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_nnul'] . "##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_nnul'];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_nnul'];
            break;
            case "EP":     // 
               $this->comando        .= " $nome = '' ";
               $this->comando_sum    .= " $nome_sum = '' ";
               $this->comando_filtro .= " $nome = '' ";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_empty'] . "##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_empty'];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_empty'];
            break;
            case "NE":     // 
               $this->comando        .= " $nome <> '' ";
               $this->comando_sum    .= " $nome_sum <> '' ";
               $this->comando_filtro .= " $nome <> '' ";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_nempty'] . "##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_nempty'];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_nempty'];
            break;
         }
      }
   }

   function nm_prep_date(&$val, $tp, $tsql, &$cond, $format_nd, $tp_nd)
   {
       $fill_dt = false;
       if ($tsql == "TIMESTAMP")
       {
           $tsql = "DATETIME";
       }
       $cond = strtoupper($cond);
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access) && $tp != "ND")
       {
           if ($cond == "EP")
           {
               $cond = "NU";
           }
           if ($cond == "NE")
           {
               $cond = "NN";
           }
       }
       if ($cond == "NU" || $cond == "NN" || $cond == "EP" || $cond == "NE")
       {
           $val    = array();
           $val[0] = "";
           return;
       }
       if ($cond != "II" && $cond != "QP" && $cond != "NP")
       {
           $fill_dt = true;
       }
       if ($fill_dt)
       {
           $val[0]['dia'] = (!empty($val[0]['dia']) && strlen($val[0]['dia']) == 1) ? "0" . $val[0]['dia'] : $val[0]['dia'];
           $val[0]['mes'] = (!empty($val[0]['mes']) && strlen($val[0]['mes']) == 1) ? "0" . $val[0]['mes'] : $val[0]['mes'];
           if ($tp == "DH")
           {
               $val[0]['hor'] = (!empty($val[0]['hor']) && strlen($val[0]['hor']) == 1) ? "0" . $val[0]['hor'] : $val[0]['hor'];
               $val[0]['min'] = (!empty($val[0]['min']) && strlen($val[0]['min']) == 1) ? "0" . $val[0]['min'] : $val[0]['min'];
               $val[0]['seg'] = (!empty($val[0]['seg']) && strlen($val[0]['seg']) == 1) ? "0" . $val[0]['seg'] : $val[0]['seg'];
           }
           if ($cond == "BW")
           {
               $val[1]['dia'] = (!empty($val[1]['dia']) && strlen($val[1]['dia']) == 1) ? "0" . $val[1]['dia'] : $val[1]['dia'];
               $val[1]['mes'] = (!empty($val[1]['mes']) && strlen($val[1]['mes']) == 1) ? "0" . $val[1]['mes'] : $val[1]['mes'];
               if ($tp == "DH")
               {
                   $val[1]['hor'] = (!empty($val[1]['hor']) && strlen($val[1]['hor']) == 1) ? "0" . $val[1]['hor'] : $val[1]['hor'];
                   $val[1]['min'] = (!empty($val[1]['min']) && strlen($val[1]['min']) == 1) ? "0" . $val[1]['min'] : $val[1]['min'];
                   $val[1]['seg'] = (!empty($val[1]['seg']) && strlen($val[1]['seg']) == 1) ? "0" . $val[1]['seg'] : $val[1]['seg'];
               }
           }
       }
       if ($cond == "BW")
       {
           $this->NM_data_1 = array();
           $this->NM_data_1['ano'] = (isset($val[0]['ano']) && !empty($val[0]['ano'])) ? $val[0]['ano'] : "____";
           $this->NM_data_1['mes'] = (isset($val[0]['mes']) && !empty($val[0]['mes'])) ? $val[0]['mes'] : "__";
           $this->NM_data_1['dia'] = (isset($val[0]['dia']) && !empty($val[0]['dia'])) ? $val[0]['dia'] : "__";
           $this->NM_data_1['hor'] = (isset($val[0]['hor']) && !empty($val[0]['hor'])) ? $val[0]['hor'] : "__";
           $this->NM_data_1['min'] = (isset($val[0]['min']) && !empty($val[0]['min'])) ? $val[0]['min'] : "__";
           $this->NM_data_1['seg'] = (isset($val[0]['seg']) && !empty($val[0]['seg'])) ? $val[0]['seg'] : "__";
           $this->data_menor($this->NM_data_1);
           $this->NM_data_2 = array();
           $this->NM_data_2['ano'] = (isset($val[1]['ano']) && !empty($val[1]['ano'])) ? $val[1]['ano'] : "____";
           $this->NM_data_2['mes'] = (isset($val[1]['mes']) && !empty($val[1]['mes'])) ? $val[1]['mes'] : "__";
           $this->NM_data_2['dia'] = (isset($val[1]['dia']) && !empty($val[1]['dia'])) ? $val[1]['dia'] : "__";
           $this->NM_data_2['hor'] = (isset($val[1]['hor']) && !empty($val[1]['hor'])) ? $val[1]['hor'] : "__";
           $this->NM_data_2['min'] = (isset($val[1]['min']) && !empty($val[1]['min'])) ? $val[1]['min'] : "__";
           $this->NM_data_2['seg'] = (isset($val[1]['seg']) && !empty($val[1]['seg'])) ? $val[1]['seg'] : "__";
           $this->data_maior($this->NM_data_2);
           $val = array();
           if ($tp == "ND")
           {
               $out_dt1 = $format_nd;
               $out_dt1 = str_replace("yyyy", $this->NM_data_1['ano'], $out_dt1);
               $out_dt1 = str_replace("mm",   $this->NM_data_1['mes'], $out_dt1);
               $out_dt1 = str_replace("dd",   $this->NM_data_1['dia'], $out_dt1);
               $out_dt1 = str_replace("hh",   "", $out_dt1);
               $out_dt1 = str_replace("ii",   "", $out_dt1);
               $out_dt1 = str_replace("ss",   "", $out_dt1);
               $out_dt2 = $format_nd;
               $out_dt2 = str_replace("yyyy", $this->NM_data_2['ano'], $out_dt2);
               $out_dt2 = str_replace("mm",   $this->NM_data_2['mes'], $out_dt2);
               $out_dt2 = str_replace("dd",   $this->NM_data_2['dia'], $out_dt2);
               $out_dt2 = str_replace("hh",   "", $out_dt2);
               $out_dt2 = str_replace("ii",   "", $out_dt2);
               $out_dt2 = str_replace("ss",   "", $out_dt2);
               $val[0] = $out_dt1;
               $val[1] = $out_dt2;
               return;
           }
           if ($tsql == "TIME")
           {
               $val[0] = $this->NM_data_1['hor'] . ":" . $this->NM_data_1['min'] . ":" . $this->NM_data_1['seg'];
               $val[1] = $this->NM_data_2['hor'] . ":" . $this->NM_data_2['min'] . ":" . $this->NM_data_2['seg'];
           }
           elseif (substr($tsql, 0, 4) == "DATE")
           {
               $val[0] = $this->NM_data_1['ano'] . "-" . $this->NM_data_1['mes'] . "-" . $this->NM_data_1['dia'];
               $val[1] = $this->NM_data_2['ano'] . "-" . $this->NM_data_2['mes'] . "-" . $this->NM_data_2['dia'];
               if (strpos($tsql, "TIME") !== false)
               {
                   $val[0] .= " " . $this->NM_data_1['hor'] . ":" . $this->NM_data_1['min'] . ":" . $this->NM_data_1['seg'];
                   $val[1] .= " " . $this->NM_data_2['hor'] . ":" . $this->NM_data_2['min'] . ":" . $this->NM_data_2['seg'];
               }
           }
           return;
       }
       $this->NM_data_qp = array();
       $this->NM_data_qp['ano'] = (isset($val[0]['ano']) && $val[0]['ano'] != "") ? $val[0]['ano'] : "____";
       $this->NM_data_qp['mes'] = (isset($val[0]['mes']) && $val[0]['mes'] != "") ? $val[0]['mes'] : "__";
       $this->NM_data_qp['dia'] = (isset($val[0]['dia']) && $val[0]['dia'] != "") ? $val[0]['dia'] : "__";
       $this->NM_data_qp['hor'] = (isset($val[0]['hor']) && $val[0]['hor'] != "") ? $val[0]['hor'] : "__";
       $this->NM_data_qp['min'] = (isset($val[0]['min']) && $val[0]['min'] != "") ? $val[0]['min'] : "__";
       $this->NM_data_qp['seg'] = (isset($val[0]['seg']) && $val[0]['seg'] != "") ? $val[0]['seg'] : "__";
       if ($tp != "ND" && ($cond == "LE" || $cond == "LT" || $cond == "GE" || $cond == "GT"))
       {
           $count_fill = 0;
           foreach ($this->NM_data_qp as $x => $tx)
           {
               if (substr($tx, 0, 2) != "__")
               {
                   $count_fill++;
               }
           }
           if ($count_fill > 1)
           {
               if ($cond == "LE" || $cond == "GT")
               {
                   $this->data_maior($this->NM_data_qp);
               }
               else
               {
                   $this->data_menor($this->NM_data_qp);
               }
               if ($tsql == "TIME")
               {
                   $val[0] = $this->NM_data_qp['hor'] . ":" . $this->NM_data_qp['min'] . ":" . $this->NM_data_qp['seg'];
               }
               elseif (substr($tsql, 0, 4) == "DATE")
               {
                   $val[0] = $this->NM_data_qp['ano'] . "-" . $this->NM_data_qp['mes'] . "-" . $this->NM_data_qp['dia'];
                   if (strpos($tsql, "TIME") !== false)
                   {
                       $val[0] .= " " . $this->NM_data_qp['hor'] . ":" . $this->NM_data_qp['min'] . ":" . $this->NM_data_qp['seg'];
                   }
               }
               return;
           }
       }
       foreach ($this->NM_data_qp as $x => $tx)
       {
           if (substr($tx, 0, 2) == "__" && ($x == "dia" || $x == "mes" || $x == "ano"))
           {
               if (substr($tsql, 0, 4) == "DATE")
               {
                   $this->Date_part = true;
                   break;
               }
           }
           if (substr($tx, 0, 2) == "__" && ($x == "hor" || $x == "min" || $x == "seg"))
           {
               if (strpos($tsql, "TIME") !== false && ($tp == "DH" || ($tp == "DT" && $cond != "LE" && $cond != "LT" && $cond != "GE" && $cond != "GT")))
               {
                   $this->Date_part = true;
                   break;
               }
           }
       }
       if ($this->Date_part)
       {
           $this->Ini_date_part = "";
           $this->End_date_part = "";
           $this->Ini_date_char = "";
           $this->End_date_char = "";
           if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
           {
               $this->Ini_date_part = "'";
               $this->End_date_part = "'";
           }
           if ($tp != "ND")
           {
               if ($cond == "EQ")
               {
                   $this->Operador_date_part = " = ";
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_equl'];
               }
               elseif ($cond == "II")
               {
                   $this->Operador_date_part = " like ";
                   $this->Ini_date_part = "'";
                   $this->End_date_part = "%'";
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_strt'];
                   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                   {
                       $this->Ini_date_char = "CAST (";
                       $this->End_date_char = " AS TEXT)";
                   }
               }
               elseif ($cond == "DF")
               {
                   $this->Operador_date_part = " <> ";
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_diff'];
               }
               elseif ($cond == "GT")
               {
                   $this->Operador_date_part = " > ";
                   $this->Lang_date_part = $this->Ini->Nm_lang['pesq_cond_maior'];
               }
               elseif ($cond == "GE")
               {
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_grtr_equl'];
                   $this->Operador_date_part = " >= ";
               }
               elseif ($cond == "LT")
               {
                   $this->Operador_date_part = " < ";
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_less'];
               }
               elseif ($cond == "LE")
               {
                   $this->Operador_date_part = " <= ";
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_less_equl'];
               }
               elseif ($cond == "NP")
               {
                   $this->Operador_date_part = " not like ";
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_diff'];
                   $this->Ini_date_part = "'%";
                   $this->End_date_part = "%'";
                   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                   {
                       $this->Ini_date_char = "CAST (";
                       $this->End_date_char = " AS TEXT)";
                   }
               }
               else
               {
                   $this->Operador_date_part = " like ";
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_equl'];
                   $this->Ini_date_part = "'%";
                   $this->End_date_part = "%'";
                   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                   {
                       $this->Ini_date_char = "CAST (";
                       $this->End_date_char = " AS TEXT)";
                   }
               }
           }
           if ($cond == "DF")
           {
               $cond = "NP";
           }
           if ($cond != "NP")
           {
               $cond = "QP";
           }
       }
       $val = array();
       if ($tp != "ND" && ($cond == "QP" || $cond == "NP"))
       {
           $val[0] = "";
           if (substr($tsql, 0, 4) == "DATE")
           {
               $val[0] .= $this->NM_data_qp['ano'] . "-" . $this->NM_data_qp['mes'] . "-" . $this->NM_data_qp['dia'];
               if (strpos($tsql, "TIME") !== false)
               {
                   $val[0] .= " ";
               }
           }
           if (strpos($tsql, "TIME") !== false)
           {
               $val[0] .= $this->NM_data_qp['hor'] . ":" . $this->NM_data_qp['min'] . ":" . $this->NM_data_qp['seg'];
           }
           return;
       }
       if ($cond == "II" || $cond == "DF" || $cond == "EQ" || $cond == "LT" || $cond == "GE")
       {
           $this->data_menor($this->NM_data_qp);
       }
       else
       {
           $this->data_maior($this->NM_data_qp);
       }
       if ($tsql == "TIME")
       {
           $val[0] = $this->NM_data_qp['hor'] . ":" . $this->NM_data_qp['min'] . ":" . $this->NM_data_qp['seg'];
           return;
       }
       $format_sql = "";
       if (substr($tsql, 0, 4) == "DATE")
       {
           $format_sql .= $this->NM_data_qp['ano'] . "-" . $this->NM_data_qp['mes'] . "-" . $this->NM_data_qp['dia'];
           if (strpos($tsql, "TIME") !== false)
           {
               $format_sql .= " ";
           }
       }
       if (strpos($tsql, "TIME") !== false)
       {
           $format_sql .=  $this->NM_data_qp['hor'] . ":" . $this->NM_data_qp['min'] . ":" . $this->NM_data_qp['seg'];
       }
       if ($tp != "ND")
       {
           $val[0] = $format_sql;
           return;
       }
       if ($tp == "ND")
       {
           $format_nd = str_replace("yyyy", $this->NM_data_qp['ano'], $format_nd);
           $format_nd = str_replace("mm",   $this->NM_data_qp['mes'], $format_nd);
           $format_nd = str_replace("dd",   $this->NM_data_qp['dia'], $format_nd);
           $format_nd = str_replace("hh",   $this->NM_data_qp['hor'], $format_nd);
           $format_nd = str_replace("ii",   $this->NM_data_qp['min'], $format_nd);
           $format_nd = str_replace("ss",   $this->NM_data_qp['seg'], $format_nd);
           $val[0] = $format_nd;
           return;
       }
   }
   function data_menor(&$data_arr)
   {
       $data_arr["ano"] = ("____" == $data_arr["ano"]) ? "0001" : $data_arr["ano"];
       $data_arr["mes"] = ("__" == $data_arr["mes"])   ? "01" : $data_arr["mes"];
       $data_arr["dia"] = ("__" == $data_arr["dia"])   ? "01" : $data_arr["dia"];
       $data_arr["hor"] = ("__" == $data_arr["hor"])   ? "00" : $data_arr["hor"];
       $data_arr["min"] = ("__" == $data_arr["min"])   ? "00" : $data_arr["min"];
       $data_arr["seg"] = ("__" == $data_arr["seg"])   ? "00" : $data_arr["seg"];
   }

   function data_maior(&$data_arr)
   {
       $data_arr["ano"] = ("____" == $data_arr["ano"]) ? "9999" : $data_arr["ano"];
       $data_arr["mes"] = ("__" == $data_arr["mes"])   ? "12" : $data_arr["mes"];
       $data_arr["hor"] = ("__" == $data_arr["hor"])   ? "23" : $data_arr["hor"];
       $data_arr["min"] = ("__" == $data_arr["min"])   ? "59" : $data_arr["min"];
       $data_arr["seg"] = ("__" == $data_arr["seg"])   ? "59" : $data_arr["seg"];
       if ("__" == $data_arr["dia"])
       {
           $data_arr["dia"] = "31";
           if ($data_arr["mes"] == "04" || $data_arr["mes"] == "06" || $data_arr["mes"] == "09" || $data_arr["mes"] == "11")
           {
               $data_arr["dia"] = 30;
           }
           elseif ($data_arr["mes"] == "02")
           { 
                if  ($data_arr["ano"] % 4 == 0)
                {
                     $data_arr["dia"] = 29;
                }
                else 
                {
                     $data_arr["dia"] = 28;
                }
           }
       }
   }

   /**
    * @access  public
    * @param  string  $nm_data_hora  
    */
   function limpa_dt_hor_pesq(&$nm_data_hora)
   {
      $nm_data_hora = str_replace("Y", "", $nm_data_hora); 
      $nm_data_hora = str_replace("M", "", $nm_data_hora); 
      $nm_data_hora = str_replace("D", "", $nm_data_hora); 
      $nm_data_hora = str_replace("H", "", $nm_data_hora); 
      $nm_data_hora = str_replace("I", "", $nm_data_hora); 
      $nm_data_hora = str_replace("S", "", $nm_data_hora); 
      $tmp_pos = strpos($nm_data_hora, "--");
      if ($tmp_pos !== FALSE)
      {
          $nm_data_hora = str_replace("--", "-", $nm_data_hora); 
      }
      $tmp_pos = strpos($nm_data_hora, "::");
      if ($tmp_pos !== FALSE)
      {
          $nm_data_hora = str_replace("::", ":", $nm_data_hora); 
      }
   }

   /**
    * @access  public
    */
   function retorna_pesq()
   {
      global $nm_apl_dependente;
   $NM_retorno = "./";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML>
<HEAD>
 <TITLE> </TITLE>
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
</HEAD>
<BODY id="grid_search" class="scGridPage">
<FORM style="display:none;" name="form_ok" method="POST" action="<?php echo $NM_retorno; ?>" target="_self">
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="pesq"> 
</FORM>
<SCRIPT type="text/javascript">
 document.form_ok.submit();
</SCRIPT>
</BODY>
</HTML>
<?php
}

   /**
    * @access  public
    */
   function monta_html_ini()
   {
       header("X-XSS-Protection: 1; mode=block");
       header("X-Frame-Options: SAMEORIGIN");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE> </TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php
if ($_SESSION['scriptcase']['proc_mobile'])
{
?>
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
}
?>
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT" />
 <META http-equiv="Last-Modified" content="<?php echo gmdate('D, d M Y H:i:s') ?> GMT" />
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate" />
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0" />
 <META http-equiv="Pragma" content="no-cache" />
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
 <script type="text/javascript" src="../_lib/lib/js/jquery-3.6.0.min.js"></script>
 <script type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery/js/jquery-ui.js"></script>
 <script type="text/javascript" src="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/malsup-blockui/jquery.blockUI.js"></script>
 <script type="text/javascript" src="../_lib/lib/js/scInput.js"></script>
 <script type="text/javascript" src="../_lib/lib/js/jquery.scInput.js"></script>
 <script type="text/javascript" src="../_lib/lib/js/jquery.scInput2.js"></script>
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox.css" type="text/css" media="screen" />
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_filter ?>_error.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_filter ?>_error<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $this->Str_btn_filter_css ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_filter ?>_form.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_filter ?>_form<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery/css/smoothness/jquery-ui.css" type="text/css" media="screen" />
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_filter ?>_filter.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_filter ?>_filter<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
  <?php 
  if(isset($this->Ini->str_google_fonts) && !empty($this->Ini->str_google_fonts)) 
  { 
  ?> 
  <link href="<?php echo $this->Ini->str_google_fonts ?>" rel="stylesheet" /> 
  <?php 
  } 
  ?> 
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>grid_ado_records_admon/grid_ado_records_admon_fil_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />
</HEAD>
<?php
$vertical_center = '';
?>
<BODY id="grid_search" class="scFilterPage" style="<?php echo $vertical_center ?>">
<?php echo $this->Ini->Ajax_result_set ?>
<SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_js . "/browserSniffer.js" ?>"></SCRIPT>
   <script type="text/javascript">
     var applicationKeys = '';
     applicationKeys += 'ctrl+k';
     applicationKeys += ',';
     applicationKeys += 'ctrl+enter';
     applicationKeys += ',';
     applicationKeys += 'ctrl+e';
     applicationKeys += ',';
     applicationKeys += 'f1';
     applicationKeys += ',';
     applicationKeys += 'alt+q';
     var hotkeyList = '';
     function execHotKey(e, h) {
         var hotkey_fired = false
         switch (true) {
             case (['ctrl+k'].indexOf(h.key) > -1):
                 hotkey_fired = process_hotkeys('sys_format_lim');
                 break;
             case (['ctrl+enter'].indexOf(h.key) > -1):
                 hotkey_fired = process_hotkeys('sys_format_fi2');
                 break;
             case (['ctrl+e'].indexOf(h.key) > -1):
                 hotkey_fired = process_hotkeys('sys_format_edi');
                 break;
             case (['f1'].indexOf(h.key) > -1):
                 hotkey_fired = process_hotkeys('sys_format_webh');
                 break;
             case (['alt+q'].indexOf(h.key) > -1):
                 hotkey_fired = process_hotkeys('sys_format_sai');
                 break;
         }
         if (hotkey_fired) {
             e.preventDefault();
             return false;
         } else {
             return true;
         }
     }
   </script>
   <script type="text/javascript" src="../_lib/lib/js/hotkeys.inc.js"></script>
   <script type="text/javascript" src="../_lib/lib/js/hotkeys_setup.js"></script>
        <script type="text/javascript">
          var sc_pathToTB = '<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/';
          var sc_tbLangClose = "<?php echo html_entity_decode($this->Ini->Nm_lang['lang_tb_close'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) ?>";
          var sc_tbLangEsc = "<?php echo html_entity_decode($this->Ini->Nm_lang['lang_tb_esc'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) ?>";
        </script>
 <script type="text/javascript" src="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox-compressed.js"></script>
 <script type="text/javascript" src="grid_ado_records_admon_ajax_search.js"></script>
 <script type="text/javascript" src="grid_ado_records_admon_ajax.js"></script>
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
   var sc_ajaxBg = '<?php echo $this->Ini->Color_bg_ajax ?>';
   var sc_ajaxBordC = '<?php echo $this->Ini->Border_c_ajax ?>';
   var sc_ajaxBordS = '<?php echo $this->Ini->Border_s_ajax ?>';
   var sc_ajaxBordW = '<?php echo $this->Ini->Border_w_ajax ?>';
 </script>
<?php
$Cod_Btn = nmButtonOutput($this->arr_buttons, "berrm_clse", "nmAjaxHideDebug()", "nmAjaxHideDebug()", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<div id="id_debug_window" style="display: none;" class='scDebugWindow'><table class="scFormMessageTable">
<tr><td class="scFormMessageTitle"><?php echo $Cod_Btn ?>&nbsp;&nbsp;Output</td></tr>
<tr><td class="scFormMessageMessage" style="padding: 0px; vertical-align: top"><div style="padding: 2px; height: 200px; width: 350px; overflow: auto" id="id_debug_text"></div></td></tr>
</table></div>
<script type="text/javascript" src="grid_ado_records_admon_message.js"></script>
<script type="text/javascript" src="../_lib/lib/js/frameControl.js"></script>
<script type="text/javascript">
$(function() {
<?php
if (count($this->nm_mens_alert) || count($this->Ini->nm_mens_alert)) {
   if (isset($this->Ini->nm_mens_alert) && !empty($this->Ini->nm_mens_alert))
   {
       if (isset($this->nm_mens_alert) && !empty($this->nm_mens_alert))
       {
           $this->nm_mens_alert   = array_merge($this->Ini->nm_mens_alert, $this->nm_mens_alert);
           $this->nm_params_alert = array_merge($this->Ini->nm_params_alert, $this->nm_params_alert);
       }
       else
       {
           $this->nm_mens_alert   = $this->Ini->nm_mens_alert;
           $this->nm_params_alert = $this->Ini->nm_params_alert;
       }
   }
   if (isset($this->nm_mens_alert) && !empty($this->nm_mens_alert))
   {
       foreach ($this->nm_mens_alert as $i_alert => $mensagem)
       {
           $alertParams = array();
           if (isset($this->nm_params_alert[$i_alert]))
           {
               foreach ($this->nm_params_alert[$i_alert] as $paramName => $paramValue)
               {
                   if (in_array($paramName, array('title', 'timer', 'confirmButtonText', 'confirmButtonFA', 'confirmButtonFAPos', 'cancelButtonText', 'cancelButtonFA', 'cancelButtonFAPos', 'footer', 'width', 'padding')))
                   {
                       $alertParams[$paramName] = NM_charset_to_utf8($paramValue);
                   }
                   elseif (in_array($paramName, array('showConfirmButton', 'showCancelButton', 'toast')) && in_array($paramValue, array(true, false)))
                   {
                       $alertParams[$paramName] = NM_charset_to_utf8($paramValue);
                   }
                   elseif ('position' == $paramName && in_array($paramValue, array('top', 'top-start', 'top-end', 'center', 'center-start', 'center-end', 'bottom', 'bottom-start', 'bottom-end')))
                   {
                       $alertParams[$paramName] = NM_charset_to_utf8($paramValue);
                   }
                   elseif ('type' == $paramName && in_array($paramValue, array('warning', 'error', 'success', 'info', 'question')))
                   {
                       $alertParams[$paramName] = NM_charset_to_utf8($paramValue);
                   }
                   elseif ('background' == $paramName)
                   {
                       $image_param = $paramValue;
                       preg_match_all('/url\(([\s])?(["|\'])?(.*?)(["|\'])?([\s])?\)/i', $paramValue, $matches, PREG_PATTERN_ORDER);
                       if (isset($matches[3])) {
                           foreach ($matches[3] as $match) {
                               if ('http:' != substr($match, 0, 5) && 'https:' != substr($match, 0, 6) && '/' != substr($match, 0, 1)) {
                                   $image_param = str_replace($match, "{$this->Ini->path_img_global}/{$match}", $image_param);
                               }
                           }
                       }
                       $paramValue = $image_param;
                       $alertParams[$paramName] = NM_charset_to_utf8($paramValue);
                   }
               }
           }
           $jsonParams = json_encode($alertParams);
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['ajax_nav'])
           { 
               $this->Ini->Arr_result['AlertJS'][] = NM_charset_to_utf8($mensagem);
               $this->Ini->Arr_result['AlertJSParam'][] = $alertParams;
           } 
           else 
           { 
?>
       scJs_alert('<?php echo $mensagem ?>', <?php echo $jsonParams ?>);
<?php
           } 
       }
   }
}
?>
});
</script>
<?php
$displayError = ' style="display: none"';
if ('' != $this->Campos_Mens_erro) {
	$displayError = '';
}
?>
<div<?php echo $displayError; ?>>
	<table class="scErrorTable" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td class="scErrorTitle" align="left"><?php echo $this->Ini->Nm_lang['lang_errm_errt']; ?></td>
		</tr>
		<tr>
			<td class="scErrorMessage" align="center"><?php echo $this->Campos_Mens_erro; ?></td>
		</tr>
	</table>
</div>
 <SCRIPT type="text/javascript">

<?php
if (is_file($this->Ini->root . $this->Ini->path_link . "_lib/js/tab_erro_" . $this->Ini->str_lang . ".js"))
{
    $Tb_err_js = file($this->Ini->root . $this->Ini->path_link . "_lib/js/tab_erro_" . $this->Ini->str_lang . ".js");
    foreach ($Tb_err_js as $Lines)
    {
        if (NM_is_utf8($Lines) && $_SESSION['scriptcase']['charset'] != "UTF-8")
        {
            $Lines = sc_convert_encoding($Lines, $_SESSION['scriptcase']['charset'], "UTF-8");
        }
        echo $Lines;
    }
}
 $Msg_Inval = "Inv???lido";
 if (NM_is_utf8($Lines) && $_SESSION['scriptcase']['charset'] != "UTF-8")
 {
    $Msg_Inval = sc_convert_encoding($Msg_Inval, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
var SC_crit_inv = "<?php echo $Msg_Inval ?>";
var nmdg_Form = "F1";

 $(function() {

   SC_carga_evt_jquery();
   scLoadScInput('input:text.sc-js-input');
 });
 function nm_campos_between(nm_campo, nm_cond, nm_nome_obj)
 {
  if (nm_cond.value == "bw")
  {
   nm_campo.style.display = "";
  }
  else
  {
    if (nm_campo)
    {
      nm_campo.style.display = "none";
    }
  }
  if (document.getElementById('id_hide_' + nm_nome_obj))
  {
      if (nm_cond.value == "nu" || nm_cond.value == "nn" || nm_cond.value == "ep" || nm_cond.value == "ne")
      {
          document.getElementById('id_hide_' + nm_nome_obj).style.display = 'none';
      }
      else
      {
          document.getElementById('id_hide_' + nm_nome_obj).style.display = '';
      }
  }
 }
 function nm_save_form(pos)
 {
  if (pos == 'top' && document.F1.nmgp_save_name_top.value == '')
  {
      return;
  }
  if (pos == 'bot' && document.F1.nmgp_save_name_bot.value == '')
  {
      return;
  }
  if (pos == 'fields' && document.F1.nmgp_save_name_fields.value == '')
  {
      return;
  }
  var str_out = "";
  str_out += 'SC_startingdate_cond#NMF#' + search_get_sel_txt('SC_startingdate_cond') + '@NMF@';
  str_out += 'SC_startingdate_dia#NMF#' + search_get_sel_txt('SC_startingdate_dia') + '@NMF@';
  str_out += 'SC_startingdate_mes#NMF#' + search_get_sel_txt('SC_startingdate_mes') + '@NMF@';
  str_out += 'SC_startingdate_ano#NMF#' + search_get_sel_txt('SC_startingdate_ano') + '@NMF@';
  str_out += 'SC_startingdate_input_2_dia#NMF#' + search_get_sel_txt('SC_startingdate_input_2_dia') + '@NMF@';
  str_out += 'SC_startingdate_input_2_mes#NMF#' + search_get_sel_txt('SC_startingdate_input_2_mes') + '@NMF@';
  str_out += 'SC_startingdate_input_2_ano#NMF#' + search_get_sel_txt('SC_startingdate_input_2_ano') + '@NMF@';
  str_out += 'SC_startingdate_hor#NMF#' + search_get_sel_txt('SC_startingdate_hor') + '@NMF@';
  str_out += 'SC_startingdate_min#NMF#' + search_get_sel_txt('SC_startingdate_min') + '@NMF@';
  str_out += 'SC_startingdate_seg#NMF#' + search_get_sel_txt('SC_startingdate_seg') + '@NMF@';
  str_out += 'SC_startingdate_input_2_hor#NMF#' + search_get_sel_txt('SC_startingdate_input_2_hor') + '@NMF@';
  str_out += 'SC_startingdate_input_2_min#NMF#' + search_get_sel_txt('SC_startingdate_input_2_min') + '@NMF@';
  str_out += 'SC_startingdate_input_2_seg#NMF#' + search_get_sel_txt('SC_startingdate_input_2_seg') + '@NMF@';
  str_out += 'SC_creationdate_cond#NMF#' + search_get_sel_txt('SC_creationdate_cond') + '@NMF@';
  str_out += 'SC_creationdate_dia#NMF#' + search_get_sel_txt('SC_creationdate_dia') + '@NMF@';
  str_out += 'SC_creationdate_mes#NMF#' + search_get_sel_txt('SC_creationdate_mes') + '@NMF@';
  str_out += 'SC_creationdate_ano#NMF#' + search_get_sel_txt('SC_creationdate_ano') + '@NMF@';
  str_out += 'SC_creationdate_input_2_dia#NMF#' + search_get_sel_txt('SC_creationdate_input_2_dia') + '@NMF@';
  str_out += 'SC_creationdate_input_2_mes#NMF#' + search_get_sel_txt('SC_creationdate_input_2_mes') + '@NMF@';
  str_out += 'SC_creationdate_input_2_ano#NMF#' + search_get_sel_txt('SC_creationdate_input_2_ano') + '@NMF@';
  str_out += 'SC_creationdate_hor#NMF#' + search_get_sel_txt('SC_creationdate_hor') + '@NMF@';
  str_out += 'SC_creationdate_min#NMF#' + search_get_sel_txt('SC_creationdate_min') + '@NMF@';
  str_out += 'SC_creationdate_seg#NMF#' + search_get_sel_txt('SC_creationdate_seg') + '@NMF@';
  str_out += 'SC_creationdate_input_2_hor#NMF#' + search_get_sel_txt('SC_creationdate_input_2_hor') + '@NMF@';
  str_out += 'SC_creationdate_input_2_min#NMF#' + search_get_sel_txt('SC_creationdate_input_2_min') + '@NMF@';
  str_out += 'SC_creationdate_input_2_seg#NMF#' + search_get_sel_txt('SC_creationdate_input_2_seg') + '@NMF@';
  str_out += 'SC_creationip_cond#NMF#' + search_get_sel_txt('SC_creationip_cond') + '@NMF@';
  str_out += 'SC_creationip#NMF#' + search_get_text('SC_creationip') + '@NMF@';
  str_out += 'id_ac_creationip#NMF#' + search_get_text('id_ac_creationip') + '@NMF@';
  str_out += 'SC_firstname_cond#NMF#' + search_get_sel_txt('SC_firstname_cond') + '@NMF@';
  str_out += 'SC_firstname#NMF#' + search_get_text('SC_firstname') + '@NMF@';
  str_out += 'id_ac_firstname#NMF#' + search_get_text('id_ac_firstname') + '@NMF@';
  str_out += 'SC_firstsurname_cond#NMF#' + search_get_sel_txt('SC_firstsurname_cond') + '@NMF@';
  str_out += 'SC_firstsurname#NMF#' + search_get_text('SC_firstsurname') + '@NMF@';
  str_out += 'id_ac_firstsurname#NMF#' + search_get_text('id_ac_firstsurname') + '@NMF@';
  str_out += 'SC_gender_cond#NMF#' + search_get_sel_txt('SC_gender_cond') + '@NMF@';
  str_out += 'SC_gender#NMF#' + search_get_select('SC_gender') + '@NMF@';
  str_out += 'SC_transactiontypename_cond#NMF#' + search_get_sel_txt('SC_transactiontypename_cond') + '@NMF@';
  str_out += 'SC_transactiontypename#NMF#' + search_get_text('SC_transactiontypename') + '@NMF@';
  str_out += 'id_ac_transactiontypename#NMF#' + search_get_text('id_ac_transactiontypename') + '@NMF@';
  str_out += 'SC_issuedate_cond#NMF#' + search_get_sel_txt('SC_issuedate_cond') + '@NMF@';
  str_out += 'SC_issuedate_dia#NMF#' + search_get_sel_txt('SC_issuedate_dia') + '@NMF@';
  str_out += 'SC_issuedate_mes#NMF#' + search_get_sel_txt('SC_issuedate_mes') + '@NMF@';
  str_out += 'SC_issuedate_ano#NMF#' + search_get_sel_txt('SC_issuedate_ano') + '@NMF@';
  str_out += 'SC_issuedate_input_2_dia#NMF#' + search_get_sel_txt('SC_issuedate_input_2_dia') + '@NMF@';
  str_out += 'SC_issuedate_input_2_mes#NMF#' + search_get_sel_txt('SC_issuedate_input_2_mes') + '@NMF@';
  str_out += 'SC_issuedate_input_2_ano#NMF#' + search_get_sel_txt('SC_issuedate_input_2_ano') + '@NMF@';
  str_out += 'SC_issuedate_hor#NMF#' + search_get_sel_txt('SC_issuedate_hor') + '@NMF@';
  str_out += 'SC_issuedate_min#NMF#' + search_get_sel_txt('SC_issuedate_min') + '@NMF@';
  str_out += 'SC_issuedate_seg#NMF#' + search_get_sel_txt('SC_issuedate_seg') + '@NMF@';
  str_out += 'SC_issuedate_input_2_hor#NMF#' + search_get_sel_txt('SC_issuedate_input_2_hor') + '@NMF@';
  str_out += 'SC_issuedate_input_2_min#NMF#' + search_get_sel_txt('SC_issuedate_input_2_min') + '@NMF@';
  str_out += 'SC_issuedate_input_2_seg#NMF#' + search_get_sel_txt('SC_issuedate_input_2_seg') + '@NMF@';
  str_out += 'SC_extras_cond#NMF#' + search_get_sel_txt('SC_extras_cond') + '@NMF@';
  str_out += 'SC_extras#NMF#' + search_get_text('SC_extras') + '@NMF@';
  str_out += 'id_ac_extras#NMF#' + search_get_text('id_ac_extras') + '@NMF@';
  str_out += 'SC_NM_operador#NMF#' + search_get_text('SC_NM_operador');
  str_out  = str_out.replace(/[+]/g, "__NM_PLUS__");
  str_out  = str_out.replace(/[&]/g, "__NM_AMP__");
  str_out  = str_out.replace(/[%]/g, "__NM_PRC__");
  var save_name = search_get_text('SC_nmgp_save_name_' + pos);
  var save_opt  = search_get_sel_txt('SC_nmgp_save_option_' + pos);
  ajax_save_filter(save_name, save_opt, str_out, pos);
 }
 function nm_submit_filter(obj_sel, pos)
 {
  index = obj_sel.selectedIndex;
  if (index == -1 || obj_sel.options[index].value == "") 
  {
      return false;
  }
  ajax_select_filter(obj_sel.options[index].value);
 }
 function nm_submit_filter_del(pos)
 {
  obj_sel = document.F1.elements['NM_filters_del_' + pos];
  index   = obj_sel.selectedIndex;
  if (index == -1 || obj_sel.options[index].value == "") 
  {
      return false;
  }
  parm = obj_sel.options[index].value;
  ajax_delete_filter(parm);
 }
 function search_get_select(obj_id)
 {
    var index = document.getElementById(obj_id).selectedIndex;
    if (index != -1) {
        return document.getElementById(obj_id).options[index].value;
    }
    else {
        return '';
    }
 }
 function search_get_selmult(obj_id)
 {
    var obj = document.getElementById(obj_id);
    var val = "_NM_array_";
    for (iSelect = 0; iSelect < obj.length; iSelect++)
    {
        if (obj[iSelect].selected)
        {
            val += "#NMARR#" + obj[iSelect].value;
        }
    }
    return val;
 }
 function search_get_Dselelect(obj_id)
 {
    var obj = document.getElementById(obj_id);
    var val = "_NM_array_";
    for (iSelect = 0; iSelect < obj.length; iSelect++)
    {
         val += "#NMARR#" + obj[iSelect].value;
    }
    return val;
 }
 function search_get_radio(obj_id)
 {
    var val  = "";
    if (document.getElementById(obj_id)) {
       var Nobj = document.getElementById(obj_id).name;
       var obj  = document.getElementsByName(Nobj);
       for (iRadio = 0; iRadio < obj.length; iRadio++) {
           if (obj[iRadio].checked) {
               val = obj[iRadio].value;
           }
       }
    }
    return val;
 }
 function search_get_checkbox(obj_id)
 {
    var val  = "_NM_array_";
    if (document.getElementById(obj_id)) {
       var Nobj = document.getElementById(obj_id).name;
       var obj  = document.getElementsByName(Nobj);
       if (!obj.length) {
           if (obj.checked) {
               val += "#NMARR#" + obj.value;
           }
       }
       else {
           for (iCheck = 0; iCheck < obj.length; iCheck++) {
               if (obj[iCheck].checked) {
                   val += "#NMARR#" + obj[iCheck].value;
               }
           }
       }
    }
    return val;
 }
 function search_get_text(obj_id)
 {
    var obj = document.getElementById(obj_id);
    return (obj) ? obj.value : '';
 }
 function search_get_title(obj_id)
 {
    var obj = document.getElementById(obj_id);
    return (obj) ? obj.title : '';
 }
 function search_get_sel_txt(obj_id)
 {
    var val = "";
    obj_part  = document.getElementById(obj_id);
    if (obj_part && obj_part.type.substr(0, 6) == 'select')
    {
        val = search_get_select(obj_id);
    }
    else
    {
        val = (obj_part) ? obj_part.value : '';
    }
    return val;
 }
 function search_get_html(obj_id)
 {
    var obj = document.getElementById(obj_id);
    return obj.innerHTML;
 }
function nm_open_popup(parms)
{
    NovaJanela = window.open (parms, '', 'resizable, scrollbars');
}
 </SCRIPT>
<script type="text/javascript">
 $(function() {
   scClass = $("#id_ac_creationip").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_creationip").autocomplete({
     minLength: 1,
     classes: { 'ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_creationip",
          max_itens: "10",
          cod_desc: "N",
          script_case_init: <?php echo $this->Ini->sc_page ?>
        },
       success: function (data) {
         if (data == "ss_time_out") {
             nm_move();
         }
         response(data);
       }
      });
    },
     select: function (event, ui) {
       $("#SC_creationip").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
       $("#SC_creationip").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_creationip").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_firstname").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_firstname").autocomplete({
     minLength: 1,
     classes: { 'ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_firstname",
          max_itens: "10",
          cod_desc: "N",
          script_case_init: <?php echo $this->Ini->sc_page ?>
        },
       success: function (data) {
         if (data == "ss_time_out") {
             nm_move();
         }
         response(data);
       }
      });
    },
     select: function (event, ui) {
       $("#SC_firstname").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
       $("#SC_firstname").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_firstname").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_firstsurname").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_firstsurname").autocomplete({
     minLength: 1,
     classes: { 'ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_firstsurname",
          max_itens: "10",
          cod_desc: "N",
          script_case_init: <?php echo $this->Ini->sc_page ?>
        },
       success: function (data) {
         if (data == "ss_time_out") {
             nm_move();
         }
         response(data);
       }
      });
    },
     select: function (event, ui) {
       $("#SC_firstsurname").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
       $("#SC_firstsurname").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_firstsurname").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_transactiontypename").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_transactiontypename").autocomplete({
     minLength: 1,
     classes: { 'ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_transactiontypename",
          max_itens: "10",
          cod_desc: "N",
          script_case_init: <?php echo $this->Ini->sc_page ?>
        },
       success: function (data) {
         if (data == "ss_time_out") {
             nm_move();
         }
         response(data);
       }
      });
    },
     select: function (event, ui) {
       $("#SC_transactiontypename").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
       $("#SC_transactiontypename").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_transactiontypename").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_extras").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_extras").autocomplete({
     minLength: 1,
     classes: { 'ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_extras",
          max_itens: "10",
          cod_desc: "N",
          script_case_init: <?php echo $this->Ini->sc_page ?>
        },
       success: function (data) {
         if (data == "ss_time_out") {
             nm_move();
         }
         response(data);
       }
      });
    },
     select: function (event, ui) {
       $("#SC_extras").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
       $("#SC_extras").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_extras").val( $(this).val() );
       }
     }
   });
 });
</script>
 <FORM name="F1" action="./" method="post" target="_self"> 
 <INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
 <INPUT type="hidden" name="nmgp_opcao" value="busca"> 
 <div id="idJSSpecChar" style="display:none;"></div>
 <div id="id_div_process" style="display: none; position: absolute"><table class="scFilterTable"><tr><td class="scFilterLabelOdd"><?php echo $this->Ini->Nm_lang['lang_othr_prcs']; ?>...</td></tr></table></div>
 <div id="id_fatal_error" class="scFilterFieldOdd" style="display:none; position: absolute"></div>
<TABLE id="main_table" align="center" valign="top" >
<tr>
<td>
<div class="scFilterBorder">
  <div id="id_div_process_block" style="display: none; margin: 10px; whitespace: nowrap"><span class="scFormProcess"><img border="0" src="<?php echo $this->Ini->path_icones ?>/scriptcase__NM__ajax_load.gif" align="absmiddle" />&nbsp;<?php echo $this->Ini->Nm_lang['lang_othr_prcs'] ?>...</span></div>
<table cellspacing=0 cellpadding=0 width='100%'>
<?php
   }

   /**
    * @access  public
    * @global  string  $bprocessa  
    */
   /**
    * @access  public
    */
   function monta_cabecalho()
   {
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['dashboard_info']['compact_mode'])
      {
          return;
      }
      $Str_date = strtolower($_SESSION['scriptcase']['reg_conf']['date_format']);
      $Lim   = strlen($Str_date);
      $Ult   = "";
      $Arr_D = array();
      for ($I = 0; $I < $Lim; $I++)
      {
          $Char = substr($Str_date, $I, 1);
          if ($Char != $Ult)
          {
              $Arr_D[] = $Char;
          }
          $Ult = $Char;
      }
      $Prim = true;
      $Str  = "";
      foreach ($Arr_D as $Cada_d)
      {
          $Str .= (!$Prim) ? $_SESSION['scriptcase']['reg_conf']['date_sep'] : "";
          $Str .= $Cada_d;
          $Prim = false;
      }
      $Str = str_replace("a", "Y", $Str);
      $Str = str_replace("y", "Y", $Str);
      $nm_data_fixa = date($Str); 
?>
 <TR align="center">
  <TD class="scFilterTableTd scGridPage">
<style>
    .scMenuTHeaderFont img, .scGridHeaderFont img , .scFormHeaderFont img , .scTabHeaderFont img , .scContainerHeaderFont img , .scFilterHeaderFont img { height:23px;}
</style>
<div class="scFilterHeader" style="height: 54px; padding: 17px 15px; box-sizing: border-box;margin: -1px 0px 0px 0px;width: 100%;">
    <div class="scFilterHeaderFont" style="float: left; text-transform: uppercase;"><?php echo $this->Ini->Nm_lang['lang_othr_grid_title'] ?> <?php echo $this->Ini->Nm_lang['lang_tbl_ado_records'] ?></div>
    <div class="scFilterHeaderFont" style="float: right;"></div>
</div>  </TD>
 </TR>
<?php
   }

   /**
    * @access  public
    * @global  string  $nm_url_saida  $this->Ini->Nm_lang['pesq_global_nm_url_saida']
    * @global  integer  $nm_apl_dependente  $this->Ini->Nm_lang['pesq_global_nm_apl_dependente']
    * @global  string  $nmgp_parms  
    * @global  string  $bprocessa  $this->Ini->Nm_lang['pesq_global_bprocessa']
    */
   function monta_form()
   {
      global 
             $startingdate_cond, $startingdate, $startingdate_dia, $startingdate_mes, $startingdate_ano, $startingdate_hor, $startingdate_min, $startingdate_seg, $startingdate_input_2_dia, $startingdate_input_2_mes, $startingdate_input_2_ano, $startingdate_input_2_min, $startingdate_input_2_hor, $startingdate_input_2_seg,
             $creationdate_cond, $creationdate, $creationdate_dia, $creationdate_mes, $creationdate_ano, $creationdate_hor, $creationdate_min, $creationdate_seg, $creationdate_input_2_dia, $creationdate_input_2_mes, $creationdate_input_2_ano, $creationdate_input_2_min, $creationdate_input_2_hor, $creationdate_input_2_seg,
             $creationip_cond, $creationip, $creationip_autocomp,
             $firstname_cond, $firstname, $firstname_autocomp,
             $firstsurname_cond, $firstsurname, $firstsurname_autocomp,
             $gender_cond, $gender,
             $transactiontypename_cond, $transactiontypename, $transactiontypename_autocomp,
             $issuedate_cond, $issuedate, $issuedate_dia, $issuedate_mes, $issuedate_ano, $issuedate_hor, $issuedate_min, $issuedate_seg, $issuedate_input_2_dia, $issuedate_input_2_mes, $issuedate_input_2_ano, $issuedate_input_2_min, $issuedate_input_2_hor, $issuedate_input_2_seg,
             $extras_cond, $extras, $extras_autocomp,
             $nm_url_saida, $nm_apl_dependente, $nmgp_parms, $bprocessa, $nmgp_save_name, $NM_operador, $NM_filters, $nmgp_save_option, $NM_filters_del, $Script_BI;
      $Script_BI = "";
      $this->nmgp_botoes['clear'] = "on";
      $this->nmgp_botoes['save'] = "on";
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_ado_records_admon']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_ado_records_admon']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_ado_records_admon']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }
      $this->New_label['record'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_Record'] . "";
      $this->New_label['uid'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_Uid'] . "";
      $this->New_label['documenttype'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_DocumentType'] . "";
      $this->New_label['idnumber'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_IdNumber'] . "";
      $this->New_label['secondname'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_SecondName'] . "";
      $this->New_label['transactionid'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_TransactionId'] . "";
      $this->New_label['response_ani'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_Response_ANI'] . "";
      $this->New_label['secondsurname'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_SecondSurname'] . "";
      $this->New_label['birthdate'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_BirthDate'] . "";
      $this->New_label['street'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_Street'] . "";
      $this->New_label['cedulatecondition'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_CedulateCondition'] . "";
      $this->New_label['spouse'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_Spouse'] . "";
      $this->New_label['home'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_Home'] . "";
      $this->New_label['maritalstatus'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_MaritalStatus'] . "";
      $this->New_label['dateofidentification'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_DateOfIdentification'] . "";
      $this->New_label['dateofdeath'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_DateOfDeath'] . "";
      $this->New_label['marriagedate'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_MarriageDate'] . "";
      $this->New_label['instruction'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_Instruction'] . "";
      $this->New_label['placebirth'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_PlaceBirth'] . "";
      $this->New_label['nationality'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_Nationality'] . "";
      $this->New_label['mothername'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_MotherName'] . "";
      $this->New_label['fathername'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_FatherName'] . "";
      $this->New_label['housenumber'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_HouseNumber'] . "";
      $this->New_label['profession'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_Profession'] . "";
      $this->New_label['expeditioncity'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_ExpeditionCity'] . "";
      $this->New_label['expeditiondepartment'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_ExpeditionDepartment'] . "";
      $this->New_label['birthcity'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_BirthCity'] . "";
      $this->New_label['birthdepartment'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_BirthDepartment'] . "";
      $this->New_label['transactiontype'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_TransactionType'] . "";
      $this->New_label['barcodetext'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_BarcodeText'] . "";
      $this->New_label['ocrtextsideone'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_OcrTextSideOne'] . "";
      $this->New_label['ocrtextsidetwo'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_OcrTextSideTwo'] . "";
      $this->New_label['sideonewrongattempts'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_SideOneWrongAttempts'] . "";
      $this->New_label['sidetwowrongattempts'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_SideTwoWrongAttempts'] . "";
      $this->New_label['foundonadoalert'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_FoundOnAdoAlert'] . "";
      $this->New_label['adoprojectid'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_AdoProjectId'] . "";
      $this->New_label['productid'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_ProductId'] . "";
      $this->New_label['comparationfacessuccesful'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_ComparationFacesSuccesful'] . "";
      $this->New_label['facefound'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_FaceFound'] . "";
      $this->New_label['facedocumentfrontfound'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_FaceDocumentFrontFound'] . "";
      $this->New_label['barcodefound'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_BarcodeFound'] . "";
      $this->New_label['resultcomparationfaces'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_ResultComparationFaces'] . "";
      $this->New_label['comparationfacesaproved'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_ComparationFacesAproved'] . "";
      $this->New_label['numberphone'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_NumberPhone'] . "";
      $this->New_label['codfingerprint'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_CodFingerprint'] . "";
      $this->New_label['resultqrcode'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_ResultQRCode'] . "";
      $this->New_label['dactilarcode'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_DactilarCode'] . "";
      $this->New_label['reponsecontrollist'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_ReponseControlList'] . "";
      $this->New_label['images'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_Images'] . "";
      $this->New_label['signeddocuments'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_SignedDocuments'] . "";
      $this->New_label['scores'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_Scores'] . "";
      $this->New_label['parameters'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_Parameters'] . "";
      $this->New_label['statesignaturedocument'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_StateSignatureDocument'] . "";
      $this->New_label['verifyupdate'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_VerifyUpdate'] . "";
      $this->New_label['estadoreg'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_EstadoReg'] . "";
      $this->New_label['json_response'] = "" . $this->Ini->Nm_lang['lang_ado_records_fld_JSON_Response'] . "";
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("grid_ado_records_admon", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
      {
          $this->aba_iframe = true;
      }
      $nmgp_tab_label = "";
      $delimitador = "##@@";
      if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']) && $bprocessa != "recarga" && $bprocessa != "save_form" && $bprocessa != "filter_save" && $bprocessa != "filter_delete")
      {
      }
      if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']) && $bprocessa != "recarga" && $bprocessa != "save_form" && $bprocessa != "filter_save" && $bprocessa != "filter_delete")
      { 
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca'] = NM_conv_charset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca'], $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $startingdate_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['startingdate_dia']; 
          $startingdate_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['startingdate_mes']; 
          $startingdate_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['startingdate_ano']; 
          $startingdate_input_2_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['startingdate_input_2_dia']; 
          $startingdate_input_2_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['startingdate_input_2_mes']; 
          $startingdate_input_2_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['startingdate_input_2_ano']; 
          $startingdate_hor = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['startingdate_hor']; 
          $startingdate_min = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['startingdate_min']; 
          $startingdate_seg = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['startingdate_seg']; 
          $startingdate_input_2_hor = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['startingdate_input_2_hor']; 
          $startingdate_input_2_min = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['startingdate_input_2_min']; 
          $startingdate_input_2_seg = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['startingdate_input_2_seg']; 
          $startingdate_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['startingdate_cond']; 
          $creationdate_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['creationdate_dia']; 
          $creationdate_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['creationdate_mes']; 
          $creationdate_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['creationdate_ano']; 
          $creationdate_input_2_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['creationdate_input_2_dia']; 
          $creationdate_input_2_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['creationdate_input_2_mes']; 
          $creationdate_input_2_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['creationdate_input_2_ano']; 
          $creationdate_hor = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['creationdate_hor']; 
          $creationdate_min = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['creationdate_min']; 
          $creationdate_seg = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['creationdate_seg']; 
          $creationdate_input_2_hor = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['creationdate_input_2_hor']; 
          $creationdate_input_2_min = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['creationdate_input_2_min']; 
          $creationdate_input_2_seg = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['creationdate_input_2_seg']; 
          $creationdate_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['creationdate_cond']; 
          $creationip = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['creationip']; 
          $creationip_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['creationip_cond']; 
          $firstname = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['firstname']; 
          $firstname_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['firstname_cond']; 
          $firstsurname = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['firstsurname']; 
          $firstsurname_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['firstsurname_cond']; 
          $gender = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['gender']; 
          $gender_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['gender_cond']; 
          $transactiontypename = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['transactiontypename']; 
          $transactiontypename_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['transactiontypename_cond']; 
          $issuedate_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['issuedate_dia']; 
          $issuedate_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['issuedate_mes']; 
          $issuedate_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['issuedate_ano']; 
          $issuedate_input_2_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['issuedate_input_2_dia']; 
          $issuedate_input_2_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['issuedate_input_2_mes']; 
          $issuedate_input_2_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['issuedate_input_2_ano']; 
          $issuedate_hor = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['issuedate_hor']; 
          $issuedate_min = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['issuedate_min']; 
          $issuedate_seg = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['issuedate_seg']; 
          $issuedate_input_2_hor = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['issuedate_input_2_hor']; 
          $issuedate_input_2_min = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['issuedate_input_2_min']; 
          $issuedate_input_2_seg = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['issuedate_input_2_seg']; 
          $issuedate_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['issuedate_cond']; 
          $extras = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['extras']; 
          $extras_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['extras_cond']; 
          $this->NM_operador = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['NM_operador']; 
      } 
      if (!isset($startingdate_cond) || empty($startingdate_cond))
      {
         $startingdate_cond = "eq";
      }
      if (!isset($creationdate_cond) || empty($creationdate_cond))
      {
         $creationdate_cond = "eq";
      }
      if (!isset($creationip_cond) || empty($creationip_cond))
      {
         $creationip_cond = "eq";
      }
      if (!isset($firstname_cond) || empty($firstname_cond))
      {
         $firstname_cond = "qp";
      }
      if (!isset($firstsurname_cond) || empty($firstsurname_cond))
      {
         $firstsurname_cond = "qp";
      }
      if (!isset($gender_cond) || empty($gender_cond))
      {
         $gender_cond = "eq";
      }
      if (!isset($transactiontypename_cond) || empty($transactiontypename_cond))
      {
         $transactiontypename_cond = "eq";
      }
      if (!isset($issuedate_cond) || empty($issuedate_cond))
      {
         $issuedate_cond = "eq";
      }
      if (!isset($extras_cond) || empty($extras_cond))
      {
         $extras_cond = "qp";
      }
      $display_aberto  = "style=display:";
      $display_fechado = "style=display:none";
      $opc_hide_input = array("nu","nn","ep","ne");
      $str_hide_startingdate = (in_array($startingdate_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_creationdate = (in_array($creationdate_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_creationip = (in_array($creationip_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_firstname = (in_array($firstname_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_firstsurname = (in_array($firstsurname_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_gender = (in_array($gender_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_transactiontypename = (in_array($transactiontypename_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_issuedate = (in_array($issuedate_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_extras = (in_array($extras_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;

      $str_display_startingdate = ('bw' == $startingdate_cond) ? $display_aberto : $display_fechado;
      $str_display_creationdate = ('bw' == $creationdate_cond) ? $display_aberto : $display_fechado;
      $str_display_creationip = ('bw' == $creationip_cond) ? $display_aberto : $display_fechado;
      $str_display_firstname = ('bw' == $firstname_cond) ? $display_aberto : $display_fechado;
      $str_display_firstsurname = ('bw' == $firstsurname_cond) ? $display_aberto : $display_fechado;
      $str_display_gender = ('bw' == $gender_cond) ? $display_aberto : $display_fechado;
      $str_display_transactiontypename = ('bw' == $transactiontypename_cond) ? $display_aberto : $display_fechado;
      $str_display_issuedate = ('bw' == $issuedate_cond) ? $display_aberto : $display_fechado;
      $str_display_extras = ('bw' == $extras_cond) ? $display_aberto : $display_fechado;

      if (!isset($startingdate) || $startingdate == "")
      {
          $startingdate = "";
      }
      if (isset($startingdate) && !empty($startingdate))
      {
         $tmp_pos = strpos($startingdate, "##@@");
         if ($tmp_pos === false)
         { }
         else
         {
         $startingdate = substr($startingdate, 0, $tmp_pos);
         }
      }
      if (!isset($creationdate) || $creationdate == "")
      {
          $creationdate = "";
      }
      if (isset($creationdate) && !empty($creationdate))
      {
         $tmp_pos = strpos($creationdate, "##@@");
         if ($tmp_pos === false)
         { }
         else
         {
         $creationdate = substr($creationdate, 0, $tmp_pos);
         }
      }
      if (!isset($creationip) || $creationip == "")
      {
          $creationip = "";
      }
      if (isset($creationip) && !empty($creationip))
      {
         $tmp_pos = strpos($creationip, "##@@");
         if ($tmp_pos === false)
         { }
         else
         {
         $creationip = substr($creationip, 0, $tmp_pos);
         }
      }
      if (!isset($firstname) || $firstname == "")
      {
          $firstname = "";
      }
      if (isset($firstname) && !empty($firstname))
      {
         $tmp_pos = strpos($firstname, "##@@");
         if ($tmp_pos === false)
         { }
         else
         {
         $firstname = substr($firstname, 0, $tmp_pos);
         }
      }
      if (!isset($firstsurname) || $firstsurname == "")
      {
          $firstsurname = "";
      }
      if (isset($firstsurname) && !empty($firstsurname))
      {
         $tmp_pos = strpos($firstsurname, "##@@");
         if ($tmp_pos === false)
         { }
         else
         {
         $firstsurname = substr($firstsurname, 0, $tmp_pos);
         }
      }
      if (!isset($gender) || $gender == "")
      {
          $gender = "";
      }
      if (isset($gender) && !empty($gender))
      {
         $tmp_pos = strpos($gender, "##@@");
         if ($tmp_pos === false)
         { }
         else
         {
         $gender = substr($gender, 0, $tmp_pos);
         }
      }
      if (!isset($transactiontypename) || $transactiontypename == "")
      {
          $transactiontypename = "";
      }
      if (isset($transactiontypename) && !empty($transactiontypename))
      {
         $tmp_pos = strpos($transactiontypename, "##@@");
         if ($tmp_pos === false)
         { }
         else
         {
         $transactiontypename = substr($transactiontypename, 0, $tmp_pos);
         }
      }
      if (!isset($issuedate) || $issuedate == "")
      {
          $issuedate = "";
      }
      if (isset($issuedate) && !empty($issuedate))
      {
         $tmp_pos = strpos($issuedate, "##@@");
         if ($tmp_pos === false)
         { }
         else
         {
         $issuedate = substr($issuedate, 0, $tmp_pos);
         }
      }
      if (!isset($extras) || $extras == "")
      {
          $extras = "";
      }
      if (isset($extras) && !empty($extras))
      {
         $tmp_pos = strpos($extras, "##@@");
         if ($tmp_pos === false)
         { }
         else
         {
         $extras = substr($extras, 0, $tmp_pos);
         }
      }
?>
 <TR align="center">
  <TD class="scFilterTableTd">
   <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
   <TR valign="top" >
  <TD width="100%" height="">
   <TABLE class="scFilterTable" id="hidden_bloco_0" valign="top" width="100%" style="height: 100%;">
   <tr>



   
    <TD nowrap class="scFilterLabelOdd" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['startingdate'])) ? $this->New_label['startingdate'] : "" . $this->Ini->Nm_lang['lang_ado_records_fld_StartingDate'] . "";
 $nmgp_tab_label .= "startingdate?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectOdd" id="SC_startingdate_cond" name="startingdate_cond" onChange="nm_campos_between(document.getElementById('id_vis_startingdate'), this, 'startingdate')">
       <OPTION value="eq" <?php if ("eq" == $startingdate_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="gt" <?php if ("gt" == $startingdate_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $startingdate_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="bw" <?php if ("bw" == $startingdate_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_betw'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_startingdate"  <?php echo $str_hide_startingdate?>>
<?php
  $Form_base = "ddmmyyyyhhiiss";
  $date_format_show = "";
  $Str_date = str_replace("a", "y", strtolower($_SESSION['scriptcase']['reg_conf']['date_format']));
  $Lim   = strlen($Str_date);
  $Str   = "";
  $Ult   = "";
  $Arr_D = array();
  for ($I = 0; $I < $Lim; $I++)
  {
      $Char = substr($Str_date, $I, 1);
      if ($Char != $Ult && "" != $Str)
      {
          $Arr_D[] = $Str;
          $Str     = $Char;
      }
      else
      {
          $Str    .= $Char;
      }
      $Ult = $Char;
  }
  $Arr_D[] = $Str;
  $Prim = true;
  foreach ($Arr_D as $Cada_d)
  {
      if (strpos($Form_base, $Cada_d) !== false)
      {
          $date_format_show .= (!$Prim) ? $_SESSION['scriptcase']['reg_conf']['date_sep'] : "";
          $date_format_show .= $Cada_d;
          $Prim = false;
      }
  }
  $date_format_show .= " ";
  $Str_time = strtolower($_SESSION['scriptcase']['reg_conf']['time_format']);
  $Lim   = strlen($Str_time);
  $Str   = "";
  $Ult   = "";
  $Arr_T = array();
  for ($I = 0; $I < $Lim; $I++)
  {
      $Char = substr($Str_time, $I, 1);
      if ($Char != $Ult && "" != $Str)
      {
          $Arr_T[] = $Str;
          $Str     = $Char;
      }
      else
      {
          $Str    .= $Char;
      }
      $Ult = $Char;
  }
  $Arr_T[] = $Str;
  $Prim = true;
  foreach ($Arr_T as $Cada_t)
  {
      if (strpos($Form_base, $Cada_t) !== false)
      {
          $date_format_show .= (!$Prim) ? $_SESSION['scriptcase']['reg_conf']['time_sep'] : "";
          $date_format_show .= $Cada_t;
          $Prim = false;
      }
  }
  $Arr_format = array_merge($Arr_D, $Arr_T);
  $date_format_show = str_replace("dd",   $this->Ini->Nm_lang['lang_othr_date_days'], $date_format_show);
  $date_format_show = str_replace("mm",   $this->Ini->Nm_lang['lang_othr_date_mnth'], $date_format_show);
  $date_format_show = str_replace("yyyy", $this->Ini->Nm_lang['lang_othr_date_year'], $date_format_show);
  $date_format_show = str_replace("aaaa", $this->Ini->Nm_lang['lang_othr_date_year'], $date_format_show);
  $date_format_show = str_replace("hh",   $this->Ini->Nm_lang['lang_othr_date_hour'], $date_format_show);
  $date_format_show = str_replace("ii",   $this->Ini->Nm_lang['lang_othr_date_mint'], $date_format_show);
  $date_format_show = str_replace("ss",   $this->Ini->Nm_lang['lang_othr_date_scnd'], $date_format_show);
  $date_format_show = "" . $date_format_show .  "";

?>

         <?php

foreach ($Arr_format as $Part_date)
{
?>
<?php
  if (substr($Part_date, 0,1) == "d")
  {
?>
<span id='id_date_part_startingdate_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_startingdate_dia" name="startingdate_dia" value="<?php echo NM_encode_input($startingdate_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "m")
  {
?>
<span id='id_date_part_startingdate_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_startingdate_mes" name="startingdate_mes" value="<?php echo NM_encode_input($startingdate_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "y")
  {
?>
<span id='id_date_part_startingdate_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_startingdate_ano" name="startingdate_ano" value="<?php echo NM_encode_input($startingdate_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
 </span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "h")
  {
?>
<span id='id_date_part_startingdate_HH' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_startingdate_hor" name="startingdate_hor" value="<?php echo NM_encode_input($startingdate_hor); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "i")
  {
?>
<span id='id_date_part_startingdate_II' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_startingdate_min" name="startingdate_min" value="<?php echo NM_encode_input($startingdate_min); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "s")
  {
?>
<span id='id_date_part_startingdate_SS' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_startingdate_seg" name="startingdate_seg" value="<?php echo NM_encode_input($startingdate_seg); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
</span>

<?php
  }
?>

<?php

}

?>
        <SPAN id="id_css_startingdate"  class="scFilterFieldFontOdd">
 <br><?php echo $date_format_show ?>         </SPAN>
                  <br />
        <SPAN id="id_vis_startingdate"  <?php echo $str_display_startingdate; ?> class="scFilterFieldFontOdd">
         <?php echo $date_sep_bw ?> 
         <BR>
         
         <?php

foreach ($Arr_format as $Part_date)
{
?>
<?php
  if (substr($Part_date, 0,1) == "d")
  {
?>
<span id='id_date_part_startingdate_input_2_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_startingdate_input_2_dia" name="startingdate_input_2_dia" value="<?php echo NM_encode_input($startingdate_input_2_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "m")
  {
?>
<span id='id_date_part_startingdate_input_2_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_startingdate_input_2_mes" name="startingdate_input_2_mes" value="<?php echo NM_encode_input($startingdate_input_2_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "y")
  {
?>
<span id='id_date_part_startingdate_input_2_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_startingdate_input_2_ano" name="startingdate_input_2_ano" value="<?php echo NM_encode_input($startingdate_input_2_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
 </span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "h")
  {
?>
<span id='id_date_part_startingdate_input_2_HH' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_startingdate_input_2_hor" name="startingdate_input_2_hor" value="<?php echo NM_encode_input($startingdate_input_2_hor); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "i")
  {
?>
<span id='id_date_part_startingdate_input_2_II' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_startingdate_input_2_min" name="startingdate_input_2_min" value="<?php echo NM_encode_input($startingdate_input_2_min); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "s")
  {
?>
<span id='id_date_part_startingdate_input_2_SS' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_startingdate_input_2_seg" name="startingdate_input_2_seg" value="<?php echo NM_encode_input($startingdate_input_2_seg); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
</span>

<?php
  }
?>

<?php

}

?>
         </SPAN>
          </TD>
   



   </tr><tr>



   
    <TD nowrap class="scFilterLabelEven" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['creationdate'])) ? $this->New_label['creationdate'] : "" . $this->Ini->Nm_lang['lang_ado_records_fld_CreationDate'] . "";
 $nmgp_tab_label .= "creationdate?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectEven" id="SC_creationdate_cond" name="creationdate_cond" onChange="nm_campos_between(document.getElementById('id_vis_creationdate'), this, 'creationdate')">
       <OPTION value="eq" <?php if ("eq" == $creationdate_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="gt" <?php if ("gt" == $creationdate_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $creationdate_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="bw" <?php if ("bw" == $creationdate_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_betw'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_creationdate"  <?php echo $str_hide_creationdate?>>
<?php
  $Form_base = "ddmmyyyyhhiiss";
  $date_format_show = "";
  $Str_date = str_replace("a", "y", strtolower($_SESSION['scriptcase']['reg_conf']['date_format']));
  $Lim   = strlen($Str_date);
  $Str   = "";
  $Ult   = "";
  $Arr_D = array();
  for ($I = 0; $I < $Lim; $I++)
  {
      $Char = substr($Str_date, $I, 1);
      if ($Char != $Ult && "" != $Str)
      {
          $Arr_D[] = $Str;
          $Str     = $Char;
      }
      else
      {
          $Str    .= $Char;
      }
      $Ult = $Char;
  }
  $Arr_D[] = $Str;
  $Prim = true;
  foreach ($Arr_D as $Cada_d)
  {
      if (strpos($Form_base, $Cada_d) !== false)
      {
          $date_format_show .= (!$Prim) ? $_SESSION['scriptcase']['reg_conf']['date_sep'] : "";
          $date_format_show .= $Cada_d;
          $Prim = false;
      }
  }
  $date_format_show .= " ";
  $Str_time = strtolower($_SESSION['scriptcase']['reg_conf']['time_format']);
  $Lim   = strlen($Str_time);
  $Str   = "";
  $Ult   = "";
  $Arr_T = array();
  for ($I = 0; $I < $Lim; $I++)
  {
      $Char = substr($Str_time, $I, 1);
      if ($Char != $Ult && "" != $Str)
      {
          $Arr_T[] = $Str;
          $Str     = $Char;
      }
      else
      {
          $Str    .= $Char;
      }
      $Ult = $Char;
  }
  $Arr_T[] = $Str;
  $Prim = true;
  foreach ($Arr_T as $Cada_t)
  {
      if (strpos($Form_base, $Cada_t) !== false)
      {
          $date_format_show .= (!$Prim) ? $_SESSION['scriptcase']['reg_conf']['time_sep'] : "";
          $date_format_show .= $Cada_t;
          $Prim = false;
      }
  }
  $Arr_format = array_merge($Arr_D, $Arr_T);
  $date_format_show = str_replace("dd",   $this->Ini->Nm_lang['lang_othr_date_days'], $date_format_show);
  $date_format_show = str_replace("mm",   $this->Ini->Nm_lang['lang_othr_date_mnth'], $date_format_show);
  $date_format_show = str_replace("yyyy", $this->Ini->Nm_lang['lang_othr_date_year'], $date_format_show);
  $date_format_show = str_replace("aaaa", $this->Ini->Nm_lang['lang_othr_date_year'], $date_format_show);
  $date_format_show = str_replace("hh",   $this->Ini->Nm_lang['lang_othr_date_hour'], $date_format_show);
  $date_format_show = str_replace("ii",   $this->Ini->Nm_lang['lang_othr_date_mint'], $date_format_show);
  $date_format_show = str_replace("ss",   $this->Ini->Nm_lang['lang_othr_date_scnd'], $date_format_show);
  $date_format_show = "" . $date_format_show .  "";

?>

         <?php

foreach ($Arr_format as $Part_date)
{
?>
<?php
  if (substr($Part_date, 0,1) == "d")
  {
?>
<span id='id_date_part_creationdate_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_creationdate_dia" name="creationdate_dia" value="<?php echo NM_encode_input($creationdate_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "m")
  {
?>
<span id='id_date_part_creationdate_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_creationdate_mes" name="creationdate_mes" value="<?php echo NM_encode_input($creationdate_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "y")
  {
?>
<span id='id_date_part_creationdate_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_creationdate_ano" name="creationdate_ano" value="<?php echo NM_encode_input($creationdate_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
 </span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "h")
  {
?>
<span id='id_date_part_creationdate_HH' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_creationdate_hor" name="creationdate_hor" value="<?php echo NM_encode_input($creationdate_hor); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "i")
  {
?>
<span id='id_date_part_creationdate_II' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_creationdate_min" name="creationdate_min" value="<?php echo NM_encode_input($creationdate_min); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "s")
  {
?>
<span id='id_date_part_creationdate_SS' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_creationdate_seg" name="creationdate_seg" value="<?php echo NM_encode_input($creationdate_seg); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
</span>

<?php
  }
?>

<?php

}

?>
        <SPAN id="id_css_creationdate"  class="scFilterFieldFontEven">
 <br><?php echo $date_format_show ?>         </SPAN>
                  <br />
        <SPAN id="id_vis_creationdate"  <?php echo $str_display_creationdate; ?> class="scFilterFieldFontEven">
         <?php echo $date_sep_bw ?> 
         <BR>
         
         <?php

foreach ($Arr_format as $Part_date)
{
?>
<?php
  if (substr($Part_date, 0,1) == "d")
  {
?>
<span id='id_date_part_creationdate_input_2_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_creationdate_input_2_dia" name="creationdate_input_2_dia" value="<?php echo NM_encode_input($creationdate_input_2_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "m")
  {
?>
<span id='id_date_part_creationdate_input_2_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_creationdate_input_2_mes" name="creationdate_input_2_mes" value="<?php echo NM_encode_input($creationdate_input_2_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "y")
  {
?>
<span id='id_date_part_creationdate_input_2_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_creationdate_input_2_ano" name="creationdate_input_2_ano" value="<?php echo NM_encode_input($creationdate_input_2_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
 </span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "h")
  {
?>
<span id='id_date_part_creationdate_input_2_HH' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_creationdate_input_2_hor" name="creationdate_input_2_hor" value="<?php echo NM_encode_input($creationdate_input_2_hor); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "i")
  {
?>
<span id='id_date_part_creationdate_input_2_II' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_creationdate_input_2_min" name="creationdate_input_2_min" value="<?php echo NM_encode_input($creationdate_input_2_min); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "s")
  {
?>
<span id='id_date_part_creationdate_input_2_SS' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_creationdate_input_2_seg" name="creationdate_input_2_seg" value="<?php echo NM_encode_input($creationdate_input_2_seg); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
</span>

<?php
  }
?>

<?php

}

?>
         </SPAN>
          </TD>
   



   </tr><tr>



   
      <INPUT type="hidden" id="SC_creationip_cond" name="creationip_cond" value="eq">

    <TD nowrap class="scFilterLabelOdd" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['creationip'])) ? $this->New_label['creationip'] : "" . $this->Ini->Nm_lang['lang_ado_records_fld_CreationIP'] . "";
 $nmgp_tab_label .= "creationip?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span><br><span id="id_hide_creationip"  <?php echo $str_hide_creationip?>><?php
      if ($creationip != "")
      {
      $creationip_look = substr($this->Db->qstr($creationip), 1, -1); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct CreationIP from " . $this->Ini->nm_tabela . " where EstadoReg='A' and CreationIP = '$creationip_look' order by CreationIP"; 
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = trim($rs->fields[0]);
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 
      }
      if (isset($nmgp_def_dados[0][$creationip]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$creationip];
      }
      else
      {
          $sAutocompValue = $creationip;
      }
?>
<INPUT  type="text" id="SC_creationip" name="creationip" value="<?php echo NM_encode_input($creationip) ?>"  size=15 alt="{datatype: 'text', maxLength: 15, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_creationip" name="creationip_autocomp" size="15"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 15, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">

 </TD>
   



   </tr><tr>



   
    <TD nowrap class="scFilterLabelEven" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['firstname'])) ? $this->New_label['firstname'] : "" . $this->Ini->Nm_lang['lang_ado_records_fld_FirstName'] . "";
 $nmgp_tab_label .= "firstname?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectEven" id="SC_firstname_cond" name="firstname_cond" onChange="nm_campos_between(document.getElementById('id_vis_firstname'), this, 'firstname')">
       <OPTION value="qp" <?php if ("qp" == $firstname_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $firstname_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_firstname"  <?php echo $str_hide_firstname?>><?php
      if ($firstname != "")
      {
      $firstname_look = substr($this->Db->qstr($firstname), 1, -1); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct FirstName from " . $this->Ini->nm_tabela . " where EstadoReg='A' and FirstName = '$firstname_look' order by FirstName"; 
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = trim($rs->fields[0]);
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 
      }
      if (isset($nmgp_def_dados[0][$firstname]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$firstname];
      }
      else
      {
          $sAutocompValue = $firstname;
      }
?>
<INPUT  type="text" id="SC_firstname" name="firstname" value="<?php echo NM_encode_input($firstname) ?>"  size=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectEven" type="text" id="id_ac_firstname" name="firstname_autocomp" size="30"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 30, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">

 </TD>
   



   </tr><tr>



   
    <TD nowrap class="scFilterLabelOdd" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['firstsurname'])) ? $this->New_label['firstsurname'] : "" . $this->Ini->Nm_lang['lang_ado_records_fld_FirstSurname'] . "";
 $nmgp_tab_label .= "firstsurname?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectOdd" id="SC_firstsurname_cond" name="firstsurname_cond" onChange="nm_campos_between(document.getElementById('id_vis_firstsurname'), this, 'firstsurname')">
       <OPTION value="qp" <?php if ("qp" == $firstsurname_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $firstsurname_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_firstsurname"  <?php echo $str_hide_firstsurname?>><?php
      if ($firstsurname != "")
      {
      $firstsurname_look = substr($this->Db->qstr($firstsurname), 1, -1); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct FirstSurname from " . $this->Ini->nm_tabela . " where EstadoReg='A' and FirstSurname = '$firstsurname_look' order by FirstSurname"; 
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = trim($rs->fields[0]);
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 
      }
      if (isset($nmgp_def_dados[0][$firstsurname]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$firstsurname];
      }
      else
      {
          $sAutocompValue = $firstsurname;
      }
?>
<INPUT  type="text" id="SC_firstsurname" name="firstsurname" value="<?php echo NM_encode_input($firstsurname) ?>"  size=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_firstsurname" name="firstsurname_autocomp" size="30"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 30, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">

 </TD>
   



   </tr><tr>



   
      <INPUT type="hidden" id="SC_gender_cond" name="gender_cond" value="eq">

    <TD nowrap class="scFilterLabelEven" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['gender'])) ? $this->New_label['gender'] : "" . $this->Ini->Nm_lang['lang_ado_records_fld_Gender'] . "";
 $nmgp_tab_label .= "gender?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span><br><span id="id_hide_gender"  <?php echo $str_hide_gender?>> 
<?php
  $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['psq_check_ret']['gender'] = array();
  $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['psq_check_ret']['gender'][] = "M";
  $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['psq_check_ret']['gender'][] = "F";
 ?>

 <SELECT class="scFilterObjectEven" id="SC_gender"  name="gender"  size="1">
 <OPTION value="M##@@<?php echo $this->Ini->Nm_lang['lang_masculino'] ?>"<?php if ($gender == "M") { echo " selected" ;} ?>><?php echo $this->Ini->Nm_lang['lang_masculino'] ?></option>
 <OPTION value="F##@@<?php echo $this->Ini->Nm_lang['lang_femenino'] ?>"<?php if ($gender == "F") { echo " selected" ;} ?>><?php echo $this->Ini->Nm_lang['lang_femenino'] ?></option>
 </SELECT>
 </TD>
   



   </tr><tr>



   
      <INPUT type="hidden" id="SC_transactiontypename_cond" name="transactiontypename_cond" value="eq">

    <TD nowrap class="scFilterLabelOdd" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['transactiontypename'])) ? $this->New_label['transactiontypename'] : "" . $this->Ini->Nm_lang['lang_ado_records_fld_TransactionTypeName'] . "";
 $nmgp_tab_label .= "transactiontypename?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span><br><span id="id_hide_transactiontypename"  <?php echo $str_hide_transactiontypename?>><?php
      if ($transactiontypename != "")
      {
      $transactiontypename_look = substr($this->Db->qstr($transactiontypename), 1, -1); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct TransactionTypeName from " . $this->Ini->nm_tabela . " where EstadoReg='A' and TransactionTypeName = '$transactiontypename_look' order by TransactionTypeName"; 
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = trim($rs->fields[0]);
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 
      }
      if (isset($nmgp_def_dados[0][$transactiontypename]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$transactiontypename];
      }
      else
      {
          $sAutocompValue = $transactiontypename;
      }
?>
<INPUT  type="text" id="SC_transactiontypename" name="transactiontypename" value="<?php echo NM_encode_input($transactiontypename) ?>"  size=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_transactiontypename" name="transactiontypename_autocomp" size="30"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 30, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">

 </TD>
   



   </tr><tr>



   
    <TD nowrap class="scFilterLabelEven" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['issuedate'])) ? $this->New_label['issuedate'] : "" . $this->Ini->Nm_lang['lang_ado_records_fld_IssueDate'] . "";
 $nmgp_tab_label .= "issuedate?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectEven" id="SC_issuedate_cond" name="issuedate_cond" onChange="nm_campos_between(document.getElementById('id_vis_issuedate'), this, 'issuedate')">
       <OPTION value="eq" <?php if ("eq" == $issuedate_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="gt" <?php if ("gt" == $issuedate_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $issuedate_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="bw" <?php if ("bw" == $issuedate_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_betw'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_issuedate"  <?php echo $str_hide_issuedate?>>
<?php
  $Form_base = "ddmmyyyyhhiiss";
  $date_format_show = "";
  $Str_date = str_replace("a", "y", strtolower($_SESSION['scriptcase']['reg_conf']['date_format']));
  $Lim   = strlen($Str_date);
  $Str   = "";
  $Ult   = "";
  $Arr_D = array();
  for ($I = 0; $I < $Lim; $I++)
  {
      $Char = substr($Str_date, $I, 1);
      if ($Char != $Ult && "" != $Str)
      {
          $Arr_D[] = $Str;
          $Str     = $Char;
      }
      else
      {
          $Str    .= $Char;
      }
      $Ult = $Char;
  }
  $Arr_D[] = $Str;
  $Prim = true;
  foreach ($Arr_D as $Cada_d)
  {
      if (strpos($Form_base, $Cada_d) !== false)
      {
          $date_format_show .= (!$Prim) ? $_SESSION['scriptcase']['reg_conf']['date_sep'] : "";
          $date_format_show .= $Cada_d;
          $Prim = false;
      }
  }
  $date_format_show .= " ";
  $Str_time = strtolower($_SESSION['scriptcase']['reg_conf']['time_format']);
  $Lim   = strlen($Str_time);
  $Str   = "";
  $Ult   = "";
  $Arr_T = array();
  for ($I = 0; $I < $Lim; $I++)
  {
      $Char = substr($Str_time, $I, 1);
      if ($Char != $Ult && "" != $Str)
      {
          $Arr_T[] = $Str;
          $Str     = $Char;
      }
      else
      {
          $Str    .= $Char;
      }
      $Ult = $Char;
  }
  $Arr_T[] = $Str;
  $Prim = true;
  foreach ($Arr_T as $Cada_t)
  {
      if (strpos($Form_base, $Cada_t) !== false)
      {
          $date_format_show .= (!$Prim) ? $_SESSION['scriptcase']['reg_conf']['time_sep'] : "";
          $date_format_show .= $Cada_t;
          $Prim = false;
      }
  }
  $Arr_format = array_merge($Arr_D, $Arr_T);
  $date_format_show = str_replace("dd",   $this->Ini->Nm_lang['lang_othr_date_days'], $date_format_show);
  $date_format_show = str_replace("mm",   $this->Ini->Nm_lang['lang_othr_date_mnth'], $date_format_show);
  $date_format_show = str_replace("yyyy", $this->Ini->Nm_lang['lang_othr_date_year'], $date_format_show);
  $date_format_show = str_replace("aaaa", $this->Ini->Nm_lang['lang_othr_date_year'], $date_format_show);
  $date_format_show = str_replace("hh",   $this->Ini->Nm_lang['lang_othr_date_hour'], $date_format_show);
  $date_format_show = str_replace("ii",   $this->Ini->Nm_lang['lang_othr_date_mint'], $date_format_show);
  $date_format_show = str_replace("ss",   $this->Ini->Nm_lang['lang_othr_date_scnd'], $date_format_show);
  $date_format_show = "" . $date_format_show .  "";

?>

         <?php

foreach ($Arr_format as $Part_date)
{
?>
<?php
  if (substr($Part_date, 0,1) == "d")
  {
?>
<span id='id_date_part_issuedate_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_issuedate_dia" name="issuedate_dia" value="<?php echo NM_encode_input($issuedate_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "m")
  {
?>
<span id='id_date_part_issuedate_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_issuedate_mes" name="issuedate_mes" value="<?php echo NM_encode_input($issuedate_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "y")
  {
?>
<span id='id_date_part_issuedate_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_issuedate_ano" name="issuedate_ano" value="<?php echo NM_encode_input($issuedate_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
 </span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "h")
  {
?>
<span id='id_date_part_issuedate_HH' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_issuedate_hor" name="issuedate_hor" value="<?php echo NM_encode_input($issuedate_hor); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "i")
  {
?>
<span id='id_date_part_issuedate_II' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_issuedate_min" name="issuedate_min" value="<?php echo NM_encode_input($issuedate_min); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "s")
  {
?>
<span id='id_date_part_issuedate_SS' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_issuedate_seg" name="issuedate_seg" value="<?php echo NM_encode_input($issuedate_seg); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
</span>

<?php
  }
?>

<?php

}

?>
        <SPAN id="id_css_issuedate"  class="scFilterFieldFontEven">
 <br><?php echo $date_format_show ?>         </SPAN>
                  <br />
        <SPAN id="id_vis_issuedate"  <?php echo $str_display_issuedate; ?> class="scFilterFieldFontEven">
         <?php echo $date_sep_bw ?> 
         <BR>
         
         <?php

foreach ($Arr_format as $Part_date)
{
?>
<?php
  if (substr($Part_date, 0,1) == "d")
  {
?>
<span id='id_date_part_issuedate_input_2_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_issuedate_input_2_dia" name="issuedate_input_2_dia" value="<?php echo NM_encode_input($issuedate_input_2_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "m")
  {
?>
<span id='id_date_part_issuedate_input_2_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_issuedate_input_2_mes" name="issuedate_input_2_mes" value="<?php echo NM_encode_input($issuedate_input_2_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "y")
  {
?>
<span id='id_date_part_issuedate_input_2_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_issuedate_input_2_ano" name="issuedate_input_2_ano" value="<?php echo NM_encode_input($issuedate_input_2_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
 </span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "h")
  {
?>
<span id='id_date_part_issuedate_input_2_HH' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_issuedate_input_2_hor" name="issuedate_input_2_hor" value="<?php echo NM_encode_input($issuedate_input_2_hor); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "i")
  {
?>
<span id='id_date_part_issuedate_input_2_II' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_issuedate_input_2_min" name="issuedate_input_2_min" value="<?php echo NM_encode_input($issuedate_input_2_min); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "s")
  {
?>
<span id='id_date_part_issuedate_input_2_SS' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_issuedate_input_2_seg" name="issuedate_input_2_seg" value="<?php echo NM_encode_input($issuedate_input_2_seg); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
</span>

<?php
  }
?>

<?php

}

?>
         </SPAN>
          </TD>
   



   </tr><tr>



   
    <TD nowrap class="scFilterLabelOdd" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['extras'])) ? $this->New_label['extras'] : "" . $this->Ini->Nm_lang['lang_ado_records_fld_Extras'] . "";
 $nmgp_tab_label .= "extras?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectOdd" id="SC_extras_cond" name="extras_cond" onChange="nm_campos_between(document.getElementById('id_vis_extras'), this, 'extras')">
       <OPTION value="qp" <?php if ("qp" == $extras_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $extras_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $extras_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_extras"  <?php echo $str_hide_extras?>><?php
      if ($extras != "")
      {
      $extras_look = substr($this->Db->qstr($extras), 1, -1); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct Extras from " . $this->Ini->nm_tabela . " where EstadoReg='A' and Extras = '$extras_look' order by Extras"; 
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = trim($rs->fields[0]);
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 
      }
      if (isset($nmgp_def_dados[0][$extras]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$extras];
      }
      else
      {
          $sAutocompValue = $extras;
      }
?>
<INPUT  type="text" id="SC_extras" name="extras" value="<?php echo NM_encode_input($extras) ?>"  size=50 alt="{datatype: 'text', maxLength: 1000, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_extras" name="extras_autocomp" size="50"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 1000, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">

 </TD>
   



   </tr>
   </TABLE>
  </TD>
 </TR>
 </TABLE>
 </TD>
 </TR>
 <TR>
  <TD class="scFilterTableTd" align="center">
<INPUT type="hidden" id="SC_NM_operador" name="NM_operador" value="and">  </TD>
 </TR>
   <INPUT type="hidden" name="nmgp_tab_label" value="<?php echo NM_encode_input($nmgp_tab_label); ?>"> 
   <INPUT type="hidden" name="bprocessa" value="pesq"> 
<?php
    $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['pesq_tab_label'] = $nmgp_tab_label;
?>
 <?php
     if ($_SESSION['scriptcase']['proc_mobile'])
     {
     ?>
 <TR align="center">
  <TD class="scFilterTableTd" id='sc_filter_toolbar_bot'>
   <table width="100%" class="scFilterToolbar"><tr>
    <td class="scFilterToolbarPadding" align="left" width="33%" nowrap>
   <?php echo nmButtonOutput($this->arr_buttons, "bpesquisa", "document.F1.bprocessa.value='pesq'; setTimeout(function() {nm_submit_form()}, 200);", "document.F1.bprocessa.value='pesq'; setTimeout(function() {nm_submit_form()}, 200);", "sc_b_pesq_bot", "", "" . $this->Ini->Nm_lang['lang_btns_srch_lone'] . "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "" . $this->Ini->Nm_lang['lang_btns_srch_lone_hint'] . "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   if ($this->nmgp_botoes['clear'] == "on")
   {
?>
          <?php echo nmButtonOutput($this->arr_buttons, "blimpar", "limpa_form();", "limpa_form();", "limpa_frm_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
?>
<?php
   if (!isset($this->nmgp_botoes['save']) || $this->nmgp_botoes['save'] == "on")
   {
       $this->NM_fil_ant = $this->gera_array_filtros();
?>
     <span id="idAjaxSelect_NM_filters_bot">
       <SELECT class="scFilterToolbar_obj" id="sel_recup_filters_bot" name="NM_filters_bot" onChange="nm_submit_filter(this, 'bot');" size="1">
           <option value=""></option>
<?php
          $Nome_filter = "";
          foreach ($this->NM_fil_ant as $Cada_filter => $Tipo_filter)
          {
              $Select = "";
              if ($Cada_filter == $this->NM_curr_fil)
              {
                  $Select = "selected";
              }
              if (NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] != "UTF-8")
              {
                  $Cada_filter    = sc_convert_encoding($Cada_filter, $_SESSION['scriptcase']['charset'], "UTF-8");
                  $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], $_SESSION['scriptcase']['charset'], "UTF-8");
              }
              elseif (!NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] == "UTF-8")
              {
                  $Cada_filter    = sc_convert_encoding($Cada_filter, "UTF-8", $_SESSION['scriptcase']['charset']);
                  $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($Tipo_filter[1] != $Nome_filter)
              {
                  $Nome_filter = $Tipo_filter[1];
                  echo "           <option value=\"\">" . NM_encode_input($Nome_filter) . "</option>\r\n";
              }
?>
           <option value="<?php echo NM_encode_input($Tipo_filter[0]) . "\" " . $Select . ">.." . $Cada_filter ?></option>
<?php
          }
?>
       </SELECT>
     </span>
<?php
   }
?>
<?php
   if ($this->nmgp_botoes['save'] == "on")
   {
?>
          <?php echo nmButtonOutput($this->arr_buttons, "bedit_filter", "document.getElementById('Salvar_filters_bot').style.display = ''; document.F1.nmgp_save_name_bot.focus();", "document.getElementById('Salvar_filters_bot').style.display = ''; document.F1.nmgp_save_name_bot.focus();", "Ativa_save_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
?>
<?php
   if (is_file("grid_ado_records_admon_help.txt"))
   {
      $Arq_WebHelp = file("grid_ado_records_admon_help.txt"); 
      if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
      {
          $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
          $Tmp = explode(";", $Arq_WebHelp[0]); 
          foreach ($Tmp as $Cada_help)
          {
              $Tmp1 = explode(":", $Cada_help); 
              if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "fil" && is_file($this->Ini->root . $this->Ini->path_help . $Tmp1[1]))
              {
?>
          <?php echo nmButtonOutput($this->arr_buttons, "bhelp", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "sc_b_help_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
              }
          }
      }
   }
?>
<?php
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_ado_records_admon']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['grid_ado_records_admon']['start'] == 'filter' && $nm_apl_dependente != 1)
   {
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bsair", "document.form_cancel.submit();", "document.form_cancel.submit();", "sc_b_cancel_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
   else
   {
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.form_cancel.submit();", "document.form_cancel.submit();", "sc_b_cancel_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
?>
    </td>
   </tr></table>
<?php
   if ($this->nmgp_botoes['save'] == "on")
   {
?>
    </TD></TR><TR><TD>
    <DIV id="Salvar_filters_bot" style="display:none;z-index:9999;">
     <TABLE align="center" class="scFilterTable">
      <TR>
       <TD class="scFilterBlock">
        <table style="border-width: 0px; border-collapse: collapse" width="100%">
         <tr>
          <td style="padding: 0px" valign="top" class="scFilterBlockFont"><?php echo $this->Ini->Nm_lang['lang_othr_srch_head'] ?></td>
          <td style="padding: 0px" align="right" valign="top">
           <?php echo nmButtonOutput($this->arr_buttons, "bcancelar_appdiv", "document.getElementById('Salvar_filters_bot').style.display = 'none';", "document.getElementById('Salvar_filters_bot').style.display = 'none';", "Cancel_frm_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
          </td>
         </tr>
        </table>
       </TD>
      </TR>
      <TR>
       <TD class="scFilterFieldOdd">
        <table style="border-width: 0px; border-collapse: collapse" width="100%">
         <tr>
          <td style="padding: 0px" valign="top">
           <input class="scFilterObjectOdd" type="text" id="SC_nmgp_save_name_bot" name="nmgp_save_name_bot" value="">
          </td>
          <td style="padding: 0px" align="right" valign="top">
           <?php echo nmButtonOutput($this->arr_buttons, "bsalvar_appdiv", "nm_save_form('bot');", "nm_save_form('bot');", "Save_frm_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
          </td>
         </tr>
        </table>
       </TD>
      </TR>
      <TR>
       <TD class="scFilterFieldEven">
       <DIV id="Apaga_filters_bot" style="display:''">
        <table style="border-width: 0px; border-collapse: collapse" width="100%">
         <tr>
          <td style="padding: 0px" valign="top">
          <div id="idAjaxSelect_NM_filters_del_bot">
           <SELECT class="scFilterObjectOdd" id="sel_filters_del_bot" name="NM_filters_del_bot" size="1">
            <option value=""></option>
<?php
          $Nome_filter = "";
          foreach ($this->NM_fil_ant as $Cada_filter => $Tipo_filter)
          {
              $Select = "";
              if ($Cada_filter == $this->NM_curr_fil)
              {
                  $Select = "selected";
              }
              if (NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] != "UTF-8")
              {
                  $Cada_filter    = sc_convert_encoding($Cada_filter, $_SESSION['scriptcase']['charset'], "UTF-8");
                  $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], $_SESSION['scriptcase']['charset'], "UTF-8");
              }
              elseif (!NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] == "UTF-8")
              {
                  $Cada_filter    = sc_convert_encoding($Cada_filter, "UTF-8", $_SESSION['scriptcase']['charset']);
                  $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($Tipo_filter[1] != $Nome_filter)
              {
                  $Nome_filter = $Tipo_filter[1];
                  echo "            <option value=\"\">" . NM_encode_input($Nome_filter) . "</option>\r\n";
              }
?>
            <option value="<?php echo NM_encode_input($Tipo_filter[0]) . "\" " . $Select . ">.." . $Cada_filter ?></option>
<?php
          }
?>
           </SELECT>
          </div>
          </td>
          <td style="padding: 0px" align="right" valign="top">
           <?php echo nmButtonOutput($this->arr_buttons, "bexcluir_appdiv", "nm_submit_filter_del('bot');", "nm_submit_filter_del('bot');", "Exc_filtro_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
          </td>
         </tr>
        </table>
       </DIV>
       </TD>
      </TR>
     </TABLE>
    </DIV> 
<?php
   }
?>
  </TD>
 </TR>
     <?php
     }
     if (!$_SESSION['scriptcase']['proc_mobile'])
     {
     ?>
 <TR align="center">
  <TD class="scFilterTableTd" id='sc_filter_toolbar_bot'>
   <table width="100%" class="scFilterToolbar"><tr>
    <td class="scFilterToolbarPadding" align="left" width="33%" nowrap>
    </td>
    <td class="scFilterToolbarPadding" align="center" width="33%" nowrap>
   <?php echo nmButtonOutput($this->arr_buttons, "bpesquisa", "document.F1.bprocessa.value='pesq'; setTimeout(function() {nm_submit_form()}, 200);", "document.F1.bprocessa.value='pesq'; setTimeout(function() {nm_submit_form()}, 200);", "sc_b_pesq_bot", "", "" . $this->Ini->Nm_lang['lang_btns_srch_lone'] . "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "" . $this->Ini->Nm_lang['lang_btns_srch_lone_hint'] . "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   if ($this->nmgp_botoes['clear'] == "on")
   {
?>
          <?php echo nmButtonOutput($this->arr_buttons, "blimpar", "limpa_form();", "limpa_form();", "limpa_frm_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
?>
<?php
   if (!isset($this->nmgp_botoes['save']) || $this->nmgp_botoes['save'] == "on")
   {
       $this->NM_fil_ant = $this->gera_array_filtros();
?>
     <span id="idAjaxSelect_NM_filters_bot">
       <SELECT class="scFilterToolbar_obj" id="sel_recup_filters_bot" name="NM_filters_bot" onChange="nm_submit_filter(this, 'bot');" size="1">
           <option value=""></option>
<?php
          $Nome_filter = "";
          foreach ($this->NM_fil_ant as $Cada_filter => $Tipo_filter)
          {
              $Select = "";
              if ($Cada_filter == $this->NM_curr_fil)
              {
                  $Select = "selected";
              }
              if (NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] != "UTF-8")
              {
                  $Cada_filter    = sc_convert_encoding($Cada_filter, $_SESSION['scriptcase']['charset'], "UTF-8");
                  $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], $_SESSION['scriptcase']['charset'], "UTF-8");
              }
              elseif (!NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] == "UTF-8")
              {
                  $Cada_filter    = sc_convert_encoding($Cada_filter, "UTF-8", $_SESSION['scriptcase']['charset']);
                  $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($Tipo_filter[1] != $Nome_filter)
              {
                  $Nome_filter = $Tipo_filter[1];
                  echo "           <option value=\"\">" . NM_encode_input($Nome_filter) . "</option>\r\n";
              }
?>
           <option value="<?php echo NM_encode_input($Tipo_filter[0]) . "\" " . $Select . ">.." . $Cada_filter ?></option>
<?php
          }
?>
       </SELECT>
     </span>
<?php
   }
?>
<?php
   if ($this->nmgp_botoes['save'] == "on")
   {
?>
          <?php echo nmButtonOutput($this->arr_buttons, "bedit_filter", "document.getElementById('Salvar_filters_bot').style.display = ''; document.F1.nmgp_save_name_bot.focus();", "document.getElementById('Salvar_filters_bot').style.display = ''; document.F1.nmgp_save_name_bot.focus();", "Ativa_save_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
?>
<?php
   if (is_file("grid_ado_records_admon_help.txt"))
   {
      $Arq_WebHelp = file("grid_ado_records_admon_help.txt"); 
      if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
      {
          $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
          $Tmp = explode(";", $Arq_WebHelp[0]); 
          foreach ($Tmp as $Cada_help)
          {
              $Tmp1 = explode(":", $Cada_help); 
              if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "fil" && is_file($this->Ini->root . $this->Ini->path_help . $Tmp1[1]))
              {
?>
          <?php echo nmButtonOutput($this->arr_buttons, "bhelp", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "sc_b_help_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
              }
          }
      }
   }
?>
<?php
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_ado_records_admon']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['grid_ado_records_admon']['start'] == 'filter' && $nm_apl_dependente != 1)
   {
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bsair", "document.form_cancel.submit();", "document.form_cancel.submit();", "sc_b_cancel_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
   else
   {
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.form_cancel.submit();", "document.form_cancel.submit();", "sc_b_cancel_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
?>
    </td>
    <td class="scFilterToolbarPadding" align="right" width="33%" nowrap>
    </td>
   </tr></table>
<?php
   if ($this->nmgp_botoes['save'] == "on")
   {
?>
    </TD></TR><TR><TD>
    <DIV id="Salvar_filters_bot" style="display:none;z-index:9999;">
     <TABLE align="center" class="scFilterTable">
      <TR>
       <TD class="scFilterBlock">
        <table style="border-width: 0px; border-collapse: collapse" width="100%">
         <tr>
          <td style="padding: 0px" valign="top" class="scFilterBlockFont"><?php echo $this->Ini->Nm_lang['lang_othr_srch_head'] ?></td>
          <td style="padding: 0px" align="right" valign="top">
           <?php echo nmButtonOutput($this->arr_buttons, "bcancelar_appdiv", "document.getElementById('Salvar_filters_bot').style.display = 'none';", "document.getElementById('Salvar_filters_bot').style.display = 'none';", "Cancel_frm_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
          </td>
         </tr>
        </table>
       </TD>
      </TR>
      <TR>
       <TD class="scFilterFieldOdd">
        <table style="border-width: 0px; border-collapse: collapse" width="100%">
         <tr>
          <td style="padding: 0px" valign="top">
           <input class="scFilterObjectOdd" type="text" id="SC_nmgp_save_name_bot" name="nmgp_save_name_bot" value="">
          </td>
          <td style="padding: 0px" align="right" valign="top">
           <?php echo nmButtonOutput($this->arr_buttons, "bsalvar_appdiv", "nm_save_form('bot');", "nm_save_form('bot');", "Save_frm_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
          </td>
         </tr>
        </table>
       </TD>
      </TR>
      <TR>
       <TD class="scFilterFieldEven">
       <DIV id="Apaga_filters_bot" style="display:''">
        <table style="border-width: 0px; border-collapse: collapse" width="100%">
         <tr>
          <td style="padding: 0px" valign="top">
          <div id="idAjaxSelect_NM_filters_del_bot">
           <SELECT class="scFilterObjectOdd" id="sel_filters_del_bot" name="NM_filters_del_bot" size="1">
            <option value=""></option>
<?php
          $Nome_filter = "";
          foreach ($this->NM_fil_ant as $Cada_filter => $Tipo_filter)
          {
              $Select = "";
              if ($Cada_filter == $this->NM_curr_fil)
              {
                  $Select = "selected";
              }
              if (NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] != "UTF-8")
              {
                  $Cada_filter    = sc_convert_encoding($Cada_filter, $_SESSION['scriptcase']['charset'], "UTF-8");
                  $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], $_SESSION['scriptcase']['charset'], "UTF-8");
              }
              elseif (!NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] == "UTF-8")
              {
                  $Cada_filter    = sc_convert_encoding($Cada_filter, "UTF-8", $_SESSION['scriptcase']['charset']);
                  $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($Tipo_filter[1] != $Nome_filter)
              {
                  $Nome_filter = $Tipo_filter[1];
                  echo "            <option value=\"\">" . NM_encode_input($Nome_filter) . "</option>\r\n";
              }
?>
            <option value="<?php echo NM_encode_input($Tipo_filter[0]) . "\" " . $Select . ">.." . $Cada_filter ?></option>
<?php
          }
?>
           </SELECT>
          </div>
          </td>
          <td style="padding: 0px" align="right" valign="top">
           <?php echo nmButtonOutput($this->arr_buttons, "bexcluir_appdiv", "nm_submit_filter_del('bot');", "nm_submit_filter_del('bot');", "Exc_filtro_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
          </td>
         </tr>
        </table>
       </DIV>
       </TD>
      </TR>
     </TABLE>
    </DIV> 
<?php
   }
?>
  </TD>
 </TR>
     <?php
     }
 ?>
<?php
   }

   function monta_html_fim()
   {
       global $bprocessa, $nm_url_saida, $Script_BI;
?>

</TABLE>
   <INPUT type="hidden" name="form_condicao" value="3">
</FORM> 
<?php
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_ado_records_admon']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['grid_ado_records_admon']['start'] == 'filter')
   {
?>
   <FORM style="display:none;" name="form_cancel"  method="POST" action="<?php echo $nm_url_saida; ?>" target="_self"> 
<?php
   }
   else
   {
?>
   <FORM style="display:none;" name="form_cancel"  method="POST" action="./" target="_self"> 
<?php
   }
?>
   <INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<?php
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['orig_pesq'] == "grid")
   {
       $Ret_cancel_pesq = "volta_grid";
   }
   else
   {
       $Ret_cancel_pesq = "resumo";
   }
?>
   <INPUT type="hidden" name="nmgp_opcao" value="<?php echo $Ret_cancel_pesq; ?>"> 
   </FORM> 
<SCRIPT type="text/javascript">
<?php
   if (empty($this->NM_fil_ant))
   {
       if ($_SESSION['scriptcase']['proc_mobile'])
       {
?>
      document.getElementById('Apaga_filters_bot').style.display = 'none';
      document.getElementById('sel_recup_filters_bot').style.display = 'none';
<?php
       }
       else
       {
?>
      document.getElementById('Apaga_filters_bot').style.display = 'none';
      document.getElementById('sel_recup_filters_bot').style.display = 'none';
<?php
       }
   }
?>
 function nm_move()
 {
     document.form_cancel.target = "_self"; 
     document.form_cancel.action = "./"; 
     document.form_cancel.submit(); 
 }
 function nm_submit_form()
 {
    document.F1.submit();
 }
 function limpa_form()
 {
   document.F1.reset();
   if (document.F1.NM_filters)
   {
       document.F1.NM_filters.selectedIndex = -1;
   }
   document.getElementById('Salvar_filters_bot').style.display = 'none';
   document.F1.startingdate_cond.value = 'eq';
   nm_campos_between(document.getElementById('id_vis_startingdate'), document.F1.startingdate_cond, 'startingdate');
   document.F1.startingdate_dia.value = "";
   document.F1.startingdate_mes.value = "";
   document.F1.startingdate_ano.value = "";
   document.F1.startingdate_input_2_dia.value = "";
   document.F1.startingdate_input_2_mes.value = "";
   document.F1.startingdate_input_2_ano.value = "";
   document.F1.startingdate_hor.value = "";
   document.F1.startingdate_min.value = "";
   document.F1.startingdate_seg.value = "";
   document.F1.startingdate_input_2_hor.value = "";
   document.F1.startingdate_input_2_min.value = "";
   document.F1.startingdate_input_2_seg.value = "";
   document.F1.creationdate_cond.value = 'eq';
   nm_campos_between(document.getElementById('id_vis_creationdate'), document.F1.creationdate_cond, 'creationdate');
   document.F1.creationdate_dia.value = "";
   document.F1.creationdate_mes.value = "";
   document.F1.creationdate_ano.value = "";
   document.F1.creationdate_input_2_dia.value = "";
   document.F1.creationdate_input_2_mes.value = "";
   document.F1.creationdate_input_2_ano.value = "";
   document.F1.creationdate_hor.value = "";
   document.F1.creationdate_min.value = "";
   document.F1.creationdate_seg.value = "";
   document.F1.creationdate_input_2_hor.value = "";
   document.F1.creationdate_input_2_min.value = "";
   document.F1.creationdate_input_2_seg.value = "";
   document.F1.creationip_cond.value = 'eq';
   nm_campos_between(document.getElementById('id_vis_creationip'), document.F1.creationip_cond, 'creationip');
   document.F1.creationip.value = "";
   document.F1.creationip_autocomp.value = "";
   document.F1.firstname_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_firstname'), document.F1.firstname_cond, 'firstname');
   document.F1.firstname.value = "";
   document.F1.firstname_autocomp.value = "";
   document.F1.firstsurname_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_firstsurname'), document.F1.firstsurname_cond, 'firstsurname');
   document.F1.firstsurname.value = "";
   document.F1.firstsurname_autocomp.value = "";
   document.F1.gender_cond.value = 'eq';
   nm_campos_between(document.getElementById('id_vis_gender'), document.F1.gender_cond, 'gender');
   document.F1.gender.value = "";
   document.F1.transactiontypename_cond.value = 'eq';
   nm_campos_between(document.getElementById('id_vis_transactiontypename'), document.F1.transactiontypename_cond, 'transactiontypename');
   document.F1.transactiontypename.value = "";
   document.F1.transactiontypename_autocomp.value = "";
   document.F1.issuedate_cond.value = 'eq';
   nm_campos_between(document.getElementById('id_vis_issuedate'), document.F1.issuedate_cond, 'issuedate');
   document.F1.issuedate_dia.value = "";
   document.F1.issuedate_mes.value = "";
   document.F1.issuedate_ano.value = "";
   document.F1.issuedate_input_2_dia.value = "";
   document.F1.issuedate_input_2_mes.value = "";
   document.F1.issuedate_input_2_ano.value = "";
   document.F1.issuedate_hor.value = "";
   document.F1.issuedate_min.value = "";
   document.F1.issuedate_seg.value = "";
   document.F1.issuedate_input_2_hor.value = "";
   document.F1.issuedate_input_2_min.value = "";
   document.F1.issuedate_input_2_seg.value = "";
   document.F1.extras_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_extras'), document.F1.extras_cond, 'extras');
   document.F1.extras.value = "";
   document.F1.extras_autocomp.value = "";
 }
 function SC_carga_evt_jquery()
 {
    $('#SC_creationdate_dia').bind('change', function() {sc_grid_ado_records_admon_valida_dia(this)});
    $('#SC_creationdate_hor').bind('change', function() {sc_grid_ado_records_admon_valida_hora(this)});
    $('#SC_creationdate_input_2_dia').bind('change', function() {sc_grid_ado_records_admon_valida_dia(this)});
    $('#SC_creationdate_input_2_hor').bind('change', function() {sc_grid_ado_records_admon_valida_hora(this)});
    $('#SC_creationdate_input_2_mes').bind('change', function() {sc_grid_ado_records_admon_valida_mes(this)});
    $('#SC_creationdate_input_2_min').bind('change', function() {sc_grid_ado_records_admon_valida_min(this)});
    $('#SC_creationdate_input_2_seg').bind('change', function() {sc_grid_ado_records_admon_valida_seg(this)});
    $('#SC_creationdate_mes').bind('change', function() {sc_grid_ado_records_admon_valida_mes(this)});
    $('#SC_creationdate_min').bind('change', function() {sc_grid_ado_records_admon_valida_min(this)});
    $('#SC_creationdate_seg').bind('change', function() {sc_grid_ado_records_admon_valida_seg(this)});
    $('#SC_issuedate_dia').bind('change', function() {sc_grid_ado_records_admon_valida_dia(this)});
    $('#SC_issuedate_hor').bind('change', function() {sc_grid_ado_records_admon_valida_hora(this)});
    $('#SC_issuedate_input_2_dia').bind('change', function() {sc_grid_ado_records_admon_valida_dia(this)});
    $('#SC_issuedate_input_2_hor').bind('change', function() {sc_grid_ado_records_admon_valida_hora(this)});
    $('#SC_issuedate_input_2_mes').bind('change', function() {sc_grid_ado_records_admon_valida_mes(this)});
    $('#SC_issuedate_input_2_min').bind('change', function() {sc_grid_ado_records_admon_valida_min(this)});
    $('#SC_issuedate_input_2_seg').bind('change', function() {sc_grid_ado_records_admon_valida_seg(this)});
    $('#SC_issuedate_mes').bind('change', function() {sc_grid_ado_records_admon_valida_mes(this)});
    $('#SC_issuedate_min').bind('change', function() {sc_grid_ado_records_admon_valida_min(this)});
    $('#SC_issuedate_seg').bind('change', function() {sc_grid_ado_records_admon_valida_seg(this)});
    $('#SC_startingdate_dia').bind('change', function() {sc_grid_ado_records_admon_valida_dia(this)});
    $('#SC_startingdate_hor').bind('change', function() {sc_grid_ado_records_admon_valida_hora(this)});
    $('#SC_startingdate_input_2_dia').bind('change', function() {sc_grid_ado_records_admon_valida_dia(this)});
    $('#SC_startingdate_input_2_hor').bind('change', function() {sc_grid_ado_records_admon_valida_hora(this)});
    $('#SC_startingdate_input_2_mes').bind('change', function() {sc_grid_ado_records_admon_valida_mes(this)});
    $('#SC_startingdate_input_2_min').bind('change', function() {sc_grid_ado_records_admon_valida_min(this)});
    $('#SC_startingdate_input_2_seg').bind('change', function() {sc_grid_ado_records_admon_valida_seg(this)});
    $('#SC_startingdate_mes').bind('change', function() {sc_grid_ado_records_admon_valida_mes(this)});
    $('#SC_startingdate_min').bind('change', function() {sc_grid_ado_records_admon_valida_min(this)});
    $('#SC_startingdate_seg').bind('change', function() {sc_grid_ado_records_admon_valida_seg(this)});
 }
 function sc_grid_ado_records_admon_valida_dia(obj)
 {
     if (obj.value != "" && (obj.value < 1 || obj.value > 31))
     {
         if (confirm (Nm_erro['lang_jscr_ivdt'] +  " " + Nm_erro['lang_jscr_iday'] +  " " + Nm_erro['lang_jscr_wfix']))
         {
            Xfocus = setTimeout(function() { obj.focus(); }, 10);
         }
     }
 }
 function sc_grid_ado_records_admon_valida_mes(obj)
 {
     if (obj.value != "" && (obj.value < 1 || obj.value > 12))
     {
         if (confirm (Nm_erro['lang_jscr_ivdt'] +  " " + Nm_erro['lang_jscr_mnth'] +  " " + Nm_erro['lang_jscr_wfix']))
         {
            Xfocus = setTimeout(function() { obj.focus(); }, 10);
         }
     }
 }
 function sc_grid_ado_records_admon_valida_hora(obj)
 {
     if (obj.value != "" && (obj.value < 0 || obj.value > 23))
     {
         if (confirm (Nm_erro['lang_jscr_ivtm'] +  " " + Nm_erro['lang_jscr_wfix']))
         {
            Xfocus = setTimeout(function() { obj.focus(); }, 10);
         }
     }
 }
 function sc_grid_ado_records_admon_valida_min(obj)
 {
     if (obj.value != "" && (obj.value < 0 || obj.value > 59))
     {
         if (confirm (Nm_erro['lang_jscr_ivdt'] +  " " + Nm_erro['lang_jscr_mint'] +  " " + Nm_erro['lang_jscr_wfix']))
         {
            Xfocus = setTimeout(function() { obj.focus(); }, 10);
         }
     }
 }
 function sc_grid_ado_records_admon_valida_seg(obj)
 {
     if (obj.value != "" && (obj.value < 0 || obj.value > 59))
     {
         if (confirm (Nm_erro['lang_jscr_ivdt'] +  " " + Nm_erro['lang_jscr_secd'] +  " " + Nm_erro['lang_jscr_wfix']))
         {
            Xfocus = setTimeout(function() { obj.focus(); }, 10);
         }
     }
 }
   function process_hotkeys(hotkey)
   {
      if (hotkey == 'sys_format_fi2') { 
         var output =  $('#sc_b_pesq_bot').click();
         return (0 < output.length);
      }
      if (hotkey == 'sys_format_lim') { 
         var output =  $('#limpa_frm_bot').click();
         return (0 < output.length);
      }
      if (hotkey == 'sys_format_edi') { 
         var output =  $('#Ativa_save_bot').click();
         return (0 < output.length);
      }
      if (hotkey == 'sys_format_webh') { 
         var output =  $('#sc_b_help_bot').click();
         return (0 < output.length);
      }
      if (hotkey == 'sys_format_sai') { 
         var output =  $('#sc_b_cancel_bot').click();
         return (0 < output.length);
      }
   return false;
   }
</SCRIPT>
</BODY>
</HTML>
<?php
   }

   function gera_array_filtros()
   {
       $this->NM_fil_ant = array();
       $NM_patch   = "OpenIdConnect/grid_ado_records_admon";
       if (is_dir($this->NM_path_filter . $NM_patch))
       {
           $NM_dir = @opendir($this->NM_path_filter . $NM_patch);
           while (FALSE !== ($NM_arq = @readdir($NM_dir)))
           {
             if (@is_file($this->NM_path_filter . $NM_patch . "/" . $NM_arq))
             {
                 $Sc_v6 = false;
                 $NMcmp_filter = file($this->NM_path_filter . $NM_patch . "/" . $NM_arq);
                 $NMcmp_filter = explode("@NMF@", $NMcmp_filter[0]);
                 if (substr($NMcmp_filter[0], 0, 6) == "SC_V6_" || substr($NMcmp_filter[0], 0, 6) == "SC_V8_")
                 {
                     $Name_filter = substr($NMcmp_filter[0], 6);
                     if (!empty($Name_filter))
                     {
                         $nmgp_save_name = str_replace('/', ' ', $Name_filter);
                         $nmgp_save_name = str_replace('\\', ' ', $nmgp_save_name);
                         $nmgp_save_name = str_replace('.', ' ', $nmgp_save_name);
                         $this->NM_fil_ant[$Name_filter][0] = $NM_patch . "/" . $nmgp_save_name;
                         $this->NM_fil_ant[$Name_filter][1] = "" . $this->Ini->Nm_lang['lang_srch_public'] . "";
                         $Sc_v6 = true;
                     }
                 }
                 if (!$Sc_v6)
                 {
                     $this->NM_fil_ant[$NM_arq][0] = $NM_patch . "/" . $NM_arq;
                     $this->NM_fil_ant[$NM_arq][1] = "" . $this->Ini->Nm_lang['lang_srch_public'] . "";
                 }
             }
           }
       }
       return $this->NM_fil_ant;
   }
   /**
    * @access  public
    * @param  string  $NM_operador  $this->Ini->Nm_lang['pesq_global_NM_operador']
    * @param  array  $nmgp_tab_label  
    */
   function inicializa_vars()
   {
      global $NM_operador, $nmgp_tab_label;

      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/");  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1);  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz;
      $this->Campos_Mens_erro = ""; 
      $this->nm_data = new nm_data("es");
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['cond_pesq'] = "";
      if ($this->NM_ajax_flag && ($this->NM_ajax_opcao == "ajax_grid_search" || $this->NM_ajax_opcao == "ajax_grid_search_change_fil"))
      {
          $nmgp_tab_label = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['pesq_tab_label'];
      }
      if (!empty($nmgp_tab_label))
      {
         $nm_tab_campos = explode("?@?", $nmgp_tab_label);
         $nmgp_tab_label = array();
         foreach ($nm_tab_campos as $cada_campo)
         {
             $parte_campo = explode("?#?", $cada_campo);
             $nmgp_tab_label[$parte_campo[0]] = $parte_campo[1];
         }
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['where_orig']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['where_orig'] = "";
      }
      if ($this->NM_ajax_flag && ($this->NM_ajax_opcao == "ajax_grid_search" || $this->NM_ajax_opcao == "ajax_grid_search_change_fil"))
      {
          $this->comando = "";
      }
      else
      {
          $this->comando = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['where_orig'];
      }
      $this->comando_sum    = "";
      $this->comando_filtro = "";
      $this->comando_ini    = "ini";
      $this->comando_fim    = "";
      $this->NM_operador    = (isset($NM_operador) && ("and" == strtolower($NM_operador) || "or" == strtolower($NM_operador))) ? $NM_operador : "and";
   }

   function salva_filtro($nmgp_save_origem)
   {
      global $NM_filters_save, $nmgp_save_name, $nmgp_save_option, $script_case_init;
          $NM_filters_save = str_replace("__NM_PLUS__", "+", $NM_filters_save);
          $NM_str_filter  = "SC_V8_" . $nmgp_save_name . "@NMF@";
          $nmgp_save_name = str_replace('/', ' ', $nmgp_save_name);
          $nmgp_save_name = str_replace('\\', ' ', $nmgp_save_name);
          $nmgp_save_name = str_replace('.', ' ', $nmgp_save_name);
          if (!NM_is_utf8($nmgp_save_name))
          {
              $nmgp_save_name = sc_convert_encoding($nmgp_save_name, "UTF-8", $_SESSION['scriptcase']['charset']);
          }
          $NM_str_filter  .= $NM_filters_save;
          $NM_patch = $this->NM_path_filter;
          if (!is_dir($NM_patch))
          {
              $NMdir = mkdir($NM_patch, 0755);
          }
          $NM_patch .= "OpenIdConnect/";
          if (!is_dir($NM_patch))
          {
              $NMdir = mkdir($NM_patch, 0755);
          }
          $NM_patch .= "grid_ado_records_admon/";
          if (!is_dir($NM_patch))
          {
              $NMdir = mkdir($NM_patch, 0755);
          }
          $Parms_usr  = "";
          $NM_filter = fopen ($NM_patch . $nmgp_save_name, 'w');
          if (!NM_is_utf8($NM_str_filter))
          {
              $NM_str_filter = sc_convert_encoding($NM_str_filter, "UTF-8", $_SESSION['scriptcase']['charset']);
          }
          fwrite($NM_filter, $NM_str_filter);
          fclose($NM_filter);
   }
   function recupera_filtro($NM_filters)
   {
      global $NM_operador, $script_case_init;
      $NM_patch = $this->NM_path_filter . "/" . $NM_filters;
      if (!is_file($NM_patch))
      {
          $NM_filters = sc_convert_encoding($NM_filters, "UTF-8", $_SESSION['scriptcase']['charset']);
          $NM_patch = $this->NM_path_filter . "/" . $NM_filters;
      }
      $return_fields = array();
      $tp_fields     = array();
      $tb_fields_esp = array();
      $old_bi_opcs   = array("TP","HJ","OT","U7","SP","US","MM","UM","AM","PS","SS","P3","PM","P7","CY","LY","YY","M6","M3","M18","M24");
      $tp_fields['SC_startingdate_cond'] = 'cond';
      $tp_fields['SC_startingdate_dia'] = 'text';
      $tp_fields['SC_startingdate_mes'] = 'text';
      $tp_fields['SC_startingdate_ano'] = 'text';
      $tp_fields['SC_startingdate_input_2_dia'] = 'text';
      $tp_fields['SC_startingdate_input_2_mes'] = 'text';
      $tp_fields['SC_startingdate_input_2_ano'] = 'text';
      $tp_fields['SC_startingdate_hor'] = 'text';
      $tp_fields['SC_startingdate_min'] = 'text';
      $tp_fields['SC_startingdate_seg'] = 'text';
      $tp_fields['SC_startingdate_input_2_hor'] = 'text';
      $tp_fields['SC_startingdate_input_2_min'] = 'text';
      $tp_fields['SC_startingdate_input_2_seg'] = 'text';
      $tp_fields['SC_creationdate_cond'] = 'cond';
      $tp_fields['SC_creationdate_dia'] = 'text';
      $tp_fields['SC_creationdate_mes'] = 'text';
      $tp_fields['SC_creationdate_ano'] = 'text';
      $tp_fields['SC_creationdate_input_2_dia'] = 'text';
      $tp_fields['SC_creationdate_input_2_mes'] = 'text';
      $tp_fields['SC_creationdate_input_2_ano'] = 'text';
      $tp_fields['SC_creationdate_hor'] = 'text';
      $tp_fields['SC_creationdate_min'] = 'text';
      $tp_fields['SC_creationdate_seg'] = 'text';
      $tp_fields['SC_creationdate_input_2_hor'] = 'text';
      $tp_fields['SC_creationdate_input_2_min'] = 'text';
      $tp_fields['SC_creationdate_input_2_seg'] = 'text';
      $tp_fields['SC_creationip_cond'] = 'cond';
      $tp_fields['SC_creationip'] = 'text_aut';
      $tp_fields['id_ac_creationip'] = 'text_aut';
      $tp_fields['SC_firstname_cond'] = 'cond';
      $tp_fields['SC_firstname'] = 'text_aut';
      $tp_fields['id_ac_firstname'] = 'text_aut';
      $tp_fields['SC_firstsurname_cond'] = 'cond';
      $tp_fields['SC_firstsurname'] = 'text_aut';
      $tp_fields['id_ac_firstsurname'] = 'text_aut';
      $tp_fields['SC_gender_cond'] = 'cond';
      $tp_fields['SC_gender'] = 'select';
      $tp_fields['SC_transactiontypename_cond'] = 'cond';
      $tp_fields['SC_transactiontypename'] = 'text_aut';
      $tp_fields['id_ac_transactiontypename'] = 'text_aut';
      $tp_fields['SC_issuedate_cond'] = 'cond';
      $tp_fields['SC_issuedate_dia'] = 'text';
      $tp_fields['SC_issuedate_mes'] = 'text';
      $tp_fields['SC_issuedate_ano'] = 'text';
      $tp_fields['SC_issuedate_input_2_dia'] = 'text';
      $tp_fields['SC_issuedate_input_2_mes'] = 'text';
      $tp_fields['SC_issuedate_input_2_ano'] = 'text';
      $tp_fields['SC_issuedate_hor'] = 'text';
      $tp_fields['SC_issuedate_min'] = 'text';
      $tp_fields['SC_issuedate_seg'] = 'text';
      $tp_fields['SC_issuedate_input_2_hor'] = 'text';
      $tp_fields['SC_issuedate_input_2_min'] = 'text';
      $tp_fields['SC_issuedate_input_2_seg'] = 'text';
      $tp_fields['SC_extras_cond'] = 'cond';
      $tp_fields['SC_extras'] = 'text_aut';
      $tp_fields['id_ac_extras'] = 'text_aut';
      $tp_fields['SC_NM_operador'] = 'text';
      if (is_file($NM_patch))
      {
          $SC_V8    = false;
          $NMfilter = file($NM_patch);
          $NMcmp_filter = explode("@NMF@", $NMfilter[0]);
          if (substr($NMcmp_filter[0], 0, 5) == "SC_V8")
          {
              $SC_V8 = true;
          }
          if (substr($NMcmp_filter[0], 0, 5) == "SC_V6" || substr($NMcmp_filter[0], 0, 5) == "SC_V8")
          {
              unset($NMcmp_filter[0]);
          }
          foreach ($NMcmp_filter as $Cada_cmp)
          {
              $Cada_cmp = explode("#NMF#", $Cada_cmp);
              if (isset($tb_fields_esp[$Cada_cmp[0]]))
              {
                  $Cada_cmp[0] = $tb_fields_esp[$Cada_cmp[0]];
              }
              if (!$SC_V8 && substr($Cada_cmp[0], 0, 11) != "div_ac_lab_" && substr($Cada_cmp[0], 0, 6) != "id_ac_")
              {
                  $Cada_cmp[0] = "SC_" . $Cada_cmp[0];
              }
              if (!isset($tp_fields[$Cada_cmp[0]]))
              {
                  continue;
              }
              $list   = array();
              $list_a = array();
              if (substr($Cada_cmp[1], 0, 10) == "_NM_array_")
              {
                  if (substr($Cada_cmp[1], 0, 17) == "_NM_array_#NMARR#")
                  {
                      $Sc_temp = explode("#NMARR#", substr($Cada_cmp[1], 17));
                      foreach ($Sc_temp as $Cada_val)
                      {
                          $list[]   = $Cada_val;
                          $tmp_pos  = strpos($Cada_val, "##@@");
                          $val_a    = ($tmp_pos !== false) ?  substr($Cada_val, $tmp_pos + 4) : $Cada_val;
                          $list_a[] = array('opt' => $Cada_val, 'value' => $val_a);
                      }
                  }
              }
              elseif ($tp_fields[$Cada_cmp[0]] == 'dselect')
              {
                  $list[]   = $Cada_cmp[1];
                  $tmp_pos  = strpos($Cada_cmp[1], "##@@");
                  $val_a    = ($tmp_pos !== false) ?  substr($Cada_cmp[1], $tmp_pos + 4) : $Cada_cmp[1];
                  $list_a[] = array('opt' => $Cada_cmp[1], 'value' => $val_a);
              }
              else
              {
                  $list[0] = $Cada_cmp[1];
              }
              if ($tp_fields[$Cada_cmp[0]] == 'select2_aut')
              {
                  if (!isset($list[0]))
                  {
                      $list[0] = "";
                  }
                  $return_fields['set_select2_aut'][] = array('field' => $Cada_cmp[0], 'value' => $list[0]);
              }
              elseif ($tp_fields[$Cada_cmp[0]] == 'dselect')
              {
                  $return_fields['set_dselect'][] = array('field' => $Cada_cmp[0], 'value' => $list_a);
              }
              elseif ($tp_fields[$Cada_cmp[0]] == 'fil_order')
              {
                  $return_fields['set_fil_order'][] = array('field' => $Cada_cmp[0], 'value' => $list);
              }
              elseif ($tp_fields[$Cada_cmp[0]] == 'selmult')
              {
                  if (count($list) == 1 && $list[0] == "")
                  {
                      continue;
                  }
                  $return_fields['set_selmult'][] = array('field' => $Cada_cmp[0], 'value' => $list);
              }
              elseif ($tp_fields[$Cada_cmp[0]] == 'ddcheckbox')
              {
                  $return_fields['set_ddcheckbox'][] = array('field' => $Cada_cmp[0], 'value' => $list);
              }
              elseif ($tp_fields[$Cada_cmp[0]] == 'checkbox')
              {
                  $return_fields['set_checkbox'][] = array('field' => $Cada_cmp[0], 'value' => $list);
              }
              else
              {
                  if (!isset($list[0]))
                  {
                      $list[0] = "";
                  }
                  if ($tp_fields[$Cada_cmp[0]] == 'html')
                  {
                      $return_fields['set_html'][] = array('field' => $Cada_cmp[0], 'value' => $list[0]);
                  }
                  elseif ($tp_fields[$Cada_cmp[0]] == 'radio')
                  {
                      $return_fields['set_radio'][] = array('field' => $Cada_cmp[0], 'value' => $list[0]);
                  }
                  elseif ($tp_fields[$Cada_cmp[0]] == 'cond' && in_array($list[0], $old_bi_opcs))
                  {
                      $Cada_cmp[1] = "bi_" . $list[0];
                      $return_fields['set_val'][] = array('field' => $Cada_cmp[0], 'value' => $Cada_cmp[1]);
                  }
                  else
                  {
                      $return_fields['set_val'][] = array('field' => $Cada_cmp[0], 'value' => $list[0]);
                  }
              }
          }
          $this->NM_curr_fil = $NM_filters;
      }
      return $return_fields;
   }
   function apaga_filtro()
   {
      global $NM_filters_del;
      if (isset($NM_filters_del) && !empty($NM_filters_del))
      { 
          $NM_patch = $this->NM_path_filter . "/" . $NM_filters_del;
          if (!is_file($NM_patch))
          {
              $NM_filters_del = sc_convert_encoding($NM_filters_del, "UTF-8", $_SESSION['scriptcase']['charset']);
              $NM_patch = $this->NM_path_filter . "/" . $NM_filters_del;
          }
          if (is_file($NM_patch))
          {
              @unlink($NM_patch);
          }
          if ($NM_filters_del == $this->NM_curr_fil)
          {
              $this->NM_curr_fil = "";
          }
      }
   }
   /**
    * @access  public
    */
   function trata_campos()
   {
      global $startingdate_cond, $startingdate, $startingdate_dia, $startingdate_mes, $startingdate_ano, $startingdate_hor, $startingdate_min, $startingdate_seg, $startingdate_input_2_dia, $startingdate_input_2_mes, $startingdate_input_2_ano, $startingdate_input_2_min, $startingdate_input_2_hor, $startingdate_input_2_seg,
             $creationdate_cond, $creationdate, $creationdate_dia, $creationdate_mes, $creationdate_ano, $creationdate_hor, $creationdate_min, $creationdate_seg, $creationdate_input_2_dia, $creationdate_input_2_mes, $creationdate_input_2_ano, $creationdate_input_2_min, $creationdate_input_2_hor, $creationdate_input_2_seg,
             $creationip_cond, $creationip, $creationip_autocomp,
             $firstname_cond, $firstname, $firstname_autocomp,
             $firstsurname_cond, $firstsurname, $firstsurname_autocomp,
             $gender_cond, $gender,
             $transactiontypename_cond, $transactiontypename, $transactiontypename_autocomp,
             $issuedate_cond, $issuedate, $issuedate_dia, $issuedate_mes, $issuedate_ano, $issuedate_hor, $issuedate_min, $issuedate_seg, $issuedate_input_2_dia, $issuedate_input_2_mes, $issuedate_input_2_ano, $issuedate_input_2_min, $issuedate_input_2_hor, $issuedate_input_2_seg,
             $extras_cond, $extras, $extras_autocomp, $nmgp_tab_label;

      $C_formatado = true;
      if ($this->NM_ajax_flag && ($this->NM_ajax_opcao == "ajax_grid_search" || $this->NM_ajax_opcao == "ajax_grid_search_change_fil"))
      {
          if ($this->NM_ajax_opcao == "ajax_grid_search")
          {
              $C_formatado = false;
          }
          $Temp_Busca  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8" && $this->NM_ajax_opcao != "ajax_grid_search_change_fil")
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca'] = NM_conv_charset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca'], $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca'] as $Cmps => $Vals)
          {
              $$Cmps = $Vals;
          }
      }
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_gp_limpa.php", "F", "nm_limpa_valor") ; 
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_conv_dados.php", "F", "nm_conv_limpa_dado") ; 
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_edit.php", "F", "nmgp_Form_Num_Val") ; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq'] = array();
      if (!empty($creationip_autocomp) && empty($creationip))
      {
          $creationip = $creationip_autocomp;
      }
      if (!empty($firstname_autocomp) && empty($firstname))
      {
          $firstname = $firstname_autocomp;
      }
      if (!empty($firstsurname_autocomp) && empty($firstsurname))
      {
          $firstsurname = $firstsurname_autocomp;
      }
      if (!empty($transactiontypename_autocomp) && empty($transactiontypename))
      {
          $transactiontypename = $transactiontypename_autocomp;
      }
      if (!empty($extras_autocomp) && empty($extras))
      {
          $extras = $extras_autocomp;
      }
      $startingdate_cond_salva = $startingdate_cond; 
      if (!isset($startingdate_input_2_dia) || $startingdate_input_2_dia == "")
      {
          $startingdate_input_2_dia = $startingdate_dia;
      }
      if (!isset($startingdate_input_2_mes) || $startingdate_input_2_mes == "")
      {
          $startingdate_input_2_mes = $startingdate_mes;
      }
      if (!isset($startingdate_input_2_ano) || $startingdate_input_2_ano == "")
      {
          $startingdate_input_2_ano = $startingdate_ano;
      }
      if (!isset($startingdate_input_2_hor) || $startingdate_input_2_hor == "")
      {
          $startingdate_input_2_hor = $startingdate_hor;
      }
      if (!isset($startingdate_input_2_min) || $startingdate_input_2_min == "")
      {
          $startingdate_input_2_min = $startingdate_min;
      }
      if (!isset($startingdate_input_2_seg) || $startingdate_input_2_seg == "")
      {
          $startingdate_input_2_seg = $startingdate_seg;
      }
      $creationdate_cond_salva = $creationdate_cond; 
      if (!isset($creationdate_input_2_dia) || $creationdate_input_2_dia == "")
      {
          $creationdate_input_2_dia = $creationdate_dia;
      }
      if (!isset($creationdate_input_2_mes) || $creationdate_input_2_mes == "")
      {
          $creationdate_input_2_mes = $creationdate_mes;
      }
      if (!isset($creationdate_input_2_ano) || $creationdate_input_2_ano == "")
      {
          $creationdate_input_2_ano = $creationdate_ano;
      }
      if (!isset($creationdate_input_2_hor) || $creationdate_input_2_hor == "")
      {
          $creationdate_input_2_hor = $creationdate_hor;
      }
      if (!isset($creationdate_input_2_min) || $creationdate_input_2_min == "")
      {
          $creationdate_input_2_min = $creationdate_min;
      }
      if (!isset($creationdate_input_2_seg) || $creationdate_input_2_seg == "")
      {
          $creationdate_input_2_seg = $creationdate_seg;
      }
      $creationip_cond_salva = $creationip_cond; 
      if (!isset($creationip_input_2) || $creationip_input_2 == "")
      {
          $creationip_input_2 = $creationip;
      }
      $firstname_cond_salva = $firstname_cond; 
      if (!isset($firstname_input_2) || $firstname_input_2 == "")
      {
          $firstname_input_2 = $firstname;
      }
      $firstsurname_cond_salva = $firstsurname_cond; 
      if (!isset($firstsurname_input_2) || $firstsurname_input_2 == "")
      {
          $firstsurname_input_2 = $firstsurname;
      }
      $gender_cond_salva = $gender_cond; 
      if (!isset($gender_input_2) || $gender_input_2 == "")
      {
          $gender_input_2 = $gender;
      }
      $transactiontypename_cond_salva = $transactiontypename_cond; 
      if (!isset($transactiontypename_input_2) || $transactiontypename_input_2 == "")
      {
          $transactiontypename_input_2 = $transactiontypename;
      }
      $issuedate_cond_salva = $issuedate_cond; 
      if (!isset($issuedate_input_2_dia) || $issuedate_input_2_dia == "")
      {
          $issuedate_input_2_dia = $issuedate_dia;
      }
      if (!isset($issuedate_input_2_mes) || $issuedate_input_2_mes == "")
      {
          $issuedate_input_2_mes = $issuedate_mes;
      }
      if (!isset($issuedate_input_2_ano) || $issuedate_input_2_ano == "")
      {
          $issuedate_input_2_ano = $issuedate_ano;
      }
      if (!isset($issuedate_input_2_hor) || $issuedate_input_2_hor == "")
      {
          $issuedate_input_2_hor = $issuedate_hor;
      }
      if (!isset($issuedate_input_2_min) || $issuedate_input_2_min == "")
      {
          $issuedate_input_2_min = $issuedate_min;
      }
      if (!isset($issuedate_input_2_seg) || $issuedate_input_2_seg == "")
      {
          $issuedate_input_2_seg = $issuedate_seg;
      }
      $extras_cond_salva = $extras_cond; 
      if (!isset($extras_input_2) || $extras_input_2 == "")
      {
          $extras_input_2 = $extras;
      }
      $tmp_pos = strpos($gender, "##@@");
      if ($tmp_pos === false) {
          $L_lookup = $gender;
      }
      else {
          $L_lookup = substr($gender, 0, $tmp_pos);
      }
      if ($this->NM_ajax_opcao != "ajax_grid_search_change_fil" && !empty($L_lookup) && !in_array($L_lookup, $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['psq_check_ret']['gender'])) {
          if (!empty($this->Campos_Mens_erro)) {$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "" . $this->Ini->Nm_lang['lang_ado_records_fld_Gender'] . " : " . $this->Ini->Nm_lang['lang_errm_ajax_data'];
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']  = array(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search']  = array(); 
      $I_Grid = 0;
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['startingdate_dia'] = $startingdate_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['startingdate_mes'] = $startingdate_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['startingdate_ano'] = $startingdate_ano; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['startingdate_input_2_dia'] = $startingdate_input_2_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['startingdate_input_2_mes'] = $startingdate_input_2_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['startingdate_input_2_ano'] = $startingdate_input_2_ano; 
      if (!empty($startingdate_dia) || !empty($startingdate_mes) || !empty($startingdate_ano) || $startingdate_cond_salva == "nu" || $startingdate_cond_salva == "nn" || $startingdate_cond_salva == "ep" || $startingdate_cond_salva == "ne")
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][0][] = "D:" . $startingdate_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][0][] = "M:" . $startingdate_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][0][] = "Y:" . $startingdate_ano;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][1][] = "D:" . $startingdate_input_2_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][1][] = "M:" . $startingdate_input_2_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][1][] = "Y:" . $startingdate_input_2_ano;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['startingdate_hor'] = $startingdate_hor; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['startingdate_min'] = $startingdate_min; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['startingdate_seg'] = $startingdate_seg; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['startingdate_input_2_hor'] = $startingdate_input_2_hor; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['startingdate_input_2_min'] = $startingdate_input_2_min; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['startingdate_input_2_seg'] = $startingdate_input_2_seg; 
      if (!empty($startingdate_hor) || !empty($startingdate_min) || !empty($startingdate_seg) || $startingdate_cond_salva == "nu" || $startingdate_cond_salva == "nn" || $startingdate_cond_salva == "ep" || $startingdate_cond_salva == "ne")
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][0][] = "H:" . $startingdate_hor;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][0][] = "I:" . $startingdate_min;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][0][] = "S:" . $startingdate_seg;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][1][] = "H:" . $startingdate_input_2_hor;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][1][] = "I:" . $startingdate_input_2_min;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][1][] = "S:" . $startingdate_input_2_seg;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['startingdate_cond'] = $startingdate_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['cmp'] = "startingdate"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['opc'] = $startingdate_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq']['startingdate'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['creationdate_dia'] = $creationdate_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['creationdate_mes'] = $creationdate_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['creationdate_ano'] = $creationdate_ano; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['creationdate_input_2_dia'] = $creationdate_input_2_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['creationdate_input_2_mes'] = $creationdate_input_2_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['creationdate_input_2_ano'] = $creationdate_input_2_ano; 
      if (!empty($creationdate_dia) || !empty($creationdate_mes) || !empty($creationdate_ano) || $creationdate_cond_salva == "nu" || $creationdate_cond_salva == "nn" || $creationdate_cond_salva == "ep" || $creationdate_cond_salva == "ne")
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][0][] = "D:" . $creationdate_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][0][] = "M:" . $creationdate_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][0][] = "Y:" . $creationdate_ano;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][1][] = "D:" . $creationdate_input_2_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][1][] = "M:" . $creationdate_input_2_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][1][] = "Y:" . $creationdate_input_2_ano;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['creationdate_hor'] = $creationdate_hor; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['creationdate_min'] = $creationdate_min; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['creationdate_seg'] = $creationdate_seg; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['creationdate_input_2_hor'] = $creationdate_input_2_hor; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['creationdate_input_2_min'] = $creationdate_input_2_min; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['creationdate_input_2_seg'] = $creationdate_input_2_seg; 
      if (!empty($creationdate_hor) || !empty($creationdate_min) || !empty($creationdate_seg) || $creationdate_cond_salva == "nu" || $creationdate_cond_salva == "nn" || $creationdate_cond_salva == "ep" || $creationdate_cond_salva == "ne")
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][0][] = "H:" . $creationdate_hor;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][0][] = "I:" . $creationdate_min;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][0][] = "S:" . $creationdate_seg;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][1][] = "H:" . $creationdate_input_2_hor;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][1][] = "I:" . $creationdate_input_2_min;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][1][] = "S:" . $creationdate_input_2_seg;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['creationdate_cond'] = $creationdate_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['cmp'] = "creationdate"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['opc'] = $creationdate_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq']['creationdate'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['creationip'] = $creationip; 
      if (is_array($creationip) && !empty($creationip))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][0] = $creationip;
      }
      elseif ($creationip_cond_salva == "nu" || $creationip_cond_salva == "nn" || $creationip_cond_salva == "ep" || $creationip_cond_salva == "ne" || !empty($creationip))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][0][0] = $creationip;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['creationip_cond'] = $creationip_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['cmp'] = "creationip"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['opc'] = $creationip_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq']['creationip'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['firstname'] = $firstname; 
      if (is_array($firstname) && !empty($firstname))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][0] = $firstname;
      }
      elseif ($firstname_cond_salva == "nu" || $firstname_cond_salva == "nn" || $firstname_cond_salva == "ep" || $firstname_cond_salva == "ne" || !empty($firstname))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][0][0] = $firstname;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['firstname_cond'] = $firstname_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['cmp'] = "firstname"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['opc'] = $firstname_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq']['firstname'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['firstsurname'] = $firstsurname; 
      if (is_array($firstsurname) && !empty($firstsurname))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][0] = $firstsurname;
      }
      elseif ($firstsurname_cond_salva == "nu" || $firstsurname_cond_salva == "nn" || $firstsurname_cond_salva == "ep" || $firstsurname_cond_salva == "ne" || !empty($firstsurname))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][0][0] = $firstsurname;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['firstsurname_cond'] = $firstsurname_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['cmp'] = "firstsurname"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['opc'] = $firstsurname_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq']['firstsurname'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['gender'] = $gender; 
      if (is_array($gender) && !empty($gender))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][0] = $gender;
      }
      elseif ($gender_cond_salva == "nu" || $gender_cond_salva == "nn" || $gender_cond_salva == "ep" || $gender_cond_salva == "ne" || !empty($gender))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][0][0] = $gender;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['gender_cond'] = $gender_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['cmp'] = "gender"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['opc'] = $gender_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq']['gender'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['transactiontypename'] = $transactiontypename; 
      if (is_array($transactiontypename) && !empty($transactiontypename))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][0] = $transactiontypename;
      }
      elseif ($transactiontypename_cond_salva == "nu" || $transactiontypename_cond_salva == "nn" || $transactiontypename_cond_salva == "ep" || $transactiontypename_cond_salva == "ne" || !empty($transactiontypename))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][0][0] = $transactiontypename;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['transactiontypename_cond'] = $transactiontypename_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['cmp'] = "transactiontypename"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['opc'] = $transactiontypename_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq']['transactiontypename'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['issuedate_dia'] = $issuedate_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['issuedate_mes'] = $issuedate_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['issuedate_ano'] = $issuedate_ano; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['issuedate_input_2_dia'] = $issuedate_input_2_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['issuedate_input_2_mes'] = $issuedate_input_2_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['issuedate_input_2_ano'] = $issuedate_input_2_ano; 
      if (!empty($issuedate_dia) || !empty($issuedate_mes) || !empty($issuedate_ano) || $issuedate_cond_salva == "nu" || $issuedate_cond_salva == "nn" || $issuedate_cond_salva == "ep" || $issuedate_cond_salva == "ne")
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][0][] = "D:" . $issuedate_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][0][] = "M:" . $issuedate_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][0][] = "Y:" . $issuedate_ano;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][1][] = "D:" . $issuedate_input_2_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][1][] = "M:" . $issuedate_input_2_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][1][] = "Y:" . $issuedate_input_2_ano;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['issuedate_hor'] = $issuedate_hor; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['issuedate_min'] = $issuedate_min; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['issuedate_seg'] = $issuedate_seg; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['issuedate_input_2_hor'] = $issuedate_input_2_hor; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['issuedate_input_2_min'] = $issuedate_input_2_min; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['issuedate_input_2_seg'] = $issuedate_input_2_seg; 
      if (!empty($issuedate_hor) || !empty($issuedate_min) || !empty($issuedate_seg) || $issuedate_cond_salva == "nu" || $issuedate_cond_salva == "nn" || $issuedate_cond_salva == "ep" || $issuedate_cond_salva == "ne")
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][0][] = "H:" . $issuedate_hor;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][0][] = "I:" . $issuedate_min;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][0][] = "S:" . $issuedate_seg;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][1][] = "H:" . $issuedate_input_2_hor;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][1][] = "I:" . $issuedate_input_2_min;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][1][] = "S:" . $issuedate_input_2_seg;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['issuedate_cond'] = $issuedate_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['cmp'] = "issuedate"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['opc'] = $issuedate_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq']['issuedate'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['extras'] = $extras; 
      if (is_array($extras) && !empty($extras))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][0] = $extras;
      }
      elseif ($extras_cond_salva == "nu" || $extras_cond_salva == "nn" || $extras_cond_salva == "ep" || $extras_cond_salva == "ne" || !empty($extras))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['val'][0][0] = $extras;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['extras_cond'] = $extras_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['cmp'] = "extras"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid]['opc'] = $extras_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq']['extras'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['NM_operador'] = $this->NM_operador; 
      if ($this->NM_ajax_flag && $this->NM_ajax_opcao == "ajax_grid_search")
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca'] = $Temp_Busca;
      }
      if (!empty($this->Campos_Mens_erro)) 
      {
          return;
      }
      $nmgp_def_dados = array();
    if ($creationip != '') {
      $creationip_look = substr($this->Db->qstr($creationip), 1, -1); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct CreationIP from " . $this->Ini->nm_tabela . " where EstadoReg='A' and CreationIP = '$creationip_look' order by CreationIP"; 
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

    }
      if (!empty($nmgp_def_dados) && isset($cmp2) && !empty($cmp2))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp2 = NM_conv_charset($cmp2, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['creationip'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['creationip'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['creationip'] = $creationip;
      }
      $nmgp_def_dados = array();
    if ($firstname != '') {
      $firstname_look = substr($this->Db->qstr($firstname), 1, -1); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct FirstName from " . $this->Ini->nm_tabela . " where EstadoReg='A' and FirstName = '$firstname_look' order by FirstName"; 
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

    }
      if (!empty($nmgp_def_dados) && isset($cmp2) && !empty($cmp2))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp2 = NM_conv_charset($cmp2, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['firstname'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['firstname'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['firstname'] = $firstname;
      }
      $nmgp_def_dados = array();
    if ($firstsurname != '') {
      $firstsurname_look = substr($this->Db->qstr($firstsurname), 1, -1); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct FirstSurname from " . $this->Ini->nm_tabela . " where EstadoReg='A' and FirstSurname = '$firstsurname_look' order by FirstSurname"; 
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

    }
      if (!empty($nmgp_def_dados) && isset($cmp2) && !empty($cmp2))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp2 = NM_conv_charset($cmp2, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['firstsurname'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['firstsurname'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['firstsurname'] = $firstsurname;
      }
      $Conteudo = $gender;
      if (strpos($Conteudo, "##@@") !== false)
      {
          $Conteudo = substr($Conteudo, strpos($Conteudo, "##@@") + 4);
      }
      $this->cmp_formatado['gender'] = $Conteudo;
      $nmgp_def_dados = array();
    if ($transactiontypename != '') {
      $transactiontypename_look = substr($this->Db->qstr($transactiontypename), 1, -1); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct TransactionTypeName from " . $this->Ini->nm_tabela . " where EstadoReg='A' and TransactionTypeName = '$transactiontypename_look' order by TransactionTypeName"; 
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

    }
      if (!empty($nmgp_def_dados) && isset($cmp2) && !empty($cmp2))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp2 = NM_conv_charset($cmp2, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['transactiontypename'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['transactiontypename'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['transactiontypename'] = $transactiontypename;
      }
      $nmgp_def_dados = array();
    if ($extras != '') {
      $extras_look = substr($this->Db->qstr($extras), 1, -1); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct Extras from " . $this->Ini->nm_tabela . " where EstadoReg='A' and Extras = '$extras_look' order by Extras"; 
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

    }
      if (!empty($nmgp_def_dados) && isset($cmp2) && !empty($cmp2))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp2 = NM_conv_charset($cmp2, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['extras'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['extras'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['extras'] = $extras;
      }

      //----- $startingdate
      $this->Date_part = false;
      if ($startingdate_cond != "bi_TP")
      {
          $startingdate_cond = strtoupper($startingdate_cond);
          $Dtxt = "";
          $val  = array();
          $Dtxt .= $startingdate_ano;
          $Dtxt .= $startingdate_mes;
          $Dtxt .= $startingdate_dia;
          $Dtxt .= $startingdate_hor;
          $Dtxt .= $startingdate_min;
          $Dtxt .= $startingdate_seg;
          $val[0]['ano'] = $startingdate_ano;
          $val[0]['mes'] = $startingdate_mes;
          $val[0]['dia'] = $startingdate_dia;
          $val[0]['hor'] = $startingdate_hor;
          $val[0]['min'] = $startingdate_min;
          $val[0]['seg'] = $startingdate_seg;
          if ($startingdate_cond == "BW")
          {
              $val[1]['ano'] = $startingdate_input_2_ano;
              $val[1]['mes'] = $startingdate_input_2_mes;
              $val[1]['dia'] = $startingdate_input_2_dia;
              $val[1]['hor'] = $startingdate_input_2_hor;
              $val[1]['min'] = $startingdate_input_2_min;
              $val[1]['seg'] = $startingdate_input_2_seg;
          }
          $this->Operador_date_part = "";
          $this->Lang_date_part     = "";
          $this->nm_prep_date($val, "DH", "DATETIME", $startingdate_cond, "", "datahora");
          if (!$this->Date_part) {
              $val[0] = $this->Ini->sc_Date_Protect($val[0]);
          }
          $startingdate = $val[0];
          $this->cmp_formatado['startingdate'] = $val[0];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['startingdate'] = $val[0];
          $this->nm_data->SetaData($this->cmp_formatado['startingdate'], "YYYY-MM-DD HH:II:SS");
          $this->cmp_formatado['startingdate'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "dmY his"));
          if ($startingdate_cond == "BW")
          {
              if (!$this->Date_part) {
                  $val[1] = $this->Ini->sc_Date_Protect($val[1]);
              }
              $startingdate_input_2     = $val[1];
              $this->cmp_formatado['startingdate_input_2'] = $val[1];
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['startingdate_input_2'] = $val[1];
              $this->nm_data->SetaData($this->cmp_formatado['startingdate_input_2'], "YYYY-MM-DD HH:II:SS");
              $this->cmp_formatado['startingdate_input_2'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "dmY his"));
          }
          if (!empty($Dtxt) || $startingdate_cond == "NU" || $startingdate_cond == "NN"|| $startingdate_cond == "EP"|| $startingdate_cond == "NE")
          {
              $this->monta_condicao("StartingDate", $startingdate_cond, $startingdate, $startingdate_input_2, 'startingdate', 'DATETIME');
          }
      }
      else
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq']['startingdate']['label'] = $nmgp_tab_label['startingdate'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq']['startingdate']['descr'] = $nmgp_tab_label['startingdate'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq']['startingdate']['hint']  = $nmgp_tab_label['startingdate'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
      }

      //----- $creationdate
      $this->Date_part = false;
      if ($creationdate_cond != "bi_TP")
      {
          $creationdate_cond = strtoupper($creationdate_cond);
          $Dtxt = "";
          $val  = array();
          $Dtxt .= $creationdate_ano;
          $Dtxt .= $creationdate_mes;
          $Dtxt .= $creationdate_dia;
          $Dtxt .= $creationdate_hor;
          $Dtxt .= $creationdate_min;
          $Dtxt .= $creationdate_seg;
          $val[0]['ano'] = $creationdate_ano;
          $val[0]['mes'] = $creationdate_mes;
          $val[0]['dia'] = $creationdate_dia;
          $val[0]['hor'] = $creationdate_hor;
          $val[0]['min'] = $creationdate_min;
          $val[0]['seg'] = $creationdate_seg;
          if ($creationdate_cond == "BW")
          {
              $val[1]['ano'] = $creationdate_input_2_ano;
              $val[1]['mes'] = $creationdate_input_2_mes;
              $val[1]['dia'] = $creationdate_input_2_dia;
              $val[1]['hor'] = $creationdate_input_2_hor;
              $val[1]['min'] = $creationdate_input_2_min;
              $val[1]['seg'] = $creationdate_input_2_seg;
          }
          $this->Operador_date_part = "";
          $this->Lang_date_part     = "";
          $this->nm_prep_date($val, "DH", "DATETIME", $creationdate_cond, "", "datahora");
          if (!$this->Date_part) {
              $val[0] = $this->Ini->sc_Date_Protect($val[0]);
          }
          $creationdate = $val[0];
          $this->cmp_formatado['creationdate'] = $val[0];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['creationdate'] = $val[0];
          $this->nm_data->SetaData($this->cmp_formatado['creationdate'], "YYYY-MM-DD HH:II:SS");
          $this->cmp_formatado['creationdate'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "dmY his"));
          if ($creationdate_cond == "BW")
          {
              if (!$this->Date_part) {
                  $val[1] = $this->Ini->sc_Date_Protect($val[1]);
              }
              $creationdate_input_2     = $val[1];
              $this->cmp_formatado['creationdate_input_2'] = $val[1];
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['creationdate_input_2'] = $val[1];
              $this->nm_data->SetaData($this->cmp_formatado['creationdate_input_2'], "YYYY-MM-DD HH:II:SS");
              $this->cmp_formatado['creationdate_input_2'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "dmY his"));
          }
          if (!empty($Dtxt) || $creationdate_cond == "NU" || $creationdate_cond == "NN"|| $creationdate_cond == "EP"|| $creationdate_cond == "NE")
          {
              $this->monta_condicao("CreationDate", $creationdate_cond, $creationdate, $creationdate_input_2, 'creationdate', 'DATETIME');
          }
      }
      else
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq']['creationdate']['label'] = $nmgp_tab_label['creationdate'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq']['creationdate']['descr'] = $nmgp_tab_label['creationdate'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq']['creationdate']['hint']  = $nmgp_tab_label['creationdate'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
      }

      //----- $creationip
      $this->Date_part = false;
      if (isset($creationip) || $creationip_cond == "nu" || $creationip_cond == "nn" || $creationip_cond == "ep" || $creationip_cond == "ne")
      {
         $this->monta_condicao("CreationIP", $creationip_cond, $creationip, "", "creationip");
      }

      //----- $firstname
      $this->Date_part = false;
      if (isset($firstname) || $firstname_cond == "nu" || $firstname_cond == "nn" || $firstname_cond == "ep" || $firstname_cond == "ne")
      {
         $this->monta_condicao("FirstName", $firstname_cond, $firstname, "", "firstname");
      }

      //----- $firstsurname
      $this->Date_part = false;
      if (isset($firstsurname) || $firstsurname_cond == "nu" || $firstsurname_cond == "nn" || $firstsurname_cond == "ep" || $firstsurname_cond == "ne")
      {
         $this->monta_condicao("FirstSurname", $firstsurname_cond, $firstsurname, "", "firstsurname");
      }

      //----- $gender
      $this->Date_part = false;
      if (isset($gender))
      {
         $this->monta_condicao("Gender", $gender_cond, $gender, "", "gender");
      }

      //----- $transactiontypename
      $this->Date_part = false;
      if (isset($transactiontypename) || $transactiontypename_cond == "nu" || $transactiontypename_cond == "nn" || $transactiontypename_cond == "ep" || $transactiontypename_cond == "ne")
      {
         $this->monta_condicao("TransactionTypeName", $transactiontypename_cond, $transactiontypename, "", "transactiontypename");
      }

      //----- $issuedate
      $this->Date_part = false;
      if ($issuedate_cond != "bi_TP")
      {
          $issuedate_cond = strtoupper($issuedate_cond);
          $Dtxt = "";
          $val  = array();
          $Dtxt .= $issuedate_ano;
          $Dtxt .= $issuedate_mes;
          $Dtxt .= $issuedate_dia;
          $Dtxt .= $issuedate_hor;
          $Dtxt .= $issuedate_min;
          $Dtxt .= $issuedate_seg;
          $val[0]['ano'] = $issuedate_ano;
          $val[0]['mes'] = $issuedate_mes;
          $val[0]['dia'] = $issuedate_dia;
          $val[0]['hor'] = $issuedate_hor;
          $val[0]['min'] = $issuedate_min;
          $val[0]['seg'] = $issuedate_seg;
          if ($issuedate_cond == "BW")
          {
              $val[1]['ano'] = $issuedate_input_2_ano;
              $val[1]['mes'] = $issuedate_input_2_mes;
              $val[1]['dia'] = $issuedate_input_2_dia;
              $val[1]['hor'] = $issuedate_input_2_hor;
              $val[1]['min'] = $issuedate_input_2_min;
              $val[1]['seg'] = $issuedate_input_2_seg;
          }
          $this->Operador_date_part = "";
          $this->Lang_date_part     = "";
          $this->nm_prep_date($val, "DH", "DATETIME", $issuedate_cond, "", "datahora");
          if (!$this->Date_part) {
              $val[0] = $this->Ini->sc_Date_Protect($val[0]);
          }
          $issuedate = $val[0];
          $this->cmp_formatado['issuedate'] = $val[0];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['issuedate'] = $val[0];
          $this->nm_data->SetaData($this->cmp_formatado['issuedate'], "YYYY-MM-DD HH:II:SS");
          $this->cmp_formatado['issuedate'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "dmY his"));
          if ($issuedate_cond == "BW")
          {
              if (!$this->Date_part) {
                  $val[1] = $this->Ini->sc_Date_Protect($val[1]);
              }
              $issuedate_input_2     = $val[1];
              $this->cmp_formatado['issuedate_input_2'] = $val[1];
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']['issuedate_input_2'] = $val[1];
              $this->nm_data->SetaData($this->cmp_formatado['issuedate_input_2'], "YYYY-MM-DD HH:II:SS");
              $this->cmp_formatado['issuedate_input_2'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "dmY his"));
          }
          if (!empty($Dtxt) || $issuedate_cond == "NU" || $issuedate_cond == "NN"|| $issuedate_cond == "EP"|| $issuedate_cond == "NE")
          {
              $this->monta_condicao("IssueDate", $issuedate_cond, $issuedate, $issuedate_input_2, 'issuedate', 'DATETIME');
          }
      }
      else
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq']['issuedate']['label'] = $nmgp_tab_label['issuedate'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq']['issuedate']['descr'] = $nmgp_tab_label['issuedate'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['grid_pesq']['issuedate']['hint']  = $nmgp_tab_label['issuedate'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
      }

      //----- $extras
      $this->Date_part = false;
      if (isset($extras) || $extras_cond == "nu" || $extras_cond == "nn" || $extras_cond == "ep" || $extras_cond == "ne")
      {
         $this->monta_condicao("Extras", $extras_cond, $extras, "", "extras");
      }
   }

   /**
    * @access  public
    */
   function finaliza_resultado_ajax()
   {
       $this->comando = substr($this->comando, 8);
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['where_pesq_grid'] = $this->comando;
       if (empty($this->comando)) 
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['where_pesq_filtro'] = "";
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['where_pesq']        = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['where_orig'];
       }
       else
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['where_pesq_filtro'] = "( " . $this->comando . " )";
           if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['where_orig'])) 
           {
               $this->comando = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['where_orig'] . " and (" . $this->comando . ")"; 
           }
           else
           {
               $this->comando = " where " . $this->comando; 
           }
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['where_pesq'] = $this->comando;
       }
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['where_pesq_fast'])) 
       {
           if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['where_pesq'])) 
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['where_pesq'] .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['where_pesq_fast'] . ")";
           }
           else 
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['where_pesq'] = " where (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['where_pesq_fast'] . ")";
           }
       }
   }
   function finaliza_resultado()
   {
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['dyn_search']      = array();
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['cond_dyn_search'] = "";
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['where_pesq_fast'] = "";
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['fast_search']);
      if ("" == $this->comando_filtro)
      {
          $this->comando = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['where_orig'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca']) && $_SESSION['scriptcase']['charset'] != "UTF-8")
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca'] = NM_conv_charset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['campos_busca'], "UTF-8", $_SESSION['scriptcase']['charset']);
      }

      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['where_pesq_grid']    = $this->comando_filtro;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['where_pesq_lookup']  = $this->comando_sum . $this->comando_fim;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['where_pesq']         = $this->comando . $this->comando_fim;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['opcao']              = "pesq";
      if ("" == $this->comando_filtro)
      {
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['where_pesq_filtro'] = "";
      }
      else
      {
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['where_pesq_filtro'] = " (" . $this->comando_filtro . ")";
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['where_pesq'] != $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['where_pesq_ant'])
      {
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['cond_pesq'] .= $this->NM_operador;
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['contr_array_resumo'] = "NAO";
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['contr_total_geral']  = "NAO";
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['tot_geral']);
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['where_pesq_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_ado_records_admon']['where_pesq'];

      if ($this->NM_ajax_flag && ($this->NM_ajax_opcao == "ajax_grid_search" || $this->NM_ajax_opcao == "ajax_grid_search_change_fil"))
      {
         return;
      }
      $this->retorna_pesq();
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
}

?>
