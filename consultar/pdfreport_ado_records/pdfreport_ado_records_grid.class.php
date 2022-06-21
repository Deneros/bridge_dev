<?php
class pdfreport_ado_records_grid
{
   var $Ini;
   var $Erro;
   var $Pdf;
   var $Db;
   var $rs_grid;
   var $nm_grid_sem_reg;
   var $SC_seq_register;
   var $nm_location;
   var $nm_data;
   var $nm_cod_barra;
   var $sc_proc_grid; 
   var $nmgp_botoes = array();
   var $Campos_Mens_erro;
   var $NM_raiz_img; 
   var $Font_ttf; 
   var $photo = array();
   var $urlimgs = array();
   var $record = array();
   var $uid = array();
   var $startingdate = array();
   var $creationdate = array();
   var $creationip = array();
   var $documenttype = array();
   var $idnumber = array();
   var $firstname = array();
   var $secondname = array();
   var $firstsurname = array();
   var $secondsurname = array();
   var $gender = array();
   var $birthdate = array();
   var $placebirth = array();
   var $transactiontype = array();
   var $transactiontypename = array();
   var $issuedate = array();
   var $adoprojectid = array();
   var $transactionid = array();
   var $productid = array();
   var $resultcomparationfaces = array();
   var $comparationfacesaproved = array();
   var $extras = array();
   var $response_ani = array();
   var $look_gender = array();
//--- 
 function monta_grid($linhas = 0)
 {

   clearstatcache();
   $this->inicializa();
   $this->grid();
 }
//--- 
 function inicializa()
 {
   global $nm_saida, 
   $rec, $nmgp_chave, $nmgp_opcao, $nmgp_ordem, $nmgp_chave_det, 
   $nmgp_quant_linhas, $nmgp_quant_colunas, $nmgp_url_saida, $nmgp_parms;
//
   $this->nm_data = new nm_data("es");
   include_once("../_lib/lib/php/nm_font_tcpdf.php");
   $this->default_font = 'helvetica';
   $this->default_font_sr  = '';
   $this->default_style    = '';
   $this->default_style_sr = 'B';
   $Tp_papel = "LETTER";
   $old_dir = getcwd();
   $File_font_ttf     = "";
   $temp_font_ttf     = "";
   $this->Font_ttf    = false;
   $this->Font_ttf_sr = false;
   if (empty($this->default_font) && isset($arr_font_tcpdf[$this->Ini->str_lang]))
   {
       $this->default_font = $arr_font_tcpdf[$this->Ini->str_lang];
   }
   elseif (empty($this->default_font))
   {
       $this->default_font = "Times";
   }
   if (empty($this->default_font_sr) && isset($arr_font_tcpdf[$this->Ini->str_lang]))
   {
       $this->default_font_sr = $arr_font_tcpdf[$this->Ini->str_lang];
   }
   elseif (empty($this->default_font_sr))
   {
       $this->default_font_sr = "Times";
   }
   $_SESSION['scriptcase']['pdfreport_ado_records']['default_font'] = $this->default_font;
   chdir($this->Ini->path_third . "/tcpdf/");
   include_once("tcpdf.php");
   chdir($old_dir);
   $this->Pdf = new TCPDF('P', 'mm', $Tp_papel, true, 'UTF-8', false);
   $this->Pdf->setPrintHeader(false);
   $this->Pdf->setPrintFooter(false);
   if (!empty($File_font_ttf))
   {
       $this->Pdf->addTTFfont($File_font_ttf, "", "", 32, $_SESSION['scriptcase']['dir_temp'] . "/");
   }
   $this->Pdf->SetDisplayMode('real');
   $this->aba_iframe = false;
   if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
   {
       foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
       {
           if (in_array("pdfreport_ado_records", $apls_aba))
           {
               $this->aba_iframe = true;
               break;
           }
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
   {
       $this->aba_iframe = true;
   }
   $this->nmgp_botoes['exit'] = "on";
   $this->sc_proc_grid = false; 
   $this->NM_raiz_img = $this->Ini->root;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   $this->nm_where_dinamico = "";
   $this->nm_grid_colunas = 0;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['campos_busca']))
   { 
       $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['campos_busca'];
       if ($_SESSION['scriptcase']['charset'] != "UTF-8")
       {
           $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
       }
       $this->record[0] = $Busca_temp['record']; 
       $tmp_pos = strpos($this->record[0], "##@@");
       if ($tmp_pos !== false && !is_array($this->record[0]))
       {
           $this->record[0] = substr($this->record[0], 0, $tmp_pos);
       }
       $this->uid[0] = $Busca_temp['uid']; 
       $tmp_pos = strpos($this->uid[0], "##@@");
       if ($tmp_pos !== false && !is_array($this->uid[0]))
       {
           $this->uid[0] = substr($this->uid[0], 0, $tmp_pos);
       }
       $this->startingdate[0] = $Busca_temp['startingdate']; 
       $tmp_pos = strpos($this->startingdate[0], "##@@");
       if ($tmp_pos !== false && !is_array($this->startingdate[0]))
       {
           $this->startingdate[0] = substr($this->startingdate[0], 0, $tmp_pos);
       }
       $startingdate_2 = $Busca_temp['startingdate_input_2']; 
       $this->startingdate_2 = $Busca_temp['startingdate_input_2']; 
       $this->creationdate[0] = $Busca_temp['creationdate']; 
       $tmp_pos = strpos($this->creationdate[0], "##@@");
       if ($tmp_pos !== false && !is_array($this->creationdate[0]))
       {
           $this->creationdate[0] = substr($this->creationdate[0], 0, $tmp_pos);
       }
       $creationdate_2 = $Busca_temp['creationdate_input_2']; 
       $this->creationdate_2 = $Busca_temp['creationdate_input_2']; 
       $this->response_ani[0] = $Busca_temp['response_ani']; 
       $tmp_pos = strpos($this->response_ani[0], "##@@");
       if ($tmp_pos !== false && !is_array($this->response_ani[0]))
       {
           $this->response_ani[0] = substr($this->response_ani[0], 0, $tmp_pos);
       }
   } 
   else 
   { 
       $this->startingdate_2 = ""; 
       $this->creationdate_2 = ""; 
   } 
   $this->nm_field_dinamico = array();
   $this->nm_order_dinamico = array();
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['where_pesq_filtro'];
   $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
   $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
   $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
   $_SESSION['scriptcase']['contr_link_emb'] = $this->nm_location;
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['qt_col_grid'] = 1 ;  
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['pdfreport_ado_records']['cols']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['pdfreport_ado_records']['cols']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['qt_col_grid'] = $_SESSION['scriptcase']['sc_apl_conf']['pdfreport_ado_records']['cols'];  
       unset($_SESSION['scriptcase']['sc_apl_conf']['pdfreport_ado_records']['cols']);
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['ordem_select']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['ordem_select'] = array(); 
   } 
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['ordem_quebra']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['ordem_grid'] = "" ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['ordem_ant']  = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['ordem_desc'] = "" ; 
   }   
   if (!empty($nmgp_parms) && $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['opcao'] != "pdf")   
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['opcao'] = "igual";
       $rec = "ini";
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['where_orig']) || $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['prim_cons'] || !empty($nmgp_parms))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['prim_cons'] = false;  
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['where_orig'] = " where TransactionId=" . $_SESSION['nuTransacion'] . "";  
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['where_pesq']        = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['where_pesq_ant']    = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['cond_pesq']         = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['where_pesq_filtro'] = "";
   }   
   if  (!empty($this->nm_where_dinamico)) 
   {   
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['where_pesq'] .= $this->nm_where_dinamico;
   }   
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['where_pesq_filtro'];
//
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['tot_geral'][1])) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['sc_total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['tot_geral'][1] ;  
   }
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['where_pesq_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['where_pesq'];  
//----- 
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
   $nmgp_order_by = ""; 
   $campos_order_select = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['ordem_select'] as $campo => $ordem) 
   {
        if ($campo != $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['ordem_grid']) 
        {
           if (!empty($campos_order_select)) 
           {
               $campos_order_select .= ", ";
           }
           $campos_order_select .= $campo . " " . $ordem;
        }
   }
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['ordem_grid'])) 
   { 
       $nmgp_order_by = " order by " . $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['ordem_grid'] . $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['ordem_desc']; 
   } 
   if (!empty($campos_order_select)) 
   { 
       if (!empty($nmgp_order_by)) 
       { 
          $nmgp_order_by .= ", " . $campos_order_select; 
       } 
       else 
       { 
          $nmgp_order_by = " order by $campos_order_select"; 
       } 
   } 
   $nmgp_select .= $nmgp_order_by; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['order_grid'] = $nmgp_order_by;
   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
   $this->rs_grid = $this->Db->Execute($nmgp_select) ; 
   if ($this->rs_grid === false && !$this->rs_grid->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
   { 
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit ; 
   }  
   if ($this->rs_grid->EOF || ($this->rs_grid === false && $GLOBALS["NM_ERRO_IBASE"] == 1)) 
   { 
       $this->nm_grid_sem_reg = $this->SC_conv_utf8($this->Ini->Nm_lang['lang_errm_empt']); 
   }  
// 
 }  
// 
 function Pdf_init()
 {
     if ($_SESSION['scriptcase']['reg_conf']['css_dir'] == "RTL")
     {
         $this->Pdf->setRTL(true);
     }
     $this->Pdf->setHeaderMargin(0);
     $this->Pdf->setFooterMargin(0);
     $this->Pdf->setCellMargins($left = 15, $top = 30, $right = 15, $bottom = 15);
     $this->Pdf->SetAutoPageBreak(true, 15);
     if ($this->Font_ttf)
     {
         $this->Pdf->SetFont($this->default_font, $this->default_style, 8, $this->def_TTF);
     }
     else
     {
         $this->Pdf->SetFont($this->default_font, $this->default_style, 8);
     }
     $this->Pdf->SetTextColor(0, 0, 0);
 }
