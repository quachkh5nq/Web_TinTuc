<?php
/**
 * Add on for Visual Composer
 * If VC installed, this file will load
 * This add-on only use for Soledad theme
 *
 * @since 2.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! class_exists( 'Soledad_VC_Admin' ) && function_exists( 'vc_map' ) ) {
	class Soledad_VC_Admin {

		function __construct() {
			// We safely integrate with VC with this hook
			add_action( 'init', array( $this, 'integrate' ) );
		}

		/**
		 * Integrate elements (shortcodes) into VC interface
		 */
		public function integrate() {
			// Check if Visual Composer is installed
			if ( ! defined( 'WPB_VC_VERSION' ) ) {
				// Display notice that Visual Compser is required
				add_action( 'admin_notices', array( __CLASS__, 'notice' ) );

				return;
			}

			/*
			 * Register custom shortcodes within Visual Composer interface
			 *
			 * @see http://kb.wpbakery.com/index.php?title=Vc_map
			 */
			// Latest Posts
			vc_map( array(
				'name'        => __( 'Latest Posts', 'soledad' ),
				'description' => 'Display your latest posts',
				'base'        => 'latest_posts',
				'class'       => '',
				'controls'    => 'full',
				'icon'        => get_template_directory_uri() . '/images/vc-icon.png',
				'category'    => 'Soledad',
				'params'      => array(
					array(
						'type'        => 'textfield',
						'heading'     => 'Heading Title for Latest Posts',
						'param_name'  => 'heading',
						'description' => '',
					),
					array(
						'type'        => 'dropdown',
						'heading'     => __( 'Latest Posts Layout', 'soledad' ),
						'value'       => array(
							'Standard Posts'                   => 'standard',
							'Classic Posts'                    => 'classic',
							'Overlay Posts'                    => 'overlay',
							'Grid Posts'                       => 'grid',
							'Grid 2 Columns Posts'             => 'grid-2',
							'Grid Masonry Posts'               => 'masonry',
							'Grid Masonry 2 Columns Posts'     => 'masonry-2',
							'List Posts'                       => 'list',
							'Boxed Posts Style 1'              => 'boxed-1',
							'Boxed Posts Style 2'              => 'boxed-2',
							'Mixed Posts'                      => 'mixed',
							'Mixed Posts Style 2'              => 'mixed-2',
							'Photography Posts'                => 'photography',
							'1st Standard Then Grid'           => 'standard-grid',
							'1st Standard Then Grid 2 Columns' => 'standard-grid-2',
							'1st Standard Then List'           => 'standard-list',
							'1st Standard Then Boxed'          => 'standard-boxed-1',
							'1st Classic Then Grid'            => 'classic-grid',
							'1st Classic Then Grid 2 Columns'  => 'classic-grid-2',
							'1st Classic Then List'            => 'classic-list',
							'1st Classic Then Boxed'           => 'classic-boxed-1',
							'1st Overlay Then Grid'            => 'overlay-grid',
							'1st Overlay Then List'            => 'overlay-list'
						),
						'param_name'  => 'style',
						'description' => 'Select Latest Posts Style',
					),
					array(
						'type'        => 'textfield',
						'heading'     => 'Number Posts Per Page',
						'param_name'  => 'number',
						'description' => 'Fill the number posts per page you want here',
					),
					array(
						'type'        => 'dropdown',
						'heading'     => __('Page Navigation Style', 'soledad'),
						'value'       => array(
							'Page Navigation Numbers' => 'numbers',
							'Load More Posts'         => 'loadmore',
							'Infinite Scroll'         => 'scroll'
						),
						'param_name'  => 'paging',
						'description' => 'Select Page Navigation Style',
					),
					array(
						'type'        => 'textfield',
						'heading'     => 'Custom Number Posts for Each Time Load More Posts',
						'param_name'  => 'morenum',
						'description' => 'Fill the number posts for each time load more posts here - this option use for load more posts navigation',
					),
					array(
						'type'        => 'textfield',
						'heading'     => 'Exclude Categories',
						'param_name'  => 'exclude',
						'description' => 'If you want to exclude any categories, fill the categories slug here. See <a href="http://pencidesign.com/soledad/soledad-document/assets/images/magazine-2.png" target="_blank">here</a> to know what is category slug. Example: travel, life-style',
					)
				)
			) );

			// Featured Categories
			vc_map( array(
				'name'        => __( 'Featured Category', 'soledad' ),
				'description' => 'Display A Featured Category',
				'base'        => 'featured_cat',
				'class'       => '',
				'controls'    => 'full',
				'icon'        => get_template_directory_uri() . '/images/vc-icon.png',
				'category'    => 'Soledad',
				'params'      => array(
					array(
						'type'        => 'dropdown',
						'heading'     => __( 'Featured Category Layout', 'soledad' ),
						'value'       => array(
							'Style 1 - 1st Post Grid Featured on Left'    => 'style-1',
							'Style 2 - 1st Post Grid Featured on Top'     => 'style-2',
							'Style 3 - Text Overlay'                      => 'style-3',
							'Style 4 - Single Slider'                     => 'style-4',
							'Style 5 - Slider 2 Columns'                  => 'style-5',
							'Style 6 - 1st Post List Featured on Top'     => 'style-6',
							'Style 7 - Grid Layout'                       => 'style-7',
							'Style 8 - List Layout'                       => 'style-8',
							'Style 9 - Small List Layout'                 => 'style-9',
							'Style 10 - 2 First Posts Featured and List'  => 'style-10',
							'Style 11 - Text Overlay Center'              => 'style-11',
							'Style 12 - Slider 3 Columns'                 => 'style-12',
							'Style 13 - Grid 3 Columns'                   => 'style-13',
							'Style 14 - 1st Post Overlay Featured on Top' => 'style-14'
						),
						'param_name'  => 'style',
						'description' => '',
					),
					array(
						'type'        => 'dropdown',
						'heading'     => __( 'Select Category', 'soledad' ),
						'value'       => self::get_terms( 'category' ),
						'param_name'  => 'category',
						'description' => 'Select Featured Category',
					),
					array(
						'type'        => 'textfield',
						'heading'     => 'Number Posts Display',
						'param_name'  => 'number',
						'description' => 'Fill the number posts display you want here',
					),
					array(
						'type'       => 'dropdown',
						'heading'    => __( 'Order by', 'soledad' ),
						'value'      => array(
							'Post Date'    => 'date',
							'Post ID'      => 'ID',
							'Post Title'   => 'title',
							'Random Posts' => 'rand'
						),
						'std'        => 'date',
						'param_name' => 'orderby'
					),
					array(
						'type'       => 'dropdown',
						'heading'    => __( 'Sort order', 'soledad' ),
						'value'      => array(
							 'Descending' => 'DESC',
							 'Ascending' => 'ASC'
						),
						'std'        => 'DESC',
						'param_name' => 'order'
					),
				)
			) );

			// Portfolio
			vc_map( array(
				'name'        => __( 'Portfolio', 'soledad' ),
				'description' => 'Display Your Portfolio',
				'base'        => 'portfolio',
				'class'       => '',
				'controls'    => 'full',
				'icon'        => get_template_directory_uri() . '/images/vc-icon.png',
				'category'    => 'Soledad',
				'params'      => array(
					array(
						'type'        => 'loop',
						'heading'     => __( 'Click button below to Build Query for This Portfolio', 'soledad' ),
						'param_name'  => 'loop',
						'value'       => 'post_type:portfolio',
						'settings'    => array(
							'size'      => array( 'value' => '' ),
							'post_type' => array( 'value' => 'portfolio' ),
						),
						'description' => __( 'Create Portfolio loop, to populate content from your site.', 'soledad' ),
					),
					array(
						'type'        => 'dropdown',
						'heading'     => 'Portfolio Style',
						'value'       => array(
							'Masonry' => 'masonry',
							'Grid'    => 'grid'
						),
						'param_name'  => 'style',
						'description' => '',
					),
					array(
						'type'        => 'hidden',
						'heading'     => 'Number Portfolio Display',
						'param_name'  => 'number',
						'description' => 'Fill the number portfolio display you want here',
					),
					array(
						'type'        => 'dropdown',
						'heading'     => 'Number Columns',
						'value'       => array(
							'3 Columns' => '3',
							'2 Columns' => '2'
						),
						'param_name'  => 'column',
						'description' => '',
					),
					array(
						'type'       => 'dropdown',
						'heading'    => __( 'Image Type - Just apply for Grid Style', 'soledad' ),
						'param_name' => 'image_type',
						'value'      => array(
							__( 'Square', 'soledad' )    => 'square',
							__( 'Vertical', 'soledad' )  => 'vertical',
							__( 'Landscape', 'soledad' ) => 'landscape',
						),
						'std'        => 'landscape',
					),
					array(
						'type'        => 'hidden',
						'heading'     => 'Display Portfolio in Portfolio Categories',
						'param_name'  => 'cat',
						'description' => 'Fill the portfolio categories slug you want to display. E.g: cat-1, cat-2',
					),
					array(
						'type'        => 'dropdown',
						'heading'     => 'Display Filter?',
						'value'       => array(
							'Yes' => 'true',
							'No'  => 'false'
						),
						'param_name'  => 'filter',
						'description' => '',
					),
					array(
						'type'        => 'textfield',
						'heading'     => 'All Portfolio Text',
						'param_name'  => 'all_text',
						'description' => '',
					),
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__( 'Pagination:', 'soledad' ),
						'param_name' => 'pagination',
						'std'        => 'number',
						'value'      => array(
							esc_html__( 'Numeric Pagination', 'soledad' )  => 'number',
							esc_html__( 'Load More Button', 'soledad' )  => 'load_more',
							esc_html__( 'Infinite Load', 'soledad' )     => 'infinite',
						),
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__( 'Custom Number Posts for Each Time Load More Posts', 'soledad' ),
						'param_name' => 'numbermore',
						'std'        => 6,
						'dependency' => array( 'element' => 'pagination', 'value' => array( 'load_more', 'infinite' ) )
					),
					array(
						'type'        => 'dropdown',
						'heading'     => 'Enable Click on Thumbnails to Open Lightbox?',
						'value'       => array(
							'No' => 'false',
							'Yes'    => 'true'
						),
						'param_name'  => 'lightbox',
						'description' => '',
					),
				)
			) );

			// Popular Posts
			vc_map( array(
				'name'        => __( 'Popular Posts', 'soledad' ),
				'description' => 'Display Popular Posts Slider Based on The Most Posts Viewed',
				'base'        => 'popular_posts',
				'class'       => '',
				'controls'    => 'full',
				'icon'        => get_template_directory_uri() . '/images/vc-icon.png',
				'category'    => 'Soledad',
				'params'      => array(
					array(
						'type'        => 'textfield',
						'heading'     => 'Heading Title',
						'param_name'  => 'title',
						'description' => '',
						'value'       => 'Popular Posts'
					),
					array(
						'type'        => 'dropdown',
						'heading'     => 'Display Popular Posts by?',
						'value'       => array(
							'All Time'   => 'all',
							'Once Week'  => 'week',
							'Once Month' => 'month'
						),
						'param_name'  => 'type',
						'description' => '',
					),
					array(
						'type'        => 'dropdown',
						'heading'     => 'Select Columns for Display',
						'value'       => array(
							'4 Columns' => '4',
							'3 Columns' => '3'
						),
						'param_name'  => 'columns',
						'description' => '',
					),
					array(
						'type'        => 'textfield',
						'heading'     => 'Filter Popular Posts by Category(s)',
						'param_name'  => 'category',
						'description' => 'Fill the category(s) slug you want to display. E.g: cat-1, cat-2. Check <a href="http://soledad.pencidesign.com/soledad-document/images/magazine-2.png" target="_blank">this image</a> to know what is slug',
					),
					array(
						'type'        => 'textfield',
						'heading'     => 'Number Posts To Display',
						'param_name'  => 'number',
						'description' => '',
						'value'       => '12'
					)
				)
			) );
			
			// Sidebar
			vc_map( array(
				'name'        => __( 'Soledad Sidebar', 'soledad' ),
				'description' => 'Display a Sidebar for Soledad Theme',
				'base'        => 'soledad_sidebar',
				'class'       => '',
				'controls'    => 'full',
				'icon'        => get_template_directory_uri() . '/images/vc-icon.png',
				'category'    => 'Soledad',
				'params'      => array(
					array(
						'type'        => 'dropdown',
						'heading'     => 'Sidebar to Display',
						'value'       => array(
							'Main Sidebar'   => 'main-sidebar',
							'Custom Sidebar 1'  => 'custom-sidebar-1',
							'Custom Sidebar 2'  => 'custom-sidebar-2',
							'Custom Sidebar 3'  => 'custom-sidebar-3',
							'Custom Sidebar 4'  => 'custom-sidebar-4',
							'Custom Sidebar 5'  => 'custom-sidebar-5',
							'Custom Sidebar 6'  => 'custom-sidebar-6',
							'Custom Sidebar 7'  => 'custom-sidebar-7',
							'Custom Sidebar 8'  => 'custom-sidebar-8',
							'Custom Sidebar 9'  => 'custom-sidebar-9',
							'Custom Sidebar 10'  => 'custom-sidebar-10'
						),
						'param_name'  => 'sidebar',
						'description' => '',
					),
					array(
						'type'        => 'dropdown',
						'heading'     => 'Sidebar Widget Heading Style',
						'value'       => array(
							'Default' => 'style-1',
							'Style 2' => 'style-2',
							'Style 3' => 'style-3',
							'Style 4' => 'style-4',
							'Style 5' => 'style-5',
							'Style 6 - Only Text' => 'style-6',
							'Style 7' => 'style-7',
							'Style 8' => 'style-8',
							'Style 9' => 'style-9',
						),
						'param_name'  => 'style',
						'description' => '',
					),
					array(
						'type'        => 'dropdown',
						'heading'     => 'Sidebar Widget Heading Align',
						'value'       => array(
							'Center' => 'pcalign-center',
							'Left' => 'pcalign-left',
							'Right' => 'pcalign-right',
						),
						'param_name'  => 'align',
						'description' => '',
					),
				)
			) );
			
			// Featured Boxes
			vc_map( array(
				'name'        => __( 'Soledad Featured Boxes', 'soledad' ),
				'description' => 'Create Featured Boxes',
				'base'        => 'soledad_featured_boxes',
				'class'       => '',
				'controls'    => 'full',
				'icon'        => get_template_directory_uri() . '/images/vc-icon.png',
				'category'    => 'Soledad',
				'params'      => array(
					array(
						'type'        => 'dropdown',
						'heading'     => 'Featured Boxes Style',
						'value'       => array(
							'Style 1' => 'boxes-style-1',
							'Style 2' => 'boxes-style-2',
							'Style 3' => 'boxes-style-3',
						),
						'param_name'  => 'style',
						'description' => '',
					),
					array(
						'type'        => 'dropdown',
						'heading'     => 'Featured Boxes Columns',
						'value'       => array(
							'3 Columns' => 'boxes-3-columns',
							'4 Columns' => 'boxes-4-columns',
						),
						'param_name'  => 'columns',
						'description' => '',
					),
					array(
						'type'        => 'dropdown',
						'heading'     => 'Featured Boxes Size Type',
						'value'       => array(
							'Horizontal Size' => 'horizontal',
							'Square Size' => 'square',
							'Vertical Size' => 'vertical'
						),
						'param_name'  => 'size',
						'description' => '',
					),
					array(
						'type'        => 'dropdown',
						'heading'     => 'Open in New Tab?',
						'value'       => array(
							'No' => 'no',
							'Yes' => 'yes',
						),
						'param_name'  => 'new_tab',
						'description' => '',
					),
					array(
						'type'        => 'textfield',
						'heading'     => 'Custom Margin Top ( Unit is Pixel )',
						'param_name'  => 'margin_top',
						'description' => '',
						'value'       => '0'
					),
					array(
						'type'        => 'textfield',
						'heading'     => 'Custom Margin Bottom ( Unit is Pixel )',
						'param_name'  => 'margin_bottom',
						'description' => '',
						'value'       => '0'
					),
					array(
						'type'       => 'param_group',
						'heading'    => '',
						'param_name' => 'boxes_data',
						'value' => urlencode( json_encode( array(
							array(
								'text'       => 'Featured Boxed 1',
								'url' => 'http://example1.com/'
							),
							array(
								'text'       => 'Featured Boxed 2',
								'url' => 'http://example2.com/'
							),
							array(
								'text'       => 'Featured Boxed 3',
								'url' => 'http://example3.com/'
							),
						) ) ),
						'params'     => array(
							array(
								'type'        => 'attach_image',
								'heading'     => __( 'Image', 'soledad' ),
								'param_name'  => 'image',
								'value'       => '',
								'description' => __( 'Select image from media library.', 'soledad' ),
							),
							array(
								'type'        => 'textfield',
								'heading'     => __( 'Text', 'soledad' ),
								'param_name'  => 'text',
								'admin_label' => true,
							),
							array(
								'type' => 'textfield',
								'heading'     => __( 'URL', 'soledad' ),
								'param_name'  => 'url',
							),
						),
					),
				)
			) );
		}

		/**
		 * Show notice if your plugin is activated but Visual Composer is not
		 */
		public static function notice() {
			?>

			<div class="updated">
				<p><?php _e( '<strong>Soledad VC Addon</strong> requires <strong>Visual Composer</strong> plugin to be installed and activated on your site.', 'soledad' ) ?></p>
			</div>

		<?php
		}

		/**
		 * Get category for auto complete field
		 *
		 * @param string $taxonomy Taxnomy to get terms
		 *
		 * @return array
		 */
		private static function get_terms( $taxonomy = 'category' ) {
			$cats = get_terms( $taxonomy );
			if ( ! $cats || is_wp_error( $cats ) ) {
				return array();
			}

			$categories = array();
			foreach ( $cats as $cat ) {
				$categories[] = array(
					'label' => $cat->name,
					'value' => $cat->slug,
					'group' => 'category',
				);
			}

			return $categories;
		}
	}

	new Soledad_VC_Admin();
}


