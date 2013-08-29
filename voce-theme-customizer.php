<?php
/*
  Plugin Name: Voce Theme Customizer
  Plugin URI: http://plugins.voceconnect.com
  Description: Theme Customizer
  Version: 1.0
  Author: banderon
  License: GPL2
 */

// Class can't be defined before WP_Customize_Image_Control
add_action( 'plugins_loaded', function() {
	if ( class_exists( 'WP_Customize_Image_Control' ) ) {
		return;
	}

	class Voce_Customize_Image_Control extends WP_Customize_Image_Control {

		/**
		 * Bootstrap plugin 
		 */
		public static function init() {
			add_action( 'customize_controls_enqueue_scripts', array( __CLASS__, 'enqueue_admin_scripts' ) );
			add_action( 'customize_controls_print_footer_scripts', 'wp_print_media_templates' );
			add_action( 'customize_controls_print_styles', array( __CLASS__, 'print_customizer_styles' ) );
		}

		/**
		 * Enqueue the necessary scripts 
		 */
		public static function enqueue_admin_scripts() {
			wp_enqueue_media();
			wp_enqueue_script( 'media-modal', plugins_url( 'libs/wp-media-modal/wp-media-modal.js', __FILE__ ), false, false, true );
			wp_enqueue_script( 'voce-theme-customizer', plugins_url( 'js/image-handling.js', __FILE__ ), array('media-modal'), false, true );
		}

		/**
		 * Print the CSS required to make media modal work on customizer page 
		 */
		public static function print_customizer_styles() {
			?>
			<style>
			.wp-full-overlay {
				z-index: 1000 !important;
			}
			.voce-customize-image-picker .customize-control-content .dropdown.preview-thumbnail img {
				max-height: 400px;
			}
			.voce-customize-image-picker .library {
				margin-top: 10px;
				padding-top: 10px;
				border-top: 1px solid #dfdfdf;
			}
			.voce-customize-image-picker .library .voce-theme-image-lib, .voce-customize-image-picker .library .voce-theme-image-lib:hover {
				padding-left: 2.5em;
				background-image: url("<?php echo esc_url( admin_url( 'images/media-button-image.gif' ) ); ?>");
				background-repeat: no-repeat;
				background-position: 10px 5px;
			}
			</style>
			<?php
		}

		/**
		 * Create a new Voce Image Control
		 */
		public function __construct( $manager, $id, $args ) {
			parent::__construct( $manager, $id, $args );

			$output_formats = array( 'src', 'id' );
			$this->output_format = 'src';

			if ( ! empty( $args['output_format'] ) && in_array( $args['output_format'], $output_formats ) ) {
				$this->output_format = $args['output_format'];
			}

			$this->remove_tab( 'upload-new' );
			$this->remove_tab( 'uploaded' );

		}

		/**
		 * Define method to prevent parent's method from being invoked 
		 */
		public function prepare_control() {}

		/**
		 * Render control 
		 */
		public function render_content() {
			$src = $this->value();

			if ( ! empty( $src ) && ! empty( $this->output_format ) && 'id' === $this->output_format ) {
				$src = reset( wp_get_attachment_image_src( $src ) );
			}

			?>
			<div class="customize-image-picker voce-customize-image-picker">
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

				<div class="customize-control-content">
					<div class="dropdown preview-thumbnail" tabindex="0">
						<div class="dropdown-content">
							<?php if ( empty( $src ) ): ?>
								<img style="display:none;" />
							<?php else: ?>
								<img src="<?php echo esc_url( set_url_scheme( $src ) ); ?>" />
							<?php endif; ?>
							<div class="dropdown-status"></div>
						</div>
						<div class="dropdown-arrow"></div>
					</div>
				</div>

				<div class="library">
					<?php printf( '<a id="voce-theme-image-%1$s-lib" class="button voce-theme-image-lib" href="#" data-controller="%1$s" data-attachment_ids="%2$d" data-output_format="%3$s" data-uploader_title="Select %4$s">Select Image</a>', esc_attr( $this->id ), $this->value() ?: '', esc_attr( $this->output_format ), esc_attr( $this->label ) ); ?>
				</div>

				<div class="actions">
					<a href="#" class="remove"><?php _e( 'Remove Image' ); ?></a>
				</div>
			</div>
			<?php
		}

	}

	Voce_Customize_Image_Control::init();

}, 11 );

// Class can't be defined before WP_Customize_Control
add_action( 'plugins_loaded', function() {
	if ( ! class_exists( 'WP_Customize_Control' ) ) {
		return;
	}

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

}, 11 );


// Class can't be defined before WP_Customize_Control
add_action( 'plugins_loaded', function() {
	if ( ! class_exists( 'WP_Customize_Control' ) ) {
		return;
	}

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

}, 11 );