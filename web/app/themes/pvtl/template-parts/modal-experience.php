<div
	class="modal fade experience-modal"
	id="experience-modal"
	tabindex="-1"
	role="dialog"
	aria-labelledby="experience-modal"
	aria-hidden="true"
	data-backdrop="true"
>
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<?php the_field( 'experience_content', 'option' ); ?>
				<?php
				if ( have_rows( 'experience_groups', 'option' ) ) :
					$count = 0;
					?>
					<div class="experience-groups">
						<?php
						while ( have_rows( 'experience_groups', 'option' ) ) :
							the_row();
							$count++;
							?>
							<div class="experience-group">
							<?php
								vprintf(
									'<button
                                        type="button"
                                        data-name="%2$s"
                                        class="group-btn group-btn-red group-btn-%1$s"
                                        data-toggle="tooltip"
                                        data-placement="right"
                                        title="%3$s"
                                    >
                                        %2$s
                                    </button>',
									array(
										esc_html( $count ),
										esc_html( get_sub_field( 'name' ) ),
										esc_html( get_sub_field( 'description' ) ),
									)
								);
							?>
							</div>
						<?php endwhile; ?>
						<div class="experience-group">
							<button type="button" data-name="null" class="group-btn group-btn-grey">
								None of the above
							</button>
						</div>
					</div>
				<?php endif; ?>

				<?php the_field( 'experience_footer_content', 'option' ); ?>
			</div>
		</div>
	</div>
</div>
