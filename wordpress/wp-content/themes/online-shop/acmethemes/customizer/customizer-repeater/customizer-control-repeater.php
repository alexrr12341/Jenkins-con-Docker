<?php
/**
 * Sanitize social data
 */
if ( ! function_exists( 'online_shop_sanitize_social_data' ) ) :
	function online_shop_sanitize_social_data( $input ){
		$input_decoded = json_decode( $input, true );
		if( !empty( $input_decoded ) ) {
			foreach ( $input_decoded as $boxes => $box ){
				foreach ( $box as $key => $value ){
					if( $key == 'link' || $key == 'image' ){
						$input_decoded[$boxes][$key] = esc_url_raw( $value );
					}
                    elseif ( $key == 'checkbox' ){
						$input_decoded[$boxes][$key] = online_shop_sanitize_checkbox( $value );
					}
					else{
						$input_decoded[$boxes][$key] = esc_attr( $value );
					}
				}
			}
			return json_encode( $input_decoded );
		}
		return $input;
	}
endif;

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Online_Shop_Customize_Icons_Control' )):
	/**
	 * Custom Control for Icons Controls
	 * @package Acme Themes
	 * @subpackage Online Shop
	 * @since 1.0.0
	 *
	 */

	class Online_Shop_Customize_Icons_Control extends WP_Customize_Control {
		public $type = 'icons-control';
		public function enqueue() {

		}
		public function render_content() {
			$value = $this->value();
			?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                <span class="at-customize-icons">
                    <span class="icon-preview">
                        <?php if( !empty( $value ) ) { echo '<i class="fa '. esc_attr( $value ) .'"></i>'; } ?>
                    </span>
                    <span class="icon-toggle">
                        <?php echo ( empty( $value )? esc_html__('Add Icon','online-shop'): esc_html__('Edit Icon','online-shop') ); ?>
                        <span class="dashicons dashicons-arrow-down"></span>
                    </span>
                    <span class="icons-list-wrapper hidden">
                        <input class="icon-search" type="text" placeholder="<?php esc_attr_e('Search Icon','online-shop')?>">
	                    <?php
	                    $fa_icon_list_array = online_shop_icons_array();
	                    foreach ( $fa_icon_list_array as $single_icon ) {
		                    if( $value == $single_icon ) {
			                    echo '<span class="single-icon selected"><i class="fa '. esc_attr( $single_icon ) .'"></i></span>';
		                    }
		                    else {
			                    echo '<span class="single-icon"><i class="fa '. esc_attr( $single_icon ) .'"></i></span>';
		                    }
	                    }
	                    ?>
                    </span>
                    <input type="hidden" class="at-icon-value" value="" <?php $this->link(); ?>>
                </span>
            </label>
			<?php
		}
	}
