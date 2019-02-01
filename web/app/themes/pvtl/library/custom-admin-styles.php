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

		.is-style-standard-button .wp-block-button__link, .is-style-outline-button .wp-block-button__link {
			font-family: 'Roboto', sans-serif;
			display: inline-block;
			font-weight: 400;
			text-align: center;
			white-space: nowrap;
			vertical-align: middle;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
			border: 1px solid transparent;
			padding: 5px 30px;
			font-size: 18px;
			line-height: 1.5;
			border-radius: 0;
			-webkit-transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
			transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out; }
		.is-style-standard-button .wp-block-button__link {
			color: #fff;
			background-color: #c44d34;
			border-color: currentColor; }
		.is-style-standard-button .wp-block-button__link:hover {
			color: #fff !important;
			background-color: #a6412c !important;
			border-color: currentColor !important; }
		.is-style-outline-button .wp-block-button__link {
			color: #c44d34;
			background-color: transparent !important;
			background-image: none;
			border-color: currentColor; }
		.is-style-outline-button .wp-block-button__link:hover {
			color: #fff !important;
			background-color: #c44d34 !important;
			border-color: #c44d34 !important; }
    </style>
<?php
}
