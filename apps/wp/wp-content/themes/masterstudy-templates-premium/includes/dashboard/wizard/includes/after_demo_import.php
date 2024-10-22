<?php
// Tagging posts and images that are imported during the demo import process
add_action( 'masterstudy_starter_after_demo_import', 'masterstudy_starter_add_demo_meta_box', 10, 4 );

function masterstudy_starter_add_demo_meta_box( $processed_posts, $processed_terms, $processed_menu_items ) {
	if ( ! empty( $processed_posts ) ) {
		foreach ( $processed_posts as $post_id ) {
			if ( $post_id && get_post_type( $post_id ) ) {
				add_post_meta( $post_id, 'masterstudy_starter_demo', true );
			}
		}
	}

	if ( ! empty( $processed_terms ) ) {
		foreach ( $processed_terms as $term_id ) {
			if ( $term_id ) {
				add_term_meta( $term_id, 'masterstudy_starter_demo', true );
			}
		}
	}

	if ( ! empty( $processed_menu_items ) ) {
		foreach ( $processed_menu_items as $menu_item_id ) {
			if ( $menu_item_id ) {
				add_post_meta( $menu_item_id, 'masterstudy_starter_demo', true );
			}
		}
	}
}

// Update Elementor header footer settings
add_action( 'masterstudy_starter_after_demo_import', 'masterstudy_trigger_resave_after_demo_import', 10, 4 );

function masterstudy_trigger_resave_after_demo_import() {
	$hf_query = new WP_Query(
		array(
			'post_type'      => 'elementor-hf',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
		)
	);

	if ( $hf_query->have_posts() ) {
		remove_action( 'save_post', 'masterstudy_resave_elementor_template' );

		while ( $hf_query->have_posts() ) {
			$hf_query->the_post();
			$hf_id = get_the_ID();

			if ( ! wp_is_post_revision( $hf_id ) ) {
				wp_update_post(
					array(
						'ID'          => $hf_id,
						'post_status' => 'publish',
					)
				);
			}
		}

		add_action( 'save_post', 'masterstudy_resave_elementor_template' );

		wp_reset_postdata();
	}
}

add_action( 'masterstudy_starter_after_demo_import', 'ms_starter_fix_mailchimp_slashes', 10, 3 );

function ms_starter_fix_mailchimp_slashes( $processed_posts, $processed_terms, $processed_menu_items ) {
	global $wpdb;

	$form_id = $wpdb->get_var(
		"SELECT ID FROM {$wpdb->posts} WHERE post_type = 'mc4wp-form' LIMIT 1"
	);

	if ( $form_id ) {
		$form_content = get_post_field( 'post_content', $form_id );

		if ( ! empty( $form_content ) ) {
			$fixed_content = stripslashes( $form_content );

			$wpdb->update(
				$wpdb->posts,
				array( 'post_content' => $fixed_content ),
				array( 'ID' => $form_id )
			);

			add_post_meta( $form_id, 'masterstudy_starter_demo', true );
		}
	}
}

