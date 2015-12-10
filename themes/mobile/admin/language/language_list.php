<?php ### Top Section Begin ###  ?>
<?php echo $top; ?>
<?php ### Top Section End ###  ?>
<?php
### If No Error Begin ###
if (!$response["event"]["error"]):
    ?>

    <?php if ($edit_id): ?>
        <?php echo anchor(getBackUrl('edit_id'), '<span class="ion-android-system-back"></span>' . _e('Back'), array('title' => _e('Back to List'), 'class' => 'btn-type1 margin-right10 margin-top10 float-left')) ?>
        <?php
        ### If Valid Edit Id Begin ###
        if (isset($results["records"][0]->ai_language_id)):
            ?>
            <div class="formcont-small"><?php
            echo form_open('', array('name' => 'language_edit_form', 'id' => 'language_edit_form', 'class' => 'width100 float-left margin-bottom30 margin-top10'));
            echo form_hidden('row_id', $results["records"][0]->ai_language_id);
            ?> <?php echo form_label('<p>' . _e('Language') . '</p>', 'language') ?> <?php echo form_input(array('name' => 'language', 'id' => 'language', 'size' => 30, 'value' => $results["records"][0]->language, 'placeholder' => 'add language here', 'class' => 'validate', 'data-display' => _e('Language'), 'data-rules' => 'required')); ?>
           <div class="current_them"> 
            <?php echo form_checkbox(array('name' => 'is_current', 'id' => 'is_current'), 1, $results["records"][0]->is_current ? True : False ); ?>
            <?php echo form_label('<p>' . _e('Make Current Language') . '</p>', 'is_current') ?>
            </div>
            <div class="clear"></div>
            <?php echo form_submit(array('name' => 'language_update', 'id' => 'language_update', 'class' => 'margin-top10'), _e('Update')); ?> <?php echo form_close() ?></div>
            <?php
            $js = $this->template->admin_view('language_js', '', true, "language");
            $this->template->embed_asset_code('admin', 'js', 'language-js', $js);
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
        <?php echo form_open('', array('name' => 'language_search_form', 'id' => 'language_search_form', 'class' => 'width100 float-left margin-bottom30 margin-top10', 'method' => 'get')) ?>
        <table>
            <tr id="caption_section">
                <th><a href="<?php echo sortBy($var['CFG'], 'sortbylanguage') ?>" class="<?php echo sortClass($var['CFG'], 'sortbylanguage') ?>"><?php echo _e('Language') ?></a></th>
                <th><?php echo _e('Current Language') ?></th>
                <th><a href="<?php echo sortBy($var['CFG'], 'sortbytime') ?>"  class="<?php echo sortClass($var['CFG'], 'sortbytime') ?>"><?php echo _e('Time Created') ?></a></th>
                <th><a href="<?php echo sortBy($var['CFG'], 'sortbymfdtime') ?>"  class="<?php echo sortClass($var['CFG'], 'sortbymfdtime') ?>"><?php echo _e('Modified time') ?></a></th>
                <th><a href="<?php echo sortBy($var['CFG'], 'sortbyactive') ?>"  class="<?php echo sortClass($var['CFG'], 'sortbyactive') ?>"><?php echo _e('Status') ?></a></th>
                <th class="actionth"><?php echo _e('Action') ?></th>
            </tr>
            <tr id="blanktr">
                <td colspan="6">&nbsp;</td>
            </tr>
            <tr id="filter_section">
                <td><?php echo form_input(array('name' => 'language', 'id' => 'language', 'placeholder' => 'search by language', 'size' => 20, 'value' => $this->input->get('language'))); ?></td>
                <td><?php echo form_dropdown('is_current', $var['language_status_dd'], $this->input->get('is_current') != '' ? $this->input->get('is_current') : '' );
        ?></td>
                <td></td>
                <td></td>
                <td><?php echo form_dropdown('is_trashed', $var['filter_status_dd'], $this->input->get('is_trashed') != '' ? $this->input->get('is_trashed') : '' );
            ?></td>    
                <td><?php echo anchor('admin/language/edit', _e('Reset'), array('title' => _e('Reset'), 'class' => 'refresh btn-type1 margin-right10 margin-left20 float-left')) ?> <?php echo form_button(array('name' => 'search', 'id' => 'search', 'class' => 'filter ', 'onclick' => 'return goFilter(this)'), _e('Filter')); ?></td>
            </tr>
            <tr id="blanktr">
                <td colspan="6">&nbsp;</td>
            </tr>
            <tr id="multiple_action_section">
                <td colspan="5"><a onclick="return selectAll(this)" class="btn-type1 margin-right10 float-left" title="<?php echo _e('Select All') ?>" href="#"><span class="ion-checkmark-circled"></span><?php echo _e('Select All') ?></a> <a onclick="return unselectAll(this)" class="btn-type1 margin-right10 float-left" title="<?php echo _e('Unselect All') ?>" href="#"><span class="ion-close-circled"></span><?php echo _e('Unselect All') ?></a></td>
                <td><?php echo form_dropdown('action', $var['action_dd']); ?>
                    <button onclick="return goAction(this)" class="margin-left5 go" id="go" type="button" name="go"><?php echo _e('Go') ?> <span class="ion-play"></span></button></td>
            </tr>
            <tr id="blanktr">
                <td colspan="6">&nbsp;</td>
            </tr>
            <?php ### If Record Found Begin ### ?>
        <?php
        if (count($results["records"])) {
            ?>
            <?php foreach ($results["records"] as $value): ?>
                    <tr id="oddeven">
                        <td><label><?php echo form_checkbox('row_id[]', $value->ai_language_id); ?><?php echo $value->language ?></label></td>
                        <td align="center"><?php echo $value->is_current ? _e('Current') : '' ?></td>
                        <td align="center"><?php echo $value->creation_time ?></td>
                        <td align="center"><?php echo $value->update_time ?></td>
                        <td align="center"><?php echo $value->is_trashed ? _e("Inactive") : _e("Active") ?></td>
                        <td class="addedit" align="center"><a href="<?php echo createEditUrl($value->ai_language_id) ?>" class="ion-edit"></a>     | &nbsp;<a href="<?php echo createRevertDeleteUrl($value->ai_language_id, $value->is_trashed) ?>" class="editrevert<?php echo $value->is_trashed ?>"></a></td>
                    </tr>
            <?php endforeach; ?>
                <tr>
                    <td colspan="6"><?php echo $results["pagination"] ?></td>
                </tr>
                <script type="text/javascript">
                    var deleteconformstring = '<?php echo _e('Confirm delete language') ?>';
                    var pdeleteconformstring = '<?php echo _e('Confirm permanent delete language') ?>';
                </script>
                <?php ### If Record Found End ### ?>
                <?php
            }
            else {
                ?>
            <?php ### If No Record Found Begin ###  ?>
                <tr>
                    <td colspan="6"><div class="error">
                            <p><?php echo _e('No records found') ?></p>
                        </div></td>
                </tr>
            <?php ### If No Record Found Begin ###  ?>
            <?php }
        ?>
        </table>
        <?php echo form_close() ?>
        <?php ### List Section Begin ### ?>
    <?php endif; ?>
<?php endif; ?>

