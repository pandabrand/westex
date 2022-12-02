<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class SingleExhibition extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.content-single-exhibition',
    ];

    /**
     * Data to be passed to view before rendering, but after merging.
     *
     * @return array
     */
    public function override()
    {
      $location = get_the_terms(get_the_ID(), 'location');
      $term = array_pop($location);
      $term_location = '';

      if ( ( stripos( $term->name, 'gallery' ) !== false ) ) {
        $term_location = ', Chicago';
      } elseif ( ( stripos( $term->name, '(northern)' ) !== false ) ) {
        $term_location = ', Skokie';
      }
$non_rosters = get_field('artist_non-roster', get_the_ID());
      $artists_non_roster = ($non_rosters) ? array_map(
          function ($row) {
              return $row['artist_non-roster_name'];
          },
          $non_rosters
      ) : [];
      $artists = (get_field('artists', get_the_ID())) ? 
          array_map(function($artist) {
            return [
              'permalink' => get_the_permalink( $artist->ID ),
              'title'     => $artist->post_title,
            ];
          }, get_field('artists', get_the_ID())) : [];
      $thumbnail_title = str_replace(PHP_EOL, '', get_the_title(get_post_thumbnail_id()).' '.get_post(get_post_thumbnail_id())->post_content);
      $exhibition_images = (get_field('exhibition_images')) ?
          array_map(function($image) {
            $gallery_string = htmlentities(str_replace(PHP_EOL, ' ', $image['title'].' '.$image['description']), ENT_QUOTES);
            return [
              'href'           => ($image['type'] == 'video') ? $image['url'] : $image['sizes']['large'],
              'src'            => $image['sizes']['large'],
              'title'          => $image['title'],
              'description'    => $image['description'],
              'gallery_string' => $gallery_string,
            ];
          }, get_field('exhibition_images')) : [];

      return [
        'permalink'           => get_permalink(get_the_ID()),
        'title'               => get_the_title(get_the_ID()),
        'term'                => $term->name,
        'term_location'       => $term_location,
        'start_date'          => get_field('start_date', get_the_ID()),
        'display_start_date'  => get_field('display_start_date', get_the_ID()),
        'end_date'            => get_field('end_date', get_the_ID()),
        'artists'             => $artists,
        'switch_title'        => get_field('switch_titleartist_order', get_the_ID()) ? 1 : 0,
        'show_title'          => get_field('display_exhibition_title', get_the_ID()) ? get_field('display_exhibition_title', get_the_ID()) : 0,
        'thumbnail'           => get_the_post_thumbnail(get_the_ID(), 'full', ['class' => 'img-fluid', 'alt' => $thumbnail_title]),
        'thumbnail_title'     => $thumbnail_title,
        'non_roster_artists'  => $artists_non_roster,
        'off_site_exhibition' => get_field('off-site_exhibition', get_the_ID()),
        'off_site_url'        => get_field('off-site_url', get_the_ID()),
        'off_site_details'    => get_field('off-site_details', get_the_ID()),
        'exhibition_images'   => $exhibition_images,
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
                  'thumbnail'    => get_the_post_thumbnail($upcoming->ID, 'large', ['class' => 'img-fluid']),
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
              $non_rosters = get_field('artist_non-roster', get_the_ID());
              $artists_non_roster = ($non_rosters) ? array_map(
                  function ($row) {
                      return $row['artist_non-roster_name'];
                  },
                  $non_rosters
              ) : [];

              return [
                'location_title'       => get_the_title(get_the_ID()),
                'thumbnail'            => get_the_post_thumbnail(get_the_ID(), 'medium', ['class' => 'img-fluid']),
                'thumbnail_title'      => get_the_title(get_post_thumbnail_id(get_the_ID())),
                'location_url'         => get_field('location_url', get_the_ID()),
                'location_name'        => get_field('location_name', get_the_ID()),
                'location_address'     => get_field('location_address', get_the_ID()),
                'artists'              => get_field('artists', get_the_ID()),
                'non_roster_artists'   => $artists_non_roster,
                'start_date'           => get_field('start_date', get_the_ID()),
                'display_start_date'   => get_field('display_start_date', get_the_ID()),
                'end_date'             => get_field('end_date', get_the_ID()),
              ];
            }, $offsite_posts)
            : [];
          // set_transient( 'upcoming_exhibitions_off', $offsite_exhibitions, DAY_IN_SECONDS );
        // }
      return $offsite_exhibitions;
    }
}
