<?php
session_start();
require_once dirname(__DIR__)."/includes/constant.inc.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">
    <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Neptune - Responsive Admin Dashboard Template</title>

    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= URL ?>assets/portal-assets/plugins/fontawesome-6.1.1/css/all.min.css">
    <link href="<?= URL ?>assets/portal-assets/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/plugins/pace/pace.css" rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/plugins/highlight/styles/github-gist.css" rel="stylesheet">


    <!-- Theme Styles -->
    <link href="<?= URL ?>assets/portal-assets/css/main.min.css" rel="stylesheet">

    <link rel="icon" type="image/png" sizes="32x32" href="assets/portal-assets/images/neptune.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="assets/portal-assets/images/neptune.png" />
</head>

<body>
    <div class="app align-content-stretch d-flex flex-wrap">
    <?php require_once ROOT_DIR."components/sidebar.php"; ?>
        <!-- sidebar ends -->
        <div class="app-container">
            <!-- navbar header starts -->
            <?php require_once ROOT_DIR."components/navbar.php"; ?>
            <!-- navbar header ends -->
            <div class="app-content">
                <div class="content-wrapper">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <div class="page-description">
                                    <h1>Form Layouts</h1>
                                    <span>Give your forms some structure—from inline to horizontal to custom grid implementations—with our form layout options.</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Form Grid</h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-description">More complex forms can be built using Bootstrap grid classes. Use these for form layouts that require multiple columns, varied widths, and additional alignment options. <strong>Requires the <code>$enable-grid-classes</code> Sass variable to be enabled</strong> (on by default).</p>
                                        <div class="example-container">
                                            <div class="example-content">
                                                <form class="row g-3">
                                                    <div class="col-md-6">
                                                        <label for="inputEmail4" class="form-label">Email</label>
                                                        <input type="email" class="form-control" id="inputEmail4">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputPassword4" class="form-label">Password</label>
                                                        <input type="password" class="form-control" id="inputPassword4">
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="inputAddress" class="form-label">Address</label>
                                                        <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="inputAddress2" class="form-label">Address 2</label>
                                                        <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputCity" class="form-label">City</label>
                                                        <input type="text" class="form-control" id="inputCity">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="inputState" class="form-label">State</label>
                                                        <select id="inputState" class="form-select">
                                                            <option selected>Choose...</option>
                                                            <option>...</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for="inputZip" class="form-label">Zip</label>
                                                        <input type="text" class="form-control" id="inputZip">
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="gridCheck">
                                                            <label class="form-check-label" for="gridCheck">
                                                                Check me out
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-primary">Sign in</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="example-code">
                                                <pre><code class="html">&lt;form class=&quot;row g-3&quot;&gt;
    &lt;div class=&quot;col-md-6&quot;&gt;
        &lt;label for=&quot;inputEmail4&quot; class=&quot;form-label&quot;&gt;Email&lt;/label&gt;
        &lt;input type=&quot;email&quot; class=&quot;form-control&quot; id=&quot;inputEmail4&quot;&gt;
    &lt;/div&gt;
    &lt;div class=&quot;col-md-6&quot;&gt;
        &lt;label for=&quot;inputPassword4&quot; class=&quot;form-label&quot;&gt;Password&lt;/label&gt;
        &lt;input type=&quot;password&quot; class=&quot;form-control&quot; id=&quot;inputPassword4&quot;&gt;
    &lt;/div&gt;
    &lt;div class=&quot;col-12&quot;&gt;
        &lt;label for=&quot;inputAddress&quot; class=&quot;form-label&quot;&gt;Address&lt;/label&gt;
        &lt;input type=&quot;text&quot; class=&quot;form-control&quot; id=&quot;inputAddress&quot; placeholder=&quot;1234 Main St&quot;&gt;
    &lt;/div&gt;
    &lt;div class=&quot;col-12&quot;&gt;
        &lt;label for=&quot;inputAddress2&quot; class=&quot;form-label&quot;&gt;Address 2&lt;/label&gt;
        &lt;input type=&quot;text&quot; class=&quot;form-control&quot; id=&quot;inputAddress2&quot; placeholder=&quot;Apartment, studio, or floor&quot;&gt;
    &lt;/div&gt;
    &lt;div class=&quot;col-md-6&quot;&gt;
        &lt;label for=&quot;inputCity&quot; class=&quot;form-label&quot;&gt;City&lt;/label&gt;
        &lt;input type=&quot;text&quot; class=&quot;form-control&quot; id=&quot;inputCity&quot;&gt;
    &lt;/div&gt;
    &lt;div class=&quot;col-md-4&quot;&gt;
        &lt;label for=&quot;inputState&quot; class=&quot;form-label&quot;&gt;State&lt;/label&gt;
        &lt;select id=&quot;inputState&quot; class=&quot;form-select&quot;&gt;
            &lt;option selected&gt;Choose...&lt;/option&gt;
            &lt;option&gt;...&lt;/option&gt;
        &lt;/select&gt;
    &lt;/div&gt;
    &lt;div class=&quot;col-md-2&quot;&gt;
        &lt;label for=&quot;inputZip&quot; class=&quot;form-label&quot;&gt;Zip&lt;/label&gt;
        &lt;input type=&quot;text&quot; class=&quot;form-control&quot; id=&quot;inputZip&quot;&gt;
    &lt;/div&gt;
    &lt;div class=&quot;col-12&quot;&gt;
        &lt;div class=&quot;form-check&quot;&gt;
            &lt;input class=&quot;form-check-input&quot; type=&quot;checkbox&quot; id=&quot;gridCheck&quot;&gt;
            &lt;label class=&quot;form-check-label&quot; for=&quot;gridCheck&quot;&gt;
                Check me out
            &lt;/label&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class=&quot;col-12&quot;&gt;
        &lt;button type=&quot;submit&quot; class=&quot;btn btn-primary&quot;&gt;Sign in&lt;/button&gt;
    &lt;/div&gt;
