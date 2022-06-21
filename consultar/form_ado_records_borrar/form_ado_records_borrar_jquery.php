
function scJQGeneralAdd() {
  scLoadScInput('input:text.sc-js-input');
  scLoadScInput('input:password.sc-js-input');
  scLoadScInput('input:checkbox.sc-js-input');
  scLoadScInput('input:radio.sc-js-input');
  scLoadScInput('select.sc-js-input');
  scLoadScInput('textarea.sc-js-input');

} // scJQGeneralAdd

function scFocusField(sField) {
  var $oField = $('#id_sc_field_' + sField);

  if (0 == $oField.length) {
    $oField = $('input[name=' + sField + ']');
  }

  if (0 == $oField.length && document.F1.elements[sField]) {
    $oField = $(document.F1.elements[sField]);
  }

  if ($("#id_ac_" + sField).length > 0) {
    if ($oField.hasClass("select2-hidden-accessible")) {
      if (false == scSetFocusOnField($oField)) {
        setTimeout(function() { scSetFocusOnField($oField); }, 500);
      }
    }
    else {
      if (false == scSetFocusOnField($oField)) {
        if (false == scSetFocusOnField($("#id_ac_" + sField))) {
          setTimeout(function() { scSetFocusOnField($("#id_ac_" + sField)); }, 500);
        }
      }
      else {
        setTimeout(function() { scSetFocusOnField($oField); }, 500);
      }
    }
  }
  else {
    setTimeout(function() { scSetFocusOnField($oField); }, 500);
  }
} // scFocusField

function scSetFocusOnField($oField) {
  if ($oField.length > 0 && $oField[0].offsetHeight > 0 && $oField[0].offsetWidth > 0 && !$oField[0].disabled) {
    $oField[0].focus();
    return true;
  }
  return false;
} // scSetFocusOnField

