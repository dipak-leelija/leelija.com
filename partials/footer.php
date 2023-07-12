<footer class="footer ">
    <!-- -- FOOTER SECTION 1 -- -->
    <section class="d-flex justify-content-center text-light">
        <div class="row px-3 footer-div">
            <div class="col-12 col-lg-5 col-md-6 p-0 bg-img">
                <img src="img/footer-logo.png" class=" footer-logo" alt="">
                <p class="mb-4 text-light" style="font-size: 1.2rem">
                    Objectively integrate enterprise wide strategic theme areas with functionalized infrastructures.
                    Interactively productize premium mobile technologies.
                </p>
                <div>
                    <ul class="list-unstyled ">
                        <li class="predesign"><i class="pe-3 fa-solid fa-phone"></i><a href="tel:+91 874224523">+91
                                874224523</a></li>
                        <li class="predesign"><i class="pe-3 fa-solid fa-earth-americas"></i><a
                                href="/">www.leelija.com</a></li>
                        <li class="predesign"><i class="pe-3 fa-solid fa-envelope"></i><a
                                href="mailto:">info@leelija.com</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-6 col-lg-2 col-md-6 ">
                <ul class="list-unstyled ">
                    <h4 class="uldesign">Our Services</h4>
                    <div class=''>
                        <li class='lidesign'><a href="<?php echo URL;?>/social-media-marketing-services.php">Branding
                                Services</a></li>
                        <li class='lidesign'><a href="<?php echo URL;?>/content-marketing.php">Content Marketing</a>
                        </li>
                        <li class='lidesign'><a href="<?php echo URL;?>/guest-posting.php">Guest Post Services</a></li>
                        <li class='lidesign'><a href="<?php echo URL;?>/seo-services.php">SEO Services</a></li>
                        <li class='lidesign'><a href="<?php echo URL;?>/web-development-services.php">Web Design</a>
                        </li>
                        <!-- <li class='lidesign'><a href="<?php echo URL;?>/web-development-services.php">Web
                                Development</a></li> -->

                        <!-- <li class='lidesign'><a href="<?php echo URL;?>/social-media-marketing-services.php">Social
                                Media Marketing</a> -->
                        </li>

                        <li class='lidesign'><a href="<?php echo URL;?>/wordpress-development-services.php">WordPress
                                Development</a></li>
                    </div>
                </ul>
            </div>
            <div class="col-6 col-lg-2 col-md-6">
                <ul class="list-unstyled ">
                    <h4 class="uldesign">More Info</h4>
                    <div class=''>
                        <li class='lidesign'><a href="<?php echo URL;?>/blog">Blog</a></li>
                        <li class='lidesign'><a href="<?php echo URL;?>/career.php">Career</a></li>
                        <li class='lidesign'><a href="<?php echo URL;?>/contact.php">Clients Query</a></li>
                        <li class='lidesign'><a href="<?php echo URL;?>/domains.php">Marketplace</a></li>
                        <li class='lidesign'><a href="<?php echo URL;?>/portfolio.php">Portfolio</a></li>
                        <li class='lidesign'><a href="<?php echo URL;?>/start-selling.php">Start Selling</a></li>

                    </div>
                </ul>
            </div>
            <div class="col-12 col-lg-3 col-md-6 pe-0">
                <h4 class="uldesign">
                    Connect
                </h4>
                <div class=" mt-5 mb-3 ">
                    <a href="https://www.facebook.com/leelijaweb/" target="_blank"><i
                            class=" fa-brands fa-facebook-f icondesign"></i></a>
                    <a href="https://twitter.com/lee_lija" target="_blank"><i
                            class="fa-brands fa-twitter icondesign"></i></a>
                    <a href="https://www.linkedin.com/in/leelija" target="_blank"><i
                            class="fa-brands fa-linkedin-in icondesign"></i></a>
                    <a href="https://in.pinterest.com/leelijaa/" target="_blank"><i
                            class="fa-brands fa-pinterest-p icondesign"></i></a>
                </div>
                <p class="mb-5 fs-6 text-light">Keep up to date with latest news and update about Leelija, simply
                    subscribe with your email address.
                </p>

                <div class="newswrap">
                    <div class="input-group">
                        <input type="text" class="newsletter" id="subscribeInp" placeholder="Email Address"
                            style="font-size: 1.1rem;">
                        <div class="newsletter_icon">
                            <i class="fa-solid fa-paper-plane sendmsg" id="subscribeBtn"></i>
                        </div>
                        <p class="text-light mt-2 subscriptionMsg" id="subscriptionMsg"></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- -- FOOTER SECTION 2 -- -->

    <div class="end_footer text-light px-3">
        <div class="row">
            <div class="col-12 col-md-7 pt-2 ">
                <p class="p-3 ps-md-5 fs-6 fs-md-4 text-light">
                    Copyright 2019 <strong style="font-weight: bold;">Leelija Websolutions.</strong> All rights
                    reserved.</p>
            </div>
            <div class="col-12 col-md-5">
                <ul class="list-unstyled p-0 d-flex w-100">
                    <div class='d-flex justify-content-start w-100 p-0 m-0'>
                        <li class='px-2 px-md-3 lidesign2'><a class="f-menu" href="/">Home</a></li>
                        <li class='px-2 px-md-3 lidesign2'><a class="f-menu"
                                href="<?php echo URL;?>/about.php">About</a></li>
                        <li class='px-2 px-md-3 lidesign2'><a class="f-menu" href="#">Privacy</a></li>
                        <li class='px-2 px-md-3 lidesign2'><a class="f-menu" href="#">Terms</a></li>
                        <li class='px-2 px-md-3 lidesign2'><a class="f-menu"
                                href="<?php echo URL;?>/career.php">Careers</a></li>
                    </div>
                </ul>
            </div>
        </div>
    </div>
</footer>


<script>
let mblBtn = document.getElementById("navbar-toggler");
mblBtn.addEventListener("click", mobileMenuToggle);

function mobileMenuToggle() {
    // alert('Working');
    mblBtn.classList.toggle("is-active");
}

// let sbsBtn = document.getElementById("subscribeBtn");
// let sbsInp = document.getElementById("subscribeInp");
// let sbsMsg = document.getElementById("subscriptionMsg");

// sbsBtn.addEventListener("click", (email) =>{
//     if (email != "") {
//      alert();   
//     }else{
//         sbsMsg.innterText = "Enter an Email First";
//     }
// });

// function subscribeUs (email) =>{
//     // if (email != null) {

//     // }
//     alert("Hi");
// }
</script>