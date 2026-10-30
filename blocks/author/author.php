<?php
/**
 * Author / Medical Reviewer Block Template.
 *
 * @param array $block The block settings and attributes.
 */

$wrapper_attributes = get_block_wrapper_attributes( [ 'class' => 'author-review-block' ] );

// 1. Get the selected team member ID from ACF
$team_member_id = get_field('author_team_member'); 

// 2. Setup our variables
$name     = 'Select a Team Member';
$image    = '<div class="author-avatar-placeholder"></div>';
$position = 'Position';
$post_url = ''; // NEW: Variable to hold the team member's URL

// 3. If a team member is selected, fetch their specific data
if ( $team_member_id ) {
    $name     = get_the_title( $team_member_id );
    $post_url = get_permalink( $team_member_id ); // Get the URL
    
    // Grab the featured image from the team member post
    if ( has_post_thumbnail( $team_member_id ) ) {
        $image = get_the_post_thumbnail( $team_member_id, 'thumbnail', [ 'class' => 'author-avatar' ] );
    }

    // Assuming you have a custom field for their title/position on the Team post type
    $position = get_field('team_position', $team_member_id) ?: 'Board-Certified Dermatologist'; 
}

// 4. Get the current post's last updated date natively via WordPress
$last_updated = get_the_modified_date('F j, Y');

// 5. Optional editable strings (with fallbacks if left blank)
$prefix_text = get_field('author_prefix_text') ?: 'Medically reviewed by';
$badge_text  = get_field('author_badge_text') ?: 'Clinically Verified';
?>

<div <?php echo $wrapper_attributes; ?>>
    <div class="author-review-container">
        
        <div class="author-main">
            <div class="author-image-wrapper">
                <?php if ( $post_url ) : ?>
                    <a href="<?php echo esc_url( $post_url ); ?>" class="author-avatar-link">
                        <?php echo $image; ?>
                    </a>
                <?php else : ?>
                    <?php echo $image; ?>
                <?php endif; ?>
            </div>
            
            <div class="author-details">
                <span class="author-prefix"><?php echo esc_html( $prefix_text ); ?></span>
                
                <h4 class="author-name">
                    <?php /* NEW: Link the name as well */ ?>
                    <?php if ( $post_url ) : ?>
                        <a href="<?php echo esc_url( $post_url ); ?>" class="author-name-link"><?php echo esc_html( $name ); ?></a>
                    <?php else : ?>
                        <?php echo esc_html( $name ); ?>
                    <?php endif; ?>
                </h4>
                
                <span class="author-meta">
                    <?php echo esc_html( $position ); ?> &middot; Last reviewed <?php echo esc_html( $last_updated ); ?>
                </span>
            </div>
        </div>

        <div class="author-badge">
            <span class="badge-text"><?php echo esc_html( $badge_text ); ?></span>
        </div>

    </div>
</div>