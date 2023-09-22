<div class="row">
    <div class="col-12 col-xl-4">
        <div class="card h-100">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                        <h6 class="mb-0">Profile Information</h6>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="javascript:;">
                            <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Edit Profile"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body p-3">
                <form action="<?= $currentURL ?>" method="POST" name="profile-form" enctype="multipart/form-data">

                    <div class="row w-100 m-0 mb-2">
                        <div class="col-6 col-sm-auto mb-3">
                            <div class="mx-auto">
                                <div class="d-flex justify-content-center align-items-center rounded"
                                    style="height: 80px; background-color: rgb(233, 236, 239); aspect-ratio: 1/1;">
                                    <img class="img-uv-view" src="<?= EMP_IMG_PATH.$empImage ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-6 d-flex align-items-center">
                            <div class="input-group mt-2">
                                <input type="file" class="d-none" id="img-uv-input" name="profile-picture" accept="image/*">
                                <label class="input-group-text btn btn-sm btn-primary rounded" for="img-uv-input">
                                    <i class="fa fa-fw fa-camera pe-2"></i>
                                    Recent Photo
                                </label>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="emp-name" class="form-control-label">Name</label>
                        <input class="form-control" type="text" value="<?= $empName ?>" id="emp-name" name="emp-name"
                            required />
                    </div>
                    <div class="form-group">
                        <label for="emp-gender" class="form-label">Gender</label>
                        <div class="d-flex align-item-center justify-content-between">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="emp-gender" value="male"
                                    required <?= $empGender == 'male' ? 'checked': ''?>>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Male
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="emp-gender"
                                    value="female" required <?= $empGender == 'female' ? 'checked': ''?>>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Female
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="emp-gender"
                                    value="others" required <?= $empGender == 'others' ? 'checked': ''?>>
                                <label class="form-check-label" for="flexRadioDefault3">
                                    Others
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="designation" class="form-control-label">Designation</label>
                        <select class="js-states form-select" tabindex="-1" aria-label="designation"
                            style="display: none; width: 100%" multiple="multiple" id="designation" name="designation[]"
                            required>
                            <!-- <optgroup label="Alaskan/Hawaiian Time Zone"> -->
                            <option value="Content Writer"
                                <?= $empDesignation == 'Content Writer' ? 'selected' : ''; ?>>
                                Content Writer</option>
                            <option value="SEO Specialist"
                                <?= $empDesignation == 'SEO Specialist' ? 'selected' : ''; ?>>
                                SEO Specialist</option>
                            <option value="SEO Execitive" <?= $empDesignation == 'SEO Execitive' ? 'selected' : ''; ?>>
                                SEO Execitive</option>
                            <option value="Outreach Specialist"
                                <?= $empDesignation == 'Outreach Specialist' ? 'selected' : ''; ?>>
                                Outreach Specialist</option>
                            <option value="Outreach Manager"
                                <?= $empDesignation == 'Outreach Manager' ? 'selected' : ''; ?>>
                                Outreach Manager</option>
                            <option value="Video Editor" <?= $empDesignation == 'Video Editor' ? 'selected' : ''; ?>>
                                Video Editor</option>
                            <option value="Frontend Developer"
                                <?= $empDesignation == 'Frontend Developer' ? 'selected' : ''; ?>>
                                Frontend Developer</option>
                            <option value="Backend Developer"
                                <?= $empDesignation == 'Backend Developer' ? 'selected' : ''; ?>>
                                Backend Developer</option>
                            <option value="Full Stack Developer"
                                <?= $empDesignation == 'Full Stack Developer' ? 'selected' : ''; ?>>
                                Full Stack Developer</option>
                            <!-- </optgroup> -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="emp-phone" class="form-control-label">Phone</label>
                        <input class="form-control" type="tel" maxlength="10" minlength="10" value="<?= $empPhone?>"
                            name="emp-phone" id="emp-phone" required />
                    </div>
                    <div class="form-group">
                        <label for="emp-email" class="form-control-label">Email</label>
                        <input class="form-control" type="email" value="<?= $empEmail ?>" id="emp-email"
                            name="emp-email" required />
                    </div>
                    <div class="form-group">
                        <label for="doj" class="form-control-label">Date of Joining</label>
                        <input class="form-control" type="date" value="<?= $empDOJ?>" name="doj" id="doj" required />
                    </div>
                    <div class="text-end">
                        <button class="btn btn-sm btn-primary" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-12 col-xl-4">
        <div class="card h-100">
            <div class="card-header pb-0 p-3">
                <h6 class="mb-0">Address Information</h6>
            </div>
            <div class="card-body p-3">
                <form action="<?= $currentURL ?>" method="POST">
                    <div class="form-group">
                        <label for="address1" class="form-control-label">Address 1</label>
                        <input class="form-control" type="text" id="address1" name="address1"
                            value="<?= $empAddress1 ?>" />
                    </div>
                    <div class="form-group">
                        <label for="address2" class="form-control-label">Address 2</label>
                        <input class="form-control" type="text" id="address2" name="address2"
                            value="<?= $empAddress2 ?>" />
                    </div>
                    <div class="form-group">
                        <label for="city" class="form-control-label">City</label>
                        <select class="form-select" name="city" id="city">
                            <?php
                            if (empty($empCityId) && empty($empStateId) && empty($empCountryId)) {
                                echo '<option value="" disabled> Select Country and State First </option>';
                            }elseif(empty($empCityId) && !empty($empStateId)) {
                                echo '<option value="" disabled selected> Select </option>';
                                $Utility->populateDropDown2('', 'id', 'name', 'state_id', $empStateId, 'cities');
                            }elseif (!empty($empCityId) && !empty($empStateId)) {
                                echo '<option value="" disabled selected> Select </option>';
                                $Utility->populateDropDown2($empCityId, 'id', 'name', 'state_id', $empStateId, 'cities');
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="stateId" class="form-control-label">State</label>
                        <!-- <input class="form-control" type="text" value="<?= $empState?>" id="example-url-input" /> -->
                        <select id="stateId" class="form-select " name="stateId" onchange="getCitiesList(this)">
                            <option value="" selected disabled> Select </option>
                            <?php
                                if (!empty($empCountryId) && !empty($empStateId)) {
                                    $Utility->populateDropDown2($empStateId, 'id', 'name', 'country_id', $empCountryId, 'states');
                                    // $Utility->populateDropDown($empStateId, 'id', 'name', 'states');
                                }elseif (!empty($empCountryId) && empty($empStateId)) {
                                    $Utility->populateDropDown2($empStateId, 'id', 'name', 'country_id', $empCountryId, 'states');
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pin-code" class="form-control-label">PIN Code</label>
                        <input class="form-control" type="number" id="pin-code" name="pin-code"
                            value="<?= $empPinCode ?>" />
                    </div>
                    <div class="form-group">
                        <label for="example-password-input" class="form-control-label">Country</label>
                        <!-- <input class="form-control" type="text" value="<?= $empPassword ?>"
                            id="example-password-input" /> -->
                        <select id="countryId" class="form-select " name="countryId" onchange="getStateList(this)"
                            required>
                            <option value="" selected disabled>Select Country</option>
                            <?php $Utility->populateDropDown($empCountryId, 'id', 'name', 'countries'); ?>
                        </select>

                    </div>
                    <div class="text-end">
                        <button class="btn btn-sm btn-primary" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-12 col-xl-4">
        <div class="card h-100">
            <div class="card-header pb-0 p-3">
                <h6 class="mb-0">Conversations</h6>
            </div>
            <div class="card-body p-3">
                <ul class="list-group">

                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src=" assets/img/kal-visuals-square.jpg" alt="kal" class="border-radius-lg" />
                                </span>
                            </div>
                            <input type="url" class="form-control">
                        </div>
                    </li>
                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src=" assets/img/kal-visuals-square.jpg" alt="kal" class="border-radius-lg" />
                                </span>
                            </div>
                            <input type="email" class="form-control">
                        </div>
                    </li>
                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src=" assets/img/kal-visuals-square.jpg" alt="kal" class="border-radius-lg" />
                                </span>
                            </div>
                            <input type="email" class="form-control">
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>