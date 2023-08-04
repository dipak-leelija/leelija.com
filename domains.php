<?php
session_start();
require_once("includes/constant.inc.php");
require_once "_config/dbconnect.php";
require_once("classes/date.class.php");
require_once("classes/error.class.php");
require_once("classes/search.class.php");
require_once("classes/customer.class.php");
require_once("classes/login.class.php");

//require_once("../classes/front_photo.class.php");
require_once("classes/blog_mst.class.php");
require_once("classes/domain.class.php");
require_once("classes/utility.class.php");
require_once("classes/utilityMesg.class.php");
require_once("classes/utilityImage.class.php");
require_once("classes/utilityNum.class.php");

/* INSTANTIATING CLASSES */
$dateUtil      	= new DateUtil();
$error 			= new Error();
$search_obj		= new Search();
$customer		= new Customer();
$logIn			= new Login();

//$ff				= new FrontPhoto();
$blogMst		= new BlogMst();
$domain			= new Domain();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
######################################################################################################################
$typeM			= $utility->returnGetVar('typeM','');
//user id
$cusId			= $utility->returnSess('userid', 0);
$cusDtl			= $customer->getCustomerData($cusId);
$domainDtls		= $domain->ShowDomainData();


?>
<!DOCTYPE HTML>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo COMPANY_S; ?>: blogs name, blogs on sales, blogs popular, blogs platforms</title>
    <link rel="icon" href="<?php echo FAVCON_PATH; ?>" type="image/png">
    <link rel="apple-touch-icon" href="<?php echo FAVCON_PATH; ?>" />
    
    <meta name="description"
        content="LeeLija help Instantly find the Domain Name, Blogs name, Website for small business, blogs on fashion, blogs about food, blogs design that you have been looking for.">
    <meta name="keywords" content="blogs name, blogs making, blogs for beginners, blog wordpress theme, blogs seo, blogs topics, blogs types, blogs layout, blogs niche, blogs post, blogs templates, blogs for sale,
	blogs for sales, established blogs for sale, blogs sales, blogs on sales" />


    <!-- <link href="css/bootstrap.css" rel='stylesheet' type='text/css' /> -->
    <link rel="stylesheet" href="plugins/bootstrap-5.2.0/css/bootstrap.css">
    <link rel="stylesheet" href="plugins/fontawesome-6.1.1/css/all.css">

    <!-- Custom CSS -->
    <link href="css/leelija.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel='stylesheet' type='text/css' />

    <!-- //Custom Theme files -->
    <link href="css/jquery-ui.css" rel="stylesheet">

    <!--webfonts-->
    <link href="//fonts.googleapis.com/css?family=Montserrat:400,500,600,700,900" rel="stylesheet">
    <!-- <link href="//fonts.googleapis.com/css?family=Nunito+Sans:400,700,900" rel="stylesheet"> -->
    <!--//webfonts-->

</head>

