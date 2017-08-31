<?php
/**
 * Resume Post Type
 *
 * @package   Resume_Post_Type
 * @license   GPL-2.0+
 */

/**
 * Register post types and taxonomies.
 *
 * @package Resume_Post_Type
 */
class Resume_Post_Type_Registrations {

	public $post_type = 'resume';

	public $taxonomies = array( 'resume_filter' );

	public function init() {
		// Add the team post type and taxonomies
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * Initiate registrations of post type and taxonomies.
	 *
	 * @uses Resume_Post_Type_Registrations::register_post_type()
	 * @uses Resume_Post_Type_Registrations::register_taxonomy_category()
	 */
	public function register() {
		$this->register_post_type();
		$this->register_taxonomy_category();
	}

	/**
	 * Register the custom post type.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	protected function register_post_type() {
		$labels = array(
			'name'               => __( 'Resume', 'resume-post-type' ),
			'singular_name'      => __( 'Resume Member', 'resume-post-type' ),
			'add_new'            => __( 'Add Resume', 'resume-post-type' ),
			'add_new_item'       => __( 'Add Resume', 'resume-post-type' ),
			'edit_item'          => __( 'Edit Resume', 'resume-post-type' ),
			'new_item'           => __( 'New Resume', 'resume-post-type' ),
			'view_item'          => __( 'View Resume', 'resume-post-type' ),
			'search_items'       => __( 'Search Resume', 'resume-post-type' ),
			'not_found'          => __( 'No resume found', 'resume-post-type' ),
			'not_found_in_trash' => __( 'No resume in the trash', 'resume-post-type' ),
		);

		$supports = array(
			'title',
			'editor',
			'thumbnail',
			'custom-fields',
			'revisions',
			'excerpt'
		);

		$args = array(
			'labels'          => $labels,
			'supports'        => $supports,
			'public'          => true,
			'capability_type' => 'post',
			'rewrite'         => array( 'slug' => 'resume', ), // Permalinks format
			'menu_position'   => 30,
			'menu_icon'       => 'dashicons-book',
		);

		$args = apply_filters( 'resume_post_type_args', $args );

		register_post_type( $this->post_type, $args );
	}

	/**
	 * Register a taxonomy for Resume Categories.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	protected function register_taxonomy_category() {
		$labels = array(
			'name'                       => __( 'Resume Categories', 'resume-post-type' ),
			'singular_name'              => __( 'Resume Category', 'resume-post-type' ),
			'menu_name'                  => __( 'Resume Categories', 'resume-post-type' ),
			'edit_item'                  => __( 'Edit Resume Category', 'resume-post-type' ),
			'update_item'                => __( 'Update Resume Category', 'resume-post-type' ),
			'add_new_item'               => __( 'Add New Resume Category', 'resume-post-type' ),
			'new_item_name'              => __( 'New Resume Category Name', 'resume-post-type' ),
			'parent_item'                => __( 'Parent Resume Category', 'resume-post-type' ),
			'parent_item_colon'          => __( 'Parent Resume Category:', 'resume-post-type' ),
			'all_items'                  => __( 'All Resume Categories', 'resume-post-type' ),
			'search_items'               => __( 'Search Resume Categories', 'resume-post-type' ),
			'popular_items'              => __( 'Popular Resume Categories', 'resume-post-type' ),
			'separate_items_with_commas' => __( 'Separate resume categories with commas', 'resume-post-type' ),
			'add_or_remove_items'        => __( 'Add or remove resume categories', 'resume-post-type' ),
			'choose_from_most_used'      => __( 'Choose from the most used resume categories', 'resume-post-type' ),
			'not_found'                  => __( 'No resume categories found.', 'resume-post-type' ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => true,
			'rewrite'           => array( 'slug' => 'resume_filter' ),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		$args = apply_filters( 'resume_post_type_category_args', $args );

		register_taxonomy( $this->taxonomies[0], $this->post_type, $args );
	}
}