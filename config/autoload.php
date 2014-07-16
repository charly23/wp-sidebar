<?php if(!class_exists('sidebar_page')){
    
    class sidebar_page{
        
        public static $name        = "Sidebar";
        
        public static $icon        = "sidebar/images/1403848361_layout_select_sidebar.png";
        
        public static $plugin_slug = 'sidebar';
        
        public static $folder      = 'sidebar';
        
        function __construct(){
              //parent::__construct();
              spl_autoload_register( array( $this, 'autoload' ) );
        } 
        
        function autoload(){
              
              add::action_page( array($this, 'admin_page') );
              
              /**
                * Backend Style
              **/
                 
              add::style(true, self::$plugin_slug.'admin-style', self::$folder.'/css/admin.css' );
    
              
              /**
               * Front Style
              **/
              
              add::style(false, self::$plugin_slug.'front-style', self::$folder.'/css/front.css' );
                
              /**
                * Backend Script 
              **/
    
              add::wp_script('jQuery');
              add::wp_script('jquery-ui-sortable');
              add::wp_script('jquery-ui-draggable');
              add::wp_script('jquery-ui-droppable');
              
              add::wp_script('jquery-ui-core');
              add::wp_script('jquery-ui-dialog');
              add::wp_script('jquery-ui-slider');
              
              add::script(true, self::$plugin_slug.'admin-script', self::$folder.'/js/admin.js' );
              add::script(true, self::$plugin_slug.'sort-script', self::$folder.'/js/sort.js' );
              
              add::script(true, self::$plugin_slug.'ajax_handler', self::$folder.'/js/ajax.js' );
              add::localize_script( true, self::$plugin_slug.'ajax_handler', 'ajax_script', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
              
              
              /**
                * Frontend Script 
              **/
              
              add::script(false, self::$plugin_slug.'front-script', self::$folder.'/js/front.js' );
              add::script(false, 'front_ajax_handler', self::$folder.'/js/front-ajax.js' );
              add::localize_script( false, 'front_ajax_handler', 'ajax_call', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
    
              // actions option
              
              add::action_loaded( array($this,'update_db_check') );
              
              // actions shortcode callback
              
              add::shortcode('sidebar', array($this,'shortcode_sidebar_function') );
              
              /**
               *  Sidebar Extention Jquery
              **/
              
              add::script(false, self::$plugin_slug.'jquery-ns-min-script', self::$folder.'/js/jquery.min.js' );
              //add::script(false, self::$plugin_slug.'demo-ns-min-script', self::$folder.'/js/sidebar/demo-ns.min.js.pagespeed.jm.WOFKUnhr_k.js' );
              //add::script(false, self::$plugin_slug.'ga-ns-min-script', self::$folder.'/js/sidebar/ga.js' );
              
              //add::style(false, self::$plugin_slug.'A-demo-main-style', self::$folder.'/css/A.demo-main.css.pagespeed.cf.MtbrdlntKg.css' );
              
              /**
               *  Sidebar Extention Datepicker
              **/
              
              /** add::script(true, self::$plugin_slug.'datepicker-script', self::$folder.'/js/datepicker/datepicker.js' );
              add::script(true, self::$plugin_slug.'eye-script', self::$folder.'/js/datepicker/eye.js' );
              add::script(true, self::$plugin_slug.'layout-script', self::$folder.'/js/datepicker/layout.js' );
              add::script(true, self::$plugin_slug.'utils-script', self::$folder.'/js/datepicker/utils.js' );
              
              add::style(true, self::$plugin_slug.'datepicker-style', self::$folder.'/css/datepicker/datepicker.css' );
              add::style(true, self::$plugin_slug.'layout-style', self::$folder.'/css/datepicker/layout.css' ); **/
              
              add::wp_script('jquery-ui-datepicker');
              wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');

              
              /**
               *  Sidebar Extention ICheck
              **/
              
              add::script(true, self::$plugin_slug.'icheck-script', self::$folder.'/js/icheck/icheck.js' );
              //add::script(true, self::$plugin_slug.'icheck-custom-script', self::$folder.'/js/icheck/custom.min.js' );
              
              add::style(true, self::$plugin_slug.'icheck-all-style', self::$folder.'/css/icheck/all.css' );
              add::style(true, self::$plugin_slug.'icheck-blue-style', self::$folder.'/css/icheck/blue.css' );
              add::style(true, self::$plugin_slug.'icheck-custom-style', self::$folder.'/css/icheck/custom.css' );
              
              /**
               *  Ajax callback function
              **/
              
              add::action_ajax( array($this,'ajax_action_sform') );
              add::action_ajax( array($this,'ajax_sort_action_sform'));
              add::action_ajax( array($this,'ajax_delete_action_sform'));
              add::action_ajax( array($this,'ajax_quick_update_sform' ));
              add::action_ajax( array($this,'ajax_settings_sform') );
              
              add::action_ajax( array($this,'ajax_item_sform') );
              add::action_ajax( array($this,'ajax_item_insert_sform'));
              add::action_ajax( array($this,'ajax_item_update_sform'));
              add::action_ajax( array($this,'ajax_item_sort_sform'));
              add::action_ajax( array($this,'ajax_item_delete_sform'));
              add::action_ajax( array($this,'ajax_item_add_form_sform') );
              
              /**
               *  Colorpicker
              **/
              
              wp_enqueue_style( 'wp-color-picker' ); 
              wp_enqueue_script( 'colorpicker-script', plugins_url( self::$folder.'/js/colorpicker.js' ), array( 'wp-color-picker' ), false, true ); 
              
              /**
               *  Redactor
              **/
              
              add::script(true, self::$plugin_slug.'redactor-wysiwyg-script', self::$folder.'/js/advanced.js' ); 
              add::script(true, self::$plugin_slug.'redactor-script', self::$folder.'/js/redactor.js' ); 
              
              add::style(true, self::$plugin_slug.'redactor-wysiwyg-style', self::$folder.'/css/advanced.css' );
              add::style(true, self::$plugin_slug.'redactor-style', self::$folder.'/css/redactor.css' );
              
              add_action('wp_footer', array($this,'footer_function'));

        } 
        
        public function admin_page(){
            
            /** $menu[] = array( self::$name, self::$name, 1, self::$plugin_slug, array( $this,  self::$plugin_slug.'_function'), self::$icon );
                $menu[] = array( 'Client', 'Client', 1, self::$plugin_slug, 'add_new_option_'.self::$plugin_slug, array( $this, 'add_new_option_'.self::$plugin_slug.'_function' ) );
            **/
            
            $menu[] = array( 'Checklist Sidebar', 'Checklist Sidebar', 1, 'add_new_option_'.self::$plugin_slug, array( $this, 'add_new_option_'.self::$plugin_slug.'_function' ), self::$icon );
            $menu[] = array( 'Settings', 'Settings', 1, 'add_new_option_'.self::$plugin_slug, 'settings_'.self::$plugin_slug, array( $this, 'settings_'.self::$plugin_slug.'_function' ) );
        
            if( is_array( $menu )){
                add::load_menu_page( $menu );
            }
        }
        
        public function update_db_check() {
            global $db_version;
            if (get_site_option( 'db_version' ) != $db_version) {
                self::install();
            }
        }
        
        public static function install(){
            global $wpdb;
            
            // dbDelta
            
            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            
            $table1 = $wpdb->prefix . "sidebar_client";
            
            $sql1 = "CREATE TABLE $table1 (
                      id int(9) NOT NULL AUTO_INCREMENT,
                      client_name text NOT NULL,
                      client_text text NOT NULL,
                      name text NOT NULL,
                      email text NOT NULL,
                      contact text NOT NULL,
                      date text NOT NULL,
                      checkbox_items text NOT NULL,
                      short_details text NOT NULL,
                      `sort` int(9) NOT NULL
                      UNIQUE KEY id (id)
                    );";
        
             dbDelta( $sql1 ); 
             
             $table2 = $wpdb->prefix . "sidebar_items";
            
             $sql2 = "CREATE TABLE $table2 (
                       id int(9) NOT NULL AUTO_INCREMENT,
                       name text NOT NULL,
                       slug text NOT NULL,
                       `sort` int(9) NOT NULL,
                       UNIQUE KEY id (id)
                    );";
        
              dbDelta( $sql2 ); 

        }
        
        // view 
        
        public function sidebar_function(){
            load::view('manage');
        }
        
        public function add_new_option_sidebar_function(){
            load::view('add');
        }
        
        public function settings_sidebar_function(){
            load::view('setting');
        }
        
        public function help_sidebar_function(){
            load::view('help');
        }
        
        // shortcode
        
        public function shortcode_sidebar_function(){
            load::view('shortcode/shortcode');
            return display();
        }
        
        // ajax
        
        public function ajax_action_sform(){
            action::sform_insert(); 
            die();
        }
        
        public function ajax_delete_action_sform(){
            action::sform_delete(); 
            die();
        }
        
        public function ajax_sort_action_sform(){
            action::sform_sort(); 
            die();
        }
        
        public function ajax_quick_update_sform(){
            action::sform_quick(); 
            die();  
        }
        
        public function ajax_settings_sform(){
            action::settings_option(); 
            die();
        }
        
        public function ajax_item_sform(){
            action::item_updateform(); 
            die();
        }
        
        public function ajax_item_insert_sform(){
            action::item_insert();
            die();
        }
        
        public function ajax_item_update_sform(){
            action::item_update();
            die();
        }
        
        public function ajax_item_sort_sform(){
            action::item_sort();
            die();
        }
        
        public function ajax_item_delete_sform(){
            action::item_delete();
            die();  
        }
        
        public function ajax_item_add_form_sform(){
            action::item_addform();
            die();
        }
        
        /** xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
         *  WP Footer filter action
         *  xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
        **/
        
        function footer_function() {
            
             load::view('filter/footer');
             return footer_display();
             
        }
    
    }
    
    $sidebar_page = new sidebar_page();

}  
?>