<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FullWidthImage extends Component
{
    use \App\Traits\Westex\WestexImage;
    public $content, $full_width_image;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        $this->content = $content;
        $this->full_width_image = $this->getImage($content['image'], $content['fw_image_size'], $content['image_classes']);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.full-width-image');
    }
}
