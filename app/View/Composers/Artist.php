<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Artist extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.content-artist',
    ];
    
    public function with()
    {
        return [
            'link' => get_the_permalink(),
            'medium_thumbnail' => get_the_post_thumbnail( get_the_ID(), 'medium', array('class' => 'd-flex img-fluid mx-auto')),
        ];
    }
}
