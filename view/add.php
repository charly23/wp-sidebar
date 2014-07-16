<?php
    $get = input::get_is_object();
    
    $sql = db::query('sidebar_client',true,'',false);
    if( !empty($sql)){
       $iz = 1;
       foreach( $sql as $sql_keys => $sql_vals ){
            $idval[] = intval( $sql_vals->id );
            $iz++; 
       }
    }
    
    if( !empty( $get->sform )){
        $getid = intval( $get->sform );
    } else {
        if( !empty($idval)){ $getid = $idval[0]; }
    }
    
?>


<?php
    
    if( !empty($idval)){
        $idval_get = $idval[0];
    } else {
        $idval_get = false;
    }
    
    if( $getid == true OR $idval_get == true ){
        
        $icon_title = "Update Pre-live Checklist";
        $icon_label = "";   
        
    } else {
        
        $icon_title = "Update Pre-live Checklist";
        $icon_label = "";  
        
    }
?>

<?php echo html::icon_logo( $icon_title, $icon_label, false ); ?>

<?php
      if( $getid == true ){ 
          $is_where_id = 'WHERE id='.$getid.'';
      } else {
          
          if( !empty($idval)){
              $is_where_id = 'WHERE id='.$idval[0].'';
          }
          
      }
      
      $sql = db::query( 'sidebar_client', false, $is_where_id, false );
?>

<div id="sform-result"></div>

<div id="sform">

<?php if( $getid == true ): ?>  
    <p><?php _e( 'Input fields and update into the database. on this site.'); ?></p>
<?php else: ?>
    <p><?php _e( 'Input fields and insert into the database. on this site.'); ?></p>
<?php endif; ?>

<?php
    echo input::hidden( array( 'id' => 'sform_update_id', 'value' => $getid ) );
?>

<?php

    /**
     *  client details
    **/
    
?>

<div id="formatdiv" class="postbox ">

    <div class="handlediv" title="Click to toggle"><br/></div>
    <h3 class="hndle"><span><?php _e('Client Details'); ?></span></h3>
    <div class="inside"><?php echo form::clientdetails( array( 'client_name' => $sql->client_name, 'client_text' => $sql->client_text )); ?></div>

</div>


<?php

    /**
     *  datepicker
     *  @param (string) - date
    **/
    
?>

<div id="formatdiv" class="postbox ">

    <div class="handlediv" title="Click to toggle"><br/></div>
    <h3 class="hndle"><span><?php _e('Target Date'); ?></span></h3>
    <div class="inside"><?php echo form::datepicker( $sql->date ? $sql->date : date( 'M d, Y') ); ?></div>

</div>

<?php

    /**
     *  datepicker
     *  @param (array) - items
    **/
    
?>


<div id="formatdiv" class="postbox ">

    <div class="handlediv" title="Click to toggle"><br/></div>
    <h3 class="hndle"><span><?php _e('Checkbox Items'); ?></span></h3>
    <div class="inside">
         
         <div class="skin skin-square">

              <dd class="selected">
                 <div class="skin-section">
                     <ul class="list"> 
                        
                        <?php

                             $items = $sql->checkbox_items; 
                             
                             if( !empty($items)){
                                  $expl_items = explode(',',$items);
                                  if( !empty( $expl_items ) ){
                                       foreach( $expl_items as $expl_items_keys => $expl_items_vals ){ 
                                            $items_vals[] = intval( $expl_items_vals );
                                       }
                                  }
                             }

                        ?>

                        <?php echo form::icheckbox( form::checkbox_item_array() ,$items_vals ); ?>
                        
                     </ul>
                 </div>
              </dd>

         </div>
         
         <div class="item-form">
              
              <div class="item-action"><?php echo form::item_action(); ?></div>
              
              <div class="item-addform"><?php echo form::item_add(); ?></div>
              
         </div>
         
         <div class="clear"></div>

    </div>

</div>

<?php

    /**
     *  short details
     *  @param (string) - details
    **/
    
?>

<div id="formatdiv" class="postbox ">

    <div class="handlediv" title="Click to toggle"><br/></div>
    <h3 class="hndle"><span><?php _e('Short Details'); ?></span></h3>
    
    <?php
         
         $details_default = 'We are excited to show case your newly built website, please keep in mind that this is a development environment only. It is real easy for us to make any content changes or replace any of the existing images on your website.';
             
    ?>
    <div class="inside"><?php echo form::shortdetails( $sql->short_details ? $sql->short_details : $details_default ); ?></div>
    
</div>

<?php

    /**
     *  client liaison details
    **/
    
?>

<div id="formatdiv" class="postbox ">

    <div class="handlediv" title="Click to toggle"><br/></div>
    <h3 class="hndle"><span><?php _e('Client Liaison Details'); ?></span></h3>
    <div class="inside">
         <p></p>
         <?php echo form::clientliaisondetails( array( 'sname' => $sql->name, 'semail' => $sql->email, 'scontact' => $sql->contact ) ); ?>
    </div>

</div>

<?php

    /**
     *  submit action
    **/
    
?>

<div id="sform-submit"><?php echo form::submitbtn(); ?></div>
    
</div>