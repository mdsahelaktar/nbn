<div class="top"> <strong><?php echo _e('feature_broker'); ?></strong>
    <ul>
        <li class="first"> <a href="#">Jack Guttman</a></li>
        <li> |</li>
        <li> <a href="#">Guttman Realty Advisors</a></li>
    </ul>
    <img alt="" src="<?php echo $this->template->get_frontend_image() ?>CBA.jpg" /> <em><?php echo _e('brokers_get_featured_here'); ?></em></div>
<div class="bot"> <strong><?php echo _e('find_a_local_business_broker'); ?></strong>
    <?php echo form_open('broker/searchbroker', array('name' => 'search_byzip_form', 'id' => 'search_byzip_form', 'method' => 'get')) ?>
    <dfn><?php echo _e('enter_your_zip'); ?></dfn>
    <input id="postalcode" name="postalcode" type="text" />
    <input class="search" id="search" value="" type="submit"/>
    <?php echo form_close() ?>
    &nbsp;
    <p><a href="#" class="global" target="_self"><?php echo _e('brokers_get_listed_today'); ?></a></p>
</div>