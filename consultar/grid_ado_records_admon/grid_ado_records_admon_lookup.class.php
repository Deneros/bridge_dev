<?php
class grid_ado_records_admon_lookup
{
//  
   function lookup_gender(&$gender) 
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
//  
   function lookup_estadoreg(&$estadoreg) 
   {
      $conteudo = "" ; 
      if ($estadoreg == "A")
      { 
          $conteudo = "" . $this->Ini->Nm_lang['lang_activo'] . "";
      } 
      if ($estadoreg == "I")
      { 
          $conteudo = "" . $this->Ini->Nm_lang['lang_inactivo'] . "";
      } 
      if (!empty($conteudo)) 
      { 
          $estadoreg = $conteudo; 
      } 
   }  
}
?>