&lt;/form&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Inline</h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-description">Use the <code>.row-cols-*</code> classes to create responsive horizontal layouts.</p>
                                        <div class="example-container">
                                            <div class="example-content">
                                                <form class="row row-cols-lg-auto g-3 align-items-center">
                                                    <div class="col-12">
                                                        <label class="visually-hidden" for="inlineFormInputGroupUsername">Username</label>
                                                        <div class="input-group">
                                                            <div class="input-group-text">@</div>
                                                            <input type="text" class="form-control" id="inlineFormInputGroupUsername" placeholder="Username">
                                                        </div>
                                                    </div>
                                                
                                                    <div class="col-12">
                                                        <label class="visually-hidden" for="inlineFormSelectPref">Preference</label>
                                                        <select class="form-select" id="inlineFormSelectPref">
                                                            <option selected>Choose...</option>
                                                            <option value="1">One</option>
                                                            <option value="2">Two</option>
                                                            <option value="3">Three</option>
                                                        </select>
                                                    </div>
                                                
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="inlineFormCheck">
                                                            <label class="form-check-label" for="inlineFormCheck">
                                                                Remember me
                                                            </label>
                                                        </div>
                                                    </div>
                                                
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="example-code">
                                                <pre><code class="html">&lt;form class=&quot;row row-cols-lg-auto g-3 align-items-center&quot;&gt;
    &lt;div class=&quot;col-12&quot;&gt;
        &lt;label class=&quot;visually-hidden&quot; for=&quot;inlineFormInputGroupUsername&quot;&gt;Username&lt;/label&gt;
        &lt;div class=&quot;input-group&quot;&gt;
            &lt;div class=&quot;input-group-text&quot;&gt;@&lt;/div&gt;
            &lt;input type=&quot;text&quot; class=&quot;form-control&quot; id=&quot;inlineFormInputGroupUsername&quot; placeholder=&quot;Username&quot;&gt;
        &lt;/div&gt;
    &lt;/div&gt;

    &lt;div class=&quot;col-12&quot;&gt;
        &lt;label class=&quot;visually-hidden&quot; for=&quot;inlineFormSelectPref&quot;&gt;Preference&lt;/label&gt;
        &lt;select class=&quot;form-select&quot; id=&quot;inlineFormSelectPref&quot;&gt;
            &lt;option selected&gt;Choose...&lt;/option&gt;
            &lt;option value=&quot;1&quot;&gt;One&lt;/option&gt;
            &lt;option value=&quot;2&quot;&gt;Two&lt;/option&gt;
            &lt;option value=&quot;3&quot;&gt;Three&lt;/option&gt;
        &lt;/select&gt;
    &lt;/div&gt;

    &lt;div class=&quot;col-12&quot;&gt;
        &lt;div class=&quot;form-check&quot;&gt;
            &lt;input class=&quot;form-check-input&quot; type=&quot;checkbox&quot; id=&quot;inlineFormCheck&quot;&gt;
            &lt;label class=&quot;form-check-label&quot; for=&quot;inlineFormCheck&quot;&gt;
                Remember me
            &lt;/label&gt;
        &lt;/div&gt;
    &lt;/div&gt;

    &lt;div class=&quot;col-12&quot;&gt;
        &lt;button type=&quot;submit&quot; class=&quot;btn btn-primary&quot;&gt;Submit&lt;/button&gt;
    &lt;/div&gt;
