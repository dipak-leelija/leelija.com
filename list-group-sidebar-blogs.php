<div class="list-group">
    <h3>DA</h3>
    <input type="hidden" id="hidden_minimum_da" value="0" />
    <input type="hidden" id="hidden_maximum_da" value="100" />
    <p id="da_show">1 - 100</p>
    <div id="da_range"></div>
</div>
<div class="list-group">
    <h3>TF</h3>
    <input type="hidden" id="hidden_minimum_tf" value="0" />
    <input type="hidden" id="hidden_maximum_tf" value="100" />
    <p id="tf_show">1 - 100</p>
    <div id="tf_range"></div>
</div>
<div class="list-group">
    <h3>Niches</h3>
    <div style="height: 380px; overflow-y: auto; overflow-x: hidden;">
        <?php
								$BlogMst  = $blogMst->ShowBlogNichMast();
								foreach($BlogMst as $row)
								{
								?>
        <div class="list-group-item checkbox">
            <label><input type="checkbox" class="common_selector niche" value="<?php echo $row['niche_name']; ?>">
                <?php echo $row['niche_name']; ?></label>
        </div>
        <?php
								}
							?>
    </div>
</div>

<!-- <div class="col-lg-3">
                        <!-- <?php include('list-group-sidebar-blogs.php') ?> -->
                    </div> -->