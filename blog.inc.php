
<div id="latest-blog" class="full-section">
	<h2 class="section-heading">Read our <span class="font-green">latest blogs</span></h2>
    <h3> </h3>
    
    <div class="three-sub-section">
    	<?php while (have_posts()): the_post(); ?>
    	<div class="sub-section">
        	<?php if ( has_post_thumbnail() ) {
				the_post_thumbnail('medium'); 
            } 
			?>

            <div class="sub-text-section">
            	<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                <div class="blog-text">
                <?php 
					$content = get_the_content();
					echo substr($content, 0, 300);
				?>
                </div>
                <p class="sub-section-date-time"><span><?php the_time('F jS, Y') ?> </span></p>
                <a class="more-btn" href="<?php the_permalink(); ?>" title="More">More</a>
			</div>
        </div>
    </div>
        <?php endwhile; ?>
        <div class="cl"></div>
</div>
    



<!--<div id="latest-blog" class="full-section">
	<h2 class="section-heading">Read our <span class="font-green">latest blogs</span></h2>
    <h3>No company is too big or too small for us</h3>
   
    <div class="three-sub-section">
    	<div class="sub-section">
        	<img src="images/blog/blog-image-1.png" alt="Precautions to Guest Blogging" />
            <div class="sub-text-section">
            	<h2>Precautions to Guest Blogging</h2>
                <p>It is a long established fact that a reader will be distracted by the readable</p>
                <p class="sub-section-date-time"><span>February 20, 2016</span></p>
                <a class="more-btn" href="javascript:void()" title="More">More</a>
            </div>
        </div>
        <div class="sub-section">
        	<img src="images/blog/blog-image-2.png" alt="Precautions to Guest Blogging" />
            <div class="sub-text-section">
            	<h2>Precautions to Guest Blogging</h2>
                <p>It is a long established fact that a reader will be distracted by the readable</p>
                <p class="sub-section-date-time"><span>February 20, 2016</span></p>
                <a class="more-btn" href="javascript:void()" title="More">More</a>
            </div>
        </div>
        <div class="sub-section">
        	<img src="images/blog/blog-image-3.png" alt="Precautions to Guest Blogging" />
            <div class="sub-text-section">
            	<h2>Precautions to Guest Blogging</h2>
                <p>It is a long established fact that a reader will be distracted by the readable</p>
                <p class="sub-section-date-time"><span>February 20, 2016</span></p>
                <a class="more-btn" href="javascript:void()" title="More">More</a>
            </div>
        </div>
        <div class="cl"></div>
    </div>
</div>-->