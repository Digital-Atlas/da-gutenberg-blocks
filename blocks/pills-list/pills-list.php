<?php
/**
 * Pills List Block Template.
 *
 * Renders a semantic <ul> of pill-shaped labels. Each repeater row is one <li>.
 *
 * @param array $block The block settings and attributes.
 */

$wrapper_attributes = get_block_wrapper_attributes( [ 'class' => 'pills-list-block' ] );
?>

<div <?php echo $wrapper_attributes; ?>>
    <?php if ( have_rows( 'pills_repeater' ) ) : ?>
        <ul class="pills-list">
            <?php while ( have_rows( 'pills_repeater' ) ) : the_row();
                $label = get_sub_field( 'pill_label' );
                $link  = get_sub_field( 'pill_link' );

                if ( empty( $label ) ) {
                    continue;
                }
            ?>
                <li class="pill">
                    <?php if ( ! empty( $link['url'] ) ) : ?>
                        <a class="pill-inner pill-link"
                           href="<?php echo esc_url( $link['url'] ); ?>"
                           target="<?php echo esc_attr( ! empty( $link['target'] ) ? $link['target'] : '_self' ); ?>"<?php echo ! empty( $link['target'] ) && '_blank' === $link['target'] ? ' rel="noopener"' : ''; ?>>
                            <?php echo esc_html( $label ); ?>
                        </a>
                    <?php else : ?>
                        <span class="pill-inner"><?php echo esc_html( $label ); ?></span>
                    <?php endif; ?>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else : ?>
        <p><em>Add pills in the block settings.</em></p>
    <?php endif; ?>
</div>
