<?php
class grid_ado_records_bck1_lookup
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
   function lookup_Gender_gender(&$gender) 
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
      if ($gender == "")
      { 
          $conteudo = "" . $this->Ini->Nm_lang['lang_Indeterminado'] . "";
      } 
      if (!empty($conteudo)) 
      { 
          $gender = $conteudo; 
      } 
   }  
//  
   function lookup_sc_free_group_by_extras(&$extras) 
   {
      $conteudo = "" ; 
      if ($extras == "IdState:14, StateName:Persona registrada previamente")
      { 
          $conteudo = "" . $this->Ini->Nm_lang['lang_estado_14'] . "";
      } 
      if ($extras == "IdState:15, StateName:Persona No registrada previamente")
      { 
          $conteudo = "" . $this->Ini->Nm_lang['lang_estado_15'] . "";
      } 
      if ($extras == "IdState:10, StateName:Persona registrada previamente")
      { 
          $conteudo = "" . $this->Ini->Nm_lang['lang_estado_10'] . "";
      } 
      if ($extras == "IdState:10, StateName:Rostro no corresponde")
      { 
          $conteudo = "" . $this->Ini->Nm_lang['lang_estado_10_1'] . "";
      } 
      if ($extras == "IdState:14, StateName:Rostro no corresponde")
      { 
          $conteudo = "" . $this->Ini->Nm_lang['lang_estado_14_1'] . "";
      } 
      if (!empty($conteudo)) 
      { 
          $extras = $conteudo; 
      } 
   }  
}
?>
