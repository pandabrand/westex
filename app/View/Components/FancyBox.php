<?php

namespace App\View\Components;

use Roots\Acorn\View\Component;

class FancyBox extends Component
{
	/**
	 * The FancyBox image array.
	 *
	 * @var array
	 */
	public $image;

	/**
	 * The url.
	 *
	 * @var string
	 */
	public $url;

	/**
	 * The title.
	 *
	 * @var string
	 */
	public $title;

	/**
	 * The description.
	 *
	 * @var string
	 */
	public $description;

	/**
	 * The caption.
	 *
	 * @var string
	 */
	public $caption;

	/**
	 * The thumbnail.
	 *
	 * @var string
	 */
	public $thumbnail;

	/**
	 * Create the component instance.
	 *
	 * @param  array  $image
	 * @return void
	 */
	public function __construct($image = null)
	{
		$this->image = $image;
		$this->title = $image['title'];
		$this->url = 'video' == $image['type'] ? $image['url'] : $image['sizes']['large'];
		$this->description = $image['description'];
		$this->thumbnail = $image['sizes']['medium'];
		$this->caption = htmlentities(str_replace(PHP_EOL, ' ' , $image['title'] . ' ' . $image['description']), ENT_QUOTES);
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return $this->view('components.fancy-box');
	}
}
