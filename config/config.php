<?php if( !class_exists( 'config' ) ) 
{   
    class config 
    {
         public static $name        = "WP MVC";
         public static $icon        = "wp-mvc/assets/images/Tools_-_common_fixed-14-16.png";
         public static $plugin_slug = 'wp_mvc';
         public static $folder      = 'wp-mvc';
         public static $shortcode   = 'wp_mvc';
         public static $assets      = 'assets';
         
         protected $values          = array();
        
         function __construct() 
         {
                global $wpdb;
                
                add::action_page( array( $this, 'admin_page' ) );
                
                /** backend style ( admin ) **/
                 
                add::style( true, self::$plugin_slug.__( 'admin-style', 'wp-raffle' ), self::$folder.'/'.self::$assets.'/css/admin.css' );
                
                
                /** frontend style ( front ) **/
                
                add::style( false, self::$plugin_slug.__( 'front-style', 'wp-raffle' ), self::$folder.'/'.self::$assets.'/css/front.css' );
                
                /** backend script **/
                
                add::wp_script( 'jquery' );
                add::wp_script( 'jquery-ui-sortable' );
                add::wp_script( 'jquery-ui-draggable' );
                add::wp_script( 'jquery-ui-droppable' );
                
                add::wp_script( 'jquery-ui-core' );
                add::wp_script( 'jquery-ui-dialog' );
                add::wp_script( 'jquery-ui-slider' );
                
                add::script( true, self::$plugin_slug.'admin-script', self::$folder.'/'.self::$assets.'/js/admin.js' );
                add::script( true, self::$plugin_slug.'sort-script', self::$folder.'/'.self::$assets.'/js/sort.js' );
                
                add::script( true, self::$plugin_slug.'ajax_handler', self::$folder.'/'.self::$assets.'/js/ajax.js' );
                add::localize_script( true, self::$plugin_slug.'ajax_handler', 'ajax_script', self::get_localize_script_arrays() );
                
                /** frontend script  **/
                
                add::script( false, self::$plugin_slug.'front-script', self::$folder.'/'.self::$assets.'/js/front.js' );
                
                /** actions method -- **/
                
                add::action_submit( 1, array( $this, 'action_handler' ) );
                
                /** actions option ( callback ) **/
                
                add::action_loaded( array( $this,'update_db_check' ) );
                
                /** actions shortcode ( callback ) **/
                
                add::shortcode( self::$shortcode.'_shortcode_randoms', array( $this, self::$shortcode.'_randoms' ) );
                add::shortcode( self::$shortcode.'_shortcode_times', array( $this, self::$shortcode.'_times' ) );
                add::shortcode( self::$shortcode.'_shortcode_events', array( $this, self::$shortcode.'_events' ) ); 
                add::shortcode( self::$shortcode.'_shortcode_prizes', array( $this, self::$shortcode.'_prizes' ) );  
                
                /** actions ajax actions ( callback ) **/
              
                add::action_ajax( array( $this, 'ajaxs_handler' ) ); 

                /** actions widget ( create ) **/
                
                add::widget_init( array( $this, 'register_widgets' ) );
         }
         
         public static function get_localize_script_arrays () 
         {
                return array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'admin_url' => admin_url() );   
         }
         
         public static function install () 
         {
                global $wpdb;
                    
                $tbl = $wpdb->prefix . __( 'wpmvc','wp-mvc' );
                    
                $charset_collate = $wpdb->get_charset_collate();
                    
                require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
                
                $sql_1 = "";
                $sqls = array( $sql_1 );
                
                if( isset( $sqls ) and is_array( $sqls ) ) foreach( $sqls as $sql ) : 
                        
                dbDelta( $sql ); 

                endforeach;
                
                self::dbDelta_alters( array( $tbl ) );
                
         }
         
         public static function dbDelta_alters ( $tbls=array() ) 
         {
                global $wpdb;
                
                require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
                
                if( is_array( $tbls ) ) : foreach( $tbls as $tbls_keys => $tbls_res ) :
                    $alts = null;  
                    dbDelta( $alts ); 
                endforeach; 

                endif;  
         }
         
         /**
          * Actions submits functions
          * events
         **/
         
         public function action_handler () 
         {
            action::add_tickets();          
         }
         
         /**
            WP register widgtet
         **/
         
         public function register_widgets () 
         {
            register_widget( 'Add_Widget' );
         }

        // END
    }    
    
}
?>