<div class="card">
    <div class="card-body p-md-5">
        <form class="form-horizontal" role="form" action="<?= PAGE ?>" name="passwordForm" method="post"
            enctype="multipart/form-data" autocomplete="off">
            <div class="row ">
                <div class="col-md-6">
                    <label for="currentPassword" class="form-label">Current Password</label>
                    <input type="password" id="currentPassword" name="currentPassword" class="form-control" aria-describedby="currentPassword" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" required>
                    <div class="form-text">
                        Never share your password with anyone.
                    </div>
                </div>
            </div>
            <div class="row m-t-xxl">
                <div class="col-md-6">
                    <label for="newPassword" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="newPassword" name="newPassword" aria-describedby="newPassword"
                        placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" required>
                </div>
            </div>
            <div class="row m-t-xxl">
                <div class="col-md-6">
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" aria-describedby="confirmPassword" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" required>
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