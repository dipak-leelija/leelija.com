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

                <table class="text-sm">
                    <tr>
                        <th>EMP ID</th>
                        <td class="px-2">:</td>
                        <td><?=$empId?></td>
                    </tr>
                    <tr>
                        <th>Full Name</th>
                        <td class="px-2">:</td>
                        <td><?=$empName?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td class="px-2">:</td>
                        <td><?=$empEmail?></td>
                    </tr>
                    <tr>
                        <th>Mobile</th>
                        <td class="px-2">:</td>
                        <td><?=$empPhone?></td>
                    </tr>
                </table>

                <hr class="horizontal gray-light my-2">

                <table class="text-sm">
                    <tr>
                        <th>Address Line</th>
                        <td class="px-2">:</td>
                        <td><?=$empAddress1.', '.$empAddress2?></td>
                    </tr>
                    <tr>
                        <th>City</th>
                        <td class="px-2">:</td>
                        <td><?=$empCity?></td>
                    </tr>
                    <tr>
                        <th>State</th>
                        <td class="px-2">:</td>
                        <td><?=$empState?></td>
                    </tr>
                    <tr>
                        <th>PIN Code</th>
                        <td class="px-2">:</td>
                        <td><?=$empPinCode?></td>
                    </tr>
                    <tr>
                        <th>Country</th>
                        <td class="px-2">:</td>
                        <td><?=$empCountry?></td>
                    </tr>
                </table>

                <hr class="horizontal gray-light my-2">

                <ul class="list-group">
                    <!-- <li class="list-group-item border-0 ps-0 pt-0 pb-0 text-sm">
                        <strong class="text-dark">EMP ID:</strong> &nbsp; <?=$empId?>
                    </li>
                    <li class="list-group-item border-0 ps-0 pt-0 pb-0 text-sm">
                        <strong class="text-dark">Full Name:</strong> &nbsp; <?=$empName?>
                    </li>
                    <li class="list-group-item border-0 ps-0 pt-0 pb-0 text-sm">
                        <strong class="text-dark">Email:</strong> &nbsp; <?=$empEmail?>
                    </li>
                    <li class="list-group-item border-0 ps-0 pt-0 pb-0 text-sm">
                        <strong class="text-dark">Mobile:</strong> &nbsp; <?=$empPhone?>
                    </li>
                    <li class="list-group-item border-0 ps-0 text-sm">
                        <strong class="text-dark">Location:</strong> &nbsp; <?=$empCountry?>
                    </li> -->

                    <li class="list-group-item border-0 ps-0 pb-0">
                        <strong class="text-dark text-sm">Social:</strong> &nbsp;
                        <a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                            <i class="fab fa-facebook fa-lg"></i>
                        </a>
                        <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                            <i class="fab fa-twitter fa-lg"></i>
                        </a>
                        <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                            <i class="fab fa-instagram fa-lg"></i>
                        </a>
                    </li>
                </ul>
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
                        <div class="avatar me-3">
                            <img src=" assets/img/kal-visuals-square.jpg" alt="kal" class="border-radius-lg shadow">
                        </div>
                        <div class="d-flex align-items-start flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Sophie B.</h6>
                            <p class="mb-0 text-xs">Hi! I need more information..</p>
                        </div>
                        <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                    </li>
                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                        <div class="avatar me-3">
                            <img src=" assets/img/marie.jpg" alt="kal" class="border-radius-lg shadow">
                        </div>
                        <div class="d-flex align-items-start flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Anne Marie</h6>
                            <p class="mb-0 text-xs">Awesome work, can you..</p>
                        </div>
                        <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                    </li>
                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                        <div class="avatar me-3">
                            <img src=" assets/img/ivana-square.jpg" alt="kal" class="border-radius-lg shadow">
                        </div>
                        <div class="d-flex align-items-start flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Ivanna</h6>
                            <p class="mb-0 text-xs">About files I can..</p>
                        </div>
                        <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                    </li>
                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                        <div class="avatar me-3">
                            <img src=" assets/img/team-4.jpg" alt="kal" class="border-radius-lg shadow">
                        </div>
                        <div class="d-flex align-items-start flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Peterson</h6>
                            <p class="mb-0 text-xs">Have a great afternoon..</p>
                        </div>
                        <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                    </li>
                    <li class="list-group-item border-0 d-flex align-items-center px-0">
                        <div class="avatar me-3">
                            <img src=" assets/img/team-3.jpg" alt="kal" class="border-radius-lg shadow">
                        </div>
                        <div class="d-flex align-items-start flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Nick Daniel</h6>
                            <p class="mb-0 text-xs">Hi! I need more information..</p>
                        </div>
                        <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-12 col-xl-4">
        <div class="card h-100">
            <div class="card-header pb-0 p-3">
                <h6 class="mb-0">Platform Settings</h6>
            </div>
            <div class="card-body p-3">
                <h6 class="text-uppercase text-body text-xs font-weight-bolder">Account</h6>
                <ul class="list-group">
                    <li class="list-group-item border-0 px-0">
                        <div class="form-check form-switch ps-0">
                            <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault" checked>
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                                for="flexSwitchCheckDefault">Email me when someone follows me</label>
                        </div>
                    </li>
                    <li class="list-group-item border-0 px-0">
                        <div class="form-check form-switch ps-0">
                            <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault1">
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                                for="flexSwitchCheckDefault1">Email me when someone answers on my
                                post</label>
                        </div>
                    </li>
                    <li class="list-group-item border-0 px-0">
                        <div class="form-check form-switch ps-0">
                            <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault2"
                                checked>
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                                for="flexSwitchCheckDefault2">Email me when someone mentions me</label>
                        </div>
                    </li>
                </ul>
                <h6 class="text-uppercase text-body text-xs font-weight-bolder mt-4">Application</h6>
                <ul class="list-group">
                    <li class="list-group-item border-0 px-0">
                        <div class="form-check form-switch ps-0">
                            <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault3">
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                                for="flexSwitchCheckDefault3">New launches and projects</label>
                        </div>
                    </li>
                    <li class="list-group-item border-0 px-0">
                        <div class="form-check form-switch ps-0">
                            <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault4"
                                checked>
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                                for="flexSwitchCheckDefault4">Monthly product updates</label>
                        </div>
                    </li>
                    <li class="list-group-item border-0 px-0 pb-0">
                        <div class="form-check form-switch ps-0">
                            <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault5">
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                                for="flexSwitchCheckDefault5">Subscribe to newsletter</label>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>