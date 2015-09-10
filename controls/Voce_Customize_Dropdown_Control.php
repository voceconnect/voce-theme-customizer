<?php

if( ! class_exists( 'Voce_Customize_Dropdown_Control' ) ):

class Voce_Customize_Dropdown_Control extends WP_Customize_Control {

	public $type = 'dropdown';
	public $dropdown_opts = array();

	/**
	* Create a new Voce dropdown control
	*/
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );

		if ( empty( $args['options'] ) || !is_array( $args['options'] ) ) {
			$args['options'] = array();
		}
		$this->dropdown_opts = $args['options'];
	}

	public function render_content() {
		if ( empty( $this->dropdown_opts ) ) {
			return;
		}

		?>
		<label class="voce-customize-dropdown">
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<select <?php $this->link(); ?>>
				<?php
				foreach ( $this->dropdown_opts as $val => $label ) {
					printf( '<option value="%s" %s>%s</option>', esc_attr( $val ), selected( $val, $this->value() ), esc_html( $label ) );
				}
				?>
			</select>
		</label>
		<?php
	}
}

endif;