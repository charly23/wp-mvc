<?php if( !class_exists( 'sanitize') or die ( 'error found.' ) ) 
{
    
     class sanitize 
     {
         
         public static function ent2ncr ( $text=null ) 
         {
             return ent2ncr ( $text );
         }
         
         // text nodes
         
         public static function esc_html ( $text=null )
         {
             return esc_html ( $text );
         }
         
         public static function esc_textarea ( $text=null )
         {
             return esc_textarea ( $text );
         }
         
         public static function sanitize_text_field ( $str=null )
         {
             return sanitize_text_field ( $str );
         }
         
         // attribute node
         
         public static function esc_attr ( $str=null )
         {
             return esc_attr ( $str );
         }
         
         // javascript
         
         public static function esc_js ( $text=null ) 
         {
             return esc_js ( $text );
         }
         
         // slugs
         
         public static function sanitize_title ( $title=null )
         {
             return sanitize_title ( $title );
         }
         
         public static function sanitize_user ( $username=null, $strict=false )
         {
             return sanitize_user ( $username, $strict );
         }
     }
}
?>