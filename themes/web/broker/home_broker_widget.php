<div class="top"> <strong><?php echo _e('feature_broker'); ?></strong>
    <ul>
        <li class="first"> <a href="#">Jack Guttman</a></li>
        <li> |</li>
        <li> <a href="#">Guttman Realty Advisors</a></li>
    </ul>
    <img alt="" src="<?php echo $this->template->get_frontend_image() ?>CBA.jpg" /> <em><?php echo _e('Brokers, get featured here!'); ?></em></div>
<div class="bot"> <strong><?php echo _e('Find a Local Business Broker'); ?></strong>
    <?php echo form_open('broker/searchbroker', array('name' => 'search_byzip_form', 'id' => 'search_byzip_form', 'method' => 'get')) ?>
    <dfn><?php echo _e('Enter Your Zip:'); ?></dfn>
    <input id="postalcode" name="postalcode" type="text" />
    <input class="search" id="search" value="" type="submit"/>
    <?php echo form_close() ?>
    &nbsp;
    <p><a href="#" class="global" target="_self"><?php echo _e('Brokers, get listed today!'); ?></a></p>
</div>