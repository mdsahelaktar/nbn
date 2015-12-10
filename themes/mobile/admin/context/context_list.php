<?php ### Top Section Begin ###  ?>
<?php echo $top ?>
<?php ### Top Section End ###  ?>
<?php
### Edit Section Begin ### 
### If No Error Begin ###
if (!$response["event"]["error"]):
    ?>
    <?php if ($edit_id): ?>
        <?php echo anchor(getBackUrl('edit_id'), '<span class="ion-android-system-back"></span>' . _e('Back'), array('title' => _e('Back to List'), 'class' => 'btn-type1 margin-right10 margin-top10 float-left')) ?>
        <?php
        ### If Valid Edit Id Begin ###
        if (isset($results["records"][0]->ai_context_id)):
            ?>
            <?php
            echo form_open('', array('name' => 'context_edit_form', 'id' => 'context_edit_form', 'class' => 'width100 float-left margin-bottom30 margin-top10'));
            echo form_hidden('row_id', $results["records"][0]->ai_context_id);
            ?>
            <?php echo form_label('<p>' . _e('Context') . '</p>', 'context') ?> <?php echo form_input(array('name' => 'context', 'id' => 'context', 'size' => 30, 'value' => $results["records"][0]->context, 'placeholder' => 'add context here', 'class' => 'validate', 'data-display' => _e('Context'), 'data-rules' => 'required')); ?>
            <div class="clear"></div>
            <?php echo form_label('<p>' . _e('Description') . '</p>', 'description') ?>
            <?php echo form_textarea(array('name' => 'description', 'id' => 'description', 'value' => $results["records"][0]->description, 'placeholder' => 'add description here', 'class' => 'validate', 'data-display' => _e('Description'), 'rows' => 5, 'data-rules' => 'required')); ?>

            <div class="clear"></div>
            <?php echo form_submit(array('name' => 'context_update', 'id' => 'context_update', 'class' => 'margin-top10'), _e('Update')); ?> <?php echo form_close() ?>
            <?php
            $js = $this->template->admin_view('context_js', '', true, "context");
            $this->template->embed_asset_code('admin', 'js', 'context-js', $js);
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
        <?php echo form_open('', array('name' => 'context_search_form', 'id' => 'context_search_form', 'class' => 'width100 float-left margin-bottom30 margin-top10', 'method' => 'get')) ?>
        <table>
            <tr id="caption_section">
                <th><a href="<?php echo sortBy($var['CFG'], 'sortbycontext') ?>" class="<?php echo sortClass($var['CFG'], 'sortbycontext') ?>"><?php echo _e('Context') ?></a></th>
                <th><a href="<?php echo sortBy($var['CFG'], 'sortbydescription') ?>" class="<?php echo sortClass($var['CFG'], 'sortbydescription') ?>"><?php echo _e('Description') ?></a></th>
                <th><a href="<?php echo sortBy($var['CFG'], 'sortbytime') ?>"  class="<?php echo sortClass($var['CFG'], 'sortbytime') ?>"><?php echo _e('Time Created') ?></a></th>
                <th><a href="<?php echo sortBy($var['CFG'], 'sortbymfdtime') ?>"  class="<?php echo sortClass($var['CFG'], 'sortbymfdtime') ?>"><?php echo _e('Modified time') ?></a></th>
                <th><a href="<?php echo sortBy($var['CFG'], 'sortbyactive') ?>"  class="<?php echo sortClass($var['CFG'], 'sortbyactive') ?>"><?php echo _e('Status') ?></a></th>
                <th class="actionth"><?php echo _e('Action') ?></th>
            </tr>
            <tr id="blanktr">
                <td colspan="6">&nbsp;</td>
            </tr>
            <tr id="filter_section">
                <td><?php echo form_input(array('name' => 'context', 'id' => 'context', 'placeholder' => 'search by context', 'size' => 20, 'value' => $this->input->get('context'))); ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td><?php echo form_dropdown('is_trashed', $var['filter_status_dd'], $this->input->get('is_trashed') != '' ? $this->input->get('is_trashed') : '' );
            ?></td>
                <td><?php echo anchor('admin/context/edit', _e('Reset'), array('title' => _e('Reset'), 'class' => 'refresh btn-type1 margin-right10 margin-left20 float-left')) ?> <?php echo form_button(array('name' => 'search', 'id' => 'search', 'class' => 'filter', 'onclick' => 'return goFilter(this)'), _e('Filter')); ?></td>
            </tr>
            <tr id="blanktr">
                <td colspan="6">&nbsp;</td>
            </tr>
            <?php /* ?><tr id="multiple_action_section">
              <td colspan="5"><?php echo anchor( '#', _e( 'Select All' ), array( 'title' => _e( 'Select All' ), 'class' => 'btn-type1 margin-right10 margin-top10 float-left', 'onclick' => 'return selectAll(this)' ) )?> <?php echo anchor( '#', _e( 'Unselect All' ), array( 'title' => _e( 'Unselect All' ), 'class' => 'btn-type1 margin-right10 margin-top10 float-left', 'onclick' => 'return unselectAll(this)' ) )?></td>
              <td><?php echo form_dropdown('action', $var['action_dd']);
              ?>
              <?php echo form_button( array( 'name' => 'go', 'id' => 'go', 'class' => 'margin-top10', 'onclick' => 'return goAction(this)' ), _e( 'Go' ) );?></td>
              </tr><?php */ ?>
            <tr id="multiple_action_section">
                <td colspan="5"><a onclick="return selectAll(this)" class="btn-type1 margin-right10 float-left" title="<?php echo _e('Select All') ?>" href="#"><span class="ion-checkmark-circled"></span><?php echo _e('Select All') ?></a> <a onclick="return unselectAll(this)" class="btn-type1 margin-right10 float-left" title="<?php echo _e('Unselect All') ?>" href="#"><span class="ion-close-circled"></span><?php echo _e('Unselect All') ?></a></td>
                <td><?php echo form_dropdown('action', $var['action_dd']); ?>
                    <button onclick="return goAction(this)" class="margin-left5 go" id="go" type="button" name="go"><?php echo _e('Go') ?> <span class="ion-play"></span></button></td>
            </tr>
            <tr id="blanktr">
                <td colspan="6">&nbsp;</td>
            </tr>
        <?php ### If Record Found Begin ###  ?>
        <?php
        if (count($results["records"])) {
            ?>
            <?php foreach ($results["records"] as $value): ?>
                    <tr id="oddeven">
                        <td><label><?php echo form_checkbox('row_id[]', $value->ai_context_id); ?><?php echo $value->context ?></label></td>
                        <td align="center"><?php echo $value->description ?></td>
                        <td align="center"><?php echo $value->creation_time ?></td>
                        <td align="center"><?php echo $value->update_time ?></td>
                        <td align="center"><?php echo $value->is_trashed ? _e("Inactive") : _e("Active") ?></td>
                        <td align="center"><a href="<?php echo createEditUrl($value->ai_context_id) ?>" class="ion-edit"></a>     | &nbsp;<a href="<?php echo createRevertDeleteUrl($value->ai_context_id, $value->is_trashed) ?>" class="editrevert<?php echo $value->is_trashed ?>"></a></td>
                    </tr>

            <?php endforeach; ?>
                <tr>
                    <td colspan="6"><?php echo $results["pagination"] ?></td>
                </tr>
                <script type="text/javascript">
                    var deleteconformstring = '<?php echo _e('Confirm delete context') ?>';
                    var pdeleteconformstring = '<?php echo _e('Confirm permanent delete context') ?>';
                </script>
                <?php ### If Record Found End ### ?>
                <?php
            }
            else {
                ?>
            <?php ### If No Record Found Begin ###  ?>
                <tr>
                    <td colspan="5"><div class="error">
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