<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class SingleArtFair extends Composer
{
	/**
	 * List of views served by this composer.
	 *
	 * @var array
	 */
	protected static $views = [
		'partials.content-single-art_fair',
	];
	
	public function override()
	{
		$alt_string = str_replace(PHP_EOL, '', get_the_title(get_post_thumbnail_id()).' '.get_post(get_post_thumbnail_id())->post_content);

		return [
			'link'               => get_the_permalink(),
			'start_date'         => get_field('start_date', get_the_ID()),
			'end_date'           => get_field('end_date', get_the_ID()),
			'location'           => get_field('location', get_the_ID()),
			'booth'              => get_field('booth', get_the_ID()),
			'artists'            => $this->artists(),
			'artists_non_roster' => $this->artists_non_roster(),
			'gallery_images'     => $this->gallery(),
			'thumbnail'          => get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'img-fluid', 'alt' => $alt_string)),
			'alt_string'         => $alt_string,
		]  ;
	}

	public function artists()
	{
		$artists_field_array = get_field('western_exhibitions_artists', get_the_ID());

		if(!$artists_field_array) return [];
		
		$artists = array_map(function($artist) {

			return get_the_title( $artist );

		}, $artists_field_array);

		return $artists;
	}

	public function artists_non_roster()
	{
		$artists_field_array = get_field('artists_non-roster', get_the_ID());

		if(!$artists_field_array) return [];
		
		$artists = array_map(function($artist) {

			return $artist['artist_non-roster_name'];

		}, $artists_field_array);

		return $artists;
	}

	public function gallery()
	{
		$art_fair_field_array = get_field('art_fair_gallery', get_the_ID());

		if(!$art_fair_field_array) return [];
		
		$gallery = array_map(function($image) {
			$gallery_string = htmlentities(str_replace(PHP_EOL, ' ', $image['title'].' '.$image['description']), ENT_QUOTES);
			$image_href = ( 'video' == $image['type'] ) ? $image['url'] : $image['sizes']['large'];

			return [
				'caption'     => $gallery_string,
				'href'        => $image_href,
				'url'         => $image['sizes']['large'],
				'url-w'       => $image['sizes']['large-width'],
				'url-h'       => $image['sizes']['large-height'],
				'title'       => $image['title'],
				'description' => $image['description'],
			];

		}, $art_fair_field_array);

		return $gallery;
	}
}