<body id="page-top" data-scrollbar data-target=".navbar-fixed-top">
    <div id="home">
        <!-- header -->
        <?php require_once "partials/navbar.php"; ?>

        <div class="container-fluid py-3 text-center">

            <h2 class="pb-2 text-uppercase"><span class="">Start</span> Your <span
                    class="color-blue font-weight-bold">Online Business</span> with ready Products</h2>
            <h4>Pick any Domain name with <span class="color-blue"> Ready website or blog</span> and <span
                    class="color-blue">Build</span> Your <span class="color-blue font-weight-bold">Business</span> </h4>
            <br>
            <div class="row">
                <div class="col-lg-3">
                    <div class="list-group">
                        <h3>DA</h3>
                        <input type="hidden" id="hidden_minimum_da" value="0" />
                        <input type="hidden" id="hidden_maximum_da" value="100" />
                        <p id="da_show">1 - 100</p>
                        <div id="da_range"></div>
                    </div>
                    <div class="list-group">
                        <h3>Niches</h3>
                        <div class="nichdiv" style="height: 380px; overflow-y: auto; overflow-x: hidden; text-align: start;"
                            id="list-niches" data-scrollbar>
                            <?php
								$BlogMst  = $blogMst->ShowBlogNichMast();
								foreach($BlogMst as $row)
								{
								?>
                            <div class="list-group-item checkbox">
                                <label><input type="checkbox" class="common_selector niche"
                                        value="<?php echo $row['niche_id']; ?>">
                                    <?php echo $row['niche_name']; ?></label>
                            </div>
                            <?php
								}
							?>
                        </div>
                    </div>

                </div>
                <!--Sort and Search section end-->

                <!--Start Content Section-->
                <div class="col-lg-9">
                    <br />
                    <div class="row filter_data">

                    </div>
                </div>
                <!--end Content Section-->

            </div><!-- end Row-->
        </div>
        <!--</section>-->

        <!--Content Section -->
        <section class="wthree-row py-sm-5">
            <div class="container">
                <div id="services" class="container-fluid text-center">
                    <h2>How To Become Successful And Build Your Career With Blogging</h2>
                    Today many of us want to have a wonderful career and want to become a successful person. We often
                    get confused about what profession will be a perfect option for our career and lead us towards
                    success. However, today there are so many career opportunities are available that can provide us a
                    beautiful and bright future. If we select the right career-oriented job for us and determine to do
                    something in our life then we will get success very soon with our hard work. Although, there are few
                    other jobs also available, that requires the very minimum of merit to pursue that job. Among all
                    those jobs <strong>blogging </strong>is a perfect option to choose as a profession.
                    <br><br>
                    If you choose this blogging as your profession then you must have to learn what blogging is. Which
                    things are important to do it etc? Most of us have internet connection in our house or Smartphone
                    and computer. With the help of these gadgets, one can know all the details about this job.
                    <br><br>
                    <h2>What Is Blogging?</h2>
                    It is nothing but to share your point of view and knowledge with other people with the help of the
                    internet. One can select any topic to write and to publish it on a website or even in own site or
                    page. This blogging needs a good capacity to make others understand what you want to say. It can be
                    a good selection as a profession for <strong>blogs for beginners</strong>, which could also give
                    them fame.
                    <br><br>
                    <h2>Benefits Of Blogging</h2>
                    If you want to do blogging then this will give you many benefits. Through blogging, you can learn
                    many things and can gain a lot of knowledge. Let us have a quick look, on some benefits of this
                    blogging, which will help you to decide what to do, or not.
                    <br><br>
                    <b>1. Offer You Better Job:</b>
                    This blogging can give you a better job opportunity. If you learn all the things about blogging then
                    it will always benefit you throughout your life. This is also a way to generate a lot of money. In
                    addition, the <strong>blogs for beginners</strong> will have to know the basic things about writing
                    a blog.
                    <br><br>
                    <b>2. Help To Grow Business:</b>
                    If your hobby is to make blogs and <strong>blogs making</strong> then this could also offer you to
                    start a business of your own. If you give all your hard works and time behind it then within just a
                    few months you can start a business.
                    <br><br>
                    <b>3. Bring Client For Business:</b>
                    Through your blog, if you regularly keep, your visitors updated about your writing then you could
                    get many more clients for your new business as well. With the <strong>blogs making</strong> one can
                    share details about a product, any visiting place, or any issue.
                    <br><br>
                    <b>4. Better Writer:</b>
                    The more one will be engaged in this blogging profession the more he or she will be a better writer
                    day by day. The active bloggers spent many hours behind their writing. In addition, eventually, they
                    become better writers.
                    <br><br>
                    <b>5. Be A Published Author:</b>
                    Most of the time we cannot see the writer’s name on the site, but sometimes we can see the name of
                    the writer at the bottom of the content. If you want to be a published author then blogging will
                    help you in this matter. As <strong>blogs for beginners</strong> is an opportunity to show their
                    talent to others.
                    <br><br>
                    <b>6. Immediate Feedback:</b>
                    When an author writes their book and publishes it, they have to wait for a few days or months to get
                    the feedbacks. However, here in this case of <strong>blogging</strong>, whenever you click the
                    button of publishing, within a very few moments one can get the feedback from the viewers. Through
                    the appreciation and criticism, one can know his, or her, which is their strong point and a weak
                    point about writing.
                    <br><br>
                    <b>7. Get To Know More People:</b>
                    Most of the time, the bloggers spent their time to interact with their readers. Whenever they
                    publish any writing on a site, in the comment section the bloggers get to know, what type of topic
                    they want to read, with much suggestion about writing. On the other hand, you will also get to know
                    who regularly read you are all the writings.
                    <br><br>
                    <b>8. Gain Influence:</b>
                    On a daily basis, if you give valuable information through your writings to your audience then it
                    will help to build a good impression of you within the visitors. Eventually, the readers will show
                    their interest and respect towards your writing. To sell a website the companies have to give good
                    notice, which will catch the buyers’ eyes. In this case, a good blogger can write the appropriate
                    notice for <strong>blogs for sale</strong>.
                    <br><br>
                    <b>9. Be An Expert:</b>
                    One can write on any subject that they like on their website. With the time, when you write and
                    share most the post on your site then the website becomes a powerful demonstration of your knowledge
                    from a just a <strong>blog</strong>. It will also help you to be good expertise on that subject
                    which you choose to write. People will recognize that you are genuine in this field and provide
                    essential and valuable information.
                    <br><br>
                    <b>10. Improve SEO:</b>
                    Through blogging, whenever you will publish a couple of in-depth, valuable articles on a topic,
                    Google will automatically notice it. With the assist of this, your writing will also rank on top in
                    the Google search bar. Last but the most important thing all those high-quality articles that you
                    post and share on your site will offer you more traffic for the site.
                    <br><br>
                    <b>11. Collect Emails:</b>
                    We all know the <strong>influence of social media</strong> on anything but still, the email is the
                    most reliable way to communicate. Most of us check our email daily and receive many important emails
                    and updates. If you get some genuine and authentic readers then you can send all the blogs or send
                    them an update about your writing through mails. One can get the attention of the readers and their
                    feedback through this way of email connection.
                    <br><br>
                    <b>12. Advertise A Product:</b>
                    One can even give <strong>advertisement for a product</strong> with the help of blogging. At first,
                    you have to give full details about the product, have to write full information about it, and then
                    will have to publish it to your site. When people will see that advertisement, they will also notice
                    your writing skills as well.
                    <br><br>
                    <b>13. Express Yourself:</b>
                    Blogging is one of the best ways to express oneself. Blogging is an influential form of
                    self-expression. In a blog, you can use different types of words, images, and sounds to give extra
                    quality to the writing. One can give his or her all the knowing knowledge about a topic or a subject
                    through blogging. Even in big companies when they want to sell a website they looked for a blogger
                    to write a blog on <strong>established blogs for sale</strong>. With this type of writing, you can
                    gain a lot of knowledge and experience from the blogs.
                    <br><br>
                    <h2>Few Blogging Tips For The Beginner</h2>
                    Whenever we start work or do something, we do not have that much idea what to do or not. Even we do
                    not know how to make that work perfect. However, with the time we habituated with those things. Now
                    blogging is a very interesting thing to do. Therefore, I will now go to discuss the blogging and
                    which will benefit you to do it and easily. Therefore, here are a few helpful tips for beginners.
                    Now let us have a quick look at those tips in details.
                    <br><br>
                    <b>1. Niche Down:</b>
                    Most of the bloggers are earning a lot of money from their blogging. Today there are many
                    competitions about this blogging or <strong>online marketing</strong>. Therefore, if you are
                    thinking about blogging then you have to take some unique topics or niche to write. One has to
                    select those or that niche, which they can write expertly. Until you will not ready yourself to
                    write it properly or correctly, you cannot get any organic visitors for your site. If you select
                    travel related topic to write then make yourself, so able that nobody matches your writing skill.
                    Once you get a good number of traffic or visitors through your blogging, you will eventually be a
                    successful person.
                    <br><br>
                    <b>2. Write On Demanded Niche Or Topic:</b>
                    If you want to be a successful blogger or want to start your career through blogging then you have
                    written on those topics, which people search on Google. You can take the help of the <strong>online
                        keywords tools</strong> to know which topics are on a high level. After knowing the topics one
                    can easily write on those keywords or niches. The more your site will full of with recent blog
                    topics; it will bring visitors that are more organic for your site.
                    <br><br>
                    <b>3. Handle The Competitor’s Best Performing Niches:</b>
                    One can also get to know which topics or keywords attract the viewer’s attention through your
                    competitor’s blogging. You can check their site and select a few niches to write and give your own
                    point of view. It will be helpful for you to <strong>start a career as a blogger</strong>.
                    <br><br>
                    <b>4. Make Article Worth Referencing:</b>
                    One has to be careful about the content’s uniqueness. If it is not a <strong>unique content</strong>
                    yet but a simple one then the visitors will not be that much of interested to read that article.
                    Therefore, you have to make sure that all your blogs are worth reading.
                    <br><br>
                    <b>5. Make Easy To Read And Amazing Headlines:</b>
                    Instead of using complex sentences try to write a simple sentence. Most of the readers like simple
                    sentences thus it will be a great idea to apply the same thing to your writing. There is another way
                    to make your content more beautiful, to use catchy headlines for the blog. The simple and amazing
                    headline will help to be unique content.
                    <br><br>
                    <b>6. Basic On-Page SEO And A Introduction:</b>
                    Always try to give a good and informative introduction for your writing so that the readers enjoy
                    the whole content to read. In addition, try to maintain the basic on-page SEO elements. Use the main
                    keyword in your title, subheading, H₁ tags, and Meta description. If one will follow all these steps
                    then after a few days or month your site will have many <strong>organics traffics</strong>.
                    <br><br>
                    <b>7. Write Guest Blogs For Another Site:</b>
                    One can even write a guest post for a high DA site that has thousands of visitors. If you
                    successfully do it, then from their site when will also get a Hugh number of visitors to your site.
                    You just have to put a link of your site on a particular keyword of that guest post.
                    <br><br>
                    <b>8. Get Feedback And Update The Old Content:</b>
                    To become a successful blogger, one has to update all the previous written contents and try to
                    modify them all one by one. The feedback is a vital part of a blogger to know what their audience
                    likes or not. Even this feedback helps you to write more efficiently. Whenever one will get to know
                    the reactions of the visitors’, he or she gets the minimum knowledge about the visitors taste.
                    <br><br>
                    <b>9. Promote Your Content In Social Media:</b>
                    To gain much traffic social media is the best platform. Whenever you regularly post your content or
                    share on facebook, twitter, pinterest, and so on, people will get to know about your blogging and
                    read those articles daily. Thus, day by day, your site will get much traffic.
                    <br><br>
                    <b>10. Write Everyday:</b>
                    Most importantly, try to write regularly for your blog and publish it. The more you show your
                    content on your site people will engage to your site more. Thus, try to post informative, helpful,
                    and unique articles to your blog to become a successful blogger.
                    <br><br>
                    <h2>Conclusion</h2>
                    Now day’s blogging is a good way to earn money from it. Even with this blogging, one can gain a lot
                    of knowledge and experience and get in touch with different types of people. Therefore, all these
                    tips will help you if you are a beginner and want to start your career through blogging. One can
                    apply these simple and easy tips to be a blogger.


                </div>
            </div>
        </section>
        <!--Content Section end-->



        <!-- //Main content -->

        <!-- contact top -->
        <?php include('more-info.php');?>
        <!-- //contact top -->

        <!-- Footer -->
        <?php require_once "partials/footer.php"; ?>
        <!-- /Footer -->
    </div>
    <!-- js-->
    <script src="js/jquery-2.2.3.min.js"></script>
    <!-- js-->
    <script src="js/jquery-ui.js"></script>
    <!-- <script src="js/cart.js"></script> -->
    <!--Start fetching DATA-->
    <script>
    $(document).ready(function() {

        filter_data();

        function filter_data() {
            $('.filter_data').html('<div id="loading" style="" ></div>');
            var action = 'fetch_data';
            var minimum_da = $('#hidden_minimum_da').val();
            var maximum_da = $('#hidden_maximum_da').val();
            var niche = get_filter('niche');
            $.ajax({
                url: "domains.inc.php",
                method: "POST",
                data: {
                    action: action,
                    minimum_da: minimum_da,
                    maximum_da: maximum_da,
                    niche: niche
                },
                success: function(data) {
                    $('.filter_data').html(data);
                }
            });
        }

        function get_filter(class_name) {

            var filter = [];
            $('.' + class_name + ':checked').each(function() {
                filter.push($(this).val());
            });
            return filter;
        }

        $('.common_selector').click(function() {
            filter_data();
        });

        $('#da_range').slider({
            range: true,
            min: 0,
            max: 100,
            values: [1, 100],
            step: 2,
            stop: function(event, ui) {
                $('#da_show').html(ui.values[0] + ' - ' + ui.values[1]);
                $('#hidden_minimum_da').val(ui.values[0]);
                $('#hidden_maximum_da').val(ui.values[1]);
                filter_data();
            }
        });

    });
    </script>
    <!--end fetching DATA-->



    <!-- Scrolling Nav JavaScript -->
    <!-- <script src="js/scrolling-nav.js"></script> -->
    <!-- //fixed-scroll-nav-js -->
    <!-- <script>
		$(window).scroll(function () {
			if ($(document).scrollTop() > 70) {
				$('nav.pagescrollfix,nav.RWDpagescrollfix').addClass('shrink');
			} else {
				$('nav.pagescrollfix,nav.RWDpagescrollfix').removeClass('shrink');
			}
		});
	</script> -->

    <!-- Banner text Responsiveslides -->
    <!-- <script src="js/responsiveslides.min.js"></script> -->
    <!-- <script>
		// You can also use"$(window).load(function() {"
		$(function () {
			// Slideshow 4
			$("#slider3").responsiveSlides({
				auto: true,
				pager: true,
				nav: false,
				speed: 500,
				namespace: "callbacks",
				before: function () {
					$('.events').append("<li>before event fired.</li>");
				},
				after: function () {
					$('.events').append("<li>after event fired.</li>");
				}
			});

		});
	</script> -->
    <!-- //Banner text  Responsiveslides -->
    <!-- start-smooth-scrolling -->
    <!-- <script src="js/move-top.js"></script> -->
    <!-- <script src="js/easing.js"></script> -->
    <!-- <script>
		jQuery(document).ready(function ($) {
			$(".scroll").click(function (event) {
				event.preventDefault();

				$('html,body').animate({
					scrollTop: $(this.hash).offset().top
				}, 1000);
			});
		});
	</script> -->
    <!-- //end-smooth-scrolling -->
    <!-- smooth-scrolling-of-move-up -->
    <!-- <script>
    $(document).ready(function() {
        $().UItoTop({
            easingType: 'easeOutQuart'
        });

    });
    </script> -->
    <!-- <script src="js/SmoothScroll.min.js"></script> -->
    <!-- //smooth-scrolling-of-move-up -->
    <!-- Bootstrap Core JavaScript -->
    <!-- <script src="js/bootstrap.js"></script> -->
    <script src="plugins/bootstrap-5.2.0/js/bootstrap.js"></script>

    <!-- ==== js for smooth scrollbar ==== -->
    <!-- <script src="plugins/smooth-scrollbar.js"></script>
    <script>
    const options = {
        'alwaysShowTracks': true,
    }

    var Scrollbar = window.Scrollbar;
    Scrollbar.initAll(options);
    </script> -->
    <!-- ==== js for smooth scrollbar End ==== -->




</body>

</html>