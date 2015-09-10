<?php

if( ! class_exists( 'Voce_Customize_PSU_Control' ) ):

class Voce_Customize_PSU_Control extends WP_Customize_Control {

	public $type = 'psu';
	public $psu_args = array();

	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );

		if ( empty( $args['psu_args'] ) || !is_array( $args['psu_args'] ) ) {
			$args['psu_args'] = array();
		}
		$this->psu_args = $args['psu_args'];
	}

	/**
	 * Bootstrap plugin
	 */
	public static function init() {
		add_action( 'customize_controls_enqueue_scripts', array( __CLASS__, 'enqueue_admin_scripts' ) );
	}

	/**
	 * Enqueue the necessary scripts
	 */
	public static function enqueue_admin_scripts() {
		wp_enqueue_script( 'psu-customizer-control', plugins_url( 'js/psu-customizer-control.js', __FILE__ ), false, false, true );
	}

	/**
	 * Render control
	 */
	public function render_content() {
		$value = explode(',', $this->value());
		$psu_args = array_merge( array( 'selected' => $value ), $this->psu_args );
		?>
		<label class="voce-customize-psu">
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php echo post_selection_ui( $this->id, $psu_args ); ?>
		</label>
		<?php
	}
}

endif;