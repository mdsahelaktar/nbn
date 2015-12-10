<?php ### Top Section Begin ###    ?>
<?php echo $top ?>
<?php ### Top Section End ###    ?>
<?php
### Edit Section Begin ### 
### If No Error Begin ###
if (!$response["event"]["error"]):
    ?>
    <?php if ($edit_id): ?>
        <?php echo anchor(getBackUrl('edit_id'), '<span class="ion-android-system-back"></span>' . _e('Back'), array('title' => _e('Back to List'), 'class' => 'btn-type1 margin-right10 margin-top10 float-left')) ?>
        <?php
        ### If Valid Edit Id Begin ###
        if (isset($results["records"][0]->ai_package_id)):
            ?>
           <div class="formcont-small"> <?php
            echo form_open('', array('name' => 'package_edit_form', 'id' => 'package_edit_form', 'class' => 'width100 float-left margin-bottom30 margin-top10'));
            echo form_hidden('row_id', $results["records"][0]->ai_package_id);
            ?> 
			<?php echo form_label( '<p>'._e( 'Context' ).'</p>', 'context_id' )?> <?php echo form_dropdown('context_id', $var['context_dd'], $results["records"][0]->context_id, 'id="context_id" class="validate" data-display="'._e( 'Context' ).'" data-rules="required"');
