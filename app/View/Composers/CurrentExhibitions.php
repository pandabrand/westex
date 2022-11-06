<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class CurrentExhibitions extends Composer
{
		/**
		 * List of views served by this composer.
		 *
		 * @var array
		 */
		protected static $views = [
				'partials.page-header',
				'partials.content-current-exhibitions',
		];

		/**
		 * Data to be passed to view before rendering, but after merging.
		 *
		 * @return array
		 */
		public function override()
		{
				return [
						'exhibitions' => $this->exhibitions(),
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
					'numberposts' => 4,
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
							'terms'    => ['gallery-one-and-two', 'gallery-one', 'gallery-two', 'skokie'],
						]
					],
					'orderby' => array('slug' => 'ASC'),
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

}
