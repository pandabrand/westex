<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class FlexibleContent extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.flex-*'
    ];

    protected $classed = ['fluid-container'];
    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            //
        ];
    }
}
