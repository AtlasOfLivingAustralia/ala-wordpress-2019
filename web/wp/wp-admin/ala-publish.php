<?php
/**
 * ALA Publish Administration Screen
 *
 * @package WordPress
 * @subpackage Administration
 */

/** Load WordPress Bootstrap */
require_once __DIR__ . '/admin.php';

if ( ! current_user_can( 'publish_pages' ) ) {
	wp_die( __( 'Sorry, you are not allowed to export this site.' ) );
}

$publish_file = get_stylesheet_directory() . '/publish/publish.txt';

function ala_static_publish_get_history() {
    // get publish history

	// history.csv is a CSV with columns: starttime, username, status ('generating', 'syncing', 'git', 'completed'), endtime (empty unless 'completed').
	// display most recent 10? like:
	// <li><strong>[starttime] by [username] &dash; [status]... </strong></li>
	// <li>[Date time] by [username] &dash; completed at [endtime] ([] min [] sec).</li>
    $history_file = get_stylesheet_directory() . '/publish/history.csv';

    if(file_exists($history_file)){
        // return file_get_contents($history_file);
        $history_csv = array_map('str_getcsv', file($history_file));
        // convert array into one item per row, keyed by colname
        array_walk($history_csv, function(&$a) use ($history_csv) {
	      $a = array_combine($history_csv[0], $a);
	    });
	    array_shift($history_csv); # remove column header
	    // print_r($history_csv);
	    // reverse so most recent is first
	    $history_csv = array_reverse($history_csv);
	    $history_html = '<ul>';
	    foreach($history_csv as $pubevent) {
	    	if ($pubevent['status'] == 'completed') {
	    		$history_html .= '<li>'.$pubevent['starttime'].' by '.$pubevent['username'].' &dash; completed at '.$pubevent['endtime'].'</li>';
	    	} else {
			    $history_html .= '<li><strong>'.$pubevent['starttime'].' by '.$pubevent['username'].' &dash; '.$pubevent['status'].'...</strong></li>';
			}
		}
		$history_html .= '</ul>';
		return $history_html;
    } else {
        $default_content = "";
        file_put_contents($history_file, $default_content);
        return $default_content;
    }
}

function ala_static_publish_do_publish() {
    // publish: export from WordPress, sync, push
    global $publish_file;

    if(!file_exists($publish_file)){
    	$current_user = wp_get_current_user();
        $publish_content = esc_html( $current_user->display_name );
        file_put_contents($publish_file, $publish_content);
        wp_redirect( admin_url( 'ala-publish.php' ) );
        die();
    }
}

if ( isset( $_POST['ALAexport'] )  ) {
	ala_static_publish_do_publish();
}

require_once ABSPATH . 'wp-admin/admin-header.php';
?> 
<div class="wrap">
<h1><?php echo esc_html( $title ); ?></h1>

<p><?php _e( 'When you click the button below, it will start an export from this WordPress site to update the public static site.' ); ?></p>
<p><?php _e( 'It can take up to a minute for the publish to start. Publishing typically takes around 7 minutes. ' ); ?></p>
<p><?php _e( 'You can see the progress below by refreshing this page. Stages include "generating", "syncing", "git", and "completed".' ); ?></p>
<p><?php _e( 'After the publish is completed, it can take up to two minutes before it is publicly visible on the static site.' ); ?></p>

<form method="post" action="ala-publish.php" name="form" novalidate="novalidate">
	<?php if(!file_exists($publish_file)){ ?>	
<input type="hidden" name="ALAexport" value="true" />
<?php wp_nonce_field( 'ala-publish' ); ?>
<?php submit_button( __( 'Publish to static site' ) ); ?>
	<?php } else { ?>
<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" disabled value="Publish to static site"></p>
<div class="updated notice"><p>A publish by <?php echo file_get_contents($publish_file); ?> is in progress.</p></div>
	<?php } ?>
</form>
</div>

<h2><?php _e( 'Publish history' ); ?></h2>

<?php echo ala_static_publish_get_history(); ?>

<?php require_once ABSPATH . 'wp-admin/admin-footer.php'; ?>
