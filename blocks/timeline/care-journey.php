<?php
/**
 * Care Journey Timeline Block Template.
 *
 * @param   array $block The block settings and attributes.
 */

// Generate the block wrapper attributes, inheriting Gutenberg native spacing/colors.
$wrapper_attributes = get_block_wrapper_attributes(
    [
        'class' => 'journey-container'
    ]
);
?>

<div <?php echo $wrapper_attributes; ?>>
  <p class="subtitle"><?php the_field('journey_subtitle_placeholder'); ?></p>
  <h2 class="title"><?php the_field('journey_title_placeholder'); ?></h2>

  <?php if( have_rows('care_journey_steps_repeater') ): ?>
    <ol class="timeline">
      
      <?php while( have_rows('care_journey_steps_repeater') ) : the_row(); 
        $step_title       = get_sub_field('step_title');
        $step_description = get_sub_field('step_description');
        $step_number      = get_row_index();
      ?>
      
      <li>
        <div class="timeline-number"><?php echo esc_html( $step_number ); ?></div>
        <div class="timeline-content">
          <h3><?php echo esc_html( $step_title ); ?></h3>
          <p><?php echo wp_kses_post( $step_description ); ?></p>
        </div>
      </li>

      <?php endwhile; ?>

    </ol>
  <?php endif; ?>
</div>