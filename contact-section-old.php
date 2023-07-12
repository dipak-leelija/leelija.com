<script src="js/jQuery/jquery-1.10.2.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript" src="js/contact_form.js"></script>
<div class="w3-contact py-5" id="contact">
  <div class="container py-lg-5">
    <h3 class="stat-title text-center pb-5">contact us
    </h3>
    <div class="row contact-form pt-lg-5">
      <!-- contact details -->
		<div class="col-lg-6 contact-bottom d-flex flex-column contact-right-w3ls">
			<h5>get in touch</h5>
			<div class="fv3-contact">
			  <div class="row">
				<div class="col-2">
				  <span class="fas fa-envelope-open"></span>
				</div>
				<div class="col-10 contact-add">
				  <h6 class="montserrat-font">email</h6>
				  <p>
					<a href="mailto:example@email.com" class="text-dark">info@leelija.com</a>
				  </p>
				</div>
			  </div>
			</div>
			<div class="fv3-contact my-4">
			  
			</div>
			<div class="fv3-contact">
			  <div class="row">
				<div class="col-2">
				  <span class="fas fa-home"></span>
				</div>
				<div class="col-10 contact-add">
				  <h6>address</h6>
				  <p>Barasat, Kol- 700125, West Bengal, India.</p>
				</div>
			  </div>
			</div>
		</div>
		<div class="col-lg-6 wthree-form-left my-lg-0 mt-5">
			<h5>send us a mail</h5>
			<!-- contact form grid -->
			<div class="contact-top1">
				<form name="formContact" id="formContact" method="post" action=""  enctype="multipart/form-data" 
					autocomplete="off">
					<div id="contactPageMsg" align="center"></div>
					<hr />
					<div class="form-group d-flex">
					  <label>
						Name
					  </label>
					  <input class="form-control" type="text" id="txtName" placeholder="Johnson" name="txtName" required="">
					</div>
					<div class="form-group d-flex">
					  <label>
						Email
					  </label>
					  <input class="form-control" type="email" id="txtEmail" placeholder="example@email.com" name="txtEmail" required="">
					</div>
					<div class="form-group d-flex">
					  <label>
						Phone
					  </label>
					  <input class="form-control" type="text" id="txtPhone" placeholder="XXXX XXXX XX" name="txtPhone" required="">
					</div>
					<div class="form-group d-flex">
					  <label>
						Message
					  </label>
					  <textarea class="form-control" rows="5" id="txtMessage" name="txtMessage" placeholder="Your message" required></textarea>
					</div>
					<div class="d-flex justify-content-end">
					  <input type="button" class="btn btn-agile btn-block w-25" value="Send" onclick="contactForm()" />
					 
					</div>
				</form>
			</div>
        <!--  //contact form grid ends here -->
		</div>

    </div>
    <!-- //contact details container -->
  </div>
</div>
