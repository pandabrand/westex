<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class SingleArtist extends Composer
{
	/**
	 * List of views served by this composer.
	 *
	 * @var array
	 */
	protected static $views = [
		'partials.content-single-artist',
		'single-artist',
	];
	
	public function override()
	{
		return [
			'link'          => get_the_permalink(),
			'thumbnail'     => get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'd-flex img-fluid mx-auto')),
			'alt_string'    => str_replace(PHP_EOL, '', get_the_title(get_post_thumbnail_id()).' '.get_post(get_post_thumbnail_id())->post_content),
			'born_details'  => get_field('born_details', get_the_ID()),
			'artist_images' => $this->artistCollection(),
			'cv_file'       => get_field('cv_file', get_the_ID()),
		];
	}


	public function artistCollection()
	{
		$collection_field_array = get_field('artist_images', get_the_ID());

		if(!$collection_field_array) return [];

		$collection_field = $collection_field_array[0];
		
		$collection_images = array_map(function($image) {

			return [
				'title'       => $image['title'],
				'url'         => ('video' == $image['type']) ? $image['url'] : $image['sizes']['large'],
				'description' => $image['description'],
				'thumbnail'   => $image['sizes']['medium'],
				'thumbnail-w' => $image['sizes']['medium-width'],
				'thumbnail-h' => $image['sizes']['medium-height'],
				'caption'     => htmlentities(str_replace(PHP_EOL, ' ' , $image['title'] . ' ' . $image['description']), ENT_QUOTES),
			];

		}, $collection_field['artist_image_collection']);

		return [
			'title'      => $collection_field['artist_images_title'],
			'collection' => $collection_images,
		];
	}
}
