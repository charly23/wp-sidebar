jQuery(function(){
       
       /** xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
         * sort helper function
           xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
       **/
       
       var fixHelper = function(e,ui){
               ui.children().each(function() {
                  jQuery(this).width(jQuery(this).width());
               });
               return ui;
       };
       
       var msg = ["Successfully updated to the database .", "Successfully inserted to the database .", "Successfully delete to the database ."];
       
       /**  xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
          * ajax callback function
          * insert and update action
            xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
        **/
        
        jQuery.fn.pause = function(duration) {
            jQuery(this).animate({ dummy: 1 }, duration);
            return this;
        };
        
        function ajaxinsertSForm( call, value, id){
           
           var ajaxurl = ajax_script.ajax_url;
           
           jQuery.ajax ({
                              data: { action  : call, values : value, update : id },
                              
                              type   : 'POST',
                              url    : ajaxurl,
                              
                              beforeSend: function() {
                                   jQuery("span#ajax-load").css({'display':'inline-block'});
                              },
                              
                              error: function(xhr, status, err) {
                                   // Handle errors
                              },
                              
                              success: function(html, data) {
                                
                                   jQuery("div#sform-result").html( html );
                                   
                              }
                  
            }).done(function( html, data ) {
                
                  jQuery("span#ajax-load").hide();
                  
                  jQuery("div#sform-result").html("<div id='msg_log'>"+msg[0]+"</div>");
                  
                  jQuery("div#msg_log").pause(3000).fadeOut(1200);
                  
                  window.location="admin.php?page=add_new_option_sidebar";
            }); 
       }
       
       jQuery("input#sform-btn").click(function(){
              
              var update_id = jQuery("input#sform_update_id").val();
              
              var sname    = jQuery("input#sname").val();
              var semail   = jQuery("input#semail").val();
              var scontact = jQuery("input#scontact").val();
              var sdate    = jQuery("input#inputDate").val();
              var sdetails = jQuery("textarea#sdetails").val();
              
              var items = []; 
              jQuery("ul.list li div.checked").each(function(){
                  var idval = jQuery(this).find("input").val();
                  items.push( idval );
              });
              var itemsval = items.join(',');
              
              var client_name = jQuery("input#client_name").val();
              var client_details = jQuery("textarea#client_details").val();
              
              var sform = [ sname, semail, scontact, sdate, sdetails, itemsval, client_name, client_details ];
              
              ajaxinsertSForm( 'ajax_action_sform', sform, update_id );
              
       });
       
       /**  xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
          * ajax callback function
          * insert and update action
            xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
        **/
       
       /**  xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx 
          * ajax sort callback function
          * sort action
            xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
        **/
       
       function ajaxsortSForm( call, value){
           
           var ajaxurl = ajax_script.ajax_url;
           
           jQuery.ajax ({
                              data: { action  : call, values : value },
                              
                              type   : 'POST',
                              url    : ajaxurl,
                              
                              beforeSend: function() {
                                   jQuery("span#ajax-load").css({'display':'inline-block'});
                              },
                              
                              error: function(xhr, status, err) {
                                   // Handle errors
                              },
                              
                              success: function(html, data) {
                                
                                   jQuery("div#sform-result").html( html );
                                   
                              }
                  
            }).done(function( html, data ) {
                  jQuery("span#ajax-load").hide();
            }); 
       }
       
       jQuery('table#sortval').sortable({
        
               items: 'tr.sort',
               helper: fixHelper,
               placeholder:'ui-state-highlight',
               stop: function(event, ui){

                     var id = []; 
                     jQuery('input.sform-sort').each( function(key, value) {
                         if( jQuery(this) ){
                             var id_val = jQuery(this).attr('value');
                             id.push( id_val );
                         }
                     });
                     
                     var idval = id.join(','); 
                     
                     ajaxsortSForm( 'ajax_sort_action_sform', idval );
                                       
               }
       });
       
       /**  xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx 
          * ajax sort callback function
          * sort action
            xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
        **/
       
       /**  xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
          * ajax delete callback function
          * delete action
            xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx 
        **/
       
       function ajaxdeleteSForm( call, value){
           
           var ajaxurl = ajax_script.ajax_url;
           
           jQuery.ajax ({
                              data: { action  : call, values : value },
                              
                              type   : 'POST',
                              url    : ajaxurl,
                              
                              beforeSend: function() {
                                   jQuery("span#ajax-load").css({'display':'inline-block'});
                              },
                              
                              error: function(xhr, status, err) {
                                   // Handle errors
                              },
                              
                              success: function(html, data) {
                                
                                   jQuery("div#sform-result").html( html );
                                   
                              }
                  
            }).done(function( html, data ) {
                  jQuery("span#ajax-load").hide();

            }); 
       }
       
       jQuery("input#del_id").click(function(){
               
               var id = []; 
               jQuery('input.sform-checked').each( function(key, value) {
                 if( jQuery(this).is(':checked') ){
                     var id_val = jQuery(this).attr('value');
                     id.push( id_val );
                 }
               }); 
               var idval = id.join(',');
               
               ajaxdeleteSForm( 'ajax_delete_action_sform', idval );
                
       });
       
       /**  xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
          * ajax delete callback function
          * delete action
            xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx 
        **/
       
       jQuery("input#apply_id").click(function(){
               
               var date_filter = jQuery("select#date-filter").val();
               var item_filter = jQuery("select#item-filter").val();
               
               jQuery("tr.status-publish" ).hide();
               
               if( date_filter.length !=0 ){
                   
                   jQuery("tr."+date_filter ).show();
                
               }
               
               if( item_filter.length !=0 ){
                   
                   jQuery("tr."+item_filter ).show();
                
               }
               
               jQuery("tr.quick-form").hide();
               
       });
       
       jQuery("input#all_id").click(function(){
               
               jQuery("tr.status-publish" ).show(); 
                
       });
       
       jQuery("input#sform-settings-btn").click(function(){
               
               
               
       });
       
       jQuery("span.quick-edit-icon").click(function(){
             
               var quick_form = jQuery(this).parent().parent().next();
               
               if( quick_form.is(":visible") == true ){
                   
                   quick_form.hide();
               } else {
                   quick_form.show();
               }  
              
       });
       
       /** xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx 
          * ajax quick callback function
          * quick action
           xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
        **/
       
       function ajaxquickSForm( call, value, id){
           
           var ajaxurl = ajax_script.ajax_url;
           
           jQuery.ajax ({
                              data: { action  : call, values : value, update : id },
                              
                              type   : 'POST',
                              url    : ajaxurl,
                              
                              beforeSend: function() {
                                   jQuery("span#quick-ajax-load").css({'display':'inline-block'});
                              },
                              
                              error: function(xhr, status, err) {
                                   // Handle errors
                              },
                              
                              success: function(html, data) {
                                
                                   jQuery("div#sform-result").html( html );
                                   
                              }
                  
            }).done(function( html, data ) {
                  jQuery("span#quick-ajax-load").hide();
                  
            }); 
       }
       
       jQuery("input.quick-submit-btn").click(function(){
               
               var values = jQuery(this).parent().parent().parent();
               
               var name_val     = values.find("input.quick-name").val();
               var email_val    = values.find("input.quick-email").val();
               var contact_val  = values.find("input.quick-contact").val();
               var date_val     = values.find("input.quick-date").val();
               var short_val    = values.find("textarea.quick-short").val();
               
               var upd_id       = values.find("input.quick-update-id").val();
               
               var client_name  = values.find('input.quick-client-name').val();
               var client_text  = values.find('textarea.quick-message').val();
               
               var sform = [ name_val, email_val, contact_val, date_val, short_val, client_name, client_text ];

               ajaxquickSForm( 'ajax_quick_update_sform', sform, upd_id );
               
               var quick_form_ver = jQuery(this).parent().parent().parent().parent().parent().prev();
               
               quick_form_ver.find("a.list-name").text( name_val );
               quick_form_ver.find("td.column-email").text( email_val );
               quick_form_ver.find("td.column-contact").text( date_val );
               
       });
       
        /** xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx 
          * ajax quick callback function
          * quick action
           xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
        **/
        
        /** xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx 
          * ajax settings callback function
          * settings action
           xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
        **/
        
        function ajaxsettingsSForm( call, value){
           
           var ajaxurl = ajax_script.ajax_url;
           
           jQuery.ajax ({
                              data: { action  : call, values : value },
                              
                              type   : 'POST',
                              url    : ajaxurl,
                              
                              beforeSend: function() {
                                   jQuery("span#ajax-load").css({'display':'inline-block'});
                              },
                              
                              error: function(xhr, status, err) {
                                   // Handle errors
                              },
                              
                              success: function(html, data) {
                                
                                   jQuery("div#sform-result").html( html );
                                   
                              }
                  
            }).done(function( html, data ) {
                  jQuery("span#ajax-load").hide();
                  
            }); 
       }
        
        jQuery("input#sform-settings-btn").click(function(){
             
                var color   = jQuery("input#color-circle").val();
                var radius  = jQuery("input#radius-circle").val();
                
                var bgcolor = jQuery("input#bgcolor-circle").val();
                var width   = jQuery("input#width-circle").val();
                var height  = jQuery("input#height-circle").val();
                
                var text_color = jQuery("input#text-circle").val();
                var text_size  = jQuery("input#size-circle").val();
                var weight     = jQuery("input#weight-circle").val();
                
                var settingsform = [ color, radius, bgcolor, width, height, text_color, text_size, weight ];  
                
                ajaxsettingsSForm( 'ajax_settings_sform', settingsform );
                 
        });
        
        /** xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx 
          * ajax item update form callback function
          * item update form action
           xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
        **/
        
        function ajaxitemSForm( call, value){
           
           var ajaxurl = ajax_script.ajax_url;
           
           jQuery.ajax ({
                              data: { action  : call, values : value },
                              
                              type   : 'POST',
                              url    : ajaxurl,
                              
                              beforeSend: function() {
                                   
                              },
                              
                              error: function(xhr, status, err) {
                                   // Handle errors
                              },
                              
                              success: function(html, data) {
                                
                                   jQuery("div.item-addform").html( html );
                                   
                              }
                  
            }).done(function( html, data ) {
                  
                  
            }); 
       }
        
        jQuery("span.item-edit").live('click',function(){
                
                var item_id = jQuery(this).parent().parent().find('input').val();
                
                ajaxitemSForm( 'ajax_item_sform', item_id );
                
                  
        });
        
        /** xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx 
          * ajax item update form callback function
          * item update form action
           xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
        **/
        
        /** xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx 
          * ajax item insert callback function
          * item insert action
           xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
        **/
        
        function to_slug(Text)
        {
            return Text
                .toLowerCase()
                .replace(/ /g,'-')
                .replace(/[^\w-]+/g,'');
        }
        
        function ajaxiteminsertSForm( call, value){
           
           var html_val = '';
           var ajaxurl  = ajax_script.ajax_url;
           var slug_val = to_slug( value );

           jQuery.ajax ({
                              data: { action  : call, values : value },
                              
                              type   : 'POST',
                              url    : ajaxurl,
                              
                              beforeSend: function() {
                                    jQuery("span#item-ajax-load").css({'display':'inline-block'}); 
                              },
                              
                              error: function(xhr, status, err) {
                                   // Handle errors
                              },
                              
                              success: function(html, data) {
                                
                                   jQuery("div.item-addform").html( '<div class="msg_log_item">'+msg[0]+'</div>' );
                                   jQuery("span#item-ajax-load").css({'display':'none'}); 
                                   
                              }
                  
            }).done(function( html, data ) {
                  
                  html_val += '<li>';
                  html_val += '<div class="icheckbox_square-blue">';
                  html_val += '<input id="square-checkbox-0" type="checkbox" value="'+slug_val+'" tabindex="0" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: none repeat scroll 0% 0% rgb(255, 255, 255); border: 0px none; opacity: 0;">';
                  html_val += '<ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: none repeat scroll 0% 0% rgb(255, 255, 255); border: 0px none; opacity: 0;"></ins>';
                  html_val += '</div>';
                  html_val += '<label class="" for="square-checkbox-0"> '+value+'</label>';
                  html_val += '<div class="item-edit-main"><span class="item-sort"></span><span class="item-edit"></span></div>';
                  html_val += '</li>';
                  
                  jQuery("div.skin-section ul.list").append( html_val );
                  
                  //window.location="admin.php?page=add_new_option_sidebar";
                  
                  jQuery("div.msg_log_item").pause(3000).fadeOut(1200);
                  jQuery("input#item-add").click();
                     
            }); 
            
       }
        
        jQuery("input#item-submit").live('click',function(){
               
               var item_name = jQuery("input#item-name").val();
               
               if( item_name.length != 0 ){ 
                   
                   ajaxiteminsertSForm( 'ajax_item_insert_sform', item_name );
               
               }
                
        });
        
         /** xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx 
          * ajax item insert callback function
          * item insert action
           xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
        **/
        
        /** xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx 
          * ajax item update callback function
          * item update action
           xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
        **/
        
        function ajaxitemupdateSForm( call, name, id){
           
           var html_val = '';
           var ajaxurl  = ajax_script.ajax_url;

           jQuery.ajax ({
                              data: { action  : call, name_val : name, item_id : id },
                              
                              type   : 'POST',
                              url    : ajaxurl,
                              
                              beforeSend: function() {
                                   jQuery("span#item-ajax-load").css({'display':'inline-block'}); 
                              },
                              
                              error: function(xhr, status, err) {
                                   // Handle errors
                              },
                              
                              success: function(html, data) {
                                
                                   jQuery("input#square-checkbox-"+id ).parent().next().text( name );
                                   jQuery("span#item-ajax-load").css({'display':'none'}); 
                                   
                              }
                  
            }).done(function( html, data ) {
                  
                  
                  
            }); 
            
       }
        
        
        jQuery("input#item-update").live('click',function(){
              
              var item_nm = jQuery("input#item-name").val();
              var item_id = jQuery("input#item-id").val();
              
              ajaxitemupdateSForm( 'ajax_item_update_sform', item_nm, item_id );
               
        });
        
        /** xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx 
          * ajax item update callback function
          * item update action
           xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
        **/
        
        /** xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx 
          * ajax item add form callback function
          * item add form action
           xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
        **/
        
        function ajaxitemaddSForm( call){
           
           var html_val = '';
           var ajaxurl  = ajax_script.ajax_url;

           jQuery.ajax ({
                              data: { action  : call },
                              
                              type   : 'POST',
                              url    : ajaxurl,
                              
                              beforeSend: function() {
                                   
                              },
                              
                              error: function(xhr, status, err) {
                                   // Handle errors
                              },
                              
                              success: function(html, data) {
                                
                                   jQuery("div.item-addform").html( html );
                                   
                              }
                  
            }).done(function( html, data ) {
                  
                  
            }); 
            
       }
        
        jQuery("input#item-add").live('click',function(){
          
              var addform = jQuery("div.item-addform");
              
              /**
                
              if( addform.is(":visible") == true ){
                
                  addform.hide();
                  ajaxitemaddSForm( 'ajax_item_add_form_sform' );
                  
              } else {
                  
                  addform.show();
                  ajaxitemaddSForm( 'ajax_item_add_form_sform' );
                  
              }
              
              **/
              
              ajaxitemaddSForm( 'ajax_item_add_form_sform' );
               
        });
        
        /** xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx 
          * ajax item add form callback function
          * item add form action
           xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
        **/
        
        /** xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx 
          * ajax item delete callback function
          * item delete action
           xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
        **/
        
        function ajaxitemdeleteSForm( call, id){
           
           var html_val = '';
           var ajaxurl  = ajax_script.ajax_url;

           jQuery.ajax ({
                              data: { action  : call, id_val : id },
                              
                              type   : 'POST',
                              url    : ajaxurl,
                              
                              beforeSend: function() {
                                   jQuery("span#item-ajax-load").css({'display':'inline-block'}); 
                              },
                              
                              error: function(xhr, status, err) {
                                   // Handle errors
                              },
                              
                              success: function(html, data) {
                                
                                   jQuery("div.item-addform").html( '<div class="msg_log_item">'+msg[2]+'</div>' );
                                   jQuery("span#item-ajax-load").css({'display':'none'}); 
                                   jQuery("input#square-checkbox-"+id).parent().parent().remove();
                              }
                  
            }).done(function( html, data ) {
                  
                  jQuery("div.msg_log_item").pause(3000).fadeOut(1200);
                  jQuery("input#item-add").click();
                    
            }); 
            
       }
        
        jQuery("input#item-delete").live('click',function(){
              
                var item_id = jQuery("input#item-id").val();

                ajaxitemdeleteSForm( 'ajax_item_delete_sform', item_id );

        });
        
        /**  xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
          * ajax callback function
          * item sort update action
            xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
        **/
        
        function ajaxitemsortSForm( call, id){
           
           var html_val = '';
           var ajaxurl  = ajax_script.ajax_url;

           jQuery.ajax ({
                              data: { action  : call, id_val : id },
                              
                              type   : 'POST',
                              url    : ajaxurl,
                              
                              beforeSend: function() {
                                   jQuery("span#item-ajax-load").css({'display':'inline-block'}); 
                              },
                              
                              error: function(xhr, status, err) {
                                   // Handle errors
                              },
                              
                              success: function(html, data) {
                                
                                   jQuery("span#item-ajax-load").css({'display':'none'}); 
                              }
                  
            }).done(function( html, data ) {
                  
                  
            }); 
            
       }
        
        jQuery('ul.list').sortable({
        
               items: 'li.sort',
               helper: fixHelper,
               placeholder:'ui-state-highlight',
               stop: function(event, ui){

                     var id = []; 
                     jQuery('span.item-sort').parent().parent().each( function(key, value) {
                         if( jQuery(this) ){
                             var id_val = jQuery(this).find('input').attr('value');
                             id.push( id_val );
                         }
                     });
                     
                     var idval = id.join(','); 
                     
                     ajaxitemsortSForm( 'ajax_item_sort_sform', idval );
               }
       });
       
       /**  xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
          * ajax callback function
          * item sort update action
            xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
        **/
        
});