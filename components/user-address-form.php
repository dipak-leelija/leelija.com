<div class="card">
    <div class="card-body p-md-5">
        <form class="form-horizontal" role="form" action="<?php echo $_SERVER['PHP_SELF'] ?>" name="formContactform"
            method="post" enctype="multipart/form-data" autocomplete="off">
            <div class="row">
                <div class="col-md-6">
                    <label for="settingsInputFirstName" class="form-label">Address1</label>
                    <input type="text" class="form-control" name="address1" value="<?php echo $cusDtl[0][24]; ?>"
                        required>
                </div>
                <div class="col-md-6">
                    <label for="settingsInputLastName" class="form-label">Address2</label>
                    <input type="text" class="form-control" name="address2" value="<?php echo $cusDtl[0][25]; ?>"
                        required>
                </div>
            </div>
            <div class="row  m-t-lg">
                <div class="col-md-6">
                    <label for="settingsInputFirstName" class="form-label">Town/City</label>
                    <input type="text" class="form-control" name="town/city" value="<?php echo $cusDtl[0][27]; ?>"
                        required>
                </div>
                <div class="col-md-6">
                    <label for="settingsInputLastName" class="form-label">Postal
                        Code</label>
                    <input type="number" class="form-control" name="postal_code" value="<?php echo $cusDtl[0][29]; ?>"
                        required>
                </div>
            </div>

            <div class="row m-t-lg">
                <div class="col-md-6">
                    <label for="settingsInputUserName" class="form-label">Country</label>

                    <select id="txtProfession" class="form-select " name="txtProfession" required>
                        <option value="" selected="selected">Select Country
                        </option>
                        <option value="Author">Afghanistan</option>
                        <option value="Blogger">Brazil</option>
                        <option value="Blogger">Canada
                        </option>
                        <option value="Business Analyser">Dominica
                        </option>
                        <option value="Marketing Manager"> Fiji
                        </option>
                        <option value="Web Developer">India</option>
                        <option value="Web Developer">Indonesia</option>
                        <option value="Web Developer"> Japan</option>
                        <option value="Web Developer">Kazakhstan</option>
                        <option value="Web Developer">Lebanon</option>
                        <option value="Web Developer">Mexico</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="settingsInputUserName" class="form-label">State</label>
                    <select id="txtProfession" class="form-select " name="txtProfession" required>
                        <option value="" selected="selected">Select State
                        </option>
                        <option value="Author">Andhra Pradesh</option>
                        <option value="Blogger">Bihar</option>
                        <option value="Blogger">Chhattisgarh
                        </option>
                        <option value="Business Analyser">Haryana
                        </option>
                        <option value="Marketing Manager">Jharkhand
                        </option>
                        <option value="Web Developer">West Bengal</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
            </div>
            <div class="row m-t-lg">
                <div class="col-md-6">
                    <label for="Phone1" class="form-label">Phone1</label>
                    <input type="number" class="form-control" name="postal_code" value="<?php echo $cusDtl[0][31]; ?>"
                        required>
                </div>
                <div class="col-md-6">
                    <label for="Phone2" class="form-label">Phone2</label>
                    <input type="number" class="form-control" name="postal_code" value="<?php echo $cusDtl[0][32]; ?>"
                        required>

                </div>
            </div>
            <div class="row m-t-lg">
                <div class="col-md-6">
                    <label for="settingsAbout" class="form-label">Fax</label>
                    <input type="number" class="form-control" name="postal_code" value="<?php echo $cusDtl[0][33]; ?>"
                        required>

                </div>
                <div class="col-md-6">
                    <label for="settingsAbout" class="form-label">joined</label>
                    <input placeholder="12-09-2022" class="form-control" name="postal_code"
                        value="<?php echo date('l jS \of F Y h:i:s A', strtotime($cusDtl[0][22])); ?>" readonly>
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