<div class="reveal experience-modal" id="experience-modal" data-animation-in="fade-in fast" data-close-on-click="false">
    <?php

    the_field( 'experience_content', 'option' );

    if ( have_rows( 'experience_groups', 'option' ) ) :
        $count = 0;

        ?>
        <div class="experience-groups">
            <?php

            while ( have_rows( 'experience_groups', 'option' ) ) : the_row();
                $count++;

                ?>
                <div class="experience-group">
                    <?php

                    vprintf( '<button type="button" data-name="%1$s" class="group-btn group-btn-red group-btn-%2$s">%1$s</button>', [
                        get_sub_field( 'name' ),
                        $count,
                    ] );

                    if ( get_sub_field( 'description' ) ) {

                        ?>
                        <span class="group-description">
                        <?php the_sub_field( 'description' ); ?>
                    </span>
                        <?php

                    }

                    ?>
                </div>
            <?php

            endwhile;

            ?>
            <div class="experience-group">
                <button type="button" data-name="null" class="group-btn group-btn-grey">None of the above</button>
            </div>
        </div>
    <?php

    endif;

    ?>

    <div class="footer-content">
        <?php the_field( 'experience_footer_content', 'option' ); ?>
    </div>

    <button class="close-button" data-close data-name="<?php echo get_experience_group() !== 'null' ? get_experience_group() : 'null' ?>" aria-label="Close modal" type="button">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
