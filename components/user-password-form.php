<div class="card">
    <div class="card-body p-md-5">
        <form class="form-horizontal needs-validation" role="form" action="<?= PAGE ?>" name="passwordForm"
            method="post" enctype="multipart/form-data" autocomplete="off" novalidate>
            <div class="row ">
                <div class="col-md-6">
                    <div class="form-group ">
                        <label class="form-label">Current Password</label>
                        <div class="input-group">
                            <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                placeholder="Current Password" minlength="6"
                                id="currentPassword" name="currentPassword" class="form-control custom_view_pass"
                                required>
                            <button class="btn" type="button"><i
                                    class="fa-solid fa-eye-slash custm-confirm custom-toggle-icon" id="toggler"></i></button>
                            <div class="invalid-feedback">
                                Please enter your Current Password!
                            </div>
                        </div>
                        <!-- <div class="form-text">
                            Never share your password with anyone.
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="newPassword" class="form-label">New Password</label>
                        <input type="password" minlength="8" id="newPassword" name="newPassword"
                            placeholder="New Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                            autocomplete="new-password" class="form-control custm_pv" required>
                        <div class="invalid-feedback">
                            Must be a combination of
                            (A-Z),(a-z),(0-9),(!@#$%^&*=+-_) and >8
                            characters long!
                        </div>
                        <div class="valid-feedback">
                            Strong password!
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <div class="input-group ">
                            <input type="password" id="confirmPassword" name="confirmPassword" minlength="8"
                                placeholder="Confirm Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                class="form-control " required>
                            <button class="btn" type="button"><i class="fas fa-eye-slash custm-confirm "
                                    id="toggle-show"></i></button>

                        </div>
                        <div class="form-text confirm-message"></div>
                    </div>
                </div>
            </div>

            <!-- <div class="row m-t-xxl">
                <div class="col-md-6">
                    <label for="settingsSmsCode" class="form-label">SMS Code</label>
                    <div class="input-group">
                        <input type="password" class="form-control" aria-describedby="settingsSmsCode"  placeholder="&#9679;&#9679;&#9679;&#9679;" required>
                        <button class="btn btn-primary btn-style-light" id="settingsResentSmsCode">Resend</button>
                    </div>
                    <div id="settingsSmsCode" class="form-text">
                        Code will be sent to the phone number from your account.
                    </div>
                </div>
            </div> -->

            <div class="row m-t-lg">
                <div class="col">

                    <!-- <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="settingsPasswordLogout" checked>
                        <label class="form-check-label" for="settingsPasswordLogout">
                            Log out from all current sessions
                        </label>
                    </div> -->

                    <button class="btn btn-primary m-t-sm">Change Password</button>
                </div>
            </div>
        </form>
    </div>
</div>