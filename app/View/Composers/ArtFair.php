<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class ArtFair extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.content-art_fair',
    ];

    /**
     * Data to be passed to view before rendering, but after merging.
     *
     * @return array
     */
    public function override()
    {
        return [
            'start_date' => get_field('start_date'),
            'end_date'   => get_field('end_date'),
            'booth'      => get_field('booth'),
            'location'   => get_field('location'),
        ];
    }
}
