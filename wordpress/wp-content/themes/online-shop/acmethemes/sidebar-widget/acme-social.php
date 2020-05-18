<?php
/**
 * Class for adding Social Section Widget
 *
 * @package Acme Themes
 * @subpackage Online Shop
 * @since 1.0.0
 */
if ( ! class_exists( 'Online_Shop_Social' ) ) {

    class Online_Shop_Social extends WP_Widget {
        /*defaults values for fields*/

        private function defaults(){
            /*defaults values for fields*/
            $defaults = array(
                'online_shop_widget_title' => ''
            );
            return $defaults;
        }

        function __construct() {
            parent::__construct(
            /*Base ID of your widget*/
                'online_shop_social',
                /*Widget name will appear in UI*/
                esc_html__('AT Social Section', 'online-shop'),
                /*Widget description*/
                array( 'description' => esc_html__( 'Show Social Section.', 'online-shop' ), )
            );
        }

        /*Widget Backend*/
        public function form( $instance ) {
            $instance = wp_parse_args( (array) $instance, $this->defaults() );
            /*default values*/
            $online_shop_widget_title = esc_attr( $instance[ 'online_shop_widget_title' ] );
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'online_shop_widget_title' ) ); ?>"><?php esc_html_e( 'Title', 'online-shop' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'online_shop_widget_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'online_shop_widget_title' ) ); ?>" type="text" value="<?php echo $online_shop_widget_title; ?>" />
            </p>

            <p>
                <?php
                if( is_customize_preview() ){
	                printf( esc_html__( 'Add/Edit Social Icons from %1$s Here %2$s ', 'online-shop' ), '<a class="at-customizer button button-primary" data-section="online-shop-social-options" style="cursor: pointer">','</a>' );
                }
                else{
	                printf( esc_html__( 'Add/Edit Social Icons from %1$s Here %2$s ', 'online-shop' ), '<a target="_blank" href="'.esc_url( admin_url( 'customize.php' ) ).'?autofocus[section]=online-shop-social-options'.'" class="button button-primary">','</a>' );
                }
                ?>
            </p>
            <?php
        }

        /**
         * Function to Updating widget replacing old instances with new
         *
         * @access public
         * @since 1.0.0
         *
         * @param array $new_instance new arrays value
         * @param array $old_instance old arrays value
         * @return array
         *
         */
        public function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            $instance[ 'online_shop_widget_title' ] = sanitize_text_field( $new_instance[ 'online_shop_widget_title' ] );

	        return $instance;
        }

        /**
         * Function to Creating widget front-end. This is where the action happens
         *
         * @access public
         * @since 1.0.0
         *
         * @param array $args widget setting
         * @param array $instance saved values
         * @return void
         *
         */
        public function widget($args, $instance) {
            $instance = wp_parse_args( (array) $instance, $this->defaults());

            /*default values*/
            $online_shop_widget_title = apply_filters( 'widget_title', !empty( $instance['online_shop_widget_title'] ) ? $instance['online_shop_widget_title'] : '', $instance, $this->id_base );

	        echo $args['before_widget'];
	        if ( !empty( $online_shop_widget_title ) ){

		        echo $args['before_title'];
		        echo $online_shop_widget_title;
		        echo $args['after_title'];

	        }
	        ?>
            <div class="featured-entries-col featured-social">
	            <?php
	            do_action('online_shop_action_social_links');
	            ?>
            </div>
	        <?php
	        echo $args['after_widget'];
        }
    } // Class Online_Shop_Social ends here
}