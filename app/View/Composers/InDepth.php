<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class InDepth extends Composer
{
	/**
	 * List of views served by this composer.
	 *
	 * @var array
	 */
	protected static $views = [
		'partials.content-in-depth',
	];

	/**
	 * Data to be passed to view before rendering, but after merging.
	 *
	 * @return array
	 */
	public function override()
	{
		return [
			'artist_name'            => $this->artistName(),
			'non_roster_artist_name' => $this->nonRosterArtistName(),
			'show_artist_name'       => get_field( 'show_artist_name' ),
		];
	}
	
	public function with()
	{
		return [
			'link' => get_the_permalink(),
			'medium_thumbnail' => get_the_post_thumbnail( get_the_ID(), 'medium', array('class' => 'd-flex img-fluid mx-auto mb-4')),
		];
	}

	public function artistName() {
		$artist_array = get_field( 'artist' );
		return ($artist_array && 0 < count($artist_array)) ? $artist_array[0]->post_title : '';
	}

	public function nonRosterArtistName() {
		return get_field( 'non_roster_artist' );
	}
}
