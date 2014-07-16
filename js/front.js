jQuery(function(){
     
     
  /** function runEffect() {
   
            var selectedEffect = 'drop';
            
            var options = {};
            
            if ( selectedEffect === "scale" ) {
                 options = { percent: 0 };
            } else if ( selectedEffect === "size" ) {
                 options = { to: { width: 200, height: 60 } };
            }
        
            jQuery( "#effect" ).toggle( selectedEffect, options, 500 );
  };
    
  jQuery( "#button" ).click(function() {
      runEffect();
  }); **/
  
  jQuery("span.ncf_color1").click(function(){
         
         var speed = 500;
          
         if( jQuery('div#ncf_sidebar').is(":visible") == true ){
            
             jQuery("div.scf_trigger_label").animate({ left:0 }, speed, function(){ });
             jQuery("div#ns-overlay").css({'visibility':'hidden'});
             jQuery(this).removeClass('scf-selected');
            
         } else {

             jQuery("div.scf_trigger_label").animate({ left:'425px' }, speed, function(){ });
             jQuery("div#ns-overlay").css({'visibility':'visible'});
             jQuery(this).addClass('scf-selected');
         }
         
         jQuery('div#ncf_sidebar').toggle(  '', '', 500 );

         
  });
  
  jQuery("span.ncf_color1").blur(function(){
         
         jQuery("div.scf_trigger_label").attr('style',"").animate({ left:0, }, 1500, function(){ });
         jQuery(this).removeClass('scf-selected');
          
  });
      
});