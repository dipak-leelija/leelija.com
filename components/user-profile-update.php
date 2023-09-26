<div class="card">
    <div class="card-body p-md-5">
        <form class="form-horizontal needs-validation" role="form" action="<?= PAGE; ?>" name="formContactform"
            method="post" enctype="multipart/form-data" autocomplete="off" novalidate>
            <div class="row ">
                <div class="col-md-6">
                    <label for="settingsInputFirstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" name="fname" value="<?php echo $cusDtl[0][5]; ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="settingsInputLastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control" name="lname" value="<?php echo $cusDtl[0][6]; ?>" required>
                </div>
            </div>
            <div class="row m-t-lg">
                <div class="col-md-6">
                    <label for="settingsInputEmail" class="form-label">Email address</label>
                    <input type="email" class="form-control" value="<?php echo $cusDtl[0][3]; ?>"
                         disabled>

                </div>
                <div class="col-md-6">
                    <label for="settingsPhoneNumber" class="form-label">Phone Number</label>
                    <input type="number" class="form-control" name="mob_no" value="<?php echo $cusDtl[0][34]; ?>"
                        required>
                </div>
            </div>

            <div class="row m-t-lg">

                <div class="col-md-6">
                    <label for="settingsInputLastName" class="form-label">Gender</label>
                    <div class=" genderingrow ">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="male" 
                            <?= $cusDtl[0][7] == "male" ? 'checked' : '' ;?> required>
                            <label class="form-check-label" for="gridRadios1">
                                Male
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="Female" 
                            <?= $cusDtl[0][7] == "female" ? 'checked' : '' ;?>>
                            <label class="form-check-label" for="gridRadios2">
                                Female
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="others"
                            <?= $cusDtl[0][7] == "others" ? 'checked' : '';?>>
                            <label class="form-check-label" for="gridRadios2">
                                Transgender
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="settingsInputUserName" class="form-label">Profession</label>

                    <select id="txtProfession" class="form-select myselectcss" name="txtProfession" required>
                        <option <?= $cusDtl[0][14] ==  'Author' ? 'selected' : '';?> value="Author">Author</option>
                        <option <?= $cusDtl[0][14] ==  'Blogger' ? 'selected' : '';?> value="Blogger">Blogger</option>
                        <option <?= $cusDtl[0][14] ==  'Blogger Outreach Manager' ? 'selected' : '';?> value="Blogger Outreach Manager">Blogger Outreach Manager
                        </option>
                        <option <?= $cusDtl[0][14] ==  'Business Analyser' ? 'selected' : '';?> value="Business Analyser">Business Analyser
                        </option>
                        <option <?= $cusDtl[0][14] ==  'Marketing Manager' ? 'selected' : '';?> value="Marketing Manager">Marketing Manager
                        </option>
                        <option <?= $cusDtl[0][14] ==  'Developer' ? 'selected' : '';?>value="Developer">Developer</option>
                        <option <?= $cusDtl[0][14] ==  'Others' ? 'selected' : '';?> value="Others">Others</option>
                    </select>
                </div>
            </div>
            <div class="row m-t-lg">
                <div class="col-md-6">
                    <label class="form-label">About You</label>
                    <textarea class="form-control" name="brief" maxlength="500" rows="3"
                        aria-describedby="settingsAboutHelp" required><?php echo $cusDtl[0][10]; ?></textarea>

                </div>
                <div class="col-md-6">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" maxlength="500" rows="3" name="txtDesc"
                        aria-describedby="settingsAboutHelp" required><?php echo trim(stripslashes($cusDtl[0][11])); ?></textarea>

                </div>
            </div>
            <div class="row m-t-lg">
                <div class="col-md-6">
                    <label for="settingsAbout" class="form-label">Organization</label>
                    <input class="form-control" name="organization" required value="<?php echo $cusDtl[0][12]; ?>">
                </div>
            </div>
           
            <div class="row m-t-lg">
                <div class="d-grid gap-2   d-md-flex col-12 col-md-3 mx-auto my-3">
                    <button type="submit" name="btnCancel" class="btn botton-midle btn-danger">Cancel</button>
                    <button type="submit" name="btnSubmit" class="btn botton-midle btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>