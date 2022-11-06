<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class FlexTitle extends Composer
{
    protected static $views = ['partials.flex-title-block'];

    public function with()
    {
        return [
            // 'title'        => $this->data['title'],
            // 'artist'       => $data['artist'],
            // 'narrow_class' => $data['narrow_class'],
        ];
    }
}