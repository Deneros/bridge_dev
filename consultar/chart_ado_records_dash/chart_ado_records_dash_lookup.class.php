<?php
class chart_ado_records_dash_lookup
{
//  
   function lookup_sc_free_group_by_gender(&$gender) 
   {
      $conteudo = "" ; 
      if ($gender == "M")
      { 
          $conteudo = "" . $this->Ini->Nm_lang['lang_masculino'] . "";
      } 
      if ($gender == "F")
      { 
          $conteudo = "" . $this->Ini->Nm_lang['lang_femenino'] . "";
      } 
      if (!empty($conteudo)) 
      { 
          $gender = $conteudo; 
      } 
   }  
}
?>
