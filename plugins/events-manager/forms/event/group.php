<?php
    global $EM_Event;
    if(!function_exists('bp_is_active') || !bp_is_active('groups'))
        return false;
    
    $user_groups = groups_get_user_groups(get_current_user_id());
    $active_groups = array();

    foreach($user_groups['groups'] AS $group_id ){
        $active_groups[] = groups_get_group(Array('group_id'    =>  $group_id)); 
    }

	$group_count = count($user_groups); 
?>
<div class="event-creator__container">
    <label for="group" class="event-creator__label"><?php echo __('Hosted By') ?></label>
    <select name="group_id" id="group" class="event-creator__dropdown">
        <option value=""><?php print __('No group', 'commuity-portal'); ?></option>
        <?php if( count($active_groups) > 0 ): ?>
        <?php foreach($active_groups as $BP_Group): ?>
            <option value="<?php echo esc_attr($BP_Group->id); ?>" <?php echo ($BP_Group->id == $EM_Event->group_id) ? esc_attr('selected') : null; ?>><?php echo __($BP_Group->name); ?>
            </option>
        <?php endforeach; ?>
        <?php endif; ?>
    </select>
    <?php if(em_wp_is_super_admin()): ?>
		<!-- <p><em><?php __( 'As a site admin, you see all group events, users will only be able to choose groups they are admins of.', 'commuity-portal')?></em></p> -->
    <?php endif; ?>
</div>