&lt;/form&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Horizontal</h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-description">Create horizontal forms with the grid by adding the <code>.row</code> class to form groups and using the <code>.col-*-*</code> classes to specify the width of your labels and controls. Be sure to add <code>.col-form-label</code> to your <code>&lt;label&gt;</code>s as well so they’re vertically centered with their associated form controls.</p>
                                        <p class="card-description">At times, you maybe need to use margin or padding utilities to create that perfect alignment you need. For example, we’ve removed the <code>padding-top</code> on our stacked radio inputs label to better align the text baseline.</p>
                                        <div class="example-container">
                                            <div class="example-content">
                                                <form>
                                                    <div class="row mb-3">
                                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                                        <div class="col-sm-10">
                                                            <input type="email" class="form-control" id="inputEmail3">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                                                        <div class="col-sm-10">
                                                            <input type="password" class="form-control" id="inputPassword3">
                                                        </div>
                                                    </div>
                                                    <fieldset class="row mb-3">
                                                        <legend class="col-form-label col-sm-2 pt-0">Radios</legend>
                                                        <div class="col-sm-10">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                                                                <label class="form-check-label" for="gridRadios1">
                                                                    First radio
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                                                                <label class="form-check-label" for="gridRadios2">
                                                                    Second radio
                                                                </label>
                                                            </div>
                                                            <div class="form-check disabled">
                                                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3" disabled>
                                                                <label class="form-check-label" for="gridRadios3">
                                                                    Third disabled radio
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <div class="row mb-3">
                                                        <div class="col-sm-10 offset-sm-2">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="gridCheck1">
                                                                <label class="form-check-label" for="gridCheck1">
                                                                    Example checkbox
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Sign in</button>
                                                </form>
                                            </div>
                                            <div class="example-code">
                                                <pre><code class="html">&lt;form&gt;
    &lt;div class=&quot;row mb-3&quot;&gt;
        &lt;label for=&quot;inputEmail3&quot; class=&quot;col-sm-2 col-form-label&quot;&gt;Email&lt;/label&gt;
        &lt;div class=&quot;col-sm-10&quot;&gt;
            &lt;input type=&quot;email&quot; class=&quot;form-control&quot; id=&quot;inputEmail3&quot;&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class=&quot;row mb-3&quot;&gt;
        &lt;label for=&quot;inputPassword3&quot; class=&quot;col-sm-2 col-form-label&quot;&gt;Password&lt;/label&gt;
        &lt;div class=&quot;col-sm-10&quot;&gt;
            &lt;input type=&quot;password&quot; class=&quot;form-control&quot; id=&quot;inputPassword3&quot;&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;fieldset class=&quot;row mb-3&quot;&gt;
        &lt;legend class=&quot;col-form-label col-sm-2 pt-0&quot;&gt;Radios&lt;/legend&gt;
        &lt;div class=&quot;col-sm-10&quot;&gt;
            &lt;div class=&quot;form-check&quot;&gt;
                &lt;input class=&quot;form-check-input&quot; type=&quot;radio&quot; name=&quot;gridRadios&quot; id=&quot;gridRadios1&quot; value=&quot;option1&quot; checked&gt;
                &lt;label class=&quot;form-check-label&quot; for=&quot;gridRadios1&quot;&gt;
                    First radio
                &lt;/label&gt;
            &lt;/div&gt;
            &lt;div class=&quot;form-check&quot;&gt;
                &lt;input class=&quot;form-check-input&quot; type=&quot;radio&quot; name=&quot;gridRadios&quot; id=&quot;gridRadios2&quot; value=&quot;option2&quot;&gt;
                &lt;label class=&quot;form-check-label&quot; for=&quot;gridRadios2&quot;&gt;
                    Second radio
                &lt;/label&gt;
            &lt;/div&gt;
            &lt;div class=&quot;form-check disabled&quot;&gt;
                &lt;input class=&quot;form-check-input&quot; type=&quot;radio&quot; name=&quot;gridRadios&quot; id=&quot;gridRadios3&quot; value=&quot;option3&quot; disabled&gt;
                &lt;label class=&quot;form-check-label&quot; for=&quot;gridRadios3&quot;&gt;
                    Third disabled radio
                &lt;/label&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/fieldset&gt;
    &lt;div class=&quot;row mb-3&quot;&gt;
        &lt;div class=&quot;col-sm-10 offset-sm-2&quot;&gt;
            &lt;div class=&quot;form-check&quot;&gt;
                &lt;input class=&quot;form-check-input&quot; type=&quot;checkbox&quot; id=&quot;gridCheck1&quot;&gt;
                &lt;label class=&quot;form-check-label&quot; for=&quot;gridCheck1&quot;&gt;
                    Example checkbox
                &lt;/label&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;button type=&quot;submit&quot; class=&quot;btn btn-primary&quot;&gt;Sign in&lt;/button&gt;
