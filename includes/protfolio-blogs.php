<?php
//Set the initial count outside of the loop.
$count = (int)0;
//Start the post loop
while (have_posts()) { the_post();
?>


<?php
//Set the span to our default span12
$span = 'col-md-12';
//If the count is 2 or 3 change span to be span3. You can put whatever conditions you want here
if($count == 1 || $count == 2 ){
$span = 'col-md-6';
}
elseif ($count == 3) {
$count = 0;
}

//If the count is equal to 3 or higher (which it should not be) then reset the count to 0
if($count >= 4){
$count = 0;
}
//If its not 3 or higher, increase the count
else{
$count++;
}
?>

<div class="<?php echo $span.' '.$count; ?>">
<div class="portfolio-blogs-section">
<?php the_post_thumbnail(); ?>
<h2><?php echo the_title(); ?> </h2>
</div>
</div>

<?php
//End the post loop
}
?>
