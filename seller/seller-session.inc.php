<?php
$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId		= $utility->returnSess('userid', 0);
$cusDtl		= $customer->getCustomerData($cusId);

// $reqURL     = URL."api/".$cusId;
// $response   = $utility->callApi($reqURL);
// $user = $response->data;


// // print_r($user->user_name);
// // exit;
    
//     $userType               = $user->customer_type;
//     $userName               = $user->user_name;
//     $userEmail              = $user->email;
//     $userFname              = $user->fname;
//     $userLname              = $user->lname;
//     $userGender             = $user->gender;
//     $userStatus             = $user->status;
//     $userImage              = $user->image;
//     $userBrief              = $user->brief;
//     $userDsc                = $user->description;
//     $userOrganization       = $user->organization;
//     $userFeatured           = $user->featured;
//     $userProfession         = $user->profession;
//     $userSort               = $user->sort_order;
//     $userVerficationNo      = $user->verification_no;
//     $userVerifiedBy         = $user->verified_by;
//     $userVerifiedOn         = $user->verified_on;
//     $userDiscountOffered    = $user->discount_offered;
//     $userLogonnNo           = $user->no_logon;
//     $userLastLogon          = $user->last_logon;
//     $userAddedOn            = $user->added_on;
//     $userModifiedOn         = $user->modified_on;
//     $userAddress1           = $user->address1;
//     $userAddress2           = $user->address2;
//     $userAddress3           = $user->address3;
//     $userCity               = $user->town;
//     $userProvince           = $user->province;
//     $userPostal_code        = $user->postal_code;
//     $userCountries_id       = $user->countries_id;
//     $userPhone1             = $user->phone1;
//     $userPhone2             = $user->phone2;
//     $userFax                = $user->fax;
//     $userMobile             = $user->mobile;
//     $userAccVerified        = $user->acc_verified;
//     $userDOB                = $user->dob;
//     $userBillingName        = $user->billing_name;


// print_r($cusDtl);
// exit;

$userType               = $cusDtl[0][0];

if($userType == 0){
	header("Location: ".URL);
    exit;
}
if($userType == 1){ 
	header("Location: ".USER_AREA);
    exit;
}


$userMemberId           = $cusDtl[0][1];
$userName               = $cusDtl[0][2];
$userEmail              = $cusDtl[0][3];
$userPass               = $cusDtl[0][4];
$userFname               = $cusDtl[0][5];
$userLname              = $cusDtl[0][6];
$userGender             = $cusDtl[0][7];
$userStatus             = $cusDtl[0][8];
$userImage              = $cusDtl[0][9];
$userBrief             = $cusDtl[0][10];
$userDescription       = $cusDtl[0][11];
$userOrganization      = $cusDtl[0][12];
$userFeatured          = $cusDtl[0][13];
$userProfession        = $cusDtl[0][14];
$userSortOrder         = $cusDtl[0][15];
$userVerificationNo    = $cusDtl[0][16];
$userVerifiedBy        = $cusDtl[0][17];
$userVerifiedOn        = $cusDtl[0][18];
$userDiscountOffered   = $cusDtl[0][19];
$userNoLogon           = $cusDtl[0][20];
$userLastLogon         = $cusDtl[0][21];
$userAddedOn           = $cusDtl[0][22];
$userModifiedOn        = $cusDtl[0][23];
$userAddress1          = $cusDtl[0][24];
$userAddress2          = $cusDtl[0][25];
$userAddress3          = $cusDtl[0][26];
$userCityId            = $cusDtl[0][27];
$userStateId           = $cusDtl[0][28];
$userPinCode           = $cusDtl[0][29];
$userCountryId         = $cusDtl[0][30];
$userPhone1            = $cusDtl[0][31];
$userPhone2            = $cusDtl[0][32];
$userFax               = $cusDtl[0][33];
$userMobile            = $cusDtl[0][34];
$userAccVerified       = $cusDtl[0][35];
$userDob               = $cusDtl[0][36];
$userBillingName       = $cusDtl[0][37];





?>