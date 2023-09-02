<?php
$page = "Admin_employees-Details";
require_once dirname(__DIR__) ."/includes/constant.inc.php";
require_once ADM_DIR . "incs/global-inc.php";

require_once ROOT_DIR . "classes/encrypt.inc.php";

require_once ROOT_DIR . "classes/employee.class.php";
require_once ROOT_DIR . "classes/utility.class.php";


$Employee	= new Employee();
$Utility    = new Utility();

$Utility->setCurrentPageSession();

$allEmps = $Employee->allEmps();

if(isset($_GET['action']) && isset($_GET['msg'])){
    $_GET['action'] == 'SUCCESS' ? $alertClasse = 'alert-primary' : $alertClasse = 'alert-warning';
    $msg = $_GET['msg'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<?= FAVCON_PATH ?>" type="image/png">
    <title> Leelija - Employee Details</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <link href="assets/css/leelija-admin.css" rel="stylesheet" />
    <link href="assets/css/soft-ui-dashboard.css" rel="stylesheet" id="pagestyle" />
    <link rel="stylesheet" href="../plugins/data-table/style.css">
</head>

<body class="g-sidenav-show  bg-gray-100">
    <?php require_once "partials/sidebar.php"; ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <?php require_once "partials/navbar.php"; ?>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <?php if (isset($msg)) { ?>
                            <div class="alert <?= $alertClasse ?> alert-dismissible fade show" role="alert">
                                <strong><?= $msg ?></strong>
                                <button type="button" class="btn-close btn-dark" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <?php } ?>
                            <h6>Employee Details</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0 datatable">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Employee</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Designation</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Status</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Joining Date</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($allEmps as $eachEmp) {
                                            
                                        $empId = url_enc($eachEmp->emp_id);

                                        $empIcon = IMG_PATH.'default-icons/default-emp.png';
                                        if ($eachEmp->image != '') {
                                            $empIcon = IMG_PATH.'emps/'.$eachEmp->image;
                                        }
                                        ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="<?= $empIcon ?>"
                                                            class="object-fit-cover avatar avatar-sm me-3" alt="user1">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm"><?= $eachEmp->name ?></h6>
                                                        <p class="text-xs text-secondary mb-0">john@creative-tim.com</p>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <p class="text-xs font-weight-bold mb-0"><?= $eachEmp->designation ?>
                                                </p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="badge badge-sm bg-gradient-success">Online</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold"><?= $eachEmp->doj?></span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="employee-details.php?data=<?= $empId; ?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                    <i class="fa-solid fa-eye pe-4"></i>
                                                </a>
                                                <span class="text-secondary font-weight-bold cursor-pointer text-xs" id="<?= $Utility->getLatersOnly($empId); ?>" data-id="<?= $empId; ?>" onclick="deleteRow(this, event)" data-toggle="tooltip" data-original-title="Edit user">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php require_once ADM_DIR .'partials/bar-setting.php'; ?>

    <!--   Core JS Files   -->
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="<?= URL ?>plugins/data-table/simple-datatables.js"></script>
    <script src="<?= URL ?>plugins/tinymce/tinymce.js"></script>
    <script src="<?= URL ?>plugins/main.js"></script>
    <script src="<?= URL ?>plugins/jquery-3.6.0.min.js"></script>
    <script src="<?= URL ?>js/ajax.js"></script>
    <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }


    const deleteRow = (t, event) => {

        event.preventDefault();
        let rowId = t.getAttribute('data-id');
        let fadeTarget = t.getAttribute('id');

        if (confirm('Do you want to delete?') == true) {

            $.ajax({
                url: "ajax/delete.ajax.php",
                type: "POST",
                data: {
                    empDelAction: rowId,
                },
                success: function(response) {
                    // console.log(response);
                    if (response.trim() == 'SU001') {
                        $(`#${fadeTarget}`).closest("tr").fadeOut();
                        
                        // t.closest("tr").fadeOut();
                    } else {
                        alert(response)
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("Status: " + textStatus);
                    alert("Error: " + errorThrown);
                }
            });
        }

    }
    </script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>

</body>

</html>