// 
 function Pdf_image()
 {
   if ($_SESSION['scriptcase']['reg_conf']['css_dir'] == "RTL")
   {
       $this->Pdf->setRTL(false);
   }
   $SV_margin = $this->Pdf->getBreakMargin();
   $SV_auto_page_break = $this->Pdf->getAutoPageBreak();
   $this->Pdf->SetAutoPageBreak(false, 0);
   $this->Pdf->Image($this->NM_raiz_img . $this->Ini->path_img_global . "/grp__NM__img__NM__logoempresa-707_100.png", "10.000000", "140.000000", "0", "0", '', '', '', false, 300, '', false, false, 0);
   $this->Pdf->SetAutoPageBreak($SV_auto_page_break, $SV_margin);
   $this->Pdf->setPageMark();
   if ($_SESSION['scriptcase']['reg_conf']['css_dir'] == "RTL")
   {
       $this->Pdf->setRTL(true);
   }
 }
// 
//----- 
 function grid($linhas = 0)
 {
    global 
           $nm_saida, $nm_url_saida;
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['labels']['record'] = "{lang_ado_records_fld_Record}";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['labels']['uid'] = "{lang_ado_records_fld_Uid}";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['labels']['startingdate'] = "{lang_ado_records_fld_StartingDate}";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['labels']['creationdate'] = "{lang_ado_records_fld_CreationDate}";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['labels']['creationip'] = "{lang_ado_records_fld_CreationIP}";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['labels']['documenttype'] = "{lang_ado_records_fld_DocumentType}";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['labels']['idnumber'] = "{lang_ado_records_fld_IdNumber}";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['labels']['firstname'] = "{lang_ado_records_fld_FirstName}";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['labels']['secondname'] = "{lang_ado_records_fld_SecondName}";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['labels']['firstsurname'] = "{lang_ado_records_fld_FirstSurname}";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['labels']['secondsurname'] = "{lang_ado_records_fld_SecondSurname}";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['labels']['gender'] = "{lang_ado_records_fld_Gender}";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['labels']['birthdate'] = "{lang_ado_records_fld_BirthDate}";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['labels']['placebirth'] = "{lang_ado_records_fld_PlaceBirth}";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['labels']['transactiontype'] = "{lang_ado_records_fld_TransactionType}";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['labels']['transactiontypename'] = "{lang_ado_records_fld_TransactionTypeName}";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['labels']['issuedate'] = "{lang_ado_records_fld_IssueDate}";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['labels']['adoprojectid'] = "{lang_ado_records_fld_AdoProjectId}";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['labels']['transactionid'] = "{lang_ado_records_fld_TransactionId}";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['labels']['productid'] = "{lang_ado_records_fld_ProductId}";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['labels']['resultcomparationfaces'] = "{lang_ado_records_fld_ResultComparationFaces}";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['labels']['comparationfacesaproved'] = "{lang_ado_records_fld_ComparationFacesAproved}";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['labels']['extras'] = "{lang_ado_records_fld_Extras}";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['labels']['response_ani'] = "{lang_ado_records_fld_Response_ANI}";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['labels']['photo'] = "Photo";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['labels']['urlimgs'] = "urlimgs";
   $HTTP_REFERER = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['seq_dir'] = 0; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['sub_dir'] = array(); 
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['where_pesq_filtro'];
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['pdfreport_ado_records']['lig_edit']) && $_SESSION['scriptcase']['sc_apl_conf']['pdfreport_ado_records']['lig_edit'] != '')
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['mostra_edit'] = $_SESSION['scriptcase']['sc_apl_conf']['pdfreport_ado_records']['lig_edit'];
   }
   if (!empty($this->nm_grid_sem_reg))
   {
       $this->Pdf_init();
       $this->Pdf->AddPage();
       if ($this->Font_ttf_sr)
       {
           $this->Pdf->SetFont($this->default_font_sr, 'B', 12, $this->def_TTF);
       }
       else
       {
           $this->Pdf->SetFont($this->default_font_sr, 'B', 12);
       }
       $this->Pdf->Text(10, 10, html_entity_decode($this->nm_grid_sem_reg, ENT_COMPAT, $_SESSION['scriptcase']['charset']));
       $this->Pdf->Output($this->Ini->root . $this->Ini->nm_path_pdf, 'F');
       return;
   }
