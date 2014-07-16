<?php
    $icon_title = "Settings <code>[sidebar]</code>";
    $icon_label = "";  
?>

<?php echo html::icon_logo( $icon_title, $icon_label, false ); ?>

<div id="sform-result"></div>

<div id="sform">
    
    <p><?php _e( 'Setup option fields for sidebar effect, ui and style management .'); ?></p>
     
    <div id="formatdiv" class="postbox ">

        <div class="handlediv" title="Click to toggle"><br/></div>
        <h3 class="hndle"><span><?php _e( 'Circle'); ?></span></h3>
        <div class="inside"><?php echo form::settings(1); ?></div>
    </div>
    
    <div id="formatdiv" class="postbox ">

        <div class="handlediv" title="Click to toggle"><br/></div>
        <h3 class="hndle"><span><?php _e( 'Box'); ?></span></h3>
        <div class="inside"><?php echo form::settings(2); ?></div>
    
    </div>
    
    <div id="formatdiv" class="postbox ">

        <div class="handlediv" title="Click to toggle"><br/></div>
        <h3 class="hndle"><span><?php _e( 'Content'); ?></span></h3>
        <div class="inside"><?php echo form::settings(3); ?></div>
    
    </div>
    
    <div id="sform-settins-submit"><?php echo form::submitbtn_settings(); ?></div>
     
</div>