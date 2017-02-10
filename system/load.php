<?php if( !class_exists( 'load' ) or die( '( load ) class file error excute ' ) ) 
{    
     class load 
     {
          
          public static $load  = array( 'view', 'model', 'helper' );
          public static $slash = array( "/", ".php" );
          
          public static $str   = "";
          public static $val   = null;
          public static $int   = 0;
          
          /** 
            * file loader - VIEW
            * @param  - ( {VIEW}/{PARAM} )
            * @return - location ( string )    
          **/
          
          public static function view ( $name=null, $atts=null ) 
          {
                $view      = array_shift( array_values( self::$load ) );
                $slash_val = array_shift( array_values( self::$slash ) );
                $php_val   = end( self::$slash );
                
                if( !is_null( $name ) and !empty( $name ) && is_dir( dirname( dirname( __FILE__ ) ) ) ) :

                    $file = dirname( dirname( __FILE__ ) ) . $slash_val . $view. $slash_val . __( $name ) . $php_val;
                    if( file_exists( $file ) ) require_once $file;
                    
                endif;
          } 
          
          /** 
            * file loader - MODEL
            * @param - ( {MODEL}/{PARAM} )
            * @return - location ( string )     
          **/
          
          public static function model ( $name=null ) 
          {
                end( self::$load ); 
                
                $helper    = prev( self::$load );
                $slash_val = array_shift( array_values( self::$slash ) );
                $php_val   = end( self::$slash );

                if( !is_null( $name ) and !empty( $name ) && is_dir( dirname( dirname( __FILE__ ) ) ) ) :

                    $file = dirname( dirname( __FILE__ ) ) . $slash_val . $helper. $slash_val . __( $name ) . $php_val;
                    if( file_exists( $file ) ) require_once $file;
                    
                endif;
          } 
          
          /** 
            * file loader - HELPER
            * @param - ( {HELPER}/{PARAM} )
            * @return - location ( string )     
          **/
          
          public static function helper ( $name=null )
          {
                $helper    = end( self::$load );
                $slash_val = array_shift( array_values( self::$slash ) );
                $php_val   = end( self::$slash );

                if( !is_null( $name ) and !empty( $name ) && is_dir( dirname( dirname( __FILE__ ) ) ) ) :

                    $file = dirname( dirname( __FILE__ ) ) . $slash_val . $helper . $slash_val . __( $name ) . $php_val;
                    if( file_exists( $file ) ) require_once $file;
                    
                endif;
          }
          
          /** 
            * file loader - CONTROL
            * @param - ( {CONTROL}/{PARAM} )  
            * @return - location ( string )   
          **/
          
          public static function control ( $name=null ) 
          {
                $control   = "controllers";
                $slash_val = array_shift( array_values( self::$slash ) );
                $php_val   = end( self::$slash );
                
                if( !is_null( $name ) and !empty( $name ) && is_dir( dirname( dirname( __FILE__ ) ) ) ) :
                
                    $file = dirname( dirname( __FILE__ ) ) . $slash_val . $control . $slash_val . __( $name ) . $php_val;
                    if( file_exists( $file ) ) require_once $file; 
                    
                endif;
          }
          
          public static function includes_file ( $path=null, $tags=null ) 
          {
                $file = dirname( dirname( __FILE__ ) );
                $php_val = end( self::$slash );   
                if( !is_null( $path ) ) {
                    include_once ( $file ) . __( $path.$php_val, $tags );       
                } 
          }

          // END
     }
}
?>