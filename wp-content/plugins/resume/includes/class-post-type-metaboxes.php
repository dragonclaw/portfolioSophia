<?php
/**
 * Resume Post Type
 *
 * @package   Resume_Post_Type
 * @license   GPL-2.0+
 */

/**
 * Register metaboxes.
 *
 * @package Team_Post_Type
 */
class Resume_Post_Type_Metaboxes {

	public function init() {
		add_action( 'add_meta_boxes', array( $this, 'team_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_meta_boxes' ), 10, 2 );
	}

	/**
	 * Register the metaboxes to be used for the team post type
	 *
	 * @since 0.1.0
	 */
	public function team_meta_boxes() {
		add_meta_box(
			'resume_fields',
			'Resume Fields',
			array( $this, 'render_meta_boxes' ),
			'resume',
			'normal',
			'high'
		);
	}

	/**
	 * The HTML for the fields
	 *
	 * @since 0.1.0
	 */
	function render_meta_boxes( $post ) {

		$meta     = get_post_custom( $post->ID );
		$title    = ! isset( $meta['resume_date'][0] ) ? '' : $meta['resume_date'][0];
		$twitter  = ! isset( $meta['resume_twitter'][0] ) ? '' : $meta['resume_twitter'][0];
		$linkedin = ! isset( $meta['resume_linkedin'][0] ) ? '' : $meta['resume_linkedin'][0];
		$facebook = ! isset( $meta['resume_facebook'][0] ) ? '' : $meta['resume_facebook'][0];

		wp_nonce_field( basename( __FILE__ ), 'resume_fields' ); ?>

		<table class="form-table">

			<tr>
				<td class="team_meta_box_td" colspan="2">
					<label for="resume_date"><?php _e( 'Date', 'resume-post-type' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="resume_date" class="regular-text" value="<?php echo $title; ?>">
					<p class="description"><?php _e( 'E.g. 1990 - 2009, 2014 - PRESENT ...', 'resume-post-type' ); ?></p>
				</td>
			</tr>

			<tr>
				<td class="resume_meta_box_td" colspan="2">
					<label for="resume_linkedin"><?php _e( 'LinkedIn URL', 'resume-post-type' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="resume_linkedin" class="regular-text" value="<?php echo $linkedin; ?>">
				</td>
			</tr>

			<tr>
				<td class="resume_meta_box_td" colspan="2">
					<label for="resume_twitter"><?php _e( 'Twitter URL', 'resume-post-type' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="resume_twitter" class="regular-text" value="<?php echo $twitter; ?>">
				</td>
			</tr>

			<tr>
				<td class="resume_meta_box_td" colspan="2">
					<label for="resume_facebook"><?php _e( 'Facebook URL', 'resume-post-type' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="resume_facebook" class="regular-text" value="<?php echo $facebook; ?>">
				</td>
			</tr>

		</table>

	<?php }

	/**
	 * Save metaboxes
	 *
	 * @since 0.1.0
	 */
	function save_meta_boxes( $post_id ) {

		global $post;

		// Verify nonce
		if ( ! isset( $_POST['resume_fields'] ) || ! wp_verify_nonce( $_POST['resume_fields'], basename( __FILE__ ) ) ) {
			return $post_id;
		}

		// Check Autosave
		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || ( defined( 'DOING_AJAX' ) && DOING_AJAX ) || isset( $_REQUEST['bulk_edit'] ) ) {
			return $post_id;
		}

		// Don't save if only a revision
		if ( isset( $post->post_type ) && $post->post_type == 'revision' ) {
			return $post_id;
		}

		// Check permissions
		if ( ! current_user_can( 'edit_post', $post->ID ) ) {
			return $post_id;
		}

		$meta['resume_date'] = ( isset( $_POST['resume_date'] ) ? esc_textarea( $_POST['resume_date'] ) : '' );

		$meta['resume_linkedin'] = ( isset( $_POST['resume_linkedin'] ) ? esc_url( $_POST['resume_linkedin'] ) : '' );

		$meta['resume_twitter'] = ( isset( $_POST['resume_twitter'] ) ? esc_url( $_POST['resume_twitter'] ) : '' );

		$meta['resume_facebook'] = ( isset( $_POST['resume_facebook'] ) ? esc_url( $_POST['resume_facebook'] ) : '' );

		foreach ( $meta as $key => $value ) {
			update_post_meta( $post->ID, $key, $value );
		}
	}

}