<?php

function wporg_custom_post_type()
{
    register_post_type('wporg_product',
                       [
                           'labels'      => [
                               'name'          => __('Products'),
                               'singular_name' => __('Product'),
                           ],
                           'public'      => true,
                           'has_archive' => true,
                       ]
    );
}