&lt;/form&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Column Sizing</h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-description">As shown in the previous examples, Bootstrap grid system allows you to place any number of <code>.col</code>s within a <code>.row</code>. They’ll split the available width equally between them. You may also pick a subset of your columns to take up more or less space, while the remaining <code>.col</code>s equally split the rest, with specific column classes like <code>.col-sm-7</code>.</p>
                                        <div class="example-container">
                                            <div class="example-content">
                                                <div class="row g-3">
                                                    <div class="col-sm-7">
                                                        <input type="text" class="form-control" placeholder="City" aria-label="City">
                                                    </div>
                                                    <div class="col-sm">
                                                        <input type="text" class="form-control" placeholder="State" aria-label="State">
                                                    </div>
                                                    <div class="col-sm">
                                                        <input type="text" class="form-control" placeholder="Zip" aria-label="Zip">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="example-code">
                                                <pre><code class="html">&lt;div class=&quot;row g-3&quot;&gt;
    &lt;div class=&quot;col-sm-7&quot;&gt;
        &lt;input type=&quot;text&quot; class=&quot;form-control&quot; placeholder=&quot;City&quot; aria-label=&quot;City&quot;&gt;
    &lt;/div&gt;
    &lt;div class=&quot;col-sm&quot;&gt;
        &lt;input type=&quot;text&quot; class=&quot;form-control&quot; placeholder=&quot;State&quot; aria-label=&quot;State&quot;&gt;
    &lt;/div&gt;
    &lt;div class=&quot;col-sm&quot;&gt;
        &lt;input type=&quot;text&quot; class=&quot;form-control&quot; placeholder=&quot;Zip&quot; aria-label=&quot;Zip&quot;&gt;
    &lt;/div&gt;
&lt;/div&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Javascripts -->
    <script src="<?= URL ?>assets/portal-assets/plugins/jquery/jquery-3.5.1.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/pace/pace.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/highlight/highlight.pack.js"></script>
    <script src="<?= URL ?>assets/portal-assets/js/main.min.js"></script>
</body>

</html>