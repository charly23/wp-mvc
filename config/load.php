<?php
   
   /**
    *  @Application WP MVC
   **/
   
   /**
    *  System load wp mvc default classes
   **/
   
   /** auto load 
       $system_load = array( 'system-1', 'system-2', 'system-3' );
   **/

   $system_load = array( 'add', 'load', 'input', 'html', 'post', 'money_format', 'widget', 'redirect' ); 

   /** config load 
       $config_load = array( 'config-1', 'config-2', 'config-3' );
   **/
        
   $config_load = array( 'router', 'overloading', 'config', 'autoload' );
   
    /** helper load 
       $helper_load = array( 'helper-1', 'helper-2', 'helper-3' );
   **/
   
   $helper_load = array( 'user-control' );
   
   /**
    *  Model load custom classes
   **/
   
   /** model load 
       $model_load = array( 'model-1', 'model-2', 'model-3' );
   **/
    
   $model_load = array( 'db', 'form', 'pagination' );
    
   /**
    *  Controller load custom classes
   **/

   /** control load 
       $control_load = array( 'control-1', 'control-2', 'control-3' );
   **/
    
   $control_load = array( 'db_action', 'action' );
   
?>