
<?php
   
function display(){
    global $wpdb;
      
    $html = null;
    
    $general_data = form::wp_general_data();
    
    $circle_bgcolor = get_option( 'circle_bgcolor_val' ) ? get_option( 'circle_bgcolor_val' ) : '#0074a2';
    $circle_radius  = get_option( 'circle_radius_val' ) ? get_option( 'circle_radius_val' ) : '46px';
    
    $box_bgcolor = get_option( 'box_bgcolor_val' ) ? get_option( 'box_bgcolor_val' ) : '#413d3e';
    $box_width   = get_option( 'box_width_val' ) ? get_option( 'box_width_val' ) : '520px';
    $box_height  = get_option( 'box_height_val' ) ? get_option( 'box_height_val' ) : '100%';
    
    $html .= '<style>';
    $html .= '#ncf_sidebar.ncf_flat { background-color: '.$box_bgcolor.'; } #ncf_sidebar { background-color: '.$box_bgcolor.'; width: '.$box_width.'; height: '.$box_height.'; min-height: '.$box_height.'; }';        
    $html .= 'span.ncf_color1{background-color:'.$circle_bgcolor.';border-radius: '.$circle_radius.';}';
    $html .= '</style>';
    
    $html .= '<div class="ncf-body"></div>';
    
    $html .= '<div id="ncf_sidebar" class="ncf_flat " style="left: 0px;">';
    $html .= '<div class="ncf_sidebar_cont_scrollable">';
    
    $items_array = form::checkbox_item_array();
    //$items_array_keys = array_keys($items_array);
    
    $sql = db::query('sidebar_client',true,'',true);
    $reset_sql = reset( $sql );

    if( !empty( $sql ) ){
        
        $html .= '<div id="data-main-content">';
        $html .= '<ul id="data-main">';
            
            $i = 1;
            foreach( $sql as $sql_keys => $sql_vals ){
                 
                 if( $i == 1 ){ 

                     $name = ucfirst(strtolower($sql_vals->name));
                     $client_name = ucfirst(strtolower($sql_vals->client_name));
                     
                     $idval = input::hidden( array( 'class' => 'name-id', 'id' => 'name-id', 'value' => intval( $sql_vals ) ) );
                     
                     $html .= '<li>';
                     
                     $html .= '<div class="client-main">';
                     
                     //$html .= '<a href="#" class="name-selected">Welcome '.$idval.$name.'</a>';
                     
                     $html .= '<h3 class="name-selected">Welcome '.$idval.$client_name.'</h3>';
                     $html .= '<div class="client-text">'.$sql_vals->client_text.'</div>';

                     $remain = settime::time_set_action($sql_vals->date);

                     $html .= '<div class="client-time">We are working towards launching your website in <span class="date_set">'.$remain.'</span> days on the <span class="date_set">'.date( 'd M Y',strtotime( $sql_vals->date )).'</span>.</div>';
                     
                     $html .= '<div class="client-label-items">Please see below which required information is still outstanding:</div>'; 
                     
                     $html .= '<div class="client-items-list">';
                     
                         $html .= '<ul class="client-items-base">';
                         
                         $items = $sql_vals->checkbox_items; 
                         if( !empty( $items )){
                             $items_expl = explode( ',',$items ); 
                             if( is_array($items_expl)){
                                 $items_expl_vals = $items_expl;
                             }
                         }

                         if( !empty( $items_array ) ){
                             foreach( $items_array as $items_array_keys => $items_array_vals ){
                                   if( in_array( $items_array_keys, $items_expl_vals ) ){   
                                      $html .= '<li><span class="item-checks-selected"></span>'.$items_array_vals.'</li>';
                                   }  else {
                                      $html .= '<li><span class="item-checks"></span>'.$items_array_vals.'</li>';
                                   }  
                             }
                         }
                         
                         $html .= '</ul>';
                         
                     $html .= '</div>';
                     
                     $html .= '<div class="client-liaison">';
                     
                     $html .= 'Currently your website default email is <span class="liaison_set">'.$general_data['email'].'</span>, please contact your Client Liaison if this is incorrect.
                               Please have a browse through your website and let your Client Liaison know if you have any minor changes. 
                               You can contact <span class="liaison_set">'.$client_name.'</span> by email <span class="liaison_set">'.$sql_vals->email.'</span> or phone <span class="liaison_set">'.$sql_vals->contact.'</span>';
                     
                     $html .= '</div>';
                      
                     $html .= '</div>';
                     
                     $html .= '</li>';
                     $i++;
                 }
            }
        
        $html .= '</ul>';
        $html .= '</div>';
        
    }
    
    $html .= '<div id="ajax-select-main"></div>';
    
    $html .= '</div>';
    $html .= '</div>';
    
    $html .= '<div class="scf_trigger_label scf_label_circle scf_label_visible">';
    $html .= '<span class="ncf_color1"></span>';
    $html .= '</div>';
    
    $html .= '<div id="ns-overlay"></div>';
    
    _e( $html );
}
?>