
<p>
	<input type="button" id="toggle_megamenu" name="add-custom-menu-item" value="<?php _e('Show Mega Menu Options', SH_NAME); ?>" class="button-secondary submit-add-to-menu">
</p>

<div id="megamenu_options" style="display:none;width:94%;" class="link-to-original">
    
    <p class="">
        <label class="field" for="megamenu-active">
            <?php $checked = (get_post_meta($item_id, '_menu_item_status', true) == 'active') ? ' checked="checked"' : ''; ?>
            <input type="checkbox" name="megamenu_status[<?php echo $item_id; ?>]" value="active" <?php echo $checked; ?>> <span><?php _e('Mega Menu', SH_NAME); ?>?</span>
        </label>
    </p>

    <p class="">

        <label for="menu-columns" class="field"><span><?php _e('Columns', SH_NAME); ?>:</span>
            <select id="megamenu_columns" name="bistro_menu_columns[<?php echo $item_id; ?>]">
            <?php
            $columns = range(2, 12,2);
            foreach($columns as $k=>$v){ 
                $selected = (get_post_meta($item_id, '_bistro_menu_columns', true) == $v) ? ' selected="selected"' : ''; ?>
                    <option value="<?php echo $v; ?>" <?php echo $selected; ?>><?php echo $v; ?></option>
            <?php } ?>
            </select>
        </label>
    </p>

    <p class="">

        <label class="field" for="menu-sidebars"><span><?php _e('Select Sidebar', SH_NAME); ?>:</span>

            <select name="bistro_menu_sidebar[<?php echo $item_id; ?>]">

				<?php foreach($wp_registered_sidebars as $k=>$v):
                    $selected = (get_post_meta($item_id, '_menu_item_sidebar', true) == $k) ? ' selected="selected"' : '';?>
                    <option value="<?php echo $k; ?>" <?php echo $selected; ?>><?php echo $v['name']; ?></option>
                <?php endforeach; ?>

            </select>

        </label>

    </p>

    <div class="clear"></div>

</div>