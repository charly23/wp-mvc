<?php

$userdata = get_userdata( get_current_user_id() );

?>

<div id="wp-mvc">

    <?php
        $user_role = user_control::get_role();
    ?>

    <?php
        load::view( 'template/page-tpl' );
    ?>
    
</div>

