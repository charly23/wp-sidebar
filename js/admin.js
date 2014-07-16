jQuery(function(){ 

       
    jQuery('#inputDate').datepicker({
        dateFormat : 'M dd, yy'
    });
    
    jQuery('input.quick-date').datepicker({
        dateFormat : 'M dd, yy'
    });

    jQuery('#sdetails').redactor({
        	focus: true,
            plugins: ['advanced']
    });
    
    jQuery('#client_details').redactor({
        	focus: true,
            plugins: ['advanced']
    });
    
    jQuery("div#sform .handlediv").click(function(){
          
      var inside = jQuery(this).parent().find(".inside");
      
      if ( inside.is(":visible") == true ) {
           
           inside.hide();
           jQuery(this).parent().find('.hndle').addClass('sform-acitve');
           
      } else {
          
          inside.show();
          jQuery(this).parent().find('.hndle').removeClass('sform-acitve');
        
      }
        
    });

    jQuery('.skin-square input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%'
    });
    
    
    jQuery("input.is_item_hidden").each(function(){
           
           var itemval = jQuery(this).val();
            
           jQuery("input#square-checkbox-"+itemval ).iCheck('check');
          
    });
    
    jQuery("input#sform-delete").click(function(){
        
        var checked = jQuery(this).parent().parent().parent().parent().parent();
        
        if( jQuery(this).is(':checked') ){  
            
            if( checked ){
                checked.find('input.sform-checked').attr('checked', true);
                var num_check = jQuery('input.sform-checked:checked').length; 
                jQuery('input#del_id').attr('value', 'Delete - ' + num_check ); 
            }
            
        } else {
            
            checked.find('input.sform-checked').attr('checked', false); 
            var num_check = jQuery('input.sform-checked:checked').length; 
            if( num_check != 0 ){
                jQuery('input#del_id').attr('value', 'Delete - ' + num_check );
            } else {
                jQuery('input#del_id').attr('value', 'Delete' );
            }
            
        }   
    });
    
     jQuery('input.sform-checked').click(function(){
        
        var number_of_checked = jQuery('input.sform-checked:checked').length;
        
        if( number_of_checked !=0 ){
            jQuery('input#del_id').attr('value', 'Delete - ' + number_of_checked );
        } else {
            jQuery('input#del_id').attr('value', 'Delete' ); 
        }  
        
    });
    
    jQuery("span.count_items").hover(function(){
          
          jQuery(this).next().show();
          
    }, function(){
          
          jQuery(this).next().hide();
             
    });    
    
    jQuery("a.re-icon, a.re-html").live('click',function(){
          
          return false;
           
    });

});