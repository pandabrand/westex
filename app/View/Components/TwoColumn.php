<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TwoColumn extends Component
{
    use \App\Traits\Westex\WestexImage;

    public $image_column, $body_column, $image_column_caption, $placement, $reverse_placement, $narrow_class;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        $this->image_column         = $this->getImage($content['image'], $content['tc_image_size'], $content['tc_classes'] );
        $this->body_column          = $content['body'];
        $this->image_column_caption = $content['image_caption'];
        $this->placement            = $content['placement'];
        $this->reverse_placement    = ($content['placement']) ? 0 : 1;
        $this->narrow_class         = $content['narrow_class'];

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.two-column');
    }
}
