<?php

namespace OAuth2\OpenID\Storage;

/**
 * Implement this interface to specify where the OAuth2 Server
 * should retrieve user claims for the OpenID Connect id_token.
 */
interface UserClaimsInterface
{
    // valid scope values to pass into the user claims API call
    const VALID_CLAIMS = 'profile email address phone onegate';

    // fields returned for the claims above
    const PROFILE_CLAIM_VALUES = 'name given_name family_name Uid TransactionId email picture'; //Test like google response claims + Uid and TransactionId
    //const PROFILE_CLAIM_VALUES = 'name given_name family_name';
	const EMAIL_CLAIM_VALUES    = 'email email_verified';
    const ADDRESS_CLAIM_VALUES  = 'formatted street_address locality region postal_code country';
    const PHONE_CLAIM_VALUES    = 'phone_number phone_number_verified';
    const ONEGATE_CLAIM_VALUES    = 'Uid StartingDate CreationDate CreationIP DocumentType IdNumber FirstName SecondName FirstSurname SecondSurname Gender BirthDate Street CedulateCondition Spouse Home MaritalStatus DateOfIdentification DateOfDeath MarriageDate Instruction PlaceBirth Nationality MotherName FatherName HouseNumber Profession ExpeditionCity ExpeditionDepartment BirthCity BirthDepartment TransactionType TransactionTypeName IssueDate BarcodeText OcrTextSideOne OcrTextSideTwo SideOneWrongAttempts SideTwoWrongAttempts FoundOnAdoAlert AdoProjectId TransactionId ProductId ComparationFacesSuccesful FaceFound FaceDocumentFrontFound BarcodeFound ResultComparationFaces ComparationFacesAproved Extras NumberPhone CodFingerprint ResultQRCode DactilarCode ReponseControlList Images SignedDocuments Scores Response_ANI Parameters StateSignatureDocument';

    /**
     * Return claims about the provided user id.
     *
     * Groups of claims are returned based on the requested scopes. No group
     * is required, and no claim is required.
     *
     * @param mixed  $user_id - The id of the user for which claims should be returned.
     * @param string $scope   - The requested scope.
     * Scopes with matching claims: profile, email, address, phone.
     *
     * @return array - An array in the claim => value format.
     *
     * @see http://openid.net/specs/openid-connect-core-1_0.html#ScopeClaims
     */
    public function getUserClaims($user_id, $scope);
}