if( ! class_exists( 'Soledad_VC_Shortcodes' ) ) {
	class Soledad_VC_Shortcodes {
		/**
		 * Add shortcodes
		 */
		public static function init() {
			$shortcodes = array(
				'latest_posts',
				'featured_cat',
				'popular_posts',
				'soledad_sidebar',
				'soledad_featured_boxes'
			);

			foreach ( $shortcodes as $shortcode ) {
				add_shortcode( $shortcode, array( __CLASS__, $shortcode ) );
			}
		}

		/**
		 * Retrieve HTML markup of latest_posts shortcode
		 *
		 * @param array  $atts
		 * @param string $content
		 *
		 * @return string
		 */
		public static function latest_posts( $atts, $content = null ) {
			extract(shortcode_atts(array(
				'style'   => 'standard',
				'heading' => '',
				'number'  => '10',
				'paging'  => 'numbers',
				'morenum' => '6',
				'exclude' => '',
				'wpblock' => ''
			), $atts));

			$return = '';

			if ( ! isset( $number ) || ! is_numeric( $number ) ): $number = '10'; endif;
			if ( ! isset( $morenum ) || ! is_numeric( $morenum ) ): $morenum = '6'; endif;
			$paged = max( get_query_var( 'paged' ), get_query_var( 'page' ), 1 );
			$args  = array( 'post_type' => 'post', 'paged' => $paged, 'posts_per_page' => $number );
			if ( ! empty( $exclude ) ):
				$exclude_cats      = str_replace( ' ', '', $exclude );
				$exclude_array     = explode( ',', $exclude_cats );
				$args['tax_query'] = array(
					array(
						'taxonomy' => 'category',
						'field'    => 'slug',
						'terms'    => $exclude_array,
						'operator' => 'NOT IN'
					)
				);
			endif;

			$query_custom = new WP_Query( $args );
			if ( $query_custom->have_posts() ) :
				ob_start();
				?>

				<?php if ( $heading ) : ?>
				<?php
				$heading_title = get_theme_mod( 'penci_featured_cat_style' ) ? get_theme_mod( 'penci_featured_cat_style' ) : 'style-1';
				$heading_align = get_theme_mod( 'penci_heading_latest_align' ) ? get_theme_mod( 'penci_heading_latest_align' ) : 'pcalign-center';
				?>
					<div class="penci-border-arrow penci-homepage-title penci-home-latest-posts <?php echo sanitize_text_field( $heading_title . ' ' . $heading_align ); ?>">
						<h3 class="inner-arrow"><?php echo do_shortcode( $heading ); ?></h3>
					</div>
				<?php endif; ?>

				<div class="penci-wrapper-posts-content">

					<?php if( in_array( $style, array( 'standard', 'classic', 'overlay' ) ) ): ?><div class="penci-wrapper-data"><?php endif; ?>
					<?php if ( in_array( $style, array( 'mixed', 'mixed-2', 'overlay-grid', 'overlay-list', 'photography', 'grid', 'grid-2', 'list', 'boxed-1', 'boxed-2', 'boxed-3', 'standard-grid', 'standard-grid-2', 'standard-list', 'standard-boxed-1', 'classic-grid', 'classic-grid-2', 'classic-list', 'classic-boxed-1', 'magazine-1', 'magazine-2' ) ) ) : ?><ul class="penci-wrapper-data penci-grid penci-shortcode-render"><?php endif; ?>
					<?php if ( in_array( $style, array( 'masonry', 'masonry-2' ) ) ) : ?><div class="penci-wrap-masonry"><div class="penci-wrapper-data masonry penci-masonry"><?php endif; ?>
					<?php /* The loop */
					while ( $query_custom->have_posts() ) : $query_custom->the_post();
						include( locate_template( 'content-' . $style . '.php' ) );
					endwhile;
					?>

					<?php if( in_array( $style, array( 'standard', 'classic', 'overlay' ) ) ): ?></div><?php endif; ?>
					<?php if ( in_array( $style, array( 'masonry', 'masonry-2' ) ) ) : ?></div></div><?php endif; ?>
					<?php if ( in_array( $style, array( 'mixed', 'mixed-2', 'overlay-grid', 'overlay-list', 'photography', 'grid', 'grid-2', 'list', 'boxed-1', 'boxed-2', 'boxed-3', 'standard-grid', 'standard-grid-2', 'standard-list', 'standard-boxed-1', 'classic-grid', 'classic-grid-2', 'classic-list', 'classic-boxed-1', 'magazine-1', 'magazine-2' ) ) ) : ?></ul><?php endif; ?>


					<?php
					if( $paging == 'loadmore' || $paging == 'scroll' ) {
						$button_class = 'penci-ajax-more penci-ajax-home penci-ajax-more-click';
						if( $paging == 'loadmore' ):
							wp_enqueue_script( 'penci_ajax_more_posts' );
							wp_localize_script( 'penci_ajax_more_posts', 'ajax_var_more', array(
									'url'     => admin_url( 'admin-ajax.php' ),
									'nonce'   => wp_create_nonce( 'ajax-nonce' )
								)
							);
						endif;
						if( $paging == 'scroll' ):
							$button_class = 'penci-ajax-more penci-ajax-home penci-ajax-more-scroll';
							wp_enqueue_script( 'penci_ajax_more_scroll' );
							wp_localize_script( 'penci_ajax_more_scroll', 'ajax_var_more', array(
									'url'     => admin_url( 'admin-ajax.php' ),
									'nonce'   => wp_create_nonce( 'ajax-nonce' )
								)
							);
						endif;
						/* Get data template */
						$data_layout = $style;
						$data_template = 'sidebar';
						if ( in_array( $style, array( 'standard-grid', 'classic-grid', 'overlay-grid' ) ) ) {
							$data_layout = 'grid';
						} elseif ( in_array( $style, array( 'standard-grid-2', 'classic-grid-2' ) ) ) {
							$data_layout = 'grid-2';
						} elseif ( in_array( $style, array( 'standard-list', 'classic-list', 'overlay-list' ) ) ) {
							$data_layout = 'list';
						} elseif ( in_array( $style, array( 'standard-boxed-1', 'classic-boxed-1' ) ) ) {
							$data_layout = 'boxed-1';
						}

						if( is_page_template( 'page-vc.php' ) ) {
							$data_template = 'no-sidebar';
						}
						?>
						<div class="penci-pagination <?php echo $button_class; ?>">
							<a class="penci-ajax-more-button" data-mes="<?php echo penci_get_setting('penci_trans_no_more_posts'); ?>" data-layout="<?php echo esc_attr( $data_layout ); ?>" data-number="<?php echo absint($morenum); ?>" data-offset="<?php echo absint($number); ?>" data-exclude="<?php
							echo $exclude; ?>" data-from="vc" data-template="<?php echo $data_template; ?>">
								<span class="ajax-more-text"><?php echo penci_get_setting('penci_trans_load_more_posts'); ?></span><span class="ajaxdot"></span><i class="fa fa-refresh"></i>
							</a>
						</div>
					<?php } else { ?>
					<?php echo penci_pagination_numbers( $query_custom ); ?>
					<?php } ?>

				</div>

			<?php
			endif; wp_reset_postdata();

			$return = ob_get_clean();

			return $return;
		}

		/**
		 * Retrieve HTML markup of featured_cat shortcode
		 *
		 * @param array  $atts
		 * @param string $content
		 *
		 * @return string
		 */
		public static function featured_cat( $atts, $content = null ) {

			$orderby = $order = '';
			extract( shortcode_atts( array(
				'style'    => 'style-1',
				'category' => '',
				'number'   => '5',
				'orderby'  => 'date',
				'order'    => 'DESC',
				''
			), $atts ) );

			$return = '';
			if ( ! isset( $number ) || ! is_numeric( $number ) ): $number = '5'; endif;
			$fea_oj = get_category_by_slug( $category );

			if( ! empty ( $fea_oj ) ) {

				$fea_cat_id = $fea_oj->term_id;
				$fea_cat_name = $fea_oj->name;
				$cat_meta   = get_option( "category_$fea_cat_id" );
				$cat_ads_code = isset( $cat_meta['mag_ads'] ) ? $cat_meta['mag_ads'] : '';

				$attr = array(
					'post_type' => 'post',
					'showposts' => $number,
					'orderby'   => $orderby,
					'order'     => $order,
					'tax_query' => array(
						array(
							'taxonomy' => 'category',
							'field'    => 'slug',
							'terms'    => $category
						)
					)
				);

				$fea_query = new WP_Query( $attr );
				$numers_results = $fea_query->post_count;

				if ( $fea_query->have_posts() ) :

				$heading_title = get_theme_mod( 'penci_featured_cat_style' ) ? get_theme_mod( 'penci_featured_cat_style' ) : 'style-1';
				$heading_align = get_theme_mod( 'penci_featured_cat_align' ) ? get_theme_mod( 'penci_featured_cat_align' ) : 'pcalign-left';

				ob_start();
				?>
				<?php if ( $style == 'style-2' || $style == 'style-14' ) {
					$wrap_class = '';
					if( $style == 'style-14' ): $wrap_class = ' mag-cat-style-14'; endif;
				?>
					<div class="home-featured-cat mag-cat-style-2<?php echo $wrap_class; ?>">
				<?php } else { ?>
					<section class="home-featured-cat mag-cat-<?php echo esc_attr( $style ); ?>">
				<?php } ?>
					<div class="penci-border-arrow penci-homepage-title penci-magazine-title <?php echo sanitize_text_field( $heading_title . ' ' . $heading_align ); ?>">
						<h3 class="inner-arrow"><a href="<?php echo esc_url( get_category_link( $fea_cat_id ) ); ?>"><?php echo sanitize_text_field( $fea_cat_name ); ?></a></h3>
					</div>
					<div class="home-featured-cat-content <?php echo esc_attr( $style ); ?>">
				<?php if ( $style == 'style-4' ): ?>
					<div class="penci-single-mag-slider penci-owl-carousel penci-owl-carousel-slider" data-auto="true" data-dots="true" data-nav="false">
				<?php endif; ?>
				<?php if( $style == 'style-5' || $style == 'style-12' ):
				$data_item = 2;
				if( $style == 'style-12' ): $data_item = 3; endif;
				?>
						<div class="penci-magcat-carousel-wrapper">
							<div class="penci-owl-carousel penci-owl-carousel-slider penci-magcat-carousel" data-speed="400" data-auto="true" data-item="<?php echo $data_item; ?>" data-desktop="<?php echo $data_item; ?>" data-tablet="2" data-tabsmall="1">
				<?php endif; ?>
					<?php if ( $style == 'style-7' || $style == 'style-8' || $style == 'style-13' ): ?>
					<ul class="penci-grid penci-grid-maglayout penci-fea-cat-<?php echo $style; ?>">
				<?php endif; ?>
					<?php
					$m = 1;
					while ( $fea_query->have_posts() ): $fea_query->the_post();
						include( locate_template( 'inc/modules/magazine-' . $style . '.php' ) );
						$m ++; endwhile;
					?>
				<?php if ( $style == 'style-7' || $style == 'style-8' || $style == 'style-13' ): ?>
					</ul>
				<?php endif; ?>
				<?php if ( $style == 'style-5' || $style == 'style-12' ): ?>
						</div>
					</div>
				<?php endif; ?>
				<?php if ( $style == 'style-4' ): ?>
					</div>
				<?php endif; ?>
					</div>
						<?php if ( get_theme_mod( 'penci_home_featured_cat_seemore' ) ): ?>
					<div class="penci-featured-cat-seemore penci-seemore-<?php echo esc_attr( $style ); ?>">
						<a href="<?php echo esc_url( get_category_link( $fea_cat_id ) ); ?>"><?php echo penci_get_setting( 'penci_trans_view_all' ); ?>
							<i class="fa fa-angle-double-right"></i>
						</a>
					</div>
				<?php endif; ?>

				<?php if ( $cat_ads_code ): ?>
					<div class="penci-featured-cat-custom-ads">
						<?php echo stripslashes( $cat_ads_code ); ?>
					</div>
				<?php endif; ?>

				<?php if ( $style == 'style-2' || $style == 'style-14' ) { ?>
					</div>
				<?php }
				else { ?>
				</section>
				<?php } ?>

				<?php
				endif; wp_reset_postdata();
			}

			$return = ob_get_clean();

			return $return;
		}

		/**
		 * Retrieve HTML markup for popular posts element
		 *
		 * @param array  $atts
		 * @param string $content
		 *
		 * @return string
		 */
		public static function popular_posts( $atts, $content = null ) {
			extract( shortcode_atts( array(
				'title'    => 'Popular Posts',
				'type' => 'all',
				'category'   => '',
				'number'   => '12',
				'columns'   => '4',
			), $atts ) );

			$return = '';
			if ( ! isset( $number ) || ! is_numeric( $number ) ): $number = '12'; endif;
			if ( ! isset( $columns ) || ! is_numeric( $columns ) ): $columns = '4'; endif;

			$query = array(
				'posts_per_page' => $number,
				'post_type'      => 'post',
				'meta_key'       => 'penci_post_views_count',
				'orderby'        => 'meta_value_num',
				'order'          => 'DESC'
			);

			if( $type == 'week' ) {
				$query = array(
					'posts_per_page' => $number,
					'post_type'      => 'post',
					'meta_key'       => 'penci_post_week_views_count',
					'orderby'        => 'meta_value_num',
					'order'          => 'DESC'
				);
			} elseif ( $type == 'month' ) {
				$query = array(
					'posts_per_page' => $number,
					'post_type'      => 'post',
					'meta_key'       => 'penci_post_month_views_count',
					'orderby'        => 'meta_value_num',
					'order'          => 'DESC'
				);
			}

			if( $category ):
				$query['category_name'] = $category;
			endif;

			$popular = new WP_Query( $query );

			if( $popular->have_posts() ) {
				$popular_title_length = get_theme_mod( 'penci_home_polular_title_length' ) ? get_theme_mod( 'penci_home_polular_title_length' ) : 8;
				$data_loop            = '';
				$number_posts_display = $popular->post_count;
				if ( ( $columns == '4' && $number_posts_display < 5 ) || ( $columns == '3' && $number_posts_display < 4 ) ):
					$data_loop = ' data-loop="false"';
				endif;

				ob_start();
				?>

				<div class="penci-home-popular-posts">
					<?php if( $title ): ?>
					<h2 class="home-pupular-posts-title">
						<span>
							<?php echo do_shortcode( $title ); ?>
						</span>
					</h2>
					<?php endif; ?>

					<div class="penci-owl-carousel penci-owl-carousel-slider penci-related-carousel penci-home-popular-post"<?php echo $data_loop; ?> data-lazy="true" data-item="<?php echo $columns; ?>" data-desktop="<?php echo $columns; ?>" data-tablet="3" data-tabsmall="2" data-auto="false" data-speed="300" data-dots="true" data-nav="false">
						<?php while ( $popular->have_posts() ) : $popular->the_post(); ?>
							<div class="item-related">
								<?php if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) : ?>
								<?php if( ! get_theme_mod( 'penci_disable_lazyload_layout' ) ) { ?>
								<a class="related-thumb penci-image-holder owl-lazy" href="<?php the_permalink() ?>" title="<?php echo wp_strip_all_tags( get_the_title() ); ?>" data-src="<?php echo penci_get_featured_image_size( get_the_ID(), 'penci-thumb' ); ?>">
									<?php } else { ?>
									<a class="related-thumb penci-image-holder" href="<?php the_permalink() ?>" title="<?php echo wp_strip_all_tags( get_the_title() ); ?>" style="background-image: url('<?php echo penci_get_featured_image_size( get_the_ID(), 'penci-thumb' ); ?>');">
										<?php }?>
										<?php if( has_post_thumbnail() && get_theme_mod('penci_enable_home_popular_icons') ): ?>
											<?php if ( has_post_format( 'video' ) ) : ?>
												<i class="fa fa-play"></i>
											<?php endif; ?>
											<?php if ( has_post_format( 'audio' ) ) : ?>
												<i class="fa fa-music"></i>
											<?php endif; ?>
											<?php if ( has_post_format( 'link' ) ) : ?>
												<i class="fa fa-link"></i>
											<?php endif; ?>
											<?php if ( has_post_format( 'quote' ) ) : ?>
												<i class="fa fa-quote-left"></i>
											<?php endif; ?>
											<?php if ( has_post_format( 'gallery' ) ) : ?>
												<i class="fa fa-picture-o"></i>
											<?php endif; ?>
										<?php endif; ?>
									</a>
									<?php endif; ?>

									<h3><a title="<?php echo wp_strip_all_tags( get_the_title() ); ?>" href="<?php the_permalink(); ?>"><?php echo wp_trim_words( wp_strip_all_tags( get_the_title() ), $popular_title_length, '...' ); ?></a></h3>
									<?php if ( ! get_theme_mod( 'penci_hide_date_home_popular' ) ) : ?>
										<span class="date"><?php penci_soledad_time_link(); ?></span>
									<?php endif; ?>
							</div>
							<?php
						endwhile;
						?>
					</div>
				</div>

				<?php
				$return = ob_get_clean();
			}
			wp_reset_postdata();

			return $return;
		}
		
		
		/**
		 * Retrieve HTML markup for sidebar element
		 *
		 * @param array  $atts
		 * @param string $content
		 *
		 * @return string
		 */
		public static function soledad_sidebar( $atts, $content = null ) {
			extract( shortcode_atts( array(
				'sidebar'    => 'main-sidebar',
				'style' => 'style-1',
				'align'   => 'center'
			), $atts ) );

			if ( ! isset( $sidebar ) ): $sidebar = 'main-sidebar'; endif;
			if ( ! isset( $style ) ): $style = 'style-1'; endif;
			if ( ! in_array( $align, array( 'pcalign-center', 'pcalign-left', 'pcalign-right' ) ) ): $align = 'pcalign-center'; endif;
			
			ob_start();
			?>

			<div id="sidebar" class="penci-sidebar-content penci-sidebar-content-vc <?php echo sanitize_text_field( $style . ' ' . $align ); ?>">
				<div class="theiaStickySidebar">
					<?php 
					if( is_active_sidebar( $sidebar ) ){
						dynamic_sidebar( $sidebar );
					} else {
						dynamic_sidebar( 'main-sidebar' );
					}
					?>
				</div>
			</div>

			<?php
			$return = ob_get_clean();

			return $return;
		}
		
		/**
		 * Retrieve HTML markup for featured boxes - like homepage featured boxes
		 *
		 * @param array  $atts
		 * @param string $content
		 *
		 * @return string
		 */
		public static function soledad_featured_boxes( $atts, $content = null ) {
			extract( shortcode_atts( array(
				'style'    => 'boxes-style-1',
				'columns' => 'boxes-3-columns',
				'size'   => 'horizontal',
				'margin_top'   => '0',
				'margin_bottom'   => '0',
				'boxes_data'   => '',
				'new_tab' => 'no'
			), $atts ) );
			
			if( ! function_exists( 'vc_param_group_parse_atts' ) ){
				return;
			}

			$featured_boxes = (array) vc_param_group_parse_atts( $atts['boxes_data'] );

			if( empty( $featured_boxes ) ) {
				return;
			}
			
			if ( ! isset( $style ) ): $style = 'boxes-style-1'; endif;
			if ( ! isset( $columns ) ): $columns = 'boxes-3-columns'; endif;
			if ( ! isset( $size ) ): $size = 'horizontal'; endif;
			if ( ! isset( $new_tab ) ): $new_tab = 'no'; endif;
			if ( ! is_numeric( $margin_top ) ): $margin_top = '0'; endif;
			if ( ! is_numeric( $margin_bottom ) ): $margin_bottom = '0'; endif;
			$style_css = ' style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;"';
			$weight_text = get_theme_mod( 'penci_home_box_weight' ) ? get_theme_mod( 'penci_home_box_weight' ) : 'normal';
			$thumb = 'penci-thumb';
			if( $size == 'square' ){
				$thumb = 'penci-thumb-square';
			} elseif( $size == 'vertical' ) {
				$thumb = 'penci-thumb-vertical';
			}
			ob_start();
			?>

			<div class="container home-featured-boxes home-featured-boxes-vc boxes-weight-<?php echo $weight_text; ?> boxes-size-<?php echo $size; ?>"<?php echo $style_css; ?>>
				<ul class="homepage-featured-boxes <?php echo $columns; ?>">
					<?php
					foreach ( $featured_boxes as $item ) {
						if ( isset( $item['image'] ) ):
							$homepage_box_image = wp_get_attachment_url( $item['image'] );
							$homepage_box_text = isset( $item['text'] ) ? $item['text'] : '';
							$homepage_box_url = isset( $item['url'] ) ? $item['url'] : '';
						
							$open_url  = '';
							$close_url = '';
							$target = '';
							if( 'yes' == $new_tab ):
								$target = ' target="_blank"';
							endif;
							if ( $homepage_box_url ) {
								$open_url  = '<a href="' . do_shortcode( $homepage_box_url ) . '"' . $target . '>';
								$close_url = '</a>';
							}
							?>
							<li class="penci-featured-ct">
								<?php echo wp_kses( $open_url, penci_allow_html() ); ?>
								<div class="penci-fea-in <?php echo $style; ?>">
									<?php if( ! get_theme_mod( 'penci_disable_lazyload_layout' ) ) { ?>
										<div class="fea-box-img penci-image-holder penci-holder-load penci-lazy" data-src="<?php echo penci_get_image_size_url( $homepage_box_image, $thumb ); ?>"></div>
									<?php } else { ?>
										<div class="fea-box-img penci-image-holder" style="background-image: url('<?php echo penci_get_image_size_url( $homepage_box_image, $thumb ); ?>');"></div>
									<?php }?>

									<?php if( $homepage_box_text ): ?>
									<h4><span class="boxes-text"><span style="font-weight: <?php echo $weight_text; ?>"><?php echo do_shortcode( $homepage_box_text ); ?></span></span></h4>
									<?php endif; ?>
								</div>
								<?php echo wp_kses( $close_url, penci_allow_html() ) ; ?>
							</li>
						<?php
						endif;
					}
					?>
				</ul>
			</div>

			<?php
			$return = ob_get_clean();

			return $return;
		}
	}

	if ( ! is_admin() ) {
		Soledad_VC_Shortcodes::init();
	}

}