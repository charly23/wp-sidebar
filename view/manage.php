
<?php
    $icon_title = "Manager";
    $icon_href  = "admin.php?page=add_new_option_sidebar";  
?>

<?php echo html::h2_page( $icon_title, $icon_href, true ); ?>

<div id="sform-result"></div>

<p></p>

<div id="sform">
     
     <p><?php _e( 'Manage data information that inserted in the databaase.'); ?></p>
     
     <div id="sform-action"><?php echo form::submitdelete(); ?></div>
     <div id="sform-search"><?php echo form::item_search(); ?></div>
     <div class="clear"></div>  
     <?php echo form::manager_list(); ?>
     <div id="sform-action" class="sform-action-bottom"><?php echo form::submitdelete(); ?></div>  
    
</div>

