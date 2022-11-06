<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ExhibitionPanels extends Component
{
	public $exhibitions;
	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public function __construct($exhibitions)
	{
		$this->exhibitions = $exhibitions;
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\Contracts\View\View|\Closure|string
	 */
	public function render()
	{
		return view('components.exhibition-panels');
	}
}
