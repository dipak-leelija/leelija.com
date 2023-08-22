<?php
require_once dirname(__DIR__) . "/includes/constant.inc.php";
require_once ROOT_DIR . "/_config/dbconnect.php";
require_once ROOT_DIR . "/classes/utility.class.php";

$Utility    = new Utility();

if (isset($_POST['countryId'])) {
    echo '<option value="" selected disabled>Select State </option>';
    echo $Utility->populateDropDown2('', 'id', 'name', 'country_id', $_POST['countryId'], 'states');
    // populateDropDown($selected, $idColumn, $populate, $table)
}

if (isset($_POST['stateId'])) {
    echo '<option value="" selected disabled>Select City </option>';
    echo $Utility->populateDropDown2('', 'id', 'name', 'state_id', $_POST['stateId'], 'cities');
    // populateDropDown($selected, $idColumn, $populate, $table)
}
?>