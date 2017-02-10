<?php if( !class_exists( 'user_control' ) ) 
{    
    class user_control
    {
        public function get_all()
        {
            return wp_get_current_user();    
        }
        public function get_id()
        {
            return wp_get_current_user()->data->ID;
        }
        public function get_user_login()
        {
            return wp_get_current_user()->data->user_login;
        }
        public function get_role()
        {
            return wp_get_current_user()->roles[0];
        }
            
    }
}