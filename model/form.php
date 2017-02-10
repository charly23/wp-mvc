<?php if( !class_exists( 'form' ) or die ( 'error found.' ) ) 
{    
    class form extends input
    {
          public function __construct() 
          {
               parent::__construct();
          }

          public static function form () 
          {
               // handler
          }
    }
}
?>