<?php
/**
 * Care Tabs Block Template.
 *
 * @param array $block The block settings and attributes.
 */

$wrapper_attributes = get_block_wrapper_attributes( [ 'class' => 'care-tabs-block' ] );
$block_id           = $block['id'];
$tabs               = get_field('care_tabs_repeater');
?>

<div <?php echo $wrapper_attributes; ?>>
    <?php if ( $tabs ) : ?>
        <div class="care-tabs-wrapper" id="<?php echo esc_attr( $block_id ); ?>">

            <?php /* 1. Dynamic CSS for the toggle logic */ ?>
            <style>
            <?php foreach ( $tabs as $index => $tab ) : 
                $i = $index + 1;
                $radio_id = $block_id . '-radio-' . $i;
            ?>
                /* Show the matching panel when checked */
                #<?php echo $radio_id; ?>:checked ~ .care-tabs-layout .care-tabs-panels .panel-<?php echo $i; ?> { 
                    display: block; 
                }
                /* Style the matching label when checked */
                #<?php echo $radio_id; ?>:checked ~ .care-tabs-layout .care-tabs-sidebar .label-<?php echo $i; ?> { 
                    background-color: #ffffff; 
                    border-left: 4px solid var(--uicore-primary-color, #C06141); 
                }
            <?php endforeach; ?>
            </style>

            <?php /* 2. The Hidden Radio Inputs */ ?>
            <?php foreach ( $tabs as $index => $tab ) : 
                $i = $index + 1;
                $radio_id = $block_id . '-radio-' . $i;
            ?>
                <input type="radio" class="care-tab-radio" name="tabs-<?php echo esc_attr( $block_id ); ?>" id="<?php echo esc_attr( $radio_id ); ?>" <?php echo $i === 1 ? 'checked' : ''; ?>>
            <?php endforeach; ?>

            <?php /* 3. The Visual Layout */ ?>
            <div class="care-tabs-layout">
                
                <?php /* Left Sidebar (Labels) */ ?>
                <div class="care-tabs-sidebar">
                    <?php foreach ( $tabs as $index => $tab ) : 
                        $i = $index + 1;
                        $radio_id = $block_id . '-radio-' . $i;
                    ?>
                        <label for="<?php echo esc_attr( $radio_id ); ?>" class="care-tab-label label-<?php echo $i; ?>">
                            
                            <?php /* Dynamic Step Label Field */ ?>
                            <?php if ( ! empty( $tab['tab_step_label'] ) ) : ?>
                                <span class="step-label"><?php echo esc_html( $tab['tab_step_label'] ); ?></span>
                            <?php endif; ?>

                            <h3 class="tab-title"><?php echo esc_html( $tab['tab_title'] ); ?></h3>
                            <p class="tab-subtitle"><?php echo esc_html( $tab['tab_subtitle'] ); ?></p>
                        </label>
                    <?php endforeach; ?>
                </div>

                <?php /* Right Content Area (WYSIWYG Panels & Button) */ ?>
                <div class="care-tabs-panels">
                    
                    <?php foreach ( $tabs as $index => $tab ) : 
                        $i = $index + 1;
                    ?>
                        <div class="care-tab-panel panel-<?php echo $i; ?>">
                            
                            <?php /* The WYSIWYG Content */ ?>
                            <?php echo wp_kses_post( $tab['tab_content'] ); ?>
                            
                            <?php /* 4. Dynamic Link Array Button (Now pulling from inside the repeater!) */ 
                            $button_link = $tab['tabs_button_link'];
                            if( $button_link ): 
                                $link_url    = $button_link['url'];
                                $link_title  = $button_link['title'];
                                $link_target = $button_link['target'] ? $button_link['target'] : '_self';
                            ?>
                                <div class="care-tabs-action">
                                    <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" class="care-tabs-button">
                                        <?php echo esc_html( $link_title ); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                        </div>
                    <?php endforeach; ?>

                </div>

            </div>
        </div>
    <?php else : ?>
        <p><em>Please add tabs in the block settings.</em></p>
    <?php endif; ?>
</div>