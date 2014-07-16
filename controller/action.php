<?php if( !class_exists('action')){
    
     class action{
          
          public function __construct(){
              parent::__construct();
          }
          
          public function insert(){
               
          }
          
          public static function error_log(){
            
                return array( 'err_title' => array(  'err1' => '', 
                                                     'err2' => 'Empty title pls. field up.' ),
                                                     
                              'err_email' => array(  'err1' => '',
                                                     'err2' => 'Error email pls. check.' ),
                                                     
                              'err_contact' => array( 
                                                        'err1' => '',
                                                        'err2' => 'Numeric field.',
                                                    ),   
                            ); 
            
          }
          
          // ajax call
          
          public static function sform_insert(){
                global $wpdb;
                
                $err     = '';
                $err_log = self::error_log(); 
                $input   = input::post_is_object();
                $tbl     = $wpdb->prefix . 'sidebar_client';
                
                $title = trim( stripslashes_deep( $input->values[0] ) );
                $title_slug = sanitize_title( $input->values[0] );
                
                $email = trim( $input->values[1] );
                $email_filter = filter_var($email, FILTER_VALIDATE_EMAIL);
                $email_valid  = !empty( $email ) AND $email_filter ? true : false;
                
                $contact = intval( $input->values[2] );
                $contact_valid = is_numeric( $input->values[2] ) AND $contact ? true : false;
                
                //$err = '<div class="err-log">'.$err_log['err_title']['err2'].'</div>';
                
                $dateval = trim( $input->values[3] );
                $details = trim( stripslashes_deep( $input->values[4]) );
                $items   = trim( $input->values[5] );
                
                $client_name = trim( $input->values[6] );
                $client_text = trim( $input->values[7] );
                
                $update_id = $input->update;
                
                if( !empty( $client_name ) ){
                              
                      $field = array( 
                                       'name'           => $title,
                                       'email'          => $email,
                                       'contact'        => $contact,
                                       'date'           => $dateval,
                                       'checkbox_items' => $items,
                                       'short_details'  => $details,
                                       'client_name'    => $client_name,
                                       'client_text'    => $client_text     
                                    );
                      
                      $field_format = array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' );
                      
                      if( is_array( $field ) ){
                          
                          if( intval( $update_id ) ){ 
                                
                                $field_where = array( 'id' => $update_id );
                                $field_where_format = array( '%d' );
                                
                                $wpdb->update( $tbl, $field, $field_where, $field_format, $field_where_format );
                          
                          } else {
                            
                                $wpdb->insert( $tbl, $field, $field_format );
                                
                          }
                            
                      }
                      
                }
                
          }
          
          public static function sform_delete(){
                global $wpdb;
                
                $err     = '';
                $err_log = self::error_log(); 
                $input   = input::post_is_object();
                $tbl     = $wpdb->prefix . 'sidebar_client';
                
                if( isset( $input->action ) ){
                    
                    $value = $input->values;
                    
                    if( !empty( $value ) ){
                        
                         $expl_value = explode(',',$value);
                         
                         if(!empty($expl_value)):
                            
                             foreach( $expl_value as $expl_value_keys => $expl_value_vals ):
                                  
                                  $where  = array( 'id' => intval($expl_value_vals) );
                                  $format = array( '%d');
                                  
                                  $wpdb->delete( $tbl, $where, $format );
                                    
                             endforeach;
                             
                         endif;
                    }
                    
                }

          }
          
          public static function sform_sort(){
                global $wpdb;
                
                $err     = '';
                $err_log = self::error_log(); 
                $input   = input::post_is_object();
                $tbl     = $wpdb->prefix . 'sidebar_client';
                
                if( isset( $input->action ) ){
                    
                     $value = $input->values;
                     
                     if( !empty( $value ) ){
                        
                         $expl_value = explode(',',$value);
                         
                         if( !empty($expl_value)):
                             
                             $i = 1; 
                             foreach( $expl_value as $expl_value_keys => $expl_value_vals ):
                                  
                                  $field  = array( 'sort' => $i );
                                  $field_format = array( '%d' );
                                  
                                  $filed_where  = array( 'id' => intval( $expl_value_vals ) );
                                  $field_where_format = array( '%d');
                                  
                                  $wpdb->update( $tbl, $field, $filed_where, $field_format, $field_where_format );
                                  $i++;
                                    
                             endforeach;
                             
                         endif;
                    }
                   
                }
            
          }
          
          public static function sform_quick(){
               global $wpdb;
               
               $err     = '';
               $err_log = self::error_log(); 
               $input   = input::post_is_object();
               $tbl     = $wpdb->prefix . 'sidebar_client';
               
               $title = trim( stripslashes_deep( $input->values[0] ) );
               $title_slug = sanitize_title( $input->values[0] );
                
               $email = trim( $input->values[1] );
               $email_filter = filter_var($email, FILTER_VALIDATE_EMAIL);
               $email_valid  = !empty( $email ) AND $email_filter ? true : false;
                
               $contact = intval( $input->values[2] );
               $contact_valid = is_numeric( $input->values[2] ) AND $contact ? true : false;
                
               //$err = '<div class="err-log">'.$err_log['err_title']['err2'].'</div>';
                
               $dateval = trim( $input->values[3] );
               $details = trim( stripslashes_deep( $input->values[4] ) );
                
               $update_id = $input->update;
               
               $client_name = trim( $input->values[5] );
               $client_text = trim( $input->values[6] );
 
               if( !empty( $client_name ) ){ 

                      $field = array( 
                                       'name'           => $title,
                                       'email'          => $email,
                                       'contact'        => $contact,
                                       'date'           => $dateval,
                                       'short_details'  => $details,
                                       'client_name'    => $client_name,
                                       'client_text'    => $client_text  
                                    );
                      
                      $field_format = array( '%s', '%s', '%s', '%s', '%s', '%s', '%s' );
                      
                      if( is_array( $field ) ){
             
                          $field_where = array( 'id' => $update_id );
                          $field_where_format = array( '%d' );
                            
                          $wpdb->update( $tbl, $field, $field_where, $field_format, $field_where_format );
                            
                      }
                      
                }
                
          }
          
          public static function settings_option(){
               global $wpdb;
               
               $err     = '';
               $err_log = self::error_log(); 
               $input   = input::post_is_object();
               
               if( isset( $input->action ) ){
                   
                   $values = $input->values;

                   $circle_bgcolor = get_option( 'circle_bgcolor_val' );
                   if( !empty($circle_bgcolor) ){
                       update_option( 'circle_bgcolor_val', trim($values[0]) ); 
                   } else {
                       add_option( 'circle_bgcolor_val', trim($values[0]), '', 'yes' );
                   }
                   
                   $circle_radius  = get_option( 'circle_radius_val' );
                   if( !empty($circle_radius) ){
                       update_option( 'circle_radius_val', trim($values[1]) ); 
                   } else {
                       add_option( 'circle_radius_val', trim($values[1]), '', 'yes' );
                   }
                   
                   $box_bgcolor = get_option( 'box_bgcolor_val' );
                   if( !empty($box_bgcolor) ){
                       update_option( 'box_bgcolor_val', trim($values[2]) );
                   } else { 
                       add_option( 'box_bgcolor_val', trim($values[2]), '', 'yes' );
                   }
                   
                   $box_width = get_option( 'box_width_val' );
                   if( !empty($box_width) ){
                       update_option( 'box_width_val', trim($values[3]) );
                   } else { 
                       add_option( 'box_width_val', trim($values[3]), '', 'yes' );
                   }
                   
                   $box_height = get_option( 'box_height_val' );
                   if( !empty($box_height) ){
                       update_option( 'box_height_val', trim($values[4]) );
                   } else { 
                       add_option( 'box_height_val', trim($values[4]), '', 'yes' );
                   }
                   
                   $font_color = get_option( 'text_color_value' );
                   if( !empty($font_color) ){
                       update_option( 'text_color_value', trim($values[5]) ); 
                   } else { 
                       add_option( 'text_color_value', trim($values[5]), '', 'yes' );
                   }
                   
                   $font_size = get_option( 'font_size_value' );
                   if( !empty($font_size) ){
                       update_option( 'font_size_value', trim($values[6]) );
                   } else {
                       add_option( 'font_size_value', trim($values[6]), '', 'yes' );
                   }
                   
                   $font_weight = get_option( 'font_weight_values' );
                   if( !empty($font_weight) ){
                       update_option( 'font_weight_values', trim($values[7]) );
                   } else { 
                       add_option( 'font_weight_values', trim($values[7]), '', 'yes' );
                   }
                    
               }
                 
          }
          
          public static function item_updateform(){
               global $wpdb;
               
               $err     = '';
               $html    = null;
               $err_log = self::error_log(); 
               $input   = input::post_is_object(); 
              
               $slug_val = trim( $input->values );
               
               if( !is_null( $slug_val)): 
                    $html .= form::item_add($slug_val);
               endif;
               
               _e( $html );
                
          }
          
          public static function item_addform(){
               global $wpdb;
               
               $err     = '';
               $html    = null;
               $err_log = self::error_log(); 
               $input   = input::post_is_object(); 

               _e( form::item_add() );

          }
          
          public static function item_insert(){
               global $wpdb;
               
               $err     = '';
               $err_log = self::error_log(); 
               $input   = input::post_is_object(); 
               $tbl     = $wpdb->prefix . 'sidebar_items';
               
               if( isset( $input->action ) ){
                   
                   if( !is_null($input->values) AND !empty( $input->values ) ){
                   
                       $name_var = trim( $input->values );
                       $name_slug = sanitize_title( $input->values );
                        
                       $field = array( 'name' => $name_var, 'slug' => $name_slug );
                       $field_format = array( '%s', '%s' );
                       
                       $wpdb->insert( $tbl, $field, $field_format );
                       
                   }

                   
               }
                
          }
          
          public static function item_update(){
               global $wpdb;
               
               $err     = '';
               $err_log = self::error_log(); 
               $input   = input::post_is_object(); 
               $tbl     = $wpdb->prefix . 'sidebar_items';
               
               if( isset( $input->action ) ){
                   
                   if( !is_null($input->name_val) AND !empty( $input->name_val ) ){
                   
                       $name_var = trim( $input->name_val );
                       $name_slug = sanitize_title( $input->name_val );
                       
                       $int_id = intval( $input->item_id );
                        
                       $field = array( 'name' => $name_var, 'slug' => $name_slug );
                       $field_format = array( '%s', '%s' );
                       
                       $field_where = array( 'id' => $int_id );
                       $field_where_format = array( '%d' );
                       
                       $wpdb->update( $tbl, $field, $field_where, $field_format, $field_where_format );
                       
                   }
                   
               }
                
          }
          
          public static function item_delete(){
               global $wpdb;
               
               $err     = '';
               $err_log = self::error_log(); 
               $input   = input::post_is_object(); 
               $tbl     = $wpdb->prefix . 'sidebar_items';
               
               if( isset( $input->action ) ){
                   
                   $idval = intval( $input->id_val );
                   
                   $where  = array( 'id' => $idval );
                   $format = array( '%d');
                                  
                   $wpdb->delete( $tbl, $where, $format );
                   
               }
          }
          
          public static function item_sort(){
               global $wpdb;
               
               $err     = '';
               $err_log = self::error_log(); 
               $input   = input::post_is_object(); 
               $tbl     = $wpdb->prefix . 'sidebar_items';
               
               if( isset( $input->action ) ){
                   
                   $id_val = $input->id_val;
                   if( !empty( $id_val) ){
                    
                        $idval_expl = explode( ',',$id_val);
                        
                        if( is_array($idval_expl)){
                            
                            $i = 1;
                            foreach( $idval_expl as $idval_expl_keys => $idval_expl_vals ){
                                 
                                 $field = array( 'sort' => $i );
                                 $field_format = array( '%s' );
                                   
                                 $field_where = array( 'id' => intval( $idval_expl_vals ) );
                                 $field_where_format = array( '%d' );
                                   
                                 $wpdb->update( $tbl, $field, $field_where, $field_format, $field_where_format );
                                 
                                 $i++;
                            }  
                        }
                   }
                
               } 
               
          }
          
     }
}
?>