endif;

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Online_Shop_Repeater_Control' )):
	/**
	 * Custom Control Repeater Controls
	 * @package Acme Themes
	 * @subpackage Online Shop
	 * @since 1.0.0
	 *
	 */
	class Online_Shop_Repeater_Control extends WP_Customize_Control {
		/**
		 * The control type.
		 *
		 * @access public
		 * @var string
		 */
		public $type = 'repeater';

		public $repeater_main_label = '';

		public $repeater_add_control_field = '';

		/**
		 * The fields that each container row will contain.
		 *
		 * @access public
		 * @var array
		 */
		public $fields = array();

		/**
		 * Repeater drag and drop controler
		 *
		 * @since  1.0.0
		 */
		public function __construct( $manager, $id, $args = array(), $fields = array() ) {
			$this->fields                       = $fields;
			$this->repeater_main_label          = $args['repeater_main_label'];
			$this->repeater_add_control_field   = $args['repeater_add_control_field'];
			parent::__construct( $manager, $id, $args );
		}

		public function enqueue(){
			wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/library/Font-Awesome/css/font-awesome.min.css', array(), '4.7.0' );
			wp_enqueue_style( 'online-shop-customizer-repeater-style', get_template_directory_uri() . '/acmethemes/customizer/customizer-repeater/customizer-repeater.css', array(), '3.3.6' );
			wp_enqueue_script( 'online-shop-customizer-repeater-script', get_template_directory_uri() . '/acmethemes/customizer/customizer-repeater/customizer-repeater.js', array('jquery', 'jquery-ui-draggable' ), '1.0.0', true  );
		}

		public function render_content() {
			?>
            <span class="customize-control-title">
                <?php echo esc_html( $this->label ); ?>
            </span>
            <?php if ( $this->description ) { ?>
                <span class="description customize-control-description">
                    <?php echo wp_kses_post( $this->description ); ?>
                </span>
                <?php
			}
			?>
            <ul class="at-repeater-field-control-wrap">
				<?php $this->get_fields(); ?>
            </ul>
            <input type="hidden" <?php $this->link(); ?> class="at-repeater-collection" value="<?php echo esc_attr( $this->value() ); ?>"/>
            <button type="button" class="button at-repeater-add-control-field"><?php echo esc_html( $this->repeater_add_control_field ); ?></button>
			<?php
		}

		private function get_fields() {
			$fields = $this->fields;
			$values = json_decode( $this->value() );
			?>
            <script type="text/html" class="at-repeater-field-control-generator">
                <li class="repeater-field-control">
                    <h3 class="repeater-field-title accordion-section-title">
						<?php echo esc_html( $this->repeater_main_label ); ?>
                    </h3>
                    <div class="repeater-fields hidden">
						<?php
						foreach ( $fields as $key => $field ) {
							$class = isset( $field['class'] ) ? $field['class'] : '';
							?>
                            <div class="single-field type-<?php echo esc_attr( $field['type'] ) . ' ' . $class; ?>">
								<?php
								$label       = isset( $field['label'] ) ? $field['label'] : '';
								$description = isset( $field['description'] ) ? $field['description'] : '';
								if ( $field['type'] != 'checkbox' ) { ?>
                                    <span class="customize-control-title"><?php echo esc_html( $label ); ?></span>
                                    <span class="description customize-control-description"><?php echo esc_html( $description ); ?></span>
									<?php
								}
								$new_value = '';
								$default   = isset( $field['default'] ) ? $field['default'] : '';

								switch ( $field['type'] ) {
									case 'text':
										echo '<input data-default="' . esc_attr( $default ) . '" data-name="' . esc_attr( $key ) . '" type="text" value="' . esc_attr( $new_value ) . '"/>';
										break;

									case 'url':
										echo '<input data-default="' . esc_attr( $default ) . '" data-name="' . esc_attr( $key ) . '" type="url" value="' . esc_url( $new_value ) . '"/>';
										break;

									case 'checkbox':
										echo '<input data-default="' . esc_attr( $default ) . '" data-name="' . esc_attr( $key ) . '" type="checkbox" value="' . esc_attr( $new_value ) . '"/>';
										?>
                                        <span class="customize-control-title checkbox"><?php echo esc_html( $label ); ?></span>
                                        <span class="description customize-control-description"><?php echo esc_html( $description ); ?></span>
										<?php
										break;

									case 'textarea':
										echo '<textarea data-default="' . esc_attr( $default ) . '"  data-name="' . esc_attr( $key ) . '">' . esc_textarea( $new_value ) . '</textarea>';
										break;

									case 'select':
										$options = $field['options'];
										echo '<select  data-default="' . esc_attr( $default ) . '"  data-name="' . esc_attr( $key ) . '">';
										foreach ( $options as $option => $val ) {
											printf( '<option value="%s" %s>%s</option>', esc_attr( $option ), selected( $new_value, $option, false ), esc_attr( $val ) );
										}
										echo '</select>';
										break;

									case 'icons':
										?>
                                        <span class="at-customize-icons">
                                            <span class="icon-preview"></span>
                                            <span class="icon-toggle">
                                                <?php esc_html_e('Add Icon','online-shop'); ?>
                                                <span class="dashicons dashicons-arrow-down"></span>
                                            </span>
                                            <span class="icons-list-wrapper hidden">
                                                <input class="icon-search" type="text" placeholder="<?php esc_attr_e('Search Icon','online-shop'); ?>">
                                                <?php
                                                $fa_icon_list_array = online_shop_icons_array();
                                                foreach ( $fa_icon_list_array as $single_icon ) {
                                                    echo '<span class="single-icon"><i class="fa '. esc_attr( $single_icon ) .'"></i></span>';
                                                }
                                                ?>
                                            </span>
                                            <?php
                                            echo '<input class="at-icon-value"  data-default="' . esc_attr( $default ) . '" data-name="' . esc_attr( $key ) . '" type="hidden" value="' . esc_attr( $new_value ) . '"/>';
                                            ?>
                                        </span>
										<?php
										break;
									default:
										break;
								}
								?>
                            </div>
							<?php
						}
						?>
                        <div class="clearfix repeater-footer">
                            <a class="repeater-field-remove" href="#remove">
								<?php esc_html_e( 'Delete', 'online-shop' ) ?>
                            </a>
                            <?php esc_html_e( '|', 'online-shop' ) ?>
                            <a class="repeater-field-close" href="#close">
								<?php esc_html_e( 'Close', 'online-shop' ) ?>
                            </a>
                        </div>
                    </div>
                </li>
            </script>

			<?php
			if ( is_array( $values ) ) {
				foreach ( $values as $value ) { ?>
                    <li class="repeater-field-control">
                        <h3 class="repeater-field-title accordion-section-title">
							<?php echo esc_html( $this->repeater_main_label ); ?>
                        </h3>
                        <div class="repeater-fields hidden">
							<?php
							foreach ( $fields as $key => $field ) {
								$class = isset( $field['class'] ) ? $field['class'] : '';
								?>
                                <div class="single-field type-<?php echo esc_attr( $field['type'] ) . ' ' . $class; ?>">
									<?php
									$label       = isset( $field['label'] ) ? $field['label'] : '';
									$description = isset( $field['description'] ) ? $field['description'] : '';
									if ( $field['type'] != 'checkbox' ) { ?>
                                        <span class="customize-control-title"><?php echo esc_html( $label ); ?></span>
                                        <span class="description customize-control-description"><?php echo esc_html( $description ); ?></span>
										<?php
									}
									$new_value = isset( $value->$key ) ? $value->$key : '';
									$default   = isset( $field['default'] ) ? $field['default'] : '';

									switch ( $field['type'] ) {
										case 'text':
											echo '<input data-default="' . esc_attr( $default ) . '" data-name="' . esc_attr( $key ) . '" type="text" value="' . esc_attr( $new_value ) . '"/>';
											break;

										case 'url':
											echo '<input data-default="' . esc_attr( $default ) . '" data-name="' . esc_attr( $key ) . '" type="url" value="' . esc_url( $new_value ) . '"/>';
											break;

										case 'checkbox':
											echo '<input '.checked(true, $new_value,false).' data-default="' . esc_attr( $default ) . '" data-name="' . esc_attr( $key ) . '" type="checkbox" value="' . esc_attr( $new_value ) . '"/>';
											?>
                                            <span class="customize-control-title checkbox"><?php echo esc_html( $label ); ?></span>
                                            <span class="description customize-control-description"><?php echo esc_html( $description ); ?></span>
											<?php
											break;

										case 'textarea':
											echo '<textarea data-default="' . esc_attr( $default ) . '"  data-name="' . esc_attr( $key ) . '">' . esc_textarea( $new_value ) . '</textarea>';
											break;

										case 'select':
											$options = $field['options'];
											echo '<select  data-default="' . esc_attr( $default ) . '"  data-name="' . esc_attr( $key ) . '">';
											foreach ( $options as $option => $val ) {
												printf( '<option value="%s" %s>%s</option>', esc_attr( $option ), selected( $new_value, $option, false ), esc_attr( $val ) );
											}
											echo '</select>';
											break;

										case 'icons':
											?>
                                            <span class="at-customize-icons">
                                                <span class="icon-preview">
                                                    <?php if( !empty( $new_value ) ) { echo '<i class="fa '. esc_attr( $new_value ) .'"></i>'; } ?>
                                                </span>
                                                <span class="icon-toggle">
                                                    <?php echo ( empty( $new_value )? esc_html__('Add Icon','online-shop'): esc_html__('Edit Icon','online-shop') ); ?>
                                                    <span class="dashicons dashicons-arrow-down"></span>
                                                </span>
                                                <span class="icons-list-wrapper hidden">
                                                    <input class="icon-search" type="text" placeholder="<?php esc_attr_e('Search Icon','online-shop')?>">
                                                    <?php
                                                    $fa_icon_list_array = online_shop_icons_array();
                                                    foreach ( $fa_icon_list_array as $single_icon ) {
                                                        if( $new_value == $single_icon ) {
                                                            echo '<span class="single-icon selected"><i class="fa '. esc_attr( $single_icon ) .'"></i></span>';
                                                        } else {
                                                            echo '<span class="single-icon"><i class="fa '. esc_attr( $single_icon ) .'"></i></span>';
                                                        }
                                                    }
                                                    ?>
                                                </span>
                                                <?php
                                                echo '<input class="at-icon-value"  data-default="' . esc_attr( $default ) . '" data-name="' . esc_attr( $key ) . '" type="hidden" value="' . esc_attr( $new_value ) . '"/>';
                                                ?>
                                            </span>
											<?php
											break;
										default:
											break;
									}
									?>
                                </div>
								<?php
							}
							?>
                            <div class="clearfix repeater-footer">
                                <a class="repeater-field-remove" href="#remove">
									<?php esc_html_e( 'Delete', 'online-shop' ) ?>
                                </a><?php esc_html_e( '|', 'online-shop' ) ?>
                                <a class="repeater-field-close" href="#close">
									<?php esc_html_e( 'Close', 'online-shop' ) ?>
                                </a>
                            </div>
                        </div>
                    </li>
				<?php
				}
			}
		}
	}
endif;