<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SingleImage extends Component
{
    use \App\Traits\Westex\WestexImage;
    public $single_image, $image_caption, $narrow_class;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        $this->single_image  = $this->getImage($content['image'], $content['tc_image_size'], $content['tc_classes'] );
        $this->image_caption = $content['image_caption'];
        $this->narrow_class  = $content['narrow_class'];

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.single-image');
    }
}
