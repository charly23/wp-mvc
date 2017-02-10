<?php if( !class_exists( 'shortcode' ) ) 
{    
    class shortcode 
    {
        public static function page ()
        {
            load::view( 'shortcode/template/page' );
            
            $html = null;
            $html .= page_objects::template();
            
            return $html;
        }

    }
}

new shortcode();

?>