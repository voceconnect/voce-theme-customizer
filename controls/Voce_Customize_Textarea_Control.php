<?php

if( ! class_exists( 'Voce_Customize_Textarea_Control' ) ):

class Voce_Customize_Textarea_Control extends WP_Customize_Control {

	public $type = 'textarea';

	/**
	* Create Voce Textarea control
	*/
	public function render_content() {
		?>
		<label class="voce-customize-textarea">
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<textarea class="large-text" rows="5" <?php $this->link(); ?>>
				<?php echo esc_textarea( $this->value() ); ?>
			</textarea>
		</label>
		<?php
	}
}

endif;