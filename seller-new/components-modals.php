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

    <link rel="icon" type="image/png" sizes="32x32" href="<?= URL ?>assets/portal-assets/images/neptune.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="<?= URL ?>assets/portal-assets/images/neptune.png" />
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
                                    <h1>Modals</h1>
                                    <span>Use Bootstrap’s JavaScript modal plugin to add dialogs to your site for lightboxes, user notifications, or completely custom content.</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Basic</h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-description">Toggle a working modal demo by clicking the button below. It will slide down and fade in from the top of the page.</p>
                                        <div class="example-container">
                                            <div class="example-content">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalLive">
                                                    Launch demo modal
                                                </button>
                                                <div class="modal fade" id="exampleModalLive" tabindex="-1" aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLiveLabel">Modal title</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Woohoo, you're reading this text in a modal!</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="example-code">
                                                <pre><code class="html">&lt;!-- Button trigger modal --&gt;
&lt;button type=&quot;button&quot; class=&quot;btn btn-primary&quot; data-bs-toggle=&quot;modal&quot; data-bs-target=&quot;#exampleModal&quot;&gt;
    Launch demo modal
&lt;/button&gt;

&lt;!-- Modal --&gt;
&lt;div class=&quot;modal fade&quot; id=&quot;exampleModal&quot; tabindex=&quot;-1&quot; aria-labelledby=&quot;exampleModalLabel&quot; aria-hidden=&quot;true&quot;&gt;
    &lt;div class=&quot;modal-dialog&quot;&gt;
        &lt;div class=&quot;modal-content&quot;&gt;
            &lt;div class=&quot;modal-header&quot;&gt;
                &lt;h5 class=&quot;modal-title&quot; id=&quot;exampleModalLabel&quot;&gt;Modal title&lt;/h5&gt;
                &lt;button type=&quot;button&quot; class=&quot;btn-close&quot; data-bs-dismiss=&quot;modal&quot; aria-label=&quot;Close&quot;&gt;&lt;/button&gt;
            &lt;/div&gt;
            &lt;div class=&quot;modal-body&quot;&gt;
                ...
            &lt;/div&gt;
            &lt;div class=&quot;modal-footer&quot;&gt;
                &lt;button type=&quot;button&quot; class=&quot;btn btn-secondary&quot; data-bs-dismiss=&quot;modal&quot;&gt;Close&lt;/button&gt;
                &lt;button type=&quot;button&quot; class=&quot;btn btn-primary&quot;&gt;Save changes&lt;/button&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&lt;/div&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Optional Sizes</h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-description">Modals have three optional sizes, available via modifier classes to be placed on a <code>.modal-dialog</code>. These sizes kick in at certain breakpoints to avoid horizontal scrollbars on narrower viewports.</p>
                                        <table class="table">
                                            <thead>
                                              <tr>
                                                <th>Size</th>
                                                <th>Class</th>
                                                <th>Modal max-width</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              <tr>
                                                <td>Small</td>
                                                <td><code>.modal-sm</code></td>
                                                <td><code>300px</code></td>
                                              </tr>
                                              <tr>
                                                <td>Default</td>
                                                <td class="text-muted">None</td>
                                                <td><code>500px</code></td>
                                              </tr>
                                              <tr>
                                                <td>Large</td>
                                                <td><code>.modal-lg</code></td>
                                                <td><code>800px</code></td>
                                              </tr>
                                              <tr>
                                                <td>Extra large</td>
                                                <td><code>.modal-xl</code></td>
                                                <td><code>1140px</code></td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        <div class="example-container">
                                            <div class="example-content">
                                                <button type="button" class="btn btn-primary m-b-sm" data-bs-toggle="modal" data-bs-target="#exampleModalXl">Extra large modal</button>
                                                <button type="button" class="btn btn-primary m-b-sm" data-bs-toggle="modal" data-bs-target="#exampleModalLg">Large modal</button>
                                                <button type="button" class="btn btn-primary m-b-sm" data-bs-toggle="modal" data-bs-target="#exampleModalSm">Small modal</button>
                                                <div class="modal fade" id="exampleModalXl" tabindex="-1" aria-labelledby="exampleModalXlLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title h4" id="exampleModalXlLabel">Extra large modal</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                ...
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="exampleModalLg" tabindex="-1" aria-labelledby="exampleModalLgLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title h4" id="exampleModalLgLabel">Large modal</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                ...
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="exampleModalSm" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog modal-sm">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title h4" id="exampleModalSmLabel">Small modal</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                ...
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="example-code">
                                                <pre><code class="html">&lt;div class=&quot;modal-dialog modal-xl&quot;&gt;...&lt;/div&gt;
