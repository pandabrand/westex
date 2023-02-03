<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class UpcomingExhibitions extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.content-upcoming-exhibitions',
    ];

    /**
     * Data to be passed to view before rendering, but after merging.
     *
     * @return array
     */
    public function override()
    {
        return [
            'upcoming_exhibitions' => $this->upcomingGallery(),
            'off_site'             => $this->offsiteExhibitions(),
        ];
    }

    /**
     * Upcoming Gallery
     * 
     * @return array
     */
    public function upcomingGallery()
    {
        $today = date('Ymd');
        // if (false === ( $gallery_posts = get_transient('front_upcoming') )) {
            $args = array(
              'numberofposts' => 3,
              'post_type' => ['exhibition'],
              'tax_query' => array(
                array(
                  'taxonomy' => 'location',
                  'field' => 'slug',
                  'terms' => array('gallery-one', 'gallery-two', 'gallery-one-and-two')
                  )
                ),
                'meta_query' => array(
                  'display_start_date_clause' => array(
                    'key' => 'display_start_date',
                    'compare' => '>',
                    'value' => $today,
                  ),
                  array(
                    'key' => 'off-site_exhibition',
                    'compare' => '==',
                    'value' => '0',
                  ),
                  'gallery_location_clause' => array(
                    'key' => 'gallery_location',
                    'compare' => 'EXISTS'
                    )
                  ),
                  'orderby' => array('display_start_date_clause' => 'ASC', 'gallery_location_clause' => 'ASC'),
                );
                $gallery_posts = get_posts($args);
                // set_transient('front_upcoming', $gallery_posts, 60*60*12);
        // }
        $upcoming_galleries = array_map(
            function ($upcoming) {
                    $artist_array = get_field('artists', $upcoming->ID);
                    
                    $artists = ($artist_array) ? array_map(
                        function ($artist) {
                            return ['post_title' => $artist->post_title];
                        },
                        $artist_array
                    ): [];
                    
                    $location = get_the_terms($upcoming->ID, 'location');
                    $term = array_pop($location);

                    $artists_non_roster = array_map(
                        function ($row) {
                            return $row['artist_non-roster_name'];
                        },
                        get_field('artist_non-roster', $upcoming->ID)
                    );
    
                return [
                  'permalink'          => get_permalink($upcoming->ID),
                  'title'              => get_the_title($upcoming->ID),
                  'term'               => $term->name,
                  'start_date'         => get_field('start_date', $upcoming->ID),
                  'display_start_date' => get_field('display_start_date', $upcoming->ID),
                  'end_date'           => get_field('end_date', $upcoming->ID),
                  'artists'            => $artists,
                  'switch_title'       => get_field('switch_titleartist_order', $upcoming->ID) ? 1 : 0,
                  'show_title'         => get_field('display_exhibition_title', $upcoming->ID) ? get_field('display_exhibition_title', $upcoming->ID) : 0,
                  'artist_non_roster' => $artists_non_roster,
                  'thumbnail'    => get_the_post_thumbnail($upcoming->ID, 'medium', ['class' => 'img-fluid']),
                ];
            },
            $gallery_posts
        );

        return $upcoming_galleries;
    }

    /**
     * Off Site Exhibitions
     * 
     * @return array
     */
    public function offsiteExhibitions()
    {
      // if( false === ( $offsite_exhibitions = get_transient( 'upcoming_exhibitions_off' ) ) ) {
        $today = date('Ymd');
        $args = array(
          'post_type' =>  ['post'],
          'category_name' => 'off-site-exhibition',
          'posts_per_page' => 20,
          'meta_query' => array(
            'relation' => 'AND',
            array(
              'relation' => 'OR',
              array(
                'key' => 'web_display_start_date',
                'compare' => '>=',
                'value' => $today,
              ),
              array(
                'key' => 'web_display_end_date',
                'compare' => '>=',
                'value' => $today,
              ),
            ),
            'artist_sort_clause' => array(
              'key' => 'artist',
              'compare' => 'EXISTS',
            ),
            'web_display_start_date_clause' => array(
              'key' => 'web_display_start_date',
              'compare' => 'EXISTS',
              )
            ),
            'orderby' => array('artist_sort_clause' => 'ASC','web_display_start_date_clause' => 'ASC')
          );
          $offsite_posts = get_posts($args);

          $offsite_exhibitions = $offsite_posts ?
            array_map(function ($exhibition) {
              $non_rosters = get_field('artist_non-roster', $exhibition->ID);
              $artists_non_roster = ($non_rosters) ? array_map(
                  function ($row) {
                      return $row['artist_non-roster_name'];
                  },
                  $non_rosters
              ) : false;

              $artist_array = get_field('artist', $exhibition->ID);
                    
              $artists = ($artist_array) ? array_map(
                    function ($artist) {
                        return $artist->post_title;
                    },
                  $artist_array
              ): false;

              return [
                'location_title'       => get_the_title($exhibition->ID),
                'thumbnail'            => get_the_post_thumbnail($exhibition->ID, 'medium', ['class' => 'img-fluid']),
                'thumbnail_title'      => get_the_title(get_post_thumbnail_id($exhibition->ID)),
                'location_url'         => get_field('location_url', $exhibition->ID),
                'location_name'        => get_field('location_name', $exhibition->ID),
                'location_address'     => get_field('location_address', $exhibition->ID),
                'artists'              => $artists,
                'non_roster_artists'   => $artists_non_roster,
                'start_date'           => get_field('start_date', $exhibition->ID),
                'display_start_date'   => get_field('display_start_date', $exhibition->ID),
                'end_date'             => get_field('end_date', $exhibition->ID),
              ];
            }, $offsite_posts)
            : [];
          // set_transient( 'upcoming_exhibitions_off', $offsite_exhibitions, DAY_IN_SECONDS );
        // }
        error_log( print_r( $offsite_exhibitions, true ) );
      return $offsite_exhibitions;
    }
}
