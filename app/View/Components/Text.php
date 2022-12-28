<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Text extends Component
{
    public $body, $narrow_class;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        $this->body         = $content['body'];
        $this->narrow_class = $content['narrow_class'];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.text');
    }
}
