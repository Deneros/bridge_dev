<?php
class pdfreport_ado_records_lookup
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
}
?>
