<?php
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Online_Shop_Customize_Category_Dropdown_Control' )):

    /**
     * Custom Control for category dropdown
     * @package Acme Themes
     * @subpackage Online Shop
     * @since 1.0.0
     *
     */
    class Online_Shop_Customize_Category_Dropdown_Control extends WP_Customize_Control {

        /**
         * Declare the control type.
         *
         * @access public
         * @var string
         */
        public $type = 'category_dropdown';

        /**
         * Function to  render the content on the theme customizer page
         *
         * @access public
         * @since 1.0.0
         *
         * @param null
         * @return void
         *
         */
        public function render_content() {
            $online_shop_customizer_name = 'online_shop_customizer_dropdown_categories_' . esc_attr( $this->id );
            $online_shop_dropdown_categories = wp_dropdown_categories(
                array(
                    'name'              => $online_shop_customizer_name,
                    'echo'              => 0,
                    'show_option_none'  => esc_html__('Select','online-shop'),
                    'option_none_value' => '0',
                    'selected'          => $this->value(),
                )
            );
            $online_shop_dropdown_final = str_replace( '<select', '<select ' . $this->get_link(), $online_shop_dropdown_categories );
            printf(
                '<label><span class="customize-control-title">%s</span> %s</label>',
                esc_attr( $this->label ),
                $online_shop_dropdown_final
            );
        }
    }
endif;

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Online_Shop_Customize_Message_Control' )):
    /**
     * Custom Control for html display
     * @package Acme Themes
     * @subpackage Online Shop
     * @since 1.0.0
     *
     */
    class Online_Shop_Customize_Message_Control extends WP_Customize_Control {

        /**
         * Declare the control type.
         * @access public
         * @var string
         */
        public $type = 'message';

        /**
         * Function to  render the content on the theme customizer page
         *
         * @access public
         * @since 1.0.0
         *
         * @param null
         * @return void
         *
         */
	    public function render_content() {
		    if ( empty( $this->description ) ) {
			    return;
		    }
		    $allowed_html = array(
			    'a' => array(
				    'href' => array(),
				    'title' => array(),
				    'data-panel' => array(),
				    'data-section' => array(),
				    'class' => array(),
				    'target' => array(),
			    ),
			    'div' => array(
				    'class' => array(),
			    ),
			    'hr' => array(),
			    'h2' => array(),
			    'br' => array(),
			    'em' => array(),
			    'strong' => array()
		    );
		    ?>
            <div class="online-shop-customize-customize-message">
			    <?php
			    echo wp_kses( $this->description , $allowed_html )
			    ?>
            </div> <!-- .online-shop-customize-customize-message -->
		    <?php
	    }
    }
endif;

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Online_Shop_Customize_WC_Category_Dropdown_Control' )):

	/**
	 * Custom Control for WC category dropdown
	 * @package Acme Themes
	 * @subpackage Online Shop
	 * @since 1.0.0
	 *
	 */
	class Online_Shop_Customize_WC_Category_Dropdown_Control extends WP_Customize_Control {

		/**
		 * Declare the control type.
		 *
		 * @access public
		 * @var string
		 */
		public $type = 'wc_category_dropdown';

		/**
		 * Function to  render the content on the theme customizer page
		 *
		 * @access public
		 * @since 1.0.0
		 *
		 * @param null
		 * @return void
		 *
		 */
		public function render_content() {
			$online_shop_customizer_name = 'online_shop_customizer_dropdown_categories_' . esc_attr( $this->id );
			$query_args = array(
				'name'              => $online_shop_customizer_name,
				'echo'              => 0,
				'show_option_none'  => esc_html__('Select','online-shop'),
				'option_none_value' => '0',
				'selected'          => $this->value(),
			);
			if( online_shop_is_woocommerce_active() ){
				$query_args['taxonomy']='product_cat';
            }
			$online_shop_dropdown_categories = wp_dropdown_categories(
				$query_args
			);
			$online_shop_dropdown_final = str_replace( '<select', '<select ' . $this->get_link(), $online_shop_dropdown_categories );
			printf(
				'<label><span class="customize-control-title">%s</span> %s</label>',
				esc_attr( $this->label ),
				$online_shop_dropdown_final
			);
		}
	}
endif;