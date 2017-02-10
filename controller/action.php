<?php if( ! class_exists( 'action' ) ) 
{
    
     class action extends db_action
     {
          
          public static $tbls = array( '_tickets', '_events', '_user', '_prizes' );
          
          // action event submit - tickets
          // user the querys at the top
          
          public static function ticket_select ()
          {
                global $wpdb;
                
                $inputs = input::post_is_object();
                
                $id = user_control::get_id();
                
                $qtys_value = db::ticket_get_values( 'qty', $inputs->value )-1;
                $ords_value = db::ticket_get_values( 'orders', $inputs->value )+1;
                
                self::updates( 
                    'raffle'.self::$tbls[0],
                    array( 'orders' => $ords_value, 'qty' => $qtys_value ),
                    array( 'id' => intval( $inputs->value ) ),
                    array( '%d', '%d' ),
                    array( '%d' ) 
                );
                
                $user_id_exists = db::user_id_exists( 'user_id', $id );
                $ticket_id_exists = db::user_id_exists( 'ticket_id', $inputs->value );

                if( $user_id_exists != true ) 
                {
                    
                    self::inserts(
                        'raffle'.self::$tbls[2],
                        array( 
                            'user_id' => $id, 
                            'ticket_id' => $inputs->value, 
                            'value' => 1 
                        ),
                        array( '%d', '%d', '%d' )
                    );
                    
                    _e( '<p>access submit - 1</p>', 'wp_raffle_submit_message' );
                           
                } else {
                    
                    $user_filer = db::user_id_exists_filter( $id, $inputs->value );
                    
                    if( $ticket_id_exists != true ) 
                    {
                        
                        self::inserts(
                            'raffle'.self::$tbls[2],
                            array( 
                                'user_id' => $id, 
                                'ticket_id' => $inputs->value, 
                                'value' => 1 
                            ),
                            array( '%d', '%d', '%d' )
                        );  
                        
                        _e( '<p>access submit - 2</p>', 'wp_raffle_submit_message' );
                          
                    } else {
                        
                        if( ! $user_filer ) 
                        {
                            
                            self::inserts(
                                'raffle'.self::$tbls[2],
                                array( 
                                    'user_id' => $id, 
                                    'ticket_id' => $inputs->value, 
                                    'value' => 1 
                                ),
                                array( '%d', '%d', '%d' )
                            );
                            
                            _e( '<p>access submit - 3</p>', 'wp_raffle_submit_message' );
                                  
                        } else {
                            
                            $values = db::user_get_values_filter( 'value', $id, $inputs->value );
                            
                            self::updates( 
                                'raffle'.self::$tbls[2],
                                array( 'value' => $values+1 ),
                                array( 'user_id' => $id, 'ticket_id' => intval( $inputs->value ) ),
                                array( '%d' ),
                                array( '%d', '%d' ) 
                            );
                            
                            _e( '<p>access submit - 4</p>', 'wp_raffle_submit_message' );
                        } 
                            
                    }

                }

          }

          // action event submit - tickets
          // user the querys at the top
          // END

          /**
            * timer action event
            * control submit element objects
          **/
          
          public static function set_timer ()
          {
                global $wpdb;
                
                $inputs = input::post_is_object();
                
                $is_status = $inputs->value['time'] != '0000-00-00 00:00:00' ? 1 : 0;

                self::updates( 
                    'raffle'.self::$tbls[1],
                    array( 'time' => $inputs->value['time'], 'time_set' => $is_status ),
                    array( 'id' => intval( $inputs->value['id'] ) ),
                    array( '%s', '%d' ),
                    array( '%d' ) 
                );
          }
          
          public static function selected_randoms ()
          {
                global $wpdb;
                
                $html = null;
                
                $inputs = input::post_is_object();    
                $html .= db::timer_get_data(1);

                echo $html;
          }

          /**
            * timer action event
            * control submit element objects
            * END
          **/

          /**
            * tickets action event
            * control submit element objects
          **/
          
          public static function add_tickets () 
          {
                global $wpdb;
                
                $inputs = input::post_is_object();  
                $id     = input::get_is_object_element( 'edit_tickets' );
                
                if( isset( $inputs->submit_tickets ) ) 
                {
                    
                    if( $id != 0 ) 
                    {

                        self::updates( 
                            'raffle'.self::$tbls[0],
                            array( 
                                'event_id' => $inputs->event_selects,
                                'num' => 1, 
                                'time' => $inputs->time_inputs, 
                                'name' => $inputs->name_inputs,
                                'text' => $inputs->descr_inputs,
                                'url' => $inputs->url_inputs,
                                'price' => $inputs->price_inputs,
                                'qty' => $inputs->quantity_inputs
                            ),
                            array( 'id' => intval( $id ) ),
                            array( '%d', '%d', '%s', '%s', '%s', '%s', '%d', '%d' ),
                            array( '%d' ) 
                        );

                    } else {

                        $validate = form::tickets_form_validate( $inputs );

                        if( !in_array( false, $validate )) 
                        {

                            self::inserts(
                                'raffle'.self::$tbls[0],
                                array( 
                                    'event_id' => $inputs->event_selects,
                                    'num' => 1, 
                                    'time' => $inputs->time_inputs, 
                                    'name' => $inputs->name_inputs,
                                    'text' => $inputs->descr_inputs,
                                    'url' => $inputs->url_inputs,
                                    'price' => $inputs->price_inputs,
                                    'qty' => $inputs->quantity_inputs
                                ),
                                array( '%d', '%d', '%s', '%s', '%s', '%s', '%d', '%d' )
                            );

                        }

                    }

                }
          }

          public static function delete_tickets () 
          {
                global $wpdb;  

                $id = input::get_is_object_element( 'delete_tickets' );

                if( isset( $inputs->delete_tickets ) ) 
                {

                    if( $id != 0 ) 
                    {

                        self::deletes( 
                            'raffle'.self::$tbls[0],
                            array( 'id' => intval( $id ) ),
                            array( '%d' ) 
                        );

                        redirect::filter( page_rounter::url( 'wp_raffle', false ) );
                    }
                }
          }

          /**
            * tickets action event
            * control submit element objects 
            * END
          **/

          /**
            * events action event
            * control submit element objects
          **/

          public static function add_events () 
          {
                global $wpdb;
                
                $inputs = input::post_is_object();  
                $id     = input::get_is_object_element( 'edit_events' );
                
                if( isset( $inputs->submit_events ) ) 
                {
                    
                    if( $id != 0 ) 
                    {
                        self::updates( 
                            'raffle'.self::$tbls[1],
                            array( 
                                'num' => 1, 
                                'time' => $inputs->time_inputs, 
                                'name' => $inputs->name_inputs,
                                'text' => $inputs->descr_inputs,
                                'url' => $inputs->url_inputs
                            ),
                            array( 'id' => intval( $id ) ),
                            array( '%d', '%s', '%s', '%s', '%s' ),
                            array( '%d' ) 
                        );

                    } else {

                        $validate = form::events_form_validate( $inputs );

                        if( !in_array( false, $validate )) 
                        {
                            // actions
                            self::inserts(
                                'raffle'.self::$tbls[1],
                                array( 
                                    'num' => 1, 
                                    'time' => $inputs->time_inputs, 
                                    'name' => $inputs->name_inputs,
                                    'text' => $inputs->descr_inputs,
                                    'url' => $inputs->url_inputs
                                ),
                                array( '%d', '%s', '%s', '%s', '%s' )
                            );
                        }
                    }
                }
          }

          public static function delete_events () 
          {
                global $wpdb;  

                $inputs = input::get_is_object();
                $id = input::get_is_object_element( 'delete_events' );

                if( isset( $inputs->delete_events ) ) 
                {

                    if( $id != 0 ) 
                    {

                        self::deletes( 
                            'raffle'.self::$tbls[1],
                            array( 'id' => intval( $id ) ),
                            array( '%d' ) 
                        );

                        redirect::filter( page_rounter::url( 'wp_raffle', false ) );

                    }
                }
          } 

          /**
            * events action event
            * control submit element objects 
            * END
          **/

          
     }
}
?>