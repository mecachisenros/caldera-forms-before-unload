<?php 
/**
 * @param array $form The form config
 */
?>

<div class="caldera-config-group">
	<fieldset>
		<legend><?php esc_html_e( 'Warn user when closing the browser', 'caldera-forms'); ?></legend>
		<div class="caldera-config-field">
			<input 
				type="checkbox" 
				id="caldera-forms-before_unload" 
				value="1" 
				name="config[before_unload_enabled]" 
				class="field-config"
				<?php if ( isset( $form['before_unload_enabled'] ) ) { echo ' checked="checked"'; } ?>>
			<p class="description">
				<?php esc_html_e( 'Enable this setting to warn the user when closing the browser window while the form is processing (uses the \'beforeunload\' event).', 'caldera-forms'); ?>
			</p>
		</div>
	</fieldset>
</div>