<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class FlexText extends Composer
{
    protected static $views = ['partials.flex-text'];

    public function with()
    {
        return [
            'body'         => $this->data['content']['body'],
            'narrow_class' => $this->data['content']['narrow_class'],
        ];
    }
}