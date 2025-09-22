<?php 
/*function is called under admin submenu*/
function cclw_render_advance_settings_page() {
?>
<div class="wrap cclw_form_settings_wrap advance_settings acc_design">
	<h1>Advance Settings</h1>
	<form method="post" action="options.php">
		<?php
		settings_fields('cclw_advance_settings_group');
		do_settings_sections('cclw_advance_settings');
		submit_button();
		?>
	</form>
</div>
<?php
}
/*functions to every field*/
//Header section
function cclw_header_design_callback() {
	echo '<h2 class="wp-accordion active">Section Header Style</h2>';
    $options = get_option('cclw_advance_settings');
    $value = isset($options['header_design']) ? $options['header_design'] : array(
        'background_color'     => '#fafafa',
        'text_color'     => '#000000',
        'border_width'   => '3',
        'border_style'   => 'left',
        'border_color'   => '#1e85be',
    );

    echo '<div class="cclw-ad-field-group wp-panel">';

    // Header Background Color
    echo '<div class="cclw-ad-field-row">';
    echo '<label for="background_color" class="cclw-ad-field-label">Header Background Color</label>';
    echo '<input type="text" id="background_color" name="cclw_advance_settings[header_design][background_color]" value="' . esc_attr($value['background_color']) . '" class="color-picker cclw-ad-field-input" data-default-color="#fafafa">';
    echo '</div>';

    // Header Text Color
    echo '<div class="cclw-ad-field-row">';
    echo '<label for="text_color" class="cclw-ad-field-label">Header Text Color</label>';
    echo '<input type="text" id="text_color" name="cclw_advance_settings[header_design][text_color]" value="' . esc_attr($value['text_color']) . '" class="color-picker cclw-ad-field-input" data-default-color="#000000">';
    echo '</div>';

    // Header Border Width
    echo '<div class="cclw-ad-field-row">';
    echo '<label for="border_width" class="cclw-ad-field-label">Header Border Width (px)</label>';
    echo '<input type="number" id="border_width" name="cclw_advance_settings[header_design][border_width]" value="' . esc_attr($value['border_width']) . '" class="cclw-ad-field-input" min="0">';
    echo '</div>';

    // Header Border Style
    echo '<div class="cclw-ad-field-row">';
    echo '<label for="border_style" class="cclw-ad-field-label">Header Border Position</label>';
    echo '<select id="border_style" name="cclw_advance_settings[header_design][border_style]" class="cclw-ad-field-input">';
    echo '<option value="left"' . selected($value['border_style'], 'left', false) . '>Left</option>';
    echo '<option value="right"' . selected($value['border_style'], 'right', false) . '>Right</option>';
    echo '<option value="top"' . selected($value['border_style'], 'top', false) . '>Top</option>';
    echo '<option value="bottom"' . selected($value['border_style'], 'bottom', false) . '>Bottom</option>';
    echo '</select>';
    echo '</div>';

    // Header Border Color
    echo '<div class="cclw-ad-field-row">';
    echo '<label for="border_color" class="cclw-ad-field-label">Header Border Color</label>';
    echo '<input type="text" id="border_color" name="cclw_advance_settings[header_design][border_color]" value="' . esc_attr($value['border_color']) . '" class="color-picker cclw-ad-field-input" data-default-color="#1e85be">';
    echo '</div>';

    echo '</div>'; // End field group
}
/*Button design for checkout buttons*/
function cclw_buttons_design_callback() {
	echo '<h2 class="wp-accordion">Button Style</h2>';
    $options = get_option('cclw_advance_settings');
    $value = isset($options['button_style']) ? $options['button_style'] : array(
        'button_color'              => '#1e85be',
        'button_text_color'         => '#ffffff',
        'button_hover_color'        => '#1e85be',
        'button_text_hover_color'   => '#ffffff'
    );

    echo '<div class="cclw-ad-field-group wp-panel">';

    // Button Background Color
    echo '<div class="cclw-ad-field-row">';
    echo '<label for="button_color" class="cclw-ad-field-label">Button Background Color</label>';
    echo '<input type="text" id="button_color" name="cclw_advance_settings[button_style][button_color]" value="' . esc_attr($value['button_color']) . '" class="color-picker cclw-ad-field-input" data-default-color="#1e85be">';
    echo '</div>';

    // Button Text Color
    echo '<div class="cclw-ad-field-row">';
    echo '<label for="button_text_color" class="cclw-ad-field-label">Button Text Color</label>';
    echo '<input type="text" id="button_text_color" name="cclw_advance_settings[button_style][button_text_color]" value="' . esc_attr($value['button_text_color']) . '" class="color-picker cclw-ad-field-input" data-default-color="#ffffff">';
    echo '</div>';

    // Button Hover Background Color
    echo '<div class="cclw-ad-field-row">';
    echo '<label for="button_hover_color" class="cclw-ad-field-label">Button Hover Background Color</label>';
    echo '<input type="text" id="button_hover_color" name="cclw_advance_settings[button_style][button_hover_color]" value="' . esc_attr($value['button_hover_color']) . '" class="color-picker cclw-ad-field-input" data-default-color="#1e85be">';
    echo '</div>';

    // Button Hover Text Color
    echo '<div class="cclw-ad-field-row">';
    echo '<label for="button_text_hover_color" class="cclw-ad-field-label">Button Hover Text Color</label>';
    echo '<input type="text" id="button_text_hover_color" name="cclw_advance_settings[button_style][button_text_hover_color]" value="' . esc_attr($value['button_text_hover_color']) . '" class="color-picker cclw-ad-field-input" data-default-color="#ffffff">';
    echo '</div>';

    echo '</div>'; // End field group
}