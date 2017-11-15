<?php

function es_enqueue(){
    wp_register_style( 'es_bootstrap',get_template_directory_uri() . '/assets/src/css/bootstrap.css'); 
    wp_register_style( 'es_main',get_template_directory_uri() . '/assets/src/css/style.css'); 
    wp_register_style( 'es_font',get_template_directory_uri() . '/assets/src/css/font-awesome.min.css');

    wp_enqueue_style('es_bootstrap');
    wp_enqueue_style('es_main');
    wp_enqueue_style('es_font');

    wp_register_script('es_jquery', get_template_directory_uri().'/assets/src/js/jquery.min.js');
    wp_register_script('es_popper' , get_template_directory_uri().'/assets/src/js/popper.min.js');
    wp_register_script('es_bootstrap' , get_template_directory_uri().'/assets/src/js/bootstrap.min.js');

    wp_enqueue_script('es_jquery');
    wp_enqueue_script('es_popper');
    wp_enqueue_script('es_bootstrap');

}