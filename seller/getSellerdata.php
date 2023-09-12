<?php
$reqURL     = URL."api/".$cusId;
$response   = $utility->callApi($reqURL);
$user = $response->data;


// print_r($user->user_name);
// exit;
    
    $userType               = $user->customer_type;
    $userName               = $user->user_name;
    $userEmail              = $user->email;
    $userFname              = $user->fname;
    $userLname              = $user->lname;
    $userGender             = $user->gender;
    $userStatus             = $user->status;
    $userImage              = $user->image;
    $userBrief              = $user->brief;
    $userDsc                = $user->description;
    $userOrganization       = $user->organization;
    $userFeatured           = $user->featured;
    $userProfession         = $user->profession;
    $userSort               = $user->sort_order;
    $userVerficationNo      = $user->verification_no;
    $userVerifiedBy         = $user->verified_by;
    $userVerifiedOn         = $user->verified_on;
    $userDiscountOffered    = $user->discount_offered;
    $userLogonnNo           = $user->no_logon;
    $userLastLogon          = $user->last_logon;
    $userAddedOn            = $user->added_on;
    $userModifiedOn         = $user->modified_on;
    $userAddress1           = $user->address1;
    $userAddress2           = $user->address2;
    $userAddress3           = $user->address3;
    $userCity               = $user->town;
    $userProvince           = $user->province;
    $userPostal_code        = $user->postal_code;
    $userCountries_id       = $user->countries_id;
    $userPhone1             = $user->phone1;
    $userPhone2             = $user->phone2;
    $userFax                = $user->fax;
    $userMobile             = $user->mobile;
    $userAccVerified        = $user->acc_verified;
    $userDOB                = $user->dob;
    $userBillingName        = $user->billing_name;


?>