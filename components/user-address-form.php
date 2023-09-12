<div class="card">
    <div class="card-body p-md-5">
        <form class="form-horizontal" role="form" action="<?= PAGE ?>" name="formContactform" method="post"
            autocomplete="off">
            <div class="row">
                <div class="col-md-6">
                    <label for="address1" class="form-label">Address1</label>
                    <input type="text" class="form-control" name="address1" value="<?= $userAddress1; ?>"
                        required>
                </div>
                <div class="col-md-6">
                    <label for="address2" class="form-label">Address2</label>
                    <input type="text" class="form-control" name="address2" value="<?= $userAddress2; ?>"
                        required>
                </div>
            </div>
            <div class="row  m-t-lg">
                <div class="col-md-6 form-group">
                    <label for="countryId" class="form-label">Country</label>
                    <select id="countryId" class="form-select " name="countryId" onchange="getStateList(this)" required>
                        <option value="" selected disabled>Select Country</option>
                        <?php
                        $utility->populateDropDown($userCountryId, 'id', 'name', 'countries')
                        ?>
                    </select>
                </div>

                <div class="col-md-6 form-group">
                    <label for="stateId" class="form-label">State</label>
                    <select id="stateId" class="form-select " name="stateId" required onchange="getCitiesList(this)">
                        <option value="" selected disabled>
                            Select Country First
                        </option>
                        <?php
                        $utility->populateDropDown2($userStateId, 'id', 'name', 'country_id', $userCountryId, 'states')
                        ?>
                    </select>
                </div>
            </div>

            <div class="row m-t-lg">
                <div class="col-md-6 form-group">
                    <label for="city" class="form-label">Town/City</label>
                    <select id="city" class="form-select " name="cityId" required>
                        <option value="" selected disabled>
                            Select City
                        </option>
                        <option value="" disabled selected>Select State
                            First
                        </option>
                        <?php
                        // $utility->populateDropDown2($userCityId, 'id', 'name', 'state_id', $userStateId, 'cities')
                        ?>
                    </select>


                </div>
                <div class="col-md-6 form-group">
                    <label for="postal_code" class="form-label">Postal Code</label>
                    <input type="number" class="form-control" name="postal_code" value="<?= $userPinCode; ?>"
                        required>
                </div>
            </div>
            <div class="row m-t-lg">
                <div class="col-md-6">
                    <label for="Phone1" class="form-label">Phone1</label>
                    <input type="number" class="form-control" name="phone1" value="<?= $userPhone1; ?>">
                </div>
                <div class="col-md-6">
                    <label for="Phone2" class="form-label">Phone2</label>
                    <input type="number" class="form-control" name="phone2" value="<?= $userPhone2; ?>">

                </div>
            </div>
            <div class="row m-t-lg">
                <div class="col-md-6">
                    <label for="settingsAbout" class="form-label">Fax</label>
                    <input type="number" class="form-control" name="userfax" value="<?= $userFax; ?>">

                </div>
            </div>

            <div class="row m-t-lg">
                <div class="d-grid gap-2   d-md-flex col-12 col-md-3 mx-auto my-3">
                    <button type="submit" name="btnCancel" class="btn botton-midle btn-danger">Cancel</button>
                    <button type="submit" name="addressUpdate" class="btn botton-midle btn-primary">Update</button>
                </div>
            </div>
        </form>

    </div>
</div>