// 
   $Init_Pdf = true;
   $this->SC_seq_register = 0; 
   while (!$this->rs_grid->EOF) 
   {  
      $this->nm_grid_colunas = 0; 
      $nm_quant_linhas = 0;
      $this->Pdf->setImageScale(1.33);
      $this->Pdf->AddPage();
      $this->Pdf_init();
      $this->Pdf_image();
      while (!$this->rs_grid->EOF && $nm_quant_linhas < $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_ado_records']['qt_col_grid']) 
      {  
          $this->sc_proc_grid = true;
          $this->SC_seq_register++; 
          $this->record[$this->nm_grid_colunas] = $this->rs_grid->fields[0] ;  
          $this->record[$this->nm_grid_colunas] = (string)$this->record[$this->nm_grid_colunas];
          $this->uid[$this->nm_grid_colunas] = $this->rs_grid->fields[1] ;  
          $this->startingdate[$this->nm_grid_colunas] = $this->rs_grid->fields[2] ;  
          $this->creationdate[$this->nm_grid_colunas] = $this->rs_grid->fields[3] ;  
          $this->creationip[$this->nm_grid_colunas] = $this->rs_grid->fields[4] ;  
          $this->documenttype[$this->nm_grid_colunas] = $this->rs_grid->fields[5] ;  
          $this->idnumber[$this->nm_grid_colunas] = $this->rs_grid->fields[6] ;  
          $this->firstname[$this->nm_grid_colunas] = $this->rs_grid->fields[7] ;  
          $this->secondname[$this->nm_grid_colunas] = $this->rs_grid->fields[8] ;  
          $this->firstsurname[$this->nm_grid_colunas] = $this->rs_grid->fields[9] ;  
          $this->secondsurname[$this->nm_grid_colunas] = $this->rs_grid->fields[10] ;  
          $this->gender[$this->nm_grid_colunas] = $this->rs_grid->fields[11] ;  
          $this->birthdate[$this->nm_grid_colunas] = $this->rs_grid->fields[12] ;  
          $this->placebirth[$this->nm_grid_colunas] = $this->rs_grid->fields[13] ;  
          $this->transactiontype[$this->nm_grid_colunas] = $this->rs_grid->fields[14] ;  
          $this->transactiontypename[$this->nm_grid_colunas] = $this->rs_grid->fields[15] ;  
          $this->issuedate[$this->nm_grid_colunas] = $this->rs_grid->fields[16] ;  
          $this->adoprojectid[$this->nm_grid_colunas] = $this->rs_grid->fields[17] ;  
          $this->transactionid[$this->nm_grid_colunas] = $this->rs_grid->fields[18] ;  
          $this->productid[$this->nm_grid_colunas] = $this->rs_grid->fields[19] ;  
          $this->resultcomparationfaces[$this->nm_grid_colunas] = $this->rs_grid->fields[20] ;  
          $this->comparationfacesaproved[$this->nm_grid_colunas] = $this->rs_grid->fields[21] ;  
          $this->extras[$this->nm_grid_colunas] = $this->rs_grid->fields[22] ;  
          $this->response_ani[$this->nm_grid_colunas] = $this->rs_grid->fields[23] ;  
          $this->look_gender[$this->nm_grid_colunas] = $this->gender[$this->nm_grid_colunas]; 
   $this->Lookup->lookup_gender($this->look_gender[$this->nm_grid_colunas]); 
          $this->photo[$this->nm_grid_colunas] = "";
          $this->urlimgs[$this->nm_grid_colunas] = "";
          $_SESSION['scriptcase']['pdfreport_ado_records']['contr_erro'] = 'on';
 settype($sbRuta,"string");
settype($sbSql,"string");

$sbSql = "SELECT valor FROM parametros WHERE idparametro='url_imagenes'";
 
      $nm_select = $sbSql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rcParametros[$this->nm_grid_colunas] = array();
      $this->rcparametros[$this->nm_grid_colunas] = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rcParametros[$this->nm_grid_colunas][$SCy] [$SCx] = $SCrx->fields[$SCx];
                        $this->rcparametros[$this->nm_grid_colunas][$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rcParametros[$this->nm_grid_colunas] = false;
          $this->rcParametros_erro[$this->nm_grid_colunas] = $this->Db->ErrorMsg();
          $this->rcparametros[$this->nm_grid_colunas] = false;
          $this->rcparametros_erro[$this->nm_grid_colunas] = $this->Db->ErrorMsg();
      } 
;

$sbRuta = $this->rcParametros[$this->nm_grid_colunas][0][0].$this->idnumber[$this->nm_grid_colunas] ."/".$this->transactionid[$this->nm_grid_colunas] ."/clientFace.png"; 
$this->urlimgs[$this->nm_grid_colunas]  = $sbRuta;

if(($this->comparationfacesaproved[$this->nm_grid_colunas] ==0) || ($this->comparationfacesaproved[$this->nm_grid_colunas] =="0")){
   $this->comparationfacesaproved[$this->nm_grid_colunas]  = "Falso";
}
elseif(($this->comparationfacesaproved[$this->nm_grid_colunas] ==1) || ($this->comparationfacesaproved[$this->nm_grid_colunas] =="1")){
   $this->comparationfacesaproved[$this->nm_grid_colunas]  = "Verdadero";
}
if(($this->resultcomparationfaces[$this->nm_grid_colunas] ==0) || ($this->resultcomparationfaces[$this->nm_grid_colunas] =="0")){
   $this->resultcomparationfaces[$this->nm_grid_colunas]  = "Falso";
}
elseif(($this->resultcomparationfaces[$this->nm_grid_colunas] ==1) || ($this->resultcomparationfaces[$this->nm_grid_colunas] =="1")){
   $this->resultcomparationfaces[$this->nm_grid_colunas]  = "Verdadero";
}

$rcExtras = explode(",",$this->extras[$this->nm_grid_colunas] );
$sbCodigo = str_replace("IdState:","",$rcExtras[0]);
$sbNombre = ltrim(str_replace("StateName:","",$rcExtras[1]));
$this->extras[$this->nm_grid_colunas] =$sbCodigo."-".$sbNombre;

if($this->transactiontypename[$this->nm_grid_colunas] =="Verify"){
	$this->nmgp_cmp_hidden["response_ani"] = "off";
	$this->response_ani[$this->nm_grid_colunas]  = "No aplica";
}

if($this->transactiontypename[$this->nm_grid_colunas] =="Verify"){
   $this->response_ani[$this->nm_grid_colunas]  = "No aplica";
}
elseif($this->transactiontypename[$this->nm_grid_colunas] =="Enroll" && !empty($this->response_ani[$this->nm_grid_colunas] )){
   $sbANI = $this->response_ani[$this->nm_grid_colunas] ;
   $sbANI = str_replace(",","<br>",$sbANI);
   $this->response_ani[$this->nm_grid_colunas]  = $sbANI;
}
else{
   $this->response_ani[$this->nm_grid_colunas]  = "No aplica";
}
$_SESSION['scriptcase']['pdfreport_ado_records']['contr_erro'] = 'off';
          $this->record[$this->nm_grid_colunas] = sc_strip_script($this->record[$this->nm_grid_colunas]);
          if ($this->record[$this->nm_grid_colunas] === "") 
          { 
              $this->record[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->record[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $this->record[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->record[$this->nm_grid_colunas]);
          $this->uid[$this->nm_grid_colunas] = sc_strip_script($this->uid[$this->nm_grid_colunas]);
          if ($this->uid[$this->nm_grid_colunas] === "") 
          { 
              $this->uid[$this->nm_grid_colunas] = "" ;  
          } 
          $this->uid[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->uid[$this->nm_grid_colunas]);
          $this->startingdate[$this->nm_grid_colunas] = sc_strip_script($this->startingdate[$this->nm_grid_colunas]);
          if ($this->startingdate[$this->nm_grid_colunas] === "") 
          { 
              $this->startingdate[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
               if (substr($this->startingdate[$this->nm_grid_colunas], 10, 1) == "-") 
               { 
                  $this->startingdate[$this->nm_grid_colunas] = substr($this->startingdate[$this->nm_grid_colunas], 0, 10) . " " . substr($this->startingdate[$this->nm_grid_colunas], 11);
               } 
               if (substr($this->startingdate[$this->nm_grid_colunas], 13, 1) == ".") 
               { 
                  $this->startingdate[$this->nm_grid_colunas] = substr($this->startingdate[$this->nm_grid_colunas], 0, 13) . ":" . substr($this->startingdate[$this->nm_grid_colunas], 14, 2) . ":" . substr($this->startingdate[$this->nm_grid_colunas], 17);
               } 
               $startingdate_x =  $this->startingdate[$this->nm_grid_colunas];
               nm_conv_limpa_dado($startingdate_x, "YYYY-MM-DD HH:II:SS");
               if (is_numeric($startingdate_x) && strlen($startingdate_x) > 0) 
               { 
                   $this->nm_data->SetaData($this->startingdate[$this->nm_grid_colunas], "YYYY-MM-DD HH:II:SS");
                   $this->startingdate[$this->nm_grid_colunas] = html_entity_decode($this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "ddmmaaaa;hhiiss")), ENT_COMPAT, $_SESSION['scriptcase']['charset']);
               } 
          } 
          $this->startingdate[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->startingdate[$this->nm_grid_colunas]);
          $this->creationdate[$this->nm_grid_colunas] = sc_strip_script($this->creationdate[$this->nm_grid_colunas]);
          if ($this->creationdate[$this->nm_grid_colunas] === "") 
          { 
              $this->creationdate[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
               if (substr($this->creationdate[$this->nm_grid_colunas], 10, 1) == "-") 
               { 
                  $this->creationdate[$this->nm_grid_colunas] = substr($this->creationdate[$this->nm_grid_colunas], 0, 10) . " " . substr($this->creationdate[$this->nm_grid_colunas], 11);
               } 
               if (substr($this->creationdate[$this->nm_grid_colunas], 13, 1) == ".") 
               { 
                  $this->creationdate[$this->nm_grid_colunas] = substr($this->creationdate[$this->nm_grid_colunas], 0, 13) . ":" . substr($this->creationdate[$this->nm_grid_colunas], 14, 2) . ":" . substr($this->creationdate[$this->nm_grid_colunas], 17);
               } 
               $creationdate_x =  $this->creationdate[$this->nm_grid_colunas];
               nm_conv_limpa_dado($creationdate_x, "YYYY-MM-DD HH:II:SS");
               if (is_numeric($creationdate_x) && strlen($creationdate_x) > 0) 
               { 
                   $this->nm_data->SetaData($this->creationdate[$this->nm_grid_colunas], "YYYY-MM-DD HH:II:SS");
                   $this->creationdate[$this->nm_grid_colunas] = html_entity_decode($this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "ddmmaaaa;hhiiss")), ENT_COMPAT, $_SESSION['scriptcase']['charset']);
               } 
          } 
          $this->creationdate[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->creationdate[$this->nm_grid_colunas]);
          $this->creationip[$this->nm_grid_colunas] = sc_strip_script($this->creationip[$this->nm_grid_colunas]);
          if ($this->creationip[$this->nm_grid_colunas] === "") 
          { 
              $this->creationip[$this->nm_grid_colunas] = "" ;  
          } 
          $this->creationip[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->creationip[$this->nm_grid_colunas]);
          $this->documenttype[$this->nm_grid_colunas] = sc_strip_script($this->documenttype[$this->nm_grid_colunas]);
          if ($this->documenttype[$this->nm_grid_colunas] === "") 
          { 
              $this->documenttype[$this->nm_grid_colunas] = "" ;  
          } 
          $this->documenttype[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->documenttype[$this->nm_grid_colunas]);
          $this->idnumber[$this->nm_grid_colunas] = sc_strip_script($this->idnumber[$this->nm_grid_colunas]);
          if ($this->idnumber[$this->nm_grid_colunas] === "") 
          { 
              $this->idnumber[$this->nm_grid_colunas] = "" ;  
          } 
          $this->idnumber[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->idnumber[$this->nm_grid_colunas]);
          $this->firstname[$this->nm_grid_colunas] = sc_strip_script($this->firstname[$this->nm_grid_colunas]);
          if ($this->firstname[$this->nm_grid_colunas] === "") 
          { 
              $this->firstname[$this->nm_grid_colunas] = "" ;  
          } 
          $this->firstname[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->firstname[$this->nm_grid_colunas]);
          $this->secondname[$this->nm_grid_colunas] = sc_strip_script($this->secondname[$this->nm_grid_colunas]);
          if ($this->secondname[$this->nm_grid_colunas] === "") 
          { 
              $this->secondname[$this->nm_grid_colunas] = "" ;  
          } 
          $this->secondname[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->secondname[$this->nm_grid_colunas]);
          $this->firstsurname[$this->nm_grid_colunas] = sc_strip_script($this->firstsurname[$this->nm_grid_colunas]);
          if ($this->firstsurname[$this->nm_grid_colunas] === "") 
          { 
              $this->firstsurname[$this->nm_grid_colunas] = "" ;  
          } 
          $this->firstsurname[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->firstsurname[$this->nm_grid_colunas]);
          $this->secondsurname[$this->nm_grid_colunas] = sc_strip_script($this->secondsurname[$this->nm_grid_colunas]);
          if ($this->secondsurname[$this->nm_grid_colunas] === "") 
          { 
              $this->secondsurname[$this->nm_grid_colunas] = "" ;  
          } 
          $this->secondsurname[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->secondsurname[$this->nm_grid_colunas]);
          $this->gender[$this->nm_grid_colunas] = trim(sc_strip_script($this->look_gender[$this->nm_grid_colunas])); 
          if ($this->gender[$this->nm_grid_colunas] === "") 
          { 
              $this->gender[$this->nm_grid_colunas] = "" ;  
          } 
          $this->gender[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->gender[$this->nm_grid_colunas]);
          $this->birthdate[$this->nm_grid_colunas] = sc_strip_script($this->birthdate[$this->nm_grid_colunas]);
          if ($this->birthdate[$this->nm_grid_colunas] === "") 
          { 
              $this->birthdate[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
               $birthdate_x =  $this->birthdate[$this->nm_grid_colunas];
               nm_conv_limpa_dado($birthdate_x, "YYYY-MM-DD");
               if (is_numeric($birthdate_x) && strlen($birthdate_x) > 0) 
               { 
                   $this->nm_data->SetaData($this->birthdate[$this->nm_grid_colunas], "YYYY-MM-DD");
                   $this->birthdate[$this->nm_grid_colunas] = html_entity_decode($this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa")), ENT_COMPAT, $_SESSION['scriptcase']['charset']);
               } 
          } 
          $this->birthdate[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->birthdate[$this->nm_grid_colunas]);
          $this->placebirth[$this->nm_grid_colunas] = sc_strip_script($this->placebirth[$this->nm_grid_colunas]);
          if ($this->placebirth[$this->nm_grid_colunas] === "") 
          { 
              $this->placebirth[$this->nm_grid_colunas] = "" ;  
          } 
          $this->placebirth[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->placebirth[$this->nm_grid_colunas]);
          $this->transactiontype[$this->nm_grid_colunas] = sc_strip_script($this->transactiontype[$this->nm_grid_colunas]);
          if ($this->transactiontype[$this->nm_grid_colunas] === "") 
          { 
              $this->transactiontype[$this->nm_grid_colunas] = "" ;  
          } 
          $this->transactiontype[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->transactiontype[$this->nm_grid_colunas]);
          $this->transactiontypename[$this->nm_grid_colunas] = sc_strip_script($this->transactiontypename[$this->nm_grid_colunas]);
          if ($this->transactiontypename[$this->nm_grid_colunas] === "") 
          { 
              $this->transactiontypename[$this->nm_grid_colunas] = "" ;  
          } 
          $this->transactiontypename[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->transactiontypename[$this->nm_grid_colunas]);
          $this->issuedate[$this->nm_grid_colunas] = sc_strip_script($this->issuedate[$this->nm_grid_colunas]);
          if ($this->issuedate[$this->nm_grid_colunas] === "") 
          { 
              $this->issuedate[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
               $issuedate_x =  $this->issuedate[$this->nm_grid_colunas];
               nm_conv_limpa_dado($issuedate_x, "YYYY-MM-DD");
               if (is_numeric($issuedate_x) && strlen($issuedate_x) > 0) 
               { 
                   $this->nm_data->SetaData($this->issuedate[$this->nm_grid_colunas], "YYYY-MM-DD");
                   $this->issuedate[$this->nm_grid_colunas] = html_entity_decode($this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa")), ENT_COMPAT, $_SESSION['scriptcase']['charset']);
               } 
          } 
          $this->issuedate[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->issuedate[$this->nm_grid_colunas]);
          $this->adoprojectid[$this->nm_grid_colunas] = sc_strip_script($this->adoprojectid[$this->nm_grid_colunas]);
          if ($this->adoprojectid[$this->nm_grid_colunas] === "") 
          { 
              $this->adoprojectid[$this->nm_grid_colunas] = "" ;  
          } 
          $this->adoprojectid[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->adoprojectid[$this->nm_grid_colunas]);
          $this->transactionid[$this->nm_grid_colunas] = sc_strip_script($this->transactionid[$this->nm_grid_colunas]);
          if ($this->transactionid[$this->nm_grid_colunas] === "") 
          { 
              $this->transactionid[$this->nm_grid_colunas] = "" ;  
          } 
          $this->transactionid[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->transactionid[$this->nm_grid_colunas]);
          $this->productid[$this->nm_grid_colunas] = sc_strip_script($this->productid[$this->nm_grid_colunas]);
          if ($this->productid[$this->nm_grid_colunas] === "") 
          { 
              $this->productid[$this->nm_grid_colunas] = "" ;  
          } 
          $this->productid[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->productid[$this->nm_grid_colunas]);
          $this->resultcomparationfaces[$this->nm_grid_colunas] = sc_strip_script($this->resultcomparationfaces[$this->nm_grid_colunas]);
          if ($this->resultcomparationfaces[$this->nm_grid_colunas] === "") 
          { 
              $this->resultcomparationfaces[$this->nm_grid_colunas] = "" ;  
          } 
          $this->resultcomparationfaces[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->resultcomparationfaces[$this->nm_grid_colunas]);
          $this->comparationfacesaproved[$this->nm_grid_colunas] = sc_strip_script($this->comparationfacesaproved[$this->nm_grid_colunas]);
          if ($this->comparationfacesaproved[$this->nm_grid_colunas] === "") 
          { 
              $this->comparationfacesaproved[$this->nm_grid_colunas] = "" ;  
          } 
          $this->comparationfacesaproved[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->comparationfacesaproved[$this->nm_grid_colunas]);
          $this->extras[$this->nm_grid_colunas] = sc_strip_script($this->extras[$this->nm_grid_colunas]);
          if ($this->extras[$this->nm_grid_colunas] === "") 
          { 
              $this->extras[$this->nm_grid_colunas] = "" ;  
          } 
          $this->extras[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->extras[$this->nm_grid_colunas]);
          $this->response_ani[$this->nm_grid_colunas] = sc_strip_script($this->response_ani[$this->nm_grid_colunas]);
          if ($this->response_ani[$this->nm_grid_colunas] === "") 
          { 
              $this->response_ani[$this->nm_grid_colunas] = "" ;  
          } 
          if ($this->response_ani[$this->nm_grid_colunas] !== "")
          { 
              $this->response_ani[$this->nm_grid_colunas] = nl2br($this->response_ani[$this->nm_grid_colunas]) ; 
              $temp = explode("<br />", $this->response_ani[$this->nm_grid_colunas]); 
              if (!isset($temp[1])) 
              { 
                  $temp = explode("<br>", $this->response_ani[$this->nm_grid_colunas]); 
              } 
              $this->response_ani[$this->nm_grid_colunas] = "" ; 
              $ind_x = 0 ; 
              while (isset($temp[$ind_x])) 
              { 
                 if (!empty($this->response_ani[$this->nm_grid_colunas])) 
                 { 
                     $this->response_ani[$this->nm_grid_colunas] .= "<br>"; 
                 } 
                 if (strlen($temp[$ind_x]) > 150) 
                 { 
                     $this->response_ani[$this->nm_grid_colunas] .= wordwrap($temp[$ind_x], 150, "<br>", true); 
                 } 
                 else 
                 { 
                     $this->response_ani[$this->nm_grid_colunas] .= $temp[$ind_x]; 
                 } 
                 $ind_x++; 
              }  
          }  
          $this->response_ani[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->response_ani[$this->nm_grid_colunas]);
          if ($this->photo[$this->nm_grid_colunas] === "") 
          { 
              $this->photo[$this->nm_grid_colunas] = "" ;  
          } 
          if (!is_file($this->Ini->root  . $this->Ini->path_imag_cab . "/grp__NM__img__NM__logoempresa-397_56.png"))
          { 
              $this->photo[$this->nm_grid_colunas] = "" ;  
          } 
          else 
          { 
              $this->photo[$this->nm_grid_colunas] = $this->NM_raiz_img  . $this->Ini->path_imag_cab . "/grp__NM__img__NM__logoempresa-397_56.png"; 
          } 
          $this->photo[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->photo[$this->nm_grid_colunas]);
          if ($this->urlimgs[$this->nm_grid_colunas] === "") 
          { 
              $this->urlimgs[$this->nm_grid_colunas] = "" ;  
          } 
          $this->urlimgs[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->urlimgs[$this->nm_grid_colunas]);
            $cell_Photo = array('posx' => '50', 'posy' => '20', 'data' => $this->photo[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_49 = array('posx' => '10', 'posy' => '10', 'data' => $this->SC_conv_utf8('' . $this->Ini->Nm_lang['lang_ado_records_titulo_pdf_2'] . ''), 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '11', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '255', 'font_style' => B);
            $cell_25 = array('posx' => '10', 'posy' => '20', 'data' => $this->SC_conv_utf8('' . $this->Ini->Nm_lang['lang_ado_records_fld_Record'] . ''), 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => B);
            $cell_Record = array('posx' => '48', 'posy' => '20', 'data' => $this->record[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_26 = array('posx' => '10', 'posy' => '30', 'data' => $this->SC_conv_utf8('' . $this->Ini->Nm_lang['lang_ado_records_fld_Uid'] . ''), 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => B);
            $cell_Uid = array('posx' => '48', 'posy' => '30', 'data' => $this->uid[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_27 = array('posx' => '10', 'posy' => '40', 'data' => $this->SC_conv_utf8('' . $this->Ini->Nm_lang['lang_ado_records_fld_StartingDate'] . ''), 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => B);
            $cell_StartingDate = array('posx' => '48', 'posy' => '40', 'data' => $this->startingdate[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_28 = array('posx' => '10', 'posy' => '50', 'data' => $this->SC_conv_utf8('' . $this->Ini->Nm_lang['lang_ado_records_fld_CreationDate'] . ''), 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => B);
            $cell_CreationDate = array('posx' => '48', 'posy' => '50', 'data' => $this->creationdate[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_29 = array('posx' => '10', 'posy' => '60', 'data' => $this->SC_conv_utf8('' . $this->Ini->Nm_lang['lang_ado_records_fld_CreationIP'] . ''), 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => B);
            $cell_CreationIP = array('posx' => '48', 'posy' => '60', 'data' => $this->creationip[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_48 = array('posx' => '10', 'posy' => '80', 'data' => $this->SC_conv_utf8('' . $this->Ini->Nm_lang['lang_ado_records_titulo_pdf_1'] . ''), 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '11', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '255', 'font_style' => B);
            $cell_30 = array('posx' => '10', 'posy' => '90', 'data' => $this->SC_conv_utf8('' . $this->Ini->Nm_lang['lang_ado_records_fld_IdNumber'] . ''), 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => B);
            $cell_IdNumber = array('posx' => '48', 'posy' => '90', 'data' => $this->idnumber[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_39 = array('posx' => '95', 'posy' => '90', 'data' => $this->SC_conv_utf8('' . $this->Ini->Nm_lang['lang_ado_records_fld_IssueDate'] . ''), 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => B);
            $cell_IssueDate = array('posx' => '130', 'posy' => '90', 'data' => $this->issuedate[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_31 = array('posx' => '10', 'posy' => '100', 'data' => $this->SC_conv_utf8('' . $this->Ini->Nm_lang['lang_ado_records_fld_FirstName'] . ''), 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => B);
            $cell_FirstName = array('posx' => '48', 'posy' => '100', 'data' => $this->firstname[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_32 = array('posx' => '95', 'posy' => '100', 'data' => $this->SC_conv_utf8('' . $this->Ini->Nm_lang['lang_ado_records_fld_SecondName'] . ''), 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => B);
            $cell_SecondName = array('posx' => '130', 'posy' => '100', 'data' => $this->secondname[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_33 = array('posx' => '10', 'posy' => '110', 'data' => $this->SC_conv_utf8('' . $this->Ini->Nm_lang['lang_ado_records_fld_FirstSurname'] . ''), 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => B);
            $cell_FirstSurname = array('posx' => '48', 'posy' => '110', 'data' => $this->firstsurname[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_34 = array('posx' => '95', 'posy' => '110', 'data' => $this->SC_conv_utf8('' . $this->Ini->Nm_lang['lang_ado_records_fld_SecondSurname'] . ''), 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => B);
            $cell_SecondSurname = array('posx' => '130', 'posy' => '110', 'data' => $this->secondsurname[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_35 = array('posx' => '10', 'posy' => '120', 'data' => $this->SC_conv_utf8('' . $this->Ini->Nm_lang['lang_ado_records_fld_Gender'] . ''), 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => B);
            $cell_Gender = array('posx' => '48', 'posy' => '120', 'data' => $this->gender[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_36 = array('posx' => '95', 'posy' => '120', 'data' => $this->SC_conv_utf8('' . $this->Ini->Nm_lang['lang_ado_records_fld_BirthDate'] . ''), 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => B);
            $cell_BirthDate = array('posx' => '130', 'posy' => '120', 'data' => $this->birthdate[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_37 = array('posx' => '10', 'posy' => '130', 'data' => $this->SC_conv_utf8('' . $this->Ini->Nm_lang['lang_ado_records_fld_PlaceBirth'] . ''), 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => B);
            $cell_PlaceBirth = array('posx' => '48', 'posy' => '130', 'data' => $this->placebirth[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_38 = array('posx' => '95', 'posy' => '130', 'data' => $this->SC_conv_utf8('' . $this->Ini->Nm_lang['lang_ado_records_fld_TransactionTypeName'] . ''), 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => B);
            $cell_TransactionTypeName = array('posx' => '130', 'posy' => '130', 'data' => $this->transactiontypename[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_50 = array('posx' => '10', 'posy' => '150', 'data' => $this->SC_conv_utf8('' . $this->Ini->Nm_lang['lang_ado_records_titulo_pdf_3'] . ''), 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '11', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '255', 'font_style' => B);
            $cell_40 = array('posx' => '10', 'posy' => '160', 'data' => $this->SC_conv_utf8('' . $this->Ini->Nm_lang['lang_ado_records_fld_TransactionId'] . ''), 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => B);
            $cell_TransactionId = array('posx' => '48', 'posy' => '160', 'data' => $this->transactionid[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_41 = array('posx' => '95', 'posy' => '160', 'data' => $this->SC_conv_utf8('' . $this->Ini->Nm_lang['lang_ado_records_fld_ProductId'] . ''), 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => B);
            $cell_ProductId = array('posx' => '136', 'posy' => '160', 'data' => $this->productid[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_44 = array('posx' => '10', 'posy' => '170', 'data' => $this->SC_conv_utf8('' . $this->Ini->Nm_lang['lang_ado_records_fld_Extras'] . ''), 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => B);
            $cell_Extras = array('posx' => '48', 'posy' => '170', 'data' => $this->extras[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_47 = array('posx' => '10', 'posy' => '180', 'data' => $this->SC_conv_utf8('' . $this->Ini->Nm_lang['lang_ado_records_fld_Response_ANI'] . ''), 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => B);
            $cell_Response_ANI = array('posx' => '48', 'posy' => '180', 'data' => $this->response_ani[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'helvetica', 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_urlimgs = array('posx' => '48', 'posy' => '190', 'data' => $this->urlimgs[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '8', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);

            if (isset($cell_Photo['data']) && !empty($cell_Photo['data']) && is_file($cell_Photo['data']))
            {
                $Finfo_img = finfo_open(FILEINFO_MIME_TYPE);
                $Tipo_img  = finfo_file($Finfo_img, $cell_Photo['data']);
                finfo_close($Finfo_img);
                if (substr($Tipo_img, 0, 5) == "image")
                {
                    $this->Pdf->Image($cell_Photo['data'], $cell_Photo['posx'], $cell_Photo['posy'], 0, 0);
                }
            }

            $this->Pdf->SetFont($cell_49['font_type'], $cell_49['font_style'], $cell_49['font_size']);
            $this->pdf_text_color($cell_49['data'], $cell_49['color_r'], $cell_49['color_g'], $cell_49['color_b']);
            if (!empty($cell_49['posx']) && !empty($cell_49['posy']))
            {
                $this->Pdf->SetXY($cell_49['posx'], $cell_49['posy']);
            }
            elseif (!empty($cell_49['posx']))
            {
                $this->Pdf->SetX($cell_49['posx']);
            }
            elseif (!empty($cell_49['posy']))
            {
                $this->Pdf->SetY($cell_49['posy']);
            }
            $this->Pdf->Cell($cell_49['width'], 0, $cell_49['data'], 0, 0, $cell_49['align']);

            $this->Pdf->SetFont($cell_25['font_type'], $cell_25['font_style'], $cell_25['font_size']);
            $this->pdf_text_color($cell_25['data'], $cell_25['color_r'], $cell_25['color_g'], $cell_25['color_b']);
            if (!empty($cell_25['posx']) && !empty($cell_25['posy']))
            {
                $this->Pdf->SetXY($cell_25['posx'], $cell_25['posy']);
            }
            elseif (!empty($cell_25['posx']))
            {
                $this->Pdf->SetX($cell_25['posx']);
            }
            elseif (!empty($cell_25['posy']))
            {
                $this->Pdf->SetY($cell_25['posy']);
            }
            $this->Pdf->Cell($cell_25['width'], 0, $cell_25['data'], 0, 0, $cell_25['align']);

            $this->Pdf->SetFont($cell_Record['font_type'], $cell_Record['font_style'], $cell_Record['font_size']);
            $this->pdf_text_color($cell_Record['data'], $cell_Record['color_r'], $cell_Record['color_g'], $cell_Record['color_b']);
            if (!empty($cell_Record['posx']) && !empty($cell_Record['posy']))
            {
                $this->Pdf->SetXY($cell_Record['posx'], $cell_Record['posy']);
            }
            elseif (!empty($cell_Record['posx']))
            {
                $this->Pdf->SetX($cell_Record['posx']);
            }
            elseif (!empty($cell_Record['posy']))
            {
                $this->Pdf->SetY($cell_Record['posy']);
            }
            $this->Pdf->Cell($cell_Record['width'], 0, $cell_Record['data'], 0, 0, $cell_Record['align']);


            $sbFoto = $this->urlimgs[$this->nm_grid_colunas];
            $this->Pdf->Image($sbFoto,140,50,45,50);

            $this->Pdf->SetFont($cell_26['font_type'], $cell_26['font_style'], $cell_26['font_size']);
            $this->pdf_text_color($cell_26['data'], $cell_26['color_r'], $cell_26['color_g'], $cell_26['color_b']);
            if (!empty($cell_26['posx']) && !empty($cell_26['posy']))
            {
                $this->Pdf->SetXY($cell_26['posx'], $cell_26['posy']);
            }
            elseif (!empty($cell_26['posx']))
            {
                $this->Pdf->SetX($cell_26['posx']);
            }
            elseif (!empty($cell_26['posy']))
            {
                $this->Pdf->SetY($cell_26['posy']);
            }
            $this->Pdf->Cell($cell_26['width'], 0, $cell_26['data'], 0, 0, $cell_26['align']);

            $this->Pdf->SetFont($cell_Uid['font_type'], $cell_Uid['font_style'], $cell_Uid['font_size']);
            $this->pdf_text_color($cell_Uid['data'], $cell_Uid['color_r'], $cell_Uid['color_g'], $cell_Uid['color_b']);
            if (!empty($cell_Uid['posx']) && !empty($cell_Uid['posy']))
            {
                $this->Pdf->SetXY($cell_Uid['posx'], $cell_Uid['posy']);
            }
            elseif (!empty($cell_Uid['posx']))
            {
                $this->Pdf->SetX($cell_Uid['posx']);
            }
            elseif (!empty($cell_Uid['posy']))
            {
                $this->Pdf->SetY($cell_Uid['posy']);
            }
            $this->Pdf->Cell($cell_Uid['width'], 0, $cell_Uid['data'], 0, 0, $cell_Uid['align']);

            $this->Pdf->SetFont($cell_27['font_type'], $cell_27['font_style'], $cell_27['font_size']);
            $this->pdf_text_color($cell_27['data'], $cell_27['color_r'], $cell_27['color_g'], $cell_27['color_b']);
            if (!empty($cell_27['posx']) && !empty($cell_27['posy']))
            {
                $this->Pdf->SetXY($cell_27['posx'], $cell_27['posy']);
            }
            elseif (!empty($cell_27['posx']))
            {
                $this->Pdf->SetX($cell_27['posx']);
            }
            elseif (!empty($cell_27['posy']))
            {
                $this->Pdf->SetY($cell_27['posy']);
            }
            $this->Pdf->Cell($cell_27['width'], 0, $cell_27['data'], 0, 0, $cell_27['align']);

            $this->Pdf->SetFont($cell_StartingDate['font_type'], $cell_StartingDate['font_style'], $cell_StartingDate['font_size']);
            $this->pdf_text_color($cell_StartingDate['data'], $cell_StartingDate['color_r'], $cell_StartingDate['color_g'], $cell_StartingDate['color_b']);
            if (!empty($cell_StartingDate['posx']) && !empty($cell_StartingDate['posy']))
            {
                $this->Pdf->SetXY($cell_StartingDate['posx'], $cell_StartingDate['posy']);
            }
            elseif (!empty($cell_StartingDate['posx']))
            {
                $this->Pdf->SetX($cell_StartingDate['posx']);
            }
            elseif (!empty($cell_StartingDate['posy']))
            {
                $this->Pdf->SetY($cell_StartingDate['posy']);
            }
            $this->Pdf->Cell($cell_StartingDate['width'], 0, $cell_StartingDate['data'], 0, 0, $cell_StartingDate['align']);

            $this->Pdf->SetFont($cell_28['font_type'], $cell_28['font_style'], $cell_28['font_size']);
            $this->pdf_text_color($cell_28['data'], $cell_28['color_r'], $cell_28['color_g'], $cell_28['color_b']);
            if (!empty($cell_28['posx']) && !empty($cell_28['posy']))
            {
                $this->Pdf->SetXY($cell_28['posx'], $cell_28['posy']);
            }
            elseif (!empty($cell_28['posx']))
            {
                $this->Pdf->SetX($cell_28['posx']);
            }
            elseif (!empty($cell_28['posy']))
            {
                $this->Pdf->SetY($cell_28['posy']);
            }
            $this->Pdf->Cell($cell_28['width'], 0, $cell_28['data'], 0, 0, $cell_28['align']);

            $this->Pdf->SetFont($cell_CreationDate['font_type'], $cell_CreationDate['font_style'], $cell_CreationDate['font_size']);
            $this->pdf_text_color($cell_CreationDate['data'], $cell_CreationDate['color_r'], $cell_CreationDate['color_g'], $cell_CreationDate['color_b']);
            if (!empty($cell_CreationDate['posx']) && !empty($cell_CreationDate['posy']))
            {
                $this->Pdf->SetXY($cell_CreationDate['posx'], $cell_CreationDate['posy']);
            }
            elseif (!empty($cell_CreationDate['posx']))
            {
                $this->Pdf->SetX($cell_CreationDate['posx']);
            }
            elseif (!empty($cell_CreationDate['posy']))
            {
                $this->Pdf->SetY($cell_CreationDate['posy']);
            }
            $this->Pdf->Cell($cell_CreationDate['width'], 0, $cell_CreationDate['data'], 0, 0, $cell_CreationDate['align']);

            $this->Pdf->SetFont($cell_29['font_type'], $cell_29['font_style'], $cell_29['font_size']);
            $this->pdf_text_color($cell_29['data'], $cell_29['color_r'], $cell_29['color_g'], $cell_29['color_b']);
            if (!empty($cell_29['posx']) && !empty($cell_29['posy']))
            {
                $this->Pdf->SetXY($cell_29['posx'], $cell_29['posy']);
            }
            elseif (!empty($cell_29['posx']))
            {
                $this->Pdf->SetX($cell_29['posx']);
            }
            elseif (!empty($cell_29['posy']))
            {
                $this->Pdf->SetY($cell_29['posy']);
            }
            $this->Pdf->Cell($cell_29['width'], 0, $cell_29['data'], 0, 0, $cell_29['align']);

            $this->Pdf->SetFont($cell_CreationIP['font_type'], $cell_CreationIP['font_style'], $cell_CreationIP['font_size']);
            $this->pdf_text_color($cell_CreationIP['data'], $cell_CreationIP['color_r'], $cell_CreationIP['color_g'], $cell_CreationIP['color_b']);
            if (!empty($cell_CreationIP['posx']) && !empty($cell_CreationIP['posy']))
            {
                $this->Pdf->SetXY($cell_CreationIP['posx'], $cell_CreationIP['posy']);
            }
            elseif (!empty($cell_CreationIP['posx']))
            {
                $this->Pdf->SetX($cell_CreationIP['posx']);
            }
            elseif (!empty($cell_CreationIP['posy']))
            {
                $this->Pdf->SetY($cell_CreationIP['posy']);
            }
            $this->Pdf->Cell($cell_CreationIP['width'], 0, $cell_CreationIP['data'], 0, 0, $cell_CreationIP['align']);

            $this->Pdf->SetFont($cell_48['font_type'], $cell_48['font_style'], $cell_48['font_size']);
            $this->pdf_text_color($cell_48['data'], $cell_48['color_r'], $cell_48['color_g'], $cell_48['color_b']);
            if (!empty($cell_48['posx']) && !empty($cell_48['posy']))
            {
                $this->Pdf->SetXY($cell_48['posx'], $cell_48['posy']);
            }
            elseif (!empty($cell_48['posx']))
            {
                $this->Pdf->SetX($cell_48['posx']);
            }
            elseif (!empty($cell_48['posy']))
            {
                $this->Pdf->SetY($cell_48['posy']);
            }
            $this->Pdf->Cell($cell_48['width'], 0, $cell_48['data'], 0, 0, $cell_48['align']);

            $this->Pdf->SetFont($cell_30['font_type'], $cell_30['font_style'], $cell_30['font_size']);
            $this->pdf_text_color($cell_30['data'], $cell_30['color_r'], $cell_30['color_g'], $cell_30['color_b']);
            if (!empty($cell_30['posx']) && !empty($cell_30['posy']))
            {
                $this->Pdf->SetXY($cell_30['posx'], $cell_30['posy']);
            }
            elseif (!empty($cell_30['posx']))
            {
                $this->Pdf->SetX($cell_30['posx']);
            }
            elseif (!empty($cell_30['posy']))
            {
                $this->Pdf->SetY($cell_30['posy']);
            }
            $this->Pdf->Cell($cell_30['width'], 0, $cell_30['data'], 0, 0, $cell_30['align']);

            $this->Pdf->SetFont($cell_IdNumber['font_type'], $cell_IdNumber['font_style'], $cell_IdNumber['font_size']);
            $this->pdf_text_color($cell_IdNumber['data'], $cell_IdNumber['color_r'], $cell_IdNumber['color_g'], $cell_IdNumber['color_b']);
            if (!empty($cell_IdNumber['posx']) && !empty($cell_IdNumber['posy']))
            {
                $this->Pdf->SetXY($cell_IdNumber['posx'], $cell_IdNumber['posy']);
            }
            elseif (!empty($cell_IdNumber['posx']))
            {
                $this->Pdf->SetX($cell_IdNumber['posx']);
            }
            elseif (!empty($cell_IdNumber['posy']))
            {
                $this->Pdf->SetY($cell_IdNumber['posy']);
            }
            $this->Pdf->Cell($cell_IdNumber['width'], 0, $cell_IdNumber['data'], 0, 0, $cell_IdNumber['align']);

            $this->Pdf->SetFont($cell_39['font_type'], $cell_39['font_style'], $cell_39['font_size']);
            $this->pdf_text_color($cell_39['data'], $cell_39['color_r'], $cell_39['color_g'], $cell_39['color_b']);
            if (!empty($cell_39['posx']) && !empty($cell_39['posy']))
            {
                $this->Pdf->SetXY($cell_39['posx'], $cell_39['posy']);
            }
            elseif (!empty($cell_39['posx']))
            {
                $this->Pdf->SetX($cell_39['posx']);
            }
            elseif (!empty($cell_39['posy']))
            {
                $this->Pdf->SetY($cell_39['posy']);
            }
            $this->Pdf->Cell($cell_39['width'], 0, $cell_39['data'], 0, 0, $cell_39['align']);

            $this->Pdf->SetFont($cell_IssueDate['font_type'], $cell_IssueDate['font_style'], $cell_IssueDate['font_size']);
            $this->pdf_text_color($cell_IssueDate['data'], $cell_IssueDate['color_r'], $cell_IssueDate['color_g'], $cell_IssueDate['color_b']);
            if (!empty($cell_IssueDate['posx']) && !empty($cell_IssueDate['posy']))
            {
                $this->Pdf->SetXY($cell_IssueDate['posx'], $cell_IssueDate['posy']);
            }
            elseif (!empty($cell_IssueDate['posx']))
            {
                $this->Pdf->SetX($cell_IssueDate['posx']);
            }
            elseif (!empty($cell_IssueDate['posy']))
            {
                $this->Pdf->SetY($cell_IssueDate['posy']);
            }
            $this->Pdf->Cell($cell_IssueDate['width'], 0, $cell_IssueDate['data'], 0, 0, $cell_IssueDate['align']);

            $this->Pdf->SetFont($cell_31['font_type'], $cell_31['font_style'], $cell_31['font_size']);
            $this->pdf_text_color($cell_31['data'], $cell_31['color_r'], $cell_31['color_g'], $cell_31['color_b']);
            if (!empty($cell_31['posx']) && !empty($cell_31['posy']))
            {
                $this->Pdf->SetXY($cell_31['posx'], $cell_31['posy']);
            }
            elseif (!empty($cell_31['posx']))
            {
                $this->Pdf->SetX($cell_31['posx']);
            }
            elseif (!empty($cell_31['posy']))
            {
                $this->Pdf->SetY($cell_31['posy']);
            }
            $this->Pdf->Cell($cell_31['width'], 0, $cell_31['data'], 0, 0, $cell_31['align']);

            $this->Pdf->SetFont($cell_FirstName['font_type'], $cell_FirstName['font_style'], $cell_FirstName['font_size']);
            $this->pdf_text_color($cell_FirstName['data'], $cell_FirstName['color_r'], $cell_FirstName['color_g'], $cell_FirstName['color_b']);
            if (!empty($cell_FirstName['posx']) && !empty($cell_FirstName['posy']))
            {
                $this->Pdf->SetXY($cell_FirstName['posx'], $cell_FirstName['posy']);
            }
            elseif (!empty($cell_FirstName['posx']))
            {
                $this->Pdf->SetX($cell_FirstName['posx']);
            }
            elseif (!empty($cell_FirstName['posy']))
            {
                $this->Pdf->SetY($cell_FirstName['posy']);
            }
            $this->Pdf->Cell($cell_FirstName['width'], 0, $cell_FirstName['data'], 0, 0, $cell_FirstName['align']);

            $this->Pdf->SetFont($cell_32['font_type'], $cell_32['font_style'], $cell_32['font_size']);
            $this->pdf_text_color($cell_32['data'], $cell_32['color_r'], $cell_32['color_g'], $cell_32['color_b']);
            if (!empty($cell_32['posx']) && !empty($cell_32['posy']))
            {
                $this->Pdf->SetXY($cell_32['posx'], $cell_32['posy']);
            }
            elseif (!empty($cell_32['posx']))
            {
                $this->Pdf->SetX($cell_32['posx']);
            }
            elseif (!empty($cell_32['posy']))
            {
                $this->Pdf->SetY($cell_32['posy']);
            }
            $this->Pdf->Cell($cell_32['width'], 0, $cell_32['data'], 0, 0, $cell_32['align']);

            $this->Pdf->SetFont($cell_SecondName['font_type'], $cell_SecondName['font_style'], $cell_SecondName['font_size']);
            $this->pdf_text_color($cell_SecondName['data'], $cell_SecondName['color_r'], $cell_SecondName['color_g'], $cell_SecondName['color_b']);
            if (!empty($cell_SecondName['posx']) && !empty($cell_SecondName['posy']))
            {
                $this->Pdf->SetXY($cell_SecondName['posx'], $cell_SecondName['posy']);
            }
            elseif (!empty($cell_SecondName['posx']))
            {
                $this->Pdf->SetX($cell_SecondName['posx']);
            }
            elseif (!empty($cell_SecondName['posy']))
            {
                $this->Pdf->SetY($cell_SecondName['posy']);
            }
            $this->Pdf->Cell($cell_SecondName['width'], 0, $cell_SecondName['data'], 0, 0, $cell_SecondName['align']);

            $this->Pdf->SetFont($cell_33['font_type'], $cell_33['font_style'], $cell_33['font_size']);
            $this->pdf_text_color($cell_33['data'], $cell_33['color_r'], $cell_33['color_g'], $cell_33['color_b']);
            if (!empty($cell_33['posx']) && !empty($cell_33['posy']))
            {
                $this->Pdf->SetXY($cell_33['posx'], $cell_33['posy']);
            }
            elseif (!empty($cell_33['posx']))
            {
                $this->Pdf->SetX($cell_33['posx']);
            }
            elseif (!empty($cell_33['posy']))
            {
                $this->Pdf->SetY($cell_33['posy']);
            }
            $this->Pdf->Cell($cell_33['width'], 0, $cell_33['data'], 0, 0, $cell_33['align']);

            $this->Pdf->SetFont($cell_FirstSurname['font_type'], $cell_FirstSurname['font_style'], $cell_FirstSurname['font_size']);
            $this->pdf_text_color($cell_FirstSurname['data'], $cell_FirstSurname['color_r'], $cell_FirstSurname['color_g'], $cell_FirstSurname['color_b']);
            if (!empty($cell_FirstSurname['posx']) && !empty($cell_FirstSurname['posy']))
            {
                $this->Pdf->SetXY($cell_FirstSurname['posx'], $cell_FirstSurname['posy']);
            }
            elseif (!empty($cell_FirstSurname['posx']))
            {
                $this->Pdf->SetX($cell_FirstSurname['posx']);
            }
            elseif (!empty($cell_FirstSurname['posy']))
            {
                $this->Pdf->SetY($cell_FirstSurname['posy']);
            }
            $this->Pdf->Cell($cell_FirstSurname['width'], 0, $cell_FirstSurname['data'], 0, 0, $cell_FirstSurname['align']);

            $this->Pdf->SetFont($cell_34['font_type'], $cell_34['font_style'], $cell_34['font_size']);
            $this->pdf_text_color($cell_34['data'], $cell_34['color_r'], $cell_34['color_g'], $cell_34['color_b']);
            if (!empty($cell_34['posx']) && !empty($cell_34['posy']))
            {
                $this->Pdf->SetXY($cell_34['posx'], $cell_34['posy']);
            }
            elseif (!empty($cell_34['posx']))
            {
                $this->Pdf->SetX($cell_34['posx']);
            }
            elseif (!empty($cell_34['posy']))
            {
                $this->Pdf->SetY($cell_34['posy']);
            }
            $this->Pdf->Cell($cell_34['width'], 0, $cell_34['data'], 0, 0, $cell_34['align']);

            $this->Pdf->SetFont($cell_SecondSurname['font_type'], $cell_SecondSurname['font_style'], $cell_SecondSurname['font_size']);
            $this->pdf_text_color($cell_SecondSurname['data'], $cell_SecondSurname['color_r'], $cell_SecondSurname['color_g'], $cell_SecondSurname['color_b']);
            if (!empty($cell_SecondSurname['posx']) && !empty($cell_SecondSurname['posy']))
            {
                $this->Pdf->SetXY($cell_SecondSurname['posx'], $cell_SecondSurname['posy']);
            }
            elseif (!empty($cell_SecondSurname['posx']))
            {
                $this->Pdf->SetX($cell_SecondSurname['posx']);
            }
            elseif (!empty($cell_SecondSurname['posy']))
            {
                $this->Pdf->SetY($cell_SecondSurname['posy']);
            }
            $this->Pdf->Cell($cell_SecondSurname['width'], 0, $cell_SecondSurname['data'], 0, 0, $cell_SecondSurname['align']);

            $this->Pdf->SetFont($cell_35['font_type'], $cell_35['font_style'], $cell_35['font_size']);
            $this->pdf_text_color($cell_35['data'], $cell_35['color_r'], $cell_35['color_g'], $cell_35['color_b']);
            if (!empty($cell_35['posx']) && !empty($cell_35['posy']))
            {
                $this->Pdf->SetXY($cell_35['posx'], $cell_35['posy']);
            }
            elseif (!empty($cell_35['posx']))
            {
                $this->Pdf->SetX($cell_35['posx']);
            }
            elseif (!empty($cell_35['posy']))
            {
                $this->Pdf->SetY($cell_35['posy']);
            }
            $this->Pdf->Cell($cell_35['width'], 0, $cell_35['data'], 0, 0, $cell_35['align']);

            $this->Pdf->SetFont($cell_Gender['font_type'], $cell_Gender['font_style'], $cell_Gender['font_size']);
            $this->pdf_text_color($cell_Gender['data'], $cell_Gender['color_r'], $cell_Gender['color_g'], $cell_Gender['color_b']);
            if (!empty($cell_Gender['posx']) && !empty($cell_Gender['posy']))
            {
                $this->Pdf->SetXY($cell_Gender['posx'], $cell_Gender['posy']);
            }
            elseif (!empty($cell_Gender['posx']))
            {
                $this->Pdf->SetX($cell_Gender['posx']);
            }
            elseif (!empty($cell_Gender['posy']))
            {
                $this->Pdf->SetY($cell_Gender['posy']);
            }
            $this->Pdf->Cell($cell_Gender['width'], 0, $cell_Gender['data'], 0, 0, $cell_Gender['align']);

            $this->Pdf->SetFont($cell_36['font_type'], $cell_36['font_style'], $cell_36['font_size']);
            $this->pdf_text_color($cell_36['data'], $cell_36['color_r'], $cell_36['color_g'], $cell_36['color_b']);
            if (!empty($cell_36['posx']) && !empty($cell_36['posy']))
            {
                $this->Pdf->SetXY($cell_36['posx'], $cell_36['posy']);
            }
            elseif (!empty($cell_36['posx']))
            {
                $this->Pdf->SetX($cell_36['posx']);
            }
            elseif (!empty($cell_36['posy']))
            {
                $this->Pdf->SetY($cell_36['posy']);
            }
            $this->Pdf->Cell($cell_36['width'], 0, $cell_36['data'], 0, 0, $cell_36['align']);

            $this->Pdf->SetFont($cell_BirthDate['font_type'], $cell_BirthDate['font_style'], $cell_BirthDate['font_size']);
            $this->pdf_text_color($cell_BirthDate['data'], $cell_BirthDate['color_r'], $cell_BirthDate['color_g'], $cell_BirthDate['color_b']);
            if (!empty($cell_BirthDate['posx']) && !empty($cell_BirthDate['posy']))
            {
                $this->Pdf->SetXY($cell_BirthDate['posx'], $cell_BirthDate['posy']);
            }
            elseif (!empty($cell_BirthDate['posx']))
            {
                $this->Pdf->SetX($cell_BirthDate['posx']);
            }
            elseif (!empty($cell_BirthDate['posy']))
            {
                $this->Pdf->SetY($cell_BirthDate['posy']);
            }
            $this->Pdf->Cell($cell_BirthDate['width'], 0, $cell_BirthDate['data'], 0, 0, $cell_BirthDate['align']);

            $this->Pdf->SetFont($cell_37['font_type'], $cell_37['font_style'], $cell_37['font_size']);
            $this->pdf_text_color($cell_37['data'], $cell_37['color_r'], $cell_37['color_g'], $cell_37['color_b']);
            if (!empty($cell_37['posx']) && !empty($cell_37['posy']))
            {
                $this->Pdf->SetXY($cell_37['posx'], $cell_37['posy']);
            }
            elseif (!empty($cell_37['posx']))
            {
                $this->Pdf->SetX($cell_37['posx']);
            }
            elseif (!empty($cell_37['posy']))
            {
                $this->Pdf->SetY($cell_37['posy']);
            }
            $this->Pdf->Cell($cell_37['width'], 0, $cell_37['data'], 0, 0, $cell_37['align']);

            $this->Pdf->SetFont($cell_PlaceBirth['font_type'], $cell_PlaceBirth['font_style'], $cell_PlaceBirth['font_size']);
            $this->pdf_text_color($cell_PlaceBirth['data'], $cell_PlaceBirth['color_r'], $cell_PlaceBirth['color_g'], $cell_PlaceBirth['color_b']);
            if (!empty($cell_PlaceBirth['posx']) && !empty($cell_PlaceBirth['posy']))
            {
                $this->Pdf->SetXY($cell_PlaceBirth['posx'], $cell_PlaceBirth['posy']);
            }
            elseif (!empty($cell_PlaceBirth['posx']))
            {
                $this->Pdf->SetX($cell_PlaceBirth['posx']);
            }
            elseif (!empty($cell_PlaceBirth['posy']))
            {
                $this->Pdf->SetY($cell_PlaceBirth['posy']);
            }
            $this->Pdf->Cell($cell_PlaceBirth['width'], 0, $cell_PlaceBirth['data'], 0, 0, $cell_PlaceBirth['align']);

            $this->Pdf->SetFont($cell_38['font_type'], $cell_38['font_style'], $cell_38['font_size']);
            $this->pdf_text_color($cell_38['data'], $cell_38['color_r'], $cell_38['color_g'], $cell_38['color_b']);
            if (!empty($cell_38['posx']) && !empty($cell_38['posy']))
            {
                $this->Pdf->SetXY($cell_38['posx'], $cell_38['posy']);
            }
            elseif (!empty($cell_38['posx']))
            {
                $this->Pdf->SetX($cell_38['posx']);
            }
            elseif (!empty($cell_38['posy']))
            {
                $this->Pdf->SetY($cell_38['posy']);
            }
            $this->Pdf->Cell($cell_38['width'], 0, $cell_38['data'], 0, 0, $cell_38['align']);

            $this->Pdf->SetFont($cell_TransactionTypeName['font_type'], $cell_TransactionTypeName['font_style'], $cell_TransactionTypeName['font_size']);
            $this->pdf_text_color($cell_TransactionTypeName['data'], $cell_TransactionTypeName['color_r'], $cell_TransactionTypeName['color_g'], $cell_TransactionTypeName['color_b']);
            if (!empty($cell_TransactionTypeName['posx']) && !empty($cell_TransactionTypeName['posy']))
            {
                $this->Pdf->SetXY($cell_TransactionTypeName['posx'], $cell_TransactionTypeName['posy']);
            }
            elseif (!empty($cell_TransactionTypeName['posx']))
            {
                $this->Pdf->SetX($cell_TransactionTypeName['posx']);
            }
            elseif (!empty($cell_TransactionTypeName['posy']))
            {
                $this->Pdf->SetY($cell_TransactionTypeName['posy']);
            }
            $this->Pdf->Cell($cell_TransactionTypeName['width'], 0, $cell_TransactionTypeName['data'], 0, 0, $cell_TransactionTypeName['align']);

            $this->Pdf->SetFont($cell_50['font_type'], $cell_50['font_style'], $cell_50['font_size']);
            $this->pdf_text_color($cell_50['data'], $cell_50['color_r'], $cell_50['color_g'], $cell_50['color_b']);
            if (!empty($cell_50['posx']) && !empty($cell_50['posy']))
            {
                $this->Pdf->SetXY($cell_50['posx'], $cell_50['posy']);
            }
            elseif (!empty($cell_50['posx']))
            {
                $this->Pdf->SetX($cell_50['posx']);
            }
            elseif (!empty($cell_50['posy']))
            {
                $this->Pdf->SetY($cell_50['posy']);
            }
            $this->Pdf->Cell($cell_50['width'], 0, $cell_50['data'], 0, 0, $cell_50['align']);

            $this->Pdf->SetFont($cell_40['font_type'], $cell_40['font_style'], $cell_40['font_size']);
            $this->pdf_text_color($cell_40['data'], $cell_40['color_r'], $cell_40['color_g'], $cell_40['color_b']);
            if (!empty($cell_40['posx']) && !empty($cell_40['posy']))
            {
                $this->Pdf->SetXY($cell_40['posx'], $cell_40['posy']);
            }
            elseif (!empty($cell_40['posx']))
            {
                $this->Pdf->SetX($cell_40['posx']);
            }
            elseif (!empty($cell_40['posy']))
            {
                $this->Pdf->SetY($cell_40['posy']);
            }
            $this->Pdf->Cell($cell_40['width'], 0, $cell_40['data'], 0, 0, $cell_40['align']);

            $this->Pdf->SetFont($cell_TransactionId['font_type'], $cell_TransactionId['font_style'], $cell_TransactionId['font_size']);
            $this->pdf_text_color($cell_TransactionId['data'], $cell_TransactionId['color_r'], $cell_TransactionId['color_g'], $cell_TransactionId['color_b']);
            if (!empty($cell_TransactionId['posx']) && !empty($cell_TransactionId['posy']))
            {
                $this->Pdf->SetXY($cell_TransactionId['posx'], $cell_TransactionId['posy']);
            }
            elseif (!empty($cell_TransactionId['posx']))
            {
                $this->Pdf->SetX($cell_TransactionId['posx']);
            }
            elseif (!empty($cell_TransactionId['posy']))
            {
                $this->Pdf->SetY($cell_TransactionId['posy']);
            }
            $this->Pdf->Cell($cell_TransactionId['width'], 0, $cell_TransactionId['data'], 0, 0, $cell_TransactionId['align']);

            $this->Pdf->SetFont($cell_41['font_type'], $cell_41['font_style'], $cell_41['font_size']);
            $this->pdf_text_color($cell_41['data'], $cell_41['color_r'], $cell_41['color_g'], $cell_41['color_b']);
            if (!empty($cell_41['posx']) && !empty($cell_41['posy']))
            {
                $this->Pdf->SetXY($cell_41['posx'], $cell_41['posy']);
            }
            elseif (!empty($cell_41['posx']))
            {
                $this->Pdf->SetX($cell_41['posx']);
            }
            elseif (!empty($cell_41['posy']))
            {
                $this->Pdf->SetY($cell_41['posy']);
            }
            $this->Pdf->Cell($cell_41['width'], 0, $cell_41['data'], 0, 0, $cell_41['align']);

            $this->Pdf->SetFont($cell_ProductId['font_type'], $cell_ProductId['font_style'], $cell_ProductId['font_size']);
            $this->pdf_text_color($cell_ProductId['data'], $cell_ProductId['color_r'], $cell_ProductId['color_g'], $cell_ProductId['color_b']);
            if (!empty($cell_ProductId['posx']) && !empty($cell_ProductId['posy']))
            {
                $this->Pdf->SetXY($cell_ProductId['posx'], $cell_ProductId['posy']);
            }
            elseif (!empty($cell_ProductId['posx']))
            {
                $this->Pdf->SetX($cell_ProductId['posx']);
            }
            elseif (!empty($cell_ProductId['posy']))
            {
                $this->Pdf->SetY($cell_ProductId['posy']);
            }
            $this->Pdf->Cell($cell_ProductId['width'], 0, $cell_ProductId['data'], 0, 0, $cell_ProductId['align']);

            $this->Pdf->SetFont($cell_44['font_type'], $cell_44['font_style'], $cell_44['font_size']);
            $this->pdf_text_color($cell_44['data'], $cell_44['color_r'], $cell_44['color_g'], $cell_44['color_b']);
            if (!empty($cell_44['posx']) && !empty($cell_44['posy']))
            {
                $this->Pdf->SetXY($cell_44['posx'], $cell_44['posy']);
            }
            elseif (!empty($cell_44['posx']))
            {
                $this->Pdf->SetX($cell_44['posx']);
            }
            elseif (!empty($cell_44['posy']))
            {
                $this->Pdf->SetY($cell_44['posy']);
            }
            $this->Pdf->Cell($cell_44['width'], 0, $cell_44['data'], 0, 0, $cell_44['align']);

            $this->Pdf->SetFont($cell_Extras['font_type'], $cell_Extras['font_style'], $cell_Extras['font_size']);
            $this->pdf_text_color($cell_Extras['data'], $cell_Extras['color_r'], $cell_Extras['color_g'], $cell_Extras['color_b']);
            if (!empty($cell_Extras['posx']) && !empty($cell_Extras['posy']))
            {
                $this->Pdf->SetXY($cell_Extras['posx'], $cell_Extras['posy']);
            }
            elseif (!empty($cell_Extras['posx']))
            {
                $this->Pdf->SetX($cell_Extras['posx']);
            }
            elseif (!empty($cell_Extras['posy']))
            {
                $this->Pdf->SetY($cell_Extras['posy']);
            }
            $this->Pdf->Cell($cell_Extras['width'], 0, $cell_Extras['data'], 0, 0, $cell_Extras['align']);

            $this->Pdf->SetFont($cell_47['font_type'], $cell_47['font_style'], $cell_47['font_size']);
            $this->pdf_text_color($cell_47['data'], $cell_47['color_r'], $cell_47['color_g'], $cell_47['color_b']);
            if (!empty($cell_47['posx']) && !empty($cell_47['posy']))
            {
                $this->Pdf->SetXY($cell_47['posx'], $cell_47['posy']);
            }
            elseif (!empty($cell_47['posx']))
            {
                $this->Pdf->SetX($cell_47['posx']);
            }
            elseif (!empty($cell_47['posy']))
            {
                $this->Pdf->SetY($cell_47['posy']);
            }
            $this->Pdf->Cell($cell_47['width'], 0, $cell_47['data'], 0, 0, $cell_47['align']);

            $this->Pdf->SetFont($cell_Response_ANI['font_type'], $cell_Response_ANI['font_style'], $cell_Response_ANI['font_size']);
            $this->Pdf->SetTextColor($cell_Response_ANI['color_r'], $cell_Response_ANI['color_g'], $cell_Response_ANI['color_b']);
            if (!empty($cell_Response_ANI['posx']) && !empty($cell_Response_ANI['posy']))
            {
                $this->Pdf->SetXY($cell_Response_ANI['posx'], $cell_Response_ANI['posy']);
            }
            elseif (!empty($cell_Response_ANI['posx']))
            {
                $this->Pdf->SetX($cell_Response_ANI['posx']);
            }
            elseif (!empty($cell_Response_ANI['posy']))
            {
                $this->Pdf->SetY($cell_Response_ANI['posy']);
            }
            $NM_partes_val = explode("<br>", $cell_Response_ANI['data']);
            $PosX = $this->Pdf->GetX();
            $Incre = false;
            foreach ($NM_partes_val as $Lines)
            {
                if ($Incre)
                {
                    $this->Pdf->Ln(3.175);
                }
                $this->Pdf->SetX($PosX);
                $this->Pdf->Cell($cell_Response_ANI['width'], 0, trim($Lines), 0, 0, $cell_Response_ANI['align']);
                $Incre = true;
            }
          $max_Y = 0;
          $this->rs_grid->MoveNext();
          $this->sc_proc_grid = false;
          $nm_quant_linhas++ ;
      }  
   }  
   $this->rs_grid->Close();
   $this->Pdf->Output($this->Ini->root . $this->Ini->nm_path_pdf, 'F');
 }
 function pdf_text_color(&$val, $r, $g, $b)
 {
     $pos = strpos($val, "@SCNEG#");
     if ($pos !== false)
     {
         $cor = trim(substr($val, $pos + 7));
         $val = substr($val, 0, $pos);
         $cor = (substr($cor, 0, 1) == "#") ? substr($cor, 1) : $cor;
         if (strlen($cor) == 6)
         {
             $r = hexdec(substr($cor, 0, 2));
             $g = hexdec(substr($cor, 2, 2));
             $b = hexdec(substr($cor, 4, 2));
         }
     }
     $this->Pdf->SetTextColor($r, $g, $b);
 }
 function SC_conv_utf8($input)
 {
     if ($_SESSION['scriptcase']['charset'] != "UTF-8" && !NM_is_utf8($input))
     {
         $input = sc_convert_encoding($input, "UTF-8", $_SESSION['scriptcase']['charset']);
     }
     return $input;
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
