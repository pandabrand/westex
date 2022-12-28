<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TitleBlock extends Component
{
    public $content;
    public $artist;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        $this->content = $content;
        $this->artist = $content['artist'] ?? false;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.title-block');
    }
}
