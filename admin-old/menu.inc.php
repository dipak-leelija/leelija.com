<div id="brand-logo">
    <img src="../<?php echo LOGO_ADMIN_PATH; ?>" width="<?php echo LOGO_ADMIN_WIDTH; ?>" 
    height="<?php echo LOGO_ADMIN_HEIGHT; ?>" alt="<?php echo LOGO_ALT; ?>" />     
</div>

<div class="menu-block">
	<br/>
	<h2 data-toggle="collapse" data-target="#orders" style="cursor:pointer"><img src="../images/admin/icon/order.png" width="20" height="20" alt="Web Page" />Order + Booking</h2>
		<ul id="orders" class="collapse">
			<li><a href="order.php" title="Orders Management">Orders Management</a></li>
		</ul>

	<h2 data-toggle="collapse" data-target="#usermanagement" style="cursor:pointer"><img src="../images/admin/icon/user-management.png" width="20" height="20" alt="User Management" />User Management</h2>
    <ul id="usermanagement" class="collapse">
        <li><a href="customer.php" title="Customer">Customer</a></li>
        <li><a href="customer_type.php" title="Customer Type">Customer Type</a></li>
    </ul>
    
	<h2 data-toggle="collapse" data-target="#photos" style="cursor:pointer"><img src="../images/admin/icon/gallery.jpg" width="20" height="20" alt="User Management" />PHOTO GALLERY</h2>
    <ul id="photos" class="collapse">
        <li><a href="album.php" title="Customer">Photo Gallery</a></li>
    </ul>
    
    <h2 data-toggle="collapse" data-target="#cmanagement" style="cursor:pointer"><img src="../images/admin/icon/web-page.png" width="20" height="20" alt="Web Page" />Content Management</h2>
    <ul id="cmanagement" class="collapse">
        <li><a href="cat_static.php" title="Static Categories">Web Categories</a></li>
        <li><a href="static.php" title="Web Pages">Web Pages</a></li>
         <li><a href="notice.php" title="news letters">eBox-136 Newsletters</a></li>
    </ul>
    
    <h2 data-toggle="collapse" data-target="#smanagement" style="cursor:pointer"><img src="../images/admin/icon/services.png" width="20" height="20" alt="Web Page" />Services Management</h2>
    <ul id="smanagement" class="collapse">
        <li><a href="services-type.php" title="Services Type">Services Type</a></li>
        <li><a href="services.php" title="Services">Services</a></li>
         <li><a href="services-featured.php" title="Services Featured">Services Featured</a></li>
    </ul>
    <h2 data-toggle="collapse" data-target="#blogs" style="cursor:pointer"><img src="../images/admin/icon/blog.png" width="20" height="20" alt="Marketing Tools" />Blogs</h2>
    <ul id="blogs" class="collapse">
        <li><a href="blog-niche.php" title="Email Group">Niches</a></li>
        <li><a href="blog_master.php" title="Send Email">Blogs</a></li>
    </ul>
        <h2 data-toggle="collapse" data-target="#contact" style="cursor:pointer"><img src="../images/admin/icon/communications.png" width="20" height="20" alt="Marketing Tools" />Contact Management</h2>
    <ul id="contact" class="collapse">
        <li><a href="contact.php" title="Contact">Contact Details</a></li>
    </ul>
    
    <h2 data-toggle="collapse" data-target="#marketinttools" style="cursor:pointer"><img src="../images/admin/icon/marketing-tools.png" width="20" height="20" alt="Marketing Tools" />Marketing Tools</h2>
    <ul id="marketinttools" class="collapse">
        <?php /*?><li><a href="email.php" title="Send Email">Google Analytics</a></li><?php */?>
        <li><a href="email_cat.php" title="Email Group">E-mail Group </a></li>
        <li><a href="email.php" title="Send Email">E-mail Management </a></li>
        <li><a href="email_export.php" title="E-mail Export">E-mail Export </a></li>
        <!--<li><a href="tracking_code.php" title="Visitor Tracking">Visitor Tracking</a></li> -->  
        <li><a href="auto_responder.php" title="Auto Responder">Auto Responder</a></li>
        <li><a href="email_autores_setup.php" title="Auto Responder setup">Auto Responder Setup</a></li>
    </ul>
    
    
    <h2 data-toggle="collapse" data-target="#adminuser" style="cursor:pointer"><img src="../images/admin/icon/tools.png" width="20" height="20" alt="Tools" />Setup Tools</h2>
    <ul id="adminuser" class="collapse">
    	<li><a href="admin_user.php" title="Admin Users" >Admin Users</a></li>
        <li><a href="back_up.php" title="Database Backup" >Database Backup</a></li>
       <?php /*?> <li><a href="paypal.php" title="Manage PayPal">Manage PayPal</a></li><?php */?>
    </ul>
    
</div>