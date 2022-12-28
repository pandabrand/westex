<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Quote extends Component
{
    public $narrow_class, $quote;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        $this->narrow_class = $content['narrow_class'];
        $this->quote        = $content['quote'];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.quote');
    }
}
