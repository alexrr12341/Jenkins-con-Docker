<?php
/**
 * Display Basic Info
 *
 * @since Online Shop 1.0.0
 *
 * @param null
 * @return void
 *
 */
if ( !function_exists('online_shop_basic_info') ) :

	function online_shop_basic_info( ) {
		global $online_shop_customizer_all_values;
		$online_shop_basic_info_data = array();

		$online_shop_first_info_icon = $online_shop_customizer_all_values['online-shop-first-info-icon'] ;
		$online_shop_first_info_title = $online_shop_customizer_all_values['online-shop-first-info-title'];
		$online_shop_first_info_link = $online_shop_customizer_all_values['online-shop-first-info-link'];
		$online_shop_basic_info_data[] = array(
			"icon" => $online_shop_first_info_icon,
			"title" => $online_shop_first_info_title,
			"link" => $online_shop_first_info_link
		);

		$online_shop_second_info_icon = $online_shop_customizer_all_values['online-shop-second-info-icon'] ;
		$online_shop_second_info_title = $online_shop_customizer_all_values['online-shop-second-info-title'];
		$online_shop_second_info_link = $online_shop_customizer_all_values['online-shop-second-info-link'];
		$online_shop_basic_info_data[] = array(
			"icon" => $online_shop_second_info_icon,
			"title" => $online_shop_second_info_title,
			"link" => $online_shop_second_info_link
		);

		$online_shop_third_info_icon = $online_shop_customizer_all_values['online-shop-third-info-icon'] ;
		$online_shop_third_info_title = $online_shop_customizer_all_values['online-shop-third-info-title'];
		$online_shop_third_info_link = $online_shop_customizer_all_values['online-shop-third-info-link'];
		$online_shop_basic_info_data[] = array(
			"icon" => $online_shop_third_info_icon,
			"title" => $online_shop_third_info_title,
			"link" => $online_shop_third_info_link
		);

		$online_shop_forth_info_icon = $online_shop_customizer_all_values['online-shop-forth-info-icon'] ;
		$online_shop_forth_info_title = $online_shop_customizer_all_values['online-shop-forth-info-title'];
		$online_shop_forth_info_link = $online_shop_customizer_all_values['online-shop-forth-info-link'];
		$online_shop_basic_info_data[] = array(
			"icon" => $online_shop_forth_info_icon,
			"title" => $online_shop_forth_info_title,
			"link" => $online_shop_forth_info_link
		);

		$column = count( $online_shop_basic_info_data );
		if( $column == 1 ){
			$col= "col-md-12";
		}
        elseif( $column == 2 ){
			$col= "col-md-6";
		}
        elseif( $column == 3 ){
			$col= "col-md-4";
		}
		else{
			$col= "col-md-3";
		}
		$i = 0;
		$number = $online_shop_customizer_all_values['online-shop-header-bi-number'];

		echo "<div class='icon-box'>";
		foreach ( $online_shop_basic_info_data as $base_basic_info_data) {
			if( $i >= $number ){
				break;
			}
			?>
            <div class="icon-box <?php echo esc_attr( $col );?>">
				<?php
				if( !empty( $base_basic_info_data['icon'])){
					?>
                    <div class="icon">
                        <i class="fa <?php echo esc_attr( $base_basic_info_data['icon'] );?>"></i>
                    </div>
					<?php
				}
				if( !empty( $base_basic_info_data['title'] ) ){
					?>
                    <div class="icon-details">
						<?php
						if( !empty( $base_basic_info_data['title']) ){
							if( !empty( $base_basic_info_data['link'])){
								echo '<a href="'.esc_url( $base_basic_info_data['link'] ).'">'.'<span class="icon-text">'.esc_html( $base_basic_info_data['title'] ).'</span>'.'</a>';
                            }
                            else{
	                            echo '<span class="icon-text">'.esc_html( $base_basic_info_data['title'] ).'</span>';
                            }
						}
						?>
                    </div>
					<?php
				}
				?>
            </div>
			<?php
			$i++;
		}
		echo "</div>";
	}
endif;
add_action( 'online_shop_action_basic_info', 'online_shop_basic_info', 10, 2 );

/**
 * Display Social Links
 *
 * @since Online Shop 1.0.0
 *
 * @param null
 * @return void
 *
 */

if ( !function_exists('online_shop_social_links') ) :

	function online_shop_social_links( ) {

		global $online_shop_customizer_all_values;
		$online_shop_social_data = json_decode( $online_shop_customizer_all_values['online-shop-social-data'] );
		if( is_array( $online_shop_social_data )){
			foreach ( $online_shop_social_data as $social_data ){
				$icon = $social_data->icon;
				$link = $social_data->link;
				$checkbox = $social_data->checkbox;
				echo '<div class="icon-box">';
				echo '<a href="'.esc_url( $link ).'" target="'.($checkbox == 1? '_blank':'').'">';
				echo '<i class="fa '.esc_attr( $icon ).'"></i>';
				echo '</a>';
				echo '</div>';
			}
		}
	}
endif;
add_action( 'online_shop_action_social_links', 'online_shop_social_links', 10 );

if ( !function_exists('online_shop_top_menu') ) :

	function online_shop_top_menu( ) {
		echo "<div class='at-first-level-nav at-display-inline-block'>";
		wp_nav_menu(
			array(
				'theme_location' => 'top-menu',
				'container' => false,
				'depth' => 1
			)
		);
		echo "</div>";
	}
endif;
add_action( 'online_shop_action_top_menu', 'online_shop_top_menu', 10 );