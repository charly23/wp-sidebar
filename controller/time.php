<?php if( !class_exists('settime')){
    
     class settime{
         
         public function __construct(){
              parent::__construct();
         }
          
         public static function time_set($date=null){
              
              if( !is_null( $date)){
                
                  $date_set = strtotime( $date );
                  $now = time();
                  $date_plus = $date_set - $now;
              }
                  
              return $date_plus;
              
         } 
         
         public static function time_set_action($data=null){
              
              $date_set = self::time_set( $data );
              
              if( !is_null($date_set)){
                
                  $days_remaining = floor($date_set/(60*60*24));
                  
                  return $days_remaining;
              }
              
         }
          
           
     }

}
?>