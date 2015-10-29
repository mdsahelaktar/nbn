<?php
$var = $this->config->item('var');
?>
<div id="maindiv"> 
    <!--banner start-->
    <div id="banner" class="main">
        <div class="wrapper">
            <div id="banner-wrap">
                <h3 class="white text-center bold"><?php echo _e('slider_franchise'); ?></h3>
                <div id="usual2">
                    <div class="mainmenu">
                        <ul>
                            <li> <a class="first selected" href="#tabs1"><?php echo _e('Business For Sale'); ?></a></li>
                            <li> <a href="#tabs2"><?php echo _e('Franchise Opportunities'); ?></a></li>
                            <li> <a href="#tabs3"><?php echo _e('Business Concepts for Sale'); ?></a></li>
                            <li> <a class="last" href="#tabs4"><?php echo _e('Find a Broker'); ?></a></li>
                        </ul>
                    </div>
                    <div class="searchbar">
                        <div class="width100 float-left" id="tabs1"> <?php $this->template->frontend_view('home_page_search', '', '', 'biz_listing')?>
						<?php echo $get_top_search; ?>
						</div>

                        <div class="width100 float-left" id="tabs2"> <form> <?php echo _e('franchise_coming_soon'); ?> </form> </div>
                        <div class="width100 float-left" id="tabs3"> <form> <?php echo _e('biz_concept_coming_soon'); ?> </form> </div>
                        <div class="width100 float-left" id="tabs4"><?php $this->template->frontend_view('home_broker_search', '', '', 'broker')?></div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--banner end--> 



    <!--body start-->
    <div id="body">
        <div class="wrapper"> 
            <!--3 block section start-->
            <div class="threesec">
                <div class="box1">
                    <?php $this->template->frontend_view('home_broker_widget', '', '', 'broker')?>
                </div>
                <div class="box2"> <img alt="Investers" src="<?php echo $this->template->get_frontend_image() ?>investers.jpg" /> <strong><?php echo _e('Investors') ?></strong>
                    <ul>
                        <li> Average project R0I 9.8%</li>
                        <li> 500MWp investment</li>
                    </ul>
                </div>
                <div class="box2"> <img alt="<?php echo _e('Have a n urgent problem')?>" src="<?php echo $this->template->get_frontend_image() ?>urgent-problame.jpg" /> <strong><?php echo _e('Have an urgent problem?')?></strong>
                    <div class="find-lawyer"> <a href="#"><?php echo _e('Find a Lawyer')?></a></div>
                </div>
            </div>
            <!--3 block section end-->
            <div class="containor">
                <div class="leftpanel">
                    <?php echo $get_popular_industry; ?>
                    <?php echo $get_popular_province; ?>
                    <?php echo $get_popular_city; ?>
                    <?php echo $get_popular; ?>
                    <?php echo $get_popular_restaurant; ?>     
                </div>
                <div class="rightpanel">
                    <?php echo $get_popular_side; ?>
                </div>
            </div>
        </div>
    </div>
    <!--body end-->
</div>
<?php
$this->template->add_remove_frontend_css(array('jquery-ui.css'), 'add');
$this->template->add_remove_frontend_js(array('jquery-ui.js'), 'add');
?>