<?php if(!class_exists('form')){
    
    class form{
        
          public static function wp_general_data(){
                
                 $admin_data = array( 
                                         'blogname' => get_settings('blogname'),         
                                         'email'    => get_settings('admin_email'),
                                         'tag'      => get_settings('blogdescription'),
                                         'siteurl'  => get_settings('siteurl'),
                                    );
                 
                 return $admin_data;
                
          }
          
          public static function clientdetails($array=array()){
              
                $html = null;
                
                $html .= '<p>';
                
                $html .= html::label( array( 'for' => 'description', 'text' => 'Client Name' ) );
                $html .= input::text( array( 
                                               'id'    => 'client_name', 
                                               'class' => 'client_name', 
                                               'value' => is_array( $array ) ? stripslashes_deep( $array['client_name'] ) : null 
                                            ) 
                                    );
                                    
                $html .= '</p>';
                               
                $html .= '<p>';
                
                $details_default = 'We are excited to show case your newly built website, please keep in mind that this is a development environment only. It is real easy for us to make any content changes or replace any of the existing images on your website.';
                     
                $html .= html::label( array( 'for' => 'description', 'text' => 'Welcome Details' ) );
                $html .= '<br/>';
                $html .= html::textarea( array( 
                                                   'id'    => 'client_details', 
                                                   'class' => 'client_details', 
                                                   'text' => $array['client_text'] ? stripslashes_deep( $array['client_text'] ) : $details_default  
                                                ) 
                                        );
                
                $html .= '</p>';

                return $html;
                
          }
          
          public static function clientliaisondetails($array=array()){
              
                $html = null;
                
                $html .= '<p>';
                
                $html .= html::label( array( 'for' => 'description', 'text' => 'Name' ) );
                $html .= input::text( array( 
                                               'id'    => 'sname', 
                                               'class' => 'sname', 
                                               'value' => is_array( $array ) ? stripslashes_deep( $array['sname'] ) : null 
                                            ) 
                                    );
                                    
                $html .= '</p>';
                               
                $html .= '<p>';
                     
                $html .= html::label( array( 'for' => 'description', 'text' => 'Email' ) );
                $html .= '<br/>';
                $html .= input::text( array( 
                                               'id'    => 'semail', 
                                               'class' => 'semail', 
                                               'value' => is_array( $array ) ? $array['semail'] : null  
                                            ) 
                                    );
                
                $html .= '</p>';
                
                
                $html .= '<p>';
                
                $html .= html::label( array( 'for' => 'description', 'text' => 'Contact' ) );
                $html .= '<br/>';
                $html .= input::text( array( 
                                               'id'    => 'scontact', 
                                               'class' => 'scontact', 
                                               'value' => $array['scontact'] ? $array['scontact'] : '133040'
                                            ) 
                                    );
                                    
                $html .= '</p>';
                
                
                return $html;
                
          }
          
          public static function datepicker($value=null){
              
              $val_time = date( 'M d, Y', strtotime( $value ) );
              
              $date_value = input::text( array( 
                                                    'id'    => 'inputDate', 
                                                    'class' => 'inputDate', 
                                                    'value' => $val_time 
                                               ) 
                                        );
                
              if( !is_null( $value ) ) return $date_value;

          }
          
          public static function icheckbox($args=array(),$is_checked=array()){
              $html = null;
              
              if( !is_null( $args )
                  AND is_array( $args ) 
              ){
 
                  if( !is_null($is_checked) OR !is_array( $is_checked ) ){
                       
                       foreach( $is_checked as $is_checked_keys => $is_checked_vals ){
                                
                                $html .= input::hidden( array( 'class' => 'is_item_hidden', 'id' => 'is_item_hidden', 'value' => $is_checked_vals ) );
                                
                       }
                    
                  }
                    
                  $i = 1;

                  foreach( $args as $args_keys => $args_vals ){
                        
                        $checkbox_value = input::checkbox( array(       
                                                                        'tabindex' => $args_keys,
                                                                        'id'       => 'square-checkbox-'.$args_keys, 
                                                                        'value'    => $args_keys, 
                                                                   ) 
                                                            );
                        
                        $html .= '<li class="sort">'.$checkbox_value.'<label for="square-checkbox-'.$args_keys.'"> '.$args_vals.'</label><div class="item-edit-main"><span class="item-sort"></span><span class="item-edit"></span></div></li>';
                        $html .= '';
                                  
                        $i++;
                    
                  } 
                
              }
              
              return $html;
            
          }
          
          public static function shortdetails($value=''){
             
              $html = null;
              
              $html .= html::textarea( array( 'class' => 'sdetails', 'id' => 'sdetails', 'text' => stripslashes_deep( $value)  ) ); 
              
              return $html;
            
          }
          
          public static function submitbtn(){
              
              $html = null;
              
              $html .= input::custom_submit( array( 'class' => 'sform-btn', 'id' => 'sform-btn', 'value' => 'Submit' ) ); 
              $html .= '<span id="ajax-load"></span>';
              
              return $html;
            
          }
          
          public static function submitdelete(){
              $html = null;
              
              $html .= input::custom_submit( array( 'class' => 'del_id', 'id' => 'del_id', 'value' => 'Delete' ) );
              $html .= '<span id="ajax-load"></span>';
              
              return $html;
          }
          
          function check_email_address($email) {
                  
               if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
                    return false;
               }
                 
               $email_array = explode("@", $email);
               $local_array = explode(".", $email_array[0]);
               for ($i = 0; $i < sizeof($local_array); $i++) {
                    if ( !ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&?'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$",$local_array[$i])) {
                        return false;
                    }
               }
                  
               if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) {
                    
                    $domain_array = explode(".", $email_array[1]);
                    
                    if (sizeof($domain_array) < 2) { 
                        return false;
                    }
                    
                    for ($i = 0; $i < sizeof($domain_array); $i++) {
                         if( !ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|?([A-Za-z0-9]+))$",$domain_array[$i])) {
                            return false;
                         }
                    }
                }
                
                return true;
          }
          
          public static function manager_list(){
                global $wpdb;
                
                $sql = db::query('sidebar_client',true,'',true);

                $elem = array(
                                 'id' => '',
                                 'class' => '',
                             );
                
                if( !empty( $sql ) AND is_array( $sql ) ){
                     
                     $label_arrays = array(
                                              'name'    => 'Name',
                                              'email'   => 'Email',
                                              'date'    => 'Date',
                                              'item'    => 'Item',
                                              'sort'    => 'Sort',
                                              'quick'   => '--'
                                          );
                     
                     foreach( $sql as $sql_keys => $sql_vals ){
                           
                            $sql_results[] = $sql_vals;
                           
                     }
                     
                     if( !empty( $sql_results ) ) return html::tabler( $elem, $label_arrays, $sql_results );
                     
                }
              
          }
          
          public static function circle(){
                global $wpdb;
                
                $html .= '<p>';
                
                $html .= html::label( array( 'for' => 'description', 'text' => 'Radius' ) );
                $html .= input::text( array( 
                                               'id'    => 'sradius', 
                                               'class' => 'sradius', 
                                               'value' => '', 
                                            ) 
                                    );
                                    
                $html .= '</p>'; 
                
                $html .= '<p>';
                
                $html .= html::label( array( 'for' => 'description', 'text' => 'Radius' ) );
                $html .= input::text( array( 
                                               'id'    => 'sradius', 
                                               'class' => 'sradius', 
                                               'value' => '', 
                                            ) 
                                    );
                                    
                $html .= '</p>'; 
            
          }
          
          public static function checkbox_item_array(){
               
               $sql_item = db::query('sidebar_items',true,'',true);             
                
               /**
                *  
                       $value = array(   
                                         'copy'            => 'Copy', 
                                         'images'          => 'Images', 
                                         'products'        => 'Products', 
                                         'domain'          => 'Domain',
                                         'e-commerce'      => 'E-commerce', 
                                         'payment-gateway' => 'Payment Gateway',
                                         'shipping'        => 'Shipping',
                                     );
                                     
                       return $value;
                *       
               **/
               
               if( !empty( $sql_item) ){
                    
                    foreach( $sql_item as $sql_item_keys => $sql_item_vals ){
                             
                             $slug_val = trim( $sql_item_vals->slug ); 
                             
                             $id_val = trim( $sql_item_vals->id ); 
                             
                             $names[$id_val] = trim( $sql_item_vals->name );
                             
                    }
                    
               } 
               
               return $names;
               
                               
          }
          
          public static function item_search(){
                $html = null;
                
                $data = self::checkbox_item_array(); 
                
                /** $html .= '<div class="item-filter-form">';
                $html .= html::label( array( 'for' => 'description', 'text' => 'Item ' ) ); 
                $html .= html::select( array( 'class'=>'item-filter','id'=>'item-filter', 'name'=>'item_filter' ), $data, '', '' );
                $html .= '</div>'; **/
                
                $sql = db::query('sidebar_client',true,'',false);
                if( !empty( $sql ) ){
                     foreach( $sql as $sql_keys => $sql_vals ){
                        
                          $strtime = strtotime( $sql_vals->date );
                          $strtime_val[$strtime] = strtotime( $sql_vals->date );

                          $date_arrays[$strtime] = date( 'M d, Y', $strtime );
                     }
                }
                
                rsort($strtime_val);

                $html .= '<div class="date-filter-form">';
                $html .= html::label( array( 'for' => 'description', 'text' => 'Date ' ) ); 
                
                $date_unique = array_unique( $strtime_val );
                if( !empty($date_unique)){
                    foreach( $date_unique as $date_unique_keys => $date_unique_vals ){
                           
                             $date_unique_arrays[$date_unique_vals] = date( 'M d, Y', $date_unique_vals );
                           
                    }
                }

                $html .= html::select( array( 'class'=>'date-filter','id'=>'date-filter','name'=>'date_filter' ), $date_unique_arrays, '', '' );
                $html .= '</div>';
                
                $html .= '<div class="apply-filter-form">';
                $html .= input::custom_submit( array( 'class' => 'apply_id', 'id' => 'apply_id', 'value' => 'Apply' ) );
                $html .= input::custom_submit( array( 'class' => 'all_id', 'id' => 'all_id', 'value' => 'All' ) );
                $html .= '</div>';
                
                return $html;
               
          }
          
          public static function submitbtn_settings(){
              
              $html = null;
              
              $html .= input::custom_submit( array( 'class' => 'sform-settings-btn', 'id' => 'sform-settings-btn', 'value' => 'Submit' ) ); 
              $html .= '<span id="ajax-load"></span>';
              
              return $html;
            
          }
          
          public static function settings($ival=1){
                
                $html = null;
                
                $arrays = array( 1 => 'circle', 2 => 'box', 3 => 'content' );
                
                if( $arrays ){
                    
                    switch( $ival ):
                    
                    case 1 :
                    
                    $circle_bgcolor = get_option( 'circle_bgcolor_val' ) ? get_option( 'circle_bgcolor_val' ) : '#0074a2';
                    $circle_radius  = get_option( 'circle_radius_val' ) ? get_option( 'circle_radius_val' ) : '46px';
    
                    $html .= '<p>';
                    $html .= html::label( array( 'for' => 'description', 'text' => 'Background Color' ) );
                    $html .= '<br/>';
                    $html .= input::text( array( 'class' => 'color-circle', 'id' => 'color-circle', 'value' => $circle_bgcolor, 'name' => 'color_circle' ) );
                    $html .= '</p>';
                    
                    $html .= '<p>';
                    $html .= html::label( array( 'for' => 'description', 'text' => 'Border radius - Format : 10px' ) );
                    $html .= '<br/>';
                    $html .= input::text( array( 'class' => 'radius-circle', 'id' => 'radius-circle', 'value' => $circle_radius, 'name' => 'radius_circle' ) );
                    $html .= '</p>';
                    
                    break;
                    
                    case 2 :
                    
                    $box_bgcolor = get_option( 'box_bgcolor_val' ) ? get_option( 'box_bgcolor_val' ) : '#413d3e';
                    $box_width   = get_option( 'box_width_val' ) ? get_option( 'box_width_val' ) : '520px';
                    $box_height  = get_option( 'box_height_val' ) ? get_option( 'box_height_val' ) : '100%';
                    
                    $html .= '<p>';
                    $html .= html::label( array( 'for' => 'description', 'text' => 'Background Color' ) );
                    $html .= '<br/>';
                    $html .= input::text( array( 'class' => 'bgcolor-circle', 'id' => 'bgcolor-circle', 'value' => $box_bgcolor, 'name' => 'bgcolor_circle' ) );
                    $html .= '</p>';
                    
                    $html .= '<p>';
                    $html .= html::label( array( 'for' => 'description', 'text' => 'Width' ) );
                    $html .= '<br/>';
                    $html .= input::text( array( 'class' => 'width-circle', 'id' => 'width-circle', 'value' => $box_width, 'name' => 'width_circle' ) );
                    $html .= '</p>';
                    
                    $html .= '<p>';
                    $html .= html::label( array( 'for' => 'description', 'text' => 'Height' ) );
                    $html .= '<br/>';
                    $html .= input::text( array( 'class' => 'height-circle', 'id' => 'height-circle', 'value' => $box_height, 'name' => 'height_circle' ) );
                    $html .= '</p>';
                    
                    break;  
                    
                    case 3 :
                    
                    $font_color  = get_option( 'text_color_value' ) ? get_option( 'text_color_value' ) : '#0074a2';
                    $font_size   = get_option( 'font_size_value' ) ? get_option( 'font_size_value' ) : '';
                    $font_weight = get_option( 'font_weight_values' ) ? get_option( 'font_weight_values' ) : '';
                    
                    $html .= '<p>';
                    $html .= html::label( array( 'for' => 'description', 'text' => 'Text Color' ) );
                    $html .= '<br/>';
                    $html .= input::text( array( 'class' => 'text-circle', 'id' => 'text-circle', 'value' => $font_color, 'name' => 'text_circle' ) );
                    $html .= '</p>';
                    
                    $html .= '<p>';
                    $html .= html::label( array( 'for' => 'description', 'text' => 'Font Size' ) );
                    $html .= '<br/>';
                    $html .= input::text( array( 'class' => 'size-circle', 'id' => 'size-circle', 'value' => $font_size, 'name' => 'size_circle' ) );
                    $html .= '</p>';
                    
                    $html .= '<p>';
                    $html .= html::label( array( 'for' => 'description', 'text' => 'Font Weight' ) );
                    $html .= '<br/>';
                    $html .= input::text( array( 'class' => 'weight-circle', 'id' => 'weight-circle', 'value' => $font_weight, 'name' => 'weight_circle' ) );
                    $html .= '</p>';
                    
                    break;    
                    
                    endswitch; 
                    
                }
                
                return $html;
                
          }
          
          public static function quick_form_update($array=array()){
                $html = null;

                $idval = intval( $array->id );
                
                $html .= input::hidden( array( 'class' => 'quick-update-id', 'id' => 'quick-update-id', 'value' => $idval ) );
                
                $html .= '<div class="quick-welcome">';
                
                $html .= '<p>';
                $html .= html::label( array( 'for' => 'description', 'text' => 'Client Name' ) );
                $html .= '<br/>';
                $client_nameval = $array->client_name ? $array->client_name : null;
                $html .= input::text( array( 'class' => 'quick-client-name', 'id' => 'quick-client-name', 'name' => 'quick_client_name', 'value' => $client_nameval ) );
                $html .= '</p>';
                
                $html .= '<p>';
                $html .= html::label( array( 'for' => 'description', 'text' => 'Welcome Message' ) );
                $html .= '<br/>';
                
                $client_textval = $array->client_text ? $array->client_text : null;
                
                $html .= html::textarea( array( 'class' => 'quick-message', 'id' => 'quick-message', 'name' => 'quick_message', 'text' => $client_textval ) );
                $html .= '</p>';
                
                $html .= '</div>';
                
                $html .= '<div class="quick-client">';
                
                $html .= '<p>';
                $html .= html::label( array( 'for' => 'description', 'text' => 'Name(Liaison)' ) );
                $html .= '<br/>';
                $nameval = $array->name ? $array->name : null;
                $html .= input::text( array( 'class' => 'quick-name', 'id' => 'quick-name', 'name' => 'quick_name', 'value' => $nameval ) );
                $html .= '</p>';
                
                $html .= '<p>';
                $html .= html::label( array( 'for' => 'description', 'text' => 'Email(Liaison)' ) );
                $html .= '<br/>';
                $emailval = $array->email ? $array->email : null;
                $html .= input::text( array( 'class' => 'quick-email', 'id' => 'quick-email', 'name' => 'quick_email', 'value' => $emailval ) );
                $html .= '</p>';
                
                $html .= '</div>';
                
                $html .= '<div class="quick-date">';
                
                $html .= '<p>';
                $html .= html::label( array( 'for' => 'description', 'text' => 'Contact' ) );
                $html .= '<br/>';
                
                $contactval = $array->contact ? $array->contact : null;
                
                $html .= input::text( array( 'class' => 'quick-contact', 'id' => 'quick-contact', 'name' => 'quick_contact', 'value' => $contactval ) );
                $html .= '</p>';
                
                $html .= '<p>';
                $html .= html::label( array( 'for' => 'description', 'text' => 'Date' ) );
                $html .= '<br/>';
                
                $dateval = $array->date ? $array->date : null;
                $dateval_time = date( 'M d, Y', strtotime( $dateval ) );
                             
                $html .= input::text( array( 'class' => 'quick-date', 'name' => 'quick_date', 'value' => $dateval_time ) );
                $html .= '</p>';
                
                $html .= '</div>';
                
                $html .= '<div class="quick-shortdetails">';
                
                $html .= '<p>';
                $html .= html::label( array( 'for' => 'description', 'text' => 'Short Details' ) );
                $html .= '<br/>';
                
                $shortval = $array->short_details ? $array->short_details : null;
                
                $html .= html::textarea( array( 'class' => 'quick-short', 'id' => 'quick-short', 'name' => 'quick_short', 'text' => $shortval ) );
                $html .= '</p>';
                
                $html .= '</div>';
                
                $html .= '<div class="clear"></div>';
                
                $html .= '<div class="quick-submit">';
                $html .= '<p>';
                $html .= input::custom_submit( array( 'class' => 'quick-submit-btn', 'id' => 'quick-submit-btn', 'value' => 'Submit' ) );
                $html .= '<span id="quick-ajax-load"></span>';
                $html .= '</p>';
                $html .= '</div>';
                
                return $html;
                
          }
          
          public static function item_action(){
                $html = null;
                
                $html .= input::custom_submit( array( 'class' => 'item-add', 'id' => 'item-add', 'value' => 'Add New Item' ) ); 
                
                return $html;
                
          }
          
          public static function item_add($val=null){
                global $wpdb;
                
                $html = null;                  
                
                $int_val = intval( $val );                

                $is_where_id = 'WHERE id="'.$int_val.'"';
                $sql = db::query( 'sidebar_items', false, $is_where_id, false );
                
                $html .= '<p>';
                $html .= html::label( array( 'for' => 'description', 'text' => 'Name' ) );
                $html .= '<br/>';
                
                $name_val = is_string($sql->name) ? $sql->name : null;
          
                $html .= input::text( array( 'class' => 'item-name', 'id' => 'item-name', 'name' => 'item_name', 'value' => $name_val ) );
                $html .= '</p>';
                
                $html .= '<p>';
                if( $name_val == true ){
                    
                    $html .= input::custom_submit( array( 'class' => 'item-update', 'id' => 'item-update', 'value' => 'Save' ) );
                    $html .= input::custom_submit( array( 'class' => 'item-delete', 'id' => 'item-delete', 'value' => 'Delete' ) );
                    
                    $id_val = intval( $sql->id ) ? $sql->id : null; 
                    
                    $html .= input::hidden( array( 'class' => 'item-id', 'id' => 'item-id', 'name' => 'item_id', 'value' => $id_val ) ); 
                } else {
                    $html .= input::custom_submit( array( 'class' => 'item-submit', 'id' => 'item-submit', 'value' => 'Submit' ) ); 
                }
                
                $html .= '<span id="item-ajax-load"></span>';
                $html .= '</p>';
                
                return $html;
                  
          }
         
    }
    
}
?>