?>
			<?php echo form_label('<p>' . _e('Package') . '</p>', 'package') ?> <?php echo form_input(array('name' => 'package', 'id' => 'package', 'size' => 30, 'value' => $results["records"][0]->package, 'placeholder' => 'add package here', 'class' => 'validate', 'data-display' => _e('Package'), 'data-rules' => 'required')); ?>
			<?php echo form_label( '<p>'._e( 'Description' ).'</p>', 'description' )?><?php echo form_textarea( array( 'name' => 'description', 'id' => 'description', 'value' => $results["records"][0]->description, 'placeholder' => 'add package description here', 'class' => 'validate', 'data-display' =>  _e( 'Package Description' ), 'data-rules' => 'required') );?>
			<?php echo form_label( '<p>'._e( 'Amount' ).'</p>', 'amount' )?><?php echo form_input( array( 'name' => 'amount', 'id' => 'amount', 'value' => $results["records"][0]->amount, 'placeholder' => 'add amount here', 'class' => 'validate', 'data-display' =>  _e( 'Amount' ), 'data-rules' => 'required') );?>
			<?php echo form_label( '<p>'._e( 'Validity In Month' ).'</p>', 'vim' )?><?php echo form_input( array( 'name' => 'vim', 'id' => 'vim', 'value' => $results["records"][0]->vim, 'placeholder' => 'add validity here', 'class' => 'validate', 'data-display' =>  _e( 'Validity In Month' ), 'data-rules' => 'required') );?>

            <div class="clear"></div>
            <?php echo form_submit(array('name' => 'package_update', 'id' => 'package_update', 'class' => 'margin-top10'), _e('Update')); ?> <?php echo form_close() ?></div>
            <?php
            $js = $this->template->admin_view('package_js', '', true, "package");
            $this->template->embed_asset_code('admin', 'js', 'package-js', $js);
        ### If Valid Edit Id End ###
        else:
            ### If Invalid Edit Id Begin ###
            ?>

            <div class="error">
                <p><?php echo _e('No records found') ?></p>
            </div>
        <?php
        ### If Invalid Edit Id End ###
        endif;
        ?>
        <?php ### Edit Section End ####  ?>
    <?php else: ?>
        <?php ### List Section Begin ###  ?>
        <?php echo form_open('', array('name' => 'package_search_form', 'id' => 'package_search_form', 'class' => 'width100 float-left margin-bottom30 margin-top10', 'method' => 'get')) ?>
        <table>  
            <tr id="caption_section">                
				<th><a href="<?php echo sortBy($var['CFG'], 'sortbypackage') ?>"  class="<?php echo sortClass($var['CFG'], 'sortbypackage') ?>"><?php echo _e('Package') ?></a></th>
				<th><?php echo _e('Context') ?></th>
				<th><a href="<?php echo sortBy($var['CFG'], 'sortbyamount') ?>"  class="<?php echo sortClass($var['CFG'], 'sortbyamount') ?>"><?php echo _e('Amount') ?></a></th>
				<th><a href="<?php echo sortBy($var['CFG'], 'sortbyvim') ?>"  class="<?php echo sortClass($var['CFG'], 'sortbyvim') ?>"><?php echo _e('Validity/m') ?></a></th>
                <th><a href="<?php echo sortBy($var['CFG'], 'sortbytime') ?>"  class="<?php echo sortClass($var['CFG'], 'sortbytime') ?>"><?php echo _e('Time Created') ?></a></th>
                <th><a href="<?php echo sortBy($var['CFG'], 'sortbymfdtime') ?>"  class="<?php echo sortClass($var['CFG'], 'sortbymfdtime') ?>"><?php echo _e('Modified time') ?></a></th>
                <th><a href="<?php echo sortBy($var['CFG'], 'sortbyactive') ?>"  class="<?php echo sortClass($var['CFG'], 'sortbyactive') ?>"><?php echo _e('Status') ?></a></th>
                <th class="actionth"><?php echo _e('Action') ?></th>
            </tr>
            <tr id="blanktr">
                <td colspan="7">&nbsp;</td>
            </tr>
            <tr id="filter_section">                
                <td><?php echo form_input(array('name' => 'package', 'id' => 'package', 'placeholder' => 'search by package', 'size' => 20, 'value' => $this->input->get('package'))); ?></td>
				<td><?php echo form_dropdown('context_id', $var['context_dd'], $this->input->get('context_id') != '' ? $this->input->get('context_id') : '' ); ?></td>
                <td></td>
				<td></td>
				<td></td>
				<td></td>				
                <td><?php echo form_dropdown('is_trashed', $var['filter_status_dd'], $this->input->get('is_trashed') != '' ? $this->input->get('is_trashed') : '' ); ?></td>
                <td><?php echo anchor('admin/package/edit', _e('Reset'), array('title' => _e('Reset'), 'class' => 'refresh margin-left20 btn-type1 margin-right10 float-left')) ?> <?php echo form_button(array('name' => 'search', 'id' => 'search', 'class' => 'filter', 'onclick' => 'return goFilter(this)'), _e('Filter')); ?></td>
            </tr>
            <tr id="blanktr">
                <td colspan="8">&nbsp;</td>
            </tr>
            <tr id="multiple_action_section">                
                <td colspan="7">
                    <a onclick="return selectAll(this)" class="btn-type1 margin-right10 float-left" title="<?php echo _e('Select All') ?>" href="#"><span class="ion-checkmark-circled"></span><?php echo _e('Select All') ?></a> <a onclick="return unselectAll(this)" class="btn-type1 margin-right10 float-left" title="<?php echo _e('Unselect All') ?>" href="#"><span class="ion-close-circled"></span><?php echo _e('Unselect All') ?></a></td>

                <td><?php echo form_dropdown('action', $var['action_dd']); ?>
                    <button onclick="return goAction(this)" class="margin-left5 go" id="go" type="button" name="go"><?php echo _e('Go') ?> <span class="ion-play"></span></button></td>
            </tr>
            <tr id="blanktr">
                <td colspan="8">&nbsp;</td>
            </tr>
            <?php ### If Record Found Begin ###  ?>
            <?php
            if (count($results["records"])) {
                ?>
                <?php foreach ($results["records"] as $value): ?>
                    <tr id="oddeven">
                        <td><label><?php echo form_checkbox('row_id[]', $value->ai_package_id); ?><?php echo $value->package ?></label></td>
                        <td align="center"><?php echo $value->context ?></td>
						<td align="center"><?php echo $value->amount ?></td>
						<td align="center"><?php echo $value->vim ?></td>
						<td align="center"><?php echo $value->creation_time ?></td>
                        <td align="center"><?php echo $value->update_time ?></td>
                        <td align="center"><?php echo $value->is_trashed ? _e("Inactive") : _e("Active") ?></td>
                        <td align="center"><a href="<?php echo createEditUrl($value->ai_package_id) ?>" class="ion-edit"></a>     | &nbsp;<a href="<?php echo createRevertDeleteUrl($value->ai_package_id, $value->is_trashed) ?>" class="editrevert<?php echo $value->is_trashed ?>"></a></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="8"><?php echo $results["pagination"] ?></td>
                </tr>
                <script type="text/javascript">
                    var deleteconformstring = '<?php echo _e('Confirm delete package') ?>';
                    var pdeleteconformstring = '<?php echo _e('Confirm permanent delete package') ?>';
                </script>
                <?php ### If Record Found End ### ?>
                <?php
            }
            else {
                ?>
                <?php ### If No Record Found Begin ###  ?>
                <tr>
                    <td colspan="8"><div class="error">
                            <p><?php echo _e('No records found') ?></p>
                        </div></td>
                </tr>
                <?php ### If No Record Found Begin ### ?>
            <?php }
            ?>
        </table>
        <?php echo form_close() ?>
        <?php ### List Section Begin ### ?>
    <?php
    endif;
endif;
### If No Error End ###
?>
