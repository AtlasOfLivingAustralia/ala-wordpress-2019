<?php
add_action( 'admin_head', 'pvtl_admin_theme_styles' );

function pvtl_admin_theme_styles()
{
?>
    <style>
        /* Increase the width of the Goots */
        .wp-block { max-width: 1000px; }

        /* Adds a class we can use in ACF, to right align multiple fields */
        .acf-pull-right {
            clear: none !important;
            float: right !important;
            min-height: 40px !important;
            border-left: 1px solid #eeeeee !important;
        }

        /* Adds a class we can use in ACF to have WYSIWYG editors that aren't so huge */
        .tiniest-mce iframe {
            height: 200px !important;
        }

        /* We hopefully won't need this long term */
        .acf-fields>.acf-tab-wrap:first-child .acf-tab-group { padding: 5px 5px 0 5px; }
    </style>
<?php
}