function scEventControl_init(iSeqRow) {
  scEventControl_data["record" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["uid" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["startingdate" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["creationdate" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["creationip" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["documenttype" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["idnumber" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["firstname" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["secondname" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["firstsurname" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["secondsurname" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["gender" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["birthdate" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["street" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["cedulatecondition" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["spouse" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["home" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["maritalstatus" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["dateofidentification" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["dateofdeath" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["marriagedate" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["instruction" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["placebirth" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["nationality" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["mothername" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["fathername" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["housenumber" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["profession" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["expeditioncity" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["expeditiondepartment" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["birthcity" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["birthdepartment" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["transactiontype" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["transactiontypename" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["issuedate" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["barcodetext" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["ocrtextsideone" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["ocrtextsidetwo" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["sideonewrongattempts" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["sidetwowrongattempts" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["foundonadoalert" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["adoprojectid" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["transactionid" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["productid" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["comparationfacessuccesful" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["facefound" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["facedocumentfrontfound" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["barcodefound" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["resultcomparationfaces" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["comparationfacesaproved" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["extras" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["numberphone" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["codfingerprint" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["resultqrcode" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["dactilarcode" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["reponsecontrollist" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["images" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["signeddocuments" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["scores" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["response_ani" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["parameters" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["statesignaturedocument" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["json_response" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["verifyupdate" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["estadoreg" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["record" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["record" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["uid" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["uid" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["startingdate" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["startingdate" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["creationdate" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["creationdate" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["creationip" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["creationip" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["documenttype" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["documenttype" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["idnumber" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["idnumber" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["firstname" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["firstname" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["secondname" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["secondname" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["firstsurname" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["firstsurname" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["secondsurname" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["secondsurname" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["gender" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["gender" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["birthdate" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["birthdate" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["street" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["street" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["cedulatecondition" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["cedulatecondition" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["spouse" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["spouse" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["home" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["home" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["maritalstatus" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["maritalstatus" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["dateofidentification" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["dateofidentification" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["dateofdeath" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["dateofdeath" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["marriagedate" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["marriagedate" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["instruction" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["instruction" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["placebirth" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["placebirth" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["nationality" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["nationality" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["mothername" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["mothername" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["fathername" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["fathername" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["housenumber" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["housenumber" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["profession" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["profession" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["expeditioncity" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["expeditioncity" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["expeditiondepartment" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["expeditiondepartment" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["birthcity" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["birthcity" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["birthdepartment" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["birthdepartment" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["transactiontype" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["transactiontype" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["transactiontypename" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["transactiontypename" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["issuedate" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["issuedate" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["barcodetext" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["barcodetext" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["ocrtextsideone" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["ocrtextsideone" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["ocrtextsidetwo" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["ocrtextsidetwo" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["sideonewrongattempts" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["sideonewrongattempts" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["sidetwowrongattempts" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["sidetwowrongattempts" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["foundonadoalert" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["foundonadoalert" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["adoprojectid" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["adoprojectid" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["transactionid" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["transactionid" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["productid" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["productid" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["comparationfacessuccesful" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["comparationfacessuccesful" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["facefound" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["facefound" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["facedocumentfrontfound" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["facedocumentfrontfound" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["barcodefound" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["barcodefound" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["resultcomparationfaces" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["resultcomparationfaces" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["comparationfacesaproved" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["comparationfacesaproved" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["extras" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["extras" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["numberphone" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["numberphone" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["codfingerprint" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["codfingerprint" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["resultqrcode" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["resultqrcode" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["dactilarcode" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["dactilarcode" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["reponsecontrollist" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["reponsecontrollist" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["images" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["images" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["signeddocuments" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["signeddocuments" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["scores" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["scores" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["response_ani" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["response_ani" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["parameters" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["parameters" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["statesignaturedocument" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["statesignaturedocument" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["json_response" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["json_response" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["verifyupdate" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["verifyupdate" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["estadoreg" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["estadoreg" + iSeqRow]["change"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_onFocus(oField, iSeq) {
  var fieldId, fieldName;
  fieldId = $(oField).attr("id");
  fieldName = fieldId.substr(12);
  scEventControl_data[fieldName]["blur"] = true;
  scEventControl_data[fieldName]["change"] = false;
} // scEventControl_onFocus

function scEventControl_onBlur(sFieldName) {
  scEventControl_data[sFieldName]["blur"] = false;
  if (scEventControl_data[sFieldName]["change"]) {
        if (scEventControl_data[sFieldName]["original"] == $("#id_sc_field_" + sFieldName).val() || scEventControl_data[sFieldName]["calculated"] == $("#id_sc_field_" + sFieldName).val()) {
          scEventControl_data[sFieldName]["change"] = false;
        }
  }
} // scEventControl_onBlur

function scEventControl_onChange(sFieldName) {
  scEventControl_data[sFieldName]["change"] = false;
} // scEventControl_onChange

function scEventControl_onAutocomp(sFieldName) {
  scEventControl_data[sFieldName]["autocomp"] = false;
} // scEventControl_onChange

var scEventControl_data = {};

function scJQEventsAdd(iSeqRow) {
  $('#id_sc_field_record' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_record_onblur(this, iSeqRow) })
                                    .bind('change', function() { sc_form_ado_records_borrar_record_onchange(this, iSeqRow) })
                                    .bind('focus', function() { sc_form_ado_records_borrar_record_onfocus(this, iSeqRow) });
  $('#id_sc_field_uid' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_uid_onblur(this, iSeqRow) })
                                 .bind('change', function() { sc_form_ado_records_borrar_uid_onchange(this, iSeqRow) })
                                 .bind('focus', function() { sc_form_ado_records_borrar_uid_onfocus(this, iSeqRow) });
  $('#id_sc_field_startingdate' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_startingdate_onblur(this, iSeqRow) })
                                          .bind('change', function() { sc_form_ado_records_borrar_startingdate_onchange(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_ado_records_borrar_startingdate_onfocus(this, iSeqRow) });
  $('#id_sc_field_startingdate_hora' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_startingdate_hora_onblur(this, iSeqRow) })
                                               .bind('change', function() { sc_form_ado_records_borrar_startingdate_hora_onchange(this, iSeqRow) })
                                               .bind('focus', function() { sc_form_ado_records_borrar_startingdate_hora_onfocus(this, iSeqRow) });
  $('#id_sc_field_creationdate' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_creationdate_onblur(this, iSeqRow) })
                                          .bind('change', function() { sc_form_ado_records_borrar_creationdate_onchange(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_ado_records_borrar_creationdate_onfocus(this, iSeqRow) });
  $('#id_sc_field_creationdate_hora' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_creationdate_hora_onblur(this, iSeqRow) })
                                               .bind('change', function() { sc_form_ado_records_borrar_creationdate_hora_onchange(this, iSeqRow) })
                                               .bind('focus', function() { sc_form_ado_records_borrar_creationdate_hora_onfocus(this, iSeqRow) });
  $('#id_sc_field_creationip' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_creationip_onblur(this, iSeqRow) })
                                        .bind('change', function() { sc_form_ado_records_borrar_creationip_onchange(this, iSeqRow) })
                                        .bind('focus', function() { sc_form_ado_records_borrar_creationip_onfocus(this, iSeqRow) });
  $('#id_sc_field_documenttype' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_documenttype_onblur(this, iSeqRow) })
                                          .bind('change', function() { sc_form_ado_records_borrar_documenttype_onchange(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_ado_records_borrar_documenttype_onfocus(this, iSeqRow) });
  $('#id_sc_field_idnumber' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_idnumber_onblur(this, iSeqRow) })
                                      .bind('change', function() { sc_form_ado_records_borrar_idnumber_onchange(this, iSeqRow) })
                                      .bind('focus', function() { sc_form_ado_records_borrar_idnumber_onfocus(this, iSeqRow) });
  $('#id_sc_field_firstname' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_firstname_onblur(this, iSeqRow) })
                                       .bind('change', function() { sc_form_ado_records_borrar_firstname_onchange(this, iSeqRow) })
                                       .bind('focus', function() { sc_form_ado_records_borrar_firstname_onfocus(this, iSeqRow) });
  $('#id_sc_field_secondname' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_secondname_onblur(this, iSeqRow) })
                                        .bind('change', function() { sc_form_ado_records_borrar_secondname_onchange(this, iSeqRow) })
                                        .bind('focus', function() { sc_form_ado_records_borrar_secondname_onfocus(this, iSeqRow) });
  $('#id_sc_field_firstsurname' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_firstsurname_onblur(this, iSeqRow) })
                                          .bind('change', function() { sc_form_ado_records_borrar_firstsurname_onchange(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_ado_records_borrar_firstsurname_onfocus(this, iSeqRow) });
  $('#id_sc_field_secondsurname' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_secondsurname_onblur(this, iSeqRow) })
                                           .bind('change', function() { sc_form_ado_records_borrar_secondsurname_onchange(this, iSeqRow) })
                                           .bind('focus', function() { sc_form_ado_records_borrar_secondsurname_onfocus(this, iSeqRow) });
  $('#id_sc_field_gender' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_gender_onblur(this, iSeqRow) })
                                    .bind('change', function() { sc_form_ado_records_borrar_gender_onchange(this, iSeqRow) })
                                    .bind('focus', function() { sc_form_ado_records_borrar_gender_onfocus(this, iSeqRow) });
  $('#id_sc_field_birthdate' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_birthdate_onblur(this, iSeqRow) })
                                       .bind('change', function() { sc_form_ado_records_borrar_birthdate_onchange(this, iSeqRow) })
                                       .bind('focus', function() { sc_form_ado_records_borrar_birthdate_onfocus(this, iSeqRow) });
  $('#id_sc_field_birthdate_hora' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_birthdate_hora_onblur(this, iSeqRow) })
                                            .bind('change', function() { sc_form_ado_records_borrar_birthdate_hora_onchange(this, iSeqRow) })
                                            .bind('focus', function() { sc_form_ado_records_borrar_birthdate_hora_onfocus(this, iSeqRow) });
  $('#id_sc_field_street' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_street_onblur(this, iSeqRow) })
                                    .bind('change', function() { sc_form_ado_records_borrar_street_onchange(this, iSeqRow) })
                                    .bind('focus', function() { sc_form_ado_records_borrar_street_onfocus(this, iSeqRow) });
  $('#id_sc_field_cedulatecondition' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_cedulatecondition_onblur(this, iSeqRow) })
                                               .bind('change', function() { sc_form_ado_records_borrar_cedulatecondition_onchange(this, iSeqRow) })
                                               .bind('focus', function() { sc_form_ado_records_borrar_cedulatecondition_onfocus(this, iSeqRow) });
  $('#id_sc_field_spouse' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_spouse_onblur(this, iSeqRow) })
                                    .bind('change', function() { sc_form_ado_records_borrar_spouse_onchange(this, iSeqRow) })
                                    .bind('focus', function() { sc_form_ado_records_borrar_spouse_onfocus(this, iSeqRow) });
  $('#id_sc_field_home' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_home_onblur(this, iSeqRow) })
                                  .bind('change', function() { sc_form_ado_records_borrar_home_onchange(this, iSeqRow) })
                                  .bind('focus', function() { sc_form_ado_records_borrar_home_onfocus(this, iSeqRow) });
  $('#id_sc_field_maritalstatus' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_maritalstatus_onblur(this, iSeqRow) })
                                           .bind('change', function() { sc_form_ado_records_borrar_maritalstatus_onchange(this, iSeqRow) })
                                           .bind('focus', function() { sc_form_ado_records_borrar_maritalstatus_onfocus(this, iSeqRow) });
  $('#id_sc_field_dateofidentification' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_dateofidentification_onblur(this, iSeqRow) })
                                                  .bind('change', function() { sc_form_ado_records_borrar_dateofidentification_onchange(this, iSeqRow) })
                                                  .bind('focus', function() { sc_form_ado_records_borrar_dateofidentification_onfocus(this, iSeqRow) });
  $('#id_sc_field_dateofidentification_hora' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_dateofidentification_hora_onblur(this, iSeqRow) })
                                                       .bind('change', function() { sc_form_ado_records_borrar_dateofidentification_hora_onchange(this, iSeqRow) })
                                                       .bind('focus', function() { sc_form_ado_records_borrar_dateofidentification_hora_onfocus(this, iSeqRow) });
  $('#id_sc_field_dateofdeath' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_dateofdeath_onblur(this, iSeqRow) })
                                         .bind('change', function() { sc_form_ado_records_borrar_dateofdeath_onchange(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_ado_records_borrar_dateofdeath_onfocus(this, iSeqRow) });
  $('#id_sc_field_dateofdeath_hora' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_dateofdeath_hora_onblur(this, iSeqRow) })
                                              .bind('change', function() { sc_form_ado_records_borrar_dateofdeath_hora_onchange(this, iSeqRow) })
                                              .bind('focus', function() { sc_form_ado_records_borrar_dateofdeath_hora_onfocus(this, iSeqRow) });
  $('#id_sc_field_marriagedate' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_marriagedate_onblur(this, iSeqRow) })
                                          .bind('change', function() { sc_form_ado_records_borrar_marriagedate_onchange(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_ado_records_borrar_marriagedate_onfocus(this, iSeqRow) });
  $('#id_sc_field_marriagedate_hora' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_marriagedate_hora_onblur(this, iSeqRow) })
                                               .bind('change', function() { sc_form_ado_records_borrar_marriagedate_hora_onchange(this, iSeqRow) })
                                               .bind('focus', function() { sc_form_ado_records_borrar_marriagedate_hora_onfocus(this, iSeqRow) });
  $('#id_sc_field_instruction' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_instruction_onblur(this, iSeqRow) })
                                         .bind('change', function() { sc_form_ado_records_borrar_instruction_onchange(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_ado_records_borrar_instruction_onfocus(this, iSeqRow) });
  $('#id_sc_field_placebirth' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_placebirth_onblur(this, iSeqRow) })
                                        .bind('change', function() { sc_form_ado_records_borrar_placebirth_onchange(this, iSeqRow) })
                                        .bind('focus', function() { sc_form_ado_records_borrar_placebirth_onfocus(this, iSeqRow) });
  $('#id_sc_field_nationality' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_nationality_onblur(this, iSeqRow) })
                                         .bind('change', function() { sc_form_ado_records_borrar_nationality_onchange(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_ado_records_borrar_nationality_onfocus(this, iSeqRow) });
  $('#id_sc_field_mothername' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_mothername_onblur(this, iSeqRow) })
                                        .bind('change', function() { sc_form_ado_records_borrar_mothername_onchange(this, iSeqRow) })
                                        .bind('focus', function() { sc_form_ado_records_borrar_mothername_onfocus(this, iSeqRow) });
  $('#id_sc_field_fathername' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_fathername_onblur(this, iSeqRow) })
                                        .bind('change', function() { sc_form_ado_records_borrar_fathername_onchange(this, iSeqRow) })
                                        .bind('focus', function() { sc_form_ado_records_borrar_fathername_onfocus(this, iSeqRow) });
  $('#id_sc_field_housenumber' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_housenumber_onblur(this, iSeqRow) })
                                         .bind('change', function() { sc_form_ado_records_borrar_housenumber_onchange(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_ado_records_borrar_housenumber_onfocus(this, iSeqRow) });
  $('#id_sc_field_profession' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_profession_onblur(this, iSeqRow) })
                                        .bind('change', function() { sc_form_ado_records_borrar_profession_onchange(this, iSeqRow) })
                                        .bind('focus', function() { sc_form_ado_records_borrar_profession_onfocus(this, iSeqRow) });
  $('#id_sc_field_expeditioncity' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_expeditioncity_onblur(this, iSeqRow) })
                                            .bind('change', function() { sc_form_ado_records_borrar_expeditioncity_onchange(this, iSeqRow) })
                                            .bind('focus', function() { sc_form_ado_records_borrar_expeditioncity_onfocus(this, iSeqRow) });
  $('#id_sc_field_expeditiondepartment' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_expeditiondepartment_onblur(this, iSeqRow) })
                                                  .bind('change', function() { sc_form_ado_records_borrar_expeditiondepartment_onchange(this, iSeqRow) })
                                                  .bind('focus', function() { sc_form_ado_records_borrar_expeditiondepartment_onfocus(this, iSeqRow) });
  $('#id_sc_field_birthcity' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_birthcity_onblur(this, iSeqRow) })
                                       .bind('change', function() { sc_form_ado_records_borrar_birthcity_onchange(this, iSeqRow) })
                                       .bind('focus', function() { sc_form_ado_records_borrar_birthcity_onfocus(this, iSeqRow) });
  $('#id_sc_field_birthdepartment' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_birthdepartment_onblur(this, iSeqRow) })
                                             .bind('change', function() { sc_form_ado_records_borrar_birthdepartment_onchange(this, iSeqRow) })
                                             .bind('focus', function() { sc_form_ado_records_borrar_birthdepartment_onfocus(this, iSeqRow) });
  $('#id_sc_field_transactiontype' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_transactiontype_onblur(this, iSeqRow) })
                                             .bind('change', function() { sc_form_ado_records_borrar_transactiontype_onchange(this, iSeqRow) })
                                             .bind('focus', function() { sc_form_ado_records_borrar_transactiontype_onfocus(this, iSeqRow) });
  $('#id_sc_field_transactiontypename' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_transactiontypename_onblur(this, iSeqRow) })
                                                 .bind('change', function() { sc_form_ado_records_borrar_transactiontypename_onchange(this, iSeqRow) })
                                                 .bind('focus', function() { sc_form_ado_records_borrar_transactiontypename_onfocus(this, iSeqRow) });
  $('#id_sc_field_issuedate' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_issuedate_onblur(this, iSeqRow) })
                                       .bind('change', function() { sc_form_ado_records_borrar_issuedate_onchange(this, iSeqRow) })
                                       .bind('focus', function() { sc_form_ado_records_borrar_issuedate_onfocus(this, iSeqRow) });
  $('#id_sc_field_issuedate_hora' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_issuedate_hora_onblur(this, iSeqRow) })
                                            .bind('change', function() { sc_form_ado_records_borrar_issuedate_hora_onchange(this, iSeqRow) })
                                            .bind('focus', function() { sc_form_ado_records_borrar_issuedate_hora_onfocus(this, iSeqRow) });
  $('#id_sc_field_barcodetext' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_barcodetext_onblur(this, iSeqRow) })
                                         .bind('change', function() { sc_form_ado_records_borrar_barcodetext_onchange(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_ado_records_borrar_barcodetext_onfocus(this, iSeqRow) });
  $('#id_sc_field_ocrtextsideone' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_ocrtextsideone_onblur(this, iSeqRow) })
                                            .bind('change', function() { sc_form_ado_records_borrar_ocrtextsideone_onchange(this, iSeqRow) })
                                            .bind('focus', function() { sc_form_ado_records_borrar_ocrtextsideone_onfocus(this, iSeqRow) });
  $('#id_sc_field_ocrtextsidetwo' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_ocrtextsidetwo_onblur(this, iSeqRow) })
                                            .bind('change', function() { sc_form_ado_records_borrar_ocrtextsidetwo_onchange(this, iSeqRow) })
                                            .bind('focus', function() { sc_form_ado_records_borrar_ocrtextsidetwo_onfocus(this, iSeqRow) });
  $('#id_sc_field_sideonewrongattempts' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_sideonewrongattempts_onblur(this, iSeqRow) })
                                                  .bind('change', function() { sc_form_ado_records_borrar_sideonewrongattempts_onchange(this, iSeqRow) })
                                                  .bind('focus', function() { sc_form_ado_records_borrar_sideonewrongattempts_onfocus(this, iSeqRow) });
  $('#id_sc_field_sidetwowrongattempts' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_sidetwowrongattempts_onblur(this, iSeqRow) })
                                                  .bind('change', function() { sc_form_ado_records_borrar_sidetwowrongattempts_onchange(this, iSeqRow) })
                                                  .bind('focus', function() { sc_form_ado_records_borrar_sidetwowrongattempts_onfocus(this, iSeqRow) });
  $('#id_sc_field_foundonadoalert' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_foundonadoalert_onblur(this, iSeqRow) })
                                             .bind('change', function() { sc_form_ado_records_borrar_foundonadoalert_onchange(this, iSeqRow) })
                                             .bind('focus', function() { sc_form_ado_records_borrar_foundonadoalert_onfocus(this, iSeqRow) });
  $('#id_sc_field_adoprojectid' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_adoprojectid_onblur(this, iSeqRow) })
                                          .bind('change', function() { sc_form_ado_records_borrar_adoprojectid_onchange(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_ado_records_borrar_adoprojectid_onfocus(this, iSeqRow) });
  $('#id_sc_field_transactionid' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_transactionid_onblur(this, iSeqRow) })
                                           .bind('change', function() { sc_form_ado_records_borrar_transactionid_onchange(this, iSeqRow) })
                                           .bind('focus', function() { sc_form_ado_records_borrar_transactionid_onfocus(this, iSeqRow) });
  $('#id_sc_field_productid' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_productid_onblur(this, iSeqRow) })
                                       .bind('change', function() { sc_form_ado_records_borrar_productid_onchange(this, iSeqRow) })
                                       .bind('focus', function() { sc_form_ado_records_borrar_productid_onfocus(this, iSeqRow) });
  $('#id_sc_field_comparationfacessuccesful' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_comparationfacessuccesful_onblur(this, iSeqRow) })
                                                       .bind('change', function() { sc_form_ado_records_borrar_comparationfacessuccesful_onchange(this, iSeqRow) })
                                                       .bind('focus', function() { sc_form_ado_records_borrar_comparationfacessuccesful_onfocus(this, iSeqRow) });
  $('#id_sc_field_facefound' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_facefound_onblur(this, iSeqRow) })
                                       .bind('change', function() { sc_form_ado_records_borrar_facefound_onchange(this, iSeqRow) })
                                       .bind('focus', function() { sc_form_ado_records_borrar_facefound_onfocus(this, iSeqRow) });
  $('#id_sc_field_facedocumentfrontfound' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_facedocumentfrontfound_onblur(this, iSeqRow) })
                                                    .bind('change', function() { sc_form_ado_records_borrar_facedocumentfrontfound_onchange(this, iSeqRow) })
                                                    .bind('focus', function() { sc_form_ado_records_borrar_facedocumentfrontfound_onfocus(this, iSeqRow) });
  $('#id_sc_field_barcodefound' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_barcodefound_onblur(this, iSeqRow) })
                                          .bind('change', function() { sc_form_ado_records_borrar_barcodefound_onchange(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_ado_records_borrar_barcodefound_onfocus(this, iSeqRow) });
  $('#id_sc_field_resultcomparationfaces' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_resultcomparationfaces_onblur(this, iSeqRow) })
                                                    .bind('change', function() { sc_form_ado_records_borrar_resultcomparationfaces_onchange(this, iSeqRow) })
                                                    .bind('focus', function() { sc_form_ado_records_borrar_resultcomparationfaces_onfocus(this, iSeqRow) });
  $('#id_sc_field_comparationfacesaproved' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_comparationfacesaproved_onblur(this, iSeqRow) })
                                                     .bind('change', function() { sc_form_ado_records_borrar_comparationfacesaproved_onchange(this, iSeqRow) })
                                                     .bind('focus', function() { sc_form_ado_records_borrar_comparationfacesaproved_onfocus(this, iSeqRow) });
  $('#id_sc_field_extras' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_extras_onblur(this, iSeqRow) })
                                    .bind('change', function() { sc_form_ado_records_borrar_extras_onchange(this, iSeqRow) })
                                    .bind('focus', function() { sc_form_ado_records_borrar_extras_onfocus(this, iSeqRow) });
  $('#id_sc_field_numberphone' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_numberphone_onblur(this, iSeqRow) })
                                         .bind('change', function() { sc_form_ado_records_borrar_numberphone_onchange(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_ado_records_borrar_numberphone_onfocus(this, iSeqRow) });
  $('#id_sc_field_codfingerprint' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_codfingerprint_onblur(this, iSeqRow) })
                                            .bind('change', function() { sc_form_ado_records_borrar_codfingerprint_onchange(this, iSeqRow) })
                                            .bind('focus', function() { sc_form_ado_records_borrar_codfingerprint_onfocus(this, iSeqRow) });
  $('#id_sc_field_resultqrcode' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_resultqrcode_onblur(this, iSeqRow) })
                                          .bind('change', function() { sc_form_ado_records_borrar_resultqrcode_onchange(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_ado_records_borrar_resultqrcode_onfocus(this, iSeqRow) });
  $('#id_sc_field_dactilarcode' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_dactilarcode_onblur(this, iSeqRow) })
                                          .bind('change', function() { sc_form_ado_records_borrar_dactilarcode_onchange(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_ado_records_borrar_dactilarcode_onfocus(this, iSeqRow) });
  $('#id_sc_field_reponsecontrollist' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_reponsecontrollist_onblur(this, iSeqRow) })
                                                .bind('change', function() { sc_form_ado_records_borrar_reponsecontrollist_onchange(this, iSeqRow) })
                                                .bind('focus', function() { sc_form_ado_records_borrar_reponsecontrollist_onfocus(this, iSeqRow) });
  $('#id_sc_field_images' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_images_onblur(this, iSeqRow) })
                                    .bind('change', function() { sc_form_ado_records_borrar_images_onchange(this, iSeqRow) })
                                    .bind('focus', function() { sc_form_ado_records_borrar_images_onfocus(this, iSeqRow) });
  $('#id_sc_field_signeddocuments' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_signeddocuments_onblur(this, iSeqRow) })
                                             .bind('change', function() { sc_form_ado_records_borrar_signeddocuments_onchange(this, iSeqRow) })
                                             .bind('focus', function() { sc_form_ado_records_borrar_signeddocuments_onfocus(this, iSeqRow) });
  $('#id_sc_field_scores' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_scores_onblur(this, iSeqRow) })
                                    .bind('change', function() { sc_form_ado_records_borrar_scores_onchange(this, iSeqRow) })
                                    .bind('focus', function() { sc_form_ado_records_borrar_scores_onfocus(this, iSeqRow) });
  $('#id_sc_field_response_ani' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_response_ani_onblur(this, iSeqRow) })
                                          .bind('change', function() { sc_form_ado_records_borrar_response_ani_onchange(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_ado_records_borrar_response_ani_onfocus(this, iSeqRow) });
  $('#id_sc_field_parameters' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_parameters_onblur(this, iSeqRow) })
                                        .bind('change', function() { sc_form_ado_records_borrar_parameters_onchange(this, iSeqRow) })
                                        .bind('focus', function() { sc_form_ado_records_borrar_parameters_onfocus(this, iSeqRow) });
  $('#id_sc_field_statesignaturedocument' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_statesignaturedocument_onblur(this, iSeqRow) })
                                                    .bind('change', function() { sc_form_ado_records_borrar_statesignaturedocument_onchange(this, iSeqRow) })
                                                    .bind('focus', function() { sc_form_ado_records_borrar_statesignaturedocument_onfocus(this, iSeqRow) });
  $('#id_sc_field_json_response' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_json_response_onblur(this, iSeqRow) })
                                           .bind('change', function() { sc_form_ado_records_borrar_json_response_onchange(this, iSeqRow) })
                                           .bind('focus', function() { sc_form_ado_records_borrar_json_response_onfocus(this, iSeqRow) });
  $('#id_sc_field_verifyupdate' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_verifyupdate_onblur(this, iSeqRow) })
                                          .bind('change', function() { sc_form_ado_records_borrar_verifyupdate_onchange(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_ado_records_borrar_verifyupdate_onfocus(this, iSeqRow) });
  $('#id_sc_field_estadoreg' + iSeqRow).bind('blur', function() { sc_form_ado_records_borrar_estadoreg_onblur(this, iSeqRow) })
                                       .bind('change', function() { sc_form_ado_records_borrar_estadoreg_onchange(this, iSeqRow) })
                                       .bind('focus', function() { sc_form_ado_records_borrar_estadoreg_onfocus(this, iSeqRow) });
} // scJQEventsAdd

function sc_form_ado_records_borrar_record_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_record();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_record_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_record_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_uid_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_uid();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_uid_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_uid_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_startingdate_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_startingdate();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_startingdate_hora_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_startingdate();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_startingdate_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_startingdate_hora_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_startingdate_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_startingdate_hora_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_creationdate_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_creationdate();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_creationdate_hora_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_creationdate();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_creationdate_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_creationdate_hora_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_creationdate_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_creationdate_hora_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_creationip_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_creationip();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_creationip_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_creationip_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_documenttype_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_documenttype();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_documenttype_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_documenttype_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_idnumber_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_idnumber();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_idnumber_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_idnumber_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_firstname_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_firstname();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_firstname_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_firstname_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_secondname_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_secondname();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_secondname_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_secondname_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_firstsurname_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_firstsurname();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_firstsurname_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_firstsurname_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_secondsurname_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_secondsurname();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_secondsurname_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_secondsurname_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_gender_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_gender();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_gender_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_gender_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_birthdate_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_birthdate();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_birthdate_hora_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_birthdate();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_birthdate_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_birthdate_hora_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_birthdate_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_birthdate_hora_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_street_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_street();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_street_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_street_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_cedulatecondition_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_cedulatecondition();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_cedulatecondition_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_cedulatecondition_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_spouse_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_spouse();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_spouse_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_spouse_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_home_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_home();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_home_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_home_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_maritalstatus_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_maritalstatus();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_maritalstatus_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_maritalstatus_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_dateofidentification_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_dateofidentification();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_dateofidentification_hora_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_dateofidentification();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_dateofidentification_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_dateofidentification_hora_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_dateofidentification_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_dateofidentification_hora_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_dateofdeath_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_dateofdeath();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_dateofdeath_hora_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_dateofdeath();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_dateofdeath_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_dateofdeath_hora_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_dateofdeath_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_dateofdeath_hora_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_marriagedate_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_marriagedate();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_marriagedate_hora_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_marriagedate();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_marriagedate_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_marriagedate_hora_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_marriagedate_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_marriagedate_hora_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_instruction_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_instruction();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_instruction_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_instruction_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_placebirth_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_placebirth();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_placebirth_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_placebirth_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_nationality_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_nationality();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_nationality_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_nationality_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_mothername_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_mothername();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_mothername_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_mothername_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_fathername_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_fathername();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_fathername_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_fathername_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_housenumber_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_housenumber();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_housenumber_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_housenumber_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_profession_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_profession();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_profession_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_profession_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_expeditioncity_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_expeditioncity();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_expeditioncity_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_expeditioncity_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_expeditiondepartment_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_expeditiondepartment();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_expeditiondepartment_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_expeditiondepartment_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_birthcity_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_birthcity();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_birthcity_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_birthcity_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_birthdepartment_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_birthdepartment();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_birthdepartment_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_birthdepartment_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_transactiontype_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_transactiontype();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_transactiontype_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_transactiontype_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_transactiontypename_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_transactiontypename();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_transactiontypename_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_transactiontypename_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_issuedate_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_issuedate();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_issuedate_hora_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_issuedate();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_issuedate_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_issuedate_hora_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_issuedate_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_issuedate_hora_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_barcodetext_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_barcodetext();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_barcodetext_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_barcodetext_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_ocrtextsideone_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_ocrtextsideone();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_ocrtextsideone_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_ocrtextsideone_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_ocrtextsidetwo_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_ocrtextsidetwo();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_ocrtextsidetwo_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_ocrtextsidetwo_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_sideonewrongattempts_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_sideonewrongattempts();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_sideonewrongattempts_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_sideonewrongattempts_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_sidetwowrongattempts_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_sidetwowrongattempts();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_sidetwowrongattempts_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_sidetwowrongattempts_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_foundonadoalert_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_foundonadoalert();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_foundonadoalert_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_foundonadoalert_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_adoprojectid_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_adoprojectid();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_adoprojectid_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_adoprojectid_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_transactionid_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_transactionid();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_transactionid_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_transactionid_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_productid_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_productid();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_productid_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_productid_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_comparationfacessuccesful_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_comparationfacessuccesful();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_comparationfacessuccesful_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_comparationfacessuccesful_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_facefound_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_facefound();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_facefound_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_facefound_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_facedocumentfrontfound_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_facedocumentfrontfound();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_facedocumentfrontfound_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_facedocumentfrontfound_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_barcodefound_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_barcodefound();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_barcodefound_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_barcodefound_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_resultcomparationfaces_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_resultcomparationfaces();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_resultcomparationfaces_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_resultcomparationfaces_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_comparationfacesaproved_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_comparationfacesaproved();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_comparationfacesaproved_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_comparationfacesaproved_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_extras_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_extras();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_extras_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_extras_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_numberphone_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_numberphone();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_numberphone_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_numberphone_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_codfingerprint_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_codfingerprint();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_codfingerprint_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_codfingerprint_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_resultqrcode_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_resultqrcode();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_resultqrcode_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_resultqrcode_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_dactilarcode_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_dactilarcode();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_dactilarcode_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_dactilarcode_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_reponsecontrollist_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_reponsecontrollist();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_reponsecontrollist_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_reponsecontrollist_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_images_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_images();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_images_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_images_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_signeddocuments_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_signeddocuments();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_signeddocuments_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_signeddocuments_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_scores_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_scores();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_scores_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_scores_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_response_ani_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_response_ani();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_response_ani_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_response_ani_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_parameters_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_parameters();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_parameters_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_parameters_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_statesignaturedocument_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_statesignaturedocument();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_statesignaturedocument_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_statesignaturedocument_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_json_response_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_json_response();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_json_response_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_json_response_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_verifyupdate_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_verifyupdate();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_verifyupdate_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_verifyupdate_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_ado_records_borrar_estadoreg_onblur(oThis, iSeqRow) {
  do_ajax_form_ado_records_borrar_validate_estadoreg();
  scCssBlur(oThis);
}

function sc_form_ado_records_borrar_estadoreg_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_ado_records_borrar_estadoreg_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function displayChange_block(block, status) {
	if ("0" == block) {
		displayChange_block_0(status);
	}
}

function displayChange_block_0(status) {
	displayChange_field("record", "", status);
	displayChange_field("uid", "", status);
	displayChange_field("startingdate", "", status);
	displayChange_field("creationdate", "", status);
	displayChange_field("creationip", "", status);
	displayChange_field("documenttype", "", status);
	displayChange_field("idnumber", "", status);
	displayChange_field("firstname", "", status);
	displayChange_field("secondname", "", status);
	displayChange_field("firstsurname", "", status);
	displayChange_field("secondsurname", "", status);
	displayChange_field("gender", "", status);
	displayChange_field("birthdate", "", status);
	displayChange_field("street", "", status);
	displayChange_field("cedulatecondition", "", status);
	displayChange_field("spouse", "", status);
	displayChange_field("home", "", status);
	displayChange_field("maritalstatus", "", status);
	displayChange_field("dateofidentification", "", status);
	displayChange_field("dateofdeath", "", status);
	displayChange_field("marriagedate", "", status);
	displayChange_field("instruction", "", status);
	displayChange_field("placebirth", "", status);
	displayChange_field("nationality", "", status);
	displayChange_field("mothername", "", status);
	displayChange_field("fathername", "", status);
	displayChange_field("housenumber", "", status);
	displayChange_field("profession", "", status);
	displayChange_field("expeditioncity", "", status);
	displayChange_field("expeditiondepartment", "", status);
	displayChange_field("birthcity", "", status);
	displayChange_field("birthdepartment", "", status);
	displayChange_field("transactiontype", "", status);
	displayChange_field("transactiontypename", "", status);
	displayChange_field("issuedate", "", status);
	displayChange_field("barcodetext", "", status);
	displayChange_field("ocrtextsideone", "", status);
	displayChange_field("ocrtextsidetwo", "", status);
	displayChange_field("sideonewrongattempts", "", status);
	displayChange_field("sidetwowrongattempts", "", status);
	displayChange_field("foundonadoalert", "", status);
	displayChange_field("adoprojectid", "", status);
	displayChange_field("transactionid", "", status);
	displayChange_field("productid", "", status);
	displayChange_field("comparationfacessuccesful", "", status);
	displayChange_field("facefound", "", status);
	displayChange_field("facedocumentfrontfound", "", status);
	displayChange_field("barcodefound", "", status);
	displayChange_field("resultcomparationfaces", "", status);
	displayChange_field("comparationfacesaproved", "", status);
	displayChange_field("extras", "", status);
	displayChange_field("numberphone", "", status);
	displayChange_field("codfingerprint", "", status);
	displayChange_field("resultqrcode", "", status);
	displayChange_field("dactilarcode", "", status);
	displayChange_field("reponsecontrollist", "", status);
	displayChange_field("images", "", status);
	displayChange_field("signeddocuments", "", status);
	displayChange_field("scores", "", status);
	displayChange_field("response_ani", "", status);
	displayChange_field("parameters", "", status);
	displayChange_field("statesignaturedocument", "", status);
	displayChange_field("json_response", "", status);
	displayChange_field("verifyupdate", "", status);
	displayChange_field("estadoreg", "", status);
}

function displayChange_row(row, status) {
	displayChange_field_record(row, status);
	displayChange_field_uid(row, status);
	displayChange_field_startingdate(row, status);
	displayChange_field_creationdate(row, status);
	displayChange_field_creationip(row, status);
	displayChange_field_documenttype(row, status);
	displayChange_field_idnumber(row, status);
	displayChange_field_firstname(row, status);
	displayChange_field_secondname(row, status);
	displayChange_field_firstsurname(row, status);
	displayChange_field_secondsurname(row, status);
	displayChange_field_gender(row, status);
	displayChange_field_birthdate(row, status);
	displayChange_field_street(row, status);
	displayChange_field_cedulatecondition(row, status);
	displayChange_field_spouse(row, status);
	displayChange_field_home(row, status);
	displayChange_field_maritalstatus(row, status);
	displayChange_field_dateofidentification(row, status);
	displayChange_field_dateofdeath(row, status);
	displayChange_field_marriagedate(row, status);
	displayChange_field_instruction(row, status);
	displayChange_field_placebirth(row, status);
	displayChange_field_nationality(row, status);
	displayChange_field_mothername(row, status);
	displayChange_field_fathername(row, status);
	displayChange_field_housenumber(row, status);
	displayChange_field_profession(row, status);
	displayChange_field_expeditioncity(row, status);
	displayChange_field_expeditiondepartment(row, status);
	displayChange_field_birthcity(row, status);
	displayChange_field_birthdepartment(row, status);
	displayChange_field_transactiontype(row, status);
	displayChange_field_transactiontypename(row, status);
	displayChange_field_issuedate(row, status);
	displayChange_field_barcodetext(row, status);
	displayChange_field_ocrtextsideone(row, status);
	displayChange_field_ocrtextsidetwo(row, status);
	displayChange_field_sideonewrongattempts(row, status);
	displayChange_field_sidetwowrongattempts(row, status);
	displayChange_field_foundonadoalert(row, status);
	displayChange_field_adoprojectid(row, status);
	displayChange_field_transactionid(row, status);
	displayChange_field_productid(row, status);
	displayChange_field_comparationfacessuccesful(row, status);
	displayChange_field_facefound(row, status);
	displayChange_field_facedocumentfrontfound(row, status);
	displayChange_field_barcodefound(row, status);
	displayChange_field_resultcomparationfaces(row, status);
	displayChange_field_comparationfacesaproved(row, status);
	displayChange_field_extras(row, status);
	displayChange_field_numberphone(row, status);
	displayChange_field_codfingerprint(row, status);
	displayChange_field_resultqrcode(row, status);
	displayChange_field_dactilarcode(row, status);
	displayChange_field_reponsecontrollist(row, status);
	displayChange_field_images(row, status);
	displayChange_field_signeddocuments(row, status);
	displayChange_field_scores(row, status);
	displayChange_field_response_ani(row, status);
	displayChange_field_parameters(row, status);
	displayChange_field_statesignaturedocument(row, status);
	displayChange_field_json_response(row, status);
	displayChange_field_verifyupdate(row, status);
	displayChange_field_estadoreg(row, status);
}

function displayChange_field(field, row, status) {
	if ("record" == field) {
		displayChange_field_record(row, status);
	}
	if ("uid" == field) {
		displayChange_field_uid(row, status);
	}
	if ("startingdate" == field) {
		displayChange_field_startingdate(row, status);
	}
	if ("creationdate" == field) {
		displayChange_field_creationdate(row, status);
	}
	if ("creationip" == field) {
		displayChange_field_creationip(row, status);
	}
	if ("documenttype" == field) {
		displayChange_field_documenttype(row, status);
	}
	if ("idnumber" == field) {
		displayChange_field_idnumber(row, status);
	}
	if ("firstname" == field) {
		displayChange_field_firstname(row, status);
	}
	if ("secondname" == field) {
		displayChange_field_secondname(row, status);
	}
	if ("firstsurname" == field) {
		displayChange_field_firstsurname(row, status);
	}
	if ("secondsurname" == field) {
		displayChange_field_secondsurname(row, status);
	}
	if ("gender" == field) {
		displayChange_field_gender(row, status);
	}
	if ("birthdate" == field) {
		displayChange_field_birthdate(row, status);
	}
	if ("street" == field) {
		displayChange_field_street(row, status);
	}
	if ("cedulatecondition" == field) {
		displayChange_field_cedulatecondition(row, status);
	}
	if ("spouse" == field) {
		displayChange_field_spouse(row, status);
	}
	if ("home" == field) {
		displayChange_field_home(row, status);
	}
	if ("maritalstatus" == field) {
		displayChange_field_maritalstatus(row, status);
	}
	if ("dateofidentification" == field) {
		displayChange_field_dateofidentification(row, status);
	}
	if ("dateofdeath" == field) {
		displayChange_field_dateofdeath(row, status);
	}
	if ("marriagedate" == field) {
		displayChange_field_marriagedate(row, status);
	}
	if ("instruction" == field) {
		displayChange_field_instruction(row, status);
	}
	if ("placebirth" == field) {
		displayChange_field_placebirth(row, status);
	}
	if ("nationality" == field) {
		displayChange_field_nationality(row, status);
	}
	if ("mothername" == field) {
		displayChange_field_mothername(row, status);
	}
	if ("fathername" == field) {
		displayChange_field_fathername(row, status);
	}
	if ("housenumber" == field) {
		displayChange_field_housenumber(row, status);
	}
	if ("profession" == field) {
		displayChange_field_profession(row, status);
	}
	if ("expeditioncity" == field) {
		displayChange_field_expeditioncity(row, status);
	}
	if ("expeditiondepartment" == field) {
		displayChange_field_expeditiondepartment(row, status);
	}
	if ("birthcity" == field) {
		displayChange_field_birthcity(row, status);
	}
	if ("birthdepartment" == field) {
		displayChange_field_birthdepartment(row, status);
	}
	if ("transactiontype" == field) {
		displayChange_field_transactiontype(row, status);
	}
	if ("transactiontypename" == field) {
		displayChange_field_transactiontypename(row, status);
	}
	if ("issuedate" == field) {
		displayChange_field_issuedate(row, status);
	}
	if ("barcodetext" == field) {
		displayChange_field_barcodetext(row, status);
	}
	if ("ocrtextsideone" == field) {
		displayChange_field_ocrtextsideone(row, status);
	}
	if ("ocrtextsidetwo" == field) {
		displayChange_field_ocrtextsidetwo(row, status);
	}
	if ("sideonewrongattempts" == field) {
		displayChange_field_sideonewrongattempts(row, status);
	}
	if ("sidetwowrongattempts" == field) {
		displayChange_field_sidetwowrongattempts(row, status);
	}
	if ("foundonadoalert" == field) {
		displayChange_field_foundonadoalert(row, status);
	}
	if ("adoprojectid" == field) {
		displayChange_field_adoprojectid(row, status);
	}
	if ("transactionid" == field) {
		displayChange_field_transactionid(row, status);
	}
	if ("productid" == field) {
		displayChange_field_productid(row, status);
	}
	if ("comparationfacessuccesful" == field) {
		displayChange_field_comparationfacessuccesful(row, status);
	}
	if ("facefound" == field) {
		displayChange_field_facefound(row, status);
	}
	if ("facedocumentfrontfound" == field) {
		displayChange_field_facedocumentfrontfound(row, status);
	}
	if ("barcodefound" == field) {
		displayChange_field_barcodefound(row, status);
	}
	if ("resultcomparationfaces" == field) {
		displayChange_field_resultcomparationfaces(row, status);
	}
	if ("comparationfacesaproved" == field) {
		displayChange_field_comparationfacesaproved(row, status);
	}
	if ("extras" == field) {
		displayChange_field_extras(row, status);
	}
	if ("numberphone" == field) {
		displayChange_field_numberphone(row, status);
	}
	if ("codfingerprint" == field) {
		displayChange_field_codfingerprint(row, status);
	}
	if ("resultqrcode" == field) {
		displayChange_field_resultqrcode(row, status);
	}
	if ("dactilarcode" == field) {
		displayChange_field_dactilarcode(row, status);
	}
	if ("reponsecontrollist" == field) {
		displayChange_field_reponsecontrollist(row, status);
	}
	if ("images" == field) {
		displayChange_field_images(row, status);
	}
	if ("signeddocuments" == field) {
		displayChange_field_signeddocuments(row, status);
	}
	if ("scores" == field) {
		displayChange_field_scores(row, status);
	}
	if ("response_ani" == field) {
		displayChange_field_response_ani(row, status);
	}
	if ("parameters" == field) {
		displayChange_field_parameters(row, status);
	}
	if ("statesignaturedocument" == field) {
		displayChange_field_statesignaturedocument(row, status);
	}
	if ("json_response" == field) {
		displayChange_field_json_response(row, status);
	}
	if ("verifyupdate" == field) {
		displayChange_field_verifyupdate(row, status);
	}
	if ("estadoreg" == field) {
		displayChange_field_estadoreg(row, status);
	}
}

function displayChange_field_record(row, status) {
}

function displayChange_field_uid(row, status) {
}

function displayChange_field_startingdate(row, status) {
}

function displayChange_field_creationdate(row, status) {
}

function displayChange_field_creationip(row, status) {
}

function displayChange_field_documenttype(row, status) {
}

function displayChange_field_idnumber(row, status) {
}

function displayChange_field_firstname(row, status) {
}

function displayChange_field_secondname(row, status) {
}

function displayChange_field_firstsurname(row, status) {
}

function displayChange_field_secondsurname(row, status) {
}

function displayChange_field_gender(row, status) {
}

function displayChange_field_birthdate(row, status) {
}

function displayChange_field_street(row, status) {
}

function displayChange_field_cedulatecondition(row, status) {
}

function displayChange_field_spouse(row, status) {
}

function displayChange_field_home(row, status) {
}

function displayChange_field_maritalstatus(row, status) {
}

function displayChange_field_dateofidentification(row, status) {
}

function displayChange_field_dateofdeath(row, status) {
}

function displayChange_field_marriagedate(row, status) {
}

function displayChange_field_instruction(row, status) {
}

function displayChange_field_placebirth(row, status) {
}

function displayChange_field_nationality(row, status) {
}

function displayChange_field_mothername(row, status) {
}

function displayChange_field_fathername(row, status) {
}

function displayChange_field_housenumber(row, status) {
}

function displayChange_field_profession(row, status) {
}

function displayChange_field_expeditioncity(row, status) {
}

function displayChange_field_expeditiondepartment(row, status) {
}

function displayChange_field_birthcity(row, status) {
}

function displayChange_field_birthdepartment(row, status) {
}

function displayChange_field_transactiontype(row, status) {
}

function displayChange_field_transactiontypename(row, status) {
}

function displayChange_field_issuedate(row, status) {
}

function displayChange_field_barcodetext(row, status) {
}

function displayChange_field_ocrtextsideone(row, status) {
}

function displayChange_field_ocrtextsidetwo(row, status) {
}

function displayChange_field_sideonewrongattempts(row, status) {
}

function displayChange_field_sidetwowrongattempts(row, status) {
}

function displayChange_field_foundonadoalert(row, status) {
}

function displayChange_field_adoprojectid(row, status) {
}

function displayChange_field_transactionid(row, status) {
}

function displayChange_field_productid(row, status) {
}

function displayChange_field_comparationfacessuccesful(row, status) {
}

function displayChange_field_facefound(row, status) {
}

function displayChange_field_facedocumentfrontfound(row, status) {
}

function displayChange_field_barcodefound(row, status) {
}

function displayChange_field_resultcomparationfaces(row, status) {
}

function displayChange_field_comparationfacesaproved(row, status) {
}

function displayChange_field_extras(row, status) {
}

function displayChange_field_numberphone(row, status) {
}

function displayChange_field_codfingerprint(row, status) {
}

function displayChange_field_resultqrcode(row, status) {
}

function displayChange_field_dactilarcode(row, status) {
}

function displayChange_field_reponsecontrollist(row, status) {
}

function displayChange_field_images(row, status) {
}

function displayChange_field_signeddocuments(row, status) {
}

function displayChange_field_scores(row, status) {
}

function displayChange_field_response_ani(row, status) {
}

function displayChange_field_parameters(row, status) {
}

function displayChange_field_statesignaturedocument(row, status) {
}

function displayChange_field_json_response(row, status) {
}

function displayChange_field_verifyupdate(row, status) {
}

function displayChange_field_estadoreg(row, status) {
}

function scRecreateSelect2() {
}
function scResetPagesDisplay() {
	$(".sc-form-page").show();
}

function scHidePage(pageNo) {
	$("#id_form_ado_records_borrar_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
	if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
		var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
		if (inactiveTabs.length) {
			var tabNo = $(inactiveTabs[0]).attr("id").substr(31);
		}
	}
}
var sc_jq_calendar_value = {};

function scJQCalendarAdd(iSeqRow) {
  $("#id_sc_field_startingdate" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_startingdate" + iSeqRow] = $oField.val();
      if (2 == aParts.length) {
        sTime = " " + aParts[1];
      }
      if ('' == sTime || ' ' == sTime) {
        sTime = ' <?php echo $this->jqueryCalendarTimeStart($this->field_config['startingdate']['date_format']); ?>';
      }
      $oField.datepicker("option", "dateFormat", "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['startingdate']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>" + sTime);
    },
    onClose: function(dateText, inst) {
      do_ajax_form_ado_records_borrar_validate_startingdate(iSeqRow);
    },
    showWeek: true,
    numberOfMonths: 1,
    changeMonth: true,
    changeYear: true,
    yearRange: 'c-5:c+5',
    dayNames: ["<?php        echo html_entity_decode($this->Ini->Nm_lang['lang_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>"],
    dayNamesMin: ["<?php     echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"],
    monthNames: ["<?php      echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_janu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_febr"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_marc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_apri"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_mayy"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_june"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_july"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_augu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_sept"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_octo"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_nove"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_dece"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>"],
    monthNamesShort: ["<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_janu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_febr'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_marc'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_apri'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_mayy'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_june'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_july'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_augu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_sept'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_octo'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_nove'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_dece'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"],
    weekHeader: "<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_days_sem'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>",
    firstDay: <?php echo $this->jqueryCalendarWeekInit("" . $_SESSION['scriptcase']['reg_conf']['date_week_ini'] . ""); ?>,
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['startingdate']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
    showOtherMonths: true,
    showOn: "button",
<?php
$miniCalendarIcon   = $this->jqueryIconFile('calendar');
$miniCalendarFA     = $this->jqueryFAFile('calendar');
$miniCalendarButton = $this->jqueryButtonText('calendar');
if ('' != $miniCalendarIcon) {
?>
    buttonImage: "<?php echo $miniCalendarIcon; ?>",
    buttonImageOnly: true,
<?php
}
elseif ('' != $miniCalendarFA) {
?>
    buttonText: "<?php echo $miniCalendarFA; ?>",
<?php
}
elseif ('' != $miniCalendarButton[0]) {
?>
    buttonText: "<?php echo $miniCalendarButton[0]; ?>",
<?php
}
?>
    currentText: "<?php  echo html_entity_decode($this->Ini->Nm_lang["lang_per_today"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
    closeText: "<?php  echo html_entity_decode($this->Ini->Nm_lang["lang_btns_mess_clse"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
  });
  $("#id_sc_field_creationdate" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_creationdate" + iSeqRow] = $oField.val();
      if (2 == aParts.length) {
        sTime = " " + aParts[1];
      }
      if ('' == sTime || ' ' == sTime) {
        sTime = ' <?php echo $this->jqueryCalendarTimeStart($this->field_config['creationdate']['date_format']); ?>';
      }
      $oField.datepicker("option", "dateFormat", "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['creationdate']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>" + sTime);
    },
    onClose: function(dateText, inst) {
      do_ajax_form_ado_records_borrar_validate_creationdate(iSeqRow);
    },
    showWeek: true,
    numberOfMonths: 1,
    changeMonth: true,
    changeYear: true,
    yearRange: 'c-5:c+5',
    dayNames: ["<?php        echo html_entity_decode($this->Ini->Nm_lang['lang_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>"],
    dayNamesMin: ["<?php     echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"],
    monthNames: ["<?php      echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_janu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_febr"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_marc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_apri"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_mayy"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_june"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_july"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_augu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_sept"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_octo"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_nove"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_dece"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>"],
    monthNamesShort: ["<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_janu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_febr'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_marc'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_apri'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_mayy'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_june'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_july'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_augu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_sept'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_octo'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_nove'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_dece'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"],
    weekHeader: "<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_days_sem'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>",
    firstDay: <?php echo $this->jqueryCalendarWeekInit("" . $_SESSION['scriptcase']['reg_conf']['date_week_ini'] . ""); ?>,
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['creationdate']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
    showOtherMonths: true,
    showOn: "button",
<?php
$miniCalendarIcon   = $this->jqueryIconFile('calendar');
$miniCalendarFA     = $this->jqueryFAFile('calendar');
$miniCalendarButton = $this->jqueryButtonText('calendar');
if ('' != $miniCalendarIcon) {
?>
    buttonImage: "<?php echo $miniCalendarIcon; ?>",
    buttonImageOnly: true,
<?php
}
elseif ('' != $miniCalendarFA) {
?>
    buttonText: "<?php echo $miniCalendarFA; ?>",
<?php
}
elseif ('' != $miniCalendarButton[0]) {
?>
    buttonText: "<?php echo $miniCalendarButton[0]; ?>",
<?php
}
?>
    currentText: "<?php  echo html_entity_decode($this->Ini->Nm_lang["lang_per_today"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
    closeText: "<?php  echo html_entity_decode($this->Ini->Nm_lang["lang_btns_mess_clse"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
  });
  $("#id_sc_field_birthdate" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_birthdate" + iSeqRow] = $oField.val();
      if (2 == aParts.length) {
        sTime = " " + aParts[1];
      }
      if ('' == sTime || ' ' == sTime) {
        sTime = ' <?php echo $this->jqueryCalendarTimeStart($this->field_config['birthdate']['date_format']); ?>';
      }
      $oField.datepicker("option", "dateFormat", "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['birthdate']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>" + sTime);
    },
    onClose: function(dateText, inst) {
      do_ajax_form_ado_records_borrar_validate_birthdate(iSeqRow);
    },
    showWeek: true,
    numberOfMonths: 1,
    changeMonth: true,
    changeYear: true,
    yearRange: 'c-5:c+5',
    dayNames: ["<?php        echo html_entity_decode($this->Ini->Nm_lang['lang_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>"],
    dayNamesMin: ["<?php     echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"],
    monthNames: ["<?php      echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_janu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_febr"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_marc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_apri"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_mayy"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_june"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_july"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_augu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_sept"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_octo"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_nove"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_dece"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>"],
    monthNamesShort: ["<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_janu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_febr'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_marc'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_apri'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_mayy'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_june'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_july'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_augu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_sept'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_octo'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_nove'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_dece'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"],
    weekHeader: "<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_days_sem'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>",
    firstDay: <?php echo $this->jqueryCalendarWeekInit("" . $_SESSION['scriptcase']['reg_conf']['date_week_ini'] . ""); ?>,
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['birthdate']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
    showOtherMonths: true,
    showOn: "button",
<?php
$miniCalendarIcon   = $this->jqueryIconFile('calendar');
$miniCalendarFA     = $this->jqueryFAFile('calendar');
$miniCalendarButton = $this->jqueryButtonText('calendar');
if ('' != $miniCalendarIcon) {
?>
    buttonImage: "<?php echo $miniCalendarIcon; ?>",
    buttonImageOnly: true,
<?php
}
elseif ('' != $miniCalendarFA) {
?>
    buttonText: "<?php echo $miniCalendarFA; ?>",
<?php
}
elseif ('' != $miniCalendarButton[0]) {
?>
    buttonText: "<?php echo $miniCalendarButton[0]; ?>",
<?php
}
?>
    currentText: "<?php  echo html_entity_decode($this->Ini->Nm_lang["lang_per_today"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
    closeText: "<?php  echo html_entity_decode($this->Ini->Nm_lang["lang_btns_mess_clse"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
  });
  $("#id_sc_field_dateofidentification" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_dateofidentification" + iSeqRow] = $oField.val();
      if (2 == aParts.length) {
        sTime = " " + aParts[1];
      }
      if ('' == sTime || ' ' == sTime) {
        sTime = ' <?php echo $this->jqueryCalendarTimeStart($this->field_config['dateofidentification']['date_format']); ?>';
      }
      $oField.datepicker("option", "dateFormat", "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['dateofidentification']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>" + sTime);
    },
    onClose: function(dateText, inst) {
      do_ajax_form_ado_records_borrar_validate_dateofidentification(iSeqRow);
    },
    showWeek: true,
    numberOfMonths: 1,
    changeMonth: true,
    changeYear: true,
    yearRange: 'c-5:c+5',
    dayNames: ["<?php        echo html_entity_decode($this->Ini->Nm_lang['lang_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>"],
    dayNamesMin: ["<?php     echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"],
    monthNames: ["<?php      echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_janu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_febr"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_marc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_apri"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_mayy"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_june"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_july"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_augu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_sept"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_octo"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_nove"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_dece"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>"],
    monthNamesShort: ["<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_janu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_febr'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_marc'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_apri'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_mayy'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_june'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_july'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_augu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_sept'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_octo'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_nove'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_dece'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"],
    weekHeader: "<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_days_sem'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>",
    firstDay: <?php echo $this->jqueryCalendarWeekInit("" . $_SESSION['scriptcase']['reg_conf']['date_week_ini'] . ""); ?>,
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['dateofidentification']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
    showOtherMonths: true,
    showOn: "button",
<?php
$miniCalendarIcon   = $this->jqueryIconFile('calendar');
$miniCalendarFA     = $this->jqueryFAFile('calendar');
$miniCalendarButton = $this->jqueryButtonText('calendar');
if ('' != $miniCalendarIcon) {
?>
    buttonImage: "<?php echo $miniCalendarIcon; ?>",
    buttonImageOnly: true,
<?php
}
elseif ('' != $miniCalendarFA) {
?>
    buttonText: "<?php echo $miniCalendarFA; ?>",
<?php
}
elseif ('' != $miniCalendarButton[0]) {
?>
    buttonText: "<?php echo $miniCalendarButton[0]; ?>",
<?php
}
?>
    currentText: "<?php  echo html_entity_decode($this->Ini->Nm_lang["lang_per_today"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
    closeText: "<?php  echo html_entity_decode($this->Ini->Nm_lang["lang_btns_mess_clse"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
  });
  $("#id_sc_field_dateofdeath" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_dateofdeath" + iSeqRow] = $oField.val();
      if (2 == aParts.length) {
        sTime = " " + aParts[1];
      }
      if ('' == sTime || ' ' == sTime) {
        sTime = ' <?php echo $this->jqueryCalendarTimeStart($this->field_config['dateofdeath']['date_format']); ?>';
      }
      $oField.datepicker("option", "dateFormat", "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['dateofdeath']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>" + sTime);
    },
    onClose: function(dateText, inst) {
      do_ajax_form_ado_records_borrar_validate_dateofdeath(iSeqRow);
    },
    showWeek: true,
    numberOfMonths: 1,
    changeMonth: true,
    changeYear: true,
    yearRange: 'c-5:c+5',
    dayNames: ["<?php        echo html_entity_decode($this->Ini->Nm_lang['lang_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>"],
    dayNamesMin: ["<?php     echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"],
    monthNames: ["<?php      echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_janu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_febr"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_marc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_apri"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_mayy"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_june"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_july"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_augu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_sept"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_octo"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_nove"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_dece"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>"],
    monthNamesShort: ["<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_janu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_febr'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_marc'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_apri'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_mayy'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_june'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_july'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_augu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_sept'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_octo'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_nove'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_dece'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"],
    weekHeader: "<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_days_sem'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>",
    firstDay: <?php echo $this->jqueryCalendarWeekInit("" . $_SESSION['scriptcase']['reg_conf']['date_week_ini'] . ""); ?>,
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['dateofdeath']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
    showOtherMonths: true,
    showOn: "button",
<?php
$miniCalendarIcon   = $this->jqueryIconFile('calendar');
$miniCalendarFA     = $this->jqueryFAFile('calendar');
$miniCalendarButton = $this->jqueryButtonText('calendar');
if ('' != $miniCalendarIcon) {
?>
    buttonImage: "<?php echo $miniCalendarIcon; ?>",
    buttonImageOnly: true,
<?php
}
elseif ('' != $miniCalendarFA) {
?>
    buttonText: "<?php echo $miniCalendarFA; ?>",
<?php
}
elseif ('' != $miniCalendarButton[0]) {
?>
    buttonText: "<?php echo $miniCalendarButton[0]; ?>",
<?php
}
?>
    currentText: "<?php  echo html_entity_decode($this->Ini->Nm_lang["lang_per_today"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
    closeText: "<?php  echo html_entity_decode($this->Ini->Nm_lang["lang_btns_mess_clse"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
  });
  $("#id_sc_field_marriagedate" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_marriagedate" + iSeqRow] = $oField.val();
      if (2 == aParts.length) {
        sTime = " " + aParts[1];
      }
      if ('' == sTime || ' ' == sTime) {
        sTime = ' <?php echo $this->jqueryCalendarTimeStart($this->field_config['marriagedate']['date_format']); ?>';
      }
      $oField.datepicker("option", "dateFormat", "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['marriagedate']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>" + sTime);
    },
    onClose: function(dateText, inst) {
      do_ajax_form_ado_records_borrar_validate_marriagedate(iSeqRow);
    },
    showWeek: true,
    numberOfMonths: 1,
    changeMonth: true,
    changeYear: true,
    yearRange: 'c-5:c+5',
    dayNames: ["<?php        echo html_entity_decode($this->Ini->Nm_lang['lang_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>"],
    dayNamesMin: ["<?php     echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"],
    monthNames: ["<?php      echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_janu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_febr"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_marc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_apri"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_mayy"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_june"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_july"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_augu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_sept"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_octo"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_nove"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_dece"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>"],
    monthNamesShort: ["<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_janu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_febr'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_marc'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_apri'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_mayy'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_june'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_july'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_augu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_sept'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_octo'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_nove'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_dece'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"],
    weekHeader: "<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_days_sem'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>",
    firstDay: <?php echo $this->jqueryCalendarWeekInit("" . $_SESSION['scriptcase']['reg_conf']['date_week_ini'] . ""); ?>,
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['marriagedate']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
    showOtherMonths: true,
    showOn: "button",
<?php
$miniCalendarIcon   = $this->jqueryIconFile('calendar');
$miniCalendarFA     = $this->jqueryFAFile('calendar');
$miniCalendarButton = $this->jqueryButtonText('calendar');
if ('' != $miniCalendarIcon) {
?>
    buttonImage: "<?php echo $miniCalendarIcon; ?>",
    buttonImageOnly: true,
<?php
}
elseif ('' != $miniCalendarFA) {
?>
    buttonText: "<?php echo $miniCalendarFA; ?>",
<?php
}
elseif ('' != $miniCalendarButton[0]) {
?>
    buttonText: "<?php echo $miniCalendarButton[0]; ?>",
<?php
}
?>
    currentText: "<?php  echo html_entity_decode($this->Ini->Nm_lang["lang_per_today"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
    closeText: "<?php  echo html_entity_decode($this->Ini->Nm_lang["lang_btns_mess_clse"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
  });
  $("#id_sc_field_issuedate" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_issuedate" + iSeqRow] = $oField.val();
      if (2 == aParts.length) {
        sTime = " " + aParts[1];
      }
      if ('' == sTime || ' ' == sTime) {
        sTime = ' <?php echo $this->jqueryCalendarTimeStart($this->field_config['issuedate']['date_format']); ?>';
      }
      $oField.datepicker("option", "dateFormat", "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['issuedate']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>" + sTime);
    },
    onClose: function(dateText, inst) {
      do_ajax_form_ado_records_borrar_validate_issuedate(iSeqRow);
    },
    showWeek: true,
    numberOfMonths: 1,
    changeMonth: true,
    changeYear: true,
    yearRange: 'c-5:c+5',
    dayNames: ["<?php        echo html_entity_decode($this->Ini->Nm_lang['lang_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>"],
    dayNamesMin: ["<?php     echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"],
    monthNames: ["<?php      echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_janu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_febr"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_marc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_apri"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_mayy"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_june"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_july"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_augu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_sept"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_octo"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_nove"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_dece"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>"],
    monthNamesShort: ["<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_janu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_febr'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_marc'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_apri'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_mayy'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_june'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_july'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_augu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_sept'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_octo'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_nove'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_dece'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"],
    weekHeader: "<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_days_sem'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>",
    firstDay: <?php echo $this->jqueryCalendarWeekInit("" . $_SESSION['scriptcase']['reg_conf']['date_week_ini'] . ""); ?>,
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['issuedate']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
    showOtherMonths: true,
    showOn: "button",
<?php
$miniCalendarIcon   = $this->jqueryIconFile('calendar');
$miniCalendarFA     = $this->jqueryFAFile('calendar');
$miniCalendarButton = $this->jqueryButtonText('calendar');
if ('' != $miniCalendarIcon) {
?>
    buttonImage: "<?php echo $miniCalendarIcon; ?>",
    buttonImageOnly: true,
<?php
}
elseif ('' != $miniCalendarFA) {
?>
    buttonText: "<?php echo $miniCalendarFA; ?>",
<?php
}
elseif ('' != $miniCalendarButton[0]) {
?>
    buttonText: "<?php echo $miniCalendarButton[0]; ?>",
<?php
}
?>
    currentText: "<?php  echo html_entity_decode($this->Ini->Nm_lang["lang_per_today"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
    closeText: "<?php  echo html_entity_decode($this->Ini->Nm_lang["lang_btns_mess_clse"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
  });
} // scJQCalendarAdd

function scJQUploadAdd(iSeqRow) {
} // scJQUploadAdd

var api_cache_requests = [];
function ajax_check_file(img_name, field  ,t, p, p_cache, iSeqRow, hasRun, img_before){
    setTimeout(function(){
        if(img_name == '') return;
        iSeqRow= iSeqRow !== undefined && iSeqRow !== null ? iSeqRow : '';
        var hasVar = p.indexOf('_@NM@_') > -1 || p_cache.indexOf('_@NM@_') > -1 ? true : false;

        p = p.split('_@NM@_');
        $.each(p, function(i,v){
            try{
                p[i] = $('[name='+v+iSeqRow+']').val();
            }
            catch(err){
                p[i] = v;
            }
        });
        p = p.join('');

        p_cache = p_cache.split('_@NM@_');
        $.each(p_cache, function(i,v){
            try{
                p_cache[i] = $('[name='+v+iSeqRow+']').val();
            }
            catch(err){
                p_cache[i] = v;
            }
        });
        p_cache = p_cache.join('');

        img_before = img_before !== undefined ? img_before : $(t).attr('src');
        var str_key_cache = '<?php echo $this->Ini->sc_page; ?>' + img_name+field+p+p_cache;
        if(api_cache_requests[ str_key_cache ] !== undefined && api_cache_requests[ str_key_cache ] !== null){
            if(api_cache_requests[ str_key_cache ] != false){
                do_ajax_check_file(api_cache_requests[ str_key_cache ], field  ,t, iSeqRow);
            }
            return;
        }
        //scAjaxProcOn();
        $(t).attr('src', '<?php echo $this->Ini->path_icones ?>/scriptcase__NM__ajax_load.gif');
        api_cache_requests[ str_key_cache ] = false;
        var rs =$.ajax({
                    type: "POST",
                    url: 'index.php?script_case_init=<?php echo $this->Ini->sc_page; ?>',
                    async: true,
                    data:'nmgp_opcao=ajax_check_file&AjaxCheckImg=' + encodeURI(img_name) +'&rsargs='+ field + '&p=' + p + '&p_cache=' + p_cache,
                    success: function (rs) {
                        if(rs.indexOf('</span>') != -1){
                            rs = rs.substr(rs.indexOf('</span>') + 7);
                        }
                        if(rs.indexOf('/') != -1 && rs.indexOf('/') != 0){
                            rs = rs.substr(rs.indexOf('/'));
                        }
                        rs = sc_trim(rs);

                        // if(rs == 0 && hasVar && hasRun === undefined){
                        //     delete window.api_cache_requests[ str_key_cache ];
                        //     ajax_check_file(img_name, field  ,t, p, p_cache, iSeqRow, 1, img_before);
                        //     return;
                        // }
                        window.api_cache_requests[ str_key_cache ] = rs;
                        do_ajax_check_file(rs, field  ,t, iSeqRow)
                        if(rs == 0){
                            delete window.api_cache_requests[ str_key_cache ];

                           // $(t).attr('src',img_before);
                            do_ajax_check_file(img_before+'_@@NM@@_' + img_before, field  ,t, iSeqRow)

                        }


                    }
        });
    },100);
}

function do_ajax_check_file(rs, field  ,t, iSeqRow){
    if (rs != 0) {
        rs_split = rs.split('_@@NM@@_');
        rs_orig = rs_split[0];
        rs2 = rs_split[1];
        try{
            if(!$(t).is('img')){

                if($('#id_read_on_'+field+iSeqRow).length > 0 ){
                                    var usa_read_only = false;

                switch(field){

                }
                     if(usa_read_only && $('a',$('#id_read_on_'+field+iSeqRow)).length == 0){
                         $(t).html("<a href=\"javascript:nm_mostra_doc('0', '"+rs2+"', 'form_ado_records_borrar')\">"+$('#id_read_on_'+field+iSeqRow).text()+"</a>");
                     }
                }
                if($('#id_ajax_doc_'+field+iSeqRow+' a').length > 0){
                    var target = $('#id_ajax_doc_'+field+iSeqRow+' a').attr('href').split(',');
                    target[1] = "'"+rs2+"'";
                    $('#id_ajax_doc_'+field+iSeqRow+' a').attr('href', target.join(','));
                }else{
                    var target = $(t).attr('href').split(',');
                     target[1] = "'"+rs2+"'";
                     $(t).attr('href', target.join(','));
                }
            }else{
                $(t).attr('src', rs2);
                $(t).css('display', '');
                if($('#id_ajax_doc_'+field+iSeqRow+' a').length > 0){
                    var target = $('#id_ajax_doc_'+field+iSeqRow+' a').attr('href').split(',');
                    target[1] = "'"+rs2+"'";
                    $(t).attr('href', target.join(','));
                }else{
                     var t_link = $(t).parent('a');
                     var target = $(t_link).attr('href').split(',');
                     target[0] = "javascript:nm_mostra_img('"+rs_orig+"'";
                     $(t_link).attr('href', target.join(','));
                }

            }
            eval("window.var_ajax_img_"+field+iSeqRow+" = '"+rs_orig+"';");

        } catch(err){
                        eval("window.var_ajax_img_"+field+iSeqRow+" = '"+rs_orig+"';");

        }
    }
   /* hasFalseCacheRequest = false;
    $.each(api_cache_requests, function(i,v){
        if(v == false){
            hasFalseCacheRequest = true;
        }
    });
    if(hasFalseCacheRequest == false){
        scAjaxProcOff();
    }*/
}

$(document).ready(function(){
});
function scJQElementsAdd(iLine) {
  scJQEventsAdd(iLine);
  scEventControl_init(iLine);
  scJQCalendarAdd(iLine);
  scJQUploadAdd(iLine);
} // scJQElementsAdd

function scGetFileExtension(fileName)
{
    fileNameParts = fileName.split(".");

    if (1 === fileNameParts.length || (2 === fileNameParts.length && "" == fileNameParts[0])) {
        return "";
    }

    return fileNameParts.pop().toLowerCase();
}

function scFormatExtensionSizeErrorMsg(errorMsg)
{
    var msgInfo = errorMsg.split("||"), returnMsg = "";

    if ("err_size" == msgInfo[0]) {
        returnMsg = "<?php echo $this->Ini->Nm_lang['lang_errm_file_size'] ?>. <?php echo $this->Ini->Nm_lang['lang_errm_file_size_extension'] ?>".replace("{SC_EXTENSION}", msgInfo[1]).replace("{SC_LIMIT}", msgInfo[2]);
    } else if ("err_extension" == msgInfo[0]) {
        returnMsg = "<?php echo $this->Ini->Nm_lang['lang_errm_file_invl'] ?>";
    }

    return returnMsg;
}

