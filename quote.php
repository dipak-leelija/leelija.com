<script src="js/jQuery/jquery-1.10.2.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript" src="js/contact_form.js"></script>

<div class="get_a_quote">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-2 d-none d-lg-block">
				<img src="images/icons/chat.png" alt="">
			</div>
			<div class="col-lg-7 col-md-7">
				<div class="quote_text text-white">

					<h2 class="text-uppercase">Get a custom quote</h2>
					<p class="text-white py-2">analytics to sell your creativity thus boosting your online business.</p>
				</div>
			</div>
			<div class="col-lg-3 col-md-5">
				<button class="divider_button" type="button" data-toggle="modal" id="EndQuote" data-target="#EndQuote" name="button" onClick="sendQuoteModal();">Get a Quote <i class="fas pl-2 fa-long-arrow-alt-right"></i></button>
			</div>
		</div>
	</div>
</div>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="col-lg-12 contact_left_row">
		<h3 class=" text-capitalize blue_color_class text-center">Send Your Query</h3>
		<div class="contact_form_dividor"></div>
		<form name="formContact" id="formContact" method="post" action=""  enctype="multipart/form-data" 
					autocomplete="off">
			<div id="contactPageMsg" align="center"></div>
			<div class="form-group">
			  <label for="">Name</label>
			  <input type="text" name="txtName" id="txtName" value="" class="form-control" placeholder="please enter your name" required>
			</div>
			<div class="form-group">
			  <label for="">Email</label>
			  <input type="email" name="txtEmail" id="txtEmail" value="<?php if(isset($_SESSION['txtEmail'])){ echo $_SESSION['txtEmail'];}else { echo "example@email.com";}?>"  class="form-control" placeholder="please enter your email" required>
			</div>
			<div class="form-group">
			  <label for="">Phone</label>
			  <input type="text" name="txtPhone" id="txtPhone" value="" class="form-control" placeholder="please enter your Phone no.">
			</div>
			<div class="form-group">
				<label for="">Message</label>
				<textarea name="txtMessage" id="txtMessage" rows="5" cols="80" class="form-control" placeholder="type your message" required></textarea>
				<!--<button type="submit" class="btn btn-explore-banner">Submit</button>--><br>
				<input type="button" class="btn btn-agile btn-block w-25" value="Send" onclick="contactForm()" />

			</div>
		</form>
	</div>
  </div>

</div>


	
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("EndQuote");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>	   
