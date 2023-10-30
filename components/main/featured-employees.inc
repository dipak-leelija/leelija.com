<?php
$featuredEmps = $Employee->featuredEmp(4);
$featuredEmps = json_decode($featuredEmps);
$feature1 = $featuredEmps[0];
$feature2 = $featuredEmps[1];
$feature3 = $featuredEmps[2];
$feature4 = $featuredEmps[3];

?>

<section>
    <div class="row R_team_section_div reveal">
        <div class="col-md-6 m-auto">
            <!-- display only for lg-screen -->
            <div class="r-div-h1_wrap d-md-block d-none">
                <div>
                    <img src="images/main/meet-our-team-triangle-icon.webp" class="d-md-block d-none" width="50px"
                        class=" mb-3 img-fluid">
                </div>
                <h1><span> Meet </span></h1>
                <h1><strong> Our </strong></h1>
                <h1 style="border-bottom: none;">Team</h1>
            </div>
            <!-- display only for md-screen -->
            <div class="r-div-h1_wrap d-md-none">
                <h1> Meet<span><strong> Our </strong> </span> TEAM</h1>
            </div>
            <p class="text-md-start text-center mb-4 mx-2">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Soluta, atque. Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt sed enim vitae
                harum inventore, quasi est earum ipsam explicabo totam, illum quas, eius ratione dolore nam
                accusamus facere optio nemo! </p>
            <!-- display only for lg-screen -->
            <div class="aBOUT_btn_div d-none d-md-block">
                <a href="about.php#Meet_R_Team">
                    <button value="Send" class="my-buttons-hover text-center mt-4 bn21">View All <i
                            class="fa-solid fa-arrow-right-long"></i></button>
                </a>
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="row justify-content-end">
                <div class="col-md-5 col-6 d-flex align-items-end justify-content-end  mt-2">
                    <img src="<?= EMP_IMG_PATH.$feature1->image?>" class="img-thumbnail img__wrap_ratio img-fluid">
                </div>
                <div class="col-md-7 col-6  mt-2">
                    <img src="<?= EMP_IMG_PATH.$feature2->image?>" class="img-thumbnail img__wrap_ratio img-fluid">
                </div>
                <div class="col-md-5 col-6 d-flex justify-content-end  mt-2">
                    <img src="<?= EMP_IMG_PATH.$feature3->image?>" class="img-thumbnail img__wrap_ratio img-fluid">
                </div>
                <div class="col-md-5 col-6  mt-2">
                    <img src="<?= EMP_IMG_PATH.$feature4->image?>" class="img-thumbnail img__wrap_ratio img-fluid">
                </div>
            </div>
            <!-- display only for md-screen -->
            <div class="aBOUT_btn_div d-md-none">
                <a href="about.php#Meet_R_Team">
                    <button value="Send" class="my-buttons-hover text-center mt-4 bn21">View All <i
                            class="fa-solid fa-arrow-right-long"></i></button>
                </a>
            </div>
        </div>
    </div>
</section>