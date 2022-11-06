<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class FlexMedia extends Composer
{
    protected static $views = ['partials.flex-media'];

    public function with()
    {
        return [
            'narrow_class'  => $this->data['content']['narrow_class'],
            'media'         => $this->data['content']['media'],
            'media_caption' => $this->data['content']['media_caption'],
        ];
    }
}