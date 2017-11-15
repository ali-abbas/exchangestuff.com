<?php

function es_widgets(){

    register_sidebar( array(
        'name' => __( 'Main Sidebar', 'ExchangeStuff' ),
        'id' => 'sidebar-1',
        'description' => __( 'Exchange stuff side bar', 'Exchangestuff' )
    ) );

}