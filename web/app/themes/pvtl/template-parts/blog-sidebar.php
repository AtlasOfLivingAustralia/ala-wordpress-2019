<!-- blog sidebar -->
<article>
	<h3>ALA Newsletters</h3>
	<ul>
<?php
	$sideargs  = array(
	    'posts_per_page'  => 10,
	    'offset'          => 0,
	    'category_name'   => 'newsletter',
	    'tag'             => 'newsletter',
	    'orderby'         => 'post_date',
	    'order'           => 'DESC',
	    'post_type'       => 'post',
	    'post_status'     => 'publish',
	    'suppress_filters' => true ); 
	$sideposts = get_posts($sideargs);
    foreach ($sideposts as $post) :
    ?>
		<li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
<?php endforeach; ?>
	</ul>
</article>
<article>
	<h3>ALA Impact stories</h3>
	<ul>
<?php
	$sideargs  = array(
	    'posts_per_page'  => 10,
	    'offset'          => 0,
	    'category_name'   => 'impact-stories',
	    'orderby'         => 'post_date',
	    'order'           => 'DESC',
	    'post_type'       => 'post',
	    'post_status'     => 'publish',
	    'suppress_filters' => true ); 
	$sideposts = get_posts($sideargs);
    foreach ($sideposts as $post) :
    ?>
		<li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
<?php 
	endforeach; 
	//wp_reset_query();
?>
	</ul>
</article>
<!-- /blog sidebar -->
