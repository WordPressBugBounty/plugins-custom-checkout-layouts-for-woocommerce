<?php 
$global_css = get_option( 'cclw_advance_settings' ); 
$header = isset($global_css['header_design']) ? $global_css['header_design'] : [];
$button = isset($global_css['button_style']) ? $global_css['button_style'] : [];
?>
<style>
:root {
	--main-bg-color: <?php echo isset($header['background_color']) ? $header['background_color'] : '#e6dfdf'; ?>;  
	--main-bor-text-color: <?php echo isset($header['text_color']) ? $header['text_color'] : '#000000'; ?>;
	--main-bor-width: <?php echo isset($header['border_width']) ? $header['border_width'] : '1'; ?>px;
	--main-bor-color: <?php echo isset($header['border_color']) ? $header['border_color'] : '#000000'; ?>;
	
	--main-button-color: <?php echo isset($button['button_color']) ? $button['button_color'] : '#000000'; ?>;
	--main-buttontext-color: <?php echo isset($button['button_text_color']) ? $button['button_text_color'] : '#ffffff'; ?>;
	--main-buttonhover-color: <?php echo isset($button['button_hover_color']) ? $button['button_hover_color'] : '#333333'; ?>;
	--main-buttonhovertext-color: <?php echo isset($button['button_text_hover_color']) ? $button['button_text_hover_color'] : '#ffffff'; ?>;
}

.woocommerce-checkout .border_html {
	border-<?php echo isset($header['border_style']) ? $header['border_style'] :'left';?>-style:solid;
	border-width: <?php echo isset($header['border_width']) ? $header['border_width'] : '1'; ?>px;
	border-color: <?php echo isset($header['border_color']) ? $header['border_color'] : '#000000'; ?>;
}
</style>

