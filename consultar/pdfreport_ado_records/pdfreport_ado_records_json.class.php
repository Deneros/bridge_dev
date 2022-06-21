<?php

class pdfreport_ado_records_json
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $nm_data;
   var $Arquivo;
   var $Arquivo_view;
   var $Tit_doc;
   var $sc_proc_grid; 
   var $NM_cmp_hidden = array();

   function __construct()
   {
      $this->nm_data = new nm_data("es");
   }

   function monta_json()
   {
      $this->inicializa_vars();
      $this->grava_arquivo();
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['embutida'])
      {
          if ($this->Ini->sc_export_ajax)
          {
              $this->Arr_result['file_export']  = NM_charset_to_utf8($this->Json_f);
              $this->Arr_result['title_export'] = NM_charset_to_utf8($this->Tit_doc);
              $Temp = ob_get_clean();
              if ($Temp !== false && trim($Temp) != "")
              {
                  $this->Arr_result['htmOutput'] = NM_charset_to_utf8($Temp);
              }
              $result_json = json_encode($this->Arr_result, JSON_UNESCAPED_UNICODE);
              if ($result_json == false)
              {
                  $oJson = new Services_JSON();
                  $result_json = $oJson->encode($this->Arr_result);
              }
              echo $result_json;
              exit;
          }
          else
          {
              $this->progress_bar_end();
          }
      }
      else
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['opcao'] = "";
      }
   }

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
                   nm_limpa_str_pdfreport_ado_records($cadapar[1]);
                   nm_protect_num_pdfreport_ado_records($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['pdfreport_ado_records']['opcao'] = $cadapar[1];
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
          nm_limpa_str_pdfreport_ado_records($_SESSION["nuTransacion"]);
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->Json_use_label = false;
      $this->Json_format = false;
      $this->Tem_json_res = false;
      $this->Json_password = "";
      if (isset($_REQUEST['nm_json_label']) && !empty($_REQUEST['nm_json_label']))
      {
          $this->Json_use_label = ($_REQUEST['nm_json_label'] == "S") ? true : false;
      }
      if (isset($_REQUEST['nm_json_format']) && !empty($_REQUEST['nm_json_format']))
      {
          $this->Json_format = ($_REQUEST['nm_json_format'] == "S") ? true : false;
      }
      $this->Tem_json_res  = true;
      if (isset($_REQUEST['SC_module_export']) && $_REQUEST['SC_module_export'] != "")
      { 
          $this->Tem_json_res = (strpos(" " . $_REQUEST['SC_module_export'], "resume") !== false) ? true : false;
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['SC_Gb_Free_cmp']))
      {
          $this->Tem_json_res  = false;
      }
      if (!is_file($this->Ini->root . $this->Ini->path_link . "pdfreport_ado_records/pdfreport_ado_records_res_json.class.php"))
      {
          $this->Tem_json_res  = false;
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['embutida'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['json_label']))
      {
          $this->Json_use_label = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['json_label'];
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['embutida'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['json_format']))
      {
          $this->Json_format = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['json_format'];
      }
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['embutida'] && !$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['pdfreport_ado_records']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['json_return']);
          if ($this->Tem_json_res) {
              $PB_plus = intval ($this->count_ger * 0.04);
              $PB_plus = ($PB_plus < 2) ? 2 : $PB_plus;
          }
          else {
              $PB_plus = intval ($this->count_ger * 0.02);
              $PB_plus = ($PB_plus < 1) ? 1 : $PB_plus;
          }
          $PB_tot = $this->count_ger + $PB_plus;
          $this->PB_dif = $PB_tot - $this->count_ger;
          $this->pb->setTotalSteps($PB_tot);
      }
      $this->nm_data = new nm_data("es");
      $this->Arquivo      = "sc_json";
      $this->Arquivo     .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arq_zip      = $this->Arquivo . "_pdfreport_ado_records.zip";
      $this->Arquivo     .= "_pdfreport_ado_records";
      $this->Arquivo     .= ".json";
      $this->Tit_doc      = "pdfreport_ado_records.json";
      $this->Tit_zip      = "pdfreport_ado_records.zip";
   }

   function prep_modulos($modulo)
   {
      $this->$modulo->Ini    = $this->Ini;
      $this->$modulo->Db     = $this->Db;
      $this->$modulo->Erro   = $this->Erro;
      $this->$modulo->Lookup = $this->Lookup;
   }

   function grava_arquivo()
   {
      global $nm_lang;
      global $nm_nada, $nm_lang;

      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->sc_proc_grid = false; 
      $nm_raiz_img  = ""; 
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['campos_busca'];
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
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['json_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['json_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['json_name'] .= ".json";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['json_name'];
          $this->Arq_zip = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['json_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['json_name'];
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['json_name'], ".");
          if ($Pos !== false) {
              $this->Arq_zip = substr($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['json_name'], 0, $Pos);
          }
          $this->Arq_zip .= ".zip";
          $this->Tit_zip  = $this->Arq_zip;
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['json_name']);
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['embutida'])
      { 
          $this->Json_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
          $this->Zip_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arq_zip;
          $json_f = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo, "w");
      }
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
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['order_grid'];
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
      $this->json_registro = array();
      $this->SC_seq_json   = 0;
      $PB_tot = (isset($this->count_ger) && $this->count_ger > 0) ? "/" . $this->count_ger : "";
      while (!$rs->EOF)
      {
         $this->SC_seq_register++;
         if (!$_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['embutida'] && !$this->Ini->sc_export_ajax) {
             $Mens_bar = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_prcs']);
             $this->pb->setProgressbarMessage($Mens_bar . ": " . $this->SC_seq_register . $PB_tot);
             $this->pb->addSteps(1);
         }
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
         $_SESSION['scriptcase']['pdfreport_ado_records']['contr_erro'] = 'on';
 settype($sbRuta,"string");
settype($sbSql,"string");

$sbSql = "SELECT valor FROM parametros WHERE idparametro='url_imagenes'";
 
      $nm_select = $sbSql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rcParametros = array();
      $this->rcparametros = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rcParametros[$SCy] [$SCx] = $SCrx->fields[$SCx];
                        $this->rcparametros[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rcParametros = false;
          $this->rcParametros_erro = $this->Db->ErrorMsg();
          $this->rcparametros = false;
          $this->rcparametros_erro = $this->Db->ErrorMsg();
      } 
;

$sbRuta = $this->rcParametros[0][0].$this->idnumber ."/".$this->transactionid ."/clientFace.png"; 
$this->urlimgs  = $sbRuta;

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

if($this->transactiontypename =="Verify"){
	$this->nmgp_cmp_hidden["response_ani"] = "off";
	$this->response_ani  = "No aplica";
}

if($this->transactiontypename =="Verify"){
   $this->response_ani  = "No aplica";
}
elseif($this->transactiontypename =="Enroll" && !empty($this->response_ani )){
   $sbANI = $this->response_ani ;
   $sbANI = str_replace(",","<br>",$sbANI);
   $this->response_ani  = $sbANI;
}
else{
   $this->response_ani  = "No aplica";
}
$_SESSION['scriptcase']['pdfreport_ado_records']['contr_erro'] = 'off'; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['field_order'] as $Cada_col)
         { 
            if (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off")
            { 
                $NM_func_exp = "NM_export_" . $Cada_col;
                $this->$NM_func_exp();
            } 
         } 
         $this->SC_seq_json++;
         $rs->MoveNext();
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['embutida'])
      { 
          $_SESSION['scriptcase']['export_return'] = $this->json_registro;
      }
      else
      { 
          $result_json = json_encode($this->json_registro, JSON_UNESCAPED_UNICODE);
          if ($result_json == false)
          {
              $oJson = new Services_JSON();
              $result_json = $oJson->encode($this->json_registro);
          }
          fwrite($json_f, $result_json);
          fclose($json_f);
          if ($this->Tem_json_res)
          { 
              if (!$this->Ini->sc_export_ajax) {
                  $this->PB_dif = intval ($this->PB_dif / 2);
                  $Mens_bar  = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_prcs']);
                  $Mens_smry = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_smry_titl']);
                  $this->pb->setProgressbarMessage($Mens_bar . ": " . $Mens_smry);
                  $this->pb->addSteps($this->PB_dif);
              }
              require_once($this->Ini->path_aplicacao . "pdfreport_ado_records_res_json.class.php");
              $this->Res = new pdfreport_ado_records_res_json();
              $this->prep_modulos("Res");
              $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['json_res_grid'] = true;
              $this->Res->monta_json();
          } 
          if (!$this->Ini->sc_export_ajax) {
              $Mens_bar = NM_charset_to_utf8($this->Ini->Nm_lang['lang_btns_export_finished']);
              $this->pb->setProgressbarMessage($Mens_bar);
              $this->pb->addSteps($this->PB_dif);
          }
          if ($this->Json_password != "" || $this->Tem_json_res)
          { 
              $str_zip    = "";
              $Parm_pass  = ($this->Json_password != "") ? " -p" : "";
              $Zip_f      = (FALSE !== strpos($this->Zip_f, ' ')) ? " \"" . $this->Zip_f . "\"" :  $this->Zip_f;
              $Arq_input  = (FALSE !== strpos($this->Json_f, ' ')) ? " \"" . $this->Json_f . "\"" :  $this->Json_f;
              if (is_file($Zip_f)) {
                  unlink($Zip_f);
              }
              if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
              {
                  chdir($this->Ini->path_third . "/zip/windows");
                  $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j " . $this->Json_password . " " . $Zip_f . " " . $Arq_input;
              }
              elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
              {
                  if (FALSE !== strpos(strtolower(php_uname()), 'i686')) 
                  {
                      chdir($this->Ini->path_third . "/zip/linux-i386/bin");
                  }
                  else
                  {
                      chdir($this->Ini->path_third . "/zip/linux-amd64/bin");
                  }
                  $str_zip = "./7za " . $Parm_pass . $this->Json_password . " a " . $Zip_f . " " . $Arq_input;
              }
              elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
              {
                  chdir($this->Ini->path_third . "/zip/mac/bin");
                  $str_zip = "./7za " . $Parm_pass . $this->Json_password . " a " . $Zip_f . " " . $Arq_input;
              }
              if (!empty($str_zip)) {
                  exec($str_zip);
              }
              // ----- ZIP log
              $fp = @fopen(trim(str_replace(array(".zip",'"'), array(".log",""), $Zip_f)), 'w');
              if ($fp)
              {
                  @fwrite($fp, $str_zip . "\r\n\r\n");
                  @fclose($fp);
              }
              unlink($Arq_input);
              $this->Arquivo = $this->Arq_zip;
              $this->Json_f   = $this->Zip_f;
              $this->Tit_doc = $this->Tit_zip;
              if ($this->Tem_json_res)
              { 
                  $str_zip   = "";
                  $Arq_res   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['json_res_file']['json'];
                  $Arq_input = (FALSE !== strpos($Arq_res, ' ')) ? " \"" . $Arq_res . "\"" :  $Arq_res;
                  if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
                  {
                      $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j -u " . $this->Json_password . " " . $Zip_f . " " . $Arq_input;
                  }
                  elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
                  {
                      $str_zip = "./7za " . $Parm_pass . $this->Json_password . " a " . $Zip_f . " " . $Arq_input;
                  }
                  elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
                  {
                      $str_zip = "./7za " . $Parm_pass . $this->Json_password . " a " . $Zip_f . " " . $Arq_input;
                  }
                  if (!empty($str_zip)) {
                      exec($str_zip);
                  }
                  // ----- ZIP log
                  $fp = @fopen(trim(str_replace(array(".zip",'"'), array(".log",""), $Zip_f)), 'a');
                  if ($fp)
                  {
                      @fwrite($fp, $str_zip . "\r\n\r\n");
                      @fclose($fp);
                  }
                  unlink($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['json_res_file']['json']);
              }
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['json_res_grid']);
          } 
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- record
   function NM_export_record()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->record, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['record'])) ? $this->New_label['record'] : "" . $this->Ini->Nm_lang['lang_ado_records_fld_Record'] . ""; 
         }
         else
         {
             $SC_Label = "record"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->record;
   }
   //----- uid
   function NM_export_uid()
   {
         $this->uid = NM_charset_to_utf8($this->uid);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['uid'])) ? $this->New_label['uid'] : "" . $this->Ini->Nm_lang['lang_ado_records_fld_Uid'] . ""; 
         }
         else
         {
             $SC_Label = "uid"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->uid;
   }
   //----- startingdate
   function NM_export_startingdate()
   {
         if ($this->Json_format)
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
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['startingdate'])) ? $this->New_label['startingdate'] : "" . $this->Ini->Nm_lang['lang_ado_records_fld_StartingDate'] . ""; 
         }
         else
         {
             $SC_Label = "startingdate"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->startingdate;
   }
   //----- creationdate
   function NM_export_creationdate()
   {
         if ($this->Json_format)
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
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['creationdate'])) ? $this->New_label['creationdate'] : "" . $this->Ini->Nm_lang['lang_ado_records_fld_CreationDate'] . ""; 
         }
         else
         {
             $SC_Label = "creationdate"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->creationdate;
   }
   //----- creationip
   function NM_export_creationip()
   {
         $this->creationip = NM_charset_to_utf8($this->creationip);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['creationip'])) ? $this->New_label['creationip'] : "" . $this->Ini->Nm_lang['lang_ado_records_fld_CreationIP'] . ""; 
         }
         else
         {
             $SC_Label = "creationip"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->creationip;
   }
   //----- documenttype
   function NM_export_documenttype()
   {
         $this->documenttype = NM_charset_to_utf8($this->documenttype);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['documenttype'])) ? $this->New_label['documenttype'] : "" . $this->Ini->Nm_lang['lang_ado_records_fld_DocumentType'] . ""; 
         }
         else
         {
             $SC_Label = "documenttype"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->documenttype;
   }
   //----- idnumber
   function NM_export_idnumber()
   {
         $this->idnumber = NM_charset_to_utf8($this->idnumber);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['idnumber'])) ? $this->New_label['idnumber'] : "" . $this->Ini->Nm_lang['lang_ado_records_fld_IdNumber'] . ""; 
         }
         else
         {
             $SC_Label = "idnumber"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->idnumber;
   }
   //----- firstname
   function NM_export_firstname()
   {
         $this->firstname = NM_charset_to_utf8($this->firstname);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['firstname'])) ? $this->New_label['firstname'] : "" . $this->Ini->Nm_lang['lang_ado_records_fld_FirstName'] . ""; 
         }
         else
         {
             $SC_Label = "firstname"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->firstname;
   }
   //----- secondname
   function NM_export_secondname()
   {
         $this->secondname = NM_charset_to_utf8($this->secondname);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['secondname'])) ? $this->New_label['secondname'] : "" . $this->Ini->Nm_lang['lang_ado_records_fld_SecondName'] . ""; 
         }
         else
         {
             $SC_Label = "secondname"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->secondname;
   }
   //----- firstsurname
   function NM_export_firstsurname()
   {
         $this->firstsurname = NM_charset_to_utf8($this->firstsurname);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['firstsurname'])) ? $this->New_label['firstsurname'] : "" . $this->Ini->Nm_lang['lang_ado_records_fld_FirstSurname'] . ""; 
         }
         else
         {
             $SC_Label = "firstsurname"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->firstsurname;
   }
   //----- secondsurname
   function NM_export_secondsurname()
   {
         $this->secondsurname = NM_charset_to_utf8($this->secondsurname);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['secondsurname'])) ? $this->New_label['secondsurname'] : "" . $this->Ini->Nm_lang['lang_ado_records_fld_SecondSurname'] . ""; 
         }
         else
         {
             $SC_Label = "secondsurname"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->secondsurname;
   }
   //----- gender
   function NM_export_gender()
   {
         $this->look_gender = NM_charset_to_utf8($this->look_gender);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['gender'])) ? $this->New_label['gender'] : "" . $this->Ini->Nm_lang['lang_ado_records_fld_Gender'] . ""; 
         }
         else
         {
             $SC_Label = "gender"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->look_gender;
   }
   //----- birthdate
   function NM_export_birthdate()
   {
         if ($this->Json_format)
         {
             $conteudo_x =  $this->birthdate;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->birthdate, "YYYY-MM-DD  ");
                 $this->birthdate = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['birthdate'])) ? $this->New_label['birthdate'] : "" . $this->Ini->Nm_lang['lang_ado_records_fld_BirthDate'] . ""; 
         }
         else
         {
             $SC_Label = "birthdate"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->birthdate;
   }
   //----- placebirth
   function NM_export_placebirth()
   {
         $this->placebirth = NM_charset_to_utf8($this->placebirth);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['placebirth'])) ? $this->New_label['placebirth'] : "" . $this->Ini->Nm_lang['lang_ado_records_fld_PlaceBirth'] . ""; 
         }
         else
         {
             $SC_Label = "placebirth"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->placebirth;
   }
   //----- transactiontype
   function NM_export_transactiontype()
   {
         $this->transactiontype = NM_charset_to_utf8($this->transactiontype);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['transactiontype'])) ? $this->New_label['transactiontype'] : "" . $this->Ini->Nm_lang['lang_ado_records_fld_TransactionType'] . ""; 
         }
         else
         {
             $SC_Label = "transactiontype"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->transactiontype;
   }
   //----- transactiontypename
   function NM_export_transactiontypename()
   {
         $this->transactiontypename = NM_charset_to_utf8($this->transactiontypename);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['transactiontypename'])) ? $this->New_label['transactiontypename'] : "" . $this->Ini->Nm_lang['lang_ado_records_fld_TransactionTypeName'] . ""; 
         }
         else
         {
             $SC_Label = "transactiontypename"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->transactiontypename;
   }
   //----- issuedate
   function NM_export_issuedate()
   {
         if ($this->Json_format)
         {
             $conteudo_x =  $this->issuedate;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->issuedate, "YYYY-MM-DD  ");
                 $this->issuedate = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['issuedate'])) ? $this->New_label['issuedate'] : "" . $this->Ini->Nm_lang['lang_ado_records_fld_IssueDate'] . ""; 
         }
         else
         {
             $SC_Label = "issuedate"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->issuedate;
   }
   //----- adoprojectid
   function NM_export_adoprojectid()
   {
         $this->adoprojectid = NM_charset_to_utf8($this->adoprojectid);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['adoprojectid'])) ? $this->New_label['adoprojectid'] : "" . $this->Ini->Nm_lang['lang_ado_records_fld_AdoProjectId'] . ""; 
         }
         else
         {
             $SC_Label = "adoprojectid"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->adoprojectid;
   }
   //----- transactionid
   function NM_export_transactionid()
   {
         $this->transactionid = NM_charset_to_utf8($this->transactionid);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['transactionid'])) ? $this->New_label['transactionid'] : "" . $this->Ini->Nm_lang['lang_ado_records_fld_TransactionId'] . ""; 
         }
         else
         {
             $SC_Label = "transactionid"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->transactionid;
   }
   //----- productid
   function NM_export_productid()
   {
         $this->productid = NM_charset_to_utf8($this->productid);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['productid'])) ? $this->New_label['productid'] : "" . $this->Ini->Nm_lang['lang_ado_records_fld_ProductId'] . ""; 
         }
         else
         {
             $SC_Label = "productid"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->productid;
   }
   //----- resultcomparationfaces
   function NM_export_resultcomparationfaces()
   {
         $this->resultcomparationfaces = NM_charset_to_utf8($this->resultcomparationfaces);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['resultcomparationfaces'])) ? $this->New_label['resultcomparationfaces'] : "" . $this->Ini->Nm_lang['lang_ado_records_fld_ResultComparationFaces'] . ""; 
         }
         else
         {
             $SC_Label = "resultcomparationfaces"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->resultcomparationfaces;
   }
   //----- comparationfacesaproved
   function NM_export_comparationfacesaproved()
   {
         $this->comparationfacesaproved = NM_charset_to_utf8($this->comparationfacesaproved);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['comparationfacesaproved'])) ? $this->New_label['comparationfacesaproved'] : "" . $this->Ini->Nm_lang['lang_ado_records_fld_ComparationFacesAproved'] . ""; 
         }
         else
         {
             $SC_Label = "comparationfacesaproved"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->comparationfacesaproved;
   }
   //----- extras
   function NM_export_extras()
   {
         $this->extras = NM_charset_to_utf8($this->extras);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['extras'])) ? $this->New_label['extras'] : "" . $this->Ini->Nm_lang['lang_ado_records_fld_Extras'] . ""; 
         }
         else
         {
             $SC_Label = "extras"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->extras;
   }
   //----- response_ani
   function NM_export_response_ani()
   {
         $this->response_ani = NM_charset_to_utf8($this->response_ani);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['response_ani'])) ? $this->New_label['response_ani'] : "" . $this->Ini->Nm_lang['lang_ado_records_fld_Response_ANI'] . ""; 
         }
         else
         {
             $SC_Label = "response_ani"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->response_ani;
   }
   //----- photo
   function NM_export_photo()
   {
         $this->photo = NM_charset_to_utf8($this->photo);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['photo'])) ? $this->New_label['photo'] : "Photo"; 
         }
         else
         {
             $SC_Label = "photo"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->photo;
   }
   //----- urlimgs
   function NM_export_urlimgs()
   {
         $this->urlimgs = NM_charset_to_utf8($this->urlimgs);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['urlimgs'])) ? $this->New_label['urlimgs'] : "urlimgs"; 
         }
         else
         {
             $SC_Label = "urlimgs"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->urlimgs;
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
   function progress_bar_end()
   {
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['json_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['json_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records'][$path_doc_md5][1] = $this->Tit_doc;
      $Mens_bar = $this->Ini->Nm_lang['lang_othr_file_msge'];
      if ($_SESSION['scriptcase']['charset'] != "UTF-8") {
          $Mens_bar = sc_convert_encoding($Mens_bar, "UTF-8", $_SESSION['scriptcase']['charset']);
      }
      $this->pb->setProgressbarMessage($Mens_bar);
      $this->pb->setDownloadLink($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $this->pb->setDownloadMd5($path_doc_md5);
      $this->pb->completed();
   }
   function monta_html()
   {
      global $nm_url_saida, $nm_lang;
      include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['json_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['json_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_chart_title'] ?> <?php echo $this->Ini->Nm_lang['lang_tbl_ado_records'] ?> :: JSON</TITLE>
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
   <td class="scExportTitle" style="height: 25px">JSON</td>
  </tr>
  <tr>
   <td class="scExportLine" style="width: 100%">
    <table style="border-collapse: collapse; border-width: 0; width: 100%"><tr><td class="scExportLineFont" style="padding: 3px 0 0 0" id="idMessage">
    <?php echo $this->Ini->Nm_lang['lang_othr_file_msge'] ?>
    </td><td class="scExportLineFont" style="text-align:right; padding: 3px 0 0 0">
     <?php echo nmButtonOutput($this->arr_buttons, "bdownload", "document.Fdown.submit()", "document.Fdown.submit()", "idBtnDown", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
 ?>
     <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F0.submit()", "document.F0.submit()", "idBtnBack", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
 ?>
    </td></tr></table>
   </td>
  </tr>
 </table>
</td></tr></table>
<form name="Fview" method="get" action="<?php echo $this->Ini->path_imag_temp . "/" . $this->Arquivo_view ?>" target="_blank" style="display: none"> 
</form>
<form name="Fdown" method="get" action="pdfreport_ado_records_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="pdfreport_ado_records"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./" style="display: none"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="<?php echo NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['json_return']); ?>"> 
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