&lt;div class=&quot;modal-dialog modal-lg&quot;&gt;...&lt;/div&gt;
&lt;div class=&quot;modal-dialog modal-sm&quot;&gt;...&lt;/div&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Vertically Centered</h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-description">Add <code>.active</code> to a <code>.list-group-item</code> to indicate the current active selection.</p>
                                        <div class="example-container">
                                            <div class="example-content">
                                                <button type="button" class="btn btn-primary m-b-sm" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                                                    Vertically centered modal
                                                </button>
                                                <button type="button" class="btn btn-primary m-b-sm" data-bs-toggle="modal" data-bs-target="#exampleModalCenteredScrollable">
                                                    Vertically centered scrollable modal
                                                </button>
                                                <div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Placeholder text for this demonstration of a vertically centered modal dialog.</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="exampleModalCenteredScrollable" tabindex="-1" aria-labelledby="exampleModalCenteredScrollableTitle" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenteredScrollableTitle">Modal title</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Placeholder text for this demonstration of a vertically centered modal dialog.</p>
                                                                <p>In this case, the dialog has a bit more content, just to show how vertical centering can be added to a scrollable modal.</p>
                                                                <p>What follows is just some placeholder text for this modal dialog. Sipping on Rosé, Silver Lake sun, coming up all lazy. It’s in the palm of your hand now baby. So we hit the boulevard. So make a wish, I'll make it like your birthday everyday. Do you ever feel already buried deep six feet under? It's time to bring out the big balloons. You could've been the greatest. Passport stamps, she's cosmopolitan. Your kiss is cosmic, every move is magic.</p>
                                                                <p>We're living the life. We're doing it right. Open up your heart. I was tryna hit it and quit it. Her love is like a drug. Always leaves a trail of stardust. The girl's a freak, she drive a jeep in Laguna Beach. Fine, fresh, fierce, we got it on lock. All my girls vintage Chanel baby.</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="example-code">
                                                <pre><code class="html">&lt;!-- Vertically centered modal --&gt;
&lt;div class=&quot;modal-dialog modal-dialog-centered&quot;&gt;
    ...
&lt;/div&gt;

&lt;!-- Vertically centered scrollable modal --&gt;
&lt;div class=&quot;modal-dialog modal-dialog-centered modal-dialog-scrollable&quot;&gt;
    ...
&lt;/div&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Toggle Between Modals</h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-description">Toggle between multiple modals with some clever placement of the <code>data-bs-target</code> and <code>data-bs-toggle</code> attributes. For example, you could toggle a password reset modal from within an already open sign in modal. <strong>Please note multiple modals cannot be open at the same time</strong>—this method simply toggles between two separate modals.</p>
                                        <div class="example-container">
                                            <div class="example-content">
                                                <div class="modal fade" id="exampleModalToggle" aria-labelledby="exampleModalToggleLabel" tabindex="-1" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalToggleLabel">Modal 1</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Show a second modal and hide this one with the button below.
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Open second modal</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="exampleModalToggle2" aria-labelledby="exampleModalToggleLabel2" tabindex="-1" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalToggleLabel2">Modal 2</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Hide this modal and show the first with the button below.
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Back to first</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Open first modal</a>
                                            </div>
                                            <div class="example-code">
                                                <pre><code class="html">&lt;!-- First modal dialog --&gt;
&lt;div class=&quot;modal fade&quot; id=&quot;modal&quot; aria-hidden=&quot;true&quot; aria-labelledby=&quot;...&quot; tabindex=&quot;-1&quot;&gt;
    &lt;div class=&quot;modal-dialog modal-dialog-centered&quot;&gt;
        &lt;div class=&quot;modal-content&quot;&gt;
            ...
            &lt;div class=&quot;modal-footer&quot;&gt;
                &lt;!-- Toogle to second dialog --&gt;
                &lt;button class=&quot;btn btn-primary&quot; data-bs-target=&quot;#modal2&quot; data-bs-toggle=&quot;modal&quot; data-bs-dismiss=&quot;modal&quot;&gt;Open #modal2&lt;/button&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&lt;/div&gt;
&lt;!-- Second modal dialog --&gt;
&lt;div class=&quot;modal fade&quot; id=&quot;modal2&quot; aria-hidden=&quot;true&quot; aria-labelledby=&quot;...&quot; tabindex=&quot;-1&quot;&gt;
    &lt;div class=&quot;modal-dialog modal-dialog-centered&quot;&gt;
        &lt;div class=&quot;modal-content&quot;&gt;
            ...
            &lt;div class=&quot;modal-footer&quot;&gt;
                &lt;!-- Toogle to first dialog, `data-bs-dismiss` attribute can be omitted - clicking on link will close dialog anyway --&gt;
                &lt;a class=&quot;btn btn-primary&quot; href=&quot;#modal&quot; data-bs-toggle=&quot;modal&quot; role=&quot;button&quot;&gt;Open #modal&lt;/a&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&lt;/div&gt;
&lt;!-- Open first dialog --&gt;
&lt;a class=&quot;btn btn-primary&quot; data-bs-toggle=&quot;modal&quot; href=&quot;#modal&quot; role=&quot;button&quot;&gt;Open #modal&lt;/a&gt;</code></pre>
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