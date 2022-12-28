<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Media extends Component
{
    public $narrow_class;
    public $media;
    public $media_caption;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        $this->narrow_class  = $content['narrow_class'];
        $this->media         = $content['media'];
        $this->media_caption = $content['media_caption'];

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.media');
    }
}
