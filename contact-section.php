<script src="js/jQuery/jquery-1.10.2.js"></script>

<script type="text/javascript" src="js/ajax.js"></script>

<script type="text/javascript" src="js/contact_form.js"></script>

<div class="contact-page-section px-3 py-5" id="contact">

    <section class="contact-mainpage">
        <div class="contact-box col-12 col-xl-10">
            <div class="contact-social-div">
                <div class="d-flex h-100">
                    <div class="links">
                        <div class="icons-social-div">
                            <a href="https://www.facebook.com/leelijaweb/" target="_blank"><img class="smedia-logo"
                                    src="images/icons/social-media-icons/facebook2x.png" alt="email"></a>
                        </div>
                        <div class="icons-social-div">
                            <a href="https://www.linkedin.com/in/leelija" target="_blank"><img class="smedia-logo"
                                    src="images/icons/social-media-icons/linkedin2x.png" alt="email"></a>
                        </div>
                        <div class="icons-social-div">
                            <a href="https://twitter.com/lee_lija" target="_blank"><img class="smedia-logo"
                                    src="images/icons/social-media-icons/twitter2x.png" alt="email"></a>
                        </div>
                        <div class="icons-social-div">
                            <a href="https://goo.gl/maps/AKCsxmTbJcdta2YKA" target="_blank"
                                class="text-link link--right-icon text-white"><img class="smedia-logo"
                                    src="images/icons/social-media-icons/getlocationmap.png" alt="email"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="contact-form-wrapper">
                <form name="formContact" id="formContact" class="needs-validation" method="post" action=""
                    enctype="multipart/form-data" autocomplete="off" novalidate>
                    <h2 class="contact-main-h2">Contact Us</h2>
                    <div class="form-floating mb-3">
                        <input type="text" minlength="7" name="txtName" id="txtName" class="form-control"
                            placeholder="name@example.com" required>
                        <label for="floatingInput">Full Name</label>
                        <div class="invalid-feedback">
                            Please Enter your Full Name!
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" name="txtEmail" id="txtEmail" inputmode="email"
                            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                            value="<?php if(isset($_SESSION['txtEmail'])){ echo $_SESSION['txtEmail'];}?>"
                            class="form-control" placeholder="name@example.com" required>
                        <label for="floatingInput">Email Address</label>
                        <div class="invalid-feedback">
                            Please enter your email!
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                            minlength="10" pattern="[0-9]+" maxlength="10" name="txtPhone" id="txtPhone"
                            class="form-control" id="floatingInput" placeholder="name@example.com" required>
                        <label for="floatingInput">Phone </label>
                        <div class="invalid-feedback">
                            Please enter valid phone Number!
                        </div>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" minlength="10" placeholder="Leave a comment here"
                            id="floatingTextarea" style="min-height: 96px;" required></textarea>
                        <label for="floatingTextarea">Message</label>
                        <div class="invalid-feedback">
                            Please enter your queries!
                        </div>
                    </div>

                    <div class="text-center  pt-4">
                        <a href="/">
                            <button value="Send" class="my-buttons-hover bn21">Submit</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>

    </section>


</div>
<!-- <div class="container pb-4">

    <h2 class="text-center pb-3 text-capitalize">Have any quarry?</h2>

    <div class="row">

        <div class="col-lg-6 contact_left_row mt-3">

            <h3 class=" text-capitalize blue_color_class text-center">drop us a quick mail</h3>

            <div class="contact_form_dividor"></div>

            <form name="formContact" id="formContact" method="post" action="" enctype="multipart/form-data"
                autocomplete="off">

                <div id="contactPageMsg" align="center"></div>

                <div class="form-group">

                    <label for="">Name</label>

                    <input type="text" name="txtName" id="txtName" value="" class="form-control"
                        placeholder="please enter your name" required>

                </div>

                <div class="form-group">

                    <label for="">Email</label>

                    <input type="email" name="txtEmail" id="txtEmail"
                        value="<?php if(isset($_SESSION['txtEmail'])){ echo $_SESSION['txtEmail'];}else { echo "example@email.com";}?>"
                        class="form-control" placeholder="please enter your email" required>

                </div>

                <div class="form-group">

                    <label for="">Phone</label>

                    <input type="text" name="txtPhone" id="txtPhone" value="" class="form-control"
                        placeholder="please enter your Phone no.">

                </div>

                <div class="form-group">

                    <label for="">Message</label>

                    <textarea name="txtMessage" id="txtMessage" rows="5" cols="80" class="form-control"
                        placeholder="type your message" required></textarea>

                    <br>

                    <input style="color:#0673BA" type="button" class="btn contact_send_btn btn-agile btn-block w-25"
                        value="Send" onclick="contactForm()" />



                </div>

            </form>

        </div>

        <div class="col-lg-6 mt-3 contact_right_row">

            <h3 class="text-capitalize text-center">want to send us an email</h3>

            <div class="contact_form_dividor"></div>

            <div class="contact_form_email_section ms-0 ms-sm-4">

                <ul>

                    <li class="py-2">

                        <a href="mailto:contact@leelija.com">

                            <i class="pe-2 fas fa-envelope"></i>

                            contact@leelija.com

                        </a>

                    </li>

                    <li class="py-2">

                        <a href="mailto:info@leelija.com">

                            <i class="pe-2 fas fa-envelope"></i>

                            info@leelija.com

                        </a>

                    </li>

                    <li class="py-2">

                        <a href="mailto:support@leelija.com">

                            <i class="pe-2 fas fa-envelope"></i>

                            support@leelija.com

                        </a>

                    </li>

                </ul>

            </div>

        </div>

    </div>

</div> -->

<!-- //contact details container -->