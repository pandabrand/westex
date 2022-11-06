<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Front extends Composer
{
		/**
		 * List of views served by this composer.
		 *
		 * @var array
		 */
		protected static $views = [
				'partials.page-header',
				'partials.content-page-front',
				'components.front-gallery-details',
				'components.in-depth-summary',
				'components.front-upcoming-exhibitions',
				'components.front-upcoming-art-fair',
				'partials.nav-front-group',
				'partials.carousel-cell-cards',
		];

		/**
		 * Data to be passed to view before rendering, but after merging.
		 *
		 * @return array
		 */
		public function override()
		{
				return [
						'exhibitions'          => $this->exhibitions(),
						'northern_exhibitions' => $this->northernExhibitions(),
						'in_depth_posts'       => $this->inDepthPosts(),
						'upcoming_exhibitions' => $this->upcomingGallery(),
						'art_fairs'            => $this->artFairs(),
				];
		}

		/**
		 * Front Gallery Details
		 * 
		 * @return array
		 */
		public function exhibitions()
		{
				$today = date('Ymd');
				$args = array(
					'numberposts' => 3,
					'post_type' => ['exhibition'],
					'meta_query' => array(
						'relation' => 'AND',
						'start_date_clause' => array(
							'key' => 'display_start_date',
							'compare' => '<=',
							'value' => $today,
							'type' => 'DATE',
						),
						'end_date_clause' => array(
							'key' => 'display_end_date',
							'compare' => '>=',
							'value' => $today,
							'type' => 'DATE',
						),
						array(
							'relation' => 'OR',
							array(
								'key' => 'off-site_exhibition',
								'compare' => 'EXISTS',
								'value' => ''
							),
							array(
								'key' => 'off-site_exhibition',
								'compare' => '==',
								'value' => '0',
							)
						),
						'gallery_location_clause' => array(
							'key' => 'gallery_location',
							'compare' => 'EXISTS'
						)
					),
					'tax_query' => [
						[
							'taxonomy' => 'location',
							'field'    => 'slug',
							'terms'    => ['gallery-one-and-two', 'gallery-one', 'gallery-two'],
						]
					],
					'orderby' => array('gallery_location_clause' => 'ASC'),
				);
				$front_query = get_posts($args);
				$exhibitions = array_map(
						function ($exhibition) {
								$location = get_the_terms($exhibition->ID, 'location');
								$term = array_pop($location);
								$term_location = '';

								if ( ( stripos( $term->name, 'gallery' ) !== false ) ) {
									$term_location = ', Chicago';
								} elseif ( ( stripos( $term->name, '(northern)' ) !== false ) ) {
									$term_location = ', Skokie';
								}

								$non_rosters = get_field('artist_non-roster', $exhibition->ID);
								$artists_non_roster = ($non_rosters) ? array_map(
										function ($row) {
												return $row['artist_non-roster_name'];
										},
										$non_rosters
								) : [];

								return [
									'permalink'          => get_permalink($exhibition->ID),
									'title'              => get_the_title($exhibition->ID),
									'term'               => $term->name,
									'term_location'      => $term_location,
									'start_date'         => get_field('start_date', $exhibition->ID),
									'display_start_date' => get_field('display_start_date', $exhibition->ID),
									'end_date'           => get_field('end_date', $exhibition->ID),
									'artists'            => get_field('artists', $exhibition->ID),
									'switch_title'       => get_field('switch_titleartist_order', $exhibition->ID) ? 1 : 0,
									'show_title'         => get_field('display_exhibition_title', $exhibition->ID) ? get_field('display_exhibition_title', $exhibition->ID) : 0,
									'thumbnail'          => get_the_post_thumbnail($exhibition->ID, 'large', ['class' => 'img-fluid card-img-top']),
									'thumbnail_title'    => get_the_title(get_post_thumbnail_id($exhibition->ID)),
									'non_roster_artists' => $artists_non_roster,
								];
						},
						$front_query
				);

				return $exhibitions;
		}

		/**
		 * Front Gallery Details
		 * 
		 * @return array
		 */
		public function northernExhibitions()
		{
				$today = date('Ymd');
				$args = array(
					'numberposts' => 3,
					'post_type' => ['exhibition'],
					'meta_query' => array(
						'relation' => 'AND',
						'start_date_clause' => array(
							'key' => 'display_start_date',
							'compare' => '<=',
							'value' => $today,
							'type' => 'DATE',
						),
						'end_date_clause' => array(
							'key' => 'display_end_date',
							'compare' => '>=',
							'value' => $today,
							'type' => 'DATE',
						),
						array(
							'relation' => 'OR',
							array(
								'key' => 'off-site_exhibition',
								'compare' => 'EXISTS',
								'value' => ''
							),
							array(
								'key' => 'off-site_exhibition',
								'compare' => '==',
								'value' => '0',
							)
						),
						'gallery_location_clause' => array(
							'key' => 'gallery_location',
							'compare' => 'EXISTS'
						)
					),
					'tax_query' => [
						[
							'taxonomy' => 'location',
							'field'    => 'slug',
							'terms'    => ['skokie'],
						]
					],
					'orderby' => array('gallery_location_clause' => 'ASC'),
				);
				$front_query = get_posts($args);
				$exhibitions = array_map(
						function ($exhibition) {
								$location = get_the_terms($exhibition->ID, 'location');
								$term = array_pop($location);
								$term_location = '';

								if ( ( stripos( $term->name, 'gallery' ) !== false ) ) {
									$term_location = ', Chicago';
								} elseif ( ( stripos( $term->name, '(northern)' ) !== false ) ) {
									$term_location = ', Skokie';
								}
								
								$non_rosters = get_field('artist_non-roster', $exhibition->ID);
								$artists_non_roster = ($non_rosters) ? array_map(
										function ($row) {
												return $row['artist_non-roster_name'];
										},
										$non_rosters
								) : [];

								return [
									'permalink'          => get_permalink($exhibition->ID),
									'title'              => get_the_title($exhibition->ID),
									'term'               => $term->name,
									'term_location'      => $term_location,
									'start_date'         => get_field('start_date', $exhibition->ID),
									'display_start_date' => get_field('display_start_date', $exhibition->ID),
									'end_date'           => get_field('end_date', $exhibition->ID),
									'artists'            => get_field('artists', $exhibition->ID),
									'switch_title'       => get_field('switch_titleartist_order', $exhibition->ID) ? 1 : 0,
									'show_title'         => get_field('display_exhibition_title', $exhibition->ID) ? get_field('display_exhibition_title', $exhibition->ID) : 0,
									'thumbnail'          => get_the_post_thumbnail($exhibition->ID, 'large', ['class' => 'img-fluid card-img-top']),
									'thumbnail_title'    => get_the_title(get_post_thumbnail_id($exhibition->ID)),
									'non_roster_artists' => $artists_non_roster,
								];
						},
						$front_query
				);

				return $exhibitions;
		}

		/**
		 * In Depth posts
		 * 
		 * @return array
		 */
		public function inDepthPosts()
		{
				$today = date('Ymd');
				$args = array(
						'posts_per_page' => 2,
						'post_type' => 'in-depth',
						'post_parent' => 0,
						'orderby' => 'meta_value_num',
						'meta_key' => 'start_date',
						'order' => 'DESC',
					);
					$ind_posts = get_posts($args);
					return array_map(
						function ($in_depth_post) {
										return [
											'start_date'         => get_field('start_date', $in_depth_post->ID),
											'end_date'           => get_field('end_date', $in_depth_post->ID),
											'permalink'          => get_permalink($in_depth_post->ID),
											'title'              => get_the_title($in_depth_post->ID),
											'artists'            => get_field('artist', $in_depth_post->ID),
											'thumbnail'          => get_the_post_thumbnail($in_depth_post->ID, 'large', ['class' => 'img-fluid card-img-top']),
											'thumbnail_title'    => get_the_title(get_post_thumbnail_id($in_depth_post->ID)),
											'non_roster_artists' => [],
											'term'               => 'Online In Depth With...',
											'term_location'      => '',
											'show_title'         => true,
											'switch_title'       => false,
										];
					},
						$ind_posts
				);
	}

		/**
		 * Upcoming Gallery
		 * 
		 * @return array
		 */
		public function upcomingGallery()
		{
				$today = date('Ymd');
				// if (false === ( $gallery_posts = get_transient('front_upcoming') )) {
						$args = array(
							'numberofposts' => 3,
							'post_type' => ['exhibition'],
							'tax_query' => array(
								array(
									'taxonomy' => 'location',
									'field' => 'slug',
									'terms' => array('gallery-one', 'gallery-two', 'gallery-one-and-two')
									)
								),
								'meta_query' => array(
									'display_start_date_clause' => array(
										'key' => 'display_start_date',
										'compare' => '>',
										'value' => $today,
									),
									array(
										'key' => 'off-site_exhibition',
										'compare' => '==',
										'value' => '0',
									),
									'gallery_location_clause' => array(
										'key' => 'gallery_location',
										'compare' => 'EXISTS'
										)
									),
									'orderby' => array('display_start_date_clause' => 'ASC', 'gallery_location_clause' => 'ASC'),
								);
								$gallery_posts = get_posts($args);
								// set_transient('front_upcoming', $gallery_posts, 60*60*12);
				// }
				$upcoming_galleries = array_map(
						function ($upcoming) {
										$artist_array = get_field('artists', $upcoming->ID);
										
										$artists = ($artist_array) ? array_map(
												function ($artist) {
														return ['post_title' => $artist->post_title];
												},
												$artist_array
										): [];
										
										$location = get_the_terms($upcoming->ID, 'location');
										$term = array_pop($location);
										$term_location = '';

										if ( ( stripos( $term->name, 'gallery' ) !== false ) ) {
											$term_location = 'Chicago';
										} elseif ( ( stripos( $term->name, '(northern)' ) !== false ) ) {
											$term_location = 'Skokie';
										}
										
		
										$artists_non_roster = array_map(
												function ($row) {
														return $row['artist_non-roster_name'];
												},
												get_field('artist_non-roster', $upcoming->ID)
										);
		
								return [
									'permalink'          => get_permalink($upcoming->ID),
									'title'              => get_the_title($upcoming->ID),
									'term'               => $term->name,
									'term_location'      => $term_location,
									'start_date'         => get_field('start_date', $upcoming->ID),
									'display_start_date' => get_field('display_start_date', $upcoming->ID),
									'end_date'           => get_field('end_date', $upcoming->ID),
									'artists'            => $artists,
									'switch_title'       => get_field('switch_titleartist_order', $upcoming->ID) ? 1 : 0,
									'show_title'         => get_field('display_exhibition_title', $upcoming->ID) ? get_field('display_exhibition_title', $upcoming->ID) : 0,
									'artist_non_roster'  => $artists_non_roster,
									'thumbnail'          => get_the_post_thumbnail($upcoming->ID, 'large', ['class' => 'img-fluid']),
								];
						},
						$gallery_posts
				);

				return $upcoming_galleries;
		}
		
		public function artFairs()
		{
			$today = date('Ymd');
			if( false === ( $art_fair_query = get_transient( 'front_art_fair' ) ) ) {
				$args = array(
					'numberofposts' => 3,
					'post_type' => ['art_fair'],
					'meta_query' => array(
						array(
							'key' => 'start_date',
							'compare' => '>=',
							'value' => $today,
						),
					),
					'orderby' => 'meta_value',
					'meta_key' => 'start_date',
					'order' => 'ASC'
				);
				$art_fair_query = new \WP_Query($args);
				set_transient( 'front_art_fair', $art_fair_query, 60*60*12 );
			}
			return $art_fair_query;
		}
}
