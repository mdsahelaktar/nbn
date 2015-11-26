 <div id="body">
        <div class="wrapper">
            <div class="width100 float-left margin-bottom20 margin-top140 padding-bottom25">
                <div class="width60 bg-grey padding-bottom15 padding-left15 padding-right10 padding-top15 margin-top15 float-left">					
                    <h2 class="helvetica float-left"><?php echo $registration_title?></h2>                    
					<div class="form_three-forth">                    
					<?php if( $response["event"]["error"] ): ?>
					<?php echo renderResposeMessage('user', $response) ?>
					<?php else:?>
					<div msg="user"></div>
                   <ul>
<?php echo form_open('', array('name' => 'user_add_form', 'id' => 'user_add_form', 'class' => 'width100 float-left margin-bottom30 margin-top10')) ?> <!--<li><?php echo form_label('<p><strong>' . _e('user_name') . '</strong></p>', 'user_name') ?> <?php echo form_input(array('name' => 'user_name', 'id' => 'user_name', 'placeholder' => 'add user name here', 'autofocus' => 'autofocus', 'class' => 'validate', 'data-display' => _e('user_name'), 'data-rules' => 'required|min_length[6]')); ?></li>-->
                   <li> <?php echo form_label('<p><strong>' . _e('email') . '</strong></p>', 'email') ?> <?php echo form_input(array('name' => 'email', 'id' => 'email', 'placeholder' => 'add email here', 'class' => 'validate', 'data-display' => _e('email'), 'data-rules' => 'required|valid_email')); ?></li>
                   <li> <?php echo form_label('<p><strong>' . _e('password') . '</strong></p>', 'password') ?> <?php echo form_password(array('name' => 'password', 'id' => 'password', 'class' => 'validate', 'data-display' => _e('password'), 'data-rules' => 'required|strict_password|matches[passconf]')); ?></li>
                    
                   <li> <?php echo form_label('<p><strong>' . _e('confirm_password') . '</strong></p>', 'passconf') ?> <?php echo form_password(array('name' => 'passconf', 'id' => 'passconf', 'class' => 'validate', 'data-display' => _e('confirm_password'), 'data-rules' => 'required')); ?></li>
                    <li><?php echo form_label('<p>' . _e('salutation') . '</p>', 'salutation') ?> 
                    <?php // echo form_input( array( 'name' => 'salutation', 'id' => 'salutation', 'placeholder' => 'add salutation here') );?>
                    <select name="salutation" id = "salutation">
                        <option value=""> - Select Your Salutation - </option>
                        <option value="Mr.">Mr.</option>
                        <option value="Mrs.">Mrs.</option>
                        <option value="Miss">Miss</option>
                        <option value="Ms.">Ms.</option>
                        <option value="Dr.">Dr.</option>
                        <option value="Prof.">Prof.</option>
                        <option value="Rev.">Rev.</option>
                        <option value="Other">Other</option>
                    </select></li>

                   <li> <?php echo form_label('<p><strong>' . _e('first_name') . '</strong></p>', 'first_name') ?> <?php echo form_input(array('name' => 'first_name', 'id' => 'first_name', 'placeholder' => 'add first name here', 'class' => 'validate', 'data-display'=> 'First Name','data-rules' => 'required')); ?></li>

                   <li> <?php echo form_label('<p>' . _e('middle_name') . '</p>', 'middle_name') ?> <?php echo form_input(array('name' => 'middle_name', 'id' => 'middle_name', 'placeholder' => 'add middle name here')); ?></li>

                  <li>  <?php echo form_label('<p><strong>' . _e('last_name') . '</strong></p>', 'last_name') ?> <?php echo form_input(array('name' => 'last_name', 'id' => 'last_name', 'placeholder' => 'add last name here', 'class' => 'validate', 'data-display'=> 'Last Name', 'data-rules' => 'required')); ?></li>
                    
                    <div class="clear"></div>
                    <?php echo form_hidden('user_category_id', $user_category_id); ?> <?php echo form_hidden('user_role_id', $user_role_id); ?> <?php echo form_submit(array('name' => 'user_add', 'id' => 'user_add', 'class' => 'margin-top10'), _e('register')); ?> 
