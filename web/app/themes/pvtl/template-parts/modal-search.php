<?php
$custom_logo_id   = get_theme_mod( 'custom_logo' );
$custom_logo_attr = array(
	'class'    => 'custom-logo',
	'itemprop' => 'logo',
);
?>
<div
	class="modal fade search-modal"
	id="search-modal"
	tabindex="-1"
	role="dialog"
	aria-labelledby="search-modal"
	aria-hidden="true"
	data-backdrop="true"
>
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Site Search</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<p class="text-center pt-3 pb-3">Use the below form to search the website.</p>
				<?php get_search_form(); ?>
			</div>
		</div>
	</div>
</div>
