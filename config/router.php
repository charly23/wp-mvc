<?php

/**
 * @author charly capillanes
 * @copyright 2016
 */  

if( !class_exists( 'router' ) or die ( 'page rounter url' ) ) 
    {
        class router 
        {
            public static $wp_admin_page_querys = 'admin.php?page=';
            public static $wp_raffle_url = 'admin.php?page=wp_raffle';
            public static $wp_base_url = 'admin.php?page=wp_raffle';
            public static $wp_raffle_table = 'wp_raffle';

            public static $limit = 10;
            public static $offset = -1;

            public static $wp_separate = '&&';
        }
    }

?>

<?php if( !class_exists( 'page_rounter' ) or die ( 'page rounter url' ) ) 
{
    class page_rounter extends router
    {
        
        public static function url ( $path=null, $querys=array() )
        {
            $results = null;
            $url = $path;

            if( !empty( $querys) AND is_array( $querys) ) 
            {
                foreach( $querys as $keys => $elements )  
                {
                    $results .= "{$keys}={$elements}";               
                }
            }

            if( $querys !=false ) {
                $results_values = self::$wp_separate . __( $results, 'wp-router' );    
            } else  {
                $results_values = null;    
            }
            
            return self::$wp_admin_page_querys.__( $url, 'wp-router' ). __( $results_values, 'wp-router' ); 
        }

    }

    new page_rounter(true);
}

?>