</ul><?php echo form_close() ?></div>
               
					<?php endif;?>
				</div>
                <p> &nbsp; &nbsp; &nbsp; &nbsp;</p>

                <?php
                if ($user_category_id == 2 && $user_role_id== 1) {
                    ?>
					
					<div class="width320 float-right">
                        <p class="bg-blue padding-bottom10 padding-left10 padding-right10 padding-top10 font16 white"><?php echo 'Business Brokers: Get Listed Now'; ?></p>
                        <div class="bg-lightbrown padding-bottom10 padding-left10 padding-right10 padding-top10 float-left ">
                            <p><strong><?php echo 'Reach millions of prospective buyers and sellers. ' ?>.</strong> <?php echo 'Post your business for sale listings. Broker memberships start at only $49.95 a month. ' ?>. </p>
                            <a href="<?php echo base_url()?>package?<?php echo implode( "&", setRegisterParam(4, 3) )?>" target="_self" class="global4 font14 float-left margin-top20 padding-bottom5 padding-top5 padding-left20 padding-right20 margin-left45 margin-bottom10"><?php echo 'Become a Broker Member' ?></a>
                        </div>
                        <p> &nbsp; &nbsp; &nbsp; &nbsp;</p>
                        <p> &nbsp; &nbsp; &nbsp; &nbsp;</p>
                        <p class="bg-blue padding-bottom10 padding-left10 padding-right10 padding-top10 font16 white"><?php echo 'If you are already a seller : login now'; ?></p>
                        <div class="bg-lightbrown padding-bottom10 padding-left10 padding-right10 padding-top10 float-left ">
                            <p><strong><?php echo 'Reach millions of prospective buyers and sellers. ' ?>.</strong> <?php echo 'Post your business for sale listings. Broker memberships start at only $49.95 a month. ' ?>. </p>
                            <a href="<?php echo base_url()?>login/" target="_self" class="global4 font14 float-left margin-top20 padding-bottom5 padding-top5 padding-left20 padding-right20 margin-left45 margin-bottom10">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo 'Login as seller' ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                        </div>

                    </div>				
                    
                    <?php
                } else{
                    ?>
                    
					
					<div class="width320 float-right">
                        <p class="bg-blue padding-bottom10 padding-left10 padding-right10 padding-top10 font16 white"><?php echo 'Business Seller: Get Listed Now'; ?></p>
                        <div class="bg-lightbrown padding-bottom10 padding-left10 padding-right10 padding-top10 float-left ">
                            <p><strong><?php echo 'Reach millions of prospective buyers and sellers. ' ?>.</strong> <?php echo 'Post your business for sale listings. Seller memberships start at only $00.00 a month. ' ?>. </p>
                            <a href="<?php echo base_url()?>package?<?php echo implode( "&", setRegisterParam(2, 1) )?>" target="_self" class="global4 font14 float-left margin-top20 padding-bottom5 padding-top5 padding-left20 padding-right20 margin-left45 margin-bottom10"><?php echo 'Become a Seller Member' ?></a>
                        </div>
                        <p> &nbsp; &nbsp; &nbsp; &nbsp;</p>
                        <p> &nbsp; &nbsp; &nbsp; &nbsp;</p>
                        <p class="bg-blue padding-bottom10 padding-left10 padding-right10 padding-top10 font16 white"><?php echo 'If you are already a broker : login now'; ?></p>
                        <div class="bg-lightbrown padding-bottom10 padding-left10 padding-right10 padding-top10 float-left ">
                            <p><strong><?php echo 'Reach millions of prospective buyers and sellers. ' ?>.</strong> <?php echo 'Post your business for sale listings. Broker memberships start at only $49.95 a month. ' ?>. </p>
                            <a href="<?php echo base_url()?>login/" target="_self" class="global4 font14 float-left margin-top20 padding-bottom5 padding-top5 padding-left20 padding-right20 margin-left45 margin-bottom10">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo 'Login as broker' ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                        </div>

                    </div>
        <?php
    }
    ?>
            </div>
        </div>


    <?php
    $user_js_function = $this->load->view("web/admin/user/user_js_function.php", '', true);
    $this->template->embed_asset_code('admin', 'js', 'user_js_function', $user_js_function);
    
    $user_js = $this->template->frontend_view('user_js', '', true, "user");
    $this->template->embed_asset_code('frontend', 'js', 'user-js', $user_js);    
    
    $biz_type_js = $this->load->view("web/admin/biz_type/biz_type_js_function.php", '', true);
    $this->template->embed_asset_code('frontend', 'js', 'biz-type-js-function', $biz_type_js);
?>