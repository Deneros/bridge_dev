<?php
class grid_ado_records_bck_140123_lookup
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
