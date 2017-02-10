<?php if( !class_exists( 'events_objects' ) ) 
{    
    class page_objects 
    {
        public static function template () 
        {
            $html = null;
            $html .= 'hello world?';
            
            return $html;
            
        }       
    }
}
?>